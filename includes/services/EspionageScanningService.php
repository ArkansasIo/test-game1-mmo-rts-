<?php
declare(strict_types=1);

require_once __DIR__ . '/ProceduralUniverseService.php';

final class EspionageScanningService
{
    public function __construct(private PDO $pdo)
    {
    }

    public function runMission(int $attackerId, int $targetId, string $type, int $agents): array
    {
        if ($attackerId < 1 || $targetId < 1 || $agents < 1 || !in_array($type, ['recon', 'spy', 'sabotage'], true)) {
            throw new InvalidArgumentException('Invalid espionage request.');
        }
        $targetRealm = $this->pdo->prepare('SELECT player_id,protection_until FROM target_realms WHERE id=?');
        $targetRealm->execute([$targetId]);
        $realm = $targetRealm->fetch(PDO::FETCH_ASSOC);
        $defenderId = $realm && $realm['player_id'] !== null ? (int)$realm['player_id'] : $targetId;
        if ($attackerId === $defenderId) throw new InvalidArgumentException('A commander cannot target their own realm.');
        $this->pdo->beginTransaction();
        try {
            $attacker = $this->player($attackerId, true);
            $defender = $this->player($defenderId, true);
            if ($realm && !empty($realm['protection_until']) && new DateTimeImmutable((string)$realm['protection_until']) > new DateTimeImmutable('now')) throw new RuntimeException('Target is protected.');
            if ($this->protected($defender)) throw new RuntimeException('Target is protected.');
            $attackerResources = $this->resources($attackerId, true);
            $defenderResources = $this->resources($defenderId, true);
            if ((int)$attackerResources['spies'] < $agents) throw new RuntimeException('Insufficient covert agents.');
            if ($type === 'sabotage') $this->assertCooldown($attackerId, 'covert_sabotage');
            $attackerForce = $agents * max(1, (int)($attacker['covert_level'] ?? 1));
            $defenderForce = (int)$defenderResources['anti_spies'] * max(1, (int)($defender['anti_covert_level'] ?? 1));
            $detectionProbability = max(0.02, min(0.92, 0.08 + max(0, $defenderForce - $attackerForce) * 0.002));
            $successProbability = max(0.05, min(0.95, 0.20 + ($agents * 0.012) + ((int)($attacker['covert_level'] ?? 1) * 0.03) - ($defenderForce * 0.0015)));
            $seed = hash('sha256', implode(':', [$attackerId, $defenderId, $type, $agents, microtime(true), random_int(0, PHP_INT_MAX)]));
            $roll = hexdec(substr($seed, 0, 8)) / 4294967295;
            $detected = $roll < $detectionProbability;
            $successRoll = hexdec(substr($seed, 8, 8)) / 4294967295;
            $success = !$detected && $successRoll < $successProbability;
            $agentLosses = $detected ? min($agents, max(1, (int)ceil($agents * 0.25))) : 0;
            $damage = $type === 'sabotage' && $success ? min(100, max(1, (int)round($agents * 2 * $successProbability * max(1, (int)($attacker['covert_level'] ?? 1))))) : 0;
            $resultText = $detected ? 'Operation detected by counter-intelligence.' : ($success ? ucfirst($type) . ' operation succeeded.' : 'Operation failed without detection.');
            $payload = ['type' => $type, 'success' => $success, 'detected' => $detected, 'agents_sent' => $agents, 'agent_losses' => $agentLosses, 'detection_probability' => round($detectionProbability, 4), 'success_probability' => round($successProbability, 4), 'seed' => $seed];
            $this->pdo->prepare('UPDATE player_resources SET spies=GREATEST(0,spies-?) WHERE player_id=?')->execute([$agents, $attackerId]);
            $stmt = $this->pdo->prepare('INSERT INTO covert_missions (attacker_id,defender_id,mission_type,agents_sent,success,detected,result_text,sabotage_damage,damage_system,success_probability) VALUES (?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$attackerId, $defenderId, $type, $agents, $success ? 1 : 0, $detected ? 1 : 0, $resultText, $damage, $type === 'sabotage' ? 'unit_production' : null, $successProbability]);
            $missionId = (int)$this->pdo->lastInsertId();
            $this->espionageEvent($missionId, $attackerId, $defenderId, 'launched', $payload);
            if ($detected) $this->espionageEvent($missionId, $attackerId, $defenderId, 'detected', $payload);
            if ($success) $this->espionageEvent($missionId, $attackerId, $defenderId, 'succeeded', $payload);
            if (!$success && !$detected) $this->espionageEvent($missionId, $attackerId, $defenderId, 'failed', $payload);
            $report = null;
            $reportId = null;
            if ($success && in_array($type, ['recon', 'spy'], true)) {
                $reportPayload = $this->classifiedPayload($type, $defenderResources, $defender);
                $reportPayload['confidence'] = round($successProbability * 100, 2);
                $reportPayload['mission_seed'] = $seed;
                $report = $this->pdo->prepare('INSERT INTO intelligence_reports (player_id,target_player_id,report_type,payload) VALUES (?,?,?,?)');
                $report->execute([$attackerId, $defenderId, $type, json_encode($reportPayload, JSON_THROW_ON_ERROR)]);
                $reportId = (int)$this->pdo->lastInsertId();
                $payload['report_id'] = $reportId;
                $this->espionageEvent($missionId, $attackerId, $defenderId, 'reported', ['report_id' => $reportId, 'classification' => 'CLASSIFIED']);
            }
            if ($damage > 0) {
                $this->pdo->prepare('UPDATE player_resources SET unit_production=GREATEST(0,unit_production-?) WHERE player_id=?')->execute([$damage, $defenderId]);
                $this->espionageEvent($missionId, $attackerId, $defenderId, 'sabotage_applied', ['damage' => $damage, 'system' => 'unit_production']);
            }
            if ($type === 'sabotage') $this->setCooldown($attackerId, 'covert_sabotage', 60);
            $this->event($attackerId, 'espionage_mission', 'covert_mission', $missionId, $payload);
            $this->pdo->commit();
            return ['mission_id' => $missionId, 'report_id' => $reportId, 'target_player_id' => $defenderId, 'type' => $type, 'success' => $success, 'detected' => $detected, 'agent_losses' => $agentLosses, 'damage' => $damage, 'result' => $resultText, 'detection_probability' => $detectionProbability, 'success_probability' => $successProbability, 'seed' => $seed];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function scan(int $playerId, int $galaxy, int $sector, int $system, int $orbit = 0): array
    {
        if ($playerId < 1) throw new InvalidArgumentException('Invalid scanner identity.');
        $universe = new ProceduralUniverseService($this->pdo);
        $located = $universe->locate($galaxy, $sector, $system, $orbit, $playerId);
        if (($located['state'] ?? '') !== 'ready') return $located;
        $entity = $located['entity'] ?: $located['system'];
        $technology = $this->scanTechnology($playerId);
        $basePower = $this->setting('scan_base_power', 3);
        $powerPerTech = $this->setting('scan_power_per_technology', 2);
        $scanPower = $basePower + ($technology * $powerPerTech);
        $requiredPower = $this->setting('scan_base_required_power', 2) + ((int)($entity['danger_level'] ?? 0) * 2);
        $seed = hash('sha256', implode(':', [$playerId, $galaxy, $sector, $system, $orbit, microtime(true), random_int(0, PHP_INT_MAX)]));
        $accessible = $scanPower >= $requiredPower;
        $report = ['coordinate' => [$galaxy, $sector, $system, $orbit], 'entity_key' => $entity['entity_key'], 'scan_power' => $scanPower, 'required_power' => $requiredPower, 'technology_level' => $technology, 'visibility' => $accessible ? 'full' : 'partial', 'seed' => $seed];
        if ($accessible) {
            $report['entity'] = $entity;
            $universe->scan($playerId, $galaxy, $sector, $system, $orbit);
        } else {
            $report['entity'] = ['entity_key' => $entity['entity_key'], 'entity_type' => $entity['entity_type'], 'danger_level' => $entity['danger_level'], 'name' => 'CLASSIFIED SIGNAL'];
        }
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare('INSERT INTO scan_missions (player_id,galaxy_number,sector_number,system_number,orbit_number,entity_key,scan_power,required_power,detected,status,mission_seed,report_json,completed_at) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$playerId, $galaxy, $sector, $system, $orbit, $entity['entity_key'], $scanPower, $requiredPower, $accessible ? 0 : 1, $accessible ? 'completed' : 'partial', $seed, json_encode($report, JSON_THROW_ON_ERROR), (new DateTimeImmutable('now'))->format('Y-m-d H:i:s')]);
            $missionId = (int)$this->pdo->lastInsertId();
            $this->pdo->prepare('INSERT INTO universe_generation_events(player_id,entity_key,action_key,result_json) VALUES(?,?,\'scan\',?)')->execute([$playerId, $entity['entity_key'], json_encode($report, JSON_THROW_ON_ERROR)]);
            $this->pdo->prepare('INSERT INTO game_events (player_id,event_type,entity_type,entity_id,payload) VALUES (?,?,?,?,?)')->execute([$playerId, 'universe_scan', 'scan_mission', $missionId, json_encode($report, JSON_THROW_ON_ERROR)]);
            $this->pdo->commit();
            return ['state' => $accessible ? 'success' : 'partial', 'mission_id' => $missionId, 'scan' => $report, 'message' => $accessible ? 'Scan complete: full telemetry acquired.' : 'Scan complete: only partial telemetry acquired.'];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    private function classifiedPayload(string $type, array $resources, array $defender): array
    {
        $payload = ['classification' => 'CLASSIFIED', 'observation_type' => $type, 'observed_at' => (new DateTimeImmutable('now'))->format(DateTimeInterface::ATOM)];
        if ($type === 'recon') $payload['military'] = ['attack_units' => (int)$resources['attack_units'], 'defense_units' => (int)$resources['defense_units'], 'attack_turns' => (int)$resources['attack_turns']];
        else $payload['strategic'] = ['naquadah' => (int)$resources['naquadah'], 'unit_production' => (int)$resources['unit_production'], 'government_id' => $defender['government_id'] ?? null, 'race_id' => $defender['race_id'] ?? null];
        return $payload;
    }

    private function scanTechnology(int $playerId): int
    {
        $stmt = $this->pdo->prepare("SELECT COALESCE(SUM(level),0) FROM player_technologies WHERE player_id=? AND (category IN ('navigation','technology','research') OR technology_key LIKE '%scan%' OR technology_key LIKE '%sensor%')");
        $stmt->execute([$playerId]);
        return (int)$stmt->fetchColumn();
    }

    private function player(int $id, bool $lock): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM players WHERE id=?' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) throw new RuntimeException('Player not found.');
        return $row;
    }

    private function resources(int $id, bool $lock): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM player_resources WHERE player_id=?' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) throw new RuntimeException('Player resources not found.');
        return $row;
    }

    private function protected(array $player): bool
    {
        foreach (['protected_until', 'vacation_until'] as $key) if (!empty($player[$key]) && new DateTimeImmutable((string)$player[$key]) > new DateTimeImmutable('now')) return true;
        return false;
    }

    private function assertCooldown(int $playerId, string $key): void
    {
        $stmt = $this->pdo->prepare('SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key=? FOR UPDATE');
        $stmt->execute([$playerId, $key]);
        $available = $stmt->fetchColumn();
        if ($available && new DateTimeImmutable((string)$available) > new DateTimeImmutable('now')) throw new RuntimeException('Espionage cooldown is active.');
    }

    private function setCooldown(int $playerId, string $key, int $seconds): void
    {
        $available = (new DateTimeImmutable('now'))->modify('+' . $seconds . ' seconds')->format('Y-m-d H:i:s');
        $this->pdo->prepare("INSERT INTO player_cooldowns (player_id,cooldown_key,available_at) VALUES (?,?,?) ON DUPLICATE KEY UPDATE available_at=VALUES(available_at)")->execute([$playerId, $key, $available]);
    }

    private function setting(string $key, int $fallback): int
    {
        $stmt = $this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value === false ? $fallback : (int)$value;
    }

    private function espionageEvent(int $missionId, int $attackerId, int $defenderId, string $type, array $payload): void
    {
        $this->pdo->prepare('INSERT INTO espionage_events (mission_id,attacker_id,defender_id,event_type,payload) VALUES (?,?,?,?,?)')->execute([$missionId, $attackerId, $defenderId, $type, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }

    private function event(int $playerId, string $type, string $entityType, int $entityId, array $payload): void
    {
        $this->pdo->prepare('INSERT INTO game_events (player_id,event_type,entity_type,entity_id,payload) VALUES (?,?,?,?,?)')->execute([$playerId, $type, $entityType, $entityId, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }
}

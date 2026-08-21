<?php
declare(strict_types=1);

require_once __DIR__ . '/../../config/config.php';

final class CombatFleetService
{
    public function __construct(private PDO $pdo)
    {
    }

    public function moveFleet(int $playerId, int $sourceColonyId, int $targetColonyId, string $missionType, array $units, array $cargo = [], ?DateTimeImmutable $now = null): array
    {
        $now = $now ?? new DateTimeImmutable('now');
        $allowed = ['transport', 'attack', 'raid', 'colonize', 'explore'];
        if ($playerId < 1 || $sourceColonyId < 1 || $targetColonyId < 1 || !in_array($missionType, $allowed, true)) {
            throw new InvalidArgumentException('Invalid fleet movement request.');
        }
        $normalizedUnits = $this->normalizeUnits($units);
        $shipCount = array_sum($normalizedUnits);
        if ($shipCount < 1) {
            throw new InvalidArgumentException('At least one fleet unit is required.');
        }
        $this->pdo->beginTransaction();
        try {
            $source = $this->colony($sourceColonyId, true);
            if ((int)$source['player_id'] !== $playerId) {
                throw new RuntimeException('Source colony ownership validation failed.');
            }
            $target = $this->colony($targetColonyId, false);
            if (!$target) {
                throw new RuntimeException('Target colony not found.');
            }
            if ((int)$target['player_id'] === $playerId) {
                throw new InvalidArgumentException('Target colony must belong to another realm for this mission.');
            }
            $distance = $this->distance((string)$source['coordinate'], (string)$target['coordinate']);
            $fuelPerDistance = $this->setting('fleet_fuel_per_distance', 10);
            $fuelCost = max(1, $distance * $fuelPerDistance * $shipCount);
            $resources = $this->resources($playerId, true);
            if ((int)($resources['deuterium'] ?? 0) < $fuelCost) {
                throw new RuntimeException('Insufficient Deuterium for fleet movement.');
            }
            $speed = max(1, $this->setting('fleet_speed_units_per_hour', 60));
            $travelSeconds = max(60, (int)ceil(($distance / $speed) * 3600));
            $departure = $now->format('Y-m-d H:i:s');
            $arrival = $now->modify('+' . $travelSeconds . ' seconds')->format('Y-m-d H:i:s');
            $seed = hash('sha256', implode(':', [$playerId, $sourceColonyId, $targetColonyId, $missionType, $departure, json_encode($normalizedUnits, JSON_THROW_ON_ERROR)]));
            $payload = [
                'units' => $normalizedUnits,
                'cargo' => $this->normalizeCargo($cargo),
                'distance' => $distance,
                'fuel_cost' => $fuelCost,
                'mission_seed' => $seed,
            ];
            $stmt = $this->pdo->prepare('INSERT INTO fleet_missions (player_id,source_colony_id,target_colony_id,mission_type,payload,distance_units,fuel_cost,mission_seed,departure_at,arrival_at,status) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$playerId, $sourceColonyId, $targetColonyId, $missionType, json_encode($payload, JSON_THROW_ON_ERROR), $distance, $fuelCost, $seed, $departure, $arrival, 'outbound']);
            $missionId = (int)$this->pdo->lastInsertId();
            $this->pdo->prepare('UPDATE player_resources SET deuterium=deuterium-? WHERE player_id=?')->execute([$fuelCost, $playerId]);
            $this->event($playerId, 'fleet_departed', 'fleet_mission', $missionId, $payload + ['mission_type' => $missionType]);
            $this->fleetEvent($missionId, $playerId, 'departed', $payload);
            $this->pdo->commit();
            return ['mission_id' => $missionId, 'mission_type' => $missionType, 'distance' => $distance, 'fuel_cost' => $fuelCost, 'travel_seconds' => $travelSeconds, 'departure_at' => $departure, 'arrival_at' => $arrival, 'status' => 'outbound', 'seed' => $seed];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function processArrivals(?DateTimeImmutable $now = null): array
    {
        $now = $now ?? new DateTimeImmutable('now');
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM fleet_missions WHERE status='outbound' AND arrival_at<=? ORDER BY id FOR UPDATE");
            $stmt->execute([$now->format('Y-m-d H:i:s')]);
            $missions = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $results = [];
            foreach ($missions as $mission) {
                $payload = json_decode((string)$mission['payload'], true);
                if (!is_array($payload)) $payload = [];
                $this->pdo->prepare("UPDATE fleet_missions SET status='arrived',resolved_at=? WHERE id=?")->execute([$now->format('Y-m-d H:i:s'), $mission['id']]);
                $this->fleetEvent((int)$mission['id'], (int)$mission['player_id'], 'arrived', ['mission_type' => $mission['mission_type']]);
                $result = ['mission_id' => (int)$mission['id'], 'mission_type' => $mission['mission_type'], 'status' => 'arrived'];
                if (in_array($mission['mission_type'], ['attack', 'raid'], true)) {
                    $target = $this->colony((int)$mission['target_colony_id'], false);
                    if (!$target) {
                        $this->failMission($mission, 'Target colony no longer exists.');
                        $result['status'] = 'failed';
                    } else {
                        $combat = $this->resolveCombatInternal((int)$mission['player_id'], (int)$target['player_id'], (string)$mission['mission_type'], $payload, (string)$mission['mission_seed']);
                        $result['combat'] = $combat;
                        $result['status'] = 'completed';
                        $this->fleetEvent((int)$mission['id'], (int)$mission['player_id'], 'combat_resolved', $combat);
                    }
                } else {
                    $this->fleetEvent((int)$mission['id'], (int)$mission['player_id'], 'returned', ['mission_type' => $mission['mission_type']]);
                    $this->pdo->prepare("UPDATE fleet_missions SET status='completed' WHERE id=?")->execute([$mission['id']]);
                    $result['status'] = 'completed';
                }
                $results[] = $result;
            }
            $this->pdo->commit();
            return ['processed' => count($results), 'missions' => $results, 'processed_at' => $now->format(DateTimeInterface::ATOM)];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function resolveCombat(int $attackerId, int $defenderId, string $actionType = 'attack', ?array $fleetPayload = null, ?string $missionSeed = null, bool $consumeTurn = true): array
    {
        if ($attackerId < 1 || $defenderId < 1) throw new InvalidArgumentException('Invalid combat participants.');
        $realm = $this->pdo->prepare('SELECT player_id FROM target_realms WHERE id=? AND player_id IS NOT NULL');
        $realm->execute([$defenderId]);
        $realmPlayerId = $realm->fetchColumn();
        if ($realmPlayerId !== false) $defenderId = (int)$realmPlayerId;
        if ($attackerId === $defenderId) throw new InvalidArgumentException('Invalid combat participants.');
        if (!in_array($actionType, ['attack', 'raid'], true)) throw new InvalidArgumentException('Unsupported combat action.');
        $this->pdo->beginTransaction();
        try {
            $result = $this->resolveCombatInternal($attackerId, $defenderId, $actionType, $fleetPayload ?? [], $missionSeed ?? hash('sha256', implode(':', [$attackerId, $defenderId, $actionType, microtime(true)])), $consumeTurn);
            $this->pdo->commit();
            return $result;
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    private function resolveCombatInternal(int $attackerId, int $defenderId, string $actionType, array $fleetPayload, string $seed, bool $consumeTurn = false): array
    {
        $attacker = $this->player($attackerId, true);
        $defender = $this->player($defenderId, true);
        $ar = $this->resources($attackerId, true);
        $dr = $this->resources($defenderId, true);
        if ($this->protected($defender)) throw new RuntimeException('Target is protected.');
        $turns = max(1, (int)($fleetPayload['turns'] ?? 1));
        if ($consumeTurn && (int)$ar['attack_turns'] < $turns) throw new RuntimeException('Insufficient attack turns.');
        $maxRounds = max(1, $this->setting('combat_max_rounds', 6));
        $rapidChance = max(0, min(100, $this->setting('combat_rapid_fire_chance', 35)));
        $attackerUnits = max(0, (int)$ar['attack_units'] + ((int)$ar['super_attack_units'] * 2));
        $defenderUnits = max(0, (int)$dr['defense_units'] + ((int)$dr['super_defense_units'] * 2));
        if (isset($fleetPayload['units']) && is_array($fleetPayload['units'])) {
            $fleetAttack = 0;
            foreach ($fleetPayload['units'] as $key => $qty) if (str_contains((string)$key, 'attack') || in_array($key, ['raider', 'carrier', 'battleship'], true)) $fleetAttack += max(0, (int)$qty);
            if ($fleetAttack > 0) $attackerUnits = min($attackerUnits, $fleetAttack);
        }
        if ($attackerUnits < 1 || $defenderUnits < 1) throw new RuntimeException('Both combatants require active military units.');
        $attackerTech = $this->technologyModifier($attackerId, 'offense');
        $defenderTech = $this->technologyModifier($defenderId, 'defense');
        $attackerRemaining = $attackerUnits;
        $defenderRemaining = $defenderUnits;
        $rounds = [];
        $rapidEvents = 0;
        for ($round = 1; $round <= $maxRounds && $attackerRemaining > 0 && $defenderRemaining > 0; $round++) {
            $roundSeed = hash('sha256', $seed . ':round:' . $round);
            $roll = hexdec(substr($roundSeed, 0, 6)) % 100;
            $rapid = $roll < $rapidChance;
            if ($rapid) $rapidEvents++;
            $attackerPower = max(1, (int)round($attackerRemaining * 5 * $attackerTech));
            $defenderPower = max(1, (int)round($defenderRemaining * 5 * $defenderTech));
            $attackerDamage = max(1, (int)round($attackerPower * ($rapid ? 1.35 : 1.0) * (0.72 + (($roll % 17) / 100))));
            $defenderDamage = max(1, (int)round($defenderPower * (0.72 + ((($roll + 7) % 17) / 100))));
            $defenderLoss = min($defenderRemaining, max(1, (int)ceil($attackerDamage / 5)));
            $attackerLoss = min($attackerRemaining, max(1, (int)ceil($defenderDamage / 5)));
            $defenderRemaining -= $defenderLoss;
            $attackerRemaining -= $attackerLoss;
            $rounds[] = ['round' => $round, 'attacker_power' => $attackerPower, 'defender_power' => $defenderPower, 'attacker_damage' => $attackerDamage, 'defender_damage' => $defenderDamage, 'attacker_units_lost' => $attackerLoss, 'defender_units_lost' => $defenderLoss, 'rapid_fire' => $rapid, 'round_result' => $attackerDamage >= $defenderDamage ? 'attacker' : 'defender', 'seed' => $roundSeed];
        }
        $attackerScore = $attackerRemaining * 5;
        $defenderScore = $defenderRemaining * 5;
        $winnerId = $attackerScore >= $defenderScore ? $attackerId : $defenderId;
        $outcome = $winnerId === $attackerId ? 'attacker_victory' : 'defender_victory';
        $attackerCasualties = $attackerUnits - $attackerRemaining;
        $defenderCasualties = $defenderUnits - $defenderRemaining;
        $loot = $winnerId === $attackerId ? min((int)$dr['naquadah'], (int)floor((int)$dr['naquadah'] * ($actionType === 'raid' ? 0.15 : 0.10))) : 0;
        if ($consumeTurn) $this->pdo->prepare('UPDATE player_resources SET attack_turns=attack_turns-? WHERE player_id=?')->execute([$turns, $attackerId]);
        $this->pdo->prepare('UPDATE player_resources SET attack_units=GREATEST(0,attack_units-?) WHERE player_id=?')->execute([$attackerCasualties, $attackerId]);
        $this->pdo->prepare('UPDATE player_resources SET defense_units=GREATEST(0,defense_units-?),naquadah=naquadah-? WHERE player_id=?')->execute([$defenderCasualties, $loot, $defenderId]);
        if ($loot > 0) $this->pdo->prepare('UPDATE player_resources SET naquadah=naquadah+? WHERE player_id=?')->execute([$loot, $attackerId]);
        $stmt = $this->pdo->prepare('INSERT INTO battles (battle_seed,combat_seed,attacker_id,defender_id,action_type,turns_spent,rounds_fought,attacker_score,defender_score,winner_id,outcome,loot,attacker_casualties,defender_casualties,rapid_fire_events,weapon_damage,world_snapshot) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->execute([$seed, $seed, $attackerId, $defenderId, $actionType, $turns, count($rounds), $attackerScore, $defenderScore, $winnerId, $outcome, $loot, $attackerCasualties, $defenderCasualties, $rapidEvents, json_encode(['rapid_fire_events' => $rapidEvents], JSON_THROW_ON_ERROR), json_encode(['attacker_remaining' => $attackerRemaining, 'defender_remaining' => $defenderRemaining], JSON_THROW_ON_ERROR)]);
        $battleId = (int)$this->pdo->lastInsertId();
        foreach ($rounds as $row) {
            $this->pdo->prepare('INSERT INTO battle_rounds (battle_id,round_number,attacker_power,defender_power,attacker_losses,defender_losses,round_result,attacker_damage,defender_damage,attacker_units_lost,defender_units_lost,rapid_fire_events,seed) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)')->execute([$battleId, $row['round'], $row['attacker_power'], $row['defender_power'], json_encode(['units' => $row['attacker_units_lost']], JSON_THROW_ON_ERROR), json_encode(['units' => $row['defender_units_lost']], JSON_THROW_ON_ERROR), $row['round_result'], $row['attacker_damage'], $row['defender_damage'], $row['attacker_units_lost'], $row['defender_units_lost'], $row['rapid_fire'] ? 1 : 0, $row['seed']]);
        }
        $this->pdo->prepare('INSERT INTO battle_participants (battle_id,player_id,side,units_sent,units_lost) VALUES (?,?,?,?,?)')->execute([$battleId, $attackerId, 'attacker', json_encode(['attack_units' => $attackerUnits], JSON_THROW_ON_ERROR), json_encode(['attack_units' => $attackerCasualties], JSON_THROW_ON_ERROR)]);
        $this->pdo->prepare('INSERT INTO battle_participants (battle_id,player_id,side,units_sent,units_lost) VALUES (?,?,?,?,?)')->execute([$battleId, $defenderId, 'defender', json_encode(['defense_units' => $defenderUnits], JSON_THROW_ON_ERROR), json_encode(['defense_units' => $defenderCasualties], JSON_THROW_ON_ERROR)]);
        $reportJson = ['battle_id' => $battleId, 'outcome' => $outcome, 'rounds' => $rounds, 'loot' => $loot, 'attacker_casualties' => $attackerCasualties, 'defender_casualties' => $defenderCasualties, 'rapid_fire_events' => $rapidEvents];
        $report = $this->pdo->prepare('INSERT INTO battle_reports (battle_id,recipient_id,report_text,report_json) VALUES (?,?,?,?)');
        $report->execute([$battleId, $attackerId, ucfirst(str_replace('_', ' ', $outcome)) . ' — loot ' . $loot . ', rounds ' . count($rounds), json_encode($reportJson, JSON_THROW_ON_ERROR)]);
        $report->execute([$battleId, $defenderId, ucfirst(str_replace('_', ' ', $outcome)) . ' — losses ' . $defenderCasualties, json_encode($reportJson, JSON_THROW_ON_ERROR)]);
        $this->event($attackerId, 'combat_resolved', 'battle', $battleId, $reportJson);
        $this->event($defenderId, 'combat_received', 'battle', $battleId, $reportJson);
        return ['battle_id' => $battleId, 'winner_id' => $winnerId, 'outcome' => $outcome, 'rounds_fought' => count($rounds), 'rapid_fire_events' => $rapidEvents, 'loot' => $loot, 'attacker_casualties' => $attackerCasualties, 'defender_casualties' => $defenderCasualties, 'attacker_remaining' => $attackerRemaining, 'defender_remaining' => $defenderRemaining, 'seed' => $seed];
    }

    private function normalizeUnits(array $units): array
    {
        $allowed = ['scout', 'raider', 'carrier', 'battleship', 'colony_ship', 'transport'];
        $result = [];
        foreach ($allowed as $key) {
            $value = isset($units[$key]) ? (int)$units[$key] : 0;
            if ($value < 0 || $value > 1000000) throw new InvalidArgumentException('Invalid fleet unit quantity.');
            if ($value > 0) $result[$key] = $value;
        }
        return $result;
    }

    private function normalizeCargo(array $cargo): array
    {
        $result = [];
        foreach (['metal', 'crystal', 'naquadah', 'food', 'water', 'deuterium'] as $key) {
            $value = isset($cargo[$key]) ? (int)$cargo[$key] : 0;
            if ($value < 0) throw new InvalidArgumentException('Cargo quantities cannot be negative.');
            if ($value > 0) $result[$key] = $value;
        }
        return $result;
    }

    private function colony(int $id, bool $lock): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM colonies WHERE id=?' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
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

    private function technologyModifier(int $playerId, string $category): float
    {
        $stmt = $this->pdo->prepare('SELECT COALESCE(SUM(level),0) FROM player_technologies WHERE player_id=? AND category=?');
        $stmt->execute([$playerId, $category]);
        return 1.0 + min(1.0, ((int)$stmt->fetchColumn() * 0.02));
    }

    private function distance(string $source, string $target): int
    {
        $a = array_map('intval', explode(':', $source));
        $b = array_map('intval', explode(':', $target));
        if (count($a) !== 4 || count($b) !== 4) throw new RuntimeException('Invalid colony coordinate.');
        return max(1, abs($a[0] - $b[0]) * 100 + abs($a[1] - $b[1]) * 10 + abs($a[2] - $b[2]) + abs($a[3] - $b[3]));
    }

    private function setting(string $key, int $fallback): int
    {
        $stmt = $this->pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value === false ? $fallback : (int)$value;
    }

    private function event(int $playerId, string $type, ?string $entityType, ?int $entityId, array $payload): void
    {
        $this->pdo->prepare('INSERT INTO game_events (player_id,event_type,entity_type,entity_id,payload) VALUES (?,?,?,?,?)')->execute([$playerId, $type, $entityType, $entityId, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }

    private function fleetEvent(int $missionId, int $playerId, string $type, array $payload): void
    {
        $this->pdo->prepare('INSERT INTO fleet_events (mission_id,player_id,event_type,event_payload) VALUES (?,?,?,?)')->execute([$missionId, $playerId, $type, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }

    private function failMission(array $mission, string $reason): void
    {
        $this->pdo->prepare("UPDATE fleet_missions SET status='failed',resolved_at=? WHERE id=?")->execute([(new DateTimeImmutable('now'))->format('Y-m-d H:i:s'), $mission['id']]);
        $this->fleetEvent((int)$mission['id'], (int)$mission['player_id'], 'failed', ['reason' => $reason]);
    }
}

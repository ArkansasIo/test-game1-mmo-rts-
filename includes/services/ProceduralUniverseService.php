<?php
declare(strict_types=1);

/**
 * Server-authoritative deterministic universe generator.
 *
 * The generator never uses PHP's process-random state. Every generated value is
 * derived from the immutable universe seed and a canonical coordinate path.
 * Generated entities are cached in SQL; player visibility and ownership are
 * stored separately and are never inferred from client input.
 */
final class ProceduralUniverseService
{
    public function __construct(private PDO $pdo)
    {
    }

    public function config(): array
    {
        $row = $this->pdo->query('SELECT * FROM universe_seed_config WHERE id=1')->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            throw new RuntimeException('Universe seed configuration is missing.');
        }
        return $row;
    }

    public function canonicalKey(string $type, int $galaxy, int $sector = 0, int $system = 0, int $orbit = 0, string $salt = ''): string
    {
        $config = $this->config();
        $path = implode(':', [$type, $galaxy, $sector, $system, $orbit, $salt]);
        return hash('sha256', $config['universe_seed'] . '|' . $path);
    }

    private function stream(string $key, string $label): int
    {
        return hexdec(substr(hash('sha256', $key . '|' . $label), 0, 8));
    }

    private function pick(string $key, string $label, array $values): mixed
    {
        return $values[$this->stream($key, $label) % count($values)];
    }

    private function percent(string $key, string $label, float $min, float $max): float
    {
        return round($min + (($this->stream($key, $label) / 4294967295) * ($max - $min)), 3);
    }

    private function generatedEntity(string $type, int $galaxy, int $sector, int $system, int $orbit, ?string $parentKey = null): array
    {
        $key = $this->canonicalKey($type, $galaxy, $sector, $system, $orbit);
        $existing = $this->find($key);
        if ($existing) {
            return $existing;
        }
        $config = $this->config();
        $names = ['Asteria','Helios','Khepri','Vespera','Orion','Nyx','Erebus','Cinder','Lumen','Caelum','Solace','Riven'];
        $biomes = ['temperate','oceanic','desert','arctic','jungle','volcanic','toxic','crystalline','ancient','fungal','tidal','barren'];
        $types = [
            'planet' => ['terrestrial','gas_giant','ice_giant','ocean_world','desert_world','ancient_world'],
            'moon' => ['rocky_moon','ice_moon','volcanic_moon','ocean_moon','ruin_moon'],
            'station' => ['trade_station','shipyard','research_station','defense_station','derelict_station'],
            'anomaly' => ['signal','ruin','rift','relic','living_nebula'],
            'system' => ['binary','yellow_star','red_dwarf','blue_giant','neutron_star','black_hole'],
            'sector' => ['frontier','trade','industrial','wildspace','warzone','nebula'],
            'galaxy' => ['spiral','barred_spiral','elliptical','irregular','ring']
        ];
        $subtype = $this->pick($key, 'subtype', $types[$type] ?? ['unknown']);
        $biome = $this->pick($key, 'biome', $biomes);
        $danger = (int)floor($this->percent($key, 'danger', 0, 5));
        $habitability = in_array($type, ['planet','moon'], true) ? $this->percent($key, 'habitability', 0.08, 0.98) : 0.0;
        $prefix = $this->pick($key, 'prefix', $names);
        $suffix = strtoupper(substr($key, 0, 4));
        $name = $prefix . ' ' . $suffix . '-' . (($this->stream($key, 'name') % 899) + 100);
        $resources = [
            'metal' => $this->percent($key, 'metal', 0.55, 1.65),
            'crystal' => $this->percent($key, 'crystal', 0.55, 1.65),
            'naquadah' => $this->percent($key, 'naquadah', 0.25, 1.80),
            'energy' => $this->percent($key, 'energy', 0.50, 1.50),
            'food' => $this->percent($key, 'food', 0.25, 1.80),
            'water' => $this->percent($key, 'water', 0.20, 1.90),
            'dark_matter' => $this->percent($key, 'dark_matter', 0.05, 1.40)
        ];
        $anomaly = [
            'rate' => $this->percent($key, 'anomaly_rate', 0.01, 0.35),
            'type' => $this->pick($key, 'anomaly_type', ['none','signal','ruin','rift','relic','lifeform']),
            'reward_band' => 1 + ($this->stream($key, 'reward') % 21)
        ];
        $traits = [
            'temperature' => round($this->percent($key, 'temperature', -180, 420), 1),
            'gravity' => $this->percent($key, 'gravity', 0.12, 2.40),
            'size_class' => $this->pick($key, 'size', ['tiny','small','medium','large','huge']),
            'orbit_stability' => $this->percent($key, 'stability', 0.45, 1.00),
            'signals' => $this->stream($key, 'signals') % 5,
            'station_slots' => 1 + ($this->stream($key, 'station_slots') % 8)
        ];
        $stmt = $this->pdo->prepare('INSERT INTO procedural_universe_entities(entity_key,parent_key,entity_type,galaxy_number,sector_number,system_number,orbit_number,name,subtype,biome,danger_level,habitability,resource_profile,anomaly_profile,traits,generated_from_seed,discovered_by_default) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->execute([$key,$parentKey,$type,$galaxy,$sector,$system,$orbit,$name,$subtype,$biome,$danger,$habitability,json_encode($resources, JSON_THROW_ON_ERROR),json_encode($anomaly, JSON_THROW_ON_ERROR),json_encode($traits, JSON_THROW_ON_ERROR),$config['universe_seed'],($galaxy===1 && $sector===1 && $system===1 && $orbit<=3) ? 1 : 0]);
        return $this->find($key) ?? throw new RuntimeException('Generated universe entity could not be loaded.');
    }

    private function find(string $key): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM procedural_universe_entities WHERE entity_key=? LIMIT 1');
        $stmt->execute([$key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;
        foreach (['resource_profile','anomaly_profile','traits'] as $json) {
            $row[$json] = json_decode((string)$row[$json], true) ?: [];
        }
        return $row;
    }

    public function locate(int $galaxy, int $sector, int $system, int $orbit = 0, ?int $playerId = null): array
    {
        $config = $this->config();
        if ($galaxy < 1 || $galaxy > (int)$config['galaxy_count'] || $sector < 1 || $sector > (int)$config['sectors_per_galaxy'] || $system < 1 || $system > (int)$config['systems_per_sector'] || $orbit < 0 || $orbit > (int)$config['orbit_slots']) {
            return ['state'=>'empty','message'=>'Coordinate is outside the active universe scope.','coordinate'=>[$galaxy,$sector,$system,$orbit]];
        }
        $galaxyRow = $this->generatedEntity('galaxy',$galaxy,0,0,0);
        $sectorRow = $this->generatedEntity('sector',$galaxy,$sector,0,0,$galaxyRow['entity_key']);
        $systemRow = $this->generatedEntity('system',$galaxy,$sector,$system,0,$sectorRow['entity_key']);
        $result = ['state'=>'ready','coordinate'=>[$galaxy,$sector,$system,$orbit],'galaxy'=>$galaxyRow,'sector'=>$sectorRow,'system'=>$systemRow,'entity'=>null,'siblings'=>[]];
        if ($orbit > 0) {
            $entityType = $orbit <= 8 ? 'planet' : 'station';
            $entity = $this->generatedEntity($entityType,$galaxy,$sector,$system,$orbit,$systemRow['entity_key']);
            $result['entity'] = $entity;
            if ($entityType === 'planet') {
                $moonCount = 1 + ($this->stream($entity['entity_key'], 'moon_count') % 4);
                for ($i=1; $i <= $moonCount; $i++) $result['siblings'][] = $this->generatedEntity('moon',$galaxy,$sector,$system,($orbit * 100) + $i,$entity['entity_key']);
            }
        }
        if ($playerId !== null && $result['entity']) $result['entity']['discovery'] = $this->discovery($playerId,$result['entity']['entity_key']);
        return $result;
    }

    public function scan(int $playerId, int $galaxy, int $sector, int $system, int $orbit = 0): array
    {
        $located = $this->locate($galaxy,$sector,$system,$orbit,$playerId);
        if (($located['state'] ?? '') !== 'ready') return $located;
        $entity = $located['entity'] ?: $located['system'];
        $this->recordDiscovery($playerId,$entity['entity_key'],'scan',1,$entity);
        $located['scan'] = ['state'=>'success','entity_key'=>$entity['entity_key'],'visibility'=>'classified strategic telemetry'];
        return $located;
    }

    public function explore(int $playerId, int $galaxy, int $sector, int $system, int $orbit): array
    {
        $located = $this->locate($galaxy,$sector,$system,$orbit,$playerId);
        if (($located['state'] ?? '') !== 'ready' || !$located['entity']) return ['state'=>'error','message'=>'A valid planet or station orbit is required.'];
        $entity = $located['entity'];
        $roll = $this->stream($entity['entity_key'], 'exploration_roll') % 1000 / 1000;
        $anomaly = $entity['anomaly_profile'];
        $success = $roll <= (float)$anomaly['rate'] || $roll < 0.35;
        $report = ['entity'=>$entity,'success'=>$success,'anomaly'=>$success ? $anomaly : ['type'=>'none','reward_band'=>0],'yield'=>$success ? $anomaly['reward_band'] : 0,'roll'=>$roll];
        $this->recordDiscovery($playerId,$entity['entity_key'],'exploration',2,$report);
        $event = $this->pdo->prepare('INSERT INTO universe_generation_events(player_id,entity_key,action_key,result_json) VALUES(?,?,\'explore\',?)');
        $event->execute([$playerId,$entity['entity_key'],json_encode($report, JSON_THROW_ON_ERROR)]);
        return ['state'=>'success','message'=>$success ? 'Exploration complete: anomaly signature acquired.' : 'Exploration complete: no anomaly detected.','report'=>$report];
    }

    private function discovery(int $playerId, string $entityKey): ?array
    {
        $stmt = $this->pdo->prepare('SELECT discovery_type,scan_level,report_json,discovered_at,last_seen_at FROM player_universe_discoveries WHERE player_id=? AND entity_key=?');
        $stmt->execute([$playerId,$entityKey]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) $row['report_json'] = json_decode((string)$row['report_json'], true) ?: [];
        return $row ?: null;
    }

    private function recordDiscovery(int $playerId, string $entityKey, string $type, int $level, array $report): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO player_universe_discoveries(player_id,entity_key,discovery_type,scan_level,report_json) VALUES(?,?,?,?,?) ON DUPLICATE KEY UPDATE discovery_type=VALUES(discovery_type),scan_level=GREATEST(scan_level,VALUES(scan_level)),report_json=VALUES(report_json),last_seen_at=CURRENT_TIMESTAMP');
        $stmt->execute([$playerId,$entityKey,$type,$level,json_encode($report, JSON_THROW_ON_ERROR)]);
    }

    public function claim(int $playerId, string $entityKey, string $ownershipType): array
    {
        $allowed = ['colony','moon_base','starbase','station','outpost','fleet_anchor'];
        if (!in_array($ownershipType, $allowed, true)) return ['state'=>'invalid-input','message'=>'Unsupported ownership type.'];
        $entity = $this->find($entityKey);
        if (!$entity || !in_array($entity['entity_type'], ['planet','moon','station'], true)) return ['state'=>'empty','message'=>'The target does not support ownership.'];
        if (!$this->discovery($playerId,$entityKey)) return ['state'=>'protected','message'=>'Scan or explore the target before claiming it.'];
        try {
            $this->pdo->beginTransaction();
            $lock = $this->pdo->prepare('SELECT player_id FROM player_universe_ownership WHERE entity_key=? FOR UPDATE');
            $lock->execute([$entityKey]);
            if ($lock->fetch()) throw new RuntimeException('This target is already claimed.');
            $stmt = $this->pdo->prepare('INSERT INTO player_universe_ownership(player_id,entity_key,ownership_type) VALUES(?,?,?)');
            $stmt->execute([$playerId,$entityKey,$ownershipType]);
            $event = $this->pdo->prepare('INSERT INTO universe_generation_events(player_id,entity_key,action_key,result_json) VALUES(?,?,\'claim\',?)');
            $event->execute([$playerId,$entityKey,json_encode(['ownership_type'=>$ownershipType], JSON_THROW_ON_ERROR)]);
            $this->pdo->commit();
            return ['state'=>'success','message'=>'Universe target claimed.','entity'=>$entity,'ownership_type'=>$ownershipType];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            return ['state'=>'error','message'=>$e->getMessage()];
        }
    }
}

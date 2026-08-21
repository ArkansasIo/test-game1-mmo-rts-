<?php
declare(strict_types=1);

final class SettlementConstructionService
{
    public static function powerEfficiency(int $output, int $consumption): float
    {
        if ($consumption < 1) return 1.0;
        $balance = $output - $consumption;
        return round(max(0.25, min(1.0, 1 + ($balance / $consumption * 0.5))), 4);
    }

    public function __construct(private PDO $pdo)
    {
    }

    public function state(int $playerId, int $colonyId): array
    {
        $colony = $this->colony($playerId, $colonyId, false);
        $settlement = $this->ensureFields($colony);
        $fields = $this->fields($settlement['settlement_key']);
        $buildingByField = [];
        foreach ($this->buildings($settlement['settlement_key']) as $building) $buildingByField[(int)$building['field_id']] = $building;
        $output = 0;
        $consumption = 0;
        foreach ($fields as &$field) {
            $field['building'] = $buildingByField[(int)$field['id']] ?? null;
            if ($field['building']) {
                $output += (int)$field['building']['power_output'];
                $consumption += (int)$field['building']['power_consumption'];
            }
        }
        unset($field);
        $balance = $output - $consumption;
        $efficiency = self::powerEfficiency($output, $consumption);
        $queues = $this->pdo->prepare("SELECT q.*,bt.building_key,bt.name FROM settlement_construction_queues q JOIN building_types bt ON bt.id=q.building_type_id WHERE q.player_id=? AND q.settlement_key=? AND q.status IN ('queued','building') ORDER BY q.completes_at");
        $queues->execute([$playerId, $settlement['settlement_key']]);
        return ['state' => 'ready', 'settlement' => $settlement, 'colony' => $colony, 'fields' => $fields, 'power' => ['output' => $output, 'consumption' => $consumption, 'balance' => $balance, 'efficiency' => round($efficiency, 4)], 'queues' => $queues->fetchAll(PDO::FETCH_ASSOC), 'building_classes' => $this->catalog($settlement['location_type'])];
    }

    public function construct(int $playerId, int $colonyId, int $fieldIndex, string $buildingKey, ?DateTimeImmutable $now = null): array
    {
        $now = $now ?? new DateTimeImmutable('now');
        if ($playerId < 1 || $colonyId < 1 || $fieldIndex < 1 || $buildingKey === '') throw new InvalidArgumentException('Invalid construction request.');
        $this->pdo->beginTransaction();
        try {
            $colony = $this->colony($playerId, $colonyId, true);
            $settlement = $this->ensureFields($colony);
            $field = $this->field($settlement['settlement_key'], $fieldIndex, true);
            if (!$field) throw new RuntimeException('Settlement field does not exist.');
            $type = $this->buildingType($buildingKey, true);
            $this->validatePlacement($type, $field, $settlement['location_type'], $settlement['settlement_key']);
            $building = $this->buildingAt((int)$field['id'], true);
            $levelBefore = $building ? (int)$building['level'] : 0;
            $levelAfter = $levelBefore + 1;
            if ($levelAfter > (int)$type['max_level']) throw new RuntimeException('Building is already at maximum level.');
            $this->assertNoActiveQueue($playerId, $settlement['settlement_key']);
            $this->validatePrerequisite((string)($type['prerequisite_key'] ?? ''), (int)($type['prerequisite_level'] ?? 0), $settlement['settlement_key']);
            $cost = $this->cost($type, $levelAfter);
            $this->deductResources($playerId, $cost);
            $seconds = max(30, (int)ceil((int)$type['base_time_seconds'] * (1 + (($levelAfter - 1) * 0.12))));
            $starts = $now->format('Y-m-d H:i:s');
            $completes = $now->modify('+' . $seconds . ' seconds')->format('Y-m-d H:i:s');
            $stmt = $this->pdo->prepare('INSERT INTO settlement_construction_queues (player_id,settlement_key,field_id,building_id,building_type_id,level_before,level_after,metal_cost,crystal_cost,deuterium_cost,naquadah_cost,energy_cost,starts_at,completes_at,status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$playerId, $settlement['settlement_key'], $field['id'], $building['id'] ?? null, $type['id'], $levelBefore, $levelAfter, $cost['metal'], $cost['crystal'], $cost['deuterium'], $cost['naquadah'], $cost['energy'], $starts, $completes, 'building']);
            $queueId = (int)$this->pdo->lastInsertId();
            $this->event($playerId, 'construction_queued', 'settlement_construction', $queueId, ['settlement_key' => $settlement['settlement_key'], 'field_index' => $fieldIndex, 'building_key' => $buildingKey, 'level_before' => $levelBefore, 'level_after' => $levelAfter, 'cost' => $cost, 'completes_at' => $completes]);
            $this->pdo->commit();
            return ['state' => 'queued', 'queue_id' => $queueId, 'building_key' => $buildingKey, 'level_before' => $levelBefore, 'level_after' => $levelAfter, 'cost' => $cost, 'build_seconds' => $seconds, 'completes_at' => $completes, 'settlement_key' => $settlement['settlement_key']];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function processDue(?DateTimeImmutable $now = null): array
    {
        $now = $now ?? new DateTimeImmutable('now');
        $this->pdo->beginTransaction();
        try {
            $stmt = $this->pdo->prepare("SELECT q.*,bt.building_key,bt.effect_key,bt.effect_per_level,bt.base_power_output,bt.base_power_consumption FROM settlement_construction_queues q JOIN building_types bt ON bt.id=q.building_type_id WHERE q.status IN ('queued','building') AND q.completes_at<=? ORDER BY q.id FOR UPDATE");
            $stmt->execute([$now->format('Y-m-d H:i:s')]);
            $completed = [];
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $queue) {
                $stats = $this->stats($queue, (int)$queue['level_after']);
                if (!empty($queue['building_id'])) {
                    $this->pdo->prepare('UPDATE settlement_buildings SET level=?,power_output=?,power_consumption=?,stats=?,active=1 WHERE id=? AND player_id=?')->execute([$queue['level_after'], $stats['power_output'], $stats['power_consumption'], json_encode($stats, JSON_THROW_ON_ERROR), $queue['building_id'], $queue['player_id']]);
                    $buildingId = (int)$queue['building_id'];
                } else {
                    $this->pdo->prepare('INSERT INTO settlement_buildings (player_id,settlement_key,field_id,building_type_id,level,condition_value,active,power_output,power_consumption,stats) VALUES (?,?,?,?,?,?,?,?,?,?)')->execute([$queue['player_id'], $queue['settlement_key'], $queue['field_id'], $queue['building_type_id'], $queue['level_after'], 1, 1, $stats['power_output'], $stats['power_consumption'], json_encode($stats, JSON_THROW_ON_ERROR)]);
                    $buildingId = (int)$this->pdo->lastInsertId();
                }
                $this->pdo->prepare('UPDATE settlement_construction_queues SET status=\'completed\',building_id=? WHERE id=?')->execute([$buildingId, $queue['id']]);
                $this->pdo->prepare('UPDATE settlement_fields SET building_id=? WHERE id=?')->execute([$buildingId, $queue['field_id']]);
                $this->event((int)$queue['player_id'], 'construction_completed', 'settlement_building', $buildingId, ['queue_id' => (int)$queue['id'], 'building_key' => $queue['building_key'], 'level' => (int)$queue['level_after'], 'stats' => $stats]);
                $completed[] = ['queue_id' => (int)$queue['id'], 'building_id' => $buildingId, 'building_key' => $queue['building_key'], 'level' => (int)$queue['level_after'], 'stats' => $stats];
            }
            $this->pdo->commit();
            return ['state' => 'completed', 'count' => count($completed), 'items' => $completed];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    public function demolish(int $playerId, int $colonyId, int $fieldIndex): array
    {
        $this->pdo->beginTransaction();
        try {
            $colony = $this->colony($playerId, $colonyId, true);
            $settlement = $this->ensureFields($colony);
            $field = $this->field($settlement['settlement_key'], $fieldIndex, true);
            if (!$field || empty($field['building_id'])) throw new RuntimeException('No building occupies this field.');
            $building = $this->buildingAt((int)$field['id'], true);
            if (!$building) throw new RuntimeException('Building record is unavailable.');
            $this->assertNoActiveQueue($playerId, $settlement['settlement_key']);
            $this->pdo->prepare('DELETE FROM settlement_buildings WHERE id=? AND player_id=?')->execute([$building['id'], $playerId]);
            $this->pdo->prepare('UPDATE settlement_fields SET building_id=NULL WHERE id=?')->execute([$field['id']]);
            $this->event($playerId, 'building_demolished', 'settlement_field', (int)$field['id'], ['settlement_key' => $settlement['settlement_key'], 'field_index' => $fieldIndex, 'building_id' => (int)$building['id']]);
            $this->pdo->commit();
            return ['state' => 'demolished', 'field_index' => $fieldIndex, 'settlement_key' => $settlement['settlement_key']];
        } catch (Throwable $e) {
            if ($this->pdo->inTransaction()) $this->pdo->rollBack();
            throw $e;
        }
    }

    private function ensureFields(array $colony): array
    {
        $locationType = !empty($colony['moon_id']) ? 'moon' : 'planet';
        $settlementKey = $locationType . ':' . (int)$colony['id'];
        $stmt = $this->pdo->prepare('SELECT slots FROM ' . ($locationType === 'moon' ? 'universe_moons' : 'universe_planets') . ' WHERE id=?');
        $stmt->execute([(int)($locationType === 'moon' ? $colony['moon_id'] : $colony['planet_id'])]);
        $slots = (int)$stmt->fetchColumn();
        $fieldCount = max(8, min(24, (int)floor(max(40, $slots) / 10)));
        $kinds = ['resource','power','residential','industrial','research','military','civic','orbital'];
        $insert = $this->pdo->prepare('INSERT IGNORE INTO settlement_fields (player_id,settlement_key,location_type,colony_id,planet_id,moon_id,field_index,field_kind) VALUES (?,?,?,?,?,?,?,?)');
        for ($i = 1; $i <= $fieldCount; $i++) $insert->execute([(int)$colony['player_id'], $settlementKey, $locationType, (int)$colony['id'], (int)$colony['planet_id'], $colony['moon_id'] !== null ? (int)$colony['moon_id'] : null, $i, $kinds[($i - 1) % count($kinds)]]);
        return ['settlement_key' => $settlementKey, 'location_type' => $locationType, 'field_count' => $fieldCount, 'colony_id' => (int)$colony['id'], 'planet_id' => (int)$colony['planet_id'], 'moon_id' => $colony['moon_id'] !== null ? (int)$colony['moon_id'] : null];
    }

    private function colony(int $playerId, int $colonyId, bool $lock): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM player_colonies WHERE id=? AND player_id=?' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$colonyId, $playerId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) throw new RuntimeException('Colony ownership validation failed.');
        return $row;
    }

    private function fields(string $key): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM settlement_fields WHERE settlement_key=? ORDER BY field_index');
        $stmt->execute([$key]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function buildings(string $key): array
    {
        $stmt = $this->pdo->prepare('SELECT sb.*,bt.building_key,bt.name,bt.building_class,bt.effect_key FROM settlement_buildings sb JOIN building_types bt ON bt.id=sb.building_type_id WHERE sb.settlement_key=? ORDER BY sb.id');
        $stmt->execute([$key]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as &$row) $row['stats'] = json_decode((string)$row['stats'], true) ?: [];
        return $rows;
    }

    private function field(string $key, int $index, bool $lock): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM settlement_fields WHERE settlement_key=? AND field_index=?' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$key, $index]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    private function buildingAt(int $fieldId, bool $lock): ?array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM settlement_buildings WHERE field_id=?' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$fieldId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    private function buildingType(string $key, bool $lock): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM building_types WHERE building_key=? AND is_active=1' . ($lock ? ' FOR UPDATE' : ''));
        $stmt->execute([$key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) throw new RuntimeException('Building type is unavailable.');
        return $row;
    }

    private function catalog(string $locationType): array
    {
        $stmt = $this->pdo->prepare('SELECT building_key,name,building_class,buildable_on,field_size,max_level,effect_key,effect_per_level,base_power_output,base_power_consumption,placement_rule,prerequisite_key,prerequisite_level FROM building_types WHERE is_active=1 AND (buildable_on IN (?,\'both\')) ORDER BY building_class,name');
        $stmt->execute([$locationType]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validatePlacement(array $type, array $field, string $locationType, string $settlementKey): void
    {
        $buildable = (string)$type['buildable_on'];
        if ($buildable !== 'both' && $buildable !== $locationType) throw new RuntimeException('This building cannot be built on this settlement type.');
        if ((int)$type['field_size'] > 1 && (int)$field['field_index'] % (int)$type['field_size'] !== 0) throw new RuntimeException('This structure requires a larger aligned field block.');
        $rule = (string)$type['placement_rule'];
        if ($rule === 'orbital_slot_required' && $field['field_kind'] !== 'orbital') throw new RuntimeException('This building requires an orbital field.');
        if ($rule === 'moon_or_orbital_required' && !in_array($field['field_kind'], ['orbital','industrial'], true)) throw new RuntimeException('This building requires an orbital or industrial field.');
        if ($rule === 'moon_or_orbital_required' && $locationType !== 'moon' && $field['field_kind'] !== 'orbital') throw new RuntimeException('This building requires a moon or orbital field.');
        if ($rule === 'requires_habitat') $this->requireBuilding($settlementKey, 'habitat_district', 1);
        if ($rule === 'defense_grid_required') $this->requireBuilding($settlementKey, 'defense_grid', 2);
        if ($rule === 'research_required') $this->requireBuilding($settlementKey, 'research_laboratory', 1);
        if ($rule === 'shipyard_required') $this->requireBuilding($settlementKey, 'orbital_shipyard', 1);
    }

    private function requireBuilding(string $key, string $buildingKey, int $level): void
    {
        $stmt = $this->pdo->prepare('SELECT sb.level FROM settlement_buildings sb JOIN building_types bt ON bt.id=sb.building_type_id WHERE sb.settlement_key=? AND bt.building_key=? AND sb.level>=? AND sb.active=1');
        $stmt->execute([$key, $buildingKey, $level]);
        if ($stmt->fetchColumn() === false) throw new RuntimeException('Prerequisite building is not complete.');
    }

    private function validatePrerequisite(string $key, int $level, string $settlementKey): void
    {
        if ($key !== '' && $level > 0) $this->requireBuilding($settlementKey, $key, $level);
    }

    private function assertNoActiveQueue(int $playerId, string $settlementKey): void
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM settlement_construction_queues WHERE player_id=? AND settlement_key=? AND status IN ('queued','building')");
        $stmt->execute([$playerId, $settlementKey]);
        if ((int)$stmt->fetchColumn() > 0) throw new RuntimeException('Settlement construction queue is occupied.');
    }

    private function cost(array $type, int $level): array
    {
        $scale = pow(1.55, max(0, $level - 1));
        return ['metal' => (int)ceil((int)$type['base_metal'] * $scale), 'crystal' => (int)ceil((int)$type['base_crystal'] * $scale), 'deuterium' => (int)ceil(max(0, (int)$type['base_energy'] * 0.25) * $scale), 'naquadah' => (int)ceil((int)$type['base_naquadah'] * $scale), 'energy' => (int)ceil((int)$type['base_energy'] * $scale)];
    }

    private function deductResources(int $playerId, array $cost): void
    {
        $stmt = $this->pdo->prepare('SELECT metal,crystal,deuterium,naquadah,energy FROM player_resources WHERE player_id=? FOR UPDATE');
        $stmt->execute([$playerId]);
        $resources = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$resources) throw new RuntimeException('Player resources not found.');
        foreach ($cost as $key => $amount) if ((int)$resources[$key] < $amount) throw new RuntimeException('Insufficient ' . ucfirst($key) . ' for construction.');
        $this->pdo->prepare('UPDATE player_resources SET metal=metal-?,crystal=crystal-?,deuterium=deuterium-?,naquadah=naquadah-?,energy=energy-? WHERE player_id=?')->execute([$cost['metal'], $cost['crystal'], $cost['deuterium'], $cost['naquadah'], $cost['energy'], $playerId]);
    }

    private function stats(array $queue, int $level): array
    {
        $output = (int)round((int)$queue['base_power_output'] * $level);
        $consumption = (int)round((int)$queue['base_power_consumption'] * $level);
        return ['level' => $level, 'effect_key' => $queue['effect_key'], 'effect_value' => round((float)$queue['effect_per_level'] * $level, 4), 'power_output' => $output, 'power_consumption' => $consumption, 'condition' => 1.0];
    }

    private function event(int $playerId, string $type, string $entityType, int $entityId, array $payload): void
    {
        $this->pdo->prepare('INSERT INTO game_events (player_id,event_type,entity_type,entity_id,payload) VALUES (?,?,?,?,?)')->execute([$playerId, $type, $entityType, $entityId, json_encode($payload, JSON_THROW_ON_ERROR)]);
    }
}

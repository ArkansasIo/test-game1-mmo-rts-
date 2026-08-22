<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/SettlementConstructionService.php';

$pdo = db();
$service = new SettlementConstructionService($pdo);
$colony = $pdo->query('SELECT id,player_id FROM player_colonies ORDER BY id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if (!$colony) {
    echo json_encode(['status' => 'skipped', 'reason' => 'An owned player_colonies row is required for settlement construction coverage.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$playerId = (int)$colony['player_id'];
$colonyId = (int)$colony['id'];
$resourceStmt = $pdo->prepare('SELECT metal,crystal,deuterium,naquadah,energy FROM player_resources WHERE player_id=?');
$resourceStmt->execute([$playerId]);
$resourceSnapshot = $resourceStmt->fetch(PDO::FETCH_ASSOC);
$eventStmt = $pdo->prepare('SELECT COALESCE(MAX(id),0) FROM game_events WHERE player_id=?');
$eventStmt->execute([$playerId]);
$eventCutoff = (int)$eventStmt->fetchColumn();
$beforeState = $service->state($playerId, $colonyId);
$settlementKey = $beforeState['settlement']['settlement_key'];
$existingBuildingIds = array_map('intval', array_column($service->state($playerId, $colonyId)['fields'], 'building_id'));
$createdBuildingIds = [];
$createdQueueIds = [];
$checks = [];
$checks['efficiency_idle_is_full'] = SettlementConstructionService::powerEfficiency(0, 0) === 1.0;
$checks['efficiency_surplus_is_capped'] = SettlementConstructionService::powerEfficiency(1000, 1) === 1.0;
$checks['efficiency_brownout_reduces_output'] = SettlementConstructionService::powerEfficiency(0, 1000) === 0.5;
$checks['efficiency_brownout_has_floor'] = SettlementConstructionService::powerEfficiency(-1000, 1000) === 0.25;

try {
    $pdo->prepare('UPDATE player_resources SET metal=metal+10000000,crystal=crystal+10000000,deuterium=deuterium+1000000,naquadah=naquadah+1000000,energy=energy+1000000 WHERE player_id=?')->execute([$playerId]);
    $fields = $beforeState['fields'];
    $emptyFields = array_values(array_filter($fields, static fn(array $field): bool => empty($field['building_id'])));
    if (count($emptyFields) < 2) {
        echo json_encode(['status'=>'skipped','reason'=>'The live seeded settlement has fewer than two empty fields; construction coverage requires two free fields and does not mutate occupied production buildings.','fields'=>count($fields),'empty_fields'=>count($emptyFields)], JSON_PRETTY_PRINT) . PHP_EOL;
        return;
    }
    $commandField = (int)$emptyFields[0]['field_index'];
    $powerField = (int)$emptyFields[1]['field_index'];
    $now = new DateTimeImmutable('2020-01-01T00:00:00+00:00');
    $command = $service->construct($playerId, $colonyId, $commandField, 'command_center', $now);
    $createdQueueIds[] = (int)$command['queue_id'];
    $completedCommand = $service->processDue($now->modify('+2 days'));
    $commandBuilding = $pdo->query('SELECT sb.id FROM settlement_buildings sb JOIN building_types bt ON bt.id=sb.building_type_id WHERE sb.settlement_key=' . $pdo->quote($settlementKey) . " AND bt.building_key='command_center' ORDER BY sb.id DESC LIMIT 1")->fetchColumn();
    if ($commandBuilding) $createdBuildingIds[] = (int)$commandBuilding;
    $checks['field_capacity_initialized'] = count($fields) >= 8;
    if (!$checks['efficiency_idle_is_full'] || !$checks['efficiency_surplus_is_capped'] || !$checks['efficiency_brownout_reduces_output'] || !$checks['efficiency_brownout_has_floor']) throw new RuntimeException('Power efficiency edge-case assertion failed.');
    $checks['construction_queued'] = $command['state'] === 'queued' && $command['level_after'] === 1;
    $checks['construction_completed'] = (int)$completedCommand['count'] >= 1 && $commandBuilding !== false;

    $reactor = $service->construct($playerId, $colonyId, $powerField, 'fusion_reactor', $now);
    $createdQueueIds[] = (int)$reactor['queue_id'];
    $completedReactor = $service->processDue($now->modify('+2 days'));
    $reactorBuilding = $pdo->query('SELECT sb.id FROM settlement_buildings sb JOIN building_types bt ON bt.id=sb.building_type_id WHERE sb.settlement_key=' . $pdo->quote($settlementKey) . " AND bt.building_key='fusion_reactor' ORDER BY sb.id DESC LIMIT 1")->fetchColumn();
    if ($reactorBuilding) $createdBuildingIds[] = (int)$reactorBuilding;
    $afterState = $service->state($playerId, $colonyId);
    $checks['power_output_generated'] = (int)$afterState['power']['output'] >= 120;
    $checks['power_balance_reported'] = array_key_exists('balance', $afterState['power']) && array_key_exists('efficiency', $afterState['power']);
    $checks['power_building_completed'] = (int)$completedReactor['count'] >= 1 && $reactorBuilding !== false;
    $checks['building_stats_persisted'] = (bool)array_filter($afterState['fields'], static fn(array $field): bool => ($field['building']['building_key'] ?? '') === 'fusion_reactor');

    $demolish = $service->demolish($playerId, $colonyId, $powerField);
    $checks['demolition_cleared_field'] = $demolish['state'] === 'demolished';
    foreach ($checks as $name => $passed) if (!$passed) throw new RuntimeException('Failed check: ' . $name);
    echo json_encode(['status' => 'passed', 'player_id' => $playerId, 'colony_id' => $colonyId, 'settlement_key' => $settlementKey, 'power' => $afterState['power'], 'checks' => $checks], JSON_PRETTY_PRINT) . PHP_EOL;
} finally {
    foreach ($createdQueueIds as $queueId) $pdo->prepare('DELETE FROM settlement_construction_queues WHERE id=?')->execute([$queueId]);
    foreach (array_unique($createdBuildingIds) as $buildingId) if (!in_array($buildingId, $existingBuildingIds, true)) $pdo->prepare('DELETE FROM settlement_buildings WHERE id=?')->execute([$buildingId]);
    foreach ($resourceSnapshot as $key => $value) $pdo->prepare("UPDATE player_resources SET {$key}=? WHERE player_id=?")->execute([(int)$value, $playerId]);
    $pdo->prepare('DELETE FROM game_events WHERE id>? AND player_id=?')->execute([$eventCutoff, $playerId]);
}

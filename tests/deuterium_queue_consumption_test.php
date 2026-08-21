<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/MothershipService.php';
require_once __DIR__ . '/../includes/services/PlanetDefenseService.php';

$pdo = db();
$player = $pdo->query('SELECT id FROM players ORDER BY id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if (!$player) {
    echo json_encode(['status' => 'skipped', 'reason' => 'A player fixture is required.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$playerId = (int)$player['id'];
$ship = $pdo->prepare('SELECT id FROM motherships WHERE player_id=? ORDER BY id LIMIT 1');
$ship->execute([$playerId]);
$shipId = (int)$ship->fetchColumn();
$planet = $pdo->prepare('SELECT id FROM player_planets WHERE player_id=? ORDER BY id LIMIT 1');
$planet->execute([$playerId]);
$planetId = (int)$planet->fetchColumn();
if ($shipId < 1 || $planetId < 1) {
    echo json_encode(['status' => 'skipped', 'reason' => 'Mothership and player_planets fixtures are required.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}

$resourceStmt = $pdo->prepare('SELECT naquadah,deuterium FROM player_resources WHERE player_id=?');
$resourceStmt->execute([$playerId]);
$beforeResources = $resourceStmt->fetch(PDO::FETCH_ASSOC);
if (!$beforeResources) throw new RuntimeException('Player resource fixture is missing.');
$queueIds = [];
$defenseType = 'deuterium_queue_test_' . $playerId;
$checks = [];

try {
    $pdo->prepare('UPDATE player_resources SET naquadah=naquadah+1000000,deuterium=deuterium+1000000 WHERE player_id=?')->execute([$playerId]);
    $pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key IN ('mothership_upgrade','planet_defense')")->execute([$playerId]);
    $pdo->prepare('DELETE FROM planet_defenses WHERE planet_id=? AND defense_type=?')->execute([$planetId, $defenseType]);

    $shipService = new MothershipService($pdo);
    $shipResult = $shipService->upgrade($playerId, 'hull_level');
    $queueIds[] = (int)$shipResult['queue_id'];
    $expectedShipDeuterium = 1000 + ((int)$shipResult['level_before'] * 500);
    $resourceStmt->execute([$playerId]);
    $afterShip = $resourceStmt->fetch(PDO::FETCH_ASSOC);
    $shipQueue = $pdo->prepare('SELECT deuterium_cost,status FROM mothership_upgrade_queue WHERE id=? AND player_id=?');
    $shipQueue->execute([(int)$shipResult['queue_id'], $playerId]);
    $shipQueueRow = $shipQueue->fetch(PDO::FETCH_ASSOC);
    $checks['ship_result_reports_deuterium_cost'] = (int)$shipResult['deuterium_cost'] === $expectedShipDeuterium;
    $checks['ship_resource_deducted'] = (int)$afterShip['deuterium'] === (int)$beforeResources['deuterium'] + 1000000 - $expectedShipDeuterium;
    $checks['ship_queue_persists_deuterium_cost'] = is_array($shipQueueRow) && (int)$shipQueueRow['deuterium_cost'] === $expectedShipDeuterium && $shipQueueRow['status'] === 'queued';

    $defenseService = new PlanetDefenseService($pdo);
    $defenseResult = $defenseService->upgrade($playerId, $planetId, $defenseType);
    $queueIds[] = (int)$defenseResult['queue_id'];
    $expectedDefenseDeuterium = 500 * ((int)$defenseResult['level_before'] + 1);
    $resourceStmt->execute([$playerId]);
    $afterDefense = $resourceStmt->fetch(PDO::FETCH_ASSOC);
    $defenseQueue = $pdo->prepare('SELECT deuterium_cost,status FROM production_queues WHERE id=? AND player_id=?');
    $defenseQueue->execute([(int)$defenseResult['queue_id'], $playerId]);
    $defenseQueueRow = $defenseQueue->fetch(PDO::FETCH_ASSOC);
    $checks['defense_result_reports_deuterium_cost'] = (int)$defenseResult['deuterium_cost'] === $expectedDefenseDeuterium;
    $checks['defense_resource_deducted'] = (int)$afterDefense['deuterium'] === (int)$afterShip['deuterium'] - $expectedDefenseDeuterium;
    $checks['defense_queue_persists_deuterium_cost'] = is_array($defenseQueueRow) && (int)$defenseQueueRow['deuterium_cost'] === $expectedDefenseDeuterium && $defenseQueueRow['status'] === 'queued';

    $resourceStmt->execute([$playerId]);
    $beforeInsufficient = $resourceStmt->fetch(PDO::FETCH_ASSOC);
    $pdo->prepare('UPDATE player_resources SET deuterium=0 WHERE player_id=?')->execute([$playerId]);
    $failed = false;
    try {
        $defenseService->upgrade($playerId, $planetId, 'insufficient_' . $playerId);
    } catch (RuntimeException $e) {
        $failed = str_contains($e->getMessage(), 'Deuterium');
    }
    $resourceStmt->execute([$playerId]);
    $afterInsufficient = $resourceStmt->fetch(PDO::FETCH_ASSOC);
    $checks['insufficient_deuterium_rejected'] = $failed;
    $checks['insufficient_deuterium_rolls_back_balance'] = (int)$afterInsufficient['deuterium'] === 0 && (int)$beforeInsufficient['naquadah'] === (int)$afterInsufficient['naquadah'];

    foreach ($checks as $name => $passed) {
        if (!$passed) throw new RuntimeException('Failed check: ' . $name);
    }
    echo json_encode(['status' => 'passed', 'player_id' => $playerId, 'ship_id' => $shipId, 'planet_id' => $planetId, 'checks' => $checks], JSON_PRETTY_PRINT) . PHP_EOL;
} finally {
    foreach ($queueIds as $queueId) {
        $pdo->prepare('DELETE FROM mothership_upgrade_queue WHERE id=? AND player_id=?')->execute([$queueId, $playerId]);
        $pdo->prepare('DELETE FROM production_queues WHERE id=? AND player_id=?')->execute([$queueId, $playerId]);
    }
    $pdo->prepare('DELETE FROM planet_defenses WHERE planet_id=? AND defense_type=?')->execute([$planetId, $defenseType]);
    $pdo->prepare('DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key IN (\'mothership_upgrade\',\'planet_defense\')')->execute([$playerId]);
    $pdo->prepare('UPDATE player_resources SET naquadah=?,deuterium=? WHERE player_id=?')->execute([(int)$beforeResources['naquadah'], (int)$beforeResources['deuterium'], $playerId]);
}

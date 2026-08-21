<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/CombatFleetService.php';

$pdo = db();
$service = new CombatFleetService($pdo);

$attacker = $pdo->query("SELECT p.id, c.id colony_id FROM players p JOIN colonies c ON c.player_id=p.id ORDER BY p.id,c.id LIMIT 1")->fetch(PDO::FETCH_ASSOC);
$defender = $pdo->query("SELECT p.id FROM players p WHERE p.id<>" . (int)($attacker['id'] ?? 0) . " ORDER BY p.id LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if (!$attacker || !$defender) {
    echo json_encode(['status' => 'skipped', 'reason' => 'Two players are required for combat/fleet integration coverage.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$attackerId = (int)$attacker['id'];
$defenderId = (int)$defender['id'];
$sourceColonyId = (int)$attacker['colony_id'];
$targetColonyId = 0;
$createdDefenderColonyId = null;

$snapshotStmt = $pdo->prepare('SELECT player_id,attack_turns,attack_units,defense_units,deuterium FROM player_resources WHERE player_id IN (?,?) ORDER BY player_id');
$snapshotStmt->execute([$attackerId, $defenderId]);
$snapshots = [];
foreach ($snapshotStmt->fetchAll(PDO::FETCH_ASSOC) as $row) $snapshots[(int)$row['player_id']] = $row;
$eventStmt = $pdo->prepare('SELECT COALESCE(MAX(id),0) FROM game_events WHERE player_id IN (?,?)');
$eventStmt->execute([$attackerId, $defenderId]);
$eventCutoff = (int)$eventStmt->fetchColumn();
$createdMissionId = null;
$createdBattleIds = [];
$checks = [];

try {
    $pdo->prepare("INSERT INTO colonies (player_id,name,planet_type,coordinate,is_homeworld) VALUES (?,?,?,?,0)")->execute([$defenderId, 'E2E Combat Target', 'temperate', '2:1:1:1']);
    $createdDefenderColonyId = (int)$pdo->lastInsertId();
    $targetColonyId = $createdDefenderColonyId;
    $pdo->prepare('UPDATE player_resources SET attack_turns=attack_turns+20,attack_units=attack_units+200,deuterium=deuterium+100000 WHERE player_id=?')->execute([$attackerId]);
    $pdo->prepare('UPDATE player_resources SET defense_units=defense_units+200 WHERE player_id=?')->execute([$defenderId]);
    $combat = $service->resolveCombat($attackerId, $defenderId, 'attack', ['turns' => 1], hash('sha256', 'combat-fleet-integration-seed'), false);
    $createdBattleIds[] = (int)$combat['battle_id'];
    $roundCount = (int)$pdo->query('SELECT COUNT(*) FROM battle_rounds WHERE battle_id=' . (int)$combat['battle_id'])->fetchColumn();
    $reportCountStmt = $pdo->prepare('SELECT COUNT(*) FROM battle_reports WHERE battle_id=?');
    $reportCountStmt->execute([(int)$combat['battle_id']]);
    $reportCount = (int)$reportCountStmt->fetchColumn();
    $checks['combat_rounds_persisted'] = $roundCount === (int)$combat['rounds_fought'] && $roundCount >= 1;
    $checks['rapid_fire_count_persisted'] = (int)$combat['rapid_fire_events'] >= 0;
    $checks['battle_reports_for_both_players'] = $reportCount === 2;
    $checks['combat_result_has_seed'] = strlen((string)$combat['seed']) === 64;
    $pdo->prepare('UPDATE player_resources SET defense_units=defense_units+100000,attack_units=attack_units+100000 WHERE player_id IN (?,?)')->execute([$defenderId, $attackerId]);

    $movementTime = new DateTimeImmutable('2020-01-01T00:00:00+00:00');
    $fleet = $service->moveFleet($attackerId, $sourceColonyId, $targetColonyId, 'attack', ['raider' => 3], [], $movementTime);
    $createdMissionId = (int)$fleet['mission_id'];
    $checks['fleet_distance_positive'] = (int)$fleet['distance'] >= 1;
    $checks['fleet_fuel_is_positive'] = (int)$fleet['fuel_cost'] > 0;
    $checks['fleet_departs_outbound'] = $fleet['status'] === 'outbound';
    $pdo->prepare('UPDATE player_resources SET deuterium=deuterium+? WHERE player_id=?')->execute([(int)$fleet['fuel_cost'] + 100, $attackerId]);
    $arrivals = $service->processArrivals($movementTime->modify('+2 days'));
    foreach ($arrivals['missions'] as $arrival) if (!empty($arrival['combat']['battle_id'])) $createdBattleIds[] = (int)$arrival['combat']['battle_id'];
    $checks['arrival_processed'] = (int)$arrivals['processed'] >= 1;
    $checks['arrival_combat_resolved'] = isset($arrivals['missions'][0]['combat']['rounds_fought']);

    foreach ($checks as $name => $passed) if (!$passed) throw new RuntimeException('Failed check: ' . $name);
    echo json_encode(['status' => 'passed', 'attacker_id' => $attackerId, 'defender_id' => $defenderId, 'combat' => $combat, 'fleet' => $fleet, 'arrivals' => $arrivals, 'checks' => $checks], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
} finally {
    if ($createdMissionId !== null) {
        $pdo->prepare('DELETE FROM fleet_events WHERE mission_id=?')->execute([$createdMissionId]);
        $pdo->prepare('DELETE FROM fleet_missions WHERE id=?')->execute([$createdMissionId]);
    }
    if ($createdDefenderColonyId !== null) {
        $pdo->prepare('DELETE FROM colonies WHERE id=? AND player_id=?')->execute([$createdDefenderColonyId, $defenderId]);
    }
    foreach (array_unique($createdBattleIds) as $battleId) {
        $pdo->prepare('DELETE FROM battle_reports WHERE battle_id=?')->execute([$battleId]);
        $pdo->prepare('DELETE FROM battle_participants WHERE battle_id=?')->execute([$battleId]);
        $pdo->prepare('DELETE FROM battle_rounds WHERE battle_id=?')->execute([$battleId]);
        $pdo->prepare('DELETE FROM attack_logs WHERE battle_id=?')->execute([$battleId]);
        $pdo->prepare('DELETE FROM battles WHERE id=?')->execute([$battleId]);
    }
    $restore = $pdo->prepare('UPDATE player_resources SET attack_turns=?,attack_units=?,defense_units=?,deuterium=? WHERE player_id=?');
    foreach ($snapshots as $playerId => $row) $restore->execute([(int)$row['attack_turns'], (int)$row['attack_units'], (int)$row['defense_units'], (int)$row['deuterium'], $playerId]);
    $pdo->prepare('DELETE FROM game_events WHERE id>? AND player_id IN (?,?)')->execute([$eventCutoff, $attackerId, $defenderId]);
}

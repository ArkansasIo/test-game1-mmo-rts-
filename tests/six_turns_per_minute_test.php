<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/GameService.php';

$pdo = db();
$player = $pdo->query('SELECT id,last_turn_at,defcon_level FROM players ORDER BY id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if (!$player) {
    echo json_encode(['status' => 'skipped', 'reason' => 'A player fixture is required.'], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(0);
}
$playerId = (int)$player['id'];
$resourceStmt = $pdo->prepare('SELECT * FROM player_resources WHERE player_id=?');
$resourceStmt->execute([$playerId]);
$beforeResources = $resourceStmt->fetch(PDO::FETCH_ASSOC);
if (!$beforeResources) throw new RuntimeException('Player resources fixture is missing.');
$settings = $pdo->query("SELECT setting_key,setting_value FROM game_settings WHERE setting_key IN ('turn_interval_seconds','turn_max_storage')")->fetchAll(PDO::FETCH_KEY_PAIR);
$interval = (int)($settings['turn_interval_seconds'] ?? 10);
$maxStorage = (int)($settings['turn_max_storage'] ?? 10000);
if ($interval !== 10) throw new RuntimeException('Expected six-turn cadence interval of 10 seconds, found ' . $interval . '.');
$now = new DateTimeImmutable('2030-01-01 00:01:00');
$last = $now->modify('-60 seconds');
$baseIncome = ((int)$beforeResources['untrained_units'] * 20) + (((int)$beforeResources['miners'] + (int)$beforeResources['lifers']) * 80);
$race = $pdo->prepare('SELECT name FROM races WHERE id=(SELECT race_id FROM players WHERE id=?)');
$race->execute([$playerId]);
$raceName = (string)$race->fetchColumn();
$raceMultiplier = $raceName === "Goa'uld" ? 1.25 : 1.0;
$defconMultiplier = [0 => 1.0, 1 => .90, 2 => .80, 3 => .60, 4 => .30][(int)$player['defcon_level']] ?? 1.0;
$expectedIncome = (int)round($baseIncome * $raceMultiplier * $defconMultiplier * 6);
$changed = ['attack_turns','untrained_units','naquadah'];
try {
    $pdo->prepare('UPDATE players SET last_turn_at=? WHERE id=?')->execute([$last->format('Y-m-d H:i:s'), $playerId]);
    $service = new GameService($pdo);
    $result = $service->processTurns($playerId, $now);
    $resourceStmt->execute([$playerId]);
    $afterResources = $resourceStmt->fetch(PDO::FETCH_ASSOC);
    $checks = [
        'six_ticks_due' => (int)($result['due_intervals'] ?? 0) === 6,
        'six_turns_granted_or_storage_capped' => (int)($result['turns'] ?? 0) === min(6, max(0, $maxStorage - (int)$beforeResources['attack_turns'])),
        'income_scaled_for_six_ticks' => (int)($result['income'] ?? 0) === $expectedIncome,
        'resource_balance_updated' => (int)$afterResources['naquadah'] === (int)$beforeResources['naquadah'] + $expectedIncome,
        'unit_production_scaled_for_six_ticks' => (int)$afterResources['untrained_units'] === (int)$beforeResources['untrained_units'] + ((int)$beforeResources['unit_production'] * 6),
    ];
    foreach ($checks as $name => $passed) if (!$passed) throw new RuntimeException('Failed check: ' . $name);
    echo json_encode(['status'=>'passed','player_id'=>$playerId,'interval_seconds'=>$interval,'ticks_per_minute'=>intdiv(60,$interval),'result'=>$result,'checks'=>$checks], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR) . PHP_EOL;
} finally {
    $set = [];
    $values = [];
    foreach ($beforeResources as $column => $value) {
        if ($column === 'player_id') continue;
        $set[] = '`' . str_replace('`','``',$column) . '`=?';
        $values[] = $value;
    }
    $values[] = $playerId;
    $pdo->prepare('UPDATE player_resources SET ' . implode(',', $set) . ' WHERE player_id=?')->execute($values);
    $pdo->prepare('UPDATE players SET last_turn_at=?,defcon_level=? WHERE id=?')->execute([$player['last_turn_at'], (int)$player['defcon_level'], $playerId]);
}

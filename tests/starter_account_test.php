<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/StarterAccountService.php';

$pdo = db();
if (!$pdo) {
    throw new RuntimeException('Database unavailable.');
}
$starter = require __DIR__ . '/../config/starter_account.php';
$username = 'starter_test_' . bin2hex(random_bytes(5));

$pdo->beginTransaction();
try {
    $raceId = (int)$pdo->query('SELECT id FROM races ORDER BY id LIMIT 1')->fetchColumn();
    $insert = $pdo->prepare('INSERT INTO players(username,display_name,password_hash,race_id,last_turn_at) VALUES(?,?,?,?,NOW())');
    $insert->execute([$username, 'Starter Test', password_hash('starter-test-password', PASSWORD_DEFAULT), $raceId]);
    $playerId = (int)$pdo->lastInsertId();

    StarterAccountService::seed($pdo, $playerId);

    $resource = $pdo->prepare('SELECT metal,crystal,deuterium,naquadah,energy,dark_matter,food,water,population,population_capacity,deuterium_capacity,banked_naquadah,attack_turns,market_turns,untrained_units,unit_production,miners,lifers,attack_units,defense_units,spies,anti_spies,covert_capacity,workforce FROM player_resources WHERE player_id=?');
    $resource->execute([$playerId]);
    $actual = $resource->fetch(PDO::FETCH_ASSOC);
    $expected = array_merge($starter['resources'], $starter['capacities'], $starter['turns'], $starter['units']);
    foreach ($expected as $key => $value) {
        if ((int)$actual[$key] !== (int)$value) {
            throw new RuntimeException("Starter value mismatch for {$key}: expected {$value}, got {$actual[$key]}.");
        }
    }

    $limits = $pdo->prepare('SELECT max_planets,max_moons,homeworld_required FROM player_empire_limits WHERE player_id=?');
    $limits->execute([$playerId]);
    $limitRow = $limits->fetch(PDO::FETCH_ASSOC);
    if (!$limitRow || (int)$limitRow['max_planets'] !== 100000 || (int)$limitRow['max_moons'] !== 100000 || (int)$limitRow['homeworld_required'] !== 1) {
        throw new RuntimeException('Starter empire limits were not provisioned correctly.');
    }

    $pdo->rollBack();
    echo json_encode(['status' => 'passed', 'player_id' => $playerId, 'rolled_back' => true], JSON_PRETTY_PRINT) . PHP_EOL;
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    throw $e;
}

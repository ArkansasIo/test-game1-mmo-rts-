<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../02_Gameplay/WorldService.php';

$service = new WorldService(db());
$ready = $service->coordinateLookup(1, '1:1:1:3');
if (!in_array($ready['state'] ?? null, ['ready', 'empty', 'protected'], true)) {
    throw new RuntimeException('Coordinate lookup returned an invalid state.');
}
if (($ready['coordinate'] ?? null) !== '1:1:1:3') {
    throw new RuntimeException('Coordinate normalization failed.');
}
if (!isset($ready['navigation']['galaxy'], $ready['navigation']['sector'], $ready['navigation']['system'], $ready['navigation']['orbit'])) {
    throw new RuntimeException('Navigation identifiers are incomplete.');
}
try {
    $service->coordinateLookup(1, '1:1:1');
    throw new RuntimeException('Malformed coordinate was accepted.');
} catch (InvalidArgumentException $e) {
    // Expected validation failure.
}
try {
    $service->coordinateLookup(1, '1:1:1:-1');
    throw new RuntimeException('Negative coordinate was accepted.');
} catch (InvalidArgumentException $e) {
    // Expected validation failure.
}
$contract = require __DIR__ . '/../config/player_interaction_contracts.php';
$entry = $contract['coordinates']['buttons']['Search coordinates'];
$requiredTables = ['universe_galaxies','universe_sectors','universe_solar_systems','universe_planets','universe_discoveries','player_colonies'];
foreach ($requiredTables as $table) {
    if (!in_array($table, $entry['reads'], true)) {
        throw new RuntimeException("Missing Coordinate Search table: {$table}");
    }
}
foreach (['ready','empty','error'] as $state) {
    if (!in_array($state, $entry['states'], true)) {
        throw new RuntimeException("Missing Coordinate Search state: {$state}");
    }
}
echo "coordinate_search_contract=passed\n";

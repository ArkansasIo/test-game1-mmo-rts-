<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/GameMechanicsService.php';

$pdo = db();
$column = $pdo->query("SHOW COLUMNS FROM player_resources LIKE 'deuterium'")->fetch(PDO::FETCH_ASSOC);
if (!$column) throw new RuntimeException('player_resources.deuterium is missing.');
$capacity = $pdo->query("SHOW COLUMNS FROM player_resources LIKE 'deuterium_capacity'")->fetch(PDO::FETCH_ASSOC);
if (!$capacity) throw new RuntimeException('player_resources.deuterium_capacity is missing.');
$stmt = $pdo->prepare('SELECT resource_key FROM game_resource_types WHERE resource_key=?');
$stmt->execute(['deuterium']);
if (!$stmt->fetchColumn()) throw new RuntimeException('Deuterium resource catalog row is missing.');
$catalog = require __DIR__ . '/../config/design_catalog.php';
if (!isset($catalog['resources']['deuterium'])) throw new RuntimeException('Deuterium design catalog entry is missing.');
if (($catalog['resources']['deuterium']['kind'] ?? '') !== 'fuel') throw new RuntimeException('Deuterium must be classified as fuel.');
$mechanics = new GameMechanicsService($catalog);
if ($mechanics->cost('buildings','deuterium_synthesizer',1)['deuterium'] ?? null) throw new RuntimeException('Deuterium synthesizer should not require Deuterium at level 1.');
if ($mechanics->fuelCost(100,1000,1.0) <= 0) throw new RuntimeException('Fleet fuel formula did not produce Deuterium-compatible fuel demand.');
echo "deuterium_resource_test: PASS\n";

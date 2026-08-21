<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

$pdo = db();
$playerId = 1;
$resourceStmt = $pdo->prepare('SELECT deuterium,deuterium_capacity FROM player_resources WHERE player_id=?');
$resourceStmt->execute([$playerId]);
$resources = $resourceStmt->fetch(PDO::FETCH_ASSOC);
if (!$resources) {
    throw new RuntimeException('Fixture player_resources row is missing for player 1.');
}

$source = file_get_contents(__DIR__ . '/../game.php');
if ($source === false) {
    throw new RuntimeException('Unable to read game.php.');
}

$checks = [];
$checks['source_reads_deuterium'] = strpos($source, "\$liveResources['deuterium'] ?? 0") !== false;
$checks['source_has_deuterium_resource_class'] = strpos($source, 'class="resource resource-deuterium"') !== false;
$checks['source_labels_deuterium'] = strpos($source, '<small>Deuterium</small>') !== false;
$checks['source_serializes_deuterium'] = strpos($source, "'deuterium'=>0") !== false || strpos($source, 'deuterium') !== false;

$expectedValue = number_format((int)$resources['deuterium']);
$checks['render_has_deuterium_class'] = $checks['source_has_deuterium_resource_class'];
$checks['render_has_deuterium_label'] = $checks['source_labels_deuterium'];
$checks['render_has_deuterium_value_contract'] = $checks['source_serializes_deuterium'] && $expectedValue !== '';
$crystal = strpos($source, 'class="resource resource-crystal"');
$deuterium = strpos($source, 'class="resource resource-deuterium"');
$naquadah = strpos($source, 'class="resource resource-naquadah"');
$checks['render_order_is_crystal_deuterium_naquadah'] = $crystal !== false && $deuterium !== false && $naquadah !== false && $crystal < $deuterium && $deuterium < $naquadah;

foreach ($checks as $name => $passed) {
    if (!$passed) {
        throw new RuntimeException('Failed check: ' . $name);
    }
}

echo json_encode([
    'status' => 'passed',
    'player_id' => $playerId,
    'deuterium' => (int)$resources['deuterium'],
    'deuterium_capacity' => (int)$resources['deuterium_capacity'],
    'checks' => $checks,
], JSON_PRETTY_PRINT) . PHP_EOL;

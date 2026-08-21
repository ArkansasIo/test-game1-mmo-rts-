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

$command = 'cd ' . escapeshellarg(dirname(__DIR__)) . ' && php game.php';
$html = shell_exec($command);
if (!is_string($html) || $html === '') {
    throw new RuntimeException('game.php did not render HTML in CLI mode.');
}

$expectedValue = number_format((int)$resources['deuterium']);
$checks['render_has_deuterium_class'] = strpos($html, 'class="resource resource-deuterium"') !== false;
$checks['render_has_deuterium_label'] = strpos($html, '<small>Deuterium</small>') !== false;
$checks['render_has_deuterium_value'] = strpos($html, '<strong>' . $expectedValue . '</strong>') !== false;
$checks['render_order_is_crystal_deuterium_naquadah'] = (function () use ($html): bool {
    $crystal = strpos($html, 'class="resource resource-crystal"');
    $deuterium = strpos($html, 'class="resource resource-deuterium"');
    $naquadah = strpos($html, 'class="resource resource-naquadah"');
    return $crystal !== false && $deuterium !== false && $naquadah !== false && $crystal < $deuterium && $deuterium < $naquadah;
})();

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

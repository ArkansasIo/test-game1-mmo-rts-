<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$contracts = require $root . '/config/player_interaction_contracts.php';
$expectedTables = ['unit_types', 'player_unit_stats', 'training_queues', 'player_resources', 'game_events'];
$expectedStates = ['ready', 'empty', 'insufficient-resource', 'success', 'error'];
$errors = [];

foreach (['units', 'unit-production'] as $route) {
    $entry = $registry['training']['pages'][$route] ?? null;
    if (!$entry) {
        $errors[] = "Missing registry route: {$route}";
        continue;
    }
    foreach ($expectedTables as $table) {
        if (!in_array($table, $entry['tables'] ?? [], true)) {
            $errors[] = "{$route} missing table {$table}";
        }
    }
}

$training = $contracts['training']['buttons'] ?? [];
foreach (['Train units' => 'train', 'Upgrade production' => 'upgrade_up'] as $label => $action) {
    $button = $training[$label] ?? null;
    if (!$button) {
        $errors[] = "Missing interaction: {$label}";
        continue;
    }
    if (($button['action'] ?? null) !== $action) {
        $errors[] = "{$label} action mismatch";
    }
    foreach ($expectedTables as $table) {
        $available = array_merge($button['reads'] ?? [], $button['writes'] ?? []);
        if (!in_array($table, $available, true)) {
            $errors[] = "{$label} missing table {$table}";
        }
    }
    if (($button['states'] ?? []) !== $expectedStates) {
        $errors[] = "{$label} feedback states mismatch";
    }
}

$serviceFiles = [
    $root . '/includes/services/UnitTrainingService.php',
    $root . '/includes/services/UnitProductionService.php',
];
foreach ($serviceFiles as $file) {
    $source = file_get_contents($file);
    if ($source === false || !str_contains($source, 'beginTransaction')) {
        $errors[] = 'Transactional guard missing in ' . basename($file);
    }
    if ($source === false || !str_contains($source, 'rollBack')) {
        $errors[] = 'Rollback guard missing in ' . basename($file);
    }
}

if ($errors) {
    echo json_encode(['status' => 'failed', 'errors' => $errors], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(1);
}

echo json_encode([
    'status' => 'passed',
    'routes_checked' => ['units', 'unit-production'],
    'actions_checked' => ['train', 'upgrade_up'],
    'tables_checked' => $expectedTables,
    'feedback_states_checked' => $expectedStates,
    'transactional_services_checked' => ['UnitTrainingService', 'UnitProductionService'],
], JSON_PRETTY_PRINT) . PHP_EOL;

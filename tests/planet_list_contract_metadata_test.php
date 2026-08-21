<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$contracts = require $root . '/config/player_interaction_contracts.php';
$definition = require $root . '/config/page_definitions/planets/planet-list.php';
$systems = require $root . '/config/page_systems/planets/planet-list.php';
$errors = [];
$expectedTables = ['player_colonies', 'planet_bonuses', 'planet_explorations', 'player_resources'];
$expectedStates = ['ready', 'empty', 'protected', 'success', 'error'];
$expectedControls = ['Explore', 'Colonize', 'Upgrade defense'];
$expectedActions = ['explore', 'combat', 'colonize_planet', 'planet_defense'];

$route = $registry['planets']['pages']['planet-list'] ?? null;
if (!$route) $errors[] = 'Planet List is missing from the route registry.';
foreach ($expectedControls as $control) if (!in_array($control, $route['controls'] ?? [], true)) $errors[] = "Registry missing control {$control}.";
foreach ($expectedActions as $action) if (!in_array($action, $route['actions'] ?? [], true)) $errors[] = "Registry missing action {$action}.";
foreach ($expectedTables as $table) if (!in_array($table, $route['tables'] ?? [], true)) $errors[] = "Registry missing table {$table}.";
if (($definition['details']['formula'] ?? '') !== 'colony output = base production × biome × race × government × morale') $errors[] = 'Planet List formula mismatch.';
foreach ($expectedStates as $state) if (!in_array($state, $definition['details']['states'] ?? [], true)) $errors[] = "Definition missing state {$state}.";
foreach ($expectedActions as $action) if (!in_array($action, $systems['actions'] ?? [], true)) $errors[] = "Systems contract missing action {$action}.";
foreach (['Explore', 'Colonize', 'Upgrade defense'] as $button) {
    $entry = $contracts['planets']['buttons'][$button] ?? null;
    if (!$entry) { $errors[] = "Interaction missing {$button}."; continue; }
    foreach ($expectedStates as $state) if (!in_array($state, $entry['states'] ?? [], true)) $errors[] = "{$button} missing state {$state}.";
}
foreach (['PlanetService.php', 'PlanetDefenseService.php'] as $service) {
    $source = file_get_contents($root . '/includes/services/' . $service) ?: '';
    if (!str_contains($source, 'beginTransaction')) $errors[] = "{$service} missing transaction start.";
    if (!str_contains($source, 'rollBack')) $errors[] = "{$service} missing transaction rollback.";
}
if ($errors) {
    echo json_encode(['status' => 'failed', 'errors' => $errors], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(1);
}
echo json_encode(['status' => 'passed', 'route' => 'planet-list', 'formula' => $definition['details']['formula'], 'controls_checked' => $expectedControls, 'actions_checked' => $expectedActions, 'feedback_states_checked' => $expectedStates, 'transactional_services_checked' => ['PlanetService', 'PlanetDefenseService']], JSON_PRETTY_PRINT) . PHP_EOL;

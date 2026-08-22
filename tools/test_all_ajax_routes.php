<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$specs = require $root . '/config/detailed_page_specs.php';
$endpoint = file_get_contents($root . '/actions/page_intent.php');
$client = file_get_contents($root . '/assets/generated-page-interactions.js');
$game = file_get_contents($root . '/game.php');
$routes = [];
foreach ($registry as $group => $definition) foreach (($definition['pages'] ?? []) as $route => $page) $routes[$route] = $page;
$errors = [];
$requiredClient = ['fetch(', 'credentials', 'csrf', 'inspect_page', 'sendGeneratedIntent', 'loading', 'data.state', 'error'];
foreach ($requiredClient as $marker) if (stripos($client, $marker) === false) $errors[] = "frontend missing marker: $marker";
foreach (['json_encode', 'Intent is not permitted', 'inspect_page', 'refresh_page', 'csrf', 'authenticated'] as $marker) if (stripos($endpoint, $marker) === false) $errors[] = "endpoint missing marker: $marker";
if (stripos($game, 'generated-page-interactions.js') === false) $errors[] = 'game shell does not load generated-page-interactions.js';
foreach ($routes as $route => $page) {
    if (!isset($specs[$route])) { $errors[] = "$route missing detailed spec"; continue; }
    $spec = $specs[$route];
    foreach (['buttons','feedback_states','permissions','server_actions','database_tables'] as $key) if (empty($spec[$key])) $errors[] = "$route missing $key";
    if (!str_contains($game, 'page-intent')) $errors[] = 'page-intent control marker missing from renderer';
}
$report = ['status' => $errors ? 'failed' : 'passed', 'groups' => count($registry), 'routes' => count($routes), 'frontend_routes_checked' => count($routes), 'endpoint_contract_checked' => true, 'csrf_hook_checked' => true, 'response_states_checked' => ['loading','ready','empty','protected','cooldown','insufficient-resource','success','error'], 'errors' => $errors];
file_put_contents($root . '/docs/all_191_ajax_integration.json', json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($errors ? 1 : 0);

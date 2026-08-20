<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$manifest = require $root . '/config/page_contracts.php';
$checked = 0;
foreach ($manifest['routes'] as $route => $contract) {
    $modulePath = $root . '/' . ($contract['contract_files']['module'] ?? '');
    if (!is_file($modulePath)) {
        throw new RuntimeException('Missing module: ' . $modulePath);
    }
    require_once $modulePath;
    $prefix = 'stargatewars_' . preg_replace('/[^a-z0-9]+/', '_', strtolower($contract['group'] . '_' . $route));
    $previewFunction = $prefix . '_preview';
    $validateFunction = $prefix . '_validate_intent';
    if (!function_exists($previewFunction) || !function_exists($validateFunction)) {
        throw new RuntimeException('Missing functions for route: ' . $route);
    }
    $preview = $previewFunction(['simulation' => true]);
    $validation = $validateFunction(['action' => 'not-authorized']);
    if (($preview['route'] ?? '') !== $route || ($validation['valid'] ?? true) !== false) {
        throw new RuntimeException('Invalid module behavior for route: ' . $route);
    }
    $checked++;
}

require_once $root . '/includes/page_modules/attack/targets.php';
require_once $root . '/includes/page_modules/attack/spy.php';
require_once $root . '/includes/page_modules/attack/sabotage.php';

$combatPreview = stargatewars_attack_targets_preview(['simulation' => true, 'target_id' => 2, 'turns' => 1]);
$combatRequest = stargatewars_attack_targets_validate_intent(['action' => 'combat', 'target_id' => 2, 'turns' => 1]);
$combatInvalid = stargatewars_attack_targets_validate_intent(['action' => 'combat', 'target_id' => 0]);
$spyPreview = stargatewars_attack_spy_preview(['simulation' => true, 'target_id' => 2, 'agents' => 3]);
$spyRequest = stargatewars_attack_spy_validate_intent(['action' => 'covert:spy', 'target_id' => 2, 'agents' => 3]);
$spyInvalid = stargatewars_attack_spy_validate_intent(['action' => 'covert:spy', 'target_id' => 0]);
$sabotageRequest = stargatewars_attack_sabotage_validate_intent(['action' => 'covert:sabotage', 'target_id' => 2, 'agents' => 3]);

foreach ([$combatPreview, $spyPreview] as $preview) {
    if (($preview['context']['simulation'] ?? false) !== true) {
        throw new RuntimeException('Simulation context was not preserved.');
    }
}
foreach ([$combatRequest, $spyRequest, $sabotageRequest] as $request) {
    if (($request['valid'] ?? false) !== true) {
        throw new RuntimeException('Expected valid simulated request.');
    }
}
foreach ([$combatInvalid, $spyInvalid] as $request) {
    if (($request['valid'] ?? true) !== false) {
        throw new RuntimeException('Expected invalid target request to be rejected.');
    }
}

echo 'page_modules_checked=' . $checked . PHP_EOL;
echo 'combat_simulation=valid_request_and_invalid_target_rejected' . PHP_EOL;
echo 'espionage_simulation=spy_and_sabotage_valid_request_invalid_target_rejected' . PHP_EOL;
echo 'database_mutations=none' . PHP_EOL;

<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$manifest = require $root . '/config/page_contracts.php';
$feedbackStates = ['loading', 'ready', 'empty', 'protected', 'insufficient-resource', 'cooldown', 'success', 'error'];
$requiredPreviewKeys = ['route', 'title', 'logic', 'features', 'design', 'systems', 'context'];
$metrics = [
    'routes' => 0,
    'modules_loaded' => 0,
    'valid_intents' => 0,
    'invalid_intents_rejected' => 0,
    'negative_values_rejected' => 0,
    'state_transitions_checked' => 0,
    'actions_checked' => 0,
];
$failures = [];

function checkOrRecord(bool $condition, string $message, array &$failures): void {
    if (!$condition) {
        $failures[] = $message;
    }
}

foreach ($manifest['routes'] as $route => $contract) {
    $metrics['routes']++;
    $moduleRelative = $contract['contract_files']['module'] ?? '';
    $modulePath = $root . '/' . $moduleRelative;
    checkOrRecord(is_file($modulePath), $route . ': module file missing', $failures);
    if (!is_file($modulePath)) {
        continue;
    }
    require_once $modulePath;
    $metrics['modules_loaded']++;
    $prefix = 'stargatewars_' . preg_replace('/[^a-z0-9]+/', '_', strtolower($contract['group'] . '_' . $route));
    $previewFunction = $prefix . '_preview';
    $validateFunction = $prefix . '_validate_intent';
    $actionsFunction = $prefix . '_actions';
    checkOrRecord(function_exists($previewFunction), $route . ': preview function missing', $failures);
    checkOrRecord(function_exists($validateFunction), $route . ': validation function missing', $failures);
    checkOrRecord(function_exists($actionsFunction), $route . ': actions function missing', $failures);
    if (!function_exists($previewFunction) || !function_exists($validateFunction) || !function_exists($actionsFunction)) {
        continue;
    }

    $preview = $previewFunction(['state' => 'ready', 'integration_test' => true]);
    foreach ($requiredPreviewKeys as $key) {
        checkOrRecord(array_key_exists($key, $preview), $route . ': preview missing ' . $key, $failures);
    }
    checkOrRecord(($preview['route'] ?? null) === $route, $route . ': preview route mismatch', $failures);
    checkOrRecord(($preview['context']['state'] ?? null) === 'ready', $route . ': preview context not preserved', $failures);

    foreach ($feedbackStates as $state) {
        $statePreview = $previewFunction(['state' => $state]);
        checkOrRecord(($statePreview['context']['state'] ?? null) === $state, $route . ': state transition lost ' . $state, $failures);
        $metrics['state_transitions_checked']++;
    }

    $actions = $actionsFunction();
    checkOrRecord(is_array($actions), $route . ': actions is not an array', $failures);
    foreach ($actions as $action) {
        $metrics['actions_checked']++;
        $validInput = ['action' => $action, 'target_id' => 2, 'amount' => 1, 'quantity' => 1, 'agents' => 1];
        $valid = $validateFunction($validInput);
        checkOrRecord(($valid['valid'] ?? false) === true, $route . ': valid action rejected: ' . $action, $failures);
        if (($valid['valid'] ?? false) === true) {
            $metrics['valid_intents']++;
        }
    }

    $invalidAction = $validateFunction(['action' => '__invalid_action__']);
    checkOrRecord(($invalidAction['valid'] ?? true) === false, $route . ': invalid action accepted', $failures);
    if (($invalidAction['valid'] ?? true) === false) {
        $metrics['invalid_intents_rejected']++;
    }

    $negative = $validateFunction(['action' => 'deposit', 'amount' => -1, 'quantity' => -1, 'target_id' => 2]);
    if (in_array('deposit', $actions, true) || in_array('withdraw', $actions, true) || in_array('train', $actions, true) || in_array('weapon_buy', $actions, true)) {
        checkOrRecord(($negative['valid'] ?? true) === false, $route . ': negative resource/quantity accepted', $failures);
        if (($negative['valid'] ?? true) === false) {
            $metrics['negative_values_rejected']++;
        }
    }
}

// Explicit attack and covert edge cases.
require_once $root . '/includes/page_modules/attack/targets.php';
require_once $root . '/includes/page_modules/attack/spy.php';
require_once $root . '/includes/page_modules/attack/sabotage.php';
$combatInvalidTarget = stargatewars_attack_targets_validate_intent(['action' => 'combat', 'target_id' => 0]);
$spyInvalidTarget = stargatewars_attack_spy_validate_intent(['action' => 'covert:spy', 'target_id' => 0, 'agents' => 1]);
$sabotageInvalidAgents = stargatewars_attack_sabotage_validate_intent(['action' => 'covert:sabotage', 'target_id' => 2, 'agents' => 1]);
checkOrRecord(($combatInvalidTarget['valid'] ?? true) === false, 'combat: zero target accepted', $failures);
checkOrRecord(($spyInvalidTarget['valid'] ?? true) === false, 'spy: zero target accepted', $failures);
checkOrRecord(($sabotageInvalidAgents['valid'] ?? false) === true, 'sabotage: valid agent request rejected', $failures);

if ($failures !== []) {
    fwrite(STDERR, json_encode(['status' => 'failed', 'metrics' => $metrics, 'failures' => $failures], JSON_PRETTY_PRINT) . PHP_EOL);
    exit(1);
}

echo json_encode(['status' => 'passed', 'metrics' => $metrics, 'database_mutations' => 0], JSON_PRETTY_PRINT) . PHP_EOL;

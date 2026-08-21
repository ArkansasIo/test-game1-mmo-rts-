<?php
declare(strict_types=1);

$source = file_get_contents(__DIR__ . '/../game.php');
if ($source === false) {
    throw new RuntimeException('Unable to read game.php.');
}

$checks = [
    'submit_intent_helper' => str_contains($source, 'function submitIntent(action,redirect,payload)'),
    'server_actions_wired' => str_contains($source, "bindIntentButtons('.server-action','dashboard')"),
    'attack_actions_wired' => str_contains($source, "bindIntentButtons('.attack-intent','targets')"),
    'sabotage_actions_wired' => str_contains($source, "bindIntentButtons('.sabotage-intent','sabotage')"),
    'weapon_actions_wired' => str_contains($source, "bindIntentButtons('.weapon-intent','weapons')"),
    'military_actions_wired' => str_contains($source, "bindIntentButtons('.military-intent','military-stats')"),
    'target_navigation_mapping' => str_contains($source, "action==='choose_target'"),
    'report_navigation_mapping' => str_contains($source, "action==='review_reports'"),
    'safe_read_allowlist' => str_contains($source, 'safeReadActions=['),
];

$failures = array_keys(array_filter($checks, static fn(bool $passed): bool => !$passed));
if ($failures) {
    throw new RuntimeException('Failed checks: ' . implode(', ', $failures));
}

echo json_encode(['status' => 'passed', 'checks' => $checks], JSON_PRETTY_PRINT) . PHP_EOL;

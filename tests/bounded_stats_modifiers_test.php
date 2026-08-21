<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/StatResolverService.php';

$pdo = db();
$stats = new StatResolverService($pdo);
$entityId = 987654321;
$pdo->beginTransaction();
$checks = [];
try {
    $stats->setBaseValue('commander', $entityId, 'command', 250, 'test_base');
    $command = $stats->resolve('commander', $entityId, 'command');
    $checks['hard_max_bound'] = $command['resolved_value'] === 100.0;

    $stats->setBaseValue('unit', $entityId, 'attack', 100, 'test_base');
    $buff = $stats->addModifier('unit', $entityId, 'attack', 'test_weapon_buff', 'buff', 25, 1.2, 'test');
    $debuff = $stats->addModifier('unit', $entityId, 'attack', 'test_damage_debuff', 'debuff', -50, 0.5, 'test');
    $attack = $stats->resolve('unit', $entityId, 'attack');
    $checks['additive_and_multiplicative_stack'] = abs($attack['resolved_value'] - 45.0) < 0.0001;
    $checks['source_breakdown'] = count($attack['sources']) === 3;

    $stats->addModifier('unit', $entityId, 'attack', 'expired_modifier', 'temporary', 1000, 2, 'test', '2020-01-01 00:00:00', '2020-01-02 00:00:00');
    $afterExpired = $stats->resolve('unit', $entityId, 'attack');
    $checks['expired_modifier_ignored'] = abs($afterExpired['resolved_value'] - 45.0) < 0.0001;

    $stats->addModifier('unit', $entityId, 'attack', 'floor_override', 'condition', -1000, 1, 'test', null, null, 25, 60);
    $withOverride = $stats->resolve('unit', $entityId, 'attack');
    $checks['effective_bounds_applied'] = $withOverride['resolved_value'] === 25.0;

    $invalidRejected = false;
    try {
        $stats->addModifier('unit', $entityId, 'attack', 'invalid_multiplier', 'buff', 0, -1, 'test');
    } catch (InvalidArgumentException) {
        $invalidRejected = true;
    }
    $checks['negative_multiplier_rejected'] = $invalidRejected;

    $pdo->rollBack();
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
}

$failures = array_keys(array_filter($checks, static fn(bool $ok): bool => !$ok));
echo json_encode(['status' => $failures ? 'failed' : 'passed', 'checks' => $checks, 'failures' => $failures], JSON_PRETTY_PRINT) . PHP_EOL;
exit($failures ? 1 : 0);

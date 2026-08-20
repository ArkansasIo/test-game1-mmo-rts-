<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/02_Gameplay/GameService.php';

$now = new DateTimeImmutable('2026-08-20 12:00:00');
$ready = GameService::defconCooldownState(null, $now);
$active = GameService::defconCooldownState('2026-08-20 12:04:00', $now);
$expired = GameService::defconCooldownState('2026-08-20 11:59:59', $now);
$farFuture = GameService::defconCooldownState('2026-08-20 12:05:00', $now);

$assertions = [
    'null_ready' => ($ready['state'] ?? null) === 'ready' && ($ready['remaining_seconds'] ?? -1) === 0,
    'active_cooldown' => ($active['state'] ?? null) === 'cooldown' && ($active['remaining_seconds'] ?? 0) === 240,
    'expired_ready' => ($expired['state'] ?? null) === 'ready' && ($expired['remaining_seconds'] ?? -1) === 0,
    'future_cooldown' => ($farFuture['state'] ?? null) === 'cooldown' && ($farFuture['remaining_seconds'] ?? 0) === 300,
];
foreach ($assertions as $name => $passed) {
    if (!$passed) {
        throw new RuntimeException('DefCon assertion failed: ' . $name);
    }
}

echo json_encode(['status' => 'passed', 'states' => $assertions, 'database_mutations' => 0], JSON_PRETTY_PRINT) . PHP_EOL;

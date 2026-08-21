<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/TurnProcessorService.php';

$pdo = db();
$checks = [];
$check = static function (string $name, bool $passed, string $detail = '') use (&$checks): void {
    $checks[] = ['name' => $name, 'passed' => $passed, 'detail' => $detail];
};

try {
    $settings = $pdo->prepare('SELECT setting_value FROM game_settings WHERE setting_key=?');
    $settings->execute(['turn_interval_seconds']);
    $interval = (int)$settings->fetchColumn();
    $check('six-ticks-per-minute interval configured', $interval === 10, 'interval=' . $interval . '; ticks_per_minute=' . intdiv(60, max(1, $interval)));

    $tables = [];
    foreach (['game_turns', 'turn_events', 'game_events'] as $table) {
        $stmt = $pdo->query('SHOW TABLES LIKE ' . $pdo->quote($table));
        $tables[$table] = (bool)$stmt->fetchColumn();
        $check($table . ' table exists', $tables[$table]);
    }

    $service = new TurnProcessorService($pdo);
    $summary = $service->run(new DateTimeImmutable('now'), null, true);
    $check('dry run reports ten-second interval', (int)($summary['interval_seconds'] ?? 0) === 10);
    $check('dry run does not mutate players', (int)($summary['processed'] ?? -1) === 0);
    $check('dry run has no errors', empty($summary['errors'] ?? []));

    $status = $pdo->query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='game_turns' AND COLUMN_NAME='status'")->fetchColumn();
    $check('game turn status supports completed and failed', is_string($status) && str_contains($status, 'completed') && str_contains($status, 'failed'), (string)$status);

    $passed = count(array_filter($checks, static fn(array $row): bool => $row['passed'])) === count($checks);
    echo json_encode(['status' => $passed ? 'passed' : 'failed', 'checks' => $checks], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit($passed ? 0 : 1);
} catch (Throwable $e) {
    echo json_encode(['status' => 'failed', 'error' => $e->getMessage(), 'checks' => $checks], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
    exit(1);
}

<?php
declare(strict_types=1);

if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "CLI only\n");
    exit(64);
}

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/TurnProcessorService.php';

$opts = getopt('', ['dry-run', 'player:', 'json']);
$dryRun = array_key_exists('dry-run', $opts);
$json = array_key_exists('json', $opts);
$playerFilter = isset($opts['player']) ? (int)$opts['player'] : null;
if ($playerFilter !== null && $playerFilter < 1) {
    fwrite(STDERR, "Player ID must be positive.\n");
    exit(64);
}

$lockPath = __DIR__ . '/../storage/turn-processing.lock';
$logPath = __DIR__ . '/../storage/logs/turn-processing.log';
@mkdir(dirname($lockPath), 0775, true);
@mkdir(dirname($logPath), 0775, true);
$lock = fopen($lockPath, 'c');
if (!$lock || !flock($lock, LOCK_EX | LOCK_NB)) {
    fwrite(STDERR, "Turn processor already running.\n");
    exit(75);
}

try {
    $processor = new TurnProcessorService(db());
    $summary = $processor->run(null, $playerFilter, $dryRun);
    $line = json_encode($summary, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
    file_put_contents($logPath, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
    if ($json) {
        echo $line . PHP_EOL;
    } else {
        $skipped = (($summary['message'] ?? '') !== '') || (($summary['turns'] ?? 0) === 0 && ($summary['processed'] ?? 0) === 0 && !empty($summary['turn_number']));
        echo 'Turn processor ' . ($dryRun ? 'dry run' : ($skipped ? 'skipped' : 'completed')) . ': '
            . (int)($summary['processed'] ?? 0) . ' players, '
            . (int)($summary['turns'] ?? 0) . ' turns, '
            . count($summary['errors'] ?? []) . " errors.\n";
    }
    exit(!empty($summary['errors']) ? 1 : 0);
} catch (Throwable $e) {
    $payload = ['job' => 'turn_processing', 'status' => 'failed', 'error' => $e->getMessage(), 'finished_at' => date(DATE_ATOM)];
    file_put_contents($logPath, json_encode($payload, JSON_UNESCAPED_SLASHES) . PHP_EOL, FILE_APPEND | LOCK_EX);
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
} finally {
    if (is_resource($lock)) {
        flock($lock, LOCK_UN);
        fclose($lock);
    }
}

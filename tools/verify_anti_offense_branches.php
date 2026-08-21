<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/TechnologyTreeService.php';
require_once __DIR__ . '/../includes/services/AntiCovertTechnologyService.php';
require_once __DIR__ . '/../includes/services/OffenseTechnologyService.php';
$pdo = db();
foreach ([['anti_covert', AntiCovertTechnologyService::class], ['offense', OffenseTechnologyService::class]] as [$branch, $class]) {
    $snapshot = (new $class($pdo))->snapshot(1);
    echo strtoupper($branch) . PHP_EOL;
    echo json_encode([
        'technologies' => $snapshot['technologies'] ?? [],
        'branch_systems' => $snapshot['branch_systems'] ?? [],
        'queue' => $snapshot['queue'] ?? [],
        'queue_used' => $snapshot['queue_used'] ?? 0,
        'queue_capacity' => $snapshot['queue_capacity'] ?? null,
        'queue_available' => $snapshot['queue_available'] ?? null,
        'counter_intelligence' => $snapshot['counter_intelligence'] ?? null,
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
}

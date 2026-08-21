<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/TechnologyTreeService.php';
require_once __DIR__ . '/../includes/services/OffenseTechnologyService.php';
$pdo = db();
foreach ([['tree', TechnologyTreeService::class], ['offense', OffenseTechnologyService::class]] as [$label, $class]) {
    $snapshot = (new $class($pdo))->snapshot(1);
    echo $label . '=' . json_encode([
        'branch_systems' => $snapshot['branch_systems'] ?? [],
        'weapon_systems' => $snapshot['weapon_systems'] ?? [],
    ], JSON_UNESCAPED_SLASHES) . PHP_EOL;
}

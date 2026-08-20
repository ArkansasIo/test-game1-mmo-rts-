<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$files = [
    $root . '/includes/services/GameService.php',
    $root . '/includes/services/WorldService.php',
    $root . '/includes/services/FormulaService.php',
    $root . '/includes/services/EconomyService.php',
    $root . '/02_Gameplay/Combat/CombatResolver.php',
    $root . '/02_Gameplay/Covert/CovertEngine.php',
];
$loaded = [];
foreach ($files as $file) {
    if (!is_file($file)) { echo "missing:$file\n"; exit(1); }
    require_once $file;
    $loaded[] = basename($file);
}
echo 'services_loaded=' . count($loaded) . PHP_EOL;
echo implode(',', $loaded) . PHP_EOL;

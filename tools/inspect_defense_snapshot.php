<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/DefenseTechnologyService.php';
require_once __DIR__ . '/../includes/services/TechnologyTreeService.php';
$s=(new DefenseTechnologyService(db()))->snapshot(1);
echo json_encode($s, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES).PHP_EOL;

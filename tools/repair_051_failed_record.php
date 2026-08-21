<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$stmt = db()->prepare("DELETE FROM schema_migrations WHERE migration_key = ? AND status = 'failed'");
$stmt->execute(['051_bounded_stats_modifiers']);
echo 'Removed failed migration record for 051_bounded_stats_modifiers.' . PHP_EOL;

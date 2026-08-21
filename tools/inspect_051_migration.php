<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$stmt = db()->prepare('SELECT migration_key, checksum, status, applied_at, error_message FROM schema_migrations WHERE migration_key=?');
$stmt->execute(['051_bounded_stats_modifiers']);
print_r($stmt->fetch(PDO::FETCH_ASSOC));

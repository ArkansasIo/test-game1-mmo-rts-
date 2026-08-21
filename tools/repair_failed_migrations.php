<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo = db();
$statement = $pdo->prepare("DELETE FROM schema_migrations WHERE migration_key = ? AND status = 'failed'");
$statement->execute(['038_government_commander_units']);
echo 'Removed failed migration record for 038_government_commander_units.' . PHP_EOL;

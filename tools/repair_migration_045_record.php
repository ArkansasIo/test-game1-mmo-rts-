<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$key='045_combat_fleet_mechanics';
$stmt=$pdo->prepare('SELECT status FROM schema_migrations WHERE migration_key=?');
$stmt->execute([$key]);
$status=$stmt->fetchColumn();
if($status===false){echo "no_record\n";exit(0);}
$pdo->prepare('DELETE FROM schema_migrations WHERE migration_key=?')->execute([$key]);
echo "removed_record={$key}; migration is idempotent and ready to rerun\n";

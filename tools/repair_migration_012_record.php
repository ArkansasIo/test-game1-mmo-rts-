<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$key='012_races_governments_registration';
$stmt=$pdo->prepare("SELECT status,filename FROM schema_migrations WHERE migration_key=?");
$stmt->execute([$key]);
$row=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$row){echo "no_record\n";exit(0);}
if($row['status']!=='failed'){fwrite(STDERR,"Refusing to remove non-failed migration record: {$row['status']}\n");exit(1);}
$pdo->prepare('DELETE FROM schema_migrations WHERE migration_key=? AND status=\'failed\'')->execute([$key]);
echo "removed_failed_record={$key}\n";

<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$rows=$pdo->query('SELECT migration_key,status,filename FROM schema_migrations ORDER BY migration_key')->fetchAll(PDO::FETCH_ASSOC);
$objects=[];
foreach(['market_orders','market_transactions','weapon_types','player_resources','universe_galaxies','universe_sectors','game_turns','turn_events','design_catalog','motherships','deuterium'] as $table){
  $q=$pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=?");$q->execute([$table]);$objects[$table]=(int)$q->fetchColumn();
}
$columns=[];
foreach(['market_orders','player_resources','players'] as $table){$q=$pdo->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? ORDER BY ORDINAL_POSITION");$q->execute([$table]);$columns[$table]=$q->fetchAll(PDO::FETCH_COLUMN);}
echo json_encode(['migrations'=>$rows,'objects'=>$objects,'columns'=>$columns],JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES).PHP_EOL;

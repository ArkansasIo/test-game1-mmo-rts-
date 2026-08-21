<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
$pdo=db();
foreach (['market_orders','player_weapons','weapon_types','player_cooldowns','game_settings'] as $table) {
  echo "--- {$table} ---\n";
  $q=$pdo->prepare('SELECT COLUMN_NAME,COLUMN_TYPE,IS_NULLABLE,COLUMN_DEFAULT FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? ORDER BY ORDINAL_POSITION');
  $q->execute([$table]); print_r($q->fetchAll(PDO::FETCH_ASSOC));
}

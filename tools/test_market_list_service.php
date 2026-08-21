<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/WeaponMarketService.php';
$pdo=db();
$row=$pdo->query('SELECT player_id,weapon_type_id,quantity FROM player_weapons WHERE quantity>0 ORDER BY player_id,weapon_type_id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if(!$row){echo "no inventory row\n"; exit(1);}
echo json_encode($row).PHP_EOL;
try{$id=(new WeaponMarketService($pdo))->listWeaponOrder((int)$row['player_id'],(int)$row['weapon_type_id'],1,1000,72);echo "listed_order_id={$id}\n";}catch(Throwable $e){echo 'service_error='.get_class($e).': '.$e->getMessage().PHP_EOL;exit(1);}

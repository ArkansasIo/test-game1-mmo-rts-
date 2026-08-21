<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
$pdo=db();
foreach(['market_orders','player_weapons'] as $t){echo "---{$t}---\n";$q=$pdo->prepare('SELECT COLUMN_NAME,COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? ORDER BY ORDINAL_POSITION');$q->execute([$t]);foreach($q->fetchAll(PDO::FETCH_ASSOC) as $r)echo $r['COLUMN_NAME'].' '.$r['COLUMN_TYPE'].PHP_EOL;}
echo "---settings---\n";foreach($pdo->query("SELECT setting_key,setting_value FROM game_settings WHERE setting_key LIKE 'market%'")->fetchAll(PDO::FETCH_ASSOC) as $r)echo $r['setting_key'].'='.$r['setting_value'].PHP_EOL;
try{$pdo->beginTransaction();$s=$pdo->prepare("INSERT INTO market_orders (seller_id,resource_type,weapon_type_id,quantity,unit_price,status,expires_at) VALUES (?,'weapon',?,?,?,'open',?)");$s->execute([1,1,1,1000,date('Y-m-d H:i:s',time()+3600)]);echo "insert succeeded\n";$pdo->rollBack();}catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();echo 'insert error: '.$e->getMessage().PHP_EOL;}

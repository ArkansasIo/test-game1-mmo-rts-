<?php
declare(strict_types=1);
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/WeaponRepairService.php';
$pdo=db();
$row=$pdo->query('SELECT pw.player_id,pw.id FROM player_weapons pw JOIN weapon_types wt ON wt.id=pw.weapon_type_id WHERE pw.quantity>0 AND pw.durability=wt.max_durability ORDER BY pw.player_id,pw.id LIMIT 1')->fetch(PDO::FETCH_ASSOC);
if(!$row){echo "no full-durability weapon found\n";exit(1);}
$result=(new WeaponRepairService($pdo))->repair((int)$row['player_id'],(int)$row['id']);
echo json_encode(['state'=>$result['state']??null,'message'=>$result['message']??null,'repair_cost'=>$result['repair_cost']??null],JSON_PRETTY_PRINT).PHP_EOL;
exit(($result['state']??'')==='empty' ? 0 : 1);

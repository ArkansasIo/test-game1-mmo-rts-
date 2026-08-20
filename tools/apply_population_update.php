<?php
declare(strict_types=1);
require __DIR__.'/../config/config.php';
$pdo=db();
if(!$pdo){fwrite(STDERR,"Database unavailable\n");exit(1);}
$pdo->beginTransaction();
try{
  $players=$pdo->query("SELECT id FROM players WHERE username IN ('demo','demo_commander')")->fetchAll(PDO::FETCH_COLUMN);
  if(!$players){throw new RuntimeException('No active demo commander found.');}
  $in=implode(',',array_fill(0,count($players),'?'));
  $params=array_map('intval',$players);
  $stmt=$pdo->prepare("UPDATE player_resources SET population=150000,population_capacity=200000,workforce=150000 WHERE player_id IN ($in)");$stmt->execute($params);
  foreach(['player_colonies'=>'population=150000','colonies'=>'population=150000,population_capacity=200000,workforce=150000'] as $table=>$set){try{$stmt=$pdo->prepare("UPDATE `$table` SET $set WHERE player_id IN ($in)");$stmt->execute($params);}catch(Throwable $e){if($table==='player_colonies')throw $e;}}
  $pdo->commit();echo 'Updated players: '.implode(',',$players).PHP_EOL;
}catch(Throwable $e){if($pdo->inTransaction())$pdo->rollBack();fwrite(STDERR,$e->getMessage().PHP_EOL);exit(1);}

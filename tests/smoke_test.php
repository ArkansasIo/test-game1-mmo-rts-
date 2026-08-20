<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') exit("CLI only\n");
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/GameService.php';
$pdo=db();if(!$pdo)exit("SKIP: database unavailable\n");
$player=$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetch();if(!$player)exit("FAIL: demo player missing\n");$id=(int)$player['id'];$service=new GameService($pdo);
$checks=[];
try{$service->processTurns($id);$checks[]='turns';}catch(Throwable $e){$checks[]='turns: '.$e->getMessage();}
try{$service->train($id,'miners',1);$checks[]='training';}catch(Throwable $e){$checks[]='training: '.$e->getMessage();}
try{$service->buyTechnology($id,'siege');$checks[]='technology';}catch(Throwable $e){$checks[]='technology: '.$e->getMessage();}
try{$service->buyWeapon($id,1,1);$checks[]='weapons';}catch(Throwable $e){$checks[]='weapons: '.$e->getMessage();}
echo implode(PHP_EOL,$checks).PHP_EOL;

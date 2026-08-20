<?php
declare(strict_types=1);
$root=dirname(__DIR__);
require_once $root.'/config/config.php';
require_once $root.'/includes/services/GameService.php';
$pdo=db();
if(!$pdo instanceof PDO){fwrite(STDERR,"database_unavailable\n");exit(2);}
$playerId=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();
if($playerId<1){fwrite(STDERR,"seed_player_missing\n");exit(2);}
$service=new GameService($pdo);
$targets=$service->targetBoard($playerId);
if(count($targets)<3){fwrite(STDERR,"insufficient_targets\n");exit(1);}
$open=null;$protected=null;
foreach($targets as $target){if($target['status']==='OPEN'&&$open===null)$open=$target;if($target['status']==='PROTECTED'&&$protected===null)$protected=$target;}
if(!$open){fwrite(STDERR,"open_target_missing\n");exit(1);}
$attack=$service->combatPreview($playerId,(int)$open['id'],'attack',1);
$raid=$service->combatPreview($playerId,(int)$open['id'],'raid',1);
$invalidRejected=false;try{$service->combatPreview($playerId,999999,'attack',1);}catch(Throwable $e){$invalidRejected=true;}
$checks=['target_count'=>count($targets)>=3,'open_status'=>$open['status']==='OPEN','attack_cost'=>$attack['attack_turn_cost']===1,'attack_loot'=>$attack['expected_loot_cap']==='10% Naquadah','raid_loot'=>$raid['expected_loot_cap']==='5% Naquadah','invalid_target_rejected'=>$invalidRejected];
$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));
echo json_encode(['status'=>$failures?'failed':'passed','target_count'=>count($targets),'open_target'=>$open,'protected_target'=>$protected,'attack_preview'=>$attack,'raid_preview'=>$raid,'checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;
exit($failures?1:0);

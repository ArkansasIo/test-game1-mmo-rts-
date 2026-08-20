<?php
declare(strict_types=1);
$root=dirname(__DIR__);
require_once $root.'/config/config.php';
require_once $root.'/includes/services/GameService.php';
$pdo=db();
if(!$pdo instanceof PDO){fwrite(STDERR,"database_unavailable\n");exit(2);}
$playerId=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();
if($playerId<1){fwrite(STDERR,"seed_player_missing\n");exit(2);}
$service=new GameService($pdo);$targets=$service->targetBoard($playerId);$open=null;$protected=null;foreach($targets as $target){if($target['status']==='OPEN'&&$open===null)$open=$target;if($target['status']==='PROTECTED'&&$protected===null)$protected=$target;}
if(!$open){fwrite(STDERR,"open_target_missing\n");exit(1);}
$preview=$service->covertPreview($playerId,(int)$open['id'],20,'sabotage');$invalidAgentsRejected=false;try{$service->covertPreview($playerId,(int)$open['id'],999999,'sabotage');}catch(Throwable $e){$invalidAgentsRejected=true;}
$checks=['type'=>$preview['type']==='sabotage','formula'=>str_contains($preview['formula'],'defender counter-intelligence'),'damage_scope'=>str_contains($preview['intelligence_scope'],'Bounded damage'),'success_probability_bounded'=>$preview['detection_chance_percent']>=5&&$preview['detection_chance_percent']<=95,'invalid_agents_rejected'=>$invalidAgentsRejected,'protected_target_available'=>$protected!==null];
$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));
echo json_encode(['status'=>$failures?'failed':'passed','open_target'=>$open,'protected_target'=>$protected,'preview'=>$preview,'checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;
exit($failures?1:0);

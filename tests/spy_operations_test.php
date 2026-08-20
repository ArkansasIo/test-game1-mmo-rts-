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
$stats=$service->covertStats($playerId);
$targets=$service->targetBoard($playerId);$open=null;foreach($targets as $target){if($target['status']==='OPEN'){$open=$target;break;}}
if(!$open){fwrite(STDERR,"open_target_missing\n");exit(1);}
$recon=$service->covertPreview($playerId,(int)$open['id'],10,'recon');
$spy=$service->covertPreview($playerId,(int)$open['id'],20,'spy');
$sabotage=$service->covertPreview($playerId,(int)$open['id'],30,'sabotage');
$invalidRejected=false;try{$service->covertPreview($playerId,999999,10,'spy');}catch(Throwable $e){$invalidRejected=true;}
$checks=['agents'=>($stats['available_agents']??0)>=30,'ready'=>$stats['mission_state']==='READY','formula'=>str_contains($stats['formula'],'defender counter-intelligence'),'recon_scope'=>$recon['intelligence_scope']==='Defense, resources, technology','spy_scope'=>$spy['intelligence_scope']==='Defense, resources, technology, queues','sabotage_scope'=>str_contains($sabotage['intelligence_scope'],'Bounded damage'),'invalid_target_rejected'=>$invalidRejected];
$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));
echo json_encode(['status'=>$failures?'failed':'passed','stats'=>$stats,'target'=>$open,'previews'=>['recon'=>$recon,'spy'=>$spy,'sabotage'=>$sabotage],'checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;
exit($failures?1:0);

<?php
declare(strict_types=1);
$root=dirname(__DIR__);require_once $root.'/config/config.php';require_once $root.'/includes/services/GameService.php';
$pdo=db();if(!$pdo instanceof PDO){fwrite(STDERR,"database_unavailable\n");exit(2);} $playerId=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();if($playerId<1){fwrite(STDERR,"seed_player_missing\n");exit(2);}
$service=new GameService($pdo);$reports=$service->reportFeed($playerId);$battle=null;foreach($reports as $row){if($row['report_kind']==='battle'){$battle=$row;break;}}
if(!$battle){fwrite(STDERR,"battle_report_missing\n");exit(1);}
$service->readReport($playerId,'battle',(int)$battle['report_id']);$after=$service->reportFeed($playerId);$updated=null;foreach($after as $row){if((int)$row['report_id']===(int)$battle['report_id']){$updated=$row;break;}}
$invalidRejected=false;try{$service->readReport($playerId,'battle',999999);}catch(Throwable $e){$invalidRejected=true;}
$checks=['feed_nonempty'=>count($reports)>0,'recipient_visibility'=>$battle['report_kind']==='battle','classification'=>$battle['classification']==='STANDARD','battle_title'=>str_contains((string)$battle['title'],'—'),'mark_read'=>$updated!==null&&$updated['read_state']==='READ','invalid_report_rejected'=>$invalidRejected];$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));echo json_encode(['status'=>$failures?'failed':'passed','report_count'=>count($reports),'sample'=>$battle,'after_mark_read'=>$updated,'checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;exit($failures?1:0);

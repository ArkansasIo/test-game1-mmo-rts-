<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { fwrite(STDERR, "CLI only\n"); exit(64); }
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/GameService.php';
$opts=getopt('', ['dry-run','player:', 'json']);
$dryRun=array_key_exists('dry-run',$opts);$json=array_key_exists('json',$opts);$playerFilter=isset($opts['player'])?(int)$opts['player']:null;
$lockPath=__DIR__.'/../storage/turn-processing.lock';$logPath=__DIR__.'/../storage/logs/turn-processing.log';
@mkdir(dirname($lockPath),0775,true);@mkdir(dirname($logPath),0775,true);
$lock=fopen($lockPath,'c');if(!$lock||!flock($lock,LOCK_EX|LOCK_NB)){fwrite(STDERR,"Turn processor already running.\n");exit(75);}
$started=microtime(true);$summary=['job'=>'turn_processing','started_at'=>date(DATE_ATOM),'dry_run'=>$dryRun,'player_filter'=>$playerFilter,'players'=>0,'processed'=>0,'turns'=>0,'errors'=>[]];
try{$pdo=db();if(!$pdo)throw new RuntimeException('Database unavailable.');$sql='SELECT id FROM players';$params=[];if($playerFilter!==null){$sql.=' WHERE id=?';$params[]=$playerFilter;}$sql.=' ORDER BY id';$stmt=$pdo->prepare($sql);$stmt->execute($params);$players=$stmt->fetchAll(PDO::FETCH_COLUMN);$summary['players']=count($players);if($dryRun){$summary['message']='Dry run only; no player state was mutated.';}else{foreach($players as $id){try{$result=(new GameService($pdo))->processTurns((int)$id);$summary['processed']++;$summary['turns']+=(int)($result['turns']??0);}catch(Throwable $e){$summary['errors'][]=['player_id'=>(int)$id,'message'=>$e->getMessage()];}}}$summary['finished_at']=date(DATE_ATOM);$summary['duration_ms']=round((microtime(true)-$started)*1000,2);$line=json_encode($summary,JSON_UNESCAPED_SLASHES|JSON_THROW_ON_ERROR);file_put_contents($logPath,$line.PHP_EOL,FILE_APPEND|LOCK_EX);if($json){echo $line.PHP_EOL;}else{echo 'Turn processor '.($dryRun?'dry run':'completed').': '.$summary['processed'].' players, '.$summary['turns'].' turns, '.count($summary['errors']).' errors.'.PHP_EOL;}exit($summary['errors']?1:0);}catch(Throwable $e){$summary['finished_at']=date(DATE_ATOM);$summary['fatal_error']=$e->getMessage();file_put_contents($logPath,json_encode($summary,JSON_UNESCAPED_SLASHES).PHP_EOL,FILE_APPEND|LOCK_EX);fwrite(STDERR,$e->getMessage().PHP_EOL);exit(1);}finally{flock($lock,LOCK_UN);fclose($lock);}

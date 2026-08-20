<?php
declare(strict_types=1);
$root=dirname(__DIR__);
require_once $root.'/config/config.php';
require_once $root.'/includes/services/GameService.php';
$pdo=db();
$playerId=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();
if($playerId<1){fwrite(STDERR,"seed_player_missing\n");exit(2);}
$before=$pdo->prepare('SELECT naquadah,banked_naquadah FROM player_resources WHERE player_id=?');$before->execute([$playerId]);$start=$before->fetch(PDO::FETCH_ASSOC);
$invalid=false;try{(new GameService($pdo))->deposit($playerId,0);}catch(InvalidArgumentException $e){$invalid=true;}
$service=new GameService($pdo);$service->deposit($playerId,1);$service->withdraw($playerId,1);
$after=$before;$after->execute([$playerId]);$end=$after->fetch(PDO::FETCH_ASSOC);
$events=$pdo->prepare("SELECT COUNT(*) FROM game_events WHERE player_id=? AND event_type IN ('naquadah_deposited','naquadah_withdrawn') AND created_at >= DATE_SUB(NOW(), INTERVAL 2 MINUTE)");$events->execute([$playerId]);
$checks=['invalid_amount_rejected'=>$invalid,'balances_restored'=>(int)$start['naquadah']===(int)$end['naquadah']&&(int)$start['banked_naquadah']===(int)$end['banked_naquadah'],'audit_events_written'=>(int)$events->fetchColumn()>=2];
$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));
echo json_encode(['status'=>$failures?'failed':'passed','checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;
exit($failures?1:0);

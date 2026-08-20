<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { fwrite(STDERR,"CLI only\n"); exit(1); }
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../includes/services/GameService.php';
$pdo=db();
if(!$pdo){fwrite(STDERR,"SKIP: database unavailable\n");exit(0);}
$player=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();
if($player<1){fwrite(STDERR,"FAIL: demo player missing\n");exit(1);}
$get=function(string $sql,array $args=[])use($pdo){$s=$pdo->prepare($sql);$s->execute($args);return $s->fetch(PDO::FETCH_ASSOC);};
$settings=$get("SELECT setting_value FROM game_settings WHERE setting_key='turn_interval_seconds'");
$interval=max(1,(int)($settings['setting_value']??1800));
$oldPlayer=$get('SELECT last_turn_at,defcon_level,race_id FROM players WHERE id=?',[$player]);
$oldResources=$get('SELECT attack_turns,unit_production,untrained_units,miners,lifers,naquadah FROM player_resources WHERE player_id=?',[$player]);
$oldColony=$get('SELECT id,food_stock,water_stock,population,morale,workforce FROM colonies WHERE player_id=? ORDER BY id LIMIT 1',[$player]);
if(!$oldColony){fwrite(STDERR,"FAIL: demo colony missing\n");exit(1);}
$eventMax=(int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM game_events')->fetchColumn();
$snapshotMax=(int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM colony_turn_snapshots')->fetchColumn();
$txMax=(int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM resource_transactions')->fetchColumn();
$report=['status'=>'passed','checks'=>[],'result'=>null];
$check=function(string $name,bool $ok,string $detail='')use(&$report){$report['checks'][]=['name'=>$name,'passed'=>$ok,'detail'=>$detail];if(!$ok)$report['status']='failed';};
try{
  $pdo->prepare('UPDATE players SET last_turn_at=?,defcon_level=0 WHERE id=?')->execute([(new DateTimeImmutable('now'))->modify('-'.($interval*2+5).' seconds')->format('Y-m-d H:i:s'),$player]);
  $service=new GameService($pdo);$result=$service->processTurns($player);$report['result']=$result;
  $afterResources=$get('SELECT attack_turns,unit_production,untrained_units,miners,lifers,naquadah FROM player_resources WHERE player_id=?',[$player]);
  $afterPlayer=$get('SELECT last_turn_at FROM players WHERE id=?',[$player]);
  $afterColony=$get('SELECT food_stock,water_stock,population,morale,workforce FROM colonies WHERE id=?',[$oldColony['id']]);
  $event=$get("SELECT id,payload FROM game_events WHERE id>? AND player_id=? AND event_type='turn_processed' ORDER BY id DESC LIMIT 1",[$eventMax,$player]);
  $snapshot=$get('SELECT id,food_before,food_after,water_before,water_after,population_before,population_after FROM colony_turn_snapshots WHERE id>? AND colony_id=? ORDER BY id DESC LIMIT 1',[$snapshotMax,$oldColony['id']]);
  $transaction=$get("SELECT id FROM resource_transactions WHERE id>? AND player_id=? AND colony_id=? AND reason='colony_settlement' ORDER BY id DESC LIMIT 1",[$txMax,$player,$oldColony['id']]);
  $turns=(int)($result['turns']??0);$income=(int)($result['income']??0);$expectedIncome=((int)$oldResources['untrained_units']*20+((int)$oldResources['miners']+(int)$oldResources['lifers'])*80)*$turns;
  $check('turns generated',$turns>=2,(string)$turns);$check('income settled',$income===$expectedIncome,"expected=$expectedIncome actual=$income");
  $check('attack turns incremented',(int)$afterResources['attack_turns']===(int)$oldResources['attack_turns']+$turns);
  $check('untrained units generated',(int)$afterResources['untrained_units']===(int)$oldResources['untrained_units']+(int)$oldResources['unit_production']*$turns);
  $check('naquadah income persisted',(int)$afterResources['naquadah']===(int)$oldResources['naquadah']+$income);
  $check('last turn advanced',!empty($afterPlayer['last_turn_at']));$check('turn event written',(bool)$event);$check('colony food settled',$snapshot && (int)$afterColony['food_stock']<(int)$oldColony['food_stock']);$check('colony water settled',$snapshot && (int)$afterColony['water_stock']<(int)$oldColony['water_stock']);$check('settlement snapshot written',(bool)$snapshot);$check('resource transactions written',(bool)$transaction);
}catch(Throwable $e){$report['status']='failed';$report['error']=$e->getMessage();}
finally{
  try{
    $pdo->prepare('UPDATE players SET last_turn_at=?,defcon_level=? WHERE id=?')->execute([$oldPlayer['last_turn_at'],$oldPlayer['defcon_level'],$player]);
    $pdo->prepare('UPDATE player_resources SET attack_turns=?,unit_production=?,untrained_units=?,miners=?,lifers=?,naquadah=? WHERE player_id=?')->execute([$oldResources['attack_turns'],$oldResources['unit_production'],$oldResources['untrained_units'],$oldResources['miners'],$oldResources['lifers'],$oldResources['naquadah'],$player]);
    $pdo->prepare('UPDATE colonies SET food_stock=?,water_stock=?,population=?,morale=?,workforce=? WHERE id=?')->execute([$oldColony['food_stock'],$oldColony['water_stock'],$oldColony['population'],$oldColony['morale'],$oldColony['workforce'],$oldColony['id']]);
    $pdo->prepare('DELETE FROM game_events WHERE id>?')->execute([$eventMax]);$pdo->prepare('DELETE FROM colony_turn_snapshots WHERE id>?')->execute([$snapshotMax]);$pdo->prepare('DELETE FROM resource_transactions WHERE id>?')->execute([$txMax]);
  }catch(Throwable $e){$report['status']='failed';$report['cleanup_error']=$e->getMessage();}
}
echo json_encode($report,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES).PHP_EOL;exit($report['status']==='passed'?0:1);

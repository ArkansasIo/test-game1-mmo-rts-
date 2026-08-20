<?php
declare(strict_types=1);
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../includes/services/FactionService.php';
$pdo=db();
if(!$pdo){fwrite(STDERR,"SKIP: database unavailable\n");exit(0);}
$playerId=1;$svc=new FactionService($pdo);
$before=$pdo->prepare('SELECT race_id,government_id,registration_completed_at FROM players WHERE id=?');$before->execute([$playerId]);$original=$before->fetch(PDO::FETCH_ASSOC);if(!$original){fwrite(STDERR,"SKIP: player fixture unavailable\n");exit(0);}
$race=$pdo->query('SELECT id FROM races WHERE id<>'.(int)$original['race_id'].' ORDER BY id LIMIT 1')->fetchColumn();$gov=$pdo->query('SELECT id FROM government_types WHERE id<>'.(int)$original['government_id'].' AND is_active=1 ORDER BY id LIMIT 1')->fetchColumn();if(!$race||!$gov){fwrite(STDERR,"SKIP: faction alternatives unavailable\n");exit(0);}$race=(int)$race;$gov=(int)$gov;
$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key IN ('race_change','government_reform')")->execute([$playerId]);
$maxEvent=(int)$pdo->query("SELECT COALESCE(MAX(id),0) FROM game_events")->fetchColumn();
$maxHistory=(int)$pdo->query("SELECT COALESCE(MAX(id),0) FROM player_government_history")->fetchColumn();
try{
  if($original['registration_completed_at']===null){$initial=$svc->selectRegistration($playerId,(int)$original['race_id'],(int)$original['government_id']);if(($initial['state']??'')!=='success')throw new RuntimeException('Initial registration did not succeed.');}
  $snap=$svc->snapshot($playerId);
  if($snap['state']!=='ready'||count($snap['options']['races'])<2||count($snap['options']['governments'])<2)throw new RuntimeException('Faction snapshot/options contract failed.');
  $raceMatches=array_values(array_filter($snap['options']['races'],fn(array $x)=>(int)$x['id']===(int)$original['race_id']));$govMatches=array_values(array_filter($snap['options']['governments'],fn(array $x)=>(int)$x['id']===(int)$original['government_id']));$raceRow=$raceMatches[0]??null;$govRow=$govMatches[0]??null;if(!$raceRow||!$govRow)throw new RuntimeException('Current faction option rows missing.');$expectedIncome=(float)$raceRow['income_modifier']*(float)$govRow['economy_modifier'];if(abs((float)$snap['current']['income_modifier']-$expectedIncome)>0.0001)throw new RuntimeException('Combined income modifier contract failed.');
  $changed=$svc->changeRace($playerId,$race);if(($changed['state']??'')!=='success')throw new RuntimeException('Race change did not succeed.');
  $cool=$svc->snapshot($playerId)['cooldowns']['race_change'];if($cool['state']!=='cooldown')throw new RuntimeException('Race cooldown was not persisted.');
  $rejected=false;try{$svc->changeRace($playerId,(int)$original['race_id']);}catch(Throwable $e){$rejected=str_contains(strtolower($e->getMessage()),'cooldown');}if(!$rejected)throw new RuntimeException('Race cooldown rejection missing.');
  $reformed=$svc->reformGovernment($playerId,$gov);if(($reformed['state']??'')!=='success')throw new RuntimeException('Government reform did not succeed.');
  $govCool=$svc->snapshot($playerId)['cooldowns']['government_reform'];if($govCool['state']!=='cooldown')throw new RuntimeException('Government cooldown was not persisted.');
  $rejected=false;try{$svc->reformGovernment($playerId,(int)$original['government_id']);}catch(Throwable $e){$rejected=str_contains(strtolower($e->getMessage()),'cooldown');}if(!$rejected)throw new RuntimeException('Government cooldown rejection missing.');
  echo "PASS: faction snapshot, race modifier state, race-change cooldown, government reform cooldown, and audit flow verified\n";
}finally{
  $pdo->beginTransaction();
  $stmt=$pdo->prepare('UPDATE players SET race_id=?,government_id=?,registration_completed_at=? WHERE id=?');$stmt->execute([(int)$original['race_id'],(int)$original['government_id'],$original['registration_completed_at'],$playerId]);
  $pdo->prepare('DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key IN (\'race_change\',\'government_reform\')')->execute([$playerId]);
  $pdo->prepare("DELETE FROM game_events WHERE id>? AND player_id=? AND event_type IN ('faction_selected','race_changed','government_reformed')")->execute([$maxEvent,$playerId]);
  $pdo->prepare('DELETE FROM player_government_history WHERE id>? AND player_id=?')->execute([$maxHistory,$playerId]);
  $pdo->commit();
}

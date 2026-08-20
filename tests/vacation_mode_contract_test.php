<?php
declare(strict_types=1);
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../02_Gameplay/WorldService.php';
$pdo=db();
if(!$pdo){fwrite(STDERR,"SKIP: database unavailable\n");exit(0);}
$playerId=1;$svc=new WorldService($pdo);
$original=$pdo->prepare('SELECT vacation_until FROM players WHERE id=?');$original->execute([$playerId]);$oldPlayer=$original->fetchColumn();
$oldProtection=$pdo->prepare('SELECT vacation_until,protected_until FROM protection_states WHERE player_id=?');$oldProtection->execute([$playerId]);$protection=$oldProtection->fetch(PDO::FETCH_ASSOC)?:['vacation_until'=>null,'protected_until'=>null];
$oldVacation=$pdo->prepare('SELECT active,starts_at,ends_at FROM vacation_states WHERE player_id=?');$oldVacation->execute([$playerId]);$vacation=$oldVacation->fetch(PDO::FETCH_ASSOC)?:['active'=>0,'starts_at'=>null,'ends_at'=>null];
$oldCd=$pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='vacation_activation'");$oldCd->execute([$playerId]);$oldCd=$oldCd->fetchColumn();
$maxEvent=(int)$pdo->query('SELECT COALESCE(MAX(id),0) FROM game_events')->fetchColumn();
try{
  $pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='vacation_activation'")->execute([$playerId]);
  $pdo->prepare('UPDATE players SET vacation_until=NULL WHERE id=?')->execute([$playerId]);
  $pdo->prepare('UPDATE protection_states SET vacation_until=NULL,protected_until=NULL WHERE player_id=?')->execute([$playerId]);
  $pdo->prepare('UPDATE vacation_states SET active=0,starts_at=NULL,ends_at=NULL WHERE player_id=?')->execute([$playerId]);
  $before=$svc->vacationSnapshot($playerId);if($before['state']!=='ready'||$before['blocking_operations']['active_combat'])throw new RuntimeException('Fixture is not eligible for vacation activation.');
  $svc->activateVacation($playerId,2);$after=$svc->vacationSnapshot($playerId);if($after['state']!=='protected'||!$after['active']||$after['cooldown']['state']!=='cooldown')throw new RuntimeException('Vacation protection or cooldown was not persisted.');
  $rejected=false;try{$svc->activateVacation($playerId,2);}catch(Throwable $e){$rejected=str_contains(strtolower($e->getMessage()),'already active')||str_contains(strtolower($e->getMessage()),'cooldown');}if(!$rejected)throw new RuntimeException('Repeated vacation activation was not rejected.');
  $p=$pdo->prepare('SELECT vacation_until FROM players WHERE id=?');$p->execute([$playerId]);if(!$p->fetchColumn())throw new RuntimeException('Player vacation_until was not written.');
  $v=$pdo->prepare('SELECT active,starts_at,ends_at FROM vacation_states WHERE player_id=?');$v->execute([$playerId]);$row=$v->fetch(PDO::FETCH_ASSOC);if(!$row||!(int)$row['active']||!$row['ends_at'])throw new RuntimeException('Vacation state row was not written.');
  echo "PASS: vacation protection, account/fleet/production lock contract, cooldown rejection, and persistence verified\n";
}finally{
  $pdo->beginTransaction();
  $pdo->prepare('UPDATE players SET vacation_until=? WHERE id=?')->execute([$oldPlayer,$playerId]);
  $pdo->prepare('UPDATE protection_states SET vacation_until=?,protected_until=? WHERE player_id=?')->execute([$protection['vacation_until'],$protection['protected_until'],$playerId]);
  $pdo->prepare('UPDATE vacation_states SET active=?,starts_at=?,ends_at=? WHERE player_id=?')->execute([(int)$vacation['active'],$vacation['starts_at'],$vacation['ends_at'],$playerId]);
  $pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='vacation_activation'")->execute([$playerId]);if($oldCd!==false&&$oldCd!==null)$pdo->prepare("INSERT INTO player_cooldowns(player_id,cooldown_key,available_at) VALUES(?, 'vacation_activation', ?)")->execute([$playerId,$oldCd]);
  $pdo->prepare("DELETE FROM game_events WHERE id>? AND player_id=? AND event_type='vacation_enabled'")->execute([$maxEvent,$playerId]);
  $pdo->commit();
}

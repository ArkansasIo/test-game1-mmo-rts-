<?php
declare(strict_types=1);
$root=dirname(__DIR__);
require_once $root.'/config/config.php';
require_once $root.'/includes/services/GameService.php';
$pdo=db();
$playerId=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();
$targetStmt=$pdo->prepare("SELECT id FROM target_realms WHERE player_id IS NOT NULL AND player_id<>? AND (protection_until IS NULL OR protection_until<NOW()) ORDER BY id LIMIT 1");$targetStmt->execute([$playerId]);$targetId=(int)$targetStmt->fetchColumn();
if($playerId<1||$targetId<1){fwrite(STDERR,"seed_target_missing\n");exit(2);}
$beforeStmt=$pdo->prepare('SELECT spies FROM player_resources WHERE player_id=?');$beforeStmt->execute([$playerId]);$before=(int)$beforeStmt->fetchColumn();
$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='covert_sabotage'")->execute([$playerId]);
$service=new GameService($pdo);$mission=$service->covertMission($playerId,$targetId,'sabotage',1);$missionId=(int)$mission['mission_id'];
$q=$pdo->prepare('SELECT sabotage_damage,damage_system,success_probability,agents_sent,success FROM covert_missions WHERE id=? AND attacker_id=?');$q->execute([$missionId,$playerId]);$row=$q->fetch(PDO::FETCH_ASSOC);
$cool=$pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='covert_sabotage'");$cool->execute([$playerId]);$cooldown=$cool->fetchColumn();
$checks=['mission_persisted'=>is_array($row),'damage_bounded'=>is_array($row)&&((int)$row['sabotage_damage']>=0&&(int)$row['sabotage_damage']<=100),'probability_bounded'=>is_array($row)&&((float)$row['success_probability']>=0.05&&(float)$row['success_probability']<=0.95),'agents_spent'=>is_array($row)&&(int)$row['agents_sent']===1,'cooldown_persisted'=>is_string($cooldown)&&$cooldown!==''];
$afterStmt=$pdo->prepare('SELECT spies FROM player_resources WHERE player_id=?');$afterStmt->execute([$playerId]);$after=(int)$afterStmt->fetchColumn();$checks['agent_balance_decremented']=$after===$before-1;
$pdo->prepare('UPDATE player_resources SET spies=? WHERE player_id=?')->execute([$before,$playerId]);$pdo->prepare('DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key=\'covert_sabotage\'')->execute([$playerId]);$pdo->prepare('DELETE FROM intelligence_reports WHERE player_id=? AND target_player_id=? AND created_at>=DATE_SUB(NOW(),INTERVAL 2 MINUTE)')->execute([$playerId,$targetId]);$pdo->prepare('DELETE FROM game_events WHERE player_id=? AND entity_type=\'covert_mission\' AND entity_id=?')->execute([$playerId,$missionId]);$pdo->prepare('DELETE FROM covert_missions WHERE id=? AND attacker_id=?')->execute([$missionId,$playerId]);
$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));echo json_encode(['status'=>$failures?'failed':'passed','mission'=>$mission,'metadata'=>$row,'checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;exit($failures?1:0);

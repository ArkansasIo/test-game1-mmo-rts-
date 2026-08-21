<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/AllianceService.php';
$pdo=db();
$ids=$pdo->query('SELECT id FROM players ORDER BY id LIMIT 2')->fetchAll(PDO::FETCH_COLUMN);
if(count($ids)<2)throw new RuntimeException('At least two players are required for alliance flow test.');
$leader=(int)$ids[0];$member=(int)$ids[1];
foreach([$leader,$member] as $id){$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key IN ('alliance_create','alliance_join')")->execute([$id]);$pdo->prepare('UPDATE players SET alliance_id=NULL WHERE id=?')->execute([$id]);}
$service=new AllianceService($pdo);$name='Integration Alliance '.date('His');$tag='I'.date('His');$allianceId=$service->create($leader,$name,$tag,'Integration test alliance.');
$joined=$service->join($member,$allianceId);
if(($joined['state']??'')!=='success'||(int)$joined['member_count']!==2)throw new RuntimeException('Alliance join did not return two-member success state.');
$snapshot=$service->snapshot($member);
if(!$snapshot['current']||count($snapshot['roster'])!==2)throw new RuntimeException('Alliance snapshot roster is incomplete.');
if((int)$snapshot['capacity']['capacity']<2)throw new RuntimeException('Alliance capacity calculation is below member count.');
$pdo->prepare('DELETE FROM alliance_members WHERE alliance_id=?')->execute([$allianceId]);$pdo->prepare('DELETE FROM alliances WHERE id=?')->execute([$allianceId]);foreach([$leader,$member] as $id)$pdo->prepare('UPDATE players SET alliance_id=NULL WHERE id=?')->execute([$id]);
echo "alliance_flow_test: PASS\n";

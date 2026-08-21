<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/EmpireOperationsService.php';
$pdo=db();$playerId=(int)($pdo->query('SELECT id FROM players ORDER BY id LIMIT 1')->fetchColumn()?:0);if($playerId<1)throw new RuntimeException('No test player available.');
$service=new EmpireOperationsService($pdo);$snapshot=$service->snapshot($playerId);if(!array_key_exists('quests',$snapshot)||!array_key_exists('achievements',$snapshot)||!array_key_exists('missions',$snapshot))throw new RuntimeException('Empire operations snapshot contract is incomplete.');
$qid=(int)($pdo->query("SELECT id FROM quest_definitions WHERE quest_key='tutorial_first_upgrade' LIMIT 1")->fetchColumn()?:0);if($qid<1)throw new RuntimeException('Seed quest missing.');
$service->startQuest($playerId,$qid);$targetStmt=$pdo->prepare('SELECT objective_target FROM quest_definitions WHERE id=?');$targetStmt->execute([$qid]);$target=(int)$targetStmt->fetchColumn();$pdo->prepare("UPDATE player_quests SET progress=?,state='completed' WHERE player_id=? AND quest_id=?")->execute([$target,$playerId,$qid]);$claim=$service->claimQuest($playerId,$qid);if(($claim['state']??'')!=='success')throw new RuntimeException('Quest claim did not succeed.');$pdo->prepare('DELETE FROM player_quests WHERE player_id=? AND quest_id=?')->execute([$playerId,$qid]);
echo "empire_operations_test: PASS\n";

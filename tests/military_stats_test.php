<?php
declare(strict_types=1);
$root=dirname(__DIR__);
require_once $root.'/config/config.php';
require_once $root.'/includes/services/GameService.php';
$pdo=db();
if(!$pdo instanceof PDO){fwrite(STDERR,"database_unavailable\n");exit(2);}
$playerId=(int)$pdo->query("SELECT id FROM players WHERE username='demo' LIMIT 1")->fetchColumn();
if($playerId<1){fwrite(STDERR,"seed_player_missing\n");exit(2);}
$stats=(new GameService($pdo))->militaryStats($playerId);
$checks=[
 'attack_power'=>is_int($stats['attack_power'])&&$stats['attack_power']>=0,
 'defense_power'=>is_int($stats['defense_power'])&&$stats['defense_power']>=0,
 'covert_power'=>is_int($stats['covert_power'])&&$stats['covert_power']>=0,
 'anti_covert_power'=>is_int($stats['anti_covert_power'])&&$stats['anti_covert_power']>=0,
 'readiness'=>is_int($stats['readiness'])&&$stats['readiness']>=0&&$stats['readiness']<=100,
 'defcon'=>in_array($stats['defcon_level'],[0,1,2,3,4],true),
 'cooldown_state'=>in_array($stats['cooldown_state'],['ready','cooldown'],true),
];
$failures=array_keys(array_filter($checks,static fn(bool $ok):bool=>!$ok));
echo json_encode(['status'=>$failures?'failed':'passed','player_id'=>$playerId,'stats'=>$stats,'checks'=>$checks,'failures'=>$failures],JSON_PRETTY_PRINT|JSON_THROW_ON_ERROR).PHP_EOL;
exit($failures?1:0);

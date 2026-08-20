<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/MothershipExplorationService.php';

$pdo=db();
if(!$pdo){fwrite(STDERR,"SKIP: database unavailable\n");exit(0);}
$player=$pdo->query("SELECT m.player_id FROM motherships m JOIN player_resources r ON r.player_id=m.player_id WHERE m.hull_level>0 AND r.naquadah>=25000 ORDER BY m.player_id LIMIT 1")->fetchColumn();
$target=$pdo->query("SELECT p.id FROM universe_planets p WHERE p.is_occupied=0 ORDER BY p.id LIMIT 1")->fetchColumn();
if(!$player||!$target){fwrite(STDERR,"SKIP: no exploration fixture\n");exit(0);}
$player=(int)$player;$target=(int)$target;
$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='mothership_explore'")->execute([$player]);
$beforeResource=(int)$pdo->query("SELECT naquadah FROM player_resources WHERE player_id={$player}")->fetchColumn();
$beforeExplorations=(int)$pdo->query("SELECT COUNT(*) FROM planet_explorations WHERE player_id={$player}")->fetchColumn();
$service=new MothershipExplorationService($pdo);
$result=$service->explore($player,$target);
if(($result['state']??'')!=='success')throw new RuntimeException('Expected success state.');
$payloadStmt=$pdo->prepare("SELECT result_json FROM planet_explorations WHERE id=? AND player_id=?");$payloadStmt->execute([(int)$result['exploration_id'],$player]);$payload=json_decode((string)$payloadStmt->fetchColumn(),true,512,JSON_THROW_ON_ERROR);
$expected=(int)round((float)$payload['distance']*(float)$payload['ship_science']*(float)$payload['biome_rarity']);
if((int)$payload['yield']!==$expected)throw new RuntimeException('Yield formula mismatch.');
$afterResource=(int)$pdo->query("SELECT naquadah FROM player_resources WHERE player_id={$player}")->fetchColumn();
if($beforeResource-$afterResource!==(int)$result['cost'])throw new RuntimeException('Resource debit mismatch.');
$afterExplorations=(int)$pdo->query("SELECT COUNT(*) FROM planet_explorations WHERE player_id={$player}")->fetchColumn();
if($afterExplorations!==$beforeExplorations+1)throw new RuntimeException('Exploration persistence mismatch.');
$eventStmt=$pdo->prepare("SELECT COUNT(*) FROM game_events WHERE player_id=? AND event_type='mothership_exploration' AND entity_id=?");$eventStmt->execute([$player,$target]);
if((int)$eventStmt->fetchColumn()<1)throw new RuntimeException('Exploration event missing.');
$cooldownStmt=$pdo->prepare("SELECT available_at FROM player_cooldowns WHERE player_id=? AND cooldown_key='mothership_explore'");$cooldownStmt->execute([$player]);if(!$cooldownStmt->fetchColumn())throw new RuntimeException('Cooldown row missing.');
$cooldownCaught=false;try{$service->explore($player,$target);}catch(Throwable $e){$cooldownCaught=str_contains(strtolower($e->getMessage()),'cooldown');}if(!$cooldownCaught)throw new RuntimeException('Cooldown rejection missing.');
$pdo->beginTransaction();
$pdo->prepare('DELETE FROM game_events WHERE player_id=? AND event_type=? AND entity_id=?')->execute([$player,'mothership_exploration',$target]);
$pdo->prepare('DELETE FROM planet_explorations WHERE id=? AND player_id=?')->execute([(int)$result['exploration_id'],$player]);
$pdo->prepare('UPDATE player_resources SET naquadah=naquadah+? WHERE player_id=?')->execute([(int)$result['cost'],$player]);
$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key='mothership_explore'")->execute([$player]);
$pdo->commit();
echo "PASS: mothership exploration yield, persistence, resource debit, event, and cooldown contract verified\n";

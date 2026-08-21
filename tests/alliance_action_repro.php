<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/AllianceService.php';
$pdo=db();
$playerId=(int)($pdo->query('SELECT id FROM players ORDER BY id LIMIT 1')->fetchColumn() ?: 0);
if($playerId<1)throw new RuntimeException('No player available.');
$pdo->prepare("DELETE FROM player_cooldowns WHERE player_id=? AND cooldown_key IN ('alliance_create','alliance_join')")->execute([$playerId]);
$pdo->prepare('UPDATE players SET alliance_id=NULL WHERE id=?')->execute([$playerId]);
$name='Diagnostic Alliance '.date('His');$tag='D'.date('His');
try{$service=new AllianceService($pdo);$id=$service->create($playerId,$name,$tag,'Temporary diagnostic alliance.');echo "CREATE PASS id=$id\n";$pdo->prepare('DELETE FROM alliance_members WHERE alliance_id=?')->execute([$id]);$pdo->prepare('DELETE FROM alliances WHERE id=?')->execute([$id]);$pdo->prepare('UPDATE players SET alliance_id=NULL WHERE id=?')->execute([$playerId]);}catch(Throwable $e){fwrite(STDERR,'CREATE FAIL: '.$e->getMessage().'\n');exit(1);}

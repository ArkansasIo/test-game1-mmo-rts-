<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { http_response_code(403); exit("CLI only\n"); }
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/services/GameService.php';
$pdo=db(); if(!$pdo) exit("Database unavailable\n");
$players=$pdo->query('SELECT id FROM players ORDER BY id')->fetchAll(); $processed=0;
foreach($players as $player){try{$result=(new GameService($pdo))->processTurns((int)$player['id']); if($result['turns']>0){$processed++;echo 'Player '.$player['id'].': '.$result['turns'].' turns, '.$result['income'].' income'.PHP_EOL;}}catch(Throwable $e){fwrite(STDERR,'Player '.$player['id'].': '.$e->getMessage().PHP_EOL);}}
echo 'Processed '.$processed.' players.'.PHP_EOL;

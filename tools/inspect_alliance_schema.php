<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
foreach(['alliances','alliance_members','players','government_types','player_cooldowns'] as $table){echo "--- $table ---\n";try{foreach($pdo->query('SHOW COLUMNS FROM `'.$table.'`') as $row)echo $row['Field'].' '.$row['Type'].' default='.($row['Default']??'NULL')."\n";}catch(Throwable $e){echo $e->getMessage()."\n";}}

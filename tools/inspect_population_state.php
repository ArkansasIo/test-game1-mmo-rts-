<?php
declare(strict_types=1);
require __DIR__.'/../config/config.php';
$pdo=db();
if(!$pdo){fwrite(STDERR,"Database unavailable\n");exit(1);}
foreach(['players','player_resources','player_colonies','colonies'] as $table){try{$rows=$pdo->query("SELECT * FROM `$table` LIMIT 3")->fetchAll();echo $table.' '.json_encode($rows,JSON_UNESCAPED_SLASHES).PHP_EOL;}catch(Throwable $e){echo $table.' unavailable'.PHP_EOL;}}

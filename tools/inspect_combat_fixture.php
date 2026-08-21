<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$rows=$pdo->query('SELECT p.id,p.username,COUNT(c.id) colony_count,GROUP_CONCAT(c.id ORDER BY c.id) colony_ids FROM players p LEFT JOIN colonies c ON c.player_id=p.id GROUP BY p.id,p.username ORDER BY p.id')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rows,JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES).PHP_EOL;

<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$stmt=$pdo->query("SELECT COLUMN_NAME,COLUMN_TYPE,IS_NULLABLE,COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='battle_rounds' ORDER BY ORDINAL_POSITION");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC),JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES).PHP_EOL;

<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo = db();
$stmt = $pdo->query("SELECT building_class, COUNT(*) AS total FROM building_types WHERE building_class IN ('resource','energy','life_support','civic','industrial','research','defense','shipyard','orbital','logistics') GROUP BY building_class ORDER BY building_class");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
$stmt = $pdo->query("SELECT building_key, building_class FROM building_types WHERE building_class IN ('resource','energy','life_support','civic','industrial','research','defense','shipyard','orbital','logistics') ORDER BY building_key");
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

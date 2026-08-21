<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo = db();
foreach (['building_types','production_tracks','research_nodes'] as $table) {
    echo "--- $table ---\n";
    try {
        foreach ($pdo->query('SHOW COLUMNS FROM `' . $table . '`') as $row) echo $row['Field'] . "\n";
    } catch (Throwable $e) { echo $e->getMessage() . "\n"; }
}

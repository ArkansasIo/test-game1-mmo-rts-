<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$columns = [
    'sabotage_damage' => 'INT UNSIGNED NOT NULL DEFAULT 0',
    'damage_system' => 'VARCHAR(64) NULL',
    'success_probability' => 'DECIMAL(5,4) NULL',
];
foreach ($columns as $column => $definition) {
    $check=$pdo->prepare("SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME='covert_missions' AND COLUMN_NAME=?");
    $check->execute([$column]);
    if (!(int)$check->fetchColumn()) $pdo->exec("ALTER TABLE covert_missions ADD COLUMN `$column` $definition");
}
$pdo->exec("CREATE INDEX IF NOT EXISTS idx_covert_missions_sabotage ON covert_missions (mission_type, sabotage_damage, created_at)");
echo "sabotage_damage_migration=applied\n";

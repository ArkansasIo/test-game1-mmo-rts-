<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

$pdo = db();
$pdo->exec("CREATE TABLE IF NOT EXISTS schema_migrations (id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,migration_key VARCHAR(160) NOT NULL UNIQUE,filename VARCHAR(255) NOT NULL,checksum CHAR(64) NOT NULL,status ENUM('applied','failed') NOT NULL,execution_ms INT UNSIGNED NOT NULL DEFAULT 0,applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,error_message TEXT NULL)");

$checks = [
    '017_weapon_market' => [['table','market_transactions'], ['column','market_orders','weapon_type_id'], ['column','market_orders','expires_at']],
    '018_defense_technology' => [['table','technology_prerequisites']],
    '019_unit_training' => [['table','unit_types'], ['table','training_queues'], ['column','player_unit_stats','academy_level']],
    '020_workforce_assignments' => [['table','population_assignments']],
    '021_super_units' => [['column','unit_types','prerequisite_key'], ['column','unit_types','prerequisite_level'], ['column','unit_types','tier_mastery'], ['column','unit_types','strategic_cost']],
    '022_unit_production' => [['table','production_queues']],
    '023_research_queues' => [['table','research_queues']],
    '024_offense_technology' => [['table','technologies']],
    '025_covert_technology' => [['table','technologies']],
    '026_anti_covert_technology' => [['table','technologies']],
    '027_sabotage_damage' => [['column','covert_missions','sabotage_damage'], ['column','covert_missions','damage_system'], ['column','covert_missions','success_probability']],
    '028_weapon_repair_queue' => [['table','construction_queue']],
    '029_resource_exchange_market' => [['column','market_transactions','resource_type'], ['column','market_transactions','offered_amount'], ['column','market_transactions','settled_amount'], ['column','market_transactions','exchange_rate'], ['column','market_transactions','market_fee']],
    '030_resource_exchange_seed' => [['table','market_orders']],
    '031_ranking_components' => [['column','rankings','technology_score'], ['column','rankings','glory_score'], ['column','rankings','penalty_score'], ['column','rank_snapshots','technology_score'], ['column','rank_snapshots','glory_score'], ['column','rank_snapshots','penalty_score']],
    '032_planet_defense_queue' => [['table','production_queues']],
    '033_mothership_upgrade_queue' => [['table','mothership_upgrade_queue']],
    '034_application_metadata_and_job_audit' => [['table','application_metadata'], ['table','job_run_audit']],
    '035_population_capacity_update' => [['column','player_resources','population_capacity']],
    '036_universe_navigation' => [['table','universe_galaxies'], ['table','universe_sectors'], ['table','universe_solar_systems']],
    '037_schema_migrations' => [['table','schema_migrations']],
];

function objectExists(PDO $pdo, array $check): bool
{
    if ($check[0] === 'table') {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=?");
        $stmt->execute([$check[1]]);
        return (int)$stmt->fetchColumn() === 1;
    }
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=DATABASE() AND TABLE_NAME=? AND COLUMN_NAME=?");
    $stmt->execute([$check[1], $check[2]]);
    return (int)$stmt->fetchColumn() === 1;
}

foreach ($checks as $key => $requirements) {
    $missing = [];
    foreach ($requirements as $check) {
        if (!objectExists($pdo, $check)) {
            $missing[] = implode(':', $check);
        }
    }
    if ($missing) {
        echo "SKIP {$key}: missing " . implode(', ', $missing) . PHP_EOL;
        continue;
    }
    $file = $key . '.sql';
    $path = __DIR__ . '/../sql/' . $file;
    if (!is_file($path)) {
        echo "SKIP {$key}: migration file missing" . PHP_EOL;
        continue;
    }
    $stmt = $pdo->prepare("INSERT INTO schema_migrations(migration_key,filename,checksum,status,execution_ms,error_message) VALUES(?,?,?,'applied',0,NULL) ON DUPLICATE KEY UPDATE filename=VALUES(filename),checksum=VALUES(checksum),status='applied',error_message=NULL");
    $stmt->execute([$key, $file, hash_file('sha256', $path)]);
    echo "BASELINE {$file}" . PHP_EOL;
}

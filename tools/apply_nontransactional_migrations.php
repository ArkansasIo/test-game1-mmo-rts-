<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';

$pdo = db();
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$pdo->exec("CREATE TABLE IF NOT EXISTS schema_migrations (id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,migration_key VARCHAR(160) NOT NULL UNIQUE,filename VARCHAR(255) NOT NULL,checksum CHAR(64) NOT NULL,status ENUM('applied','failed') NOT NULL,execution_ms INT UNSIGNED NOT NULL DEFAULT 0,applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,error_message TEXT NULL)");
foreach (['038_government_commander_units.sql','039_construction_production_research.sql','040_procedural_universe_seed_engine.sql','041_rankings_component_extension.sql','042_mmo_expansion_core.sql','043_design_catalog_and_mechanics.sql','044_deuterium_resource.sql','057_admin_override_tokens.sql','058_sync_empire_limits.sql'] as $file) {
    $path = __DIR__ . '/../sql/' . $file;
    $key = pathinfo($file, PATHINFO_FILENAME);
    $checksum = hash_file('sha256', $path);
    $existing = $pdo->prepare('SELECT status,checksum FROM schema_migrations WHERE migration_key=?');
    $existing->execute([$key]);
    $row = $existing->fetch(PDO::FETCH_ASSOC);
    if ($row && $row['status'] === 'applied' && $row['checksum'] === $checksum) { echo "SKIP $file\n"; continue; }
    $started = microtime(true);
    echo "APPLY $file\n";
    try {
        $pdo->exec((string)file_get_contents($path));
        $ms = (int)round((microtime(true) - $started) * 1000);
        $stmt = $pdo->prepare("INSERT INTO schema_migrations(migration_key,filename,checksum,status,execution_ms,error_message) VALUES(?,?,?,?,?,NULL) ON DUPLICATE KEY UPDATE filename=VALUES(filename),checksum=VALUES(checksum),status='applied',execution_ms=VALUES(execution_ms),applied_at=CURRENT_TIMESTAMP,error_message=NULL");
        $stmt->execute([$key,$file,$checksum,'applied',$ms]);
        echo "DONE $file {$ms}ms\n";
    } catch (Throwable $e) {
        $message = mb_substr($e->getMessage(),0,2000);
        $stmt = $pdo->prepare("INSERT INTO schema_migrations(migration_key,filename,checksum,status,execution_ms,error_message) VALUES(?,?,?,?,?,?) ON DUPLICATE KEY UPDATE filename=VALUES(filename),checksum=VALUES(checksum),status='failed',execution_ms=VALUES(execution_ms),applied_at=CURRENT_TIMESTAMP,error_message=VALUES(error_message)");
        $stmt->execute([$key,$file,$checksum,'failed',(int)round((microtime(true)-$started)*1000),$message]);
        fwrite(STDERR,"FAIL $file: $message\n");
        exit(1);
    }
}

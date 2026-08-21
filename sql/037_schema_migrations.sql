-- Universe Civilization: Empire at Wars migration 037
-- Deployment history and checksum tracking for ordered SQL application.
CREATE TABLE IF NOT EXISTS schema_migrations (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    migration_key VARCHAR(160) NOT NULL UNIQUE,
    filename VARCHAR(255) NOT NULL,
    checksum CHAR(64) NOT NULL,
    status ENUM('applied','failed') NOT NULL,
    execution_ms INT UNSIGNED NOT NULL DEFAULT 0,
    applied_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    error_message TEXT NULL,
    KEY idx_schema_migrations_status (status),
    KEY idx_schema_migrations_applied_at (applied_at)
) ENGINE=InnoDB;

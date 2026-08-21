-- Universe Civilization: Empire at Wars migration 034: application metadata and operational job audit
CREATE TABLE IF NOT EXISTS application_metadata (
  metadata_key VARCHAR(80) PRIMARY KEY,
  metadata_value VARCHAR(255) NOT NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS job_run_audit (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  job_key VARCHAR(80) NOT NULL,
  run_uuid CHAR(36) NOT NULL,
  started_at DATETIME NOT NULL,
  finished_at DATETIME NULL,
  status ENUM('running','success','failed','dry_run','locked') NOT NULL DEFAULT 'running',
  player_count INT UNSIGNED NOT NULL DEFAULT 0,
  turn_count INT UNSIGNED NOT NULL DEFAULT 0,
  error_count INT UNSIGNED NOT NULL DEFAULT 0,
  message VARCHAR(500) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_job_run_uuid (run_uuid),
  KEY idx_job_run_key_time (job_key, started_at)
) ENGINE=InnoDB;

INSERT INTO application_metadata(metadata_key,metadata_value) VALUES
 ('app_version','0.9.0'),
 ('app_build','UCEAW-2026.08.20.01'),
 ('release_channel','development'),
 ('schema_version','034'),
 ('tos_version','2026-08-20')
ON DUPLICATE KEY UPDATE metadata_value=VALUES(metadata_value);

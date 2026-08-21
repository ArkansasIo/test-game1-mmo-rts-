-- Espionage and scanning mechanics.
-- Stores scan authority, deterministic mission seeds, visibility, and classified telemetry.

CREATE TABLE IF NOT EXISTS scan_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  galaxy_number INT UNSIGNED NOT NULL,
  sector_number INT UNSIGNED NOT NULL,
  system_number INT UNSIGNED NOT NULL,
  orbit_number INT UNSIGNED NOT NULL DEFAULT 0,
  entity_key CHAR(64) NULL,
  scan_power INT UNSIGNED NOT NULL DEFAULT 0,
  required_power INT UNSIGNED NOT NULL DEFAULT 0,
  detected TINYINT(1) NOT NULL DEFAULT 0,
  status ENUM('queued','completed','partial','failed') NOT NULL DEFAULT 'completed',
  mission_seed CHAR(64) NOT NULL,
  report_json JSON NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  completed_at DATETIME NULL,
  UNIQUE KEY uq_scan_seed (player_id, mission_seed),
  KEY idx_scan_player_time (player_id, created_at),
  KEY idx_scan_entity_time (entity_key, created_at),
  CONSTRAINT fk_scan_mission_player FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS espionage_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  mission_id BIGINT UNSIGNED NOT NULL,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NULL,
  event_type ENUM('launched','detected','succeeded','failed','reported','sabotage_applied') NOT NULL,
  payload JSON NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_espionage_mission (mission_id, created_at),
  KEY idx_espionage_attacker (attacker_id, created_at),
  CONSTRAINT fk_espionage_event_mission FOREIGN KEY (mission_id) REFERENCES covert_missions(id) ON DELETE CASCADE,
  CONSTRAINT fk_espionage_event_attacker FOREIGN KEY (attacker_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_espionage_event_defender FOREIGN KEY (defender_id) REFERENCES players(id) ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO game_settings (setting_key, setting_value)
VALUES
 ('scan_base_power','3'),
 ('scan_power_per_technology','2'),
 ('scan_base_required_power','2'),
 ('scan_cooldown_seconds','0'),
 ('espionage_seed_version','1')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

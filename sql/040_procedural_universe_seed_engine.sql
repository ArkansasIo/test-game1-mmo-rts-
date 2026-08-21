-- Universe Civilization: Empire at Wars
-- Deterministic No Man's Sky-inspired procedural universe backend.
-- The server owns the seed and persists discoveries/ownership separately from generation.

CREATE TABLE IF NOT EXISTS universe_seed_config (
  id TINYINT UNSIGNED PRIMARY KEY,
  universe_key VARCHAR(80) NOT NULL UNIQUE,
  universe_seed CHAR(64) NOT NULL,
  generator_version VARCHAR(20) NOT NULL DEFAULT '1.0.0',
  galaxy_count INT UNSIGNED NOT NULL DEFAULT 256,
  sectors_per_galaxy INT UNSIGNED NOT NULL DEFAULT 64,
  systems_per_sector INT UNSIGNED NOT NULL DEFAULT 128,
  orbit_slots INT UNSIGNED NOT NULL DEFAULT 12,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS procedural_universe_entities (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  entity_key CHAR(64) NOT NULL UNIQUE,
  parent_key CHAR(64) NULL,
  entity_type ENUM('galaxy','sector','system','planet','moon','station','anomaly') NOT NULL,
  galaxy_number INT UNSIGNED NOT NULL,
  sector_number INT UNSIGNED NOT NULL DEFAULT 0,
  system_number INT UNSIGNED NOT NULL DEFAULT 0,
  orbit_number INT UNSIGNED NOT NULL DEFAULT 0,
  name VARCHAR(140) NOT NULL,
  subtype VARCHAR(80) NOT NULL,
  biome VARCHAR(80) NOT NULL,
  danger_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  habitability DECIMAL(6,3) NOT NULL DEFAULT 0.000,
  resource_profile JSON NOT NULL,
  anomaly_profile JSON NOT NULL,
  traits JSON NOT NULL,
  generated_from_seed CHAR(64) NOT NULL,
  discovered_by_default TINYINT(1) NOT NULL DEFAULT 0,
  generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_procedural_coordinate(entity_type,galaxy_number,sector_number,system_number,orbit_number),
  KEY idx_procedural_parent(parent_key),
  KEY idx_procedural_type(entity_type),
  KEY idx_procedural_galaxy(galaxy_number,sector_number,system_number)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_universe_discoveries (
  player_id INT UNSIGNED NOT NULL,
  entity_key CHAR(64) NOT NULL,
  discovery_type ENUM('scan','exploration','anomaly','trade','combat','colony') NOT NULL DEFAULT 'scan',
  scan_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  report_json JSON NOT NULL,
  discovered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  last_seen_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id,entity_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (entity_key) REFERENCES procedural_universe_entities(entity_key) ON DELETE CASCADE,
  KEY idx_discovery_type(discovery_type,last_seen_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_universe_ownership (
  player_id INT UNSIGNED NOT NULL,
  entity_key CHAR(64) NOT NULL,
  ownership_type ENUM('colony','moon_base','starbase','station','outpost','fleet_anchor') NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  condition_value DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  claimed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id,entity_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (entity_key) REFERENCES procedural_universe_entities(entity_key) ON DELETE CASCADE,
  KEY idx_ownership_type(ownership_type)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_generation_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NULL,
  entity_key CHAR(64) NOT NULL,
  action_key ENUM('generate','scan','explore','claim','anomaly') NOT NULL,
  result_json JSON NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL,
  FOREIGN KEY (entity_key) REFERENCES procedural_universe_entities(entity_key) ON DELETE CASCADE,
  KEY idx_generation_event_player(player_id,created_at), KEY idx_generation_event_entity(entity_key,created_at)
) ENGINE=InnoDB;

INSERT INTO universe_seed_config(id,universe_key,universe_seed,generator_version,galaxy_count,sectors_per_galaxy,systems_per_sector,orbit_slots)
VALUES (1,'uceaw-primary','UCEAW-ORION-EXPANSE-SEASON-ONE-20260820','1.0.0',256,64,128,12)
ON DUPLICATE KEY UPDATE universe_key=VALUES(universe_key),generator_version=VALUES(generator_version),galaxy_count=VALUES(galaxy_count),sectors_per_galaxy=VALUES(sectors_per_galaxy),systems_per_sector=VALUES(systems_per_sector),orbit_slots=VALUES(orbit_slots);

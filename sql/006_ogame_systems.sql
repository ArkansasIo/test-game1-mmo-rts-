USE stargatewars;

CREATE TABLE IF NOT EXISTS game_resource_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  resource_key VARCHAR(40) NOT NULL UNIQUE,
  display_name VARCHAR(80) NOT NULL,
  category ENUM('strategic','life_support','currency') NOT NULL DEFAULT 'strategic',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_resource_balances (
  player_id INT UNSIGNED NOT NULL,
  resource_key VARCHAR(40) NOT NULL,
  amount BIGINT NOT NULL DEFAULT 0,
  capacity BIGINT NOT NULL DEFAULT 0,
  production_per_hour DECIMAL(18,4) NOT NULL DEFAULT 0,
  consumption_per_hour DECIMAL(18,4) NOT NULL DEFAULT 0,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(player_id,resource_key),
  CONSTRAINT fk_prb_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_prb_resource FOREIGN KEY(resource_key) REFERENCES game_resource_types(resource_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS colonies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  name VARCHAR(100) NOT NULL,
  planet_type VARCHAR(60) NOT NULL DEFAULT 'temperate',
  coordinate VARCHAR(30) NOT NULL,
  population BIGINT NOT NULL DEFAULT 100,
  population_capacity BIGINT NOT NULL DEFAULT 1000,
  food_stock BIGINT NOT NULL DEFAULT 1000,
  water_stock BIGINT NOT NULL DEFAULT 1000,
  food_capacity BIGINT NOT NULL DEFAULT 10000,
  water_capacity BIGINT NOT NULL DEFAULT 10000,
  morale DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  is_homeworld TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_colony_coordinate(coordinate),
  KEY idx_colony_player(player_id),
  CONSTRAINT fk_colony_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS building_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  building_key VARCHAR(60) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  category ENUM('resource','life_support','population','defense','shipyard','research') NOT NULL,
  base_metal BIGINT NOT NULL DEFAULT 0,
  base_crystal BIGINT NOT NULL DEFAULT 0,
  base_naquadah BIGINT NOT NULL DEFAULT 0,
  base_food BIGINT NOT NULL DEFAULT 0,
  base_water BIGINT NOT NULL DEFAULT 0,
  growth_factor DECIMAL(8,4) NOT NULL DEFAULT 1.5000,
  build_seconds INT UNSIGNED NOT NULL DEFAULT 60
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS colony_buildings (
  colony_id INT UNSIGNED NOT NULL,
  building_key VARCHAR(60) NOT NULL,
  level INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(colony_id,building_key),
  CONSTRAINT fk_cb_colony FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE CASCADE,
  CONSTRAINT fk_cb_type FOREIGN KEY(building_key) REFERENCES building_types(building_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS research_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  research_key VARCHAR(60) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  category ENUM('economy','energy','combat','defense','covert','navigation') NOT NULL,
  base_metal BIGINT NOT NULL DEFAULT 0,
  base_crystal BIGINT NOT NULL DEFAULT 0,
  base_naquadah BIGINT NOT NULL DEFAULT 0,
  growth_factor DECIMAL(8,4) NOT NULL DEFAULT 1.7500,
  research_seconds INT UNSIGNED NOT NULL DEFAULT 120
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_research (
  player_id INT UNSIGNED NOT NULL,
  research_key VARCHAR(60) NOT NULL,
  level INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(player_id,research_key),
  CONSTRAINT fk_pr_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_pr_type FOREIGN KEY(research_key) REFERENCES research_types(research_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fleet_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  fleet_key VARCHAR(60) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  attack_power BIGINT NOT NULL DEFAULT 0,
  defense_power BIGINT NOT NULL DEFAULT 0,
  cargo_capacity BIGINT NOT NULL DEFAULT 0,
  speed DECIMAL(10,3) NOT NULL DEFAULT 1,
  fuel_per_hour DECIMAL(12,4) NOT NULL DEFAULT 0,
  base_metal BIGINT NOT NULL DEFAULT 0,
  base_crystal BIGINT NOT NULL DEFAULT 0,
  base_naquadah BIGINT NOT NULL DEFAULT 0,
  build_seconds INT UNSIGNED NOT NULL DEFAULT 60
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS colony_fleets (
  colony_id INT UNSIGNED NOT NULL,
  fleet_key VARCHAR(60) NOT NULL,
  quantity BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY(colony_id,fleet_key),
  CONSTRAINT fk_cf_colony FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE CASCADE,
  CONSTRAINT fk_cf_type FOREIGN KEY(fleet_key) REFERENCES fleet_types(fleet_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS defense_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  defense_key VARCHAR(60) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  attack_power BIGINT NOT NULL DEFAULT 0,
  defense_power BIGINT NOT NULL DEFAULT 0,
  base_metal BIGINT NOT NULL DEFAULT 0,
  base_crystal BIGINT NOT NULL DEFAULT 0,
  base_naquadah BIGINT NOT NULL DEFAULT 0
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS colony_defenses (
  colony_id INT UNSIGNED NOT NULL,
  defense_key VARCHAR(60) NOT NULL,
  quantity BIGINT NOT NULL DEFAULT 0,
  PRIMARY KEY(colony_id,defense_key),
  CONSTRAINT fk_cd_colony FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE CASCADE,
  CONSTRAINT fk_cd_type FOREIGN KEY(defense_key) REFERENCES defense_types(defense_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS construction_queue (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  colony_id INT UNSIGNED NULL,
  queue_type ENUM('building','research','fleet','defense','ship') NOT NULL,
  item_key VARCHAR(80) NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 1,
  level_before INT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','processing','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_queue_due(status,completes_at),
  CONSTRAINT fk_queue_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_queue_colony FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fleet_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  source_colony_id INT UNSIGNED NOT NULL,
  target_colony_id INT UNSIGNED NULL,
  mission_type ENUM('transport','attack','raid','espionage','colonize','recycle','explore','return') NOT NULL,
  payload JSON NOT NULL,
  departure_at DATETIME NOT NULL,
  arrival_at DATETIME NOT NULL,
  return_at DATETIME NULL,
  status ENUM('scheduled','outbound','arrived','returning','completed','failed','cancelled') NOT NULL DEFAULT 'scheduled',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_mission_due(status,arrival_at),
  CONSTRAINT fk_mission_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_mission_source FOREIGN KEY(source_colony_id) REFERENCES colonies(id) ON DELETE CASCADE,
  CONSTRAINT fk_mission_target FOREIGN KEY(target_colony_id) REFERENCES colonies(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS game_world_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  event_type VARCHAR(60) NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  payload JSON NULL,
  starts_at DATETIME NOT NULL,
  ends_at DATETIME NOT NULL,
  status ENUM('scheduled','active','ended') NOT NULL DEFAULT 'scheduled',
  KEY idx_world_event_status(status,starts_at,ends_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS colony_turn_snapshots (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  colony_id INT UNSIGNED NOT NULL,
  processed_at DATETIME NOT NULL,
  elapsed_seconds INT UNSIGNED NOT NULL,
  food_before BIGINT NOT NULL,
  food_after BIGINT NOT NULL,
  water_before BIGINT NOT NULL,
  water_after BIGINT NOT NULL,
  population_before BIGINT NOT NULL,
  population_after BIGINT NOT NULL,
  payload JSON NULL,
  KEY idx_snapshot_colony(colony_id,processed_at),
  CONSTRAINT fk_snapshot_colony FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

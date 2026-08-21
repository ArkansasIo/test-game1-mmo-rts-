-- UCEAW MMO expansion core: fleet operations, asynchronous progression, events, and endgame foundations.
CREATE TABLE IF NOT EXISTS expedition_reports (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  mission_id BIGINT UNSIGNED NULL,
  coordinate VARCHAR(80) NOT NULL,
  outcome ENUM('positive','neutral','negative','discovery','combat','empty') NOT NULL,
  reward_payload JSON NULL,
  risk_score DECIMAL(8,3) NOT NULL DEFAULT 0,
  resolved_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (mission_id) REFERENCES fleet_missions(id) ON DELETE SET NULL,
  KEY idx_expedition_player_time(player_id,resolved_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS fleet_mission_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  mission_id BIGINT UNSIGNED NOT NULL,
  event_type VARCHAR(50) NOT NULL,
  payload JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (mission_id) REFERENCES fleet_missions(id) ON DELETE CASCADE,
  KEY idx_fleet_event_mission(mission_id,created_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS debris_fields (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  coordinate VARCHAR(80) NOT NULL UNIQUE,
  metal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah BIGINT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  expires_at DATETIME NULL,
  KEY idx_debris_expiry(expires_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS quest_definitions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  quest_key VARCHAR(80) NOT NULL UNIQUE,
  category ENUM('tutorial','daily','weekly','empire','military','research','exploration','alliance','seasonal') NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  objective_key VARCHAR(80) NOT NULL,
  objective_target BIGINT UNSIGNED NOT NULL DEFAULT 1,
  reward_payload JSON NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_quests (
  player_id INT UNSIGNED NOT NULL,
  quest_id INT UNSIGNED NOT NULL,
  progress BIGINT UNSIGNED NOT NULL DEFAULT 0,
  state ENUM('available','active','completed','claimed','expired') NOT NULL DEFAULT 'available',
  started_at DATETIME NULL,
  completed_at DATETIME NULL,
  claimed_at DATETIME NULL,
  PRIMARY KEY(player_id,quest_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (quest_id) REFERENCES quest_definitions(id) ON DELETE CASCADE,
  KEY idx_player_quest_state(player_id,state)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS achievement_definitions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  achievement_key VARCHAR(80) NOT NULL UNIQUE,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  metric_key VARCHAR(80) NOT NULL,
  metric_target BIGINT UNSIGNED NOT NULL DEFAULT 1,
  reward_payload JSON NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_achievements (
  player_id INT UNSIGNED NOT NULL,
  achievement_id INT UNSIGNED NOT NULL,
  progress BIGINT UNSIGNED NOT NULL DEFAULT 0,
  unlocked_at DATETIME NULL,
  claimed_at DATETIME NULL,
  PRIMARY KEY(player_id,achievement_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (achievement_id) REFERENCES achievement_definitions(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS officer_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  officer_key VARCHAR(60) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  effect_key VARCHAR(80) NOT NULL,
  effect_value DECIMAL(10,4) NOT NULL DEFAULT 0,
  upkeep_dark_matter BIGINT UNSIGNED NOT NULL DEFAULT 0,
  max_level TINYINT UNSIGNED NOT NULL DEFAULT 10,
  description TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_officers (
  player_id INT UNSIGNED NOT NULL,
  officer_type_id INT UNSIGNED NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  expires_at DATETIME NULL,
  PRIMARY KEY(player_id,officer_type_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (officer_type_id) REFERENCES officer_types(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS world_seasons (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  season_key VARCHAR(60) NOT NULL UNIQUE,
  title VARCHAR(150) NOT NULL,
  starts_at DATETIME NOT NULL,
  ends_at DATETIME NOT NULL,
  status ENUM('scheduled','active','ended') NOT NULL DEFAULT 'scheduled',
  rules_payload JSON NOT NULL,
  KEY idx_season_status(status,starts_at,ends_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS npc_civilizations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  civilization_key VARCHAR(80) NOT NULL UNIQUE,
  name VARCHAR(150) NOT NULL,
  race_key VARCHAR(60) NOT NULL,
  government_key VARCHAR(60) NULL,
  home_coordinate VARCHAR(80) NOT NULL,
  military_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  economy_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  diplomacy_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  status ENUM('neutral','friendly','hostile','ancient','destroyed') NOT NULL DEFAULT 'neutral',
  payload JSON NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS planet_stability (
  colony_id INT UNSIGNED PRIMARY KEY,
  happiness DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  pollution DECIMAL(8,3) NOT NULL DEFAULT 0,
  approval DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  unrest DECIMAL(8,3) NOT NULL DEFAULT 0,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (colony_id) REFERENCES colonies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS megastructures (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  structure_key VARCHAR(80) NOT NULL,
  coordinate VARCHAR(80) NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  condition_value DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  status ENUM('planned','building','active','damaged','destroyed') NOT NULL DEFAULT 'planned',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  UNIQUE KEY uq_player_structure_coordinate(player_id,structure_key,coordinate)
) ENGINE=InnoDB;

INSERT INTO quest_definitions(quest_key,category,title,description,objective_key,objective_target,reward_payload)
VALUES
('tutorial_first_upgrade','tutorial','First Upgrade','Complete your first construction upgrade.','building_upgrade',1,'{"naquadah":5000,"glory":10}'),
('daily_scan','daily','Survey the Frontier','Scan a seeded universe coordinate.','universe_scan',1,'{"research_data":25,"glory":5}'),
('weekly_expedition','weekly','Into the Deep','Resolve an expedition report.','expedition_resolved',3,'{"dark_matter":50,"glory":25}')
ON DUPLICATE KEY UPDATE title=VALUES(title),description=VALUES(description),reward_payload=VALUES(reward_payload);

INSERT INTO achievement_definitions(achievement_key,title,description,metric_key,metric_target,reward_payload)
VALUES
('first_colony','First Colony','Establish your first colony.','colonies_owned',1,'{"glory":25}'),
('fleet_commander','Fleet Commander','Launch ten fleet missions.','fleet_missions_launched',10,'{"glory":50,"dark_matter":25}'),
('deep_explorer','Deep Explorer','Resolve twenty exploration reports.','expeditions_resolved',20,'{"glory":100,"research_data":100}')
ON DUPLICATE KEY UPDATE title=VALUES(title),description=VALUES(description),reward_payload=VALUES(reward_payload);

INSERT INTO officer_types(officer_key,display_name,effect_key,effect_value,description)
VALUES
('administrator','Administrator','production_modifier',0.05,'Improves empire-wide production.'),
('engineer','Chief Engineer','construction_speed',0.05,'Reduces construction completion time.'),
('scientist','Lead Scientist','research_speed',0.05,'Improves research queue speed.'),
('commander','Fleet Commander','fleet_attack',0.05,'Improves fleet attack power.'),
('spy_master','Spy Master','covert_power',0.05,'Improves covert operation effectiveness.')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),effect_value=VALUES(effect_value),description=VALUES(description);

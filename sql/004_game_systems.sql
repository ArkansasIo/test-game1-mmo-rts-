USE stargatewars;

CREATE TABLE IF NOT EXISTS game_settings (
  setting_key VARCHAR(80) PRIMARY KEY,
  setting_value VARCHAR(255) NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
INSERT INTO game_settings (setting_key,setting_value) VALUES
('turn_interval_seconds','1800'),('turn_generation_threshold','4000'),('turn_max_storage','10000'),
('natural_income_untrained','20'),('natural_income_miner','80'),('max_defcon','4')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

ALTER TABLE players
  ADD COLUMN IF NOT EXISTS glory INT NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS reputation INT NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS defcon_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS last_turn_at DATETIME NULL,
  ADD COLUMN IF NOT EXISTS protected_until DATETIME NULL,
  ADD COLUMN IF NOT EXISTS vacation_until DATETIME NULL,
  ADD COLUMN IF NOT EXISTS ascension_count INT UNSIGNED NOT NULL DEFAULT 0;

CREATE TABLE IF NOT EXISTS player_unit_stats (
  player_id INT UNSIGNED PRIMARY KEY,
  super_attack_units INT UNSIGNED NOT NULL DEFAULT 0,
  super_defense_units INT UNSIGNED NOT NULL DEFAULT 0,
  covert_level INT UNSIGNED NOT NULL DEFAULT 1,
  anti_covert_level INT UNSIGNED NOT NULL DEFAULT 1,
  attack_power INT UNSIGNED NOT NULL DEFAULT 0,
  defense_power INT UNSIGNED NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS weapon_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE,
  category ENUM('attack','defense','super_attack','super_defense','mothership') NOT NULL,
  power INT UNSIGNED NOT NULL,
  price BIGINT UNSIGNED NOT NULL,
  max_durability INT UNSIGNED NOT NULL DEFAULT 100
);
CREATE TABLE IF NOT EXISTS player_weapons (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  weapon_type_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 0,
  durability INT UNSIGNED NOT NULL DEFAULT 100,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (weapon_type_id) REFERENCES weapon_types(id),
  UNIQUE KEY player_weapon (player_id,weapon_type_id)
);

CREATE TABLE IF NOT EXISTS technologies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  technology_key VARCHAR(80) NOT NULL UNIQUE,
  name VARCHAR(120) NOT NULL,
  category ENUM('offense','defense','covert','anti_covert','unique','mercenary') NOT NULL,
  base_cost BIGINT UNSIGNED NOT NULL,
  cost_growth DECIMAL(8,2) NOT NULL DEFAULT 1.5,
  effect_value DECIMAL(8,2) NOT NULL DEFAULT 5
);
ALTER TABLE player_technologies ADD COLUMN IF NOT EXISTS technology_id INT UNSIGNED NULL;

CREATE TABLE IF NOT EXISTS motherships (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL DEFAULT 'Unnamed Vessel',
  hull_level INT UNSIGNED NOT NULL DEFAULT 1,
  volley_bays INT UNSIGNED NOT NULL DEFAULT 0,
  shield_bays INT UNSIGNED NOT NULL DEFAULT 0,
  fleet_hangars INT UNSIGNED NOT NULL DEFAULT 0,
  weapons_power INT UNSIGNED NOT NULL DEFAULT 0,
  shields_power INT UNSIGNED NOT NULL DEFAULT 0,
  exploration_level INT UNSIGNED NOT NULL DEFAULT 1,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS planet_defenses (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  planet_id INT UNSIGNED NOT NULL,
  defense_type VARCHAR(80) NOT NULL,
  level INT UNSIGNED NOT NULL DEFAULT 1,
  strength INT UNSIGNED NOT NULL DEFAULT 100,
  FOREIGN KEY (planet_id) REFERENCES player_planets(id) ON DELETE CASCADE,
  UNIQUE KEY planet_defense (planet_id,defense_type)
);

CREATE TABLE IF NOT EXISTS battles (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NOT NULL,
  action_type ENUM('attack','raid','planet_conquest','mothership') NOT NULL,
  turns_spent INT UNSIGNED NOT NULL,
  attacker_score INT UNSIGNED NOT NULL DEFAULT 0,
  defender_score INT UNSIGNED NOT NULL DEFAULT 0,
  winner_id INT UNSIGNED NULL,
  loot BIGINT UNSIGNED NOT NULL DEFAULT 0,
  attacker_casualties INT UNSIGNED NOT NULL DEFAULT 0,
  defender_casualties INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (attacker_id) REFERENCES players(id), FOREIGN KEY (defender_id) REFERENCES players(id), FOREIGN KEY (winner_id) REFERENCES players(id),
  INDEX battle_attacker (attacker_id,created_at), INDEX battle_defender (defender_id,created_at)
);
CREATE TABLE IF NOT EXISTS battle_reports (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  battle_id BIGINT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,
  report_text TEXT NOT NULL,
  seen_at DATETIME NULL,
  FOREIGN KEY (battle_id) REFERENCES battles(id) ON DELETE CASCADE,
  FOREIGN KEY (recipient_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS covert_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NOT NULL,
  mission_type ENUM('recon','spy','sabotage') NOT NULL,
  agents_sent INT UNSIGNED NOT NULL,
  success TINYINT(1) NOT NULL DEFAULT 0,
  detected TINYINT(1) NOT NULL DEFAULT 0,
  result_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (attacker_id) REFERENCES players(id), FOREIGN KEY (defender_id) REFERENCES players(id),
  INDEX covert_attacker (attacker_id,created_at), INDEX covert_defender (defender_id,created_at)
);
CREATE TABLE IF NOT EXISTS intelligence_reports (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  target_player_id INT UNSIGNED NOT NULL,
  report_type VARCHAR(40) NOT NULL,
  payload JSON NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (target_player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS alliances (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE,
  tag VARCHAR(12) NOT NULL UNIQUE,
  founder_id INT UNSIGNED NOT NULL,
  description TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (founder_id) REFERENCES players(id)
);
CREATE TABLE IF NOT EXISTS alliance_members (
  alliance_id INT UNSIGNED NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  role ENUM('leader','officer','member') NOT NULL DEFAULT 'member',
  joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (alliance_id,player_id), FOREIGN KEY (alliance_id) REFERENCES alliances(id) ON DELETE CASCADE, FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS messages (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sender_id INT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,
  subject VARCHAR(160) NOT NULL,
  body TEXT NOT NULL,
  read_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES players(id), FOREIGN KEY (recipient_id) REFERENCES players(id), INDEX inbox (recipient_id,read_at,created_at)
);

CREATE TABLE IF NOT EXISTS market_orders (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  seller_id INT UNSIGNED NOT NULL,
  resource_type ENUM('naquadah','mercenary','weapon') NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  unit_price BIGINT UNSIGNED NOT NULL,
  status ENUM('open','filled','cancelled') NOT NULL DEFAULT 'open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (seller_id) REFERENCES players(id), INDEX open_orders (resource_type,status,created_at)
);
CREATE TABLE IF NOT EXISTS mercenary_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE,
  attack_power INT UNSIGNED NOT NULL,
  defense_power INT UNSIGNED NOT NULL,
  price BIGINT UNSIGNED NOT NULL
);
CREATE TABLE IF NOT EXISTS player_mercenaries (
  player_id INT UNSIGNED NOT NULL,
  mercenary_type_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (player_id,mercenary_type_id), FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE, FOREIGN KEY (mercenary_type_id) REFERENCES mercenary_types(id)
);

CREATE TABLE IF NOT EXISTS rankings (
  player_id INT UNSIGNED PRIMARY KEY,
  overall_score BIGINT NOT NULL DEFAULT 0,
  military_score BIGINT NOT NULL DEFAULT 0,
  economy_score BIGINT NOT NULL DEFAULT 0,
  covert_score BIGINT NOT NULL DEFAULT 0,
  rank_position INT UNSIGNED NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS ascensions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  ascended_race VARCHAR(80) NOT NULL,
  glory_spent INT UNSIGNED NOT NULL,
  reputation_spent INT UNSIGNED NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS protection_states (
  player_id INT UNSIGNED PRIMARY KEY,
  ppt_until DATETIME NULL,
  vacation_until DATETIME NULL,
  attack_cooldown_until DATETIME NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS game_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NULL,
  event_type VARCHAR(60) NOT NULL,
  entity_type VARCHAR(60) NULL,
  entity_id BIGINT UNSIGNED NULL,
  payload JSON NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL,
  INDEX event_player (player_id,created_at), INDEX event_type (event_type,created_at)
);

INSERT INTO weapon_types (name,category,power,price,max_durability,description) VALUES
('Standard Strike Weapon','attack',5,1000,100,'Reliable baseline offensive weapon.'),('Standard Defense Weapon','defense',5,1000,100,'Reliable baseline defensive weapon.'),('Super Strike Weapon','super_attack',10,5000,100,'Enhanced offensive weapon for elite units.'),('Super Defense Weapon','super_defense',10,5000,100,'Enhanced defensive weapon for elite units.')
ON DUPLICATE KEY UPDATE power=VALUES(power),price=VALUES(price),description=VALUES(description);
INSERT INTO technologies (technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES
('siege','Siege Systems','offense',10000,1.5,5,'Improves offensive fleet and weapon performance.'),('fortification','Fortification','defense',10000,1.5,5,'Improves planetary defense and damage mitigation.'),('infiltration','Infiltration','covert',10000,1.5,5,'Improves spying and sabotage success.'),('detection','Detection Grid','anti_covert',10000,1.5,5,'Improves detection and resistance against covert actions.'),('mercenary','Mercenary Capacity','mercenary',15000,1.5,5,'Improves mercenary recruitment capacity.')
ON DUPLICATE KEY UPDATE name=VALUES(name),effect_value=VALUES(effect_value),description=VALUES(description);
INSERT INTO mercenary_types (name,attack_power,defense_power,price) VALUES ('Jaffa Contract',8,4,2500),('Defense Drone Contract',3,8,2500),('Elite Operative Contract',6,6,4000)
ON DUPLICATE KEY UPDATE price=VALUES(price);
INSERT INTO player_unit_stats (player_id) SELECT id FROM players WHERE NOT EXISTS (SELECT 1 FROM player_unit_stats s WHERE s.player_id=players.id);
INSERT INTO motherships (player_id,name) SELECT id,CONCAT(display_name,' Mothership') FROM players WHERE NOT EXISTS (SELECT 1 FROM motherships m WHERE m.player_id=players.id);
INSERT INTO protection_states (player_id) SELECT id FROM players WHERE NOT EXISTS (SELECT 1 FROM protection_states s WHERE s.player_id=players.id);
INSERT INTO rankings (player_id) SELECT id FROM players WHERE NOT EXISTS (SELECT 1 FROM rankings r WHERE r.player_id=players.id);

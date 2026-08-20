CREATE DATABASE IF NOT EXISTS stargatewars CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE stargatewars;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS races (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE,
  bonus_label VARCHAR(120) NOT NULL,
  bonus_percent DECIMAL(5,2) NOT NULL DEFAULT 25.00,
  bank_name VARCHAR(100) NOT NULL,
  attack_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  defense_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  income_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  covert_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000
);

CREATE TABLE IF NOT EXISTS players (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  email VARCHAR(190) NULL UNIQUE,
  race_id INT UNSIGNED NOT NULL,
  ascended_race VARCHAR(80) NULL,
  title VARCHAR(100) NOT NULL DEFAULT 'Initiate',
  rank_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  rank_name VARCHAR(50) NOT NULL DEFAULT 'Initiate',
  glory BIGINT UNSIGNED NOT NULL DEFAULT 0,
  reputation BIGINT NOT NULL DEFAULT 0,
  defcon_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  commander_id INT UNSIGNED NULL,
  alliance_id INT UNSIGNED NULL,
  last_turn_at DATETIME NULL,
  protected_until DATETIME NULL,
  vacation_until DATETIME NULL,
  last_login_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (race_id) REFERENCES races(id),
  FOREIGN KEY (commander_id) REFERENCES players(id) ON DELETE SET NULL,
  INDEX player_rank (rank_level,glory,reputation)
);

CREATE TABLE IF NOT EXISTS player_resources (
  player_id INT UNSIGNED PRIMARY KEY,
  naquadah BIGINT UNSIGNED NOT NULL DEFAULT 125000,
  banked_naquadah BIGINT UNSIGNED NOT NULL DEFAULT 500000,
  attack_turns INT UNSIGNED NOT NULL DEFAULT 48,
  market_turns INT UNSIGNED NOT NULL DEFAULT 3,
  untrained_units INT UNSIGNED NOT NULL DEFAULT 1600,
  unit_production INT UNSIGNED NOT NULL DEFAULT 12,
  miners INT UNSIGNED NOT NULL DEFAULT 120,
  lifers INT UNSIGNED NOT NULL DEFAULT 12,
  attack_units INT UNSIGNED NOT NULL DEFAULT 850,
  super_attack_units INT UNSIGNED NOT NULL DEFAULT 0,
  defense_units INT UNSIGNED NOT NULL DEFAULT 1200,
  super_defense_units INT UNSIGNED NOT NULL DEFAULT 0,
  spies INT UNSIGNED NOT NULL DEFAULT 160,
  anti_spies INT UNSIGNED NOT NULL DEFAULT 140,
  covert_capacity INT UNSIGNED NOT NULL DEFAULT 160,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS player_unit_stats (
  player_id INT UNSIGNED PRIMARY KEY,
  covert_level INT UNSIGNED NOT NULL DEFAULT 1,
  anti_covert_level INT UNSIGNED NOT NULL DEFAULT 1,
  attack_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  defense_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  covert_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  anti_covert_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS menu_items (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  parent_id INT UNSIGNED NULL,
  label VARCHAR(80) NOT NULL,
  route VARCHAR(100) NOT NULL UNIQUE,
  icon VARCHAR(10) DEFAULT '•',
  sort_order INT NOT NULL DEFAULT 0,
  FOREIGN KEY (parent_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS page_content (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  route VARCHAR(100) NOT NULL UNIQUE,
  title VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  minimum_rank_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  body_json JSON NULL
);

CREATE TABLE IF NOT EXISTS rank_definitions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rank_level TINYINT UNSIGNED NOT NULL UNIQUE,
  name VARCHAR(50) NOT NULL UNIQUE,
  minimum_glory BIGINT UNSIGNED NOT NULL DEFAULT 0,
  minimum_reputation BIGINT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS game_settings (
  setting_key VARCHAR(80) PRIMARY KEY,
  setting_value VARCHAR(255) NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS player_technologies (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  technology_id INT UNSIGNED NULL,
  technology_key VARCHAR(80) NOT NULL,
  technology_name VARCHAR(120) NOT NULL,
  category VARCHAR(40) NOT NULL,
  level INT UNSIGNED NOT NULL DEFAULT 0,
  next_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY player_technology (player_id,technology_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS technologies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  technology_key VARCHAR(80) NOT NULL UNIQUE,
  name VARCHAR(120) NOT NULL,
  category ENUM('offense','defense','covert','anti_covert','unique','mercenary') NOT NULL,
  base_cost BIGINT UNSIGNED NOT NULL,
  cost_growth DECIMAL(8,2) NOT NULL DEFAULT 1.50,
  effect_value DECIMAL(8,2) NOT NULL DEFAULT 5.00,
  description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS weapon_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE,
  category ENUM('attack','defense','super_attack','super_defense','mothership') NOT NULL,
  power INT UNSIGNED NOT NULL,
  price BIGINT UNSIGNED NOT NULL,
  max_durability INT UNSIGNED NOT NULL DEFAULT 100,
  description TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS player_weapons (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  weapon_type_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 0,
  durability INT UNSIGNED NOT NULL DEFAULT 100,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (weapon_type_id) REFERENCES weapon_types(id),
  UNIQUE KEY player_weapon (player_id,weapon_type_id)
);

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
  action_level INT UNSIGNED NOT NULL DEFAULT 1,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS mothership_modules (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  mothership_id INT UNSIGNED NOT NULL,
  module_key VARCHAR(80) NOT NULL,
  level INT UNSIGNED NOT NULL DEFAULT 1,
  durability INT UNSIGNED NOT NULL DEFAULT 100,
  FOREIGN KEY (mothership_id) REFERENCES motherships(id) ON DELETE CASCADE,
  UNIQUE KEY mothership_module (mothership_id,module_key)
);

CREATE TABLE IF NOT EXISTS player_planets (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  name VARCHAR(100) NOT NULL,
  planet_type VARCHAR(60) NOT NULL DEFAULT 'Balanced',
  size_label ENUM('Tiny','Small','Medium','Large','Huge') NOT NULL DEFAULT 'Medium',
  size_level INT UNSIGNED NOT NULL DEFAULT 1,
  attack_bonus DECIMAL(6,2) NOT NULL DEFAULT 0,
  defense_bonus DECIMAL(6,2) NOT NULL DEFAULT 0,
  income_bonus DECIMAL(6,2) NOT NULL DEFAULT 5,
  covert_bonus DECIMAL(6,2) NOT NULL DEFAULT 0,
  owner_since DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  conquered_from INT UNSIGNED NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (conquered_from) REFERENCES players(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS planet_bonuses (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  planet_id INT UNSIGNED NOT NULL,
  bonus_type ENUM('attack','defense','income','covert','production','mothership') NOT NULL,
  bonus_percent DECIMAL(6,2) NOT NULL DEFAULT 0,
  level INT UNSIGNED NOT NULL DEFAULT 1,
  FOREIGN KEY (planet_id) REFERENCES player_planets(id) ON DELETE CASCADE,
  UNIQUE KEY planet_bonus (planet_id,bonus_type)
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
  PRIMARY KEY (alliance_id,player_id),
  FOREIGN KEY (alliance_id) REFERENCES alliances(id) ON DELETE CASCADE,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS commander_relationships (
  commander_id INT UNSIGNED NOT NULL,
  officer_id INT UNSIGNED NOT NULL,
  income_share_percent DECIMAL(5,2) NOT NULL DEFAULT 10,
  unit_production_bonus DECIMAL(5,2) NOT NULL DEFAULT 0,
  status ENUM('pending','active','ended') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (commander_id,officer_id),
  FOREIGN KEY (commander_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (officer_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS officer_relationships (
  officer_id INT UNSIGNED NOT NULL,
  commander_id INT UNSIGNED NOT NULL,
  relationship_type VARCHAR(40) NOT NULL DEFAULT 'officer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (officer_id,commander_id),
  FOREIGN KEY (officer_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (commander_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS recruitment_records (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  commander_id INT UNSIGNED NOT NULL,
  recruit_id INT UNSIGNED NOT NULL,
  status ENUM('invited','accepted','rejected','cancelled') NOT NULL DEFAULT 'invited',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (commander_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (recruit_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS battles (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  battle_seed CHAR(64) NULL,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NOT NULL,
  action_type ENUM('attack','raid','planet_conquest','mothership') NOT NULL,
  turns_spent INT UNSIGNED NOT NULL,
  attacker_score BIGINT UNSIGNED NOT NULL DEFAULT 0,
  defender_score BIGINT UNSIGNED NOT NULL DEFAULT 0,
  winner_id INT UNSIGNED NULL,
  loot BIGINT UNSIGNED NOT NULL DEFAULT 0,
  attacker_casualties INT UNSIGNED NOT NULL DEFAULT 0,
  defender_casualties INT UNSIGNED NOT NULL DEFAULT 0,
  weapon_damage JSON NULL,
  world_snapshot JSON NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (attacker_id) REFERENCES players(id),
  FOREIGN KEY (defender_id) REFERENCES players(id),
  FOREIGN KEY (winner_id) REFERENCES players(id),
  INDEX battle_attacker (attacker_id,created_at),
  INDEX battle_defender (defender_id,created_at)
);

CREATE TABLE IF NOT EXISTS battle_participants (
  battle_id BIGINT UNSIGNED NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  side ENUM('attacker','defender') NOT NULL,
  units_sent JSON NOT NULL,
  units_lost JSON NOT NULL,
  PRIMARY KEY (battle_id,player_id),
  FOREIGN KEY (battle_id) REFERENCES battles(id) ON DELETE CASCADE,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS battle_reports (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  battle_id BIGINT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,
  report_text TEXT NOT NULL,
  report_json JSON NULL,
  seen_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (battle_id) REFERENCES battles(id) ON DELETE CASCADE,
  FOREIGN KEY (recipient_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS attack_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  battle_id BIGINT UNSIGNED NOT NULL,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NOT NULL,
  action_type VARCHAR(40) NOT NULL,
  result VARCHAR(40) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (battle_id) REFERENCES battles(id) ON DELETE CASCADE,
  FOREIGN KEY (attacker_id) REFERENCES players(id),
  FOREIGN KEY (defender_id) REFERENCES players(id)
);

CREATE TABLE IF NOT EXISTS covert_agents (
  player_id INT UNSIGNED PRIMARY KEY,
  count INT UNSIGNED NOT NULL DEFAULT 0,
  level INT UNSIGNED NOT NULL DEFAULT 1,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS anti_covert_agents (
  player_id INT UNSIGNED PRIMARY KEY,
  count INT UNSIGNED NOT NULL DEFAULT 0,
  level INT UNSIGNED NOT NULL DEFAULT 1,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS spy_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NOT NULL,
  mission_type ENUM('recon','spy') NOT NULL,
  agents_sent INT UNSIGNED NOT NULL,
  success TINYINT(1) NOT NULL DEFAULT 0,
  detected TINYINT(1) NOT NULL DEFAULT 0,
  agent_losses INT UNSIGNED NOT NULL DEFAULT 0,
  result_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (attacker_id) REFERENCES players(id),
  FOREIGN KEY (defender_id) REFERENCES players(id)
);

CREATE TABLE IF NOT EXISTS sabotage_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  attacker_id INT UNSIGNED NOT NULL,
  defender_id INT UNSIGNED NOT NULL,
  target_system VARCHAR(80) NOT NULL,
  agents_sent INT UNSIGNED NOT NULL,
  success TINYINT(1) NOT NULL DEFAULT 0,
  detected TINYINT(1) NOT NULL DEFAULT 0,
  damage_value BIGINT UNSIGNED NOT NULL DEFAULT 0,
  result_text TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (attacker_id) REFERENCES players(id),
  FOREIGN KEY (defender_id) REFERENCES players(id)
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
  FOREIGN KEY (attacker_id) REFERENCES players(id),
  FOREIGN KEY (defender_id) REFERENCES players(id)
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

CREATE TABLE IF NOT EXISTS market_orders (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  seller_id INT UNSIGNED NOT NULL,
  resource_type ENUM('naquadah','mercenary','weapon') NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  unit_price BIGINT UNSIGNED NOT NULL,
  status ENUM('open','filled','cancelled') NOT NULL DEFAULT 'open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (seller_id) REFERENCES players(id),
  INDEX open_orders (resource_type,status,created_at)
);

CREATE TABLE IF NOT EXISTS private_trades (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sender_id INT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,
  offer_json JSON NOT NULL,
  status ENUM('pending','accepted','rejected','cancelled','expired') NOT NULL DEFAULT 'pending',
  expires_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES players(id),
  FOREIGN KEY (recipient_id) REFERENCES players(id)
);

CREATE TABLE IF NOT EXISTS mercenary_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL UNIQUE,
  attack_power INT UNSIGNED NOT NULL,
  defense_power INT UNSIGNED NOT NULL,
  price BIGINT UNSIGNED NOT NULL,
  capacity_cost INT UNSIGNED NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS player_mercenaries (
  player_id INT UNSIGNED NOT NULL,
  mercenary_type_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (player_id,mercenary_type_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (mercenary_type_id) REFERENCES mercenary_types(id)
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

CREATE TABLE IF NOT EXISTS rank_snapshots (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  snapshot_date DATE NOT NULL,
  overall_score BIGINT NOT NULL DEFAULT 0,
  military_score BIGINT NOT NULL DEFAULT 0,
  economy_score BIGINT NOT NULL DEFAULT 0,
  covert_score BIGINT NOT NULL DEFAULT 0,
  rank_position INT UNSIGNED NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  UNIQUE KEY player_rank_day (player_id,snapshot_date)
);

CREATE TABLE IF NOT EXISTS glory_reputation (
  player_id INT UNSIGNED PRIMARY KEY,
  glory BIGINT UNSIGNED NOT NULL DEFAULT 0,
  reputation BIGINT NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ascensions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  ascended_race VARCHAR(80) NOT NULL,
  glory_spent BIGINT UNSIGNED NOT NULL,
  reputation_spent BIGINT UNSIGNED NOT NULL,
  conversion_value BIGINT UNSIGNED NOT NULL DEFAULT 0,
  title_granted VARCHAR(100) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS ascension_states (
  player_id INT UNSIGNED PRIMARY KEY,
  ascension_count INT UNSIGNED NOT NULL DEFAULT 0,
  ascended_race VARCHAR(80) NULL,
  ascension_points BIGINT UNSIGNED NOT NULL DEFAULT 0,
  last_ascended_at DATETIME NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS protection_states (
  player_id INT UNSIGNED PRIMARY KEY,
  ppt_until DATETIME NULL,
  vacation_until DATETIME NULL,
  attack_cooldown_until DATETIME NULL,
  protected_until DATETIME NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS vacation_states (
  player_id INT UNSIGNED PRIMARY KEY,
  active TINYINT(1) NOT NULL DEFAULT 0,
  starts_at DATETIME NULL,
  ends_at DATETIME NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS messages (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sender_id INT UNSIGNED NOT NULL,
  recipient_id INT UNSIGNED NOT NULL,
  subject VARCHAR(160) NOT NULL,
  body TEXT NOT NULL,
  read_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sender_id) REFERENCES players(id),
  FOREIGN KEY (recipient_id) REFERENCES players(id),
  INDEX inbox (recipient_id,read_at,created_at)
);

CREATE TABLE IF NOT EXISTS blacklists (
  player_id INT UNSIGNED NOT NULL,
  blocked_player_id INT UNSIGNED NOT NULL,
  reason VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id,blocked_player_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (blocked_player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS target_realms (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NULL,
  name VARCHAR(100) NOT NULL,
  race_name VARCHAR(50) NOT NULL,
  rank_position INT UNSIGNED NOT NULL DEFAULT 9999,
  attack_score BIGINT UNSIGNED NOT NULL DEFAULT 0,
  defense_score BIGINT UNSIGNED NOT NULL DEFAULT 0,
  covert_score BIGINT UNSIGNED NOT NULL DEFAULT 0,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS ip_restrictions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip_address VARBINARY(16) NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  restriction_type ENUM('same_ip','attack_block','transfer_block','commander_block') NOT NULL,
  reason VARCHAR(255) NULL,
  expires_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  INDEX ip_lookup (ip_address,restriction_type)
);
CREATE TABLE IF NOT EXISTS game_turns (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  turn_number BIGINT UNSIGNED NOT NULL,
  processed_at DATETIME NOT NULL,
  status ENUM('started','completed','failed') NOT NULL DEFAULT 'started',
  summary_json JSON NULL,
  UNIQUE KEY turn_number_unique (turn_number)
);

CREATE TABLE IF NOT EXISTS turn_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  game_turn_id BIGINT UNSIGNED NULL,
  player_id INT UNSIGNED NULL,
  event_type VARCHAR(80) NOT NULL,
  amount_json JSON NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (game_turn_id) REFERENCES game_turns(id) ON DELETE SET NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS game_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NULL,
  event_type VARCHAR(80) NOT NULL,
  entity_type VARCHAR(80) NULL,
  entity_id BIGINT UNSIGNED NULL,
  payload JSON NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL,
  INDEX event_player (player_id,created_at),
  INDEX event_type (event_type,created_at)
);

CREATE TABLE IF NOT EXISTS audit_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NULL,
  action_name VARCHAR(100) NOT NULL,
  request_id CHAR(36) NULL,
  ip_address VARBINARY(16) NULL,
  payload JSON NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL,
  INDEX audit_player (player_id,created_at)
);

CREATE TABLE IF NOT EXISTS alliances_black_market (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  seller_id INT UNSIGNED NOT NULL,
  item_key VARCHAR(80) NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  price BIGINT UNSIGNED NOT NULL,
  status ENUM('open','sold','cancelled') NOT NULL DEFAULT 'open',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (seller_id) REFERENCES players(id)
);

CREATE TABLE IF NOT EXISTS supporter_status (
  player_id INT UNSIGNED PRIMARY KEY,
  supporter_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NULL,
  ends_at DATETIME NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS planet_explorations (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  name VARCHAR(100) NOT NULL,
  discovery_type VARCHAR(60) NOT NULL,
  status ENUM('started','completed','failed') NOT NULL DEFAULT 'started',
  result_json JSON NULL,
  started_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  completed_at DATETIME NULL,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

SET FOREIGN_KEY_CHECKS=1;

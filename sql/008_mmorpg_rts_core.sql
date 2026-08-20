USE stargatewars;

CREATE TABLE IF NOT EXISTS game_worlds (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  world_key VARCHAR(50) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  turn_interval_seconds INT UNSIGNED NOT NULL DEFAULT 1800,
  status ENUM('open','maintenance','closed') NOT NULL DEFAULT 'open',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS world_players (
  world_id INT UNSIGNED NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  home_colony_id INT UNSIGNED NULL,
  joined_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  last_seen_at DATETIME NULL,
  PRIMARY KEY(world_id,player_id),
  KEY idx_world_players_player(player_id),
  CONSTRAINT fk_wp_world FOREIGN KEY(world_id) REFERENCES game_worlds(id) ON DELETE CASCADE,
  CONSTRAINT fk_wp_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_progression (
  player_id INT UNSIGNED PRIMARY KEY,
  experience BIGINT NOT NULL DEFAULT 0,
  level INT UNSIGNED NOT NULL DEFAULT 1,
  glory BIGINT NOT NULL DEFAULT 0,
  reputation BIGINT NOT NULL DEFAULT 0,
  victories INT UNSIGNED NOT NULL DEFAULT 0,
  defeats INT UNSIGNED NOT NULL DEFAULT 0,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_progress_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_cooldowns (
  player_id INT UNSIGNED NOT NULL,
  cooldown_key VARCHAR(60) NOT NULL,
  available_at DATETIME NOT NULL,
  PRIMARY KEY(player_id,cooldown_key),
  CONSTRAINT fk_cooldown_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS diplomacy_relations (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  world_id INT UNSIGNED NOT NULL,
  proposer_player_id INT UNSIGNED NOT NULL,
  target_player_id INT UNSIGNED NOT NULL,
  relation_type ENUM('nap','trade','alliance','war','ceasefire') NOT NULL,
  status ENUM('pending','active','rejected','expired','cancelled') NOT NULL DEFAULT 'pending',
  starts_at DATETIME NULL,
  ends_at DATETIME NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_relation(world_id,proposer_player_id,target_player_id,relation_type),
  CONSTRAINT fk_relation_world FOREIGN KEY(world_id) REFERENCES game_worlds(id) ON DELETE CASCADE,
  CONSTRAINT fk_relation_proposer FOREIGN KEY(proposer_player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_relation_target FOREIGN KEY(target_player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS trade_contracts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  world_id INT UNSIGNED NOT NULL,
  seller_player_id INT UNSIGNED NOT NULL,
  buyer_player_id INT UNSIGNED NOT NULL,
  resource_key VARCHAR(40) NOT NULL,
  quantity BIGINT NOT NULL,
  unit_price BIGINT NOT NULL,
  status ENUM('open','accepted','settled','cancelled','expired') NOT NULL DEFAULT 'open',
  expires_at DATETIME NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_trade_world FOREIGN KEY(world_id) REFERENCES game_worlds(id) ON DELETE CASCADE,
  CONSTRAINT fk_trade_seller FOREIGN KEY(seller_player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_trade_buyer FOREIGN KEY(buyer_player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS turn_batches (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  world_id INT UNSIGNED NOT NULL,
  started_at DATETIME NOT NULL,
  completed_at DATETIME NULL,
  players_processed INT UNSIGNED NOT NULL DEFAULT 0,
  colonies_processed INT UNSIGNED NOT NULL DEFAULT 0,
  missions_processed INT UNSIGNED NOT NULL DEFAULT 0,
  status ENUM('running','completed','failed') NOT NULL DEFAULT 'running',
  error_text TEXT NULL,
  CONSTRAINT fk_turn_world FOREIGN KEY(world_id) REFERENCES game_worlds(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS turn_actions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  turn_batch_id BIGINT UNSIGNED NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  action_type VARCHAR(60) NOT NULL,
  payload JSON NOT NULL,
  result JSON NULL,
  status ENUM('queued','resolved','rejected','failed') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  resolved_at DATETIME NULL,
  KEY idx_turn_actions_batch(turn_batch_id,status),
  CONSTRAINT fk_action_batch FOREIGN KEY(turn_batch_id) REFERENCES turn_batches(id) ON DELETE CASCADE,
  CONSTRAINT fk_action_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_notifications (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  notification_type VARCHAR(60) NOT NULL,
  title VARCHAR(150) NOT NULL,
  body TEXT NOT NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_notifications_player(player_id,is_read,created_at),
  CONSTRAINT fk_notification_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

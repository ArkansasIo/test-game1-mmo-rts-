-- Universe Civilization: Empire at Wars full MMORPG/RTS feature extension.
-- Apply after 010_dark_matter_resource.sql.

CREATE TABLE IF NOT EXISTS technology_prerequisites (
  technology_key VARCHAR(80) NOT NULL,
  prerequisite_key VARCHAR(80) NOT NULL,
  minimum_level INT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (technology_key,prerequisite_key),
  FOREIGN KEY (technology_key) REFERENCES technologies(technology_key) ON DELETE CASCADE,
  FOREIGN KEY (prerequisite_key) REFERENCES technologies(technology_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS battle_rounds (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  battle_id BIGINT UNSIGNED NOT NULL,
  round_number INT UNSIGNED NOT NULL,
  attacker_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  defender_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  attacker_losses JSON NOT NULL,
  defender_losses JSON NOT NULL,
  round_result ENUM('attacker','defender','draw') NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (battle_id) REFERENCES battles(id) ON DELETE CASCADE,
  UNIQUE KEY uq_battle_round (battle_id,round_number)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_discoveries (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  solar_system_id INT UNSIGNED NULL,
  planet_id INT UNSIGNED NULL,
  discovery_type ENUM('system','planet','moon','anomaly','ruin','resource') NOT NULL,
  discovery_key VARCHAR(120) NOT NULL,
  payload JSON NOT NULL,
  discovered_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (solar_system_id) REFERENCES universe_solar_systems(id) ON DELETE SET NULL,
  FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE SET NULL,
  UNIQUE KEY uq_player_discovery (player_id,discovery_key),
  KEY idx_discovery_player_time (player_id,discovered_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS world_event_participants (
  event_id BIGINT UNSIGNED NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  participation_state ENUM('joined','completed','claimed','failed') NOT NULL DEFAULT 'joined',
  score BIGINT NOT NULL DEFAULT 0,
  reward_json JSON NULL,
  joined_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  completed_at DATETIME NULL,
  PRIMARY KEY (event_id,player_id),
  FOREIGN KEY (event_id) REFERENCES game_world_events(id) ON DELETE CASCADE,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS diplomacy_actions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  relation_id BIGINT UNSIGNED NOT NULL,
  actor_player_id INT UNSIGNED NOT NULL,
  action_type ENUM('propose','accept','reject','cancel','break') NOT NULL,
  payload JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (relation_id) REFERENCES diplomacy_relations(id) ON DELETE CASCADE,
  FOREIGN KEY (actor_player_id) REFERENCES players(id) ON DELETE CASCADE,
  KEY idx_diplomacy_actor_time (actor_player_id,created_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS game_audit_log (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NULL,
  action_name VARCHAR(80) NOT NULL,
  entity_type VARCHAR(80) NULL,
  entity_id BIGINT UNSIGNED NULL,
  request_id CHAR(36) NULL,
  payload JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE SET NULL,
  KEY idx_audit_player_time (player_id,created_at),
  KEY idx_audit_action_time (action_name,created_at)
) ENGINE=InnoDB;

INSERT INTO technology_prerequisites (technology_key,prerequisite_key,minimum_level)
SELECT 'shield_harmonics','defense_grid',3
WHERE EXISTS (SELECT 1 FROM technologies WHERE technology_key='shield_harmonics')
  AND EXISTS (SELECT 1 FROM technologies WHERE technology_key='defense_grid')
ON DUPLICATE KEY UPDATE minimum_level=VALUES(minimum_level);

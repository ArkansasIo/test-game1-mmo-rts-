-- Combat and fleet movement mechanics.
-- Adds idempotent metadata to existing mission and battle records and stores round-by-round resolution.

ALTER TABLE fleet_missions
  ADD COLUMN IF NOT EXISTS distance_units INT UNSIGNED NOT NULL DEFAULT 1 AFTER target_colony_id,
  ADD COLUMN IF NOT EXISTS fuel_cost BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER distance_units,
  ADD COLUMN IF NOT EXISTS mission_seed CHAR(64) NULL AFTER fuel_cost,
  ADD COLUMN IF NOT EXISTS resolved_at DATETIME NULL AFTER status;

ALTER TABLE battles
  ADD COLUMN IF NOT EXISTS combat_seed CHAR(64) NULL AFTER battle_seed,
  ADD COLUMN IF NOT EXISTS rounds_fought INT UNSIGNED NOT NULL DEFAULT 0 AFTER turns_spent,
  ADD COLUMN IF NOT EXISTS outcome VARCHAR(32) NULL AFTER winner_id,
  ADD COLUMN IF NOT EXISTS rapid_fire_events INT UNSIGNED NOT NULL DEFAULT 0 AFTER defender_casualties;

CREATE TABLE IF NOT EXISTS battle_rounds (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  battle_id BIGINT UNSIGNED NOT NULL,
  round_number INT UNSIGNED NOT NULL,
  attacker_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  defender_power BIGINT UNSIGNED NOT NULL DEFAULT 0,
  attacker_damage BIGINT UNSIGNED NOT NULL DEFAULT 0,
  defender_damage BIGINT UNSIGNED NOT NULL DEFAULT 0,
  attacker_units_lost INT UNSIGNED NOT NULL DEFAULT 0,
  defender_units_lost INT UNSIGNED NOT NULL DEFAULT 0,
  rapid_fire_events INT UNSIGNED NOT NULL DEFAULT 0,
  seed CHAR(64) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_battle_round (battle_id, round_number),
  CONSTRAINT fk_battle_round_battle FOREIGN KEY (battle_id) REFERENCES battles(id) ON DELETE CASCADE
) ENGINE=InnoDB;

ALTER TABLE battle_rounds
  ADD COLUMN IF NOT EXISTS attacker_damage BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER defender_power,
  ADD COLUMN IF NOT EXISTS defender_damage BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER attacker_damage,
  ADD COLUMN IF NOT EXISTS attacker_units_lost INT UNSIGNED NOT NULL DEFAULT 0 AFTER defender_damage,
  ADD COLUMN IF NOT EXISTS defender_units_lost INT UNSIGNED NOT NULL DEFAULT 0 AFTER attacker_units_lost,
  ADD COLUMN IF NOT EXISTS rapid_fire_events INT UNSIGNED NOT NULL DEFAULT 0 AFTER defender_units_lost,
  ADD COLUMN IF NOT EXISTS seed CHAR(64) NULL AFTER rapid_fire_events;

CREATE TABLE IF NOT EXISTS fleet_events (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  mission_id BIGINT UNSIGNED NOT NULL,
  player_id INT UNSIGNED NOT NULL,
  event_type ENUM('departed','arrived','returned','combat_started','combat_resolved','failed','cancelled') NOT NULL,
  event_payload JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_fleet_event_mission (mission_id, created_at),
  KEY idx_fleet_event_player (player_id, created_at),
  CONSTRAINT fk_fleet_event_mission FOREIGN KEY (mission_id) REFERENCES fleet_missions(id) ON DELETE CASCADE,
  CONSTRAINT fk_fleet_event_player FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO game_settings (setting_key, setting_value)
VALUES
 ('fleet_speed_units_per_hour','60'),
 ('fleet_fuel_per_distance','10'),
 ('fleet_movement_cooldown_seconds','0'),
 ('combat_max_rounds','6'),
 ('combat_rapid_fire_chance','35'),
 ('combat_cooldown_seconds','0')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

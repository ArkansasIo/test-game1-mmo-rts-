-- Universe Civilization: Empire at Wars
-- Empire control limits and authoritative homeworld registry.
CREATE TABLE IF NOT EXISTS player_empire_limits (
  player_id INT UNSIGNED NOT NULL PRIMARY KEY,
  max_planets INT UNSIGNED NOT NULL DEFAULT 100000,
  max_moons INT UNSIGNED NOT NULL DEFAULT 100000,
  homeworld_required TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_empire_limits_player FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS empire_homeworlds (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  colony_id INT UNSIGNED NOT NULL,
  planet_id INT UNSIGNED NOT NULL,
  homeworld_type ENUM('planet','moon') NOT NULL DEFAULT 'planet',
  established_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_homeworld_player FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_homeworld_colony FOREIGN KEY (colony_id) REFERENCES player_colonies(id) ON DELETE CASCADE,
  CONSTRAINT fk_homeworld_planet FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE CASCADE,
  UNIQUE KEY uq_homeworld_player (player_id),
  UNIQUE KEY uq_homeworld_colony (colony_id),
  UNIQUE KEY uq_homeworld_planet (planet_id)
) ENGINE=InnoDB;

INSERT INTO player_empire_limits (player_id, max_planets, max_moons, homeworld_required)
SELECT id, 100000, 100000, 1 FROM players
ON DUPLICATE KEY UPDATE max_planets=GREATEST(max_planets,100000), max_moons=GREATEST(max_moons,100000), homeworld_required=1;

INSERT IGNORE INTO empire_homeworlds (player_id, colony_id, planet_id, homeworld_type, established_at)
SELECT c.player_id, c.id, c.planet_id, IF(c.moon_id IS NULL,'planet','moon'), c.created_at
FROM player_colonies c
WHERE c.is_homeworld=1;

CREATE INDEX idx_empire_limits_planets ON player_empire_limits(max_planets);
CREATE INDEX idx_empire_limits_moons ON player_empire_limits(max_moons);

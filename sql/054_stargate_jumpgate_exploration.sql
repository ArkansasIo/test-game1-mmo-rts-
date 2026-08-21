-- Universe Civilization: Empire at Wars
-- Stargate network, jump-gate links, and deep-space exploration records.
CREATE TABLE IF NOT EXISTS stargate_nodes (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  galaxy_id INT UNSIGNED NULL,
  sector_id INT UNSIGNED NULL,
  solar_system_id INT UNSIGNED NULL,
  planet_id INT UNSIGNED NULL,
  moon_id INT UNSIGNED NULL,
  gate_name VARCHAR(120) NOT NULL,
  gate_class ENUM('stargate','jump_gate','ancient_gate','wormhole') NOT NULL DEFAULT 'stargate',
  status ENUM('dormant','active','unstable','disabled') NOT NULL DEFAULT 'dormant',
  level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  max_level TINYINT UNSIGNED NOT NULL DEFAULT 99,
  capacity_per_tick INT UNSIGNED NOT NULL DEFAULT 100,
  energy_cost INT UNSIGNED NOT NULL DEFAULT 10,
  activation_cost BIGINT UNSIGNED NOT NULL DEFAULT 25000,
  discovered TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (galaxy_id) REFERENCES universe_galaxies(id) ON DELETE SET NULL,
  FOREIGN KEY (sector_id) REFERENCES universe_sectors(id) ON DELETE SET NULL,
  FOREIGN KEY (solar_system_id) REFERENCES universe_solar_systems(id) ON DELETE SET NULL,
  FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE SET NULL,
  FOREIGN KEY (moon_id) REFERENCES universe_moons(id) ON DELETE SET NULL,
  KEY idx_gate_status(status,gate_class),
  KEY idx_gate_coordinates(galaxy_id,sector_id,solar_system_id),
  UNIQUE KEY uq_gate_location (solar_system_id,planet_id,moon_id,gate_class)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stargate_links (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  source_gate_id BIGINT UNSIGNED NOT NULL,
  destination_gate_id BIGINT UNSIGNED NOT NULL,
  link_status ENUM('offline','charging','online','unstable') NOT NULL DEFAULT 'offline',
  distance_units INT UNSIGNED NOT NULL DEFAULT 1,
  transit_seconds INT UNSIGNED NOT NULL DEFAULT 60,
  energy_per_transit INT UNSIGNED NOT NULL DEFAULT 10,
  capacity_per_tick INT UNSIGNED NOT NULL DEFAULT 100,
  last_used_at DATETIME NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (source_gate_id) REFERENCES stargate_nodes(id) ON DELETE CASCADE,
  FOREIGN KEY (destination_gate_id) REFERENCES stargate_nodes(id) ON DELETE CASCADE,
  UNIQUE KEY uq_gate_link(source_gate_id,destination_gate_id),
  KEY idx_gate_link_status(link_status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_exploration_missions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  mothership_id INT UNSIGNED NULL,
  origin_system_id INT UNSIGNED NULL,
  target_system_id INT UNSIGNED NULL,
  mission_type ENUM('planet_scan','moon_scan','deep_space_survey','gate_probe') NOT NULL,
  status ENUM('queued','scanning','completed','failed','cancelled') NOT NULL DEFAULT 'queued',
  scan_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  risk_score DECIMAL(8,3) NOT NULL DEFAULT 0,
  started_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  completes_at DATETIME NULL,
  completed_at DATETIME NULL,
  result_json JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (origin_system_id) REFERENCES universe_solar_systems(id) ON DELETE SET NULL,
  FOREIGN KEY (target_system_id) REFERENCES universe_solar_systems(id) ON DELETE SET NULL,
  KEY idx_exploration_player_status(player_id,status),
  KEY idx_exploration_completion(status,completes_at)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_discovered_bodies (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  mission_id BIGINT UNSIGNED NOT NULL,
  body_type ENUM('planet','moon') NOT NULL,
  planet_id INT UNSIGNED NULL,
  moon_id INT UNSIGNED NULL,
  discovery_confidence DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  classification ENUM('unknown','surveyed','habitable','resource_rich','ancient','hostile') NOT NULL DEFAULT 'unknown',
  can_colonize TINYINT(1) NOT NULL DEFAULT 0,
  discovered_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (mission_id) REFERENCES universe_exploration_missions(id) ON DELETE CASCADE,
  FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE CASCADE,
  FOREIGN KEY (moon_id) REFERENCES universe_moons(id) ON DELETE CASCADE,
  UNIQUE KEY uq_player_discovered_planet(player_id,planet_id),
  UNIQUE KEY uq_player_discovered_moon(player_id,moon_id),
  KEY idx_discovered_body_type(player_id,body_type,classification)
) ENGINE=InnoDB;

INSERT INTO stargate_nodes (galaxy_id,sector_id,solar_system_id,gate_name,gate_class,status,level,discovered)
SELECT g.id,s.id,ss.id,CONCAT(g.name,' / ',s.name,' Gate'),'stargate','active',1,1
FROM universe_solar_systems ss
JOIN universe_sectors s ON s.id=ss.sector_id
JOIN universe_galaxies g ON g.id=s.galaxy_id
WHERE NOT EXISTS (SELECT 1 FROM stargate_nodes n WHERE n.solar_system_id=ss.id AND n.gate_class='stargate');

INSERT IGNORE INTO stargate_links (source_gate_id,destination_gate_id,link_status,distance_units,transit_seconds,energy_per_transit,capacity_per_tick)
SELECT a.id,b.id,'online',ABS(CAST(a.solar_system_id AS SIGNED)-CAST(b.solar_system_id AS SIGNED))+1,60,10,100
FROM stargate_nodes a JOIN stargate_nodes b ON a.id<>b.id AND a.gate_class='stargate' AND b.gate_class='stargate'
WHERE a.status='active' AND b.status='active' AND a.solar_system_id < b.solar_system_id;

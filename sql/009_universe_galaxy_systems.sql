-- StargateWars Universe Expansion
-- Apply after 008_mmorpg_rts_core.sql.
-- MySQL 8.0+ / MariaDB 10.6+

CREATE TABLE IF NOT EXISTS universe_galaxies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  galaxy_number SMALLINT UNSIGNED NOT NULL,
  name VARCHAR(120) NOT NULL,
  description TEXT NULL,
  star_density ENUM('sparse','standard','dense','core') NOT NULL DEFAULT 'standard',
  sector_count SMALLINT UNSIGNED NOT NULL DEFAULT 8,
  system_count INT UNSIGNED NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_galaxy_number (galaxy_number),
  UNIQUE KEY uq_galaxy_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_sectors (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  galaxy_id INT UNSIGNED NOT NULL,
  sector_number SMALLINT UNSIGNED NOT NULL,
  name VARCHAR(120) NOT NULL,
  sector_class ENUM('frontier','trade','industrial','military','research','ancient','nebula','core') NOT NULL DEFAULT 'frontier',
  danger_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  resource_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  anomaly_rate DECIMAL(6,3) NOT NULL DEFAULT 0.050,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (galaxy_id) REFERENCES universe_galaxies(id) ON DELETE CASCADE,
  UNIQUE KEY uq_sector_coordinate (galaxy_id,sector_number),
  KEY idx_sector_class (sector_class),
  KEY idx_sector_danger (danger_level)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_solar_systems (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  sector_id INT UNSIGNED NOT NULL,
  system_number SMALLINT UNSIGNED NOT NULL,
  name VARCHAR(120) NOT NULL,
  spectral_class ENUM('O','B','A','F','G','K','M','binary','neutron','black_hole') NOT NULL DEFAULT 'G',
  star_age_billion DECIMAL(5,2) NOT NULL DEFAULT 4.60,
  star_mass DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  system_class ENUM('stable','volatile','binary','collapsed','anomalous','ancient') NOT NULL DEFAULT 'stable',
  max_orbits TINYINT UNSIGNED NOT NULL DEFAULT 15,
  travel_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  anomaly_seed VARCHAR(64) NULL,
  is_discovered TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (sector_id) REFERENCES universe_sectors(id) ON DELETE CASCADE,
  UNIQUE KEY uq_system_coordinate (sector_id,system_number),
  KEY idx_system_class (system_class),
  KEY idx_spectral_class (spectral_class)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS universe_planets (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  solar_system_id INT UNSIGNED NOT NULL,
  orbit_position TINYINT UNSIGNED NOT NULL,
  name VARCHAR(120) NOT NULL,
  coordinate_label VARCHAR(32) NOT NULL,
  planet_class ENUM('terrestrial','gas_giant','ice_giant','ocean','desert','volcanic','toxic','crystal','metallic','barren','jungle','ancient') NOT NULL DEFAULT 'terrestrial',
  planet_type ENUM('habitable','colony_world','resource_world','fortress_world','ruin_world','storm_world','dead_world','proto_world') NOT NULL DEFAULT 'habitable',
  biome ENUM('temperate','forest','jungle','oceanic','arid','desert','tundra','ice','volcanic','toxic','crystal','metallic','gas','barren','ancient') NOT NULL DEFAULT 'temperate',
  size_class ENUM('tiny','small','medium','large','huge','mega') NOT NULL DEFAULT 'medium',
  diameter_km INT UNSIGNED NOT NULL DEFAULT 12000,
  gravity DECIMAL(5,2) NOT NULL DEFAULT 1.00,
  temperature_c SMALLINT NOT NULL DEFAULT 15,
  habitability DECIMAL(5,2) NOT NULL DEFAULT 0.75,
  slots SMALLINT UNSIGNED NOT NULL DEFAULT 150,
  metal_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  crystal_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  food_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  water_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  energy_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  anomaly_rate DECIMAL(6,3) NOT NULL DEFAULT 0.050,
  is_colonizable TINYINT(1) NOT NULL DEFAULT 1,
  is_occupied TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (solar_system_id) REFERENCES universe_solar_systems(id) ON DELETE CASCADE,
  UNIQUE KEY uq_planet_orbit (solar_system_id,orbit_position),
  UNIQUE KEY uq_planet_coordinate (coordinate_label),
  KEY idx_planet_class_type (planet_class,planet_type),
  KEY idx_planet_biome (biome),
  KEY idx_planet_habitability (habitability),
  KEY idx_planet_colonizable (is_colonizable,is_occupied)
) ENGINE=InnoDB;

ALTER TABLE universe_planets MODIFY COLUMN slots SMALLINT UNSIGNED NOT NULL DEFAULT 150;

CREATE TABLE IF NOT EXISTS universe_moons (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  planet_id INT UNSIGNED NOT NULL,
  orbit_position TINYINT UNSIGNED NOT NULL DEFAULT 1,
  name VARCHAR(120) NOT NULL,
  moon_class ENUM('rocky','ice','metallic','volcanic','crystal','artificial','ancient') NOT NULL DEFAULT 'rocky',
  moon_type ENUM('standard','resource','shipyard','sensor','fortress','ruin','titan') NOT NULL DEFAULT 'standard',
  biome ENUM('cratered','ice','volcanic','crystal','metallic','barren','ancient') NOT NULL DEFAULT 'cratered',
  size_class ENUM('tiny','small','medium','large','huge') NOT NULL DEFAULT 'small',
  diameter_km INT UNSIGNED NOT NULL DEFAULT 1800,
  gravity DECIMAL(5,2) NOT NULL DEFAULT 0.16,
  habitability DECIMAL(5,2) NOT NULL DEFAULT 0.05,
  slots TINYINT UNSIGNED NOT NULL DEFAULT 40,
  metal_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  crystal_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  energy_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  sensor_range_bonus INT NOT NULL DEFAULT 0,
  jump_gate_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  is_colonizable TINYINT(1) NOT NULL DEFAULT 0,
  is_occupied TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE CASCADE,
  UNIQUE KEY uq_moon_orbit (planet_id,orbit_position),
  KEY idx_moon_class_type (moon_class,moon_type),
  KEY idx_moon_colonizable (is_colonizable,is_occupied)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_colonies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  planet_id INT UNSIGNED NOT NULL,
  moon_id INT UNSIGNED NULL,
  colony_name VARCHAR(120) NOT NULL,
  is_homeworld TINYINT(1) NOT NULL DEFAULT 0,
  population INT UNSIGNED NOT NULL DEFAULT 0,
  food INT UNSIGNED NOT NULL DEFAULT 0,
  water INT UNSIGNED NOT NULL DEFAULT 0,
  morale DECIMAL(5,3) NOT NULL DEFAULT 1.000,
  colony_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  last_settled_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE CASCADE,
  FOREIGN KEY (moon_id) REFERENCES universe_moons(id) ON DELETE SET NULL,
  UNIQUE KEY uq_player_planet (player_id,planet_id),
  KEY idx_player_homeworld (player_id,is_homeworld),
  KEY idx_colony_planet (planet_id),
  KEY idx_colony_moon (moon_id)
) ENGINE=InnoDB;

INSERT INTO universe_galaxies (galaxy_number,name,description,star_density,sector_count,is_active) VALUES
(1,'The Orion Expanse','The first mapped frontier of StargateWars.','standard',8,1),
(2,'The Veiled Reach','A dangerous region of nebulae and ancient gates.','dense',8,1)
ON DUPLICATE KEY UPDATE name=VALUES(name),description=VALUES(description),star_density=VALUES(star_density),sector_count=VALUES(sector_count);

INSERT INTO universe_sectors (galaxy_id,sector_number,name,sector_class,danger_level,resource_modifier,anomaly_rate)
SELECT g.id, s.sector_number, s.name, s.sector_class, s.danger_level, s.resource_modifier, s.anomaly_rate
FROM universe_galaxies g JOIN (
  SELECT 1 galaxy_number,1 sector_number,'Asteria Frontier' name,'frontier' sector_class,2 danger_level,1.050 resource_modifier,0.060 anomaly_rate
  UNION ALL SELECT 1,2,'Helios Trade Corridor','trade',1,1.100,0.030
  UNION ALL SELECT 1,3,'Khepri Industrial Belt','industrial',3,1.220,0.080
  UNION ALL SELECT 2,1,'The Shroud','nebula',5,1.150,0.220
  UNION ALL SELECT 2,2,'Ancient Gateworks','ancient',6,1.300,0.300
) s ON s.galaxy_number=g.galaxy_number
ON DUPLICATE KEY UPDATE name=VALUES(name),sector_class=VALUES(sector_class),danger_level=VALUES(danger_level),resource_modifier=VALUES(resource_modifier),anomaly_rate=VALUES(anomaly_rate);

INSERT INTO universe_solar_systems (sector_id,system_number,name,spectral_class,star_age_billion,star_mass,system_class,max_orbits,travel_modifier,anomaly_seed)
SELECT s.id, x.system_number, x.name, x.spectral_class, x.star_age_billion, x.star_mass, x.system_class, x.max_orbits, x.travel_modifier, x.anomaly_seed
FROM universe_sectors s JOIN (
  SELECT 1 galaxy_number,1 sector_number,1 system_number,'Asteria Prime System' name,'G' spectral_class,4.60 star_age_billion,1.000 star_mass,'stable' system_class,15 max_orbits,1.000 travel_modifier,'AST-001' anomaly_seed
  UNION ALL SELECT 1,1,2,'Tau Ceti Gate','K',6.10,0.820,'stable',12,1.050,'TCG-002'
  UNION ALL SELECT 1,2,1,'Helios Market System','F',2.90,1.180,'stable',15,0.950,'HMS-001'
  UNION ALL SELECT 1,3,1,'Khepri Foundry','M',9.80,0.480,'volatile',10,1.250,'KHF-001'
  UNION ALL SELECT 2,1,1,'Shroud Nebula Core','binary',3.40,1.920,'binary',18,1.500,'SHR-001'
  UNION ALL SELECT 2,2,1,'Gateworks Remnant','neutron',11.20,1.700,'ancient',9,1.700,'GWR-001'
) x ON x.galaxy_number=(SELECT g.galaxy_number FROM universe_galaxies g JOIN universe_sectors ss ON ss.galaxy_id=g.id WHERE ss.id=s.id) AND x.sector_number=s.sector_number
ON DUPLICATE KEY UPDATE name=VALUES(name),spectral_class=VALUES(spectral_class),system_class=VALUES(system_class),travel_modifier=VALUES(travel_modifier),anomaly_seed=VALUES(anomaly_seed);

INSERT INTO universe_planets (solar_system_id,orbit_position,name,coordinate_label,planet_class,planet_type,biome,size_class,diameter_km,gravity,temperature_c,habitability,slots,metal_modifier,crystal_modifier,food_modifier,water_modifier,energy_modifier,anomaly_rate,is_colonizable,is_occupied)
SELECT ss.id,p.orbit_position,p.name,CONCAT(g.galaxy_number,':',s.sector_number,':',ss.system_number,':',p.orbit_position),p.planet_class,p.planet_type,p.biome,p.size_class,p.diameter_km,p.gravity,p.temperature_c,p.habitability,p.slots,p.metal_modifier,p.crystal_modifier,p.food_modifier,p.water_modifier,p.energy_modifier,p.anomaly_rate,p.is_colonizable,p.is_occupied
FROM universe_galaxies g JOIN universe_sectors s ON s.galaxy_id=g.id JOIN universe_solar_systems ss ON ss.sector_id=s.id JOIN (
  SELECT 1 galaxy_number,1 sector_number,1 system_number,3 orbit_position,'Asteria Prime' name,'terrestrial' planet_class,'colony_world' planet_type,'temperate' biome,'large' size_class,14200 diameter_km,1.04 gravity,18 temperature_c,0.96 habitability,210 slots,1.05 metal_modifier,1.02 crystal_modifier,1.25 food_modifier,1.18 water_modifier,0.98 energy_modifier,0.05 anomaly_rate,1 is_colonizable,1 is_occupied
  UNION ALL SELECT 1,1,1,5,'Vespera','ocean','resource_world','oceanic','huge',18800,1.12,22,0.78,260,1.02,1.18,1.05,1.35,0.90,0.10,1,0
  UNION ALL SELECT 1,1,2,4,'Tau Ceti IV','desert','habitable','desert','medium',9800,0.88,46,0.62,140,1.20,0.94,0.62,0.55,1.12,0.08,1,0
  UNION ALL SELECT 1,2,1,2,'Helios Exchange','terrestrial','colony_world','forest','large',15100,1.08,25,0.90,225,1.00,1.00,1.20,1.15,1.00,0.04,1,0
  UNION ALL SELECT 1,3,1,7,'Khepri Forge','metallic','resource_world','metallic','large',16300,1.40,90,0.28,190,1.55,1.10,0.35,0.20,1.30,0.18,1,0
  UNION ALL SELECT 2,1,1,6,'Shroudfall','ice_giant','storm_world','ice','huge',42000,1.90,-130,0.12,90,1.10,1.42,0.18,0.22,0.80,0.30,0,0
  UNION ALL SELECT 2,2,1,1,'Remnant World','ancient','ruin_world','ancient','medium',12100,1.00,7,0.44,160,1.25,1.30,0.60,0.70,1.20,0.45,1,0
) p ON p.galaxy_number=g.galaxy_number AND p.sector_number=s.sector_number AND p.system_number=ss.system_number
ON DUPLICATE KEY UPDATE name=VALUES(name),planet_class=VALUES(planet_class),planet_type=VALUES(planet_type),biome=VALUES(biome),habitability=VALUES(habitability),metal_modifier=VALUES(metal_modifier),crystal_modifier=VALUES(crystal_modifier),food_modifier=VALUES(food_modifier),water_modifier=VALUES(water_modifier),energy_modifier=VALUES(energy_modifier);

INSERT INTO universe_moons (planet_id,orbit_position,name,moon_class,moon_type,biome,size_class,diameter_km,gravity,habitability,slots,metal_modifier,crystal_modifier,energy_modifier,sensor_range_bonus,jump_gate_level,is_colonizable,is_occupied)
SELECT p.id,m.orbit_position,m.name,m.moon_class,m.moon_type,m.biome,m.size_class,m.diameter_km,m.gravity,m.habitability,m.slots,m.metal_modifier,m.crystal_modifier,m.energy_modifier,m.sensor_range_bonus,m.jump_gate_level,m.is_colonizable,m.is_occupied
FROM universe_planets p JOIN (
  SELECT '1:1:3' coordinate_label,1 orbit_position,'Asteria Luna' name,'rocky' moon_class,'sensor' moon_type,'cratered' biome,'medium' size_class,3300 diameter_km,0.16 gravity,0.08 habitability,55 slots,1.05 metal_modifier,1.12 crystal_modifier,1.00 energy_modifier,3 sensor_range_bonus,0 jump_gate_level,0 is_colonizable,0 is_occupied
  UNION ALL SELECT '1:1:5',1,'Vespera Tide','ice','resource','ice','large',4100,0.19,0.12,70,1.10,1.35,0.92,1,0,0,0
  UNION ALL SELECT '1:3:1:7',1,'Forge Satellite','metallic','shipyard','metallic','large',5200,0.24,0.04,80,1.25,1.08,1.15,2,1,0,0
  UNION ALL SELECT '2:2:1:1',1,'Remnant Moon','ancient','ruin','ancient','medium',2800,0.13,0.10,60,1.22,1.28,1.10,5,0,0,0
) m ON m.coordinate_label=p.coordinate_label
ON DUPLICATE KEY UPDATE name=VALUES(name),moon_class=VALUES(moon_class),moon_type=VALUES(moon_type),biome=VALUES(biome),sensor_range_bonus=VALUES(sensor_range_bonus),jump_gate_level=VALUES(jump_gate_level);

UPDATE universe_galaxies g SET system_count=(SELECT COUNT(*) FROM universe_sectors s JOIN universe_solar_systems ss ON ss.sector_id=s.id WHERE s.galaxy_id=g.id);

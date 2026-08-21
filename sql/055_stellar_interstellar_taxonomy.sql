-- Universe Civilization: Empire at Wars
-- Stable taxonomy for stars, solar systems, and interstellar objects.
CREATE TABLE IF NOT EXISTS stellar_class_catalog (
  class_id VARCHAR(16) NOT NULL PRIMARY KEY,
  class_letter CHAR(1) NOT NULL,
  subclass_code VARCHAR(12) NOT NULL,
  display_name VARCHAR(120) NOT NULL,
  spectral_family VARCHAR(32) NOT NULL,
  temperature_min_k INT UNSIGNED NOT NULL,
  temperature_max_k INT UNSIGNED NOT NULL,
  mass_min DECIMAL(8,3) NOT NULL,
  mass_max DECIMAL(8,3) NOT NULL,
  luminosity_min DECIMAL(10,3) NOT NULL,
  luminosity_max DECIMAL(10,3) NOT NULL,
  lifespan_million_years INT UNSIGNED NOT NULL,
  habitability_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  energy_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  anomaly_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  gate_stability_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  description TEXT NOT NULL,
  UNIQUE KEY uq_stellar_class_subclass(class_letter,subclass_code)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stellar_system_type_catalog (
  system_type_id VARCHAR(16) NOT NULL PRIMARY KEY,
  type_letter CHAR(1) NOT NULL,
  subclass_code VARCHAR(12) NOT NULL,
  display_name VARCHAR(120) NOT NULL,
  star_count TINYINT UNSIGNED NOT NULL DEFAULT 1,
  planet_min TINYINT UNSIGNED NOT NULL DEFAULT 9,
  planet_target TINYINT UNSIGNED NOT NULL DEFAULT 10,
  planet_max TINYINT UNSIGNED NOT NULL DEFAULT 15,
  navigation_risk DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  travel_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  resource_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  anomaly_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  gate_stability_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  description TEXT NOT NULL,
  UNIQUE KEY uq_system_type_subclass(type_letter,subclass_code)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS interstellar_object_type_catalog (
  object_type_id VARCHAR(16) NOT NULL PRIMARY KEY,
  type_letter CHAR(1) NOT NULL,
  subclass_code VARCHAR(12) NOT NULL,
  display_name VARCHAR(120) NOT NULL,
  object_group ENUM('stellar','nebula','debris','anomaly','structure','gate') NOT NULL,
  scan_difficulty DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  exploration_yield DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  danger_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  resource_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  gate_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  colonization_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  description TEXT NOT NULL,
  UNIQUE KEY uq_object_type_subclass(type_letter,subclass_code)
) ENGINE=InnoDB;

ALTER TABLE universe_solar_systems
  ADD COLUMN IF NOT EXISTS stellar_class_id VARCHAR(16) NULL,
  ADD COLUMN IF NOT EXISTS system_type_id VARCHAR(16) NULL,
  ADD COLUMN IF NOT EXISTS navigation_risk DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  ADD COLUMN IF NOT EXISTS resource_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  ADD COLUMN IF NOT EXISTS gate_stability_modifier DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  ADD COLUMN IF NOT EXISTS interstellar_object_count SMALLINT UNSIGNED NOT NULL DEFAULT 0;

CREATE TABLE IF NOT EXISTS universe_interstellar_objects (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  solar_system_id INT UNSIGNED NOT NULL,
  object_type_id VARCHAR(16) NOT NULL,
  orbit_position SMALLINT UNSIGNED NULL,
  object_name VARCHAR(160) NOT NULL,
  mass_index DECIMAL(10,3) NOT NULL DEFAULT 1.000,
  radius_km INT UNSIGNED NOT NULL DEFAULT 1,
  scan_difficulty DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  danger_rating DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  resource_yield DECIMAL(10,3) NOT NULL DEFAULT 0.000,
  anomaly_strength DECIMAL(10,3) NOT NULL DEFAULT 0.000,
  is_discovered TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (solar_system_id) REFERENCES universe_solar_systems(id) ON DELETE CASCADE,
  FOREIGN KEY (object_type_id) REFERENCES interstellar_object_type_catalog(object_type_id) ON DELETE RESTRICT,
  KEY idx_interstellar_system(solar_system_id),
  KEY idx_interstellar_type(object_type_id)
) ENGINE=InnoDB;

INSERT INTO stellar_class_catalog VALUES
('STAR-A01','A','0','Blue Supergiant','O/B hot luminous',30000,60000,12.000,60.000,20000.000,1000000.000,8,0.550,2.800,1.700,0.700,'Extreme blue supergiant with immense energy output and unstable gate lanes.'),
('STAR-B01','B','0','Blue Giant','B hot luminous',10000,30000,2.100,16.000,25.000,30000.000,100,0.700,2.100,1.350,0.820,'Hot blue giant suitable for high-energy industry and dangerous exploration.'),
('STAR-C01','A','0','White Main Sequence','A white main sequence',7500,10000,1.400,2.100,5.000,25.000,1000,0.900,1.350,1.100,0.950,'Bright white star with stable but high-energy planetary environments.'),
('STAR-D01','F','0','Yellow-White Main Sequence','F yellow-white',6000,7500,1.040,1.400,1.500,5.000,3000,1.000,1.150,1.000,1.000,'Balanced star with good habitability and reliable navigation.'),
('STAR-E01','G','0','Yellow Main Sequence','G yellow',5200,6000,0.800,1.040,0.600,1.500,10000,1.080,1.000,0.950,1.080,'Stable solar-type star with strong colony and gate potential.'),
('STAR-F01','K','0','Orange Main Sequence','K orange',3700,5200,0.600,0.800,0.080,0.600,20000,1.180,0.850,0.900,1.120,'Long-lived orange star with favorable survival and resource conditions.'),
('STAR-G01','M','0','Red Dwarf','M red dwarf',2400,3700,0.080,0.600,0.001,0.080,100000,1.250,0.650,1.200,0.880,'Long-lived red dwarf with flare risk, hidden resources, and unstable scans.'),
('STAR-H01','N','0','Neutron Star','compact remnant',600000,1000000,1.000,2.500,0.001,100000.000,0,0.250,3.500,2.500,0.300,'Ultra-dense stellar remnant producing severe radiation and time distortion.'),
('STAR-I01','X','0','Black Hole','singularity remnant',0,0,3.000,99999.999,0.000,0.000,0,0.050,0.100,4.000,0.150,'Singularity with extreme gravity, rare anomaly yield, and hazardous gates.'),
('STAR-J01','Q','0','Binary Pair','multiple star system',2500,30000,0.200,20.000,0.010,50000.000,5000,0.820,1.700,1.500,0.720,'Two gravitationally bound stars producing complex orbital zones and valuable anomalies.'),
('STAR-K01','R','0','Variable Star','unstable luminous',3000,20000,0.500,15.000,0.050,10000.000,2000,0.650,1.450,2.000,0.650,'Pulsating variable star with shifting radiation, unpredictable weather, and unstable gates.'),
('STAR-L01','S','0','Ancient Star','low-metallicity relic',3500,9000,0.500,1.200,0.100,4.000,12000,0.750,0.900,1.800,0.600,'Ancient low-metallicity star associated with relic systems and unusual exploration signatures.')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),description=VALUES(description),habitability_modifier=VALUES(habitability_modifier),energy_modifier=VALUES(energy_modifier),anomaly_modifier=VALUES(anomaly_modifier),gate_stability_modifier=VALUES(gate_stability_modifier);

INSERT INTO stellar_system_type_catalog VALUES
('SYS-A01','A','0','Single Star System',1,9,10,15,1.000,1.000,1.000,1.000,1.000,'Standard system centered on one main-sequence star.'),
('SYS-B01','B','0','Binary Star System',2,9,11,15,1.250,1.150,1.100,1.300,0.820,'Two-star system with complex orbits and stronger anomaly activity.'),
('SYS-C01','C','0','Trinary Star System',3,9,12,15,1.550,1.300,1.200,1.650,0.650,'Three-star system with unstable lanes and rare high-value worlds.'),
('SYS-D01','D','0','Nebula System',1,9,10,15,1.400,1.250,1.350,1.900,0.700,'System embedded in a gas cloud with obscured scans and rich chemistry.'),
('SYS-E01','E','0','Ancient System',1,9,9,15,1.650,1.400,1.500,2.100,0.550,'Old system containing ruins, relics, and degraded navigation infrastructure.'),
('SYS-F01','F','0','Compact Remnant System',1,9,10,15,2.000,1.700,1.250,2.500,0.350,'System surrounding a neutron star or black hole remnant.'),
('SYS-G01','G','0','Rogue System',1,9,9,15,1.800,1.900,1.450,1.800,0.450,'System on a drifting trajectory with difficult long-range navigation.'),
('SYS-H01','H','0','Wormhole System',1,9,12,15,2.200,0.450,1.600,3.000,0.300,'System linked through a natural or engineered spacetime aperture.'),
('SYS-I01','I','0','Frontier System',1,9,12,15,0.900,1.100,1.250,1.250,0.900,'Newly mapped frontier with unsettled worlds and exploration potential.'),
('SYS-J01','J','0','Industrial System',1,9,15,15,0.850,0.900,1.650,0.800,1.100,'Dense industrial system optimized for production and logistics.'),
('SYS-K01','K','0','Warzone System',1,9,10,15,2.400,1.350,1.150,1.600,0.500,'Contested system with military debris, blockades, and combat anomalies.'),
('SYS-L01','L','0','Gate Nexus',1,9,15,15,1.100,0.350,1.400,2.200,1.600,'Strategic system containing a high-capacity gate junction.')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),description=VALUES(description),planet_min=VALUES(planet_min),planet_target=VALUES(planet_target),planet_max=VALUES(planet_max),navigation_risk=VALUES(navigation_risk),travel_modifier=VALUES(travel_modifier),resource_modifier=VALUES(resource_modifier),anomaly_modifier=VALUES(anomaly_modifier),gate_stability_modifier=VALUES(gate_stability_modifier);

INSERT INTO interstellar_object_type_catalog VALUES
('OBJ-A01','A','0','Asteroid Belt','debris',1.100,1.450,0.900,1.800,1.000,0.800,'Dense mineral field suitable for mining and survey missions.'),
('OBJ-B01','B','0','Comet Cluster','debris',1.250,1.250,0.750,1.350,0.900,0.900,'Mobile ice and volatile bodies that enrich water and deuterium operations.'),
('OBJ-C01','C','0','Nebula Cloud','nebula',1.750,1.650,1.250,1.550,0.700,0.900,'Gas cloud that obscures sensors and amplifies anomaly signals.'),
('OBJ-D01','D','0','Planetary Ring','debris',1.050,1.150,0.700,1.200,1.000,1.000,'Orbital debris ring containing minerals and navigation hazards.'),
('OBJ-E01','E','0','Derelict Megastructure','structure',2.100,2.800,1.800,2.300,1.250,1.100,'Abandoned artificial structure containing technology and salvage.'),
('OBJ-F01','F','0','Ancient Ruin','structure',2.250,2.600,1.650,1.800,1.150,1.050,'Ancient installation with high scan difficulty and relic rewards.'),
('OBJ-G01','G','0','Natural Wormhole','anomaly',2.800,3.200,2.500,1.200,3.000,0.900,'Transient spacetime bridge that can connect distant systems.'),
('OBJ-H01','H','0','Gravitational Anomaly','anomaly',2.500,2.200,2.700,0.900,1.800,0.700,'Unstable gravity region affecting travel, combat, and scans.'),
('OBJ-I01','I','0','Stellar Nursery','nebula',1.900,1.900,1.300,1.650,0.800,1.150,'Star-forming cloud with rare resources and high radiation.'),
('OBJ-J01','J','0','Jump-Gate Relay','gate',1.350,1.700,1.000,1.150,2.500,1.000,'Artificial relay that increases gate capacity and transit reliability.'),
('OBJ-K01','K','0','Black Hole Accretion Disk','stellar',2.900,3.500,3.500,1.400,0.400,0.350,'High-energy disk around a singularity with exceptional danger.'),
('OBJ-L01','L','0','Neutron Pulsar Beacon','stellar',2.400,2.900,2.900,1.250,0.600,0.450,'Pulsar beacon used for deep navigation and precision scanning.')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),description=VALUES(description),scan_difficulty=VALUES(scan_difficulty),exploration_yield=VALUES(exploration_yield),danger_modifier=VALUES(danger_modifier),resource_modifier=VALUES(resource_modifier),gate_modifier=VALUES(gate_modifier),colonization_modifier=VALUES(colonization_modifier);

UPDATE universe_solar_systems ss
JOIN stellar_class_catalog sc ON sc.class_letter=CASE ss.spectral_class WHEN 'O' THEN 'A' WHEN 'B' THEN 'B' WHEN 'A' THEN 'C' WHEN 'F' THEN 'D' WHEN 'G' THEN 'E' WHEN 'K' THEN 'F' WHEN 'M' THEN 'G' ELSE 'E' END
JOIN stellar_system_type_catalog st ON st.system_type_id=CASE ss.system_class WHEN 'binary' THEN 'SYS-B01' WHEN 'anomalous' THEN 'SYS-H01' WHEN 'ancient' THEN 'SYS-E01' WHEN 'volatile' THEN 'SYS-K01' WHEN 'collapsed' THEN 'SYS-F01' ELSE 'SYS-A01' END
SET ss.stellar_class_id=sc.class_id,ss.system_type_id=st.system_type_id,ss.navigation_risk=st.navigation_risk,ss.resource_modifier=st.resource_modifier,ss.gate_stability_modifier=st.gate_stability_modifier;

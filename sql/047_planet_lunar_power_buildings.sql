-- Planetary and lunar settlement power/building systems.
-- Adds reusable field slots, modular settlement buildings, and construction queues.

ALTER TABLE building_types
  ADD COLUMN IF NOT EXISTS building_class VARCHAR(40) NOT NULL DEFAULT 'infrastructure',
  ADD COLUMN IF NOT EXISTS buildable_on VARCHAR(20) NOT NULL DEFAULT 'both',
  ADD COLUMN IF NOT EXISTS field_size TINYINT UNSIGNED NOT NULL DEFAULT 1,
  ADD COLUMN IF NOT EXISTS base_power_output BIGINT NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS base_power_consumption BIGINT NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS placement_rule VARCHAR(80) NOT NULL DEFAULT 'standard';

CREATE TABLE IF NOT EXISTS settlement_fields (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  settlement_key VARCHAR(90) NOT NULL,
  location_type ENUM('planet','moon') NOT NULL,
  colony_id INT UNSIGNED NOT NULL,
  planet_id INT UNSIGNED NOT NULL,
  moon_id INT UNSIGNED NULL,
  field_index INT UNSIGNED NOT NULL,
  field_kind ENUM('resource','power','residential','industrial','research','military','civic','orbital') NOT NULL DEFAULT 'resource',
  building_id BIGINT UNSIGNED NULL,
  power_priority TINYINT UNSIGNED NOT NULL DEFAULT 5,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_settlement_field (settlement_key,field_index),
  KEY idx_settlement_field_player (player_id,settlement_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (colony_id) REFERENCES player_colonies(id) ON DELETE CASCADE,
  FOREIGN KEY (planet_id) REFERENCES universe_planets(id) ON DELETE CASCADE,
  FOREIGN KEY (moon_id) REFERENCES universe_moons(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS settlement_buildings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  settlement_key VARCHAR(90) NOT NULL,
  field_id BIGINT UNSIGNED NOT NULL,
  building_type_id INT UNSIGNED NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  condition_value DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  active TINYINT(1) NOT NULL DEFAULT 1,
  power_output BIGINT NOT NULL DEFAULT 0,
  power_consumption BIGINT NOT NULL DEFAULT 0,
  stats JSON NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_settlement_building_field (field_id),
  KEY idx_settlement_building_owner (player_id,settlement_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (field_id) REFERENCES settlement_fields(id) ON DELETE CASCADE,
  FOREIGN KEY (building_type_id) REFERENCES building_types(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS settlement_construction_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  settlement_key VARCHAR(90) NOT NULL,
  field_id BIGINT UNSIGNED NOT NULL,
  building_id BIGINT UNSIGNED NULL,
  building_type_id INT UNSIGNED NOT NULL,
  level_before TINYINT UNSIGNED NOT NULL DEFAULT 0,
  level_after TINYINT UNSIGNED NOT NULL,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','building','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_settlement_construction_due (status,completes_at),
  KEY idx_settlement_construction_player (player_id,status),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (field_id) REFERENCES settlement_fields(id) ON DELETE CASCADE,
  FOREIGN KEY (building_id) REFERENCES settlement_buildings(id) ON DELETE SET NULL,
  FOREIGN KEY (building_type_id) REFERENCES building_types(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO building_types
(building_key,name,display_name,category,max_level,base_time_seconds,base_metal,base_crystal,base_naquadah,base_energy,effect_key,effect_per_level,prerequisite_key,prerequisite_level,description,building_class,buildable_on,field_size,base_power_output,base_power_consumption,placement_rule)
VALUES
('resource_field','Resource Field','Resource Field','economy',21,120,180,90,10,0,'resource_yield',0.08,'command_center',1,'Extracts and refines local planetary or lunar resources.','resource','both',1,0,8,'standard'),
('fusion_reactor','Fusion Reactor','Fusion Reactor','economy',21,180,260,180,30,0,'power_output',25.00,'command_center',1,'Generates stable grid power for settlement infrastructure.','power',1,1,120,4,'power_core_required'),
('water_reclaimer','Water Reclaimer','Water Reclaimer','civilian',21,150,220,110,15,0,'water_output',18.00,'command_center',1,'Reclaims water and increases life-support throughput.','resource','both',1,0,10,'standard'),
('agri_bioreactor','Agri-Bioreactor','Agri-Bioreactor','civilian',21,160,240,130,18,0,'food_output',22.00,'command_center',1,'Converts energy and biomass into food production.','resource','planet',1,0,12,'planet_biome_required'),
('habitat_district','Habitat District','Habitat District','civilian',21,180,300,160,25,0,'population_capacity',500.00,'command_center',1,'Provides protected population housing and workforce capacity.','residential','both',2,0,15,'standard'),
('city_core','City Core','City Core','government',21,420,700,450,100,0,'city_capacity',1.00,'command_center',3,'Connects districts into a functioning settlement city.','civic','both',3,0,40,'requires_habitat'),
('orbital_shipyard','Orbital Shipyard','Orbital Shipyard','military',21,480,900,600,120,0,'shipyard_capacity',4.00,'industrial_complex',3,'Builds fleet hulls and maintains orbital logistics.','shipyard','planet',3,0,60,'orbital_slot_required'),
('moon_shipyard','Moon Shipyard','Moon Shipyard','military',21,520,1100,800,180,0,'shipyard_capacity',5.00,'industrial_complex',3,'Builds specialized lunar and deep-space vessels.','shipyard','moon',3,0,80,'moon_orbit_required'),
('defense_bastion','Defense Bastion','Defense Bastion','defense',21,300,650,380,70,0,'defense_rating',0.09,'defense_grid',2,'Hardens settlement approaches and garrison positions.','military','both',2,0,30,'defense_grid_required'),
('sensor_array','Sensor Array','Sensor Array','research',21,240,400,500,80,0,'scan_power',3.00,'research_laboratory',2,'Extends scan power and reveals partial telemetry.','research','both',1,0,20,'research_required'),
('jump_gate','Jump Gate','Jump Gate','military',21,900,1800,1800,450,0,'gate_capacity',2.00,'research_laboratory',5,'Enables high-throughput fleet movement between linked settlements.','orbital','both',4,0,120,'moon_or_orbital_required'),
('stellar_foundry','Stellar Foundry','Stellar Foundry','military',21,1200,2400,1500,600,0,'capital_ship_capacity',1.00,'orbital_shipyard',5,'Produces capital hulls and megastructure components.','shipyard','planet',5,0,180,'shipyard_required')
ON DUPLICATE KEY UPDATE
 name=VALUES(name),display_name=VALUES(display_name),description=VALUES(description),building_class=VALUES(building_class),buildable_on=VALUES(buildable_on),field_size=VALUES(field_size),base_power_output=VALUES(base_power_output),base_power_consumption=VALUES(base_power_consumption),placement_rule=VALUES(placement_rule);

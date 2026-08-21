-- Universe Civilization: Empire at Wars
-- Construction, production, research library, technology prerequisites, and upgrade queues.

CREATE TABLE IF NOT EXISTS building_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  building_key VARCHAR(60) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  category ENUM('economy','military','civilian','research','defense','government') NOT NULL,
  max_level TINYINT UNSIGNED NOT NULL DEFAULT 21,
  base_time_seconds INT UNSIGNED NOT NULL DEFAULT 300,
  base_metal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  base_crystal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  base_naquadah BIGINT UNSIGNED NOT NULL DEFAULT 0,
  base_energy BIGINT UNSIGNED NOT NULL DEFAULT 0,
  effect_key VARCHAR(60) NOT NULL,
  effect_per_level DECIMAL(10,4) NOT NULL DEFAULT 0,
  prerequisite_key VARCHAR(60) NULL,
  prerequisite_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  description TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

ALTER TABLE building_types MODIFY category ENUM('resource','life_support','population','defense','shipyard','research','economy','military','civilian','government') NOT NULL;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS name VARCHAR(100) NULL AFTER building_key;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS display_name VARCHAR(100) NULL AFTER name;
ALTER TABLE building_types MODIFY display_name VARCHAR(100) NULL;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS max_level TINYINT UNSIGNED NOT NULL DEFAULT 21;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS base_time_seconds INT UNSIGNED NOT NULL DEFAULT 300;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS base_energy BIGINT UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS effect_key VARCHAR(60) NULL;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS effect_per_level DECIMAL(10,4) NOT NULL DEFAULT 0;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS prerequisite_key VARCHAR(60) NULL;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS prerequisite_level TINYINT UNSIGNED NOT NULL DEFAULT 0;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS description TEXT NULL;
ALTER TABLE building_types ADD COLUMN IF NOT EXISTS is_active TINYINT(1) NOT NULL DEFAULT 1;
UPDATE building_types SET name=COALESCE(name,display_name,building_key),display_name=COALESCE(display_name,name,building_key),base_time_seconds=COALESCE(base_time_seconds,build_seconds),description=COALESCE(description,CONCAT('Legacy building: ',COALESCE(display_name,name,building_key))),effect_key=COALESCE(effect_key,building_key) WHERE name IS NULL OR display_name IS NULL OR description IS NULL OR effect_key IS NULL;

CREATE TABLE IF NOT EXISTS player_buildings (
  player_id INT UNSIGNED NOT NULL,
  building_type_id INT UNSIGNED NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  condition_value DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  active TINYINT(1) NOT NULL DEFAULT 1,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id,building_type_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (building_type_id) REFERENCES building_types(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS construction_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  building_type_id INT UNSIGNED NOT NULL,
  level_before TINYINT UNSIGNED NOT NULL,
  level_after TINYINT UNSIGNED NOT NULL,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','building','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (building_type_id) REFERENCES building_types(id) ON DELETE CASCADE,
  KEY idx_construction_due(status,completes_at), KEY idx_construction_player(player_id,status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS production_tracks (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  track_key VARCHAR(60) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  category ENUM('military','civilian','fleet','covert','government') NOT NULL,
  output_unit_key VARCHAR(60) NULL,
  base_capacity INT UNSIGNED NOT NULL DEFAULT 10,
  base_time_seconds INT UNSIGNED NOT NULL DEFAULT 60,
  capacity_per_level INT UNSIGNED NOT NULL DEFAULT 5,
  speed_per_level DECIMAL(8,4) NOT NULL DEFAULT 0.0500,
  prerequisite_building VARCHAR(60) NULL,
  description TEXT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_production_tracks (
  player_id INT UNSIGNED NOT NULL,
  production_track_id INT UNSIGNED NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  queue_slots TINYINT UNSIGNED NOT NULL DEFAULT 1,
  efficiency DECIMAL(8,4) NOT NULL DEFAULT 1.0000,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id,production_track_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (production_track_id) REFERENCES production_tracks(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS unit_production_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  production_track_id INT UNSIGNED NOT NULL,
  unit_class_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  unit_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','producing','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (production_track_id) REFERENCES production_tracks(id) ON DELETE CASCADE,
  FOREIGN KEY (unit_class_id) REFERENCES unit_classes(id) ON DELETE CASCADE,
  KEY idx_unit_production_due(status,completes_at), KEY idx_unit_production_player(player_id,status)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS research_nodes (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  node_key VARCHAR(80) NOT NULL UNIQUE,
  name VARCHAR(120) NOT NULL,
  branch ENUM('military','civilian','government','science','covert','universal') NOT NULL,
  tier TINYINT UNSIGNED NOT NULL DEFAULT 1,
  max_level TINYINT UNSIGNED NOT NULL DEFAULT 21,
  base_time_seconds INT UNSIGNED NOT NULL DEFAULT 300,
  base_metal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  base_crystal BIGINT UNSIGNED NOT NULL DEFAULT 0,
  base_naquadah BIGINT UNSIGNED NOT NULL DEFAULT 0,
  base_energy BIGINT UNSIGNED NOT NULL DEFAULT 0,
  effect_key VARCHAR(80) NOT NULL,
  effect_per_level DECIMAL(10,4) NOT NULL DEFAULT 0,
  description TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS research_prerequisites (
  node_id INT UNSIGNED NOT NULL,
  prerequisite_node_id INT UNSIGNED NOT NULL,
  minimum_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (node_id,prerequisite_node_id),
  FOREIGN KEY (node_id) REFERENCES research_nodes(id) ON DELETE CASCADE,
  FOREIGN KEY (prerequisite_node_id) REFERENCES research_nodes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_research_nodes (
  player_id INT UNSIGNED NOT NULL,
  node_id INT UNSIGNED NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  effect_value DECIMAL(12,4) NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id,node_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (node_id) REFERENCES research_nodes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS research_node_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  node_id INT UNSIGNED NOT NULL,
  level_before TINYINT UNSIGNED NOT NULL,
  level_after TINYINT UNSIGNED NOT NULL,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','researching','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (node_id) REFERENCES research_nodes(id) ON DELETE CASCADE,
  KEY idx_research_node_due(status,completes_at), KEY idx_research_node_player(player_id,status)
) ENGINE=InnoDB;

INSERT INTO building_types(building_key,name,category,max_level,base_time_seconds,base_metal,base_crystal,base_naquadah,base_energy,effect_key,effect_per_level,prerequisite_key,prerequisite_level,description) VALUES
('command_center','Command Center','government',21,240,500,250,50,40,'command_capacity',10,NULL,0,'Expands commander authority and unlocks higher systems.'),
('academy','Military Academy','military',21,300,700,300,80,60,'military_training',0.06,'command_center',1,'Improves military unit training.'),
('industrial_complex','Industrial Complex','economy',21,360,900,250,70,80,'production',0.08,'command_center',1,'Improves construction and unit production.'),
('research_laboratory','Research Laboratory','research',21,420,500,850,100,120,'research',0.08,'command_center',1,'Improves research speed and technology effects.'),
('defense_grid','Defense Grid','defense',21,420,1000,500,120,160,'defense',0.07,'command_center',2,'Improves colony defense.'),
('civilian_habitat','Civilian Habitat','civilian',21,300,450,180,20,60,'population_capacity',250,'command_center',1,'Expands population capacity and civilian workforce.'),
('government_hall','Government Hall','government',21,480,700,450,100,140,'policy_power',0.06,'command_center',3,'Improves policy effects and stability.')
ON DUPLICATE KEY UPDATE name=VALUES(name),effect_key=VALUES(effect_key),effect_per_level=VALUES(effect_per_level),description=VALUES(description);

INSERT INTO production_tracks(track_key,name,category,output_unit_key,base_capacity,base_time_seconds,capacity_per_level,speed_per_level,prerequisite_building,description) VALUES
('ground_foundry','Ground Foundry','military','rifle_squad',10,45,5,0.05,'academy','Produces infantry and ground units.'),
('vehicle_bay','Vehicle Bay','military','armor_column',6,90,2,0.05,'industrial_complex','Produces armored and vehicle units.'),
('aerospace_dock','Aerospace Dock','fleet','interceptor_wing',4,150,1,0.06,'industrial_complex','Produces aerospace and fleet units.'),
('covert_academy','Covert Academy','covert','spy_team',8,100,3,0.06,'command_center','Produces covert and counter-intelligence units.'),
('civilian_bureau','Civilian Bureau','civilian','miners',20,30,8,0.07,'civilian_habitat','Produces civilian job units.'),
('science_annex','Science Annex','government','scientists',5,180,1,0.08,'research_laboratory','Produces scientific and administrative specialists.')
ON DUPLICATE KEY UPDATE name=VALUES(name),output_unit_key=VALUES(output_unit_key),description=VALUES(description);

INSERT INTO research_nodes(node_key,name,branch,tier,max_level,base_time_seconds,base_metal,base_crystal,base_naquadah,base_energy,effect_key,effect_per_level,description) VALUES
('weapons_matrix','Weapons Matrix','military',1,21,300,200,400,30,50,'attack_multiplier',0.025,'Improves attack output for military units.'),
('shield_matrix','Shield Matrix','military',1,21,320,350,250,30,60,'defense_multiplier',0.025,'Improves defensive output for military units.'),
('fleet_navigation','Fleet Navigation','military',2,21,420,450,500,60,90,'fleet_speed',0.030,'Improves fleet speed and readiness.'),
('industrial_automation','Industrial Automation','civilian',1,21,360,500,300,40,80,'production_multiplier',0.030,'Improves production and construction throughput.'),
('life_support_science','Life Support Science','civilian',2,21,420,350,600,50,100,'population_multiplier',0.028,'Improves population capacity and life support.'),
('government_architecture','Government Architecture','government',2,21,480,450,550,80,120,'policy_multiplier',0.030,'Improves active government policy effects.'),
('quantum_computing','Quantum Computing','science',3,21,600,700,1000,150,200,'research_multiplier',0.035,'Improves research speed and technology scaling.'),
('counter_intelligence','Counter Intelligence','covert',2,21,420,400,650,90,120,'anti_covert_multiplier',0.030,'Improves detection and counter-espionage.'),
('anomaly_analysis','Anomaly Analysis','universal',3,21,540,550,850,120,160,'exploration_multiplier',0.030,'Improves exploration and anomaly rewards.')
ON DUPLICATE KEY UPDATE name=VALUES(name),effect_key=VALUES(effect_key),effect_per_level=VALUES(effect_per_level),description=VALUES(description);

INSERT INTO research_prerequisites(node_id,prerequisite_node_id,minimum_level)
SELECT child.id,parent.id,1 FROM research_nodes child JOIN research_nodes parent ON parent.node_key=CASE child.node_key WHEN 'fleet_navigation' THEN 'weapons_matrix' WHEN 'life_support_science' THEN 'industrial_automation' WHEN 'government_architecture' THEN 'industrial_automation' WHEN 'quantum_computing' THEN 'government_architecture' WHEN 'counter_intelligence' THEN 'weapons_matrix' WHEN 'anomaly_analysis' THEN 'quantum_computing' ELSE '' END
ON DUPLICATE KEY UPDATE minimum_level=VALUES(minimum_level);

INSERT IGNORE INTO player_buildings(player_id,building_type_id) SELECT p.id,b.id FROM players p CROSS JOIN building_types b;
INSERT IGNORE INTO player_production_tracks(player_id,production_track_id) SELECT p.id,t.id FROM players p CROSS JOIN production_tracks t;
INSERT IGNORE INTO player_research_nodes(player_id,node_id) SELECT p.id,n.id FROM players p CROSS JOIN research_nodes n;

-- Universe Civilization: Empire at Wars
-- Government systems, commander systems, 28 unit classes/types, and job classes.

CREATE TABLE IF NOT EXISTS commander_profiles (
  player_id INT UNSIGNED PRIMARY KEY,
  commander_class VARCHAR(40) NOT NULL DEFAULT 'strategist',
  command_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  command_xp BIGINT UNSIGNED NOT NULL DEFAULT 0,
  leadership DECIMAL(8,2) NOT NULL DEFAULT 10.00,
  tactics DECIMAL(8,2) NOT NULL DEFAULT 10.00,
  logistics DECIMAL(8,2) NOT NULL DEFAULT 10.00,
  diplomacy DECIMAL(8,2) NOT NULL DEFAULT 10.00,
  espionage DECIMAL(8,2) NOT NULL DEFAULT 10.00,
  science DECIMAL(8,2) NOT NULL DEFAULT 10.00,
  morale DECIMAL(8,2) NOT NULL DEFAULT 100.00,
  command_capacity INT UNSIGNED NOT NULL DEFAULT 100,
  fleet_capacity_bonus DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  combat_bonus DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  civilian_bonus DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS commander_skill_catalog (
  skill_key VARCHAR(60) PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  branch ENUM('military','civilian','government','universal') NOT NULL,
  max_level TINYINT UNSIGNED NOT NULL DEFAULT 21,
  base_effect DECIMAL(8,3) NOT NULL DEFAULT 0.010,
  description TEXT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_commander_skills (
  player_id INT UNSIGNED NOT NULL,
  skill_key VARCHAR(60) NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  unlocked_at TIMESTAMP NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id, skill_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (skill_key) REFERENCES commander_skill_catalog(skill_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS government_policies (
  policy_key VARCHAR(60) PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  branch ENUM('economy','military','civilian','diplomacy','science') NOT NULL,
  effect_json JSON NOT NULL,
  description TEXT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_government_policies (
  player_id INT UNSIGNED NOT NULL,
  policy_key VARCHAR(60) NOT NULL,
  level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  active TINYINT(1) NOT NULL DEFAULT 1,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id, policy_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (policy_key) REFERENCES government_policies(policy_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS unit_classes (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  unit_key VARCHAR(60) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL UNIQUE,
  class_group ENUM('military','civilian','support','special','government') NOT NULL,
  unit_type ENUM('infantry','vehicle','air','fleet','covert','worker','specialist') NOT NULL,
  role VARCHAR(60) NOT NULL,
  tier TINYINT UNSIGNED NOT NULL DEFAULT 1,
  population_cost INT UNSIGNED NOT NULL DEFAULT 1,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  food_upkeep DECIMAL(10,2) NOT NULL DEFAULT 0,
  water_upkeep DECIMAL(10,2) NOT NULL DEFAULT 0,
  attack_power DECIMAL(12,2) NOT NULL DEFAULT 0,
  defense_power DECIMAL(12,2) NOT NULL DEFAULT 0,
  covert_power DECIMAL(12,2) NOT NULL DEFAULT 0,
  hit_points DECIMAL(12,2) NOT NULL DEFAULT 100,
  speed DECIMAL(8,2) NOT NULL DEFAULT 1,
  accuracy DECIMAL(8,2) NOT NULL DEFAULT 1,
  morale DECIMAL(8,2) NOT NULL DEFAULT 1,
  carry_capacity DECIMAL(12,2) NOT NULL DEFAULT 0,
  science DECIMAL(8,2) NOT NULL DEFAULT 0,
  production_bonus DECIMAL(8,3) NOT NULL DEFAULT 0,
  description TEXT NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  KEY idx_unit_class_group (class_group,unit_type,tier)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_unit_rosters (
  player_id INT UNSIGNED NOT NULL,
  unit_class_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 0,
  veteran_level TINYINT UNSIGNED NOT NULL DEFAULT 0,
  readiness DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  condition_value DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id, unit_class_id),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (unit_class_id) REFERENCES unit_classes(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_job_assignments (
  player_id INT UNSIGNED NOT NULL,
  job_key VARCHAR(60) NOT NULL,
  assigned_population INT UNSIGNED NOT NULL DEFAULT 0,
  efficiency DECIMAL(8,3) NOT NULL DEFAULT 1.000,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (player_id, job_key),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO commander_skill_catalog(skill_key,name,branch,max_level,base_effect,description) VALUES
('field_command','Field Command','military',21,0.020,'Improves attack and defense coordination.'),
('fleet_doctrine','Fleet Doctrine','military',21,0.018,'Improves fleet readiness, speed, and capacity.'),
('logistics','Logistics Corps','civilian',21,0.020,'Reduces upkeep and improves carrying capacity.'),
('industrial_planning','Industrial Planning','civilian',21,0.022,'Improves civilian production and construction.'),
('diplomatic_service','Diplomatic Service','government',21,0.018,'Improves diplomacy, alliance capacity, and reputation.'),
('internal_security','Internal Security','government',21,0.020,'Improves counter-intelligence and stability.'),
('xeno_science','Xeno Science','universal',21,0.020,'Improves research, exploration, and anomaly analysis.')
ON DUPLICATE KEY UPDATE name=VALUES(name),branch=VALUES(branch),base_effect=VALUES(base_effect),description=VALUES(description);

INSERT INTO government_policies(policy_key,name,branch,effect_json,description) VALUES
('industrial_mobilization','Industrial Mobilization','economy','{"production":0.08,"military_upkeep":0.04}','Convert civilian capacity into faster military production.'),
('civilian_welfare','Civilian Welfare','civilian','{"population_growth":0.10,"morale":0.06,"food_upkeep":0.03}','Improves population growth and civilian morale.'),
('total_defense','Total Defense','military','{"defense":0.10,"attack":0.03,"economy":-0.04}','Raises defense readiness at an economic cost.'),
('open_diplomacy','Open Diplomacy','diplomacy','{"diplomacy":0.12,"trade":0.08}','Improves diplomacy, trade, and alliance relations.'),
('research_directive','Research Directive','science','{"research":0.12,"energy_upkeep":0.04}','Prioritizes science and technology development.')
ON DUPLICATE KEY UPDATE name=VALUES(name),effect_json=VALUES(effect_json),description=VALUES(description);

INSERT INTO unit_classes(unit_key,name,class_group,unit_type,role,tier,population_cost,metal_cost,crystal_cost,naquadah_cost,energy_cost,food_upkeep,water_upkeep,attack_power,defense_power,covert_power,hit_points,speed,accuracy,morale,carry_capacity,science,production_bonus,description) VALUES
('militia','Militia','military','infantry','garrison',1,1,20,5,0,1,0.10,0.10,8,10,0,80,1.00,0.80,1.00,0,0,0,'Basic settlement defense.'),
('rifle_squad','Rifle Squad','military','infantry','line infantry',2,1,45,10,0,2,0.12,0.12,18,15,0,110,1.10,0.90,1.00,0,0,0,'Reliable frontline infantry.'),
('heavy_infantry','Heavy Infantry','military','infantry','assault infantry',3,2,90,25,4,4,0.18,0.16,34,28,0,190,0.90,0.86,1.02,0,0,0,'Armored assault troops.'),
('shock_troopers','Shock Troopers','military','infantry','shock assault',5,2,180,60,12,7,0.22,0.20,65,36,0,260,1.20,0.92,1.08,0,0,0,'Rapid breach specialists.'),
('commandos','Commandos','military','infantry','special operations',6,2,220,110,20,8,0.20,0.18,58,30,45,220,1.35,1.08,1.12,0,0,0,'Elite infiltration infantry.'),
('armor_column','Armor Column','military','vehicle','armored assault',4,3,260,55,10,10,0.28,0.22,82,76,0,520,0.75,0.88,1.04,0,0,0,'Heavy armored vehicles.'),
('siege_artillery','Siege Artillery','military','vehicle','siege',7,3,380,90,18,15,0.30,0.24,120,42,0,430,0.55,0.94,0.98,0,0,0,'Long-range structure breaker.'),
('scout_bikes','Scout Bikes','military','vehicle','recon',3,1,80,20,3,5,0.14,0.12,22,16,12,140,1.80,0.96,1.04,40,0,0,'Fast reconnaissance vehicles.'),
('interceptor_wing','Interceptor Wing','military','air','air superiority',6,2,300,140,22,20,0.24,0.18,96,45,0,300,2.10,1.02,1.06,0,0,0,'Fast atmospheric interceptors.'),
('bomber_wing','Bomber Wing','military','air','strategic strike',8,3,520,210,35,30,0.34,0.24,160,34,0,360,1.30,0.90,1.00,0,0,0,'Heavy strategic bombers.'),
('corvette','Corvette','military','fleet','patrol fleet',4,4,500,180,30,25,0.40,0.30,130,100,0,700,1.40,0.92,1.02,300,0,0,'Light patrol vessel.'),
('frigate','Frigate','military','fleet','escort fleet',6,6,900,350,55,45,0.60,0.42,230,210,0,1200,1.15,0.95,1.04,500,0,0,'Balanced escort ship.'),
('destroyer','Destroyer','military','fleet','line warship',8,8,1500,600,100,70,0.85,0.56,410,360,0,1900,0.95,0.96,1.05,800,0,0,'Line combat warship.'),
('cruiser','Cruiser','military','fleet','capital escort',10,12,2600,1100,180,120,1.20,0.80,700,620,0,3300,0.78,0.98,1.08,1200,0,0,'Heavy command escort.'),
('battleship','Battleship','military','fleet','capital assault',13,18,5200,2200,380,220,1.80,1.20,1450,1150,0,6200,0.60,1.00,1.10,1800,0,0,'Major line-of-battle ship.'),
('carrier','Carrier','military','fleet','fleet command',12,20,4600,2500,420,260,1.70,1.15,950,980,0,7000,0.62,0.92,1.12,2200,0,0,'Deploys and coordinates aerospace wings.'),
('dreadnought','Dreadnought','military','fleet','super capital',17,30,10000,5200,900,500,2.80,1.90,3200,2800,0,14000,0.42,1.02,1.16,4000,0,0,'Strategic super-capital warship.'),
('spy_team','Spy Team','special','covert','reconnaissance',2,1,35,45,8,3,0.08,0.08,0,4,32,60,1.50,1.10,1.00,10,0,0,'Collects classified intelligence.'),
('infiltrators','Infiltrators','special','covert','sabotage',5,1,90,120,20,6,0.10,0.10,4,8,75,90,1.30,1.18,1.02,25,0,0,'Conducts covert disruption.'),
('counter_agents','Counter Agents','special','covert','counter-intelligence',4,1,70,90,16,5,0.10,0.10,0,10,68,85,1.20,1.15,1.04,15,0,0,'Protects against espionage.'),
('engineer_corps','Engineer Corps','civilian','worker','construction',2,1,30,15,0,3,0.12,0.10,0,8,0,100,0.90,0.80,1.00,80,8,0.04,'Builds and repairs infrastructure.'),
('miners','Miners','civilian','worker','metal extraction',1,1,15,5,0,1,0.10,0.10,0,2,0,70,0.80,0.70,1.00,120,0,0.06,'Increases metal production.'),
('crystal_harvesters','Crystal Harvesters','civilian','worker','crystal extraction',2,1,20,12,0,2,0.10,0.10,0,2,0,75,0.85,0.72,1.00,90,0,0.06,'Increases crystal production.'),
('farmers','Farmers','civilian','worker','food production',1,1,12,4,0,1,0.08,0.12,0,2,0,70,0.75,0.70,1.00,100,0,0.08,'Increases food production.'),
('hydrologists','Hydrologists','civilian','worker','water production',2,1,18,8,0,2,0.08,0.10,0,2,0,75,0.80,0.72,1.00,100,4,0.08,'Increases water and life-support output.'),
('scientists','Scientists','civilian','specialist','research',4,1,30,80,4,8,0.12,0.10,0,4,5,80,0.80,0.90,1.02,10,18,0,'Improves technology research.'),
('diplomats','Diplomats','civilian','specialist','diplomacy',3,1,25,55,3,5,0.10,0.10,0,3,8,75,0.90,0.88,1.05,5,10,0,'Improves diplomacy and reputation.'),
('administrators','Administrators','government','specialist','governance',3,1,35,45,5,5,0.10,0.10,0,6,12,90,0.85,0.86,1.08,15,12,0.03,'Improves policy execution and stability.')
ON DUPLICATE KEY UPDATE name=VALUES(name),class_group=VALUES(class_group),unit_type=VALUES(unit_type),role=VALUES(role),tier=VALUES(tier),attack_power=VALUES(attack_power),defense_power=VALUES(defense_power),covert_power=VALUES(covert_power),description=VALUES(description);

INSERT INTO commander_profiles(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM commander_profiles cp WHERE cp.player_id=p.id);
INSERT IGNORE INTO player_unit_rosters(player_id,unit_class_id) SELECT p.id,u.id FROM players p CROSS JOIN unit_classes u;
INSERT IGNORE INTO player_government_policies(player_id,policy_key) SELECT p.id,g.policy_key FROM players p CROSS JOIN government_policies g;
INSERT IGNORE INTO player_commander_skills(player_id,skill_key) SELECT p.id,s.skill_key FROM players p CROSS JOIN commander_skill_catalog s;

UPDATE commander_profiles cp JOIN players p ON p.id=cp.player_id SET cp.commander_class=CASE WHEN p.rank_level >= 15 THEN 'warlord' WHEN p.rank_level >= 8 THEN 'marshal' ELSE 'strategist' END;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT player_id,'miners',miners FROM player_resources;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT player_id,'lifers',lifers FROM player_resources;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'administrators',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'scientists',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'diplomats',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'engineer_corps',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'farmers',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'hydrologists',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'crystal_harvesters',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'counter_agents',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'spy_team',0 FROM players;
INSERT IGNORE INTO player_job_assignments(player_id,job_key,assigned_population) SELECT id,'infiltrators',0 FROM players;

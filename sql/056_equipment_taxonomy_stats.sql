-- Universe Civilization: Empire at Wars
-- Equipment taxonomy and bounded combat statistics.
CREATE TABLE IF NOT EXISTS equipment_class_catalog (
  class_id VARCHAR(16) NOT NULL PRIMARY KEY,
  equipment_group VARCHAR(32) NOT NULL,
  class_code CHAR(1) NOT NULL,
  subclass_code VARCHAR(16) NOT NULL,
  class_name VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  UNIQUE KEY uq_equipment_class_code(class_code,subclass_code)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS equipment_design_catalog (
  design_key VARCHAR(40) NOT NULL PRIMARY KEY,
  class_id VARCHAR(16) NOT NULL,
  type_code VARCHAR(24) NOT NULL,
  subtype_code VARCHAR(24) NOT NULL,
  display_name VARCHAR(120) NOT NULL,
  tier TINYINT UNSIGNED NOT NULL DEFAULT 1,
  max_level TINYINT UNSIGNED NOT NULL DEFAULT 99,
  damage_type VARCHAR(32) NOT NULL DEFAULT 'none',
  primary_stat VARCHAR(32) NOT NULL,
  base_offense DECIMAL(12,3) NOT NULL DEFAULT 0,
  base_defense DECIMAL(12,3) NOT NULL DEFAULT 0,
  base_shield DECIMAL(12,3) NOT NULL DEFAULT 0,
  base_armor DECIMAL(12,3) NOT NULL DEFAULT 0,
  accuracy DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  penetration DECIMAL(7,3) NOT NULL DEFAULT 0.000,
  resistance DECIMAL(7,3) NOT NULL DEFAULT 0.000,
  mobility DECIMAL(7,3) NOT NULL DEFAULT 1.000,
  sensor_bonus DECIMAL(7,3) NOT NULL DEFAULT 0.000,
  power_draw INT UNSIGNED NOT NULL DEFAULT 0,
  heat_generation INT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost INT UNSIGNED NOT NULL DEFAULT 0,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  durability INT UNSIGNED NOT NULL DEFAULT 100,
  description TEXT NOT NULL,
  FOREIGN KEY (class_id) REFERENCES equipment_class_catalog(class_id) ON DELETE RESTRICT,
  KEY idx_equipment_design_class(class_id,type_code,subtype_code),
  KEY idx_equipment_design_tier(tier,max_level)
) ENGINE=InnoDB;

ALTER TABLE weapon_types
  ADD COLUMN IF NOT EXISTS design_key VARCHAR(40) NULL,
  ADD COLUMN IF NOT EXISTS type_code VARCHAR(24) NULL,
  ADD COLUMN IF NOT EXISTS subtype_code VARCHAR(24) NULL,
  ADD COLUMN IF NOT EXISTS damage_type VARCHAR(32) NOT NULL DEFAULT 'kinetic',
  ADD COLUMN IF NOT EXISTS offense_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS defense_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS shield_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS armor_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS penetration DECIMAL(7,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS accuracy DECIMAL(7,3) NOT NULL DEFAULT 1,
  ADD COLUMN IF NOT EXISTS power_draw INT UNSIGNED NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS equipment_level TINYINT UNSIGNED NOT NULL DEFAULT 1;

ALTER TABLE player_weapons
  ADD COLUMN IF NOT EXISTS design_key VARCHAR(40) NULL,
  ADD COLUMN IF NOT EXISTS equipment_level TINYINT UNSIGNED NOT NULL DEFAULT 1,
  ADD COLUMN IF NOT EXISTS tier TINYINT UNSIGNED NOT NULL DEFAULT 1,
  ADD COLUMN IF NOT EXISTS offense_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS defense_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS shield_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS armor_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS heat DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS installed_on VARCHAR(80) NULL;

ALTER TABLE planet_defenses
  ADD COLUMN IF NOT EXISTS design_key VARCHAR(40) NULL,
  ADD COLUMN IF NOT EXISTS class_id VARCHAR(16) NULL,
  ADD COLUMN IF NOT EXISTS subtype_code VARCHAR(24) NULL,
  ADD COLUMN IF NOT EXISTS shield_integrity DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS armor_integrity DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS offense_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS detection_power DECIMAL(12,3) NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS power_draw INT UNSIGNED NOT NULL DEFAULT 0;

INSERT INTO equipment_class_catalog (class_id,equipment_group,class_code,subclass_code,class_name,description) VALUES
('EQ-A-KIN','weapon','A','KIN','Kinetic Weapons','Mass-driver and ballistic weapons that trade rate of fire for reliable physical penetration.'),
('EQ-B-ENE','weapon','B','ENE','Energy Weapons','Beam and pulse weapons using reactor output for precision damage.'),
('EQ-C-MIS','weapon','C','MIS','Missile Weapons','Guided explosive systems with range, payload, and reload tradeoffs.'),
('EQ-D-PLA','weapon','D','PLA','Plasma Weapons','High-heat plasma systems with strong armor damage and power draw.'),
('EQ-E-SHD','defense','E','SHD','Shield Systems','Regenerative and directional energy barriers that absorb incoming damage.'),
('EQ-F-ARM','defense','F','ARM','Armor Systems','Layered hull and structural armor that reduces penetrating damage.'),
('EQ-G-PNT','defense','G','PNT','Point Defense','Intercept systems that improve accuracy, evasion, and missile resistance.'),
('EQ-H-SUP','support','H','SUP','Support Systems','Sensors, command, cooling, and logistics systems that improve secondary stats.')
ON DUPLICATE KEY UPDATE class_name=VALUES(class_name),description=VALUES(description),equipment_group=VALUES(equipment_group);

INSERT INTO equipment_design_catalog (design_key,class_id,type_code,subtype_code,display_name,tier,max_level,damage_type,primary_stat,base_offense,base_defense,base_shield,base_armor,accuracy,penetration,resistance,mobility,sensor_bonus,power_draw,heat_generation,energy_cost,metal_cost,crystal_cost,deuterium_cost,naquadah_cost,durability,description) VALUES
('KIN-RAIL-01','EQ-A-KIN','railgun','magnetic_rail','Magnetic Railgun',1,99,'kinetic','offense',90,0,0,20,0.92,0.18,0,0.90,0,18,10,6,1200,500,40,600,100,'A reliable kinetic battery for general-purpose offense.'),
('KIN-COIL-02','EQ-A-KIN','coilgun','mass_driver','Coil Mass Driver',2,99,'kinetic','penetration',150,0,0,35,0.88,0.28,0,0.82,0,30,16,10,2200,900,80,1200,120,'High-penetration kinetic system with reduced mobility.'),
('ENE-LASER-01','EQ-B-ENE','laser','beam','Pulse Laser',1,99,'energy','accuracy',70,0,0,0,1.08,0.10,0.08,0.96,5,22,8,12,900,1300,70,800,100,'Accurate energy weapon with moderate shield interaction.'),
('ENE-BEAM-02','EQ-B-ENE','laser','focused_beam','Focused Beam Array',2,99,'energy','offense',135,0,0,0,1.02,0.18,0.12,0.88,8,40,18,22,1600,2400,120,1600,120,'Focused beam array for sustained offensive pressure.'),
('MIS-RACK-01','EQ-C-MIS','missile','guided_rocket','Guided Missile Rack',1,99,'explosive','offense',110,0,0,25,0.84,0.22,0,0.86,0,16,5,8,1500,800,90,900,100,'Guided payload system with strong range and reload utility.'),
('MIS-TORP-02','EQ-C-MIS','missile','torpedo','Siege Torpedo',2,99,'explosive','penetration',210,0,0,45,0.72,0.38,0,0.68,0,34,20,18,2800,1400,180,1800,120,'Heavy siege projectile for fortifications and capital hulls.'),
('PLA-CAST-01','EQ-D-PLA','plasma','caster','Plasma Caster',1,99,'plasma','offense',125,0,0,10,0.82,0.25,0.05,0.80,0,38,28,18,1800,1900,140,1300,100,'High-damage plasma system with meaningful heat generation.'),
('PLA-LANCE-02','EQ-D-PLA','plasma','lance','Plasma Lance',2,99,'plasma','penetration',250,0,0,20,0.70,0.48,0.06,0.60,0,65,45,30,3200,2800,220,2400,120,'Capital-grade lance with extreme penetration and heat.'),
('SHD-DEF-01','EQ-E-SHD','shield','deflector','Deflector Shield',1,99,'none','shield',0,45,180,0,0.96,0,0.18,0.94,0,20,5,14,1000,1700,100,1000,100,'Regenerative protection for ships and orbital installations.'),
('SHD-PHASE-02','EQ-E-SHD','shield','phase','Phase Shield Matrix',2,99,'none','resistance',0,90,340,0,0.93,0,0.35,0.86,4,44,16,28,2100,3200,180,2200,120,'Layered shield matrix with improved resistance and sensor support.'),
('ARM-CERAM-01','EQ-F-ARM','armor','ceramic','Ceramic Composite Armor',1,99,'none','armor',0,30,0,170,0.98,0.05,0.22,0.88,0,12,2,6,1800,500,50,900,100,'Light armor that improves hull integrity without crippling mobility.'),
('ARM-NANO-02','EQ-F-ARM','armor','nanolaminate','Nanolaminate Armor',2,99,'none','resistance',0,75,0,310,0.96,0.10,0.40,0.75,0,28,5,12,3500,1200,100,1800,120,'Self-repairing layered armor with strong resistance.'),
('PNT-INTER-01','EQ-G-PNT','point_defense','interceptor','Interceptor Grid',1,99,'none','accuracy',35,40,0,30,1.05,0.08,0.10,1.02,10,18,6,10,1200,900,60,800,100,'Automated interceptors improve accuracy, defense, and missile interception.'),
('PNT-FLAK-02','EQ-G-PNT','point_defense','flak','Flak Curtain',2,99,'none','defense',70,80,0,55,1.00,0.15,0.18,0.94,14,32,12,18,2200,1500,120,1400,120,'Dense defensive screen for fleets and planetary defenses.'),
('SUP-SENS-01','EQ-H-SUP','support','sensor','Deep-Space Sensor',1,99,'none','sensor',0,20,0,0,1.00,0,0.05,1.00,35,10,2,8,600,1100,60,700,100,'Improves detection, targeting, and exploration confidence.'),
('SUP-CORE-02','EQ-H-SUP','support','command_core','Tactical Command Core',2,99,'none','command',20,65,80,60,1.02,0.05,0.12,1.06,20,26,4,16,1600,2300,120,1600,120,'Command and control system that improves balanced combat readiness.')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),tier=VALUES(tier),description=VALUES(description),base_offense=VALUES(base_offense),base_defense=VALUES(base_defense),base_shield=VALUES(base_shield),base_armor=VALUES(base_armor),accuracy=VALUES(accuracy),penetration=VALUES(penetration),resistance=VALUES(resistance),mobility=VALUES(mobility),sensor_bonus=VALUES(sensor_bonus),power_draw=VALUES(power_draw),heat_generation=VALUES(heat_generation),energy_cost=VALUES(energy_cost),metal_cost=VALUES(metal_cost),crystal_cost=VALUES(crystal_cost),deuterium_cost=VALUES(deuterium_cost),naquadah_cost=VALUES(naquadah_cost),durability=VALUES(durability);

UPDATE weapon_types wt JOIN equipment_design_catalog ed ON ed.design_key=wt.design_key SET wt.type_code=ed.type_code,wt.subtype_code=ed.subtype_code,wt.damage_type=ed.damage_type,wt.offense_power=ed.base_offense,wt.defense_power=ed.base_defense,wt.shield_power=ed.base_shield,wt.armor_power=ed.base_armor,wt.penetration=ed.penetration,wt.accuracy=ed.accuracy,wt.power_draw=ed.power_draw,wt.deuterium_cost=ed.deuterium_cost;

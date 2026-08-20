-- StargateWars registration factions and government systems.
-- Apply after 011_full_gameplay_features.sql.

CREATE TABLE IF NOT EXISTS government_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  government_key VARCHAR(60) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL UNIQUE,
  description TEXT NOT NULL,
  economy_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  research_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  military_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  defense_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  covert_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  diplomacy_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  colony_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  fleet_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  population_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  dark_matter_modifier DECIMAL(6,3) NOT NULL DEFAULT 1.000,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

ALTER TABLE players ADD COLUMN IF NOT EXISTS government_id INT UNSIGNED NULL AFTER race_id;
ALTER TABLE players ADD COLUMN IF NOT EXISTS registration_completed_at DATETIME NULL;
ALTER TABLE players ADD CONSTRAINT fk_players_government FOREIGN KEY (government_id) REFERENCES government_types(id) ON DELETE SET NULL;

CREATE TABLE IF NOT EXISTS player_government_history (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  government_id INT UNSIGNED NOT NULL,
  reason ENUM('registration','reform','conquest','event','admin') NOT NULL DEFAULT 'registration',
  changed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (government_id) REFERENCES government_types(id),
  KEY idx_government_history_player (player_id,changed_at)
) ENGINE=InnoDB;

INSERT INTO races (name,bonus_label,bonus_percent,bank_name,attack_modifier,defense_modifier,income_modifier,covert_modifier) VALUES
('Tau\'ri','Balanced industrial growth and diplomacy',8.00,'Terran Reserve',1.000,1.000,1.080,1.040),
('Goa\'uld','Command authority and military pressure',12.00,'System Lord Treasury',1.120,1.040,1.000,0.960),
('Asgard','Advanced research and defensive systems',14.00,'Asgard Quantum Vault',0.980,1.140,1.020,1.120),
('Wraith','Population conversion and aggressive fleet logistics',10.00,'Hive Biomass Reserve',1.080,0.960,1.060,1.000),
('Tok\'ra','Covert intelligence and resistance networks',11.00,'Resistance Cache',1.000,1.020,1.040,1.140)
ON DUPLICATE KEY UPDATE bonus_label=VALUES(bonus_label),bonus_percent=VALUES(bonus_percent),bank_name=VALUES(bank_name),attack_modifier=VALUES(attack_modifier),defense_modifier=VALUES(defense_modifier),income_modifier=VALUES(income_modifier),covert_modifier=VALUES(covert_modifier);

INSERT INTO government_types (government_key,name,description,economy_modifier,research_modifier,military_modifier,defense_modifier,covert_modifier,diplomacy_modifier,colony_modifier,fleet_modifier,population_modifier,dark_matter_modifier) VALUES
('republic','Stellar Republic','Representative government with balanced taxation and diplomacy.',1.050,1.020,0.980,1.000,1.000,1.120,1.000,0.980,1.020,1.000),
('empire','Militarized Empire','Centralized command that converts industry into military power.',1.020,0.960,1.120,1.040,0.940,0.900,1.000,1.060,0.980,1.000),
('federation','Trade Federation','Commercial federation optimized for logistics and exchange.',1.120,1.000,0.960,0.980,0.980,1.080,1.040,1.100,1.040,1.020),
('theocracy','Gate Theocracy','Religious hierarchy that amplifies unity, morale, and influence.',1.000,1.060,1.020,1.060,1.020,1.100,1.020,0.960,1.080,1.040),
('technocracy','Research Technocracy','Scientist-led government focused on technology and automation.',0.980,1.160,0.980,1.020,1.080,0.940,1.000,0.960,0.960,1.060),
('hive','Hive Collective','Collective society with high population throughput and fleet coordination.',1.020,0.940,1.080,0.940,0.960,0.860,1.140,1.120,1.180,0.980),
('corporate','Corporate Directorate','Private-sector administration that accelerates production and markets.',1.140,0.980,0.940,0.960,1.000,1.020,1.020,1.040,0.980,1.080),
('military_junta','Military Junta','Permanent war footing with powerful defense and direct command.',0.960,0.920,1.160,1.120,0.900,0.820,0.980,1.080,0.940,0.960),
('council','Free Systems Council','Loose coalition that excels at espionage, diplomacy, and autonomy.',1.000,1.040,0.940,1.000,1.140,1.160,1.020,0.980,1.000,1.020)
ON DUPLICATE KEY UPDATE description=VALUES(description),economy_modifier=VALUES(economy_modifier),research_modifier=VALUES(research_modifier),military_modifier=VALUES(military_modifier),defense_modifier=VALUES(defense_modifier),covert_modifier=VALUES(covert_modifier),diplomacy_modifier=VALUES(diplomacy_modifier),colony_modifier=VALUES(colony_modifier),fleet_modifier=VALUES(fleet_modifier),population_modifier=VALUES(population_modifier),dark_matter_modifier=VALUES(dark_matter_modifier);

UPDATE players p JOIN government_types g ON g.government_key='republic' SET p.government_id=g.id WHERE p.government_id IS NULL;

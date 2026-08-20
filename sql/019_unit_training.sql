ALTER TABLE player_unit_stats ADD COLUMN IF NOT EXISTS academy_level INT UNSIGNED NOT NULL DEFAULT 1;

CREATE TABLE IF NOT EXISTS unit_types (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  unit_key VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  category ENUM('workforce','military','covert') NOT NULL,
  stat_column VARCHAR(40) NOT NULL,
  recruit_cost BIGINT UNSIGNED NOT NULL DEFAULT 100,
  seconds_per_unit INT UNSIGNED NOT NULL DEFAULT 30,
  academy_level_required INT UNSIGNED NOT NULL DEFAULT 1,
  base_power INT UNSIGNED NOT NULL DEFAULT 1,
  description TEXT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS training_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  unit_type_id INT UNSIGNED NOT NULL,
  quantity INT UNSIGNED NOT NULL,
  academy_level INT UNSIGNED NOT NULL,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','processing','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_training_queue_due(status,completes_at),
  CONSTRAINT fk_training_queue_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_training_queue_type FOREIGN KEY(unit_type_id) REFERENCES unit_types(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO unit_types(unit_key,name,category,stat_column,recruit_cost,seconds_per_unit,academy_level_required,base_power,description) VALUES
('miners','Miners','workforce','miners',80,20,1,1,'Assign workers to mining and resource extraction.'),
('lifers','Lifers','workforce','lifers',100,25,1,1,'Assign workers to life-support and population services.'),
('attack_units','Attack Units','military','attack_units',250,40,1,5,'Train standard offensive fleet personnel.'),
('defense_units','Defense Units','military','defense_units',220,40,1,5,'Train standard defensive personnel.'),
('spies','Spies','covert','spies',300,50,2,3,'Train covert intelligence operatives.'),
('anti_spies','Anti-Covert Agents','covert','anti_spies',280,50,2,3,'Train counter-intelligence operatives.')
ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),stat_column=VALUES(stat_column),recruit_cost=VALUES(recruit_cost),seconds_per_unit=VALUES(seconds_per_unit),academy_level_required=VALUES(academy_level_required),base_power=VALUES(base_power),description=VALUES(description);

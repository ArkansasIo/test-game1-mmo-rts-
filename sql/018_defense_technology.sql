CREATE TABLE IF NOT EXISTS technology_prerequisites (
  technology_id INT UNSIGNED NOT NULL,
  prerequisite_id INT UNSIGNED NOT NULL,
  required_level INT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (technology_id, prerequisite_id),
  CONSTRAINT fk_tech_prereq_target FOREIGN KEY (technology_id) REFERENCES technologies(id) ON DELETE CASCADE,
  CONSTRAINT fk_tech_prereq_source FOREIGN KEY (prerequisite_id) REFERENCES technologies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES
('shield_harmonics','Shield Harmonics','defense',15000,1.55,8,'Improves orbital shield harmonics and defensive absorption.'),
('orbital_bastion','Orbital Bastion','defense',30000,1.60,12,'Adds layered orbital bastion defenses to every controlled colony.')
ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description);

INSERT INTO technology_prerequisites(technology_id,prerequisite_id,required_level)
SELECT child.id,parent.id,2 FROM technologies child JOIN technologies parent ON parent.technology_key='fortification' WHERE child.technology_key='shield_harmonics'
ON DUPLICATE KEY UPDATE required_level=VALUES(required_level);
INSERT INTO technology_prerequisites(technology_id,prerequisite_id,required_level)
SELECT child.id,parent.id,2 FROM technologies child JOIN technologies parent ON parent.technology_key='shield_harmonics' WHERE child.technology_key='orbital_bastion'
ON DUPLICATE KEY UPDATE required_level=VALUES(required_level);

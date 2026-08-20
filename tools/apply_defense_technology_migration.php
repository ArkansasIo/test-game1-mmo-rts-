<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$pdo->exec("CREATE TABLE IF NOT EXISTS technology_prerequisites (technology_key VARCHAR(80) NOT NULL, prerequisite_key VARCHAR(80) NOT NULL, minimum_level INT UNSIGNED NOT NULL DEFAULT 1, PRIMARY KEY (technology_key,prerequisite_key), CONSTRAINT technology_prerequisites_ibfk_1 FOREIGN KEY (technology_key) REFERENCES technologies(technology_key) ON DELETE CASCADE, CONSTRAINT technology_prerequisites_ibfk_2 FOREIGN KEY (prerequisite_key) REFERENCES technologies(technology_key) ON DELETE CASCADE) ENGINE=InnoDB");
$pdo->exec("INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES ('shield_harmonics','Shield Harmonics','defense',15000,1.55,8,'Improves orbital shield harmonics and defensive absorption.'),('orbital_bastion','Orbital Bastion','defense',30000,1.60,12,'Adds layered orbital bastion defenses to every controlled colony.') ON DUPLICATE KEY UPDATE category=VALUES(category),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description)");
$pdo->exec("INSERT INTO technology_prerequisites(technology_key,prerequisite_key,minimum_level) VALUES ('shield_harmonics','fortification',2),('orbital_bastion','shield_harmonics',2) ON DUPLICATE KEY UPDATE minimum_level=VALUES(minimum_level)");
echo "defense_technology_migration=applied\n";

<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$pdo->exec("INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES('deep_cover','Deep Cover Networks','covert',14000,1.50,7,'Improves long-duration infiltration and agent concealment.'),('social_engineering','Social Engineering','covert',22000,1.55,10,'Improves intelligence extraction and target manipulation.'),('quantum_masking','Quantum Masking','covert',40000,1.65,16,'Reduces detection exposure during advanced covert operations.') ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description)");
$pdo->exec("INSERT INTO technology_prerequisites(technology_key,prerequisite_key,minimum_level) VALUES('deep_cover','infiltration',2),('social_engineering','deep_cover',2),('quantum_masking','social_engineering',2) ON DUPLICATE KEY UPDATE minimum_level=VALUES(minimum_level)");
echo "covert_technology_migration=applied\n";

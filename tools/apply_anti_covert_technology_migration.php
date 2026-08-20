<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$pdo->exec("INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES('signal_analysis','Signal Analysis Array','anti_covert',14000,1.50,7,'Improves interception of hostile transmissions and covert signatures.'),('countermeasure_matrix','Countermeasure Matrix','anti_covert',22000,1.55,10,'Improves automated detection and covert-operation disruption.'),('quantum_sentinel','Quantum Sentinel Grid','anti_covert',40000,1.65,16,'Provides advanced counter-intelligence across all colonies.') ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description)");
$pdo->exec("INSERT INTO technology_prerequisites(technology_key,prerequisite_key,minimum_level) VALUES('signal_analysis','detection',2),('countermeasure_matrix','signal_analysis',2),('quantum_sentinel','countermeasure_matrix',2) ON DUPLICATE KEY UPDATE minimum_level=VALUES(minimum_level)");
echo "anti_covert_technology_migration=applied\n";

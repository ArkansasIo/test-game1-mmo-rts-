<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
$pdo=db();
$pdo->exec("CREATE TABLE IF NOT EXISTS production_queues (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,player_id INT UNSIGNED NOT NULL,queue_type ENUM('unit_production','academy','elite_capacity') NOT NULL DEFAULT 'unit_production',level_before INT UNSIGNED NOT NULL,level_after INT UNSIGNED NOT NULL,technology_modifier DECIMAL(8,3) NOT NULL DEFAULT 1.000,starts_at DATETIME NOT NULL,completes_at DATETIME NOT NULL,status ENUM('queued','processing','completed','cancelled') NOT NULL DEFAULT 'queued',created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,KEY idx_production_queue_due(status,completes_at),CONSTRAINT fk_production_queue_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE) ENGINE=InnoDB");
$pdo->exec("INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES('automation','Industrial Automation','unique',18000,1.55,8,'Improves unit production efficiency and queue throughput.') ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description)");
echo "unit_production_migration=applied\n";

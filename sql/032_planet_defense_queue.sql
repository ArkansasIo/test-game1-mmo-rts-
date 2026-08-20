ALTER TABLE production_queues MODIFY queue_type ENUM('unit_production','academy','elite_capacity','defense') NOT NULL DEFAULT 'unit_production';

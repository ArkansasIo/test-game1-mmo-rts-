CREATE TABLE IF NOT EXISTS population_assignments (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  colony_id INT UNSIGNED NOT NULL,
  role ENUM('miners','lifers') NOT NULL,
  assigned_population INT UNSIGNED NOT NULL DEFAULT 0,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_colony_role(colony_id,role),
  CONSTRAINT fk_assignment_colony FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO population_assignments(colony_id,role,assigned_population)
SELECT c.id,'miners',LEAST(c.population,COALESCE(pr.miners,0))
FROM colonies c JOIN player_resources pr ON pr.player_id=c.player_id
ON DUPLICATE KEY UPDATE assigned_population=VALUES(assigned_population);
INSERT INTO population_assignments(colony_id,role,assigned_population)
SELECT c.id,'lifers',LEAST(GREATEST(c.population-COALESCE(pa.assigned_population,0),0),COALESCE(pr.lifers,0))
FROM colonies c JOIN player_resources pr ON pr.player_id=c.player_id
LEFT JOIN population_assignments pa ON pa.colony_id=c.id AND pa.role='miners'
ON DUPLICATE KEY UPDATE assigned_population=VALUES(assigned_population);

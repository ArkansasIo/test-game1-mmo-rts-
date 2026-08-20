CREATE TABLE IF NOT EXISTS research_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  technology_id INT UNSIGNED NOT NULL,
  technology_key VARCHAR(80) NOT NULL,
  level_before INT UNSIGNED NOT NULL,
  level_after INT UNSIGNED NOT NULL,
  base_effect DECIMAL(10,3) NOT NULL,
  tier_coefficient DECIMAL(8,3) NOT NULL,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','researching','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_research_queue_due(status,completes_at),
  CONSTRAINT fk_research_queue_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_research_queue_technology FOREIGN KEY(technology_id) REFERENCES technologies(id) ON DELETE CASCADE
) ENGINE=InnoDB;

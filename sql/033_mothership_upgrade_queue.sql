CREATE TABLE IF NOT EXISTS mothership_upgrade_queue (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  mothership_id INT UNSIGNED NOT NULL,
  module_key VARCHAR(80) NOT NULL,
  level_before INT UNSIGNED NOT NULL,
  level_after INT UNSIGNED NOT NULL,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','processing','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_mothership_queue_due(status,completes_at),
  CONSTRAINT fk_msq_player FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  CONSTRAINT fk_msq_ship FOREIGN KEY(mothership_id) REFERENCES motherships(id) ON DELETE CASCADE
) ENGINE=InnoDB;

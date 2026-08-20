-- Adds the premium-style strategic resource displayed in the five-resource header.
-- Apply after 009_universe_galaxy_systems.sql.

ALTER TABLE player_resources
  ADD COLUMN IF NOT EXISTS dark_matter BIGINT UNSIGNED NOT NULL DEFAULT 2500 AFTER naquadah;

CREATE TABLE IF NOT EXISTS dark_matter_transactions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  amount BIGINT NOT NULL,
  transaction_type ENUM('grant','spend','purchase','reward','admin_adjustment') NOT NULL,
  reference_key VARCHAR(120) NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  KEY idx_dm_player_created (player_id,created_at),
  KEY idx_dm_type (transaction_type)
) ENGINE=InnoDB;

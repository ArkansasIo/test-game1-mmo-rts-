-- Ranking component persistence for transparent score calculation
ALTER TABLE rankings
  ADD COLUMN technology_score BIGINT NOT NULL DEFAULT 0 AFTER covert_score,
  ADD COLUMN glory_score BIGINT NOT NULL DEFAULT 0 AFTER technology_score,
  ADD COLUMN penalty_score BIGINT NOT NULL DEFAULT 0 AFTER glory_score;

ALTER TABLE rank_snapshots
  ADD COLUMN technology_score BIGINT NOT NULL DEFAULT 0 AFTER covert_score,
  ADD COLUMN glory_score BIGINT NOT NULL DEFAULT 0 AFTER technology_score,
  ADD COLUMN penalty_score BIGINT NOT NULL DEFAULT 0 AFTER glory_score;

INSERT INTO game_settings (setting_key, setting_value)
VALUES ('ranking_refresh_cooldown_seconds', '0')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

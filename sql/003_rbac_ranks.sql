USE stargatewars;

ALTER TABLE players
  ADD COLUMN IF NOT EXISTS rank_level INT UNSIGNED NOT NULL DEFAULT 1 AFTER race_id,
  ADD COLUMN IF NOT EXISTS rank_name VARCHAR(50) NOT NULL DEFAULT 'Initiate' AFTER rank_level;

UPDATE players SET rank_level = 3, rank_name = 'Commander' WHERE username = 'demo';

CREATE TABLE IF NOT EXISTS rank_definitions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rank_level INT UNSIGNED NOT NULL UNIQUE,
  name VARCHAR(50) NOT NULL UNIQUE,
  minimum_glory INT UNSIGNED NOT NULL DEFAULT 0,
  minimum_reputation INT NOT NULL DEFAULT 0
);

INSERT INTO rank_definitions (rank_level, name, minimum_glory, minimum_reputation) VALUES
(1, 'Initiate', 0, 0),
(2, 'Officer', 100, 0),
(3, 'Commander', 500, 0)
ON DUPLICATE KEY UPDATE name=VALUES(name), minimum_glory=VALUES(minimum_glory), minimum_reputation=VALUES(minimum_reputation);

ALTER TABLE page_content ADD COLUMN IF NOT EXISTS min_rank_level INT UNSIGNED NOT NULL DEFAULT 1 AFTER description;
UPDATE page_content SET min_rank_level = 2 WHERE route IN ('sabotage','alliances','modules','planet-conquest','black-market');
UPDATE page_content SET min_rank_level = 3 WHERE route IN ('ascension');

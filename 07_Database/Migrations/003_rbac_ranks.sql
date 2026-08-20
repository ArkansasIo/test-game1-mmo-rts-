USE stargatewars;

ALTER TABLE players
  ADD COLUMN rank_level INT UNSIGNED NOT NULL DEFAULT 1 AFTER race_id,
  ADD COLUMN rank_name VARCHAR(50) NOT NULL DEFAULT 'Initiate' AFTER rank_level;

UPDATE players SET rank_level = 3, rank_name = 'Commander' WHERE username = 'demo';

CREATE TABLE IF NOT EXISTS rank_definitions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rank_level INT UNSIGNED NOT NULL UNIQUE,
  rank_name VARCHAR(50) NOT NULL UNIQUE,
  description VARCHAR(255) NOT NULL,
  minimum_glory INT UNSIGNED NOT NULL DEFAULT 0
);

INSERT INTO rank_definitions (rank_level, rank_name, description, minimum_glory) VALUES
(1, 'Initiate', 'Basic realm access and standard command functions.', 0),
(2, 'Officer', 'Access to alliance, sabotage, and advanced management functions.', 100),
(3, 'Commander', 'Full command access, including ascension and strategic systems.', 500)
ON DUPLICATE KEY UPDATE description=VALUES(description), minimum_glory=VALUES(minimum_glory);

ALTER TABLE page_content ADD COLUMN min_rank_level INT UNSIGNED NOT NULL DEFAULT 1 AFTER description;
UPDATE page_content SET min_rank_level = 2 WHERE route IN ('sabotage','alliances','modules','planet-conquest','black-market');
UPDATE page_content SET min_rank_level = 3 WHERE route IN ('ascension');

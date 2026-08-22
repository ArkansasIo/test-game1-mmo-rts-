-- Premium systems: deterministic, server-authoritative premium economy.
CREATE TABLE IF NOT EXISTS premium_catalog (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  item_key VARCHAR(80) NOT NULL UNIQUE,
  category ENUM('store','officer','service','season_pass') NOT NULL,
  display_name VARCHAR(160) NOT NULL,
  description VARCHAR(500) NOT NULL,
  price_dark_matter BIGINT UNSIGNED NOT NULL DEFAULT 0,
  effect_key VARCHAR(80) NOT NULL,
  effect_value DECIMAL(12,3) NOT NULL DEFAULT 0,
  duration_seconds INT UNSIGNED NOT NULL DEFAULT 0,
  max_uses INT UNSIGNED NOT NULL DEFAULT 1,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS player_premium (
  player_id INT UNSIGNED PRIMARY KEY,
  dark_matter BIGINT UNSIGNED NOT NULL DEFAULT 2500,
  season_pass TINYINT(1) NOT NULL DEFAULT 0,
  season_points INT UNSIGNED NOT NULL DEFAULT 0,
  daily_claim_at DATETIME NULL,
  active_officer_key VARCHAR(80) NULL,
  officer_expires_at DATETIME NULL,
  service_flags JSON NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS premium_transactions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  item_key VARCHAR(80) NOT NULL,
  transaction_type ENUM('purchase','claim','activate','consume') NOT NULL,
  price_dark_matter BIGINT UNSIGNED NOT NULL DEFAULT 0,
  payload JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  KEY idx_premium_player_created(player_id,created_at),
  KEY idx_premium_item(item_key)
) ENGINE=InnoDB;

INSERT INTO premium_catalog(item_key,category,display_name,description,price_dark_matter,effect_key,effect_value,duration_seconds,max_uses)
VALUES
 ('season_pass_01','season_pass','Empire Season Pass','Unlocks the seasonal reward track and premium objectives.',1000,'season_pass',1,2592000,1),
 ('officer_logistics','officer','Logistics Officer','Improves construction and fleet logistics by 10% for 24 hours.',500,'logistics_modifier',10,86400,1),
 ('officer_science','officer','Science Officer','Improves research output by 12% for 24 hours.',600,'research_modifier',12,86400,1),
 ('service_queue','service','Queue Priority Service','Reduces one active queue completion time by 15%.',350,'queue_speed_modifier',15,0,3),
 ('service_colony_scan','service','Colony Scan Packet','Reveals one additional validated colony telemetry report.',150,'scan_credit',1,0,5),
 ('store_dark_matter_2500','store','Dark Matter Reserve','Adds a grant of premium currency to the commander wallet.',0,'dark_matter_grant',2500,0,1)
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),description=VALUES(description),price_dark_matter=VALUES(price_dark_matter),effect_key=VALUES(effect_key),effect_value=VALUES(effect_value),duration_seconds=VALUES(duration_seconds),max_uses=VALUES(max_uses),is_active=1;

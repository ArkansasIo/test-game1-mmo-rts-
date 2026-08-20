-- Resource Exchange market support
ALTER TABLE market_orders
  MODIFY resource_type VARCHAR(40) NOT NULL;

ALTER TABLE market_transactions
  MODIFY weapon_type_id INT UNSIGNED NULL,
  ADD COLUMN resource_type VARCHAR(40) NULL AFTER weapon_type_id,
  ADD COLUMN offered_amount BIGINT UNSIGNED NULL AFTER quantity,
  ADD COLUMN settled_amount BIGINT UNSIGNED NULL AFTER seller_net,
  ADD COLUMN exchange_rate DECIMAL(18,6) NULL AFTER settled_amount,
  ADD COLUMN market_fee BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER exchange_rate;

INSERT INTO game_settings (setting_key, setting_value)
VALUES ('resource_market_cooldown_seconds', '0')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

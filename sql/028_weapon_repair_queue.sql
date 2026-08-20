-- Weapon Repair queue metadata
ALTER TABLE construction_queue
  MODIFY queue_type ENUM('building','research','fleet','defense','ship','weapon_repair') NOT NULL;

INSERT INTO game_settings (setting_key, setting_value)
VALUES ('weapon_repair_cooldown_seconds', '0')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

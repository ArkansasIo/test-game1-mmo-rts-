-- Universe Civilization: Empire at Wars
-- Six authoritative turn ticks per minute: one tick every 10 seconds.
INSERT INTO game_settings(setting_key,setting_value)
VALUES ('turn_interval_seconds','10')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

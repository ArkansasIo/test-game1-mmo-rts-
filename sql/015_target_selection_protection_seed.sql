-- Target Selection protection state for NPC realms.
-- Idempotent for MariaDB/MySQL installations that already have the column.
ALTER TABLE target_realms ADD COLUMN IF NOT EXISTS protection_until DATETIME NULL AFTER covert_score;
UPDATE target_realms SET protection_until = DATE_ADD(NOW(), INTERVAL 30 DAY)
WHERE name = 'Northern Watch' AND player_id IS NULL;

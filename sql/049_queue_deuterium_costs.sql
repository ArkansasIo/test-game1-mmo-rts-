-- Persist Deuterium costs for ship and planetary defense upgrade queues.
ALTER TABLE mothership_upgrade_queue
  ADD COLUMN IF NOT EXISTS deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER level_after;

ALTER TABLE production_queues
  ADD COLUMN IF NOT EXISTS deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0 AFTER level_after;

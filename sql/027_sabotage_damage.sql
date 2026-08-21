-- Universe Civilization: Empire at Wars sabotage outcome metadata
ALTER TABLE covert_missions
  ADD COLUMN sabotage_damage INT UNSIGNED NOT NULL DEFAULT 0,
  ADD COLUMN damage_system VARCHAR(64) NULL,
  ADD COLUMN success_probability DECIMAL(5,4) NULL;

CREATE INDEX idx_covert_missions_sabotage ON covert_missions (mission_type, sabotage_damage, created_at);

UPDATE schema_migrations SET applied_at = applied_at WHERE migration_name = '027_sabotage_damage';

-- Universe Civilization: Empire at Wars
-- Bounded stat, attribute, buff, and debuff framework.
-- Values are resolved server-side as: clamp((base + additive) * multiplier, min, max).

CREATE TABLE IF NOT EXISTS stat_definitions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  stat_key VARCHAR(80) NOT NULL UNIQUE,
  entity_type ENUM('commander','unit','starship','mothership','building','technology','resource','planet','moon','fleet') NOT NULL,
  stat_group VARCHAR(60) NOT NULL,
  label VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  value_kind ENUM('integer','decimal','ratio','percent') NOT NULL DEFAULT 'decimal',
  base_value DECIMAL(18,6) NOT NULL DEFAULT 0,
  min_value DECIMAL(18,6) NOT NULL DEFAULT 0,
  max_value DECIMAL(18,6) NOT NULL DEFAULT 1000000,
  is_primary TINYINT(1) NOT NULL DEFAULT 1,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT chk_stat_definition_bounds CHECK (min_value <= max_value)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS entity_stat_values (
  entity_type ENUM('commander','unit','starship','mothership','building','technology','resource','planet','moon','fleet') NOT NULL,
  entity_id BIGINT UNSIGNED NOT NULL,
  stat_key VARCHAR(80) NOT NULL,
  base_value DECIMAL(18,6) NOT NULL DEFAULT 0,
  additive_value DECIMAL(18,6) NOT NULL DEFAULT 0,
  multiplier DECIMAL(12,6) NOT NULL DEFAULT 1.000000,
  min_override DECIMAL(18,6) NULL,
  max_override DECIMAL(18,6) NULL,
  source_key VARCHAR(120) NOT NULL DEFAULT 'base',
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (entity_type, entity_id, stat_key),
  KEY idx_entity_stats_lookup (entity_type, entity_id),
  KEY idx_entity_stats_stat (stat_key, entity_type, entity_id),
  CONSTRAINT fk_entity_stats_definition FOREIGN KEY (stat_key) REFERENCES stat_definitions(stat_key) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS entity_stat_modifiers (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  entity_type ENUM('commander','unit','starship','mothership','building','technology','resource','planet','moon','fleet') NOT NULL,
  entity_id BIGINT UNSIGNED NOT NULL,
  stat_key VARCHAR(80) NOT NULL,
  modifier_key VARCHAR(100) NOT NULL,
  modifier_kind ENUM('buff','debuff','temporary','aura','technology','government','race','biome','condition') NOT NULL,
  additive_value DECIMAL(18,6) NOT NULL DEFAULT 0,
  multiplier DECIMAL(12,6) NOT NULL DEFAULT 1.000000,
  min_override DECIMAL(18,6) NULL,
  max_override DECIMAL(18,6) NULL,
  source_key VARCHAR(120) NOT NULL,
  starts_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  expires_at DATETIME NULL,
  active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY idx_modifiers_active (entity_type, entity_id, active, starts_at, expires_at),
  KEY idx_modifiers_stat (stat_key, entity_type, entity_id, active),
  KEY idx_modifiers_expiry (active, expires_at),
  CONSTRAINT fk_entity_modifiers_definition FOREIGN KEY (stat_key) REFERENCES stat_definitions(stat_key) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO stat_definitions
  (stat_key, entity_type, stat_group, label, description, value_kind, base_value, min_value, max_value, is_primary)
VALUES
  ('command', 'commander', 'attributes', 'Command', 'Raises fleet coordination and command capacity.', 'integer', 10, 0, 100, 1),
  ('tactics', 'commander', 'attributes', 'Tactics', 'Improves deterministic combat force efficiency.', 'integer', 10, 0, 100, 1),
  ('science', 'commander', 'attributes', 'Science', 'Improves research, scanning, and exploration output.', 'integer', 10, 0, 100, 1),
  ('logistics', 'commander', 'attributes', 'Logistics', 'Improves cargo, fuel efficiency, and queue throughput.', 'integer', 10, 0, 100, 1),
  ('diplomacy', 'commander', 'attributes', 'Diplomacy', 'Improves alliance capacity and diplomatic outcomes.', 'integer', 10, 0, 100, 1),
  ('covert', 'commander', 'attributes', 'Covert', 'Improves covert success and reduces detection.', 'integer', 10, 0, 100, 1),
  ('resilience', 'commander', 'attributes', 'Resilience', 'Reduces debuff impact and improves recovery.', 'integer', 10, 0, 100, 1),
  ('health', 'unit', 'combat', 'Health', 'Durability before a unit is removed from combat.', 'integer', 100, 1, 1000000, 1),
  ('attack', 'unit', 'combat', 'Attack', 'Base damage contribution per combat round.', 'integer', 10, 0, 1000000, 1),
  ('defense', 'unit', 'combat', 'Defense', 'Reduces incoming combat damage.', 'integer', 10, 0, 1000000, 1),
  ('speed', 'unit', 'mobility', 'Speed', 'Movement and response speed.', 'integer', 10, 0, 1000, 1),
  ('accuracy', 'unit', 'combat', 'Accuracy', 'Chance contribution for successful attacks.', 'ratio', 0.75, 0, 1, 0),
  ('evasion', 'unit', 'combat', 'Evasion', 'Chance contribution for avoiding attacks.', 'ratio', 0.10, 0, 1, 0),
  ('morale', 'unit', 'sub_stats', 'Morale', 'Temporary combat readiness and performance.', 'ratio', 1, 0, 2, 0),
  ('armor', 'unit', 'sub_stats', 'Armor', 'Flat mitigation layer before defense.', 'integer', 0, 0, 1000000, 0),
  ('shield', 'unit', 'sub_stats', 'Shield', 'Absorbs damage before health.', 'integer', 0, 0, 1000000, 0),
  ('hull', 'starship', 'combat', 'Hull', 'Starship structural integrity.', 'integer', 1000, 1, 100000000, 1),
  ('ship_attack', 'starship', 'combat', 'Ship Attack', 'Starship weapon output.', 'integer', 100, 0, 100000000, 1),
  ('ship_defense', 'starship', 'combat', 'Ship Defense', 'Starship defensive rating.', 'integer', 100, 0, 100000000, 1),
  ('ship_speed', 'starship', 'mobility', 'Ship Speed', 'Travel speed and initiative.', 'integer', 100, 0, 100000, 1),
  ('cargo', 'starship', 'logistics', 'Cargo', 'Resource transport capacity.', 'integer', 1000, 0, 100000000, 1),
  ('fuel_efficiency', 'starship', 'logistics', 'Fuel Efficiency', 'Deuterium consumption multiplier; lower is better.', 'ratio', 1, 0.1, 5, 0),
  ('sensor_range', 'starship', 'scanning', 'Sensor Range', 'Scan and detection range.', 'integer', 10, 0, 100000, 1),
  ('stealth', 'starship', 'scanning', 'Stealth', 'Reduces enemy detection probability.', 'ratio', 0, 0, 1, 0),
  ('power_generation', 'building', 'infrastructure', 'Power Generation', 'Power supplied to the settlement grid.', 'integer', 0, 0, 100000000, 1),
  ('power_draw', 'building', 'infrastructure', 'Power Draw', 'Power consumed by an active structure.', 'integer', 0, 0, 100000000, 1),
  ('production', 'building', 'economy', 'Production', 'Resource output contribution.', 'integer', 0, 0, 100000000, 1),
  ('research', 'building', 'science', 'Research', 'Research output contribution.', 'integer', 0, 0, 100000000, 1),
  ('housing', 'building', 'civilian', 'Housing', 'Population capacity contribution.', 'integer', 0, 0, 100000000, 1),
  ('construction_speed', 'building', 'infrastructure', 'Construction Speed', 'Construction time multiplier; lower is faster.', 'ratio', 1, 0.1, 5, 0),
  ('offense_technology', 'technology', 'combat', 'Offense Technology', 'Technology multiplier for attack output.', 'ratio', 1, 0, 10, 1),
  ('defense_technology', 'technology', 'combat', 'Defense Technology', 'Technology multiplier for defense output.', 'ratio', 1, 0, 10, 1),
  ('covert_technology', 'technology', 'covert', 'Covert Technology', 'Technology multiplier for covert actions.', 'ratio', 1, 0, 10, 1),
  ('anti_covert_technology', 'technology', 'covert', 'Anti-Covert Technology', 'Technology multiplier for detection.', 'ratio', 1, 0, 10, 1),
  ('storage_capacity', 'resource', 'economy', 'Storage Capacity', 'Maximum stored quantity for a resource.', 'integer', 100000, 0, 999999999999.999999, 1),
  ('production_rate', 'resource', 'economy', 'Production Rate', 'Per-tick resource generation rate.', 'decimal', 0, 0, 1000000000, 1),
  ('upkeep_rate', 'resource', 'economy', 'Upkeep Rate', 'Per-tick resource consumption rate.', 'decimal', 0, 0, 1000000000, 1)
ON DUPLICATE KEY UPDATE
  label=VALUES(label), description=VALUES(description), min_value=VALUES(min_value), max_value=VALUES(max_value), is_primary=VALUES(is_primary);

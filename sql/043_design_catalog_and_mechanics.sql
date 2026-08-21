-- Universe Civilization: Empire at Wars
-- Versioned design catalog and formula registry.
-- Existing gameplay tables remain authoritative for player state.

CREATE TABLE IF NOT EXISTS game_design_catalog (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  catalog_version VARCHAR(40) NOT NULL,
  catalog_type VARCHAR(40) NOT NULL,
  catalog_key VARCHAR(100) NOT NULL,
  display_name VARCHAR(160) NOT NULL,
  payload JSON NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uq_design_catalog (catalog_version,catalog_type,catalog_key),
  KEY idx_design_catalog_type (catalog_type,is_active)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS game_formula_definitions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  formula_key VARCHAR(100) NOT NULL UNIQUE,
  version VARCHAR(40) NOT NULL,
  expression TEXT NOT NULL,
  variables JSON NOT NULL,
  source_section VARCHAR(120) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO game_formula_definitions(formula_key,version,expression,variables,source_section) VALUES
('production_elapsed','UCEAW-CATALOG-2026.08.21','production_rate_per_hour * elapsed_seconds / 3600',JSON_ARRAY('production_rate_per_hour','elapsed_seconds'),'7 Resource Production'),
('building_cost_growth','UCEAW-CATALOG-2026.08.21','base_cost * growth_multiplier ^ (level - 1)',JSON_ARRAY('base_cost','growth_multiplier','level'),'12 Building Upgrade System'),
('combat_power','UCEAW-CATALOG-2026.08.21','units * base_power * technology * race * government * planet_bonus',JSON_ARRAY('units','base_power','technology','race','government','planet_bonus'),'30 Combat Statistics'),
('fleet_travel','UCEAW-CATALOG-2026.08.21','distance * 3600 / fleet_speed / drive_modifier / universe_speed',JSON_ARRAY('distance','fleet_speed','drive_modifier','universe_speed'),'22 Fleet Travel'),
('espionage_detection','UCEAW-CATALOG-2026.08.21','defender_counter_intelligence - attacker_agents - covert_technology',JSON_ARRAY('defender_counter_intelligence','attacker_agents','covert_technology'),'34 Espionage'),
('population_growth','UCEAW-CATALOG-2026.08.21','population * capacity_factor * food_ratio * water_ratio * stability',JSON_ARRAY('population','capacity_factor','food_ratio','water_ratio','stability'),'46 Population System'),
('ranking_score','UCEAW-CATALOG-2026.08.21','economy + military + research + glory - penalties',JSON_ARRAY('economy','military','research','glory','penalties'),'55 Score System')
ON DUPLICATE KEY UPDATE version=VALUES(version),expression=VALUES(expression),variables=VALUES(variables),source_section=VALUES(source_section),is_active=1;

INSERT INTO game_design_catalog(catalog_version,catalog_type,catalog_key,display_name,payload)
SELECT 'UCEAW-CATALOG-2026.08.21','system','core_loop','Gather Build Research Expand Fleet Explore Trade Fight Recover',JSON_OBJECT('loop','Gather → Build → Research → Expand → Fleet → Explore → Trade → Fight → Recover → Expand Again')
WHERE NOT EXISTS (SELECT 1 FROM game_design_catalog WHERE catalog_version='UCEAW-CATALOG-2026.08.21' AND catalog_type='system' AND catalog_key='core_loop');

INSERT INTO game_design_catalog(catalog_version,catalog_type,catalog_key,display_name,payload)
SELECT 'UCEAW-CATALOG-2026.08.21','system','resource_model','Expanded resource model',JSON_OBJECT('resources',JSON_ARRAY('metal','crystal','deuterium','energy','food','water','population','fuel','dark_matter','research_data','rare_minerals','antimatter','nanites'))
WHERE NOT EXISTS (SELECT 1 FROM game_design_catalog WHERE catalog_version='UCEAW-CATALOG-2026.08.21' AND catalog_type='system' AND catalog_key='resource_model');

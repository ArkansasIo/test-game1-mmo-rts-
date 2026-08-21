-- Universe Civilization: Empire at Wars
-- Add Deuterium as a first-class fuel and strategic resource.

ALTER TABLE player_resources
  ADD COLUMN IF NOT EXISTS deuterium BIGINT UNSIGNED NOT NULL DEFAULT 0,
  ADD COLUMN IF NOT EXISTS deuterium_capacity BIGINT UNSIGNED NOT NULL DEFAULT 100000;

INSERT INTO game_resource_types(resource_key,display_name,category)
VALUES ('deuterium','Deuterium','strategic')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),category=VALUES(category);

UPDATE player_resources
SET deuterium=COALESCE(deuterium,0),deuterium_capacity=COALESCE(NULLIF(deuterium_capacity,0),100000);

INSERT INTO game_design_catalog(catalog_version,catalog_type,catalog_key,display_name,payload)
SELECT 'UCEAW-CATALOG-2026.08.21','resource','deuterium','Deuterium',JSON_OBJECT(
  'kind','fuel',
  'storage','deuterium_capacity',
  'uses',JSON_ARRAY('fleet_fuel','research','advanced_technology','hyperspace','fusion_systems'),
  'initial_balance',0,
  'initial_capacity',100000
)
WHERE NOT EXISTS (
  SELECT 1 FROM game_design_catalog
  WHERE catalog_version='UCEAW-CATALOG-2026.08.21'
    AND catalog_type='resource'
    AND catalog_key='deuterium'
);

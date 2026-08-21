-- Universe Civilization: Empire at Wars Income Breakdown seed
-- Apply after 013_eight_resource_economy.sql.
-- Idempotently creates the demo commander’s canonical settlement and universe registry row.

USE stargatewars;

INSERT INTO colonies
  (player_id,name,planet_type,coordinate,population,population_capacity,food_stock,water_stock,morale,energy_stock,food_rate,water_rate,growth_rate,workforce)
SELECT
  p.id, up.name, up.planet_type, up.coordinate_label,
  100, 210, 975, 980, 0.920, 640, 0.2500, 0.2000, 0.010000, 100
FROM players p
JOIN universe_planets up ON up.coordinate_label='1:1:1:3'
WHERE p.username='demo'
  AND NOT EXISTS (
    SELECT 1 FROM colonies c
    WHERE c.player_id=p.id OR c.coordinate=up.coordinate_label
  );

INSERT INTO player_colonies
  (player_id,planet_id,colony_name,is_homeworld,population,food,water,morale)
SELECT
  p.id, up.id, up.name, 1, 100, 975, 980, 0.920
FROM players p
JOIN universe_planets up ON up.coordinate_label='1:1:1:3'
WHERE p.username='demo'
  AND NOT EXISTS (
    SELECT 1 FROM player_colonies pc
    WHERE pc.player_id=p.id AND pc.planet_id=up.id
  );

UPDATE universe_planets
SET is_occupied=1
WHERE coordinate_label='1:1:1:3'
  AND EXISTS (
    SELECT 1 FROM player_colonies pc
    JOIN players p ON p.id=pc.player_id
    WHERE pc.planet_id=universe_planets.id AND p.username='demo'
  );

INSERT INTO colony_buildings (colony_id,building_key,level)
SELECT c.id,'metal_mine',12
FROM colonies c
JOIN players p ON p.id=c.player_id
WHERE p.username='demo' AND c.coordinate='1:1:1:3'
  AND NOT EXISTS (
    SELECT 1 FROM colony_buildings cb
    WHERE cb.colony_id=c.id AND cb.building_key='metal_mine'
  );

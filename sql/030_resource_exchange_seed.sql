-- Seed the extended resource catalog and balances for existing commanders
INSERT INTO game_resource_types (resource_key, display_name, category)
VALUES
  ('dark_matter','Dark Matter','currency'),
  ('population','Population','life_support')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name), category=VALUES(category);

INSERT INTO player_resource_balances (player_id, resource_key, amount, capacity, production_per_hour, consumption_per_hour)
SELECT p.id, r.resource_key,
       CASE r.resource_key
         WHEN 'metal' THEN 250000
         WHEN 'crystal' THEN 125000
         WHEN 'energy' THEN 5000
         WHEN 'food' THEN 10000
         WHEN 'water' THEN 10000
         WHEN 'dark_matter' THEN 250
         WHEN 'population' THEN 1000
         ELSE 0
       END,
       CASE r.resource_key
         WHEN 'population' THEN 5000
         ELSE 1000000
       END,
       0, 0
FROM players p
CROSS JOIN game_resource_types r
WHERE r.resource_key IN ('metal','crystal','energy','food','water','dark_matter','population')
ON DUPLICATE KEY UPDATE amount=amount;

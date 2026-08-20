-- StargateWars migration 035: population scale-up for the active demo commander
UPDATE player_resources pr
JOIN players p ON p.id = pr.player_id
SET pr.population = 150000,
    pr.population_capacity = 200000,
    pr.workforce = 150000
WHERE p.username IN ('demo', 'demo_commander');

UPDATE player_colonies pc
JOIN players p ON p.id = pc.player_id
SET pc.population = 150000
WHERE p.username IN ('demo', 'demo_commander');

UPDATE colonies c
JOIN players p ON p.id = c.player_id
SET c.population = 150000,
    c.population_capacity = 200000,
    c.workforce = 150000
WHERE p.username IN ('demo', 'demo_commander');

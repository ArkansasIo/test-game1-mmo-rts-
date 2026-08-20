INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description)
VALUES
('kinetic_lances','Kinetic Lance Array','offense',14000,1.50,7,'Improves ship-mounted kinetic weapon damage.'),
('orbital_strike','Orbital Strike Doctrine','offense',22000,1.55,10,'Improves coordinated orbital bombardment damage.'),
('singularity_cannon','Singularity Cannon','offense',40000,1.65,16,'Unlocks a high-energy strategic weapon system.')
ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description);
INSERT INTO technology_prerequisites(technology_key,prerequisite_key,minimum_level)
VALUES('kinetic_lances','siege',3),('orbital_strike','kinetic_lances',2),('singularity_cannon','orbital_strike',2)
ON DUPLICATE KEY UPDATE minimum_level=VALUES(minimum_level);

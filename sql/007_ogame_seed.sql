USE stargatewars;
INSERT INTO game_resource_types(resource_key,display_name,category) VALUES
('metal','Metal','strategic'),('crystal','Crystal','strategic'),('food','Food','life_support'),('water','Water','life_support'),('energy','Energy','strategic'),('naquadah','Naquadah','currency')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),category=VALUES(category);
INSERT INTO building_types(building_key,display_name,category,base_metal,base_crystal,base_naquadah,base_food,base_water,growth_factor,build_seconds) VALUES
('metal_mine','Metal Mine','resource',60,15,0,0,0,1.5,60),('crystal_mine','Crystal Mine','resource',48,24,0,0,0,1.6,75),('food_farm','Food Farm','life_support',30,10,100,0,0,1.5,45),('water_processor','Water Processor','life_support',30,10,100,0,0,1.5,45),('residential_hub','Residential Hub','population',80,40,150,0,0,1.7,90),('shipyard','Shipyard','shipyard',400,200,500,0,0,1.8,180),('research_lab','Research Lab','research',200,400,600,0,0,1.8,240),('defense_grid','Defense Grid','defense',300,300,500,0,0,1.7,180)
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name);
INSERT INTO research_types(research_key,display_name,category,base_metal,base_crystal,base_naquadah,growth_factor,research_seconds) VALUES
('energy','Energy Research','energy',0,800,400,1.75,180),('computer','Computer Research','navigation',0,400,300,1.75,120),('weapons','Weapons Research','combat',800,200,500,1.8,240),('shielding','Shielding Research','defense',200,800,500,1.8,240),('hyperspace','Hyperspace Research','navigation',400,1200,800,1.9,360)
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name);
INSERT INTO fleet_types(fleet_key,display_name,attack_power,defense_power,cargo_capacity,speed,fuel_per_hour,base_metal,base_crystal,base_naquadah,build_seconds) VALUES
('scout','Scout',10,5,50,5,1,300,100,50,45),('raider','Raider',80,60,500,3,4,1200,600,200,120),('carrier','Carrier',30,100,2500,2,8,2000,1500,600,240),('colony_ship','Colony Ship',20,40,1000,1,10,5000,3000,1200,360)
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name);
INSERT INTO defense_types(defense_key,display_name,attack_power,defense_power,base_metal,base_crystal,base_naquadah) VALUES
('rail_turret','Rail Turret',40,80,400,100,80),('ion_battery','Ion Battery',80,120,800,300,160),('planetary_shield','Planetary Shield',0,500,2000,1500,500)
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name);

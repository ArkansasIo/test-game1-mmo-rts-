USE stargatewars;

INSERT INTO races (name,bonus_label,bonus_percent,bank_name,attack_modifier,defense_modifier,income_modifier,covert_modifier) VALUES
('Asgard','Defense bonus',25,'Planetary Vault',1.000,1.250,1.000,1.000),
('Goa''uld','Income bonus',25,'Secret Temple',1.000,1.000,1.250,1.000),
('Replicator','Covert bonus',25,'Time Chamber',1.000,1.000,1.000,1.250),
('Tau''ri','Attack bonus',25,'Alpha Site',1.250,1.000,1.000,1.000)
ON DUPLICATE KEY UPDATE bonus_label=VALUES(bonus_label),bonus_percent=VALUES(bonus_percent),bank_name=VALUES(bank_name),attack_modifier=VALUES(attack_modifier),defense_modifier=VALUES(defense_modifier),income_modifier=VALUES(income_modifier),covert_modifier=VALUES(covert_modifier);

INSERT INTO rank_definitions (rank_level,name,minimum_glory,minimum_reputation) VALUES
(1,'Initiate',0,0),(2,'Officer',250,100),(3,'Commander',1000,500),(4,'Ascended',2500,1500)
ON DUPLICATE KEY UPDATE minimum_glory=VALUES(minimum_glory),minimum_reputation=VALUES(minimum_reputation);

INSERT INTO game_settings (setting_key,setting_value) VALUES
('turn_interval_seconds','1800'),('turn_generation_threshold','4000'),('turn_max_storage','10000'),
('natural_income_untrained','20'),('natural_income_miner','80'),('lifer_ratio','10'),('market_turns_weekly','3'),
('bank_capacity_multiplier','72'),('max_defcon','4'),('max_messages_daily','50'),('max_officer_count','10'),
('max_planets','10'),('max_alliance_members','100'),('raid_rank_range','10'),('attack_daily_target_limit','5')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);

INSERT INTO menu_items (parent_id,label,route,icon,sort_order) VALUES
(NULL,'Command Center','dashboard','⌂',1),(NULL,'Attack','attack','⚔',2),(NULL,'Armory','armory','▣',3),
(NULL,'Training','training','◈',4),(NULL,'Technology','technology','◇',5),(NULL,'Intelligence','intelligence','◎',6),
(NULL,'Market','market','¤',7),(NULL,'Social','social','♧',8),(NULL,'Planets','planets','○',9),
(NULL,'Mothership','mothership','△',10),(NULL,'Account','account','◌',11),(NULL,'Universe','universe','✦',12)
ON DUPLICATE KEY UPDATE label=VALUES(label),icon=VALUES(icon),sort_order=VALUES(sort_order);

INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Account Information','account-info',1 FROM menu_items WHERE route='dashboard' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Resources','resources',2 FROM menu_items WHERE route='dashboard' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Income','income',3 FROM menu_items WHERE route='dashboard' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Military Scores','military-stats',4 FROM menu_items WHERE route='dashboard' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Targets','targets',1 FROM menu_items WHERE route='attack' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Spy','spy',2 FROM menu_items WHERE route='attack' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Sabotage','sabotage',3 FROM menu_items WHERE route='attack' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Attack Log','attack-log',4 FROM menu_items WHERE route='attack' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Weapons','weapons',1 FROM menu_items WHERE route='armory' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Buy / Sell','weapon-market',2 FROM menu_items WHERE route='armory' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Repair','repair',3 FROM menu_items WHERE route='armory' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Units','units',1 FROM menu_items WHERE route='training' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Miners','miners',2 FROM menu_items WHERE route='training' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Super Units','super-units',3 FROM menu_items WHERE route='training' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Unit Production','unit-production',4 FROM menu_items WHERE route='training' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Offense','tech-offense',1 FROM menu_items WHERE route='technology' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Defense','tech-defense',2 FROM menu_items WHERE route='technology' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Covert','tech-covert',3 FROM menu_items WHERE route='technology' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Anti-Covert','tech-anti-covert',4 FROM menu_items WHERE route='technology' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Spy Log','spy-log',1 FROM menu_items WHERE route='intelligence' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Enemy Intelligence','enemy-intelligence',2 FROM menu_items WHERE route='intelligence' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Resource Exchange','resource-exchange',1 FROM menu_items WHERE route='market' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Mercenary Market','mercenary-market',2 FROM menu_items WHERE route='market' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Rankings','rankings',1 FROM menu_items WHERE route='social' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Alliances','alliances',2 FROM menu_items WHERE route='social' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Messages','messages',3 FROM menu_items WHERE route='social' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Planet List','planet-list',1 FROM menu_items WHERE route='planets' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Bonuses','planet-bonuses',2 FROM menu_items WHERE route='planets' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Defenses','planet-defenses',3 FROM menu_items WHERE route='planets' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Ship','ship',1 FROM menu_items WHERE route='mothership' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Modules','modules',2 FROM menu_items WHERE route='mothership' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Exploration','exploration',3 FROM menu_items WHERE route='mothership' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Race','race',1 FROM menu_items WHERE route='account' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Galaxy Map','galaxies',1 FROM menu_items WHERE route='universe' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Sector Map','sectors',2 FROM menu_items WHERE route='universe' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Solar Systems','solar-systems',3 FROM menu_items WHERE route='universe' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Universe Planets','universe-planets',4 FROM menu_items WHERE route='universe' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Moon Registry','moons',5 FROM menu_items WHERE route='universe' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Coordinate Search','coordinates',6 FROM menu_items WHERE route='universe' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Vacation','vacation',2 FROM menu_items WHERE route='account' ON DUPLICATE KEY UPDATE label=VALUES(label);
INSERT INTO menu_items (parent_id,label,route,sort_order) SELECT id,'Ascension','ascension',3 FROM menu_items WHERE route='account' ON DUPLICATE KEY UPDATE label=VALUES(label);

INSERT INTO page_content(route,title,description,minimum_rank_level) VALUES
('dashboard','Dashboard','Command center overview.',1),('resources','Resources','Manage available and banked Naquadah.',1),('income','Income','Review turn income and modifiers.',1),('military-stats','Military Scores','Review military and covert power.',1),
('account-info','Account Information','Review player identity and progression.',1),('race','Race','Select a strategic race specialization.',1),('units','Units','Train and manage military units.',1),('miners','Miners','Develop the economic workforce.',1),('super-units','Super Units','Develop elite attack and defense personnel.',1),('unit-production','Unit Production','Upgrade population generation.',1),
('technology','Technology','Upgrade offense, defense, covert, and unique systems.',1),('targets','Targets','Select an enemy realm for combat.',1),('attack-log','Attack Log','Review battle results.',1),('spy','Spy','Run intelligence operations.',1),('sabotage','Sabotage','Run covert disruption operations.',2),
('weapons','Weapons','Manage weapon inventory.',1),('weapon-market','Buy / Sell','Trade weapon systems.',1),('repair','Repair','Restore weapon durability.',1),('resources','Resource Exchange','Trade resources with other players.',1),('mercenary-market','Mercenary Market','Recruit mercenary contracts.',2),
('alliances','Alliances','Create and join political organizations.',2),('messages','Messages','Send private commander messages.',1),('rankings','Rankings','Compare realm scores.',1),('planet-list','Planet List','Review controlled worlds.',1),('planet-bonuses','Planet Bonuses','Review planetary modifiers.',1),('planet-defenses','Planet Defenses','Build planetary defenses.',2),('exploration','Exploration','Explore for new planets.',1),
('mothership','Mothership','Manage the command vessel.',1),('ship','Ship','Upgrade mothership components.',1),('modules','Modules','Upgrade mothership modules.',2),('galaxies','Galaxy Map','Inspect discovered galaxies and sectors.',1),('sectors','Sector Map','Scan sectors and travel lanes.',1),('solar-systems','Solar Systems','Inspect system orbit maps and gate access.',1),('universe-planets','Universe Planets','Inspect planets and colonization status.',1),('moons','Moon Registry','Inspect moons and jump-gate infrastructure.',1),('coordinates','Coordinate Search','Search validated universe coordinates.',1),('vacation','Vacation','Activate temporary protection.',1),('ascension','Ascension','Convert progression into an ascended realm.',3)
ON DUPLICATE KEY UPDATE title=VALUES(title),description=VALUES(description),minimum_rank_level=VALUES(minimum_rank_level);

INSERT INTO technologies(technology_key,name,category,base_cost,cost_growth,effect_value,description) VALUES
('siege','Siege Systems','offense',10000,1.50,5,'Improves offensive action strength.'),
('fortification','Fortification','defense',10000,1.50,5,'Improves defensive action strength.'),
('infiltration','Infiltration','covert',10000,1.50,5,'Improves covert operations.'),
('detection','Detection Grid','anti_covert',10000,1.50,5,'Improves anti-covert operations.'),
('mercenary','Mercenary Capacity','mercenary',15000,1.50,5,'Increases mercenary capacity.'),
('unique','Unique Doctrine','unique',25000,1.60,8,'Improves race-specific doctrine effects.')
ON DUPLICATE KEY UPDATE name=VALUES(name),base_cost=VALUES(base_cost),cost_growth=VALUES(cost_growth),effect_value=VALUES(effect_value),description=VALUES(description);

INSERT INTO weapon_types(name,category,power,price,max_durability,description) VALUES
('Standard Strike Weapon','attack',5,1000,100,'A basic offensive weapon.'),('Standard Defense Weapon','defense',5,1000,100,'A basic defensive weapon.'),('Super Strike Weapon','super_attack',10,5000,100,'An elite offensive weapon.'),('Super Defense Weapon','super_defense',10,5000,100,'An elite defensive weapon.'),('Mothership Volley Cannon','mothership',25,25000,100,'A mothership weapon system.')
ON DUPLICATE KEY UPDATE power=VALUES(power),price=VALUES(price),max_durability=VALUES(max_durability),description=VALUES(description);

INSERT INTO mercenary_types(name,attack_power,defense_power,price,capacity_cost) VALUES
('Jaffa Contract',8,4,2500,1),('Defense Drone Contract',3,8,2500,1),('Elite Operative Contract',6,6,4000,1),('Mothership Guard Contract',4,10,6000,2)
ON DUPLICATE KEY UPDATE attack_power=VALUES(attack_power),defense_power=VALUES(defense_power),price=VALUES(price),capacity_cost=VALUES(capacity_cost);

INSERT INTO players(username,display_name,password_hash,race_id,title,rank_level,rank_name,glory,reputation,last_turn_at)
SELECT 'demo','Commander Tanang',SHA2('demo123',256),id,'Commander',3,'Commander',1500,700,NOW() FROM races WHERE name='Tau''ri'
AND NOT EXISTS (SELECT 1 FROM players WHERE username='demo');
INSERT INTO players(username,display_name,password_hash,race_id,title,rank_level,rank_name,glory,reputation,last_turn_at)
SELECT 'opponent_demo','Rival Commander',SHA2('demo123',256),id,'Officer',2,'Officer',350,150,NOW() FROM races WHERE name='Asgard'
AND NOT EXISTS (SELECT 1 FROM players WHERE username='opponent_demo');

INSERT INTO player_resources(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM player_resources r WHERE r.player_id=p.id);
INSERT INTO player_unit_stats(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM player_unit_stats r WHERE r.player_id=p.id);
INSERT INTO motherships(player_id,name) SELECT id,CONCAT(display_name,' Mothership') FROM players p WHERE NOT EXISTS (SELECT 1 FROM motherships r WHERE r.player_id=p.id);
INSERT INTO protection_states(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM protection_states r WHERE r.player_id=p.id);
INSERT INTO vacation_states(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM vacation_states r WHERE r.player_id=p.id);
INSERT INTO ascension_states(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM ascension_states r WHERE r.player_id=p.id);
INSERT INTO glory_reputation(player_id,glory,reputation) SELECT id,glory,reputation FROM players p ON DUPLICATE KEY UPDATE glory=VALUES(glory),reputation=VALUES(reputation);
INSERT INTO rankings(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM rankings r WHERE r.player_id=p.id);
INSERT INTO supporter_status(player_id) SELECT id FROM players p WHERE NOT EXISTS (SELECT 1 FROM supporter_status r WHERE r.player_id=p.id);
INSERT INTO covert_agents(player_id,count,level) SELECT id,spies,1 FROM players p JOIN player_resources r ON r.player_id=p.id ON DUPLICATE KEY UPDATE count=VALUES(count);
INSERT INTO anti_covert_agents(player_id,count,level) SELECT id,anti_spies,1 FROM players p JOIN player_resources r ON r.player_id=p.id ON DUPLICATE KEY UPDATE count=VALUES(count);

INSERT INTO player_planets(player_id,name,planet_type,size_label,size_level,income_bonus)
SELECT id,'Capital World','Balanced','Large',2,10 FROM players p WHERE p.username='demo' AND NOT EXISTS (SELECT 1 FROM player_planets q WHERE q.player_id=p.id);
INSERT INTO player_planets(player_id,name,planet_type,size_label,size_level,defense_bonus)
SELECT id,'Asgard Outpost','Fortified','Medium',1,10 FROM players p WHERE p.username='opponent_demo' AND NOT EXISTS (SELECT 1 FROM player_planets q WHERE q.player_id=p.id);
INSERT INTO planet_bonuses(planet_id,bonus_type,bonus_percent) SELECT id,'income',10 FROM player_planets WHERE name='Capital World' AND NOT EXISTS (SELECT 1 FROM planet_bonuses b WHERE b.planet_id=player_planets.id AND b.bonus_type='income');
INSERT INTO planet_bonuses(planet_id,bonus_type,bonus_percent) SELECT id,'defense',10 FROM player_planets WHERE name='Asgard Outpost' AND NOT EXISTS (SELECT 1 FROM planet_bonuses b WHERE b.planet_id=player_planets.id AND b.bonus_type='defense');

INSERT INTO target_realms(player_id,name,race_name,rank_position,attack_score,defense_score,covert_score)
SELECT p.id,p.display_name,'Tau''ri',20,850,1200,300 FROM players p WHERE p.username='demo' AND NOT EXISTS (SELECT 1 FROM target_realms t WHERE t.player_id=p.id);
INSERT INTO target_realms(player_id,name,race_name,rank_position,attack_score,defense_score,covert_score)
SELECT p.id,p.display_name,'Asgard',12,1100,1800,500 FROM players p WHERE p.username='opponent_demo' AND NOT EXISTS (SELECT 1 FROM target_realms t WHERE t.player_id=p.id);

INSERT INTO rankings(player_id,overall_score,military_score,economy_score,covert_score,rank_position)
SELECT p.id,(r.attack_units+r.defense_units+r.naquadah DIV 1000),(r.attack_units+r.defense_units),(r.naquadah+r.banked_naquadah) DIV 1000,(r.spies+r.anti_spies),ROW_NUMBER() OVER (ORDER BY p.id) FROM players p JOIN player_resources r ON r.player_id=p.id ON DUPLICATE KEY UPDATE overall_score=VALUES(overall_score),military_score=VALUES(military_score),economy_score=VALUES(economy_score),covert_score=VALUES(covert_score);

SET FOREIGN_KEY_CHECKS=1;

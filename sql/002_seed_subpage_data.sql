USE stargatewars;

CREATE TABLE IF NOT EXISTS page_content (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  route VARCHAR(100) NOT NULL UNIQUE,
  section VARCHAR(80) NOT NULL,
  title VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  status VARCHAR(30) NOT NULL DEFAULT 'active',
  sort_order INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS player_planets (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  name VARCHAR(100) NOT NULL,
  planet_type VARCHAR(50) NOT NULL,
  size_label VARCHAR(30) NOT NULL DEFAULT 'Medium',
  attack_bonus DECIMAL(5,2) NOT NULL DEFAULT 0,
  defense_bonus DECIMAL(5,2) NOT NULL DEFAULT 0,
  income_bonus DECIMAL(5,2) NOT NULL DEFAULT 0,
  status VARCHAR(30) NOT NULL DEFAULT 'active',
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS player_technologies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  technology_key VARCHAR(80) NOT NULL,
  technology_name VARCHAR(120) NOT NULL,
  category VARCHAR(40) NOT NULL,
  level INT UNSIGNED NOT NULL DEFAULT 0,
  next_cost BIGINT UNSIGNED NOT NULL DEFAULT 10000,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  UNIQUE KEY player_technology (player_id, technology_key)
);

CREATE TABLE IF NOT EXISTS target_realms (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  race_name VARCHAR(50) NOT NULL,
  rank_position INT UNSIGNED NOT NULL,
  attack_score INT UNSIGNED NOT NULL,
  defense_score INT UNSIGNED NOT NULL,
  covert_score INT UNSIGNED NOT NULL,
  protection_until DATETIME NULL
);

INSERT INTO page_content (route, section, title, description) VALUES
('account-info','Command Center','Account Information','Review commander identity, race, rank, protection, and account status.'),
('resources','Command Center','Resources','Track available Naquadah, protected reserves, turns, and population.'),
('income','Command Center','Income','Review natural income, miner output, race bonuses, and modifiers.'),
('military-stats','Command Center','Military Scores','Compare attack, defense, covert, and anti-covert strength.'),
('targets','Attack','Targets','Browse target realms and inspect their visible strategic information.'),
('spy','Attack','Spy Operations','Plan reconnaissance and espionage missions against target realms.'),
('sabotage','Attack','Sabotage','Prepare covert disruption missions and review operation requirements.'),
('attack-log','Attack','Attack Log','Review completed attacks, outcomes, casualties, and loot.'),
('weapons','Armory','Weapons','Inspect weapon inventory, strength, durability, and assignments.'),
('weapon-market','Armory','Weapon Market','Buy or sell weapons using Naquadah reserves.'),
('repair','Armory','Repair','Restore weapon durability and maintain military readiness.'),
('units','Training','Unit Training','Train untrained population into specialized personnel.'),
('miners','Training','Miners','Assign workers to resource production and improve income.'),
('super-units','Training','Super Units','Upgrade eligible attack and defense units into elite personnel.'),
('unit-production','Training','Unit Production','Increase the permanent rate of unit generation per turn.'),
('tech-offense','Technology','Offense Technology','Improve siege, strike, and offensive combat performance.'),
('tech-defense','Technology','Defense Technology','Improve fortification and defensive combat performance.'),
('tech-covert','Technology','Covert Technology','Improve reconnaissance, spying, and sabotage capacity.'),
('tech-anti-covert','Technology','Anti-Covert Technology','Improve detection and resistance against enemy covert actions.'),
('spy-log','Intelligence','Spy Log','Review intelligence gathered from reconnaissance missions.'),
('enemy-intelligence','Intelligence','Enemy Intelligence','Organize known information about enemy realms.'),
('resource-exchange','Market','Resource Exchange','Exchange eligible resources and manage market turns.'),
('mercenary-market','Market','Mercenary Market','Recruit mercenaries and review capacity limits.'),
('rankings','Social','Rankings','View realm standings by overall rank, military, glory, and reputation.'),
('alliances','Social','Alliances','Manage alliance membership, diplomacy, and shared objectives.'),
('messages','Social','Messages','Send and receive private communications between commanders.'),
('planet-list','Planets','Planet List','Review controlled planets and their current status.'),
('planet-bonuses','Planets','Planet Bonuses','Review attack, defense, covert, income, and production bonuses.'),
('planet-defenses','Planets','Planet Defenses','Build and maintain defensive systems around controlled planets.'),
('ship','Mothership','Mothership Ship','Manage the mothership hull, readiness, and fleet command.'),
('modules','Mothership','Ship Modules','Configure volley bays, shield bays, and fleet hangars.'),
('exploration','Mothership','Exploration','Send mothership missions into unexplored space.'),
('race','Account','Race Selection','Review race identity and race-specific strategic bonuses.'),
('vacation','Account','Vacation Mode','Manage temporary protection while away from the game.'),
('ascension','Account','Ascension','Review progression requirements, titles, and ascension conversion.')
ON DUPLICATE KEY UPDATE title=VALUES(title), description=VALUES(description);

INSERT INTO player_planets (player_id,name,planet_type,size_label,attack_bonus,defense_bonus,income_bonus)
SELECT id,'Alpha Site','Industrial','Large',4,2,12 FROM players WHERE username='demo'
UNION ALL SELECT id,'Orilla','Fortified','Medium',0,15,4 FROM players WHERE username='demo'
UNION ALL SELECT id,'Cimmeria','Covert','Small',2,3,5 FROM players WHERE username='demo';

INSERT IGNORE INTO player_technologies (player_id,technology_key,technology_name,category,level,next_cost)
SELECT id,'siege','Siege Systems','Offense',3,25000 FROM players WHERE username='demo'
UNION ALL SELECT id,'fortification','Fortification','Defense',4,30000 FROM players WHERE username='demo'
UNION ALL SELECT id,'infiltration','Infiltration','Covert',2,18000 FROM players WHERE username='demo'
UNION ALL SELECT id,'detection','Detection Grid','Anti-Covert',2,18000 FROM players WHERE username='demo';

INSERT INTO target_realms (name,race_name,rank_position,attack_score,defense_score,covert_score) VALUES
('Abydos Rising','Goa''uld',18,820,420,160),
('Northern Watch','Asgard',27,540,760,210),
('Silent Pattern','Replicator',34,620,310,880),
('Frontier Command','Tau''ri',41,880,470,350);

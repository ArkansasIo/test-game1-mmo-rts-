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

INSERT INTO page_content (route, section, title, description, sort_order) VALUES
('account-info','Command Center','Account Information','Review commander identity, race, rank, protection, and account status.',1),
('resources','Command Center','Resources','Track available Naquadah, protected reserves, turns, and population.',2),
('income','Command Center','Income','Review natural income, miner output, race bonuses, and modifiers.',3),
('military-stats','Command Center','Military Scores','Compare attack, defense, covert, and anti-covert strength.',4),
('targets','Attack','Targets','Browse target realms and inspect their visible strategic information.',1),
('spy','Attack','Spy Operations','Plan reconnaissance and espionage missions against target realms.',2),
('sabotage','Attack','Sabotage','Prepare covert disruption missions and review operation requirements.',3),
('attack-log','Attack','Attack Log','Review completed attacks, outcomes, casualties, and loot.',4),
('weapons','Armory','Weapons','Inspect weapon inventory, strength, durability, and assignments.',1),
('weapon-market','Armory','Weapon Market','Buy or sell weapons using Naquadah reserves.',2),
('repair','Armory','Repair','Restore weapon durability and maintain military readiness.',3),
('units','Training','Unit Training','Train untrained population into specialized personnel.',1),
('miners','Training','Miners','Assign workers to resource production and improve income.',2),
('super-units','Training','Super Units','Upgrade eligible attack and defense units into elite personnel.',3),
('unit-production','Training','Unit Production','Increase the permanent rate of unit generation per turn.',4),
('tech-offense','Technology','Offense Technology','Improve siege, strike, and offensive combat performance.',1),
('tech-defense','Technology','Defense Technology','Improve fortification and defensive combat performance.',2),
('tech-covert','Technology','Covert Technology','Improve reconnaissance, spying, and sabotage capacity.',3),
('tech-anti-covert','Technology','Anti-Covert Technology','Improve detection and resistance against enemy covert actions.',4),
('spy-log','Intelligence','Spy Log','Review intelligence gathered from reconnaissance missions.',1),
('enemy-intelligence','Intelligence','Enemy Intelligence','Organize known information about enemy realms.',2),
('resource-exchange','Market','Resource Exchange','Exchange eligible resources and manage market turns.',1),
('mercenary-market','Market','Mercenary Market','Recruit mercenaries and review capacity limits.',2),
('rankings','Social','Rankings','View realm standings by overall rank, military, glory, and reputation.',1),
('alliances','Social','Alliances','Manage alliance membership, diplomacy, and shared objectives.',2),
('messages','Social','Messages','Send and receive private communications between commanders.',3),
('planet-list','Planets','Planet List','Review controlled planets and their current status.',1),
('planet-bonuses','Planets','Planet Bonuses','Review attack, defense, covert, income, and production bonuses.',2),
('planet-defenses','Planets','Planet Defenses','Build and maintain defensive systems around controlled planets.',3),
('ship','Mothership','Mothership Ship','Manage the mothership hull, readiness, and fleet command.',1),
('modules','Mothership','Ship Modules','Configure volley bays, shield bays, and fleet hangars.',2),
('exploration','Mothership','Exploration','Send mothership missions into unexplored space.',3),
('race','Account','Race Selection','Review race identity and race-specific strategic bonuses.',1),
('vacation','Account','Vacation Mode','Manage temporary protection while away from the game.',2),
('ascension','Account','Ascension','Review progression requirements, titles, and ascension conversion.',3)
ON DUPLICATE KEY UPDATE title=VALUES(title), description=VALUES(description);

INSERT INTO player_planets (player_id,name,planet_type,size_label,attack_bonus,defense_bonus,income_bonus)
SELECT id,'Alpha Site','Industrial','Large',4,2,12 FROM players WHERE username='demo'
UNION ALL SELECT id,'Orilla','Fortified','Medium',0,15,4 FROM players WHERE username='demo'
UNION ALL SELECT id,'Cimmeria','Covert','Small',2,3,5 FROM players WHERE username='demo';

INSERT INTO player_technologies (player_id,technology_key,technology_name,category,level,next_cost)
SELECT id,'siege','Siege Systems','Offense',3,25000 FROM players WHERE username='demo'
UNION ALL SELECT id,'fortification','Fortification','Defense',4,30000 FROM players WHERE username='demo'
UNION ALL SELECT id,'infiltration','Infiltration','Covert',2,18000 FROM players WHERE username='demo'
UNION ALL SELECT id,'detection','Detection Grid','Anti-Covert',2,18000 FROM players WHERE username='demo';

INSERT INTO target_realms (name,race_name,rank_position,attack_score,defense_score,covert_score) VALUES
('Abydos Rising','Goa''uld',18,820,610,390),
('Northern Watch','Asgard',27,540,980,420),
('Silent Pattern','Replicator',34,620,590,1060),
('Frontier Command','Tau''ri',41,880,470,350);

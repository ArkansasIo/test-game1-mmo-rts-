CREATE DATABASE IF NOT EXISTS stargatewars CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE stargatewars;

CREATE TABLE races (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL UNIQUE,
  bonus_label VARCHAR(100) NOT NULL,
  bonus_percent DECIMAL(5,2) NOT NULL DEFAULT 25.00
);

CREATE TABLE players (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  display_name VARCHAR(100) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  race_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (race_id) REFERENCES races(id)
);

CREATE TABLE player_resources (
  player_id INT UNSIGNED PRIMARY KEY,
  naquadah BIGINT UNSIGNED NOT NULL DEFAULT 125000,
  banked_naquadah BIGINT UNSIGNED NOT NULL DEFAULT 500000,
  attack_turns INT UNSIGNED NOT NULL DEFAULT 48,
  market_turns INT UNSIGNED NOT NULL DEFAULT 3,
  untrained_units INT UNSIGNED NOT NULL DEFAULT 1600,
  unit_production INT UNSIGNED NOT NULL DEFAULT 12,
  miners INT UNSIGNED NOT NULL DEFAULT 120,
  lifers INT UNSIGNED NOT NULL DEFAULT 12,
  attack_units INT UNSIGNED NOT NULL DEFAULT 850,
  defense_units INT UNSIGNED NOT NULL DEFAULT 1200,
  spies INT UNSIGNED NOT NULL DEFAULT 160,
  anti_spies INT UNSIGNED NOT NULL DEFAULT 140,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE
);

CREATE TABLE menu_items (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  parent_id INT UNSIGNED NULL,
  label VARCHAR(80) NOT NULL,
  route VARCHAR(100) NOT NULL,
  icon VARCHAR(10) DEFAULT '•',
  sort_order INT NOT NULL DEFAULT 0,
  FOREIGN KEY (parent_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

INSERT INTO races (name, bonus_label, bonus_percent) VALUES
('Asgard', 'Defense bonus', 25),
('Goa''uld', 'Income bonus', 25),
('Replicator', 'Covert bonus', 25),
('Tau''ri', 'Attack bonus', 25);

INSERT INTO menu_items (parent_id, label, route, icon, sort_order) VALUES
(NULL, 'Command Center', 'dashboard', '⌂', 1),
(NULL, 'Attack', 'attack', '⚔', 2),
(NULL, 'Armory', 'armory', '▣', 3),
(NULL, 'Training', 'training', '◈', 4),
(NULL, 'Technology', 'technology', '◇', 5),
(NULL, 'Intelligence', 'intelligence', '◎', 6),
(NULL, 'Market', 'market', '¤', 7),
(NULL, 'Social', 'social', '♧', 8),
(NULL, 'Planets', 'planets', '○', 9),
(NULL, 'Mothership', 'mothership', '△', 10),
(NULL, 'Account', 'account', '◌', 11);

INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Account Information', 'account-info', 1 FROM menu_items WHERE route='dashboard';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Resources', 'resources', 2 FROM menu_items WHERE route='dashboard';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Income', 'income', 3 FROM menu_items WHERE route='dashboard';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Military Scores', 'military-stats', 4 FROM menu_items WHERE route='dashboard';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Targets', 'targets', 1 FROM menu_items WHERE route='attack';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Spy', 'spy', 2 FROM menu_items WHERE route='attack';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Sabotage', 'sabotage', 3 FROM menu_items WHERE route='attack';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Attack Log', 'attack-log', 4 FROM menu_items WHERE route='attack';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Weapons', 'weapons', 1 FROM menu_items WHERE route='armory';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Buy / Sell', 'weapon-market', 2 FROM menu_items WHERE route='armory';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Repair', 'repair', 3 FROM menu_items WHERE route='armory';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Units', 'units', 1 FROM menu_items WHERE route='training';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Miners', 'miners', 2 FROM menu_items WHERE route='training';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Super Units', 'super-units', 3 FROM menu_items WHERE route='training';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Unit Production', 'unit-production', 4 FROM menu_items WHERE route='training';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Offense', 'tech-offense', 1 FROM menu_items WHERE route='technology';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Defense', 'tech-defense', 2 FROM menu_items WHERE route='technology';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Covert', 'tech-covert', 3 FROM menu_items WHERE route='technology';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Anti-Covert', 'tech-anti-covert', 4 FROM menu_items WHERE route='technology';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Spy Log', 'spy-log', 1 FROM menu_items WHERE route='intelligence';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Enemy Intelligence', 'enemy-intelligence', 2 FROM menu_items WHERE route='intelligence';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Resource Exchange', 'resource-exchange', 1 FROM menu_items WHERE route='market';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Mercenary Market', 'mercenary-market', 2 FROM menu_items WHERE route='market';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Rankings', 'rankings', 1 FROM menu_items WHERE route='social';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Alliances', 'alliances', 2 FROM menu_items WHERE route='social';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Messages', 'messages', 3 FROM menu_items WHERE route='social';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Planet List', 'planet-list', 1 FROM menu_items WHERE route='planets';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Bonuses', 'planet-bonuses', 2 FROM menu_items WHERE route='planets';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Defenses', 'planet-defenses', 3 FROM menu_items WHERE route='planets';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Ship', 'ship', 1 FROM menu_items WHERE route='mothership';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Modules', 'modules', 2 FROM menu_items WHERE route='mothership';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Exploration', 'exploration', 3 FROM menu_items WHERE route='mothership';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Race', 'race', 1 FROM menu_items WHERE route='account';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Vacation', 'vacation', 2 FROM menu_items WHERE route='account';
INSERT INTO menu_items (parent_id, label, route, sort_order)
SELECT id, 'Ascension', 'ascension', 3 FROM menu_items WHERE route='account';

INSERT INTO players (username, display_name, password_hash, race_id)
SELECT 'demo', 'Commander Tanang', SHA2('demo123', 256), id FROM races WHERE name='Tau''ri';
INSERT INTO player_resources (player_id) SELECT id FROM players WHERE username='demo';

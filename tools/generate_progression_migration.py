from pathlib import Path

root = Path(__file__).resolve().parents[1]
tiers = ['Awakening','Initiate','Frontier','Settler','Architect','Warden','Commander','Admiral','Strategist','Dominion','Ascendant','Stellar','Nebular','Galactic','Eternal','Transcendent','Singularity','Omniscient','Apex','Mythic','Gatebreaker']
categories = ['player','building','technology','unit','fleet','defense','colony','mothership','exploration','diplomacy','race','government']
lines = ["USE stargatewars;", "", "CREATE TABLE IF NOT EXISTS progression_tiers (id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,tier_number TINYINT UNSIGNED NOT NULL UNIQUE,tier_name VARCHAR(80) NOT NULL,unlock_score BIGINT UNSIGNED NOT NULL,description VARCHAR(255) NOT NULL) ENGINE=InnoDB;", "CREATE TABLE IF NOT EXISTS progression_levels (id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,tier_id TINYINT UNSIGNED NOT NULL,level_number TINYINT UNSIGNED NOT NULL,global_level SMALLINT UNSIGNED NOT NULL UNIQUE,xp_cost BIGINT UNSIGNED NOT NULL,metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,food_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,water_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,dark_matter_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,effect_percent DECIMAL(8,3) NOT NULL DEFAULT 0,build_seconds INT UNSIGNED NOT NULL DEFAULT 60,FOREIGN KEY(tier_id) REFERENCES progression_tiers(id) ON DELETE CASCADE,UNIQUE KEY uq_tier_level(tier_id,level_number)) ENGINE=InnoDB;", "CREATE TABLE IF NOT EXISTS progression_entities (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,player_id INT UNSIGNED NOT NULL,entity_category VARCHAR(30) NOT NULL,entity_key VARCHAR(100) NOT NULL,tier_number TINYINT UNSIGNED NOT NULL DEFAULT 1,level_number TINYINT UNSIGNED NOT NULL DEFAULT 1,experience BIGINT UNSIGNED NOT NULL DEFAULT 0,updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,UNIQUE KEY uq_player_entity(player_id,entity_category,entity_key),KEY idx_entity_level(entity_category,tier_number,level_number)) ENGINE=InnoDB;", "CREATE TABLE IF NOT EXISTS progression_prerequisites (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,entity_category VARCHAR(30) NOT NULL,entity_key VARCHAR(100) NOT NULL,required_category VARCHAR(30) NOT NULL,required_key VARCHAR(100) NOT NULL,required_tier TINYINT UNSIGNED NOT NULL DEFAULT 1,required_level TINYINT UNSIGNED NOT NULL DEFAULT 1,UNIQUE KEY uq_progression_requirement(entity_category,entity_key,required_category,required_key)) ENGINE=InnoDB;", "CREATE TABLE IF NOT EXISTS progression_events (id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,player_id INT UNSIGNED NOT NULL,entity_category VARCHAR(30) NOT NULL,entity_key VARCHAR(100) NOT NULL,tier_before TINYINT UNSIGNED NOT NULL,level_before TINYINT UNSIGNED NOT NULL,tier_after TINYINT UNSIGNED NOT NULL,level_after TINYINT UNSIGNED NOT NULL,cost_payload JSON NULL,created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,KEY idx_progress_event_player(player_id,created_at)) ENGINE=InnoDB;", ""]
for i, name in enumerate(tiers, 1):
    desc = f'Tier {i} of 21; levels 1 through 23 unlock deeper {name.lower()} capabilities.'
    lines.append(f"INSERT INTO progression_tiers(tier_number,tier_name,unlock_score,description) VALUES({i},'{name}',{(i-1)*100000},'{desc}') ON DUPLICATE KEY UPDATE tier_name=VALUES(tier_name),unlock_score=VALUES(unlock_score),description=VALUES(description);")
lines.append("")
for global_level in range(1, 21*23 + 1):
    tier = (global_level-1)//23 + 1
    level = (global_level-1)%23 + 1
    xp = 1000 * global_level * global_level
    metal = 500 * global_level
    crystal = 350 * global_level
    naquadah = 250 * global_level
    food = 100 * global_level
    water = 100 * global_level
    energy = 25 * global_level
    dm = 0 if global_level % 23 else tier * 5
    effect = round(global_level * 0.75, 3)
    seconds = 60 + global_level * 30
    lines.append(f"INSERT INTO progression_levels(tier_id,level_number,global_level,xp_cost,metal_cost,crystal_cost,naquadah_cost,food_cost,water_cost,energy_cost,dark_matter_cost,effect_percent,build_seconds) SELECT id,{level},{global_level},{xp},{metal},{crystal},{naquadah},{food},{water},{energy},{dm},{effect},{seconds} FROM progression_tiers WHERE tier_number={tier} ON DUPLICATE KEY UPDATE xp_cost=VALUES(xp_cost),metal_cost=VALUES(metal_cost),crystal_cost=VALUES(crystal_cost),naquadah_cost=VALUES(naquadah),food_cost=VALUES(food_cost),water_cost=VALUES(water_cost),energy_cost=VALUES(energy_cost),dark_matter_cost=VALUES(dark_matter_cost),effect_percent=VALUES(effect_percent),build_seconds=VALUES(build_seconds);")
lines.append("")
for category in categories:
    key = category + '_core'
    lines.append(f"INSERT INTO progression_entities(player_id,entity_category,entity_key) SELECT id,'{category}','{key}' FROM players WHERE NOT EXISTS (SELECT 1 FROM progression_entities pe WHERE pe.player_id=players.id AND pe.entity_category='{category}' AND pe.entity_key='{key}');")
(root/'sql/015_universal_progression_21x23.sql').write_text('\n'.join(lines)+'\n')
print('created sql/015_universal_progression_21x23.sql with 21 tiers and 483 levels')

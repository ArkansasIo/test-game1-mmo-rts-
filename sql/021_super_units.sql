ALTER TABLE unit_types MODIFY category ENUM('workforce','military','covert','elite') NOT NULL;
ALTER TABLE unit_types ADD COLUMN IF NOT EXISTS prerequisite_key VARCHAR(80) NULL;
ALTER TABLE unit_types ADD COLUMN IF NOT EXISTS prerequisite_level INT UNSIGNED NOT NULL DEFAULT 1;
ALTER TABLE unit_types ADD COLUMN IF NOT EXISTS tier_mastery DECIMAL(8,3) NOT NULL DEFAULT 1.000;
ALTER TABLE unit_types ADD COLUMN IF NOT EXISTS strategic_cost BIGINT UNSIGNED NOT NULL DEFAULT 1000;

INSERT INTO unit_types(unit_key,name,category,stat_column,recruit_cost,seconds_per_unit,academy_level_required,base_power,description,prerequisite_key,prerequisite_level,tier_mastery,strategic_cost) VALUES
('super_attack_units','Ascendant Strike Corps','elite','super_attack_units',1500,90,3,25,'Elite offensive units trained for decisive fleet engagements.','siege',2,2.500,1500),
('super_defense_units','Citadel Guardian Corps','elite','super_defense_units',1400,90,3,25,'Elite defensive units trained to hold strategic worlds.','fortification',2,2.500,1400)
ON DUPLICATE KEY UPDATE name=VALUES(name),category=VALUES(category),stat_column=VALUES(stat_column),recruit_cost=VALUES(recruit_cost),seconds_per_unit=VALUES(seconds_per_unit),academy_level_required=VALUES(academy_level_required),base_power=VALUES(base_power),description=VALUES(description),prerequisite_key=VALUES(prerequisite_key),prerequisite_level=VALUES(prerequisite_level),tier_mastery=VALUES(tier_mastery),strategic_cost=VALUES(strategic_cost);

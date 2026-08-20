USE stargatewars;

ALTER TABLE player_resources
  ADD COLUMN IF NOT EXISTS metal BIGINT UNSIGNED NOT NULL DEFAULT 820000,
  ADD COLUMN IF NOT EXISTS crystal BIGINT UNSIGNED NOT NULL DEFAULT 460000,
  ADD COLUMN IF NOT EXISTS energy BIGINT UNSIGNED NOT NULL DEFAULT 640,
  ADD COLUMN IF NOT EXISTS dark_matter BIGINT UNSIGNED NOT NULL DEFAULT 2500,
  ADD COLUMN IF NOT EXISTS food BIGINT UNSIGNED NOT NULL DEFAULT 10000,
  ADD COLUMN IF NOT EXISTS water BIGINT UNSIGNED NOT NULL DEFAULT 10000,
  ADD COLUMN IF NOT EXISTS population BIGINT UNSIGNED NOT NULL DEFAULT 100,
  ADD COLUMN IF NOT EXISTS population_capacity BIGINT UNSIGNED NOT NULL DEFAULT 1000,
  ADD COLUMN IF NOT EXISTS food_rate DECIMAL(12,4) NOT NULL DEFAULT 0.25,
  ADD COLUMN IF NOT EXISTS water_rate DECIMAL(12,4) NOT NULL DEFAULT 0.20,
  ADD COLUMN IF NOT EXISTS growth_rate DECIMAL(12,6) NOT NULL DEFAULT 0.010000,
  ADD COLUMN IF NOT EXISTS workforce BIGINT UNSIGNED NOT NULL DEFAULT 100;

INSERT INTO game_resource_types(resource_key,display_name,category) VALUES
 ('metal','Metal','strategic'),('crystal','Crystal','strategic'),('naquadah','Naquadah','currency'),('energy','Energy','strategic'),('dark_matter','Dark Matter','currency'),('food','Food','life_support'),('water','Water','life_support'),('population','Population','population')
ON DUPLICATE KEY UPDATE display_name=VALUES(display_name),category=VALUES(category);

CREATE TABLE IF NOT EXISTS resource_transactions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  colony_id INT UNSIGNED NULL,
  resource_key VARCHAR(40) NOT NULL,
  amount BIGINT NOT NULL,
  reason VARCHAR(80) NOT NULL,
  turn_number INT UNSIGNED NULL,
  metadata JSON NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY(player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY(colony_id) REFERENCES colonies(id) ON DELETE SET NULL,
  FOREIGN KEY(resource_key) REFERENCES game_resource_types(resource_key) ON DELETE RESTRICT,
  KEY idx_resource_player_time(player_id,created_at),
  KEY idx_resource_colony_time(colony_id,created_at)
) ENGINE=InnoDB;

ALTER TABLE colonies
  ADD COLUMN IF NOT EXISTS energy_stock BIGINT UNSIGNED NOT NULL DEFAULT 640,
  ADD COLUMN IF NOT EXISTS energy_capacity BIGINT UNSIGNED NOT NULL DEFAULT 10000,
  ADD COLUMN IF NOT EXISTS food_rate DECIMAL(12,4) NOT NULL DEFAULT 0.25,
  ADD COLUMN IF NOT EXISTS water_rate DECIMAL(12,4) NOT NULL DEFAULT 0.20,
  ADD COLUMN IF NOT EXISTS growth_rate DECIMAL(12,6) NOT NULL DEFAULT 0.010000,
  ADD COLUMN IF NOT EXISTS workforce BIGINT UNSIGNED NOT NULL DEFAULT 100;

UPDATE player_resources SET metal=COALESCE(NULLIF(metal,0),820000),crystal=COALESCE(NULLIF(crystal,0),460000),energy=COALESCE(NULLIF(energy,0),640),food=COALESCE(NULLIF(food,0),10000),water=COALESCE(NULLIF(water,0),10000),population=COALESCE(NULLIF(population,0),100),population_capacity=COALESCE(NULLIF(population_capacity,0),1000),workforce=COALESCE(NULLIF(workforce,0),100);
UPDATE colonies SET energy_stock=COALESCE(NULLIF(energy_stock,0),640),food_rate=COALESCE(NULLIF(food_rate,0),0.25),water_rate=COALESCE(NULLIF(water_rate,0),0.20),growth_rate=COALESCE(NULLIF(growth_rate,0),0.01),workforce=COALESCE(NULLIF(workforce,0),population);

-- Keep the authoritative 100,000 planet/moon capacity present for every player,
-- including accounts created after migration 053 was originally applied.
INSERT INTO player_empire_limits (player_id, max_planets, max_moons, homeworld_required)
SELECT id, 100000, 100000, 1
FROM players
ON DUPLICATE KEY UPDATE
  max_planets = GREATEST(max_planets, 100000),
  max_moons = GREATEST(max_moons, 100000),
  homeworld_required = 1;

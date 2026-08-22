<?php
return array (
  'purpose' => 'Manage colonies, biomes, defenses, population, and life support.',
  'workflow' => 
  array (
    0 => 'load planet portfolio',
    1 => 'load biome and bonuses',
    2 => 'validate colony ownership',
    3 => 'process exploration or defense action',
    4 => 'render life support',
  ),
  'validation' => 
  array (
    0 => 'authenticated colony owner',
    1 => 'planet occupancy',
    2 => 'habitability',
    3 => 'resource balance',
  ),
  'calculations' => 
  array (
    0 => 'production − food/water upkeep + morale and habitability modifiers',
  ),
  'mutations' => 
  array (
    0 => 'player_colonies',
    1 => 'planet_defenses',
    2 => 'universe_planets',
    3 => 'game_events',
  ),
);

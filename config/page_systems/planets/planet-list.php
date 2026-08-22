<?php
return array (
  'services' => 
  array (
    0 => 'ColonyService',
    1 => 'PlanetService',
    2 => 'ExplorationService',
  ),
  'reads' => 
  array (
    0 => 'player_planets',
    1 => 'player_colonies',
    2 => 'planet_bonuses',
    3 => 'planet_defenses',
    4 => 'universe_planets',
  ),
  'writes' => 
  array (
    0 => 'player_colonies',
    1 => 'planet_defenses',
    2 => 'universe_planets',
    3 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'explore',
    1 => 'colonize_planet',
    2 => 'planet_defense',
  ),
);

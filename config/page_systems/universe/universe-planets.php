<?php
return array (
  'services' => 
  array (
    0 => 'UniverseService',
    1 => 'ColonyService',
  ),
  'reads' => 
  array (
    0 => 'universe_planets',
    1 => 'universe_moons',
    2 => 'player_colonies',
  ),
  'writes' => 
  array (
    0 => 'universe_planets',
    1 => 'player_colonies',
    2 => 'game_audit_log',
  ),
  'actions' => 
  array (
    0 => 'planet_details',
    1 => 'colonize_planet',
  ),
);

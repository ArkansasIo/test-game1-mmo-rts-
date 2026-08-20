<?php
return array (
  'services' => 
  array (
    0 => 'UniverseService',
    1 => 'ExplorationService',
  ),
  'reads' => 
  array (
    0 => 'universe_solar_systems',
    1 => 'universe_planets',
    2 => 'universe_discoveries',
  ),
  'writes' => 
  array (
    0 => 'universe_discoveries',
    1 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'system_map',
    1 => 'explore',
  ),
);

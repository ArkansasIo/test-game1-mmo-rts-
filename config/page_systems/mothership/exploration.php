<?php
return array (
  'services' => 
  array (
    0 => 'ExplorationService',
    1 => 'MothershipService',
  ),
  'reads' => 
  array (
    0 => 'motherships',
    1 => 'universe_solar_systems',
    2 => 'universe_planets',
    3 => 'universe_moons',
  ),
  'writes' => 
  array (
    0 => 'universe_discoveries',
    1 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'explore',
  ),
);

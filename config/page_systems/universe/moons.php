<?php
return array (
  'services' => 
  array (
    0 => 'UniverseService',
    1 => 'MothershipService',
  ),
  'reads' => 
  array (
    0 => 'universe_moons',
    1 => 'universe_planets',
    2 => 'player_colonies',
    3 => 'mothership_modules',
  ),
  'writes' => 
  array (
    0 => 'mothership_modules',
    1 => 'player_colonies',
  ),
  'actions' => 
  array (
    0 => 'moon_details',
    1 => 'mothership_upgrade',
  ),
);

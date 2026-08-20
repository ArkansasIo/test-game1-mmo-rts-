<?php
return array (
  'group' => 'universe',
  'label' => 'Universe',
  'icon' => '✦',
  'parent_route' => 'universe',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'galaxies',
      'title' => 'Galaxy Map',
      'layout' => 'galaxies',
      'definition' => 'config/page_definitions/universe/galaxies.php',
      'actions' => 
      array (
        0 => 'universe_galaxies',
      ),
      'tables' => 
      array (
        0 => 'universe_galaxies',
        1 => 'universe_sectors',
      ),
    ),
    1 => 
    array (
      'route' => 'sectors',
      'title' => 'Sector Map',
      'layout' => 'sectors',
      'definition' => 'config/page_definitions/universe/sectors.php',
      'actions' => 
      array (
        0 => 'universe_sectors',
      ),
      'tables' => 
      array (
        0 => 'universe_sectors',
        1 => 'universe_solar_systems',
      ),
    ),
    2 => 
    array (
      'route' => 'solar-systems',
      'title' => 'Solar Systems',
      'layout' => 'solar-systems',
      'definition' => 'config/page_definitions/universe/solar-systems.php',
      'actions' => 
      array (
        0 => 'system_map',
        1 => 'explore',
      ),
      'tables' => 
      array (
        0 => 'universe_solar_systems',
        1 => 'universe_planets',
      ),
    ),
    3 => 
    array (
      'route' => 'universe-planets',
      'title' => 'Universe Planets',
      'layout' => 'universe-planets',
      'definition' => 'config/page_definitions/universe/universe-planets.php',
      'actions' => 
      array (
        0 => 'planet_details',
        1 => 'colonize_planet',
      ),
      'tables' => 
      array (
        0 => 'universe_planets',
        1 => 'player_colonies',
      ),
    ),
    4 => 
    array (
      'route' => 'moons',
      'title' => 'Moon Registry',
      'layout' => 'moons',
      'definition' => 'config/page_definitions/universe/moons.php',
      'actions' => 
      array (
        0 => 'moon_details',
        1 => 'mothership_upgrade',
      ),
      'tables' => 
      array (
        0 => 'universe_moons',
        1 => 'universe_planets',
      ),
    ),
    5 => 
    array (
      'route' => 'coordinates',
      'title' => 'Coordinate Search',
      'layout' => 'coordinates',
      'definition' => 'config/page_definitions/universe/coordinates.php',
      'actions' => 
      array (
        0 => 'coordinate_lookup',
      ),
      'tables' => 
      array (
        0 => 'universe_galaxies',
        1 => 'universe_sectors',
        2 => 'universe_solar_systems',
        3 => 'universe_planets',
      ),
    ),
  ),
);

<?php
return array (
  'route' => 'coordinates',
  'group' => 'universe',
  'group_label' => 'Universe',
  'title' => 'Coordinate Search',
  'layout' => 'coordinates',
  'controls' => 
  array (
    0 => 'Search coordinates',
    1 => 'Open system',
  ),
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
  'details' => 
  array (
    'hero' => 'Coordinate Search',
    'panels' => 
    array (
      0 => 'Coordinate input',
      1 => 'Galaxy result',
      2 => 'System result',
      3 => 'Planet and moon result',
    ),
    'formula' => 'coordinate = galaxy:sector:system:orbit; every level is validated server-side',
    'controls' => 
    array (
      0 => 'Search coordinates',
      1 => 'Open system',
      2 => 'Inspect planet',
    ),
    'action' => NULL,
    'tables' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_moons',
    ),
    'permission' => 'authenticated commander',
    'states' => 
    array (
      0 => 'ready',
      1 => 'empty',
      2 => 'invalid-input',
      3 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Coordinate Search',
    'purpose' => 'Find a galaxy, sector, system, planet, or moon.',
    'buttons' => 
    array (
      'Search coordinates' => 
      array (
        'action' => 'coordinate_lookup',
        'logic' => 'Parse galaxy:sector:system:orbit and query each hierarchy level safely.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_moons',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'invalid-input',
          3 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Validate and resolve galaxy:sector:system:orbit coordinates.',
    'workflow' => 
    array (
      0 => 'validate coordinate input',
      1 => 'find galaxy',
      2 => 'find sector',
      3 => 'find system',
      4 => 'find planet or moon',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'coordinate format',
      2 => 'coordinate bounds',
    ),
    'calculations' => 
    array (
      0 => 'coordinate = galaxy:sector:system:orbit',
    ),
    'mutations' => 
    array (
    ),
  ),
  'features' => 
  array (
    0 => 'coordinate input',
    1 => 'galaxy result',
    2 => 'system result',
    3 => 'planet result',
    4 => 'moon result',
  ),
  'design' => 
  array (
    'template' => 'coordinate-search',
    'sections' => 
    array (
      0 => 'input',
      1 => 'galaxy',
      2 => 'sector',
      3 => 'system',
      4 => 'planet/moon',
    ),
    'components' => 
    array (
      0 => 'coordinate-form',
      1 => 'result-path',
      2 => 'coordinate-badge',
      3 => 'detail-link',
    ),
    'responsive' => 'Result path wraps into vertical steps',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'UniverseService',
    ),
    'reads' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_moons',
    ),
    'writes' => 
    array (
    ),
    'actions' => 
    array (
      0 => 'coordinate_lookup',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/universe/coordinates.php',
    'features' => 'config/page_features/universe/coordinates.php',
    'design' => 'config/page_design_specs/universe/coordinates.php',
    'systems' => 'config/page_systems/universe/coordinates.php',
  ),
);

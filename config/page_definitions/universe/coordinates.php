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
    4 => 'universe_discoveries',
    5 => 'player_colonies',
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
    'formula' => 'coordinate lookup = validated galaxy : sector : system : slot tuple',
    'controls' => 
    array (
      0 => 'Search coordinates',
      1 => 'Open system',
      2 => 'Inspect planet',
    ),
    'action' => 'coordinate_lookup',
    'tables' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'player_colonies',
    ),
    'permission' => 'authenticated commander · coordinate access',
    'states' => 
    array (
      0 => 'ready',
      1 => 'empty',
      2 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Coordinate Search',
    'purpose' => 'Locate a validated galaxy:sector:system:orbit tuple and disclose only permitted information.',
    'buttons' => 
    array (
      'Search coordinates' => 
      array (
        'action' => 'coordinate_lookup',
        'logic' => 'Parse galaxy:sector:system:orbit, validate each hierarchy level and bounds, apply discovery filtering, classify ownership, and return scoped navigation identifiers.',
        'permission' => 'authenticated commander · coordinate access',
        'reads' => 
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_discoveries',
          5 => 'player_colonies',
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
    'purpose' => 'Validate a coordinate tuple through the galaxy, sector, system, and orbit hierarchy, then apply discovery and ownership visibility.',
    'workflow' => 
    array (
      0 => 'validate coordinate input',
      1 => 'find galaxy',
      2 => 'find sector',
      3 => 'find system',
      4 => 'find planet at orbit slot',
      5 => 'apply discovery filter',
      6 => 'classify ownership and return navigation identifiers',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'coordinate format',
      2 => 'coordinate bounds',
      3 => 'hierarchy validity',
      4 => 'discovery or ownership visibility',
    ),
    'calculations' => 
    array (
      0 => 'coordinate lookup = validated galaxy : sector : system : slot tuple',
      1 => 'visibility = discovered system OR commander-owned colony',
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
    'module' => 'includes/page_modules/universe/coordinates.php',
  ),
);

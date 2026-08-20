<?php
return array (
  'route' => 'solar-systems',
  'group' => 'universe',
  'group_label' => 'Universe',
  'title' => 'Solar Systems',
  'layout' => 'solar-systems',
  'controls' => 
  array (
    0 => 'Open system',
    1 => 'Scan system',
  ),
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
  'details' => 
  array (
    'hero' => 'Solar Systems',
    'panels' => 
    array (
      0 => 'Star class',
      1 => 'Orbit map',
      2 => 'Planet slots',
      3 => 'Anomaly scan',
    ),
    'formula' => 'system travel = base travel × system modifier × sector danger',
    'controls' => 
    array (
      0 => 'Open system',
      1 => 'Scan system',
      2 => 'Explore anomaly',
    ),
    'action' => 'explore',
    'tables' => 
    array (
      0 => 'universe_solar_systems',
      1 => 'universe_planets',
      2 => 'universe_discoveries',
    ),
    'permission' => 'authenticated commander',
    'states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'cooldown',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Solar Systems',
    'purpose' => 'Scan stars, orbits, planets, and anomalies.',
    'buttons' => 
    array (
      'Scan system' => 
      array (
        'action' => 'system_map',
        'logic' => 'Load orbit map and resolve permitted scan information.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'universe_solar_systems',
          1 => 'universe_planets',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'error',
        ),
      ),
      'Explore anomaly' => 
      array (
        'action' => 'explore',
        'logic' => 'Create discovery record and event reward when successful.',
        'permission' => 'exploration-capable commander',
        'reads' => 
        array (
          0 => 'universe_solar_systems',
          1 => 'universe_discoveries',
        ),
        'writes' => 
        array (
          0 => 'universe_discoveries',
          1 => 'game_events',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'cooldown',
          2 => 'success',
          3 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Browse star class, orbit map, planet slots, and anomalies.',
    'workflow' => 
    array (
      0 => 'open system',
      1 => 'load orbit map',
      2 => 'scan anomaly',
      3 => 'calculate travel',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'valid system identifier',
      2 => 'exploration capacity',
    ),
    'calculations' => 
    array (
      0 => 'base travel × system modifier × sector danger',
    ),
    'mutations' => 
    array (
      0 => 'universe_discoveries',
      1 => 'game_events',
    ),
  ),
  'features' => 
  array (
    0 => 'star class',
    1 => 'orbit map',
    2 => 'planet slots',
    3 => 'anomaly scan',
  ),
  'design' => 
  array (
    'template' => 'solar-system-map',
    'sections' => 
    array (
      0 => 'star',
      1 => 'orbits',
      2 => 'planet slots',
      3 => 'anomaly',
    ),
    'components' => 
    array (
      0 => 'orbit-list',
      1 => 'planet-slot',
      2 => 'star-badge',
      3 => 'scan-control',
    ),
    'responsive' => 'Orbit list becomes stacked planets',
  ),
  'systems' => 
  array (
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
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/universe/solar-systems.php',
    'features' => 'config/page_features/universe/solar-systems.php',
    'design' => 'config/page_design_specs/universe/solar-systems.php',
    'systems' => 'config/page_systems/universe/solar-systems.php',
    'module' => 'includes/page_modules/universe/solar-systems.php',
  ),
);

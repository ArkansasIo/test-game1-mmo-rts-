<?php
return array (
  'route' => 'exploration',
  'group' => 'mothership',
  'group_label' => 'Mothership',
  'title' => 'Exploration',
  'layout' => 'exploration',
  'controls' => 
  array (
    0 => 'Explore planet',
  ),
  'actions' => 
  array (
    0 => 'explore',
  ),
  'tables' => 
  array (
    0 => 'motherships',
    1 => 'planet_explorations',
  ),
  'details' => 
  array (
    'hero' => 'Exploration',
    'panels' => 
    array (
      0 => 'Discovery range',
      1 => 'System scan',
      2 => 'Anomaly chance',
      3 => 'Discovery rewards',
    ),
    'formula' => 'discovery = exploration level + sensor bonus + anomaly rate − travel risk',
    'controls' => 
    array (
      0 => 'Explore system',
      1 => 'Scan planet',
      2 => 'Record discovery',
    ),
    'action' => 'explore',
    'tables' => 
    array (
      0 => 'motherships',
      1 => 'universe_solar_systems',
      2 => 'universe_planets',
      3 => 'universe_moons',
      4 => 'universe_discoveries',
    ),
    'permission' => 'authenticated commander with exploration capacity',
    'states' => 
    array (
      0 => 'ready',
      1 => 'cooldown',
      2 => 'success',
      3 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Exploration',
    'purpose' => 'Explore systems, anomalies, planets, and discovery opportunities.',
    'buttons' => 
    array (
      'Explore' => 
      array (
        'action' => 'explore',
        'logic' => 'Validate mothership readiness, calculate travel, resolve anomaly, and write discovery or event result.',
        'permission' => 'exploration-capable commander',
        'reads' => 
        array (
          0 => 'motherships',
          1 => 'universe_solar_systems',
          2 => 'universe_planets',
          3 => 'universe_discoveries',
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
    'purpose' => 'Explore systems, planets, moons, anomalies, and discovery rewards.',
    'workflow' => 
    array (
      0 => 'load sensor range',
      1 => 'validate mission capacity',
      2 => 'calculate travel risk',
      3 => 'resolve anomaly',
      4 => 'record discovery',
    ),
    'validation' => 
    array (
      0 => 'exploration-capable commander',
      1 => 'mothership readiness',
      2 => 'cooldown',
      3 => 'target visibility',
    ),
    'calculations' => 
    array (
      0 => 'exploration level + sensor bonus + anomaly rate − travel risk',
    ),
    'mutations' => 
    array (
      0 => 'universe_discoveries',
      1 => 'game_events',
    ),
  ),
  'features' => 
  array (
    0 => 'discovery range',
    1 => 'system scan',
    2 => 'anomaly chance',
    3 => 'discovery rewards',
    4 => 'travel risk',
  ),
  'design' => 
  array (
    'template' => 'exploration-board',
    'sections' => 
    array (
      0 => 'range',
      1 => 'system scan',
      2 => 'anomaly',
      3 => 'rewards',
    ),
    'components' => 
    array (
      0 => 'scan-form',
      1 => 'risk-meter',
      2 => 'discovery-card',
      3 => 'mission-status',
    ),
    'responsive' => 'Exploration panels stack vertically',
  ),
  'systems' => 
  array (
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
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/mothership/exploration.php',
    'features' => 'config/page_features/mothership/exploration.php',
    'design' => 'config/page_design_specs/mothership/exploration.php',
    'systems' => 'config/page_systems/mothership/exploration.php',
    'module' => 'includes/page_modules/mothership/exploration.php',
  ),
);

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
      0 => 'Available expeditions',
      1 => 'Distance and travel time',
      2 => 'Biome rarity and yield',
      3 => 'Discovery risk and mission result',
    ),
    'formula' => 'exploration yield = distance × ship science × biome rarity',
    'controls' => 
    array (
      0 => 'Explore',
    ),
    'action' => 'explore',
    'tables' => 
    array (
      0 => 'motherships',
      1 => 'planet_explorations',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'player_resources',
      5 => 'player_cooldowns',
      6 => 'game_events',
    ),
    'permission' => 'authenticated commander with mothership readiness',
    'states' => 
    array (
      0 => 'ready',
      1 => 'protected',
      2 => 'insufficient-resource',
      3 => 'cooldown',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Exploration',
    'purpose' => 'Dispatch a ready mothership to a validated unoccupied universe planet.',
    'buttons' => 
    array (
      'Explore' => 
      array (
        'action' => 'explore',
        'logic' => 'Validate mothership ownership and hull readiness, lock the universe target, calculate distance × ship science × biome rarity, persist travel time and discovery risk, consume Naquadah, and record the result transactionally.',
        'permission' => 'authenticated commander with mothership readiness',
        'reads' => 
        array (
          0 => 'motherships',
          1 => 'universe_solar_systems',
          2 => 'universe_planets',
          3 => 'player_resources',
          4 => 'player_cooldowns',
        ),
        'writes' => 
        array (
          0 => 'planet_explorations',
          1 => 'player_resources',
          2 => 'player_cooldowns',
          3 => 'game_events',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
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

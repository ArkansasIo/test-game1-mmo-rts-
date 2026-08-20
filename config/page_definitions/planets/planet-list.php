<?php
return array (
  'route' => 'planet-list',
  'group' => 'planets',
  'group_label' => 'Planets',
  'title' => 'Planet List',
  'layout' => 'planets',
  'controls' => 
  array (
    0 => 'Explore',
    1 => 'Conquer',
  ),
  'actions' => 
  array (
    0 => 'explore',
    1 => 'combat',
  ),
  'tables' => 
  array (
    0 => 'player_planets',
    1 => 'planet_explorations',
  ),
  'details' => 
  array (
    'hero' => 'Planet and Colony Management',
    'panels' => 
    array (
      0 => 'Planet portfolio',
      1 => 'Biome modifiers',
      2 => 'Defenses',
      3 => 'Population and life support',
    ),
    'formula' => 'colony state = production − food/water upkeep + morale and habitability modifiers',
    'controls' => 
    array (
      0 => 'Explore',
      1 => 'Colonize',
      2 => 'Upgrade defense',
      3 => 'View bonuses',
    ),
    'action' => 'planet_defense',
    'tables' => 
    array (
      0 => 'player_planets',
      1 => 'planet_bonuses',
      2 => 'planet_defenses',
      3 => 'universe_planets',
      4 => 'player_colonies',
    ),
    'permission' => 'authenticated colony owner',
    'states' => 
    array (
      0 => 'ready',
      1 => 'empty',
      2 => 'protected',
      3 => 'insufficient-resource',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Planets and Colonies',
    'purpose' => 'Manage worlds, biomes, defenses, and life support.',
    'buttons' => 
    array (
      'Explore' => 
      array (
        'action' => 'explore',
        'logic' => 'Resolve exploration travel, anomaly, discovery, and event reward.',
        'permission' => 'exploration-capable commander',
        'reads' => 
        array (
          0 => 'motherships',
          1 => 'universe_solar_systems',
          2 => 'universe_planets',
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
      'Colonize' => 
      array (
        'action' => 'colonize_planet',
        'logic' => 'Lock planet, validate habitability and occupancy, then create colony.',
        'permission' => 'commander with colonization access',
        'reads' => 
        array (
          0 => 'universe_planets',
          1 => 'universe_moons',
          2 => 'player_colonies',
        ),
        'writes' => 
        array (
          0 => 'player_colonies',
          1 => 'universe_planets',
          2 => 'game_audit_log',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'occupied',
          2 => 'protected',
          3 => 'insufficient-resource',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'Upgrade defense' => 
      array (
        'action' => 'planet_defense',
        'logic' => 'Validate colony ownership, resource cost, and defense level cap.',
        'permission' => 'colony owner',
        'reads' => 
        array (
          0 => 'planet_defenses',
          1 => 'player_colonies',
          2 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'planet_defenses',
          1 => 'player_resources',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'success',
          3 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Manage colonies, biomes, defenses, population, and life support.',
    'workflow' => 
    array (
      0 => 'load planet portfolio',
      1 => 'load biome and bonuses',
      2 => 'validate colony ownership',
      3 => 'process exploration or defense action',
      4 => 'render life support',
    ),
    'validation' => 
    array (
      0 => 'authenticated colony owner',
      1 => 'planet occupancy',
      2 => 'habitability',
      3 => 'resource balance',
    ),
    'calculations' => 
    array (
      0 => 'production − food/water upkeep + morale and habitability modifiers',
    ),
    'mutations' => 
    array (
      0 => 'player_colonies',
      1 => 'planet_defenses',
      2 => 'universe_planets',
      3 => 'game_events',
    ),
  ),
  'features' => 
  array (
    0 => 'planet portfolio',
    1 => 'biome modifiers',
    2 => 'defenses',
    3 => 'population',
    4 => 'food and water',
    5 => 'exploration',
    6 => 'colonization',
  ),
  'design' => 
  array (
    'template' => 'colony-grid',
    'sections' => 
    array (
      0 => 'planet selector',
      1 => 'population',
      2 => 'biome',
      3 => 'life support',
      4 => 'defenses',
    ),
    'components' => 
    array (
      0 => 'planet-card',
      1 => 'biome-badge',
      2 => 'life-support-meter',
      3 => 'defense-table',
    ),
    'responsive' => 'Planet cards use one column on mobile',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'ColonyService',
      1 => 'PlanetService',
      2 => 'ExplorationService',
    ),
    'reads' => 
    array (
      0 => 'player_planets',
      1 => 'player_colonies',
      2 => 'planet_bonuses',
      3 => 'planet_defenses',
      4 => 'universe_planets',
    ),
    'writes' => 
    array (
      0 => 'player_colonies',
      1 => 'planet_defenses',
      2 => 'universe_planets',
      3 => 'game_events',
    ),
    'actions' => 
    array (
      0 => 'explore',
      1 => 'colonize_planet',
      2 => 'planet_defense',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/planets/planet-list.php',
    'features' => 'config/page_features/planets/planet-list.php',
    'design' => 'config/page_design_specs/planets/planet-list.php',
    'systems' => 'config/page_systems/planets/planet-list.php',
    'module' => 'includes/page_modules/planets/planet-list.php',
  ),
);

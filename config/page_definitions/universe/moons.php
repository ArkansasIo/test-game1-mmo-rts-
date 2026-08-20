<?php
return array (
  'route' => 'moons',
  'group' => 'universe',
  'group_label' => 'Universe',
  'title' => 'Moon Registry',
  'layout' => 'moons',
  'controls' => 
  array (
    0 => 'Inspect moon',
    1 => 'Build jump gate',
  ),
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
  'details' => 
  array (
    'hero' => 'Moon Registry',
    'panels' => 
    array (
      0 => 'Moon class and biome',
      1 => 'Sensor bonus',
      2 => 'Jump-gate level',
      3 => 'Orbit relationship',
    ),
    'formula' => 'moon utility = sensor bonus + jump-gate level + moon resource modifiers',
    'controls' => 
    array (
      0 => 'Inspect moon',
      1 => 'Build jump gate',
      2 => 'Assign colony',
    ),
    'action' => 'mothership_upgrade',
    'tables' => 
    array (
      0 => 'universe_moons',
      1 => 'universe_planets',
      2 => 'player_colonies',
      3 => 'mothership_modules',
    ),
    'permission' => 'authenticated commander with moon access',
    'states' => 
    array (
      0 => 'ready',
      1 => 'empty',
      2 => 'occupied',
      3 => 'success',
      4 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Moon Registry',
    'purpose' => 'Inspect and develop moons.',
    'buttons' => 
    array (
      'Inspect moon' => 
      array (
        'action' => 'moon_details',
        'logic' => 'Load moon class, biome, sensor bonus, jump-gate, and parent planet.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'universe_moons',
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
      'Build jump gate' => 
      array (
        'action' => 'mothership_upgrade',
        'logic' => 'Validate moon ownership and module cost before upgrading gate.',
        'permission' => 'moon owner',
        'reads' => 
        array (
          0 => 'universe_moons',
          1 => 'player_colonies',
          2 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'universe_moons',
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
    'purpose' => 'Inspect moon class, sensor bonus, jump gate, and orbit relationship.',
    'workflow' => 
    array (
      0 => 'inspect moon',
      1 => 'load parent planet',
      2 => 'calculate utility',
      3 => 'validate jump-gate upgrade',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'moon access',
      2 => 'colony or mothership ownership',
    ),
    'calculations' => 
    array (
      0 => 'sensor bonus + jump-gate level + moon resource modifiers',
    ),
    'mutations' => 
    array (
      0 => 'universe_moons',
      1 => 'mothership_modules',
      2 => 'player_colonies',
    ),
  ),
  'features' => 
  array (
    0 => 'moon registry',
    1 => 'moon class',
    2 => 'sensor bonus',
    3 => 'jump-gate level',
    4 => 'orbit relationship',
  ),
  'design' => 
  array (
    'template' => 'moon-registry',
    'sections' => 
    array (
      0 => 'moon identity',
      1 => 'sensor',
      2 => 'jump gate',
      3 => 'orbit',
      4 => 'assignment',
    ),
    'components' => 
    array (
      0 => 'moon-card',
      1 => 'sensor-meter',
      2 => 'gate-upgrade',
      3 => 'orbit-badge',
    ),
    'responsive' => 'Moon cards stack on mobile',
  ),
  'systems' => 
  array (
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
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/universe/moons.php',
    'features' => 'config/page_features/universe/moons.php',
    'design' => 'config/page_design_specs/universe/moons.php',
    'systems' => 'config/page_systems/universe/moons.php',
    'module' => 'includes/page_modules/universe/moons.php',
  ),
);

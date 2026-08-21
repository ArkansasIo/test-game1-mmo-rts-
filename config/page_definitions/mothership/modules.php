<?php
return array (
  'route' => 'modules',
  'group' => 'mothership',
  'group_label' => 'Mothership',
  'title' => 'Mothership Modules',
  'layout' => 'ship',
  'controls' => 
  array (
    0 => 'Upgrade module',
  ),
  'actions' => 
  array (
    0 => 'mothership_upgrade',
  ),
  'tables' => 
  array (
    0 => 'mothership_modules',
  ),
  'details' => 
  array (
    'hero' => 'Mothership Command',
    'panels' => 
    array (
      0 => 'Hull',
      1 => 'Weapons and shields',
      2 => 'Hangars',
      3 => 'Modules and capacity',
    ),
    'formula' => 'ship readiness = hull + modules + weapons + shields + fleet capacity',
    'controls' => 
    array (
      0 => 'Upgrade hull',
      1 => 'Upgrade hangars',
      2 => 'Upgrade shields',
      3 => 'Upgrade module',
    ),
    'action' => 'mothership_upgrade',
    'tables' => 
    array (
      0 => 'motherships',
      1 => 'mothership_modules',
      2 => 'player_resources',
    ),
    'permission' => 'authenticated mothership owner',
    'states' => 
    array (
      0 => 'ready',
      1 => 'insufficient-resource',
      2 => 'queued',
      3 => 'success',
      4 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Mothership and Modules',
    'purpose' => 'Upgrade the commander’s strategic vessel.',
    'buttons' => 
    array (
      'Upgrade hull' => 
      array (
        'action' => 'mothership_upgrade',
        'logic' => 'Validate module type, cost, prerequisite, and capacity.',
        'permission' => 'mothership owner',
        'reads' => 
        array (
          0 => 'motherships',
          1 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'motherships',
          1 => 'player_resources',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'queued',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'Explore' => 
      array (
        'action' => 'explore',
        'logic' => 'Dispatch mothership exploration to a validated universe target and persist yield, travel, risk, cooldown, resource, and event state atomically.',
        'permission' => 'mothership owner with hull readiness',
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
    'purpose' => 'Command the mothership hull, hangars, shields, weapons, and modules.',
    'workflow' => 
    array (
      0 => 'load mothership',
      1 => 'select upgrade',
      2 => 'validate module prerequisite',
      3 => 'lock resources',
      4 => 'queue or apply upgrade',
    ),
    'validation' => 
    array (
      0 => 'mothership owner',
      1 => 'module prerequisite',
      2 => 'resource balance',
      3 => 'capacity cap',
    ),
    'calculations' => 
    array (
      0 => 'hull + modules + weapons + shields + fleet capacity',
    ),
    'mutations' => 
    array (
      0 => 'motherships',
      1 => 'mothership_modules',
      2 => 'player_resources',
      3 => 'construction_queue',
    ),
  ),
  'features' => 
  array (
    0 => 'hull',
    1 => 'weapons and shields',
    2 => 'hangars',
    3 => 'modules',
    4 => 'capacity',
    5 => 'upgrade queue',
  ),
  'design' => 
  array (
    'template' => 'mothership-command',
    'sections' => 
    array (
      0 => 'hull',
      1 => 'weapons',
      2 => 'hangars',
      3 => 'modules',
    ),
    'components' => 
    array (
      0 => 'ship-stat',
      1 => 'module-card',
      2 => 'capacity-meter',
      3 => 'upgrade-form',
    ),
    'responsive' => 'Ship systems stack into full-width modules',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'MothershipService',
      1 => 'QueueService',
    ),
    'reads' => 
    array (
      0 => 'motherships',
      1 => 'mothership_modules',
      2 => 'player_resources',
      3 => 'construction_queue',
    ),
    'writes' => 
    array (
      0 => 'motherships',
      1 => 'mothership_modules',
      2 => 'player_resources',
      3 => 'construction_queue',
    ),
    'actions' => 
    array (
      0 => 'mothership_upgrade',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/mothership/modules.php',
    'features' => 'config/page_features/mothership/modules.php',
    'design' => 'config/page_design_specs/mothership/modules.php',
    'systems' => 'config/page_systems/mothership/modules.php',
    'module' => 'includes/page_modules/mothership/modules.php',
  ),
);

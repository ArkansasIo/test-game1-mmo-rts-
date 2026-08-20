<?php
return array (
  'route' => 'ship',
  'group' => 'mothership',
  'group_label' => 'Mothership',
  'title' => 'Mothership',
  'layout' => 'ship',
  'controls' => 
  array (
    0 => 'Upgrade hull',
    1 => 'Upgrade hangars',
    2 => 'Upgrade shields',
  ),
  'actions' => 
  array (
    0 => 'mothership_upgrade',
  ),
  'tables' => 
  array (
    0 => 'motherships',
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
        'logic' => 'Dispatch mothership exploration mission.',
        'permission' => 'mothership owner',
        'reads' => 
        array (
          0 => 'motherships',
          1 => 'universe_solar_systems',
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
    'logic' => 'config/page_logic/mothership/ship.php',
    'features' => 'config/page_features/mothership/ship.php',
    'design' => 'config/page_design_specs/mothership/ship.php',
    'systems' => 'config/page_systems/mothership/ship.php',
  ),
);

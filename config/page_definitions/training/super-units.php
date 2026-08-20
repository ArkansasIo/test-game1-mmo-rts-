<?php
return array (
  'route' => 'super-units',
  'group' => 'training',
  'group_label' => 'Training',
  'title' => 'Super Units',
  'layout' => 'training',
  'controls' => 
  array (
    0 => 'Train elite units',
  ),
  'actions' => 
  array (
    0 => 'train',
  ),
  'tables' => 
  array (
    0 => 'player_resources',
    1 => 'technologies',
  ),
  'details' => 
  array (
    'hero' => 'Personnel Training',
    'panels' => 
    array (
      0 => 'Available population',
      1 => 'Training queue',
      2 => 'Unit categories',
      3 => 'Current personnel',
    ),
    'formula' => 'training = population conversion − training cost + production bonus',
    'controls' => 
    array (
      0 => 'Train units',
      1 => 'Choose category',
      2 => 'Set quantity',
    ),
    'action' => 'train',
    'tables' => 
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'technologies',
    ),
    'permission' => 'authenticated commander with untrained population',
    'states' => 
    array (
      0 => 'ready',
      1 => 'insufficient-resource',
      2 => 'cooldown',
      3 => 'success',
      4 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Training',
    'purpose' => 'Convert population into specialized units.',
    'buttons' => 
    array (
      'Train units' => 
      array (
        'action' => 'train',
        'logic' => 'Validate type and quantity, deduct untrained population, and increase unit stats.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_resources',
          1 => 'technologies',
        ),
        'writes' => 
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Upgrade production' => 
      array (
        'action' => 'upgrade_up',
        'logic' => 'Calculate next production cost and increase production cap.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'player_resources',
          1 => 'game_audit_log',
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
    'purpose' => 'Convert available population into specialized personnel and units.',
    'workflow' => 
    array (
      0 => 'load population pool',
      1 => 'select unit category',
      2 => 'validate quantity',
      3 => 'deduct population and cost',
      4 => 'update unit stats',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'untrained population',
      2 => 'positive quantity',
      3 => 'resource balance',
    ),
    'calculations' => 
    array (
      0 => 'population conversion − training cost + production bonus',
    ),
    'mutations' => 
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'game_events',
    ),
  ),
  'features' => 
  array (
    0 => 'unit categories',
    1 => 'quantity input',
    2 => 'training queue',
    3 => 'population conversion',
    4 => 'production upgrade',
  ),
  'design' => 
  array (
    'template' => 'training-board',
    'sections' => 
    array (
      0 => 'unit pool',
      1 => 'training controls',
      2 => 'cost preview',
      3 => 'queue/result',
    ),
    'components' => 
    array (
      0 => 'unit-card',
      1 => 'quantity-input',
      2 => 'cost-preview',
      3 => 'queue-row',
    ),
    'responsive' => 'Training cards stack with full-width controls',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'TrainingService',
      1 => 'GameService',
    ),
    'reads' => 
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'technologies',
    ),
    'writes' => 
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'game_events',
    ),
    'actions' => 
    array (
      0 => 'train',
      1 => 'upgrade_up',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/training/super-units.php',
    'features' => 'config/page_features/training/super-units.php',
    'design' => 'config/page_design_specs/training/super-units.php',
    'systems' => 'config/page_systems/training/super-units.php',
  ),
);

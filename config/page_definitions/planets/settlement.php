<?php
return array (
  'route' => 'settlement',
  'group' => 'planets',
  'group_label' => 'Planets',
  'title' => 'Settlement & Power Grid',
  'layout' => 'settlement',
  'controls' => 
  array (
    0 => 'Queue build',
    1 => 'Demolish',
    2 => 'Process construction',
  ),
  'actions' => 
  array (
    0 => 'settlement_state',
    1 => 'settlement_build',
    2 => 'settlement_demolish',
    3 => 'settlement_process',
  ),
  'tables' => 
  array (
    0 => 'settlement_fields',
    1 => 'settlement_buildings',
    2 => 'settlement_construction_queues',
    3 => 'building_types',
    4 => 'player_resources',
    5 => 'game_events',
  ),
  'details' => 
  array (
  ),
  'interaction' => 
  array (
  ),
  'logic' => 
  array (
    'purpose' => 'Settlement & Power Grid',
    'workflow' => 
    array (
      0 => 'load state',
      1 => 'validate intent',
      2 => 'render result',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
    ),
    'calculations' => 
    array (
    ),
    'mutations' => 
    array (
    ),
  ),
  'features' => 
  array (
    0 => 'Settlement & Power Grid',
  ),
  'design' => 
  array (
    'template' => 'generic-page',
    'sections' => 
    array (
      0 => 'overview',
      1 => 'controls',
      2 => 'activity',
    ),
    'components' => 
    array (
      0 => 'panel',
      1 => 'status-badge',
    ),
    'responsive' => 'stacked mobile layout',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'PageService',
    ),
    'reads' => 
    array (
      0 => 'settlement_fields',
      1 => 'settlement_buildings',
      2 => 'settlement_construction_queues',
      3 => 'building_types',
      4 => 'player_resources',
      5 => 'game_events',
    ),
    'writes' => 
    array (
    ),
    'actions' => 
    array (
      0 => 'settlement_state',
      1 => 'settlement_build',
      2 => 'settlement_demolish',
      3 => 'settlement_process',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/planets/settlement.php',
    'features' => 'config/page_features/planets/settlement.php',
    'design' => 'config/page_design_specs/planets/settlement.php',
    'systems' => 'config/page_systems/planets/settlement.php',
    'module' => 'includes/page_modules/planets/settlement.php',
  ),
);

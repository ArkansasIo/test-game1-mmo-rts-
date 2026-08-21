<?php
return array (
  'route' => 'unit-production',
  'group' => 'training',
  'group_label' => 'Training',
  'title' => 'Unit Production',
  'layout' => 'upgrade',
  'controls' => 
  array (
    0 => 'Upgrade UP',
  ),
  'actions' => 
  array (
    0 => 'upgrade_up',
  ),
  'tables' => 
  array (
    0 => 'unit_types',
    1 => 'player_unit_stats',
    2 => 'training_queues',
    3 => 'player_resources',
    4 => 'game_events',
  ),
  'details' => 
  array (
    'hero' => 'Unit Production',
    'panels' => 
    array (
      0 => 'Current production',
      1 => 'Next-level cost',
      2 => 'Queue status',
      3 => 'Upgrade effects',
    ),
    'formula' => 'upgrade cost = base cost × growth rate ^ current level',
    'controls' => 
    array (
      0 => 'Upgrade production',
      1 => 'Preview next level',
    ),
    'action' => 'upgrade_up',
    'tables' => 
    array (
      0 => 'player_resources',
      1 => 'construction_queue',
      2 => 'technologies',
    ),
    'permission' => 'authenticated commander',
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
    'page' => 'Unit Production',
    'purpose' => 'Upgrade the rate at which personnel and units can be produced.',
    'buttons' => 
    array (
      'Upgrade production' => 
      array (
        'action' => 'upgrade_up',
        'logic' => 'Calculate next-level cost, lock resources, and increase production level.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
        ),
        'writes' => 
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'game_audit_log',
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
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Increase unit production capacity and show next-level effects.',
    'workflow' => 
    array (
      0 => 'load current level',
      1 => 'calculate next cost',
      2 => 'validate resources',
      3 => 'queue upgrade',
      4 => 'apply completion effect',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'positive current level',
      2 => 'resource balance',
      3 => 'level cap',
    ),
    'calculations' => 
    array (
      0 => 'base cost × growth rate ^ current level',
    ),
    'mutations' => 
    array (
      0 => 'player_resources',
      1 => 'construction_queue',
      2 => 'game_audit_log',
    ),
  ),
  'features' => 
  array (
    0 => 'current production',
    1 => 'next-level cost',
    2 => 'queue status',
    3 => 'upgrade effects',
    4 => 'production preview',
  ),
  'design' => 
  array (
    'template' => 'upgrade-card',
    'sections' => 
    array (
      0 => 'current level',
      1 => 'next cost',
      2 => 'modifier preview',
      3 => 'confirmation',
    ),
    'components' => 
    array (
      0 => 'level-card',
      1 => 'cost-table',
      2 => 'effect-preview',
      3 => 'queue-badge',
    ),
    'responsive' => 'Upgrade card becomes full-width',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'TrainingService',
      1 => 'QueueService',
    ),
    'reads' => 
    array (
      0 => 'player_resources',
      1 => 'construction_queue',
      2 => 'technologies',
    ),
    'writes' => 
    array (
      0 => 'player_resources',
      1 => 'construction_queue',
      2 => 'game_audit_log',
    ),
    'actions' => 
    array (
      0 => 'upgrade_up',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/training/unit-production.php',
    'features' => 'config/page_features/training/unit-production.php',
    'design' => 'config/page_design_specs/training/unit-production.php',
    'systems' => 'config/page_systems/training/unit-production.php',
    'module' => 'includes/page_modules/training/unit-production.php',
  ),
);

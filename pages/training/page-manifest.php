<?php
return array (
  'group' => 'training',
  'label' => 'Training',
  'icon' => '◈',
  'parent_route' => 'training',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'units',
      'title' => 'Unit Training',
      'layout' => 'training',
      'definition' => 'config/page_definitions/training/units.php',
      'actions' => 
      array (
        0 => 'train',
        1 => 'upgrade_up',
      ),
      'tables' => 
      array (
        0 => 'unit_types',
        1 => 'player_unit_stats',
        2 => 'training_queues',
        3 => 'player_resources',
        4 => 'game_events',
      ),
    ),
    1 => 
    array (
      'route' => 'miners',
      'title' => 'Miners & Lifers',
      'layout' => 'training',
      'definition' => 'config/page_definitions/training/miners.php',
      'actions' => 
      array (
        0 => 'train',
      ),
      'tables' => 
      array (
        0 => 'player_resources',
      ),
    ),
    2 => 
    array (
      'route' => 'super-units',
      'title' => 'Super Units',
      'layout' => 'training',
      'definition' => 'config/page_definitions/training/super-units.php',
      'actions' => 
      array (
        0 => 'train',
      ),
      'tables' => 
      array (
        0 => 'player_resources',
        1 => 'technologies',
      ),
    ),
    3 => 
    array (
      'route' => 'unit-production',
      'title' => 'Unit Production',
      'layout' => 'upgrade',
      'definition' => 'config/page_definitions/training/unit-production.php',
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
    ),
  ),
);

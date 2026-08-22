<?php
return array (
  'group' => 'premium',
  'label' => 'Premium',
  'icon' => '◆',
  'parent_route' => 'premium',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'store',
      'title' => 'Store',
      'layout' => 'premium',
      'definition' => 'config/page_definitions/premium/store.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    1 => 
    array (
      'route' => 'premium-officers',
      'title' => 'Officers',
      'layout' => 'premium',
      'definition' => 'config/page_definitions/premium/premium-officers.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    2 => 
    array (
      'route' => 'commander',
      'title' => 'Commander',
      'layout' => 'premium',
      'definition' => 'config/page_definitions/premium/commander.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    3 => 
    array (
      'route' => 'premium-services',
      'title' => 'Premium Services',
      'layout' => 'premium',
      'definition' => 'config/page_definitions/premium/premium-services.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
  ),
);

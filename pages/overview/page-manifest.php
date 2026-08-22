<?php
return array (
  'group' => 'overview',
  'label' => 'Overview',
  'icon' => '◆',
  'parent_route' => 'overview',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'overview-dashboard',
      'title' => 'Dashboard',
      'layout' => 'dashboard',
      'definition' => 'config/page_definitions/overview/overview-dashboard.php',
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
      'route' => 'empire-overview',
      'title' => 'Empire Overview',
      'layout' => 'dashboard',
      'definition' => 'config/page_definitions/overview/empire-overview.php',
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
      'route' => 'active-operations',
      'title' => 'Active Operations',
      'layout' => 'dashboard',
      'definition' => 'config/page_definitions/overview/active-operations.php',
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
      'route' => 'alerts',
      'title' => 'Alerts',
      'layout' => 'dashboard',
      'definition' => 'config/page_definitions/overview/alerts.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    4 => 
    array (
      'route' => 'tutorial-objectives',
      'title' => 'Tutorial / Objectives',
      'layout' => 'dashboard',
      'definition' => 'config/page_definitions/overview/tutorial-objectives.php',
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

<?php
return array (
  'group' => 'intelligence',
  'label' => 'Intelligence',
  'icon' => '◎',
  'parent_route' => 'intelligence',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'spy-log',
      'title' => 'Spy Log',
      'layout' => 'reports',
      'definition' => 'config/page_definitions/intelligence/spy-log.php',
      'actions' => 
      array (
        0 => 'message_read',
      ),
      'tables' => 
      array (
        0 => 'covert_missions',
        1 => 'intelligence_reports',
      ),
    ),
    1 => 
    array (
      'route' => 'enemy-intelligence',
      'title' => 'Enemy Intelligence',
      'layout' => 'reports',
      'definition' => 'config/page_definitions/intelligence/enemy-intelligence.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'intelligence_reports',
      ),
    ),
    2 => 
    array (
      'route' => 'intelligence-espionage',
      'title' => 'Espionage',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/intelligence-espionage.php',
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
      'route' => 'spy-missions',
      'title' => 'Spy Missions',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/spy-missions.php',
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
      'route' => 'counter-espionage',
      'title' => 'Counter-Espionage',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/counter-espionage.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    5 => 
    array (
      'route' => 'intelligence-sabotage',
      'title' => 'Sabotage',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/intelligence-sabotage.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    6 => 
    array (
      'route' => 'reconnaissance',
      'title' => 'Reconnaissance',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/reconnaissance.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    7 => 
    array (
      'route' => 'sensor-phalanx',
      'title' => 'Sensor Phalanx',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/sensor-phalanx.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    8 => 
    array (
      'route' => 'fleet-activity',
      'title' => 'Fleet Activity',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/fleet-activity.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    9 => 
    array (
      'route' => 'intelligence-reports',
      'title' => 'Intelligence Reports',
      'layout' => 'combat',
      'definition' => 'config/page_definitions/intelligence/intelligence-reports.php',
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

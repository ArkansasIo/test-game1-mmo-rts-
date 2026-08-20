<?php
return array (
  'group' => 'attack',
  'label' => 'Attack',
  'icon' => '⚔',
  'parent_route' => 'attack',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'targets',
      'title' => 'Target Selection',
      'layout' => 'targets',
      'definition' => 'config/page_definitions/attack/targets.php',
      'actions' => 
      array (
        0 => 'combat',
        1 => 'covert',
        2 => 'explore',
        3 => 'message',
      ),
      'tables' => 
      array (
        0 => 'target_realms',
        1 => 'players',
        2 => 'battles',
      ),
    ),
    1 => 
    array (
      'route' => 'spy',
      'title' => 'Spy Operations',
      'layout' => 'covert',
      'definition' => 'config/page_definitions/attack/spy.php',
      'actions' => 
      array (
        0 => 'covert',
      ),
      'tables' => 
      array (
        0 => 'covert_missions',
        1 => 'spy_missions',
        2 => 'intelligence_reports',
      ),
    ),
    2 => 
    array (
      'route' => 'sabotage',
      'title' => 'Sabotage Operations',
      'layout' => 'covert',
      'definition' => 'config/page_definitions/attack/sabotage.php',
      'actions' => 
      array (
        0 => 'covert',
      ),
      'tables' => 
      array (
        0 => 'covert_missions',
        1 => 'sabotage_missions',
      ),
    ),
    3 => 
    array (
      'route' => 'attack-log',
      'title' => 'Attack Log & Reports',
      'layout' => 'reports',
      'definition' => 'config/page_definitions/attack/attack-log.php',
      'actions' => 
      array (
        0 => 'message_read',
      ),
      'tables' => 
      array (
        0 => 'battles',
        1 => 'battle_reports',
        2 => 'attack_logs',
      ),
    ),
  ),
);

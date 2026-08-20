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
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'intelligence_reports',
      ),
    ),
  ),
);

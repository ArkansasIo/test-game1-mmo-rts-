<?php
return array (
  'group' => 'account',
  'label' => 'Account',
  'icon' => '◌',
  'parent_route' => 'account',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'race',
      'title' => 'Race Selection',
      'layout' => 'account',
      'definition' => 'config/page_definitions/account/race.php',
      'actions' => 
      array (
        0 => 'change_race',
      ),
      'tables' => 
      array (
        0 => 'races',
        1 => 'players',
      ),
    ),
    1 => 
    array (
      'route' => 'vacation',
      'title' => 'Vacation Mode',
      'layout' => 'account',
      'definition' => 'config/page_definitions/account/vacation.php',
      'actions' => 
      array (
        0 => 'vacation',
      ),
      'tables' => 
      array (
        0 => 'vacation_states',
        1 => 'protection_states',
      ),
    ),
    2 => 
    array (
      'route' => 'ascension',
      'title' => 'Ascension',
      'layout' => 'progression',
      'definition' => 'config/page_definitions/account/ascension.php',
      'actions' => 
      array (
        0 => 'ascend',
      ),
      'tables' => 
      array (
        0 => 'ascension_states',
        1 => 'ascensions',
        2 => 'glory_reputation',
      ),
    ),
  ),
);

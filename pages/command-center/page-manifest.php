<?php
return array (
  'group' => 'command-center',
  'label' => 'Command Center',
  'icon' => '⌂',
  'parent_route' => 'dashboard',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'dashboard',
      'title' => 'Command Center',
      'layout' => 'dashboard',
      'actions' => 
      array (
        0 => 'process_turns',
      ),
      'tables' => 
      array (
        0 => 'players',
        1 => 'player_resources',
        2 => 'rankings',
        3 => 'game_events',
      ),
    ),
    1 => 
    array (
      'route' => 'account-info',
      'title' => 'Account Information',
      'layout' => 'details',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'players',
        1 => 'races',
        2 => 'rankings',
        3 => 'glory_reputation',
      ),
    ),
    2 => 
    array (
      'route' => 'resources',
      'title' => 'Resources & Vault',
      'layout' => 'economy',
      'actions' => 
      array (
        0 => 'deposit',
        1 => 'withdraw',
      ),
      'tables' => 
      array (
        0 => 'player_resources',
        1 => 'game_settings',
      ),
    ),
    3 => 
    array (
      'route' => 'income',
      'title' => 'Income Breakdown',
      'layout' => 'breakdown',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'player_resources',
        1 => 'races',
        2 => 'player_planets',
        3 => 'game_settings',
      ),
    ),
    4 => 
    array (
      'route' => 'military-stats',
      'title' => 'Military Statistics',
      'layout' => 'stats',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'player_resources',
        1 => 'player_unit_stats',
        2 => 'rankings',
      ),
    ),
  ),
);

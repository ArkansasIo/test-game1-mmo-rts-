<?php
return array (
  'group' => 'planets',
  'label' => 'Planets',
  'icon' => '○',
  'parent_route' => 'planets',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'planet-list',
      'title' => 'Planet List',
      'layout' => 'planets',
      'definition' => 'config/page_definitions/planets/planet-list.php',
      'actions' => 
      array (
        0 => 'explore',
        1 => 'combat',
        2 => 'colonize_planet',
        3 => 'planet_defense',
      ),
      'tables' => 
      array (
        0 => 'player_colonies',
        1 => 'planet_bonuses',
        2 => 'planet_explorations',
        3 => 'player_resources',
        4 => 'universe_planets',
        5 => 'planet_defenses',
        6 => 'motherships',
        7 => 'player_cooldowns',
        8 => 'game_events',
      ),
    ),
    1 => 
    array (
      'route' => 'settlement',
      'title' => 'Settlement & Power Grid',
      'layout' => 'settlement',
      'definition' => 'config/page_definitions/planets/settlement.php',
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
    ),
    2 => 
    array (
      'route' => 'planet-bonuses',
      'title' => 'Planet Bonuses',
      'layout' => 'planets',
      'definition' => 'config/page_definitions/planets/planet-bonuses.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'planet_bonuses',
      ),
    ),
    3 => 
    array (
      'route' => 'planet-defenses',
      'title' => 'Planet Defenses',
      'layout' => 'planets',
      'definition' => 'config/page_definitions/planets/planet-defenses.php',
      'actions' => 
      array (
        0 => 'planet_defense',
      ),
      'tables' => 
      array (
        0 => 'planet_defenses',
      ),
    ),
  ),
);

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
    2 => 
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

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
      ),
      'tables' => 
      array (
        0 => 'player_planets',
        1 => 'planet_explorations',
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

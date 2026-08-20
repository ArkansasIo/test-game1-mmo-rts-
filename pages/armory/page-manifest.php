<?php
return array (
  'group' => 'armory',
  'label' => 'Armory',
  'icon' => '▣',
  'parent_route' => 'armory',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'weapons',
      'title' => 'Weapon Inventory',
      'layout' => 'inventory',
      'actions' => 
      array (
        0 => 'weapon_buy',
      ),
      'tables' => 
      array (
        0 => 'weapon_types',
        1 => 'player_weapons',
      ),
    ),
    1 => 
    array (
      'route' => 'weapon-market',
      'title' => 'Weapon Market',
      'layout' => 'market',
      'actions' => 
      array (
        0 => 'market_list',
        1 => 'market_buy',
      ),
      'tables' => 
      array (
        0 => 'market_orders',
        1 => 'weapon_types',
      ),
    ),
    2 => 
    array (
      'route' => 'repair',
      'title' => 'Weapon Repair',
      'layout' => 'repair',
      'actions' => 
      array (
        0 => 'weapon_repair',
      ),
      'tables' => 
      array (
        0 => 'player_weapons',
        1 => 'player_resources',
      ),
    ),
  ),
);

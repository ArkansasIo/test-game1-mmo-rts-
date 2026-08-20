<?php
return array (
  'group' => 'market',
  'label' => 'Market',
  'icon' => '¤',
  'parent_route' => 'market',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'resource-exchange',
      'title' => 'Resource Exchange',
      'layout' => 'market',
      'definition' => 'config/page_definitions/market/resource-exchange.php',
      'actions' => 
      array (
        0 => 'market_list',
        1 => 'market_buy',
      ),
      'tables' => 
      array (
        0 => 'market_orders',
        1 => 'player_resources',
      ),
    ),
    1 => 
    array (
      'route' => 'mercenary-market',
      'title' => 'Mercenary Market',
      'layout' => 'market',
      'definition' => 'config/page_definitions/market/mercenary-market.php',
      'actions' => 
      array (
        0 => 'mercenary_buy',
      ),
      'tables' => 
      array (
        0 => 'mercenary_types',
        1 => 'player_mercenaries',
      ),
    ),
  ),
);

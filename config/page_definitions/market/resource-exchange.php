<?php
return array (
  'route' => 'resource-exchange',
  'group' => 'market',
  'group_label' => 'Market',
  'title' => 'Resource Exchange',
  'layout' => 'market',
  'controls' => 
  array (
    0 => 'List order',
    1 => 'Buy order',
  ),
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
  'details' => 
  array (
    'hero' => 'Market Exchange',
    'panels' => 
    array (
      0 => 'Open orders',
      1 => 'Price history',
      2 => 'Order form',
      3 => 'Settlement status',
    ),
    'formula' => 'settlement = quantity × unit price + market fee',
    'controls' => 
    array (
      0 => 'List order',
      1 => 'Buy order',
      2 => 'Cancel order',
    ),
    'action' => 'market_list',
    'tables' => 
    array (
      0 => 'market_orders',
      1 => 'trade_contracts',
      2 => 'player_resources',
      3 => 'mercenary_types',
    ),
    'permission' => 'authenticated commander with market turns',
    'states' => 
    array (
      0 => 'ready',
      1 => 'empty',
      2 => 'insufficient-resource',
      3 => 'cooldown',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Markets',
    'purpose' => 'Trade resources, weapons, and mercenaries.',
    'buttons' => 
    array (
      'List order' => 
      array (
        'action' => 'market_list',
        'logic' => 'Validate resource, quantity, unit price, turn balance, and expiry.',
        'permission' => 'authenticated trader',
        'reads' => 
        array (
          0 => 'player_resources',
          1 => 'market_orders',
        ),
        'writes' => 
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'cooldown',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'Buy order' => 
      array (
        'action' => 'market_buy',
        'logic' => 'Lock order, check funds, transfer resource, and settle seller.',
        'permission' => 'authenticated trader',
        'reads' => 
        array (
          0 => 'market_orders',
          1 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'market_orders',
          1 => 'player_resources',
          2 => 'game_audit_log',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'success',
          3 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'List and buy resource, weapon, and mercenary market orders.',
    'workflow' => 
    array (
      0 => 'load orders',
      1 => 'validate order fields',
      2 => 'lock balance or order',
      3 => 'settle trade',
      4 => 'write market event',
    ),
    'validation' => 
    array (
      0 => 'authenticated trader',
      1 => 'market turns',
      2 => 'positive quantity',
      3 => 'available balance',
      4 => 'order ownership',
    ),
    'calculations' => 
    array (
      0 => 'quantity × unit price + market fee',
    ),
    'mutations' => 
    array (
      0 => 'market_orders',
      1 => 'trade_contracts',
      2 => 'player_resources',
      3 => 'game_audit_log',
    ),
  ),
  'features' => 
  array (
    0 => 'open orders',
    1 => 'price history',
    2 => 'order form',
    3 => 'buy order',
    4 => 'list order',
    5 => 'settlement status',
  ),
  'design' => 
  array (
    'template' => 'market-exchange',
    'sections' => 
    array (
      0 => 'orders',
      1 => 'price history',
      2 => 'order form',
      3 => 'settlement',
    ),
    'components' => 
    array (
      0 => 'order-table',
      1 => 'price-badge',
      2 => 'order-form',
      3 => 'settlement-banner',
    ),
    'responsive' => 'Market tables scroll or stack into order cards',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'MarketService',
    ),
    'reads' => 
    array (
      0 => 'market_orders',
      1 => 'trade_contracts',
      2 => 'player_resources',
      3 => 'mercenary_types',
    ),
    'writes' => 
    array (
      0 => 'market_orders',
      1 => 'trade_contracts',
      2 => 'player_resources',
      3 => 'game_audit_log',
    ),
    'actions' => 
    array (
      0 => 'market_list',
      1 => 'market_buy',
      2 => 'market_cancel',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/market/resource-exchange.php',
    'features' => 'config/page_features/market/resource-exchange.php',
    'design' => 'config/page_design_specs/market/resource-exchange.php',
    'systems' => 'config/page_systems/market/resource-exchange.php',
    'module' => 'includes/page_modules/market/resource-exchange.php',
  ),
);

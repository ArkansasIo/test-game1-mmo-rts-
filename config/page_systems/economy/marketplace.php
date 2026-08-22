<?php
return array (
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
);

<?php
return array (
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
);

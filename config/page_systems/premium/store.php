<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'PageService',
  ),
  'reads' => 
  array (
    0 => 'premium_catalog',
    1 => 'player_premium',
    2 => 'premium_transactions',
    3 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'premium_catalog',
    1 => 'player_premium',
    2 => 'premium_transactions',
    3 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'premium_purchase',
    1 => 'premium_claim',
    2 => 'premium_activate',
    3 => 'refresh_page',
  ),
  'permissions' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF',
    2 => 'RBAC',
    3 => 'ownership scope',
    4 => 'cooldown validation',
  ),
);

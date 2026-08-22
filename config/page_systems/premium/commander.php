<?php
return array (
  'services' => array (
    0 => 'PremiumService',
  ),
  'reads' => array (
    0 => 'player_premium',
    1 => 'premium_transactions',
    2 => 'game_events',
  ),
  'writes' => array (
    0 => 'player_premium',
    1 => 'premium_transactions',
    2 => 'game_events',
  ),
  'actions' => array (
    0 => 'premium_claim_daily',
    1 => 'premium_activate',
  ),
  'feedback_states' => array (
    0 => 'ready',
    1 => 'empty',
    2 => 'cooldown',
    3 => 'insufficient-resource',
    4 => 'success',
    5 => 'error',
  ),
  'security' => array (
    0 => 'authentication',
    1 => 'CSRF',
    2 => 'server-side price lookup',
    3 => 'transaction row locks',
    4 => 'ownership and cooldown validation',
  ),
);

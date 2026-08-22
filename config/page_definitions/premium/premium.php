<?php
return array (
  'route' => 'premium',
  'group' => 'premium',
  'group_label' => 'Premium',
  'title' => 'Premium Hub',
  'layout' => 'dashboard',
  'controls' => array (
    0 => 'Open Store',
    1 => 'Claim daily premium',
    2 => 'Review transaction history',
  ),
  'actions' => array (
    0 => 'premium_purchase',
    1 => 'premium_claim_daily',
    2 => 'premium_activate',
  ),
  'tables' => array (
    0 => 'premium_catalog',
    1 => 'player_premium',
    2 => 'premium_transactions',
    3 => 'game_events',
  ),
  'details' => array (
    0 => 'wallet summary',
    1 => 'season pass progression',
    2 => 'officer status',
    3 => 'service credits',
  ),
  'interaction' => array (
    'server_authoritative' => true,
    'feedback_states' => array (
      0 => 'ready',
      1 => 'empty',
      2 => 'cooldown',
      3 => 'insufficient-resource',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'logic' => array (
    'purpose' => 'Premium command center for wallet, passes, officers, and services.',
    'workflow' => array (
      0 => 'load wallet and catalogue',
      1 => 'validate authentication, CSRF, ownership, price, quantity, and cooldown',
      2 => 'lock wallet rows and commit transaction',
      3 => 'render updated state and feedback',
    ),
    'validation' => array (
      0 => 'authenticated commander',
      1 => 'server-side catalogue item',
      2 => 'wallet row lock',
      3 => 'positive bounded quantity',
      4 => 'cooldown and ownership checks',
    ),
    'calculations' => array (
      0 => 'purchase cost = catalogue price × quantity',
      1 => 'season progression = claimed rewards + validated activity',
      2 => 'service effect = catalogue effect × active duration',
    ),
    'mutations' => array (
      0 => 'premium wallet debit or reward credit',
      1 => 'officer/service activation',
      2 => 'transaction audit event',
    ),
  ),
  'features' => array (
    0 => 'wallet telemetry',
    1 => 'server-validated controls',
    2 => 'transaction history',
    3 => 'feedback states',
  ),
);

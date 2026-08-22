<?php
return array (
  'route' => 'commander',
  'group' => 'premium',
  'group_label' => 'Premium',
  'title' => 'Commander',
  'layout' => 'dashboard',
  'controls' => array (
    0 => 'Claim daily reward',
    1 => 'Activate season pass',
    2 => 'Refresh profile',
  ),
  'actions' => array (
    0 => 'premium_claim_daily',
    1 => 'premium_activate',
  ),
  'tables' => array (
    0 => 'player_premium',
    1 => 'premium_transactions',
    2 => 'game_events',
  ),
  'details' => array (
    0 => 'daily claim cooldown',
    1 => 'season pass state',
    2 => 'season points',
    3 => 'wallet balance',
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
    'purpose' => 'Manage the commander premium profile, daily claim, and season pass progression.',
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
  'contract_files' => array (
    'logic' => 'config/page_logic/premium/commander.php',
    'features' => 'config/page_features/premium/commander.php',
    'design' => 'config/page_design_specs/premium/commander.php',
    'systems' => 'config/page_systems/premium/commander.php',
    'module' => 'includes/page_modules/premium/commander.php',
  ),
  'features' => array (
    0 => 'wallet telemetry',
    1 => 'server-validated controls',
    2 => 'transaction history',
    3 => 'feedback states',
  ),
);

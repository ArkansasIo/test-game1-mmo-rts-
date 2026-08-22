<?php
return array (
  'route' => 'premium-services',
  'group' => 'premium',
  'group_label' => 'Premium',
  'title' => 'Premium Services',
  'layout' => 'dashboard',
  'controls' => array (
    0 => 'Activate service',
    1 => 'Inspect service credits',
    2 => 'Refresh services',
  ),
  'actions' => array (
    0 => 'premium_activate',
  ),
  'tables' => array (
    0 => 'premium_catalog',
    1 => 'player_premium',
    2 => 'premium_transactions',
  ),
  'details' => array (
    0 => 'service catalogue',
    1 => 'credit balances',
    2 => 'cooldown state',
    3 => 'audit history',
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
    'purpose' => 'Consume bounded convenience services such as queue priority and colony scan credits.',
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
    'logic' => 'config/page_logic/premium/premium-services.php',
    'features' => 'config/page_features/premium/premium-services.php',
    'design' => 'config/page_design_specs/premium/premium-services.php',
    'systems' => 'config/page_systems/premium/premium-services.php',
    'module' => 'includes/page_modules/premium/premium-services.php',
  ),
  'features' => array (
    0 => 'wallet telemetry',
    1 => 'server-validated controls',
    2 => 'transaction history',
    3 => 'feedback states',
  ),
);

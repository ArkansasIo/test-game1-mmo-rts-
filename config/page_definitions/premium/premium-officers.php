<?php
return array (
  'route' => 'premium-officers',
  'group' => 'premium',
  'group_label' => 'Premium',
  'title' => 'Officers',
  'layout' => 'dashboard',
  'controls' => array (
    0 => 'Activate officer',
    1 => 'Inspect effects',
    2 => 'Refresh officer status',
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
    0 => 'officer roster',
    1 => 'effect modifiers',
    2 => 'expiry state',
    3 => 'activation history',
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
    'purpose' => 'Activate time-limited officers with transparent modifiers and expiry tracking.',
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
    'logic' => 'config/page_logic/premium/premium-officers.php',
    'features' => 'config/page_features/premium/premium-officers.php',
    'design' => 'config/page_design_specs/premium/premium-officers.php',
    'systems' => 'config/page_systems/premium/premium-officers.php',
    'module' => 'includes/page_modules/premium/premium-officers.php',
  ),
  'features' => array (
    0 => 'wallet telemetry',
    1 => 'server-validated controls',
    2 => 'transaction history',
    3 => 'feedback states',
  ),
);

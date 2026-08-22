<?php
return array (
  'route' => 'planets',
  'group' => 'empire',
  'group_label' => 'Empire',
  'title' => 'Planets',
  'layout' => 'economy',
  'controls' => 
  array (
    0 => 'Open overview',
    1 => 'Review status',
  ),
  'actions' => 
  array (
  ),
  'tables' => 
  array (
    0 => 'game_events',
  ),
  'details' => 
  array (
  ),
  'interaction' => 
  array (
    'page' => 'Resources and Vault',
    'purpose' => 'Manage five strategic resources, protected reserves, production, upkeep, and Dark Matter.',
    'buttons' => 
    array (
      'Deposit' => 
      array (
        'action' => 'deposit',
        'logic' => 'Validate amount and move available Naquadah into the protected vault.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'player_resources',
          1 => 'game_audit_log',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Withdraw' => 
      array (
        'action' => 'withdraw',
        'logic' => 'Validate vault balance and move Naquadah into the available balance.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'player_resources',
          1 => 'game_audit_log',
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
    'purpose' => 'Manage the eight-resource ledger and protected Naquadah vault.',
    'workflow' => 
    array (
      0 => 'load resource ledger',
      1 => 'validate transfer amount',
      2 => 'lock resource row',
      3 => 'move balance transactionally',
      4 => 'write audit event',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF token',
      2 => 'positive amount',
      3 => 'available or vault balance',
      4 => 'RBAC permission',
    ),
    'calculations' => 
    array (
      0 => 'available Naquadah',
      1 => 'protected vault balance',
      2 => 'eight-resource totals',
      3 => 'transfer delta',
    ),
    'mutations' => 
    array (
      0 => 'player_resources',
      1 => 'game_audit_log',
    ),
  ),
  'features' => 
  array (
    0 => 'eight-resource ledger',
    1 => 'Naquadah vault',
    2 => 'deposit',
    3 => 'withdraw',
    4 => 'balance validation',
    5 => 'transaction feedback',
  ),
  'design' => 
  array (
    'template' => 'resource-vault',
    'sections' => 
    array (
      0 => 'balance cards',
      1 => 'resource ledger',
      2 => 'transfer controls',
      3 => 'server contract',
      4 => 'feedback states',
    ),
    'components' => 
    array (
      0 => 'resource-card',
      1 => 'transfer-form',
      2 => 'balance-row',
      3 => 'validation-banner',
    ),
    'responsive' => 'Resource cards flow from four columns to one column',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'GameService',
      1 => 'EconomyService',
    ),
    'reads' => 
    array (
      0 => 'player_resources',
      1 => 'game_settings',
    ),
    'writes' => 
    array (
      0 => 'player_resources',
      1 => 'game_audit_log',
    ),
    'actions' => 
    array (
      0 => 'deposit',
      1 => 'withdraw',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/empire/planets.php',
    'features' => 'config/page_features/empire/planets.php',
    'design' => 'config/page_design_specs/empire/planets.php',
    'systems' => 'config/page_systems/empire/planets.php',
    'module' => 'includes/page_modules/empire/planets.php',
  ),
);

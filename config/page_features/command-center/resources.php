<?php
return array (
  'page_title' => 'Resources & Vault',
  0 => 'eight-resource ledger',
  1 => 'Naquadah vault',
  2 => 'deposit',
  3 => 'withdraw',
  4 => 'balance validation',
  5 => 'transaction feedback',
  'feature_matrix' =>
  array (
    'core' =>
    array (
      0 => 'state snapshot',
      1 => 'permission-aware rendering',
      2 => 'feedback-state rendering',
    ),
    'controls' =>
    array (
      0 => 'Deposit',
      1 => 'Withdraw',
    ),
    'actions' =>
    array (
      0 => 'deposit',
      1 => 'withdraw',
    ),
    'data_sources' =>
    array (
      0 => 'player_resources',
      1 => 'game_settings',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'validate_vault_balance',
    1 => 'calculate_net_settlement',
    2 => 'apply_resource_transfer',
    3 => 'write_economy_event',
  ),
  'acceptance_criteria' =>
  array (
    0 => 'unauthorized input rejected',
    1 => 'negative quantities rejected',
    2 => 'empty state handled',
    3 => 'success refreshes state',
    4 => 'database mutation is transactional',
  ),
);

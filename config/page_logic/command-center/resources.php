<?php
return array (
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
  'page_title' => 'Resources & Vault',
  'layout_family' => 'economy',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_deposit',
    7 => 'handle_withdraw',
  ),
  'sub_functions' =>
  array (
    0 => 'validate_vault_balance',
    1 => 'calculate_net_settlement',
    2 => 'apply_resource_transfer',
    3 => 'write_economy_event',
  ),
  'state_transitions' =>
  array (
    'loading' => 'load scoped state and render skeleton',
    'ready' => 'display authoritative state and enable permitted controls',
    'empty' => 'display an explicit no-records state without fabricating data',
    'submitting' => 'disable duplicate submission and show progress',
    'success' => 'refresh live state, append event, and announce result',
    'protected' => 'explain protection or ownership restriction without leaking data',
    'cooldown' => 'display remaining server cooldown and disable action',
    'insufficient-resource' => 'display missing resources and preserve state',
    'error' => 'display safe error feedback and retain navigation context',
  ),
  'server_authority' =>
  array (
    'client_submits_intent_only' => true,
    'server_recalculates_costs' => true,
    'server_validates_ownership' => true,
    'server_commits_transaction' => true,
  ),
  'data_flow' =>
  array (
    'reads' =>
    array (
      0 => 'player_resources',
      1 => 'game_settings',
    ),
    'writes' =>
    array (
      0 => 'player_resources',
      1 => 'game_settings',
    ),
    'actions' =>
    array (
      0 => 'deposit',
      1 => 'withdraw',
    ),
    'event_sink' => 'game_events',
  ),
);

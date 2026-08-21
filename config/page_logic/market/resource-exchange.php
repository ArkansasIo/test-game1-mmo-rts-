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
  'page_title' => 'Resource Exchange',
  'layout_family' => 'market',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_market_list',
    7 => 'handle_market_buy',
  ),
  'sub_functions' =>
  array (
    0 => 'load_page_state',
    1 => 'validate_page_scope',
    2 => 'calculate_page_metrics',
    3 => 'render_page_result',
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
      0 => 'market_orders',
      1 => 'player_resources',
    ),
    'writes' =>
    array (
      0 => 'market_orders',
      1 => 'player_resources',
    ),
    'actions' =>
    array (
      0 => 'market_list',
      1 => 'market_buy',
    ),
    'event_sink' => 'game_events',
  ),
);

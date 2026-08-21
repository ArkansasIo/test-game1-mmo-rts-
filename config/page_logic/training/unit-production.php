<?php
return array (
  'purpose' => 'Increase unit production capacity and show next-level effects.',
  'workflow' =>
  array (
    0 => 'load current level',
    1 => 'calculate next cost',
    2 => 'validate resources',
    3 => 'queue upgrade',
    4 => 'apply completion effect',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'positive current level',
    2 => 'resource balance',
    3 => 'level cap',
  ),
  'calculations' =>
  array (
    0 => 'base cost × growth rate ^ current level',
  ),
  'mutations' =>
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'game_audit_log',
  ),
  'page_title' => 'Unit Production',
  'layout_family' => 'upgrade',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_upgrade_up',
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
      0 => 'unit_types',
      1 => 'player_unit_stats',
      2 => 'training_queues',
      3 => 'player_resources',
      4 => 'game_events',
    ),
    'writes' =>
    array (
      0 => 'unit_types',
      1 => 'player_unit_stats',
      2 => 'training_queues',
      3 => 'player_resources',
      4 => 'game_events',
    ),
    'actions' =>
    array (
      0 => 'upgrade_up',
    ),
    'event_sink' => 'game_events',
  ),
);

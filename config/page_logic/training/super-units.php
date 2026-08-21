<?php
return array (
  'purpose' => 'Convert available population into specialized personnel and units.',
  'workflow' =>
  array (
    0 => 'load population pool',
    1 => 'select unit category',
    2 => 'validate quantity',
    3 => 'deduct population and cost',
    4 => 'update unit stats',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'untrained population',
    2 => 'positive quantity',
    3 => 'resource balance',
  ),
  'calculations' =>
  array (
    0 => 'population conversion − training cost + production bonus',
  ),
  'mutations' =>
  array (
    0 => 'player_resources',
    1 => 'player_unit_stats',
    2 => 'game_events',
  ),
  'page_title' => 'Super Units',
  'layout_family' => 'training',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_train',
  ),
  'sub_functions' =>
  array (
    0 => 'load_queue_capacity',
    1 => 'validate_population',
    2 => 'calculate_training_cost',
    3 => 'enqueue_training',
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
      1 => 'technologies',
    ),
    'writes' =>
    array (
      0 => 'player_resources',
      1 => 'technologies',
    ),
    'actions' =>
    array (
      0 => 'train',
    ),
    'event_sink' => 'game_events',
  ),
);

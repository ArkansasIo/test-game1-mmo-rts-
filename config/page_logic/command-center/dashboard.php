<?php
return array (
  'purpose' => 'Coordinate colony, economy, queues, fleets, alerts, and turn settlement.',
  'workflow' =>
  array (
    0 => 'load authoritative state',
    1 => 'validate commander intent',
    2 => 'settle bounded turn window',
    3 => 'return refreshed state',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'CSRF token',
    2 => 'RBAC permission',
    3 => 'transaction boundary',
  ),
  'calculations' =>
  array (
    0 => 'resource settlement',
    1 => 'food and water upkeep',
    2 => 'queue completion',
    3 => 'fleet ETA',
  ),
  'mutations' =>
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'fleet_missions',
    3 => 'game_events',
    4 => 'rankings',
  ),
  'page_title' => 'Command Center',
  'layout_family' => 'dashboard',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_process_turns',
  ),
  'sub_functions' =>
  array (
    0 => 'refresh_state',
    1 => 'settle_turns',
    2 => 'aggregate_resource_delta',
    3 => 'render_event_feed',
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
      0 => 'players',
      1 => 'player_resources',
      2 => 'rankings',
      3 => 'game_events',
    ),
    'writes' =>
    array (
      0 => 'players',
      1 => 'player_resources',
      2 => 'rankings',
      3 => 'game_events',
    ),
    'actions' =>
    array (
      0 => 'process_turns',
    ),
    'event_sink' => 'game_events',
  ),
);

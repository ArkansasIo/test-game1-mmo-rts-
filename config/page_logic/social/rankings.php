<?php
return array (
  'purpose' => 'Compare economy, military, covert, progression, and colony scores.',
  'workflow' =>
  array (
    0 => 'load ranking snapshot',
    1 => 'calculate or refresh scores',
    2 => 'filter leaderboard',
    3 => 'open public profile',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'public profile field policy',
  ),
  'calculations' =>
  array (
    0 => 'weighted economy + military + covert + progression + colony value',
  ),
  'mutations' =>
  array (
    0 => 'rankings',
    1 => 'rank_snapshots',
  ),
  'page_title' => 'Rankings',
  'layout_family' => 'rankings',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_refresh_rankings',
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
      0 => 'rankings',
      1 => 'rank_snapshots',
    ),
    'writes' =>
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
    ),
    'actions' =>
    array (
      0 => 'refresh_rankings',
    ),
    'event_sink' => 'game_events',
  ),
);

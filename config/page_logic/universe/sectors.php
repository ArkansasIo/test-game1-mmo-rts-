<?php
return array (
  'purpose' => 'Inspect sector class, danger, resource modifiers, and anomaly rate.',
  'workflow' =>
  array (
    0 => 'select sector',
    1 => 'load systems',
    2 => 'calculate sector output',
    3 => 'filter by risk',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'valid sector identifier',
  ),
  'calculations' =>
  array (
    0 => 'base output × resource modifier; anomaly rate drives events',
  ),
  'mutations' =>
  array (
  ),
  'page_title' => 'Sector Map',
  'layout_family' => 'sectors',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_universe_sectors',
  ),
  'sub_functions' =>
  array (
    0 => 'load_sector',
    1 => 'calculate_scan_power',
    2 => 'order_systems_by_strategy',
    3 => 'classify_owner_signals',
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
      0 => 'universe_sectors',
      1 => 'universe_solar_systems',
      2 => 'universe_planets',
      3 => 'motherships',
      4 => 'mothership_modules',
      5 => 'player_technologies',
      6 => 'player_cooldowns',
      7 => 'game_events',
    ),
    'writes' =>
    array (
      0 => 'universe_sectors',
      1 => 'universe_solar_systems',
      2 => 'universe_planets',
      3 => 'motherships',
      4 => 'mothership_modules',
      5 => 'player_technologies',
      6 => 'player_cooldowns',
      7 => 'game_events',
    ),
    'actions' =>
    array (
      0 => 'universe_sectors',
    ),
    'event_sink' => 'game_events',
  ),
);

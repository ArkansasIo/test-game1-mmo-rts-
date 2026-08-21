<?php
return array (
  'purpose' => 'Browse star class, orbit map, planet slots, and anomalies.',
  'workflow' =>
  array (
    0 => 'open system',
    1 => 'load orbit map',
    2 => 'scan anomaly',
    3 => 'calculate travel',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'valid system identifier',
    2 => 'exploration capacity',
  ),
  'calculations' =>
  array (
    0 => 'base travel × system modifier × sector danger',
  ),
  'mutations' =>
  array (
    0 => 'universe_discoveries',
    1 => 'game_events',
  ),
  'page_title' => 'Solar Systems',
  'layout_family' => 'solar-systems',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_system_map',
    7 => 'handle_explore',
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
      0 => 'universe_solar_systems',
      1 => 'universe_planets',
    ),
    'writes' =>
    array (
      0 => 'universe_solar_systems',
      1 => 'universe_planets',
    ),
    'actions' =>
    array (
      0 => 'system_map',
      1 => 'explore',
    ),
    'event_sink' => 'game_events',
  ),
);

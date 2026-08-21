<?php
return array (
  'purpose' => 'Browse galaxy density, sector overview, and travel risk.',
  'workflow' =>
  array (
    0 => 'select galaxy',
    1 => 'load sectors',
    2 => 'calculate density and risk',
    3 => 'open sector',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'valid galaxy identifier',
  ),
  'calculations' =>
  array (
    0 => 'sector danger × system volatility × distance modifier',
  ),
  'mutations' =>
  array (
  ),
  'page_title' => 'Galaxy Map',
  'layout_family' => 'galaxies',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_universe_galaxies',
  ),
  'sub_functions' =>
  array (
    0 => 'load_active_galaxies',
    1 => 'apply_coordinate_scope',
    2 => 'filter_discovered_sectors',
    3 => 'summarize_ownership',
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
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'target_realms',
      6 => 'game_events',
    ),
    'writes' =>
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'target_realms',
      6 => 'game_events',
    ),
    'actions' =>
    array (
      0 => 'universe_galaxies',
    ),
    'event_sink' => 'game_events',
  ),
);

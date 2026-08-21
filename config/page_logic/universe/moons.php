<?php
return array (
  'purpose' => 'Inspect moon class, sensor bonus, jump gate, and orbit relationship.',
  'workflow' =>
  array (
    0 => 'inspect moon',
    1 => 'load parent planet',
    2 => 'calculate utility',
    3 => 'validate jump-gate upgrade',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'moon access',
    2 => 'colony or mothership ownership',
  ),
  'calculations' =>
  array (
    0 => 'sensor bonus + jump-gate level + moon resource modifiers',
  ),
  'mutations' =>
  array (
    0 => 'universe_moons',
    1 => 'mothership_modules',
    2 => 'player_colonies',
  ),
  'page_title' => 'Moon Registry',
  'layout_family' => 'moons',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_moon_details',
    7 => 'handle_mothership_upgrade',
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
      0 => 'universe_moons',
      1 => 'universe_planets',
    ),
    'writes' =>
    array (
      0 => 'universe_moons',
      1 => 'universe_planets',
    ),
    'actions' =>
    array (
      0 => 'moon_details',
      1 => 'mothership_upgrade',
    ),
    'event_sink' => 'game_events',
  ),
);

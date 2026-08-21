<?php
return array (
  'purpose' => 'Explore systems, planets, moons, anomalies, and discovery rewards.',
  'workflow' =>
  array (
    0 => 'load sensor range',
    1 => 'validate mission capacity',
    2 => 'calculate travel risk',
    3 => 'resolve anomaly',
    4 => 'record discovery',
  ),
  'validation' =>
  array (
    0 => 'exploration-capable commander',
    1 => 'mothership readiness',
    2 => 'cooldown',
    3 => 'target visibility',
  ),
  'calculations' =>
  array (
    0 => 'exploration level + sensor bonus + anomaly rate − travel risk',
  ),
  'mutations' =>
  array (
    0 => 'universe_discoveries',
    1 => 'game_events',
  ),
  'page_title' => 'Exploration',
  'layout_family' => 'exploration',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_explore',
  ),
  'sub_functions' =>
  array (
    0 => 'validate_expedition_readiness',
    1 => 'calculate_travel_time',
    2 => 'resolve_anomaly',
    3 => 'persist_discovery_reward',
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
      0 => 'motherships',
      1 => 'planet_explorations',
    ),
    'writes' =>
    array (
      0 => 'motherships',
      1 => 'planet_explorations',
    ),
    'actions' =>
    array (
      0 => 'explore',
    ),
    'event_sink' => 'game_events',
  ),
);

<?php
return array (
  'purpose' => 'Run reconnaissance, spy, and sabotage missions using agents and covert technology.',
  'workflow' =>
  array (
    0 => 'load agent pools',
    1 => 'select mission type',
    2 => 'calculate detection',
    3 => 'resolve intelligence or damage',
    4 => 'store report and cooldown',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'available agents',
    2 => 'target visibility',
    3 => 'cooldown',
    4 => 'mission cost',
  ),
  'calculations' =>
  array (
    0 => 'defender counter-intelligence − attacker agents − covert technology',
    1 => 'detection chance',
    2 => 'bounded sabotage damage',
  ),
  'mutations' =>
  array (
    0 => 'covert_missions',
    1 => 'spy_missions',
    2 => 'sabotage_missions',
    3 => 'intelligence_reports',
    4 => 'game_events',
  ),
  'page_title' => 'Sabotage Operations',
  'layout_family' => 'covert',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_covert',
  ),
  'sub_functions' =>
  array (
    0 => 'load_agent_pool',
    1 => 'calculate_detection',
    2 => 'resolve_mission',
    3 => 'persist_classified_report',
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
      0 => 'covert_missions',
      1 => 'sabotage_missions',
    ),
    'writes' =>
    array (
      0 => 'covert_missions',
      1 => 'sabotage_missions',
    ),
    'actions' =>
    array (
      0 => 'covert',
    ),
    'event_sink' => 'game_events',
  ),
);

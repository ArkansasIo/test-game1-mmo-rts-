<?php
return array (
  'purpose' => 'Select targets and preview combat, raid, covert, sabotage, and conquest operations.',
  'workflow' =>
  array (
    0 => 'load visible realms',
    1 => 'verify protection',
    2 => 'calculate operation cost',
    3 => 'compare forces',
    4 => 'submit chosen operation',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'attack turns',
    2 => 'target ownership scope',
    3 => 'protection rules',
    4 => 'fleet or unit availability',
  ),
  'calculations' =>
  array (
    0 => 'validated force comparison + technology + defense + deterministic resolver',
    1 => 'operation cost',
    2 => 'loot preview',
  ),
  'mutations' =>
  array (
    0 => 'battles',
    1 => 'battle_rounds',
    2 => 'battle_reports',
    3 => 'attack_logs',
    4 => 'player_resources',
  ),
  'page_title' => 'Target Selection',
  'layout_family' => 'targets',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_combat',
    7 => 'handle_covert',
    8 => 'handle_explore',
    9 => 'handle_message',
  ),
  'sub_functions' =>
  array (
    0 => 'load_target_board',
    1 => 'calculate_combat_preview',
    2 => 'check_protection',
    3 => 'resolve_deterministic_battle',
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
      0 => 'target_realms',
      1 => 'players',
      2 => 'battles',
    ),
    'writes' =>
    array (
      0 => 'target_realms',
      1 => 'players',
      2 => 'battles',
    ),
    'actions' =>
    array (
      0 => 'combat',
      1 => 'covert',
      2 => 'explore',
      3 => 'message',
    ),
    'event_sink' => 'game_events',
  ),
);

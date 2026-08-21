<?php
return array (
  'purpose' => 'Aggregate military, defense, covert, anti-covert, readiness, and DefCon values.',
  'workflow' =>
  array (
    0 => 'load units and weapons',
    1 => 'load technology and faction modifiers',
    2 => 'calculate power totals',
    3 => 'read protection and DefCon',
    4 => 'render readiness',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'valid DefCon level for mutation',
  ),
  'calculations' =>
  array (
    0 => 'units × base power × technology × race × government × planet bonus',
    1 => 'readiness score',
    2 => 'DefCon effect',
  ),
  'mutations' =>
  array (
    0 => 'players',
    1 => 'game_audit_log',
  ),
  'page_title' => 'Military Statistics',
  'layout_family' => 'stats',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
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
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'rankings',
    ),
    'writes' =>
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'rankings',
    ),
    'actions' =>
    array (
    ),
    'event_sink' => 'game_events',
  ),
);

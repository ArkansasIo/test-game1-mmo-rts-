<?php
return array (
  'purpose' => 'Track universal tier and level progression, Glory, Reputation, and ascension.',
  'workflow' =>
  array (
    0 => 'load progression state',
    1 => 'check thresholds',
    2 => 'calculate cost or eligibility',
    3 => 'advance or ascend transactionally',
    4 => 'write history',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'experience threshold',
    2 => 'tier and level cap',
    3 => 'resource or Glory cost',
  ),
  'calculations' =>
  array (
    0 => 'experience thresholds',
    1 => '21 tiers × 23 levels',
    2 => 'ascension eligibility',
  ),
  'mutations' =>
  array (
    0 => 'player_progression',
    1 => 'glory_reputation',
    2 => 'ascension_states',
    3 => 'ascensions',
    4 => 'game_audit_log',
  ),
  'page_title' => 'Ascension',
  'layout_family' => 'progression',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_ascend',
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
      0 => 'ascension_states',
      1 => 'ascensions',
      2 => 'glory_reputation',
    ),
    'writes' =>
    array (
      0 => 'ascension_states',
      1 => 'ascensions',
      2 => 'glory_reputation',
    ),
    'actions' =>
    array (
      0 => 'ascend',
    ),
    'event_sink' => 'game_events',
  ),
);

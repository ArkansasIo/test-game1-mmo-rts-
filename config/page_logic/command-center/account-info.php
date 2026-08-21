<?php
return array (
  'purpose' => 'Read commander identity, faction, rank, protection, and progression.',
  'workflow' =>
  array (
    0 => 'load commander',
    1 => 'load faction and government',
    2 => 'load rank and progression',
    3 => 'render read-only profile',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'ownership scope',
  ),
  'calculations' =>
  array (
    0 => 'combined faction modifier',
    1 => 'rank score',
  ),
  'mutations' =>
  array (
  ),
  'page_title' => 'Account Information',
  'layout_family' => 'details',
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
      0 => 'players',
      1 => 'races',
      2 => 'rankings',
      3 => 'glory_reputation',
    ),
    'writes' =>
    array (
      0 => 'players',
      1 => 'races',
      2 => 'rankings',
      3 => 'glory_reputation',
    ),
    'actions' =>
    array (
    ),
    'event_sink' => 'game_events',
  ),
);

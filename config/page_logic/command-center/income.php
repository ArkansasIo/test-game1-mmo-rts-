<?php
return array (
  'purpose' => 'Explain production settlement by colony, faction, government, technology, biome, and upkeep.',
  'workflow' =>
  array (
    0 => 'load colony production',
    1 => 'load modifiers',
    2 => 'calculate gross output',
    3 => 'calculate food water energy upkeep',
    4 => 'render net settlement',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'owned colony scope',
  ),
  'calculations' =>
  array (
    0 => 'base production × race modifier × government modifier × technology − upkeep',
    1 => 'colony comparison',
    2 => 'life-support efficiency',
  ),
  'mutations' =>
  array (
  ),
  'page_title' => 'Income Breakdown',
  'layout_family' => 'breakdown',
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
      1 => 'races',
      2 => 'player_planets',
      3 => 'game_settings',
    ),
    'writes' =>
    array (
      0 => 'player_resources',
      1 => 'races',
      2 => 'player_planets',
      3 => 'game_settings',
    ),
    'actions' =>
    array (
    ),
    'event_sink' => 'game_events',
  ),
);

<?php
return array (
  'purpose' => 'Manage race, government, vacation, protection, and account security.',
  'workflow' =>
  array (
    0 => 'load faction options',
    1 => 'validate selection',
    2 => 'save faction history',
    3 => 'apply protection state',
    4 => 'render security controls',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'valid race and government',
    2 => 'vacation rules',
    3 => 'protection rules',
  ),
  'calculations' =>
  array (
    0 => 'race modifier × government modifier',
  ),
  'mutations' =>
  array (
    0 => 'players',
    1 => 'player_government_history',
    2 => 'vacation_states',
    3 => 'protection_states',
  ),
  'page_title' => 'Race Selection',
  'layout_family' => 'account',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_change_race',
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
      0 => 'races',
      1 => 'players',
    ),
    'writes' =>
    array (
      0 => 'races',
      1 => 'players',
    ),
    'actions' =>
    array (
      0 => 'change_race',
    ),
    'event_sink' => 'game_events',
  ),
);

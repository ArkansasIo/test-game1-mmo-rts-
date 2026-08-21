<?php
return array (
  'purpose' => 'Restore weapon durability using validated repair costs.',
  'workflow' =>
  array (
    0 => 'load damaged weapon',
    1 => 'calculate missing durability',
    2 => 'validate resources',
    3 => 'lock weapon',
    4 => 'restore durability transactionally',
  ),
  'validation' =>
  array (
    0 => 'weapon owner',
    1 => 'positive durability gap',
    2 => 'resource balance',
  ),
  'calculations' =>
  array (
    0 => 'missing durability × weapon tier × maintenance factor',
  ),
  'mutations' =>
  array (
    0 => 'player_weapons',
    1 => 'player_resources',
    2 => 'game_audit_log',
  ),
  'page_title' => 'Weapon Repair',
  'layout_family' => 'repair',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_weapon_repair',
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
      0 => 'player_weapons',
      1 => 'player_resources',
    ),
    'writes' =>
    array (
      0 => 'player_weapons',
      1 => 'player_resources',
    ),
    'actions' =>
    array (
      0 => 'weapon_repair',
    ),
    'event_sink' => 'game_events',
  ),
);

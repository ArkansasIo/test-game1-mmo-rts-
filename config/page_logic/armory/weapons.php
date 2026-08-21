<?php
return array (
  'purpose' => 'Manage owned weapons, quantities, durability, assignments, and effective power.',
  'workflow' =>
  array (
    0 => 'load catalogue',
    1 => 'validate purchase or inspection',
    2 => 'upsert inventory',
    3 => 'calculate durability-adjusted power',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'weapon ownership',
    2 => 'resource balance',
    3 => 'positive quantity',
  ),
  'calculations' =>
  array (
    0 => 'base power × durability × technology × race × government',
  ),
  'mutations' =>
  array (
    0 => 'player_weapons',
    1 => 'player_resources',
  ),
  'page_title' => 'Weapon Inventory',
  'layout_family' => 'inventory',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_weapon_buy',
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
      0 => 'weapon_types',
      1 => 'player_weapons',
    ),
    'writes' =>
    array (
      0 => 'weapon_types',
      1 => 'player_weapons',
    ),
    'actions' =>
    array (
      0 => 'weapon_buy',
    ),
    'event_sink' => 'game_events',
  ),
);

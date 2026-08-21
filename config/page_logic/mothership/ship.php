<?php
return array (
  'purpose' => 'Command the mothership hull, hangars, shields, weapons, and modules.',
  'workflow' =>
  array (
    0 => 'load mothership',
    1 => 'select upgrade',
    2 => 'validate module prerequisite',
    3 => 'lock resources',
    4 => 'queue or apply upgrade',
  ),
  'validation' =>
  array (
    0 => 'mothership owner',
    1 => 'module prerequisite',
    2 => 'resource balance',
    3 => 'capacity cap',
  ),
  'calculations' =>
  array (
    0 => 'hull + modules + weapons + shields + fleet capacity',
  ),
  'mutations' =>
  array (
    0 => 'motherships',
    1 => 'mothership_modules',
    2 => 'player_resources',
    3 => 'construction_queue',
  ),
  'page_title' => 'Mothership',
  'layout_family' => 'ship',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_mothership_upgrade',
  ),
  'sub_functions' =>
  array (
    0 => 'load_hull_and_modules',
    1 => 'calculate_capacity',
    2 => 'validate_module_slot',
    3 => 'enqueue_mothership_upgrade',
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
    ),
    'writes' =>
    array (
      0 => 'motherships',
    ),
    'actions' =>
    array (
      0 => 'mothership_upgrade',
    ),
    'event_sink' => 'game_events',
  ),
);

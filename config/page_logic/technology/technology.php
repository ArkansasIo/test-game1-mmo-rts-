<?php
return array (
  'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
  'workflow' =>
  array (
    0 => 'load technology tree',
    1 => 'check prerequisites',
    2 => 'calculate cost',
    3 => 'queue research',
    4 => 'apply completed effect',
  ),
  'validation' =>
  array (
    0 => 'authenticated researcher',
    1 => 'prerequisites',
    2 => 'research queue',
    3 => 'resource balance',
    4 => 'level cap',
  ),
  'calculations' =>
  array (
    0 => 'base cost × growth ^ current level',
  ),
  'mutations' =>
  array (
    0 => 'player_technologies',
    1 => 'construction_queue',
    2 => 'player_resources',
  ),
  'page_title' => 'Technology Tree',
  'layout_family' => 'technology',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_technology',
  ),
  'sub_functions' =>
  array (
    0 => 'load_branch',
    1 => 'check_prerequisites',
    2 => 'calculate_research_cost',
    3 => 'enqueue_research',
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
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'writes' =>
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'actions' =>
    array (
      0 => 'technology',
    ),
    'event_sink' => 'game_events',
  ),
);

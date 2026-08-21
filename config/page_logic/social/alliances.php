<?php
return array (
  'purpose' => 'Create alliances, manage members, and coordinate diplomacy.',
  'workflow' =>
  array (
    0 => 'load alliance state',
    1 => 'validate role or invitation',
    2 => 'create membership or proposal',
    3 => 'notify participants',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'alliance role',
    2 => 'membership rules',
    3 => 'target ownership',
  ),
  'calculations' =>
  array (
    0 => 'relation proposal lifecycle',
  ),
  'mutations' =>
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'diplomacy_relations',
    3 => 'diplomacy_actions',
    4 => 'player_notifications',
  ),
  'page_title' => 'Alliances',
  'layout_family' => 'social',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_alliance_create',
    7 => 'handle_alliance_join',
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
      0 => 'alliances',
      1 => 'alliance_members',
    ),
    'writes' =>
    array (
      0 => 'alliances',
      1 => 'alliance_members',
    ),
    'actions' =>
    array (
      0 => 'alliance_create',
      1 => 'alliance_join',
    ),
    'event_sink' => 'game_events',
  ),
);

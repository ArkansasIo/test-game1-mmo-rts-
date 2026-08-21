<?php
return array (
  'purpose' => 'Show battle, spy, sabotage, and system reports only to authorized recipients.',
  'workflow' =>
  array (
    0 => 'load recipient reports',
    1 => 'classify payload',
    2 => 'filter read state',
    3 => 'open or mark report read',
    4 => 'write audit state',
  ),
  'validation' =>
  array (
    0 => 'authenticated report recipient',
    1 => 'recipient ownership',
    2 => 'classification access',
  ),
  'calculations' =>
  array (
    0 => 'recipient ownership + report classification + read status',
  ),
  'mutations' =>
  array (
    0 => 'messages',
    1 => 'game_audit_log',
  ),
  'page_title' => 'Enemy Intelligence',
  'layout_family' => 'reports',
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
    0 => 'load_owned_reports',
    1 => 'classify_payload',
    2 => 'mark_report_read',
    3 => 'audit_report_access',
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
      0 => 'intelligence_reports',
    ),
    'writes' =>
    array (
      0 => 'intelligence_reports',
    ),
    'actions' =>
    array (
    ),
    'event_sink' => 'game_events',
  ),
);

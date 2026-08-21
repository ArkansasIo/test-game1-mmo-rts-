<?php
return array (
  'purpose' => 'Send, receive, read, and block commander messages.',
  'workflow' =>
  array (
    0 => 'load inbox',
    1 => 'validate sender and recipient',
    2 => 'apply content policy',
    3 => 'write message and notification',
    4 => 'update read or blacklist state',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'recipient exists',
    2 => 'blacklist policy',
    3 => 'message ownership',
  ),
  'calculations' =>
  array (
    0 => 'unread count',
  ),
  'mutations' =>
  array (
    0 => 'messages',
    1 => 'blacklists',
    2 => 'player_notifications',
  ),
  'page_title' => 'Messages',
  'layout_family' => 'messages',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_message',
    7 => 'handle_message_read',
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
      0 => 'messages',
      1 => 'blacklists',
    ),
    'writes' =>
    array (
      0 => 'messages',
      1 => 'blacklists',
    ),
    'actions' =>
    array (
      0 => 'message',
      1 => 'message_read',
    ),
    'event_sink' => 'game_events',
  ),
);

<?php
return array (
  'route' => 'targets',
  'title' => 'Target Selection',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_combat',
    7 => 'handle_covert',
    8 => 'handle_explore',
    9 => 'handle_message',
  ),
  'sub_functions' =>
  array (
    0 => 'load_target_board',
    1 => 'calculate_combat_preview',
    2 => 'check_protection',
    3 => 'resolve_deterministic_battle',
  ),
  'actions' =>
  array (
    0 => 'combat',
    1 => 'covert',
    2 => 'explore',
    3 => 'message',
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
);

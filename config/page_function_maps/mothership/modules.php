<?php
return array (
  'route' => 'modules',
  'title' => 'Mothership Modules',
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
  'actions' =>
  array (
    0 => 'mothership_upgrade',
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

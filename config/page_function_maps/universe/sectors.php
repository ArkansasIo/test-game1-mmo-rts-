<?php
return array (
  'route' => 'sectors',
  'title' => 'Sector Map',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_universe_sectors',
  ),
  'sub_functions' =>
  array (
    0 => 'load_sector',
    1 => 'calculate_scan_power',
    2 => 'order_systems_by_strategy',
    3 => 'classify_owner_signals',
  ),
  'actions' =>
  array (
    0 => 'universe_sectors',
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

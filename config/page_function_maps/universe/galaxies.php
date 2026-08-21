<?php
return array (
  'route' => 'galaxies',
  'title' => 'Galaxy Map',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_universe_galaxies',
  ),
  'sub_functions' =>
  array (
    0 => 'load_active_galaxies',
    1 => 'apply_coordinate_scope',
    2 => 'filter_discovered_sectors',
    3 => 'summarize_ownership',
  ),
  'actions' =>
  array (
    0 => 'universe_galaxies',
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

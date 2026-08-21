<?php
return array (
  'purpose' => 'Inspect planet class, biome, habitability, resource modifiers, and colony status.',
  'workflow' =>
  array (
    0 => 'inspect planet',
    1 => 'load biome',
    2 => 'calculate viability',
    3 => 'validate colonization',
    4 => 'create colony',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'colonization access',
    2 => 'occupancy',
    3 => 'habitability',
    4 => 'resource balance',
  ),
  'calculations' =>
  array (
    0 => 'habitability × biome × race × government × life support',
  ),
  'mutations' =>
  array (
    0 => 'universe_planets',
    1 => 'player_colonies',
    2 => 'game_audit_log',
  ),
  'page_title' => 'Universe Planets',
  'layout_family' => 'universe-planets',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_planet_details',
    7 => 'handle_colonize_planet',
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
      0 => 'universe_planets',
      1 => 'player_colonies',
    ),
    'writes' =>
    array (
      0 => 'universe_planets',
      1 => 'player_colonies',
    ),
    'actions' =>
    array (
      0 => 'planet_details',
      1 => 'colonize_planet',
    ),
    'event_sink' => 'game_events',
  ),
);

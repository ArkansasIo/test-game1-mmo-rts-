<?php
return array (
  'purpose' => 'Manage colonies, biomes, defenses, population, and life support.',
  'workflow' =>
  array (
    0 => 'load planet portfolio',
    1 => 'load biome and bonuses',
    2 => 'validate colony ownership',
    3 => 'process exploration or defense action',
    4 => 'render life support',
  ),
  'validation' =>
  array (
    0 => 'authenticated colony owner',
    1 => 'planet occupancy',
    2 => 'habitability',
    3 => 'resource balance',
  ),
  'calculations' =>
  array (
    0 => 'production − food/water upkeep + morale and habitability modifiers',
  ),
  'mutations' =>
  array (
    0 => 'player_colonies',
    1 => 'settlement',
    2 => 'universe_planets',
    3 => 'game_events',
  ),
  'page_title' => 'Settlement & Power Grid',
  'layout_family' => 'planets',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_planet_defense',
  ),
  'sub_functions' =>
  array (
    0 => 'load_colony_portfolio',
    1 => 'calculate_life_support',
    2 => 'validate_habitability',
    3 => 'queue_colony_action',
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
      0 => 'settlement',
    ),
    'writes' =>
    array (
      0 => 'settlement',
    ),
    'actions' =>
    array (
      0 => 'planet_defense',
    ),
    'event_sink' => 'game_events',
  ),
);

<?php
return array (
  'purpose' => 'Validate a coordinate tuple through the galaxy, sector, system, and orbit hierarchy, then apply discovery and ownership visibility.',
  'workflow' =>
  array (
    0 => 'validate coordinate input',
    1 => 'find active galaxy',
    2 => 'find active sector within the galaxy',
    3 => 'find active solar system within the sector',
    4 => 'find planet at the requested orbit slot',
    5 => 'apply discovery filter',
    6 => 'classify ownership and return scoped navigation identifiers',
  ),
  'validation' =>
  array (
    0 => 'authenticated commander',
    1 => 'coordinate format',
    2 => 'coordinate bounds',
    3 => 'hierarchy validity',
    4 => 'discovery or ownership visibility',
  ),
  'calculations' =>
  array (
    0 => 'coordinate lookup = validated galaxy : sector : system : slot tuple',
    1 => 'visibility = discovered system OR commander-owned colony',
  ),
  'mutations' =>
  array (
  ),
  'page_title' => 'Coordinate Search',
  'layout_family' => 'coordinates',
  'functions' =>
  array (
    0 => 'load_state',
    1 => 'validate_intent',
    2 => 'preview_action',
    3 => 'render_ready_state',
    4 => 'render_empty_state',
    5 => 'render_error_state',
    6 => 'handle_coordinate_lookup',
  ),
  'sub_functions' =>
  array (
    0 => 'parse_coordinate_tuple',
    1 => 'validate_hierarchy',
    2 => 'apply_discovery_filter',
    3 => 'build_navigation_identifiers',
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
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'player_colonies',
    ),
    'writes' =>
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'player_colonies',
    ),
    'actions' =>
    array (
      0 => 'coordinate_lookup',
    ),
    'event_sink' => 'game_events',
  ),
);

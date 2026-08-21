<?php
return array (
  'page_title' => 'Coordinate Search',
  0 => 'coordinate input',
  1 => 'galaxy result',
  2 => 'system result',
  3 => 'planet result',
  4 => 'moon result',
  'feature_matrix' =>
  array (
    'core' =>
    array (
      0 => 'state snapshot',
      1 => 'permission-aware rendering',
      2 => 'feedback-state rendering',
    ),
    'controls' =>
    array (
      0 => 'Search coordinates',
      1 => 'Open system',
    ),
    'actions' =>
    array (
      0 => 'coordinate_lookup',
    ),
    'data_sources' =>
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'player_colonies',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'parse_coordinate_tuple',
    1 => 'validate_hierarchy',
    2 => 'apply_discovery_filter',
    3 => 'build_navigation_identifiers',
  ),
  'acceptance_criteria' =>
  array (
    0 => 'unauthorized input rejected',
    1 => 'negative quantities rejected',
    2 => 'empty state handled',
    3 => 'success refreshes state',
    4 => 'database mutation is transactional',
  ),
);

<?php
return array (
  'page_title' => 'Galaxy Map',
  0 => 'galaxy selector',
  1 => 'star density',
  2 => 'sector overview',
  3 => 'travel risk',
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
      0 => 'Select galaxy',
      1 => 'Open sector',
    ),
    'actions' =>
    array (
      0 => 'universe_galaxies',
    ),
    'data_sources' =>
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'target_realms',
      6 => 'game_events',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_active_galaxies',
    1 => 'apply_coordinate_scope',
    2 => 'filter_discovered_sectors',
    3 => 'summarize_ownership',
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

<?php
return array (
  'page_title' => 'Solar Systems',
  0 => 'star class',
  1 => 'orbit map',
  2 => 'planet slots',
  3 => 'anomaly scan',
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
      0 => 'Open system',
      1 => 'Scan system',
    ),
    'actions' =>
    array (
      0 => 'system_map',
      1 => 'explore',
    ),
    'data_sources' =>
    array (
      0 => 'universe_solar_systems',
      1 => 'universe_planets',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_page_state',
    1 => 'validate_page_scope',
    2 => 'calculate_page_metrics',
    3 => 'render_page_result',
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

<?php
return array (
  'page_title' => 'Moon Registry',
  0 => 'moon registry',
  1 => 'moon class',
  2 => 'sensor bonus',
  3 => 'jump-gate level',
  4 => 'orbit relationship',
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
      0 => 'Inspect moon',
      1 => 'Build jump gate',
    ),
    'actions' =>
    array (
      0 => 'moon_details',
      1 => 'mothership_upgrade',
    ),
    'data_sources' =>
    array (
      0 => 'universe_moons',
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

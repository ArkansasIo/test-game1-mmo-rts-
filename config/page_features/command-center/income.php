<?php
return array (
  'page_title' => 'Income Breakdown',
  0 => 'income formula',
  1 => 'modifier breakdown',
  2 => 'colony comparison',
  3 => 'food water energy upkeep',
  4 => 'production forecast',
  5 => 'read-only state',
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
      0 => 'View income formula',
    ),
    'actions' =>
    array (
    ),
    'data_sources' =>
    array (
      0 => 'player_resources',
      1 => 'races',
      2 => 'player_planets',
      3 => 'game_settings',
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

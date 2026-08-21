<?php
return array (
  'page_title' => 'Account Information',
  0 => 'commander profile',
  1 => 'race and government identity',
  2 => 'rank summary',
  3 => 'protection state',
  4 => 'progression summary',
  5 => 'session security',
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
      0 => 'View profile',
      1 => 'View rank',
      2 => 'View protection',
    ),
    'actions' =>
    array (
    ),
    'data_sources' =>
    array (
      0 => 'players',
      1 => 'races',
      2 => 'rankings',
      3 => 'glory_reputation',
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

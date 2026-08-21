<?php
return array (
  'page_title' => 'Race Selection',
  0 => 'race selection',
  1 => 'government selection',
  2 => 'vacation mode',
  3 => 'protection',
  4 => 'session security',
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
      0 => 'Select race',
    ),
    'actions' =>
    array (
      0 => 'change_race',
    ),
    'data_sources' =>
    array (
      0 => 'races',
      1 => 'players',
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

<?php
return array (
  'page_title' => 'Mothership Modules',
  0 => 'hull',
  1 => 'weapons and shields',
  2 => 'hangars',
  3 => 'modules',
  4 => 'capacity',
  5 => 'upgrade queue',
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
      0 => 'Upgrade module',
    ),
    'actions' =>
    array (
      0 => 'mothership_upgrade',
    ),
    'data_sources' =>
    array (
      0 => 'mothership_modules',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_hull_and_modules',
    1 => 'calculate_capacity',
    2 => 'validate_module_slot',
    3 => 'enqueue_mothership_upgrade',
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

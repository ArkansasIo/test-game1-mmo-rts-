<?php
return array (
  'page_title' => 'Unit Training',
  0 => 'unit categories',
  1 => 'quantity input',
  2 => 'training queue',
  3 => 'population conversion',
  4 => 'production upgrade',
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
      0 => 'Train units',
    ),
    'actions' =>
    array (
      0 => 'train',
      1 => 'upgrade_up',
    ),
    'data_sources' =>
    array (
      0 => 'unit_types',
      1 => 'player_unit_stats',
      2 => 'training_queues',
      3 => 'player_resources',
      4 => 'game_events',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_queue_capacity',
    1 => 'validate_population',
    2 => 'calculate_training_cost',
    3 => 'enqueue_training',
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

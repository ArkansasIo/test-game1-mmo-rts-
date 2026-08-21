<?php
return array (
  'page_title' => 'Unit Production',
  0 => 'current production',
  1 => 'next-level cost',
  2 => 'queue status',
  3 => 'upgrade effects',
  4 => 'production preview',
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
      0 => 'Upgrade UP',
    ),
    'actions' =>
    array (
      0 => 'upgrade_up',
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

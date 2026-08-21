<?php
return array (
  'page_title' => 'Rankings',
  0 => 'overall leaderboard',
  1 => 'military leaderboard',
  2 => 'economy leaderboard',
  3 => 'covert leaderboard',
  4 => 'historical snapshots',
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
      0 => 'Refresh rankings',
      1 => 'Open player',
    ),
    'actions' =>
    array (
      0 => 'refresh_rankings',
    ),
    'data_sources' =>
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
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

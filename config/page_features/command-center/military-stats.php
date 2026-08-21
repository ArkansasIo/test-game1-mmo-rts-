<?php
return array (
  'page_title' => 'Military Statistics',
  0 => 'attack power',
  1 => 'defense power',
  2 => 'covert power',
  3 => 'anti-covert power',
  4 => 'readiness',
  5 => 'DefCon control',
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
      0 => 'View attack',
      1 => 'View defense',
      2 => 'View covert',
    ),
    'actions' =>
    array (
    ),
    'data_sources' =>
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'rankings',
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

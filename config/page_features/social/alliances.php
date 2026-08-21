<?php
return array (
  'page_title' => 'Alliances',
  0 => 'alliance identity',
  1 => 'member roles',
  2 => 'join and leave',
  3 => 'diplomacy proposals',
  4 => 'shared activity',
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
      0 => 'Create alliance',
      1 => 'Join alliance',
      2 => 'Leave alliance',
    ),
    'actions' =>
    array (
      0 => 'alliance_create',
      1 => 'alliance_join',
    ),
    'data_sources' =>
    array (
      0 => 'alliances',
      1 => 'alliance_members',
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

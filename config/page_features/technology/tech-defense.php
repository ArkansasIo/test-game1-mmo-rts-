<?php
return array (
  'page_title' => 'Defense Technology',
  0 => 'technology tree',
  1 => 'branch filters',
  2 => 'prerequisites',
  3 => 'level and cost',
  4 => 'research queue',
  5 => 'effect preview',
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
      0 => 'Upgrade',
    ),
    'actions' =>
    array (
      0 => 'technology',
    ),
    'data_sources' =>
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_branch',
    1 => 'check_prerequisites',
    2 => 'calculate_research_cost',
    3 => 'enqueue_research',
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

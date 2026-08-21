<?php
return array (
  'page_title' => 'Sabotage Operations',
  0 => 'agent allocation',
  1 => 'detection warning',
  2 => 'target intelligence',
  3 => 'reconnaissance',
  4 => 'spy mission',
  5 => 'sabotage mission',
  6 => 'classified report',
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
      0 => 'Choose system',
      1 => 'Run sabotage',
    ),
    'actions' =>
    array (
      0 => 'covert',
    ),
    'data_sources' =>
    array (
      0 => 'covert_missions',
      1 => 'sabotage_missions',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_agent_pool',
    1 => 'calculate_detection',
    2 => 'resolve_mission',
    3 => 'persist_classified_report',
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

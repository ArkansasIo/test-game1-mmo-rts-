<?php
return array (
  'page_title' => 'Ascension',
  0 => 'experience',
  1 => 'tier and level',
  2 => 'Glory',
  3 => 'Reputation',
  4 => 'ascension requirements',
  5 => 'progression history',
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
      0 => 'Check eligibility',
      1 => 'Ascend',
    ),
    'actions' =>
    array (
      0 => 'ascend',
    ),
    'data_sources' =>
    array (
      0 => 'ascension_states',
      1 => 'ascensions',
      2 => 'glory_reputation',
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

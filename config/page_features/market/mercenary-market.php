<?php
return array (
  'page_title' => 'Mercenary Market',
  0 => 'open orders',
  1 => 'price history',
  2 => 'order form',
  3 => 'buy order',
  4 => 'list order',
  5 => 'settlement status',
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
      0 => 'Recruit',
      1 => 'Sell',
    ),
    'actions' =>
    array (
      0 => 'mercenary_buy',
    ),
    'data_sources' =>
    array (
      0 => 'mercenary_types',
      1 => 'player_mercenaries',
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

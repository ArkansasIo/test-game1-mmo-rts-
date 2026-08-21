<?php
return array (
  'page_title' => 'Weapon Inventory',
  0 => 'weapon catalogue',
  1 => 'owned quantity',
  2 => 'durability',
  3 => 'assignment readiness',
  4 => 'weapon purchase',
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
      0 => 'Buy weapon',
      1 => 'Inspect durability',
    ),
    'actions' =>
    array (
      0 => 'weapon_buy',
    ),
    'data_sources' =>
    array (
      0 => 'weapon_types',
      1 => 'player_weapons',
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

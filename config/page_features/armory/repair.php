<?php
return array (
  'page_title' => 'Weapon Repair',
  0 => 'durability board',
  1 => 'repair cost',
  2 => 'resource check',
  3 => 'repair result',
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
      0 => 'Repair weapon',
    ),
    'actions' =>
    array (
      0 => 'weapon_repair',
    ),
    'data_sources' =>
    array (
      0 => 'player_weapons',
      1 => 'player_resources',
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

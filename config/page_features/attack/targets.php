<?php
return array (
  'page_title' => 'Target Selection',
  0 => 'known realm search',
  1 => 'protection badges',
  2 => 'combat preview',
  3 => 'operation cost',
  4 => 'attack',
  5 => 'raid',
  6 => 'spy',
  7 => 'sabotage',
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
      0 => 'Attack',
      1 => 'Raid',
      2 => 'Spy',
      3 => 'Sabotage',
      4 => 'Conquer Planet',
      5 => 'Message',
    ),
    'actions' =>
    array (
      0 => 'combat',
      1 => 'covert',
      2 => 'explore',
      3 => 'message',
    ),
    'data_sources' =>
    array (
      0 => 'target_realms',
      1 => 'players',
      2 => 'battles',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_target_board',
    1 => 'calculate_combat_preview',
    2 => 'check_protection',
    3 => 'resolve_deterministic_battle',
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

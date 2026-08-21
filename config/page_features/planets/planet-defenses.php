<?php
return array (
  'page_title' => 'Planet Defenses',
  0 => 'planet portfolio',
  1 => 'biome modifiers',
  2 => 'defenses',
  3 => 'population',
  4 => 'food and water',
  5 => 'exploration',
  6 => 'colonization',
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
      0 => 'Upgrade defense',
    ),
    'actions' =>
    array (
      0 => 'planet_defense',
    ),
    'data_sources' =>
    array (
      0 => 'planet_defenses',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_colony_portfolio',
    1 => 'calculate_life_support',
    2 => 'validate_habitability',
    3 => 'queue_colony_action',
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

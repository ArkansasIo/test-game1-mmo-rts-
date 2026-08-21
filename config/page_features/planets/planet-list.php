<?php
return array (
  'page_title' => 'Planet List',
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
      0 => 'Explore',
      1 => 'Colonize',
      2 => 'Upgrade defense',
    ),
    'actions' =>
    array (
      0 => 'explore',
      1 => 'combat',
      2 => 'colonize_planet',
      3 => 'planet_defense',
    ),
    'data_sources' =>
    array (
      0 => 'player_colonies',
      1 => 'planet_bonuses',
      2 => 'planet_explorations',
      3 => 'player_resources',
      4 => 'universe_planets',
      5 => 'planet_defenses',
      6 => 'motherships',
      7 => 'player_cooldowns',
      8 => 'game_events',
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

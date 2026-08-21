<?php
return array (
  'page_title' => 'Universe Planets',
  0 => 'planet class',
  1 => 'biome',
  2 => 'habitability',
  3 => 'resource modifiers',
  4 => 'colony status',
  5 => 'colonization',
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
      0 => 'Inspect planet',
      1 => 'Colonize planet',
    ),
    'actions' =>
    array (
      0 => 'planet_details',
      1 => 'colonize_planet',
    ),
    'data_sources' =>
    array (
      0 => 'universe_planets',
      1 => 'player_colonies',
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

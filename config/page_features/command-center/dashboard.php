<?php
return array (
  'page_title' => 'Command Center',
  0 => 'eight-resource HUD',
  1 => 'colony life support',
  2 => 'building and research queues',
  3 => 'fleet mission board',
  4 => 'universal progression',
  5 => 'server feedback',
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
      0 => 'Process turns',
      1 => 'Choose target',
      2 => 'Review reports',
    ),
    'actions' =>
    array (
      0 => 'process_turns',
    ),
    'data_sources' =>
    array (
      0 => 'players',
      1 => 'player_resources',
      2 => 'rankings',
      3 => 'game_events',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'refresh_state',
    1 => 'settle_turns',
    2 => 'aggregate_resource_delta',
    3 => 'render_event_feed',
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

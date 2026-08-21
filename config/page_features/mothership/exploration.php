<?php
return array (
  'page_title' => 'Exploration',
  0 => 'discovery range',
  1 => 'system scan',
  2 => 'anomaly chance',
  3 => 'discovery rewards',
  4 => 'travel risk',
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
      0 => 'Explore planet',
    ),
    'actions' =>
    array (
      0 => 'explore',
    ),
    'data_sources' =>
    array (
      0 => 'motherships',
      1 => 'planet_explorations',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'validate_expedition_readiness',
    1 => 'calculate_travel_time',
    2 => 'resolve_anomaly',
    3 => 'persist_discovery_reward',
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

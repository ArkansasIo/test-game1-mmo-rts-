<?php
return array (
  'page_title' => 'Sector Map',
  0 => 'sector class',
  1 => 'danger level',
  2 => 'resource modifier',
  3 => 'anomaly rate',
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
      0 => 'Select sector',
      1 => 'Open system',
    ),
    'actions' =>
    array (
      0 => 'universe_sectors',
    ),
    'data_sources' =>
    array (
      0 => 'universe_sectors',
      1 => 'universe_solar_systems',
      2 => 'universe_planets',
      3 => 'motherships',
      4 => 'mothership_modules',
      5 => 'player_technologies',
      6 => 'player_cooldowns',
      7 => 'game_events',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_sector',
    1 => 'calculate_scan_power',
    2 => 'order_systems_by_strategy',
    3 => 'classify_owner_signals',
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

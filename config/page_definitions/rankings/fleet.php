<?php
return array (
  'route' => 'fleet',
  'group' => 'rankings',
  'group_label' => 'Rankings',
  'title' => 'Fleet',
  'layout' => 'rankings',
  'controls' => 
  array (
    0 => 'Open overview',
    1 => 'Review status',
  ),
  'actions' => 
  array (
  ),
  'tables' => 
  array (
    0 => 'game_events',
  ),
  'details' => 
  array (
    'hero' => 'Rankings',
    'panels' => 
    array (
      0 => 'Overall leaderboard',
      1 => 'Military leaderboard',
      2 => 'Economy leaderboard',
      3 => 'Covert leaderboard',
      4 => 'Historical snapshots',
    ),
    'formula' => 'score = weighted economy + military + covert + progression + colony value',
    'controls' => 
    array (
      0 => 'Refresh rankings',
      1 => 'Open player',
      2 => 'View snapshot',
    ),
    'action' => 'refresh_rankings',
    'tables' => 
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
      2 => 'players',
    ),
    'permission' => 'authenticated commander',
    'states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'success',
      4 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Rankings',
    'purpose' => 'Compare commanders and preserve ranking snapshots.',
    'buttons' => 
    array (
      'Refresh rankings' => 
      array (
        'action' => 'refresh_rankings',
        'logic' => 'Recalculate weighted scores and persist snapshot.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'players',
          1 => 'player_resources',
          2 => 'rankings',
        ),
        'writes' => 
        array (
          0 => 'rankings',
          1 => 'rank_snapshots',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'cooldown',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Open player' => 
      array (
        'action' => 'read_profile',
        'logic' => 'Open public commander profile without exposing private fields.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'players',
          1 => 'rankings',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'not-found',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Compare economy, military, covert, progression, and colony scores.',
    'workflow' => 
    array (
      0 => 'load ranking snapshot',
      1 => 'calculate or refresh scores',
      2 => 'filter leaderboard',
      3 => 'open public profile',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'public profile field policy',
    ),
    'calculations' => 
    array (
      0 => 'weighted economy + military + covert + progression + colony value',
    ),
    'mutations' => 
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
    ),
  ),
  'features' => 
  array (
    0 => 'overall leaderboard',
    1 => 'military leaderboard',
    2 => 'economy leaderboard',
    3 => 'covert leaderboard',
    4 => 'historical snapshots',
  ),
  'design' => 
  array (
    'template' => 'ranking-table',
    'sections' => 
    array (
      0 => 'filters',
      1 => 'leaderboard',
      2 => 'score breakdown',
      3 => 'snapshots',
    ),
    'components' => 
    array (
      0 => 'ranking-table',
      1 => 'score-badge',
      2 => 'filter-tabs',
      3 => 'snapshot-selector',
    ),
    'responsive' => 'Leaderboard columns collapse into ranked cards',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'RankingService',
      1 => 'AccountService',
    ),
    'reads' => 
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
      2 => 'players',
      3 => 'player_resources',
    ),
    'writes' => 
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
    ),
    'actions' => 
    array (
      0 => 'refresh_rankings',
      1 => 'read_profile',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/rankings/fleet.php',
    'features' => 'config/page_features/rankings/fleet.php',
    'design' => 'config/page_design_specs/rankings/fleet.php',
    'systems' => 'config/page_systems/rankings/fleet.php',
    'module' => 'includes/page_modules/rankings/fleet.php',
  ),
);

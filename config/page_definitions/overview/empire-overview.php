<?php
return array (
  'route' => 'empire-overview',
  'group' => 'overview',
  'group_label' => 'Overview',
  'title' => 'Empire Overview',
  'layout' => 'dashboard',
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
  ),
  'interaction' => 
  array (
    'page' => 'Command Center',
    'purpose' => 'Read the commander state and issue high-level intent.',
    'buttons' => 
    array (
      'Process turns' => 
      array (
        'action' => 'process_turns',
        'logic' => 'Lock player state, settle elapsed turns, production, upkeep, queues, missions, rankings, and events.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'players',
          1 => 'player_resources',
          2 => 'player_colonies',
          3 => 'construction_queue',
          4 => 'fleet_missions',
        ),
        'writes' => 
        array (
          0 => 'player_resources',
          1 => 'game_events',
          2 => 'rankings',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'cooldown',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Choose target' => 
      array (
        'action' => 'navigate:targets',
        'logic' => 'Open known-realm target board without mutating state.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'target_realms',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'empty',
        ),
      ),
      'Review reports' => 
      array (
        'action' => 'navigate:attack-log',
        'logic' => 'Open unread combat and intelligence reports.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'battle_reports',
          1 => 'intelligence_reports',
          2 => 'messages',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'empty',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Coordinate colony, economy, queues, fleets, alerts, and turn settlement.',
    'workflow' => 
    array (
      0 => 'load authoritative state',
      1 => 'validate commander intent',
      2 => 'settle bounded turn window',
      3 => 'return refreshed state',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF token',
      2 => 'RBAC permission',
      3 => 'transaction boundary',
    ),
    'calculations' => 
    array (
      0 => 'resource settlement',
      1 => 'food and water upkeep',
      2 => 'queue completion',
      3 => 'fleet ETA',
    ),
    'mutations' => 
    array (
      0 => 'player_resources',
      1 => 'construction_queue',
      2 => 'fleet_missions',
      3 => 'game_events',
      4 => 'rankings',
    ),
  ),
  'features' => 
  array (
    0 => 'eight-resource HUD',
    1 => 'colony life support',
    2 => 'building and research queues',
    3 => 'fleet mission board',
    4 => 'universal progression',
    5 => 'server feedback',
  ),
  'design' => 
  array (
    'template' => 'command-center',
    'sections' => 
    array (
      0 => 'identity header',
      1 => 'resource strip',
      2 => 'colony overview',
      3 => 'server actions',
      4 => 'queues',
      5 => 'life support',
      6 => 'fleet control',
      7 => 'progression',
      8 => 'alerts',
    ),
    'components' => 
    array (
      0 => 'resource-tile',
      1 => 'metric-grid',
      2 => 'action-panel',
      3 => 'status-badge',
      4 => 'data-table',
    ),
    'responsive' => '12-column desktop grid collapses to stacked mobile panels',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'GameService',
      1 => 'DashboardService',
      2 => 'ProgressionService',
    ),
    'reads' => 
    array (
      0 => 'players',
      1 => 'player_resources',
      2 => 'player_colonies',
      3 => 'construction_queue',
      4 => 'fleet_missions',
      5 => 'rankings',
      6 => 'game_events',
    ),
    'writes' => 
    array (
      0 => 'player_resources',
      1 => 'construction_queue',
      2 => 'fleet_missions',
      3 => 'rankings',
      4 => 'game_events',
    ),
    'actions' => 
    array (
      0 => 'process_turns',
      1 => 'choose_target',
      2 => 'review_reports',
      3 => 'progression_advance',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/overview/empire-overview.php',
    'features' => 'config/page_features/overview/empire-overview.php',
    'design' => 'config/page_design_specs/overview/empire-overview.php',
    'systems' => 'config/page_systems/overview/empire-overview.php',
    'module' => 'includes/page_modules/overview/empire-overview.php',
  ),
);

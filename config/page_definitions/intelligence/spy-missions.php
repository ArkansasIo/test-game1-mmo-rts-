<?php
declare(strict_types=1);
return array (
  'route' => 'spy-missions',
  'group' => 'intelligence',
  'group_label' => 'Intelligence',
  'title' => 'Spy Missions',
  'layout' => 'combat',
  'purpose' => 'Spy Missions subsystem console with server-authoritative state, controls, dependencies, and feedback.',
  'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
  'controls' => 
  array (
    0 => 'select target',
    1 => 'allocate agents',
    2 => 'run reconnaissance',
    3 => 'run spy mission',
    4 => 'run sabotage',
    5 => 'review classified reports',
  ),
  'actions' => 
  array (
    0 => 'covert:recon',
    1 => 'covert:spy',
    2 => 'covert:sabotage',
    3 => 'refresh_page',
  ),
  'tables' => 
  array (
    0 => 'players',
    1 => 'target_realms',
    2 => 'player_resources',
    3 => 'covert_missions',
    4 => 'intelligence_reports',
    5 => 'espionage_events',
    6 => 'game_events',
  ),
  'details' => 
  array (
    'current state' => 'server-calculated telemetry',
    'available controls' => 'permission-aware operations',
    'dependencies' => 'validated prerequisites and cooldowns',
    'audit' => 'transactional event history',
  ),
  'logic' => 
  array (
    'purpose' => 'Spy Missions operations',
    'workflow' => 
    array (
      0 => 'load scoped state',
      1 => 'validate authenticated intent',
      2 => 'lock required records',
      3 => 'resolve authoritative mechanic',
      4 => 'write audit event',
      5 => 'return feedback',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF token',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'cooldown validation',
      5 => 'transaction boundary',
    ),
    'calculations' => 
    array (
      0 => 'detection = defender counter-intelligence − attacker agents − covert technology',
    ),
    'mutations' => 
    array (
      0 => 'players',
      1 => 'target_realms',
      2 => 'player_resources',
      3 => 'covert_missions',
      4 => 'intelligence_reports',
      5 => 'espionage_events',
      6 => 'game_events',
    ),
  ),
  'features' => 
  array (
    0 => 'target board',
    1 => 'agent allocation',
    2 => 'detection meter',
    3 => 'reconnaissance reports',
    4 => 'spy mission reports',
    5 => 'bounded sabotage',
    6 => 'classified report access',
    7 => 'cooldown visibility',
  ),
  'sub_features' => 
  array (
    0 => 'loading and refresh state',
    1 => 'permission-aware controls',
    2 => 'related-page navigation',
    3 => 'filter and sort state',
    4 => 'empty-state explanation',
    5 => 'audit and feedback detail',
  ),
  'design' => 
  array (
    'template' => 'covert-operations',
    'sections' => 
    array (
      0 => 'overview',
      1 => 'controls',
      2 => 'features',
      3 => 'system-design',
      4 => 'information',
      5 => 'feedback-states',
    ),
    'components' => 
    array (
      0 => 'metric-strip',
      1 => 'operation-controls',
      2 => 'status-badge',
      3 => 'data-table',
      4 => 'feedback-panel',
    ),
    'responsive' => 'horizontal dashboard with stacked mobile layout',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'EspionageScanningService',
    ),
    'reads' => 
    array (
      0 => 'players',
      1 => 'target_realms',
      2 => 'player_resources',
      3 => 'covert_missions',
      4 => 'intelligence_reports',
      5 => 'espionage_events',
      6 => 'game_events',
    ),
    'writes' => 
    array (
      0 => 'players',
      1 => 'target_realms',
      2 => 'player_resources',
      3 => 'covert_missions',
      4 => 'intelligence_reports',
      5 => 'espionage_events',
      6 => 'game_events',
    ),
    'actions' => 
    array (
      0 => 'covert:recon',
      1 => 'covert:spy',
      2 => 'covert:sabotage',
      3 => 'refresh_page',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF',
      2 => 'RBAC',
      3 => 'ownership scope',
      4 => 'cooldown validation',
    ),
  ),
  'feedback_states' => 
  array (
    0 => 'loading',
    1 => 'ready',
    2 => 'empty',
    3 => 'protected',
    4 => 'cooldown',
    5 => 'insufficient-resource',
    6 => 'success',
    7 => 'error',
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/intelligence/spy-missions.php',
    'features' => 'config/page_features/intelligence/spy-missions.php',
    'design' => 'config/page_design_specs/intelligence/spy-missions.php',
    'systems' => 'config/page_systems/intelligence/spy-missions.php',
    'module' => 'includes/page_modules/intelligence/spy-missions.php',
  ),
);

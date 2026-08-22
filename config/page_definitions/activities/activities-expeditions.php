<?php
declare(strict_types=1);
return array (
  'route' => 'activities-expeditions',
  'group' => 'activities',
  'group_label' => 'Activities',
  'title' => 'Expeditions',
  'layout' => 'activities',
  'purpose' => 'Expeditions subsystem console with server-authoritative state, controls, dependencies, and feedback.',
  'mechanic' => 'server-authoritative subsystem state = validated inputs + scoped records + pending operations',
  'controls' => 
  array (
    0 => 'open overview',
    1 => 'review status',
    2 => 'inspect records',
    3 => 'review alerts',
  ),
  'actions' => 
  array (
    0 => 'inspect_page',
    1 => 'refresh_page',
  ),
  'tables' => 
  array (
    0 => 'players',
    1 => 'player_resources',
    2 => 'game_events',
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
    'purpose' => 'Expeditions operations',
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
      0 => 'server-authoritative subsystem state = validated inputs + scoped records + pending operations',
    ),
    'mutations' => 
    array (
    ),
  ),
  'features' => 
  array (
    0 => 'summary metrics',
    1 => 'status badges',
    2 => 'related-page navigation',
    3 => 'empty-state guidance',
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
    'template' => 'specification-dashboard',
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
      0 => 'PageService',
    ),
    'reads' => 
    array (
      0 => 'players',
      1 => 'player_resources',
      2 => 'game_events',
    ),
    'writes' => 
    array (
    ),
    'actions' => 
    array (
      0 => 'inspect_page',
      1 => 'refresh_page',
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
    'logic' => 'config/page_logic/activities/activities-expeditions.php',
    'features' => 'config/page_features/activities/activities-expeditions.php',
    'design' => 'config/page_design_specs/activities/activities-expeditions.php',
    'systems' => 'config/page_systems/activities/activities-expeditions.php',
    'module' => 'includes/page_modules/activities/activities-expeditions.php',
  ),
);

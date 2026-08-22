<?php
declare(strict_types=1);
return array (
  'route' => 'alliance-intelligence',
  'group' => 'alliance',
  'group_label' => 'Alliance',
  'title' => 'Alliance Intelligence',
  'layout' => 'social',
  'purpose' => 'Alliance Intelligence subsystem console with server-authoritative state, controls, dependencies, and feedback.',
  'mechanic' => 'alliance capacity = command level × alliance technology × government modifier',
  'controls' => 
  array (
    0 => 'inspect alliance',
    1 => 'manage membership',
    2 => 'propose diplomacy',
    3 => 'coordinate war',
    4 => 'review projects',
  ),
  'actions' => 
  array (
    0 => 'alliance_create',
    1 => 'alliance_join',
    2 => 'diplomacy_propose',
    3 => 'refresh_page',
  ),
  'tables' => 
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'alliance_projects',
    3 => 'game_events',
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
    'purpose' => 'Alliance Intelligence operations',
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
      0 => 'alliance capacity = command level × alliance technology × government modifier',
    ),
    'mutations' => 
    array (
      0 => 'alliances',
      1 => 'alliance_members',
      2 => 'alliance_projects',
      3 => 'game_events',
    ),
  ),
  'features' => 
  array (
    0 => 'membership roster',
    1 => 'role permissions',
    2 => 'shared projects',
    3 => 'diplomacy map',
    4 => 'war coordination',
    5 => 'alliance intelligence',
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
      0 => 'alliances',
      1 => 'alliance_members',
      2 => 'alliance_projects',
      3 => 'game_events',
    ),
    'writes' => 
    array (
      0 => 'alliances',
      1 => 'alliance_members',
      2 => 'alliance_projects',
      3 => 'game_events',
    ),
    'actions' => 
    array (
      0 => 'alliance_create',
      1 => 'alliance_join',
      2 => 'diplomacy_propose',
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
    'logic' => 'config/page_logic/alliance/alliance-intelligence.php',
    'features' => 'config/page_features/alliance/alliance-intelligence.php',
    'design' => 'config/page_design_specs/alliance/alliance-intelligence.php',
    'systems' => 'config/page_systems/alliance/alliance-intelligence.php',
    'module' => 'includes/page_modules/alliance/alliance-intelligence.php',
  ),
);

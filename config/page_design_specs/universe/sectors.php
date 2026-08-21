<?php
return array (
  'template' => 'sector-map',
  'sections' =>
  array (
    0 => 'sector selector',
    1 => 'danger',
    2 => 'resource modifier',
    3 => 'anomalies',
  ),
  'components' =>
  array (
    0 => 'sector-card',
    1 => 'danger-meter',
    2 => 'modifier-badge',
    3 => 'system-list',
  ),
  'responsive' => 'Sector cards stack on mobile',
  'page_title' => 'Sector Map',
  'layout_family' => 'sectors',
  'sub_design' =>
  array (
    'primary_panel' => 'Sector scan and risk board',
    'visual_system' => 'sector-table',
    'interaction_model' => 'server-side scan power and cooldown',
    'sections' =>
    array (
      0 => 'sector selector',
      1 => 'danger',
      2 => 'resource modifier',
      3 => 'anomalies',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'sector-card',
      1 => 'danger-meter',
      2 => 'modifier-badge',
      3 => 'system-list',
      4 => 'state-banner',
      5 => 'action-form',
      6 => 'feedback-region',
      7 => 'audit-trail',
    ),
    'hierarchy' =>
    array (
      0 => 'header',
      1 => 'context-strip',
      2 => 'primary-content',
      3 => 'action-zone',
      4 => 'feedback-zone',
      5 => 'technical-details',
    ),
  ),
  'responsive_breakpoints' =>
  array (
    'mobile' => 'single-column; controls stack; tables scroll',
    'tablet' => 'two-column metrics; action panel below',
    'desktop' => 'full information density with sidebar',
  ),
  'interaction_patterns' =>
  array (
    'optimistic_ui' => false,
    'server_authoritative' => true,
    'csrf_required' => true,
    'focus_after_feedback' => 'feedback-region',
  ),
  'accessibility' =>
  array (
    'keyboard_navigation' => true,
    'aria_live_feedback' => true,
    'semantic_tables' => true,
    'reduced_motion_supported' => true,
  ),
  'states' =>
  array (
    0 => 'loading',
    1 => 'ready',
    2 => 'empty',
    3 => 'error',
    4 => 'submitting',
    5 => 'success',
    6 => 'cooldown',
    7 => 'protected',
    8 => 'insufficient-resource',
  ),
);

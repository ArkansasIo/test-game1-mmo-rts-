<?php
return array (
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
  'page_title' => 'Command Center',
  'layout_family' => 'dashboard',
  'sub_design' =>
  array (
    'primary_panel' => 'Command overview',
    'visual_system' => 'metric-grid',
    'interaction_model' => 'turn settlement and live refresh',
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
      9 => 'status',
      10 => 'controls',
      11 => 'activity',
      12 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'resource-tile',
      1 => 'metric-grid',
      2 => 'action-panel',
      3 => 'status-badge',
      4 => 'data-table',
      5 => 'state-banner',
      6 => 'action-form',
      7 => 'feedback-region',
      8 => 'audit-trail',
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
    'semantic_tables' => false,
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

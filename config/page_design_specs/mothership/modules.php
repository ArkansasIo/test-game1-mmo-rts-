<?php
return array (
  'template' => 'mothership-command',
  'sections' =>
  array (
    0 => 'hull',
    1 => 'weapons',
    2 => 'hangars',
    3 => 'modules',
  ),
  'components' =>
  array (
    0 => 'ship-stat',
    1 => 'module-card',
    2 => 'capacity-meter',
    3 => 'upgrade-form',
  ),
  'responsive' => 'Ship systems stack into full-width modules',
  'page_title' => 'Mothership Modules',
  'layout_family' => 'ship',
  'sub_design' =>
  array (
    'primary_panel' => 'Mothership hull and modules',
    'visual_system' => 'ship-blueprint',
    'interaction_model' => 'capacity, prerequisite, and queue validation',
    'sections' =>
    array (
      0 => 'hull',
      1 => 'weapons',
      2 => 'hangars',
      3 => 'modules',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'ship-stat',
      1 => 'module-card',
      2 => 'capacity-meter',
      3 => 'upgrade-form',
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

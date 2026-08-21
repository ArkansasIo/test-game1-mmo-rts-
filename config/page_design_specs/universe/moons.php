<?php
return array (
  'template' => 'moon-registry',
  'sections' =>
  array (
    0 => 'moon identity',
    1 => 'sensor',
    2 => 'jump gate',
    3 => 'orbit',
    4 => 'assignment',
  ),
  'components' =>
  array (
    0 => 'moon-card',
    1 => 'sensor-meter',
    2 => 'gate-upgrade',
    3 => 'orbit-badge',
  ),
  'responsive' => 'Moon cards stack on mobile',
  'page_title' => 'Moon Registry',
  'layout_family' => 'moons',
  'sub_design' =>
  array (
    'primary_panel' => 'Moon registry and gate status',
    'visual_system' => 'orbital-table',
    'interaction_model' => 'parent-colony ownership and gate upgrade',
    'sections' =>
    array (
      0 => 'moon identity',
      1 => 'sensor',
      2 => 'jump gate',
      3 => 'orbit',
      4 => 'assignment',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'moon-card',
      1 => 'sensor-meter',
      2 => 'gate-upgrade',
      3 => 'orbit-badge',
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

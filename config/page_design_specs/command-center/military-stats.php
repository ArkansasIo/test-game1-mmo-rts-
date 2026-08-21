<?php
return array (
  'template' => 'military-statistics',
  'sections' =>
  array (
    0 => 'power totals',
    1 => 'unit breakdown',
    2 => 'technology modifiers',
    3 => 'readiness',
    4 => 'DefCon',
  ),
  'components' =>
  array (
    0 => 'power-metric',
    1 => 'modifier-table',
    2 => 'defcon-selector',
    3 => 'readiness-bar',
  ),
  'responsive' => 'Stat grid reduces from four columns to one',
  'page_title' => 'Military Statistics',
  'layout_family' => 'stats',
  'sub_design' =>
  array (
    'primary_panel' => 'Military readiness and posture',
    'visual_system' => 'power-metrics',
    'interaction_model' => 'read and DefCon mutation',
    'sections' =>
    array (
      0 => 'power totals',
      1 => 'unit breakdown',
      2 => 'technology modifiers',
      3 => 'readiness',
      4 => 'DefCon',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'power-metric',
      1 => 'modifier-table',
      2 => 'defcon-selector',
      3 => 'readiness-bar',
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
  ),
);

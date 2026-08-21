<?php
return array (
  'template' => 'upgrade-card',
  'sections' =>
  array (
    0 => 'current level',
    1 => 'next cost',
    2 => 'modifier preview',
    3 => 'confirmation',
  ),
  'components' =>
  array (
    0 => 'level-card',
    1 => 'cost-table',
    2 => 'effect-preview',
    3 => 'queue-badge',
  ),
  'responsive' => 'Upgrade card becomes full-width',
  'page_title' => 'Unit Production',
  'layout_family' => 'upgrade',
  'sub_design' =>
  array (
    'primary_panel' => 'Production upgrade tracks',
    'visual_system' => 'upgrade-track',
    'interaction_model' => 'prerequisite and queue validation',
    'sections' =>
    array (
      0 => 'current level',
      1 => 'next cost',
      2 => 'modifier preview',
      3 => 'confirmation',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'level-card',
      1 => 'cost-table',
      2 => 'effect-preview',
      3 => 'queue-badge',
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

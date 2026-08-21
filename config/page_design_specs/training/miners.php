<?php
return array (
  'template' => 'training-board',
  'sections' =>
  array (
    0 => 'unit pool',
    1 => 'training controls',
    2 => 'cost preview',
    3 => 'queue/result',
  ),
  'components' =>
  array (
    0 => 'unit-card',
    1 => 'quantity-input',
    2 => 'cost-preview',
    3 => 'queue-row',
  ),
  'responsive' => 'Training cards stack with full-width controls',
  'page_title' => 'Miners & Lifers',
  'layout_family' => 'training',
  'sub_design' =>
  array (
    'primary_panel' => 'Population training and readiness',
    'visual_system' => 'queue-roster',
    'interaction_model' => 'validate workforce then queue',
    'sections' =>
    array (
      0 => 'unit pool',
      1 => 'training controls',
      2 => 'cost preview',
      3 => 'queue/result',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'unit-card',
      1 => 'quantity-input',
      2 => 'cost-preview',
      3 => 'queue-row',
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

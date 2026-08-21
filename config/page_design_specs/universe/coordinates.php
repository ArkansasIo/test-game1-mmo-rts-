<?php
return array (
  'template' => 'coordinate-search',
  'sections' =>
  array (
    0 => 'input',
    1 => 'galaxy',
    2 => 'sector',
    3 => 'system',
    4 => 'planet/moon',
  ),
  'components' =>
  array (
    0 => 'coordinate-form',
    1 => 'result-path',
    2 => 'coordinate-badge',
    3 => 'detail-link',
  ),
  'responsive' => 'Result path wraps into vertical steps',
  'page_title' => 'Coordinate Search',
  'layout_family' => 'coordinates',
  'sub_design' =>
  array (
    'primary_panel' => 'Validated coordinate navigation',
    'visual_system' => 'coordinate-path',
    'interaction_model' => 'tuple parsing and scoped result',
    'sections' =>
    array (
      0 => 'input',
      1 => 'galaxy',
      2 => 'sector',
      3 => 'system',
      4 => 'planet/moon',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'coordinate-form',
      1 => 'result-path',
      2 => 'coordinate-badge',
      3 => 'detail-link',
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

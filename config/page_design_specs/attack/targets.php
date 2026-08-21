<?php
return array (
  'template' => 'target-board',
  'sections' =>
  array (
    0 => 'filters',
    1 => 'target rows',
    2 => 'protection',
    3 => 'combat preview',
    4 => 'operation controls',
  ),
  'components' =>
  array (
    0 => 'target-table',
    1 => 'protection-badge',
    2 => 'cost-preview',
    3 => 'operation-buttons',
  ),
  'responsive' => 'Target table becomes stacked target rows',
  'page_title' => 'Target Selection',
  'layout_family' => 'targets',
  'sub_design' =>
  array (
    'primary_panel' => 'Known realm target board',
    'visual_system' => 'sortable-target-table',
    'interaction_model' => 'preview then validated operation',
    'sections' =>
    array (
      0 => 'filters',
      1 => 'target rows',
      2 => 'protection',
      3 => 'combat preview',
      4 => 'operation controls',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'target-table',
      1 => 'protection-badge',
      2 => 'cost-preview',
      3 => 'operation-buttons',
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

<?php
return array (
  'template' => 'report-list',
  'sections' =>
  array (
    0 => 'unread summary',
    1 => 'report table',
    2 => 'detail view',
    3 => 'read state',
  ),
  'components' =>
  array (
    0 => 'report-row',
    1 => 'classification-badge',
    2 => 'detail-panel',
    3 => 'mark-read-button',
  ),
  'responsive' => 'Report rows become expandable cards',
  'page_title' => 'Attack Log & Reports',
  'layout_family' => 'reports',
  'sub_design' =>
  array (
    'primary_panel' => 'Classified report feed',
    'visual_system' => 'report-list',
    'interaction_model' => 'ownership-gated read state',
    'sections' =>
    array (
      0 => 'unread summary',
      1 => 'report table',
      2 => 'detail view',
      3 => 'read state',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'report-row',
      1 => 'classification-badge',
      2 => 'detail-panel',
      3 => 'mark-read-button',
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

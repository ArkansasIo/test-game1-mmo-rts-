<?php
return array (
  'template' => 'account-details',
  'sections' =>
  array (
    0 => 'profile',
    1 => 'faction identity',
    2 => 'progression',
    3 => 'protection',
    4 => 'security',
  ),
  'components' =>
  array (
    0 => 'profile-metric',
    1 => 'modifier-row',
    2 => 'security-badge',
  ),
  'responsive' => 'Two-column details collapse to one column',
  'page_title' => 'Account Information',
  'layout_family' => 'details',
  'sub_design' =>
  array (
    'primary_panel' => 'Identity and status dossier',
    'visual_system' => 'detail-table',
    'interaction_model' => 'read-only inspection',
    'sections' =>
    array (
      0 => 'profile',
      1 => 'faction identity',
      2 => 'progression',
      3 => 'protection',
      4 => 'security',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'profile-metric',
      1 => 'modifier-row',
      2 => 'security-badge',
      3 => 'state-banner',
      4 => 'action-form',
      5 => 'feedback-region',
      6 => 'audit-trail',
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

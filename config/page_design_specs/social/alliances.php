<?php
return array (
  'template' => 'social-command',
  'sections' =>
  array (
    0 => 'alliance',
    1 => 'members',
    2 => 'diplomacy',
    3 => 'activity',
  ),
  'components' =>
  array (
    0 => 'member-table',
    1 => 'role-badge',
    2 => 'proposal-form',
    3 => 'activity-feed',
  ),
  'responsive' => 'Member table becomes stacked rows',
  'page_title' => 'Alliances',
  'layout_family' => 'social',
  'sub_design' =>
  array (
    'primary_panel' => 'Social and diplomacy workspace',
    'visual_system' => 'relationship-panel',
    'interaction_model' => 'role-gated social mutation',
    'sections' =>
    array (
      0 => 'alliance',
      1 => 'members',
      2 => 'diplomacy',
      3 => 'activity',
      4 => 'status',
      5 => 'controls',
      6 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'member-table',
      1 => 'role-badge',
      2 => 'proposal-form',
      3 => 'activity-feed',
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

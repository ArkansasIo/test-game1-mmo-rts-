<?php
return array (
  'template' => 'account-settings',
  'sections' =>
  array (
    0 => 'race selector',
    1 => 'government selector',
    2 => 'vacation',
    3 => 'protection',
    4 => 'security',
  ),
  'components' =>
  array (
    0 => 'faction-selector',
    1 => 'modifier-preview',
    2 => 'vacation-toggle',
    3 => 'security-panel',
  ),
  'responsive' => 'Settings sections stack on mobile',
  'page_title' => 'Vacation Mode',
  'layout_family' => 'account',
  'sub_design' =>
  array (
    'primary_panel' => 'Commander account controls',
    'visual_system' => 'account-form',
    'interaction_model' => 'eligibility and cooldown validation',
    'sections' =>
    array (
      0 => 'race selector',
      1 => 'government selector',
      2 => 'vacation',
      3 => 'protection',
      4 => 'security',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'faction-selector',
      1 => 'modifier-preview',
      2 => 'vacation-toggle',
      3 => 'security-panel',
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

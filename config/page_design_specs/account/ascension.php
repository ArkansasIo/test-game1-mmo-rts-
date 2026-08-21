<?php
return array (
  'template' => 'progression-panel',
  'sections' =>
  array (
    0 => 'requirements',
    1 => 'tier and level',
    2 => 'Glory/Reputation',
    3 => 'ascension preview',
    4 => 'history',
  ),
  'components' =>
  array (
    0 => 'progress-bar',
    1 => 'tier-badge',
    2 => 'requirement-list',
    3 => 'ascension-preview',
  ),
  'responsive' => 'Progression metrics stack on mobile',
  'page_title' => 'Ascension',
  'layout_family' => 'progression',
  'sub_design' =>
  array (
    'primary_panel' => 'Tier and level progression',
    'visual_system' => 'progression-ladder',
    'interaction_model' => 'requirement check then atomic transition',
    'sections' =>
    array (
      0 => 'requirements',
      1 => 'tier and level',
      2 => 'Glory/Reputation',
      3 => 'ascension preview',
      4 => 'history',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'progress-bar',
      1 => 'tier-badge',
      2 => 'requirement-list',
      3 => 'ascension-preview',
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

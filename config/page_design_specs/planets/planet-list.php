<?php
return array (
  'template' => 'colony-grid',
  'sections' =>
  array (
    0 => 'planet selector',
    1 => 'population',
    2 => 'biome',
    3 => 'life support',
    4 => 'defenses',
  ),
  'components' =>
  array (
    0 => 'planet-card',
    1 => 'biome-badge',
    2 => 'life-support-meter',
    3 => 'defense-table',
  ),
  'responsive' => 'Planet cards use one column on mobile',
  'page_title' => 'Planet List',
  'layout_family' => 'planets',
  'sub_design' =>
  array (
    'primary_panel' => 'Colony portfolio and life support',
    'visual_system' => 'colony-grid',
    'interaction_model' => 'ownership, habitability, and defense',
    'sections' =>
    array (
      0 => 'planet selector',
      1 => 'population',
      2 => 'biome',
      3 => 'life support',
      4 => 'defenses',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'planet-card',
      1 => 'biome-badge',
      2 => 'life-support-meter',
      3 => 'defense-table',
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

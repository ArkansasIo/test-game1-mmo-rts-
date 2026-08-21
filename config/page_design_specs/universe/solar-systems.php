<?php
return array (
  'template' => 'solar-system-map',
  'sections' =>
  array (
    0 => 'star',
    1 => 'orbits',
    2 => 'planet slots',
    3 => 'anomaly',
  ),
  'components' =>
  array (
    0 => 'orbit-list',
    1 => 'planet-slot',
    2 => 'star-badge',
    3 => 'scan-control',
  ),
  'responsive' => 'Orbit list becomes stacked planets',
  'page_title' => 'Solar Systems',
  'layout_family' => 'solar-systems',
  'sub_design' =>
  array (
    'primary_panel' => 'Solar system orbit map',
    'visual_system' => 'orbit-map',
    'interaction_model' => 'coordinate, gate, and fleet authority',
    'sections' =>
    array (
      0 => 'star',
      1 => 'orbits',
      2 => 'planet slots',
      3 => 'anomaly',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'orbit-list',
      1 => 'planet-slot',
      2 => 'star-badge',
      3 => 'scan-control',
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

<?php
return array (
  'template' => 'universe-planet',
  'sections' =>
  array (
    0 => 'planet identity',
    1 => 'biome',
    2 => 'habitability',
    3 => 'resources',
    4 => 'colony status',
  ),
  'components' =>
  array (
    0 => 'planet-detail',
    1 => 'biome-card',
    2 => 'habitability-meter',
    3 => 'colonize-form',
  ),
  'responsive' => 'Planet details stack vertically',
  'page_title' => 'Universe Planets',
  'layout_family' => 'universe-planets',
  'sub_design' =>
  array (
    'primary_panel' => 'Universe planet catalogue',
    'visual_system' => 'planet-catalogue',
    'interaction_model' => 'inspection and colonization eligibility',
    'sections' =>
    array (
      0 => 'planet identity',
      1 => 'biome',
      2 => 'habitability',
      3 => 'resources',
      4 => 'colony status',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'planet-detail',
      1 => 'biome-card',
      2 => 'habitability-meter',
      3 => 'colonize-form',
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

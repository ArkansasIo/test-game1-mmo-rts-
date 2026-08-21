<?php
return array (
  'template' => 'weapon-repair',
  'sections' =>
  array (
    0 => 'damaged items',
    1 => 'cost preview',
    2 => 'confirmation',
    3 => 'result',
  ),
  'components' =>
  array (
    0 => 'durability-meter',
    1 => 'repair-cost',
    2 => 'confirmation-panel',
    3 => 'result-banner',
  ),
  'responsive' => 'Repair cards stack on mobile',
  'page_title' => 'Weapon Repair',
  'layout_family' => 'repair',
  'sub_design' =>
  array (
    'primary_panel' => 'Durability repair queue',
    'visual_system' => 'repair-queue',
    'interaction_model' => 'estimate then queue repair',
    'sections' =>
    array (
      0 => 'damaged items',
      1 => 'cost preview',
      2 => 'confirmation',
      3 => 'result',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'durability-meter',
      1 => 'repair-cost',
      2 => 'confirmation-panel',
      3 => 'result-banner',
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

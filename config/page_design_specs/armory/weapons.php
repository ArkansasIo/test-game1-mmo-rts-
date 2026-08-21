<?php
return array (
  'template' => 'armory-inventory',
  'sections' =>
  array (
    0 => 'catalogue',
    1 => 'inventory',
    2 => 'durability',
    3 => 'assignment',
  ),
  'components' =>
  array (
    0 => 'weapon-card',
    1 => 'durability-meter',
    2 => 'purchase-form',
    3 => 'assignment-badge',
  ),
  'responsive' => 'Weapon cards wrap into a single-column inventory',
  'page_title' => 'Weapon Inventory',
  'layout_family' => 'inventory',
  'sub_design' =>
  array (
    'primary_panel' => 'Weapon inventory and loadout',
    'visual_system' => 'inventory-table',
    'interaction_model' => 'purchase and durability inspection',
    'sections' =>
    array (
      0 => 'catalogue',
      1 => 'inventory',
      2 => 'durability',
      3 => 'assignment',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'weapon-card',
      1 => 'durability-meter',
      2 => 'purchase-form',
      3 => 'assignment-badge',
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

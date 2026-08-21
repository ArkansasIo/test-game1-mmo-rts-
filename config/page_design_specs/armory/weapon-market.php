<?php
return array (
  'template' => 'market-exchange',
  'sections' =>
  array (
    0 => 'orders',
    1 => 'price history',
    2 => 'order form',
    3 => 'settlement',
  ),
  'components' =>
  array (
    0 => 'order-table',
    1 => 'price-badge',
    2 => 'order-form',
    3 => 'settlement-banner',
  ),
  'responsive' => 'Market tables scroll or stack into order cards',
  'page_title' => 'Weapon Market',
  'layout_family' => 'market',
  'sub_design' =>
  array (
    'primary_panel' => 'Escrowed market order book',
    'visual_system' => 'order-book',
    'interaction_model' => 'list, lock, settle',
    'sections' =>
    array (
      0 => 'orders',
      1 => 'price history',
      2 => 'order form',
      3 => 'settlement',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'order-table',
      1 => 'price-badge',
      2 => 'order-form',
      3 => 'settlement-banner',
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

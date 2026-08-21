<?php
return array (
  'template' => 'resource-vault',
  'sections' =>
  array (
    0 => 'balance cards',
    1 => 'resource ledger',
    2 => 'transfer controls',
    3 => 'server contract',
    4 => 'feedback states',
  ),
  'components' =>
  array (
    0 => 'resource-card',
    1 => 'transfer-form',
    2 => 'balance-row',
    3 => 'validation-banner',
  ),
  'responsive' => 'Resource cards flow from four columns to one column',
  'page_title' => 'Resources & Vault',
  'layout_family' => 'economy',
  'sub_design' =>
  array (
    'primary_panel' => 'Resource balance and vault',
    'visual_system' => 'resource-grid',
    'interaction_model' => 'validated deposit and withdrawal',
    'sections' =>
    array (
      0 => 'balance cards',
      1 => 'resource ledger',
      2 => 'transfer controls',
      3 => 'server contract',
      4 => 'feedback states',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'resource-card',
      1 => 'transfer-form',
      2 => 'balance-row',
      3 => 'validation-banner',
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

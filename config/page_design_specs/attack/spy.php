<?php
return array (
  'template' => 'covert-operations',
  'sections' =>
  array (
    0 => 'agent allocation',
    1 => 'detection meter',
    2 => 'target intelligence',
    3 => 'mission result',
  ),
  'components' =>
  array (
    0 => 'mission-selector',
    1 => 'agent-input',
    2 => 'detection-meter',
    3 => 'report-panel',
  ),
  'responsive' => 'Mission controls and reports stack vertically',
  'page_title' => 'Spy Operations',
  'layout_family' => 'covert',
  'sub_design' =>
  array (
    'primary_panel' => 'Covert mission console',
    'visual_system' => 'mission-console',
    'interaction_model' => 'agent allocation and detection preview',
    'sections' =>
    array (
      0 => 'agent allocation',
      1 => 'detection meter',
      2 => 'target intelligence',
      3 => 'mission result',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'mission-selector',
      1 => 'agent-input',
      2 => 'detection-meter',
      3 => 'report-panel',
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

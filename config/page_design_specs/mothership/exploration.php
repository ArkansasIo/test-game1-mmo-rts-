<?php
return array (
  'template' => 'exploration-board',
  'sections' =>
  array (
    0 => 'range',
    1 => 'system scan',
    2 => 'anomaly',
    3 => 'rewards',
  ),
  'components' =>
  array (
    0 => 'scan-form',
    1 => 'risk-meter',
    2 => 'discovery-card',
    3 => 'mission-status',
  ),
  'responsive' => 'Exploration panels stack vertically',
  'page_title' => 'Exploration',
  'layout_family' => 'exploration',
  'sub_design' =>
  array (
    'primary_panel' => 'Mothership expedition control',
    'visual_system' => 'expedition-board',
    'interaction_model' => 'readiness, distance, anomaly, reward',
    'sections' =>
    array (
      0 => 'range',
      1 => 'system scan',
      2 => 'anomaly',
      3 => 'rewards',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'scan-form',
      1 => 'risk-meter',
      2 => 'discovery-card',
      3 => 'mission-status',
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

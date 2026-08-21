<?php
return array (
  'template' => 'ranking-table',
  'sections' =>
  array (
    0 => 'filters',
    1 => 'leaderboard',
    2 => 'score breakdown',
    3 => 'snapshots',
  ),
  'components' =>
  array (
    0 => 'ranking-table',
    1 => 'score-badge',
    2 => 'filter-tabs',
    3 => 'snapshot-selector',
  ),
  'responsive' => 'Leaderboard columns collapse into ranked cards',
  'page_title' => 'Rankings',
  'layout_family' => 'rankings',
  'sub_design' =>
  array (
    'primary_panel' => 'Commander ranking ladder',
    'visual_system' => 'ranking-table',
    'interaction_model' => 'read snapshot and refresh',
    'sections' =>
    array (
      0 => 'filters',
      1 => 'leaderboard',
      2 => 'score breakdown',
      3 => 'snapshots',
      4 => 'status',
      5 => 'controls',
      6 => 'activity',
      7 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'ranking-table',
      1 => 'score-badge',
      2 => 'filter-tabs',
      3 => 'snapshot-selector',
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

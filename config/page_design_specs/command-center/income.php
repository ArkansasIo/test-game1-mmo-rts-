<?php
return array (
  'template' => 'income-breakdown',
  'sections' =>
  array (
    0 => 'formula',
    1 => 'modifier table',
    2 => 'colony production',
    3 => 'upkeep',
    4 => 'feedback states',
  ),
  'components' =>
  array (
    0 => 'formula-block',
    1 => 'modifier-row',
    2 => 'forecast-metric',
    3 => 'comparison-table',
  ),
  'responsive' => 'Formula and comparison sections stack on small screens',
  'page_title' => 'Income Breakdown',
  'layout_family' => 'breakdown',
  'sub_design' =>
  array (
    'primary_panel' => 'Income formula and colony comparison',
    'visual_system' => 'formula-panel',
    'interaction_model' => 'read-only calculation',
    'sections' =>
    array (
      0 => 'formula',
      1 => 'modifier table',
      2 => 'colony production',
      3 => 'upkeep',
      4 => 'feedback states',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'formula-block',
      1 => 'modifier-row',
      2 => 'forecast-metric',
      3 => 'comparison-table',
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
  ),
);

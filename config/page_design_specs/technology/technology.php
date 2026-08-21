<?php
return array (
  'template' => 'technology-tree',
  'sections' =>
  array (
    0 => 'branch tabs',
    1 => 'technology cards',
    2 => 'prerequisites',
    3 => 'cost',
    4 => 'queue',
  ),
  'components' =>
  array (
    0 => 'tech-card',
    1 => 'branch-tabs',
    2 => 'prerequisite-list',
    3 => 'research-queue',
  ),
  'responsive' => 'Branch tabs scroll and cards stack',
  'page_title' => 'Technology Tree',
  'layout_family' => 'technology',
  'sub_design' =>
  array (
    'primary_panel' => 'Technology research branches',
    'visual_system' => 'tech-tree',
    'interaction_model' => 'prerequisite and research queue',
    'sections' =>
    array (
      0 => 'branch tabs',
      1 => 'technology cards',
      2 => 'prerequisites',
      3 => 'cost',
      4 => 'queue',
      5 => 'status',
      6 => 'controls',
      7 => 'activity',
      8 => 'technical-details',
    ),
    'components' =>
    array (
      0 => 'tech-card',
      1 => 'branch-tabs',
      2 => 'prerequisite-list',
      3 => 'research-queue',
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

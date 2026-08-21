<?php
return array (
  'page_title' => 'Enemy Intelligence',
  0 => 'unread count',
  1 => 'battle outcomes',
  2 => 'spy payloads',
  3 => 'classified report view',
  4 => 'mark read',
  5 => 'report filters',
  'feature_matrix' =>
  array (
    'core' =>
    array (
      0 => 'state snapshot',
      1 => 'permission-aware rendering',
      2 => 'feedback-state rendering',
    ),
    'controls' =>
    array (
      0 => 'Open intelligence report',
    ),
    'actions' =>
    array (
    ),
    'data_sources' =>
    array (
      0 => 'intelligence_reports',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_owned_reports',
    1 => 'classify_payload',
    2 => 'mark_report_read',
    3 => 'audit_report_access',
  ),
  'acceptance_criteria' =>
  array (
    0 => 'unauthorized input rejected',
    1 => 'negative quantities rejected',
    2 => 'empty state handled',
    3 => 'success refreshes state',
    4 => 'database mutation is transactional',
  ),
);

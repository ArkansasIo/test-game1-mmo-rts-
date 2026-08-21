<?php
return array (
  'page_title' => 'Messages',
  0 => 'inbox',
  1 => 'unread count',
  2 => 'compose',
  3 => 'mark read',
  4 => 'blacklist',
  5 => 'notifications',
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
      0 => 'Send',
      1 => 'Mark read',
      2 => 'Blacklist',
    ),
    'actions' =>
    array (
      0 => 'message',
      1 => 'message_read',
    ),
    'data_sources' =>
    array (
      0 => 'messages',
      1 => 'blacklists',
    ),
  ),
  'sub_features' =>
  array (
    0 => 'load_page_state',
    1 => 'validate_page_scope',
    2 => 'calculate_page_metrics',
    3 => 'render_page_result',
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

<?php
return array (
  'primary_panel' => 'Secure commander messaging',
  'visual_system' => 'inbox-thread',
  'interaction_model' => 'recipient, blacklist, and read-state validation',
  'sections' =>
  array (
    0 => 'inbox',
    1 => 'compose',
    2 => 'read state',
    3 => 'blacklist',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'message-list',
    1 => 'compose-form',
    2 => 'unread-badge',
    3 => 'blacklist-control',
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
);

<?php
return array (
  'route' => 'messages',
  'group' => 'social',
  'group_label' => 'Social',
  'title' => 'Messages',
  'layout' => 'messages',
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
  'tables' => 
  array (
    0 => 'messages',
    1 => 'blacklists',
  ),
  'details' => 
  array (
    'hero' => 'Messages',
    'panels' => 
    array (
      0 => 'Inbox',
      1 => 'Unread count',
      2 => 'Compose message',
      3 => 'Blacklist and notifications',
    ),
    'formula' => 'message = validated sender + recipient + content policy + notification event',
    'controls' => 
    array (
      0 => 'Send',
      1 => 'Mark read',
      2 => 'Blacklist',
    ),
    'action' => 'message',
    'tables' => 
    array (
      0 => 'messages',
      1 => 'blacklists',
      2 => 'player_notifications',
    ),
    'permission' => 'authenticated commander',
    'states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'success',
      4 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Messages',
    'purpose' => 'Communicate and manage notifications.',
    'buttons' => 
    array (
      'Send' => 
      array (
        'action' => 'message',
        'logic' => 'Validate recipient, content, blacklist, and notification creation.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'players',
          1 => 'blacklists',
        ),
        'writes' => 
        array (
          0 => 'messages',
          1 => 'player_notifications',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Mark read' => 
      array (
        'action' => 'message_read',
        'logic' => 'Verify recipient and mark message read.',
        'permission' => 'message recipient',
        'reads' => 
        array (
          0 => 'messages',
        ),
        'writes' => 
        array (
          0 => 'messages',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'success',
          2 => 'error',
        ),
      ),
      'Blacklist' => 
      array (
        'action' => 'blacklist',
        'logic' => 'Verify target and upsert communication block.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'players',
          1 => 'blacklists',
        ),
        'writes' => 
        array (
          0 => 'blacklists',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'success',
          2 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Send, receive, read, and block commander messages.',
    'workflow' => 
    array (
      0 => 'load inbox',
      1 => 'validate sender and recipient',
      2 => 'apply content policy',
      3 => 'write message and notification',
      4 => 'update read or blacklist state',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'recipient exists',
      2 => 'blacklist policy',
      3 => 'message ownership',
    ),
    'calculations' => 
    array (
      0 => 'unread count',
    ),
    'mutations' => 
    array (
      0 => 'messages',
      1 => 'blacklists',
      2 => 'player_notifications',
    ),
  ),
  'features' => 
  array (
    0 => 'inbox',
    1 => 'unread count',
    2 => 'compose',
    3 => 'mark read',
    4 => 'blacklist',
    5 => 'notifications',
  ),
  'design' => 
  array (
    'template' => 'message-center',
    'sections' => 
    array (
      0 => 'inbox',
      1 => 'compose',
      2 => 'read state',
      3 => 'blacklist',
    ),
    'components' => 
    array (
      0 => 'message-list',
      1 => 'compose-form',
      2 => 'unread-badge',
      3 => 'blacklist-control',
    ),
    'responsive' => 'Message rows become conversation cards',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'MessageService',
      1 => 'NotificationService',
    ),
    'reads' => 
    array (
      0 => 'messages',
      1 => 'blacklists',
      2 => 'player_notifications',
      3 => 'players',
    ),
    'writes' => 
    array (
      0 => 'messages',
      1 => 'blacklists',
      2 => 'player_notifications',
    ),
    'actions' => 
    array (
      0 => 'message',
      1 => 'message_read',
      2 => 'blacklist',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/social/messages.php',
    'features' => 'config/page_features/social/messages.php',
    'design' => 'config/page_design_specs/social/messages.php',
    'systems' => 'config/page_systems/social/messages.php',
    'module' => 'includes/page_modules/social/messages.php',
  ),
);

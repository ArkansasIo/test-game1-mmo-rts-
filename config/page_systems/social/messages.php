<?php
return array (
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
);

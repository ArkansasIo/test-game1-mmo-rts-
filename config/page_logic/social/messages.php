<?php
return array (
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
);

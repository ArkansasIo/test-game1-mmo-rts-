<?php
return array (
  'purpose' => 'Show battle, spy, sabotage, and system reports only to authorized recipients.',
  'workflow' => 
  array (
    0 => 'load recipient reports',
    1 => 'classify payload',
    2 => 'filter read state',
    3 => 'open or mark report read',
    4 => 'write audit state',
  ),
  'validation' => 
  array (
    0 => 'authenticated report recipient',
    1 => 'recipient ownership',
    2 => 'classification access',
  ),
  'calculations' => 
  array (
    0 => 'recipient ownership + report classification + read status',
  ),
  'mutations' => 
  array (
    0 => 'messages',
    1 => 'game_audit_log',
  ),
);

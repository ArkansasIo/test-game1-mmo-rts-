<?php
return array (
  'purpose' => 'Increase unit production capacity and show next-level effects.',
  'workflow' => 
  array (
    0 => 'load current level',
    1 => 'calculate next cost',
    2 => 'validate resources',
    3 => 'queue upgrade',
    4 => 'apply completion effect',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'positive current level',
    2 => 'resource balance',
    3 => 'level cap',
  ),
  'calculations' => 
  array (
    0 => 'base cost × growth rate ^ current level',
  ),
  'mutations' => 
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'game_audit_log',
  ),
);

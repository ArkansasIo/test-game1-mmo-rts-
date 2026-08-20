<?php
return array (
  'purpose' => 'Aggregate military, defense, covert, anti-covert, readiness, and DefCon values.',
  'workflow' => 
  array (
    0 => 'load units and weapons',
    1 => 'load technology and faction modifiers',
    2 => 'calculate power totals',
    3 => 'read protection and DefCon',
    4 => 'render readiness',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'valid DefCon level for mutation',
  ),
  'calculations' => 
  array (
    0 => 'units × base power × technology × race × government × planet bonus',
    1 => 'readiness score',
    2 => 'DefCon effect',
  ),
  'mutations' => 
  array (
    0 => 'players',
    1 => 'game_audit_log',
  ),
);

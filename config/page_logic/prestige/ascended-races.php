<?php
return array (
  'purpose' => 'Track universal tier and level progression, Glory, Reputation, and ascension.',
  'workflow' => 
  array (
    0 => 'load progression state',
    1 => 'check thresholds',
    2 => 'calculate cost or eligibility',
    3 => 'advance or ascend transactionally',
    4 => 'write history',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'experience threshold',
    2 => 'tier and level cap',
    3 => 'resource or Glory cost',
  ),
  'calculations' => 
  array (
    0 => 'experience thresholds',
    1 => '21 tiers × 23 levels',
    2 => 'ascension eligibility',
  ),
  'mutations' => 
  array (
    0 => 'player_progression',
    1 => 'glory_reputation',
    2 => 'ascension_states',
    3 => 'ascensions',
    4 => 'game_audit_log',
  ),
);

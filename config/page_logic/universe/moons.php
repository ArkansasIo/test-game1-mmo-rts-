<?php
return array (
  'purpose' => 'Inspect moon class, sensor bonus, jump gate, and orbit relationship.',
  'workflow' => 
  array (
    0 => 'inspect moon',
    1 => 'load parent planet',
    2 => 'calculate utility',
    3 => 'validate jump-gate upgrade',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'moon access',
    2 => 'colony or mothership ownership',
  ),
  'calculations' => 
  array (
    0 => 'sensor bonus + jump-gate level + moon resource modifiers',
  ),
  'mutations' => 
  array (
    0 => 'universe_moons',
    1 => 'mothership_modules',
    2 => 'player_colonies',
  ),
);

<?php
return array (
  'purpose' => 'Convert available population into specialized personnel and units.',
  'workflow' => 
  array (
    0 => 'load population pool',
    1 => 'select unit category',
    2 => 'validate quantity',
    3 => 'deduct population and cost',
    4 => 'update unit stats',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'untrained population',
    2 => 'positive quantity',
    3 => 'resource balance',
  ),
  'calculations' => 
  array (
    0 => 'population conversion − training cost + production bonus',
  ),
  'mutations' => 
  array (
    0 => 'player_resources',
    1 => 'player_unit_stats',
    2 => 'game_events',
  ),
);

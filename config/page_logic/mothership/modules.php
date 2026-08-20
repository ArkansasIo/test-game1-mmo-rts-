<?php
return array (
  'purpose' => 'Command the mothership hull, hangars, shields, weapons, and modules.',
  'workflow' => 
  array (
    0 => 'load mothership',
    1 => 'select upgrade',
    2 => 'validate module prerequisite',
    3 => 'lock resources',
    4 => 'queue or apply upgrade',
  ),
  'validation' => 
  array (
    0 => 'mothership owner',
    1 => 'module prerequisite',
    2 => 'resource balance',
    3 => 'capacity cap',
  ),
  'calculations' => 
  array (
    0 => 'hull + modules + weapons + shields + fleet capacity',
  ),
  'mutations' => 
  array (
    0 => 'motherships',
    1 => 'mothership_modules',
    2 => 'player_resources',
    3 => 'construction_queue',
  ),
);

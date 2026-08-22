<?php
return array (
  'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
  'workflow' => 
  array (
    0 => 'load technology tree',
    1 => 'check prerequisites',
    2 => 'calculate cost',
    3 => 'queue research',
    4 => 'apply completed effect',
  ),
  'validation' => 
  array (
    0 => 'authenticated researcher',
    1 => 'prerequisites',
    2 => 'research queue',
    3 => 'resource balance',
    4 => 'level cap',
  ),
  'calculations' => 
  array (
    0 => 'base cost × growth ^ current level',
  ),
  'mutations' => 
  array (
    0 => 'player_technologies',
    1 => 'construction_queue',
    2 => 'player_resources',
  ),
);

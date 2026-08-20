<?php
return array (
  'purpose' => 'Select targets and preview combat, raid, covert, sabotage, and conquest operations.',
  'workflow' => 
  array (
    0 => 'load visible realms',
    1 => 'verify protection',
    2 => 'calculate operation cost',
    3 => 'compare forces',
    4 => 'submit chosen operation',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'attack turns',
    2 => 'target ownership scope',
    3 => 'protection rules',
    4 => 'fleet or unit availability',
  ),
  'calculations' => 
  array (
    0 => 'validated force comparison + technology + defense + deterministic resolver',
    1 => 'operation cost',
    2 => 'loot preview',
  ),
  'mutations' => 
  array (
    0 => 'battles',
    1 => 'battle_rounds',
    2 => 'battle_reports',
    3 => 'attack_logs',
    4 => 'player_resources',
  ),
);

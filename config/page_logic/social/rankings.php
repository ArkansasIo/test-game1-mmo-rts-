<?php
return array (
  'purpose' => 'Compare economy, military, covert, progression, and colony scores.',
  'workflow' => 
  array (
    0 => 'load ranking snapshot',
    1 => 'calculate or refresh scores',
    2 => 'filter leaderboard',
    3 => 'open public profile',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'public profile field policy',
  ),
  'calculations' => 
  array (
    0 => 'weighted economy + military + covert + progression + colony value',
  ),
  'mutations' => 
  array (
    0 => 'rankings',
    1 => 'rank_snapshots',
  ),
);

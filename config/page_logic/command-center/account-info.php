<?php
return array (
  'purpose' => 'Read commander identity, faction, rank, protection, and progression.',
  'workflow' => 
  array (
    0 => 'load commander',
    1 => 'load faction and government',
    2 => 'load rank and progression',
    3 => 'render read-only profile',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'ownership scope',
  ),
  'calculations' => 
  array (
    0 => 'combined faction modifier',
    1 => 'rank score',
  ),
  'mutations' => 
  array (
  ),
);

<?php
return array (
  'purpose' => 'Explain production settlement by colony, faction, government, technology, biome, and upkeep.',
  'workflow' => 
  array (
    0 => 'load colony production',
    1 => 'load modifiers',
    2 => 'calculate gross output',
    3 => 'calculate food water energy upkeep',
    4 => 'render net settlement',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'owned colony scope',
  ),
  'calculations' => 
  array (
    0 => 'base production × race modifier × government modifier × technology − upkeep',
    1 => 'colony comparison',
    2 => 'life-support efficiency',
  ),
  'mutations' => 
  array (
  ),
);

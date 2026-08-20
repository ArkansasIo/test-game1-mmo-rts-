<?php
return array (
  'purpose' => 'Inspect sector class, danger, resource modifiers, and anomaly rate.',
  'workflow' => 
  array (
    0 => 'select sector',
    1 => 'load systems',
    2 => 'calculate sector output',
    3 => 'filter by risk',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'valid sector identifier',
  ),
  'calculations' => 
  array (
    0 => 'base output × resource modifier; anomaly rate drives events',
  ),
  'mutations' => 
  array (
  ),
);

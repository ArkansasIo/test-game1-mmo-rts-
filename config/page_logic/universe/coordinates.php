<?php
return array (
  'purpose' => 'Validate and resolve galaxy:sector:system:orbit coordinates.',
  'workflow' => 
  array (
    0 => 'validate coordinate input',
    1 => 'find galaxy',
    2 => 'find sector',
    3 => 'find system',
    4 => 'find planet or moon',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'coordinate format',
    2 => 'coordinate bounds',
  ),
  'calculations' => 
  array (
    0 => 'coordinate = galaxy:sector:system:orbit',
  ),
  'mutations' => 
  array (
  ),
);

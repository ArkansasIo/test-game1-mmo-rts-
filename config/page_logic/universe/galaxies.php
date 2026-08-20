<?php
return array (
  'purpose' => 'Browse galaxy density, sector overview, and travel risk.',
  'workflow' => 
  array (
    0 => 'select galaxy',
    1 => 'load sectors',
    2 => 'calculate density and risk',
    3 => 'open sector',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'valid galaxy identifier',
  ),
  'calculations' => 
  array (
    0 => 'sector danger × system volatility × distance modifier',
  ),
  'mutations' => 
  array (
  ),
);

<?php
return array (
  'purpose' => 'Browse star class, orbit map, planet slots, and anomalies.',
  'workflow' => 
  array (
    0 => 'open system',
    1 => 'load orbit map',
    2 => 'scan anomaly',
    3 => 'calculate travel',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'valid system identifier',
    2 => 'exploration capacity',
  ),
  'calculations' => 
  array (
    0 => 'base travel × system modifier × sector danger',
  ),
  'mutations' => 
  array (
    0 => 'universe_discoveries',
    1 => 'game_events',
  ),
);

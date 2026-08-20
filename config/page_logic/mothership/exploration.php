<?php
return array (
  'purpose' => 'Explore systems, planets, moons, anomalies, and discovery rewards.',
  'workflow' => 
  array (
    0 => 'load sensor range',
    1 => 'validate mission capacity',
    2 => 'calculate travel risk',
    3 => 'resolve anomaly',
    4 => 'record discovery',
  ),
  'validation' => 
  array (
    0 => 'exploration-capable commander',
    1 => 'mothership readiness',
    2 => 'cooldown',
    3 => 'target visibility',
  ),
  'calculations' => 
  array (
    0 => 'exploration level + sensor bonus + anomaly rate − travel risk',
  ),
  'mutations' => 
  array (
    0 => 'universe_discoveries',
    1 => 'game_events',
  ),
);

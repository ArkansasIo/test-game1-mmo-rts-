<?php
return array (
  'purpose' => 'Coordinate colony, economy, queues, fleets, alerts, and turn settlement.',
  'workflow' => 
  array (
    0 => 'load authoritative state',
    1 => 'validate commander intent',
    2 => 'settle bounded turn window',
    3 => 'return refreshed state',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF token',
    2 => 'RBAC permission',
    3 => 'transaction boundary',
  ),
  'calculations' => 
  array (
    0 => 'resource settlement',
    1 => 'food and water upkeep',
    2 => 'queue completion',
    3 => 'fleet ETA',
  ),
  'mutations' => 
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'fleet_missions',
    3 => 'game_events',
    4 => 'rankings',
  ),
);

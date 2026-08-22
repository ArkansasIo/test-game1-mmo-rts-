<?php
return array (
  'purpose' => 'Inspect planet class, biome, habitability, resource modifiers, and colony status.',
  'workflow' => 
  array (
    0 => 'inspect planet',
    1 => 'load biome',
    2 => 'calculate viability',
    3 => 'validate colonization',
    4 => 'create colony',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'colonization access',
    2 => 'occupancy',
    3 => 'habitability',
    4 => 'resource balance',
  ),
  'calculations' => 
  array (
    0 => 'habitability × biome × race × government × life support',
  ),
  'mutations' => 
  array (
    0 => 'universe_planets',
    1 => 'player_colonies',
    2 => 'game_audit_log',
  ),
);

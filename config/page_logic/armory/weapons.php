<?php
return array (
  'purpose' => 'Manage owned weapons, quantities, durability, assignments, and effective power.',
  'workflow' => 
  array (
    0 => 'load catalogue',
    1 => 'validate purchase or inspection',
    2 => 'upsert inventory',
    3 => 'calculate durability-adjusted power',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'weapon ownership',
    2 => 'resource balance',
    3 => 'positive quantity',
  ),
  'calculations' => 
  array (
    0 => 'base power × durability × technology × race × government',
  ),
  'mutations' => 
  array (
    0 => 'player_weapons',
    1 => 'player_resources',
  ),
);

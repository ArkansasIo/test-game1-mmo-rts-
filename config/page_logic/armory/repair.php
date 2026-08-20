<?php
return array (
  'purpose' => 'Restore weapon durability using validated repair costs.',
  'workflow' => 
  array (
    0 => 'load damaged weapon',
    1 => 'calculate missing durability',
    2 => 'validate resources',
    3 => 'lock weapon',
    4 => 'restore durability transactionally',
  ),
  'validation' => 
  array (
    0 => 'weapon owner',
    1 => 'positive durability gap',
    2 => 'resource balance',
  ),
  'calculations' => 
  array (
    0 => 'missing durability × weapon tier × maintenance factor',
  ),
  'mutations' => 
  array (
    0 => 'player_weapons',
    1 => 'player_resources',
    2 => 'game_audit_log',
  ),
);

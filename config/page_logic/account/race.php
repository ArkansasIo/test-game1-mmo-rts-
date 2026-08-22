<?php
return array (
  'purpose' => 'Manage race, government, vacation, protection, and account security.',
  'workflow' => 
  array (
    0 => 'load faction options',
    1 => 'validate selection',
    2 => 'save faction history',
    3 => 'apply protection state',
    4 => 'render security controls',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'valid race and government',
    2 => 'vacation rules',
    3 => 'protection rules',
  ),
  'calculations' => 
  array (
    0 => 'race modifier × government modifier',
  ),
  'mutations' => 
  array (
    0 => 'players',
    1 => 'player_government_history',
    2 => 'vacation_states',
    3 => 'protection_states',
  ),
);

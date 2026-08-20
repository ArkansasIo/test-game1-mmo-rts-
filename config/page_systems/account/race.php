<?php
return array (
  'services' => 
  array (
    0 => 'AccountService',
    1 => 'ProtectionService',
  ),
  'reads' => 
  array (
    0 => 'players',
    1 => 'races',
    2 => 'government_types',
    3 => 'protection_states',
    4 => 'vacation_states',
  ),
  'writes' => 
  array (
    0 => 'players',
    1 => 'player_government_history',
    2 => 'vacation_states',
    3 => 'protection_states',
  ),
  'actions' => 
  array (
    0 => 'select_registration_faction',
    1 => 'change_race',
    2 => 'vacation',
  ),
);

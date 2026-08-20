<?php
return array (
  'services' => 
  array (
    0 => 'MilitaryService',
    1 => 'GameService',
  ),
  'reads' => 
  array (
    0 => 'player_resources',
    1 => 'player_unit_stats',
    2 => 'player_weapons',
    3 => 'technologies',
    4 => 'rankings',
    5 => 'protection_states',
  ),
  'writes' => 
  array (
    0 => 'players',
    1 => 'game_audit_log',
  ),
  'actions' => 
  array (
    0 => 'read_military_stats',
    1 => 'set_defcon',
  ),
);

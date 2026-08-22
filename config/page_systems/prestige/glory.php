<?php
return array (
  'services' => 
  array (
    0 => 'ProgressionService',
    1 => 'AscensionService',
  ),
  'reads' => 
  array (
    0 => 'player_progression',
    1 => 'glory_reputation',
    2 => 'rank_definitions',
    3 => 'ascension_states',
    4 => 'ascensions',
  ),
  'writes' => 
  array (
    0 => 'player_progression',
    1 => 'glory_reputation',
    2 => 'ascension_states',
    3 => 'ascensions',
    4 => 'game_audit_log',
  ),
  'actions' => 
  array (
    0 => 'progression_advance',
    1 => 'ascend',
  ),
);

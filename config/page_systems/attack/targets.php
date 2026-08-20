<?php
return array (
  'services' => 
  array (
    0 => 'CombatService',
    1 => 'CovertService',
    2 => 'TargetingService',
  ),
  'reads' => 
  array (
    0 => 'target_realms',
    1 => 'players',
    2 => 'rankings',
    3 => 'protection_states',
    4 => 'technologies',
  ),
  'writes' => 
  array (
    0 => 'battles',
    1 => 'battle_rounds',
    2 => 'battle_reports',
    3 => 'attack_logs',
    4 => 'player_resources',
  ),
  'actions' => 
  array (
    0 => 'combat',
    1 => 'combat:raid',
    2 => 'covert:spy',
    3 => 'covert:sabotage',
  ),
);

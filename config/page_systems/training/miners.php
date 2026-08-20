<?php
return array (
  'services' => 
  array (
    0 => 'TrainingService',
    1 => 'GameService',
  ),
  'reads' => 
  array (
    0 => 'player_resources',
    1 => 'player_unit_stats',
    2 => 'technologies',
  ),
  'writes' => 
  array (
    0 => 'player_resources',
    1 => 'player_unit_stats',
    2 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'train',
    1 => 'upgrade_up',
  ),
);

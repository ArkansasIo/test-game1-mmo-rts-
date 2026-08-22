<?php
return array (
  'services' => 
  array (
    0 => 'GameService',
    1 => 'DashboardService',
    2 => 'ProgressionService',
  ),
  'reads' => 
  array (
    0 => 'players',
    1 => 'player_resources',
    2 => 'player_colonies',
    3 => 'construction_queue',
    4 => 'fleet_missions',
    5 => 'rankings',
    6 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'fleet_missions',
    3 => 'rankings',
    4 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'process_turns',
    1 => 'choose_target',
    2 => 'review_reports',
    3 => 'progression_advance',
  ),
);

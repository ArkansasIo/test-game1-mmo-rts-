<?php
return array (
  'services' => 
  array (
    0 => 'TrainingService',
    1 => 'QueueService',
  ),
  'reads' => 
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'technologies',
  ),
  'writes' => 
  array (
    0 => 'player_resources',
    1 => 'construction_queue',
    2 => 'game_audit_log',
  ),
  'actions' => 
  array (
    0 => 'upgrade_up',
  ),
);

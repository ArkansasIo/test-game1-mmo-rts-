<?php
return array (
  'services' => 
  array (
    0 => 'MothershipService',
    1 => 'QueueService',
  ),
  'reads' => 
  array (
    0 => 'motherships',
    1 => 'mothership_modules',
    2 => 'player_resources',
    3 => 'construction_queue',
  ),
  'writes' => 
  array (
    0 => 'motherships',
    1 => 'mothership_modules',
    2 => 'player_resources',
    3 => 'construction_queue',
  ),
  'actions' => 
  array (
    0 => 'mothership_upgrade',
  ),
);

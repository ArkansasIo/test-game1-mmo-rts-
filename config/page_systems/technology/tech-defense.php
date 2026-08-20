<?php
return array (
  'services' => 
  array (
    0 => 'TechnologyService',
    1 => 'QueueService',
  ),
  'reads' => 
  array (
    0 => 'technologies',
    1 => 'technology_prerequisites',
    2 => 'player_technologies',
    3 => 'player_resources',
    4 => 'construction_queue',
  ),
  'writes' => 
  array (
    0 => 'player_technologies',
    1 => 'construction_queue',
    2 => 'player_resources',
  ),
  'actions' => 
  array (
    0 => 'technology',
  ),
);

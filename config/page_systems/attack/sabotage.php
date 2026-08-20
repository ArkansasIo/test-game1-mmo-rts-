<?php
return array (
  'services' => 
  array (
    0 => 'CovertService',
    1 => 'IntelligenceService',
  ),
  'reads' => 
  array (
    0 => 'covert_agents',
    1 => 'anti_covert_agents',
    2 => 'target_realms',
    3 => 'technologies',
  ),
  'writes' => 
  array (
    0 => 'covert_missions',
    1 => 'spy_missions',
    2 => 'sabotage_missions',
    3 => 'intelligence_reports',
    4 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'covert:recon',
    1 => 'covert:spy',
    2 => 'covert:sabotage',
  ),
);

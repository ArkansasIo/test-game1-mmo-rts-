<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'EspionageScanningService',
  ),
  'reads' => 
  array (
    0 => 'players',
    1 => 'target_realms',
    2 => 'player_resources',
    3 => 'covert_missions',
    4 => 'intelligence_reports',
    5 => 'espionage_events',
    6 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'players',
    1 => 'target_realms',
    2 => 'player_resources',
    3 => 'covert_missions',
    4 => 'intelligence_reports',
    5 => 'espionage_events',
    6 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'covert:recon',
    1 => 'covert:spy',
    2 => 'covert:sabotage',
    3 => 'refresh_page',
  ),
  'permissions' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF',
    2 => 'RBAC',
    3 => 'ownership scope',
    4 => 'cooldown validation',
  ),
);

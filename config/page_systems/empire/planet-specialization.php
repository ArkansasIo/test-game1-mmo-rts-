<?php
return array (
  'services' => 
  array (
    0 => 'GameService',
    1 => 'EconomyService',
  ),
  'reads' => 
  array (
    0 => 'player_resources',
    1 => 'game_settings',
  ),
  'writes' => 
  array (
    0 => 'player_resources',
    1 => 'game_audit_log',
  ),
  'actions' => 
  array (
    0 => 'deposit',
    1 => 'withdraw',
  ),
);

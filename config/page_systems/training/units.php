<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'PageService',
  ),
  'reads' => 
  array (
    0 => 'players',
    1 => 'player_resources',
    2 => 'game_events',
  ),
  'writes' => 
  array (
  ),
  'actions' => 
  array (
    0 => 'inspect_page',
    1 => 'refresh_page',
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

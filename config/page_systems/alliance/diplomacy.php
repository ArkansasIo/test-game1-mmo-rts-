<?php
declare(strict_types=1);
return array (
  'services' => 
  array (
    0 => 'PageService',
  ),
  'reads' => 
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'alliance_projects',
    3 => 'game_events',
  ),
  'writes' => 
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'alliance_projects',
    3 => 'game_events',
  ),
  'actions' => 
  array (
    0 => 'alliance_create',
    1 => 'alliance_join',
    2 => 'diplomacy_propose',
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

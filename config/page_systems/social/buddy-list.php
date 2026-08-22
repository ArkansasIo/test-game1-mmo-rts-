<?php
return array (
  'services' => 
  array (
    0 => 'AllianceService',
    1 => 'DiplomacyService',
    2 => 'NotificationService',
  ),
  'reads' => 
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'diplomacy_relations',
    3 => 'diplomacy_actions',
    4 => 'player_notifications',
  ),
  'writes' => 
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'diplomacy_relations',
    3 => 'diplomacy_actions',
    4 => 'player_notifications',
  ),
  'actions' => 
  array (
    0 => 'alliance_create',
    1 => 'alliance_join',
    2 => 'diplomacy_propose',
  ),
);

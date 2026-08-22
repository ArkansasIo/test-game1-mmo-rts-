<?php
return array (
  'purpose' => 'Create alliances, manage members, and coordinate diplomacy.',
  'workflow' => 
  array (
    0 => 'load alliance state',
    1 => 'validate role or invitation',
    2 => 'create membership or proposal',
    3 => 'notify participants',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'alliance role',
    2 => 'membership rules',
    3 => 'target ownership',
  ),
  'calculations' => 
  array (
    0 => 'relation proposal lifecycle',
  ),
  'mutations' => 
  array (
    0 => 'alliances',
    1 => 'alliance_members',
    2 => 'diplomacy_relations',
    3 => 'diplomacy_actions',
    4 => 'player_notifications',
  ),
);

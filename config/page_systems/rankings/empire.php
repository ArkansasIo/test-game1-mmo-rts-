<?php
return array (
  'services' => 
  array (
    0 => 'RankingService',
    1 => 'AccountService',
  ),
  'reads' => 
  array (
    0 => 'rankings',
    1 => 'rank_snapshots',
    2 => 'players',
    3 => 'player_resources',
  ),
  'writes' => 
  array (
    0 => 'rankings',
    1 => 'rank_snapshots',
  ),
  'actions' => 
  array (
    0 => 'refresh_rankings',
    1 => 'read_profile',
  ),
);

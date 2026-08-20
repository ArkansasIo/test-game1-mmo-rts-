<?php
return array (
  'group' => 'social',
  'label' => 'Social',
  'icon' => '♧',
  'parent_route' => 'social',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'rankings',
      'title' => 'Rankings',
      'layout' => 'rankings',
      'definition' => 'config/page_definitions/social/rankings.php',
      'actions' => 
      array (
        0 => 'refresh_rankings',
      ),
      'tables' => 
      array (
        0 => 'rankings',
        1 => 'rank_snapshots',
      ),
    ),
    1 => 
    array (
      'route' => 'alliances',
      'title' => 'Alliances',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/alliances.php',
      'actions' => 
      array (
        0 => 'alliance_create',
        1 => 'alliance_join',
      ),
      'tables' => 
      array (
        0 => 'alliances',
        1 => 'alliance_members',
      ),
    ),
    2 => 
    array (
      'route' => 'messages',
      'title' => 'Messages',
      'layout' => 'messages',
      'definition' => 'config/page_definitions/social/messages.php',
      'actions' => 
      array (
        0 => 'message',
        1 => 'message_read',
      ),
      'tables' => 
      array (
        0 => 'messages',
        1 => 'blacklists',
      ),
    ),
  ),
);

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
    3 => 
    array (
      'route' => 'social-messages',
      'title' => 'Messages',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/social-messages.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    4 => 
    array (
      'route' => 'notifications',
      'title' => 'Notifications',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/notifications.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    5 => 
    array (
      'route' => 'global-chat',
      'title' => 'Global Chat',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/global-chat.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    6 => 
    array (
      'route' => 'buddy-list',
      'title' => 'Buddy List',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/buddy-list.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    7 => 
    array (
      'route' => 'recruitment',
      'title' => 'Recruitment',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/recruitment.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
    8 => 
    array (
      'route' => 'empires-at-war',
      'title' => 'Empires at War',
      'layout' => 'social',
      'definition' => 'config/page_definitions/social/empires-at-war.php',
      'actions' => 
      array (
      ),
      'tables' => 
      array (
        0 => 'game_events',
      ),
    ),
  ),
);

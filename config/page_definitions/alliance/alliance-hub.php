<?php
return array (
  'route' => 'alliance-hub',
  'group' => 'alliance',
  'group_label' => 'Alliance',
  'title' => 'Alliance Hub',
  'layout' => 'social',
  'controls' => 
  array (
    0 => 'Open overview',
    1 => 'Review status',
  ),
  'actions' => 
  array (
  ),
  'tables' => 
  array (
    0 => 'game_events',
  ),
  'details' => 
  array (
    'hero' => 'Alliances and Diplomacy',
    'panels' => 
    array (
      0 => 'Alliance identity',
      1 => 'Members and roles',
      2 => 'Diplomacy proposals',
      3 => 'Shared activity',
    ),
    'formula' => 'relation lifecycle = proposal → permission check → acceptance → active status',
    'controls' => 
    array (
      0 => 'Create alliance',
      1 => 'Join alliance',
      2 => 'Leave alliance',
      3 => 'Propose diplomacy',
    ),
    'action' => 'alliance_join',
    'tables' => 
    array (
      0 => 'alliances',
      1 => 'alliance_members',
      2 => 'diplomacy_relations',
      3 => 'diplomacy_actions',
      4 => 'player_notifications',
    ),
    'permission' => 'authenticated commander with social access',
    'states' => 
    array (
      0 => 'ready',
      1 => 'protected',
      2 => 'success',
      3 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Alliances and Diplomacy',
    'purpose' => 'Coordinate with other commanders.',
    'buttons' => 
    array (
      'Create alliance' => 
      array (
        'action' => 'alliance_create',
        'logic' => 'Validate name, ownership, and creator role, then create alliance and membership.',
        'permission' => 'commander without alliance',
        'reads' => 
        array (
          0 => 'players',
          1 => 'alliances',
        ),
        'writes' => 
        array (
          0 => 'alliances',
          1 => 'alliance_members',
          2 => 'game_audit_log',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'conflict',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Join alliance' => 
      array (
        'action' => 'alliance_join',
        'logic' => 'Validate invitation or open membership and create membership.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'alliances',
          1 => 'alliance_members',
        ),
        'writes' => 
        array (
          0 => 'alliance_members',
          1 => 'player_notifications',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'Propose diplomacy' => 
      array (
        'action' => 'diplomacy_propose',
        'logic' => 'Create relation proposal between two players in the current world.',
        'permission' => 'alliance or commander role',
        'reads' => 
        array (
          0 => 'game_worlds',
          1 => 'players',
          2 => 'diplomacy_relations',
        ),
        'writes' => 
        array (
          0 => 'diplomacy_relations',
          1 => 'diplomacy_actions',
          2 => 'player_notifications',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'conflict',
          2 => 'success',
          3 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
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
  ),
  'features' => 
  array (
    0 => 'alliance identity',
    1 => 'member roles',
    2 => 'join and leave',
    3 => 'diplomacy proposals',
    4 => 'shared activity',
  ),
  'design' => 
  array (
    'template' => 'social-command',
    'sections' => 
    array (
      0 => 'alliance',
      1 => 'members',
      2 => 'diplomacy',
      3 => 'activity',
    ),
    'components' => 
    array (
      0 => 'member-table',
      1 => 'role-badge',
      2 => 'proposal-form',
      3 => 'activity-feed',
    ),
    'responsive' => 'Member table becomes stacked rows',
  ),
  'systems' => 
  array (
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
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/alliance/alliance-hub.php',
    'features' => 'config/page_features/alliance/alliance-hub.php',
    'design' => 'config/page_design_specs/alliance/alliance-hub.php',
    'systems' => 'config/page_systems/alliance/alliance-hub.php',
    'module' => 'includes/page_modules/alliance/alliance-hub.php',
  ),
);

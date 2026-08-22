<?php
declare(strict_types=1);
return array (
  'dashboard' => 
  array (
    'route' => 'dashboard',
    'group' => 'command-center',
    'title' => 'Command Center',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Process turns',
      1 => 'Choose target',
      2 => 'Review reports',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Process Turns',
        'action' => 'process_turns',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'process_turns',
    ),
    'database_tables' => 
    array (
      0 => 'players',
      1 => 'player_resources',
      2 => 'rankings',
      3 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'dashboard',
  ),
  'account-info' => 
  array (
    'route' => 'account-info',
    'group' => 'command-center',
    'title' => 'Account Information',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'View profile',
      1 => 'View rank',
      2 => 'View protection',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'players',
      1 => 'races',
      2 => 'rankings',
      3 => 'glory_reputation',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'details',
  ),
  'resources' => 
  array (
    'route' => 'resources',
    'group' => 'command-center',
    'title' => 'Resources & Vault',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Deposit',
      1 => 'Withdraw',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Deposit',
        'action' => 'deposit',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Withdraw',
        'action' => 'withdraw',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'deposit',
      1 => 'withdraw',
    ),
    'database_tables' => 
    array (
      0 => 'player_resources',
      1 => 'game_settings',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'income' => 
  array (
    'route' => 'income',
    'group' => 'command-center',
    'title' => 'Income Breakdown',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'View income formula',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'player_resources',
      1 => 'races',
      2 => 'player_planets',
      3 => 'game_settings',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'breakdown',
  ),
  'military-stats' => 
  array (
    'route' => 'military-stats',
    'group' => 'command-center',
    'title' => 'Military Statistics',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'View attack',
      1 => 'View defense',
      2 => 'View covert',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'player_resources',
      1 => 'player_unit_stats',
      2 => 'rankings',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'stats',
  ),
  'targets' => 
  array (
    'route' => 'targets',
    'group' => 'attack',
    'title' => 'Target Selection',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Attack',
      1 => 'Raid',
      2 => 'Spy',
      3 => 'Sabotage',
      4 => 'Conquer Planet',
      5 => 'Message',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Combat',
        'action' => 'combat',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Covert',
        'action' => 'covert',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      2 => 
      array (
        'label' => 'Explore',
        'action' => 'explore',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      3 => 
      array (
        'label' => 'Message',
        'action' => 'message',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'combat',
      1 => 'covert',
      2 => 'explore',
      3 => 'message',
    ),
    'database_tables' => 
    array (
      0 => 'target_realms',
      1 => 'players',
      2 => 'battles',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'targets',
  ),
  'spy' => 
  array (
    'route' => 'spy',
    'group' => 'attack',
    'title' => 'Spy Operations',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Run reconnaissance',
      1 => 'Run spy mission',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Covert',
        'action' => 'covert',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'covert',
    ),
    'database_tables' => 
    array (
      0 => 'covert_missions',
      1 => 'spy_missions',
      2 => 'intelligence_reports',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'covert',
  ),
  'sabotage' => 
  array (
    'route' => 'sabotage',
    'group' => 'attack',
    'title' => 'Sabotage Operations',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Choose system',
      1 => 'Run sabotage',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Covert',
        'action' => 'covert',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'covert',
    ),
    'database_tables' => 
    array (
      0 => 'covert_missions',
      1 => 'sabotage_missions',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'covert',
  ),
  'attack-log' => 
  array (
    'route' => 'attack-log',
    'group' => 'attack',
    'title' => 'Attack Log & Reports',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open report',
      1 => 'Mark read',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Message Read',
        'action' => 'message_read',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'message_read',
    ),
    'database_tables' => 
    array (
      0 => 'battles',
      1 => 'battle_reports',
      2 => 'attack_logs',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'reports',
  ),
  'weapons' => 
  array (
    'route' => 'weapons',
    'group' => 'armory',
    'title' => 'Weapon Inventory',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Buy weapon',
      1 => 'Inspect durability',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Weapon Buy',
        'action' => 'weapon_buy',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'weapon_buy',
    ),
    'database_tables' => 
    array (
      0 => 'weapon_types',
      1 => 'player_weapons',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'inventory',
  ),
  'weapon-market' => 
  array (
    'route' => 'weapon-market',
    'group' => 'armory',
    'title' => 'Weapon Market',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'List order',
      1 => 'Buy order',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Market List',
        'action' => 'market_list',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Market Buy',
        'action' => 'market_buy',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'market_list',
      1 => 'market_buy',
    ),
    'database_tables' => 
    array (
      0 => 'market_orders',
      1 => 'weapon_types',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'repair' => 
  array (
    'route' => 'repair',
    'group' => 'armory',
    'title' => 'Weapon Repair',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Repair weapon',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Weapon Repair',
        'action' => 'weapon_repair',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'weapon_repair',
    ),
    'database_tables' => 
    array (
      0 => 'player_weapons',
      1 => 'player_resources',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'repair',
  ),
  'units' => 
  array (
    'route' => 'units',
    'group' => 'training',
    'title' => 'Unit Training',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Train units',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Train',
        'action' => 'train',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Upgrade Up',
        'action' => 'upgrade_up',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'train',
      1 => 'upgrade_up',
    ),
    'database_tables' => 
    array (
      0 => 'unit_types',
      1 => 'player_unit_stats',
      2 => 'training_queues',
      3 => 'player_resources',
      4 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'training',
  ),
  'miners' => 
  array (
    'route' => 'miners',
    'group' => 'training',
    'title' => 'Miners & Lifers',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Train miners',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Train',
        'action' => 'train',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'train',
    ),
    'database_tables' => 
    array (
      0 => 'player_resources',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'training',
  ),
  'super-units' => 
  array (
    'route' => 'super-units',
    'group' => 'training',
    'title' => 'Super Units',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Train elite units',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Train',
        'action' => 'train',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'train',
    ),
    'database_tables' => 
    array (
      0 => 'player_resources',
      1 => 'technologies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'training',
  ),
  'unit-production' => 
  array (
    'route' => 'unit-production',
    'group' => 'training',
    'title' => 'Unit Production',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade UP',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Upgrade Up',
        'action' => 'upgrade_up',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'upgrade_up',
    ),
    'database_tables' => 
    array (
      0 => 'unit_types',
      1 => 'player_unit_stats',
      2 => 'training_queues',
      3 => 'player_resources',
      4 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'upgrade',
  ),
  'technology' => 
  array (
    'route' => 'technology',
    'group' => 'technology',
    'title' => 'Technology Tree',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade offense',
      1 => 'Upgrade defense',
      2 => 'Upgrade covert',
      3 => 'Upgrade anti-covert',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Technology',
        'action' => 'technology',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'technology',
    ),
    'database_tables' => 
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'tech-offense' => 
  array (
    'route' => 'tech-offense',
    'group' => 'technology',
    'title' => 'Offense Technology',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Technology',
        'action' => 'technology',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'technology',
    ),
    'database_tables' => 
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'tech-defense' => 
  array (
    'route' => 'tech-defense',
    'group' => 'technology',
    'title' => 'Defense Technology',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Technology',
        'action' => 'technology',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'technology',
    ),
    'database_tables' => 
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'tech-covert' => 
  array (
    'route' => 'tech-covert',
    'group' => 'technology',
    'title' => 'Covert Technology',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Technology',
        'action' => 'technology',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'technology',
    ),
    'database_tables' => 
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'tech-anti-covert' => 
  array (
    'route' => 'tech-anti-covert',
    'group' => 'technology',
    'title' => 'Anti-Covert Technology',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Technology',
        'action' => 'technology',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'technology',
    ),
    'database_tables' => 
    array (
      0 => 'technologies',
      1 => 'player_technologies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'spy-log' => 
  array (
    'route' => 'spy-log',
    'group' => 'intelligence',
    'title' => 'Spy Log',
    'purpose' => 'Run reconnaissance, espionage, counter-espionage, sabotage, and sensor operations.',
    'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
    'functions' => 
    array (
      0 => 'scan target',
      1 => 'estimate detection',
      2 => 'run covert mission',
      3 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'covert pool',
      1 => 'target profile',
      2 => 'detection forecast',
      3 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'low-risk scan',
      1 => 'spy mission',
      2 => 'sabotage',
      3 => 'sensor phalanx',
      4 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open report',
      1 => 'Mark read',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Message Read',
        'action' => 'message_read',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'message_read',
    ),
    'database_tables' => 
    array (
      0 => 'covert_missions',
      1 => 'intelligence_reports',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'reports',
  ),
  'enemy-intelligence' => 
  array (
    'route' => 'enemy-intelligence',
    'group' => 'intelligence',
    'title' => 'Enemy Intelligence',
    'purpose' => 'Run reconnaissance, espionage, counter-espionage, sabotage, and sensor operations.',
    'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
    'functions' => 
    array (
      0 => 'scan target',
      1 => 'estimate detection',
      2 => 'run covert mission',
      3 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'covert pool',
      1 => 'target profile',
      2 => 'detection forecast',
      3 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'low-risk scan',
      1 => 'spy mission',
      2 => 'sabotage',
      3 => 'sensor phalanx',
      4 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open intelligence report',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'intelligence_reports',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'reports',
  ),
  'intelligence-espionage' => 
  array (
    'route' => 'intelligence-espionage',
    'group' => 'intelligence',
    'title' => 'Espionage',
    'purpose' => 'Espionage is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'intelligence result = sensor power + covert skill − target counter-intelligence',
    'functions' => 
    array (
      0 => 'open Espionage state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'target profile',
      1 => 'detection estimate',
      2 => 'classified output',
      3 => 'mission history',
      4 => 'covert pool',
      5 => 'detection forecast',
      6 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'spy-missions' => 
  array (
    'route' => 'spy-missions',
    'group' => 'intelligence',
    'title' => 'Spy Missions',
    'purpose' => 'Spy Missions is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
    'functions' => 
    array (
      0 => 'open Spy Missions state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'covert pool',
      1 => 'target profile',
      2 => 'detection forecast',
      3 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'counter-espionage' => 
  array (
    'route' => 'counter-espionage',
    'group' => 'intelligence',
    'title' => 'Counter-Espionage',
    'purpose' => 'Counter-Espionage is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
    'functions' => 
    array (
      0 => 'open Counter-Espionage state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'covert pool',
      1 => 'target profile',
      2 => 'detection forecast',
      3 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'intelligence-sabotage' => 
  array (
    'route' => 'intelligence-sabotage',
    'group' => 'intelligence',
    'title' => 'Sabotage',
    'purpose' => 'Sabotage is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'intelligence result = sensor power + covert skill − target counter-intelligence',
    'functions' => 
    array (
      0 => 'open Sabotage state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'target profile',
      1 => 'detection estimate',
      2 => 'classified output',
      3 => 'mission history',
      4 => 'covert pool',
      5 => 'detection forecast',
      6 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'reconnaissance' => 
  array (
    'route' => 'reconnaissance',
    'group' => 'intelligence',
    'title' => 'Reconnaissance',
    'purpose' => 'Reconnaissance is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
    'functions' => 
    array (
      0 => 'open Reconnaissance state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'covert pool',
      1 => 'target profile',
      2 => 'detection forecast',
      3 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'sensor-phalanx' => 
  array (
    'route' => 'sensor-phalanx',
    'group' => 'intelligence',
    'title' => 'Sensor Phalanx',
    'purpose' => 'Sensor Phalanx is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'detection = defender counter-intelligence − attacker agents − covert technology',
    'functions' => 
    array (
      0 => 'open Sensor Phalanx state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'covert pool',
      1 => 'target profile',
      2 => 'detection forecast',
      3 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'fleet-activity' => 
  array (
    'route' => 'fleet-activity',
    'group' => 'intelligence',
    'title' => 'Fleet Activity',
    'purpose' => 'Fleet Activity is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'fleet mission = validated composition + route distance + propulsion + fuel + cooldown',
    'functions' => 
    array (
      0 => 'open Fleet Activity state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'formation editor',
      2 => 'mission route',
      3 => 'arrival forecast',
      4 => 'covert pool',
      5 => 'target profile',
      6 => 'detection forecast',
      7 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'intelligence-reports' => 
  array (
    'route' => 'intelligence-reports',
    'group' => 'intelligence',
    'title' => 'Intelligence Reports',
    'purpose' => 'Intelligence Reports is the intelligence subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'intelligence result = sensor power + covert skill − target counter-intelligence',
    'functions' => 
    array (
      0 => 'open Intelligence Reports state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'scan target',
      5 => 'estimate detection',
      6 => 'run covert mission',
      7 => 'read classified report',
    ),
    'features' => 
    array (
      0 => 'target profile',
      1 => 'detection estimate',
      2 => 'classified output',
      3 => 'mission history',
      4 => 'covert pool',
      5 => 'detection forecast',
      6 => 'report classification',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'low-risk scan',
      5 => 'spy mission',
      6 => 'sabotage',
      7 => 'sensor phalanx',
      8 => 'fleet activity',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'resource-exchange' => 
  array (
    'route' => 'resource-exchange',
    'group' => 'market',
    'title' => 'Resource Exchange',
    'purpose' => 'Resource Exchange is the market subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'resource state = authenticated balance + production − upkeep − queued cost',
    'functions' => 
    array (
      0 => 'open Resource Exchange state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'balance tiles',
      1 => 'production history',
      2 => 'consumption forecast',
      3 => 'deficit warning',
      4 => 'page overview',
      5 => 'control panel',
      6 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'List order',
      1 => 'Buy order',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Market List',
        'action' => 'market_list',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Market Buy',
        'action' => 'market_buy',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'market_list',
      1 => 'market_buy',
    ),
    'database_tables' => 
    array (
      0 => 'market_orders',
      1 => 'player_resources',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'mercenary-market' => 
  array (
    'route' => 'mercenary-market',
    'group' => 'market',
    'title' => 'Mercenary Market',
    'purpose' => 'Mercenary Market is the market subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'trade settlement = validated order × price − fee − escrow state',
    'functions' => 
    array (
      0 => 'open Mercenary Market state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price bands',
      2 => 'escrow state',
      3 => 'trade history',
      4 => 'page overview',
      5 => 'control panel',
      6 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Recruit',
      1 => 'Sell',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Mercenary Buy',
        'action' => 'mercenary_buy',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'mercenary_buy',
    ),
    'database_tables' => 
    array (
      0 => 'mercenary_types',
      1 => 'player_mercenaries',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'rankings' => 
  array (
    'route' => 'rankings',
    'group' => 'social',
    'title' => 'Rankings',
    'purpose' => 'Rankings is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'functions' => 
    array (
      0 => 'open Rankings state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'leaderboard',
      1 => 'score breakdown',
      2 => 'movement indicator',
      3 => 'season snapshot',
      4 => 'page overview',
      5 => 'control panel',
      6 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Refresh rankings',
      1 => 'Open player',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Refresh Rankings',
        'action' => 'refresh_rankings',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'refresh_rankings',
    ),
    'database_tables' => 
    array (
      0 => 'rankings',
      1 => 'rank_snapshots',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'alliances' => 
  array (
    'route' => 'alliances',
    'group' => 'social',
    'title' => 'Alliances',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Create alliance',
      1 => 'Join alliance',
      2 => 'Leave alliance',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Alliance Create',
        'action' => 'alliance_create',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Alliance Join',
        'action' => 'alliance_join',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'alliance_create',
      1 => 'alliance_join',
    ),
    'database_tables' => 
    array (
      0 => 'alliances',
      1 => 'alliance_members',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'messages' => 
  array (
    'route' => 'messages',
    'group' => 'social',
    'title' => 'Messages',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Send',
      1 => 'Mark read',
      2 => 'Blacklist',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Message',
        'action' => 'message',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Message Read',
        'action' => 'message_read',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'message',
      1 => 'message_read',
    ),
    'database_tables' => 
    array (
      0 => 'messages',
      1 => 'blacklists',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'messages',
  ),
  'social-messages' => 
  array (
    'route' => 'social-messages',
    'group' => 'social',
    'title' => 'Messages',
    'purpose' => 'Messages is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Messages state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'notifications' => 
  array (
    'route' => 'notifications',
    'group' => 'social',
    'title' => 'Notifications',
    'purpose' => 'Notifications is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Notifications state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'global-chat' => 
  array (
    'route' => 'global-chat',
    'group' => 'social',
    'title' => 'Global Chat',
    'purpose' => 'Global Chat is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Global Chat state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'buddy-list' => 
  array (
    'route' => 'buddy-list',
    'group' => 'social',
    'title' => 'Buddy List',
    'purpose' => 'Buddy List is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Buddy List state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'recruitment' => 
  array (
    'route' => 'recruitment',
    'group' => 'social',
    'title' => 'Recruitment',
    'purpose' => 'Recruitment is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Recruitment state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'empires-at-war' => 
  array (
    'route' => 'empires-at-war',
    'group' => 'social',
    'title' => 'Empires at War',
    'purpose' => 'Empires at War is the social subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Empires at War state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'planet-list' => 
  array (
    'route' => 'planet-list',
    'group' => 'planets',
    'title' => 'Planet List',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Explore',
      1 => 'Colonize',
      2 => 'Upgrade defense',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Explore',
        'action' => 'explore',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Combat',
        'action' => 'combat',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      2 => 
      array (
        'label' => 'Colonize Planet',
        'action' => 'colonize_planet',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      3 => 
      array (
        'label' => 'Planet Defense',
        'action' => 'planet_defense',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'explore',
      1 => 'combat',
      2 => 'colonize_planet',
      3 => 'planet_defense',
    ),
    'database_tables' => 
    array (
      0 => 'player_colonies',
      1 => 'planet_bonuses',
      2 => 'planet_explorations',
      3 => 'player_resources',
      4 => 'universe_planets',
      5 => 'planet_defenses',
      6 => 'motherships',
      7 => 'player_cooldowns',
      8 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'planets',
  ),
  'settlement' => 
  array (
    'route' => 'settlement',
    'group' => 'planets',
    'title' => 'Settlement & Power Grid',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Queue build',
      1 => 'Demolish',
      2 => 'Process construction',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Settlement State',
        'action' => 'settlement_state',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Settlement Build',
        'action' => 'settlement_build',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      2 => 
      array (
        'label' => 'Settlement Demolish',
        'action' => 'settlement_demolish',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      3 => 
      array (
        'label' => 'Settlement Process',
        'action' => 'settlement_process',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'settlement_state',
      1 => 'settlement_build',
      2 => 'settlement_demolish',
      3 => 'settlement_process',
    ),
    'database_tables' => 
    array (
      0 => 'settlement_fields',
      1 => 'settlement_buildings',
      2 => 'settlement_construction_queues',
      3 => 'building_types',
      4 => 'player_resources',
      5 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'settlement',
  ),
  'planet-bonuses' => 
  array (
    'route' => 'planet-bonuses',
    'group' => 'planets',
    'title' => 'Planet Bonuses',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'View bonuses',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'planet_bonuses',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'planets',
  ),
  'planet-defenses' => 
  array (
    'route' => 'planet-defenses',
    'group' => 'planets',
    'title' => 'Planet Defenses',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade defense',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Planet Defense',
        'action' => 'planet_defense',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'planet_defense',
    ),
    'database_tables' => 
    array (
      0 => 'planet_defenses',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'planets',
  ),
  'ship' => 
  array (
    'route' => 'ship',
    'group' => 'mothership',
    'title' => 'Mothership',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade hull',
      1 => 'Upgrade hangars',
      2 => 'Upgrade shields',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Mothership Upgrade',
        'action' => 'mothership_upgrade',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'mothership_upgrade',
    ),
    'database_tables' => 
    array (
      0 => 'motherships',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'ship',
  ),
  'modules' => 
  array (
    'route' => 'modules',
    'group' => 'mothership',
    'title' => 'Mothership Modules',
    'purpose' => 'Mothership Modules is the mothership subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'open Mothership Modules state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect state',
      5 => 'review controls',
      6 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'loading',
      5 => 'ready',
      6 => 'empty',
      7 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Upgrade module',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Mothership Upgrade',
        'action' => 'mothership_upgrade',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'mothership_upgrade',
    ),
    'database_tables' => 
    array (
      0 => 'mothership_modules',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'ship',
  ),
  'exploration' => 
  array (
    'route' => 'exploration',
    'group' => 'mothership',
    'title' => 'Exploration',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Explore planet',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Explore',
        'action' => 'explore',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'explore',
    ),
    'database_tables' => 
    array (
      0 => 'motherships',
      1 => 'planet_explorations',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'exploration',
  ),
  'race' => 
  array (
    'route' => 'race',
    'group' => 'account',
    'title' => 'Race Selection',
    'purpose' => 'Manage commander profile, settings, support, security, and logout.',
    'mechanic' => 'account mutation = authenticated session + CSRF + policy permission + audit event',
    'functions' => 
    array (
      0 => 'read profile',
      1 => 'update preferences',
      2 => 'review security',
      3 => 'open support',
      4 => 'sign out',
    ),
    'features' => 
    array (
      0 => 'profile card',
      1 => 'theme selector',
      2 => 'security controls',
      3 => 'support channels',
    ),
    'sub_features' => 
    array (
      0 => 'density',
      1 => 'theme',
      2 => 'reduced motion',
      3 => 'session review',
      4 => 'logout',
    ),
    'controls' => 
    array (
      0 => 'Select race',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Change Race',
        'action' => 'change_race',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'change_race',
    ),
    'database_tables' => 
    array (
      0 => 'races',
      1 => 'players',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'account',
  ),
  'vacation' => 
  array (
    'route' => 'vacation',
    'group' => 'account',
    'title' => 'Vacation Mode',
    'purpose' => 'Manage commander profile, settings, support, security, and logout.',
    'mechanic' => 'account mutation = authenticated session + CSRF + policy permission + audit event',
    'functions' => 
    array (
      0 => 'read profile',
      1 => 'update preferences',
      2 => 'review security',
      3 => 'open support',
      4 => 'sign out',
    ),
    'features' => 
    array (
      0 => 'profile card',
      1 => 'theme selector',
      2 => 'security controls',
      3 => 'support channels',
    ),
    'sub_features' => 
    array (
      0 => 'density',
      1 => 'theme',
      2 => 'reduced motion',
      3 => 'session review',
      4 => 'logout',
    ),
    'controls' => 
    array (
      0 => 'Enable vacation',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Vacation',
        'action' => 'vacation',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'vacation',
    ),
    'database_tables' => 
    array (
      0 => 'vacation_states',
      1 => 'protection_states',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'account',
  ),
  'ascension' => 
  array (
    'route' => 'ascension',
    'group' => 'account',
    'title' => 'Ascension',
    'purpose' => 'Manage commander profile, settings, support, security, and logout.',
    'mechanic' => 'account mutation = authenticated session + CSRF + policy permission + audit event',
    'functions' => 
    array (
      0 => 'read profile',
      1 => 'update preferences',
      2 => 'review security',
      3 => 'open support',
      4 => 'sign out',
    ),
    'features' => 
    array (
      0 => 'profile card',
      1 => 'theme selector',
      2 => 'security controls',
      3 => 'support channels',
    ),
    'sub_features' => 
    array (
      0 => 'density',
      1 => 'theme',
      2 => 'reduced motion',
      3 => 'session review',
      4 => 'logout',
    ),
    'controls' => 
    array (
      0 => 'Check eligibility',
      1 => 'Ascend',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Ascend',
        'action' => 'ascend',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'ascend',
    ),
    'database_tables' => 
    array (
      0 => 'ascension_states',
      1 => 'ascensions',
      2 => 'glory_reputation',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'galaxies' => 
  array (
    'route' => 'galaxies',
    'group' => 'universe',
    'title' => 'Galaxy Map',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Select galaxy',
      1 => 'Open sector',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Universe Galaxies',
        'action' => 'universe_galaxies',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'universe_galaxies',
    ),
    'database_tables' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'target_realms',
      6 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'sectors' => 
  array (
    'route' => 'sectors',
    'group' => 'universe',
    'title' => 'Sector Map',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Select sector',
      1 => 'Open system',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Universe Sectors',
        'action' => 'universe_sectors',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'universe_sectors',
    ),
    'database_tables' => 
    array (
      0 => 'universe_sectors',
      1 => 'universe_solar_systems',
      2 => 'universe_planets',
      3 => 'motherships',
      4 => 'mothership_modules',
      5 => 'player_technologies',
      6 => 'player_cooldowns',
      7 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'sectors',
  ),
  'solar-systems' => 
  array (
    'route' => 'solar-systems',
    'group' => 'universe',
    'title' => 'Solar Systems',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Open system',
      1 => 'Scan system',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'System Map',
        'action' => 'system_map',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Explore',
        'action' => 'explore',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'system_map',
      1 => 'explore',
    ),
    'database_tables' => 
    array (
      0 => 'universe_solar_systems',
      1 => 'universe_planets',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'solar-systems',
  ),
  'universe-planets' => 
  array (
    'route' => 'universe-planets',
    'group' => 'universe',
    'title' => 'Universe Planets',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Inspect planet',
      1 => 'Colonize planet',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Planet Details',
        'action' => 'planet_details',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Colonize Planet',
        'action' => 'colonize_planet',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'planet_details',
      1 => 'colonize_planet',
    ),
    'database_tables' => 
    array (
      0 => 'universe_planets',
      1 => 'player_colonies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'universe-planets',
  ),
  'moons' => 
  array (
    'route' => 'moons',
    'group' => 'universe',
    'title' => 'Moon Registry',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Inspect moon',
      1 => 'Build jump gate',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Moon Details',
        'action' => 'moon_details',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
      1 => 
      array (
        'label' => 'Mothership Upgrade',
        'action' => 'mothership_upgrade',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'moon_details',
      1 => 'mothership_upgrade',
    ),
    'database_tables' => 
    array (
      0 => 'universe_moons',
      1 => 'universe_planets',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'moons',
  ),
  'coordinates' => 
  array (
    'route' => 'coordinates',
    'group' => 'universe',
    'title' => 'Coordinate Search',
    'purpose' => 'Authenticated game operations and server-verified state.',
    'mechanic' => 'state = authenticated read scope + validated intent + transaction result',
    'functions' => 
    array (
      0 => 'inspect state',
      1 => 'review controls',
      2 => 'open related system',
    ),
    'features' => 
    array (
      0 => 'page overview',
      1 => 'control panel',
      2 => 'server contract',
    ),
    'sub_features' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
    'controls' => 
    array (
      0 => 'Search coordinates',
      1 => 'Open system',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Coordinate Lookup',
        'action' => 'coordinate_lookup',
        'behavior' => 'Submit commander intent; server validates before mutation.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'coordinate_lookup',
    ),
    'database_tables' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
      2 => 'universe_solar_systems',
      3 => 'universe_planets',
      4 => 'universe_discoveries',
      5 => 'player_colonies',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Page overview',
      1 => 'Current state',
      2 => 'Controls and sub-controls',
      3 => 'Server contract',
      4 => 'Database scope',
      5 => 'Feedback states',
      6 => 'Related pages',
    ),
    'layout' => 'coordinates',
  ),
  'overview-dashboard' => 
  array (
    'route' => 'overview-dashboard',
    'group' => 'overview',
    'title' => 'Dashboard',
    'purpose' => 'Dashboard is the overview subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state summary = authenticated colony telemetry + queued operations + unread events',
    'functions' => 
    array (
      0 => 'open Dashboard state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'summarize commander state',
      5 => 'surface alerts',
      6 => 'track objectives',
      7 => 'open operational detail',
    ),
    'features' => 
    array (
      0 => 'live status strip',
      1 => 'priority alerts',
      2 => 'objective progress',
      3 => 'operation timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'filter by severity',
      5 => 'sort by completion',
      6 => 'acknowledge read-only alerts',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'dashboard',
  ),
  'empire-overview' => 
  array (
    'route' => 'empire-overview',
    'group' => 'overview',
    'title' => 'Empire Overview',
    'purpose' => 'Empire Overview is the overview subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state summary = authenticated colony telemetry + queued operations + unread events',
    'functions' => 
    array (
      0 => 'open Empire Overview state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'summarize commander state',
      5 => 'surface alerts',
      6 => 'track objectives',
      7 => 'open operational detail',
    ),
    'features' => 
    array (
      0 => 'live status strip',
      1 => 'priority alerts',
      2 => 'objective progress',
      3 => 'operation timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'filter by severity',
      5 => 'sort by completion',
      6 => 'acknowledge read-only alerts',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'dashboard',
  ),
  'active-operations' => 
  array (
    'route' => 'active-operations',
    'group' => 'overview',
    'title' => 'Active Operations',
    'purpose' => 'Active Operations is the overview subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state summary = authenticated colony telemetry + queued operations + unread events',
    'functions' => 
    array (
      0 => 'open Active Operations state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'summarize commander state',
      5 => 'surface alerts',
      6 => 'track objectives',
      7 => 'open operational detail',
    ),
    'features' => 
    array (
      0 => 'live status strip',
      1 => 'priority alerts',
      2 => 'objective progress',
      3 => 'operation timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'filter by severity',
      5 => 'sort by completion',
      6 => 'acknowledge read-only alerts',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'dashboard',
  ),
  'alerts' => 
  array (
    'route' => 'alerts',
    'group' => 'overview',
    'title' => 'Alerts',
    'purpose' => 'Alerts is the overview subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state summary = authenticated colony telemetry + queued operations + unread events',
    'functions' => 
    array (
      0 => 'open Alerts state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'summarize commander state',
      5 => 'surface alerts',
      6 => 'track objectives',
      7 => 'open operational detail',
    ),
    'features' => 
    array (
      0 => 'live status strip',
      1 => 'priority alerts',
      2 => 'objective progress',
      3 => 'operation timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'filter by severity',
      5 => 'sort by completion',
      6 => 'acknowledge read-only alerts',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'dashboard',
  ),
  'tutorial-objectives' => 
  array (
    'route' => 'tutorial-objectives',
    'group' => 'overview',
    'title' => 'Tutorial / Objectives',
    'purpose' => 'Tutorial / Objectives is the overview subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'state summary = authenticated colony telemetry + queued operations + unread events',
    'functions' => 
    array (
      0 => 'open Tutorial / Objectives state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'summarize commander state',
      5 => 'surface alerts',
      6 => 'track objectives',
      7 => 'open operational detail',
    ),
    'features' => 
    array (
      0 => 'live status strip',
      1 => 'priority alerts',
      2 => 'objective progress',
      3 => 'operation timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'filter by severity',
      5 => 'sort by completion',
      6 => 'acknowledge read-only alerts',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'dashboard',
  ),
  'planets' => 
  array (
    'route' => 'planets',
    'group' => 'empire',
    'title' => 'Planets',
    'purpose' => 'Planets is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Planets state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'colonies' => 
  array (
    'route' => 'colonies',
    'group' => 'empire',
    'title' => 'Colonies',
    'purpose' => 'Colonies is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Colonies state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'empire-moons' => 
  array (
    'route' => 'empire-moons',
    'group' => 'empire',
    'title' => 'Moons',
    'purpose' => 'Moons is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Moons state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'buildings' => 
  array (
    'route' => 'buildings',
    'group' => 'empire',
    'title' => 'Buildings',
    'purpose' => 'Buildings is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Buildings state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'facilities' => 
  array (
    'route' => 'facilities',
    'group' => 'empire',
    'title' => 'Facilities',
    'purpose' => 'Facilities is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Facilities state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'storage' => 
  array (
    'route' => 'storage',
    'group' => 'empire',
    'title' => 'Storage',
    'purpose' => 'Storage is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Storage state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'population' => 
  array (
    'route' => 'population',
    'group' => 'empire',
    'title' => 'Population',
    'purpose' => 'Population is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Population state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'planet-specialization' => 
  array (
    'route' => 'planet-specialization',
    'group' => 'empire',
    'title' => 'Planet Specialization',
    'purpose' => 'Planet Specialization is the empire subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'empire output = colony production × biome × race × government × morale',
    'functions' => 
    array (
      0 => 'open Planet Specialization state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect owned worlds',
      5 => 'compare colonies',
      6 => 'open settlement control',
      7 => 'review population capacity',
    ),
    'features' => 
    array (
      0 => 'colony roster',
      1 => 'life-support summary',
      2 => 'specialization profile',
      3 => 'capacity warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'world filters',
      5 => 'morale indicators',
      6 => 'ownership scope',
      7 => 'queue visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'resource-overview' => 
  array (
    'route' => 'resource-overview',
    'group' => 'resources',
    'title' => 'Resource Overview',
    'purpose' => 'Resource Overview is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'resource state = authenticated balance + production − upkeep − queued cost',
    'functions' => 
    array (
      0 => 'open Resource Overview state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'balance tiles',
      1 => 'production history',
      2 => 'consumption forecast',
      3 => 'deficit warning',
      4 => 'resource tiles',
      5 => 'income breakdown',
      6 => 'production forecast',
      7 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'metal' => 
  array (
    'route' => 'metal',
    'group' => 'resources',
    'title' => 'Metal',
    'purpose' => 'Metal is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'metal net = mines + income − construction − fleet upkeep',
    'functions' => 
    array (
      0 => 'open Metal state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'metal balance',
      1 => 'mine output',
      2 => 'construction demand',
      3 => 'turn forecast',
      4 => 'resource tiles',
      5 => 'income breakdown',
      6 => 'production forecast',
      7 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'crystal' => 
  array (
    'route' => 'crystal',
    'group' => 'resources',
    'title' => 'Crystal',
    'purpose' => 'Crystal is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'crystal net = crystal production + income − research − crafting demand',
    'functions' => 
    array (
      0 => 'open Crystal state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'crystal balance',
      1 => 'research demand',
      2 => 'crafting demand',
      3 => 'turn forecast',
      4 => 'resource tiles',
      5 => 'income breakdown',
      6 => 'production forecast',
      7 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'deuterium' => 
  array (
    'route' => 'deuterium',
    'group' => 'resources',
    'title' => 'Deuterium',
    'purpose' => 'Deuterium is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'deuterium net = refinery output + income − fuel − research − power demand',
    'functions' => 
    array (
      0 => 'open Deuterium state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'deuterium balance',
      1 => 'fuel demand',
      2 => 'research demand',
      3 => 'shortfall forecast',
      4 => 'resource tiles',
      5 => 'income breakdown',
      6 => 'production forecast',
      7 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'naquadah' => 
  array (
    'route' => 'naquadah',
    'group' => 'resources',
    'title' => 'Naquadah',
    'purpose' => 'Naquadah is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'net resource change = production + income − upkeep − queue costs',
    'functions' => 
    array (
      0 => 'open Naquadah state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'resource tiles',
      1 => 'income breakdown',
      2 => 'production forecast',
      3 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'energy' => 
  array (
    'route' => 'energy',
    'group' => 'resources',
    'title' => 'Energy',
    'purpose' => 'Energy is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'energy margin = generated power − colony load − fleet load − module draw',
    'functions' => 
    array (
      0 => 'open Energy state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'generation',
      1 => 'load graph',
      2 => 'brownout state',
      3 => 'power priorities',
      4 => 'resource tiles',
      5 => 'income breakdown',
      6 => 'production forecast',
      7 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'dark-matter' => 
  array (
    'route' => 'dark-matter',
    'group' => 'resources',
    'title' => 'Dark Matter',
    'purpose' => 'Dark Matter is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'net resource change = production + income − upkeep − queue costs',
    'functions' => 
    array (
      0 => 'open Dark Matter state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'resource tiles',
      1 => 'income breakdown',
      2 => 'production forecast',
      3 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'production' => 
  array (
    'route' => 'production',
    'group' => 'resources',
    'title' => 'Production',
    'purpose' => 'Production is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'net resource change = production + income − upkeep − queue costs',
    'functions' => 
    array (
      0 => 'open Production state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'resource tiles',
      1 => 'income breakdown',
      2 => 'production forecast',
      3 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'energy-grid' => 
  array (
    'route' => 'energy-grid',
    'group' => 'resources',
    'title' => 'Energy Grid',
    'purpose' => 'Energy Grid is the resources subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'energy margin = generated power − colony load − fleet load − module draw',
    'functions' => 
    array (
      0 => 'open Energy Grid state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read balances',
      5 => 'compare income',
      6 => 'inspect resource history',
      7 => 'review energy grid',
    ),
    'features' => 
    array (
      0 => 'generation',
      1 => 'load graph',
      2 => 'brownout state',
      3 => 'power priorities',
      4 => 'resource tiles',
      5 => 'income breakdown',
      6 => 'production forecast',
      7 => 'deficit warnings',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'per-turn view',
      5 => 'per-colony view',
      6 => 'resource filters',
      7 => 'shortfall states',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'economy',
  ),
  'construction-buildings' => 
  array (
    'route' => 'construction-buildings',
    'group' => 'construction',
    'title' => 'Buildings',
    'purpose' => 'Buildings is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'build eligibility = ownership + prerequisite + cost + field capacity + queue slot',
    'functions' => 
    array (
      0 => 'open Buildings state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'build catalogue',
      1 => 'level preview',
      2 => 'queue timeline',
      3 => 'field usage',
      4 => 'building catalogue',
      5 => 'prerequisite matrix',
      6 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'construction-facilities' => 
  array (
    'route' => 'construction-facilities',
    'group' => 'construction',
    'title' => 'Facilities',
    'purpose' => 'Facilities is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'build eligibility = ownership + prerequisite + cost + field capacity + queue slot',
    'functions' => 
    array (
      0 => 'open Facilities state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'build catalogue',
      1 => 'level preview',
      2 => 'queue timeline',
      3 => 'field usage',
      4 => 'building catalogue',
      5 => 'prerequisite matrix',
      6 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'construction-queue' => 
  array (
    'route' => 'construction-queue',
    'group' => 'construction',
    'title' => 'Construction Queue',
    'purpose' => 'Construction Queue is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'build eligibility = ownership + prerequisite + cost + field capacity + queue slot',
    'functions' => 
    array (
      0 => 'open Construction Queue state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'build catalogue',
      1 => 'level preview',
      2 => 'queue timeline',
      3 => 'field usage',
      4 => 'building catalogue',
      5 => 'prerequisite matrix',
      6 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'shipyard' => 
  array (
    'route' => 'shipyard',
    'group' => 'construction',
    'title' => 'Shipyard',
    'purpose' => 'Shipyard is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ship production = blueprint cost + yard capacity + queue availability + resource balance',
    'functions' => 
    array (
      0 => 'open Shipyard state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'ship catalogue',
      1 => 'yard queue',
      2 => 'hull preview',
      3 => 'fuel profile',
      4 => 'building catalogue',
      5 => 'queue timeline',
      6 => 'prerequisite matrix',
      7 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'defense' => 
  array (
    'route' => 'defense',
    'group' => 'construction',
    'title' => 'Defense',
    'purpose' => 'Defense is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'queue eligibility = ownership + prerequisite + resource balance + queue capacity + cooldown',
    'functions' => 
    array (
      0 => 'open Defense state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'building catalogue',
      1 => 'queue timeline',
      2 => 'prerequisite matrix',
      3 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'robotics' => 
  array (
    'route' => 'robotics',
    'group' => 'construction',
    'title' => 'Robotics',
    'purpose' => 'Robotics is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'queue eligibility = ownership + prerequisite + resource balance + queue capacity + cooldown',
    'functions' => 
    array (
      0 => 'open Robotics state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'building catalogue',
      1 => 'queue timeline',
      2 => 'prerequisite matrix',
      3 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'nanite-factory' => 
  array (
    'route' => 'nanite-factory',
    'group' => 'construction',
    'title' => 'Nanite Factory',
    'purpose' => 'Nanite Factory is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'queue eligibility = ownership + prerequisite + resource balance + queue capacity + cooldown',
    'functions' => 
    array (
      0 => 'open Nanite Factory state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'building catalogue',
      1 => 'queue timeline',
      2 => 'prerequisite matrix',
      3 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'terraformer' => 
  array (
    'route' => 'terraformer',
    'group' => 'construction',
    'title' => 'Terraformer',
    'purpose' => 'Terraformer is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'queue eligibility = ownership + prerequisite + resource balance + queue capacity + cooldown',
    'functions' => 
    array (
      0 => 'open Terraformer state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'building catalogue',
      1 => 'queue timeline',
      2 => 'prerequisite matrix',
      3 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'space-dock' => 
  array (
    'route' => 'space-dock',
    'group' => 'construction',
    'title' => 'Space Dock',
    'purpose' => 'Space Dock is the construction subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'queue eligibility = ownership + prerequisite + resource balance + queue capacity + cooldown',
    'functions' => 
    array (
      0 => 'open Space Dock state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect catalogue',
      5 => 'calculate cost',
      6 => 'queue construction',
      7 => 'review completion',
    ),
    'features' => 
    array (
      0 => 'building catalogue',
      1 => 'queue timeline',
      2 => 'prerequisite matrix',
      3 => 'power impact',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'level preview',
      5 => 'cancel policy',
      6 => 'field placement',
      7 => 'capacity validation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'facilities',
  ),
  'research-technology' => 
  array (
    'route' => 'research-technology',
    'group' => 'research',
    'title' => 'Technology',
    'purpose' => 'Technology is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation',
    'functions' => 
    array (
      0 => 'open Technology state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'technology tree',
      1 => 'prerequisite graph',
      2 => 'research queue',
      3 => 'effect preview',
      4 => 'branch tree',
      5 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'advanced-research' => 
  array (
    'route' => 'advanced-research',
    'group' => 'research',
    'title' => 'Advanced Research',
    'purpose' => 'Advanced Research is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation',
    'functions' => 
    array (
      0 => 'open Advanced Research state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'technology tree',
      1 => 'prerequisite graph',
      2 => 'research queue',
      3 => 'effect preview',
      4 => 'branch tree',
      5 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'combat' => 
  array (
    'route' => 'combat',
    'group' => 'research',
    'title' => 'Combat',
    'purpose' => 'Combat is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'functions' => 
    array (
      0 => 'open Combat state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'branch tree',
      1 => 'research queue',
      2 => 'effect preview',
      3 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'propulsion' => 
  array (
    'route' => 'propulsion',
    'group' => 'research',
    'title' => 'Propulsion',
    'purpose' => 'Propulsion is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'functions' => 
    array (
      0 => 'open Propulsion state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'branch tree',
      1 => 'research queue',
      2 => 'effect preview',
      3 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'espionage' => 
  array (
    'route' => 'espionage',
    'group' => 'research',
    'title' => 'Espionage',
    'purpose' => 'Espionage is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'functions' => 
    array (
      0 => 'open Espionage state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'branch tree',
      1 => 'research queue',
      2 => 'effect preview',
      3 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'astrophysics' => 
  array (
    'route' => 'astrophysics',
    'group' => 'research',
    'title' => 'Astrophysics',
    'purpose' => 'Astrophysics is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'functions' => 
    array (
      0 => 'open Astrophysics state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'branch tree',
      1 => 'research queue',
      2 => 'effect preview',
      3 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'stargate-technology' => 
  array (
    'route' => 'stargate-technology',
    'group' => 'research',
    'title' => 'Stargate Technology',
    'purpose' => 'Stargate Technology is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'functions' => 
    array (
      0 => 'open Stargate Technology state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'branch tree',
      1 => 'research queue',
      2 => 'effect preview',
      3 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'mothership-technology' => 
  array (
    'route' => 'mothership-technology',
    'group' => 'research',
    'title' => 'Mothership Technology',
    'purpose' => 'Mothership Technology is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'functions' => 
    array (
      0 => 'open Mothership Technology state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'branch tree',
      1 => 'research queue',
      2 => 'effect preview',
      3 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'lifeform-research' => 
  array (
    'route' => 'lifeform-research',
    'group' => 'research',
    'title' => 'Lifeform Research',
    'purpose' => 'Lifeform Research is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation',
    'functions' => 
    array (
      0 => 'open Lifeform Research state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'technology tree',
      1 => 'prerequisite graph',
      2 => 'research queue',
      3 => 'effect preview',
      4 => 'branch tree',
      5 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'ascension-research' => 
  array (
    'route' => 'ascension-research',
    'group' => 'research',
    'title' => 'Ascension Research',
    'purpose' => 'Ascension Research is the research subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation',
    'functions' => 
    array (
      0 => 'open Ascension Research state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect technology tree',
      5 => 'check prerequisites',
      6 => 'queue research',
      7 => 'review applied effects',
    ),
    'features' => 
    array (
      0 => 'technology tree',
      1 => 'prerequisite graph',
      2 => 'research queue',
      3 => 'effect preview',
      4 => 'branch tree',
      5 => 'locked-state explanation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'offense',
      5 => 'defense',
      6 => 'covert',
      7 => 'anti-covert',
      8 => 'propulsion',
      9 => 'astrophysics',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'technology',
  ),
  'fleet-manager' => 
  array (
    'route' => 'fleet-manager',
    'group' => 'fleet',
    'title' => 'Fleet Manager',
    'purpose' => 'Fleet Manager is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'fleet mission = validated composition + route distance + propulsion + fuel + cooldown',
    'functions' => 
    array (
      0 => 'open Fleet Manager state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'formation editor',
      2 => 'mission route',
      3 => 'arrival forecast',
      4 => 'loadout view',
      5 => 'mission planner',
      6 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'starships' => 
  array (
    'route' => 'starships',
    'group' => 'fleet',
    'title' => 'Starships',
    'purpose' => 'Starships is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'mission readiness = ownership + fleet availability + fuel + route validation + cooldown',
    'functions' => 
    array (
      0 => 'open Starships state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'loadout view',
      2 => 'mission planner',
      3 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'motherships' => 
  array (
    'route' => 'motherships',
    'group' => 'fleet',
    'title' => 'Motherships',
    'purpose' => 'Motherships is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'mission readiness = ownership + fleet availability + fuel + route validation + cooldown',
    'functions' => 
    array (
      0 => 'open Motherships state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'loadout view',
      2 => 'mission planner',
      3 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'ship-upgrades' => 
  array (
    'route' => 'ship-upgrades',
    'group' => 'fleet',
    'title' => 'Ship Upgrades',
    'purpose' => 'Ship Upgrades is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'mission readiness = ownership + fleet availability + fuel + route validation + cooldown',
    'functions' => 
    array (
      0 => 'open Ship Upgrades state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'loadout view',
      2 => 'mission planner',
      3 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'formations' => 
  array (
    'route' => 'formations',
    'group' => 'fleet',
    'title' => 'Formations',
    'purpose' => 'Formations is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'mission readiness = ownership + fleet availability + fuel + route validation + cooldown',
    'functions' => 
    array (
      0 => 'open Formations state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'loadout view',
      2 => 'mission planner',
      3 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'fleet-missions' => 
  array (
    'route' => 'fleet-missions',
    'group' => 'fleet',
    'title' => 'Fleet Missions',
    'purpose' => 'Fleet Missions is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'fleet mission = validated composition + route distance + propulsion + fuel + cooldown',
    'functions' => 
    array (
      0 => 'open Fleet Missions state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'formation editor',
      2 => 'mission route',
      3 => 'arrival forecast',
      4 => 'loadout view',
      5 => 'mission planner',
      6 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'expeditions' => 
  array (
    'route' => 'expeditions',
    'group' => 'fleet',
    'title' => 'Expeditions',
    'purpose' => 'Expeditions is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'mission readiness = ownership + fleet availability + fuel + route validation + cooldown',
    'functions' => 
    array (
      0 => 'open Expeditions state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'loadout view',
      2 => 'mission planner',
      3 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'fleet-save' => 
  array (
    'route' => 'fleet-save',
    'group' => 'fleet',
    'title' => 'Fleet Save',
    'purpose' => 'Fleet Save is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'fleet mission = validated composition + route distance + propulsion + fuel + cooldown',
    'functions' => 
    array (
      0 => 'open Fleet Save state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'formation editor',
      2 => 'mission route',
      3 => 'arrival forecast',
      4 => 'loadout view',
      5 => 'mission planner',
      6 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'acs' => 
  array (
    'route' => 'acs',
    'group' => 'fleet',
    'title' => 'ACS',
    'purpose' => 'ACS is the fleet subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'mission readiness = ownership + fleet availability + fuel + route validation + cooldown',
    'functions' => 
    array (
      0 => 'open ACS state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect fleet',
      5 => 'compose formation',
      6 => 'launch mission',
      7 => 'review movement and return',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'loadout view',
      2 => 'mission planner',
      3 => 'fuel estimate',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'speed calculation',
      5 => 'risk preview',
      6 => 'arrival timing',
      7 => 'formation modifiers',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'fleet',
  ),
  'ground-forces' => 
  array (
    'route' => 'ground-forces',
    'group' => 'military',
    'title' => 'Ground Forces',
    'purpose' => 'Ground Forces is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Ground Forces state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'military-units' => 
  array (
    'route' => 'military-units',
    'group' => 'military',
    'title' => 'Units',
    'purpose' => 'Units is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat readiness = units × equipment × technology × morale − fatigue',
    'functions' => 
    array (
      0 => 'open Units state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense posture',
      3 => 'combat readiness',
      4 => 'defense grid',
      5 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'officers' => 
  array (
    'route' => 'officers',
    'group' => 'military',
    'title' => 'Officers',
    'purpose' => 'Officers is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Officers state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'training-center' => 
  array (
    'route' => 'training-center',
    'group' => 'military',
    'title' => 'Training Center',
    'purpose' => 'Training Center is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Training Center state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'planetary-defense' => 
  array (
    'route' => 'planetary-defense',
    'group' => 'military',
    'title' => 'Planetary Defense',
    'purpose' => 'Planetary Defense is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Planetary Defense state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'missile-warfare' => 
  array (
    'route' => 'missile-warfare',
    'group' => 'military',
    'title' => 'Missile Warfare',
    'purpose' => 'Missile Warfare is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Missile Warfare state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'combat-simulator' => 
  array (
    'route' => 'combat-simulator',
    'group' => 'military',
    'title' => 'Combat Simulator',
    'purpose' => 'Combat Simulator is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Combat Simulator state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'war-room' => 
  array (
    'route' => 'war-room',
    'group' => 'military',
    'title' => 'War Room',
    'purpose' => 'War Room is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open War Room state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'campaigns' => 
  array (
    'route' => 'campaigns',
    'group' => 'military',
    'title' => 'Campaigns',
    'purpose' => 'Campaigns is the military subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'combat power = units × equipment × technology × morale − penalties',
    'functions' => 
    array (
      0 => 'open Campaigns state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect forces',
      5 => 'train units',
      6 => 'assign officers',
      7 => 'simulate combat',
      8 => 'review campaigns',
    ),
    'features' => 
    array (
      0 => 'force roster',
      1 => 'training queue',
      2 => 'defense grid',
      3 => 'combat simulator',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'shield',
      5 => 'armor',
      6 => 'penetration',
      7 => 'casualty preview',
      8 => 'readiness state',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'combat',
  ),
  'galaxy-view' => 
  array (
    'route' => 'galaxy-view',
    'group' => 'galaxy',
    'title' => 'Galaxy View',
    'purpose' => 'Galaxy View is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'navigation visibility = coordinate scope + discovery state + scan power + permission',
    'functions' => 
    array (
      0 => 'open Galaxy View state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'map viewport',
      1 => 'coordinate path',
      2 => 'scan state',
      3 => 'discovery record',
      4 => 'coordinate navigator',
      5 => 'map layers',
      6 => 'sensor scope',
      7 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'galaxy-map' => 
  array (
    'route' => 'galaxy-map',
    'group' => 'galaxy',
    'title' => 'Galaxy Map',
    'purpose' => 'Galaxy Map is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'navigation visibility = coordinate scope + discovery state + scan power + permission',
    'functions' => 
    array (
      0 => 'open Galaxy Map state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'map viewport',
      1 => 'coordinate path',
      2 => 'scan state',
      3 => 'discovery record',
      4 => 'coordinate navigator',
      5 => 'map layers',
      6 => 'sensor scope',
      7 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'galaxy-solar-systems' => 
  array (
    'route' => 'galaxy-solar-systems',
    'group' => 'galaxy',
    'title' => 'Solar Systems',
    'purpose' => 'Solar Systems is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'navigation visibility = coordinate scope + discovery state + scan power + permission',
    'functions' => 
    array (
      0 => 'open Solar Systems state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'map viewport',
      1 => 'coordinate path',
      2 => 'scan state',
      3 => 'discovery record',
      4 => 'coordinate navigator',
      5 => 'map layers',
      6 => 'sensor scope',
      7 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  '3d-universe' => 
  array (
    'route' => '3d-universe',
    'group' => 'galaxy',
    'title' => '3D Universe',
    'purpose' => '3D Universe is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open 3D Universe state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'galaxy-sectors' => 
  array (
    'route' => 'galaxy-sectors',
    'group' => 'galaxy',
    'title' => 'Sectors',
    'purpose' => 'Sectors is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'navigation visibility = coordinate scope + discovery state + scan power + permission',
    'functions' => 
    array (
      0 => 'open Sectors state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'map viewport',
      1 => 'coordinate path',
      2 => 'scan state',
      3 => 'discovery record',
      4 => 'coordinate navigator',
      5 => 'map layers',
      6 => 'sensor scope',
      7 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'realm-systems' => 
  array (
    'route' => 'realm-systems',
    'group' => 'galaxy',
    'title' => 'Realm Systems',
    'purpose' => 'Realm Systems is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open Realm Systems state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'stargate-network' => 
  array (
    'route' => 'stargate-network',
    'group' => 'galaxy',
    'title' => 'Stargate Network',
    'purpose' => 'Stargate Network is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open Stargate Network state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'wormholes' => 
  array (
    'route' => 'wormholes',
    'group' => 'galaxy',
    'title' => 'Wormholes',
    'purpose' => 'Wormholes is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open Wormholes state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'anomalies' => 
  array (
    'route' => 'anomalies',
    'group' => 'galaxy',
    'title' => 'Anomalies',
    'purpose' => 'Anomalies is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open Anomalies state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'npc-factions' => 
  array (
    'route' => 'npc-factions',
    'group' => 'galaxy',
    'title' => 'NPC Factions',
    'purpose' => 'NPC Factions is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open NPC Factions state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'seed-discovery' => 
  array (
    'route' => 'seed-discovery',
    'group' => 'galaxy',
    'title' => 'Seed Discovery',
    'purpose' => 'Seed Discovery is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open Seed Discovery state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'galactic-calendar' => 
  array (
    'route' => 'galactic-calendar',
    'group' => 'galaxy',
    'title' => 'Galactic Calendar',
    'purpose' => 'Galactic Calendar is the galaxy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'visibility = discovered scope + scan permission + coordinate hierarchy + sensor power',
    'functions' => 
    array (
      0 => 'open Galactic Calendar state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'select coordinate',
      5 => 'open map',
      6 => 'scan sector',
      7 => 'inspect route',
      8 => 'review discovery',
    ),
    'features' => 
    array (
      0 => 'coordinate navigator',
      1 => 'map layers',
      2 => 'sensor scope',
      3 => 'travel lanes',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'galaxy filter',
      5 => 'sector filter',
      6 => 'system orbit',
      7 => 'anomaly status',
      8 => 'NPC signal',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'galaxies',
  ),
  'marketplace' => 
  array (
    'route' => 'marketplace',
    'group' => 'economy',
    'title' => 'Marketplace',
    'purpose' => 'Marketplace is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'trade settlement = validated order × price − fee − escrow state',
    'functions' => 
    array (
      0 => 'open Marketplace state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price bands',
      2 => 'escrow state',
      3 => 'trade history',
      4 => 'price limits',
      5 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'resource-trading' => 
  array (
    'route' => 'resource-trading',
    'group' => 'economy',
    'title' => 'Resource Trading',
    'purpose' => 'Resource Trading is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'resource state = authenticated balance + production − upkeep − queued cost',
    'functions' => 
    array (
      0 => 'open Resource Trading state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'balance tiles',
      1 => 'production history',
      2 => 'consumption forecast',
      3 => 'deficit warning',
      4 => 'order book',
      5 => 'price limits',
      6 => 'trade history',
      7 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'trade-routes' => 
  array (
    'route' => 'trade-routes',
    'group' => 'economy',
    'title' => 'Trade Routes',
    'purpose' => 'Trade Routes is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'settlement = validated order × market price − fee − risk adjustment',
    'functions' => 
    array (
      0 => 'open Trade Routes state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price limits',
      2 => 'trade history',
      3 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'merchant' => 
  array (
    'route' => 'merchant',
    'group' => 'economy',
    'title' => 'Merchant',
    'purpose' => 'Merchant is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'settlement = validated order × market price − fee − risk adjustment',
    'functions' => 
    array (
      0 => 'open Merchant state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price limits',
      2 => 'trade history',
      3 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'auction-house' => 
  array (
    'route' => 'auction-house',
    'group' => 'economy',
    'title' => 'Auction House',
    'purpose' => 'Auction House is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'settlement = validated order × market price − fee − risk adjustment',
    'functions' => 
    array (
      0 => 'open Auction House state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price limits',
      2 => 'trade history',
      3 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'black-market' => 
  array (
    'route' => 'black-market',
    'group' => 'economy',
    'title' => 'Black Market',
    'purpose' => 'Black Market is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'trade settlement = validated order × price − fee − escrow state',
    'functions' => 
    array (
      0 => 'open Black Market state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price bands',
      2 => 'escrow state',
      3 => 'trade history',
      4 => 'price limits',
      5 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'insurance' => 
  array (
    'route' => 'insurance',
    'group' => 'economy',
    'title' => 'Insurance',
    'purpose' => 'Insurance is the economy subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'settlement = validated order × market price − fee − risk adjustment',
    'functions' => 
    array (
      0 => 'open Insurance state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect market',
      5 => 'create order',
      6 => 'review trade route',
      7 => 'settle transaction',
    ),
    'features' => 
    array (
      0 => 'order book',
      1 => 'price limits',
      2 => 'trade history',
      3 => 'insurance status',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'buy',
      5 => 'sell',
      6 => 'route capacity',
      7 => 'expiry',
      8 => 'fee preview',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'market',
  ),
  'workshop' => 
  array (
    'route' => 'workshop',
    'group' => 'crafting',
    'title' => 'Workshop',
    'purpose' => 'Workshop is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Workshop state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'master-crafting' => 
  array (
    'route' => 'master-crafting',
    'group' => 'crafting',
    'title' => 'Master Crafting',
    'purpose' => 'Master Crafting is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill × station efficiency',
    'functions' => 
    array (
      0 => 'open Master Crafting state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprints',
      1 => 'materials',
      2 => 'craft queue',
      3 => 'quality preview',
      4 => 'blueprint library',
      5 => 'materials inventory',
      6 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'crafting-rank' => 
  array (
    'route' => 'crafting-rank',
    'group' => 'crafting',
    'title' => 'Crafting Rank',
    'purpose' => 'Crafting Rank is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill × station efficiency',
    'functions' => 
    array (
      0 => 'open Crafting Rank state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprints',
      1 => 'materials',
      2 => 'craft queue',
      3 => 'quality preview',
      4 => 'blueprint library',
      5 => 'materials inventory',
      6 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'materials' => 
  array (
    'route' => 'materials',
    'group' => 'crafting',
    'title' => 'Materials',
    'purpose' => 'Materials is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Materials state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'materials-lab' => 
  array (
    'route' => 'materials-lab',
    'group' => 'crafting',
    'title' => 'Materials Lab',
    'purpose' => 'Materials Lab is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Materials Lab state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'dismantling' => 
  array (
    'route' => 'dismantling',
    'group' => 'crafting',
    'title' => 'Dismantling',
    'purpose' => 'Dismantling is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Dismantling state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'augmentations' => 
  array (
    'route' => 'augmentations',
    'group' => 'crafting',
    'title' => 'Augmentations',
    'purpose' => 'Augmentations is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Augmentations state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'artifacts' => 
  array (
    'route' => 'artifacts',
    'group' => 'crafting',
    'title' => 'Artifacts',
    'purpose' => 'Artifacts is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Artifacts state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'blueprints' => 
  array (
    'route' => 'blueprints',
    'group' => 'crafting',
    'title' => 'Blueprints',
    'purpose' => 'Blueprints is the crafting subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'craft output = blueprint tier × material quality × skill modifier × station efficiency',
    'functions' => 
    array (
      0 => 'open Blueprints state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect blueprint',
      5 => 'calculate materials',
      6 => 'start craft',
      7 => 'review durability',
      8 => 'dismantle item',
    ),
    'features' => 
    array (
      0 => 'blueprint library',
      1 => 'materials inventory',
      2 => 'craft queue',
      3 => 'augmentation panel',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'quality tier',
      5 => 'success chance',
      6 => 'durability',
      7 => 'salvage yield',
      8 => 'artifact effects',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'crafting',
  ),
  'alliance-hub' => 
  array (
    'route' => 'alliance-hub',
    'group' => 'alliance',
    'title' => 'Alliance Hub',
    'purpose' => 'Alliance Hub is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event',
    'functions' => 
    array (
      0 => 'open Alliance Hub state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role matrix',
      2 => 'diplomacy map',
      3 => 'shared projects',
      4 => 'role permissions',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'members' => 
  array (
    'route' => 'members',
    'group' => 'alliance',
    'title' => 'Members',
    'purpose' => 'Members is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance capacity = command level × alliance technology × government modifier',
    'functions' => 
    array (
      0 => 'open Members state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role permissions',
      2 => 'diplomacy map',
      3 => 'shared projects',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'commanders' => 
  array (
    'route' => 'commanders',
    'group' => 'alliance',
    'title' => 'Commanders',
    'purpose' => 'Commanders is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance capacity = command level × alliance technology × government modifier',
    'functions' => 
    array (
      0 => 'open Commanders state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role permissions',
      2 => 'diplomacy map',
      3 => 'shared projects',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'alliance-officers' => 
  array (
    'route' => 'alliance-officers',
    'group' => 'alliance',
    'title' => 'Officers',
    'purpose' => 'Officers is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event',
    'functions' => 
    array (
      0 => 'open Officers state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role matrix',
      2 => 'diplomacy map',
      3 => 'shared projects',
      4 => 'role permissions',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'diplomacy' => 
  array (
    'route' => 'diplomacy',
    'group' => 'alliance',
    'title' => 'Diplomacy',
    'purpose' => 'Diplomacy is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance capacity = command level × alliance technology × government modifier',
    'functions' => 
    array (
      0 => 'open Diplomacy state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role permissions',
      2 => 'diplomacy map',
      3 => 'shared projects',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'war' => 
  array (
    'route' => 'war',
    'group' => 'alliance',
    'title' => 'War',
    'purpose' => 'War is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance capacity = command level × alliance technology × government modifier',
    'functions' => 
    array (
      0 => 'open War state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role permissions',
      2 => 'diplomacy map',
      3 => 'shared projects',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'alliance-acs' => 
  array (
    'route' => 'alliance-acs',
    'group' => 'alliance',
    'title' => 'ACS',
    'purpose' => 'ACS is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event',
    'functions' => 
    array (
      0 => 'open ACS state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role matrix',
      2 => 'diplomacy map',
      3 => 'shared projects',
      4 => 'role permissions',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'alliance-logistics' => 
  array (
    'route' => 'alliance-logistics',
    'group' => 'alliance',
    'title' => 'Alliance Logistics',
    'purpose' => 'Alliance Logistics is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event',
    'functions' => 
    array (
      0 => 'open Alliance Logistics state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role matrix',
      2 => 'diplomacy map',
      3 => 'shared projects',
      4 => 'role permissions',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'alliance-stargates' => 
  array (
    'route' => 'alliance-stargates',
    'group' => 'alliance',
    'title' => 'Alliance Stargates',
    'purpose' => 'Alliance Stargates is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event',
    'functions' => 
    array (
      0 => 'open Alliance Stargates state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role matrix',
      2 => 'diplomacy map',
      3 => 'shared projects',
      4 => 'role permissions',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'alliance-intelligence' => 
  array (
    'route' => 'alliance-intelligence',
    'group' => 'alliance',
    'title' => 'Alliance Intelligence',
    'purpose' => 'Alliance Intelligence is the alliance subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'intelligence result = sensor power + covert skill − target counter-intelligence',
    'functions' => 
    array (
      0 => 'open Alliance Intelligence state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect roster',
      5 => 'invite member',
      6 => 'propose diplomacy',
      7 => 'coordinate defense',
      8 => 'review projects',
    ),
    'features' => 
    array (
      0 => 'target profile',
      1 => 'detection estimate',
      2 => 'classified output',
      3 => 'mission history',
      4 => 'member roster',
      5 => 'role permissions',
      6 => 'diplomacy map',
      7 => 'shared projects',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'officer roles',
      5 => 'war state',
      6 => 'ACS readiness',
      7 => 'logistics capacity',
      8 => 'alliance reports',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'social',
  ),
  'lifeforms-population' => 
  array (
    'route' => 'lifeforms-population',
    'group' => 'lifeforms',
    'title' => 'Population',
    'purpose' => 'Population is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform progress = population × role efficiency × tier modifier × morale',
    'functions' => 
    array (
      0 => 'open Population state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'population roles',
      1 => 'tier ladder',
      2 => 'trait matrix',
      3 => 'bonus summary',
      4 => 'population profile',
      5 => 'food balance',
      6 => 'lifeform tree',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'food' => 
  array (
    'route' => 'food',
    'group' => 'lifeforms',
    'title' => 'Food',
    'purpose' => 'Food is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform output = population × role efficiency × morale × tier modifier',
    'functions' => 
    array (
      0 => 'open Food state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'population profile',
      1 => 'food balance',
      2 => 'lifeform tree',
      3 => 'trait matrix',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'lifeform-buildings' => 
  array (
    'route' => 'lifeform-buildings',
    'group' => 'lifeforms',
    'title' => 'Lifeform Buildings',
    'purpose' => 'Lifeform Buildings is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform progress = population × role efficiency × tier modifier × morale',
    'functions' => 
    array (
      0 => 'open Lifeform Buildings state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'population roles',
      1 => 'tier ladder',
      2 => 'trait matrix',
      3 => 'bonus summary',
      4 => 'population profile',
      5 => 'food balance',
      6 => 'lifeform tree',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'lifeforms-lifeform-research' => 
  array (
    'route' => 'lifeforms-lifeform-research',
    'group' => 'lifeforms',
    'title' => 'Lifeform Research',
    'purpose' => 'Lifeform Research is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation',
    'functions' => 
    array (
      0 => 'open Lifeform Research state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'technology tree',
      1 => 'prerequisite graph',
      2 => 'research queue',
      3 => 'effect preview',
      4 => 'population profile',
      5 => 'food balance',
      6 => 'lifeform tree',
      7 => 'trait matrix',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'civilization-tier' => 
  array (
    'route' => 'civilization-tier',
    'group' => 'lifeforms',
    'title' => 'Civilization Tier',
    'purpose' => 'Civilization Tier is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform output = population × role efficiency × morale × tier modifier',
    'functions' => 
    array (
      0 => 'open Civilization Tier state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'population profile',
      1 => 'food balance',
      2 => 'lifeform tree',
      3 => 'trait matrix',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'traits' => 
  array (
    'route' => 'traits',
    'group' => 'lifeforms',
    'title' => 'Traits',
    'purpose' => 'Traits is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform output = population × role efficiency × morale × tier modifier',
    'functions' => 
    array (
      0 => 'open Traits state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'population profile',
      1 => 'food balance',
      2 => 'lifeform tree',
      3 => 'trait matrix',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'lifeform-bonuses' => 
  array (
    'route' => 'lifeform-bonuses',
    'group' => 'lifeforms',
    'title' => 'Lifeform Bonuses',
    'purpose' => 'Lifeform Bonuses is the lifeforms subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform progress = population × role efficiency × tier modifier × morale',
    'functions' => 
    array (
      0 => 'open Lifeform Bonuses state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect population',
      5 => 'assign roles',
      6 => 'research lifeform',
      7 => 'review traits',
      8 => 'apply bonus',
    ),
    'features' => 
    array (
      0 => 'population roles',
      1 => 'tier ladder',
      2 => 'trait matrix',
      3 => 'bonus summary',
      4 => 'population profile',
      5 => 'food balance',
      6 => 'lifeform tree',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'tier progress',
      5 => 'civilization level',
      6 => 'bonus stacking',
      7 => 'workforce allocation',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'generic',
  ),
  'quests' => 
  array (
    'route' => 'quests',
    'group' => 'activities',
    'title' => 'Quests',
    'purpose' => 'Quests is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Quests state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'activities-expeditions' => 
  array (
    'route' => 'activities-expeditions',
    'group' => 'activities',
    'title' => 'Expeditions',
    'purpose' => 'Expeditions is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Expeditions state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'pirate-hunting' => 
  array (
    'route' => 'pirate-hunting',
    'group' => 'activities',
    'title' => 'Pirate Hunting',
    'purpose' => 'Pirate Hunting is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Pirate Hunting state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'bounty-board' => 
  array (
    'route' => 'bounty-board',
    'group' => 'activities',
    'title' => 'Bounty Board',
    'purpose' => 'Bounty Board is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Bounty Board state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'world-bosses' => 
  array (
    'route' => 'world-bosses',
    'group' => 'activities',
    'title' => 'World Bosses',
    'purpose' => 'World Bosses is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open World Bosses state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'activities-anomalies' => 
  array (
    'route' => 'activities-anomalies',
    'group' => 'activities',
    'title' => 'Anomalies',
    'purpose' => 'Anomalies is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Anomalies state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'activities-campaigns' => 
  array (
    'route' => 'activities-campaigns',
    'group' => 'activities',
    'title' => 'Campaigns',
    'purpose' => 'Campaigns is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Campaigns state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'achievements' => 
  array (
    'route' => 'achievements',
    'group' => 'activities',
    'title' => 'Achievements',
    'purpose' => 'Achievements is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Achievements state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'seasonal-events' => 
  array (
    'route' => 'seasonal-events',
    'group' => 'activities',
    'title' => 'Seasonal Events',
    'purpose' => 'Seasonal Events is the activities subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'activity reward = validated objective completion × difficulty × season modifier',
    'functions' => 
    array (
      0 => 'open Seasonal Events state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse activities',
      5 => 'start activity',
      6 => 'resolve outcome',
      7 => 'claim reward',
      8 => 'track achievement',
    ),
    'features' => 
    array (
      0 => 'activity board',
      1 => 'progress tracker',
      2 => 'reward preview',
      3 => 'season timeline',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'eligibility',
      5 => 'cooldown',
      6 => 'risk',
      7 => 'reward state',
      8 => 'completion audit',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'activities',
  ),
  'glory' => 
  array (
    'route' => 'glory',
    'group' => 'prestige',
    'title' => 'Glory',
    'purpose' => 'Glory is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige score = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Glory state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'prestige summary',
      1 => 'milestone ladder',
      2 => 'title library',
      3 => 'permanent modifiers',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'reputation' => 
  array (
    'route' => 'reputation',
    'group' => 'prestige',
    'title' => 'Reputation',
    'purpose' => 'Reputation is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige score = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Reputation state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'prestige summary',
      1 => 'milestone ladder',
      2 => 'title library',
      3 => 'permanent modifiers',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'prestige-ascension' => 
  array (
    'route' => 'prestige-ascension',
    'group' => 'prestige',
    'title' => 'Ascension',
    'purpose' => 'Ascension is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige state = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Ascension state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'milestone ladder',
      1 => 'reputation track',
      2 => 'title library',
      3 => 'permanent modifiers',
      4 => 'prestige summary',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  're-ascension' => 
  array (
    'route' => 're-ascension',
    'group' => 'prestige',
    'title' => 'Re-Ascension',
    'purpose' => 'Re-Ascension is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige score = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Re-Ascension state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'prestige summary',
      1 => 'milestone ladder',
      2 => 'title library',
      3 => 'permanent modifiers',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'ascended-races' => 
  array (
    'route' => 'ascended-races',
    'group' => 'prestige',
    'title' => 'Ascended Races',
    'purpose' => 'Ascended Races is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige score = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Ascended Races state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'prestige summary',
      1 => 'milestone ladder',
      2 => 'title library',
      3 => 'permanent modifiers',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'titles' => 
  array (
    'route' => 'titles',
    'group' => 'prestige',
    'title' => 'Titles',
    'purpose' => 'Titles is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige score = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Titles state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'prestige summary',
      1 => 'milestone ladder',
      2 => 'title library',
      3 => 'permanent modifiers',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'permanent-bonuses' => 
  array (
    'route' => 'permanent-bonuses',
    'group' => 'prestige',
    'title' => 'Permanent Bonuses',
    'purpose' => 'Permanent Bonuses is the prestige subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'prestige score = glory + reputation + ascension milestones − penalties',
    'functions' => 
    array (
      0 => 'open Permanent Bonuses state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'inspect prestige',
      5 => 'review reputation',
      6 => 'preview ascension',
      7 => 'select title',
      8 => 'review bonuses',
    ),
    'features' => 
    array (
      0 => 'prestige summary',
      1 => 'milestone ladder',
      2 => 'title library',
      3 => 'permanent modifiers',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'thresholds',
      5 => 'locked states',
      6 => 'season movement',
      7 => 'bonus application',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'progression',
  ),
  'empire' => 
  array (
    'route' => 'empire',
    'group' => 'rankings',
    'title' => 'Empire',
    'purpose' => 'Empire is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'functions' => 
    array (
      0 => 'open Empire state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'leaderboard',
      1 => 'movement indicators',
      2 => 'score breakdown',
      3 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'economy' => 
  array (
    'route' => 'economy',
    'group' => 'rankings',
    'title' => 'Economy',
    'purpose' => 'Economy is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'functions' => 
    array (
      0 => 'open Economy state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'leaderboard',
      1 => 'movement indicators',
      2 => 'score breakdown',
      3 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'fleet' => 
  array (
    'route' => 'fleet',
    'group' => 'rankings',
    'title' => 'Fleet',
    'purpose' => 'Fleet is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'fleet mission = validated composition + route distance + propulsion + fuel + cooldown',
    'functions' => 
    array (
      0 => 'open Fleet state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'fleet roster',
      1 => 'formation editor',
      2 => 'mission route',
      3 => 'arrival forecast',
      4 => 'leaderboard',
      5 => 'movement indicators',
      6 => 'score breakdown',
      7 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'research' => 
  array (
    'route' => 'research',
    'group' => 'rankings',
    'title' => 'Research',
    'purpose' => 'Research is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'research completion = base cost × growth^level with prerequisite and queue validation',
    'functions' => 
    array (
      0 => 'open Research state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'technology tree',
      1 => 'prerequisite graph',
      2 => 'research queue',
      3 => 'effect preview',
      4 => 'leaderboard',
      5 => 'movement indicators',
      6 => 'score breakdown',
      7 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'rankings-defense' => 
  array (
    'route' => 'rankings-defense',
    'group' => 'rankings',
    'title' => 'Defense',
    'purpose' => 'Defense is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'functions' => 
    array (
      0 => 'open Defense state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'leaderboard',
      1 => 'score breakdown',
      2 => 'movement indicator',
      3 => 'season snapshot',
      4 => 'movement indicators',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'covert' => 
  array (
    'route' => 'covert',
    'group' => 'rankings',
    'title' => 'Covert',
    'purpose' => 'Covert is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'functions' => 
    array (
      0 => 'open Covert state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'leaderboard',
      1 => 'movement indicators',
      2 => 'score breakdown',
      3 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'alliance' => 
  array (
    'route' => 'alliance',
    'group' => 'rankings',
    'title' => 'Alliance',
    'purpose' => 'Alliance is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'alliance action = membership role + diplomatic state + project capacity + audit event',
    'functions' => 
    array (
      0 => 'open Alliance state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'member roster',
      1 => 'role matrix',
      2 => 'diplomacy map',
      3 => 'shared projects',
      4 => 'leaderboard',
      5 => 'movement indicators',
      6 => 'score breakdown',
      7 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'lifeform' => 
  array (
    'route' => 'lifeform',
    'group' => 'rankings',
    'title' => 'Lifeform',
    'purpose' => 'Lifeform is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'lifeform progress = population × role efficiency × tier modifier × morale',
    'functions' => 
    array (
      0 => 'open Lifeform state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'population roles',
      1 => 'tier ladder',
      2 => 'trait matrix',
      3 => 'bonus summary',
      4 => 'leaderboard',
      5 => 'movement indicators',
      6 => 'score breakdown',
      7 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'galactic-control' => 
  array (
    'route' => 'galactic-control',
    'group' => 'rankings',
    'title' => 'Galactic Control',
    'purpose' => 'Galactic Control is the rankings subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'ranking score = economy + military + technology + glory − penalties',
    'functions' => 
    array (
      0 => 'open Galactic Control state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'read rankings',
      5 => 'filter ladder',
      6 => 'open public profile',
      7 => 'refresh snapshot',
    ),
    'features' => 
    array (
      0 => 'leaderboard',
      1 => 'movement indicators',
      2 => 'score breakdown',
      3 => 'season snapshot',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'universe filter',
      5 => 'category filter',
      6 => 'rank movement',
      7 => 'public visibility',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'rankings',
  ),
  'store' => 
  array (
    'route' => 'store',
    'group' => 'premium',
    'title' => 'Store',
    'purpose' => 'Store is the premium subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'purchase eligibility = authenticated account + catalogue availability + balance + entitlement rules',
    'functions' => 
    array (
      0 => 'open Store state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse store',
      5 => 'inspect entitlement',
      6 => 'purchase item',
      7 => 'review duration',
      8 => 'manage service',
    ),
    'features' => 
    array (
      0 => 'catalogue',
      1 => 'entitlement panel',
      2 => 'expiry state',
      3 => 'purchase confirmation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'price display',
      5 => 'inventory grant',
      6 => 'renewal',
      7 => 'service limits',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'premium',
  ),
  'premium-officers' => 
  array (
    'route' => 'premium-officers',
    'group' => 'premium',
    'title' => 'Officers',
    'purpose' => 'Officers is the premium subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'entitlement = authenticated account + catalogue item + balance + service policy',
    'functions' => 
    array (
      0 => 'open Officers state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse store',
      5 => 'inspect entitlement',
      6 => 'purchase item',
      7 => 'review duration',
      8 => 'manage service',
    ),
    'features' => 
    array (
      0 => 'store catalogue',
      1 => 'entitlement state',
      2 => 'expiry timer',
      3 => 'purchase confirmation',
      4 => 'catalogue',
      5 => 'entitlement panel',
      6 => 'expiry state',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'price display',
      5 => 'inventory grant',
      6 => 'renewal',
      7 => 'service limits',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'premium',
  ),
  'commander' => 
  array (
    'route' => 'commander',
    'group' => 'premium',
    'title' => 'Commander',
    'purpose' => 'Commander is the premium subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'purchase eligibility = authenticated account + catalogue availability + balance + entitlement rules',
    'functions' => 
    array (
      0 => 'open Commander state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse store',
      5 => 'inspect entitlement',
      6 => 'purchase item',
      7 => 'review duration',
      8 => 'manage service',
    ),
    'features' => 
    array (
      0 => 'catalogue',
      1 => 'entitlement panel',
      2 => 'expiry state',
      3 => 'purchase confirmation',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'price display',
      5 => 'inventory grant',
      6 => 'renewal',
      7 => 'service limits',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'premium',
  ),
  'premium-services' => 
  array (
    'route' => 'premium-services',
    'group' => 'premium',
    'title' => 'Premium Services',
    'purpose' => 'Premium Services is the premium subsystem console for authenticated commander operations, review, and validated state transitions.',
    'mechanic' => 'entitlement = authenticated account + catalogue item + balance + service policy',
    'functions' => 
    array (
      0 => 'open Premium Services state',
      1 => 'inspect server-calculated values',
      2 => 'review related queues and dependencies',
      3 => 'navigate to linked subsystem',
      4 => 'browse store',
      5 => 'inspect entitlement',
      6 => 'purchase item',
      7 => 'review duration',
      8 => 'manage service',
    ),
    'features' => 
    array (
      0 => 'store catalogue',
      1 => 'entitlement state',
      2 => 'expiry timer',
      3 => 'purchase confirmation',
      4 => 'catalogue',
      5 => 'entitlement panel',
      6 => 'expiry state',
    ),
    'sub_features' => 
    array (
      0 => 'empty-state explanation',
      1 => 'loading and refresh state',
      2 => 'permission-aware controls',
      3 => 'related-page navigation',
      4 => 'price display',
      5 => 'inventory grant',
      6 => 'renewal',
      7 => 'service limits',
    ),
    'controls' => 
    array (
      0 => 'Open overview',
      1 => 'Review status',
    ),
    'buttons' => 
    array (
      0 => 
      array (
        'label' => 'Inspect page',
        'action' => 'inspect_page',
        'behavior' => 'Read authenticated page contract.',
      ),
      1 => 
      array (
        'label' => 'Refresh state',
        'action' => 'refresh_page',
        'behavior' => 'Refresh authenticated page metadata.',
      ),
    ),
    'server_actions' => 
    array (
      0 => 'read-only',
    ),
    'database_tables' => 
    array (
      0 => 'game_events',
    ),
    'permissions' => 
    array (
      0 => 'authenticated commander',
      1 => 'CSRF protection',
      2 => 'RBAC policy',
      3 => 'ownership scope',
      4 => 'transaction validation',
    ),
    'feedback_states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'locked',
      4 => 'protected',
      5 => 'cooldown',
      6 => 'insufficient-resource',
      7 => 'success',
      8 => 'error',
    ),
    'information_sections' => 
    array (
      0 => 'Commander context',
      1 => 'Current state',
      2 => 'Available controls',
      3 => 'Dependencies and prerequisites',
      4 => 'Audit and feedback',
      5 => 'Page overview',
      6 => 'Controls and sub-controls',
      7 => 'Server contract',
      8 => 'Database scope',
      9 => 'Feedback states',
      10 => 'Related pages',
    ),
    'layout' => 'premium',
  ),
);

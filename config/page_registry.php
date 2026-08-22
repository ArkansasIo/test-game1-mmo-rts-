<?php
declare(strict_types=1);
return array (
  'command-center' => 
  array (
    'label' => 'Command Center',
    'icon' => '⌂',
    'pages' => 
    array (
      'dashboard' => 
      array (
        'title' => 'Command Center',
        'layout' => 'dashboard',
        'controls' => 
        array (
          0 => 'Process turns',
          1 => 'Choose target',
          2 => 'Review reports',
        ),
        'actions' => 
        array (
          0 => 'process_turns',
        ),
        'tables' => 
        array (
          0 => 'players',
          1 => 'player_resources',
          2 => 'rankings',
          3 => 'game_events',
        ),
      ),
      'account-info' => 
      array (
        'title' => 'Account Information',
        'layout' => 'details',
        'controls' => 
        array (
          0 => 'View profile',
          1 => 'View rank',
          2 => 'View protection',
        ),
        'actions' => 
        array (
        ),
        'tables' => 
        array (
          0 => 'players',
          1 => 'races',
          2 => 'rankings',
          3 => 'glory_reputation',
        ),
      ),
      'resources' => 
      array (
        'title' => 'Resources & Vault',
        'layout' => 'economy',
        'controls' => 
        array (
          0 => 'Deposit',
          1 => 'Withdraw',
        ),
        'actions' => 
        array (
          0 => 'deposit',
          1 => 'withdraw',
        ),
        'tables' => 
        array (
          0 => 'player_resources',
          1 => 'game_settings',
        ),
      ),
      'income' => 
      array (
        'title' => 'Income Breakdown',
        'layout' => 'breakdown',
        'controls' => 
        array (
          0 => 'View income formula',
        ),
        'actions' => 
        array (
        ),
        'tables' => 
        array (
          0 => 'player_resources',
          1 => 'races',
          2 => 'player_planets',
          3 => 'game_settings',
        ),
      ),
      'military-stats' => 
      array (
        'title' => 'Military Statistics',
        'layout' => 'stats',
        'controls' => 
        array (
          0 => 'View attack',
          1 => 'View defense',
          2 => 'View covert',
        ),
        'actions' => 
        array (
        ),
        'tables' => 
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'rankings',
        ),
      ),
    ),
  ),
  'attack' => 
  array (
    'label' => 'Attack',
    'icon' => '⚔',
    'pages' => 
    array (
      'targets' => 
      array (
        'title' => 'Target Selection',
        'layout' => 'targets',
        'controls' => 
        array (
          0 => 'Attack',
          1 => 'Raid',
          2 => 'Spy',
          3 => 'Sabotage',
          4 => 'Conquer Planet',
          5 => 'Message',
        ),
        'actions' => 
        array (
          0 => 'combat',
          1 => 'covert',
          2 => 'explore',
          3 => 'message',
        ),
        'tables' => 
        array (
          0 => 'target_realms',
          1 => 'players',
          2 => 'battles',
        ),
      ),
      'spy' => 
      array (
        'title' => 'Spy Operations',
        'layout' => 'covert',
        'controls' => 
        array (
          0 => 'Run reconnaissance',
          1 => 'Run spy mission',
        ),
        'actions' => 
        array (
          0 => 'covert',
        ),
        'tables' => 
        array (
          0 => 'covert_missions',
          1 => 'spy_missions',
          2 => 'intelligence_reports',
        ),
      ),
      'sabotage' => 
      array (
        'title' => 'Sabotage Operations',
        'layout' => 'covert',
        'controls' => 
        array (
          0 => 'Choose system',
          1 => 'Run sabotage',
        ),
        'actions' => 
        array (
          0 => 'covert',
        ),
        'tables' => 
        array (
          0 => 'covert_missions',
          1 => 'sabotage_missions',
        ),
      ),
      'attack-log' => 
      array (
        'title' => 'Attack Log & Reports',
        'layout' => 'reports',
        'controls' => 
        array (
          0 => 'Open report',
          1 => 'Mark read',
        ),
        'actions' => 
        array (
          0 => 'message_read',
        ),
        'tables' => 
        array (
          0 => 'battles',
          1 => 'battle_reports',
          2 => 'attack_logs',
        ),
      ),
    ),
  ),
  'armory' => 
  array (
    'label' => 'Armory',
    'icon' => '▣',
    'pages' => 
    array (
      'weapons' => 
      array (
        'title' => 'Weapon Inventory',
        'layout' => 'inventory',
        'controls' => 
        array (
          0 => 'Buy weapon',
          1 => 'Inspect durability',
        ),
        'actions' => 
        array (
          0 => 'weapon_buy',
        ),
        'tables' => 
        array (
          0 => 'weapon_types',
          1 => 'player_weapons',
        ),
      ),
      'weapon-market' => 
      array (
        'title' => 'Weapon Market',
        'layout' => 'market',
        'controls' => 
        array (
          0 => 'List order',
          1 => 'Buy order',
        ),
        'actions' => 
        array (
          0 => 'market_list',
          1 => 'market_buy',
        ),
        'tables' => 
        array (
          0 => 'market_orders',
          1 => 'weapon_types',
        ),
      ),
      'repair' => 
      array (
        'title' => 'Weapon Repair',
        'layout' => 'repair',
        'controls' => 
        array (
          0 => 'Repair weapon',
        ),
        'actions' => 
        array (
          0 => 'weapon_repair',
        ),
        'tables' => 
        array (
          0 => 'player_weapons',
          1 => 'player_resources',
        ),
      ),
    ),
  ),
  'training' => 
  array (
    'label' => 'Training',
    'icon' => '◈',
    'pages' => 
    array (
      'units' => 
      array (
        'title' => 'Unit Training',
        'layout' => 'training',
        'controls' => 
        array (
          0 => 'Train units',
        ),
        'actions' => 
        array (
          0 => 'train',
          1 => 'upgrade_up',
        ),
        'tables' => 
        array (
          0 => 'unit_types',
          1 => 'player_unit_stats',
          2 => 'training_queues',
          3 => 'player_resources',
          4 => 'game_events',
        ),
      ),
      'miners' => 
      array (
        'title' => 'Miners & Lifers',
        'layout' => 'training',
        'controls' => 
        array (
          0 => 'Train miners',
        ),
        'actions' => 
        array (
          0 => 'train',
        ),
        'tables' => 
        array (
          0 => 'player_resources',
        ),
      ),
      'super-units' => 
      array (
        'title' => 'Super Units',
        'layout' => 'training',
        'controls' => 
        array (
          0 => 'Train elite units',
        ),
        'actions' => 
        array (
          0 => 'train',
        ),
        'tables' => 
        array (
          0 => 'player_resources',
          1 => 'technologies',
        ),
      ),
      'unit-production' => 
      array (
        'title' => 'Unit Production',
        'layout' => 'upgrade',
        'controls' => 
        array (
          0 => 'Upgrade UP',
        ),
        'actions' => 
        array (
          0 => 'upgrade_up',
        ),
        'tables' => 
        array (
          0 => 'unit_types',
          1 => 'player_unit_stats',
          2 => 'training_queues',
          3 => 'player_resources',
          4 => 'game_events',
        ),
      ),
    ),
  ),
  'technology' => 
  array (
    'label' => 'Technology',
    'icon' => '◇',
    'pages' => 
    array (
      'technology' => 
      array (
        'title' => 'Technology Tree',
        'layout' => 'technology',
        'controls' => 
        array (
          0 => 'Upgrade offense',
          1 => 'Upgrade defense',
          2 => 'Upgrade covert',
          3 => 'Upgrade anti-covert',
        ),
        'actions' => 
        array (
          0 => 'technology',
        ),
        'tables' => 
        array (
          0 => 'technologies',
          1 => 'player_technologies',
        ),
      ),
      'tech-offense' => 
      array (
        'title' => 'Offense Technology',
        'layout' => 'technology',
        'controls' => 
        array (
          0 => 'Upgrade',
        ),
        'actions' => 
        array (
          0 => 'technology',
        ),
        'tables' => 
        array (
          0 => 'technologies',
          1 => 'player_technologies',
        ),
      ),
      'tech-defense' => 
      array (
        'title' => 'Defense Technology',
        'layout' => 'technology',
        'controls' => 
        array (
          0 => 'Upgrade',
        ),
        'actions' => 
        array (
          0 => 'technology',
        ),
        'tables' => 
        array (
          0 => 'technologies',
          1 => 'player_technologies',
        ),
      ),
      'tech-covert' => 
      array (
        'title' => 'Covert Technology',
        'layout' => 'technology',
        'controls' => 
        array (
          0 => 'Upgrade',
        ),
        'actions' => 
        array (
          0 => 'technology',
        ),
        'tables' => 
        array (
          0 => 'technologies',
          1 => 'player_technologies',
        ),
      ),
      'tech-anti-covert' => 
      array (
        'title' => 'Anti-Covert Technology',
        'layout' => 'technology',
        'controls' => 
        array (
          0 => 'Upgrade',
        ),
        'actions' => 
        array (
          0 => 'technology',
        ),
        'tables' => 
        array (
          0 => 'technologies',
          1 => 'player_technologies',
        ),
      ),
    ),
  ),
  'intelligence' => 
  array (
    'label' => 'Intelligence',
    'icon' => '◎',
    'pages' => 
    array (
      'spy-log' => 
      array (
        'title' => 'Spy Log',
        'layout' => 'reports',
        'controls' => 
        array (
          0 => 'Open report',
          1 => 'Mark read',
        ),
        'actions' => 
        array (
          0 => 'message_read',
        ),
        'tables' => 
        array (
          0 => 'covert_missions',
          1 => 'intelligence_reports',
        ),
      ),
      'enemy-intelligence' => 
      array (
        'title' => 'Enemy Intelligence',
        'layout' => 'reports',
        'controls' => 
        array (
          0 => 'Open intelligence report',
        ),
        'actions' => 
        array (
        ),
        'tables' => 
        array (
          0 => 'intelligence_reports',
        ),
      ),
      'intelligence-espionage' => 
      array (
        'title' => 'Espionage',
        'layout' => 'combat',
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
      ),
      'spy-missions' => 
      array (
        'title' => 'Spy Missions',
        'layout' => 'combat',
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
      ),
      'counter-espionage' => 
      array (
        'title' => 'Counter-Espionage',
        'layout' => 'combat',
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
      ),
      'intelligence-sabotage' => 
      array (
        'title' => 'Sabotage',
        'layout' => 'combat',
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
      ),
      'reconnaissance' => 
      array (
        'title' => 'Reconnaissance',
        'layout' => 'combat',
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
      ),
      'sensor-phalanx' => 
      array (
        'title' => 'Sensor Phalanx',
        'layout' => 'combat',
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
      ),
      'fleet-activity' => 
      array (
        'title' => 'Fleet Activity',
        'layout' => 'combat',
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
      ),
      'intelligence-reports' => 
      array (
        'title' => 'Intelligence Reports',
        'layout' => 'combat',
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
      ),
    ),
  ),
  'market' => 
  array (
    'label' => 'Market',
    'icon' => '¤',
    'pages' => 
    array (
      'resource-exchange' => 
      array (
        'title' => 'Resource Exchange',
        'layout' => 'market',
        'controls' => 
        array (
          0 => 'List order',
          1 => 'Buy order',
        ),
        'actions' => 
        array (
          0 => 'market_list',
          1 => 'market_buy',
        ),
        'tables' => 
        array (
          0 => 'market_orders',
          1 => 'player_resources',
        ),
      ),
      'mercenary-market' => 
      array (
        'title' => 'Mercenary Market',
        'layout' => 'market',
        'controls' => 
        array (
          0 => 'Recruit',
          1 => 'Sell',
        ),
        'actions' => 
        array (
          0 => 'mercenary_buy',
        ),
        'tables' => 
        array (
          0 => 'mercenary_types',
          1 => 'player_mercenaries',
        ),
      ),
    ),
  ),
  'social' => 
  array (
    'label' => 'Social',
    'icon' => '♧',
    'pages' => 
    array (
      'rankings' => 
      array (
        'title' => 'Rankings',
        'layout' => 'rankings',
        'controls' => 
        array (
          0 => 'Refresh rankings',
          1 => 'Open player',
        ),
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
      'alliances' => 
      array (
        'title' => 'Alliances',
        'layout' => 'social',
        'controls' => 
        array (
          0 => 'Create alliance',
          1 => 'Join alliance',
          2 => 'Leave alliance',
        ),
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
      'messages' => 
      array (
        'title' => 'Messages',
        'layout' => 'messages',
        'controls' => 
        array (
          0 => 'Send',
          1 => 'Mark read',
          2 => 'Blacklist',
        ),
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
      'social-messages' => 
      array (
        'title' => 'Messages',
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
      ),
      'notifications' => 
      array (
        'title' => 'Notifications',
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
      ),
      'global-chat' => 
      array (
        'title' => 'Global Chat',
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
      ),
      'buddy-list' => 
      array (
        'title' => 'Buddy List',
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
      ),
      'recruitment' => 
      array (
        'title' => 'Recruitment',
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
      ),
      'empires-at-war' => 
      array (
        'title' => 'Empires at War',
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
      ),
    ),
  ),
  'planets' => 
  array (
    'label' => 'Planets',
    'icon' => '○',
    'pages' => 
    array (
      'planet-list' => 
      array (
        'title' => 'Planet List',
        'layout' => 'planets',
        'controls' => 
        array (
          0 => 'Explore',
          1 => 'Colonize',
          2 => 'Upgrade defense',
        ),
        'actions' => 
        array (
          0 => 'explore',
          1 => 'combat',
          2 => 'colonize_planet',
          3 => 'planet_defense',
        ),
        'tables' => 
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
      ),
      'settlement' => 
      array (
        'title' => 'Settlement & Power Grid',
        'layout' => 'settlement',
        'controls' => 
        array (
          0 => 'Queue build',
          1 => 'Demolish',
          2 => 'Process construction',
        ),
        'actions' => 
        array (
          0 => 'settlement_state',
          1 => 'settlement_build',
          2 => 'settlement_demolish',
          3 => 'settlement_process',
        ),
        'tables' => 
        array (
          0 => 'settlement_fields',
          1 => 'settlement_buildings',
          2 => 'settlement_construction_queues',
          3 => 'building_types',
          4 => 'player_resources',
          5 => 'game_events',
        ),
      ),
      'planet-bonuses' => 
      array (
        'title' => 'Planet Bonuses',
        'layout' => 'planets',
        'controls' => 
        array (
          0 => 'View bonuses',
        ),
        'actions' => 
        array (
        ),
        'tables' => 
        array (
          0 => 'planet_bonuses',
        ),
      ),
      'planet-defenses' => 
      array (
        'title' => 'Planet Defenses',
        'layout' => 'planets',
        'controls' => 
        array (
          0 => 'Upgrade defense',
        ),
        'actions' => 
        array (
          0 => 'planet_defense',
        ),
        'tables' => 
        array (
          0 => 'planet_defenses',
        ),
      ),
    ),
  ),
  'mothership' => 
  array (
    'label' => 'Mothership',
    'icon' => '△',
    'pages' => 
    array (
      'ship' => 
      array (
        'title' => 'Mothership',
        'layout' => 'ship',
        'controls' => 
        array (
          0 => 'Upgrade hull',
          1 => 'Upgrade hangars',
          2 => 'Upgrade shields',
        ),
        'actions' => 
        array (
          0 => 'mothership_upgrade',
        ),
        'tables' => 
        array (
          0 => 'motherships',
        ),
      ),
      'modules' => 
      array (
        'title' => 'Mothership Modules',
        'layout' => 'ship',
        'controls' => 
        array (
          0 => 'Upgrade module',
        ),
        'actions' => 
        array (
          0 => 'mothership_upgrade',
        ),
        'tables' => 
        array (
          0 => 'mothership_modules',
        ),
      ),
      'exploration' => 
      array (
        'title' => 'Exploration',
        'layout' => 'exploration',
        'controls' => 
        array (
          0 => 'Explore planet',
        ),
        'actions' => 
        array (
          0 => 'explore',
        ),
        'tables' => 
        array (
          0 => 'motherships',
          1 => 'planet_explorations',
        ),
      ),
    ),
  ),
  'account' => 
  array (
    'label' => 'Account',
    'icon' => '◌',
    'pages' => 
    array (
      'race' => 
      array (
        'title' => 'Race Selection',
        'layout' => 'account',
        'controls' => 
        array (
          0 => 'Select race',
        ),
        'actions' => 
        array (
          0 => 'change_race',
        ),
        'tables' => 
        array (
          0 => 'races',
          1 => 'players',
        ),
      ),
      'vacation' => 
      array (
        'title' => 'Vacation Mode',
        'layout' => 'account',
        'controls' => 
        array (
          0 => 'Enable vacation',
        ),
        'actions' => 
        array (
          0 => 'vacation',
        ),
        'tables' => 
        array (
          0 => 'vacation_states',
          1 => 'protection_states',
        ),
      ),
      'ascension' => 
      array (
        'title' => 'Ascension',
        'layout' => 'progression',
        'controls' => 
        array (
          0 => 'Check eligibility',
          1 => 'Ascend',
        ),
        'actions' => 
        array (
          0 => 'ascend',
        ),
        'tables' => 
        array (
          0 => 'ascension_states',
          1 => 'ascensions',
          2 => 'glory_reputation',
        ),
      ),
    ),
  ),
  'universe' => 
  array (
    'label' => 'Universe',
    'icon' => '✦',
    'pages' => 
    array (
      'galaxies' => 
      array (
        'title' => 'Galaxy Map',
        'layout' => 'galaxies',
        'controls' => 
        array (
          0 => 'Select galaxy',
          1 => 'Open sector',
        ),
        'actions' => 
        array (
          0 => 'universe_galaxies',
        ),
        'tables' => 
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_discoveries',
          5 => 'target_realms',
          6 => 'game_events',
        ),
      ),
      'sectors' => 
      array (
        'title' => 'Sector Map',
        'layout' => 'sectors',
        'controls' => 
        array (
          0 => 'Select sector',
          1 => 'Open system',
        ),
        'actions' => 
        array (
          0 => 'universe_sectors',
        ),
        'tables' => 
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
      ),
      'solar-systems' => 
      array (
        'title' => 'Solar Systems',
        'layout' => 'solar-systems',
        'controls' => 
        array (
          0 => 'Open system',
          1 => 'Scan system',
        ),
        'actions' => 
        array (
          0 => 'system_map',
          1 => 'explore',
        ),
        'tables' => 
        array (
          0 => 'universe_solar_systems',
          1 => 'universe_planets',
        ),
      ),
      'universe-planets' => 
      array (
        'title' => 'Universe Planets',
        'layout' => 'universe-planets',
        'controls' => 
        array (
          0 => 'Inspect planet',
          1 => 'Colonize planet',
        ),
        'actions' => 
        array (
          0 => 'planet_details',
          1 => 'colonize_planet',
        ),
        'tables' => 
        array (
          0 => 'universe_planets',
          1 => 'player_colonies',
        ),
      ),
      'moons' => 
      array (
        'title' => 'Moon Registry',
        'layout' => 'moons',
        'controls' => 
        array (
          0 => 'Inspect moon',
          1 => 'Build jump gate',
        ),
        'actions' => 
        array (
          0 => 'moon_details',
          1 => 'mothership_upgrade',
        ),
        'tables' => 
        array (
          0 => 'universe_moons',
          1 => 'universe_planets',
        ),
      ),
      'coordinates' => 
      array (
        'title' => 'Coordinate Search',
        'layout' => 'coordinates',
        'controls' => 
        array (
          0 => 'Search coordinates',
          1 => 'Open system',
        ),
        'actions' => 
        array (
          0 => 'coordinate_lookup',
        ),
        'tables' => 
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_discoveries',
          5 => 'player_colonies',
        ),
      ),
    ),
  ),
  'overview' => 
  array (
    'label' => 'Overview',
    'icon' => '◆',
    'pages' => 
    array (
      'overview-dashboard' => 
      array (
        'title' => 'Dashboard',
        'layout' => 'dashboard',
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
      ),
      'empire-overview' => 
      array (
        'title' => 'Empire Overview',
        'layout' => 'dashboard',
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
      ),
      'active-operations' => 
      array (
        'title' => 'Active Operations',
        'layout' => 'dashboard',
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
      ),
      'alerts' => 
      array (
        'title' => 'Alerts',
        'layout' => 'dashboard',
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
      ),
      'tutorial-objectives' => 
      array (
        'title' => 'Tutorial / Objectives',
        'layout' => 'dashboard',
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
      ),
    ),
  ),
  'empire' => 
  array (
    'label' => 'Empire',
    'icon' => '◆',
    'pages' => 
    array (
      'planets' => 
      array (
        'title' => 'Planets',
        'layout' => 'economy',
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
      ),
      'colonies' => 
      array (
        'title' => 'Colonies',
        'layout' => 'economy',
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
      ),
      'empire-moons' => 
      array (
        'title' => 'Moons',
        'layout' => 'economy',
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
      ),
      'buildings' => 
      array (
        'title' => 'Buildings',
        'layout' => 'economy',
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
      ),
      'facilities' => 
      array (
        'title' => 'Facilities',
        'layout' => 'economy',
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
      ),
      'storage' => 
      array (
        'title' => 'Storage',
        'layout' => 'economy',
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
      ),
      'population' => 
      array (
        'title' => 'Population',
        'layout' => 'economy',
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
      ),
      'planet-specialization' => 
      array (
        'title' => 'Planet Specialization',
        'layout' => 'economy',
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
      ),
    ),
  ),
  'resources' => 
  array (
    'label' => 'Resources',
    'icon' => '◆',
    'pages' => 
    array (
      'resource-overview' => 
      array (
        'title' => 'Resource Overview',
        'layout' => 'economy',
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
      ),
      'metal' => 
      array (
        'title' => 'Metal',
        'layout' => 'economy',
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
      ),
      'crystal' => 
      array (
        'title' => 'Crystal',
        'layout' => 'economy',
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
      ),
      'deuterium' => 
      array (
        'title' => 'Deuterium',
        'layout' => 'economy',
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
      ),
      'naquadah' => 
      array (
        'title' => 'Naquadah',
        'layout' => 'economy',
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
      ),
      'energy' => 
      array (
        'title' => 'Energy',
        'layout' => 'economy',
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
      ),
      'dark-matter' => 
      array (
        'title' => 'Dark Matter',
        'layout' => 'economy',
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
      ),
      'production' => 
      array (
        'title' => 'Production',
        'layout' => 'economy',
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
      ),
      'energy-grid' => 
      array (
        'title' => 'Energy Grid',
        'layout' => 'economy',
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
      ),
    ),
  ),
  'construction' => 
  array (
    'label' => 'Construction',
    'icon' => '◆',
    'pages' => 
    array (
      'construction-buildings' => 
      array (
        'title' => 'Buildings',
        'layout' => 'facilities',
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
      ),
      'construction-facilities' => 
      array (
        'title' => 'Facilities',
        'layout' => 'facilities',
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
      ),
      'construction-queue' => 
      array (
        'title' => 'Construction Queue',
        'layout' => 'facilities',
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
      ),
      'shipyard' => 
      array (
        'title' => 'Shipyard',
        'layout' => 'facilities',
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
      ),
      'defense' => 
      array (
        'title' => 'Defense',
        'layout' => 'facilities',
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
      ),
      'robotics' => 
      array (
        'title' => 'Robotics',
        'layout' => 'facilities',
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
      ),
      'nanite-factory' => 
      array (
        'title' => 'Nanite Factory',
        'layout' => 'facilities',
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
      ),
      'terraformer' => 
      array (
        'title' => 'Terraformer',
        'layout' => 'facilities',
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
      ),
      'space-dock' => 
      array (
        'title' => 'Space Dock',
        'layout' => 'facilities',
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
      ),
    ),
  ),
  'research' => 
  array (
    'label' => 'Research',
    'icon' => '◆',
    'pages' => 
    array (
      'research-technology' => 
      array (
        'title' => 'Technology',
        'layout' => 'technology',
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
      ),
      'advanced-research' => 
      array (
        'title' => 'Advanced Research',
        'layout' => 'technology',
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
      ),
      'combat' => 
      array (
        'title' => 'Combat',
        'layout' => 'technology',
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
      ),
      'propulsion' => 
      array (
        'title' => 'Propulsion',
        'layout' => 'technology',
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
      ),
      'espionage' => 
      array (
        'title' => 'Espionage',
        'layout' => 'technology',
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
      ),
      'astrophysics' => 
      array (
        'title' => 'Astrophysics',
        'layout' => 'technology',
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
      ),
      'stargate-technology' => 
      array (
        'title' => 'Stargate Technology',
        'layout' => 'technology',
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
      ),
      'mothership-technology' => 
      array (
        'title' => 'Mothership Technology',
        'layout' => 'technology',
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
      ),
      'lifeform-research' => 
      array (
        'title' => 'Lifeform Research',
        'layout' => 'technology',
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
      ),
      'ascension-research' => 
      array (
        'title' => 'Ascension Research',
        'layout' => 'technology',
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
      ),
    ),
  ),
  'fleet' => 
  array (
    'label' => 'Fleet',
    'icon' => '◆',
    'pages' => 
    array (
      'fleet-manager' => 
      array (
        'title' => 'Fleet Manager',
        'layout' => 'fleet',
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
      ),
      'starships' => 
      array (
        'title' => 'Starships',
        'layout' => 'fleet',
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
      ),
      'motherships' => 
      array (
        'title' => 'Motherships',
        'layout' => 'fleet',
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
      ),
      'ship-upgrades' => 
      array (
        'title' => 'Ship Upgrades',
        'layout' => 'fleet',
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
      ),
      'formations' => 
      array (
        'title' => 'Formations',
        'layout' => 'fleet',
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
      ),
      'fleet-missions' => 
      array (
        'title' => 'Fleet Missions',
        'layout' => 'fleet',
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
      ),
      'expeditions' => 
      array (
        'title' => 'Expeditions',
        'layout' => 'fleet',
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
      ),
      'fleet-save' => 
      array (
        'title' => 'Fleet Save',
        'layout' => 'fleet',
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
      ),
      'acs' => 
      array (
        'title' => 'ACS',
        'layout' => 'fleet',
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
      ),
    ),
  ),
  'military' => 
  array (
    'label' => 'Military',
    'icon' => '◆',
    'pages' => 
    array (
      'ground-forces' => 
      array (
        'title' => 'Ground Forces',
        'layout' => 'combat',
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
      ),
      'military-units' => 
      array (
        'title' => 'Units',
        'layout' => 'combat',
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
      ),
      'officers' => 
      array (
        'title' => 'Officers',
        'layout' => 'combat',
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
      ),
      'training-center' => 
      array (
        'title' => 'Training Center',
        'layout' => 'combat',
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
      ),
      'planetary-defense' => 
      array (
        'title' => 'Planetary Defense',
        'layout' => 'combat',
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
      ),
      'missile-warfare' => 
      array (
        'title' => 'Missile Warfare',
        'layout' => 'combat',
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
      ),
      'combat-simulator' => 
      array (
        'title' => 'Combat Simulator',
        'layout' => 'combat',
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
      ),
      'war-room' => 
      array (
        'title' => 'War Room',
        'layout' => 'combat',
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
      ),
      'campaigns' => 
      array (
        'title' => 'Campaigns',
        'layout' => 'combat',
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
      ),
    ),
  ),
  'galaxy' => 
  array (
    'label' => 'Galaxy',
    'icon' => '◆',
    'pages' => 
    array (
      'galaxy-view' => 
      array (
        'title' => 'Galaxy View',
        'layout' => 'galaxies',
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
      ),
      'galaxy-map' => 
      array (
        'title' => 'Galaxy Map',
        'layout' => 'galaxies',
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
      ),
      'galaxy-solar-systems' => 
      array (
        'title' => 'Solar Systems',
        'layout' => 'galaxies',
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
      ),
      '3d-universe' => 
      array (
        'title' => '3D Universe',
        'layout' => 'galaxies',
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
      ),
      'galaxy-sectors' => 
      array (
        'title' => 'Sectors',
        'layout' => 'galaxies',
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
      ),
      'realm-systems' => 
      array (
        'title' => 'Realm Systems',
        'layout' => 'galaxies',
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
      ),
      'stargate-network' => 
      array (
        'title' => 'Stargate Network',
        'layout' => 'galaxies',
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
      ),
      'wormholes' => 
      array (
        'title' => 'Wormholes',
        'layout' => 'galaxies',
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
      ),
      'anomalies' => 
      array (
        'title' => 'Anomalies',
        'layout' => 'galaxies',
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
      ),
      'npc-factions' => 
      array (
        'title' => 'NPC Factions',
        'layout' => 'galaxies',
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
      ),
      'seed-discovery' => 
      array (
        'title' => 'Seed Discovery',
        'layout' => 'galaxies',
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
      ),
      'galactic-calendar' => 
      array (
        'title' => 'Galactic Calendar',
        'layout' => 'galaxies',
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
      ),
    ),
  ),
  'economy' => 
  array (
    'label' => 'Economy',
    'icon' => '◆',
    'pages' => 
    array (
      'marketplace' => 
      array (
        'title' => 'Marketplace',
        'layout' => 'market',
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
      ),
      'resource-trading' => 
      array (
        'title' => 'Resource Trading',
        'layout' => 'market',
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
      ),
      'trade-routes' => 
      array (
        'title' => 'Trade Routes',
        'layout' => 'market',
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
      ),
      'merchant' => 
      array (
        'title' => 'Merchant',
        'layout' => 'market',
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
      ),
      'auction-house' => 
      array (
        'title' => 'Auction House',
        'layout' => 'market',
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
      ),
      'black-market' => 
      array (
        'title' => 'Black Market',
        'layout' => 'market',
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
      ),
      'insurance' => 
      array (
        'title' => 'Insurance',
        'layout' => 'market',
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
      ),
    ),
  ),
  'crafting' => 
  array (
    'label' => 'Crafting',
    'icon' => '◆',
    'pages' => 
    array (
      'workshop' => 
      array (
        'title' => 'Workshop',
        'layout' => 'crafting',
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
      ),
      'master-crafting' => 
      array (
        'title' => 'Master Crafting',
        'layout' => 'crafting',
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
      ),
      'crafting-rank' => 
      array (
        'title' => 'Crafting Rank',
        'layout' => 'crafting',
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
      ),
      'materials' => 
      array (
        'title' => 'Materials',
        'layout' => 'crafting',
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
      ),
      'materials-lab' => 
      array (
        'title' => 'Materials Lab',
        'layout' => 'crafting',
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
      ),
      'dismantling' => 
      array (
        'title' => 'Dismantling',
        'layout' => 'crafting',
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
      ),
      'augmentations' => 
      array (
        'title' => 'Augmentations',
        'layout' => 'crafting',
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
      ),
      'artifacts' => 
      array (
        'title' => 'Artifacts',
        'layout' => 'crafting',
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
      ),
      'blueprints' => 
      array (
        'title' => 'Blueprints',
        'layout' => 'crafting',
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
      ),
    ),
  ),
  'alliance' => 
  array (
    'label' => 'Alliance',
    'icon' => '◆',
    'pages' => 
    array (
      'alliance-hub' => 
      array (
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
      ),
      'members' => 
      array (
        'title' => 'Members',
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
      ),
      'commanders' => 
      array (
        'title' => 'Commanders',
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
      ),
      'alliance-officers' => 
      array (
        'title' => 'Officers',
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
      ),
      'diplomacy' => 
      array (
        'title' => 'Diplomacy',
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
      ),
      'war' => 
      array (
        'title' => 'War',
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
      ),
      'alliance-acs' => 
      array (
        'title' => 'ACS',
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
      ),
      'alliance-logistics' => 
      array (
        'title' => 'Alliance Logistics',
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
      ),
      'alliance-stargates' => 
      array (
        'title' => 'Alliance Stargates',
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
      ),
      'alliance-intelligence' => 
      array (
        'title' => 'Alliance Intelligence',
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
      ),
    ),
  ),
  'lifeforms' => 
  array (
    'label' => 'Lifeforms',
    'icon' => '◆',
    'pages' => 
    array (
      'lifeforms-population' => 
      array (
        'title' => 'Population',
        'layout' => 'generic',
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
      ),
      'food' => 
      array (
        'title' => 'Food',
        'layout' => 'generic',
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
      ),
      'lifeform-buildings' => 
      array (
        'title' => 'Lifeform Buildings',
        'layout' => 'generic',
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
      ),
      'lifeforms-lifeform-research' => 
      array (
        'title' => 'Lifeform Research',
        'layout' => 'generic',
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
      ),
      'civilization-tier' => 
      array (
        'title' => 'Civilization Tier',
        'layout' => 'generic',
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
      ),
      'traits' => 
      array (
        'title' => 'Traits',
        'layout' => 'generic',
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
      ),
      'lifeform-bonuses' => 
      array (
        'title' => 'Lifeform Bonuses',
        'layout' => 'generic',
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
      ),
    ),
  ),
  'activities' => 
  array (
    'label' => 'Activities',
    'icon' => '◆',
    'pages' => 
    array (
      'quests' => 
      array (
        'title' => 'Quests',
        'layout' => 'activities',
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
      ),
      'activities-expeditions' => 
      array (
        'title' => 'Expeditions',
        'layout' => 'activities',
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
      ),
      'pirate-hunting' => 
      array (
        'title' => 'Pirate Hunting',
        'layout' => 'activities',
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
      ),
      'bounty-board' => 
      array (
        'title' => 'Bounty Board',
        'layout' => 'activities',
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
      ),
      'world-bosses' => 
      array (
        'title' => 'World Bosses',
        'layout' => 'activities',
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
      ),
      'activities-anomalies' => 
      array (
        'title' => 'Anomalies',
        'layout' => 'activities',
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
      ),
      'activities-campaigns' => 
      array (
        'title' => 'Campaigns',
        'layout' => 'activities',
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
      ),
      'achievements' => 
      array (
        'title' => 'Achievements',
        'layout' => 'activities',
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
      ),
      'seasonal-events' => 
      array (
        'title' => 'Seasonal Events',
        'layout' => 'activities',
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
      ),
    ),
  ),
  'prestige' => 
  array (
    'label' => 'Prestige',
    'icon' => '◆',
    'pages' => 
    array (
      'glory' => 
      array (
        'title' => 'Glory',
        'layout' => 'progression',
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
      ),
      'reputation' => 
      array (
        'title' => 'Reputation',
        'layout' => 'progression',
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
      ),
      'prestige-ascension' => 
      array (
        'title' => 'Ascension',
        'layout' => 'progression',
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
      ),
      're-ascension' => 
      array (
        'title' => 'Re-Ascension',
        'layout' => 'progression',
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
      ),
      'ascended-races' => 
      array (
        'title' => 'Ascended Races',
        'layout' => 'progression',
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
      ),
      'titles' => 
      array (
        'title' => 'Titles',
        'layout' => 'progression',
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
      ),
      'permanent-bonuses' => 
      array (
        'title' => 'Permanent Bonuses',
        'layout' => 'progression',
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
      ),
    ),
  ),
  'rankings' => 
  array (
    'label' => 'Rankings',
    'icon' => '◆',
    'pages' => 
    array (
      'empire' => 
      array (
        'title' => 'Empire',
        'layout' => 'rankings',
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
      ),
      'economy' => 
      array (
        'title' => 'Economy',
        'layout' => 'rankings',
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
      ),
      'fleet' => 
      array (
        'title' => 'Fleet',
        'layout' => 'rankings',
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
      ),
      'research' => 
      array (
        'title' => 'Research',
        'layout' => 'rankings',
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
      ),
      'rankings-defense' => 
      array (
        'title' => 'Defense',
        'layout' => 'rankings',
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
      ),
      'covert' => 
      array (
        'title' => 'Covert',
        'layout' => 'rankings',
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
      ),
      'alliance' => 
      array (
        'title' => 'Alliance',
        'layout' => 'rankings',
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
      ),
      'lifeform' => 
      array (
        'title' => 'Lifeform',
        'layout' => 'rankings',
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
      ),
      'galactic-control' => 
      array (
        'title' => 'Galactic Control',
        'layout' => 'rankings',
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
      ),
    ),
  ),
  'premium' => 
  array (
    'label' => 'Premium',
    'icon' => '◆',
    'pages' => 
    array (
      'store' => 
      array (
        'title' => 'Store',
        'layout' => 'premium',
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
      ),
      'premium-officers' => 
      array (
        'title' => 'Officers',
        'layout' => 'premium',
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
      ),
      'commander' => 
      array (
        'title' => 'Commander',
        'layout' => 'premium',
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
      ),
      'premium-services' => 
      array (
        'title' => 'Premium Services',
        'layout' => 'premium',
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
      ),
    ),
  ),
);

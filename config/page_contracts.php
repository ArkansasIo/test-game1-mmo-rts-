<?php
return array (
  'generated_at' => '2026-08-21T00:13:24+00:00',
  'page_count' => 43,
  'routes' =>
  array (
    'dashboard' =>
    array (
      'route' => 'dashboard',
      'group' => 'command-center',
      'group_label' => 'Command Center',
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
      'details' =>
      array (
      ),
      'interaction' =>
      array (
        'page' => 'Command Center',
        'purpose' => 'Read the commander state and issue high-level intent.',
        'buttons' =>
        array (
          'Process turns' =>
          array (
            'action' => 'process_turns',
            'logic' => 'Lock player state, settle elapsed turns, production, upkeep, queues, missions, rankings, and events.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'player_resources',
              2 => 'player_colonies',
              3 => 'construction_queue',
              4 => 'fleet_missions',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'game_events',
              2 => 'rankings',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Choose target' =>
          array (
            'action' => 'navigate:targets',
            'logic' => 'Open known-realm target board without mutating state.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'target_realms',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
            ),
          ),
          'Review reports' =>
          array (
            'action' => 'navigate:attack-log',
            'logic' => 'Open unread combat and intelligence reports.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'battle_reports',
              1 => 'intelligence_reports',
              2 => 'messages',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Coordinate colony, economy, queues, fleets, alerts, and turn settlement.',
        'workflow' =>
        array (
          0 => 'load authoritative state',
          1 => 'validate commander intent',
          2 => 'settle bounded turn window',
          3 => 'return refreshed state',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'CSRF token',
          2 => 'RBAC permission',
          3 => 'transaction boundary',
        ),
        'calculations' =>
        array (
          0 => 'resource settlement',
          1 => 'food and water upkeep',
          2 => 'queue completion',
          3 => 'fleet ETA',
        ),
        'mutations' =>
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'fleet_missions',
          3 => 'game_events',
          4 => 'rankings',
        ),
      ),
      'features' =>
      array (
        0 => 'eight-resource HUD',
        1 => 'colony life support',
        2 => 'building and research queues',
        3 => 'fleet mission board',
        4 => 'universal progression',
        5 => 'server feedback',
      ),
      'design' =>
      array (
        'template' => 'command-center',
        'sections' =>
        array (
          0 => 'identity header',
          1 => 'resource strip',
          2 => 'colony overview',
          3 => 'server actions',
          4 => 'queues',
          5 => 'life support',
          6 => 'fleet control',
          7 => 'progression',
          8 => 'alerts',
        ),
        'components' =>
        array (
          0 => 'resource-tile',
          1 => 'metric-grid',
          2 => 'action-panel',
          3 => 'status-badge',
          4 => 'data-table',
        ),
        'responsive' => '12-column desktop grid collapses to stacked mobile panels',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'GameService',
          1 => 'DashboardService',
          2 => 'ProgressionService',
        ),
        'reads' =>
        array (
          0 => 'players',
          1 => 'player_resources',
          2 => 'player_colonies',
          3 => 'construction_queue',
          4 => 'fleet_missions',
          5 => 'rankings',
          6 => 'game_events',
        ),
        'writes' =>
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'fleet_missions',
          3 => 'rankings',
          4 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'process_turns',
          1 => 'choose_target',
          2 => 'review_reports',
          3 => 'progression_advance',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/command-center/dashboard.php',
        'features' => 'config/page_features/command-center/dashboard.php',
        'design' => 'config/page_design_specs/command-center/dashboard.php',
        'systems' => 'config/page_systems/command-center/dashboard.php',
        'module' => 'includes/page_modules/command-center/dashboard.php',
      ),
    ),
    'account-info' =>
    array (
      'route' => 'account-info',
      'group' => 'command-center',
      'group_label' => 'Command Center',
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
      'details' =>
      array (
      ),
      'interaction' =>
      array (
        'page' => 'Account Information',
        'purpose' => 'Read commander identity, race, government, rank, protection, and progression.',
        'buttons' =>
        array (
          'View profile' =>
          array (
            'action' => 'read_profile',
            'logic' => 'Return safe public and private account fields for the authenticated player.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'races',
              2 => 'government_types',
              3 => 'rankings',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'error',
            ),
          ),
          'View rank' =>
          array (
            'action' => 'read_rank',
            'logic' => 'Return current rank, score, Glory, Reputation, and progression history.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'rankings',
              1 => 'player_progression',
              2 => 'glory_reputation',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'error',
            ),
          ),
          'View protection' =>
          array (
            'action' => 'read_protection',
            'logic' => 'Return vacation, protection, attack cooldown, and DefCon state.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'protection_states',
              1 => 'players',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Read commander identity, faction, rank, protection, and progression.',
        'workflow' =>
        array (
          0 => 'load commander',
          1 => 'load faction and government',
          2 => 'load rank and progression',
          3 => 'render read-only profile',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'ownership scope',
        ),
        'calculations' =>
        array (
          0 => 'combined faction modifier',
          1 => 'rank score',
        ),
        'mutations' =>
        array (
        ),
      ),
      'features' =>
      array (
        0 => 'commander profile',
        1 => 'race and government identity',
        2 => 'rank summary',
        3 => 'protection state',
        4 => 'progression summary',
        5 => 'session security',
      ),
      'design' =>
      array (
        'template' => 'account-details',
        'sections' =>
        array (
          0 => 'profile',
          1 => 'faction identity',
          2 => 'progression',
          3 => 'protection',
          4 => 'security',
        ),
        'components' =>
        array (
          0 => 'profile-metric',
          1 => 'modifier-row',
          2 => 'security-badge',
        ),
        'responsive' => 'Two-column details collapse to one column',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'AccountService',
          1 => 'ProgressionService',
        ),
        'reads' =>
        array (
          0 => 'players',
          1 => 'races',
          2 => 'government_types',
          3 => 'rankings',
          4 => 'player_progression',
          5 => 'protection_states',
          6 => 'glory_reputation',
        ),
        'writes' =>
        array (
        ),
        'actions' =>
        array (
          0 => 'read_profile',
          1 => 'read_rank',
          2 => 'read_protection',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/command-center/account-info.php',
        'features' => 'config/page_features/command-center/account-info.php',
        'design' => 'config/page_design_specs/command-center/account-info.php',
        'systems' => 'config/page_systems/command-center/account-info.php',
        'module' => 'includes/page_modules/command-center/account-info.php',
      ),
    ),
    'resources' =>
    array (
      'route' => 'resources',
      'group' => 'command-center',
      'group_label' => 'Command Center',
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
      'details' =>
      array (
      ),
      'interaction' =>
      array (
        'page' => 'Resources and Vault',
        'purpose' => 'Manage five strategic resources, protected reserves, production, upkeep, and Dark Matter.',
        'buttons' =>
        array (
          'Deposit' =>
          array (
            'action' => 'deposit',
            'logic' => 'Validate amount and move available Naquadah into the protected vault.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Withdraw' =>
          array (
            'action' => 'withdraw',
            'logic' => 'Validate vault balance and move Naquadah into the available balance.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage the eight-resource ledger and protected Naquadah vault.',
        'workflow' =>
        array (
          0 => 'load resource ledger',
          1 => 'validate transfer amount',
          2 => 'lock resource row',
          3 => 'move balance transactionally',
          4 => 'write audit event',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'CSRF token',
          2 => 'positive amount',
          3 => 'available or vault balance',
          4 => 'RBAC permission',
        ),
        'calculations' =>
        array (
          0 => 'available Naquadah',
          1 => 'protected vault balance',
          2 => 'eight-resource totals',
          3 => 'transfer delta',
        ),
        'mutations' =>
        array (
          0 => 'player_resources',
          1 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'eight-resource ledger',
        1 => 'Naquadah vault',
        2 => 'deposit',
        3 => 'withdraw',
        4 => 'balance validation',
        5 => 'transaction feedback',
      ),
      'design' =>
      array (
        'template' => 'resource-vault',
        'sections' =>
        array (
          0 => 'balance cards',
          1 => 'resource ledger',
          2 => 'transfer controls',
          3 => 'server contract',
          4 => 'feedback states',
        ),
        'components' =>
        array (
          0 => 'resource-card',
          1 => 'transfer-form',
          2 => 'balance-row',
          3 => 'validation-banner',
        ),
        'responsive' => 'Resource cards flow from four columns to one column',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'GameService',
          1 => 'EconomyService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'game_settings',
        ),
        'writes' =>
        array (
          0 => 'player_resources',
          1 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'deposit',
          1 => 'withdraw',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/command-center/resources.php',
        'features' => 'config/page_features/command-center/resources.php',
        'design' => 'config/page_design_specs/command-center/resources.php',
        'systems' => 'config/page_systems/command-center/resources.php',
        'module' => 'includes/page_modules/command-center/resources.php',
      ),
    ),
    'income' =>
    array (
      'route' => 'income',
      'group' => 'command-center',
      'group_label' => 'Command Center',
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
      'details' =>
      array (
        'hero' => 'Income Breakdown',
        'panels' =>
        array (
          0 => 'Base income',
          1 => 'Race and government modifiers',
          2 => 'Colony production',
          3 => 'Food, water, and energy upkeep',
        ),
        'formula' => 'settlement = (base production × race modifier × government modifier × technology) − upkeep',
        'controls' =>
        array (
          0 => 'View per-turn formula',
          1 => 'Compare colonies',
          2 => 'Open resources',
        ),
        'action' => NULL,
        'tables' =>
        array (
          0 => 'player_resources',
          1 => 'player_colonies',
          2 => 'races',
          3 => 'government_types',
          4 => 'technologies',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'protected',
          3 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Income Breakdown',
        'purpose' => 'Explain production and upkeep.',
        'buttons' =>
        array (
          'View income formula' =>
          array (
            'action' => 'read_income_breakdown',
            'logic' => 'Calculate base output, race modifier, government modifier, technology, biome, and upkeep.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_resources',
              1 => 'player_colonies',
              2 => 'races',
              3 => 'government_types',
              4 => 'technologies',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'error',
            ),
          ),
          'Compare colonies' =>
          array (
            'action' => 'read_colony_comparison',
            'logic' => 'Compare production and life-support efficiency across owned colonies.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Explain production settlement by colony, faction, government, technology, biome, and upkeep.',
        'workflow' =>
        array (
          0 => 'load colony production',
          1 => 'load modifiers',
          2 => 'calculate gross output',
          3 => 'calculate food water energy upkeep',
          4 => 'render net settlement',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'owned colony scope',
        ),
        'calculations' =>
        array (
          0 => 'base production × race modifier × government modifier × technology − upkeep',
          1 => 'colony comparison',
          2 => 'life-support efficiency',
        ),
        'mutations' =>
        array (
        ),
      ),
      'features' =>
      array (
        0 => 'income formula',
        1 => 'modifier breakdown',
        2 => 'colony comparison',
        3 => 'food water energy upkeep',
        4 => 'production forecast',
        5 => 'read-only state',
      ),
      'design' =>
      array (
        'template' => 'income-breakdown',
        'sections' =>
        array (
          0 => 'formula',
          1 => 'modifier table',
          2 => 'colony production',
          3 => 'upkeep',
          4 => 'feedback states',
        ),
        'components' =>
        array (
          0 => 'formula-block',
          1 => 'modifier-row',
          2 => 'forecast-metric',
          3 => 'comparison-table',
        ),
        'responsive' => 'Formula and comparison sections stack on small screens',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'EconomyService',
          1 => 'ColonyService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'player_colonies',
          2 => 'races',
          3 => 'government_types',
          4 => 'technologies',
          5 => 'universe_planets',
        ),
        'writes' =>
        array (
        ),
        'actions' =>
        array (
          0 => 'read_income_breakdown',
          1 => 'read_colony_comparison',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/command-center/income.php',
        'features' => 'config/page_features/command-center/income.php',
        'design' => 'config/page_design_specs/command-center/income.php',
        'systems' => 'config/page_systems/command-center/income.php',
        'module' => 'includes/page_modules/command-center/income.php',
      ),
    ),
    'military-stats' =>
    array (
      'route' => 'military-stats',
      'group' => 'command-center',
      'group_label' => 'Command Center',
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
      'details' =>
      array (
        'hero' => 'Military Statistics',
        'panels' =>
        array (
          0 => 'Attack power',
          1 => 'Defense power',
          2 => 'Covert power',
          3 => 'Readiness and DefCon',
        ),
        'formula' => 'power = units × base power × technology × race × government × planet bonus',
        'controls' =>
        array (
          0 => 'View attack',
          1 => 'View defense',
          2 => 'View covert',
          3 => 'Set DefCon',
        ),
        'action' => 'set_defcon',
        'tables' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'rankings',
          3 => 'protection_states',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'cooldown',
          3 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Military Statistics',
        'purpose' => 'Show attack, defense, covert, and readiness values.',
        'buttons' =>
        array (
          'View attack' =>
          array (
            'action' => 'read_military_stats',
            'logic' => 'Aggregate units, weapons, technologies, race, government, and planet bonuses.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_resources',
              1 => 'player_unit_stats',
              2 => 'player_weapons',
              3 => 'technologies',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'error',
            ),
          ),
          'Set DefCon' =>
          array (
            'action' => 'set_defcon',
            'logic' => 'Validate level, update alert posture, and apply income or defense effects.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'protection_states',
            ),
            'writes' =>
            array (
              0 => 'players',
              1 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'invalid-input',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Aggregate military, defense, covert, anti-covert, readiness, and DefCon values.',
        'workflow' =>
        array (
          0 => 'load units and weapons',
          1 => 'load technology and faction modifiers',
          2 => 'calculate power totals',
          3 => 'read protection and DefCon',
          4 => 'render readiness',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'valid DefCon level for mutation',
        ),
        'calculations' =>
        array (
          0 => 'units × base power × technology × race × government × planet bonus',
          1 => 'readiness score',
          2 => 'DefCon effect',
        ),
        'mutations' =>
        array (
          0 => 'players',
          1 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'attack power',
        1 => 'defense power',
        2 => 'covert power',
        3 => 'anti-covert power',
        4 => 'readiness',
        5 => 'DefCon control',
      ),
      'design' =>
      array (
        'template' => 'military-statistics',
        'sections' =>
        array (
          0 => 'power totals',
          1 => 'unit breakdown',
          2 => 'technology modifiers',
          3 => 'readiness',
          4 => 'DefCon',
        ),
        'components' =>
        array (
          0 => 'power-metric',
          1 => 'modifier-table',
          2 => 'defcon-selector',
          3 => 'readiness-bar',
        ),
        'responsive' => 'Stat grid reduces from four columns to one',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MilitaryService',
          1 => 'GameService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'player_weapons',
          3 => 'technologies',
          4 => 'rankings',
          5 => 'protection_states',
        ),
        'writes' =>
        array (
          0 => 'players',
          1 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'read_military_stats',
          1 => 'set_defcon',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/command-center/military-stats.php',
        'features' => 'config/page_features/command-center/military-stats.php',
        'design' => 'config/page_design_specs/command-center/military-stats.php',
        'systems' => 'config/page_systems/command-center/military-stats.php',
        'module' => 'includes/page_modules/command-center/military-stats.php',
      ),
    ),
    'targets' =>
    array (
      'route' => 'targets',
      'group' => 'attack',
      'group_label' => 'Attack',
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
      'details' =>
      array (
        'hero' => 'Target Selection',
        'panels' =>
        array (
          0 => 'Known realms',
          1 => 'Protection status',
          2 => 'Combat preview',
          3 => 'Operation costs',
        ),
        'formula' => 'battle outcome = validated force comparison + technology + defense + deterministic resolver',
        'controls' =>
        array (
          0 => 'Attack',
          1 => 'Raid',
          2 => 'Spy',
          3 => 'Sabotage',
          4 => 'Conquer planet',
          5 => 'Message',
        ),
        'action' => 'combat',
        'tables' =>
        array (
          0 => 'target_realms',
          1 => 'players',
          2 => 'rankings',
          3 => 'protection_states',
          4 => 'battles',
        ),
        'permission' => 'authenticated commander with attack turns',
        'states' =>
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Target Selection',
        'purpose' => 'Choose and preview offensive or covert operations.',
        'buttons' =>
        array (
          'Attack' =>
          array (
            'action' => 'combat',
            'logic' => 'Validate target, protection, attack turns, fleet or units, then resolve combat transactionally.',
            'permission' => 'authenticated commander with attack turns',
            'reads' =>
            array (
              0 => 'target_realms',
              1 => 'players',
              2 => 'battles',
              3 => 'protection_states',
            ),
            'writes' =>
            array (
              0 => 'battles',
              1 => 'battle_rounds',
              2 => 'battle_reports',
              3 => 'attack_logs',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'insufficient-resource',
              3 => 'cooldown',
              4 => 'success',
              5 => 'error',
            ),
          ),
          'Raid' =>
          array (
            'action' => 'combat:raid',
            'logic' => 'Resolve reduced-force combat with resource-loot rules.',
            'permission' => 'authenticated commander with attack turns',
            'reads' =>
            array (
              0 => 'target_realms',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'battles',
              1 => 'battle_reports',
              2 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Spy' =>
          array (
            'action' => 'covert:spy',
            'logic' => 'Allocate agents, calculate detection, and generate intelligence payload.',
            'permission' => 'authenticated commander with spies',
            'reads' =>
            array (
              0 => 'covert_agents',
              1 => 'anti_covert_agents',
              2 => 'technologies',
            ),
            'writes' =>
            array (
              0 => 'spy_missions',
              1 => 'intelligence_reports',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Sabotage' =>
          array (
            'action' => 'covert:sabotage',
            'logic' => 'Target a system, calculate detection, and apply bounded damage.',
            'permission' => 'authenticated commander with spies',
            'reads' =>
            array (
              0 => 'covert_agents',
              1 => 'target_realms',
            ),
            'writes' =>
            array (
              0 => 'sabotage_missions',
              1 => 'intelligence_reports',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Select targets and preview combat, raid, covert, sabotage, and conquest operations.',
        'workflow' =>
        array (
          0 => 'load visible realms',
          1 => 'verify protection',
          2 => 'calculate operation cost',
          3 => 'compare forces',
          4 => 'submit chosen operation',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'attack turns',
          2 => 'target ownership scope',
          3 => 'protection rules',
          4 => 'fleet or unit availability',
        ),
        'calculations' =>
        array (
          0 => 'validated force comparison + technology + defense + deterministic resolver',
          1 => 'operation cost',
          2 => 'loot preview',
        ),
        'mutations' =>
        array (
          0 => 'battles',
          1 => 'battle_rounds',
          2 => 'battle_reports',
          3 => 'attack_logs',
          4 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'known realm search',
        1 => 'protection badges',
        2 => 'combat preview',
        3 => 'operation cost',
        4 => 'attack',
        5 => 'raid',
        6 => 'spy',
        7 => 'sabotage',
      ),
      'design' =>
      array (
        'template' => 'target-board',
        'sections' =>
        array (
          0 => 'filters',
          1 => 'target rows',
          2 => 'protection',
          3 => 'combat preview',
          4 => 'operation controls',
        ),
        'components' =>
        array (
          0 => 'target-table',
          1 => 'protection-badge',
          2 => 'cost-preview',
          3 => 'operation-buttons',
        ),
        'responsive' => 'Target table becomes stacked target rows',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'CombatService',
          1 => 'CovertService',
          2 => 'TargetingService',
        ),
        'reads' =>
        array (
          0 => 'target_realms',
          1 => 'players',
          2 => 'rankings',
          3 => 'protection_states',
          4 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'battles',
          1 => 'battle_rounds',
          2 => 'battle_reports',
          3 => 'attack_logs',
          4 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'combat',
          1 => 'combat:raid',
          2 => 'covert:spy',
          3 => 'covert:sabotage',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/attack/targets.php',
        'features' => 'config/page_features/attack/targets.php',
        'design' => 'config/page_design_specs/attack/targets.php',
        'systems' => 'config/page_systems/attack/targets.php',
        'module' => 'includes/page_modules/attack/targets.php',
      ),
    ),
    'spy' =>
    array (
      'route' => 'spy',
      'group' => 'attack',
      'group_label' => 'Attack',
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
      'details' =>
      array (
        'hero' => 'Covert Operations',
        'panels' =>
        array (
          0 => 'Agent allocation',
          1 => 'Detection chance',
          2 => 'Target intelligence',
          3 => 'Mission result',
        ),
        'formula' => 'detection = defender counter-intelligence − attacker agents − covert technology',
        'controls' =>
        array (
          0 => 'Reconnaissance',
          1 => 'Spy mission',
          2 => 'Sabotage mission',
        ),
        'action' => 'covert',
        'tables' =>
        array (
          0 => 'covert_agents',
          1 => 'anti_covert_agents',
          2 => 'covert_missions',
          3 => 'spy_missions',
          4 => 'sabotage_missions',
          5 => 'intelligence_reports',
        ),
        'permission' => 'authenticated commander with available agents',
        'states' =>
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Spy and Sabotage Operations',
        'purpose' => 'Manage covert agent operations.',
        'buttons' =>
        array (
          'Run reconnaissance' =>
          array (
            'action' => 'covert:recon',
            'logic' => 'Generate low-risk target intelligence with detection calculation.',
            'permission' => 'authenticated commander with agents',
            'reads' =>
            array (
              0 => 'covert_agents',
              1 => 'target_realms',
            ),
            'writes' =>
            array (
              0 => 'covert_missions',
              1 => 'intelligence_reports',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Run spy mission' =>
          array (
            'action' => 'covert:spy',
            'logic' => 'Resolve spy mission and store report.',
            'permission' => 'authenticated commander with spies',
            'reads' =>
            array (
              0 => 'spy_missions',
              1 => 'technologies',
            ),
            'writes' =>
            array (
              0 => 'spy_missions',
              1 => 'intelligence_reports',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
          'Run sabotage' =>
          array (
            'action' => 'covert:sabotage',
            'logic' => 'Resolve sabotage with detection and damage caps.',
            'permission' => 'authenticated commander with spies',
            'reads' =>
            array (
              0 => 'sabotage_missions',
              1 => 'target_realms',
            ),
            'writes' =>
            array (
              0 => 'sabotage_missions',
              1 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Run reconnaissance, spy, and sabotage missions using agents and covert technology.',
        'workflow' =>
        array (
          0 => 'load agent pools',
          1 => 'select mission type',
          2 => 'calculate detection',
          3 => 'resolve intelligence or damage',
          4 => 'store report and cooldown',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'available agents',
          2 => 'target visibility',
          3 => 'cooldown',
          4 => 'mission cost',
        ),
        'calculations' =>
        array (
          0 => 'defender counter-intelligence − attacker agents − covert technology',
          1 => 'detection chance',
          2 => 'bounded sabotage damage',
        ),
        'mutations' =>
        array (
          0 => 'covert_missions',
          1 => 'spy_missions',
          2 => 'sabotage_missions',
          3 => 'intelligence_reports',
          4 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'agent allocation',
        1 => 'detection warning',
        2 => 'target intelligence',
        3 => 'reconnaissance',
        4 => 'spy mission',
        5 => 'sabotage mission',
        6 => 'classified report',
      ),
      'design' =>
      array (
        'template' => 'covert-operations',
        'sections' =>
        array (
          0 => 'agent allocation',
          1 => 'detection meter',
          2 => 'target intelligence',
          3 => 'mission result',
        ),
        'components' =>
        array (
          0 => 'mission-selector',
          1 => 'agent-input',
          2 => 'detection-meter',
          3 => 'report-panel',
        ),
        'responsive' => 'Mission controls and reports stack vertically',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'CovertService',
          1 => 'IntelligenceService',
        ),
        'reads' =>
        array (
          0 => 'covert_agents',
          1 => 'anti_covert_agents',
          2 => 'target_realms',
          3 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'covert_missions',
          1 => 'spy_missions',
          2 => 'sabotage_missions',
          3 => 'intelligence_reports',
          4 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'covert:recon',
          1 => 'covert:spy',
          2 => 'covert:sabotage',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/attack/spy.php',
        'features' => 'config/page_features/attack/spy.php',
        'design' => 'config/page_design_specs/attack/spy.php',
        'systems' => 'config/page_systems/attack/spy.php',
        'module' => 'includes/page_modules/attack/spy.php',
      ),
    ),
    'sabotage' =>
    array (
      'route' => 'sabotage',
      'group' => 'attack',
      'group_label' => 'Attack',
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
      'details' =>
      array (
        'hero' => 'Covert Operations',
        'panels' =>
        array (
          0 => 'Agent allocation',
          1 => 'Detection chance',
          2 => 'Target intelligence',
          3 => 'Mission result',
        ),
        'formula' => 'detection = defender counter-intelligence − attacker agents − covert technology',
        'controls' =>
        array (
          0 => 'Reconnaissance',
          1 => 'Spy mission',
          2 => 'Sabotage mission',
        ),
        'action' => 'covert',
        'tables' =>
        array (
          0 => 'covert_agents',
          1 => 'anti_covert_agents',
          2 => 'covert_missions',
          3 => 'spy_missions',
          4 => 'sabotage_missions',
          5 => 'intelligence_reports',
        ),
        'permission' => 'authenticated commander with available agents',
        'states' =>
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Spy and Sabotage Operations',
        'purpose' => 'Manage covert agent operations.',
        'buttons' =>
        array (
          'Run reconnaissance' =>
          array (
            'action' => 'covert:recon',
            'logic' => 'Generate low-risk target intelligence with detection calculation.',
            'permission' => 'authenticated commander with agents',
            'reads' =>
            array (
              0 => 'covert_agents',
              1 => 'target_realms',
            ),
            'writes' =>
            array (
              0 => 'covert_missions',
              1 => 'intelligence_reports',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Run spy mission' =>
          array (
            'action' => 'covert:spy',
            'logic' => 'Resolve spy mission and store report.',
            'permission' => 'authenticated commander with spies',
            'reads' =>
            array (
              0 => 'spy_missions',
              1 => 'technologies',
            ),
            'writes' =>
            array (
              0 => 'spy_missions',
              1 => 'intelligence_reports',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
          'Run sabotage' =>
          array (
            'action' => 'covert:sabotage',
            'logic' => 'Resolve sabotage with detection and damage caps.',
            'permission' => 'authenticated commander with spies',
            'reads' =>
            array (
              0 => 'sabotage_missions',
              1 => 'target_realms',
            ),
            'writes' =>
            array (
              0 => 'sabotage_missions',
              1 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Run reconnaissance, spy, and sabotage missions using agents and covert technology.',
        'workflow' =>
        array (
          0 => 'load agent pools',
          1 => 'select mission type',
          2 => 'calculate detection',
          3 => 'resolve intelligence or damage',
          4 => 'store report and cooldown',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'available agents',
          2 => 'target visibility',
          3 => 'cooldown',
          4 => 'mission cost',
        ),
        'calculations' =>
        array (
          0 => 'defender counter-intelligence − attacker agents − covert technology',
          1 => 'detection chance',
          2 => 'bounded sabotage damage',
        ),
        'mutations' =>
        array (
          0 => 'covert_missions',
          1 => 'spy_missions',
          2 => 'sabotage_missions',
          3 => 'intelligence_reports',
          4 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'agent allocation',
        1 => 'detection warning',
        2 => 'target intelligence',
        3 => 'reconnaissance',
        4 => 'spy mission',
        5 => 'sabotage mission',
        6 => 'classified report',
      ),
      'design' =>
      array (
        'template' => 'covert-operations',
        'sections' =>
        array (
          0 => 'agent allocation',
          1 => 'detection meter',
          2 => 'target intelligence',
          3 => 'mission result',
        ),
        'components' =>
        array (
          0 => 'mission-selector',
          1 => 'agent-input',
          2 => 'detection-meter',
          3 => 'report-panel',
        ),
        'responsive' => 'Mission controls and reports stack vertically',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'CovertService',
          1 => 'IntelligenceService',
        ),
        'reads' =>
        array (
          0 => 'covert_agents',
          1 => 'anti_covert_agents',
          2 => 'target_realms',
          3 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'covert_missions',
          1 => 'spy_missions',
          2 => 'sabotage_missions',
          3 => 'intelligence_reports',
          4 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'covert:recon',
          1 => 'covert:spy',
          2 => 'covert:sabotage',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/attack/sabotage.php',
        'features' => 'config/page_features/attack/sabotage.php',
        'design' => 'config/page_design_specs/attack/sabotage.php',
        'systems' => 'config/page_systems/attack/sabotage.php',
        'module' => 'includes/page_modules/attack/sabotage.php',
      ),
    ),
    'attack-log' =>
    array (
      'route' => 'attack-log',
      'group' => 'attack',
      'group_label' => 'Attack',
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
      'details' =>
      array (
        'hero' => 'Reports and Intelligence',
        'panels' =>
        array (
          0 => 'Unread reports',
          1 => 'Battle outcomes',
          2 => 'Spy payloads',
          3 => 'Audit and read state',
        ),
        'formula' => 'report visibility = recipient ownership + report classification + read status',
        'controls' =>
        array (
          0 => 'Open report',
          1 => 'Mark read',
          2 => 'Filter by type',
        ),
        'action' => 'message_read',
        'tables' =>
        array (
          0 => 'battle_reports',
          1 => 'attack_logs',
          2 => 'intelligence_reports',
          3 => 'messages',
        ),
        'permission' => 'authenticated report recipient',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Reports and Intelligence',
        'purpose' => 'Review server-generated outcomes.',
        'buttons' =>
        array (
          'Open report' =>
          array (
            'action' => 'read_report',
            'logic' => 'Verify recipient or owner, then return classified payload.',
            'permission' => 'report recipient',
            'reads' =>
            array (
              0 => 'battle_reports',
              1 => 'intelligence_reports',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'empty',
              3 => 'error',
            ),
          ),
          'Mark read' =>
          array (
            'action' => 'message_read',
            'logic' => 'Verify ownership and update unread state.',
            'permission' => 'message recipient',
            'reads' =>
            array (
              0 => 'messages',
            ),
            'writes' =>
            array (
              0 => 'messages',
              1 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Show battle, spy, sabotage, and system reports only to authorized recipients.',
        'workflow' =>
        array (
          0 => 'load recipient reports',
          1 => 'classify payload',
          2 => 'filter read state',
          3 => 'open or mark report read',
          4 => 'write audit state',
        ),
        'validation' =>
        array (
          0 => 'authenticated report recipient',
          1 => 'recipient ownership',
          2 => 'classification access',
        ),
        'calculations' =>
        array (
          0 => 'recipient ownership + report classification + read status',
        ),
        'mutations' =>
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'unread count',
        1 => 'battle outcomes',
        2 => 'spy payloads',
        3 => 'classified report view',
        4 => 'mark read',
        5 => 'report filters',
      ),
      'design' =>
      array (
        'template' => 'report-list',
        'sections' =>
        array (
          0 => 'unread summary',
          1 => 'report table',
          2 => 'detail view',
          3 => 'read state',
        ),
        'components' =>
        array (
          0 => 'report-row',
          1 => 'classification-badge',
          2 => 'detail-panel',
          3 => 'mark-read-button',
        ),
        'responsive' => 'Report rows become expandable cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ReportService',
          1 => 'IntelligenceService',
        ),
        'reads' =>
        array (
          0 => 'battle_reports',
          1 => 'attack_logs',
          2 => 'intelligence_reports',
          3 => 'messages',
        ),
        'writes' =>
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'read_report',
          1 => 'message_read',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/attack/attack-log.php',
        'features' => 'config/page_features/attack/attack-log.php',
        'design' => 'config/page_design_specs/attack/attack-log.php',
        'systems' => 'config/page_systems/attack/attack-log.php',
        'module' => 'includes/page_modules/attack/attack-log.php',
      ),
    ),
    'weapons' =>
    array (
      'route' => 'weapons',
      'group' => 'armory',
      'group_label' => 'Armory',
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
      'details' =>
      array (
        'hero' => 'Weapon Inventory',
        'panels' =>
        array (
          0 => 'Weapon catalogue',
          1 => 'Owned quantity',
          2 => 'Durability',
          3 => 'Assignment readiness',
        ),
        'formula' => 'effective power = base power × durability × technology × race × government',
        'controls' =>
        array (
          0 => 'Buy weapon',
          1 => 'Inspect durability',
          2 => 'Assign weapon',
        ),
        'action' => 'weapon_buy',
        'tables' =>
        array (
          0 => 'weapon_types',
          1 => 'player_weapons',
          2 => 'player_resources',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Weapon Inventory',
        'purpose' => 'Manage owned weapons and readiness.',
        'buttons' =>
        array (
          'Buy weapon' =>
          array (
            'action' => 'weapon_buy',
            'logic' => 'Validate catalogue item, quantity, balance, and inventory upsert.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'weapon_types',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_weapons',
              1 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Inspect durability' =>
          array (
            'action' => 'read_weapon',
            'logic' => 'Read quantity, durability, power, and assignment state.',
            'permission' => 'weapon owner',
            'reads' =>
            array (
              0 => 'player_weapons',
              1 => 'weapon_types',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage owned weapons, quantities, durability, assignments, and effective power.',
        'workflow' =>
        array (
          0 => 'load catalogue',
          1 => 'validate purchase or inspection',
          2 => 'upsert inventory',
          3 => 'calculate durability-adjusted power',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'weapon ownership',
          2 => 'resource balance',
          3 => 'positive quantity',
        ),
        'calculations' =>
        array (
          0 => 'base power × durability × technology × race × government',
        ),
        'mutations' =>
        array (
          0 => 'player_weapons',
          1 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'weapon catalogue',
        1 => 'owned quantity',
        2 => 'durability',
        3 => 'assignment readiness',
        4 => 'weapon purchase',
      ),
      'design' =>
      array (
        'template' => 'armory-inventory',
        'sections' =>
        array (
          0 => 'catalogue',
          1 => 'inventory',
          2 => 'durability',
          3 => 'assignment',
        ),
        'components' =>
        array (
          0 => 'weapon-card',
          1 => 'durability-meter',
          2 => 'purchase-form',
          3 => 'assignment-badge',
        ),
        'responsive' => 'Weapon cards wrap into a single-column inventory',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ArmoryService',
        ),
        'reads' =>
        array (
          0 => 'weapon_types',
          1 => 'player_weapons',
          2 => 'player_resources',
          3 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'player_weapons',
          1 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'weapon_buy',
          1 => 'read_weapon',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/armory/weapons.php',
        'features' => 'config/page_features/armory/weapons.php',
        'design' => 'config/page_design_specs/armory/weapons.php',
        'systems' => 'config/page_systems/armory/weapons.php',
        'module' => 'includes/page_modules/armory/weapons.php',
      ),
    ),
    'weapon-market' =>
    array (
      'route' => 'weapon-market',
      'group' => 'armory',
      'group_label' => 'Armory',
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
      'details' =>
      array (
        'hero' => 'Market Exchange',
        'panels' =>
        array (
          0 => 'Open orders',
          1 => 'Price history',
          2 => 'Order form',
          3 => 'Settlement status',
        ),
        'formula' => 'settlement = quantity × unit price + market fee',
        'controls' =>
        array (
          0 => 'List order',
          1 => 'Buy order',
          2 => 'Cancel order',
        ),
        'action' => 'market_list',
        'tables' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'mercenary_types',
        ),
        'permission' => 'authenticated commander with market turns',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Markets',
        'purpose' => 'Trade resources, weapons, and mercenaries.',
        'buttons' =>
        array (
          'List order' =>
          array (
            'action' => 'market_list',
            'logic' => 'Validate resource, quantity, unit price, turn balance, and expiry.',
            'permission' => 'authenticated trader',
            'reads' =>
            array (
              0 => 'player_resources',
              1 => 'market_orders',
            ),
            'writes' =>
            array (
              0 => 'market_orders',
              1 => 'trade_contracts',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'cooldown',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Buy order' =>
          array (
            'action' => 'market_buy',
            'logic' => 'Lock order, check funds, transfer resource, and settle seller.',
            'permission' => 'authenticated trader',
            'reads' =>
            array (
              0 => 'market_orders',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'market_orders',
              1 => 'player_resources',
              2 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'List and buy resource, weapon, and mercenary market orders.',
        'workflow' =>
        array (
          0 => 'load orders',
          1 => 'validate order fields',
          2 => 'lock balance or order',
          3 => 'settle trade',
          4 => 'write market event',
        ),
        'validation' =>
        array (
          0 => 'authenticated trader',
          1 => 'market turns',
          2 => 'positive quantity',
          3 => 'available balance',
          4 => 'order ownership',
        ),
        'calculations' =>
        array (
          0 => 'quantity × unit price + market fee',
        ),
        'mutations' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'open orders',
        1 => 'price history',
        2 => 'order form',
        3 => 'buy order',
        4 => 'list order',
        5 => 'settlement status',
      ),
      'design' =>
      array (
        'template' => 'market-exchange',
        'sections' =>
        array (
          0 => 'orders',
          1 => 'price history',
          2 => 'order form',
          3 => 'settlement',
        ),
        'components' =>
        array (
          0 => 'order-table',
          1 => 'price-badge',
          2 => 'order-form',
          3 => 'settlement-banner',
        ),
        'responsive' => 'Market tables scroll or stack into order cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MarketService',
        ),
        'reads' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'mercenary_types',
        ),
        'writes' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'market_list',
          1 => 'market_buy',
          2 => 'market_cancel',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/armory/weapon-market.php',
        'features' => 'config/page_features/armory/weapon-market.php',
        'design' => 'config/page_design_specs/armory/weapon-market.php',
        'systems' => 'config/page_systems/armory/weapon-market.php',
        'module' => 'includes/page_modules/armory/weapon-market.php',
      ),
    ),
    'repair' =>
    array (
      'route' => 'repair',
      'group' => 'armory',
      'group_label' => 'Armory',
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
      'details' =>
      array (
        'hero' => 'Weapon Repair',
        'panels' =>
        array (
          0 => 'Durability board',
          1 => 'Repair cost',
          2 => 'Resource check',
          3 => 'Repair result',
        ),
        'formula' => 'repair cost = missing durability × weapon tier × maintenance factor',
        'controls' =>
        array (
          0 => 'Repair weapon',
          1 => 'Inspect cost',
        ),
        'action' => 'weapon_repair',
        'tables' =>
        array (
          0 => 'player_weapons',
          1 => 'weapon_types',
          2 => 'player_resources',
        ),
        'permission' => 'authenticated weapon owner',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'success',
          3 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Weapon Repair',
        'purpose' => 'Restore weapon durability.',
        'buttons' =>
        array (
          'Repair weapon' =>
          array (
            'action' => 'weapon_repair',
            'logic' => 'Calculate missing-durability cost, lock weapon, deduct resources, and restore durability.',
            'permission' => 'weapon owner',
            'reads' =>
            array (
              0 => 'player_weapons',
              1 => 'weapon_types',
              2 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_weapons',
              1 => 'player_resources',
              2 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Restore weapon durability using validated repair costs.',
        'workflow' =>
        array (
          0 => 'load damaged weapon',
          1 => 'calculate missing durability',
          2 => 'validate resources',
          3 => 'lock weapon',
          4 => 'restore durability transactionally',
        ),
        'validation' =>
        array (
          0 => 'weapon owner',
          1 => 'positive durability gap',
          2 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'missing durability × weapon tier × maintenance factor',
        ),
        'mutations' =>
        array (
          0 => 'player_weapons',
          1 => 'player_resources',
          2 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'durability board',
        1 => 'repair cost',
        2 => 'resource check',
        3 => 'repair result',
      ),
      'design' =>
      array (
        'template' => 'weapon-repair',
        'sections' =>
        array (
          0 => 'damaged items',
          1 => 'cost preview',
          2 => 'confirmation',
          3 => 'result',
        ),
        'components' =>
        array (
          0 => 'durability-meter',
          1 => 'repair-cost',
          2 => 'confirmation-panel',
          3 => 'result-banner',
        ),
        'responsive' => 'Repair cards stack on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ArmoryService',
        ),
        'reads' =>
        array (
          0 => 'player_weapons',
          1 => 'weapon_types',
          2 => 'player_resources',
        ),
        'writes' =>
        array (
          0 => 'player_weapons',
          1 => 'player_resources',
          2 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'weapon_repair',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/armory/repair.php',
        'features' => 'config/page_features/armory/repair.php',
        'design' => 'config/page_design_specs/armory/repair.php',
        'systems' => 'config/page_systems/armory/repair.php',
        'module' => 'includes/page_modules/armory/repair.php',
      ),
    ),
    'units' =>
    array (
      'route' => 'units',
      'group' => 'training',
      'group_label' => 'Training',
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
      'details' =>
      array (
        'hero' => 'Personnel Training',
        'panels' =>
        array (
          0 => 'Available population',
          1 => 'Training queue',
          2 => 'Unit categories',
          3 => 'Current personnel',
        ),
        'formula' => 'training = population conversion − training cost + production bonus',
        'controls' =>
        array (
          0 => 'Train units',
          1 => 'Choose category',
          2 => 'Set quantity',
        ),
        'action' => 'train',
        'tables' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'technologies',
        ),
        'permission' => 'authenticated commander with untrained population',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'cooldown',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Training',
        'purpose' => 'Convert population into specialized units and queue production upgrades.',
        'buttons' =>
        array (
          'Train units' =>
          array (
            'action' => 'train',
            'logic' => 'Validate type and quantity, then transactionally lock unit type, commander resources, academy level, queue capacity, cooldown, population, and Naquadah before creating a training queue and game event.',
            'permission' => 'authenticated commander with owned population and training authority',
            'reads' =>
            array (
              0 => 'unit_types',
              1 => 'player_unit_stats',
              2 => 'training_queues',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'training_queues',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Upgrade production' =>
          array (
            'action' => 'upgrade_up',
            'logic' => 'Validate commander ownership, automation prerequisite, production queue capacity, cooldown, and Naquadah in one transaction before creating the production upgrade queue and game event.',
            'permission' => 'authenticated commander with production authority',
            'reads' =>
            array (
              0 => 'unit_types',
              1 => 'player_unit_stats',
              2 => 'training_queues',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'training_queues',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Convert available population into specialized personnel and units.',
        'workflow' =>
        array (
          0 => 'load population pool',
          1 => 'select unit category',
          2 => 'validate quantity',
          3 => 'deduct population and cost',
          4 => 'update unit stats',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'untrained population',
          2 => 'positive quantity',
          3 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'population conversion − training cost + production bonus',
        ),
        'mutations' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'unit categories',
        1 => 'quantity input',
        2 => 'training queue',
        3 => 'population conversion',
        4 => 'production upgrade',
      ),
      'design' =>
      array (
        'template' => 'training-board',
        'sections' =>
        array (
          0 => 'unit pool',
          1 => 'training controls',
          2 => 'cost preview',
          3 => 'queue/result',
        ),
        'components' =>
        array (
          0 => 'unit-card',
          1 => 'quantity-input',
          2 => 'cost-preview',
          3 => 'queue-row',
        ),
        'responsive' => 'Training cards stack with full-width controls',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TrainingService',
          1 => 'GameService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'train',
          1 => 'upgrade_up',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/training/units.php',
        'features' => 'config/page_features/training/units.php',
        'design' => 'config/page_design_specs/training/units.php',
        'systems' => 'config/page_systems/training/units.php',
        'module' => 'includes/page_modules/training/units.php',
      ),
    ),
    'miners' =>
    array (
      'route' => 'miners',
      'group' => 'training',
      'group_label' => 'Training',
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
      'details' =>
      array (
        'hero' => 'Personnel Training',
        'panels' =>
        array (
          0 => 'Available population',
          1 => 'Training queue',
          2 => 'Unit categories',
          3 => 'Current personnel',
        ),
        'formula' => 'training = population conversion − training cost + production bonus',
        'controls' =>
        array (
          0 => 'Train units',
          1 => 'Choose category',
          2 => 'Set quantity',
        ),
        'action' => 'train',
        'tables' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'technologies',
        ),
        'permission' => 'authenticated commander with untrained population',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'cooldown',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Training',
        'purpose' => 'Convert population into specialized units and queue production upgrades.',
        'buttons' =>
        array (
          'Train units' =>
          array (
            'action' => 'train',
            'logic' => 'Validate type and quantity, then transactionally lock unit type, commander resources, academy level, queue capacity, cooldown, population, and Naquadah before creating a training queue and game event.',
            'permission' => 'authenticated commander with owned population and training authority',
            'reads' =>
            array (
              0 => 'unit_types',
              1 => 'player_unit_stats',
              2 => 'training_queues',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'training_queues',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Upgrade production' =>
          array (
            'action' => 'upgrade_up',
            'logic' => 'Validate commander ownership, automation prerequisite, production queue capacity, cooldown, and Naquadah in one transaction before creating the production upgrade queue and game event.',
            'permission' => 'authenticated commander with production authority',
            'reads' =>
            array (
              0 => 'unit_types',
              1 => 'player_unit_stats',
              2 => 'training_queues',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'training_queues',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Convert available population into specialized personnel and units.',
        'workflow' =>
        array (
          0 => 'load population pool',
          1 => 'select unit category',
          2 => 'validate quantity',
          3 => 'deduct population and cost',
          4 => 'update unit stats',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'untrained population',
          2 => 'positive quantity',
          3 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'population conversion − training cost + production bonus',
        ),
        'mutations' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'unit categories',
        1 => 'quantity input',
        2 => 'training queue',
        3 => 'population conversion',
        4 => 'production upgrade',
      ),
      'design' =>
      array (
        'template' => 'training-board',
        'sections' =>
        array (
          0 => 'unit pool',
          1 => 'training controls',
          2 => 'cost preview',
          3 => 'queue/result',
        ),
        'components' =>
        array (
          0 => 'unit-card',
          1 => 'quantity-input',
          2 => 'cost-preview',
          3 => 'queue-row',
        ),
        'responsive' => 'Training cards stack with full-width controls',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TrainingService',
          1 => 'GameService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'train',
          1 => 'upgrade_up',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/training/miners.php',
        'features' => 'config/page_features/training/miners.php',
        'design' => 'config/page_design_specs/training/miners.php',
        'systems' => 'config/page_systems/training/miners.php',
        'module' => 'includes/page_modules/training/miners.php',
      ),
    ),
    'super-units' =>
    array (
      'route' => 'super-units',
      'group' => 'training',
      'group_label' => 'Training',
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
      'details' =>
      array (
        'hero' => 'Personnel Training',
        'panels' =>
        array (
          0 => 'Available population',
          1 => 'Training queue',
          2 => 'Unit categories',
          3 => 'Current personnel',
        ),
        'formula' => 'training = population conversion − training cost + production bonus',
        'controls' =>
        array (
          0 => 'Train units',
          1 => 'Choose category',
          2 => 'Set quantity',
        ),
        'action' => 'train',
        'tables' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'technologies',
        ),
        'permission' => 'authenticated commander with untrained population',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'cooldown',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Training',
        'purpose' => 'Convert population into specialized units and queue production upgrades.',
        'buttons' =>
        array (
          'Train units' =>
          array (
            'action' => 'train',
            'logic' => 'Validate type and quantity, then transactionally lock unit type, commander resources, academy level, queue capacity, cooldown, population, and Naquadah before creating a training queue and game event.',
            'permission' => 'authenticated commander with owned population and training authority',
            'reads' =>
            array (
              0 => 'unit_types',
              1 => 'player_unit_stats',
              2 => 'training_queues',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'training_queues',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Upgrade production' =>
          array (
            'action' => 'upgrade_up',
            'logic' => 'Validate commander ownership, automation prerequisite, production queue capacity, cooldown, and Naquadah in one transaction before creating the production upgrade queue and game event.',
            'permission' => 'authenticated commander with production authority',
            'reads' =>
            array (
              0 => 'unit_types',
              1 => 'player_unit_stats',
              2 => 'training_queues',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'training_queues',
              2 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Convert available population into specialized personnel and units.',
        'workflow' =>
        array (
          0 => 'load population pool',
          1 => 'select unit category',
          2 => 'validate quantity',
          3 => 'deduct population and cost',
          4 => 'update unit stats',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'untrained population',
          2 => 'positive quantity',
          3 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'population conversion − training cost + production bonus',
        ),
        'mutations' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'unit categories',
        1 => 'quantity input',
        2 => 'training queue',
        3 => 'population conversion',
        4 => 'production upgrade',
      ),
      'design' =>
      array (
        'template' => 'training-board',
        'sections' =>
        array (
          0 => 'unit pool',
          1 => 'training controls',
          2 => 'cost preview',
          3 => 'queue/result',
        ),
        'components' =>
        array (
          0 => 'unit-card',
          1 => 'quantity-input',
          2 => 'cost-preview',
          3 => 'queue-row',
        ),
        'responsive' => 'Training cards stack with full-width controls',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TrainingService',
          1 => 'GameService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'player_resources',
          1 => 'player_unit_stats',
          2 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'train',
          1 => 'upgrade_up',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/training/super-units.php',
        'features' => 'config/page_features/training/super-units.php',
        'design' => 'config/page_design_specs/training/super-units.php',
        'systems' => 'config/page_systems/training/super-units.php',
        'module' => 'includes/page_modules/training/super-units.php',
      ),
    ),
    'unit-production' =>
    array (
      'route' => 'unit-production',
      'group' => 'training',
      'group_label' => 'Training',
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
      'details' =>
      array (
        'hero' => 'Unit Production',
        'panels' =>
        array (
          0 => 'Current production',
          1 => 'Next-level cost',
          2 => 'Queue status',
          3 => 'Upgrade effects',
        ),
        'formula' => 'upgrade cost = base cost × growth rate ^ current level',
        'controls' =>
        array (
          0 => 'Upgrade production',
          1 => 'Preview next level',
        ),
        'action' => 'upgrade_up',
        'tables' =>
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'technologies',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'queued',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Unit Production',
        'purpose' => 'Upgrade the rate at which personnel and units can be produced.',
        'buttons' =>
        array (
          'Upgrade production' =>
          array (
            'action' => 'upgrade_up',
            'logic' => 'Calculate next-level cost, lock resources, and increase production level.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_resources',
              1 => 'construction_queue',
            ),
            'writes' =>
            array (
              0 => 'player_resources',
              1 => 'construction_queue',
              2 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'queued',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Increase unit production capacity and show next-level effects.',
        'workflow' =>
        array (
          0 => 'load current level',
          1 => 'calculate next cost',
          2 => 'validate resources',
          3 => 'queue upgrade',
          4 => 'apply completion effect',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'positive current level',
          2 => 'resource balance',
          3 => 'level cap',
        ),
        'calculations' =>
        array (
          0 => 'base cost × growth rate ^ current level',
        ),
        'mutations' =>
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'current production',
        1 => 'next-level cost',
        2 => 'queue status',
        3 => 'upgrade effects',
        4 => 'production preview',
      ),
      'design' =>
      array (
        'template' => 'upgrade-card',
        'sections' =>
        array (
          0 => 'current level',
          1 => 'next cost',
          2 => 'modifier preview',
          3 => 'confirmation',
        ),
        'components' =>
        array (
          0 => 'level-card',
          1 => 'cost-table',
          2 => 'effect-preview',
          3 => 'queue-badge',
        ),
        'responsive' => 'Upgrade card becomes full-width',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TrainingService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'technologies',
        ),
        'writes' =>
        array (
          0 => 'player_resources',
          1 => 'construction_queue',
          2 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'upgrade_up',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/training/unit-production.php',
        'features' => 'config/page_features/training/unit-production.php',
        'design' => 'config/page_design_specs/training/unit-production.php',
        'systems' => 'config/page_systems/training/unit-production.php',
        'module' => 'includes/page_modules/training/unit-production.php',
      ),
    ),
    'technology' =>
    array (
      'route' => 'technology',
      'group' => 'technology',
      'group_label' => 'Technology',
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
      'details' =>
      array (
        'hero' => 'Technology Tree',
        'panels' =>
        array (
          0 => 'Offense branch',
          1 => 'Defense branch',
          2 => 'Covert branch',
          3 => 'Anti-covert branch',
          4 => 'Prerequisites and queue',
        ),
        'formula' => 'research cost = base cost × growth ^ current level; completion applies effect',
        'controls' =>
        array (
          0 => 'Upgrade offense',
          1 => 'Upgrade defense',
          2 => 'Upgrade covert',
          3 => 'Upgrade anti-covert',
          4 => 'Queue research',
        ),
        'action' => 'technology',
        'tables' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'construction_queue',
        ),
        'permission' => 'authenticated commander with research access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'insufficient-resource',
          3 => 'queued',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Technology',
        'purpose' => 'Research permanent strategic upgrades.',
        'buttons' =>
        array (
          'Upgrade technology' =>
          array (
            'action' => 'technology',
            'logic' => 'Validate category, prerequisites, cost, queue availability, and apply effect on completion.',
            'permission' => 'authenticated researcher',
            'reads' =>
            array (
              0 => 'technologies',
              1 => 'technology_prerequisites',
              2 => 'player_technologies',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_technologies',
              1 => 'construction_queue',
              2 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'insufficient-resource',
              3 => 'queued',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
        'workflow' =>
        array (
          0 => 'load technology tree',
          1 => 'check prerequisites',
          2 => 'calculate cost',
          3 => 'queue research',
          4 => 'apply completed effect',
        ),
        'validation' =>
        array (
          0 => 'authenticated researcher',
          1 => 'prerequisites',
          2 => 'research queue',
          3 => 'resource balance',
          4 => 'level cap',
        ),
        'calculations' =>
        array (
          0 => 'base cost × growth ^ current level',
        ),
        'mutations' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'technology tree',
        1 => 'branch filters',
        2 => 'prerequisites',
        3 => 'level and cost',
        4 => 'research queue',
        5 => 'effect preview',
      ),
      'design' =>
      array (
        'template' => 'technology-tree',
        'sections' =>
        array (
          0 => 'branch tabs',
          1 => 'technology cards',
          2 => 'prerequisites',
          3 => 'cost',
          4 => 'queue',
        ),
        'components' =>
        array (
          0 => 'tech-card',
          1 => 'branch-tabs',
          2 => 'prerequisite-list',
          3 => 'research-queue',
        ),
        'responsive' => 'Branch tabs scroll and cards stack',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TechnologyService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'player_resources',
          4 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'technology',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/technology/technology.php',
        'features' => 'config/page_features/technology/technology.php',
        'design' => 'config/page_design_specs/technology/technology.php',
        'systems' => 'config/page_systems/technology/technology.php',
        'module' => 'includes/page_modules/technology/technology.php',
      ),
    ),
    'tech-offense' =>
    array (
      'route' => 'tech-offense',
      'group' => 'technology',
      'group_label' => 'Technology',
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
      'details' =>
      array (
        'hero' => 'Technology Tree',
        'panels' =>
        array (
          0 => 'Offense branch',
          1 => 'Defense branch',
          2 => 'Covert branch',
          3 => 'Anti-covert branch',
          4 => 'Prerequisites and queue',
        ),
        'formula' => 'research cost = base cost × growth ^ current level; completion applies effect',
        'controls' =>
        array (
          0 => 'Upgrade offense',
          1 => 'Upgrade defense',
          2 => 'Upgrade covert',
          3 => 'Upgrade anti-covert',
          4 => 'Queue research',
        ),
        'action' => 'technology',
        'tables' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'construction_queue',
        ),
        'permission' => 'authenticated commander with research access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'insufficient-resource',
          3 => 'queued',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Technology',
        'purpose' => 'Research permanent strategic upgrades.',
        'buttons' =>
        array (
          'Upgrade technology' =>
          array (
            'action' => 'technology',
            'logic' => 'Validate category, prerequisites, cost, queue availability, and apply effect on completion.',
            'permission' => 'authenticated researcher',
            'reads' =>
            array (
              0 => 'technologies',
              1 => 'technology_prerequisites',
              2 => 'player_technologies',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_technologies',
              1 => 'construction_queue',
              2 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'insufficient-resource',
              3 => 'queued',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
        'workflow' =>
        array (
          0 => 'load technology tree',
          1 => 'check prerequisites',
          2 => 'calculate cost',
          3 => 'queue research',
          4 => 'apply completed effect',
        ),
        'validation' =>
        array (
          0 => 'authenticated researcher',
          1 => 'prerequisites',
          2 => 'research queue',
          3 => 'resource balance',
          4 => 'level cap',
        ),
        'calculations' =>
        array (
          0 => 'base cost × growth ^ current level',
        ),
        'mutations' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'technology tree',
        1 => 'branch filters',
        2 => 'prerequisites',
        3 => 'level and cost',
        4 => 'research queue',
        5 => 'effect preview',
      ),
      'design' =>
      array (
        'template' => 'technology-tree',
        'sections' =>
        array (
          0 => 'branch tabs',
          1 => 'technology cards',
          2 => 'prerequisites',
          3 => 'cost',
          4 => 'queue',
        ),
        'components' =>
        array (
          0 => 'tech-card',
          1 => 'branch-tabs',
          2 => 'prerequisite-list',
          3 => 'research-queue',
        ),
        'responsive' => 'Branch tabs scroll and cards stack',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TechnologyService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'player_resources',
          4 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'technology',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/technology/tech-offense.php',
        'features' => 'config/page_features/technology/tech-offense.php',
        'design' => 'config/page_design_specs/technology/tech-offense.php',
        'systems' => 'config/page_systems/technology/tech-offense.php',
        'module' => 'includes/page_modules/technology/tech-offense.php',
      ),
    ),
    'tech-defense' =>
    array (
      'route' => 'tech-defense',
      'group' => 'technology',
      'group_label' => 'Technology',
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
      'details' =>
      array (
        'hero' => 'Technology Tree',
        'panels' =>
        array (
          0 => 'Offense branch',
          1 => 'Defense branch',
          2 => 'Covert branch',
          3 => 'Anti-covert branch',
          4 => 'Prerequisites and queue',
        ),
        'formula' => 'research cost = base cost × growth ^ current level; completion applies effect',
        'controls' =>
        array (
          0 => 'Upgrade offense',
          1 => 'Upgrade defense',
          2 => 'Upgrade covert',
          3 => 'Upgrade anti-covert',
          4 => 'Queue research',
        ),
        'action' => 'technology',
        'tables' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'construction_queue',
        ),
        'permission' => 'authenticated commander with research access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'insufficient-resource',
          3 => 'queued',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Technology',
        'purpose' => 'Research permanent strategic upgrades.',
        'buttons' =>
        array (
          'Upgrade technology' =>
          array (
            'action' => 'technology',
            'logic' => 'Validate category, prerequisites, cost, queue availability, and apply effect on completion.',
            'permission' => 'authenticated researcher',
            'reads' =>
            array (
              0 => 'technologies',
              1 => 'technology_prerequisites',
              2 => 'player_technologies',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_technologies',
              1 => 'construction_queue',
              2 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'insufficient-resource',
              3 => 'queued',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
        'workflow' =>
        array (
          0 => 'load technology tree',
          1 => 'check prerequisites',
          2 => 'calculate cost',
          3 => 'queue research',
          4 => 'apply completed effect',
        ),
        'validation' =>
        array (
          0 => 'authenticated researcher',
          1 => 'prerequisites',
          2 => 'research queue',
          3 => 'resource balance',
          4 => 'level cap',
        ),
        'calculations' =>
        array (
          0 => 'base cost × growth ^ current level',
        ),
        'mutations' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'technology tree',
        1 => 'branch filters',
        2 => 'prerequisites',
        3 => 'level and cost',
        4 => 'research queue',
        5 => 'effect preview',
      ),
      'design' =>
      array (
        'template' => 'technology-tree',
        'sections' =>
        array (
          0 => 'branch tabs',
          1 => 'technology cards',
          2 => 'prerequisites',
          3 => 'cost',
          4 => 'queue',
        ),
        'components' =>
        array (
          0 => 'tech-card',
          1 => 'branch-tabs',
          2 => 'prerequisite-list',
          3 => 'research-queue',
        ),
        'responsive' => 'Branch tabs scroll and cards stack',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TechnologyService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'player_resources',
          4 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'technology',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/technology/tech-defense.php',
        'features' => 'config/page_features/technology/tech-defense.php',
        'design' => 'config/page_design_specs/technology/tech-defense.php',
        'systems' => 'config/page_systems/technology/tech-defense.php',
        'module' => 'includes/page_modules/technology/tech-defense.php',
      ),
    ),
    'tech-covert' =>
    array (
      'route' => 'tech-covert',
      'group' => 'technology',
      'group_label' => 'Technology',
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
      'details' =>
      array (
        'hero' => 'Technology Tree',
        'panels' =>
        array (
          0 => 'Offense branch',
          1 => 'Defense branch',
          2 => 'Covert branch',
          3 => 'Anti-covert branch',
          4 => 'Prerequisites and queue',
        ),
        'formula' => 'research cost = base cost × growth ^ current level; completion applies effect',
        'controls' =>
        array (
          0 => 'Upgrade offense',
          1 => 'Upgrade defense',
          2 => 'Upgrade covert',
          3 => 'Upgrade anti-covert',
          4 => 'Queue research',
        ),
        'action' => 'technology',
        'tables' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'construction_queue',
        ),
        'permission' => 'authenticated commander with research access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'insufficient-resource',
          3 => 'queued',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Technology',
        'purpose' => 'Research permanent strategic upgrades.',
        'buttons' =>
        array (
          'Upgrade technology' =>
          array (
            'action' => 'technology',
            'logic' => 'Validate category, prerequisites, cost, queue availability, and apply effect on completion.',
            'permission' => 'authenticated researcher',
            'reads' =>
            array (
              0 => 'technologies',
              1 => 'technology_prerequisites',
              2 => 'player_technologies',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_technologies',
              1 => 'construction_queue',
              2 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'insufficient-resource',
              3 => 'queued',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
        'workflow' =>
        array (
          0 => 'load technology tree',
          1 => 'check prerequisites',
          2 => 'calculate cost',
          3 => 'queue research',
          4 => 'apply completed effect',
        ),
        'validation' =>
        array (
          0 => 'authenticated researcher',
          1 => 'prerequisites',
          2 => 'research queue',
          3 => 'resource balance',
          4 => 'level cap',
        ),
        'calculations' =>
        array (
          0 => 'base cost × growth ^ current level',
        ),
        'mutations' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'technology tree',
        1 => 'branch filters',
        2 => 'prerequisites',
        3 => 'level and cost',
        4 => 'research queue',
        5 => 'effect preview',
      ),
      'design' =>
      array (
        'template' => 'technology-tree',
        'sections' =>
        array (
          0 => 'branch tabs',
          1 => 'technology cards',
          2 => 'prerequisites',
          3 => 'cost',
          4 => 'queue',
        ),
        'components' =>
        array (
          0 => 'tech-card',
          1 => 'branch-tabs',
          2 => 'prerequisite-list',
          3 => 'research-queue',
        ),
        'responsive' => 'Branch tabs scroll and cards stack',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TechnologyService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'player_resources',
          4 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'technology',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/technology/tech-covert.php',
        'features' => 'config/page_features/technology/tech-covert.php',
        'design' => 'config/page_design_specs/technology/tech-covert.php',
        'systems' => 'config/page_systems/technology/tech-covert.php',
        'module' => 'includes/page_modules/technology/tech-covert.php',
      ),
    ),
    'tech-anti-covert' =>
    array (
      'route' => 'tech-anti-covert',
      'group' => 'technology',
      'group_label' => 'Technology',
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
      'details' =>
      array (
        'hero' => 'Technology Tree',
        'panels' =>
        array (
          0 => 'Offense branch',
          1 => 'Defense branch',
          2 => 'Covert branch',
          3 => 'Anti-covert branch',
          4 => 'Prerequisites and queue',
        ),
        'formula' => 'research cost = base cost × growth ^ current level; completion applies effect',
        'controls' =>
        array (
          0 => 'Upgrade offense',
          1 => 'Upgrade defense',
          2 => 'Upgrade covert',
          3 => 'Upgrade anti-covert',
          4 => 'Queue research',
        ),
        'action' => 'technology',
        'tables' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'construction_queue',
        ),
        'permission' => 'authenticated commander with research access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'insufficient-resource',
          3 => 'queued',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Technology',
        'purpose' => 'Research permanent strategic upgrades.',
        'buttons' =>
        array (
          'Upgrade technology' =>
          array (
            'action' => 'technology',
            'logic' => 'Validate category, prerequisites, cost, queue availability, and apply effect on completion.',
            'permission' => 'authenticated researcher',
            'reads' =>
            array (
              0 => 'technologies',
              1 => 'technology_prerequisites',
              2 => 'player_technologies',
              3 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'player_technologies',
              1 => 'construction_queue',
              2 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'insufficient-resource',
              3 => 'queued',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
        'workflow' =>
        array (
          0 => 'load technology tree',
          1 => 'check prerequisites',
          2 => 'calculate cost',
          3 => 'queue research',
          4 => 'apply completed effect',
        ),
        'validation' =>
        array (
          0 => 'authenticated researcher',
          1 => 'prerequisites',
          2 => 'research queue',
          3 => 'resource balance',
          4 => 'level cap',
        ),
        'calculations' =>
        array (
          0 => 'base cost × growth ^ current level',
        ),
        'mutations' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
      ),
      'features' =>
      array (
        0 => 'technology tree',
        1 => 'branch filters',
        2 => 'prerequisites',
        3 => 'level and cost',
        4 => 'research queue',
        5 => 'effect preview',
      ),
      'design' =>
      array (
        'template' => 'technology-tree',
        'sections' =>
        array (
          0 => 'branch tabs',
          1 => 'technology cards',
          2 => 'prerequisites',
          3 => 'cost',
          4 => 'queue',
        ),
        'components' =>
        array (
          0 => 'tech-card',
          1 => 'branch-tabs',
          2 => 'prerequisite-list',
          3 => 'research-queue',
        ),
        'responsive' => 'Branch tabs scroll and cards stack',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'TechnologyService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'player_resources',
          4 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
        'actions' =>
        array (
          0 => 'technology',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/technology/tech-anti-covert.php',
        'features' => 'config/page_features/technology/tech-anti-covert.php',
        'design' => 'config/page_design_specs/technology/tech-anti-covert.php',
        'systems' => 'config/page_systems/technology/tech-anti-covert.php',
        'module' => 'includes/page_modules/technology/tech-anti-covert.php',
      ),
    ),
    'spy-log' =>
    array (
      'route' => 'spy-log',
      'group' => 'intelligence',
      'group_label' => 'Intelligence',
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
      'details' =>
      array (
        'hero' => 'Reports and Intelligence',
        'panels' =>
        array (
          0 => 'Unread reports',
          1 => 'Battle outcomes',
          2 => 'Spy payloads',
          3 => 'Audit and read state',
        ),
        'formula' => 'report visibility = recipient ownership + report classification + read status',
        'controls' =>
        array (
          0 => 'Open report',
          1 => 'Mark read',
          2 => 'Filter by type',
        ),
        'action' => 'message_read',
        'tables' =>
        array (
          0 => 'battle_reports',
          1 => 'attack_logs',
          2 => 'intelligence_reports',
          3 => 'messages',
        ),
        'permission' => 'authenticated report recipient',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Reports and Intelligence',
        'purpose' => 'Review server-generated outcomes.',
        'buttons' =>
        array (
          'Open report' =>
          array (
            'action' => 'read_report',
            'logic' => 'Verify recipient or owner, then return classified payload.',
            'permission' => 'report recipient',
            'reads' =>
            array (
              0 => 'battle_reports',
              1 => 'intelligence_reports',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'empty',
              3 => 'error',
            ),
          ),
          'Mark read' =>
          array (
            'action' => 'message_read',
            'logic' => 'Verify ownership and update unread state.',
            'permission' => 'message recipient',
            'reads' =>
            array (
              0 => 'messages',
            ),
            'writes' =>
            array (
              0 => 'messages',
              1 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Show battle, spy, sabotage, and system reports only to authorized recipients.',
        'workflow' =>
        array (
          0 => 'load recipient reports',
          1 => 'classify payload',
          2 => 'filter read state',
          3 => 'open or mark report read',
          4 => 'write audit state',
        ),
        'validation' =>
        array (
          0 => 'authenticated report recipient',
          1 => 'recipient ownership',
          2 => 'classification access',
        ),
        'calculations' =>
        array (
          0 => 'recipient ownership + report classification + read status',
        ),
        'mutations' =>
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'unread count',
        1 => 'battle outcomes',
        2 => 'spy payloads',
        3 => 'classified report view',
        4 => 'mark read',
        5 => 'report filters',
      ),
      'design' =>
      array (
        'template' => 'report-list',
        'sections' =>
        array (
          0 => 'unread summary',
          1 => 'report table',
          2 => 'detail view',
          3 => 'read state',
        ),
        'components' =>
        array (
          0 => 'report-row',
          1 => 'classification-badge',
          2 => 'detail-panel',
          3 => 'mark-read-button',
        ),
        'responsive' => 'Report rows become expandable cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ReportService',
          1 => 'IntelligenceService',
        ),
        'reads' =>
        array (
          0 => 'battle_reports',
          1 => 'attack_logs',
          2 => 'intelligence_reports',
          3 => 'messages',
        ),
        'writes' =>
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'read_report',
          1 => 'message_read',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/intelligence/spy-log.php',
        'features' => 'config/page_features/intelligence/spy-log.php',
        'design' => 'config/page_design_specs/intelligence/spy-log.php',
        'systems' => 'config/page_systems/intelligence/spy-log.php',
        'module' => 'includes/page_modules/intelligence/spy-log.php',
      ),
    ),
    'enemy-intelligence' =>
    array (
      'route' => 'enemy-intelligence',
      'group' => 'intelligence',
      'group_label' => 'Intelligence',
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
      'details' =>
      array (
        'hero' => 'Reports and Intelligence',
        'panels' =>
        array (
          0 => 'Unread reports',
          1 => 'Battle outcomes',
          2 => 'Spy payloads',
          3 => 'Audit and read state',
        ),
        'formula' => 'report visibility = recipient ownership + report classification + read status',
        'controls' =>
        array (
          0 => 'Open report',
          1 => 'Mark read',
          2 => 'Filter by type',
        ),
        'action' => 'message_read',
        'tables' =>
        array (
          0 => 'battle_reports',
          1 => 'attack_logs',
          2 => 'intelligence_reports',
          3 => 'messages',
        ),
        'permission' => 'authenticated report recipient',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Reports and Intelligence',
        'purpose' => 'Review server-generated outcomes.',
        'buttons' =>
        array (
          'Open report' =>
          array (
            'action' => 'read_report',
            'logic' => 'Verify recipient or owner, then return classified payload.',
            'permission' => 'report recipient',
            'reads' =>
            array (
              0 => 'battle_reports',
              1 => 'intelligence_reports',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'empty',
              3 => 'error',
            ),
          ),
          'Mark read' =>
          array (
            'action' => 'message_read',
            'logic' => 'Verify ownership and update unread state.',
            'permission' => 'message recipient',
            'reads' =>
            array (
              0 => 'messages',
            ),
            'writes' =>
            array (
              0 => 'messages',
              1 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Show battle, spy, sabotage, and system reports only to authorized recipients.',
        'workflow' =>
        array (
          0 => 'load recipient reports',
          1 => 'classify payload',
          2 => 'filter read state',
          3 => 'open or mark report read',
          4 => 'write audit state',
        ),
        'validation' =>
        array (
          0 => 'authenticated report recipient',
          1 => 'recipient ownership',
          2 => 'classification access',
        ),
        'calculations' =>
        array (
          0 => 'recipient ownership + report classification + read status',
        ),
        'mutations' =>
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'unread count',
        1 => 'battle outcomes',
        2 => 'spy payloads',
        3 => 'classified report view',
        4 => 'mark read',
        5 => 'report filters',
      ),
      'design' =>
      array (
        'template' => 'report-list',
        'sections' =>
        array (
          0 => 'unread summary',
          1 => 'report table',
          2 => 'detail view',
          3 => 'read state',
        ),
        'components' =>
        array (
          0 => 'report-row',
          1 => 'classification-badge',
          2 => 'detail-panel',
          3 => 'mark-read-button',
        ),
        'responsive' => 'Report rows become expandable cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ReportService',
          1 => 'IntelligenceService',
        ),
        'reads' =>
        array (
          0 => 'battle_reports',
          1 => 'attack_logs',
          2 => 'intelligence_reports',
          3 => 'messages',
        ),
        'writes' =>
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'read_report',
          1 => 'message_read',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/intelligence/enemy-intelligence.php',
        'features' => 'config/page_features/intelligence/enemy-intelligence.php',
        'design' => 'config/page_design_specs/intelligence/enemy-intelligence.php',
        'systems' => 'config/page_systems/intelligence/enemy-intelligence.php',
        'module' => 'includes/page_modules/intelligence/enemy-intelligence.php',
      ),
    ),
    'resource-exchange' =>
    array (
      'route' => 'resource-exchange',
      'group' => 'market',
      'group_label' => 'Market',
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
      'details' =>
      array (
        'hero' => 'Market Exchange',
        'panels' =>
        array (
          0 => 'Open orders',
          1 => 'Price history',
          2 => 'Order form',
          3 => 'Settlement status',
        ),
        'formula' => 'settlement = quantity × unit price + market fee',
        'controls' =>
        array (
          0 => 'List order',
          1 => 'Buy order',
          2 => 'Cancel order',
        ),
        'action' => 'market_list',
        'tables' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'mercenary_types',
        ),
        'permission' => 'authenticated commander with market turns',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Markets',
        'purpose' => 'Trade resources, weapons, and mercenaries.',
        'buttons' =>
        array (
          'List order' =>
          array (
            'action' => 'market_list',
            'logic' => 'Validate resource, quantity, unit price, turn balance, and expiry.',
            'permission' => 'authenticated trader',
            'reads' =>
            array (
              0 => 'player_resources',
              1 => 'market_orders',
            ),
            'writes' =>
            array (
              0 => 'market_orders',
              1 => 'trade_contracts',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'cooldown',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Buy order' =>
          array (
            'action' => 'market_buy',
            'logic' => 'Lock order, check funds, transfer resource, and settle seller.',
            'permission' => 'authenticated trader',
            'reads' =>
            array (
              0 => 'market_orders',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'market_orders',
              1 => 'player_resources',
              2 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'List and buy resource, weapon, and mercenary market orders.',
        'workflow' =>
        array (
          0 => 'load orders',
          1 => 'validate order fields',
          2 => 'lock balance or order',
          3 => 'settle trade',
          4 => 'write market event',
        ),
        'validation' =>
        array (
          0 => 'authenticated trader',
          1 => 'market turns',
          2 => 'positive quantity',
          3 => 'available balance',
          4 => 'order ownership',
        ),
        'calculations' =>
        array (
          0 => 'quantity × unit price + market fee',
        ),
        'mutations' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'open orders',
        1 => 'price history',
        2 => 'order form',
        3 => 'buy order',
        4 => 'list order',
        5 => 'settlement status',
      ),
      'design' =>
      array (
        'template' => 'market-exchange',
        'sections' =>
        array (
          0 => 'orders',
          1 => 'price history',
          2 => 'order form',
          3 => 'settlement',
        ),
        'components' =>
        array (
          0 => 'order-table',
          1 => 'price-badge',
          2 => 'order-form',
          3 => 'settlement-banner',
        ),
        'responsive' => 'Market tables scroll or stack into order cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MarketService',
        ),
        'reads' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'mercenary_types',
        ),
        'writes' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'market_list',
          1 => 'market_buy',
          2 => 'market_cancel',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/market/resource-exchange.php',
        'features' => 'config/page_features/market/resource-exchange.php',
        'design' => 'config/page_design_specs/market/resource-exchange.php',
        'systems' => 'config/page_systems/market/resource-exchange.php',
        'module' => 'includes/page_modules/market/resource-exchange.php',
      ),
    ),
    'mercenary-market' =>
    array (
      'route' => 'mercenary-market',
      'group' => 'market',
      'group_label' => 'Market',
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
      'details' =>
      array (
        'hero' => 'Market Exchange',
        'panels' =>
        array (
          0 => 'Open orders',
          1 => 'Price history',
          2 => 'Order form',
          3 => 'Settlement status',
        ),
        'formula' => 'settlement = quantity × unit price + market fee',
        'controls' =>
        array (
          0 => 'List order',
          1 => 'Buy order',
          2 => 'Cancel order',
        ),
        'action' => 'market_list',
        'tables' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'mercenary_types',
        ),
        'permission' => 'authenticated commander with market turns',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Markets',
        'purpose' => 'Trade resources, weapons, and mercenaries.',
        'buttons' =>
        array (
          'List order' =>
          array (
            'action' => 'market_list',
            'logic' => 'Validate resource, quantity, unit price, turn balance, and expiry.',
            'permission' => 'authenticated trader',
            'reads' =>
            array (
              0 => 'player_resources',
              1 => 'market_orders',
            ),
            'writes' =>
            array (
              0 => 'market_orders',
              1 => 'trade_contracts',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'cooldown',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Buy order' =>
          array (
            'action' => 'market_buy',
            'logic' => 'Lock order, check funds, transfer resource, and settle seller.',
            'permission' => 'authenticated trader',
            'reads' =>
            array (
              0 => 'market_orders',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'market_orders',
              1 => 'player_resources',
              2 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'List and buy resource, weapon, and mercenary market orders.',
        'workflow' =>
        array (
          0 => 'load orders',
          1 => 'validate order fields',
          2 => 'lock balance or order',
          3 => 'settle trade',
          4 => 'write market event',
        ),
        'validation' =>
        array (
          0 => 'authenticated trader',
          1 => 'market turns',
          2 => 'positive quantity',
          3 => 'available balance',
          4 => 'order ownership',
        ),
        'calculations' =>
        array (
          0 => 'quantity × unit price + market fee',
        ),
        'mutations' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'open orders',
        1 => 'price history',
        2 => 'order form',
        3 => 'buy order',
        4 => 'list order',
        5 => 'settlement status',
      ),
      'design' =>
      array (
        'template' => 'market-exchange',
        'sections' =>
        array (
          0 => 'orders',
          1 => 'price history',
          2 => 'order form',
          3 => 'settlement',
        ),
        'components' =>
        array (
          0 => 'order-table',
          1 => 'price-badge',
          2 => 'order-form',
          3 => 'settlement-banner',
        ),
        'responsive' => 'Market tables scroll or stack into order cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MarketService',
        ),
        'reads' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'mercenary_types',
        ),
        'writes' =>
        array (
          0 => 'market_orders',
          1 => 'trade_contracts',
          2 => 'player_resources',
          3 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'market_list',
          1 => 'market_buy',
          2 => 'market_cancel',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/market/mercenary-market.php',
        'features' => 'config/page_features/market/mercenary-market.php',
        'design' => 'config/page_design_specs/market/mercenary-market.php',
        'systems' => 'config/page_systems/market/mercenary-market.php',
        'module' => 'includes/page_modules/market/mercenary-market.php',
      ),
    ),
    'rankings' =>
    array (
      'route' => 'rankings',
      'group' => 'social',
      'group_label' => 'Social',
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
      'details' =>
      array (
        'hero' => 'Rankings',
        'panels' =>
        array (
          0 => 'Overall leaderboard',
          1 => 'Military leaderboard',
          2 => 'Economy leaderboard',
          3 => 'Covert leaderboard',
          4 => 'Historical snapshots',
        ),
        'formula' => 'score = weighted economy + military + covert + progression + colony value',
        'controls' =>
        array (
          0 => 'Refresh rankings',
          1 => 'Open player',
          2 => 'View snapshot',
        ),
        'action' => 'refresh_rankings',
        'tables' =>
        array (
          0 => 'rankings',
          1 => 'rank_snapshots',
          2 => 'players',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Rankings',
        'purpose' => 'Compare commanders and preserve ranking snapshots.',
        'buttons' =>
        array (
          'Refresh rankings' =>
          array (
            'action' => 'refresh_rankings',
            'logic' => 'Recalculate weighted scores and persist snapshot.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'player_resources',
              2 => 'rankings',
            ),
            'writes' =>
            array (
              0 => 'rankings',
              1 => 'rank_snapshots',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Open player' =>
          array (
            'action' => 'read_profile',
            'logic' => 'Open public commander profile without exposing private fields.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'rankings',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'not-found',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Compare economy, military, covert, progression, and colony scores.',
        'workflow' =>
        array (
          0 => 'load ranking snapshot',
          1 => 'calculate or refresh scores',
          2 => 'filter leaderboard',
          3 => 'open public profile',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'public profile field policy',
        ),
        'calculations' =>
        array (
          0 => 'weighted economy + military + covert + progression + colony value',
        ),
        'mutations' =>
        array (
          0 => 'rankings',
          1 => 'rank_snapshots',
        ),
      ),
      'features' =>
      array (
        0 => 'overall leaderboard',
        1 => 'military leaderboard',
        2 => 'economy leaderboard',
        3 => 'covert leaderboard',
        4 => 'historical snapshots',
      ),
      'design' =>
      array (
        'template' => 'ranking-table',
        'sections' =>
        array (
          0 => 'filters',
          1 => 'leaderboard',
          2 => 'score breakdown',
          3 => 'snapshots',
        ),
        'components' =>
        array (
          0 => 'ranking-table',
          1 => 'score-badge',
          2 => 'filter-tabs',
          3 => 'snapshot-selector',
        ),
        'responsive' => 'Leaderboard columns collapse into ranked cards',
      ),
      'systems' =>
      array (
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
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/social/rankings.php',
        'features' => 'config/page_features/social/rankings.php',
        'design' => 'config/page_design_specs/social/rankings.php',
        'systems' => 'config/page_systems/social/rankings.php',
        'module' => 'includes/page_modules/social/rankings.php',
      ),
    ),
    'alliances' =>
    array (
      'route' => 'alliances',
      'group' => 'social',
      'group_label' => 'Social',
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
        'logic' => 'config/page_logic/social/alliances.php',
        'features' => 'config/page_features/social/alliances.php',
        'design' => 'config/page_design_specs/social/alliances.php',
        'systems' => 'config/page_systems/social/alliances.php',
        'module' => 'includes/page_modules/social/alliances.php',
      ),
    ),
    'messages' =>
    array (
      'route' => 'messages',
      'group' => 'social',
      'group_label' => 'Social',
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
      'details' =>
      array (
        'hero' => 'Messages',
        'panels' =>
        array (
          0 => 'Inbox',
          1 => 'Unread count',
          2 => 'Compose message',
          3 => 'Blacklist and notifications',
        ),
        'formula' => 'message = validated sender + recipient + content policy + notification event',
        'controls' =>
        array (
          0 => 'Send',
          1 => 'Mark read',
          2 => 'Blacklist',
        ),
        'action' => 'message',
        'tables' =>
        array (
          0 => 'messages',
          1 => 'blacklists',
          2 => 'player_notifications',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Messages',
        'purpose' => 'Communicate and manage notifications.',
        'buttons' =>
        array (
          'Send' =>
          array (
            'action' => 'message',
            'logic' => 'Validate recipient, content, blacklist, and notification creation.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'blacklists',
            ),
            'writes' =>
            array (
              0 => 'messages',
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
          'Mark read' =>
          array (
            'action' => 'message_read',
            'logic' => 'Verify recipient and mark message read.',
            'permission' => 'message recipient',
            'reads' =>
            array (
              0 => 'messages',
            ),
            'writes' =>
            array (
              0 => 'messages',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
          'Blacklist' =>
          array (
            'action' => 'blacklist',
            'logic' => 'Verify target and upsert communication block.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'players',
              1 => 'blacklists',
            ),
            'writes' =>
            array (
              0 => 'blacklists',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Send, receive, read, and block commander messages.',
        'workflow' =>
        array (
          0 => 'load inbox',
          1 => 'validate sender and recipient',
          2 => 'apply content policy',
          3 => 'write message and notification',
          4 => 'update read or blacklist state',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'recipient exists',
          2 => 'blacklist policy',
          3 => 'message ownership',
        ),
        'calculations' =>
        array (
          0 => 'unread count',
        ),
        'mutations' =>
        array (
          0 => 'messages',
          1 => 'blacklists',
          2 => 'player_notifications',
        ),
      ),
      'features' =>
      array (
        0 => 'inbox',
        1 => 'unread count',
        2 => 'compose',
        3 => 'mark read',
        4 => 'blacklist',
        5 => 'notifications',
      ),
      'design' =>
      array (
        'template' => 'message-center',
        'sections' =>
        array (
          0 => 'inbox',
          1 => 'compose',
          2 => 'read state',
          3 => 'blacklist',
        ),
        'components' =>
        array (
          0 => 'message-list',
          1 => 'compose-form',
          2 => 'unread-badge',
          3 => 'blacklist-control',
        ),
        'responsive' => 'Message rows become conversation cards',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MessageService',
          1 => 'NotificationService',
        ),
        'reads' =>
        array (
          0 => 'messages',
          1 => 'blacklists',
          2 => 'player_notifications',
          3 => 'players',
        ),
        'writes' =>
        array (
          0 => 'messages',
          1 => 'blacklists',
          2 => 'player_notifications',
        ),
        'actions' =>
        array (
          0 => 'message',
          1 => 'message_read',
          2 => 'blacklist',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/social/messages.php',
        'features' => 'config/page_features/social/messages.php',
        'design' => 'config/page_design_specs/social/messages.php',
        'systems' => 'config/page_systems/social/messages.php',
        'module' => 'includes/page_modules/social/messages.php',
      ),
    ),
    'planet-list' =>
    array (
      'route' => 'planet-list',
      'group' => 'planets',
      'group_label' => 'Planets',
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
      'details' =>
      array (
        'hero' => 'Planet and Colony Management',
        'panels' =>
        array (
          0 => 'Planet portfolio',
          1 => 'Biome modifiers',
          2 => 'Defenses',
          3 => 'Population and life support',
        ),
        'formula' => 'colony state = production − food/water upkeep + morale and habitability modifiers',
        'controls' =>
        array (
          0 => 'Explore',
          1 => 'Colonize',
          2 => 'Upgrade defense',
          3 => 'View bonuses',
        ),
        'action' => 'planet_defense',
        'tables' =>
        array (
          0 => 'player_planets',
          1 => 'planet_bonuses',
          2 => 'planet_defenses',
          3 => 'universe_planets',
          4 => 'player_colonies',
        ),
        'permission' => 'authenticated colony owner',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'protected',
          3 => 'insufficient-resource',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Planets and Colonies',
        'purpose' => 'Manage owned colonies, life support, production output, and fleet presence.',
        'buttons' =>
        array (
          'Explore' =>
          array (
            'action' => 'explore',
            'logic' => 'Dispatch mothership exploration to a validated unoccupied universe planet; legacy named-planet exploration remains supported for compatibility.',
            'permission' => 'authenticated commander with colony and mothership authority',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'planet_bonuses',
              2 => 'planet_explorations',
              3 => 'player_resources',
              4 => 'universe_planets',
              5 => 'motherships',
              6 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_explorations',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Colonize' =>
          array (
            'action' => 'colonize_planet',
            'logic' => 'Lock a validated planet, verify habitability, occupancy, colony capacity, ownership, resources, cooldown, and transaction state, then create the colony.',
            'permission' => 'authenticated commander with colonization access',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
              2 => 'planet_bonuses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
              2 => 'planet_bonuses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
              5 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Upgrade defense' =>
          array (
            'action' => 'planet_defense',
            'logic' => 'Validate colony ownership, defense type, resource cost, cooldown, and defense level cap before queuing the upgrade atomically.',
            'permission' => 'authenticated colony owner',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'planet_bonuses',
              2 => 'planet_defenses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_defenses',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage colonies, biomes, defenses, population, and life support.',
        'workflow' =>
        array (
          0 => 'load planet portfolio',
          1 => 'load biome and bonuses',
          2 => 'validate colony ownership',
          3 => 'process exploration or defense action',
          4 => 'render life support',
        ),
        'validation' =>
        array (
          0 => 'authenticated colony owner',
          1 => 'planet occupancy',
          2 => 'habitability',
          3 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'production − food/water upkeep + morale and habitability modifiers',
        ),
        'mutations' =>
        array (
          0 => 'player_colonies',
          1 => 'planet_defenses',
          2 => 'universe_planets',
          3 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'planet portfolio',
        1 => 'biome modifiers',
        2 => 'defenses',
        3 => 'population',
        4 => 'food and water',
        5 => 'exploration',
        6 => 'colonization',
      ),
      'design' =>
      array (
        'template' => 'colony-grid',
        'sections' =>
        array (
          0 => 'planet selector',
          1 => 'population',
          2 => 'biome',
          3 => 'life support',
          4 => 'defenses',
        ),
        'components' =>
        array (
          0 => 'planet-card',
          1 => 'biome-badge',
          2 => 'life-support-meter',
          3 => 'defense-table',
        ),
        'responsive' => 'Planet cards use one column on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ColonyService',
          1 => 'PlanetService',
          2 => 'ExplorationService',
        ),
        'reads' =>
        array (
          0 => 'player_planets',
          1 => 'player_colonies',
          2 => 'planet_bonuses',
          3 => 'planet_defenses',
          4 => 'universe_planets',
        ),
        'writes' =>
        array (
          0 => 'player_colonies',
          1 => 'planet_defenses',
          2 => 'universe_planets',
          3 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'explore',
          1 => 'colonize_planet',
          2 => 'planet_defense',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/planets/planet-list.php',
        'features' => 'config/page_features/planets/planet-list.php',
        'design' => 'config/page_design_specs/planets/planet-list.php',
        'systems' => 'config/page_systems/planets/planet-list.php',
        'module' => 'includes/page_modules/planets/planet-list.php',
      ),
    ),
    'planet-bonuses' =>
    array (
      'route' => 'planet-bonuses',
      'group' => 'planets',
      'group_label' => 'Planets',
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
      'details' =>
      array (
        'hero' => 'Planet and Colony Management',
        'panels' =>
        array (
          0 => 'Planet portfolio',
          1 => 'Biome modifiers',
          2 => 'Defenses',
          3 => 'Population and life support',
        ),
        'formula' => 'colony state = production − food/water upkeep + morale and habitability modifiers',
        'controls' =>
        array (
          0 => 'Explore',
          1 => 'Colonize',
          2 => 'Upgrade defense',
          3 => 'View bonuses',
        ),
        'action' => 'planet_defense',
        'tables' =>
        array (
          0 => 'player_planets',
          1 => 'planet_bonuses',
          2 => 'planet_defenses',
          3 => 'universe_planets',
          4 => 'player_colonies',
        ),
        'permission' => 'authenticated colony owner',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'protected',
          3 => 'insufficient-resource',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Planets and Colonies',
        'purpose' => 'Manage owned colonies, life support, production output, and fleet presence.',
        'buttons' =>
        array (
          'Explore' =>
          array (
            'action' => 'explore',
            'logic' => 'Dispatch mothership exploration to a validated unoccupied universe planet; legacy named-planet exploration remains supported for compatibility.',
            'permission' => 'authenticated commander with colony and mothership authority',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'planet_bonuses',
              2 => 'planet_explorations',
              3 => 'player_resources',
              4 => 'universe_planets',
              5 => 'motherships',
              6 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_explorations',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Colonize' =>
          array (
            'action' => 'colonize_planet',
            'logic' => 'Lock a validated planet, verify habitability, occupancy, colony capacity, ownership, resources, cooldown, and transaction state, then create the colony.',
            'permission' => 'authenticated commander with colonization access',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
              2 => 'planet_bonuses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
              2 => 'planet_bonuses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
              5 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Upgrade defense' =>
          array (
            'action' => 'planet_defense',
            'logic' => 'Validate colony ownership, defense type, resource cost, cooldown, and defense level cap before queuing the upgrade atomically.',
            'permission' => 'authenticated colony owner',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'planet_bonuses',
              2 => 'planet_defenses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_defenses',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage colonies, biomes, defenses, population, and life support.',
        'workflow' =>
        array (
          0 => 'load planet portfolio',
          1 => 'load biome and bonuses',
          2 => 'validate colony ownership',
          3 => 'process exploration or defense action',
          4 => 'render life support',
        ),
        'validation' =>
        array (
          0 => 'authenticated colony owner',
          1 => 'planet occupancy',
          2 => 'habitability',
          3 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'production − food/water upkeep + morale and habitability modifiers',
        ),
        'mutations' =>
        array (
          0 => 'player_colonies',
          1 => 'planet_defenses',
          2 => 'universe_planets',
          3 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'planet portfolio',
        1 => 'biome modifiers',
        2 => 'defenses',
        3 => 'population',
        4 => 'food and water',
        5 => 'exploration',
        6 => 'colonization',
      ),
      'design' =>
      array (
        'template' => 'colony-grid',
        'sections' =>
        array (
          0 => 'planet selector',
          1 => 'population',
          2 => 'biome',
          3 => 'life support',
          4 => 'defenses',
        ),
        'components' =>
        array (
          0 => 'planet-card',
          1 => 'biome-badge',
          2 => 'life-support-meter',
          3 => 'defense-table',
        ),
        'responsive' => 'Planet cards use one column on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ColonyService',
          1 => 'PlanetService',
          2 => 'ExplorationService',
        ),
        'reads' =>
        array (
          0 => 'player_planets',
          1 => 'player_colonies',
          2 => 'planet_bonuses',
          3 => 'planet_defenses',
          4 => 'universe_planets',
        ),
        'writes' =>
        array (
          0 => 'player_colonies',
          1 => 'planet_defenses',
          2 => 'universe_planets',
          3 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'explore',
          1 => 'colonize_planet',
          2 => 'planet_defense',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/planets/planet-bonuses.php',
        'features' => 'config/page_features/planets/planet-bonuses.php',
        'design' => 'config/page_design_specs/planets/planet-bonuses.php',
        'systems' => 'config/page_systems/planets/planet-bonuses.php',
        'module' => 'includes/page_modules/planets/planet-bonuses.php',
      ),
    ),
    'planet-defenses' =>
    array (
      'route' => 'planet-defenses',
      'group' => 'planets',
      'group_label' => 'Planets',
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
      'details' =>
      array (
        'hero' => 'Planet and Colony Management',
        'panels' =>
        array (
          0 => 'Planet portfolio',
          1 => 'Biome modifiers',
          2 => 'Defenses',
          3 => 'Population and life support',
        ),
        'formula' => 'colony state = production − food/water upkeep + morale and habitability modifiers',
        'controls' =>
        array (
          0 => 'Explore',
          1 => 'Colonize',
          2 => 'Upgrade defense',
          3 => 'View bonuses',
        ),
        'action' => 'planet_defense',
        'tables' =>
        array (
          0 => 'player_planets',
          1 => 'planet_bonuses',
          2 => 'planet_defenses',
          3 => 'universe_planets',
          4 => 'player_colonies',
        ),
        'permission' => 'authenticated colony owner',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'protected',
          3 => 'insufficient-resource',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Planets and Colonies',
        'purpose' => 'Manage owned colonies, life support, production output, and fleet presence.',
        'buttons' =>
        array (
          'Explore' =>
          array (
            'action' => 'explore',
            'logic' => 'Dispatch mothership exploration to a validated unoccupied universe planet; legacy named-planet exploration remains supported for compatibility.',
            'permission' => 'authenticated commander with colony and mothership authority',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'planet_bonuses',
              2 => 'planet_explorations',
              3 => 'player_resources',
              4 => 'universe_planets',
              5 => 'motherships',
              6 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_explorations',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Colonize' =>
          array (
            'action' => 'colonize_planet',
            'logic' => 'Lock a validated planet, verify habitability, occupancy, colony capacity, ownership, resources, cooldown, and transaction state, then create the colony.',
            'permission' => 'authenticated commander with colonization access',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
              2 => 'planet_bonuses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
              2 => 'planet_bonuses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
              5 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Upgrade defense' =>
          array (
            'action' => 'planet_defense',
            'logic' => 'Validate colony ownership, defense type, resource cost, cooldown, and defense level cap before queuing the upgrade atomically.',
            'permission' => 'authenticated colony owner',
            'reads' =>
            array (
              0 => 'player_colonies',
              1 => 'planet_bonuses',
              2 => 'planet_defenses',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_defenses',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage colonies, biomes, defenses, population, and life support.',
        'workflow' =>
        array (
          0 => 'load planet portfolio',
          1 => 'load biome and bonuses',
          2 => 'validate colony ownership',
          3 => 'process exploration or defense action',
          4 => 'render life support',
        ),
        'validation' =>
        array (
          0 => 'authenticated colony owner',
          1 => 'planet occupancy',
          2 => 'habitability',
          3 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'production − food/water upkeep + morale and habitability modifiers',
        ),
        'mutations' =>
        array (
          0 => 'player_colonies',
          1 => 'planet_defenses',
          2 => 'universe_planets',
          3 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'planet portfolio',
        1 => 'biome modifiers',
        2 => 'defenses',
        3 => 'population',
        4 => 'food and water',
        5 => 'exploration',
        6 => 'colonization',
      ),
      'design' =>
      array (
        'template' => 'colony-grid',
        'sections' =>
        array (
          0 => 'planet selector',
          1 => 'population',
          2 => 'biome',
          3 => 'life support',
          4 => 'defenses',
        ),
        'components' =>
        array (
          0 => 'planet-card',
          1 => 'biome-badge',
          2 => 'life-support-meter',
          3 => 'defense-table',
        ),
        'responsive' => 'Planet cards use one column on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ColonyService',
          1 => 'PlanetService',
          2 => 'ExplorationService',
        ),
        'reads' =>
        array (
          0 => 'player_planets',
          1 => 'player_colonies',
          2 => 'planet_bonuses',
          3 => 'planet_defenses',
          4 => 'universe_planets',
        ),
        'writes' =>
        array (
          0 => 'player_colonies',
          1 => 'planet_defenses',
          2 => 'universe_planets',
          3 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'explore',
          1 => 'colonize_planet',
          2 => 'planet_defense',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/planets/planet-defenses.php',
        'features' => 'config/page_features/planets/planet-defenses.php',
        'design' => 'config/page_design_specs/planets/planet-defenses.php',
        'systems' => 'config/page_systems/planets/planet-defenses.php',
        'module' => 'includes/page_modules/planets/planet-defenses.php',
      ),
    ),
    'ship' =>
    array (
      'route' => 'ship',
      'group' => 'mothership',
      'group_label' => 'Mothership',
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
      'details' =>
      array (
        'hero' => 'Mothership Command',
        'panels' =>
        array (
          0 => 'Hull',
          1 => 'Weapons and shields',
          2 => 'Hangars',
          3 => 'Modules and capacity',
        ),
        'formula' => 'ship readiness = hull + modules + weapons + shields + fleet capacity',
        'controls' =>
        array (
          0 => 'Upgrade hull',
          1 => 'Upgrade hangars',
          2 => 'Upgrade shields',
          3 => 'Upgrade module',
        ),
        'action' => 'mothership_upgrade',
        'tables' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
        ),
        'permission' => 'authenticated mothership owner',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'queued',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Mothership and Modules',
        'purpose' => 'Upgrade the commander’s strategic vessel.',
        'buttons' =>
        array (
          'Upgrade hull' =>
          array (
            'action' => 'mothership_upgrade',
            'logic' => 'Validate module type, cost, prerequisite, and capacity.',
            'permission' => 'mothership owner',
            'reads' =>
            array (
              0 => 'motherships',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'motherships',
              1 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'queued',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Explore' =>
          array (
            'action' => 'explore',
            'logic' => 'Dispatch mothership exploration to a validated universe target and persist yield, travel, risk, cooldown, resource, and event state atomically.',
            'permission' => 'mothership owner with hull readiness',
            'reads' =>
            array (
              0 => 'motherships',
              1 => 'universe_solar_systems',
              2 => 'universe_planets',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_explorations',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'insufficient-resource',
              3 => 'cooldown',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Command the mothership hull, hangars, shields, weapons, and modules.',
        'workflow' =>
        array (
          0 => 'load mothership',
          1 => 'select upgrade',
          2 => 'validate module prerequisite',
          3 => 'lock resources',
          4 => 'queue or apply upgrade',
        ),
        'validation' =>
        array (
          0 => 'mothership owner',
          1 => 'module prerequisite',
          2 => 'resource balance',
          3 => 'capacity cap',
        ),
        'calculations' =>
        array (
          0 => 'hull + modules + weapons + shields + fleet capacity',
        ),
        'mutations' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
          3 => 'construction_queue',
        ),
      ),
      'features' =>
      array (
        0 => 'hull',
        1 => 'weapons and shields',
        2 => 'hangars',
        3 => 'modules',
        4 => 'capacity',
        5 => 'upgrade queue',
      ),
      'design' =>
      array (
        'template' => 'mothership-command',
        'sections' =>
        array (
          0 => 'hull',
          1 => 'weapons',
          2 => 'hangars',
          3 => 'modules',
        ),
        'components' =>
        array (
          0 => 'ship-stat',
          1 => 'module-card',
          2 => 'capacity-meter',
          3 => 'upgrade-form',
        ),
        'responsive' => 'Ship systems stack into full-width modules',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MothershipService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
          3 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
          3 => 'construction_queue',
        ),
        'actions' =>
        array (
          0 => 'mothership_upgrade',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/mothership/ship.php',
        'features' => 'config/page_features/mothership/ship.php',
        'design' => 'config/page_design_specs/mothership/ship.php',
        'systems' => 'config/page_systems/mothership/ship.php',
        'module' => 'includes/page_modules/mothership/ship.php',
      ),
    ),
    'modules' =>
    array (
      'route' => 'modules',
      'group' => 'mothership',
      'group_label' => 'Mothership',
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
      'details' =>
      array (
        'hero' => 'Mothership Command',
        'panels' =>
        array (
          0 => 'Hull',
          1 => 'Weapons and shields',
          2 => 'Hangars',
          3 => 'Modules and capacity',
        ),
        'formula' => 'ship readiness = hull + modules + weapons + shields + fleet capacity',
        'controls' =>
        array (
          0 => 'Upgrade hull',
          1 => 'Upgrade hangars',
          2 => 'Upgrade shields',
          3 => 'Upgrade module',
        ),
        'action' => 'mothership_upgrade',
        'tables' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
        ),
        'permission' => 'authenticated mothership owner',
        'states' =>
        array (
          0 => 'ready',
          1 => 'insufficient-resource',
          2 => 'queued',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Mothership and Modules',
        'purpose' => 'Upgrade the commander’s strategic vessel.',
        'buttons' =>
        array (
          'Upgrade hull' =>
          array (
            'action' => 'mothership_upgrade',
            'logic' => 'Validate module type, cost, prerequisite, and capacity.',
            'permission' => 'mothership owner',
            'reads' =>
            array (
              0 => 'motherships',
              1 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'motherships',
              1 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'queued',
              3 => 'success',
              4 => 'error',
            ),
          ),
          'Explore' =>
          array (
            'action' => 'explore',
            'logic' => 'Dispatch mothership exploration to a validated universe target and persist yield, travel, risk, cooldown, resource, and event state atomically.',
            'permission' => 'mothership owner with hull readiness',
            'reads' =>
            array (
              0 => 'motherships',
              1 => 'universe_solar_systems',
              2 => 'universe_planets',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_explorations',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'insufficient-resource',
              3 => 'cooldown',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Command the mothership hull, hangars, shields, weapons, and modules.',
        'workflow' =>
        array (
          0 => 'load mothership',
          1 => 'select upgrade',
          2 => 'validate module prerequisite',
          3 => 'lock resources',
          4 => 'queue or apply upgrade',
        ),
        'validation' =>
        array (
          0 => 'mothership owner',
          1 => 'module prerequisite',
          2 => 'resource balance',
          3 => 'capacity cap',
        ),
        'calculations' =>
        array (
          0 => 'hull + modules + weapons + shields + fleet capacity',
        ),
        'mutations' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
          3 => 'construction_queue',
        ),
      ),
      'features' =>
      array (
        0 => 'hull',
        1 => 'weapons and shields',
        2 => 'hangars',
        3 => 'modules',
        4 => 'capacity',
        5 => 'upgrade queue',
      ),
      'design' =>
      array (
        'template' => 'mothership-command',
        'sections' =>
        array (
          0 => 'hull',
          1 => 'weapons',
          2 => 'hangars',
          3 => 'modules',
        ),
        'components' =>
        array (
          0 => 'ship-stat',
          1 => 'module-card',
          2 => 'capacity-meter',
          3 => 'upgrade-form',
        ),
        'responsive' => 'Ship systems stack into full-width modules',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'MothershipService',
          1 => 'QueueService',
        ),
        'reads' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
          3 => 'construction_queue',
        ),
        'writes' =>
        array (
          0 => 'motherships',
          1 => 'mothership_modules',
          2 => 'player_resources',
          3 => 'construction_queue',
        ),
        'actions' =>
        array (
          0 => 'mothership_upgrade',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/mothership/modules.php',
        'features' => 'config/page_features/mothership/modules.php',
        'design' => 'config/page_design_specs/mothership/modules.php',
        'systems' => 'config/page_systems/mothership/modules.php',
        'module' => 'includes/page_modules/mothership/modules.php',
      ),
    ),
    'exploration' =>
    array (
      'route' => 'exploration',
      'group' => 'mothership',
      'group_label' => 'Mothership',
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
      'details' =>
      array (
        'hero' => 'Exploration',
        'panels' =>
        array (
          0 => 'Available expeditions',
          1 => 'Distance and travel time',
          2 => 'Biome rarity and yield',
          3 => 'Discovery risk and mission result',
        ),
        'formula' => 'exploration yield = distance × ship science × biome rarity',
        'controls' =>
        array (
          0 => 'Explore',
        ),
        'action' => 'explore',
        'tables' =>
        array (
          0 => 'motherships',
          1 => 'planet_explorations',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'player_resources',
          5 => 'player_cooldowns',
          6 => 'game_events',
        ),
        'permission' => 'authenticated commander with mothership readiness',
        'states' =>
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'insufficient-resource',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Exploration',
        'purpose' => 'Dispatch a ready mothership to a validated unoccupied universe planet.',
        'buttons' =>
        array (
          'Explore' =>
          array (
            'action' => 'explore',
            'logic' => 'Validate mothership ownership and hull readiness, lock the universe target, calculate distance × ship science × biome rarity, persist travel time and discovery risk, consume Naquadah, and record the result transactionally.',
            'permission' => 'authenticated commander with mothership readiness',
            'reads' =>
            array (
              0 => 'motherships',
              1 => 'universe_solar_systems',
              2 => 'universe_planets',
              3 => 'player_resources',
              4 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'planet_explorations',
              1 => 'player_resources',
              2 => 'player_cooldowns',
              3 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'insufficient-resource',
              3 => 'cooldown',
              4 => 'success',
              5 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Explore systems, planets, moons, anomalies, and discovery rewards.',
        'workflow' =>
        array (
          0 => 'load sensor range',
          1 => 'validate mission capacity',
          2 => 'calculate travel risk',
          3 => 'resolve anomaly',
          4 => 'record discovery',
        ),
        'validation' =>
        array (
          0 => 'exploration-capable commander',
          1 => 'mothership readiness',
          2 => 'cooldown',
          3 => 'target visibility',
        ),
        'calculations' =>
        array (
          0 => 'exploration level + sensor bonus + anomaly rate − travel risk',
        ),
        'mutations' =>
        array (
          0 => 'universe_discoveries',
          1 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'discovery range',
        1 => 'system scan',
        2 => 'anomaly chance',
        3 => 'discovery rewards',
        4 => 'travel risk',
      ),
      'design' =>
      array (
        'template' => 'exploration-board',
        'sections' =>
        array (
          0 => 'range',
          1 => 'system scan',
          2 => 'anomaly',
          3 => 'rewards',
        ),
        'components' =>
        array (
          0 => 'scan-form',
          1 => 'risk-meter',
          2 => 'discovery-card',
          3 => 'mission-status',
        ),
        'responsive' => 'Exploration panels stack vertically',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ExplorationService',
          1 => 'MothershipService',
        ),
        'reads' =>
        array (
          0 => 'motherships',
          1 => 'universe_solar_systems',
          2 => 'universe_planets',
          3 => 'universe_moons',
        ),
        'writes' =>
        array (
          0 => 'universe_discoveries',
          1 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'explore',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/mothership/exploration.php',
        'features' => 'config/page_features/mothership/exploration.php',
        'design' => 'config/page_design_specs/mothership/exploration.php',
        'systems' => 'config/page_systems/mothership/exploration.php',
        'module' => 'includes/page_modules/mothership/exploration.php',
      ),
    ),
    'race' =>
    array (
      'route' => 'race',
      'group' => 'account',
      'group_label' => 'Account',
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
      'details' =>
      array (
        'hero' => 'Account and Registration',
        'panels' =>
        array (
          0 => 'Race identity',
          1 => 'Government identity',
          2 => 'Protection status',
          3 => 'Session and security',
        ),
        'formula' => 'combined modifier = race modifier × government modifier',
        'controls' =>
        array (
          0 => 'Select race',
          1 => 'Select government',
          2 => 'Enable vacation',
          3 => 'View protection',
        ),
        'action' => 'select_registration_faction',
        'tables' =>
        array (
          0 => 'players',
          1 => 'races',
          2 => 'government_types',
          3 => 'protection_states',
          4 => 'player_government_history',
        ),
        'permission' => 'authenticated commander',
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
        'page' => 'Account and Registration',
        'purpose' => 'Manage faction identity, protection, and security.',
        'buttons' =>
        array (
          'Select race and government' =>
          array (
            'action' => 'select_registration_faction',
            'logic' => 'Validate both faction selections and save atomically.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'races',
              1 => 'government_types',
              2 => 'players',
            ),
            'writes' =>
            array (
              0 => 'players',
              1 => 'player_government_history',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
          'Reform government' =>
          array (
            'action' => 'reform_government',
            'logic' => 'Lock player, validate active government, record history, and update government.',
            'permission' => 'authenticated commander with reform access',
            'reads' =>
            array (
              0 => 'government_types',
              1 => 'players',
            ),
            'writes' =>
            array (
              0 => 'players',
              1 => 'player_government_history',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Vacation mode' =>
          array (
            'action' => 'vacation',
            'logic' => 'Validate duration and set protection state.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'protection_states',
            ),
            'writes' =>
            array (
              0 => 'protection_states',
              1 => 'players',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage race, government, vacation, protection, and account security.',
        'workflow' =>
        array (
          0 => 'load faction options',
          1 => 'validate selection',
          2 => 'save faction history',
          3 => 'apply protection state',
          4 => 'render security controls',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'valid race and government',
          2 => 'vacation rules',
          3 => 'protection rules',
        ),
        'calculations' =>
        array (
          0 => 'race modifier × government modifier',
        ),
        'mutations' =>
        array (
          0 => 'players',
          1 => 'player_government_history',
          2 => 'vacation_states',
          3 => 'protection_states',
        ),
      ),
      'features' =>
      array (
        0 => 'race selection',
        1 => 'government selection',
        2 => 'vacation mode',
        3 => 'protection',
        4 => 'session security',
      ),
      'design' =>
      array (
        'template' => 'account-settings',
        'sections' =>
        array (
          0 => 'race selector',
          1 => 'government selector',
          2 => 'vacation',
          3 => 'protection',
          4 => 'security',
        ),
        'components' =>
        array (
          0 => 'faction-selector',
          1 => 'modifier-preview',
          2 => 'vacation-toggle',
          3 => 'security-panel',
        ),
        'responsive' => 'Settings sections stack on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'AccountService',
          1 => 'ProtectionService',
        ),
        'reads' =>
        array (
          0 => 'players',
          1 => 'races',
          2 => 'government_types',
          3 => 'protection_states',
          4 => 'vacation_states',
        ),
        'writes' =>
        array (
          0 => 'players',
          1 => 'player_government_history',
          2 => 'vacation_states',
          3 => 'protection_states',
        ),
        'actions' =>
        array (
          0 => 'select_registration_faction',
          1 => 'change_race',
          2 => 'vacation',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/account/race.php',
        'features' => 'config/page_features/account/race.php',
        'design' => 'config/page_design_specs/account/race.php',
        'systems' => 'config/page_systems/account/race.php',
        'module' => 'includes/page_modules/account/race.php',
      ),
    ),
    'vacation' =>
    array (
      'route' => 'vacation',
      'group' => 'account',
      'group_label' => 'Account',
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
      'details' =>
      array (
        'hero' => 'Account and Registration',
        'panels' =>
        array (
          0 => 'Race identity',
          1 => 'Government identity',
          2 => 'Protection status',
          3 => 'Session and security',
        ),
        'formula' => 'combined modifier = race modifier × government modifier',
        'controls' =>
        array (
          0 => 'Select race',
          1 => 'Select government',
          2 => 'Enable vacation',
          3 => 'View protection',
        ),
        'action' => 'select_registration_faction',
        'tables' =>
        array (
          0 => 'players',
          1 => 'races',
          2 => 'government_types',
          3 => 'protection_states',
          4 => 'player_government_history',
        ),
        'permission' => 'authenticated commander',
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
        'page' => 'Account and Registration',
        'purpose' => 'Manage faction identity, protection, and security.',
        'buttons' =>
        array (
          'Select race and government' =>
          array (
            'action' => 'select_registration_faction',
            'logic' => 'Validate both faction selections and save atomically.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'races',
              1 => 'government_types',
              2 => 'players',
            ),
            'writes' =>
            array (
              0 => 'players',
              1 => 'player_government_history',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'success',
              2 => 'error',
            ),
          ),
          'Reform government' =>
          array (
            'action' => 'reform_government',
            'logic' => 'Lock player, validate active government, record history, and update government.',
            'permission' => 'authenticated commander with reform access',
            'reads' =>
            array (
              0 => 'government_types',
              1 => 'players',
            ),
            'writes' =>
            array (
              0 => 'players',
              1 => 'player_government_history',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
          'Vacation mode' =>
          array (
            'action' => 'vacation',
            'logic' => 'Validate duration and set protection state.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'protection_states',
            ),
            'writes' =>
            array (
              0 => 'protection_states',
              1 => 'players',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'protected',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Manage race, government, vacation, protection, and account security.',
        'workflow' =>
        array (
          0 => 'load faction options',
          1 => 'validate selection',
          2 => 'save faction history',
          3 => 'apply protection state',
          4 => 'render security controls',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'valid race and government',
          2 => 'vacation rules',
          3 => 'protection rules',
        ),
        'calculations' =>
        array (
          0 => 'race modifier × government modifier',
        ),
        'mutations' =>
        array (
          0 => 'players',
          1 => 'player_government_history',
          2 => 'vacation_states',
          3 => 'protection_states',
        ),
      ),
      'features' =>
      array (
        0 => 'race selection',
        1 => 'government selection',
        2 => 'vacation mode',
        3 => 'protection',
        4 => 'session security',
      ),
      'design' =>
      array (
        'template' => 'account-settings',
        'sections' =>
        array (
          0 => 'race selector',
          1 => 'government selector',
          2 => 'vacation',
          3 => 'protection',
          4 => 'security',
        ),
        'components' =>
        array (
          0 => 'faction-selector',
          1 => 'modifier-preview',
          2 => 'vacation-toggle',
          3 => 'security-panel',
        ),
        'responsive' => 'Settings sections stack on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'AccountService',
          1 => 'ProtectionService',
        ),
        'reads' =>
        array (
          0 => 'players',
          1 => 'races',
          2 => 'government_types',
          3 => 'protection_states',
          4 => 'vacation_states',
        ),
        'writes' =>
        array (
          0 => 'players',
          1 => 'player_government_history',
          2 => 'vacation_states',
          3 => 'protection_states',
        ),
        'actions' =>
        array (
          0 => 'select_registration_faction',
          1 => 'change_race',
          2 => 'vacation',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/account/vacation.php',
        'features' => 'config/page_features/account/vacation.php',
        'design' => 'config/page_design_specs/account/vacation.php',
        'systems' => 'config/page_systems/account/vacation.php',
        'module' => 'includes/page_modules/account/vacation.php',
      ),
    ),
    'ascension' =>
    array (
      'route' => 'ascension',
      'group' => 'account',
      'group_label' => 'Account',
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
      'details' =>
      array (
        'hero' => 'Progression and Ascension',
        'panels' =>
        array (
          0 => 'Experience',
          1 => 'Rank and Glory',
          2 => 'Reputation',
          3 => 'Ascension requirements',
        ),
        'formula' => 'level progression consumes experience thresholds and unlocks rank content',
        'controls' =>
        array (
          0 => 'Check eligibility',
          1 => 'Ascend',
          2 => 'View history',
        ),
        'action' => 'ascend',
        'tables' =>
        array (
          0 => 'player_progression',
          1 => 'glory_reputation',
          2 => 'rank_definitions',
          3 => 'ascension_states',
          4 => 'ascensions',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'protected',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Progression and Ascension',
        'purpose' => 'Advance rank and unlock long-term systems.',
        'buttons' =>
        array (
          'Check eligibility' =>
          array (
            'action' => 'read_ascension',
            'logic' => 'Compare Glory, Reputation, level, and required technologies.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'player_progression',
              1 => 'glory_reputation',
              2 => 'ascension_states',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'error',
            ),
          ),
          'Ascend' =>
          array (
            'action' => 'ascend',
            'logic' => 'Lock progression, validate requirements, write ascension, and grant result.',
            'permission' => 'eligible commander',
            'reads' =>
            array (
              0 => 'player_progression',
              1 => 'glory_reputation',
              2 => 'ascension_states',
            ),
            'writes' =>
            array (
              0 => 'ascensions',
              1 => 'players',
              2 => 'game_audit_log',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'locked',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Track universal tier and level progression, Glory, Reputation, and ascension.',
        'workflow' =>
        array (
          0 => 'load progression state',
          1 => 'check thresholds',
          2 => 'calculate cost or eligibility',
          3 => 'advance or ascend transactionally',
          4 => 'write history',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'experience threshold',
          2 => 'tier and level cap',
          3 => 'resource or Glory cost',
        ),
        'calculations' =>
        array (
          0 => 'experience thresholds',
          1 => '21 tiers × 23 levels',
          2 => 'ascension eligibility',
        ),
        'mutations' =>
        array (
          0 => 'player_progression',
          1 => 'glory_reputation',
          2 => 'ascension_states',
          3 => 'ascensions',
          4 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'experience',
        1 => 'tier and level',
        2 => 'Glory',
        3 => 'Reputation',
        4 => 'ascension requirements',
        5 => 'progression history',
      ),
      'design' =>
      array (
        'template' => 'progression-panel',
        'sections' =>
        array (
          0 => 'requirements',
          1 => 'tier and level',
          2 => 'Glory/Reputation',
          3 => 'ascension preview',
          4 => 'history',
        ),
        'components' =>
        array (
          0 => 'progress-bar',
          1 => 'tier-badge',
          2 => 'requirement-list',
          3 => 'ascension-preview',
        ),
        'responsive' => 'Progression metrics stack on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'ProgressionService',
          1 => 'AscensionService',
        ),
        'reads' =>
        array (
          0 => 'player_progression',
          1 => 'glory_reputation',
          2 => 'rank_definitions',
          3 => 'ascension_states',
          4 => 'ascensions',
        ),
        'writes' =>
        array (
          0 => 'player_progression',
          1 => 'glory_reputation',
          2 => 'ascension_states',
          3 => 'ascensions',
          4 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'progression_advance',
          1 => 'ascend',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/account/ascension.php',
        'features' => 'config/page_features/account/ascension.php',
        'design' => 'config/page_design_specs/account/ascension.php',
        'systems' => 'config/page_systems/account/ascension.php',
        'module' => 'includes/page_modules/account/ascension.php',
      ),
    ),
    'galaxies' =>
    array (
      'route' => 'galaxies',
      'group' => 'universe',
      'group_label' => 'Universe',
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
      'details' =>
      array (
        'hero' => 'Galaxy Map',
        'panels' =>
        array (
          0 => 'Galaxy selector',
          1 => 'Star density',
          2 => 'Sector overview',
          3 => 'Travel risk',
        ),
        'formula' => 'travel risk = sector danger × system volatility × distance modifier',
        'controls' =>
        array (
          0 => 'Select galaxy',
          1 => 'Open sector',
          2 => 'Compare density',
        ),
        'action' => NULL,
        'tables' =>
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Galaxy Map',
        'purpose' => 'Browse active galaxies and server-scoped sector distribution.',
        'buttons' =>
        array (
          'Select galaxy' =>
          array (
            'action' => 'universe_galaxies',
            'logic' => 'Validate active galaxy identifiers, coordinate scope, scan permission, discovered-sector visibility, protected records, ownership summaries, and authenticated commander access before loading the map.',
            'permission' => 'authenticated commander · coordinate access',
            'reads' =>
            array (
              0 => 'universe_galaxies',
              1 => 'universe_sectors',
              2 => 'universe_solar_systems',
              3 => 'universe_planets',
              4 => 'universe_discoveries',
              5 => 'target_realms',
            ),
            'writes' =>
            array (
              0 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Browse galaxy density, sector overview, and travel risk.',
        'workflow' =>
        array (
          0 => 'select galaxy',
          1 => 'load sectors',
          2 => 'calculate density and risk',
          3 => 'open sector',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'valid galaxy identifier',
        ),
        'calculations' =>
        array (
          0 => 'sector danger × system volatility × distance modifier',
        ),
        'mutations' =>
        array (
        ),
      ),
      'features' =>
      array (
        0 => 'galaxy selector',
        1 => 'star density',
        2 => 'sector overview',
        3 => 'travel risk',
      ),
      'design' =>
      array (
        'template' => 'galaxy-map',
        'sections' =>
        array (
          0 => 'galaxy selector',
          1 => 'density',
          2 => 'sectors',
          3 => 'risk',
        ),
        'components' =>
        array (
          0 => 'selector',
          1 => 'density-metric',
          2 => 'sector-list',
          3 => 'risk-badge',
        ),
        'responsive' => 'Map lists become stacked rows',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'UniverseService',
        ),
        'reads' =>
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
        ),
        'writes' =>
        array (
        ),
        'actions' =>
        array (
          0 => 'universe_galaxies',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/universe/galaxies.php',
        'features' => 'config/page_features/universe/galaxies.php',
        'design' => 'config/page_design_specs/universe/galaxies.php',
        'systems' => 'config/page_systems/universe/galaxies.php',
        'module' => 'includes/page_modules/universe/galaxies.php',
      ),
    ),
    'sectors' =>
    array (
      'route' => 'sectors',
      'group' => 'universe',
      'group_label' => 'Universe',
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
      'details' =>
      array (
        'hero' => 'Sector Map',
        'panels' =>
        array (
          0 => 'Sector class',
          1 => 'Danger level',
          2 => 'Resource modifier',
          3 => 'Anomaly rate',
        ),
        'formula' => 'sector output = base output × resource modifier; anomaly rate drives events',
        'controls' =>
        array (
          0 => 'Select sector',
          1 => 'Open system',
          2 => 'Filter by risk',
        ),
        'action' => NULL,
        'tables' =>
        array (
          0 => 'universe_sectors',
          1 => 'universe_solar_systems',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Sector Map',
        'purpose' => 'Scan a selected sector and compare systems by risk and strategic value.',
        'buttons' =>
        array (
          'Select sector' =>
          array (
            'action' => 'universe_sectors',
            'logic' => 'Submit only the selected sector identifier; calculate sensor range × mothership science × scan technology on the server, apply sector visibility and scan cooldown, then return ordered systems with classified owner signals and travel lanes.',
            'permission' => 'authenticated commander · sector visibility · scan cooldown',
            'reads' =>
            array (
              0 => 'universe_sectors',
              1 => 'universe_solar_systems',
              2 => 'universe_planets',
              3 => 'motherships',
              4 => 'mothership_modules',
              5 => 'player_technologies',
              6 => 'player_cooldowns',
            ),
            'writes' =>
            array (
              0 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'cooldown',
              4 => 'error',
            ),
          ),
          'Open system' =>
          array (
            'action' => 'read_sector',
            'logic' => 'Open a system only after the selected sector and coordinate visibility checks pass.',
            'permission' => 'authenticated commander with permitted sector access',
            'reads' =>
            array (
              0 => 'universe_sectors',
              1 => 'universe_solar_systems',
              2 => 'universe_planets',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'protected',
              3 => 'cooldown',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Inspect sector class, danger, resource modifiers, and anomaly rate.',
        'workflow' =>
        array (
          0 => 'select sector',
          1 => 'load systems',
          2 => 'calculate sector output',
          3 => 'filter by risk',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'valid sector identifier',
        ),
        'calculations' =>
        array (
          0 => 'base output × resource modifier; anomaly rate drives events',
        ),
        'mutations' =>
        array (
        ),
      ),
      'features' =>
      array (
        0 => 'sector class',
        1 => 'danger level',
        2 => 'resource modifier',
        3 => 'anomaly rate',
      ),
      'design' =>
      array (
        'template' => 'sector-map',
        'sections' =>
        array (
          0 => 'sector selector',
          1 => 'danger',
          2 => 'resource modifier',
          3 => 'anomalies',
        ),
        'components' =>
        array (
          0 => 'sector-card',
          1 => 'danger-meter',
          2 => 'modifier-badge',
          3 => 'system-list',
        ),
        'responsive' => 'Sector cards stack on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'UniverseService',
        ),
        'reads' =>
        array (
          0 => 'universe_sectors',
          1 => 'universe_solar_systems',
        ),
        'writes' =>
        array (
        ),
        'actions' =>
        array (
          0 => 'universe_sectors',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/universe/sectors.php',
        'features' => 'config/page_features/universe/sectors.php',
        'design' => 'config/page_design_specs/universe/sectors.php',
        'systems' => 'config/page_systems/universe/sectors.php',
        'module' => 'includes/page_modules/universe/sectors.php',
      ),
    ),
    'solar-systems' =>
    array (
      'route' => 'solar-systems',
      'group' => 'universe',
      'group_label' => 'Universe',
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
      'details' =>
      array (
        'hero' => 'Solar Systems',
        'panels' =>
        array (
          0 => 'Star class',
          1 => 'Orbit map',
          2 => 'Planet slots',
          3 => 'Anomaly scan',
        ),
        'formula' => 'system travel = base travel × system modifier × sector danger',
        'controls' =>
        array (
          0 => 'Open system',
          1 => 'Scan system',
          2 => 'Explore anomaly',
        ),
        'action' => 'explore',
        'tables' =>
        array (
          0 => 'universe_solar_systems',
          1 => 'universe_planets',
          2 => 'universe_discoveries',
        ),
        'permission' => 'authenticated commander',
        'states' =>
        array (
          0 => 'loading',
          1 => 'ready',
          2 => 'empty',
          3 => 'cooldown',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Solar Systems',
        'purpose' => 'Scan stars, orbits, planets, and anomalies.',
        'buttons' =>
        array (
          'Scan system' =>
          array (
            'action' => 'system_map',
            'logic' => 'Load orbit map and resolve permitted scan information.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'universe_solar_systems',
              1 => 'universe_planets',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'error',
            ),
          ),
          'Explore anomaly' =>
          array (
            'action' => 'explore',
            'logic' => 'Create discovery record and event reward when successful.',
            'permission' => 'exploration-capable commander',
            'reads' =>
            array (
              0 => 'universe_solar_systems',
              1 => 'universe_discoveries',
            ),
            'writes' =>
            array (
              0 => 'universe_discoveries',
              1 => 'game_events',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'cooldown',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Browse star class, orbit map, planet slots, and anomalies.',
        'workflow' =>
        array (
          0 => 'open system',
          1 => 'load orbit map',
          2 => 'scan anomaly',
          3 => 'calculate travel',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'valid system identifier',
          2 => 'exploration capacity',
        ),
        'calculations' =>
        array (
          0 => 'base travel × system modifier × sector danger',
        ),
        'mutations' =>
        array (
          0 => 'universe_discoveries',
          1 => 'game_events',
        ),
      ),
      'features' =>
      array (
        0 => 'star class',
        1 => 'orbit map',
        2 => 'planet slots',
        3 => 'anomaly scan',
      ),
      'design' =>
      array (
        'template' => 'solar-system-map',
        'sections' =>
        array (
          0 => 'star',
          1 => 'orbits',
          2 => 'planet slots',
          3 => 'anomaly',
        ),
        'components' =>
        array (
          0 => 'orbit-list',
          1 => 'planet-slot',
          2 => 'star-badge',
          3 => 'scan-control',
        ),
        'responsive' => 'Orbit list becomes stacked planets',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'UniverseService',
          1 => 'ExplorationService',
        ),
        'reads' =>
        array (
          0 => 'universe_solar_systems',
          1 => 'universe_planets',
          2 => 'universe_discoveries',
        ),
        'writes' =>
        array (
          0 => 'universe_discoveries',
          1 => 'game_events',
        ),
        'actions' =>
        array (
          0 => 'system_map',
          1 => 'explore',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/universe/solar-systems.php',
        'features' => 'config/page_features/universe/solar-systems.php',
        'design' => 'config/page_design_specs/universe/solar-systems.php',
        'systems' => 'config/page_systems/universe/solar-systems.php',
        'module' => 'includes/page_modules/universe/solar-systems.php',
      ),
    ),
    'universe-planets' =>
    array (
      'route' => 'universe-planets',
      'group' => 'universe',
      'group_label' => 'Universe',
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
      'details' =>
      array (
        'hero' => 'Universe Planets',
        'panels' =>
        array (
          0 => 'Planet class and biome',
          1 => 'Habitability',
          2 => 'Resource modifiers',
          3 => 'Colony status',
        ),
        'formula' => 'colony viability = habitability × biome × race × government × life support',
        'controls' =>
        array (
          0 => 'Inspect planet',
          1 => 'Colonize planet',
          2 => 'View moons',
        ),
        'action' => 'colonize_planet',
        'tables' =>
        array (
          0 => 'universe_planets',
          1 => 'universe_moons',
          2 => 'player_colonies',
        ),
        'permission' => 'authenticated commander with colonization access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'occupied',
          2 => 'protected',
          3 => 'insufficient-resource',
          4 => 'success',
          5 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Universe Planets',
        'purpose' => 'Inspect worlds and colonization opportunities.',
        'buttons' =>
        array (
          'Inspect planet' =>
          array (
            'action' => 'planet_details',
            'logic' => 'Load class, type, biome, habitability, modifiers, moons, and occupancy.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'universe_planets',
              1 => 'universe_moons',
              2 => 'player_colonies',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'occupied',
              2 => 'empty',
              3 => 'error',
            ),
          ),
          'Colonize planet' =>
          array (
            'action' => 'colonize_planet',
            'logic' => 'Lock the planet and create a player colony only after all validation passes.',
            'permission' => 'colonization-capable commander',
            'reads' =>
            array (
              0 => 'universe_planets',
              1 => 'player_colonies',
            ),
            'writes' =>
            array (
              0 => 'player_colonies',
              1 => 'universe_planets',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'occupied',
              2 => 'insufficient-resource',
              3 => 'success',
              4 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Inspect planet class, biome, habitability, resource modifiers, and colony status.',
        'workflow' =>
        array (
          0 => 'inspect planet',
          1 => 'load biome',
          2 => 'calculate viability',
          3 => 'validate colonization',
          4 => 'create colony',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'colonization access',
          2 => 'occupancy',
          3 => 'habitability',
          4 => 'resource balance',
        ),
        'calculations' =>
        array (
          0 => 'habitability × biome × race × government × life support',
        ),
        'mutations' =>
        array (
          0 => 'universe_planets',
          1 => 'player_colonies',
          2 => 'game_audit_log',
        ),
      ),
      'features' =>
      array (
        0 => 'planet class',
        1 => 'biome',
        2 => 'habitability',
        3 => 'resource modifiers',
        4 => 'colony status',
        5 => 'colonization',
      ),
      'design' =>
      array (
        'template' => 'universe-planet',
        'sections' =>
        array (
          0 => 'planet identity',
          1 => 'biome',
          2 => 'habitability',
          3 => 'resources',
          4 => 'colony status',
        ),
        'components' =>
        array (
          0 => 'planet-detail',
          1 => 'biome-card',
          2 => 'habitability-meter',
          3 => 'colonize-form',
        ),
        'responsive' => 'Planet details stack vertically',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'UniverseService',
          1 => 'ColonyService',
        ),
        'reads' =>
        array (
          0 => 'universe_planets',
          1 => 'universe_moons',
          2 => 'player_colonies',
        ),
        'writes' =>
        array (
          0 => 'universe_planets',
          1 => 'player_colonies',
          2 => 'game_audit_log',
        ),
        'actions' =>
        array (
          0 => 'planet_details',
          1 => 'colonize_planet',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/universe/universe-planets.php',
        'features' => 'config/page_features/universe/universe-planets.php',
        'design' => 'config/page_design_specs/universe/universe-planets.php',
        'systems' => 'config/page_systems/universe/universe-planets.php',
        'module' => 'includes/page_modules/universe/universe-planets.php',
      ),
    ),
    'moons' =>
    array (
      'route' => 'moons',
      'group' => 'universe',
      'group_label' => 'Universe',
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
      'details' =>
      array (
        'hero' => 'Moon Registry',
        'panels' =>
        array (
          0 => 'Moon class and biome',
          1 => 'Sensor bonus',
          2 => 'Jump-gate level',
          3 => 'Orbit relationship',
        ),
        'formula' => 'moon utility = sensor bonus + jump-gate level + moon resource modifiers',
        'controls' =>
        array (
          0 => 'Inspect moon',
          1 => 'Build jump gate',
          2 => 'Assign colony',
        ),
        'action' => 'mothership_upgrade',
        'tables' =>
        array (
          0 => 'universe_moons',
          1 => 'universe_planets',
          2 => 'player_colonies',
          3 => 'mothership_modules',
        ),
        'permission' => 'authenticated commander with moon access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'occupied',
          3 => 'success',
          4 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Moon Registry',
        'purpose' => 'Inspect and develop moons.',
        'buttons' =>
        array (
          'Inspect moon' =>
          array (
            'action' => 'moon_details',
            'logic' => 'Load moon class, biome, sensor bonus, jump-gate, and parent planet.',
            'permission' => 'authenticated commander',
            'reads' =>
            array (
              0 => 'universe_moons',
              1 => 'universe_planets',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'error',
            ),
          ),
          'Build jump gate' =>
          array (
            'action' => 'mothership_upgrade',
            'logic' => 'Validate moon ownership and module cost before upgrading gate.',
            'permission' => 'moon owner',
            'reads' =>
            array (
              0 => 'universe_moons',
              1 => 'player_colonies',
              2 => 'player_resources',
            ),
            'writes' =>
            array (
              0 => 'universe_moons',
              1 => 'player_resources',
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'insufficient-resource',
              2 => 'success',
              3 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Inspect moon class, sensor bonus, jump gate, and orbit relationship.',
        'workflow' =>
        array (
          0 => 'inspect moon',
          1 => 'load parent planet',
          2 => 'calculate utility',
          3 => 'validate jump-gate upgrade',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'moon access',
          2 => 'colony or mothership ownership',
        ),
        'calculations' =>
        array (
          0 => 'sensor bonus + jump-gate level + moon resource modifiers',
        ),
        'mutations' =>
        array (
          0 => 'universe_moons',
          1 => 'mothership_modules',
          2 => 'player_colonies',
        ),
      ),
      'features' =>
      array (
        0 => 'moon registry',
        1 => 'moon class',
        2 => 'sensor bonus',
        3 => 'jump-gate level',
        4 => 'orbit relationship',
      ),
      'design' =>
      array (
        'template' => 'moon-registry',
        'sections' =>
        array (
          0 => 'moon identity',
          1 => 'sensor',
          2 => 'jump gate',
          3 => 'orbit',
          4 => 'assignment',
        ),
        'components' =>
        array (
          0 => 'moon-card',
          1 => 'sensor-meter',
          2 => 'gate-upgrade',
          3 => 'orbit-badge',
        ),
        'responsive' => 'Moon cards stack on mobile',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'UniverseService',
          1 => 'MothershipService',
        ),
        'reads' =>
        array (
          0 => 'universe_moons',
          1 => 'universe_planets',
          2 => 'player_colonies',
          3 => 'mothership_modules',
        ),
        'writes' =>
        array (
          0 => 'mothership_modules',
          1 => 'player_colonies',
        ),
        'actions' =>
        array (
          0 => 'moon_details',
          1 => 'mothership_upgrade',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/universe/moons.php',
        'features' => 'config/page_features/universe/moons.php',
        'design' => 'config/page_design_specs/universe/moons.php',
        'systems' => 'config/page_systems/universe/moons.php',
        'module' => 'includes/page_modules/universe/moons.php',
      ),
    ),
    'coordinates' =>
    array (
      'route' => 'coordinates',
      'group' => 'universe',
      'group_label' => 'Universe',
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
      'details' =>
      array (
        'hero' => 'Coordinate Search',
        'panels' =>
        array (
          0 => 'Coordinate input',
          1 => 'Galaxy result',
          2 => 'System result',
          3 => 'Planet and moon result',
        ),
        'formula' => 'coordinate lookup = validated galaxy : sector : system : slot tuple',
        'controls' =>
        array (
          0 => 'Search coordinates',
          1 => 'Open system',
          2 => 'Inspect planet',
        ),
        'action' => 'coordinate_lookup',
        'tables' =>
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_discoveries',
          5 => 'player_colonies',
        ),
        'permission' => 'authenticated commander · coordinate access',
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'error',
        ),
      ),
      'interaction' =>
      array (
        'page' => 'Coordinate Search',
        'purpose' => 'Locate a validated galaxy:sector:system:orbit tuple and disclose only permitted information.',
        'buttons' =>
        array (
          'Search coordinates' =>
          array (
            'action' => 'coordinate_lookup',
            'logic' => 'Parse galaxy:sector:system:orbit, validate each hierarchy level and bounds, apply discovery filtering, classify ownership, and return scoped navigation identifiers.',
            'permission' => 'authenticated commander · coordinate access',
            'reads' =>
            array (
              0 => 'universe_galaxies',
              1 => 'universe_sectors',
              2 => 'universe_solar_systems',
              3 => 'universe_planets',
              4 => 'universe_discoveries',
              5 => 'player_colonies',
            ),
            'writes' =>
            array (
            ),
            'states' =>
            array (
              0 => 'ready',
              1 => 'empty',
              2 => 'error',
            ),
          ),
        ),
      ),
      'logic' =>
      array (
        'purpose' => 'Validate a coordinate tuple through the galaxy, sector, system, and orbit hierarchy, then apply discovery and ownership visibility.',
        'workflow' =>
        array (
          0 => 'validate coordinate input',
          1 => 'find galaxy',
          2 => 'find sector',
          3 => 'find system',
          4 => 'find planet at orbit slot',
          5 => 'apply discovery filter',
          6 => 'classify ownership and return navigation identifiers',
        ),
        'validation' =>
        array (
          0 => 'authenticated commander',
          1 => 'coordinate format',
          2 => 'coordinate bounds',
          3 => 'hierarchy validity',
          4 => 'discovery or ownership visibility',
        ),
        'calculations' =>
        array (
          0 => 'coordinate lookup = validated galaxy : sector : system : slot tuple',
          1 => 'visibility = discovered system OR commander-owned colony',
        ),
        'mutations' =>
        array (
        ),
      ),
      'features' =>
      array (
        0 => 'coordinate input',
        1 => 'galaxy result',
        2 => 'system result',
        3 => 'planet result',
        4 => 'moon result',
      ),
      'design' =>
      array (
        'template' => 'coordinate-search',
        'sections' =>
        array (
          0 => 'input',
          1 => 'galaxy',
          2 => 'sector',
          3 => 'system',
          4 => 'planet/moon',
        ),
        'components' =>
        array (
          0 => 'coordinate-form',
          1 => 'result-path',
          2 => 'coordinate-badge',
          3 => 'detail-link',
        ),
        'responsive' => 'Result path wraps into vertical steps',
      ),
      'systems' =>
      array (
        'services' =>
        array (
          0 => 'UniverseService',
        ),
        'reads' =>
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_moons',
        ),
        'writes' =>
        array (
        ),
        'actions' =>
        array (
          0 => 'coordinate_lookup',
        ),
      ),
      'contract_files' =>
      array (
        'logic' => 'config/page_logic/universe/coordinates.php',
        'features' => 'config/page_features/universe/coordinates.php',
        'design' => 'config/page_design_specs/universe/coordinates.php',
        'systems' => 'config/page_systems/universe/coordinates.php',
        'module' => 'includes/page_modules/universe/coordinates.php',
      ),
    ),
  ),
);

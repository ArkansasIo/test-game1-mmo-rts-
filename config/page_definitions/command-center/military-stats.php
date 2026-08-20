<?php
return array (
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
);

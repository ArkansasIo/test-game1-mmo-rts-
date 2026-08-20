<?php
return array (
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
);

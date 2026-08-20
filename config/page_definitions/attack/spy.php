<?php
return array (
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
  ),
);

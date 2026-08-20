<?php
return array (
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
);

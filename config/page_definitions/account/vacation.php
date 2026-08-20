<?php
return array (
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
  ),
);

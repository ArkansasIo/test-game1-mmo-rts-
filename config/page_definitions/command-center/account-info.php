<?php
return array (
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
  ),
);

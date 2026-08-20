<?php
return array (
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
);

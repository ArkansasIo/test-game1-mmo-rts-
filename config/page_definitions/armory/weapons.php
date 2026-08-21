<?php
return array (
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
        'action' => 'read_weapon_inventory',
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
      1 => 'read_weapon_inventory',
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
);

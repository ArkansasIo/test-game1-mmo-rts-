<?php
return array (
  'route' => 'lifeform-bonuses',
  'group' => 'lifeforms',
  'group_label' => 'Lifeforms',
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
  'details' => 
  array (
  ),
  'interaction' => 
  array (
  ),
  'logic' => 
  array (
    'purpose' => 'Lifeform Bonuses',
    'workflow' => 
    array (
      0 => 'load state',
      1 => 'validate intent',
      2 => 'render result',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
    ),
    'calculations' => 
    array (
    ),
    'mutations' => 
    array (
    ),
  ),
  'features' => 
  array (
    0 => 'Lifeform Bonuses',
  ),
  'design' => 
  array (
    'template' => 'generic-page',
    'sections' => 
    array (
      0 => 'overview',
      1 => 'controls',
      2 => 'activity',
    ),
    'components' => 
    array (
      0 => 'panel',
      1 => 'status-badge',
    ),
    'responsive' => 'stacked mobile layout',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'PageService',
    ),
    'reads' => 
    array (
      0 => 'game_events',
    ),
    'writes' => 
    array (
    ),
    'actions' => 
    array (
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/lifeforms/lifeform-bonuses.php',
    'features' => 'config/page_features/lifeforms/lifeform-bonuses.php',
    'design' => 'config/page_design_specs/lifeforms/lifeform-bonuses.php',
    'systems' => 'config/page_systems/lifeforms/lifeform-bonuses.php',
    'module' => 'includes/page_modules/lifeforms/lifeform-bonuses.php',
  ),
);

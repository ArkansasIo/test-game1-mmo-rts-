<?php
return array (
  'route' => 'pirate-hunting',
  'group' => 'activities',
  'group_label' => 'Activities',
  'title' => 'Pirate Hunting',
  'layout' => 'activities',
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
    'purpose' => 'Pirate Hunting',
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
    0 => 'Pirate Hunting',
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
    'logic' => 'config/page_logic/activities/pirate-hunting.php',
    'features' => 'config/page_features/activities/pirate-hunting.php',
    'design' => 'config/page_design_specs/activities/pirate-hunting.php',
    'systems' => 'config/page_systems/activities/pirate-hunting.php',
    'module' => 'includes/page_modules/activities/pirate-hunting.php',
  ),
);

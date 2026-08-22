<?php
return array (
  'route' => 'lifeforms-lifeform-research',
  'group' => 'lifeforms',
  'group_label' => 'Lifeforms',
  'title' => 'Lifeform Research',
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
    'purpose' => 'Lifeform Research',
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
    0 => 'Lifeform Research',
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
    'logic' => 'config/page_logic/lifeforms/lifeforms-lifeform-research.php',
    'features' => 'config/page_features/lifeforms/lifeforms-lifeform-research.php',
    'design' => 'config/page_design_specs/lifeforms/lifeforms-lifeform-research.php',
    'systems' => 'config/page_systems/lifeforms/lifeforms-lifeform-research.php',
    'module' => 'includes/page_modules/lifeforms/lifeforms-lifeform-research.php',
  ),
);

<?php
return array (
  'route' => 'world-bosses',
  'group' => 'activities',
  'group_label' => 'Activities',
  'title' => 'World Bosses',
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
    'purpose' => 'World Bosses',
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
    0 => 'World Bosses',
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
    'logic' => 'config/page_logic/activities/world-bosses.php',
    'features' => 'config/page_features/activities/world-bosses.php',
    'design' => 'config/page_design_specs/activities/world-bosses.php',
    'systems' => 'config/page_systems/activities/world-bosses.php',
    'module' => 'includes/page_modules/activities/world-bosses.php',
  ),
);

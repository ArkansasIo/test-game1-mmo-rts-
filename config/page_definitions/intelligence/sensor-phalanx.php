<?php
return array (
  'route' => 'sensor-phalanx',
  'group' => 'intelligence',
  'group_label' => 'Intelligence',
  'title' => 'Sensor Phalanx',
  'layout' => 'combat',
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
    'purpose' => 'Sensor Phalanx',
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
    0 => 'Sensor Phalanx',
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
    'logic' => 'config/page_logic/intelligence/sensor-phalanx.php',
    'features' => 'config/page_features/intelligence/sensor-phalanx.php',
    'design' => 'config/page_design_specs/intelligence/sensor-phalanx.php',
    'systems' => 'config/page_systems/intelligence/sensor-phalanx.php',
    'module' => 'includes/page_modules/intelligence/sensor-phalanx.php',
  ),
);

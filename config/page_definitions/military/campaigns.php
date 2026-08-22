<?php
return array (
  'route' => 'campaigns',
  'group' => 'military',
  'group_label' => 'Military',
  'title' => 'Campaigns',
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
    'purpose' => 'Campaigns',
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
    0 => 'Campaigns',
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
    'logic' => 'config/page_logic/military/campaigns.php',
    'features' => 'config/page_features/military/campaigns.php',
    'design' => 'config/page_design_specs/military/campaigns.php',
    'systems' => 'config/page_systems/military/campaigns.php',
    'module' => 'includes/page_modules/military/campaigns.php',
  ),
);

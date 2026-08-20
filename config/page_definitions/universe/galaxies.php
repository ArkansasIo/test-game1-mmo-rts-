<?php
return array (
  'route' => 'galaxies',
  'group' => 'universe',
  'group_label' => 'Universe',
  'title' => 'Galaxy Map',
  'layout' => 'galaxies',
  'controls' => 
  array (
    0 => 'Select galaxy',
    1 => 'Open sector',
  ),
  'actions' => 
  array (
    0 => 'universe_galaxies',
  ),
  'tables' => 
  array (
    0 => 'universe_galaxies',
    1 => 'universe_sectors',
  ),
  'details' => 
  array (
    'hero' => 'Galaxy Map',
    'panels' => 
    array (
      0 => 'Galaxy selector',
      1 => 'Star density',
      2 => 'Sector overview',
      3 => 'Travel risk',
    ),
    'formula' => 'travel risk = sector danger × system volatility × distance modifier',
    'controls' => 
    array (
      0 => 'Select galaxy',
      1 => 'Open sector',
      2 => 'Compare density',
    ),
    'action' => NULL,
    'tables' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
    ),
    'permission' => 'authenticated commander',
    'states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Galaxy Map',
    'purpose' => 'Navigate the universe hierarchy.',
    'buttons' => 
    array (
      'Select galaxy' => 
      array (
        'action' => 'read_galaxy',
        'logic' => 'Load active galaxy and sector summary.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
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
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Browse galaxy density, sector overview, and travel risk.',
    'workflow' => 
    array (
      0 => 'select galaxy',
      1 => 'load sectors',
      2 => 'calculate density and risk',
      3 => 'open sector',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'valid galaxy identifier',
    ),
    'calculations' => 
    array (
      0 => 'sector danger × system volatility × distance modifier',
    ),
    'mutations' => 
    array (
    ),
  ),
  'features' => 
  array (
    0 => 'galaxy selector',
    1 => 'star density',
    2 => 'sector overview',
    3 => 'travel risk',
  ),
  'design' => 
  array (
    'template' => 'galaxy-map',
    'sections' => 
    array (
      0 => 'galaxy selector',
      1 => 'density',
      2 => 'sectors',
      3 => 'risk',
    ),
    'components' => 
    array (
      0 => 'selector',
      1 => 'density-metric',
      2 => 'sector-list',
      3 => 'risk-badge',
    ),
    'responsive' => 'Map lists become stacked rows',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'UniverseService',
    ),
    'reads' => 
    array (
      0 => 'universe_galaxies',
      1 => 'universe_sectors',
    ),
    'writes' => 
    array (
    ),
    'actions' => 
    array (
      0 => 'universe_galaxies',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/universe/galaxies.php',
    'features' => 'config/page_features/universe/galaxies.php',
    'design' => 'config/page_design_specs/universe/galaxies.php',
    'systems' => 'config/page_systems/universe/galaxies.php',
  ),
);

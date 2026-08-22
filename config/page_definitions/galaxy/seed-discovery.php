<?php
return array (
  'route' => 'seed-discovery',
  'group' => 'galaxy',
  'group_label' => 'Galaxy',
  'title' => 'Seed Discovery',
  'layout' => 'galaxies',
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
    'purpose' => 'Browse active galaxies and server-scoped sector distribution.',
    'buttons' => 
    array (
      'Select galaxy' => 
      array (
        'action' => 'universe_galaxies',
        'logic' => 'Validate active galaxy identifiers, coordinate scope, scan permission, discovered-sector visibility, protected records, ownership summaries, and authenticated commander access before loading the map.',
        'permission' => 'authenticated commander · coordinate access',
        'reads' => 
        array (
          0 => 'universe_galaxies',
          1 => 'universe_sectors',
          2 => 'universe_solar_systems',
          3 => 'universe_planets',
          4 => 'universe_discoveries',
          5 => 'target_realms',
        ),
        'writes' => 
        array (
          0 => 'game_events',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'protected',
          3 => 'error',
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
    'logic' => 'config/page_logic/galaxy/seed-discovery.php',
    'features' => 'config/page_features/galaxy/seed-discovery.php',
    'design' => 'config/page_design_specs/galaxy/seed-discovery.php',
    'systems' => 'config/page_systems/galaxy/seed-discovery.php',
    'module' => 'includes/page_modules/galaxy/seed-discovery.php',
  ),
);

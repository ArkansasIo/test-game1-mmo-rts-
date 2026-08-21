<?php
return array (
  'route' => 'sectors',
  'group' => 'universe',
  'group_label' => 'Universe',
  'title' => 'Sector Map',
  'layout' => 'sectors',
  'controls' =>
  array (
    0 => 'Select sector',
    1 => 'Open system',
  ),
  'actions' =>
  array (
    0 => 'universe_sectors',
  ),
  'tables' =>
  array (
    0 => 'universe_sectors',
    1 => 'universe_solar_systems',
    2 => 'universe_planets',
    3 => 'motherships',
    4 => 'mothership_modules',
    5 => 'player_technologies',
    6 => 'player_cooldowns',
    7 => 'game_events',
  ),
  'details' =>
  array (
    'hero' => 'Sector Map',
    'panels' =>
    array (
      0 => 'Sector class',
      1 => 'Danger level',
      2 => 'Resource modifier',
      3 => 'Anomaly rate',
    ),
    'formula' => 'sector output = base output × resource modifier; anomaly rate drives events',
    'controls' =>
    array (
      0 => 'Select sector',
      1 => 'Open system',
      2 => 'Filter by risk',
    ),
    'action' => NULL,
    'tables' =>
    array (
      0 => 'universe_sectors',
      1 => 'universe_solar_systems',
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
    'page' => 'Sector Map',
    'purpose' => 'Scan a selected sector and compare systems by risk and strategic value.',
    'buttons' =>
    array (
      'Select sector' =>
      array (
        'action' => 'universe_sectors',
        'logic' => 'Submit only the selected sector identifier; calculate sensor range × mothership science × scan technology on the server, apply sector visibility and scan cooldown, then return ordered systems with classified owner signals and travel lanes.',
        'permission' => 'authenticated commander · sector visibility · scan cooldown',
        'reads' =>
        array (
          0 => 'universe_sectors',
          1 => 'universe_solar_systems',
          2 => 'universe_planets',
          3 => 'motherships',
          4 => 'mothership_modules',
          5 => 'player_technologies',
          6 => 'player_cooldowns',
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
          3 => 'cooldown',
          4 => 'error',
        ),
      ),
      'Open system' =>
      array (
        'action' => 'read_sector',
        'logic' => 'Open a system only after the selected sector and coordinate visibility checks pass.',
        'permission' => 'authenticated commander with permitted sector access',
        'reads' =>
        array (
          0 => 'universe_sectors',
          1 => 'universe_solar_systems',
          2 => 'universe_planets',
        ),
        'writes' =>
        array (
        ),
        'states' =>
        array (
          0 => 'ready',
          1 => 'empty',
          2 => 'protected',
          3 => 'cooldown',
          4 => 'error',
        ),
      ),
    ),
  ),
  'logic' =>
  array (
    'purpose' => 'Inspect sector class, danger, resource modifiers, and anomaly rate.',
    'workflow' =>
    array (
      0 => 'select sector',
      1 => 'load systems',
      2 => 'calculate sector output',
      3 => 'filter by risk',
    ),
    'validation' =>
    array (
      0 => 'authenticated commander',
      1 => 'valid sector identifier',
    ),
    'calculations' =>
    array (
      0 => 'base output × resource modifier; anomaly rate drives events',
    ),
    'mutations' =>
    array (
    ),
  ),
  'features' =>
  array (
    0 => 'sector class',
    1 => 'danger level',
    2 => 'resource modifier',
    3 => 'anomaly rate',
  ),
  'design' =>
  array (
    'template' => 'sector-map',
    'sections' =>
    array (
      0 => 'sector selector',
      1 => 'danger',
      2 => 'resource modifier',
      3 => 'anomalies',
    ),
    'components' =>
    array (
      0 => 'sector-card',
      1 => 'danger-meter',
      2 => 'modifier-badge',
      3 => 'system-list',
    ),
    'responsive' => 'Sector cards stack on mobile',
  ),
  'systems' =>
  array (
    'services' =>
    array (
      0 => 'UniverseService',
    ),
    'reads' =>
    array (
      0 => 'universe_sectors',
      1 => 'universe_solar_systems',
    ),
    'writes' =>
    array (
    ),
    'actions' =>
    array (
      0 => 'universe_sectors',
    ),
  ),
  'contract_files' =>
  array (
    'logic' => 'config/page_logic/universe/sectors.php',
    'features' => 'config/page_features/universe/sectors.php',
    'design' => 'config/page_design_specs/universe/sectors.php',
    'systems' => 'config/page_systems/universe/sectors.php',
    'module' => 'includes/page_modules/universe/sectors.php',
  ),
);

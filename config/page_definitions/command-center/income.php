<?php
return array (
  'route' => 'income',
  'group' => 'command-center',
  'group_label' => 'Command Center',
  'title' => 'Income Breakdown',
  'layout' => 'breakdown',
  'controls' => 
  array (
    0 => 'View income formula',
  ),
  'actions' => 
  array (
  ),
  'tables' => 
  array (
    0 => 'player_resources',
    1 => 'races',
    2 => 'player_planets',
    3 => 'game_settings',
  ),
  'details' => 
  array (
    'hero' => 'Income Breakdown',
    'panels' => 
    array (
      0 => 'Base income',
      1 => 'Race and government modifiers',
      2 => 'Colony production',
      3 => 'Food, water, and energy upkeep',
    ),
    'formula' => 'settlement = (base production × race modifier × government modifier × technology) − upkeep',
    'controls' => 
    array (
      0 => 'View per-turn formula',
      1 => 'Compare colonies',
      2 => 'Open resources',
    ),
    'action' => NULL,
    'tables' => 
    array (
      0 => 'player_resources',
      1 => 'player_colonies',
      2 => 'races',
      3 => 'government_types',
      4 => 'technologies',
    ),
    'permission' => 'authenticated commander',
    'states' => 
    array (
      0 => 'ready',
      1 => 'empty',
      2 => 'protected',
      3 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Income Breakdown',
    'purpose' => 'Explain production and upkeep.',
    'buttons' => 
    array (
      'View income formula' => 
      array (
        'action' => 'read_income_breakdown',
        'logic' => 'Calculate base output, race modifier, government modifier, technology, biome, and upkeep.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_resources',
          1 => 'player_colonies',
          2 => 'races',
          3 => 'government_types',
          4 => 'technologies',
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
      'Compare colonies' => 
      array (
        'action' => 'read_colony_comparison',
        'logic' => 'Compare production and life-support efficiency across owned colonies.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'player_colonies',
          1 => 'universe_planets',
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
    'purpose' => 'Explain production settlement by colony, faction, government, technology, biome, and upkeep.',
    'workflow' => 
    array (
      0 => 'load colony production',
      1 => 'load modifiers',
      2 => 'calculate gross output',
      3 => 'calculate food water energy upkeep',
      4 => 'render net settlement',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'owned colony scope',
    ),
    'calculations' => 
    array (
      0 => 'base production × race modifier × government modifier × technology − upkeep',
      1 => 'colony comparison',
      2 => 'life-support efficiency',
    ),
    'mutations' => 
    array (
    ),
  ),
  'features' => 
  array (
    0 => 'income formula',
    1 => 'modifier breakdown',
    2 => 'colony comparison',
    3 => 'food water energy upkeep',
    4 => 'production forecast',
    5 => 'read-only state',
  ),
  'design' => 
  array (
    'template' => 'income-breakdown',
    'sections' => 
    array (
      0 => 'formula',
      1 => 'modifier table',
      2 => 'colony production',
      3 => 'upkeep',
      4 => 'feedback states',
    ),
    'components' => 
    array (
      0 => 'formula-block',
      1 => 'modifier-row',
      2 => 'forecast-metric',
      3 => 'comparison-table',
    ),
    'responsive' => 'Formula and comparison sections stack on small screens',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'EconomyService',
      1 => 'ColonyService',
    ),
    'reads' => 
    array (
      0 => 'player_resources',
      1 => 'player_colonies',
      2 => 'races',
      3 => 'government_types',
      4 => 'technologies',
      5 => 'universe_planets',
    ),
    'writes' => 
    array (
    ),
    'actions' => 
    array (
      0 => 'read_income_breakdown',
      1 => 'read_colony_comparison',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/command-center/income.php',
    'features' => 'config/page_features/command-center/income.php',
    'design' => 'config/page_design_specs/command-center/income.php',
    'systems' => 'config/page_systems/command-center/income.php',
  ),
);

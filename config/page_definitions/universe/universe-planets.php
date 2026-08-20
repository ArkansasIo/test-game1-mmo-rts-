<?php
return array (
  'route' => 'universe-planets',
  'group' => 'universe',
  'group_label' => 'Universe',
  'title' => 'Universe Planets',
  'layout' => 'universe-planets',
  'controls' => 
  array (
    0 => 'Inspect planet',
    1 => 'Colonize planet',
  ),
  'actions' => 
  array (
    0 => 'planet_details',
    1 => 'colonize_planet',
  ),
  'tables' => 
  array (
    0 => 'universe_planets',
    1 => 'player_colonies',
  ),
  'details' => 
  array (
    'hero' => 'Universe Planets',
    'panels' => 
    array (
      0 => 'Planet class and biome',
      1 => 'Habitability',
      2 => 'Resource modifiers',
      3 => 'Colony status',
    ),
    'formula' => 'colony viability = habitability × biome × race × government × life support',
    'controls' => 
    array (
      0 => 'Inspect planet',
      1 => 'Colonize planet',
      2 => 'View moons',
    ),
    'action' => 'colonize_planet',
    'tables' => 
    array (
      0 => 'universe_planets',
      1 => 'universe_moons',
      2 => 'player_colonies',
    ),
    'permission' => 'authenticated commander with colonization access',
    'states' => 
    array (
      0 => 'ready',
      1 => 'occupied',
      2 => 'protected',
      3 => 'insufficient-resource',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Universe Planets',
    'purpose' => 'Inspect worlds and colonization opportunities.',
    'buttons' => 
    array (
      'Inspect planet' => 
      array (
        'action' => 'planet_details',
        'logic' => 'Load class, type, biome, habitability, modifiers, moons, and occupancy.',
        'permission' => 'authenticated commander',
        'reads' => 
        array (
          0 => 'universe_planets',
          1 => 'universe_moons',
          2 => 'player_colonies',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'occupied',
          2 => 'empty',
          3 => 'error',
        ),
      ),
      'Colonize planet' => 
      array (
        'action' => 'colonize_planet',
        'logic' => 'Lock the planet and create a player colony only after all validation passes.',
        'permission' => 'colonization-capable commander',
        'reads' => 
        array (
          0 => 'universe_planets',
          1 => 'player_colonies',
        ),
        'writes' => 
        array (
          0 => 'player_colonies',
          1 => 'universe_planets',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'occupied',
          2 => 'insufficient-resource',
          3 => 'success',
          4 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Inspect planet class, biome, habitability, resource modifiers, and colony status.',
    'workflow' => 
    array (
      0 => 'inspect planet',
      1 => 'load biome',
      2 => 'calculate viability',
      3 => 'validate colonization',
      4 => 'create colony',
    ),
    'validation' => 
    array (
      0 => 'authenticated commander',
      1 => 'colonization access',
      2 => 'occupancy',
      3 => 'habitability',
      4 => 'resource balance',
    ),
    'calculations' => 
    array (
      0 => 'habitability × biome × race × government × life support',
    ),
    'mutations' => 
    array (
      0 => 'universe_planets',
      1 => 'player_colonies',
      2 => 'game_audit_log',
    ),
  ),
  'features' => 
  array (
    0 => 'planet class',
    1 => 'biome',
    2 => 'habitability',
    3 => 'resource modifiers',
    4 => 'colony status',
    5 => 'colonization',
  ),
  'design' => 
  array (
    'template' => 'universe-planet',
    'sections' => 
    array (
      0 => 'planet identity',
      1 => 'biome',
      2 => 'habitability',
      3 => 'resources',
      4 => 'colony status',
    ),
    'components' => 
    array (
      0 => 'planet-detail',
      1 => 'biome-card',
      2 => 'habitability-meter',
      3 => 'colonize-form',
    ),
    'responsive' => 'Planet details stack vertically',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'UniverseService',
      1 => 'ColonyService',
    ),
    'reads' => 
    array (
      0 => 'universe_planets',
      1 => 'universe_moons',
      2 => 'player_colonies',
    ),
    'writes' => 
    array (
      0 => 'universe_planets',
      1 => 'player_colonies',
      2 => 'game_audit_log',
    ),
    'actions' => 
    array (
      0 => 'planet_details',
      1 => 'colonize_planet',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/universe/universe-planets.php',
    'features' => 'config/page_features/universe/universe-planets.php',
    'design' => 'config/page_design_specs/universe/universe-planets.php',
    'systems' => 'config/page_systems/universe/universe-planets.php',
  ),
);

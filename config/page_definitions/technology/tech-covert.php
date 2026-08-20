<?php
return array (
  'route' => 'tech-covert',
  'group' => 'technology',
  'group_label' => 'Technology',
  'title' => 'Covert Technology',
  'layout' => 'technology',
  'controls' => 
  array (
    0 => 'Upgrade',
  ),
  'actions' => 
  array (
    0 => 'technology',
  ),
  'tables' => 
  array (
    0 => 'technologies',
    1 => 'player_technologies',
  ),
  'details' => 
  array (
    'hero' => 'Technology Tree',
    'panels' => 
    array (
      0 => 'Offense branch',
      1 => 'Defense branch',
      2 => 'Covert branch',
      3 => 'Anti-covert branch',
      4 => 'Prerequisites and queue',
    ),
    'formula' => 'research cost = base cost × growth ^ current level; completion applies effect',
    'controls' => 
    array (
      0 => 'Upgrade offense',
      1 => 'Upgrade defense',
      2 => 'Upgrade covert',
      3 => 'Upgrade anti-covert',
      4 => 'Queue research',
    ),
    'action' => 'technology',
    'tables' => 
    array (
      0 => 'technologies',
      1 => 'technology_prerequisites',
      2 => 'player_technologies',
      3 => 'construction_queue',
    ),
    'permission' => 'authenticated commander with research access',
    'states' => 
    array (
      0 => 'ready',
      1 => 'locked',
      2 => 'insufficient-resource',
      3 => 'queued',
      4 => 'success',
      5 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Technology',
    'purpose' => 'Research permanent strategic upgrades.',
    'buttons' => 
    array (
      'Upgrade technology' => 
      array (
        'action' => 'technology',
        'logic' => 'Validate category, prerequisites, cost, queue availability, and apply effect on completion.',
        'permission' => 'authenticated researcher',
        'reads' => 
        array (
          0 => 'technologies',
          1 => 'technology_prerequisites',
          2 => 'player_technologies',
          3 => 'player_resources',
        ),
        'writes' => 
        array (
          0 => 'player_technologies',
          1 => 'construction_queue',
          2 => 'player_resources',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'locked',
          2 => 'insufficient-resource',
          3 => 'queued',
          4 => 'success',
          5 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Research offense, defense, covert, and anti-covert technology branches.',
    'workflow' => 
    array (
      0 => 'load technology tree',
      1 => 'check prerequisites',
      2 => 'calculate cost',
      3 => 'queue research',
      4 => 'apply completed effect',
    ),
    'validation' => 
    array (
      0 => 'authenticated researcher',
      1 => 'prerequisites',
      2 => 'research queue',
      3 => 'resource balance',
      4 => 'level cap',
    ),
    'calculations' => 
    array (
      0 => 'base cost × growth ^ current level',
    ),
    'mutations' => 
    array (
      0 => 'player_technologies',
      1 => 'construction_queue',
      2 => 'player_resources',
    ),
  ),
  'features' => 
  array (
    0 => 'technology tree',
    1 => 'branch filters',
    2 => 'prerequisites',
    3 => 'level and cost',
    4 => 'research queue',
    5 => 'effect preview',
  ),
  'design' => 
  array (
    'template' => 'technology-tree',
    'sections' => 
    array (
      0 => 'branch tabs',
      1 => 'technology cards',
      2 => 'prerequisites',
      3 => 'cost',
      4 => 'queue',
    ),
    'components' => 
    array (
      0 => 'tech-card',
      1 => 'branch-tabs',
      2 => 'prerequisite-list',
      3 => 'research-queue',
    ),
    'responsive' => 'Branch tabs scroll and cards stack',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'TechnologyService',
      1 => 'QueueService',
    ),
    'reads' => 
    array (
      0 => 'technologies',
      1 => 'technology_prerequisites',
      2 => 'player_technologies',
      3 => 'player_resources',
      4 => 'construction_queue',
    ),
    'writes' => 
    array (
      0 => 'player_technologies',
      1 => 'construction_queue',
      2 => 'player_resources',
    ),
    'actions' => 
    array (
      0 => 'technology',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/technology/tech-covert.php',
    'features' => 'config/page_features/technology/tech-covert.php',
    'design' => 'config/page_design_specs/technology/tech-covert.php',
    'systems' => 'config/page_systems/technology/tech-covert.php',
  ),
);

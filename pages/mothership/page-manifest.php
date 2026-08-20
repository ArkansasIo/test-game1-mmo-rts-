<?php
return array (
  'group' => 'mothership',
  'label' => 'Mothership',
  'icon' => '△',
  'parent_route' => 'mothership',
  'pages' => 
  array (
    0 => 
    array (
      'route' => 'ship',
      'title' => 'Mothership',
      'layout' => 'ship',
      'actions' => 
      array (
        0 => 'mothership_upgrade',
      ),
      'tables' => 
      array (
        0 => 'motherships',
      ),
    ),
    1 => 
    array (
      'route' => 'modules',
      'title' => 'Mothership Modules',
      'layout' => 'ship',
      'actions' => 
      array (
        0 => 'mothership_upgrade',
      ),
      'tables' => 
      array (
        0 => 'mothership_modules',
      ),
    ),
    2 => 
    array (
      'route' => 'exploration',
      'title' => 'Exploration',
      'layout' => 'exploration',
      'actions' => 
      array (
        0 => 'explore',
      ),
      'tables' => 
      array (
        0 => 'motherships',
        1 => 'planet_explorations',
      ),
    ),
  ),
);

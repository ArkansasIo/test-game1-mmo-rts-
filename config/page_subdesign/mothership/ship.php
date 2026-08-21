<?php
return array (
  'primary_panel' => 'Mothership hull and modules',
  'visual_system' => 'ship-blueprint',
  'interaction_model' => 'capacity, prerequisite, and queue validation',
  'sections' =>
  array (
    0 => 'hull',
    1 => 'weapons',
    2 => 'hangars',
    3 => 'modules',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'ship-stat',
    1 => 'module-card',
    2 => 'capacity-meter',
    3 => 'upgrade-form',
    4 => 'state-banner',
    5 => 'action-form',
    6 => 'feedback-region',
    7 => 'audit-trail',
  ),
  'hierarchy' =>
  array (
    0 => 'header',
    1 => 'context-strip',
    2 => 'primary-content',
    3 => 'action-zone',
    4 => 'feedback-zone',
    5 => 'technical-details',
  ),
);

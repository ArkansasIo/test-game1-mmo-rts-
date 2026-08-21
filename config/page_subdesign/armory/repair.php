<?php
return array (
  'primary_panel' => 'Durability repair queue',
  'visual_system' => 'repair-queue',
  'interaction_model' => 'estimate then queue repair',
  'sections' =>
  array (
    0 => 'damaged items',
    1 => 'cost preview',
    2 => 'confirmation',
    3 => 'result',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'durability-meter',
    1 => 'repair-cost',
    2 => 'confirmation-panel',
    3 => 'result-banner',
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

<?php
return array (
  'primary_panel' => 'Weapon inventory and loadout',
  'visual_system' => 'inventory-table',
  'interaction_model' => 'purchase and durability inspection',
  'sections' =>
  array (
    0 => 'catalogue',
    1 => 'inventory',
    2 => 'durability',
    3 => 'assignment',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'weapon-card',
    1 => 'durability-meter',
    2 => 'purchase-form',
    3 => 'assignment-badge',
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

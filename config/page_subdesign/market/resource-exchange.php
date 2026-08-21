<?php
return array (
  'primary_panel' => 'Escrowed market order book',
  'visual_system' => 'order-book',
  'interaction_model' => 'list, lock, settle',
  'sections' =>
  array (
    0 => 'orders',
    1 => 'price history',
    2 => 'order form',
    3 => 'settlement',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'order-table',
    1 => 'price-badge',
    2 => 'order-form',
    3 => 'settlement-banner',
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

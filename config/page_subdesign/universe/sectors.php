<?php
return array (
  'primary_panel' => 'Sector scan and risk board',
  'visual_system' => 'sector-table',
  'interaction_model' => 'server-side scan power and cooldown',
  'sections' =>
  array (
    0 => 'sector selector',
    1 => 'danger',
    2 => 'resource modifier',
    3 => 'anomalies',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'sector-card',
    1 => 'danger-meter',
    2 => 'modifier-badge',
    3 => 'system-list',
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

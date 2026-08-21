<?php
return array (
  'primary_panel' => 'Mothership expedition control',
  'visual_system' => 'expedition-board',
  'interaction_model' => 'readiness, distance, anomaly, reward',
  'sections' =>
  array (
    0 => 'range',
    1 => 'system scan',
    2 => 'anomaly',
    3 => 'rewards',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'scan-form',
    1 => 'risk-meter',
    2 => 'discovery-card',
    3 => 'mission-status',
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

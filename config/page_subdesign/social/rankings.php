<?php
return array (
  'primary_panel' => 'Commander ranking ladder',
  'visual_system' => 'ranking-table',
  'interaction_model' => 'read snapshot and refresh',
  'sections' =>
  array (
    0 => 'filters',
    1 => 'leaderboard',
    2 => 'score breakdown',
    3 => 'snapshots',
    4 => 'status',
    5 => 'controls',
    6 => 'activity',
    7 => 'technical-details',
  ),
  'components' =>
  array (
    0 => 'ranking-table',
    1 => 'score-badge',
    2 => 'filter-tabs',
    3 => 'snapshot-selector',
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

<?php
return array (
  'route' => 'enemy-intelligence',
  'group' => 'intelligence',
  'group_label' => 'Intelligence',
  'title' => 'Enemy Intelligence',
  'layout' => 'reports',
  'controls' => 
  array (
    0 => 'Open intelligence report',
  ),
  'actions' => 
  array (
  ),
  'tables' => 
  array (
    0 => 'intelligence_reports',
  ),
  'details' => 
  array (
    'hero' => 'Reports and Intelligence',
    'panels' => 
    array (
      0 => 'Unread reports',
      1 => 'Battle outcomes',
      2 => 'Spy payloads',
      3 => 'Audit and read state',
    ),
    'formula' => 'report visibility = recipient ownership + report classification + read status',
    'controls' => 
    array (
      0 => 'Open report',
      1 => 'Mark read',
      2 => 'Filter by type',
    ),
    'action' => 'message_read',
    'tables' => 
    array (
      0 => 'battle_reports',
      1 => 'attack_logs',
      2 => 'intelligence_reports',
      3 => 'messages',
    ),
    'permission' => 'authenticated report recipient',
    'states' => 
    array (
      0 => 'loading',
      1 => 'ready',
      2 => 'empty',
      3 => 'success',
      4 => 'error',
    ),
  ),
  'interaction' => 
  array (
    'page' => 'Reports and Intelligence',
    'purpose' => 'Review server-generated outcomes.',
    'buttons' => 
    array (
      'Open report' => 
      array (
        'action' => 'read_report',
        'logic' => 'Verify recipient or owner, then return classified payload.',
        'permission' => 'report recipient',
        'reads' => 
        array (
          0 => 'battle_reports',
          1 => 'intelligence_reports',
        ),
        'writes' => 
        array (
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'protected',
          2 => 'empty',
          3 => 'error',
        ),
      ),
      'Mark read' => 
      array (
        'action' => 'message_read',
        'logic' => 'Verify ownership and update unread state.',
        'permission' => 'message recipient',
        'reads' => 
        array (
          0 => 'messages',
        ),
        'writes' => 
        array (
          0 => 'messages',
          1 => 'game_audit_log',
        ),
        'states' => 
        array (
          0 => 'ready',
          1 => 'success',
          2 => 'error',
        ),
      ),
    ),
  ),
  'logic' => 
  array (
    'purpose' => 'Show battle, spy, sabotage, and system reports only to authorized recipients.',
    'workflow' => 
    array (
      0 => 'load recipient reports',
      1 => 'classify payload',
      2 => 'filter read state',
      3 => 'open or mark report read',
      4 => 'write audit state',
    ),
    'validation' => 
    array (
      0 => 'authenticated report recipient',
      1 => 'recipient ownership',
      2 => 'classification access',
    ),
    'calculations' => 
    array (
      0 => 'recipient ownership + report classification + read status',
    ),
    'mutations' => 
    array (
      0 => 'messages',
      1 => 'game_audit_log',
    ),
  ),
  'features' => 
  array (
    0 => 'unread count',
    1 => 'battle outcomes',
    2 => 'spy payloads',
    3 => 'classified report view',
    4 => 'mark read',
    5 => 'report filters',
  ),
  'design' => 
  array (
    'template' => 'report-list',
    'sections' => 
    array (
      0 => 'unread summary',
      1 => 'report table',
      2 => 'detail view',
      3 => 'read state',
    ),
    'components' => 
    array (
      0 => 'report-row',
      1 => 'classification-badge',
      2 => 'detail-panel',
      3 => 'mark-read-button',
    ),
    'responsive' => 'Report rows become expandable cards',
  ),
  'systems' => 
  array (
    'services' => 
    array (
      0 => 'ReportService',
      1 => 'IntelligenceService',
    ),
    'reads' => 
    array (
      0 => 'battle_reports',
      1 => 'attack_logs',
      2 => 'intelligence_reports',
      3 => 'messages',
    ),
    'writes' => 
    array (
      0 => 'messages',
      1 => 'game_audit_log',
    ),
    'actions' => 
    array (
      0 => 'read_report',
      1 => 'message_read',
    ),
  ),
  'contract_files' => 
  array (
    'logic' => 'config/page_logic/intelligence/enemy-intelligence.php',
    'features' => 'config/page_features/intelligence/enemy-intelligence.php',
    'design' => 'config/page_design_specs/intelligence/enemy-intelligence.php',
    'systems' => 'config/page_systems/intelligence/enemy-intelligence.php',
    'module' => 'includes/page_modules/intelligence/enemy-intelligence.php',
  ),
);

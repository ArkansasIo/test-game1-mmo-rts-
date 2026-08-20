<?php
return array (
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
);

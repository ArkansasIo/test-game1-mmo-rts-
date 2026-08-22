<?php
return array (
  'purpose' => 'Manage the eight-resource ledger and protected Naquadah vault.',
  'workflow' => 
  array (
    0 => 'load resource ledger',
    1 => 'validate transfer amount',
    2 => 'lock resource row',
    3 => 'move balance transactionally',
    4 => 'write audit event',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF token',
    2 => 'positive amount',
    3 => 'available or vault balance',
    4 => 'RBAC permission',
  ),
  'calculations' => 
  array (
    0 => 'available Naquadah',
    1 => 'protected vault balance',
    2 => 'eight-resource totals',
    3 => 'transfer delta',
  ),
  'mutations' => 
  array (
    0 => 'player_resources',
    1 => 'game_audit_log',
  ),
);

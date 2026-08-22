<?php
declare(strict_types=1);
return array (
  'purpose' => 'Training Center operations',
  'workflow' => 
  array (
    0 => 'load scoped state',
    1 => 'validate authenticated intent',
    2 => 'lock required records',
    3 => 'resolve authoritative mechanic',
    4 => 'write audit event',
    5 => 'return feedback',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'CSRF token',
    2 => 'RBAC policy',
    3 => 'ownership scope',
    4 => 'cooldown validation',
    5 => 'transaction boundary',
  ),
  'calculations' => 
  array (
    0 => 'server-authoritative subsystem state = validated inputs + scoped records + pending operations',
  ),
  'mutations' => 
  array (
  ),
);

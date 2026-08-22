<?php
return array (
  'purpose' => 'Run reconnaissance, spy, and sabotage missions using agents and covert technology.',
  'workflow' => 
  array (
    0 => 'load agent pools',
    1 => 'select mission type',
    2 => 'calculate detection',
    3 => 'resolve intelligence or damage',
    4 => 'store report and cooldown',
  ),
  'validation' => 
  array (
    0 => 'authenticated commander',
    1 => 'available agents',
    2 => 'target visibility',
    3 => 'cooldown',
    4 => 'mission cost',
  ),
  'calculations' => 
  array (
    0 => 'defender counter-intelligence − attacker agents − covert technology',
    1 => 'detection chance',
    2 => 'bounded sabotage damage',
  ),
  'mutations' => 
  array (
    0 => 'covert_missions',
    1 => 'spy_missions',
    2 => 'sabotage_missions',
    3 => 'intelligence_reports',
    4 => 'game_events',
  ),
);

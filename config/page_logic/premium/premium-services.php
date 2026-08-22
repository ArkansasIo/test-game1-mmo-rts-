<?php
return array (
  'purpose' => 'Consume bounded convenience services such as queue priority and colony scan credits.',
  'workflow' => array (
    0 => 'load wallet and catalogue',
    1 => 'validate intent',
    2 => 'lock and mutate transactionally',
    3 => 'render result',
  ),
  'validation' => array (
    0 => 'authenticated commander',
    1 => 'CSRF token',
    2 => 'catalogue ownership and active status',
    3 => 'wallet balance',
    4 => 'cooldown and quantity bounds',
  ),
  'calculations' => array (
    0 => 'purchase cost = price × quantity',
    1 => 'daily reward = 100 Dark Matter once per 24 hours',
    2 => 'officer effect = catalogue modifier while active',
  ),
  'mutations' => array (
    0 => 'premium wallet update',
    1 => 'premium transaction audit',
    2 => 'game event emission',
  ),
);

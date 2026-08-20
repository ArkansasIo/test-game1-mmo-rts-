<?php
declare(strict_types=1);
return [
    'name' => getenv('APP_NAME') ?: 'StargateWars',
    'timezone' => getenv('APP_TIMEZONE') ?: 'UTC',
    'turn_interval_seconds' => 1800,
    'max_attack_turns' => 10000,
    'turn_generation_threshold' => 4000,
    'max_planets' => 10,
    'max_officers' => 25,
];

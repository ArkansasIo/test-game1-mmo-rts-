<?php
declare(strict_types=1);
return [
    'name' => 'StargateWars',
    'version' => '0.9.0',
    'build' => 'SW-2026.08.20.01',
    'release_channel' => 'development',
    'environment' => getenv('APP_ENV') ?: 'local',
    'server_status' => 'online',
    'database_schema' => '033',
    'copyright' => 'StargateWars Command Systems',
    'legal' => [
        'terms' => 'docs/terms.php',
        'privacy' => 'docs/privacy.php',
        'rules' => 'docs/game-rules.php',
        'status' => 'docs/status.php',
    ],
    'support_email' => 'support@stargatewars.local',
];

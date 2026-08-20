<?php
declare(strict_types=1);
$manifest = require dirname(__DIR__) . '/config/page_contracts.php';
$json = json_encode($manifest, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP);
echo 'json_is_string=' . (is_string($json) ? 'yes' : 'no') . PHP_EOL;
echo 'json_error=' . json_last_error_msg() . PHP_EOL;
echo 'route_count=' . count($manifest['routes'] ?? []) . PHP_EOL;
if (is_string($json)) echo 'json_bytes=' . strlen($json) . PHP_EOL;

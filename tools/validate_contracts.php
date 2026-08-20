<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$manifest = require $root . '/config/page_contracts.php';
$routes = $manifest['routes'] ?? [];
$required = ['logic', 'features', 'design', 'systems', 'contract_files'];
$missing = [];
foreach ($routes as $route => $contract) {
    foreach ($required as $key) {
        if (!array_key_exists($key, $contract)) {
            $missing[] = $route . ':' . $key;
        }
    }
}
echo 'route_count=' . count($routes) . PHP_EOL;
echo 'missing_fields=' . count($missing) . PHP_EOL;
if ($missing) {
    echo implode(PHP_EOL, $missing) . PHP_EOL;
    exit(1);
}
foreach ($routes as $route => $contract) {
    foreach ($contract['contract_files'] as $path) {
        if (!is_file($root . '/' . $path)) {
            echo 'missing_file=' . $path . PHP_EOL;
            exit(1);
        }
    }
}
echo 'contract_files=complete' . PHP_EOL;

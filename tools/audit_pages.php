<?php
declare(strict_types=1);
$registry = require __DIR__ . '/../config/page_registry.php';
$designs = require __DIR__ . '/../config/page_designs.php';
$registered = [];
foreach ($registry as $group) foreach (($group['pages'] ?? []) as $route => $page) $registered[$route] = $page;
$files = [];
foreach (glob(__DIR__ . '/../pages/*.php') ?: [] as $file) {
    $route = basename($file, '.php');
    if ($route !== '_entry') $files[$route] = true;
}
$missingFiles = array_values(array_diff(array_keys($registered), array_keys($files)));
$missingDesigns = [];
foreach ($registered as $route => $page) if (!isset($designs[$page['layout']])) $missingDesigns[$route] = $page['layout'];
printf("registered=%d\n", count($registered));
printf("page_files=%d\n", count($files));
printf("missing_files=%s\n", $missingFiles ? implode(',', $missingFiles) : 'none');
printf("missing_designs=%s\n", $missingDesigns ? json_encode($missingDesigns) : 'none');

<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$errors = [];
$checked = 0;
$requiredLayers = [
    'definition' => 'config/page_definitions',
    'logic' => 'config/page_logic',
    'features' => 'config/page_features',
    'design' => 'config/page_design_specs',
    'systems' => 'config/page_systems',
    'module' => 'includes/page_modules',
];

foreach ($registry as $group => $groupDefinition) {
    foreach ($groupDefinition['pages'] ?? [] as $route => $pageDefinition) {
        $checked++;
        $safeRoute = str_replace('-', '_', $route);
        $pageFile = $root . "/pages/{$group}/subpages/{$route}.php";
        if (!is_file($pageFile)) {
            $errors[] = "{$route}: missing {$pageFile}";
        }
        foreach ($requiredLayers as $layer => $base) {
            $file = $root . "/{$base}/{$group}/{$route}.php";
            if (!is_file($file)) {
                $errors[] = "{$route}: missing {$layer} file {$file}";
            }
        }
        $moduleFile = $root . "/includes/page_modules/{$group}/{$route}.php";
        if (is_file($moduleFile)) {
            $source = file_get_contents($moduleFile) ?: '';
            $safeGroup = str_replace('-', '_', $group);
            $prefix = "stargatewars_{$safeGroup}_{$safeRoute}";
            foreach (['_logic', '_features', '_design', '_systems', '_actions', '_validate_intent', '_preview'] as $suffix) {
                if (!str_contains($source, "function {$prefix}{$suffix}")) {
                    $errors[] = "{$route}: missing module function {$prefix}{$suffix}";
                }
            }
        }
    }
}

if ($errors) {
    echo json_encode(['status' => 'failed', 'routes_checked' => $checked, 'errors' => $errors], JSON_PRETTY_PRINT) . PHP_EOL;
    exit(1);
}

echo json_encode([
    'status' => 'passed',
    'routes_checked' => $checked,
    'layers_checked' => array_keys($requiredLayers),
    'module_functions_checked' => ['logic', 'features', 'design', 'systems', 'actions', 'validate_intent', 'preview'],
], JSON_PRETTY_PRINT) . PHP_EOL;

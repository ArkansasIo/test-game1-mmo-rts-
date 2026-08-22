<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$specs = require $root . '/config/detailed_page_specs.php';
$groups = [];
$routes = [];
foreach ($registry as $groupKey => $group) {
    $pages = $group['pages'] ?? [];
    $groups[$groupKey] = ['label' => $group['label'] ?? $groupKey, 'routes' => count($pages)];
    foreach ($pages as $route => $page) {
        $routes[$route] = ['group' => $groupKey, 'title' => $page['title'] ?? $route, 'layout' => $page['layout'] ?? 'generic', 'spec' => isset($specs[$route]), 'actions' => array_values($page['actions'] ?? []), 'tables' => array_values($page['tables'] ?? [])];
    }
}
$layers = [];
foreach (['pages','config/page_definitions','config/page_logic','config/page_features','config/page_design_specs','config/page_systems','includes/page_modules'] as $dir) {
    $layers[$dir] = count(glob($root . '/' . $dir . '/**/*.php', GLOB_BRACE) ?: []) + count(glob($root . '/' . $dir . '/*.php') ?: []);
}
$manifest = ['generated_at_utc' => gmdate('c'), 'groups' => $groups, 'routes' => $routes, 'layers' => $layers, 'theme_files' => array_values(array_map('basename', glob($root . '/assets/*.css') ?: [])), 'javascript_assets' => array_values(array_map('basename', glob($root . '/assets/*.js') ?: [])), 'action_endpoints' => array_values(array_map('basename', glob($root . '/actions/*.php') ?: [])), 'tests' => count(glob($root . '/tests/*') ?: []), 'documentation_files' => count(glob($root . '/docs/**/*', GLOB_BRACE) ?: [])];
file_put_contents($root . '/docs/source_package_manifest.json', json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);
$md = "# Source Package Manifest\n\nGenerated " . $manifest['generated_at_utc'] . ". The active source package contains **" . count($routes) . " routes** across **" . count($groups) . " navigation groups**.\n\n## Route layers\n\n| Layer | Files detected |\n|---|---:|\n";
foreach ($layers as $dir => $count) $md .= "| `$dir` | $count |\n";
$md .= "\n## Theme and runtime assets\n\n" . count($manifest['theme_files']) . " CSS theme files and " . count($manifest['javascript_assets']) . " JavaScript assets are present. The action directory contains " . count($manifest['action_endpoints']) . " PHP endpoints, while the test directory contains " . $manifest['tests'] . " test artifacts.\n\n## Route groups\n\n| Group | Routes |\n|---|---:|\n";
foreach ($groups as $key => $group) $md .= "| " . ($group['label'] ?? $key) . " | " . $group['routes'] . " |\n";
$md .= "\n## Implementation boundary\n\nGenerated pages provide consistent navigation, page information, controls, contracts, features, sub-features, feedback states, and theme behavior. Domain mutations remain behind authenticated server actions with CSRF, RBAC, ownership, cooldown, prerequisite, resource, and transaction validation.\n";
file_put_contents($root . '/docs/source_package_manifest.md', $md);
echo json_encode(['status' => 'generated', 'routes' => count($routes), 'groups' => count($groups), 'layers' => $layers], JSON_PRETTY_PRINT) . PHP_EOL;

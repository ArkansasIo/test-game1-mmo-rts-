<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$rows = [];
$groups = 0;
foreach ($registry as $groupKey => $group) {
    $groups++;
    foreach (($group['pages'] ?? []) as $route => $page) {
        $slug = (string)$route;
        $groupDir = strtolower((string)$groupKey);
        $title = (string)($page['title'] ?? $slug);
        $paths = [
            'root_entry' => "pages/{$slug}.php",
            'nested_entry' => "pages/{$groupDir}/subpages/{$slug}.php",
            'definition' => "config/page_definitions/{$groupDir}/{$slug}.php",
            'logic' => "config/page_logic/{$groupDir}/{$slug}.php",
            'features' => "config/page_features/{$groupDir}/{$slug}.php",
            'design' => "config/page_design_specs/{$groupDir}/{$slug}.php",
            'systems' => "config/page_systems/{$groupDir}/{$slug}.php",
            'module' => "includes/page_modules/{$groupDir}/{$slug}.php",
        ];
        $exists = [];
        foreach ($paths as $key => $relative) {
            $exists[$key] = is_file($root . '/' . $relative);
        }
        $missing = array_keys(array_filter($exists, static fn(bool $ok): bool => !$ok));
        $rows[] = [
            'group' => $groupKey,
            'route' => $slug,
            'title' => $title,
            'actions' => array_values((array)($page['actions'] ?? [])),
            'tables' => array_values((array)($page['tables'] ?? [])),
            'feedback_states' => array_values((array)($page['feedback_states'] ?? [])),
            'paths' => $paths,
            'exists' => $exists,
            'missing' => $missing,
            'complete' => $missing === [],
        ];
    }
}

$summary = [
    'generated_at' => gmdate('c'),
    'groups' => $groups,
    'routes' => count($rows),
    'complete_routes' => count(array_filter($rows, static fn(array $row): bool => $row['complete'])),
    'incomplete_routes' => count(array_filter($rows, static fn(array $row): bool => !$row['complete'])),
    'support_files' => [
        'php_pages' => count(glob($root . '/pages/**/*.php', GLOB_BRACE) ?: []),
        'services' => count(glob($root . '/includes/services/*.php') ?: []),
        'sql_migrations' => count(glob($root . '/sql/*.sql') ?: []),
        'tests' => count(glob($root . '/tests/*') ?: []),
    ],
    'rows' => $rows,
];

$out = $root . '/storage/feature_coverage.json';
file_put_contents($out, json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR) . PHP_EOL);
echo json_encode($summary, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;

<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$specs = require $root . '/config/detailed_page_specs.php';
$required = ['route','group','title','purpose','mechanic','functions','features','sub_features','controls','buttons','server_actions','database_tables','permissions','feedback_states','information_sections','layout'];
$errors = [];
$routes = 0;
foreach ($registry as $groupKey => $group) {
    foreach (($group['pages'] ?? []) as $route => $page) {
        $routes++;
        if (!isset($specs[$route])) { $errors[] = "$route missing detail spec"; continue; }
        foreach ($required as $key) {
            if (!array_key_exists($key, $specs[$route])) $errors[] = "$route missing $key";
        }
        if (($specs[$route]['group'] ?? null) !== $groupKey) $errors[] = "$route group mismatch";
        if (($specs[$route]['route'] ?? null) !== $route) $errors[] = "$route route mismatch";
        foreach (['functions','features','sub_features','controls','buttons','permissions','feedback_states','information_sections'] as $list) {
            if (!is_array($specs[$route][$list] ?? null) || count($specs[$route][$list]) === 0) $errors[] = "$route empty $list";
        }
    }
}
$result = ['status' => $errors ? 'failed' : 'passed', 'routes' => $routes, 'specs' => count($specs), 'errors' => $errors];
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($errors ? 1 : 0);

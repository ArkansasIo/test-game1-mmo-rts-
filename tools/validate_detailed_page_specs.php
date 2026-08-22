<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$specPayload = require $root . '/config/detailed_page_specs.php';
$specs = $specPayload['by_key'] ?? $specPayload['routes'] ?? $specPayload;
$specList = $specPayload['routes'] ?? array_values($specs);
$required = ['route','group','title','purpose','mechanic','functions','features','sub_features','controls','buttons','server_actions','database_tables','permissions','feedback_states','information_sections','layout'];
$errors = [];
$routes = 0;
foreach ($registry as $groupKey => $group) {
    foreach (($group['pages'] ?? []) as $route => $page) {
        $routes++;
        $matches = array_values(array_filter($specList, static fn(array $spec): bool => ($spec['route'] ?? null) === $route && ($spec['group'] ?? null) === $groupKey));
        if (!$matches) { $errors[] = "$groupKey/$route missing detail spec"; continue; }
        $spec = $matches[0];
        foreach ($required as $key) {
            if (!array_key_exists($key, $spec)) $errors[] = "$groupKey/$route missing $key";
        }
        foreach (['functions','features','sub_features','controls','buttons','permissions','feedback_states','information_sections'] as $list) {
            if (!is_array($spec[$list] ?? null) || count($spec[$list]) === 0) $errors[] = "$groupKey/$route empty $list";
        }
    }
}
$result = ['status' => $errors ? 'failed' : 'passed', 'routes' => $routes, 'specs' => count($specList), 'errors' => $errors];
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($errors ? 1 : 0);

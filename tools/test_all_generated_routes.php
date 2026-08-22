<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$errors = [];
$routes = 0;
$groups = 0;
foreach ($registry as $groupKey => $group) {
    $groups++;
    foreach (($group['pages'] ?? []) as $route => $definition) {
        $routes++;
        $title = (string)($definition['title'] ?? $route);
        $paths = [
            "definition" => "$root/config/page_definitions/$groupKey/$route.php",
            "logic" => "$root/config/page_logic/$groupKey/$route.php",
            "features" => "$root/config/page_features/$groupKey/$route.php",
            "design" => "$root/config/page_design_specs/$groupKey/$route.php",
            "systems" => "$root/config/page_systems/$groupKey/$route.php",
            "module" => "$root/includes/page_modules/$groupKey/$route.php",
            "submenu" => "$root/pages/$groupKey/subpages/$route.php",
            "legacy" => "$root/pages/$route.php",
        ];
        foreach ($paths as $kind => $path) {
            if (!is_file($path)) $errors[] = "$groupKey/$route missing $kind file";
        }
        $definitionData = is_file($paths['definition']) ? require $paths['definition'] : [];
        foreach (['route','group','title','layout','controls','actions','tables','contract_files'] as $key) {
            if (!array_key_exists($key, $definitionData)) $errors[] = "$groupKey/$route definition missing $key";
        }
        foreach ((array)($definitionData['contract_files'] ?? []) as $kind => $relative) {
            if (!is_file($root . '/' . ltrim((string)$relative, '/'))) $errors[] = "$groupKey/$route contract dependency missing $kind";
        }
        if (($definitionData['route'] ?? null) !== $route) $errors[] = "$groupKey/$route route metadata mismatch";
        if (($definitionData['group'] ?? null) !== $groupKey) $errors[] = "$groupKey/$route group metadata mismatch";
        if (($definitionData['title'] ?? null) !== $title) $errors[] = "$groupKey/$route title metadata mismatch";
    }
}
$requiredFiles = [
    "$root/actions/page_intent.php",
    "$root/assets/generated-page-interactions.js",
    "$root/assets/menu-groups.css",
    "$root/config/page_registry.php",
    "$root/game.php",
];
foreach ($requiredFiles as $file) if (!is_file($file)) $errors[] = 'required dependency missing: ' . $file;
$game = file_get_contents($root . '/game.php') ?: '';
foreach (['registryHasPage','generated-page-interactions.js','page-intent'] as $needle) {
    if (!str_contains($game, $needle)) $errors[] = "game.php missing integration marker: $needle";
}
$js = file_get_contents($root . '/assets/generated-page-interactions.js') ?: '';
foreach (['fetch(', 'page_intent.php', 'generated-page:intent-complete'] as $needle) {
    if (!str_contains($js, $needle)) $errors[] = "AJAX asset missing integration marker: $needle";
}
$phpFiles = [];
foreach (['config','pages','includes','actions'] as $dir) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root . '/' . $dir, FilesystemIterator::SKIP_DOTS));
    foreach ($iterator as $file) if ($file->isFile() && $file->getExtension() === 'php') $phpFiles[] = $file->getPathname();
}
$syntaxErrors = [];
foreach ($phpFiles as $file) {
    $output = []; $code = 0;
    exec('php -l ' . escapeshellarg($file) . ' 2>&1', $output, $code);
    if ($code !== 0) $syntaxErrors[$file] = implode("\n", $output);
}
if ($syntaxErrors) foreach ($syntaxErrors as $file => $message) $errors[] = "PHP syntax error: $file :: $message";
$result = [
    'status' => $errors ? 'failed' : 'passed',
    'groups' => $groups,
    'routes' => $routes,
    'route_layers_checked' => $routes * 8,
    'php_files_checked' => count($phpFiles),
    'syntax_errors' => count($syntaxErrors),
    'missing_dependencies' => count(array_filter($errors, fn($e) => str_contains($e, 'missing'))),
    'errors' => $errors,
];
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
exit($errors ? 1 : 0);

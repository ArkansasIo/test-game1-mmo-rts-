<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$errors = [];
$counts = ['groups'=>0,'routes'=>0,'linked_routes'=>0,'broken_routes'=>0];

foreach ($registry as $groupKey => $group) {
    $counts['groups']++;
    $groupDir = $root . '/pages/' . $groupKey;
    if (!is_file($groupDir . '/index.php')) $errors[] = "$groupKey: missing parent pages/$groupKey/index.php";
    if (!is_file($groupDir . '/page-manifest.php')) $errors[] = "$groupKey: missing page manifest";
    foreach (($group['pages'] ?? []) as $route => $page) {
        $counts['routes']++;
        $files = [
            "route" => "$groupDir/subpages/$route.php",
            "definition" => "$root/config/page_definitions/$groupKey/$route.php",
            "logic" => "$root/config/page_logic/$groupKey/$route.php",
            "features" => "$root/config/page_features/$groupKey/$route.php",
            "design" => "$root/config/page_design_specs/$groupKey/$route.php",
            "systems" => "$root/config/page_systems/$groupKey/$route.php",
            "module" => "$root/includes/page_modules/$groupKey/$route.php",
        ];
        $routeOk = true;
        foreach ($files as $kind => $file) {
            if (!is_file($file)) { $errors[] = "$route: missing $kind file ($file)"; $routeOk = false; }
        }
        if ($routeOk) {
            $routeSource = file_get_contents($files['route']);
            if (!str_contains($routeSource, "\$route = '$route'")) $errors[] = "$route: route wrapper does not assign the registered route";
            if (!str_contains($routeSource, "require __DIR__ . '/../../_nested_entry.php'")) $errors[] = "$route: route wrapper does not load the shared nested entrypoint";
            $counts['linked_routes']++;
        } else $counts['broken_routes']++;
    }
}

$game = file_get_contents($root . '/game.php');
if (!str_contains($game, '$registry = require')) $errors[] = 'game.php does not load page_registry.php';
if (!str_contains($game, '$pageContracts = require')) $errors[] = 'game.php does not load page_contracts.php';
if (str_contains($game, 'Open PHP page')) $errors[] = 'game.php still contains the removed Open PHP page control';
$legacy = file_get_contents($root . '/modular-pages-preview.php');
if (!str_contains($legacy, 'game.php')) $errors[] = 'modular-pages-preview.php does not redirect to game.php';

$result = ['status' => $errors ? 'failed' : 'passed', 'counts' => $counts, 'errors' => $errors];
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL;
if ($errors) exit(1);

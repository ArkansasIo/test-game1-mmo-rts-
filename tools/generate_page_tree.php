<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$details = require $root . '/config/dashboard_page_details.php';
$contracts = require $root . '/config/player_interaction_contracts.php';
$catalog = require $root . '/config/page_contract_catalog.php';
$pagesRoot = $root . '/pages';
$definitionsRoot = $root . '/config/page_definitions';
$logicRoot = $root . '/config/page_logic';
$featuresRoot = $root . '/config/page_features';
$designRoot = $root . '/config/page_design_specs';
$systemsRoot = $root . '/config/page_systems';

$nestedEntry = <<<'PHP'
<?php
declare(strict_types=1);
$route = $route ?? 'dashboard';
$group = $group ?? 'command-center';
$label = $label ?? ucwords(str_replace('-', ' ', $route));
$pageDefinition = $pageDefinition ?? null;
$target = '/index.php?page=' . rawurlencode($route);
header('Location: ' . $target, true, 302);
exit;
PHP;
file_put_contents($pagesRoot . '/_nested_entry.php', $nestedEntry . "\n");

$all = [];
$contractsAll = [];
foreach ($registry as $groupKey => $group) {
    $dir = $pagesRoot . '/' . $groupKey;
    $subdir = $dir . '/subpages';
    $definitionDir = $definitionsRoot . '/' . $groupKey;
    $logicDir = $logicRoot . '/' . $groupKey;
    $featuresDir = $featuresRoot . '/' . $groupKey;
    $designDir = $designRoot . '/' . $groupKey;
    $systemsDir = $systemsRoot . '/' . $groupKey;
    foreach ([$dir, $subdir, $definitionDir, $logicDir, $featuresDir, $designDir, $systemsDir] as $path) {
        if (!is_dir($path)) mkdir($path, 0775, true);
    }

    $parentRoute = $groupKey === 'command-center' ? 'dashboard' : $groupKey;
    $parentDefinition = $definitionsRoot . '/' . $groupKey . '/' . $parentRoute . '.php';
    $parent = "<?php\ndeclare(strict_types=1);\n\$route = " . var_export($parentRoute, true) . "; \$group = " . var_export($groupKey, true) . "; \$label = " . var_export($group['label'] ?? $groupKey, true) . "; \$pageDefinition = is_file(" . var_export($parentDefinition, true) . ") ? require " . var_export($parentDefinition, true) . " : null; require __DIR__ . '/../_nested_entry.php';\n";
    file_put_contents($dir . '/index.php', $parent);

    $manifestPages = [];
    foreach (($group['pages'] ?? []) as $route => $definition) {
        $title = $definition['title'] ?? ucwords(str_replace('-', ' ', $route));
        $layout = $definition['layout'] ?? 'generic';
        $profile = $catalog['profiles'][$layout] ?? ['logic'=>['purpose'=>$title,'workflow'=>['load state','validate intent','render result'],'validation'=>['authenticated commander'],'calculations'=>[],'mutations'=>[]],'features'=>[$title],'design'=>['template'=>'generic-page','sections'=>['overview','controls','activity'],'components'=>['panel','status-badge'],'responsive'=>'stacked mobile layout'],'systems'=>['services'=>['PageService'],'reads'=>$definition['tables'] ?? [],'writes'=>[],'actions'=>$definition['actions'] ?? []]];
        foreach ([
            $logicDir . '/' . $route . '.php' => $profile['logic'],
            $featuresDir . '/' . $route . '.php' => $profile['features'],
            $designDir . '/' . $route . '.php' => $profile['design'],
            $systemsDir . '/' . $route . '.php' => $profile['systems'],
        ] as $contractPath => $contractData) {
            file_put_contents($contractPath, "<?php\nreturn " . var_export($contractData, true) . ";\n");
        }
        $pageDefinitionData = [
            'route' => $route,
            'group' => $groupKey,
            'group_label' => $group['label'] ?? $groupKey,
            'title' => $title,
            'layout' => $layout,
            'controls' => $definition['controls'] ?? [],
            'actions' => $definition['actions'] ?? [],
            'tables' => $definition['tables'] ?? [],
            'details' => $details[$layout] ?? [],
            'interaction' => $contracts[$layout] ?? [],
            'logic' => $profile['logic'],
            'features' => $profile['features'],
            'design' => $profile['design'],
            'systems' => $profile['systems'],
            'contract_files' => [
                'logic' => 'config/page_logic/' . $groupKey . '/' . $route . '.php',
                'features' => 'config/page_features/' . $groupKey . '/' . $route . '.php',
                'design' => 'config/page_design_specs/' . $groupKey . '/' . $route . '.php',
                'systems' => 'config/page_systems/' . $groupKey . '/' . $route . '.php',
            ],
        ];
        $definitionFile = $definitionDir . '/' . $route . '.php';
        file_put_contents($definitionFile, "<?php\nreturn " . var_export($pageDefinitionData, true) . ";\n");

        $manifestPages[] = ['route'=>$route, 'title'=>$title, 'layout'=>$layout, 'definition'=>'config/page_definitions/' . $groupKey . '/' . $route . '.php', 'actions'=>$definition['actions'] ?? [], 'tables'=>$definition['tables'] ?? []];
        $definitionPath = $root . '/config/page_definitions/' . $groupKey . '/' . $route . '.php';
        $content = "<?php\ndeclare(strict_types=1);\n\$route = " . var_export($route, true) . "; \$group = " . var_export($groupKey, true) . "; \$label = " . var_export($title, true) . "; \$pageDefinition = require " . var_export($definitionPath, true) . "; require __DIR__ . '/../../_nested_entry.php';\n";
        file_put_contents($subdir . '/' . $route . '.php', $content);
        $legacy = "<?php\ndeclare(strict_types=1);\n\$route = " . var_export($route, true) . "; \$group = " . var_export($groupKey, true) . "; \$label = " . var_export($title, true) . "; \$pageDefinition = require " . var_export($definitionPath, true) . "; require __DIR__ . '/_nested_entry.php';\n";
        file_put_contents($pagesRoot . '/' . $route . '.php', $legacy);
        $all[$route] = ['group'=>$groupKey,'title'=>$title,'layout'=>$layout,'definition'=>'config/page_definitions/' . $groupKey . '/' . $route . '.php'];
        $contractsAll[$route] = $pageDefinitionData;
    }
    file_put_contents($dir . '/page-manifest.php', "<?php\nreturn " . var_export(['group'=>$groupKey,'label'=>$group['label'] ?? $groupKey,'icon'=>$group['icon'] ?? '', 'parent_route'=>$parentRoute,'pages'=>$manifestPages], true) . ";\n");
}

file_put_contents($pagesRoot . '/PAGE_TREE_MANIFEST.php', "<?php\nreturn " . var_export(['generated_at'=>date('c'),'group_count'=>count($registry),'page_count'=>count($all),'routes'=>$all], true) . ";\n");
file_put_contents($root . '/config/page_contracts.php', "<?php\nreturn " . var_export(['generated_at'=>date('c'),'page_count'=>count($contractsAll),'routes'=>$contractsAll], true) . ";\n");
echo 'Generated ' . count($registry) . ' grouped folders, ' . count($all) . ' page definitions, and ' . count($all) . ' submenu routes.' . PHP_EOL;

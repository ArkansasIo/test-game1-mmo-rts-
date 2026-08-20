<?php
declare(strict_types=1);
$root = dirname(__DIR__);
$registry = require $root . '/config/page_registry.php';
$pagesRoot = $root . '/pages';
$groups = [];
$nestedEntry = <<<'PHP'
<?php
declare(strict_types=1);
$route = $route ?? 'dashboard';
$group = $group ?? 'command-center';
$label = $label ?? ucwords(str_replace('-', ' ', $route));
$target = '/index.php?page=' . rawurlencode($route);
header('Location: ' . $target, true, 302);
exit;
PHP;
file_put_contents($pagesRoot . '/_nested_entry.php', $nestedEntry . "\n");
foreach ($registry as $groupKey => $group) {
    $dir = $pagesRoot . '/' . $groupKey;
    $subdir = $dir . '/subpages';
    if (!is_dir($subdir)) mkdir($subdir, 0775, true);
    $parentRoute = $groupKey === 'command-center' ? 'dashboard' : $groupKey;
    $parent = "<?php\ndeclare(strict_types=1);\n\$route = " . var_export($parentRoute, true) . "; \$group = " . var_export($groupKey, true) . "; \$label = " . var_export($group['label'] ?? $groupKey, true) . "; require __DIR__ . '/../_nested_entry.php';\n";
    file_put_contents($dir . '/index.php', $parent);
    $manifestPages = [];
    foreach (($group['pages'] ?? []) as $route => $definition) {
        $title = $definition['title'] ?? ucwords(str_replace('-', ' ', $route));
        $manifestPages[] = ['route'=>$route, 'title'=>$title, 'layout'=>$definition['layout'] ?? 'generic', 'actions'=>$definition['actions'] ?? [], 'tables'=>$definition['tables'] ?? []];
        $content = "<?php\ndeclare(strict_types=1);\n\$route = " . var_export($route, true) . "; \$group = " . var_export($groupKey, true) . "; \$label = " . var_export($title, true) . "; require __DIR__ . '/../../_nested_entry.php';\n";
        file_put_contents($subdir . '/' . $route . '.php', $content);
        $legacy = "<?php\ndeclare(strict_types=1);\n\$route = " . var_export($route, true) . "; \$group = " . var_export($groupKey, true) . "; \$label = " . var_export($title, true) . "; require __DIR__ . '/_nested_entry.php';\n";
        file_put_contents($pagesRoot . '/' . $route . '.php', $legacy);
    }
    file_put_contents($dir . '/page-manifest.php', "<?php\nreturn " . var_export(['group'=>$groupKey,'label'=>$group['label'] ?? $groupKey,'icon'=>$group['icon'] ?? '', 'parent_route'=>$parentRoute,'pages'=>$manifestPages], true) . ";\n");
}
$all = [];
foreach ($registry as $groupKey => $group) foreach (($group['pages'] ?? []) as $route => $definition) $all[$route] = ['group'=>$groupKey,'title'=>$definition['title'] ?? $route,'layout'=>$definition['layout'] ?? 'generic'];
file_put_contents($pagesRoot . '/PAGE_TREE_MANIFEST.php', "<?php\nreturn " . var_export(['generated_at'=>date('c'),'group_count'=>count($registry),'page_count'=>count($all),'routes'=>$all], true) . ";\n");
echo 'Generated ' . count($registry) . ' grouped folders and ' . count($all) . ' submenu routes.' . PHP_EOL;

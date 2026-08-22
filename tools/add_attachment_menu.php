<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$registryPath = $root . '/config/page_registry.php';
$attachment = '/home/ubuntu/upload/pasted_content.txt';
$registry = require $registryPath;
$lines = file($attachment, FILE_IGNORE_NEW_LINES);
if ($lines === false) {
    throw new RuntimeException('Unable to read attached menu file.');
}

$slugify = static function (string $value): string {
    $value = strtolower(trim($value));
    $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';
    return trim($value, '-') ?: 'menu';
};
$layoutFor = static function (string $group): string {
    return match ($group) {
        'overview' => 'dashboard',
        'empire', 'resources' => 'economy',
        'construction' => 'facilities',
        'research' => 'technology',
        'fleet' => 'fleet',
        'military', 'intelligence' => 'combat',
        'galaxy' => 'galaxies',
        'economy' => 'market',
        'crafting' => 'crafting',
        'alliance', 'social' => 'social',
        'activities' => 'activities',
        'prestige', 'account' => 'progression',
        'premium' => 'premium',
        'rankings' => 'rankings',
        default => 'generic',
    };
};
$groups = [];
$currentGroup = null;
foreach ($lines as $line) {
    if (preg_match('/^├──\s+(.+)$/u', $line, $match) || preg_match('/^└──\s+(.+)$/u', $line, $match)) {
        $label = trim($match[1]);
        $currentGroup = $slugify($label);
        $groups[$currentGroup] = ['label' => ucwords(strtolower($label)), 'icon' => '◆', 'pages' => []];
        continue;
    }
    if ($currentGroup !== null && (preg_match('/^\s*│\s+├──\s+(.+)$/u', $line, $match) || preg_match('/^\s*│\s+└──\s+(.+)$/u', $line, $match))) {
        $title = trim($match[1]);
        $baseRoute = $slugify($title);
        $route = $baseRoute;
        $allRoutes = [];
        foreach ($registry as $existingGroup) {
            $allRoutes = array_merge($allRoutes, array_keys($existingGroup['pages'] ?? []));
        }
        foreach ($groups as $group) {
            $allRoutes = array_merge($allRoutes, array_keys($group['pages'] ?? []));
        }
        if (in_array($route, $allRoutes, true)) {
            $route = $currentGroup . '-' . $baseRoute;
        }
        $groups[$currentGroup]['pages'][$route] = [
            'title' => $title,
            'layout' => $layoutFor($currentGroup),
            'controls' => ['Open overview', 'Review status'],
            'actions' => [],
            'tables' => ['game_events'],
        ];
    }
}

$addedGroups = 0;
$addedPages = 0;
foreach ($groups as $groupKey => $group) {
    if (!isset($registry[$groupKey])) {
        $registry[$groupKey] = $group;
        $addedGroups++;
        $addedPages += count($group['pages']);
        continue;
    }
    foreach ($group['pages'] as $route => $definition) {
        if (!isset($registry[$groupKey]['pages'][$route])) {
            $registry[$groupKey]['pages'][$route] = $definition;
            $addedPages++;
        }
    }
}
file_put_contents($registryPath, "<?php\ndeclare(strict_types=1);\nreturn " . var_export($registry, true) . ";\n");
echo "Added {$addedGroups} groups and {$addedPages} attached menu pages.\n";

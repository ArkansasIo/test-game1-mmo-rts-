<?php
require_once __DIR__ . '/../config/auth.php';
require_auth();
$route = $_GET['page'] ?? 'dashboard';
require_route_access($route);
$menu = menu_tree();
$activeParent = $route;
foreach ($menu as $item) {
    foreach ($item['children'] as $child) if ($child['route'] === $route) $activeParent = $item['route'];
}
$pdo = db();
$sessionUser = current_user();
$player = $sessionUser ?? ['display_name'=>'Commander Tanang','username'=>'demo','race'=>'Tau\'ri'];
$resources = ['naquadah'=>125000,'dark_matter'=>2500,'metal'=>820000,'crystal'=>460000,'energy'=>640,'banked_naquadah'=>500000,'attack_turns'=>48,'market_turns'=>3,'untrained_units'=>1600,'unit_production'=>12,'miners'=>120,'lifers'=>12,'attack_units'=>850,'defense_units'=>1200,'spies'=>160,'anti_spies'=>140,'food'=>10000,'water'=>10000,'population'=>100,'population_capacity'=>1000];
if ($pdo && $sessionUser) {
    try {
        $stmt = $pdo->prepare("SELECT p.*,r.name AS race,g.name AS government FROM players p JOIN races r ON r.id=p.race_id LEFT JOIN government_types g ON g.id=p.government_id WHERE p.id=? LIMIT 1");
        $stmt->execute([(int)$sessionUser['id']]);
        if ($row = $stmt->fetch()) $player = $row;
        $stmt = $pdo->prepare('SELECT * FROM player_resources WHERE player_id=? LIMIT 1');
        $stmt->execute([(int)$sessionUser['id']]);
        if ($row = $stmt->fetch()) $resources = array_merge($resources, $row);
    } catch (Throwable $e) {}
}
function render_menu(array $items, string $activeParent, string $route): void {
    foreach ($items as $item) {
        $isActive = $activeParent === $item['route'] || $route === $item['route'];
        echo '<li class="nav-group ' . ($isActive ? 'open' : '') . '">';
        echo '<a class="nav-link ' . ($route === $item['route'] ? 'active' : '') . '" href="?page=' . e($item['route']) . '"><span class="nav-icon">' . e($item['icon'] ?? '•') . '</span><span>' . e($item['label']) . '</span>' . (count($item['children']) ? '<span class="chevron">›</span>' : '') . '</a>';
        if (count($item['children'])) {
            echo '<ul class="submenu">';
            foreach ($item['children'] as $child) echo '<li><a class="sub-link ' . ($route === $child['route'] ? 'active' : '') . '" href="?page=' . e($child['route']) . '">' . e($child['label']) . '</a></li>';
            echo '</ul>';
        }
        echo '</li>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e(page_title($route)) ?> · StargateWars</title>
<link rel="stylesheet" href="assets/app.css">
</head>
<body>
<div class="app-shell">
<aside class="sidebar">
  <div class="brand"><div class="brand-mark">S</div><div><strong>STARGATEWARS</strong><small>COMMAND INTERFACE</small></div></div>
  <div class="profile"><div class="avatar">CT</div><div><strong><?= e($player['display_name']) ?></strong><span><?= e($player['race']) ?> · <?= e($player['government'] ?? 'Republic') ?> · <?= e($player['rank_name'] ?? 'Initiate') ?></span></div></div>
  <nav class="main-nav"><div class="nav-caption">Navigation</div><ul><?php render_menu($menu, $activeParent, $route); ?></ul></nav>
  <div class="sidebar-foot"><span class="status-dot"></span> Systems operational<br><small>Turn cycle: 30 minutes</small></div>
</aside>
<main class="main-content">
  <header class="topbar"><div><div class="eyebrow">STARGATEWARS / <?= e(strtoupper($activeParent)) ?></div><h1><?= e(page_title($route)) ?></h1></div><div class="resource-header" aria-label="Strategic resources"><div class="resource-item resource-metal"><span class="resource-icon">M</span><span><small>Metal</small><strong><?= number((int)$resources['metal']) ?></strong></span></div><div class="resource-item resource-crystal"><span class="resource-icon">C</span><span><small>Crystal</small><strong><?= number((int)$resources['crystal']) ?></strong></span></div><div class="resource-item resource-naquadah"><span class="resource-icon">N</span><span><small>Naquadah</small><strong><?= number((int)$resources['naquadah']) ?></strong></span></div><div class="resource-item resource-energy"><span class="resource-icon">E</span><span><small>Energy</small><strong><?= number((int)$resources['energy']) ?></strong></span></div><div class="resource-item resource-dark-matter"><span class="resource-icon">DM</span><span><small>Dark Matter</small><strong><?= number((int)$resources['dark_matter']) ?></strong></span></div><div class="resource-item resource-food"><span class="resource-icon">F</span><span><small>Food</small><strong><?= number((int)$resources['food']) ?></strong></span></div><div class="resource-item resource-water"><span class="resource-icon">W</span><span><small>Water</small><strong><?= number((int)$resources['water']) ?></strong></span></div><div class="resource-item resource-population"><span class="resource-icon">POP</span><span><small>Population</small><strong><?= number((int)$resources['population']) ?> / <?= number((int)$resources['population_capacity']) ?></strong></span></div><span class="turn-pill">TURN <b><?= number($resources['attack_turns']) ?></b></span><a href="?page=account" class="profile-chip"><?= e($player['username']) ?> <span>⌄</span></a><a href="logout.php" class="logout-link">Log out</a></div></header>
  <section class="page-content">

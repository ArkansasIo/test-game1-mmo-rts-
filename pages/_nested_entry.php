<?php
declare(strict_types=1);
$route = $route ?? 'dashboard';
$group = $group ?? 'command-center';
$label = $label ?? ucwords(str_replace('-', ' ', $route));
$pageDefinition = $pageDefinition ?? null;
$target = '/game.php?page=' . rawurlencode($route);
header('Location: ' . $target, true, 302);
exit;

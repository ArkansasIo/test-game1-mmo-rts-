<?php
declare(strict_types=1);
$route = $route ?? 'dashboard';
$group = $group ?? 'command-center';
$label = $label ?? ucwords(str_replace('-', ' ', $route));
$target = '/index.php?page=' . rawurlencode($route);
header('Location: ' . $target, true, 302);
exit;

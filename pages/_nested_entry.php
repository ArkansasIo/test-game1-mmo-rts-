<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/auth.php';
$route = isset($route) && is_string($route) && preg_match('/^[a-z0-9-]+$/', $route) ? $route : 'dashboard';
require_auth();
header('Location: /game.php?page=' . rawurlencode($route), true, 302);
exit;

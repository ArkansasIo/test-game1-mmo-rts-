<?php
declare(strict_types=1);
$route = basename($_SERVER['SCRIPT_FILENAME'] ?? 'dashboard.php', '.php');
if ($route === '_entry') { $route = 'dashboard'; }
header('Location: ../index.php?page=' . rawurlencode(str_replace('_', '-', $route)), true, 302);
exit;

<?php
declare(strict_types=1);
$configPath = __DIR__ . '/../config/auth_bypass.php';
$mode = strtolower((string)($argv[1] ?? 'status'));
$config = require $configPath;
if ($mode === 'on' || $mode === 'off') {
    $enabled = $mode === 'on';
    $config['enabled'] = $enabled;
    $userId = (int)($argv[2] ?? ($config['user_id'] ?? 1));
    if ($userId < 1) throw new InvalidArgumentException('Bypass user ID must be positive.');
    $config['user_id'] = $userId;
    $php = "<?php\ndeclare(strict_types=1);\nreturn " . var_export($config, true) . ";\n";
    file_put_contents($configPath, $php, LOCK_EX);
    echo 'auth_bypass=' . ($enabled ? 'ON' : 'OFF') . ' user_id=' . $userId . PHP_EOL;
    exit(0);
}
if ($mode !== 'status') throw new InvalidArgumentException('Usage: php tools/toggle_auth_bypass.php [on|off|status] [user_id]');
echo 'auth_bypass=' . (($config['enabled'] ?? false) ? 'ON' : 'OFF') . ' configured_user_id=' . (int)($config['user_id'] ?? 1) . PHP_EOL;

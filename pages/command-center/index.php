<?php
declare(strict_types=1);
$route = 'dashboard'; $group = 'command-center'; $label = 'Command Center'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/command-center/dashboard.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/command-center/dashboard.php' : null; require __DIR__ . '/../_nested_entry.php';

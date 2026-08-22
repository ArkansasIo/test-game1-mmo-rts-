<?php
declare(strict_types=1);
$route = 'galaxy'; $group = 'galaxy'; $label = 'Galaxy'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/galaxy/galaxy.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/galaxy/galaxy.php' : null; require __DIR__ . '/../_nested_entry.php';

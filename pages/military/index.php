<?php
declare(strict_types=1);
$route = 'military'; $group = 'military'; $label = 'Military'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/military/military.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/military/military.php' : null; require __DIR__ . '/../_nested_entry.php';

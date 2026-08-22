<?php
declare(strict_types=1);
$route = 'premium'; $group = 'premium'; $label = 'Premium'; $pageDefinition = is_file('/home/ubuntu/stargatewars/config/page_definitions/premium/premium.php') ? require '/home/ubuntu/stargatewars/config/page_definitions/premium/premium.php' : null; require __DIR__ . '/../_nested_entry.php';

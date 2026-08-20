<?php
declare(strict_types=1);
$modules = require __DIR__ . '/../config/module_manifest.php';
printf("module_count=%d\n", count($modules));
printf("module_names=%s\n", implode(',', array_keys($modules)));

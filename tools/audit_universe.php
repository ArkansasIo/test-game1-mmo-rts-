<?php
declare(strict_types=1);
$registry = require __DIR__ . '/../config/page_registry.php';
$designs = require __DIR__ . '/../config/page_designs.php';
$universe = $registry['universe']['pages'] ?? [];
printf("universe_pages=%d\n", count($universe));
printf("universe_designs=%d\n", count(array_intersect_key($designs, array_fill_keys(array_map(static fn(array $p): string => (string)$p['layout'], $universe), true))));
printf("universe_layouts=%s\n", implode(',', array_map(static fn(array $p): string => (string)$p['layout'], $universe)));

<?php
declare(strict_types=1);
$registry = require __DIR__ . '/../config/page_registry.php';
$contracts = require __DIR__ . '/../config/page_feature_contracts.php';
$designs = require __DIR__ . '/../config/page_designs.php';
$out = "# StargateWars Page and Sub-Page Coverage\n\n";
$out .= "This report is generated from the PHP route registry, page designs, and feature contracts.\n\n";
foreach ($registry as $groupKey => $group) {
    $out .= "## " . ($group['label'] ?? $groupKey) . "\n\n";
    foreach (($group['pages'] ?? []) as $route => $page) {
        $layout = (string)($page['layout'] ?? 'module-workspace');
        $contract = $contracts[$layout] ?? [];
        $design = $designs[$layout] ?? [];
        $out .= "### `{$route}` — " . ($page['title'] ?? $route) . "\n\n";
        $out .= "**Layout:** `{$layout}`  \n";
        $out .= "**Feature:** " . ($contract['feature'] ?? 'Module workspace') . "  \n";
        $out .= "**Permission:** " . ($contract['permission'] ?? 'authenticated commander') . "  \n";
        $out .= "**Controls:** " . implode(', ', $page['controls'] ?? []) . "  \n";
        $out .= "**Actions:** " . implode(', ', $page['actions'] ?? []) . "  \n";
        $out .= "**Reads:** " . implode(', ', $contract['reads'] ?? $page['tables'] ?? []) . "  \n";
        $out .= "**Writes:** " . implode(', ', $contract['writes'] ?? []) . "  \n";
        $out .= "**Sections:** " . implode(', ', $design['sections'] ?? []) . "  \n";
        $out .= "**States:** " . implode(', ', $contract['errors'] ?? $design['states'] ?? []) . "  \n\n";
    }
}
file_put_contents(__DIR__ . '/../docs/PAGE_AND_SUBPAGE_COVERAGE.md', $out);
echo "coverage_report=docs/PAGE_AND_SUBPAGE_COVERAGE.md\n";

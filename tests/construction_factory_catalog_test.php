<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/construction_factory_catalog.php';

$catalog = construction_factory_catalog();
$pdo = db();
$checks = [];
$checks['catalog_has_90_entries'] = count($catalog) === 90;
$classes = [];
foreach ($catalog as $key => $entry) {
    $classes[$entry['building_class']] = ($classes[$entry['building_class']] ?? 0) + 1;
    $checks['unique_key_' . $key] = $key === $entry['building_key'];
    $checks['max_level_99_' . $key] = (int)$entry['max_level'] === 99;
    $checks['has_type_' . $key] = str_starts_with((string)$entry['building_type'], 'factory_t');
    $checks['has_power_profile_' . $key] = isset($entry['base_power_output'], $entry['base_power_consumption']);
    $checks['has_prerequisite_' . $key] = $entry['prerequisite_key'] === null || $entry['prerequisite_level'] > 0;
}
$checks['ten_classes'] = count($classes) === 10;
$checks['nine_types_per_class'] = count($classes) === 10 && min($classes) === 9 && max($classes) === 9;

$keys = array_keys($catalog);
$placeholders = implode(',', array_fill(0, count($keys), '?'));
$stmt = $pdo->prepare("SELECT COUNT(*) FROM building_types WHERE building_key IN ($placeholders)");
$stmt->execute($keys);
$checks['database_has_90_seeded_rows'] = (int)$stmt->fetchColumn() === 90;
$stmt = $pdo->prepare("SELECT COUNT(*) FROM building_types WHERE building_key IN ($placeholders) AND max_level=99");
$stmt->execute($keys);
$checks['database_rows_have_level_99'] = (int)$stmt->fetchColumn() === 90;

$failures = array_keys(array_filter($checks, static fn(bool $ok): bool => !$ok));
echo json_encode(['status' => $failures ? 'failed' : 'passed', 'catalog_count' => count($catalog), 'classes' => $classes, 'failures' => $failures], JSON_PRETTY_PRINT) . PHP_EOL;
exit($failures ? 1 : 0);

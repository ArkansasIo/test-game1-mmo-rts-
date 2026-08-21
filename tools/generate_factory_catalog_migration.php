<?php
declare(strict_types=1);
require_once __DIR__ . '/../config/construction_factory_catalog.php';

$catalog = construction_factory_catalog();
$quote = static function ($value): string {
    if ($value === null) return 'NULL';
    if (is_int($value) || is_float($value)) return (string)$value;
    return "'" . str_replace("'", "''", (string)$value) . "'";
};
$lines = [
    '-- Universe Civilization: Empire at Wars',
    '-- Seed 90 construction and factory designs: 10 classes × 9 types.',
    'INSERT INTO building_types (building_key,name,display_name,category,max_level,base_time_seconds,base_metal,base_crystal,base_naquadah,base_energy,effect_key,effect_per_level,prerequisite_key,prerequisite_level,description,is_active,building_class,buildable_on,field_size,base_power_output,base_power_consumption,placement_rule) VALUES',
];
$values = [];
foreach ($catalog as $entry) {
    $values[] = '(' . implode(',', [
        $quote($entry['building_key']), $quote($entry['display_name']), $quote($entry['display_name']), $quote($entry['category']),
        $entry['max_level'], $entry['base_time_seconds'], $entry['base_metal'], $entry['base_crystal'], $entry['base_naquadah'], $entry['base_energy'],
        $quote($entry['effect_key']), $entry['effect_per_level'], $quote($entry['prerequisite_key']), $entry['prerequisite_level'], $quote($entry['description']),
        1, $quote($entry['building_class']), $quote($entry['buildable_on']), $entry['field_size'], $entry['base_power_output'], $entry['base_power_consumption'], $quote($entry['placement_rule'])
    ]) . ')';
}
$lines[] = implode(",\n", $values) . "\nON DUPLICATE KEY UPDATE\n  name=VALUES(name), display_name=VALUES(display_name), category=VALUES(category), max_level=VALUES(max_level),\n  base_time_seconds=VALUES(base_time_seconds), base_metal=VALUES(base_metal), base_crystal=VALUES(base_crystal),\n  base_naquadah=VALUES(base_naquadah), base_energy=VALUES(base_energy), effect_key=VALUES(effect_key),\n  effect_per_level=VALUES(effect_per_level), prerequisite_key=VALUES(prerequisite_key), prerequisite_level=VALUES(prerequisite_level),\n  description=VALUES(description), is_active=VALUES(is_active), building_class=VALUES(building_class), buildable_on=VALUES(buildable_on),\n  field_size=VALUES(field_size), base_power_output=VALUES(base_power_output), base_power_consumption=VALUES(base_power_consumption), placement_rule=VALUES(placement_rule);";
file_put_contents(__DIR__ . '/../sql/052_construction_factory_catalog.sql', implode("\n", $lines) . "\n");
echo 'Generated sql/052_construction_factory_catalog.sql with ' . count($catalog) . " entries.\n";

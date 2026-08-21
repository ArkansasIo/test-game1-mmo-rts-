<?php
declare(strict_types=1);

/**
 * Shared bounded-stat catalog. All gameplay consumers should resolve values
 * through StatResolverService rather than trusting client-provided numbers.
 */
return [
    'bounds' => [
        'commander' => ['min' => 0.0, 'max' => 100.0],
        'unit' => ['min' => 0.0, 'max' => 1000000.0],
        'starship' => ['min' => 0.0, 'max' => 100000000.0],
        'mothership' => ['min' => 0.0, 'max' => 1000000000.0],
        'building' => ['min' => 0.0, 'max' => 100000000.0],
        'technology' => ['min' => 0.0, 'max' => 10.0],
        'resource' => ['min' => 0.0, 'max' => 1000000000000.0],
        'planet' => ['min' => -1.0, 'max' => 100.0],
        'moon' => ['min' => -1.0, 'max' => 100.0],
        'fleet' => ['min' => 0.0, 'max' => 1000000000.0],
    ],
    'groups' => [
        'attributes' => ['command', 'tactics', 'science', 'logistics', 'diplomacy', 'covert', 'resilience'],
        'combat' => ['health', 'attack', 'defense', 'accuracy', 'evasion', 'ship_attack', 'ship_defense', 'offense_technology', 'defense_technology'],
        'mobility' => ['speed', 'ship_speed'],
        'logistics' => ['cargo', 'fuel_efficiency', 'storage_capacity'],
        'sub_stats' => ['morale', 'armor', 'shield', 'stealth', 'sensor_range'],
        'infrastructure' => ['power_generation', 'power_draw', 'construction_speed'],
        'economy' => ['production', 'production_rate', 'upkeep_rate'],
        'science' => ['research'],
        'civilian' => ['housing'],
        'covert' => ['covert_technology', 'anti_covert_technology'],
    ],
    'stacking' => [
        'additive_order' => 'sum',
        'multiplicative_order' => 'product',
        'buffs' => 'positive additive and multiplicative values are applied before bounds',
        'debuffs' => 'negative additive values and multipliers below one are applied before bounds',
        'temporary_expiry' => 'expired modifiers are ignored server-side',
        'hard_bounds' => 'definition bounds cannot be bypassed by modifiers',
    ],
];

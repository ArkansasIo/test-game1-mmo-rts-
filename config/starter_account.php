<?php
declare(strict_types=1);

/**
 * New commander starter package.
 *
 * Metal and Crystal follow the classic OGame-style opening balance. The
 * additional UCEAW resources use conservative starter values so a new account
 * can begin life-support and basic construction without bypassing progression.
 */
return [
    'resources' => [
        'metal' => 500,
        'crystal' => 500,
        'deuterium' => 0,
        'naquadah' => 1000,
        'energy' => 0,
        'dark_matter' => 500,
        'food' => 1000,
        'water' => 1000,
        'banked_naquadah' => 0,
    ],
    'capacities' => [
        'deuterium_capacity' => 1000,
        'population' => 100,
        'population_capacity' => 1000,
        'workforce' => 100,
    ],
    'turns' => [
        'attack_turns' => 10,
        'market_turns' => 3,
    ],
    'units' => [
        'untrained_units' => 100,
        'unit_production' => 1,
        'miners' => 10,
        'lifers' => 10,
        'attack_units' => 10,
        'defense_units' => 10,
        'spies' => 5,
        'anti_spies' => 5,
        'covert_capacity' => 5,
    ],
];

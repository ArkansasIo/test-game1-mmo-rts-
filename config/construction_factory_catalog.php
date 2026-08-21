<?php
declare(strict_types=1);

/**
 * 90 construction/factory designs: 10 classes × 9 types.
 * Every design is bounded to technology level 1–99 and can be seeded into
 * building_types for use by the settlement construction service.
 */
function construction_factory_catalog(): array
{
    $classes = [
        'resource' => [
            'names' => ['Metal Extractor','Crystal Extractor','Deuterium Synthesizer','Naquadah Mine','Dark Matter Observatory','Rare Mineral Quarry','Gas Harvester','Asteroid Drill','Resource Refinery'],
            'effects' => ['metal_production','crystal_production','deuterium_production','naquadah_production','dark_matter_production','rare_mineral_production','gas_production','asteroid_production','resource_refining'],
            'category' => 'resource', 'power' => 4, 'draw' => 12, 'output' => 5, 'time' => 240,
        ],
        'energy' => [
            'names' => ['Solar Array','Fusion Reactor','Antimatter Plant','Zero-Point Core','Dyson Relay','Geothermal Tap','Tidal Generator','Stellar Collector','Power Distribution Hub'],
            'effects' => ['solar_power','fusion_power','antimatter_power','zero_point_power','dyson_power','geothermal_power','tidal_power','stellar_power','power_distribution'],
            'category' => 'life_support', 'power' => 80, 'draw' => 4, 'output' => 8, 'time' => 360,
        ],
        'life_support' => [
            'names' => ['Water Purifier','Atmosphere Processor','Hydroponic Farm','Oxygen Garden','Climate Regulator','Biosphere Dome','Medical Habitat','Ecology Archive','Life Support Nexus'],
            'effects' => ['water_output','atmosphere_output','food_output','oxygen_output','climate_stability','biosphere_capacity','medical_recovery','ecology_research','life_support'],
            'category' => 'life_support', 'power' => 8, 'draw' => 20, 'output' => 6, 'time' => 300,
        ],
        'civic' => [
            'names' => ['Civic Library','Archive Complex','Academy Campus','Government Hall','Cultural Exchange','Population Registry','Public Forum','Command Secretariat','Capital District'],
            'effects' => ['library_research','archive_research','academy_capacity','government_efficiency','diplomacy_output','population_admin','morale_output','command_capacity','capital_bonus'],
            'category' => 'government', 'power' => 3, 'draw' => 10, 'output' => 4, 'time' => 420,
        ],
        'industrial' => [
            'names' => ['Robotics Factory','Nanite Factory','Heavy Industry','Automated Foundry','Machine Works','Industrial Fabricator','Molecular Printer','Megafactory','Industrial Arcology'],
            'effects' => ['robotics_speed','nanite_speed','heavy_industry','automated_foundry','machine_output','fabrication_output','molecular_printing','mega_output','arcology_output'],
            'category' => 'economy', 'power' => 18, 'draw' => 42, 'output' => 10, 'time' => 600,
        ],
        'research' => [
            'names' => ['Research Lab','Physics Institute','Engineering Institute','Quantum Lab','Xenoarchaeology Center','AI Research Core','Propulsion Lab','Weapons Lab','Technology Directorate'],
            'effects' => ['research_speed','physics_research','engineering_research','quantum_research','xeno_research','ai_research','propulsion_research','weapons_research','technology_direction'],
            'category' => 'research', 'power' => 12, 'draw' => 34, 'output' => 9, 'time' => 540,
        ],
        'defense' => [
            'names' => ['Kinetic Battery','Laser Battery','Ion Battery','Gauss Emplacement','Plasma Bastion','Shield Generator','Point Defense Grid','Planetary Fortress','Defense Command Nexus'],
            'effects' => ['kinetic_defense','laser_defense','ion_defense','gauss_defense','plasma_defense','shield_defense','point_defense','fortress_defense','defense_command'],
            'category' => 'defense', 'power' => 10, 'draw' => 28, 'output' => 12, 'time' => 480,
        ],
        'shipyard' => [
            'names' => ['Orbital Shipyard','Frigate Assembly Line','Cruiser Assembly Line','Battleship Assembly Line','Carrier Assembly Line','Capital Ship Foundry','Mothership Dock','Fleet Fabrication Ring','Grand Shipyard'],
            'effects' => ['shipyard_capacity','frigate_production','cruiser_production','battleship_production','carrier_production','capital_production','mothership_dock','fleet_fabrication','grand_shipyard'],
            'category' => 'shipyard', 'power' => 24, 'draw' => 60, 'output' => 14, 'time' => 900,
        ],
        'orbital' => [
            'names' => ['Orbital Elevator','Space Station','Jump Gate','Sensor Array','Trade Platform','Orbital Habitat','Starbase Core','Gate Network Hub','Orbital Command'],
            'effects' => ['orbital_logistics','station_capacity','jump_gate','sensor_range','trade_capacity','orbital_housing','starbase_capacity','gate_network','orbital_command'],
            'category' => 'military', 'power' => 20, 'draw' => 48, 'output' => 11, 'time' => 720,
        ],
        'logistics' => [
            'names' => ['Cargo Terminal','Fuel Depot','Deuterium Reserve','Fleet Logistics Center','Repair Dock','Salvage Yard','Supply Exchange','Convoy Control','Logistics Nexus'],
            'effects' => ['cargo_capacity','fuel_storage','deuterium_storage','fleet_logistics','repair_speed','salvage_output','supply_trade','convoy_control','logistics_nexus'],
            'category' => 'civilian', 'power' => 7, 'draw' => 18, 'output' => 7, 'time' => 450,
        ],
    ];

    $catalog = [];
    foreach ($classes as $classKey => $class) {
        foreach ($class['names'] as $index => $name) {
            $type = $index + 1;
            $key = $classKey . '_' . str_pad((string)$type, 2, '0', STR_PAD_LEFT);
            $catalog[$key] = [
                'building_key' => $key,
                'display_name' => $name,
                'building_class' => $classKey,
                'building_type' => 'factory_t' . $type,
                'category' => $class['category'],
                'effect_key' => $class['effects'][$index],
                'effect_per_level' => round($class['output'] * (1 + $index * 0.08), 4),
                'base_time_seconds' => $class['time'] + ($index * 45),
                'base_metal' => 1000 * ($type + 1),
                'base_crystal' => 500 * ($type + 1),
                'base_naquadah' => 250 * $type,
                'base_energy' => $class['draw'],
                'base_power_output' => $class['power'] + ($index * 5),
                'base_power_consumption' => $class['draw'] + ($index * 3),
                'buildable_on' => in_array($classKey, ['shipyard', 'orbital'], true) ? 'planet' : 'both',
                'field_size' => $classKey === 'orbital' ? 2 : 1,
                'max_level' => 99,
                'placement_rule' => $classKey === 'shipyard' ? 'shipyard_required' : 'none',
                'prerequisite_key' => $index === 0 ? null : $classKey . '_' . str_pad((string)$index, 2, '0', STR_PAD_LEFT),
                'prerequisite_level' => $index === 0 ? 0 : min(99, $index * 5),
                'description' => $name . ' is a tiered ' . $classKey . ' construction design with factory type ' . $type . ', scalable output, power draw, and level 1–99 progression.',
            ];
        }
    }
    return $catalog;
}

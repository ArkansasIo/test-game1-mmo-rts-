# Universe Civilization: Empire at Wars — Bounded Stats and Modifiers

## Purpose

The bounded-stat framework gives every major game entity a common, server-authoritative way to expose primary attributes, secondary attributes, buffs, debuffs, and hard limits. It applies to commanders, units, starships, motherships, buildings, technologies, resources, planets, moons, and fleets.

> The client may display a value, but it never decides the final value. Every combat, production, queue, movement, construction, and covert calculation must resolve through the server-side stat rules.

## Resolution formula

For a stat definition with base value `B`, persistent additive value `A0`, persistent multiplier `M0`, and active modifiers `i`:

```text
additive_total = A0 + Σ(additive_i)
multiplier_total = M0 × Π(multiplier_i)
raw_value = (B + additive_total) × multiplier_total
resolved_value = clamp(raw_value, effective_min, effective_max)
```

Effective minimum and maximum values come from the stat definition. Entity and modifier overrides can tighten those limits but cannot widen the hard definition bounds.

Expired modifiers are excluded using server time. Negative multiplier values are rejected. A debuff normally uses a negative additive value or a multiplier below `1.0`; a buff normally uses a positive additive value or a multiplier above `1.0`.

## Attribute families

| Family | Examples | Primary use |
|---|---|---|
| Commander attributes | Command, Tactics, Science, Logistics, Diplomacy, Covert, Resilience | Commander progression and global modifiers |
| Unit primary stats | Health, Attack, Defense, Speed | Combat, movement, survivability |
| Unit sub-stats | Accuracy, Evasion, Morale, Armor, Shield | Combat resolution and readiness |
| Starship primary stats | Hull, Ship Attack, Ship Defense, Ship Speed, Cargo | Fleet combat and movement |
| Starship sub-stats | Fuel Efficiency, Sensor Range, Stealth | Deuterium usage, scanning, covert movement |
| Building stats | Power Generation, Power Draw, Production, Research, Housing | Settlement output and power-grid behavior |
| Technology stats | Offense, Defense, Covert, Anti-Covert Technology | Technology scaling and detection |
| Resource stats | Storage Capacity, Production Rate, Upkeep Rate | Economy and turn settlement |

## Buff and debuff source types

The schema records source type and source key for auditability. Supported source kinds are `buff`, `debuff`, `temporary`, `aura`, `technology`, `government`, `race`, `biome`, and `condition`.

Typical positive sources include race specialization, government policy, technology research, morale, alliance effects, and infrastructure synergy. Typical negative sources include brownouts, low morale, damage condition, blockade, detected covert operations, depleted life support, and temporary combat injuries.

## Example formulas

```text
unit_effective_attack = clamp((base_attack + commander_tactics + weapon_buff - damage_debuff)
                              × offense_technology × morale, 0, hard_max)

starship_deuterium_cost = base_distance_cost × distance × fuel_efficiency
                          × condition_multiplier × fleet_debuff_multiplier

settlement_production = clamp((base_production + building_production + technology_bonus)
                              × morale × power_efficiency, 0, production_cap)

covert_detection = clamp((defender_counter_intelligence + anti_covert_bonus
                          - attacker_agents - attacker_covert_bonus)
                         × detection_multiplier, 0, 100)
```

All formula inputs must be resolved server-side. Values supplied by forms are treated only as intent and are revalidated against ownership, cooldown, prerequisites, resource balances, and entity bounds.

## Database and service contract

`sql/051_bounded_stats_modifiers.sql` creates `stat_definitions`, `entity_stat_values`, and `entity_stat_modifiers`. `includes/services/StatResolverService.php` provides `resolve`, `resolveMany`, `setBaseValue`, `addModifier`, `deactivateModifier`, and `clamp`. Every resolved value includes a source breakdown for debugging and audit displays.

The indexes support the two high-traffic access patterns: resolving all stats for one entity and finding active modifiers for one entity/stat. Modifiers also have an expiry index so cleanup and reporting jobs can avoid full-table scans.

## Integration rule

Existing combat, fleet, settlement, research, training, and covert services should gradually replace local ad hoc multipliers with `StatResolverService`. During migration, the legacy formula remains the fallback when no stat row exists, while the resolver returns the definition base value and an empty modifier set.

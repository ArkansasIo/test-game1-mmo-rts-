# Fleet, Motherships, and Megastructures

## Fleet model

Fleets are collections of starships, units, weapons, support modules, and mission metadata. A fleet has owner, origin, target, mission type, departure time, arrival time, fuel requirement, readiness, combat force, science capability, and return state.

The design catalog supports 32 starship classes and types with distinct stats and sub-stats. Each class should declare hull, shields, armor, attack, defense, speed, cargo, science, fuel use, crew or population use, build cost, build time, technology prerequisites, and rapid-fire interactions.

## Mothership

The mothership is a persistent command vessel with hull integrity, hangar capacity, shield systems, science, storage, module slots, and technology modifiers. Mothership upgrades validate module type, cost, prerequisites, ownership, capacity, cooldown, and queue availability. The mothership page should show installed modules, power draw, capacity, queue status, and exploration readiness.

## Starbases and moon bases

Starbases anchor travel lanes, defense grids, trade, fleet logistics, and sector control. Moon bases provide sensors, jump gates, storage, defenses, and orbital bonuses. Both are owned infrastructure and must be protected by ownership and transaction checks.

## Travel and fuel

Travel time and Deuterium use depend on distance, ship class, fleet size, speed technology, gates, and travel lanes. A fleet cannot dispatch unless its owner has the required resources and the target is valid. Gate access is checked server-side and may reduce time or fuel without bypassing protection or coordinate scope.

## Megastructures

Megastructures are strategic projects that require phases, resources, technologies, construction queues, special materials, and potentially alliance or civilization contributions. Each phase should record contributor, amount, start time, completion state, and event history. Concurrent contributions must use row locks or atomic increments to avoid lost progress.

## Victory conditions

Possible victory conditions include:

- Military dominance through an auditable campaign or control threshold.
- Economic supremacy based on verified production, wealth, and infrastructure.
- Technological ascension through research and progression completion.
- Exploration victory through discovery, anomaly, and coordinate milestones.
- Diplomatic victory through alliance and NPC relations.
- Megastructure victory through completed end-game construction.
- Seasonal victory through ranking and objective performance.

Victory must be determined from server state, recorded with timestamp and evidence, protected from duplicate claims, and announced through appropriate public or private events.

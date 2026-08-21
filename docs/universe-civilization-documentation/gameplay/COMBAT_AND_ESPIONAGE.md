# Combat and Espionage

## Combat authority

Combat is a server-side resolution. The client may request target selection or a preview, but the authoritative result is generated from current force, technology, defense, readiness, protection, cooldown, resource, and deterministic resolver inputs.

## Combat phases

1. Validate attacker identity, target existence, target protection, target ownership classification, available turns, fleet readiness, and cooldown.
2. Lock the relevant attacker, target, resource, protection, and battle rows.
3. Calculate attack power, defense power, technology modifiers, race and government modifiers, planet bonuses, and readiness.
4. Resolve multiple rounds until a victory, defeat, draw, retreat, or configured maximum round count.
5. Apply rapid-fire or counter-fire rules, bounded damage, unit and weapon losses, loot, debris, cooldowns, and protection outcomes.
6. Write battle reports, intelligence records where applicable, game events, rankings impacts, and audit data in one transaction.

## Multi-round combat

The combat resolver should retain a round-by-round record containing participating forces, effective attack, effective defense, damage, losses, rapid-fire triggers, remaining force, and deterministic seed. The final report should summarize the battle while preserving enough detail for a commander to understand the outcome.

## Rapid-fire

Rapid-fire is a bounded repeated-hit or target-switching rule driven by weapon class, attacker technology, defender class, and configured probability or deterministic seed. It must never create unbounded loops, negative unit counts, or damage outside configured caps.

## Protection and cooldowns

Protected commanders cannot be attacked, raided, sabotaged, or covertly targeted when the protection rule applies. Attack turns, mission cooldowns, DefCon, vacation state, active combat, and account restrictions are validated at resolution time rather than only at page load.

## Espionage

Covert missions include reconnaissance, spy, and sabotage. Detection compares defender counter-intelligence against attacker agents and covert technology, adjusted by target vulnerability, mission type, freshness, and anti-covert effects. A detected operation can fail, produce partial intelligence, inflict bounded damage, or create a report according to the mission contract.

## Reports

Battle reports and intelligence reports include recipient, classification, read state, confidence, freshness, payload, outcome, and event references. Report access is scoped to the recipient, sender where applicable, or explicitly public classification. Mark-read actions update only the authorized report row and must be transactionally safe.

## Testing

Combat tests should cover zero force, maximum force, equal force, protected target, cooldown, insufficient resources, invalid target, rapid-fire cap, deterministic repeatability, loss bounds, debris creation, report visibility, and concurrent attack attempts. Covert tests should cover invalid target, insufficient agents, detection, sabotage damage caps, and report classification.


## Implemented combat and fleet-resolution layer

The server now provides `CombatFleetService`, which resolves combat inside a database transaction. It validates participants and protection state, uses a deterministic SHA-256 seed, runs up to the configured maximum number of rounds, calculates round power and damage, records rapid-fire events, applies bounded casualties and loot, persists `battles`, `battle_rounds`, `battle_participants`, and `battle_reports`, and writes commander events. Dashboard `target_realms` identifiers are resolved to their owning player before combat.

Fleet movement is persisted in `fleet_missions`. The service validates source-colony ownership, target existence, mission type, unit quantities, coordinates, Deuterium fuel, and travel time. Departures consume Deuterium atomically and create `fleet_events`. Due missions are processed by `processArrivals`; attack and raid missions invoke the same combat resolver, while non-combat missions complete with arrival and return events.

Migration `045_combat_fleet_mechanics.sql` adds travel metadata, battle seeds and round counters, compatible round-resolution fields, `fleet_events`, and the combat/fleet settings used by the authoritative service.

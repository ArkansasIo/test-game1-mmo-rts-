# Database Architecture

## Schema domains

The database is organized by domain rather than by page. Core identity tables link to player resources, colonies, units, technologies, fleets, reports, social systems, universe records, queues, cooldowns, and events.

| Domain | Main tables |
|---|---|
| Identity and access | `players`, races, governments, roles, protection, vacation, sessions. |
| Economy | `player_resources`, vault/settings, production, resource markets, market transactions. |
| Progression | progression states, tiers, levels, glory, reputation, ascensions, rankings, seasons. |
| Research and production | `technologies`, `technology_prerequisites`, `player_technologies`, `research_queues`, construction and production queues. |
| Military | unit types, player unit stats, training queues, weapons, weapon types, battles, battle reports, defenses. |
| Universe | galaxies, sectors, solar systems, planets, moons, biomes, bonuses, discoveries, travel lanes. |
| Mothership and exploration | motherships, modules, missions, expeditions, discoveries, anomalies, debris. |
| Social and MMO | alliances, members, projects, messages, blacklists, quests, achievements, officers, NPC civilizations. |
| Audit and operations | `game_events`, audit records, migrations, scheduled job records, cooldowns. |

## Ownership model

Most player-scoped tables include a player or owner reference. Colony, mothership, weapon, fleet, market order, message, report, and alliance records should be joined through ownership or membership checks rather than trusting a submitted identifier. Public tables must expose only fields declared safe by the page contract.

## Keys and indexes

Coordinate tables require indexes for hierarchy traversal and coordinate lookup. Queue tables require indexes for player and active status, completion time, and idempotent processing. Markets require indexes for active orders, type, price, expiry, and seller. Reports require recipient, classification, read state, and created time. Event tables require player, event type, entity, and created time indexes for audit and feed queries.

## Event history

Game events are the durable explanation for important state transitions. Events should contain player, event type, entity type, entity ID, payload, created time, and optionally correlation or source information. Payloads must avoid secrets and must be safe for authorized display.

## Decimal and numeric policy

Resource balances, production, modifiers, and population may require decimal precision. IDs, levels, quantities, statuses, and enumerations should use appropriate integer or constrained types. Application formatting should not silently change stored precision. Population capacity and Deuterium capacity must be explicitly represented rather than inferred in the browser.

## MariaDB-safe migrations

The migration runner handles DDL changes without assuming that all statements can participate in a transaction. Migration files must be ordered, idempotent where practical, and safe to resume. Data backfills and dependent seed inserts should follow the schema change in a later migration when a partial failure could leave an inconsistent state.

## Backup and restore

Backups must include schema, migration metadata, player state, queues, events, and universe ownership overlays. A restore must verify migration state, foreign keys, event continuity, queue status, and resource invariants before allowing normal turn processing.

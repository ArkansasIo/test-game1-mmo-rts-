# OGame-style design gap audit

Source: `/home/ubuntu/upload/pasted_content.txt` (3,007 lines; sections 1–110).

## Design domains identified

The attachment covers resource production and storage, planets and fields, buildings and construction queues, research and technology dependencies, shipyards, fleet statistics and management, fleet missions and travel, colonization and colony development, moon systems, defenses and recovery, combat rounds/rapid fire/debris/loot, espionage and counterespionage, expeditions and exploration events, galaxy maps, alliances and alliance ranks, diplomacy, trading and market, economy, population, happiness/stability, government, officers, premium currency, tutorials, missions/quests, achievements, statistics, ranking, messaging, notifications, security, anti-cheat, backend architecture, database architecture, server ticks, event queues, UI pages, game speed, server configuration, new-player protection, inactive players, vacation mode, seasons, world events, NPC civilizations, ancient technology, endgame, megastructures, victory conditions, API design, administration, logging, performance, caching, and phased development.

## Existing project coverage

The project already contains services for economy, resources, income, faction/government, progression, weapons, training, production, technology branches, covert operations, planets, defenses, motherships, exploration, alliances, rankings, messaging, markets, procedural universe generation, and world navigation. It contains migrations through `041_rankings_component_extension.sql` and many contract/integration tests.

The project currently lacks dedicated service classes with these names/domains: Fleet, Expedition, Quest, Achievement, Notification, Event, NPC, Megastructure, Tutorial, Officer, and Cache. Some related tables and action cases exist, but they are not yet represented by complete dedicated service layers or full dashboard modules.

Existing action cases include `launch_mission`, `event_join`, `notification_read`, `queue_building`, `queue_research`, `trade_create`, `diplomacy_propose`, `add_experience`, and `record_discovery`, in addition to existing combat, exploration, market, alliance, planet, technology, and progression actions.

Existing fleet-related schemas are in `sql/006_ogame_systems.sql`: `fleet_types`, `colony_fleets`, and `fleet_missions`. Existing event-related schemas include `game_world_events`, `world_event_participants`, `turn_events`, `game_events`, `player_notifications`, and procedural-universe generation events. These should be extended rather than duplicated.

## Implementation priority

1. Complete missing server-authoritative fleet/fleet-mission service and dispatch flow.
2. Complete event/notification/quest/achievement service contracts and persistence.
3. Extend combat with explicit round resolution, rapid-fire, debris, loot, and recovery state.
4. Add expedition and exploration event resolution connected to the seeded universe.
5. Add diplomacy/trade/NPC/season/endgame features after the core queue and event loop is stable.
6. Add dedicated UI panels and tests for every new action and state.

All new mutations must preserve authentication, CSRF, RBAC, ownership, cooldown, resource checks, deterministic resolution, and transactions.

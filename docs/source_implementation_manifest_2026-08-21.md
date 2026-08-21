# Universe Civilization: Empire at Wars — Source Implementation Manifest

## Purpose

This manifest maps the attached 3,007-line game design specification to the PHP/MySQL source architecture. It is the authoritative source-file index for the implementation batch.

## Implemented source domains

| Domain | Primary source files | Persistent support | Frontend route |
|---|---|---|---|
| Authentication and security | `config/auth.php`, `actions/game.php` | `players`, sessions, CSRF | Login and account |
| Economy and resources | `includes/services/EconomyService.php`, `includes/services/GameService.php` | `player_resources`, settings | Resources, income |
| Planet economy | `includes/services/PlanetService.php`, `includes/services/PlanetBonusService.php` | colonies, bonuses, production queues | Planet List, Planet Bonuses |
| Construction and research | `includes/services/OGameService.php`, `includes/services/GameFeatureService.php`, technology services | `building_types`, research queues, production queues | Buildings and Technology |
| Fleet and missions | `includes/services/OGameService.php`, `includes/services/EmpireOperationsService.php` | fleets, missions, expeditions | Missions and Exploration |
| Combat and espionage | `includes/services/GameService.php`, `includes/services/SpyLogService.php` | battles, reports, covert missions | Attack and Intelligence |
| Diplomacy and social | `includes/services/AllianceService.php`, `includes/services/MessagingService.php`, `includes/services/RankingsService.php` | alliances, messages, rankings | Social |
| Universe generation | `includes/services/ProceduralUniverseService.php`, `WorldService.php` | procedural entities, discovery, ownership | Universe |
| Progression | `includes/services/ProgressionService.php`, `FactionService.php` | tiers, governments, officers, achievements | Account and Operations |

## Required catalog source

`config/design_catalog.php` contains machine-readable definitions for resources, planet biomes, buildings, technologies, ships, defenses, troops, missions, government jobs, officers, achievements, and world events. Services must read catalog keys rather than hard-code user-submitted values.

## Required mechanic source

`includes/services/GameMechanicsService.php` centralizes formulas from the specification:

- Elapsed-time production.
- Storage capacity and clamping.
- Building and research cost growth.
- Fleet travel time and fuel.
- Combat power and rapid-fire resolution.
- Loot and debris generation.
- Espionage detection.
- Population growth and life-support pressure.
- Stability and government effects.
- Ranking score composition.

## Database migration

`sql/043_design_catalog_and_mechanics.sql` stores versioned formula definitions and catalog metadata without replacing existing tables. Existing services remain compatible and can progressively migrate from embedded constants to catalog lookups.

## Frontend integration

The existing `game.php` shell remains the single-page dashboard. New pages should use the existing route registry, server-provided state, POST intent forms, and one-time feedback lifecycle. No client-side calculation is authoritative.

## Validation expectations

Every new mutation must enforce authentication, CSRF, ownership, RBAC, resource validation, cooldowns, queue capacity, and a transaction. Every read must be scoped to the authenticated commander. Formula tests must include zero resources, negative income, storage caps, maximum population, queue saturation, and deterministic coordinates.

## Remaining staged work

The specification contains 110 design sections. The current source package provides the shared catalogs and formula layer needed to complete the remaining specialized screens and action handlers incrementally. Large-scale NPC behavior, full combat-round resolution, advanced anti-cheat telemetry, and megastructure victory processing remain separate implementation batches rather than being silently represented as completed.

## Version

Manifest version: `UCEAW-SOURCE-MAP-2026.08.21`

Author: Manus AI

## References

The design source is the user-provided attachment `pasted_content_2.txt`, sections 1–110.
> Gather → Build → Research → Expand → Fleet → Explore → Trade → Fight → Recover → Expand Again.

This source package preserves that loop as separate server-authoritative services and queues.

# Implementation Status

## Status legend

| Status | Meaning |
|---|---|
| Implemented | Present in the current repository with a usable service, page, persistence path, or test coverage. |
| Integrated | Implemented across multiple layers, including schema, service, state, and UI or route wiring. |
| Partial | Core behavior exists, but one or more UI, balancing, persistence, edge-case, or integration details remain. |
| Architectural | Service or schema direction exists, but the complete gameplay loop is not yet finished. |
| Planned | Described by the design or manifest but not yet implemented as a complete system. |

## Current system matrix

| System | Status | Evidence / source of truth | Remaining work |
|---|---|---|---|
| Authenticated dashboard shell | Integrated | `game.php`, auth configuration, route registry, live route checks | Continue responsive and accessibility refinement. |
| 43-page registry and page modules | Integrated | `config/page_registry.php`, `config/page_definitions/`, `includes/page_modules/`, page-module tests | Keep route, renderer, and contract catalogs synchronized. |
| Nine-resource economy | Integrated | `sql/044_deuterium_resource.sql`, `player_resources`, resource state serialization, design catalog | Verify Deuterium appears in every deployed header and advanced cost table. |
| Resource settlement and vault | Implemented | `EconomyService`, `actions/game.php`, vault tests, turn processing | Expand edge-case coverage for all nine resources and concurrent settlements. |
| 21 tiers × 23 levels | Integrated | progression catalog and progression services | Complete long-term balance pass and ascension UI depth. |
| Procedural universe | Integrated | `ProceduralUniverseService`, universe SQL, procedural tests | Expand generated content volume and discovery persistence as production scale grows. |
| Galaxy, sector, system, planet, moon navigation | Integrated | universe page services, page renderers, route contracts | Add richer fleet lanes, scan telemetry, and map visualization. |
| Colonies and planet bonuses | Implemented | `PlanetService`, `PlanetBonusService`, planet pages, contract tests | Add deeper building queues and biome-specific event chains. |
| Planet defense | Implemented | `PlanetDefenseService`, defense queue migration, planet defense page | Integrate full combat rounds and repair/condition decay. |
| Technology Tree | Integrated | `TechnologyTreeService`, technology branch services, research migrations, Technology pages | Add more research categories, Deuterium costs, and completion effects. |
| Offense, defense, covert, anti-covert branches | Integrated | branch services, action dispatcher, shared Technology renderer | Balance formulas and add more branch-specific UI telemetry. |
| Unit training and production | Implemented | training and production services, queues, tests | Improve pause/cancel semantics and production event visibility. |
| Workforce: Miners and Lifers | Implemented | `WorkforceService`, workforce migration, page renderer | Add assignment mutation UI and role-specific events. |
| Weapons and repair | Implemented | weapon inventory, market, repair services and pages | Expand loadout management and durability effects in combat. |
| Mothership and modules | Implemented | mothership services, migrations, page modules, tests | Extend module inventory, power draw, and fleet launch behavior. |
| Exploration and expeditions | Partial | exploration service, universe services, MMO expansion schema | Add full mission lifecycle, recall, rewards, and anomaly chains. |
| Combat | Partial | combat service, resolver foundations, attack contracts and tests | Implement authoritative multi-round resolver, rapid-fire, losses, loot, and reports. |
| Espionage and sabotage | Implemented / Partial | covert services, reports, sabotage migrations and tests | Extend target-system disruption and detection outcome presentation. |
| Markets | Implemented | weapon and resource market services, migrations, trade tests | Add richer order matching, cancellation, and market history UX. |
| Alliances and messaging | Implemented | social services, pages, contracts, tests | Expand diplomacy proposals, role management, and alliance projects. |
| Rankings and seasons | Partial | ranking services, snapshot tables, rankings page | Complete seasonal rewards, season rollover, and historical views. |
| Quests and achievements | Partial | MMO expansion schema and services | Add player-facing pages, progression triggers, and reward settlement. |
| Officers | Partial | MMO expansion schema and services | Add recruitment, assignment, progression, and officer effects UI. |
| NPC civilizations | Architectural | NPC schema and service foundation | Implement behavior loops, diplomacy, expansion, and combat interaction. |
| Debris fields | Partial | expansion schema and services | Connect battlefield debris creation, scanning, harvesting, and expiry. |
| Megastructures | Planned / Architectural | design manifest and related schema direction | Implement construction phases, concurrency, ownership, and victory resolution. |
| Scheduled turn processing | Implemented | cron scripts and queue services | Add production monitoring, retry strategy, and operational alerting. |
| Load testing | Partial | 500-player load test artifacts and turn tests | Repeat against production-like MariaDB settings and record thresholds. |

## Documentation maintenance rule

Every status change must update this file, the affected gameplay document, the route or service catalog, and the validation matrix. Status should be changed only after the source code and tests support the new claim.

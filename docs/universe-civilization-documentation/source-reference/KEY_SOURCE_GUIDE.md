# Key Source Guide

## Primary entry points

| File | Role |
|---|---|
| `game.php` | Authenticated dashboard shell, server-state assembly, route selection, client renderer dispatch, header, footer, account preferences. |
| `index.php` | Public or login-facing entry point, depending on current deployment routing. |
| `actions/game.php` | Authenticated mutation dispatcher for gameplay actions. |
| `actions/login.php` | Login request handler. |
| `actions/register.php` | Registration request handler. |
| `actions/logout.php` | Session logout handler. |
| `cron/process_turns.php` | Scheduled turn processing entry point. |

## Configuration and catalogs

| File | Role |
|---|---|
| `config/page_registry.php` | 43-route menu and page registry. |
| `config/page_route_details.php` | Route formulas, panels, controls, permissions, tables, and feedback states. |
| `config/page_contracts.php` | Page-level action and data contracts. |
| `config/design_catalog.php` | Shared game entity definitions and design metadata. |
| `config/economy_resource_model.php` | Resource definitions and economy semantics. |
| `config/progression_catalog.php` | Tier, level, effect, and progression definitions. |
| `config/app_meta.php` | Version, build, developer, and footer metadata. |
| `config/auth.php` | Authentication and security integration. |
| `config/database.php` | PDO/database connection configuration. |

## Authoritative services

| File or group | Role |
|---|---|
| `includes/services/GameMechanicsService.php` | Core production, combat, travel, and authoritative game formulas. |
| `includes/services/TechnologyTreeService.php` | Research catalogue, prerequisites, queue snapshot, cost, effects, and upgrades. |
| `includes/services/DefenseTechnologyService.php` | Defense branch snapshot and validation wrapper. |
| `includes/services/OffenseTechnologyService.php` | Offense branch snapshot and weapon-system telemetry. |
| `includes/services/CovertTechnologyService.php` | Covert branch snapshot and infiltration telemetry. |
| `includes/services/AntiCovertTechnologyService.php` | Anti-covert branch snapshot and counter-intelligence telemetry. |
| `includes/services/ProceduralUniverseService.php` | Deterministic universe generation, scan, explore, and ownership overlay. |
| `includes/services/PlanetService.php` | Colony list, exploration, colonization, and planet operations. |
| `includes/services/MothershipService.php` | Mothership state, modules, and upgrade operations. |
| `includes/services/MothershipExplorationService.php` | Mothership exploration missions and results. |
| `includes/services/EmpireOperationsService.php` | MMO operations, missions, quests, achievements, or expansion state where implemented. |
| `includes/services/RankingsService.php` | Ranking score, snapshots, and refresh behavior. |
| `includes/services/AllianceService.php` | Alliance creation, membership, projects, and diplomacy. |
| `includes/services/MessagingService.php` | Messages, read state, blacklist, and notifications. |

## Page layers

Each page typically has a public entry under `pages/`, a definition under `config/page_definitions/`, logic/features/design/system files under corresponding `config/` directories, and a module under `includes/page_modules/`. The module exposes logic, feature, design, system, action, validation, preview, and state-transition functions used by contract and smoke tests.

## Database and migration tools

The `sql/` directory contains complete schemas, seed data, and ordered migrations. The `tools/` directory contains migration runners, audits, generators, load helpers, and documentation utilities. Migration scripts should not be run against production without a backup and the deployment runbook.

## Test suite

The `tests/` directory contains contract tests, service tests, page-module tests, universe tests, economy tests, action flow tests, UI helper tests, and load tests. A test is part of the implementation contract when it protects a security, resource, ownership, queue, or deterministic-universe invariant.

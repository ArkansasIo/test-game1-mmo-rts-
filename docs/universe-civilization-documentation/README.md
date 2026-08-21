# Universe Civilization: Empire at Wars — Documentation Index

> **Universe Civilization: Empire at Wars** is a text-based PHP/MySQL MMORPG/RTS in which commanders build colonies, develop technology, command fleets, explore a deterministic seeded universe, compete in military and economic systems, and progress through a 21-tier strategic hierarchy.

This folder is the canonical documentation package for the current repository implementation. The documentation is organized so that the high-level **Game Design Document** remains readable while detailed engineering references stay in focused documents.

## Core documents

| Document | Purpose |
|---|---|
| [Game Design Document](gdd/GDD.md) | Complete game vision, player loop, content, systems, progression, economy, combat, universe, social features, UI, and victory conditions. |
| [Implementation Status](gdd/IMPLEMENTATION_STATUS.md) | Separates implemented behavior, partial systems, architectural work, and planned features. |
| [Glossary](gdd/GLOSSARY.md) | Shared terminology for gameplay, technical, database, and UI concepts. |
| [Changelog Template](gdd/CHANGELOG_TEMPLATE.md) | Standard format for documenting future gameplay and engineering changes. |

## Architecture and design

| Document | Purpose |
|---|---|
| [System Architecture](architecture/SYSTEM_ARCHITECTURE.md) | Runtime layers, request flow, state authority, service boundaries, and deployment topology. |
| [Security Architecture](architecture/SECURITY_ARCHITECTURE.md) | Authentication, CSRF, RBAC, ownership, cooldowns, transactions, and trust boundaries. |
| [Data and State Flow](architecture/DATA_AND_STATE_FLOW.md) | How browser intent becomes server-validated state and event history. |
| [UI and Navigation Architecture](frontend/UI_NAVIGATION_ARCHITECTURE.md) | Dashboard shell, menu groups, submenus, route registry, renderer patterns, and preferences. |

## Gameplay systems

| Document | Purpose |
|---|---|
| [Economy and Resources](gameplay/ECONOMY_AND_RESOURCES.md) | Nine-resource economy, capacities, production, upkeep, vault, Deuterium, and settlement. |
| [Progression](gameplay/PROGRESSION.md) | 21 tiers, 23 levels per tier, effects, ascension, glory, and reputation. |
| [Technology and Research](gameplay/TECHNOLOGY_AND_RESEARCH.md) | Research branches, prerequisites, cost formulas, queues, effects, and Deuterium integration points. |
| [Combat and Espionage](gameplay/COMBAT_AND_ESPIONAGE.md) | Force comparison, combat rounds, detection, sabotage, reports, and combat authority. |
| [Universe and Exploration](gameplay/UNIVERSE_AND_EXPLORATION.md) | Seeded universe hierarchy, procedural generation, sectors, systems, planets, moons, anomalies, and expeditions. |
| [Civilizations and Colonies](gameplay/CIVILIZATIONS_AND_COLONIES.md) | Races, governments, colonies, population, workforce, biomes, defenses, and life support. |
| [Fleet, Motherships, and Megastructures](gameplay/FLEET_AND_MEGASTRUCTURES.md) | Ships, motherships, modules, starbases, moon bases, megastructures, and victory conditions. |
| [Social, MMO, and Seasonal Systems](gameplay/SOCIAL_MMO_AND_SEASONS.md) | Alliances, diplomacy, messages, rankings, quests, achievements, officers, seasons, NPC civilizations, and markets. |

## Frontend and backend references

| Document | Purpose |
|---|---|
| [43-Route Dashboard Reference](frontend/DASHBOARD_43_ROUTE_REFERENCE.md) | Page-by-page menu, submenu, control, state, formula, action, and table reference. |
| [Frontend Integration Guide](frontend/FRONTEND_INTEGRATION_GUIDE.md) | Client state, forms, CSRF fields, feedback states, navigation, and responsive behavior. |
| [Backend Action Reference](backend/BACKEND_ACTION_REFERENCE.md) | Server actions, inputs, validation, authorization, transactions, and outputs. |
| [Service Layer Guide](backend/SERVICE_LAYER_GUIDE.md) | Authoritative services, responsibilities, formulas, and service-to-table relationships. |
| [Cron and Queue Reference](backend/CRON_AND_QUEUE_REFERENCE.md) | Turn processing, research, training, construction, travel, and scheduled settlement. |

## Database and diagrams

| Document | Purpose |
|---|---|
| [Database Architecture](database/DATABASE_ARCHITECTURE.md) | Schema domains, table relationships, indexes, event history, and ownership boundaries. |
| [Migration and Deployment Order](database/MIGRATION_AND_DEPLOYMENT_ORDER.md) | Numeric migration order, MariaDB DDL behavior, seed data, and rollout checks. |
| [SQL Migration Catalog](source-reference/sql_migration_catalog.md) | Generated migration and schema-file inventory. |
| [Source File Catalog](source-reference/source_file_catalog.md) | Generated PHP source-file inventory with role and line count. |
| [Dashboard Route Catalog](source-reference/dashboard_route_catalog.md) | Generated route registry inventory. |
| [Service Catalog](source-reference/service_catalog.md) | Generated service class and public-method inventory. |

Editable UML and architecture source files are in [`uml/`](uml/), with rendered previews in [`uml/rendered/`](uml/rendered/) when available.

## Testing, deployment, and operations

| Document | Purpose |
|---|---|
| [Testing Strategy](testing/TESTING_STRATEGY.md) | Unit, contract, integration, UI, load, migration, and regression testing. |
| [Validation Matrix](testing/VALIDATION_MATRIX.md) | Mapping between features, tests, routes, services, and validation outcomes. |
| [Deployment Runbook](deployment/DEPLOYMENT_RUNBOOK.md) | Environment setup, database migration, server startup, health checks, and rollback guidance. |
| [Operations Runbook](operations/OPERATIONS_RUNBOOK.md) | Logs, cron jobs, troubleshooting, backups, maintenance, and incident response. |
| [Release Checklist](operations/RELEASE_CHECKLIST.md) | Pre-release, release, post-release, and documentation checks. |

## Authority and documentation rules

The repository implementation is the source of truth for current behavior. The GDD describes intended player-facing design, while implementation status labels distinguish complete, partial, architectural, and planned systems. When a formula or rule differs between an older design document and the current service layer, the current authoritative service and its tests take precedence until the design is formally changed.

All documentation changes should be linked from this index, use stable filenames, identify the affected source paths, and record whether the change affects gameplay balance, persistence, security, UI behavior, or operations.

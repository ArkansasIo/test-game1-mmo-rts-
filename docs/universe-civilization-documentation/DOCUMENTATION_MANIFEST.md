# Documentation Manifest

## Package identity

**Project:** Universe Civilization: Empire at Wars  
**Package:** Game Design, Architecture, Source, Database, UML, Testing, Deployment, and Operations Documentation  
**Root:** `docs/universe-civilization-documentation/`  
**Generated:** 2026-08-21  
**Source repository:** `/home/ubuntu/stargatewars`

## Deliverables

| Area | Files | Coverage |
|---|---|---|
| Master navigation | `README.md` | Package index and authority rules. |
| GDD | `gdd/GDD.md`, `IMPLEMENTATION_STATUS.md`, `GLOSSARY.md`, `CHANGELOG_TEMPLATE.md` | Game vision, mechanics, status, vocabulary, and maintenance format. |
| Architecture | `architecture/SYSTEM_ARCHITECTURE.md`, `SECURITY_ARCHITECTURE.md`, `DATA_AND_STATE_FLOW.md` | Runtime layers, trust boundaries, state flow, and security. |
| Gameplay | Eight documents under `gameplay/` | Economy, progression, technology, combat, universe, colonies, fleet, megastructures, social, and MMO systems. |
| Frontend | Three documents under `frontend/` | 43 routes, navigation, themes, state, forms, feedback, and responsive behavior. |
| Backend | Three documents under `backend/` | Action contracts, service layer, queues, cron, and mutations. |
| Database | Two documents under `database/` | Schema domains, ownership, events, migrations, MariaDB behavior, and deployment order. |
| Source references | Four generated catalogs plus `KEY_SOURCE_GUIDE.md` | PHP files, services, SQL files, routes, migrations, and key entry points. |
| UML | Four `.mmd` sources, UML README, four rendered PNG previews | Components, database relationships, server actions, and procedural universe. |
| Testing | `TESTING_STRATEGY.md`, `VALIDATION_MATRIX.md` | Test layers, invariants, edge cases, existing tests, and release validation. |
| Deployment | `DEPLOYMENT_RUNBOOK.md` | Fresh install, upgrade, migration, runtime, health, and rollback checks. |
| Operations | `OPERATIONS_RUNBOOK.md`, `RELEASE_CHECKLIST.md` | Logs, queues, backups, incident response, and release gates. |

## Catalog generation

The generated catalogs are produced by `tools/generate_documentation_catalogs.py`. Re-run it after adding, removing, or renaming source files, services, migrations, or registered route definitions. The generator intentionally excludes the documentation package itself from the source catalog.

## Diagram generation

Editable Mermaid files are in `uml/`. Rendered previews are derived with `manus-render-diagram` and stored under `uml/rendered/`. Edit `.mmd` sources rather than editing PNG previews.

## Authority notes

The current implementation and tests are authoritative for completed behavior. The GDD includes planned or architectural systems but labels them in the implementation-status matrix. Deuterium is documented as a first-class ninth resource; any deployed state that omits it from a resource header or cost table requires a deployment/state audit.

## Completion criteria

The package is complete when internal links resolve, all source catalogs regenerate, all Mermaid files render, every registered route has a documentation entry, implementation-status labels match current source and tests, and deployment or operations changes update the relevant runbook.

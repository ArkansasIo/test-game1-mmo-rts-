# Universe Civilization: Empire at Wars — Documentation Package Plan

## Goal

Create a dedicated documentation package for the PHP/MySQL text-based MMORPG/RTS **Universe Civilization: Empire at Wars**. The package will document the game design, source architecture, menus and pages, backend services, database schema and migrations, gameplay systems, security model, procedural universe, testing strategy, deployment process, and operational maintenance procedures.

## Documentation structure

The documentation will be organized under a dedicated repository folder, preferably `docs/universe-civilization-documentation/`, with subfolders for the GDD, architecture, gameplay systems, frontend and page contracts, backend and API references, database, UML diagrams, testing, deployment, operations, and source-file reference documentation.

The package will include a primary `GDD.md` that acts as the navigational entry point and links to focused documents. It will document the game vision, player loop, universe structure, nine-resource economy, 21-tier/23-level progression, races and governments, colonies and population, units, starships, motherships, starbases, moon bases, technology, research, combat, espionage, markets, alliances, quests, achievements, officers, seasons, NPC civilizations, expeditions, debris fields, megastructures, victory conditions, user interface, and accessibility or responsive behavior.

## Source documentation

A source-file catalog will map every relevant PHP, SQL, CSS, JavaScript, configuration, service, page module, action handler, cron job, test, tool, and documentation file to its purpose, inputs, outputs, dependencies, security requirements, and related database tables. The documentation will distinguish authoritative server logic from browser presentation logic and will identify the main entry points, including `game.php`, `actions/game.php`, authentication actions, the service layer, page registry, design catalog, procedural universe service, migration runner, and cron processing.

## Architecture and UML

The package will include Mermaid UML and architecture diagrams saved as `.mmd` files with rendered `.png` previews where useful. Planned diagrams include system context, component architecture, request and action flow, authentication and authorization flow, page/module routing, database entity relationships, resource settlement transactions, technology research flow, combat flow, procedural universe generation, fleet or expedition flow, and scheduled turn processing. Diagram source will remain editable and each diagram will be linked from the relevant Markdown document.

## Database documentation

Database documentation will catalog the complete schema, migration order, seed data, table ownership, primary and foreign keys, important indexes, resource columns including Deuterium, queue tables, event and audit tables, universe tables, technology tables, social tables, and protection or cooldown tables. It will explain MariaDB-safe non-transactional DDL migration behavior, deployment ordering, seed assumptions, rollback limitations, and data-integrity expectations.

## Page and API documentation

The documentation will describe all 43 registered dashboard routes and their menu or submenu placement. Each route entry will include purpose, UI states, controls, formulas, server actions, request fields, validation rules, permissions, affected tables, response or feedback states, and test coverage. A separate API/action reference will document authentication, CSRF, RBAC, ownership, cooldown, transaction, resource, population, queue, and protection checks.

## Testing and operations

The package will document syntax checks, page-module smoke tests, full module integration tests, route validation, combat and espionage checks, resource edge cases, Deuterium checks, load testing, UI responsive checks, database migration validation, and deployment verification. It will include runbooks for local startup, database setup, migration execution, cron configuration, log inspection, troubleshooting, backup and restoration, release checklists, and version/build metadata.

## Implementation phases after approval

1. Inventory the current repository and identify all source, SQL, page, service, test, configuration, and existing documentation files.
2. Create the dedicated documentation folder and navigation index.
3. Write the GDD and gameplay-system specifications from the implemented repository behavior and existing contracts.
4. Generate source-file, page-route, action, service, database, migration, and test catalogs.
5. Create editable UML and architecture diagram source files and render preview images.
6. Write deployment, operations, security, testing, and maintenance runbooks.
7. Cross-link documents, validate Markdown links and diagram references, and run documentation completeness checks.
8. Produce a final documentation manifest describing every generated file and any remaining design gaps or assumptions.

## Deliverables

The completed package will contain a master GDD, documentation index, source catalog, 43-route page reference, backend action/API reference, gameplay system documents, database and migration reference, UML/architecture diagrams, security model, testing guide, deployment and operations runbooks, glossary, changelog/template files, and a documentation manifest.

## Assumptions and risks

The documentation will describe the current repository implementation as the source of truth and will clearly label architectural or planned features that are not fully implemented. No undocumented gameplay behavior will be presented as complete. Existing filenames and routes will be preserved unless a documentation-only index requires aliases. Mermaid will be used for editable UML and architecture sources because it is already supported by the project utilities. PDF generation is not included unless explicitly requested; Markdown and diagram source files are the primary deliverables, with rendered PNG previews included for convenience.

## Validation plan

The documentation pass will verify that every registered route has a documentation entry, every service and migration is cataloged, every UML source file renders, internal Markdown links resolve, source paths exist, database table references are consistent with the SQL files, and implementation status labels are consistent with the current code and test results.

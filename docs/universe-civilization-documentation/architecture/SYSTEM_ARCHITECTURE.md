# System Architecture

## Runtime overview

The game is a PHP 8.1+ application using PDO against MariaDB/MySQL. The authenticated dashboard is centered on `game.php`, which loads configuration and route metadata, resolves authenticated state, serializes server data into the page, and renders the selected dashboard view through JavaScript functions. Mutations are submitted to `actions/game.php`, which validates the action context and delegates authoritative work to the service layer.

```text
Browser
  │  GET dashboard / POST intent
  ▼
game.php or actions/game.php
  │
  ├── Authentication and session state
  ├── CSRF and request validation
  ├── Route registry and page contracts
  ├── Service layer
  │     ├── economy, turns, progression
  │     ├── combat, covert, reports
  │     ├── technology, queues, training
  │     ├── colonies, universe, motherships
  │     └── social, markets, MMO expansion
  ▼
PDO / MariaDB or MySQL
  │
  ├── domain tables
  ├── queue and cooldown tables
  ├── event and audit history
  └── procedural universe records
```

## Repository layers

| Layer | Primary paths | Responsibility |
|---|---|---|
| Core configuration | `01_Core/Config/`, `config/` | Database, app metadata, rules, catalogs, route contracts, and preferences. |
| Core HTTP and security | `01_Core/Http/`, `01_Core/Security/`, `config/auth.php` | Requests, responses, routing, authentication, and security rules. |
| Gameplay foundations | `02_Gameplay/`, `includes/services/` | Formulas, game rules, combat, turns, world logic, and domain services. |
| Dashboard entry points | `game.php`, `pages/`, `includes/page_modules/` | Authenticated shell, page entry files, and modular page contract functions. |
| Action handlers | `actions/` | Authenticated mutation dispatch, redirect/feedback state, and service delegation. |
| Data layer | `sql/`, `config/database.php` | Schema, migrations, seeds, migration runner, and PDO access. |
| Scheduled processing | `cron/`, `08_Cron/` | Turn settlement and asynchronous queue processing. |
| Testing | `tests/` | Contract, integration, service, UI, load, and regression checks. |
| Documentation and tools | `docs/`, `10_Docs/`, `tools/` | Design references, generators, audits, migration tools, and operational records. |

## Request and state authority

The browser may select a route, display a form, and submit player intent. It may not authoritatively determine resource balances, combat outcomes, ownership, research completion, queue capacity, cooldown expiry, or report visibility. The server reloads the relevant row or rows, locks them when required, validates the request against current state, calculates the result, writes all affected rows in one transaction, and returns feedback or refreshed state.

Read pages are authenticated and scoped. A read-only page may load server state without mutation, but it must still apply ownership, classification, discovery, coordinate, and privacy rules.

## Transaction boundary

Each mutation should have a clear transaction boundary. Resource deductions, queue creation, ownership changes, market settlement, combat results, report creation, and event writes belong to the same atomic unit whenever possible. MariaDB DDL migrations are handled separately by the non-transactional migration runner because DDL transaction semantics vary by engine and statement.

## State model

The dashboard state is assembled from multiple domain services. Each state section should expose a predictable empty fallback and explicit feedback states so that a missing row does not become a fatal renderer error. The state payload should include only fields required for the authenticated page and should avoid leaking private or classified data.

## Extension pattern

A new feature should normally provide:

1. A migration or schema change.
2. A service with authoritative reads and mutations.
3. A page definition and route registry entry.
4. A page module with logic, features, design, systems, validation, preview, and state transition metadata.
5. A page renderer or shared renderer configuration.
6. An action-dispatch branch with authentication, CSRF, RBAC, ownership, cooldown, and transaction checks.
7. Tests and documentation updates.

## Operational topology

Development commonly runs with PHP’s built-in server bound to an exposed port and MariaDB/MySQL available through the configured PDO connection. Production deployment should use a managed PHP runtime or PHP-FPM behind a web server, a persistent database, protected environment configuration, HTTPS, scheduled jobs, and centralized logs. The deployment and operations runbooks in this package define the verification sequence.

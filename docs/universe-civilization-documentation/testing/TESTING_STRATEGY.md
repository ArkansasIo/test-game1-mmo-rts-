# Testing Strategy

## Testing layers

| Layer | Purpose | Example coverage |
|---|---|---|
| PHP syntax | Detect parse errors before runtime. | `php -l` on entry points, actions, services, modules, and tests. |
| Unit and formula | Verify deterministic calculations and edge cases. | Zero resources, negative income, max population, cost growth, modifiers. |
| Page contract | Verify route definitions, module functions, actions, state transitions, and invalid intents. | 43 page modules, valid and invalid action payloads. |
| Service integration | Verify service/database behavior with safe fixtures. | Economy, technology, combat, espionage, markets, colonies, universe. |
| UI smoke | Verify route loads, renderer selection, forms, controls, and feedback. | Dashboard, Technology branches, Armory, Universe, Social. |
| End-to-end | Verify complete user flows. | Login, turn processing, research, combat, reports, alliance, colonization. |
| Load and concurrency | Detect locks, deadlocks, duplicate settlement, and latency degradation. | 500 concurrent turn processors and contested mutations. |
| Migration | Verify schema order, idempotence, defaults, indexes, and data backfill. | Fresh install and upgrade from previous migration versions. |
| Documentation | Verify links, source paths, route coverage, and diagram rendering. | Markdown link checker, catalog regeneration, Mermaid render. |

## Existing validation artifacts

The repository contains tests for page modules, service bootstrap, design catalog, Deuterium, economy edge cases, alliance flow, combat and attack reports, covert operations, rankings, universe maps, moon registry, mothership exploration, training, markets, population, vault, and turn processing. The 43-page module integration test reports route count, module coverage, valid and invalid intents, state transitions, and action coverage.

## Required edge cases

Every resource mutation must test zero, negative, fractional where applicable, insufficient balance, exact balance, over-capacity, concurrent update, and rollback. Population must test zero population, maximum capacity, capacity overflow, assignment overflow, and training depletion. Technology must test missing key, wrong category, unmet prerequisite, full queue, exact resource cost, insufficient Naquadah, Deuterium requirements, duplicate request, and completion idempotence.

Combat must test protected target, invalid target, equal force, zero force, maximum rounds, rapid-fire cap, deterministic seed, loss bounds, debris, reports, and simultaneous attacks. Exploration must test invalid coordinates, hidden target, occupied planet, cooldown, fleet readiness, fuel, anomaly outcome, and duplicate completion.

## Regression process

Before release, run syntax checks, page-module smoke, full module integration, service boot, representative domain tests, client JavaScript syntax validation against rendered HTML, and route smoke checks. Run load tests when changing transaction boundaries, queue processing, resource settlement, or database indexes.

## Test data policy

Tests should use isolated fixtures or a dedicated test database. Production or real commander state must not be mutated by tests. Seed data should be deterministic and should include both populated and empty states. Test names should identify the invariant being protected.

## Failure handling

A failure must record command, environment, migration version, test name, relevant route or action, and safe diagnostic output. Database mutation tests should roll back or reset fixtures. Flaky tests must not be silently ignored; they should be isolated and fixed or explicitly documented with a tracked issue.

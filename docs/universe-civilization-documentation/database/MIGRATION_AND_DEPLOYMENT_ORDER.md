# Migration and Deployment Order

## Migration policy

SQL files in `sql/` use numeric prefixes to communicate execution order. A fresh installation should start from the complete schema or migration zero and apply files in ascending order. An existing installation should use the project migration runner and record completed migrations in the migration metadata table.

## Migration families

| Family | Purpose |
|---|---|
| `000`–`009` | Core database, seed data, RBAC, base game, and universe foundations. |
| `010`–`016` | Resources, progression, targets, reports, and attack foundations. |
| `017`–`028` | Markets, technology branches, training, workforce, super units, production, queues, sabotage, repair. |
| `029`–`035` | Resource exchange, rankings, defenses, mothership upgrades, metadata, population capacity. |
| `036`–`041` | Universe navigation, migration metadata, faction/unit systems, construction and production, procedural seed, ranking extensions. |
| `042`–`044` | MMO expansion, design catalog and mechanics, Deuterium resource integration. |

## MariaDB DDL behavior

DDL may implicitly commit or behave differently across MariaDB/MySQL versions. The custom migration runner therefore treats schema changes as non-transactional units, records progress, and avoids pretending that a failed DDL statement can always be rolled back. Data changes that must be atomic should be isolated in transactional application or seed steps.

## Deployment sequence

1. Back up the database and record the current migration version.
2. Put scheduled turn processing into maintenance or pause mode.
3. Verify PHP version, PDO driver, database connectivity, writable storage, and protected configuration.
4. Apply pending migrations in numeric order.
5. Run required seed or backfill scripts, including Deuterium capacity or existing-player defaults.
6. Run schema integrity and service smoke tests.
7. Start or reload PHP workers and scheduled jobs.
8. Verify login, dashboard shell, resource header, all route groups, and one representative mutation in a safe test account.
9. Resume scheduled processing and monitor logs, queue counts, migration state, and error rate.

## Rollback guidance

Schema rollback should use an explicit reverse migration or a database restore rather than ad hoc destructive SQL. Application rollback must be compatible with the current schema or must be deployed together with a forward-compatible migration. Never delete player state, events, reports, or queue records as a shortcut for resolving a failed migration.

## Post-migration checks

Confirm that every player has all nine resource columns, Deuterium capacity is non-null and bounded, technology and queue tables have expected indexes, universe hierarchy counts are valid, foreign keys are intact, and cron processors can read active queues. Run the documented tests before accepting player traffic.

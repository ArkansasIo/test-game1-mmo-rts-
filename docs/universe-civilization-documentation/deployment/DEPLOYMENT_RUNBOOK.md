# Deployment Runbook

## Prerequisites

Use PHP 8.1 or newer with PDO and the configured MariaDB/MySQL driver. Provide a database, protected environment configuration, writable storage for logs or generated artifacts, and a scheduler for turn processing. Do not expose credentials in source control.

## Fresh installation

1. Clone or unpack the repository into the deployment directory.
2. Configure database connection, session settings, application metadata, and environment secrets.
3. Create the database and least-privilege application user.
4. Apply the schema or run migrations in numeric order.
5. Apply seed data and required backfills.
6. Verify migration metadata and required indexes.
7. Create or verify the initial commander fixture only in a non-production environment.
8. Run PHP syntax, service bootstrap, page module, and database smoke tests.
9. Configure the web server or PHP-FPM and scheduled jobs.
10. Verify login, dashboard, resource header, route groups, and a safe read-only page.

## Upgrade installation

Back up the database and record current migration version before applying pending migrations. Pause turn processing, apply migrations with the project runner, run Deuterium and resource backfill checks, restart or reload PHP workers, run validation tests, and resume scheduled processing only after queue and event checks pass.

## Runtime verification

| Check | Expected result |
|---|---|
| PHP version | PHP 8.1+ and required extensions available. |
| Database connection | PDO connects with the configured user. |
| Migration state | All intended migrations recorded as applied. |
| Login | Valid account logs in; invalid credentials fail safely. |
| Dashboard | `game.php` loads without PHP or JavaScript errors. |
| Resource header | Metal, Crystal, Deuterium, Naquadah, Energy, Dark Matter, Food, Water, and Population are represented where state is available. |
| Technology | Tree and branch routes render; upgrade form is CSRF-protected. |
| Cron | Turn processor runs once and writes expected event or log. |
| Logs | Errors are visible to operators without exposing secrets to players. |

## Rollback

If application code must be rolled back, confirm that the previous release supports the current schema. If the schema migration cannot be safely reversed, restore the database backup into a controlled environment and verify event, queue, resource, and ownership invariants before switching traffic.

## Release artifacts

Record release version, build number, Git commit, migration version, test output, deployment time, operator, rollback point, and known limitations. Update the changelog and implementation-status document.

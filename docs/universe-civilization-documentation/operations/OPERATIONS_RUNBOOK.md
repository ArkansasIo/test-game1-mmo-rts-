# Operations Runbook

## Daily health checks

Review application errors, database connectivity, queue depth, turn processor status, migration metadata, failed events, market expiries, exploration missions, and storage usage. Confirm that active queue counts are plausible and that no player resource or population values violate configured bounds.

## Logs

The main useful operational sources are the PHP server log, application event history, cron output, migration output, and database error log. Logs should include timestamp, environment, action or job, authenticated player or safe correlation ID, result, latency, and error class without exposing credentials or classified payloads.

## Queue operations

Research, construction, production, training, repair, fleet travel, exploration, and mission queues should be processed by status and completion time. Processing must be idempotent: a repeated job should not grant the same reward or apply the same level twice. Stuck records should be investigated from their status transition and event history before manual repair.

## Turn processor

Pause or disable the scheduler before emergency database work. Inspect the last successful turn event, lock duration, failed players, retry count, and settlement invariants. Re-run only through the supported job or a documented recovery script. Never manually subtract or grant resources without recording an auditable event.

## Backups

Perform regular database backups including schema, data, migration metadata, event history, queues, universe ownership overlays, and configuration references. Test restoration in an isolated environment. A backup is not considered valid until authentication, dashboard state, resource balances, active queues, and recent events are verified after restore.

## Incident response

1. Identify whether the issue affects authentication, reads, mutations, queues, database integrity, or security.
2. Preserve logs, migration version, build number, and relevant event IDs.
3. Pause affected scheduled jobs or mutations if state corruption is possible.
4. Reproduce in a safe environment using the documented test fixture.
5. Apply the smallest safe fix or rollback.
6. Validate resources, ownership, queues, reports, and event continuity.
7. Resume traffic gradually and monitor.
8. Update the changelog, implementation status, and incident record.

## Common symptoms

| Symptom | First checks |
|---|---|
| Page falls back to Command Center | Route metadata, JavaScript syntax, page state key, renderer function. |
| Resource missing from header | SQL select, state serialization, design catalog, deployed source freshness. |
| Upgrade says action failed | CSRF, authenticated session, technology key, prerequisites, queue capacity, Naquadah/Deuterium balance. |
| Queue repeats reward | Completion status transition, unique event, idempotent job condition. |
| Map hides valid world | Coordinate parser, discovery record, scan permission, ownership filter. |
| Market settlement mismatch | Order lock, price/fee calculation, seller ownership, transaction history. |
| Combat result disputed | Deterministic seed, resolver inputs, battle event, round log, protection and cooldown state. |

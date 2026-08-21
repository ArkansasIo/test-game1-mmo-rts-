# Cron and Queue Reference

## Scheduled responsibilities

Scheduled processing settles turns and due queue records. Responsibilities include resource production and upkeep, research completion, construction, unit training, unit production, weapon repair, fleet travel, exploration, missions, market expiry, debris expiry, quest or achievement progress, season rollover, and NPC behavior where implemented.

## Job requirements

Every job must identify its selection window, status transition, lock strategy, retry behavior, completion event, and failure handling. Due records should be processed in bounded batches to avoid long locks. Jobs must be safe to resume after a process crash.

## Idempotency

A queue row may be selected more than once by a retry or concurrent worker. The job must lock the row, verify active status, apply the effect once, set the completed or failed state, write an event, and commit. A completed row must not grant the same reward, level, resource, or achievement again.

## Turn processing

`process_turns` calls the service layer to settle player state. It must calculate production and upkeep from owned colonies and current modifiers, settle queues and missions whose time has elapsed, update rankings or events when required, and return refreshed state. A concurrent double request must not duplicate income or consume turns incorrectly.

## Monitoring

Operators should monitor last run time, duration, processed count, failure count, retry count, queue depth, lock wait, deadlocks, and event continuity. Alerts should trigger when a job is stale, repeatedly failing, or accumulating an abnormal queue backlog.

## Manual recovery

Manual recovery should use a documented tool or service command that preserves transaction and event rules. Direct SQL corrections should be a last resort, require a backup, and write a corrective audit event. Never mark a queue complete without verifying the expected domain state.


## 30-minute turn processor implementation

The deployable schedule is `cron/universe-civilization-turns.cron`, which invokes `cron/process_turns.php --json` at minutes 0 and 30 of every hour. The CLI entry point uses a filesystem lock to prevent overlapping workers and delegates state work to `TurnProcessorService`.

A processor run uses `floor(unix_timestamp / turn_interval_seconds)` as its deterministic `turn_number`. The unique key on `game_turns.turn_number` prevents a completed interval from being applied twice. Runs are written as `started`, then changed to `completed` or `failed` with a JSON summary. Per-commander outcomes are recorded in `turn_events`; operational JSON lines are appended to `storage/logs/turn-processing.log`.

Use `php cron/process_turns.php --dry-run --json` to verify configuration without mutation. Use `--player=<id>` for a scoped operational retry or test run. Production installation must use the deployment environment's PHP path and project root rather than assuming the sandbox path in the example cron file.

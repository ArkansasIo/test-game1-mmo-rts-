# Universe Civilization: Empire at Wars Turn-Processing Operations

The canonical job is `cron/process_turns.php`. The categorized entrypoint at `08_Cron/TurnProcessing/process_turns.php` delegates to the same implementation so both deployment paths use identical logic.

## Manual checks

Run a non-mutating database and player-count check:

```bash
php cron/process_turns.php --dry-run --json
```

Process one player during controlled testing:

```bash
php cron/process_turns.php --player=1 --json
```

The processor exits with code `75` when another copy already holds the exclusive lock. It exits with code `1` when one or more player settlements fail, and writes the failure details to the structured log.

## Production schedule

Run the job from the project root every five minutes through the host's scheduler:

```cron
*/5 * * * * cd /home/ubuntu/stargatewars && /usr/bin/php cron/process_turns.php --json >> /home/ubuntu/stargatewars/storage/logs/turn-processing.stdout.log 2>&1
```

The job creates `storage/turn-processing.lock` and `storage/logs/turn-processing.log`. The lock prevents overlapping settlements; each completed run appends one JSON record containing duration, players, turns, and errors.

## Safety model

The PHP service remains the authority for resource settlement, queue completion, fleet arrivals, and event writes. The cron wrapper only selects players, serializes execution, records operational telemetry, and invokes the existing transactional service. Do not call database mutation statements directly from the scheduler.

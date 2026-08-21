# Universe Civilization: Empire at Wars 500-Player Turn Load Test

## Scope

This benchmark exercised **500 logical players** processing turns through the real `GameService::processTurns()` implementation. The test created isolated temporary player and resource fixtures, forced two due turn intervals, launched up to 120 independent database workers at a time, measured each transaction, and removed all fixtures after completion.

The MySQL server is configured with `max_connections=151` and `innodb_lock_wait_timeout=50`. A 120-worker ceiling was therefore used to exercise concurrent row locking without intentionally exceeding the database connection capacity. The test still covered all 500 players and completed every transaction.

## Result

| Metric | Result |
|---|---:|
| Logical players requested | 500 |
| Workers completed | 500 |
| Successful turn transactions | 500 |
| Failed transactions | 0 |
| Total elapsed time | 0.587 seconds |
| Worker launch/join interval | 0.440 seconds |
| Latency p50 | 33.198 ms |
| Latency p95 | 56.007 ms |
| Maximum latency | 63.074 ms |
| Reported errors | None |
| Temporary fixtures remaining | 0 |

## Interpretation

The turn processor completed all 500 isolated player transactions without lock timeout, deadlock, rollback failure, or resource mutation error. Each player used an independent PDO session, and the test verified cleanup after the run. The benchmark is intentionally repeatable through:

```bash
php tests/turn_load_500.php 500 120
```

The second argument controls the concurrent database worker ceiling and should remain below the configured MySQL connection limit when running alongside the web server and scheduled jobs.

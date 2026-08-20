# Storage / Logs

This module defines the storage contract for operational and gameplay logs that must not be mixed with player-facing reports.

## Log categories

| Category | Purpose | Retention |
|---|---|---|
| `gameplay` | Turn settlement, combat, fleet, queue, and discovery lifecycle | Long-term summary; detailed payload subject to archival |
| `audit` | Authentication, permission, ownership, CSRF, admin, and state-change records | Long-term |
| `security` | Login failures, suspicious request patterns, blocked players, and rate limits | Long-term |
| `cron` | Turn-worker start, lock, batch, failure, retry, and completion records | Operational retention |
| `database` | Migration, integrity, constraint, and connection failures | Operational retention |
| `performance` | Query duration, queue latency, and settlement duration | Short-term metrics |

## Rules

Logs are written server-side with an authenticated player ID when available, a request ID, event name, entity type and ID, timestamp, and structured JSON payload. Passwords, session tokens, CSRF values, and raw secrets must never be written. Player-facing reports should be generated from gameplay tables such as `battle_reports`, `intelligence_reports`, `messages`, and `game_events`; operational logs remain restricted to administrators and maintainers.

## Expected interfaces

```php
AuditLogger::record(string $event, ?int $playerId, array $context): void;
AuditLogger::security(string $event, ?int $playerId, array $context): void;
AuditLogger::cron(string $event, array $context): void;
AuditLogger::performance(string $queryName, float $durationMs, array $context): void;
```

The current project uses `game_audit_log`, `game_events`, and audit payloads in transactional services. Future log adapters should preserve those event names and correlation IDs so turn-worker and API diagnostics remain searchable.

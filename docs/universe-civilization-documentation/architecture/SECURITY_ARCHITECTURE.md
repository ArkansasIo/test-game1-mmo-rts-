# Security Architecture

## Security objective

The game treats the browser as an untrusted intent client. The server is the authority for identity, permissions, ownership, resource balances, cooldowns, protection, queue state, combat, exploration, research, market settlement, and reports.

> A valid browser request is not automatically a valid game action. Every mutation must be revalidated against current server state.

## Trust boundaries

| Boundary | Threat | Required control |
|---|---|---|
| Browser to PHP | Forged or altered form values | Authentication, CSRF, strict input validation, server-side recalculation. |
| Player to another player | Unauthorized access to targets, reports, messages, or colonies | Ownership, classification, public/private field filtering, RBAC, privacy rules. |
| Concurrent requests | Double spend, duplicate queue, stale ownership, race conditions | Row locks, transaction boundaries, unique constraints, cooldown checks. |
| Scheduled job to database | Repeated settlement or partial queue completion | Idempotent job logic, status transitions, event records, retry policy. |
| Admin or operator to production | Accidental destructive changes | Migration ordering, backups, least privilege, audit logs, release checklist. |

## Authentication and sessions

Login and registration actions establish the authenticated commander session. Protected pages must reject unauthenticated access before loading private state. Session identifiers should use secure cookie settings, session regeneration on authentication, inactivity controls where appropriate, and explicit logout invalidation.

All private state must be scoped to the authenticated player identifier. A submitted `player_id` must never override the authenticated identity for a normal player action.

## CSRF protection

Every state-changing form must include the application CSRF field and every action handler must verify it before mutation. GET requests should not perform state-changing work. CSRF failure should return a safe feedback state and should not disclose internal database details.

## RBAC and ownership

Role-based permissions are applied in addition to ownership. Examples include alliance role permissions, commander eligibility, researcher access, market seller ownership, report recipient ownership, colony ownership, mothership ownership, and public ranking visibility. Ownership checks should be performed inside the service transaction after locking the relevant row when a concurrent change could affect the decision.

## Input validation

Input validation includes type, range, enumeration, format, existence, cross-field compatibility, and business-rule validation. Negative amounts are rejected. Quantities, prices, coordinates, IDs, categories, technology keys, mission types, levels, and durations are all validated against allowlists or bounded numeric domains.

The server recalculates prices, costs, effects, travel times, damage, detection, production, and rewards from authoritative records. Client-provided totals are ignored.

## Resource and queue safeguards

Resource deductions lock the player resource row before checking the balance. Queue mutations check capacity, duplicate active work, cooldowns, prerequisites, and ownership. Unique indexes should prevent duplicate active records where the domain requires one. Deuterium must be treated like every other first-class resource in validation and settlement, including advanced ship and research requirements.

## Protection and cooldowns

Vacation mode, DefCon, active combat, mission cooldowns, exploration cooldowns, research queue limits, market expiry, and account eligibility are server-side controls. Protection state must be checked before attacks, covert missions, colonization, or other actions that could affect a protected commander.

## Transaction and audit policy

A mutation should commit domain changes and the corresponding event or audit record atomically. On any exception, the transaction rolls back. Error messages presented to players should be safe and actionable; logs may contain a correlation identifier and technical detail without exposing secrets.

## Data exposure

Public pages may expose only public fields. Classified intelligence, private messages, session data, resource balances, hidden coordinates, and internal identifiers must be filtered. Discovery and map pages must return only records permitted by scan power, coordinate scope, discovery state, and ownership classification.

## Secrets and configuration

Database credentials, session secrets, API tokens, and deployment settings must remain outside source control or in protected environment configuration. Production error display should be disabled, while structured logs should remain available to operators. Migration and seed tools should use least-privilege credentials and should be run only in the intended environment.

## Security testing

The test suite should cover unauthenticated access, invalid CSRF, unauthorized ownership, invalid IDs, negative values, stale cooldowns, insufficient resources, duplicate queue attempts, protected targets, report classification, market settlement, and concurrent transactions. Security regressions must block release when they can change ownership, resources, combat outcomes, or private data visibility.

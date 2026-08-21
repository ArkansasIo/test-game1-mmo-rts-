# Backend Action Reference

## General mutation contract

The browser submits a player intent to `actions/game.php`. The handler requires an authenticated user and valid CSRF, selects the action branch, validates request fields, and delegates to an authoritative service. Services reload current state, apply ownership and permission rules, lock rows when needed, perform calculations, write domain changes and events, and commit atomically.

## Action groups

| Action group | Representative actions | Core validation |
|---|---|---|
| Turns and command | `process_turns`, `read_military_stats`, `set_defcon` | Auth, player identity, cooldown, protection, bounded level. |
| Economy | `deposit`, `withdraw` | Auth, CSRF, non-negative amount, balance, vault rules, transaction. |
| Technology | `technology` | Technology key, category, prerequisites, queue capacity, resources, level cap. |
| Training | `train`, `upgrade_up` | Unit type, quantity, population, academy, queue, resources. |
| Combat | `combat`, `combat:raid`, `combat_preview` | Target, protection, turns, readiness, force, cooldown, resources. |
| Covert | `covert`, `covert:recon`, `covert:spy`, `covert:sabotage` | Target, mission type, agents, detection, cooldown, protection. |
| Reports | `read_report`, `message_read`, `legacy_message_read` | Report/message ownership, classification, read state. |
| Armory | `weapon_buy`, `weapon_repair`, `inspect_durability` | Type, quantity, ownership, durability, cost, resources. |
| Market | `market_list`, `market_buy` | Seller ownership, order, quantity, price, expiry, funds, fees. |
| Universe | scan, explore, claim, coordinate actions | Coordinate validity, discovery, scan permission, target, cooldown. |
| Colonies | `explore`, `colonize_planet`, `planet_defense` | Habitability, occupancy, colony ownership, capacity, cost, queue. |
| Social | alliance, message, blacklist, rankings actions | Membership, role, recipient, rate limit, public-data scope. |
| Account | race, government, vacation, ascension | Eligibility, cooldown, protection, progression, glory, transaction. |

## Safe response behavior

Action handlers should set a safe feedback state and redirect to an approved route. They should not echo raw exception text, SQL fragments, secrets, or private identifiers. A failed action must leave all protected state unchanged and should write an operational log entry when appropriate.

## Action-specific notes

### Technology

The `technology` action resolves the technology category from the database key, then delegates to the matching branch service. This prevents a client from claiming that a technology belongs to another branch. The service validates prerequisites, queue capacity, resource balance, cost, and transaction state.

### Combat and covert

Combat and covert actions must validate the target and protection state again at commit time. Preview endpoints must not mutate battle, resources, or reports. Final resolution must write an event and report in the same transaction as losses, loot, cooldown, or damage.

### Markets

Listing moves or reserves the seller’s resource or item according to market design. Buying locks the order, checks available quantity and funds, settles seller and buyer, applies fee, updates remaining quantity, and records a transaction. Expired or cancelled orders cannot be purchased.

### Colonization and exploration

The service checks coordinate hierarchy, target existence, habitability, occupancy, colony capacity, mothership readiness, travel, cooldown, and resource cost. Discovery and ownership information is scoped to the commander.

## Database and event requirements

Each mutation entry should identify its affected tables in the route catalog and should write an event when it changes player-visible or competitive state. New actions require a page module contract, test cases, documentation entry, and migration if schema changes are needed.


## Implementation update: authenticated action boundary

The authenticated mutation boundary is implemented in `actions/game.php`. It requires an authenticated session, rejects non-POST requests, verifies the session CSRF token, validates the requested redirect against an allowlist, dispatches to domain services, and stores only a user-safe feedback state in the session. Raw exception details are written to the server log and are not exposed to the commander.

Account creation is now atomic across player creation, initial resources, faction selection, government history, and registration events. The faction registration service is transaction-aware so it can participate in an outer registration transaction without attempting nested PDO transactions.

## Implementation update: 30-minute processor

`cron/process_turns.php` now delegates to `includes/services/TurnProcessorService.php`. The service reads `game_settings.turn_interval_seconds`, defaults to 1800 seconds, claims an auditable `game_turns` record, settles due commanders through `GameService::processTurns`, records per-player `turn_events`, writes a JSON summary, and marks the run completed or failed. Existing filesystem locking prevents overlapping CLI workers, while the unique `game_turns.turn_number` record makes repeated execution of the same interval idempotent after completion.

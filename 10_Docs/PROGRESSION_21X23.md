# Universe Civilization: Empire at Wars Universal Progression

Universe Civilization: Empire at Wars uses one progression contract for players, buildings, technologies, units, fleets, defenses, colonies, mothership systems, exploration, diplomacy, races, and governments. Each entity has **21 tiers**, each tier has **23 levels**, and the complete progression range is **483 global levels**.

## Global level formula

`global_level = ((tier - 1) * 23) + level`

The first level is Tier 1 / Level 1 / Global 1. The final level is Tier 21 / Level 23 / Global 483. Level costs and effects are seeded in `progression_levels`; player-owned state is stored in `progression_entities`; prerequisite relationships are stored in `progression_prerequisites`; and every successful advance is recorded in `progression_events`.

## Server authority

`includes/services/ProgressionService.php` validates tier and level boundaries, locks the progression entity and resource row with `FOR UPDATE`, verifies resources, deducts costs transactionally, advances the entity, and records an audit event. The secure POST route is `progression_advance` in `actions/game.php`; it is protected by authentication, CSRF validation, redirect allow-listing, and the service transaction boundary.

## Dashboard integration

The Command Center preview now displays the current tier, tier name, level, global level, progress percentage, effect modifier, and the server-authoritative **Advance player level** intent. The browser submits intent only; the PHP service remains responsible for validation and state mutation.

## Import and verification

Use the canonical sequence `sql/000_complete_database.sql` through `sql/015_universal_progression_21x23.sql`. The local MariaDB service is available on `127.0.0.1:3306`; PHP connects through the dedicated development user configured in `config/config.php` and `01_Core/Config/config.php`.

The verified database state is:

| Check | Result |
|---|---:|
| Progression tiers | 21 |
| Progression levels | 483 |
| Players | 3 |
| Demo account | `demo_commander` present |
| Demo authentication | `StargateDemo!2026` verified |
| PHP PDO connection | Working |
| Login smoke test | Redirected to Command Center |

The demo account is intended for local development only. Replace the development database credentials before deploying publicly.

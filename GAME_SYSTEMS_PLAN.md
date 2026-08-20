# StargateWars Game Systems Implementation Plan

## Current foundation

The current project provides a PHP/MySQL shell with authentication, sessions, CSRF protection, rank-based route guards, a sidebar, dashboard cards, seeded races, players, resources, menu items, page content, planets, technologies, target realms, and a static interactive preview. It does not yet execute game actions or persist gameplay events beyond the initial player/resource rows.

## Core rules to implement first

| System | Main state | Core actions | Primary safety rule |
|---|---|---|---|
| Turn engine | player turns, last processed turn, global interval | process due turns | process each interval once per player |
| Economy | Naquadah, bank, miners, lifers, UP | collect income, bank, withdraw, upgrade UP | transactional balance checks |
| Personnel | untrained, attack, defense, super units, spies, anti-spies | train, untrain where allowed, upgrade | never allow negative units |
| Technology | technology levels and costs | purchase upgrade | lock row and debit atomically |
| Combat | attacks, raids, casualties, weapons, reports | attack target, raid | turns, protection, cooldown, and target validation |
| Covert | spy/sabotage missions, detection, DefCon | recon, spy, sabotage, alert changes | covert capacity and cooldown validation |
| World | planets, bonuses, defenses, exploration | acquire, upgrade, conquer, explore | ownership and conquest cooldown rules |
| Social | alliances, members, messages, recruitment | join, leave, invite, send message | membership and recipient validation |
| Market | orders, trades, mercenaries | list, buy, sell, recruit | market turns and escrow consistency |
| Progression | rank, glory, reputation, ascension | score changes, ascend | requirements and irreversible confirmation |
| Protection | PPT, vacation, anti-abuse | activate/deactivate protection | block offensive actions while protected |
| Audit | battle, spy, event, economy logs | append event | immutable event rows with actor and timestamp |

## Initial implementation order

1. Add a normalized migration for turn state, unit detail, weapons, technology levels, planets, combat targets, missions, alliances, messaging, market orders, progression, protection, and audit events.
2. Add a PDO transaction helper and domain services under `includes/services/`.
3. Add secure POST action endpoints under `actions/` with CSRF validation and authenticated player ownership checks.
4. Add dashboard and module forms that call those endpoints and display persisted results.
5. Add a CLI turn processor suitable for cron, with idempotent interval processing.
6. Add deterministic test fixtures and smoke-test scripts.

## Formula baseline

The first playable rules use the specification's documented baseline: 30-minute turns; generation below 4,000 stored attack turns; 10,000 maximum attack turns; natural income of untrained units multiplied by 20 plus miners/lifers multiplied by 80; Goa'uld income bonus; UP upgrade cost equal to current UP multiplied by 5,000 plus 10,000; and rank-based route access.

## Deferred production-hardening work

Before public deployment, add database migrations with version tracking, stricter rate limiting, login attempt throttling, password reset, email verification, admin audit review, job locking for the turn processor, database backups, and full integration tests.

# StargateWars Game Architecture and Folder Design

## Runtime model

The project uses a server-authoritative PHP/MySQL model. Browser pages render the current state and submit player intent. Actions validate authentication, CSRF, permissions, ownership, resource availability, cooldowns, and request shape before calling a transactional service. MySQL remains the source of truth for player, colony, fleet, combat, universe, and progression state.

| Layer | Folder | Responsibility |
|---|---|---|
| Web pages | `pages/` | Authenticated PHP entrypoints that delegate to the shared renderer |
| Shared layout | `includes/` | Session bootstrap, PDO access, navigation, helpers, service classes, and page rendering |
| Commands | `actions/` | POST-only, CSRF-protected state changes |
| Core | `01_Core/` | Configuration, security, HTTP, and database foundations |
| Gameplay | `02_Gameplay/` | Combat, covert play, turns, planets, market, mothership, ascension, and universe rules |
| Player | `03_Player/` | Account, resources, units, weapons, technology, rankings, and progression |
| Social | `04_Social/` | Alliances, commanders, officers, recruitment, and messages |
| Intelligence | `05_Intelligence/` | Spying, sabotage, and reports |
| API | `06_API/` | Thin JSON adapters for frontend or external clients |
| Database | `07_Database/` and `sql/` | Schema, migrations, seeds, indexes, and read models |
| Workers | `08_Cron/` and `cron/` | Turn settlement, queue completion, fleet arrivals, rankings, and event processing |
| Runtime | `09_Storage/` and `storage/` | Logs and generated runtime artifacts |
| Documentation | `10_Docs/` and `docs/` | Design contracts, formulas, operational guides, and implementation status |

## Page contract

Every page is represented in `config/page_registry.php`. Its metadata identifies the title, layout family, controls, server actions, and database tables. `config/page_designs.php` defines reusable sections and expected states such as loading, ready, empty, protected, insufficient-funds, cooldown, success, and error.

## Game Command Center contract

The Command Center preview exposes resource counters, colony life support, building and research queues, fleet missions, world events, and server-action feedback. The preview data is deterministic for visual testing, while production pages read from MySQL through the authenticated layout and service layer.

## Action contract

POST commands target `actions/game.php` and include a CSRF token, action name, safe redirect, and validated payload. Services perform row locks and transactions. Successful results write flash feedback; failures roll back and return an error message without partial state.

## Worker contract

The turn worker should settle a bounded number of elapsed turns, process colony food and water, complete construction and research queues, settle fleet arrivals and returns, refresh rankings, emit notifications, and write audit events. It must be safe to retry and must not process the same settlement window twice.

## PHP server

Development server:

```bash
cd /home/ubuntu/stargatewars
php -S 0.0.0.0:8094
```

Main preview:

```text
/modular-pages-preview.php
```

The preview is a game-like browser shell, while `index.php?page=dashboard` is the authenticated production-style Command Center route.

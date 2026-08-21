# Full-Stack Implementation Status

The Universe Civilization: Empire at Wars project now contains a connected frontend and backend surface for all current navigation routes.

## Frontend

The authenticated left-side shell is implemented in `includes/layout.php` with white background, black text, nested menus, active states, resource HUD, rank display, flash messages, and logout. `index.php` provides server-rendered workflows for dashboard, resources, income, military statistics, account information, race selection, training, targets, covert operations, technology, weapons, repairs, mothership, planets, alliances, messages, market, mercenaries, rankings, vacation, and ascension. The `pages/` directory contains stable entrypoints for every navigation page and alias.

## Backend

`actions/game.php` is the POST action controller. It validates CSRF tokens, uses an internal redirect allowlist, requires an authenticated player, and dispatches transactional services. `GameService.php` handles turns, economy, training, technology, weapons, repairs, mothership upgrades, combat, covert missions, DefCon, deposits, withdrawals, and race changes. `WorldService.php` handles planets, social systems, market orders, mercenaries, rankings, vacation, ascension, alliances, messages, and related world operations. `Rules.php` centralizes positive-value validation, protection checks, and anti-farming rules.

## Configuration and settings

`config/config.php` provides PDO and environment constants. `config/settings.php` provides defaults and database overrides from `game_settings`, including turn timing, caps, income constants, message limits, alliance capacity, planet capacity, and attack limits.

## Database

`sql/000_complete_database.sql` is the canonical 54-table schema. `sql/001_complete_seed.sql` seeds all documented races, settings, navigation items, page metadata, technologies, weapon types, mercenaries, demo players, player state, planets, target realms, and rankings. Earlier migrations are retained for legacy installations.

## Runtime requirement

PHP 8.1+ with `pdo_mysql` and MySQL/MariaDB are required for server-side execution. The sandbox used for construction does not include PHP, so runtime PHP linting and database integration tests must be run on the deployment server.

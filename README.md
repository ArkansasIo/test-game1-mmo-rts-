# StargateWars PHP/MySQL Interface

This starter application provides a white-background, black-text StargateWars command interface with a persistent left sidebar, nested submenu navigation, dashboard cards, module pages, and a MySQL schema foundation.

## Requirements

Use PHP 8.1 or newer with PDO MySQL enabled, MySQL 8 or MariaDB, and a web server such as Apache, Nginx, or PHP's built-in development server.

## Installation

1. Create the database by importing `sql/schema.sql` into MySQL.
2. Update `config/config.php` with the database host, database name, username, and password.
3. Place the `stargatewars` directory in the web root, or run `php -S localhost:8080` from the project directory.
4. Open `login.php` to sign in, or `register.php` to create a new commander account. The seeded demo account is `demo` with password `demo123` after importing the original schema. Change this password before production use.
5. Open `preview.html` directly in a browser to view the dashboard and navigation wireframe without requiring PHP.

## PDO database configuration

Edit `config/config.php` and set the four connection constants to match the MySQL server:

```php
const DB_HOST = '127.0.0.1';
const DB_NAME = 'stargatewars';
const DB_USER = 'your_mysql_user';
const DB_PASS = 'your_mysql_password';
```

The application creates a PDO connection using the MySQL driver, `utf8mb4`, exception mode, and associative fetch mode. Confirm that PHP has the `pdo_mysql` extension enabled. On a local MySQL installation, the default host is usually `127.0.0.1`; use the database server hostname when PHP and MySQL run in separate containers or machines. Do not commit production credentials to source control.

## Importing the complete SQL database

For a new installation based on the full reverse-engineered specification, use the canonical schema and seed pair:

```bash
mysql -u root -p < sql/000_complete_database.sql
mysql -u root -p stargatewars < sql/001_complete_seed.sql
```

`000_complete_database.sql` creates the full database model, including players, races, wallets, turns, units, weapons, technology, covert and anti-covert state, motherships, modules, planets, bonuses, defenses, commanders, officers, alliances, recruitment, market orders, private trades, mercenaries, battles, battle participants, reports, spy and sabotage missions, intelligence, rankings, glory, reputation, ascension, protection, vacation, messages, blacklists, turn events, game events, audit logs, supporter status, and exploration.

`001_complete_seed.sql` inserts the four races, race modifiers, rank definitions, turn settings, complete left navigation, page metadata, technologies, weapons, mercenary contracts, demo commanders, resources, motherships, protection records, planets, planetary bonuses, targets, and initial rankings.

The older files remain available for incremental installs created during earlier development:

```bash
mysql -u root -p < sql/schema.sql
mysql -u root -p stargatewars < sql/002_seed_subpage_data.sql
mysql -u root -p stargatewars < sql/003_rbac_ranks.sql
mysql -u root -p stargatewars < sql/004_game_systems.sql
mysql -u root -p stargatewars < sql/005_test_scenario.sql
```

Do not run the legacy sequence after the canonical schema unless you are intentionally upgrading an older database, because some legacy migrations alter tables that already contain the newer columns. If your MySQL client cannot connect over the default socket, add `-h 127.0.0.1` to each command.

## Authentication

The application now uses PHP sessions with regenerated session IDs after login, HTTP-only and SameSite cookies, CSRF tokens for login and registration forms, `password_hash()` for new passwords, and `password_verify()` for login. Protected pages redirect unauthenticated visitors to `login.php`; `logout.php` destroys the session and redirects back to login. For production, use HTTPS, change the database credentials, remove or rotate the demo account, and add rate limiting and email verification.

## Role-based access control

Ranks are stored as `players.rank_level` and `players.rank_name`. The current route policy is defined in `config/auth.php`: Initiates have standard access, Officers can access sabotage, alliances, modules, planet conquest, and black-market pages, and Commanders can additionally access ascension. The `require_route_access()` guard runs before rendering the main application, so a user cannot bypass the restriction by manually changing the `page` query parameter. The demo account is seeded as a Commander for testing.

## Database migration

After importing `sql/schema.sql`, run `sql/002_seed_subpage_data.sql`. The migration adds page content, planets, technology levels, and target realms for the sub-pages.

## Navigation

The left navigation includes Command Center, Attack, Armory, Training, Technology, Intelligence, Market, Social, Planets, Mothership, and Account. Every main section contains nested subpages. Routes are query-string based, for example `?page=targets` and `?page=planet-bonuses`.

## Game logic foundation

The service layer is in `includes/services/`. `GameService.php` provides idempotent turn processing, income generation, unit training, Unit Production upgrades, technology purchases, combat resolution, casualty and loot handling, battle reports, covert missions, detection results, and intelligence reports. `WorldService.php` provides planet exploration, planet defense upgrades, alliance creation, messaging, vacation mode, ranking refresh, and ascension checks. Secure POST requests are handled by `actions/game.php`, which validates the session and CSRF token before calling the services.

To run the scheduled turn processor every 30 minutes on Linux, add a cron entry similar to:

```cron
*/30 * * * * /usr/bin/php /path/to/stargatewars/cron/process_turns.php >> /var/log/stargatewars-turns.log 2>&1
```

The turn processor is designed to be safe to run repeatedly: each player uses `last_turn_at` and only receives due intervals. Keep the CLI job behind the server environment and never expose it as a public URL.

## Next implementation steps

The schema includes players, races, resources, menu items, and the main entities recommended for later development, including weapons, technologies, planets, alliances, battles, espionage, messages, rankings, ascension, protection, and event logs. The next functional layer should add authentication, CSRF protection, server-side action handlers, and the 30-minute turn processor.

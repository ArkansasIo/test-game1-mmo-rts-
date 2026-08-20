# Dedicated PHP Page Entrypoints

Every route in the left navigation has a corresponding PHP file in this directory. The files are stable entrypoints that redirect to the authenticated front controller at `index.php?page=...`, preserving the shared sidebar, RBAC, CSRF-aware forms, flash notices, and database loading.

## Route groups

| Group | Page files |
|---|---|
| Command Center | `dashboard.php`, `resources.php`, `income.php`, `military-stats.php`, `account-info.php`, `race.php` |
| Training | `units.php`, `miners.php`, `unit-production.php`, `super-units.php` |
| Technology and Armory | `technology.php`, `weapons.php`, `weapon-market.php`, `repair.php` |
| Combat and Intelligence | `targets.php`, `attack-log.php`, `spy.php`, `sabotage.php` |
| Planets and Mothership | `planets.php`, `planet-list.php`, `planet-bonuses.php`, `planet-defenses.php`, `exploration.php`, `mothership.php`, `ship.php`, `modules.php` |
| Social and Economy | `alliances.php`, `messages.php`, `resource-exchange.php`, `mercenary-market.php`, `rankings.php` |
| Account and Progression | `vacation.php`, `ascension.php` |

The `planets.php` and `ship.php` files are convenience aliases for the corresponding navigation modules. Route-specific rendering remains in `index.php`, so the visual design and authorization rules stay consistent across every page.

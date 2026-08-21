# Universe Civilization: Empire at Wars Full-Stack Surface Map

This document maps every visible page and control to the server-side action and database state it uses. The application keeps the presentation layer in `index.php` and the reusable shell in `includes/layout.php`; the dedicated files in `pages/` are stable route entrypoints that redirect into the authenticated front controller.

## Frontend navigation and page map

| Menu | Sub-page | Main controls | Backend action or data |
|---|---|---|---|
| Command Center | Dashboard | Choose target, open training, review reports | `targets`, `units`, `attack-log` routes |
| Command Center | Account Information | View identity and progression | `players`, `races`, `rankings`, `ascension_states` |
| Command Center | Resources | Deposit, withdraw, inspect wallet | `deposit`, `withdraw`; `player_resources` |
| Command Center | Income | Review natural income and modifiers | `game_setting`, race, planets, DefCon, relationships |
| Command Center | Military Scores | Inspect army, covert, and derived scores | `player_resources`, `player_unit_stats`, rankings |
| Attack | Targets | Select target, choose turns, attack or raid | `combat`; `battles`, `battle_reports`, `attack_logs` |
| Attack | Spy | Select target and agents, run recon/spy | `covert`; `spy_missions`, `covert_missions`, `intelligence_reports` |
| Attack | Sabotage | Select target, agents, and target system | `covert`; `sabotage_missions`, `covert_missions` |
| Attack | Attack Log | Read attack results | `battles`, `battle_reports`, `attack_logs` |
| Armory | Weapons | Buy weapons and inspect durability | `weapon_buy`; `player_weapons`, `weapon_types` |
| Armory | Buy / Sell | List or buy weapon-market orders | `market_list`, `market_buy`; `market_orders` |
| Armory | Repair | Repair damaged inventory | `weapon_repair`; `player_weapons`, wallet |
| Training | Units | Train miners, attack, defense, spy, anti-spy | `train`; `player_resources` |
| Training | Miners | Train economic workforce | `train` with `miners` |
| Training | Super Units | Train elite units | `train` with super-unit types |
| Training | Unit Production | Upgrade population generation | `upgrade_up`; `player_resources` |
| Technology | Offense/Defense/Covert/Anti-Covert | Purchase branch upgrades | `technology`; `player_technologies`, `technologies` |
| Intelligence | Spy Log / Enemy Intelligence | Read covert operations and reports | `covert_missions`, `intelligence_reports` |
| Market | Resource Exchange | List and purchase resource orders | `market_list`, `market_buy`; `market_orders` |
| Market | Mercenary Market | Recruit mercenary contract | `mercenary_buy`; `mercenary_types`, `player_mercenaries` |
| Social | Rankings | Refresh and inspect scores | `refresh_rankings`; `rankings`, `rank_snapshots` |
| Social | Alliances | Create and join alliances | `alliance_create`, `alliance_join`; `alliances`, `alliance_members` |
| Social | Messages | Send and mark messages read | `message`, `message_read`; `messages` |
| Planets | Planet List | View owned worlds | `player_planets` |
| Planets | Bonuses | Inspect planetary modifiers | `planet_bonuses` |
| Planets | Defenses | Upgrade defense installations | `planet_defense`; `planet_defenses` |
| Mothership | Ship / Modules | Upgrade vessel and modules | `mothership_upgrade`; `motherships`, `mothership_modules` |
| Mothership | Exploration | Explore for new worlds | `explore`; `planet_explorations`, `player_planets` |
| Account | Race | Change race | `change_race`; `players`, `races` |
| Account | Vacation | Enable temporary protection | `vacation`; `vacation_states`, `protection_states` |
| Account | Ascension | Check eligibility and ascend | `ascend`; `ascension_states`, `ascensions` |

## Backend layers

| Layer | Files | Responsibility |
|---|---|---|
| Configuration | `config/config.php`, `config/settings.php` | PDO, environment constants, default settings, database-backed settings |
| Authentication | `config/auth.php`, `login.php`, `register.php`, `logout.php` | Sessions, password verification, CSRF, current player, rank guards |
| Layout | `includes/layout.php`, `assets/app.css` | White/black dashboard shell, menu tree, notices, player HUD |
| Front controller | `index.php` | Page route dispatch and server-rendered content |
| Action controller | `actions/game.php` | POST-only action validation, CSRF, allowlisted redirects, service calls |
| Game services | `includes/services/GameService.php`, `WorldService.php`, `Rules.php` | Transactions, formulas, combat, economy, covert, worlds, social, anti-abuse |
| Scheduled processing | `cron/process_turns.php` | 30-minute turn processing and event logging |
| Dedicated entrypoints | `pages/*.php` | Stable direct URLs for all navigation pages |
| Database | `sql/000_complete_database.sql`, `sql/001_complete_seed.sql` | Canonical schema and seed data |

## Security and server-side rules

All state-changing controls submit an intent rather than a resulting value. Naquadah, turns, units, weapon power, combat outcomes, ownership, rankings, Glory, Reputation, and Ascension are calculated on the server. Every state-changing form must include the session CSRF token, and every action must validate the current authenticated player, input ranges, rank permission, protection state, and anti-abuse rules before opening a transaction.

## Server settings

`config/settings.php` reads the defaults from `DEFAULT_GAME_SETTINGS` and overrides them with rows from `game_settings`. This allows operators to tune turn interval, turn caps, income, market limits, daily messages, alliance capacity, planet capacity, and attack-farming limits without changing PHP source code.

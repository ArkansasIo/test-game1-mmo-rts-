# StargateWars Categorized Project Structure

The original working files remain at the project root for compatibility. The categorized directories provide a clean modular organization for future development and deployment.

## 01_Core

`Config/` contains application, database, PDO, and game-settings configuration. `Http/` contains request, response, and router primitives. `Database/` contains repository connections. `Security/` contains authentication, CSRF, RBAC, and reusable validation rules.

## 02_Gameplay

`Combat/` contains combat formulas and deterministic resolution. `Covert/` contains spy, recon, sabotage, and detection engines. `Turns/` contains turn formulas and scheduled processing contracts. `Planets/`, `Ascension/`, `Market/`, and `Mothership/` are reserved for world-specific domain services and engines. Shared service implementations remain available under `02_Gameplay/` and the original `includes/services/` path.

## 03_Player

This category owns Authentication, Resources, Units, Weapons, Technology, and Rankings. The visible pages are served through the `pages/` entrypoints and the front controller; their domain responsibilities belong in these subcategories.

## 04_Social

Alliances, Commanders, Officers, Messages, and Recruitment define player relationships, income distribution, officer roles, alliance membership, communications, and recruitment workflows.

## 05_Intelligence

Spying, Sabotage, and Reports define reconnaissance, covert operations, detection, intelligence payloads, attack reports, and audit-readable outcomes.

## 06_API

The API category separates authentication, player, combat, training, armory, intelligence, market, social, planet, mothership, and ascension endpoint concerns. The legacy `actions/game.php` remains the secure form-action controller while modular HTTP classes are available under `src/Http/`.

## 07_Database

`Schema/` contains the canonical 54-table schema, `Seeds/` contains the complete seed data, `Migrations/` contains ordered legacy and scenario migrations, and `Views/` and `Indexes/` are reserved for reporting views and deployment-specific indexes.

## 08_Cron

`TurnProcessing/` contains the 30-minute turn worker. The worker should run from CLI only and write to `09_Storage/Logs/` or a system log.

## 09_Storage

This category stores runtime logs and generated operational files. Do not expose it as a public web directory.

## 10_Docs

Documentation includes the database manifest, full-stack map, feature reference, implementation status, public reference notes, schema testing guide, category structure, and optional asset attribution.

## Frontend style layers

`assets/master.css` defines layout, typography, grid, navigation, forms, tables, buttons, notices, and responsive behavior. `assets/modules/` contains module-level styles for combat, economy, social, planets, intelligence, and armory. `assets/app.css` remains the legacy application stylesheet and can be loaded with the master stylesheet during transition.

## Page and submenu hierarchy

The left navigation is organized as Command Center, Attack, Armory, Training, Technology, Intelligence, Market, Social, Planets, Mothership, and Account. Each parent expands to child pages such as Targets, Spy, Sabotage, Weapons, Repair, Units, Miners, Technology branches, Reports, Resource Exchange, Alliances, Messages, Planet Bonuses, Modules, Vacation, and Ascension.

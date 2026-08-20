# StargateWars Complete Dashboard Page Details

The StargateWars dashboard uses a common PHP page contract while each page family exposes its own game mechanics, controls, state reads, writes, permissions, and result states.

> The client submits intent only. PHP validates the authenticated commander, CSRF token, permissions, ownership, cooldowns, balances, and current game state before committing a transaction.

## Page-family contract

| Family | Detail panels | Core mechanic | Primary state |
|---|---|---|---|
| Income Breakdown | Base income, faction modifiers, colony production, upkeep | Production minus upkeep | `ready`, `empty`, `protected`, `error` |
| Military Statistics | Attack, defense, covert, readiness | Units multiplied by technologies and faction modifiers | `ready`, `protected`, `cooldown`, `error` |
| Target Selection | Realms, protection, combat preview, costs | Deterministic server combat resolver | `ready`, `protected`, `insufficient-resource`, `cooldown`, `success`, `error` |
| Spy Operations | Agents, detection, intelligence, result | Detection and payload calculation | `ready`, `protected`, `insufficient-resource`, `cooldown`, `success`, `error` |
| Sabotage Operations | Systems, agents, detection, damage | Validated sabotage mission and report | `ready`, `protected`, `cooldown`, `success`, `error` |
| Attack Reports | Battle outcomes, spy payloads, read state | Recipient ownership and report classification | `loading`, `ready`, `empty`, `success`, `error` |
| Weapon Inventory | Catalogue, quantity, durability, assignments | Effective power with durability and technology | `ready`, `insufficient-resource`, `success`, `error` |
| Weapon Market | Orders, prices, fees, settlement | Quantity times price plus market fee | `ready`, `empty`, `insufficient-resource`, `cooldown`, `success`, `error` |
| Weapon Repair | Durability, repair cost, resource check | Missing durability times tier factor | `ready`, `insufficient-resource`, `success`, `error` |
| Training | Population, queue, unit categories | Population conversion and training cost | `ready`, `insufficient-resource`, `cooldown`, `success`, `error` |
| Unit Production | Current level, next cost, upgrade result | Base cost times growth rate | `ready`, `insufficient-resource`, `queued`, `success`, `error` |
| Technology | Branches, prerequisites, queue, effects | Base cost times level growth | `ready`, `locked`, `insufficient-resource`, `queued`, `success`, `error` |
| Rankings | Leaderboards and snapshots | Weighted economy, military, covert, and progression score | `loading`, `ready`, `empty`, `success`, `error` |
| Alliances and Diplomacy | Members, roles, proposals, activity | Proposal to accepted active relationship | `ready`, `protected`, `success`, `error` |
| Messages | Inbox, unread, compose, blacklist | Validated messaging and notification lifecycle | `loading`, `ready`, `empty`, `success`, `error` |
| Planets | Portfolio, biome, defenses, life support | Production minus food/water upkeep | `ready`, `empty`, `protected`, `insufficient-resource`, `success`, `error` |
| Mothership | Hull, weapons, shields, hangars, modules | Ship readiness and capacity | `ready`, `insufficient-resource`, `queued`, `success`, `error` |
| Exploration | Discovery, scan, anomaly, reward | Exploration level plus sensors and anomaly rate | `ready`, `cooldown`, `success`, `error` |
| Account | Race, government, protection, security | Race modifier times government modifier | `ready`, `protected`, `success`, `error` |
| Progression | Experience, rank, Glory, Reputation, ascension | Threshold-based progression | `ready`, `locked`, `protected`, `success`, `error` |
| Galaxies | Density, sectors, travel risk | Sector danger and distance | `loading`, `ready`, `empty`, `error` |
| Sectors | Class, danger, resources, anomalies | Resource modifier and event rate | `loading`, `ready`, `empty`, `error` |
| Solar Systems | Star, orbits, planets, anomalies | Travel modifier and scan | `loading`, `ready`, `empty`, `cooldown`, `success`, `error` |
| Universe Planets | Class, biome, habitability, occupancy | Colony viability and occupancy lock | `ready`, `occupied`, `protected`, `insufficient-resource`, `success`, `error` |
| Moons | Class, biome, sensors, jump gate | Sensor and jump-gate utility | `ready`, `empty`, `occupied`, `success`, `error` |
| Coordinate Search | Hierarchical coordinate results | Validated galaxy:sector:system:orbit parsing | `ready`, `empty`, `invalid-input`, `error` |

## Shared server-action lifecycle

Each state-changing form posts to `actions/game.php` with a CSRF token, an action name, a safe redirect route, and only the user intent fields. The action controller resolves the authenticated user, validates the request, delegates to a service, executes the transaction, writes audit or event records, and redirects with success or error feedback.

## Shared page sections

Every page should expose a concise summary, current-state metrics, primary controls, database contract, permission contract, active queues or reports, and an explicit result-state area. Read-only pages may omit forms but must still explain their data source and access rule.

## Source of truth

The structured page metadata is maintained in:

- `config/page_registry.php` for routes and navigation.
- `config/page_designs.php` for reusable visual layouts.
- `config/page_runtime_specs.php` for mechanics, permissions, reads, writes, and actions.
- `config/dashboard_page_details.php` for detailed dashboard panels, formulas, and feedback states.
- `config/page_feature_contracts.php` for feature-level form and state contracts.

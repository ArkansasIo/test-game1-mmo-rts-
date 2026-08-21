# Dashboard 43-Route Reference

## Shared route contract

Every authenticated route is registered in `config/page_registry.php`, described in `config/page_route_details.php`, backed by a page definition and page module, and rendered by `game.php` or an intentional shared fallback. The browser submits navigation and action intent; server state remains authoritative.

## Command Center

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `dashboard` | Command Center | Resources, colony overview, queues, missions, progression, alerts, turn processing. | `process_turns`; players, resources, rankings, events. |
| `account-info` | Account Information | Commander identity, rank, race, government, protection, session status. | Read-only; players, races, rankings, glory. |
| `resources` | Resources & Vault | Nine-resource ledger, Naquadah vault, deposits, withdrawals, capacities. | `deposit`, `withdraw`; resources, settings. |
| `income` | Income Breakdown | Production, race/government/technology modifiers, upkeep, net settlement. | Read-only or refresh; resources, colonies, settings. |
| `military-stats` | Military Statistics | Attack, defense, covert, anti-covert, readiness, DefCon. | `read_military_stats`, `set_defcon`; units, rankings, protection, events. |

## Attack

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `targets` | Target Selection | Target board, protection, combat preview, attack, raid, covert, message. | `combat`, `covert`, `explore`, `message`; realms, battles, reports. |
| `spy` | Spy Operations | Agent allocation, detection, reconnaissance, spy mission. | `covert`; missions, agents, reports. |
| `sabotage` | Sabotage Operations | Target system, damage ceiling, detection risk, sabotage result. | `covert`; covert and sabotage records. |
| `attack-log` | Attack Log & Reports | Battle outcomes, unread reports, loot/losses, audit state. | `message_read`; battles, reports, logs. |

## Armory

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `weapons` | Weapon Inventory | Owned weapons, durability, power, readiness, catalogue. | `weapon_buy`, inspection; weapon types, inventory, resources. |
| `weapon-market` | Weapon Market | Order book, price limits, listing, settlement, trade history. | `market_list`, `market_buy`; orders, transactions. |
| `repair` | Weapon Repair | Missing durability, repair cost, queue estimate, restoration. | `weapon_repair`; weapons, types, resources, queues. |

## Training

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `units` / `training` | Unit Training | Roster, academy, recruitment, population, training queue. | `train`, `upgrade_up`; unit types, stats, queues, resources. |
| `miners` | Miners & Lifers | Civilian workforce, assignments, morale, support load, output. | `train` or assignment contract; colonies, assignments, resources. |
| `super-units` | Super Units | Elite prerequisites, strategic cost, power, readiness. | `train`; unit types, technologies, resources. |
| `unit-production` | Unit Production | Production tracks, automation modifier, upgrade level, slots. | `upgrade_up`; production, technology, queues. |

## Technology

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `technology` | Technology Tree | All branches, prerequisites, level, cost, effects, queue. | `technology`; technologies, prerequisites, player technologies, queues. |
| `tech-offense` | Offense Technology | Weapon systems and offensive effects. | `technology`; offense technology and weapon systems. |
| `tech-defense` | Defense Technology | Shields, fortification, defense effects. | `technology`; defense technology and queues. |
| `tech-covert` | Covert Technology | Agent systems and infiltration effects. | `technology`; covert technology and reports. |
| `tech-anti-covert` | Anti-Covert Technology | Detection and counter-intelligence effects. | `technology`; anti-covert technology and reports. |

## Intelligence

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `spy-log` | Spy Log | Missions, detection outcomes, classified payloads, read state. | `message_read`; covert missions and reports. |
| `enemy-intelligence` | Enemy Intelligence | Known targets, confidence, freshness, classification. | Read-only; reports, players, target realms. |

## Market

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `resource-exchange` | Resource Exchange | Resource orders, rates, limits, settlement preview. | `market_list`, `market_buy`; market and resources. |
| `mercenary-market` | Mercenary Market | Mercenary roster, contract duration, cost, deployment. | `mercenary_buy`; mercenary tables and resources. |

## Social

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `rankings` | Rankings | Commander ladder, weighted score, movement, snapshots. | `refresh_rankings`; rankings, snapshots, glory. |
| `alliances` | Alliances | Identity, members, capacity, diplomacy, projects. | `alliance_create`, `alliance_join`; alliances and members. |
| `messages` | Messages | Inbox, sent messages, read status, blacklist. | `message`, `message_read`, blacklist; messages and players. |

## Planets

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `planet-list` | Planet List | Owned colonies, life support, production, fleet, exploration, colonization. | `explore`, `combat`, `colonize_planet`, `planet_defense`. |
| `planet-bonuses` | Planet Bonuses | Biome, buildings, morale, applied production. | Read-only; bonuses, colonies, universe planets. |
| `planet-defenses` | Planet Defenses | Defense grid, shields, garrison, upgrade queue. | `planet_defense`; defenses, units, resources. |

## Mothership

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `ship` | Mothership | Hull, hangars, shields, capacity, upgrade queue. | `mothership_upgrade`; motherships and modules. |
| `modules` | Mothership Modules | Installed modules, power draw, effects, slots. | `mothership_upgrade`; modules and motherships. |
| `exploration` | Exploration | Expeditions, travel time, risk, discovery, results. | `explore`; motherships, expeditions, universe planets. |

## Account

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `race` | Race Selection | Race profiles, government compatibility, selection, reform. | `change_race`, faction actions; races and players. |
| `vacation` | Vacation Mode | Protection, activation, cooldown, return schedule. | `vacation`; vacation and protection states. |
| `ascension` | Ascension | Eligibility, glory, tier transition, permanent bonuses. | `ascend`; ascension, progression, glory. |

## Universe

| Route | Page | Responsibilities | Actions / tables |
|---|---|---|---|
| `galaxies` | Galaxy Map | Galaxy selector, sector distribution, ownership, filters. | `universe_galaxies`; universe hierarchy and discovery. |
| `sectors` | Sector Map | Systems, signals, travel lanes, scan results. | `universe_sectors`; sectors, systems, motherships, technology. |
| `solar-systems` | Solar Systems | Planets, lanes, gates, scan telemetry, anomalies. | `system_map`, `explore`; systems, planets, moons, discoveries. |
| `universe-planets` | Universe Planets | Planet catalogue, biome, slots, colonization preview. | `planet_details`, `colonize_planet`; universe planets and colonies. |
| `moons` | Moon Registry | Moons, orbital bonuses, gates, construction. | `moon_details`, `mothership_upgrade`; moons, planets, modules. |
| `coordinates` | Coordinate Search | Validated hierarchy lookup and navigation. | `coordinate_lookup`; universe hierarchy, discoveries, colonies. |

## Shared feedback states

Routes should represent at least the states declared by their page contract. Common states are `loading`, `ready`, `empty`, `locked`, `protected`, `insufficient-resource`, `cooldown`, `invalid-input`, `queued`, `success`, and `error`. State rendering must be safe when lists are empty and must not expose database exceptions.

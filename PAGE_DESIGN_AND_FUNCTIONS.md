# StargateWars Page Design and Function Map

## Shared page shell

Every authenticated page uses the shared shell: left navigation, active menu state, commander HUD, resource summary, page heading, flash/error notice, content modules, and responsive controls. State-changing forms post to `actions/game.php`, include a CSRF token, carry an allow-listed redirect page, and receive a session flash result.

## Core page map

| Page | Main design | Controls | Backend function | SQL domains |
|---|---|---|---|---|
| Dashboard | Metrics, turns, income, alerts, recent events | Process turns, open reports, choose target | `GameService::processTurns()` | `players`, `player_resources`, `rankings`, `game_events` |
| Resources | Resource cards, vault balance, income bars | Deposit, withdraw, set DefCon | `deposit()`, `withdraw()`, `setDefcon()` | `player_resources`, `game_settings` |
| Account | Profile, rank, race, protection | Change race, activate vacation | `changeRace()`, `activateVacation()` | `players`, `races`, `vacation_states`, `protection_states` |
| Training | Unit rows with quantity and available pool | Train miners, lifers, attack, defense, spies | `train()` | `player_resources`, `game_events` |
| Unit Production | Upgrade card with cost preview | Upgrade Unit Production | `upgradeUnitProduction()` | `player_resources`, `game_events` |
| Technology | Category tabs and level cards | Buy technology level | `buyTechnology()` | `technologies`, `player_technologies`, `player_resources` |
| Armory | Inventory table and durability badges | Buy and repair weapons | `buyWeapon()`, `repairWeapons()` | `weapon_types`, `player_weapons` |
| Targets | Target table with score, protection, and action buttons | Attack, raid, spy, sabotage | `resolveCombat()`, `covertMission()` | `players`, `player_resources`, `battles`, `covert_missions` |
| Attack Log | Battle report list and detail panel | Open report, mark read | report query, `markMessageRead()` | `battles`, `battle_reports`, `attack_logs` |
| Spy / Sabotage | Mission form, agent count, detection warning | Recon, spy, sabotage | `covertMission()` | `covert_missions`, `intelligence_reports` |
| Planets | Planet cards and bonus rows | Explore, upgrade defense | `explore()`, `upgradePlanetDefense()` | `planets`, `player_planets`, `planet_bonuses`, `planet_defenses` |
| Mothership | Module grid with current level and cost | Upgrade hull, bays, hangars, weapons, shields | `upgradeMothership()` | `motherships`, `mothership_modules` |
| Market | Order book with quantity and price | List order, purchase order | `listMarketOrder()`, `buyMarketOrder()` | `market_orders`, `private_trades`, `player_resources` |
| Social | Alliance summary, messages, rankings | Create/join alliance, send/read message | `createAlliance()`, `joinAlliance()`, `sendMessage()`, `markMessageRead()` | `alliances`, `alliance_members`, `messages`, `rankings` |
| Ascension | Requirement checklist and confirmation | Ascend | `ascend()` | `ascensions`, `glory_reputation`, `player_resources` |

## OGame-style page map

| Page | Main design | Controls | Backend function | SQL domains |
|---|---|---|---|---|
| Colonies | Colony selector, population, morale, coordinate cards | Select colony, process tick | `OGameService::processColonyTurn()` | `colonies`, `colony_turn_snapshots` |
| Food & Water | Stock meters, hourly formula, shortage banner | Process tick, choose production policy | `processColonyTurn()` | `player_resource_balances`, `game_resource_types`, `colonies` |
| Population | Capacity bar, growth forecast, morale | View growth, manage residential queue | `queueBuilding()` | `colonies`, `colony_buildings`, `building_types` |
| Resource Buildings | Building cards with level and cost | Queue build or upgrade | `queueBuilding()` | `building_types`, `colony_buildings`, `construction_queue` |
| Life Support | Farm and water processor cards | Queue farm/processor | `queueBuilding()` | `building_types`, `colony_buildings` |
| Shipyard | Fleet-type rows with stats and build cost | Queue fleet | queue handler / `construction_queue` | `fleet_types`, `colony_fleets`, `construction_queue` |
| Defense Grid | Defense cards with attack/defense values | Queue defense | queue handler / `construction_queue` | `defense_types`, `colony_defenses`, `construction_queue` |
| Research | Research tree, levels, costs, completion timers | Queue research | research queue handler | `research_types`, `player_research`, `construction_queue` |
| Fleet Overview | Hangar inventory and cargo summary | Split fleet, select mission | fleet service | `fleet_types`, `colony_fleets` |
| Fleet Dispatch | Source/target selectors, mission type, payload | Launch transport, attack, raid, colonize, explore, recycle, espionage | `launchMission()` | `fleet_missions`, `colonies`, `game_events` |
| Mission Log | Status table with ETAs | Open, cancel, return | mission settlement service | `fleet_missions`, `game_events` |
| World Events | Active event banners and rewards | Join event, view history | event service | `game_world_events`, `game_events` |

## Server-side invariants

The server owns resource amounts, unit counts, combat scores, research levels, queue completion, mission arrival, population, food, water, planet ownership, alliance membership, rankings, and Ascension state. Every mutating function validates the authenticated player, ownership, positive quantities, allowed enum values, permissions, protection and vacation state, cooldowns, and available resources before opening a transaction.

Every transaction locks the rows it will change, updates state, writes an audit/game event, and commits. Any exception rolls back. The frontend displays the returned flash result but never calculates an authoritative outcome.

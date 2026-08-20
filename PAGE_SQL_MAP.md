# StargateWars Page → SQL Mapping

This map connects each frontend page family to the database domains it reads or mutates. Browser controls submit intent; PHP services calculate outcomes and persist the result.

## Command Center

| Page | SQL domains |
|---|---|
| Dashboard | `players`, `races`, `player_resources`, `rankings`, `game_events`, `game_settings` |
| Resources & Vault | `player_resources`, `player_resource_balances`, `game_resource_types`, `game_settings` |
| Income | `player_resources`, `player_resource_balances`, `races`, `colonies`, `colony_turn_snapshots` |
| Military Statistics | `player_resources`, `player_unit_stats`, `rankings`, `battle_reports` |
| Account Information | `players`, `races`, `rankings`, `glory_reputation`, `audit_logs` |

## Attack and Intelligence

| Page | SQL domains |
|---|---|
| Targets | `target_realms`, `players`, `player_resources`, `battles` |
| Attack / Raid | `battles`, `battle_reports`, `attack_logs`, `player_resources`, `game_events` |
| Spy | `covert_missions`, `spy_missions`, `intelligence_reports`, `player_resources` |
| Sabotage | `covert_missions`, `sabotage_missions`, `intelligence_reports`, `game_events` |
| Attack Log | `battles`, `battle_reports`, `attack_logs`, `game_events` |
| Spy Log | `covert_missions`, `intelligence_reports`, `game_events` |

## Armory and Training

| Page | SQL domains |
|---|---|
| Weapon Inventory | `weapon_types`, `player_weapons`, `player_resources` |
| Weapon Market | `market_orders`, `weapon_types`, `player_resources` |
| Repair | `player_weapons`, `weapon_types`, `player_resources`, `game_events` |
| Units | `player_resources`, `player_unit_stats` |
| Miners / Lifers | `player_resources`, `races`, `game_settings` |
| Super Units | `player_resources`, `technologies`, `player_technologies` |
| Unit Production | `player_resources`, `construction_queue`, `game_events` |
| Technology | `technologies`, `player_technologies`, `research_types`, `player_research`, `construction_queue` |

## Market and Social

| Page | SQL domains |
|---|---|
| Resource Exchange | `market_orders`, `private_trades`, `player_resources` |
| Mercenary Market | `mercenary_types`, `player_mercenaries`, `player_resources` |
| Rankings | `rankings`, `rank_snapshots`, `players`, `glory_reputation` |
| Alliances | `alliances`, `alliance_members`, `alliance_applications`, `game_events` |
| Commanders / Officers | `players`, `officer_relationships`, `recruitment_records`, `game_events` |
| Messages | `messages`, `blacklists`, `audit_logs` |

## Planets, Motherships, and OGame-style expansion

| Page | SQL domains |
|---|---|
| Planet List | `planets`, `player_planets`, `colonies`, `planet_explorations` |
| Planet Bonuses | `planet_bonuses`, `player_planets`, `colonies` |
| Planet Defenses | `planet_defenses`, `defense_types`, `colony_defenses`, `construction_queue` |
| Colonies | `colonies`, `player_resource_balances`, `colony_turn_snapshots` |
| Food & Water | `game_resource_types`, `player_resource_balances`, `colonies`, `colony_turn_snapshots` |
| Buildings | `building_types`, `colony_buildings`, `construction_queue` |
| Shipyard | `fleet_types`, `colony_fleets`, `construction_queue` |
| Fleet Missions | `fleet_missions`, `colonies`, `colony_fleets`, `battles` |
| Mothership | `motherships`, `mothership_modules`, `player_resources` |
| Modules | `mothership_modules`, `motherships`, `player_resources` |
| Exploration | `motherships`, `planets`, `planet_explorations`, `fleet_missions` |

## Account and Progression

| Page | SQL domains |
|---|---|
| Race | `players`, `races`, `audit_logs` |
| Vacation | `vacation_states`, `protection_states`, `players` |
| Supporter | `players`, `supporter_status`, `game_events` |
| Protection / PPT | `protection_states`, `players`, `game_events` |
| Delete Account | `players`, `audit_logs`, `game_events` |
| Ascension | `players`, `ascensions`, `glory_reputation`, `player_resources`, `ascension_states` |
| World Events | `game_world_events`, `game_events`, `fleet_missions`, `colony_turn_snapshots` |

## Server-side rule

The browser never submits authoritative resources, combat results, ranking values, planet ownership, or population totals. It submits an action and bounded parameters. PHP validates the session, CSRF token, permission, target, cooldown, and resource availability, then calculates and persists the outcome inside a transaction.

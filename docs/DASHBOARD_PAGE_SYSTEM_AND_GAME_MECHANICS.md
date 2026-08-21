# Universe Civilization: Empire at Wars Dashboard, Pages, and Game Mechanics

## Shared page lifecycle

Every dashboard and sub-page follows the same server-authoritative lifecycle:

> **Render current state → submit player intent → authenticate → validate CSRF and permissions → validate ownership and resources → run a transaction → write state and audit event → redirect with result feedback.**

The browser never decides combat results, resource settlement, fleet arrivals, construction completion, espionage outcomes, or colony ownership.

## Page-family mechanics

| Page family | Main mechanics | State sources | State-changing actions |
|---|---|---|---|
| Command Center | Turn processing, resource summary, colony status, queues, missions, alerts | `players`, `player_resources`, `player_colonies`, `construction_queue`, `fleet_missions`, `rankings`, `game_events` | `process_turns` |
| Economy | Metal, Crystal, Naquadah, Energy, Dark Matter, food, water, income, vault | `player_resources`, `player_colonies`, `dark_matter_transactions` | `deposit`, `withdraw`, `colony_turn` |
| Training | Unit conversion, personnel specialization, production level | `player_resources`, `player_unit_stats` | `train`, `upgrade_up` |
| Technology | Offense, defense, covert, anti-covert, prerequisites, research queues | `technologies`, `player_technologies`, `construction_queue` | `technology`, `queue_building` |
| Combat | Target selection, power calculation, casualties, loot, battle reports | `target_realms`, `battles`, `battle_participants`, `battle_reports`, `attack_logs` | `combat`, `planet_defense` |
| Intelligence | Reconnaissance, spying, sabotage, detection, reports | `covert_missions`, `spy_missions`, `sabotage_missions`, `intelligence_reports` | `covert`, `message_read` |
| Armory | Weapon purchase, inventory, durability, repair, market | `weapon_types`, `player_weapons`, `market_orders` | `weapon_buy`, `weapon_repair`, `market_list`, `market_buy` |
| Colonies | Population, food, water, morale, buildings, defenses, exploration | `universe_planets`, `universe_moons`, `player_colonies`, `construction_queue` | `colonize_planet`, `colony_turn`, `queue_building`, `planet_defense`, `explore` |
| Fleet | Fleet payloads, travel time, mission arrival, return, cargo | `fleet_types`, `colony_fleets`, `fleet_missions` | `launch_mission` |
| Universe | Galaxy, sector, system, planet, moon, coordinates, anomalies | `universe_galaxies`, `universe_sectors`, `universe_solar_systems`, `universe_planets`, `universe_moons` | `explore`, `colonize_planet` |
| Social | Alliances, diplomacy, trades, messages, recruitment, rankings | `alliances`, `alliance_members`, `diplomacy_relations`, `trade_contracts`, `messages`, `rankings` | `alliance_create`, `alliance_join`, `diplomacy_propose`, `trade_create`, `message`, `refresh_rankings` |
| Progression | Experience, levels, Glory, Reputation, vacation, ascension | `player_progression`, `glory_reputation`, `rank_definitions`, `ascensions`, `protection_states` | `add_experience`, `ascend`, `vacation`, `change_race` |

## Dashboard modules

The Command Center combines five resource counters, colony overview, life support, active construction/research/shipyard queues, building status, fleet missions, command alerts, and a page-contract panel. The preview uses deterministic state for visual testing. The authenticated dashboard uses `DashboardService` to query live data when PDO and MySQL are available.

## Permission model

Actions require an authenticated session and CSRF token. Services must additionally verify player ownership, target visibility, rank requirements, cooldowns, resource balances, fleet availability, and colony or moon relationships. Administrative and worker-only operations must not be exposed through ordinary player forms.

## Failure and result states

Each page must represent at least the following states: loading, ready, empty, protected, invalid input, insufficient resources, cooldown, ownership failure, successful transaction, and rolled-back error. Flash feedback is suitable for redirect-based PHP pages; JSON result envelopes are suitable for API adapters.

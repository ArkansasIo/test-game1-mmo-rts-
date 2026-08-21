# Dashboard Route Catalog

The dashboard is a server-authenticated, JavaScript-driven shell. The registry below is the navigation contract for the active dashboard routes. Each route must have a page definition, page module, route metadata, and a renderer or intentional fallback.

| Route | Title | Layout | Controls | Actions | Tables |
|---|---|---|---|---|---|
| `dashboard` | Command Center | dashboard | Process turns, Choose target, Review reports | process_turns | players, player_resources, rankings, game_events |
| `account-info` | Account Information | details | View profile, View rank, View protection | — | players, races, rankings, glory_reputation |
| `resources` | Resources & Vault | economy | Deposit, Withdraw | deposit, withdraw | player_resources, game_settings |
| `income` | Income Breakdown | breakdown | View income formula | — | player_resources, races, player_planets, game_settings |
| `military-stats` | Military Statistics | stats | View attack, View defense, View covert | — | player_resources, player_unit_stats, rankings |
| `targets` | Target Selection | targets | Attack, Raid, Spy, Sabotage, Conquer Planet, Message | combat, covert, explore, message | target_realms, players, battles |
| `spy` | Spy Operations | covert | Run reconnaissance, Run spy mission | covert | covert_missions, spy_missions, intelligence_reports |
| `sabotage` | Sabotage Operations | covert | Choose system, Run sabotage | covert | covert_missions, sabotage_missions |
| `attack-log` | Attack Log & Reports | reports | Open report, Mark read | message_read | battles, battle_reports, attack_logs |
| `weapons` | Weapon Inventory | inventory | Buy weapon, Inspect durability | weapon_buy | weapon_types, player_weapons |
| `weapon-market` | Weapon Market | market | List order, Buy order | market_list, market_buy | market_orders, weapon_types |
| `repair` | Weapon Repair | repair | Repair weapon | weapon_repair | player_weapons, player_resources |
| `units` | Unit Training | training | Train units | train, upgrade_up | unit_types, player_unit_stats, training_queues, player_resources, game_events |
| `miners` | Miners & Lifers | training | Train miners | train | player_resources |
| `super-units` | Super Units | training | Train elite units | train | player_resources, technologies |
| `unit-production` | Unit Production | upgrade | Upgrade UP | upgrade_up | unit_types, player_unit_stats, training_queues, player_resources, game_events |
| `technology` | Technology Tree | technology | Upgrade offense, Upgrade defense, Upgrade covert, Upgrade anti-covert | technology | technologies, player_technologies |
| `tech-offense` | Offense Technology | technology | Upgrade | technology | technologies, player_technologies |
| `tech-defense` | Defense Technology | technology | Upgrade | technology | technologies, player_technologies |
| `tech-covert` | Covert Technology | technology | Upgrade | technology | technologies, player_technologies |
| `tech-anti-covert` | Anti-Covert Technology | technology | Upgrade | technology | technologies, player_technologies |
| `spy-log` | Spy Log | reports | Open report, Mark read | message_read | covert_missions, intelligence_reports |
| `enemy-intelligence` | Enemy Intelligence | reports | Open intelligence report | — | intelligence_reports |
| `resource-exchange` | Resource Exchange | market | List order, Buy order | market_list, market_buy | market_orders, player_resources |
| `mercenary-market` | Mercenary Market | market | Recruit, Sell | mercenary_buy | mercenary_types, player_mercenaries |
| `rankings` | Rankings | rankings | Refresh rankings, Open player | refresh_rankings | rankings, rank_snapshots |
| `alliances` | Alliances | social | Create alliance, Join alliance, Leave alliance | alliance_create, alliance_join | alliances, alliance_members |
| `messages` | Messages | messages | Send, Mark read, Blacklist | message, message_read | messages, blacklists |
| `planet-list` | Planet List | planets | Explore, Colonize, Upgrade defense | explore, combat, colonize_planet, planet_defense | player_colonies, planet_bonuses, planet_explorations, player_resources, universe_planets, planet_defenses, motherships, player_cooldowns, game_events |
| `planet-bonuses` | Planet Bonuses | planets | View bonuses | — | planet_bonuses |
| `planet-defenses` | Planet Defenses | planets | Upgrade defense | planet_defense | planet_defenses |
| `ship` | Mothership | ship | Upgrade hull, Upgrade hangars, Upgrade shields | mothership_upgrade | motherships |
| `modules` | Mothership Modules | ship | Upgrade module | mothership_upgrade | mothership_modules |
| `exploration` | Exploration | exploration | Explore planet | explore | motherships, planet_explorations |
| `race` | Race Selection | account | Select race | change_race | races, players |
| `vacation` | Vacation Mode | account | Enable vacation | vacation | vacation_states, protection_states |
| `ascension` | Ascension | progression | Check eligibility, Ascend | ascend | ascension_states, ascensions, glory_reputation |
| `galaxies` | Galaxy Map | galaxies | Select galaxy, Open sector | universe_galaxies | universe_galaxies, universe_sectors, universe_solar_systems, universe_planets, universe_discoveries, target_realms, game_events |
| `sectors` | Sector Map | sectors | Select sector, Open system | universe_sectors | universe_sectors, universe_solar_systems, universe_planets, motherships, mothership_modules, player_technologies, player_cooldowns, game_events |
| `solar-systems` | Solar Systems | solar-systems | Open system, Scan system | system_map, explore | universe_solar_systems, universe_planets |
| `universe-planets` | Universe Planets | universe-planets | Inspect planet, Colonize planet | planet_details, colonize_planet | universe_planets, player_colonies |
| `moons` | Moon Registry | moons | Inspect moon, Build jump gate | moon_details, mothership_upgrade | universe_moons, universe_planets |
| `coordinates` | Coordinate Search | coordinates | Search coordinates, Open system | coordinate_lookup | universe_galaxies, universe_sectors, universe_solar_systems, universe_planets, universe_discoveries, player_colonies |

# Universe Civilization: Empire at Wars Page and Sub-Page Coverage

This report is generated from the PHP route registry, page designs, and feature contracts.

## Command Center

### `dashboard` — Command Center

**Layout:** `dashboard`  
**Feature:** Command Center settlement dashboard  
**Permission:** authenticated commander  
**Controls:** Process turns, Choose target, Review reports  
**Actions:** process_turns  
**Reads:** players, player_resources, rankings, game_events  
**Writes:** turn_batches, turn_actions, game_events  
**Sections:** resource strip, turn status, income summary, recent events  
**States:** session expired, turn cooldown, worker lock  

### `account-info` — Account Information

**Layout:** `details`  
**Feature:** Module workspace  
**Permission:** authenticated commander  
**Controls:** View profile, View rank, View protection  
**Actions:**   
**Reads:** players, races, rankings, glory_reputation  
**Writes:**   
**Sections:** profile identity, rank and race, protection, audit history  
**States:** ready, restricted  

### `resources` — Resources & Vault

**Layout:** `economy`  
**Feature:** Resource treasury and vault transfers  
**Permission:** authenticated commander  
**Controls:** Deposit, Withdraw  
**Actions:** deposit, withdraw  
**Reads:** player_resources, game_settings  
**Writes:** player_resources, game_events  
**Sections:** balance cards, production rates, vault transfer, DefCon selector  
**States:** invalid amount, insufficient funds, daily limit  

### `income` — Income Breakdown

**Layout:** `breakdown`  
**Feature:** Income formula and production forecast  
**Permission:** authenticated commander  
**Controls:** View income formula  
**Actions:**   
**Reads:** player_resources, races, player_planets, game_settings  
**Writes:**   
**Sections:** income formula, modifier table, forecast, event history  
**States:** no settlement data  

### `military-stats` — Military Statistics

**Layout:** `stats`  
**Feature:** Module workspace  
**Permission:** authenticated commander  
**Controls:** View attack, View defense, View covert  
**Actions:**   
**Reads:** player_resources, player_unit_stats, rankings  
**Writes:**   
**Sections:** attack, defense, covert, ranking delta  
**States:** ready, no-data  

## Attack

### `targets` — Target Selection

**Layout:** `targets`  
**Feature:** Target selection and combat launch  
**Permission:** authenticated commander with attack turns  
**Controls:** Attack, Raid, Spy, Sabotage, Conquer Planet, Message  
**Actions:** combat, covert, explore, message  
**Reads:** target_realms, players, battles, protection_states  
**Writes:** battles, battle_reports, player_resources, game_events  
**Sections:** filters, target rows, action buttons, protection badges  
**States:** protected target, not enough turns, invalid target  

### `spy` — Spy Operations

**Layout:** `covert`  
**Feature:** Reconnaissance, spy, and sabotage missions  
**Permission:** authenticated commander with covert agents  
**Controls:** Run reconnaissance, Run spy mission  
**Actions:** covert  
**Reads:** covert_missions, spy_missions, sabotage_missions, intelligence_reports  
**Writes:** covert_missions, intelligence_reports, player_resources, game_events  
**Sections:** mission type, agent quantity, detection warning, result report  
**States:** detected, not enough agents, cooldown  

### `sabotage` — Sabotage Operations

**Layout:** `covert`  
**Feature:** Reconnaissance, spy, and sabotage missions  
**Permission:** authenticated commander with covert agents  
**Controls:** Choose system, Run sabotage  
**Actions:** covert  
**Reads:** covert_missions, spy_missions, sabotage_missions, intelligence_reports  
**Writes:** covert_missions, intelligence_reports, player_resources, game_events  
**Sections:** mission type, agent quantity, detection warning, result report  
**States:** detected, not enough agents, cooldown  

### `attack-log` — Attack Log & Reports

**Layout:** `reports`  
**Feature:** Battle and intelligence report center  
**Permission:** authenticated report owner  
**Controls:** Open report, Mark read  
**Actions:** message_read  
**Reads:** battle_reports, intelligence_reports, attack_logs  
**Writes:** messages, game_events  
**Sections:** unread count, report table, detail drawer, mark-read control  
**States:** report not found, permission denied  

## Armory

### `weapons` — Weapon Inventory

**Layout:** `inventory`  
**Feature:** Weapon inventory and durability management  
**Permission:** authenticated commander  
**Controls:** Buy weapon, Inspect durability  
**Actions:** weapon_buy  
**Reads:** weapon_types, player_weapons, player_resources  
**Writes:** player_weapons, player_resources, game_events  
**Sections:** weapon rows, durability, purchase form, repair action  
**States:** insufficient funds, invalid quantity  

### `weapon-market` — Weapon Market

**Layout:** `market`  
**Feature:** Resource and mercenary market orders  
**Permission:** authenticated commander with market turns  
**Controls:** List order, Buy order  
**Actions:** market_list, market_buy  
**Reads:** market_orders, weapon_types, mercenary_types  
**Writes:** market_orders, player_resources, game_events  
**Sections:** order book, listing form, purchase form, transaction notice  
**States:** own order, order closed, insufficient funds  

### `repair` — Weapon Repair

**Layout:** `repair`  
**Feature:** Weapon repair and durability recovery  
**Permission:** authenticated commander  
**Controls:** Repair weapon  
**Actions:** weapon_repair  
**Reads:** player_weapons, player_resources  
**Writes:** player_weapons, player_resources, game_events  
**Sections:** damaged items, repair cost, confirmation, result banner  
**States:** weapon not owned, insufficient funds  

## Training

### `units` — Unit Training

**Layout:** `training`  
**Feature:** Personnel training and specialization  
**Permission:** authenticated commander  
**Controls:** Train units  
**Actions:** train  
**Reads:** player_resources, technologies  
**Writes:** player_resources, game_events  
**Sections:** unit pool, training controls, cost preview, queue/result  
**States:** not enough untrained units, invalid type, quantity limit  

### `miners` — Miners & Lifers

**Layout:** `training`  
**Feature:** Personnel training and specialization  
**Permission:** authenticated commander  
**Controls:** Train miners  
**Actions:** train  
**Reads:** player_resources, technologies  
**Writes:** player_resources, game_events  
**Sections:** unit pool, training controls, cost preview, queue/result  
**States:** not enough untrained units, invalid type, quantity limit  

### `super-units` — Super Units

**Layout:** `training`  
**Feature:** Personnel training and specialization  
**Permission:** authenticated commander  
**Controls:** Train elite units  
**Actions:** train  
**Reads:** player_resources, technologies  
**Writes:** player_resources, game_events  
**Sections:** unit pool, training controls, cost preview, queue/result  
**States:** not enough untrained units, invalid type, quantity limit  

### `unit-production` — Unit Production

**Layout:** `upgrade`  
**Feature:** Unit production level upgrade  
**Permission:** authenticated commander  
**Controls:** Upgrade UP  
**Actions:** upgrade_up  
**Reads:** player_resources  
**Writes:** player_resources, game_events  
**Sections:** current level, next cost, modifier preview, confirmation  
**States:** insufficient funds, maximum level  

## Technology

### `technology` — Technology Tree

**Layout:** `technology`  
**Feature:** Technology research tree  
**Permission:** authenticated commander  
**Controls:** Upgrade offense, Upgrade defense, Upgrade covert, Upgrade anti-covert  
**Actions:** technology  
**Reads:** technologies, player_technologies, player_resources  
**Writes:** player_technologies, player_resources, game_events  
**Sections:** category tabs, technology cards, level and cost, upgrade result  
**States:** technology locked, insufficient funds  

### `tech-offense` — Offense Technology

**Layout:** `technology`  
**Feature:** Technology research tree  
**Permission:** authenticated commander  
**Controls:** Upgrade  
**Actions:** technology  
**Reads:** technologies, player_technologies, player_resources  
**Writes:** player_technologies, player_resources, game_events  
**Sections:** category tabs, technology cards, level and cost, upgrade result  
**States:** technology locked, insufficient funds  

### `tech-defense` — Defense Technology

**Layout:** `technology`  
**Feature:** Technology research tree  
**Permission:** authenticated commander  
**Controls:** Upgrade  
**Actions:** technology  
**Reads:** technologies, player_technologies, player_resources  
**Writes:** player_technologies, player_resources, game_events  
**Sections:** category tabs, technology cards, level and cost, upgrade result  
**States:** technology locked, insufficient funds  

### `tech-covert` — Covert Technology

**Layout:** `technology`  
**Feature:** Technology research tree  
**Permission:** authenticated commander  
**Controls:** Upgrade  
**Actions:** technology  
**Reads:** technologies, player_technologies, player_resources  
**Writes:** player_technologies, player_resources, game_events  
**Sections:** category tabs, technology cards, level and cost, upgrade result  
**States:** technology locked, insufficient funds  

### `tech-anti-covert` — Anti-Covert Technology

**Layout:** `technology`  
**Feature:** Technology research tree  
**Permission:** authenticated commander  
**Controls:** Upgrade  
**Actions:** technology  
**Reads:** technologies, player_technologies, player_resources  
**Writes:** player_technologies, player_resources, game_events  
**Sections:** category tabs, technology cards, level and cost, upgrade result  
**States:** technology locked, insufficient funds  

## Intelligence

### `spy-log` — Spy Log

**Layout:** `reports`  
**Feature:** Battle and intelligence report center  
**Permission:** authenticated report owner  
**Controls:** Open report, Mark read  
**Actions:** message_read  
**Reads:** battle_reports, intelligence_reports, attack_logs  
**Writes:** messages, game_events  
**Sections:** unread count, report table, detail drawer, mark-read control  
**States:** report not found, permission denied  

### `enemy-intelligence` — Enemy Intelligence

**Layout:** `reports`  
**Feature:** Battle and intelligence report center  
**Permission:** authenticated report owner  
**Controls:** Open intelligence report  
**Actions:**   
**Reads:** battle_reports, intelligence_reports, attack_logs  
**Writes:** messages, game_events  
**Sections:** unread count, report table, detail drawer, mark-read control  
**States:** report not found, permission denied  

## Market

### `resource-exchange` — Resource Exchange

**Layout:** `market`  
**Feature:** Resource and mercenary market orders  
**Permission:** authenticated commander with market turns  
**Controls:** List order, Buy order  
**Actions:** market_list, market_buy  
**Reads:** market_orders, weapon_types, mercenary_types  
**Writes:** market_orders, player_resources, game_events  
**Sections:** order book, listing form, purchase form, transaction notice  
**States:** own order, order closed, insufficient funds  

### `mercenary-market` — Mercenary Market

**Layout:** `market`  
**Feature:** Resource and mercenary market orders  
**Permission:** authenticated commander with market turns  
**Controls:** Recruit, Sell  
**Actions:** mercenary_buy  
**Reads:** market_orders, weapon_types, mercenary_types  
**Writes:** market_orders, player_resources, game_events  
**Sections:** order book, listing form, purchase form, transaction notice  
**States:** own order, order closed, insufficient funds  

## Social

### `rankings` — Rankings

**Layout:** `rankings`  
**Feature:** Overall, military, economy, and covert rankings  
**Permission:** authenticated commander  
**Controls:** Refresh rankings, Open player  
**Actions:** refresh_rankings  
**Reads:** rankings, rank_snapshots, players  
**Writes:** rankings, rank_snapshots  
**Sections:** ranking tabs, player rows, score delta, refresh status  
**States:** settlement in progress  

### `alliances` — Alliances

**Layout:** `social`  
**Feature:** Alliance creation, membership, and activity  
**Permission:** authenticated commander  
**Controls:** Create alliance, Join alliance, Leave alliance  
**Actions:** alliance_create, alliance_join  
**Reads:** alliances, alliance_members  
**Writes:** alliances, alliance_members, game_events  
**Sections:** alliance summary, member table, join/create forms, activity log  
**States:** duplicate tag, not found, permission denied  

### `messages` — Messages

**Layout:** `messages`  
**Feature:** Commander messages and blacklist controls  
**Permission:** authenticated commander  
**Controls:** Send, Mark read, Blacklist  
**Actions:** message, message_read  
**Reads:** messages, blacklists, players  
**Writes:** messages, blacklists, game_events  
**Sections:** inbox, compose form, read state, blacklist controls  
**States:** recipient blocked, invalid body, recipient not found  

## Planets

### `planet-list` — Planet List

**Layout:** `planets`  
**Feature:** Owned planet, bonus, defense, and exploration management  
**Permission:** authenticated commander  
**Controls:** Explore, Conquer  
**Actions:** explore, combat  
**Reads:** player_planets, planet_bonuses, planet_defenses  
**Writes:** player_planets, planet_defenses, planet_explorations, game_events  
**Sections:** planet cards, bonuses, defenses, exploration controls  
**States:** planet unavailable, not owned, insufficient funds  

### `planet-bonuses` — Planet Bonuses

**Layout:** `planets`  
**Feature:** Owned planet, bonus, defense, and exploration management  
**Permission:** authenticated commander  
**Controls:** View bonuses  
**Actions:**   
**Reads:** player_planets, planet_bonuses, planet_defenses  
**Writes:** player_planets, planet_defenses, planet_explorations, game_events  
**Sections:** planet cards, bonuses, defenses, exploration controls  
**States:** planet unavailable, not owned, insufficient funds  

### `planet-defenses` — Planet Defenses

**Layout:** `planets`  
**Feature:** Owned planet, bonus, defense, and exploration management  
**Permission:** authenticated commander  
**Controls:** Upgrade defense  
**Actions:** planet_defense  
**Reads:** player_planets, planet_bonuses, planet_defenses  
**Writes:** player_planets, planet_defenses, planet_explorations, game_events  
**Sections:** planet cards, bonuses, defenses, exploration controls  
**States:** planet unavailable, not owned, insufficient funds  

## Mothership

### `ship` — Mothership

**Layout:** `ship`  
**Feature:** Mothership hull, module, shield, and hangar upgrades  
**Permission:** authenticated commander  
**Controls:** Upgrade hull, Upgrade hangars, Upgrade shields  
**Actions:** mothership_upgrade  
**Reads:** motherships, mothership_modules, player_resources  
**Writes:** motherships, mothership_modules, player_resources  
**Sections:** hull stats, module cards, upgrade costs, exploration status  
**States:** invalid module, insufficient funds, maximum level  

### `modules` — Mothership Modules

**Layout:** `ship`  
**Feature:** Mothership hull, module, shield, and hangar upgrades  
**Permission:** authenticated commander  
**Controls:** Upgrade module  
**Actions:** mothership_upgrade  
**Reads:** motherships, mothership_modules, player_resources  
**Writes:** motherships, mothership_modules, player_resources  
**Sections:** hull stats, module cards, upgrade costs, exploration status  
**States:** invalid module, insufficient funds, maximum level  

### `exploration` — Exploration

**Layout:** `exploration`  
**Feature:** Planet and system exploration  
**Permission:** authenticated commander with exploration capacity  
**Controls:** Explore planet  
**Actions:** explore  
**Reads:** motherships, universe_solar_systems, universe_planets, planet_explorations  
**Writes:** planet_explorations, player_planets, game_events  
**Sections:** coordinates, scan result, planet card, mission history  
**States:** range exceeded, anomaly failure, cooldown  

## Account

### `race` — Race Selection

**Layout:** `account`  
**Feature:** Race, protection, vacation, and account settings  
**Permission:** authenticated account owner  
**Controls:** Select race  
**Actions:** change_race  
**Reads:** players, races, protection_states  
**Writes:** players, protection_states, game_events  
**Sections:** race selector, vacation controls, protection, supporter status  
**States:** cooldown, invalid race, active combat  

### `vacation` — Vacation Mode

**Layout:** `account`  
**Feature:** Race, protection, vacation, and account settings  
**Permission:** authenticated account owner  
**Controls:** Enable vacation  
**Actions:** vacation  
**Reads:** players, races, protection_states  
**Writes:** players, protection_states, game_events  
**Sections:** race selector, vacation controls, protection, supporter status  
**States:** cooldown, invalid race, active combat  

### `ascension` — Ascension

**Layout:** `progression`  
**Feature:** Glory, Reputation, and ascension  
**Permission:** authenticated commander meeting requirements  
**Controls:** Check eligibility, Ascend  
**Actions:** ascend  
**Reads:** players, glory_reputation, ascensions  
**Writes:** players, ascensions, game_events  
**Sections:** requirements, Glory/Reputation, Ascension preview, confirmation  
**States:** requirements not met, already ascended  

## Universe

### `galaxies` — Galaxy Map

**Layout:** `galaxies`  
**Feature:** Galaxy and sector discovery map  
**Permission:** authenticated commander  
**Controls:** Select galaxy, Open sector  
**Actions:** universe_galaxies  
**Reads:** universe_galaxies, universe_sectors  
**Writes:**   
**Sections:** galaxy selector, sector list, danger and density, discovery status  
**States:** galaxy unavailable  

### `sectors` — Sector Map

**Layout:** `sectors`  
**Feature:** Sector danger and resource map  
**Permission:** authenticated commander  
**Controls:** Select sector, Open system  
**Actions:** universe_sectors  
**Reads:** universe_sectors, universe_solar_systems  
**Writes:**   
**Sections:** sector overview, system list, resource modifier, anomaly rate  
**States:** sector locked  

### `solar-systems` — Solar Systems

**Layout:** `solar-systems`  
**Feature:** Star system orbital map  
**Permission:** authenticated commander  
**Controls:** Open system, Scan system  
**Actions:** system_map, explore  
**Reads:** universe_solar_systems, universe_planets, universe_moons  
**Writes:**   
**Sections:** star profile, orbital lanes, planet slots, scan controls  
**States:** system undiscovered  

### `universe-planets` — Universe Planets

**Layout:** `universe-planets`  
**Feature:** Planet biome, class, habitability, and colonization  
**Permission:** authenticated commander with colonization rights  
**Controls:** Inspect planet, Colonize planet  
**Actions:** planet_details, colonize_planet  
**Reads:** universe_planets, universe_moons, player_colonies  
**Writes:** player_colonies, universe_planets, game_events  
**Sections:** coordinate header, biome and class, habitability and slots, resource modifiers, moon list, colonization form  
**States:** occupied, uninhabitable, unavailable  

### `moons` — Moon Registry

**Layout:** `moons`  
**Feature:** Moon class, sensor range, facilities, and jump gates  
**Permission:** authenticated moon owner  
**Controls:** Inspect moon, Build jump gate  
**Actions:** moon_details, mothership_upgrade  
**Reads:** universe_moons, universe_planets, player_colonies  
**Writes:** universe_moons, game_events  
**Sections:** parent planet, moon classification, sensor and gate stats, moon facilities  
**States:** moon unavailable, gate locked  

### `coordinates` — Coordinate Search

**Layout:** `coordinates`  
**Feature:** Galaxy, sector, system, and orbit coordinate lookup  
**Permission:** authenticated commander  
**Controls:** Search coordinates, Open system  
**Actions:** coordinate_lookup  
**Reads:** universe_galaxies, universe_sectors, universe_solar_systems, universe_planets  
**Writes:**   
**Sections:** coordinate form, galaxy result, system result, planet result  
**States:** invalid coordinate, not found  


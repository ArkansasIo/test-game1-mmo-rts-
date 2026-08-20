# StargateWars API and Dashboard Endpoint Reference

Generated from the authoritative route registry and server-side contracts. The browser submits intent only; mutations are validated by authentication, CSRF, RBAC, ownership, cooldown, resource, and transaction rules before commit.

## Base endpoints

| Method | Endpoint | Purpose |
|---|---|---|
| GET | `/game.php?page=<route>` | Render an authenticated dashboard panel without a full navigation reload. |
| POST | `/actions/game.php` | Submit a server-side mutation or read intent using the session CSRF token. |
| GET | `/pages/<group>/subpages/<route>.php` | Standalone authenticated entrypoint that redirects to the route-aware dashboard panel. |
| GET | `/actions/login.php` | Compatibility login endpoint delegating to `login.php`. |
| GET/POST | `/actions/register.php` | Compatibility registration endpoint delegating to `register.php`. |
| GET | `/actions/logout.php` | Secure session teardown and redirect to login. |

## Request and response conventions

Mutating requests use `POST /actions/game.php` with `action`, the required route-specific fields, and the session CSRF token. Successful actions set a flash result and redirect to the requested dashboard route. Read intents are authenticated and scoped to the commander. Errors are normalized into feedback states such as `ready`, `empty`, `protected`, `insufficient-resource`, `cooldown`, `success`, `invalid-input`, and `error`.

## Route reference

### 1. Command Center (`dashboard`)

**Group:** Command Center  
**Dashboard endpoint:** `GET /game.php?page=dashboard`  
**Standalone entrypoint:** `GET /pages/command-center/subpages/dashboard.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `process_turns` |
| Tables / data sources | `players`, `player_resources`, `rankings`, `game_events` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 2. Account Information (`account-info`)

**Group:** Command Center  
**Dashboard endpoint:** `GET /game.php?page=account-info`  
**Standalone entrypoint:** `GET /pages/command-center/subpages/account-info.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | — |
| Tables / data sources | `players`, `races`, `rankings`, `glory_reputation` |
| Feedback states | — |

### 3. Resources & Vault (`resources`)

**Group:** Command Center  
**Dashboard endpoint:** `GET /game.php?page=resources`  
**Standalone entrypoint:** `GET /pages/command-center/subpages/resources.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `deposit`, `withdraw` |
| Tables / data sources | `player_resources`, `game_settings` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 4. Income Breakdown (`income`)

**Group:** Command Center  
**Dashboard endpoint:** `GET /game.php?page=income`  
**Standalone entrypoint:** `GET /pages/command-center/subpages/income.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | — |
| Tables / data sources | `player_resources`, `races`, `player_planets`, `game_settings` |
| Feedback states | — |

### 5. Military Statistics (`military-stats`)

**Group:** Command Center  
**Dashboard endpoint:** `GET /game.php?page=military-stats`  
**Standalone entrypoint:** `GET /pages/command-center/subpages/military-stats.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | — |
| Tables / data sources | `player_resources`, `player_unit_stats`, `rankings` |
| Feedback states | — |

### 6. Target Selection (`targets`)

**Group:** Attack  
**Dashboard endpoint:** `GET /game.php?page=targets`  
**Standalone entrypoint:** `GET /pages/attack/subpages/targets.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander with attack turns

**Server formula:** `battle outcome = validated force comparison + technology + defense + deterministic resolver`

| Contract item | Value |
|---|---|
| Actions / intents | `combat`, `covert`, `explore`, `message` |
| Tables / data sources | `target_realms`, `players`, `battles` |
| Feedback states | `ready`, `protected`, `insufficient-resource`, `cooldown`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 7. Spy Operations (`spy`)

**Group:** Attack  
**Dashboard endpoint:** `GET /game.php?page=spy`  
**Standalone entrypoint:** `GET /pages/attack/subpages/spy.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `covert` |
| Tables / data sources | `covert_missions`, `spy_missions`, `intelligence_reports` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 8. Sabotage Operations (`sabotage`)

**Group:** Attack  
**Dashboard endpoint:** `GET /game.php?page=sabotage`  
**Standalone entrypoint:** `GET /pages/attack/subpages/sabotage.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `covert` |
| Tables / data sources | `covert_missions`, `sabotage_missions` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 9. Attack Log & Reports (`attack-log`)

**Group:** Attack  
**Dashboard endpoint:** `GET /game.php?page=attack-log`  
**Standalone entrypoint:** `GET /pages/attack/subpages/attack-log.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `message_read` |
| Tables / data sources | `battles`, `battle_reports`, `attack_logs` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 10. Weapon Inventory (`weapons`)

**Group:** Armory  
**Dashboard endpoint:** `GET /game.php?page=weapons`  
**Standalone entrypoint:** `GET /pages/armory/subpages/weapons.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `weapon_buy` |
| Tables / data sources | `weapon_types`, `player_weapons` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 11. Weapon Market (`weapon-market`)

**Group:** Armory  
**Dashboard endpoint:** `GET /game.php?page=weapon-market`  
**Standalone entrypoint:** `GET /pages/armory/subpages/weapon-market.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `market_list`, `market_buy` |
| Tables / data sources | `market_orders`, `weapon_types` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 12. Weapon Repair (`repair`)

**Group:** Armory  
**Dashboard endpoint:** `GET /game.php?page=repair`  
**Standalone entrypoint:** `GET /pages/armory/subpages/repair.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated weapon owner

**Server formula:** `repair cost = missing durability × weapon tier × maintenance factor`

| Contract item | Value |
|---|---|
| Actions / intents | `weapon_repair` |
| Tables / data sources | `player_weapons`, `player_resources` |
| Feedback states | `ready`, `insufficient-resource`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 13. Unit Training (`units`)

**Group:** Training  
**Dashboard endpoint:** `GET /game.php?page=units`  
**Standalone entrypoint:** `GET /pages/training/subpages/units.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `train` |
| Tables / data sources | `player_resources` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 14. Miners & Lifers (`miners`)

**Group:** Training  
**Dashboard endpoint:** `GET /game.php?page=miners`  
**Standalone entrypoint:** `GET /pages/training/subpages/miners.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `train` |
| Tables / data sources | `player_resources` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 15. Super Units (`super-units`)

**Group:** Training  
**Dashboard endpoint:** `GET /game.php?page=super-units`  
**Standalone entrypoint:** `GET /pages/training/subpages/super-units.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `train` |
| Tables / data sources | `player_resources`, `technologies` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 16. Unit Production (`unit-production`)

**Group:** Training  
**Dashboard endpoint:** `GET /game.php?page=unit-production`  
**Standalone entrypoint:** `GET /pages/training/subpages/unit-production.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `upgrade_up` |
| Tables / data sources | `player_resources` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 17. Technology Tree (`technology`)

**Group:** Technology  
**Dashboard endpoint:** `GET /game.php?page=technology`  
**Standalone entrypoint:** `GET /pages/technology/subpages/technology.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander with research access

**Server formula:** `research cost = base cost × growth ^ current level; completion applies effect`

| Contract item | Value |
|---|---|
| Actions / intents | `technology` |
| Tables / data sources | `technologies`, `player_technologies` |
| Feedback states | `ready`, `locked`, `insufficient-resource`, `queued`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 18. Offense Technology (`tech-offense`)

**Group:** Technology  
**Dashboard endpoint:** `GET /game.php?page=tech-offense`  
**Standalone entrypoint:** `GET /pages/technology/subpages/tech-offense.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `technology` |
| Tables / data sources | `technologies`, `player_technologies` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 19. Defense Technology (`tech-defense`)

**Group:** Technology  
**Dashboard endpoint:** `GET /game.php?page=tech-defense`  
**Standalone entrypoint:** `GET /pages/technology/subpages/tech-defense.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `technology` |
| Tables / data sources | `technologies`, `player_technologies` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 20. Covert Technology (`tech-covert`)

**Group:** Technology  
**Dashboard endpoint:** `GET /game.php?page=tech-covert`  
**Standalone entrypoint:** `GET /pages/technology/subpages/tech-covert.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `technology` |
| Tables / data sources | `technologies`, `player_technologies` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 21. Anti-Covert Technology (`tech-anti-covert`)

**Group:** Technology  
**Dashboard endpoint:** `GET /game.php?page=tech-anti-covert`  
**Standalone entrypoint:** `GET /pages/technology/subpages/tech-anti-covert.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `technology` |
| Tables / data sources | `technologies`, `player_technologies` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 22. Spy Log (`spy-log`)

**Group:** Intelligence  
**Dashboard endpoint:** `GET /game.php?page=spy-log`  
**Standalone entrypoint:** `GET /pages/intelligence/subpages/spy-log.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `message_read` |
| Tables / data sources | `covert_missions`, `intelligence_reports` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 23. Enemy Intelligence (`enemy-intelligence`)

**Group:** Intelligence  
**Dashboard endpoint:** `GET /game.php?page=enemy-intelligence`  
**Standalone entrypoint:** `GET /pages/intelligence/subpages/enemy-intelligence.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | — |
| Tables / data sources | `intelligence_reports` |
| Feedback states | — |

### 24. Resource Exchange (`resource-exchange`)

**Group:** Market  
**Dashboard endpoint:** `GET /game.php?page=resource-exchange`  
**Standalone entrypoint:** `GET /pages/market/subpages/resource-exchange.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `market_list`, `market_buy` |
| Tables / data sources | `market_orders`, `player_resources` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 25. Mercenary Market (`mercenary-market`)

**Group:** Market  
**Dashboard endpoint:** `GET /game.php?page=mercenary-market`  
**Standalone entrypoint:** `GET /pages/market/subpages/mercenary-market.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `mercenary_buy` |
| Tables / data sources | `mercenary_types`, `player_mercenaries` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 26. Rankings (`rankings`)

**Group:** Social  
**Dashboard endpoint:** `GET /game.php?page=rankings`  
**Standalone entrypoint:** `GET /pages/social/subpages/rankings.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander

**Server formula:** `score = weighted economy + military + covert + progression + colony value`

| Contract item | Value |
|---|---|
| Actions / intents | `refresh_rankings` |
| Tables / data sources | `rankings`, `rank_snapshots` |
| Feedback states | `loading`, `ready`, `empty`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 27. Alliances (`alliances`)

**Group:** Social  
**Dashboard endpoint:** `GET /game.php?page=alliances`  
**Standalone entrypoint:** `GET /pages/social/subpages/alliances.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `alliance_create`, `alliance_join` |
| Tables / data sources | `alliances`, `alliance_members` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 28. Messages (`messages`)

**Group:** Social  
**Dashboard endpoint:** `GET /game.php?page=messages`  
**Standalone entrypoint:** `GET /pages/social/subpages/messages.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander

**Server formula:** `message = validated sender + recipient + content policy + notification event`

| Contract item | Value |
|---|---|
| Actions / intents | `message`, `message_read` |
| Tables / data sources | `messages`, `blacklists` |
| Feedback states | `loading`, `ready`, `empty`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 29. Planet List (`planet-list`)

**Group:** Planets  
**Dashboard endpoint:** `GET /game.php?page=planet-list`  
**Standalone entrypoint:** `GET /pages/planets/subpages/planet-list.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `explore`, `combat` |
| Tables / data sources | `player_planets`, `planet_explorations` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 30. Planet Bonuses (`planet-bonuses`)

**Group:** Planets  
**Dashboard endpoint:** `GET /game.php?page=planet-bonuses`  
**Standalone entrypoint:** `GET /pages/planets/subpages/planet-bonuses.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | — |
| Tables / data sources | `planet_bonuses` |
| Feedback states | — |

### 31. Planet Defenses (`planet-defenses`)

**Group:** Planets  
**Dashboard endpoint:** `GET /game.php?page=planet-defenses`  
**Standalone entrypoint:** `GET /pages/planets/subpages/planet-defenses.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `planet_defense` |
| Tables / data sources | `planet_defenses` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 32. Mothership (`ship`)

**Group:** Mothership  
**Dashboard endpoint:** `GET /game.php?page=ship`  
**Standalone entrypoint:** `GET /pages/mothership/subpages/ship.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated mothership owner

**Server formula:** `ship readiness = hull + modules + weapons + shields + fleet capacity`

| Contract item | Value |
|---|---|
| Actions / intents | `mothership_upgrade` |
| Tables / data sources | `motherships` |
| Feedback states | `ready`, `insufficient-resource`, `queued`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 33. Mothership Modules (`modules`)

**Group:** Mothership  
**Dashboard endpoint:** `GET /game.php?page=modules`  
**Standalone entrypoint:** `GET /pages/mothership/subpages/modules.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `mothership_upgrade` |
| Tables / data sources | `mothership_modules` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 34. Exploration (`exploration`)

**Group:** Mothership  
**Dashboard endpoint:** `GET /game.php?page=exploration`  
**Standalone entrypoint:** `GET /pages/mothership/subpages/exploration.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander with mothership readiness

**Server formula:** `exploration yield = distance × ship science × biome rarity`

| Contract item | Value |
|---|---|
| Actions / intents | `explore` |
| Tables / data sources | `motherships`, `planet_explorations` |
| Feedback states | `ready`, `protected`, `insufficient-resource`, `cooldown`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 35. Race Selection (`race`)

**Group:** Account  
**Dashboard endpoint:** `GET /game.php?page=race`  
**Standalone entrypoint:** `GET /pages/account/subpages/race.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `change_race` |
| Tables / data sources | `races`, `players` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 36. Vacation Mode (`vacation`)

**Group:** Account  
**Dashboard endpoint:** `GET /game.php?page=vacation`  
**Standalone entrypoint:** `GET /pages/account/subpages/vacation.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `vacation` |
| Tables / data sources | `vacation_states`, `protection_states` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 37. Ascension (`ascension`)

**Group:** Account  
**Dashboard endpoint:** `GET /game.php?page=ascension`  
**Standalone entrypoint:** `GET /pages/account/subpages/ascension.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** Authenticated commander.

| Contract item | Value |
|---|---|
| Actions / intents | `ascend` |
| Tables / data sources | `ascension_states`, `ascensions`, `glory_reputation` |
| Feedback states | — |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 38. Galaxy Map (`galaxies`)

**Group:** Universe  
**Dashboard endpoint:** `GET /game.php?page=galaxies`  
**Standalone entrypoint:** `GET /pages/universe/subpages/galaxies.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander

**Server formula:** `travel risk = sector danger × system volatility × distance modifier`

| Contract item | Value |
|---|---|
| Actions / intents | `universe_galaxies` |
| Tables / data sources | `universe_galaxies`, `universe_sectors` |
| Feedback states | `loading`, `ready`, `empty`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 39. Sector Map (`sectors`)

**Group:** Universe  
**Dashboard endpoint:** `GET /game.php?page=sectors`  
**Standalone entrypoint:** `GET /pages/universe/subpages/sectors.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander

**Server formula:** `sector output = base output × resource modifier; anomaly rate drives events`

| Contract item | Value |
|---|---|
| Actions / intents | `universe_sectors` |
| Tables / data sources | `universe_sectors`, `universe_solar_systems` |
| Feedback states | `loading`, `ready`, `empty`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 40. Solar Systems (`solar-systems`)

**Group:** Universe  
**Dashboard endpoint:** `GET /game.php?page=solar-systems`  
**Standalone entrypoint:** `GET /pages/universe/subpages/solar-systems.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander

**Server formula:** `system travel = base travel × system modifier × sector danger`

| Contract item | Value |
|---|---|
| Actions / intents | `system_map`, `explore` |
| Tables / data sources | `universe_solar_systems`, `universe_planets` |
| Feedback states | `loading`, `ready`, `empty`, `cooldown`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 41. Universe Planets (`universe-planets`)

**Group:** Universe  
**Dashboard endpoint:** `GET /game.php?page=universe-planets`  
**Standalone entrypoint:** `GET /pages/universe/subpages/universe-planets.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander with colonization access

**Server formula:** `colony viability = habitability × biome × race × government × life support`

| Contract item | Value |
|---|---|
| Actions / intents | `planet_details`, `colonize_planet` |
| Tables / data sources | `universe_planets`, `player_colonies` |
| Feedback states | `ready`, `occupied`, `protected`, `insufficient-resource`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 42. Moon Registry (`moons`)

**Group:** Universe  
**Dashboard endpoint:** `GET /game.php?page=moons`  
**Standalone entrypoint:** `GET /pages/universe/subpages/moons.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander with moon access

**Server formula:** `moon utility = sensor bonus + jump-gate level + moon resource modifiers`

| Contract item | Value |
|---|---|
| Actions / intents | `moon_details`, `mothership_upgrade` |
| Tables / data sources | `universe_moons`, `universe_planets` |
| Feedback states | `ready`, `empty`, `occupied`, `success`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

### 43. Coordinate Search (`coordinates`)

**Group:** Universe  
**Dashboard endpoint:** `GET /game.php?page=coordinates`  
**Standalone entrypoint:** `GET /pages/universe/subpages/coordinates.php`  
**Mutation endpoint:** `POST /actions/game.php`  
**Access:** authenticated commander

**Server formula:** `coordinate = galaxy:sector:system:orbit; every level is validated server-side`

| Contract item | Value |
|---|---|
| Actions / intents | `coordinate_lookup` |
| Tables / data sources | `universe_galaxies`, `universe_sectors`, `universe_solar_systems`, `universe_planets` |
| Feedback states | `ready`, `empty`, `invalid-input`, `error` |

**Action request notes.** Each listed action is submitted as `action=<name>` with route-specific validated fields. No client-provided resource balance, ownership, combat outcome, cooldown, or permission value is trusted.

## Security and operational rules

Every mutation must pass session authentication, CSRF verification, RBAC and ownership checks, input bounds, cooldown checks, resource validation, and a database transaction. Server-side services are authoritative for resource balances, population, queue state, combat resolution, report visibility, and turn settlement. Failed transactions must roll back all related writes and return a normalized feedback state.

## Coverage

This reference contains **43 active dashboard routes** from `config/page_registry.php`. Regenerate it with `php tools/generate_api_reference.php` whenever the route registry or contracts change.

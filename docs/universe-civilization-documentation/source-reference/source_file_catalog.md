# Source File Catalog

Generated from the repository on 2026-08-21. This catalog lists PHP files outside the dedicated documentation package. The current implementation uses both the numbered architecture folders and the active root/config/includes/pages/action tree; both are retained here for traceability.

| Path | Role | Lines |
|---|---|---|
| `01_Core/Config/app.php` | PHP source | 12 |
| `01_Core/Config/config.php` | PHP source | 63 |
| `01_Core/Config/database.php` | PHP source | 11 |
| `01_Core/Config/settings.php` | PHP source | 43 |
| `01_Core/Database/Database.php` | PHP source | 9 |
| `01_Core/Http/Request.php` | PHP source | 9 |
| `01_Core/Http/Response.php` | PHP source | 7 |
| `01_Core/Http/Router.php` | PHP source | 10 |
| `01_Core/Security/Rules.php` | PHP source | 10 |
| `01_Core/Security/auth.php` | PHP source | 44 |
| `02_Gameplay/Combat/CombatResolver.php` | PHP source | 14 |
| `02_Gameplay/Combat/CovertEngine.php` | PHP source | 8 |
| `02_Gameplay/Combat/Formulas.php` | PHP source | 13 |
| `02_Gameplay/Covert/CovertEngine.php` | PHP source | 8 |
| `02_Gameplay/FormulaService.php` | PHP source | 65 |
| `02_Gameplay/GameService.php` | PHP source | 62 |
| `02_Gameplay/Rules.php` | PHP source | 16 |
| `02_Gameplay/Turns/FormulaService.php` | PHP source | 65 |
| `02_Gameplay/Turns/Formulas.php` | PHP source | 13 |
| `02_Gameplay/WorldService.php` | PHP source | 37 |
| `06_API/Combat/game.php` | PHP source | 43 |
| `06_API/Player/_entry.php` | PHP source | 7 |
| `06_API/Player/account-info.php` | PHP source | 7 |
| `06_API/Player/alliances.php` | PHP source | 7 |
| `06_API/Player/ascension.php` | PHP source | 7 |
| `06_API/Player/attack-log.php` | PHP source | 7 |
| `06_API/Player/dashboard.php` | PHP source | 7 |
| `06_API/Player/exploration.php` | PHP source | 7 |
| `06_API/Player/income.php` | PHP source | 7 |
| `06_API/Player/mercenary-market.php` | PHP source | 7 |
| `06_API/Player/messages.php` | PHP source | 7 |
| `06_API/Player/military-stats.php` | PHP source | 7 |
| `06_API/Player/miners.php` | PHP source | 7 |
| `06_API/Player/modules.php` | PHP source | 7 |
| `06_API/Player/mothership.php` | PHP source | 7 |
| `06_API/Player/planet-bonuses.php` | PHP source | 7 |
| `06_API/Player/planet-defenses.php` | PHP source | 7 |
| `06_API/Player/planet-list.php` | PHP source | 7 |
| `06_API/Player/planets.php` | PHP source | 7 |
| `06_API/Player/race.php` | PHP source | 7 |
| `06_API/Player/rankings.php` | PHP source | 7 |
| `06_API/Player/repair.php` | PHP source | 7 |
| `06_API/Player/resource-exchange.php` | PHP source | 7 |
| `06_API/Player/resources.php` | PHP source | 7 |
| `06_API/Player/sabotage.php` | PHP source | 7 |
| `06_API/Player/ship.php` | PHP source | 7 |
| `06_API/Player/spy.php` | PHP source | 7 |
| `06_API/Player/super-units.php` | PHP source | 7 |
| `06_API/Player/targets.php` | PHP source | 7 |
| `06_API/Player/technology.php` | PHP source | 7 |
| `06_API/Player/unit-production.php` | PHP source | 7 |
| `06_API/Player/units.php` | PHP source | 7 |
| `06_API/Player/vacation.php` | PHP source | 7 |
| `06_API/Player/weapon-market.php` | PHP source | 7 |
| `06_API/Player/weapons.php` | PHP source | 7 |
| `08_Cron/TurnProcessing/process_turns.php` | Scheduled job | 4 |
| `actions/game.php` | HTTP action handler | 122 |
| `actions/login.php` | HTTP action handler | 4 |
| `actions/logout.php` | HTTP action handler | 4 |
| `actions/register.php` | HTTP action handler | 4 |
| `colony-fleet-dashboard.php` | PHP source | 2 |
| `config/app.php` | Configuration / contract | 12 |
| `config/app_meta.php` | Configuration / contract | 24 |
| `config/auth.php` | Configuration / contract | 44 |
| `config/config.php` | Configuration / contract | 62 |
| `config/dashboard_page_details.php` | Configuration / contract | 30 |
| `config/database.php` | Configuration / contract | 11 |
| `config/design_catalog.php` | Configuration / contract | 143 |
| `config/economy_resource_model.php` | Configuration / contract | 26 |
| `config/gameplay_features.php` | Configuration / contract | 15 |
| `config/module_manifest.php` | Configuration / contract | 18 |
| `config/ogame_page_registry.php` | Configuration / contract | 10 |
| `config/page_contract_catalog.php` | Configuration / contract | 76 |
| `config/page_contracts.php` | Configuration / contract | 8883 |
| `config/page_definitions/account/ascension.php` | Configuration / contract | 213 |
| `config/page_definitions/account/race.php` | Configuration / contract | 229 |
| `config/page_definitions/account/vacation.php` | Configuration / contract | 229 |
| `config/page_definitions/armory/repair.php` | Configuration / contract | 172 |
| `config/page_definitions/armory/weapon-market.php` | Configuration / contract | 210 |
| `config/page_definitions/armory/weapons.php` | Configuration / contract | 192 |
| `config/page_definitions/attack/attack-log.php` | Configuration / contract | 197 |
| `config/page_definitions/attack/sabotage.php` | Configuration / contract | 236 |
| `config/page_definitions/attack/spy.php` | Configuration / contract | 237 |
| `config/page_definitions/attack/targets.php` | Configuration / contract | 285 |
| `config/page_definitions/command-center/account-info.php` | Configuration / contract | 186 |
| `config/page_definitions/command-center/dashboard.php` | Configuration / contract | 211 |
| `config/page_definitions/command-center/income.php` | Configuration / contract | 196 |
| `config/page_definitions/command-center/military-stats.php` | Configuration / contract | 203 |
| `config/page_definitions/command-center/resources.php` | Configuration / contract | 171 |
| `config/page_definitions/intelligence/enemy-intelligence.php` | Configuration / contract | 193 |
| `config/page_definitions/intelligence/spy-log.php` | Configuration / contract | 196 |
| `config/page_definitions/market/mercenary-market.php` | Configuration / contract | 209 |
| `config/page_definitions/market/resource-exchange.php` | Configuration / contract | 210 |
| `config/page_definitions/mothership/exploration.php` | Configuration / contract | 184 |
| `config/page_definitions/mothership/modules.php` | Configuration / contract | 210 |
| `config/page_definitions/mothership/ship.php` | Configuration / contract | 212 |
| `config/page_definitions/planets/planet-bonuses.php` | Configuration / contract | 255 |
| `config/page_definitions/planets/planet-defenses.php` | Configuration / contract | 256 |
| `config/page_definitions/planets/planet-list.php` | Configuration / contract | 269 |
| `config/page_definitions/social/alliances.php` | Configuration / contract | 237 |
| `config/page_definitions/social/messages.php` | Configuration / contract | 223 |
| `config/page_definitions/social/rankings.php` | Configuration / contract | 194 |
| `config/page_definitions/technology/tech-anti-covert.php` | Configuration / contract | 190 |
| `config/page_definitions/technology/tech-covert.php` | Configuration / contract | 190 |
| `config/page_definitions/technology/tech-defense.php` | Configuration / contract | 190 |
| `config/page_definitions/technology/tech-offense.php` | Configuration / contract | 190 |
| `config/page_definitions/technology/technology.php` | Configuration / contract | 193 |
| `config/page_definitions/training/miners.php` | Configuration / contract | 206 |
| `config/page_definitions/training/super-units.php` | Configuration / contract | 207 |
| `config/page_definitions/training/unit-production.php` | Configuration / contract | 179 |
| `config/page_definitions/training/units.php` | Configuration / contract | 211 |
| `config/page_definitions/universe/coordinates.php` | Configuration / contract | 183 |
| `config/page_definitions/universe/galaxies.php` | Configuration / contract | 170 |
| `config/page_definitions/universe/moons.php` | Configuration / contract | 199 |
| `config/page_definitions/universe/sectors.php` | Configuration / contract | 196 |
| `config/page_definitions/universe/solar-systems.php` | Configuration / contract | 194 |
| `config/page_definitions/universe/universe-planets.php` | Configuration / contract | 205 |
| `config/page_design_specs/account/ascension.php` | Configuration / contract | 93 |
| `config/page_design_specs/account/race.php` | Configuration / contract | 93 |
| `config/page_design_specs/account/vacation.php` | Configuration / contract | 93 |
| `config/page_design_specs/armory/repair.php` | Configuration / contract | 91 |
| `config/page_design_specs/armory/weapon-market.php` | Configuration / contract | 91 |
| `config/page_design_specs/armory/weapons.php` | Configuration / contract | 91 |
| `config/page_design_specs/attack/attack-log.php` | Configuration / contract | 91 |
| `config/page_design_specs/attack/sabotage.php` | Configuration / contract | 91 |
| `config/page_design_specs/attack/spy.php` | Configuration / contract | 91 |
| `config/page_design_specs/attack/targets.php` | Configuration / contract | 93 |
| `config/page_design_specs/command-center/account-info.php` | Configuration / contract | 86 |
| `config/page_design_specs/command-center/dashboard.php` | Configuration / contract | 103 |
| `config/page_design_specs/command-center/income.php` | Configuration / contract | 88 |
| `config/page_design_specs/command-center/military-stats.php` | Configuration / contract | 88 |
| `config/page_design_specs/command-center/resources.php` | Configuration / contract | 93 |
| `config/page_design_specs/intelligence/enemy-intelligence.php` | Configuration / contract | 86 |
| `config/page_design_specs/intelligence/spy-log.php` | Configuration / contract | 91 |
| `config/page_design_specs/market/mercenary-market.php` | Configuration / contract | 91 |
| `config/page_design_specs/market/resource-exchange.php` | Configuration / contract | 91 |
| `config/page_design_specs/mothership/exploration.php` | Configuration / contract | 91 |
| `config/page_design_specs/mothership/modules.php` | Configuration / contract | 91 |
| `config/page_design_specs/mothership/ship.php` | Configuration / contract | 91 |
| `config/page_design_specs/planets/planet-bonuses.php` | Configuration / contract | 88 |
| `config/page_design_specs/planets/planet-defenses.php` | Configuration / contract | 93 |
| `config/page_design_specs/planets/planet-list.php` | Configuration / contract | 93 |
| `config/page_design_specs/social/alliances.php` | Configuration / contract | 90 |
| `config/page_design_specs/social/messages.php` | Configuration / contract | 91 |
| `config/page_design_specs/social/rankings.php` | Configuration / contract | 91 |
| `config/page_design_specs/technology/tech-anti-covert.php` | Configuration / contract | 93 |
| `config/page_design_specs/technology/tech-covert.php` | Configuration / contract | 93 |
| `config/page_design_specs/technology/tech-defense.php` | Configuration / contract | 93 |
| `config/page_design_specs/technology/tech-offense.php` | Configuration / contract | 93 |
| `config/page_design_specs/technology/technology.php` | Configuration / contract | 93 |
| `config/page_design_specs/training/miners.php` | Configuration / contract | 91 |
| `config/page_design_specs/training/super-units.php` | Configuration / contract | 91 |
| `config/page_design_specs/training/unit-production.php` | Configuration / contract | 91 |
| `config/page_design_specs/training/units.php` | Configuration / contract | 91 |
| `config/page_design_specs/universe/coordinates.php` | Configuration / contract | 93 |
| `config/page_design_specs/universe/galaxies.php` | Configuration / contract | 91 |
| `config/page_design_specs/universe/moons.php` | Configuration / contract | 93 |
| `config/page_design_specs/universe/sectors.php` | Configuration / contract | 91 |
| `config/page_design_specs/universe/solar-systems.php` | Configuration / contract | 91 |
| `config/page_design_specs/universe/universe-planets.php` | Configuration / contract | 93 |
| `config/page_designs.php` | Configuration / contract | 41 |
| `config/page_feature_contracts.php` | Configuration / contract | 39 |
| `config/page_features/account/ascension.php` | Configuration / contract | 50 |
| `config/page_features/account/race.php` | Configuration / contract | 47 |
| `config/page_features/account/vacation.php` | Configuration / contract | 47 |
| `config/page_features/armory/repair.php` | Configuration / contract | 46 |
| `config/page_features/armory/weapon-market.php` | Configuration / contract | 50 |
| `config/page_features/armory/weapons.php` | Configuration / contract | 48 |
| `config/page_features/attack/attack-log.php` | Configuration / contract | 50 |
| `config/page_features/attack/sabotage.php` | Configuration / contract | 50 |
| `config/page_features/attack/spy.php` | Configuration / contract | 51 |
| `config/page_features/attack/targets.php` | Configuration / contract | 59 |
| `config/page_features/command-center/account-info.php` | Configuration / contract | 51 |
| `config/page_features/command-center/dashboard.php` | Configuration / contract | 52 |
| `config/page_features/command-center/income.php` | Configuration / contract | 49 |
| `config/page_features/command-center/military-stats.php` | Configuration / contract | 50 |
| `config/page_features/command-center/resources.php` | Configuration / contract | 50 |
| `config/page_features/intelligence/enemy-intelligence.php` | Configuration / contract | 46 |
| `config/page_features/intelligence/spy-log.php` | Configuration / contract | 49 |
| `config/page_features/market/mercenary-market.php` | Configuration / contract | 49 |
| `config/page_features/market/resource-exchange.php` | Configuration / contract | 50 |
| `config/page_features/mothership/exploration.php` | Configuration / contract | 47 |
| `config/page_features/mothership/modules.php` | Configuration / contract | 47 |
| `config/page_features/mothership/ship.php` | Configuration / contract | 49 |
| `config/page_features/planets/planet-bonuses.php` | Configuration / contract | 47 |
| `config/page_features/planets/planet-defenses.php` | Configuration / contract | 48 |
| `config/page_features/planets/planet-list.php` | Configuration / contract | 61 |
| `config/page_features/social/alliances.php` | Configuration / contract | 50 |
| `config/page_features/social/messages.php` | Configuration / contract | 51 |
| `config/page_features/social/rankings.php` | Configuration / contract | 48 |
| `config/page_features/technology/tech-anti-covert.php` | Configuration / contract | 48 |
| `config/page_features/technology/tech-covert.php` | Configuration / contract | 48 |
| `config/page_features/technology/tech-defense.php` | Configuration / contract | 48 |
| `config/page_features/technology/tech-offense.php` | Configuration / contract | 48 |
| `config/page_features/technology/technology.php` | Configuration / contract | 51 |
| `config/page_features/training/miners.php` | Configuration / contract | 46 |
| `config/page_features/training/super-units.php` | Configuration / contract | 47 |
| `config/page_features/training/unit-production.php` | Configuration / contract | 50 |
| `config/page_features/training/units.php` | Configuration / contract | 51 |
| `config/page_features/universe/coordinates.php` | Configuration / contract | 52 |
| `config/page_features/universe/galaxies.php` | Configuration / contract | 52 |
| `config/page_features/universe/moons.php` | Configuration / contract | 49 |
| `config/page_features/universe/sectors.php` | Configuration / contract | 53 |
| `config/page_features/universe/solar-systems.php` | Configuration / contract | 48 |
| `config/page_features/universe/universe-planets.php` | Configuration / contract | 50 |
| `config/page_function_maps/account/ascension.php` | Configuration / contract | 39 |
| `config/page_function_maps/account/race.php` | Configuration / contract | 39 |
| `config/page_function_maps/account/vacation.php` | Configuration / contract | 39 |
| `config/page_function_maps/armory/repair.php` | Configuration / contract | 39 |
| `config/page_function_maps/armory/weapon-market.php` | Configuration / contract | 41 |
| `config/page_function_maps/armory/weapons.php` | Configuration / contract | 39 |
| `config/page_function_maps/attack/attack-log.php` | Configuration / contract | 39 |
| `config/page_function_maps/attack/sabotage.php` | Configuration / contract | 39 |
| `config/page_function_maps/attack/spy.php` | Configuration / contract | 39 |
| `config/page_function_maps/attack/targets.php` | Configuration / contract | 45 |
| `config/page_function_maps/command-center/account-info.php` | Configuration / contract | 37 |
| `config/page_function_maps/command-center/dashboard.php` | Configuration / contract | 39 |
| `config/page_function_maps/command-center/income.php` | Configuration / contract | 37 |
| `config/page_function_maps/command-center/military-stats.php` | Configuration / contract | 37 |
| `config/page_function_maps/command-center/resources.php` | Configuration / contract | 41 |
| `config/page_function_maps/intelligence/enemy-intelligence.php` | Configuration / contract | 37 |
| `config/page_function_maps/intelligence/spy-log.php` | Configuration / contract | 39 |
| `config/page_function_maps/market/mercenary-market.php` | Configuration / contract | 39 |
| `config/page_function_maps/market/resource-exchange.php` | Configuration / contract | 41 |
| `config/page_function_maps/mothership/exploration.php` | Configuration / contract | 39 |
| `config/page_function_maps/mothership/modules.php` | Configuration / contract | 39 |
| `config/page_function_maps/mothership/ship.php` | Configuration / contract | 39 |
| `config/page_function_maps/planets/planet-bonuses.php` | Configuration / contract | 37 |
| `config/page_function_maps/planets/planet-defenses.php` | Configuration / contract | 39 |
| `config/page_function_maps/planets/planet-list.php` | Configuration / contract | 45 |
| `config/page_function_maps/social/alliances.php` | Configuration / contract | 41 |
| `config/page_function_maps/social/messages.php` | Configuration / contract | 41 |
| `config/page_function_maps/social/rankings.php` | Configuration / contract | 39 |
| `config/page_function_maps/technology/tech-anti-covert.php` | Configuration / contract | 39 |
| `config/page_function_maps/technology/tech-covert.php` | Configuration / contract | 39 |
| `config/page_function_maps/technology/tech-defense.php` | Configuration / contract | 39 |
| `config/page_function_maps/technology/tech-offense.php` | Configuration / contract | 39 |
| `config/page_function_maps/technology/technology.php` | Configuration / contract | 39 |
| `config/page_function_maps/training/miners.php` | Configuration / contract | 39 |
| `config/page_function_maps/training/super-units.php` | Configuration / contract | 39 |
| `config/page_function_maps/training/unit-production.php` | Configuration / contract | 39 |
| `config/page_function_maps/training/units.php` | Configuration / contract | 41 |
| `config/page_function_maps/universe/coordinates.php` | Configuration / contract | 39 |
| `config/page_function_maps/universe/galaxies.php` | Configuration / contract | 39 |
| `config/page_function_maps/universe/moons.php` | Configuration / contract | 41 |
| `config/page_function_maps/universe/sectors.php` | Configuration / contract | 39 |
| `config/page_function_maps/universe/solar-systems.php` | Configuration / contract | 41 |
| `config/page_function_maps/universe/universe-planets.php` | Configuration / contract | 41 |
| `config/page_logic/account/ascension.php` | Configuration / contract | 92 |
| `config/page_logic/account/race.php` | Configuration / contract | 87 |
| `config/page_logic/account/vacation.php` | Configuration / contract | 87 |
| `config/page_logic/armory/repair.php` | Configuration / contract | 85 |
| `config/page_logic/armory/weapon-market.php` | Configuration / contract | 90 |
| `config/page_logic/armory/weapons.php` | Configuration / contract | 84 |
| `config/page_logic/attack/attack-log.php` | Configuration / contract | 86 |
| `config/page_logic/attack/sabotage.php` | Configuration / contract | 91 |
| `config/page_logic/attack/spy.php` | Configuration / contract | 93 |
| `config/page_logic/attack/targets.php` | Configuration / contract | 99 |
| `config/page_logic/command-center/account-info.php` | Configuration / contract | 83 |
| `config/page_logic/command-center/dashboard.php` | Configuration / contract | 94 |
| `config/page_logic/command-center/income.php` | Configuration / contract | 85 |
| `config/page_logic/command-center/military-stats.php` | Configuration / contract | 85 |
| `config/page_logic/command-center/resources.php` | Configuration / contract | 91 |
| `config/page_logic/intelligence/enemy-intelligence.php` | Configuration / contract | 80 |
| `config/page_logic/intelligence/spy-log.php` | Configuration / contract | 84 |
| `config/page_logic/market/mercenary-market.php` | Configuration / contract | 88 |
| `config/page_logic/market/resource-exchange.php` | Configuration / contract | 90 |
| `config/page_logic/mothership/exploration.php` | Configuration / contract | 85 |
| `config/page_logic/mothership/modules.php` | Configuration / contract | 85 |
| `config/page_logic/mothership/ship.php` | Configuration / contract | 85 |
| `config/page_logic/planets/planet-bonuses.php` | Configuration / contract | 83 |
| `config/page_logic/planets/planet-defenses.php` | Configuration / contract | 85 |
| `config/page_logic/planets/planet-list.php` | Configuration / contract | 107 |
| `config/page_logic/social/alliances.php` | Configuration / contract | 89 |
| `config/page_logic/social/messages.php` | Configuration / contract | 88 |
| `config/page_logic/social/rankings.php` | Configuration / contract | 82 |
| `config/page_logic/technology/tech-anti-covert.php` | Configuration / contract | 87 |
| `config/page_logic/technology/tech-covert.php` | Configuration / contract | 87 |
| `config/page_logic/technology/tech-defense.php` | Configuration / contract | 87 |
| `config/page_logic/technology/tech-offense.php` | Configuration / contract | 87 |
| `config/page_logic/technology/technology.php` | Configuration / contract | 87 |
| `config/page_logic/training/miners.php` | Configuration / contract | 84 |
| `config/page_logic/training/super-units.php` | Configuration / contract | 86 |
| `config/page_logic/training/unit-production.php` | Configuration / contract | 92 |
| `config/page_logic/training/units.php` | Configuration / contract | 94 |
| `config/page_logic/universe/coordinates.php` | Configuration / contract | 95 |
| `config/page_logic/universe/galaxies.php` | Configuration / contract | 90 |
| `config/page_logic/universe/moons.php` | Configuration / contract | 86 |
| `config/page_logic/universe/sectors.php` | Configuration / contract | 92 |
| `config/page_logic/universe/solar-systems.php` | Configuration / contract | 85 |
| `config/page_logic/universe/universe-planets.php` | Configuration / contract | 89 |
| `config/page_registry.php` | Configuration / contract | 74 |
| `config/page_route_details.php` | Configuration / contract | 48 |
| `config/page_runtime_specs.php` | Configuration / contract | 33 |
| `config/page_subdesign/account/ascension.php` | Configuration / contract | 39 |
| `config/page_subdesign/account/race.php` | Configuration / contract | 39 |
| `config/page_subdesign/account/vacation.php` | Configuration / contract | 39 |
| `config/page_subdesign/armory/repair.php` | Configuration / contract | 38 |
| `config/page_subdesign/armory/weapon-market.php` | Configuration / contract | 38 |
| `config/page_subdesign/armory/weapons.php` | Configuration / contract | 38 |
| `config/page_subdesign/attack/attack-log.php` | Configuration / contract | 38 |
| `config/page_subdesign/attack/sabotage.php` | Configuration / contract | 38 |
| `config/page_subdesign/attack/spy.php` | Configuration / contract | 38 |
| `config/page_subdesign/attack/targets.php` | Configuration / contract | 39 |
| `config/page_subdesign/command-center/account-info.php` | Configuration / contract | 38 |
| `config/page_subdesign/command-center/dashboard.php` | Configuration / contract | 44 |
| `config/page_subdesign/command-center/income.php` | Configuration / contract | 39 |
| `config/page_subdesign/command-center/military-stats.php` | Configuration / contract | 39 |
| `config/page_subdesign/command-center/resources.php` | Configuration / contract | 39 |
| `config/page_subdesign/intelligence/enemy-intelligence.php` | Configuration / contract | 38 |
| `config/page_subdesign/intelligence/spy-log.php` | Configuration / contract | 38 |
| `config/page_subdesign/market/mercenary-market.php` | Configuration / contract | 38 |
| `config/page_subdesign/market/resource-exchange.php` | Configuration / contract | 38 |
| `config/page_subdesign/mothership/exploration.php` | Configuration / contract | 38 |
| `config/page_subdesign/mothership/modules.php` | Configuration / contract | 38 |
| `config/page_subdesign/mothership/ship.php` | Configuration / contract | 38 |
| `config/page_subdesign/planets/planet-bonuses.php` | Configuration / contract | 39 |
| `config/page_subdesign/planets/planet-defenses.php` | Configuration / contract | 39 |
| `config/page_subdesign/planets/planet-list.php` | Configuration / contract | 39 |
| `config/page_subdesign/social/alliances.php` | Configuration / contract | 37 |
| `config/page_subdesign/social/messages.php` | Configuration / contract | 38 |
| `config/page_subdesign/social/rankings.php` | Configuration / contract | 38 |
| `config/page_subdesign/technology/tech-anti-covert.php` | Configuration / contract | 39 |
| `config/page_subdesign/technology/tech-covert.php` | Configuration / contract | 39 |
| `config/page_subdesign/technology/tech-defense.php` | Configuration / contract | 39 |
| `config/page_subdesign/technology/tech-offense.php` | Configuration / contract | 39 |
| `config/page_subdesign/technology/technology.php` | Configuration / contract | 39 |
| `config/page_subdesign/training/miners.php` | Configuration / contract | 38 |
| `config/page_subdesign/training/super-units.php` | Configuration / contract | 38 |
| `config/page_subdesign/training/unit-production.php` | Configuration / contract | 38 |
| `config/page_subdesign/training/units.php` | Configuration / contract | 38 |
| `config/page_subdesign/universe/coordinates.php` | Configuration / contract | 39 |
| `config/page_subdesign/universe/galaxies.php` | Configuration / contract | 38 |
| `config/page_subdesign/universe/moons.php` | Configuration / contract | 39 |
| `config/page_subdesign/universe/sectors.php` | Configuration / contract | 38 |
| `config/page_subdesign/universe/solar-systems.php` | Configuration / contract | 38 |
| `config/page_subdesign/universe/universe-planets.php` | Configuration / contract | 39 |
| `config/page_systems/account/ascension.php` | Configuration / contract | 30 |
| `config/page_systems/account/race.php` | Configuration / contract | 30 |
| `config/page_systems/account/vacation.php` | Configuration / contract | 30 |
| `config/page_systems/armory/repair.php` | Configuration / contract | 24 |
| `config/page_systems/armory/weapon-market.php` | Configuration / contract | 28 |
| `config/page_systems/armory/weapons.php` | Configuration / contract | 25 |
| `config/page_systems/attack/attack-log.php` | Configuration / contract | 26 |
| `config/page_systems/attack/sabotage.php` | Configuration / contract | 30 |
| `config/page_systems/attack/spy.php` | Configuration / contract | 30 |
| `config/page_systems/attack/targets.php` | Configuration / contract | 33 |
| `config/page_systems/command-center/account-info.php` | Configuration / contract | 28 |
| `config/page_systems/command-center/dashboard.php` | Configuration / contract | 35 |
| `config/page_systems/command-center/income.php` | Configuration / contract | 26 |
| `config/page_systems/command-center/military-stats.php` | Configuration / contract | 28 |
| `config/page_systems/command-center/resources.php` | Configuration / contract | 24 |
| `config/page_systems/intelligence/enemy-intelligence.php` | Configuration / contract | 26 |
| `config/page_systems/intelligence/spy-log.php` | Configuration / contract | 26 |
| `config/page_systems/market/mercenary-market.php` | Configuration / contract | 28 |
| `config/page_systems/market/resource-exchange.php` | Configuration / contract | 28 |
| `config/page_systems/mothership/exploration.php` | Configuration / contract | 25 |
| `config/page_systems/mothership/modules.php` | Configuration / contract | 27 |
| `config/page_systems/mothership/ship.php` | Configuration / contract | 27 |
| `config/page_systems/planets/planet-bonuses.php` | Configuration / contract | 31 |
| `config/page_systems/planets/planet-defenses.php` | Configuration / contract | 31 |
| `config/page_systems/planets/planet-list.php` | Configuration / contract | 31 |
| `config/page_systems/social/alliances.php` | Configuration / contract | 32 |
| `config/page_systems/social/messages.php` | Configuration / contract | 28 |
| `config/page_systems/social/rankings.php` | Configuration / contract | 26 |
| `config/page_systems/technology/tech-anti-covert.php` | Configuration / contract | 27 |
| `config/page_systems/technology/tech-covert.php` | Configuration / contract | 27 |
| `config/page_systems/technology/tech-defense.php` | Configuration / contract | 27 |
| `config/page_systems/technology/tech-offense.php` | Configuration / contract | 27 |
| `config/page_systems/technology/technology.php` | Configuration / contract | 27 |
| `config/page_systems/training/miners.php` | Configuration / contract | 26 |
| `config/page_systems/training/super-units.php` | Configuration / contract | 26 |
| `config/page_systems/training/unit-production.php` | Configuration / contract | 25 |
| `config/page_systems/training/units.php` | Configuration / contract | 26 |
| `config/page_systems/universe/coordinates.php` | Configuration / contract | 24 |
| `config/page_systems/universe/galaxies.php` | Configuration / contract | 20 |
| `config/page_systems/universe/moons.php` | Configuration / contract | 26 |
| `config/page_systems/universe/sectors.php` | Configuration / contract | 20 |
| `config/page_systems/universe/solar-systems.php` | Configuration / contract | 25 |
| `config/page_systems/universe/universe-planets.php` | Configuration / contract | 26 |
| `config/player_interaction_contracts.php` | Configuration / contract | 33 |
| `config/progression_catalog.php` | Configuration / contract | 19 |
| `config/settings.php` | Configuration / contract | 43 |
| `cron/process_turns.php` | Scheduled job | 13 |
| `docs/game-rules.php` | PHP source | 2 |
| `docs/privacy.php` | PHP source | 2 |
| `docs/status.php` | PHP source | 2 |
| `docs/terms.php` | PHP source | 2 |
| `game.php` | PHP source | 251 |
| `includes/layout.php` | PHP source | 58 |
| `includes/page_modules/account/ascension.php` | Page module | 24 |
| `includes/page_modules/account/race.php` | Page module | 24 |
| `includes/page_modules/account/vacation.php` | Page module | 24 |
| `includes/page_modules/armory/repair.php` | Page module | 24 |
| `includes/page_modules/armory/weapon-market.php` | Page module | 24 |
| `includes/page_modules/armory/weapons.php` | Page module | 24 |
| `includes/page_modules/attack/attack-log.php` | Page module | 24 |
| `includes/page_modules/attack/sabotage.php` | Page module | 24 |
| `includes/page_modules/attack/spy.php` | Page module | 24 |
| `includes/page_modules/attack/targets.php` | Page module | 24 |
| `includes/page_modules/command-center/account-info.php` | Page module | 24 |
| `includes/page_modules/command-center/dashboard.php` | Page module | 24 |
| `includes/page_modules/command-center/income.php` | Page module | 24 |
| `includes/page_modules/command-center/military-stats.php` | Page module | 24 |
| `includes/page_modules/command-center/resources.php` | Page module | 24 |
| `includes/page_modules/intelligence/enemy-intelligence.php` | Page module | 24 |
| `includes/page_modules/intelligence/spy-log.php` | Page module | 24 |
| `includes/page_modules/market/mercenary-market.php` | Page module | 24 |
| `includes/page_modules/market/resource-exchange.php` | Page module | 24 |
| `includes/page_modules/mothership/exploration.php` | Page module | 24 |
| `includes/page_modules/mothership/modules.php` | Page module | 24 |
| `includes/page_modules/mothership/ship.php` | Page module | 24 |
| `includes/page_modules/planets/planet-bonuses.php` | Page module | 24 |
| `includes/page_modules/planets/planet-defenses.php` | Page module | 24 |
| `includes/page_modules/planets/planet-list.php` | Page module | 24 |
| `includes/page_modules/social/alliances.php` | Page module | 24 |
| `includes/page_modules/social/messages.php` | Page module | 24 |
| `includes/page_modules/social/rankings.php` | Page module | 24 |
| `includes/page_modules/technology/tech-anti-covert.php` | Page module | 24 |
| `includes/page_modules/technology/tech-covert.php` | Page module | 24 |
| `includes/page_modules/technology/tech-defense.php` | Page module | 24 |
| `includes/page_modules/technology/tech-offense.php` | Page module | 24 |
| `includes/page_modules/technology/technology.php` | Page module | 24 |
| `includes/page_modules/training/miners.php` | Page module | 24 |
| `includes/page_modules/training/super-units.php` | Page module | 24 |
| `includes/page_modules/training/unit-production.php` | Page module | 24 |
| `includes/page_modules/training/units.php` | Page module | 24 |
| `includes/page_modules/universe/coordinates.php` | Page module | 24 |
| `includes/page_modules/universe/galaxies.php` | Page module | 24 |
| `includes/page_modules/universe/moons.php` | Page module | 24 |
| `includes/page_modules/universe/sectors.php` | Page module | 24 |
| `includes/page_modules/universe/solar-systems.php` | Page module | 24 |
| `includes/page_modules/universe/universe-planets.php` | Page module | 24 |
| `includes/services/AllianceService.php` | Authoritative service | 38 |
| `includes/services/AntiCovertTechnologyService.php` | Authoritative service | 18 |
| `includes/services/CovertTechnologyService.php` | Authoritative service | 18 |
| `includes/services/DashboardService.php` | Authoritative service | 30 |
| `includes/services/DefenseTechnologyService.php` | Authoritative service | 31 |
| `includes/services/DesignCatalogService.php` | Authoritative service | 55 |
| `includes/services/EconomyService.php` | Authoritative service | 75 |
| `includes/services/EmpireOperationsService.php` | Authoritative service | 68 |
| `includes/services/EnemyIntelligenceService.php` | Authoritative service | 20 |
| `includes/services/FactionService.php` | Authoritative service | 19 |
| `includes/services/FormulaService.php` | Authoritative service | 65 |
| `includes/services/GameFeatureService.php` | Authoritative service | 42 |
| `includes/services/GameMechanicsService.php` | Authoritative service | 132 |
| `includes/services/GameRulesCatalog.php` | Authoritative service | 32 |
| `includes/services/GameService.php` | Authoritative service | 202 |
| `includes/services/MMORPGService.php` | Authoritative service | 15 |
| `includes/services/MercenaryMarketService.php` | Authoritative service | 36 |
| `includes/services/MessagingService.php` | Authoritative service | 38 |
| `includes/services/MothershipExplorationService.php` | Authoritative service | 20 |
| `includes/services/MothershipService.php` | Authoritative service | 27 |
| `includes/services/OGameService.php` | Authoritative service | 19 |
| `includes/services/OffenseTechnologyService.php` | Authoritative service | 23 |
| `includes/services/PageDataService.php` | Authoritative service | 13 |
| `includes/services/PageFeatureService.php` | Authoritative service | 28 |
| `includes/services/PlanetBonusService.php` | Authoritative service | 13 |
| `includes/services/PlanetDefenseService.php` | Authoritative service | 21 |
| `includes/services/PlanetService.php` | Authoritative service | 38 |
| `includes/services/ProceduralUniverseService.php` | Authoritative service | 201 |
| `includes/services/ProgressionService.php` | Authoritative service | 11 |
| `includes/services/RankingsService.php` | Authoritative service | 46 |
| `includes/services/ResourceMarketService.php` | Authoritative service | 66 |
| `includes/services/Rules.php` | Authoritative service | 10 |
| `includes/services/SocialService.php` | Authoritative service | 15 |
| `includes/services/SpyLogService.php` | Authoritative service | 26 |
| `includes/services/SuperUnitService.php` | Authoritative service | 18 |
| `includes/services/TechnologyTreeService.php` | Authoritative service | 23 |
| `includes/services/UnitProductionService.php` | Authoritative service | 29 |
| `includes/services/UnitTrainingService.php` | Authoritative service | 37 |
| `includes/services/WeaponMarketService.php` | Authoritative service | 119 |
| `includes/services/WeaponRepairService.php` | Authoritative service | 49 |
| `includes/services/WorkforceService.php` | Authoritative service | 16 |
| `includes/services/WorldService.php` | Authoritative service | 31 |
| `index.php` | PHP source | 76 |
| `login.php` | PHP source | 58 |
| `logout.php` | PHP source | 7 |
| `modular-pages-preview.php` | PHP source | 48 |
| `pages/PAGE_TREE_MANIFEST.php` | Page entry | 311 |
| `pages/_entry.php` | Page entry | 9 |
| `pages/_nested_entry.php` | Page entry | 10 |
| `pages/account-info.php` | Page entry | 4 |
| `pages/account/index.php` | Page entry | 4 |
| `pages/account/page-manifest.php` | Page entry | 60 |
| `pages/account/subpages/ascension.php` | Page entry | 4 |
| `pages/account/subpages/race.php` | Page entry | 4 |
| `pages/account/subpages/vacation.php` | Page entry | 4 |
| `pages/alliances.php` | Page entry | 4 |
| `pages/armory/index.php` | Page entry | 4 |
| `pages/armory/page-manifest.php` | Page entry | 60 |
| `pages/armory/subpages/repair.php` | Page entry | 4 |
| `pages/armory/subpages/weapon-market.php` | Page entry | 4 |
| `pages/armory/subpages/weapons.php` | Page entry | 4 |
| `pages/ascension.php` | Page entry | 4 |
| `pages/attack-log.php` | Page entry | 4 |
| `pages/attack/index.php` | Page entry | 4 |
| `pages/attack/page-manifest.php` | Page entry | 81 |
| `pages/attack/subpages/attack-log.php` | Page entry | 4 |
| `pages/attack/subpages/sabotage.php` | Page entry | 4 |
| `pages/attack/subpages/spy.php` | Page entry | 4 |
| `pages/attack/subpages/targets.php` | Page entry | 4 |
| `pages/colonies.php` | Page entry | 4 |
| `pages/command-center/index.php` | Page entry | 4 |
| `pages/command-center/page-manifest.php` | Page entry | 96 |
| `pages/command-center/subpages/account-info.php` | Page entry | 4 |
| `pages/command-center/subpages/dashboard.php` | Page entry | 4 |
| `pages/command-center/subpages/income.php` | Page entry | 4 |
| `pages/command-center/subpages/military-stats.php` | Page entry | 4 |
| `pages/command-center/subpages/resources.php` | Page entry | 4 |
| `pages/coordinates.php` | Page entry | 4 |
| `pages/dashboard.php` | Page entry | 4 |
| `pages/defense-grid.php` | Page entry | 4 |
| `pages/enemy-intelligence.php` | Page entry | 4 |
| `pages/energy.php` | Page entry | 4 |
| `pages/event-history.php` | Page entry | 4 |
| `pages/events.php` | Page entry | 4 |
| `pages/exploration.php` | Page entry | 4 |
| `pages/fleet-overview.php` | Page entry | 4 |
| `pages/food-water.php` | Page entry | 4 |
| `pages/galaxies.php` | Page entry | 4 |
| `pages/income.php` | Page entry | 4 |
| `pages/intelligence/index.php` | Page entry | 4 |
| `pages/intelligence/page-manifest.php` | Page entry | 41 |
| `pages/intelligence/subpages/enemy-intelligence.php` | Page entry | 4 |
| `pages/intelligence/subpages/spy-log.php` | Page entry | 4 |
| `pages/life-support.php` | Page entry | 4 |
| `pages/market/index.php` | Page entry | 4 |
| `pages/market/page-manifest.php` | Page entry | 44 |
| `pages/market/subpages/mercenary-market.php` | Page entry | 4 |
| `pages/market/subpages/resource-exchange.php` | Page entry | 4 |
| `pages/mercenary-market.php` | Page entry | 4 |
| `pages/messages.php` | Page entry | 4 |
| `pages/military-stats.php` | Page entry | 4 |
| `pages/miners.php` | Page entry | 4 |
| `pages/mission-log.php` | Page entry | 4 |
| `pages/missions.php` | Page entry | 4 |
| `pages/modules.php` | Page entry | 4 |
| `pages/moons.php` | Page entry | 4 |
| `pages/mothership.php` | Page entry | 7 |
| `pages/mothership/index.php` | Page entry | 4 |
| `pages/mothership/page-manifest.php` | Page entry | 57 |
| `pages/mothership/subpages/exploration.php` | Page entry | 4 |
| `pages/mothership/subpages/modules.php` | Page entry | 4 |
| `pages/mothership/subpages/ship.php` | Page entry | 4 |
| `pages/navigation.php` | Page entry | 4 |
| `pages/planet-bonuses.php` | Page entry | 4 |
| `pages/planet-defenses.php` | Page entry | 4 |
| `pages/planet-list.php` | Page entry | 4 |
| `pages/planets.php` | Page entry | 7 |
| `pages/planets/index.php` | Page entry | 4 |
| `pages/planets/page-manifest.php` | Page entry | 66 |
| `pages/planets/subpages/planet-bonuses.php` | Page entry | 4 |
| `pages/planets/subpages/planet-defenses.php` | Page entry | 4 |
| `pages/planets/subpages/planet-list.php` | Page entry | 4 |
| `pages/population.php` | Page entry | 4 |
| `pages/race.php` | Page entry | 4 |
| `pages/rankings.php` | Page entry | 4 |
| `pages/repair.php` | Page entry | 4 |
| `pages/research.php` | Page entry | 4 |
| `pages/resource-buildings.php` | Page entry | 4 |
| `pages/resource-exchange.php` | Page entry | 4 |
| `pages/resources.php` | Page entry | 4 |
| `pages/sabotage.php` | Page entry | 4 |
| `pages/sectors.php` | Page entry | 4 |
| `pages/ship.php` | Page entry | 4 |
| `pages/shipyard.php` | Page entry | 4 |
| `pages/social/index.php` | Page entry | 4 |
| `pages/social/page-manifest.php` | Page entry | 61 |
| `pages/social/subpages/alliances.php` | Page entry | 4 |
| `pages/social/subpages/messages.php` | Page entry | 4 |
| `pages/social/subpages/rankings.php` | Page entry | 4 |
| `pages/solar-systems.php` | Page entry | 4 |
| `pages/spy-log.php` | Page entry | 4 |
| `pages/spy.php` | Page entry | 4 |
| `pages/super-units.php` | Page entry | 4 |
| `pages/targets.php` | Page entry | 4 |
| `pages/tech-anti-covert.php` | Page entry | 4 |
| `pages/tech-covert.php` | Page entry | 4 |
| `pages/tech-defense.php` | Page entry | 4 |
| `pages/tech-offense.php` | Page entry | 4 |
| `pages/technology.php` | Page entry | 4 |
| `pages/technology/index.php` | Page entry | 4 |
| `pages/technology/page-manifest.php` | Page entry | 91 |
| `pages/technology/subpages/tech-anti-covert.php` | Page entry | 4 |
| `pages/technology/subpages/tech-covert.php` | Page entry | 4 |
| `pages/technology/subpages/tech-defense.php` | Page entry | 4 |
| `pages/technology/subpages/tech-offense.php` | Page entry | 4 |
| `pages/technology/subpages/technology.php` | Page entry | 4 |
| `pages/training/index.php` | Page entry | 4 |
| `pages/training/page-manifest.php` | Page entry | 81 |
| `pages/training/subpages/miners.php` | Page entry | 4 |
| `pages/training/subpages/super-units.php` | Page entry | 4 |
| `pages/training/subpages/unit-production.php` | Page entry | 4 |
| `pages/training/subpages/units.php` | Page entry | 4 |
| `pages/unit-production.php` | Page entry | 4 |
| `pages/units.php` | Page entry | 4 |
| `pages/universe-planets.php` | Page entry | 4 |
| `pages/universe/index.php` | Page entry | 4 |
| `pages/universe/page-manifest.php` | Page entry | 123 |
| `pages/universe/subpages/coordinates.php` | Page entry | 4 |
| `pages/universe/subpages/galaxies.php` | Page entry | 4 |
| `pages/universe/subpages/moons.php` | Page entry | 4 |
| `pages/universe/subpages/sectors.php` | Page entry | 4 |
| `pages/universe/subpages/solar-systems.php` | Page entry | 4 |
| `pages/universe/subpages/universe-planets.php` | Page entry | 4 |
| `pages/vacation.php` | Page entry | 4 |
| `pages/weapon-market.php` | Page entry | 4 |
| `pages/weapons.php` | Page entry | 4 |
| `preview.php` | PHP source | 21 |
| `public-landing.php` | PHP source | 27 |
| `register.php` | PHP source | 27 |
| `schema-explorer.php` | PHP source | 8 |
| `src/Engine/CombatResolver.php` | PHP source | 14 |
| `src/Engine/CovertEngine.php` | PHP source | 8 |
| `src/Engine/Formulas.php` | PHP source | 13 |
| `src/Engine/LifeSupportEngine.php` | PHP source | 10 |
| `src/Engine/TurnProcessor.php` | PHP source | 25 |
| `src/Http/Request.php` | PHP source | 9 |
| `src/Http/Response.php` | PHP source | 7 |
| `src/Http/Router.php` | PHP source | 10 |
| `src/Repository/Database.php` | PHP source | 9 |
| `src/Repository/PlayerRepository.php` | PHP source | 11 |
| `tests/alliance_action_repro.php` | Test | 12 |
| `tests/alliance_contract_test.php` | Test | 5 |
| `tests/alliance_flow_test.php` | Test | 18 |
| `tests/ascension_contract_test.php` | Test | 26 |
| `tests/attack_reports_test.php` | Test | 10 |
| `tests/coordinate_search_contract_test.php` | Test | 43 |
| `tests/defcon_cooldown_test.php` | Test | 25 |
| `tests/design_catalog_mechanics_test.php` | Test | 23 |
| `tests/deuterium_resource_test.php` | Test | 21 |
| `tests/economy_edge_cases_test.php` | Test | 17 |
| `tests/empire_operations_test.php` | Test | 10 |
| `tests/faction_selection_contract_test.php` | Test | 33 |
| `tests/full_module_architecture_test.php` | Test | 56 |
| `tests/galaxy_map_contract_test.php` | Test | 6 |
| `tests/income_breakdown_test.php` | Test | 35 |
| `tests/mercenary_market_contract_test.php` | Test | 5 |
| `tests/messaging_contract_test.php` | Test | 5 |
| `tests/messaging_flow_test.php` | Test | 6 |
| `tests/military_stats_test.php` | Test | 23 |
| `tests/moon_registry_contract_test.php` | Test | 9 |
| `tests/mothership_exploration_contract_test.php` | Test | 36 |
| `tests/ogame_life_support_test.php` | Test | 16 |
| `tests/page_module_smoke.php` | Test | 59 |
| `tests/page_modules_integration.php` | Test | 103 |
| `tests/planet_list_contract_metadata_test.php` | Test | 38 |
| `tests/planet_list_contract_test.php` | Test | 5 |
| `tests/procedural_universe_test.php` | Test | 21 |
| `tests/rankings_refresh_test.php` | Test | 23 |
| `tests/resource_market_contract_test.php` | Test | 6 |
| `tests/route_stress_test.php` | Test | 98 |
| `tests/sabotage_operations_test.php` | Test | 17 |
| `tests/sabotage_persistence_test.php` | Test | 19 |
| `tests/sector_map_contract_test.php` | Test | 6 |
| `tests/service_bootstrap_smoke.php` | Test | 20 |
| `tests/smoke_test.php` | Test | 14 |
| `tests/solar_systems_contract_test.php` | Test | 6 |
| `tests/spy_operations_test.php` | Test | 22 |
| `tests/target_selection_test.php` | Test | 23 |
| `tests/training_contract_test.php` | Test | 72 |
| `tests/training_production_contract_test.php` | Test | 10 |
| `tests/turn_load_500.php` | Test | 16 |
| `tests/turn_settlement_e2e.php` | Test | 47 |
| `tests/universe_planets_contract_test.php` | Test | 44 |
| `tests/vacation_mode_contract_test.php` | Test | 33 |
| `tests/vault_contract_test.php` | Test | 18 |
| `tests/weapon_inventory_test.php` | Test | 7 |
| `tests/weapon_market_contract_test.php` | Test | 10 |
| `tests/weapon_repair_contract_test.php` | Test | 8 |
| `tools/add_reports_renderer.php` | PHP source | 8 |
| `tools/add_sabotage_renderer.php` | PHP source | 13 |
| `tools/add_weapon_inventory_renderer.php` | PHP source | 8 |
| `tools/apply_anti_covert_technology_migration.php` | PHP source | 8 |
| `tools/apply_covert_technology_migration.php` | PHP source | 8 |
| `tools/apply_defense_technology_migration.php` | PHP source | 9 |
| `tools/apply_nontransactional_migrations.php` | PHP source | 32 |
| `tools/apply_offense_technology_migration.php` | PHP source | 8 |
| `tools/apply_population_update.php` | PHP source | 16 |
| `tools/apply_research_queues_migration.php` | PHP source | 7 |
| `tools/apply_sabotage_damage_migration.php` | PHP source | 17 |
| `tools/apply_super_units_migration.php` | PHP source | 9 |
| `tools/apply_unit_production_migration.php` | PHP source | 8 |
| `tools/apply_unit_training_migration.php` | PHP source | 10 |
| `tools/apply_weapon_market_migration.php` | PHP source | 16 |
| `tools/apply_workforce_migration.php` | PHP source | 9 |
| `tools/audit_factions.php` | PHP source | 16 |
| `tools/audit_game_features.php` | PHP source | 24 |
| `tools/audit_modules.php` | PHP source | 6 |
| `tools/audit_pages.php` | PHP source | 19 |
| `tools/audit_player_interactions.php` | PHP source | 20 |
| `tools/audit_requested_pages.php` | PHP source | 13 |
| `tools/audit_universe.php` | PHP source | 9 |
| `tools/check_page_contract_json.php` | PHP source | 9 |
| `tools/create_demo_account.php` | PHP source | 7 |
| `tools/deploy_database.php` | PHP source | 167 |
| `tools/expand_page_architecture.php` | PHP source | 147 |
| `tools/feature_coverage_audit.php` | PHP source | 62 |
| `tools/generate_all_game_pages.php` | PHP source | 17 |
| `tools/generate_api_reference.php` | PHP source | 10 |
| `tools/generate_page_coverage.php` | PHP source | 28 |
| `tools/generate_page_tree.php` | PHP source | 113 |
| `tools/generate_standalone_pages.php` | PHP source | 19 |
| `tools/inspect_alliance_schema.php` | PHP source | 6 |
| `tools/inspect_new_system_tables.php` | PHP source | 11 |
| `tools/inspect_population_state.php` | PHP source | 7 |
| `tools/repair_failed_migrations.php` | PHP source | 8 |
| `tools/replace_military_renderer.php` | PHP source | 15 |
| `tools/validate_contracts.php` | PHP source | 31 |
| `tools/validate_page_links.php` | PHP source | 48 |

# Service Catalog

The service layer is authoritative for gameplay calculations and mutations. Controllers should validate request shape and delegate state changes to services.

| File | Class | Public methods |
|---|---|---|
| `includes/services/AllianceService.php` | AllianceService | __construct, snapshot, create, join |
| `includes/services/AntiCovertTechnologyService.php` | AntiCovertTechnologyService | __construct, snapshot, upgrade |
| `includes/services/CovertTechnologyService.php` | CovertTechnologyService | __construct, snapshot, upgrade |
| `includes/services/DashboardService.php` | DashboardService | __construct, snapshot, assertPlayerCanProcessTurns |
| `includes/services/DefenseTechnologyService.php` | DefenseTechnologyService | __construct, snapshot, upgrade |
| `includes/services/DesignCatalogService.php` | DesignCatalogService | __construct, snapshot, get, all, formula |
| `includes/services/EconomyService.php` | EconomyService | __construct, calculatePopulationState, settlePlayerColonies, settleColony, incomeBreakdown, colonyComparison |
| `includes/services/EmpireOperationsService.php` | EmpireOperationsService | __construct, snapshot, resolveExpedition, startQuest, claimQuest, markNotificationRead |
| `includes/services/EnemyIntelligenceService.php` | EnemyIntelligenceService | __construct, snapshot |
| `includes/services/FactionService.php` | FactionService | __construct, options, snapshot, selectRegistration, changeRace, reformGovernment, bonuses |
| `includes/services/FormulaService.php` | FormulaService | — |
| `includes/services/GameFeatureService.php` | GameFeatureService | __construct, queueResearch, joinWorldEvent, recordDiscovery |
| `includes/services/GameMechanicsService.php` | GameMechanicsService | __construct, catalog, production, cost, storageCapacity, clampResource, fleetPower, travelSeconds, fuelCost, combatPower, rapidFireDamage, loot, debris, espionageDetection, populationGrowth, stability, rankingScore, validateKey |
| `includes/services/GameRulesCatalog.php` | GameRulesCatalog | — |
| `includes/services/GameService.php` | GameService | __construct, processTurns, deposit, withdraw, changeRace, train, upgradeUnitProduction, buyTechnology, buyWeapon, repairWeapons, upgradeMothership, militaryStats, targetBoard, combatPreview, weaponInventory, reportFeed, readReport, covertStats, covertPreview, resolveCombat, setDefcon, covertMission |
| `includes/services/MMORPGService.php` | MMORPGService | __construct, addExperience, setCooldown, assertAvailable, proposeDiplomacy, createTrade, notify, beginTurnBatch, finishTurnBatch |
| `includes/services/MercenaryMarketService.php` | MercenaryMarketService | __construct, snapshot, buy |
| `includes/services/MessagingService.php` | MessagingService | __construct, inbox, send, markRead, blacklist |
| `includes/services/MothershipExplorationService.php` | MothershipExplorationService | __construct, snapshot, explore |
| `includes/services/MothershipService.php` | MothershipService | __construct, snapshot, upgrade |
| `includes/services/OGameService.php` | OGameService | __construct, processColonyTurn, queueBuilding, launchMission |
| `includes/services/OffenseTechnologyService.php` | OffenseTechnologyService | __construct, snapshot, upgrade |
| `includes/services/PageDataService.php` | PageDataService | __construct, colonies, colony, balances, queue, missions, snapshots, eventLog |
| `includes/services/PageFeatureService.php` | PageFeatureService | __construct, get, supports, routeSummary |
| `includes/services/PlanetBonusService.php` | PlanetBonusService | __construct, snapshot |
| `includes/services/PlanetDefenseService.php` | PlanetDefenseService | __construct, snapshot, upgrade |
| `includes/services/PlanetService.php` | PlanetService | __construct, list, explore, colonize, upgradeDefense |
| `includes/services/ProceduralUniverseService.php` | ProceduralUniverseService | __construct, config, canonicalKey, locate, scan, explore, claim |
| `includes/services/ProgressionService.php` | ProgressionService | __construct, tiers, level, entity, cost, advance |
| `includes/services/RankingsService.php` | RankingsService | __construct, rankings, refresh, publicProfile |
| `includes/services/ResourceMarketService.php` | ResourceMarketService | __construct, snapshot, listOrder, buyOrder |
| `includes/services/Rules.php` | Rules | — |
| `includes/services/SocialService.php` | SocialService | __construct, blacklist |
| `includes/services/SpyLogService.php` | SpyLogService | __construct, snapshot, markRead |
| `includes/services/SuperUnitService.php` | SuperUnitService | __construct, snapshot, train |
| `includes/services/TechnologyTreeService.php` | TechnologyTreeService | __construct, snapshot, upgrade |
| `includes/services/UnitProductionService.php` | UnitProductionService | __construct, snapshot, upgrade |
| `includes/services/UnitTrainingService.php` | UnitTrainingService | __construct, snapshot, train, upgradeProduction |
| `includes/services/WeaponMarketService.php` | WeaponMarketService | __construct, snapshot, listWeaponOrder, buyWeaponOrder |
| `includes/services/WeaponRepairService.php` | WeaponRepairService | __construct, snapshot, repair |
| `includes/services/WorkforceService.php` | WorkforceService | __construct, snapshot |
| `includes/services/WorldService.php` | WorldService | __construct, explore, upgradePlanetDefense, joinAlliance, buyMarketOrder, markMessageRead, createAlliance, listMarketOrder, buyMercenary, sendMessage, activateVacation, refreshRanking, ascend, listGalaxies, listSectors, listSystems, solarSystemSnapshot, exploreAnomaly, getSystemMap, getPlanetDetails, getMoonDetails, colonizePlanet |

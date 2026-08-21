# Universe Civilization: Empire at Wars — Game Design Document

## 1. Game identity

**Universe Civilization: Empire at Wars** is a text-based massively multiplayer real-time strategy and role-playing game. The player is an authenticated commander who establishes colonies, manages a civilization, researches strategic technologies, builds units and starships, explores a deterministic universe, conducts diplomacy, and competes for military, economic, technological, and seasonal prestige.

The game combines the long-term planning of a civilization builder with the operational tempo of a fleet strategy game. Its primary design principle is that the browser expresses commander intent while the server validates, calculates, persists, and audits the authoritative outcome.

| Design pillar | Player promise |
|---|---|
| Build an empire | Every colony, technology, fleet, and alliance contributes to a persistent civilization. |
| Explore a living universe | Coordinates produce repeatable galaxies, sectors, systems, planets, moons, anomalies, and travel opportunities. |
| Make meaningful trade-offs | Resources, population, queues, protection, technology, and military readiness compete for the same strategic attention. |
| Compete fairly | Server-side authority, deterministic formulas, ownership checks, cooldowns, and transaction safeguards limit manipulation. |
| Progress across eras | Twenty-one tiers and twenty-three levels per tier create a long strategic arc from first settlement to ascension. |

## 2. Audience and experience goals

The game is designed for strategy players who enjoy persistent progression, spreadsheet-like optimization, asynchronous operations, exploration, diplomacy, and competitive ranking. The interface is intentionally information-dense but modular: the left navigation exposes systems, the central dashboard presents the selected page, and the top header keeps commander identity and resources visible.

The intended session can be short or long. A short session may review resources, queue research, inspect reports, or process a turn. A long session may plan a colonization route, compare targets, coordinate an alliance project, prepare a fleet, or investigate an anomaly chain.

## 3. Core player loop

1. **Observe:** Read resource balances, colony output, military readiness, messages, reports, rankings, and map telemetry.
2. **Plan:** Choose a research branch, construction queue, training order, exploration target, trade, diplomatic action, or military operation.
3. **Commit:** Submit a server-validated action with authentication and CSRF protection.
4. **Resolve:** The service layer validates ownership, prerequisites, resources, queue capacity, cooldowns, protection, and deterministic formulas.
5. **Persist:** The transaction updates domain tables and writes a game event or audit record.
6. **Reassess:** The dashboard reloads authoritative state so the commander can adjust the next decision.

## 4. Universe structure

The universe is generated from validated coordinate seeds and is organized hierarchically. The current design target contains **9 universes, 30 galaxies, and 499 sectors**, with each sector containing deterministic solar systems, planets, moons, anomalies, danger characteristics, resource modifiers, and travel lanes. The coordinate hierarchy is designed for OGame-like navigation while supporting No Man’s Sky-style repeatable discovery.

A coordinate is interpreted as `universe : galaxy : sector : system : orbit` where the active game implementation may expose a reduced or scoped coordinate form in individual pages. Access is filtered by discovery, scan power, commander permissions, ownership classification, protection rules, and authenticated scope.

The seed must be stable: the same coordinate and universe seed produce the same generated base profile. Dynamic ownership, discoveries, battles, colonies, reports, and events remain persistent database state layered over the deterministic base.

## 5. Economy

The economy contains nine resources:

| Resource | Strategic role |
|---|---|
| Metal | Basic construction, infrastructure, weapons, ships, and defenses. |
| Crystal | Advanced construction, research, electronics, and high-grade modules. |
| Deuterium | Fuel, fleet operations, research support, advanced ships, and selected technologies. |
| Naquadah | Primary liquid strategic currency for research, training, upgrades, markets, and vault operations. |
| Energy | Production support, life support, shields, and infrastructure operation. |
| Dark Matter | Rare premium or special-purpose resource for advanced systems and exceptional operations. |
| Food | Population upkeep, colony life support, workforce stability, and settlement output. |
| Water | Population upkeep, life support, colonization, and biome stability. |
| Population | Workforce, training capacity, colonization, civilian assignments, and growth. |

Production follows the authoritative economy formulas in the service layer. Colony output is modified by biome, race, government, buildings, morale, technology, and local resource modifiers. Upkeep reduces net settlement. Resource actions must be bounded, non-negative, ownership-scoped, and committed transactionally.

The top dashboard header presents resource balances and capacities. Deuterium is a first-class resource and must remain present in server queries, state serialization, design catalogs, migrations, action validation, research or ship costs, and responsive resource tiles.

## 6. Civilization, races, and governments

A commander selects or inherits a race and government. Race profiles influence production, growth, population, combat, and special capabilities. Government profiles influence command capacity, alliance capacity, stability, taxation or upkeep modifiers, diplomacy, and military organization. Changing a race or reforming a government is an account-level mutation requiring eligibility, cooldown, protection, authentication, and atomic persistence.

The civilization system connects political choice to all other systems. A race is not merely cosmetic: it changes formulas and strategic identity. A government is not merely a title: it changes how efficiently an empire coordinates colonies, fleets, alliances, and population.

## 7. Colonies and population

Colonies are owned settlements attached to generated universe planets. A colony records population, capacity, morale, food, water, energy, buildings, defense, fleet presence, production, and ownership. Colonization validates planet habitability, occupancy, colony capacity, resource requirements, cooldowns, and commander authority before creating the settlement.

Population has a capacity target of 150,000 or more depending on the current migration and game-state configuration. Population is assigned to civilian roles such as miners and lifers, or converted into trained units. Workforce output is modeled as assigned population multiplied by role efficiency and morale. Life-support consumption is modeled independently and must be visible in the colony and income panels.

## 8. Progression and ascension

Progression contains **21 tiers with 23 levels per tier**, producing a 483-level global progression path. Each level contributes to player effects, unlocks, prerequisites, or strategic authority. Tier coefficients are used by technology, combat, production, and civilization formulas.

Ascension is a late-game transition. Eligibility depends on completed tier mastery, glory, reputation, required progression state, and any required technologies. Ascension records the transition and grants permanent or semi-permanent bonuses while creating a new strategic phase. It must be atomic and auditable.

## 9. Technology and research

Technology is split into a general tree and branch views:

- Technology Tree.
- Offense Technology.
- Defense Technology.
- Covert Technology.
- Anti-Covert Technology.

Research cost follows the implemented model `base cost × growth ^ current level`. Research validates prerequisites, queue capacity, ownership, resource balance, category, and level limits. The queue records the before and after levels, effect values, coefficients, start time, completion time, status, and event history.

Offense improves damage and weapon systems. Defense improves shields, fortifications, and defensive modifiers. Covert improves agent effectiveness and infiltration. Anti-Covert improves counter-intelligence and detection. Deuterium should be used by advanced research and ship requirements where the design catalog declares a fuel or high-energy dependency.

## 10. Military systems

Military strength is calculated from units, weapons, technology, race, government, planet modifiers, readiness, and defensive structures. The command center exposes attack, defense, covert, anti-covert, DefCon, and readiness indicators.

The combat contract is a validated force comparison combined with technology, defense, protection, cooldown, resource, and deterministic resolver logic. A complete combat implementation should resolve multiple rounds, apply rapid-fire rules, calculate bounded damage, settle losses and loot, write battle reports, and persist a game event. The browser may request a preview, but it cannot authoritatively decide the result.

Planet defenses include structures, condition, shield integrity, garrison units, technology, planet bonuses, and upgrade queues. Weapon inventory includes type, quantity, durability, condition, power, technology modifiers, and repair requirements.

## 11. Fleet, starships, and motherships

The design catalog supports starship classes, ship types, unit categories, weapons, and strategic modules. Fleets consume production capacity, population or crew capacity, energy, Deuterium, and other resources according to their class and mission.

A mothership is a persistent mobile command platform with hull integrity, hangar capacity, shields, modules, science capability, travel readiness, exploration actions, and upgrade queues. Mothership modules modify scan power, science, shield, command, storage, and fleet capabilities. Moon bases and starbases extend strategic infrastructure around planets and travel lanes.

## 12. Exploration and procedural discovery

Exploration uses distance, ship science, biome rarity, anomaly rate, travel time, risk, and cooldown. A mission validates the mothership or fleet, target coordinate, discovery permission, resource requirements, and commander ownership. Outcomes may produce discovery records, resources, debris, events, quests, achievements, or threats.

Procedural generation provides deterministic base content; exploration converts hidden or protected generated content into persistent commander knowledge. Discovery is scoped: an authenticated commander sees only information allowed by scan power, discovery status, ownership classification, and map rules.

## 13. Espionage and covert operations

Covert operations include reconnaissance, spy missions, sabotage, and intelligence reports. Detection is modeled from defender counter-intelligence, attacker agents, covert technology, anti-covert technology, target vulnerability, mission type, and deterministic randomness or seeded resolution.

Reports contain classification, confidence, freshness, payload, ownership, recipient, read state, and audit information. The server must prevent unauthorized report access and must distinguish public signals from classified intelligence.

## 14. Markets and trade

The game supports resource exchange, weapon markets, and mercenary markets. A market order validates resource or item ownership, quantity, price limits, expiry, balance, and market limits. A purchase locks the order, verifies funds, transfers the resource or item, settles the seller, applies the transaction fee, records history, and commits atomically.

Mercenary contracts use unit tier, duration, scarcity, population capacity, resource balance, and deployment readiness. Market pages must expose order books, trade history, price limits, settlement previews, and feedback states.

## 15. Social and MMO systems

Alliances provide membership, roles, capacity, shared projects, diplomacy, and collective objectives. Alliance capacity is influenced by command level, alliance technology, and government modifiers. Membership and role actions are ownership- and permission-scoped.

Messages support inbox, sent messages, read state, blacklist policy, rate limits, recipient validation, and notification creation. Rankings combine economy, military, technology, glory, reputation, seasonal movement, and penalties. Quests, achievements, officers, seasons, NPC civilizations, expeditions, and debris fields extend the persistent MMO layer.

## 16. Megastructures and victory conditions

Megastructures are long-running empire projects requiring resources, technologies, construction capacity, alliance or civilization coordination, and protected completion state. Examples may include gates, dyson-scale energy systems, galactic defense arrays, or ascension infrastructure. A victory condition should be explicit, auditable, difficult to fake, and resilient against partial construction or concurrent claims.

Victory can be economic, technological, military, exploratory, diplomatic, seasonal, or megastructure-based. The game should support multiple victory paths so that a commander does not need to win through direct combat alone.

## 17. User interface

`game.php` is the primary authenticated dashboard shell. It contains the left navigation, grouped submenus, top commander and resource header, central page content, account menu, feedback banner, footer metadata, build number, development credit, and legal links. Pages are selected with route state and rendered without a full page reload during normal navigation.

The UI supports default white, window blue sci-fi, deep-space blue, and lighter blue styling such as `#357EC7`, together with density and reduced-motion preferences stored in browser local storage. The layout must remain readable at narrow widths, stack cards when required, allow long tables to scroll or wrap, and preserve button labels and feedback states.

## 18. Security and authority

All mutations require authentication and CSRF validation. Role-based access, ownership, target validation, protection state, cooldowns, resource checks, population checks, queue checks, and transaction boundaries are enforced server-side. The browser submits intent and presentation fields only; it must never be trusted for combat outcomes, resource settlement, ownership, or progression authority.

Sensitive reports, messages, alliance actions, colonies, motherships, weapons, technologies, and markets must all use scoped access. Every important mutation should write an event or audit record sufficient for troubleshooting and dispute analysis.

## 19. Non-functional goals

The game should provide deterministic outcomes where reproducibility is valuable, atomic writes where state integrity matters, predictable response structures, readable server logs, migration safety for MariaDB/MySQL, and testable service boundaries. The 43-page dashboard should compile and render from a consistent registry and module structure.

## 20. Current implementation status

The repository contains a substantial backend foundation, a modular 43-page dashboard, procedural universe generation, a nine-resource model with Deuterium integration, progression, core combat and covert services, technology branches, MMO expansion tables and services, and a growing automated test suite. Multi-round combat, advanced NPC behavior, some megastructure victory logic, and complete frontend visibility for every MMO expansion feature remain areas for continued implementation and balancing.

See [Implementation Status](IMPLEMENTATION_STATUS.md), the service catalog, route catalog, and testing documents for the current code-level status rather than relying on this design summary alone.

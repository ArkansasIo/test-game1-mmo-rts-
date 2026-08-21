# Universe Civilization: Empire at Wars Modular PHP Architecture and Game Logic

## Presentation script

### Slide 1 — Universe Civilization: Empire at Wars: a modular strategy game platform

**Speaker script:**

Universe Civilization: Empire at Wars is organized as a persistent text-based MMORPG and turn-based RTS. The player experience is presented through a left-side command navigation system, while PHP services and a MySQL database remain authoritative over every state transition. The current architecture contains twelve menu groups and forty-three registered page routes. Each page is separated into a route entrypoint, a definition contract, logic metadata, feature metadata, design metadata, systems metadata, and an executable page module.

The architectural goal is controlled expansion: a new page can be added without placing all of its behavior into one monolithic controller or one oversized template.

**Key message:** the user sees a unified command console, but the implementation is divided into independently testable page systems.

---

### Slide 2 — The page-tree architecture

**Speaker script:**

The sidebar is grouped into Command Center, Attack, Armory, Training, Technology, Intelligence, Market, Social, Planets, Mothership, Account, and Universe. Every group has a parent folder, an index entrypoint, a page manifest, and nested submenu PHP files.

A representative route is `pages/attack/subpages/targets.php`. This file is intentionally thin. It assigns the route and group, loads the Target Selection definition, loads the page module, and delegates to the root front controller. The route does not directly write to the database. This keeps authentication, CSRF handling, authorization, and transaction behavior in one controlled boundary.

**Key message:** route files provide independent addresses without duplicating security-sensitive business logic.

---

### Slide 3 — One page, multiple contracts

**Speaker script:**

Every page is described by separate contracts. The definition contract combines the route identity, title, layout, controls, actions, database tables, permission scope, feedback states, and references to the individual contract files.

The logic contract describes the purpose, workflow, validation requirements, calculations, and possible mutations. The feature contract describes what the player can do. The design contract identifies the template, sections, components, and responsive behavior. The systems contract maps the page to services, reads, writes, and authorized actions.

This separation makes the page architecture readable for designers, PHP developers, database engineers, and QA testers without requiring every contributor to understand the entire codebase at once.

---

### Slide 4 — Executable page modules

**Speaker script:**

The generated page modules turn metadata into callable PHP behavior boundaries. Each module exposes a route-specific function family: logic access, feature access, design access, systems access, action enumeration, intent validation, and a preview view model.

For example, the Target Selection module can describe its combat workflow, list its combat and covert actions, validate that an operation contains an allowed action and a positive target ID, and return a preview model for the frontend. These functions describe and validate intent; they do not perform a live combat write.

This design gives every page an explicit functional surface while preserving the principle that the server, not the browser, decides the outcome.

---

### Slide 5 — The secure action boundary

**Speaker script:**

State changes enter through `actions/game.php`. The controller requires authentication, rejects non-POST requests, verifies the CSRF token, resolves the authenticated commander, validates the requested redirect against an allowlist, and dispatches the action to a service.

The controller now supports economy, faction, training, technology, armory, mothership, combat, covert operations, exploration, colonies, diplomacy, markets, messages, vacation, rankings, ascension, queueing, missions, discoveries, and progression actions.

The explicit aliases `combat:raid`, `covert:recon`, `covert:spy`, and `covert:sabotage` are normalized into the existing combat and covert service methods. Exceptions are caught and stored as session error feedback before the user is redirected to the relevant page.

**Key message:** the browser submits intent; the service layer validates and commits the result.

---

### Slide 6 — Database schema and contracts

**Speaker script:**

The canonical database installation contains fifty-four normalized tables. The schema covers identity, races, wallets, units, technologies, weapons, motherships, planets, alliances, combat, battle participants, reports, covert operations, intelligence, markets, rankings, glory, reputation, ascension, protection, vacation, messages, turn processing, events, audit records, supporter state, and exploration.

Page contracts identify the tables each page reads and writes. For example, Target Selection reads target realms, players, rankings, protection states, and technologies, then writes battles, battle rounds, battle reports, attack logs, and resource changes through the service layer. This mapping makes database impact visible before a feature is executed.

**Key message:** the page contract is also a database-impact contract.

---

### Slide 7 — Transactional gameplay rules

**Speaker script:**

Game services use database transactions around state-changing operations. Combat validates the requested turn count, anti-farming rules, target protection, and player eligibility before locking both player states. It calculates attacker and defender scores, determines the winner, applies casualties and loot, records battle and report rows, and writes an event before committing.

Covert missions validate the attacker, defender, mission type, and agent count. The service compares covert strength with counter-intelligence, determines success and detection, consumes agents, records the mission, optionally stores an intelligence report, writes an event, and commits the result.

If any validation or database operation fails, the service rolls back and the controller exposes an error state rather than leaving a partial update.

---

### Slide 8 — Economy, colonies, and progression

**Speaker script:**

The game’s economy includes Metal, Crystal, Naquadah, Energy, Dark Matter, Food, Water, and Population. Colony and life-support systems use food, water, housing, infrastructure, and production state to determine population growth and output. Economy pages expose deposits, withdrawals, income breakdowns, colony comparison, and resource feedback states.

Progression is universal across game entities: twenty-one tiers with twenty-three levels per tier produce 483 possible levels. The progression service validates prerequisites, costs, caps, and resource availability transactionally. The page-module layer can describe progression controls, while the secure action controller invokes the service for the actual state transition.

---

### Slide 9 — Integration testing across all pages

**Speaker script:**

The integration suite loads all forty-three executable page modules and verifies that every module exposes the required function family. It checks preview structure, route identity, action enumeration, valid intent acceptance, invalid action rejection, negative-value rejection where applicable, and preservation of eight feedback states: loading, ready, empty, protected, insufficient-resource, cooldown, success, and error.

The latest run passed with forty-three routes and forty-three loaded modules. It checked ninety valid intents, rejected forty-three invalid intents, rejected five negative-value requests, checked 344 state transitions, and inspected ninety declared actions. The suite performed zero database mutations.

Combat, spy, and sabotage edge cases were also tested with valid target requests and invalid target IDs.

**Key message:** the module contracts can be tested without risking live player data.

---

### Slide 10 — Development workflow and next steps

**Speaker script:**

The repeatable workflow is straightforward. Developers update the canonical page registry or contract catalog, run the page-tree generator, validate all contracts, execute the page-module integration suite, and then run live HTTP smoke tests against `game.php`.

The current system is designed for further implementation of page-specific presentation panels and deeper service tests. The remaining hardening work includes expanding database-backed integration fixtures, testing every action with transaction rollback scenarios, adding authorization matrix tests for commander ranks, and running production-like cron and combat concurrency tests.

The architecture is ready for that next stage because pages, contracts, modules, services, and database responsibilities are already separated.

**Closing message:** Universe Civilization: Empire at Wars is no longer a collection of page mockups. It is a structured PHP game platform with independently addressable routes, explicit gameplay contracts, secure server authority, and repeatable integration testing.

---

## Technical reference points

| Topic | Project location |
|---|---|
| Canonical route registry | [`config/page_registry.php`](../config/page_registry.php) |
| Combined page contracts | [`config/page_contracts.php`](../config/page_contracts.php) |
| Generated executable modules | [`includes/page_modules/`](../includes/page_modules/) |
| Secure state-changing controller | [`actions/game.php`](../actions/game.php) |
| Canonical schema manifest | [`sql/DATABASE_MANIFEST.md`](../sql/DATABASE_MANIFEST.md) |
| All-page integration suite | [`tests/page_modules_integration.php`](../tests/page_modules_integration.php) |
| Basic module smoke test | [`tests/page_module_smoke.php`](../tests/page_module_smoke.php) |
| Page system documentation | [`10_Docs/PAGE_CONTRACT_SYSTEMS.md`](PAGE_CONTRACT_SYSTEMS.md) |

## Verification snapshot

The script reflects the verified project state at the time of generation: **43 routes**, **43 executable modules**, **90 declared actions checked**, **344 feedback-state transitions checked**, and **zero database mutations** during module-level integration testing.

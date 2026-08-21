# Universe Civilization: Empire at Wars Resources & Vault and Full Page-System Implementation Plan

## Goal

Complete the Resources & Vault page and standardize the remaining Universe Civilization: Empire at Wars dashboard and sub-page surfaces so every route provides a coherent PHP-rendered experience with database-backed resource state, secure deposit and withdrawal actions, permission checks, game formulas, and consistent result feedback.

## Phase 1: Audit current resource and page contracts

Inspect `config/page_registry.php`, `config/page_designs.php`, `config/page_runtime_specs.php`, `config/page_feature_contracts.php`, `index.php`, `includes/layout.php`, `actions/game.php`, `includes/services/GameService.php`, `includes/services/DashboardService.php`, and all `pages/*.php` entrypoints.

Build a route matrix covering route, title, layout, controls, actions, SQL reads, SQL writes, permission requirement, game mechanics, and supported result states. Confirm that the Resources & Vault route and all sibling routes have PHP entrypoints and safe front-controller redirects.

## Phase 2: Define the Resources & Vault contract

The Resources & Vault page will display Metal, Crystal, Naquadah, Energy, Dark Matter, banked Naquadah, capacity, attack turns, market turns, production rates, resource modifiers, and transaction history.

The page will separate vulnerable balances from protected reserves. It will show current stock, capacity percentage, per-turn production, per-turn consumption, government and race modifiers, and warning states for low reserves or insufficient capacity.

The page contract will read from `player_resources`, `dark_matter_transactions`, `player_colonies`, `player_planets`, `races`, `government_types`, `game_settings`, and relevant event or audit tables.

## Phase 3: Implement resource calculations and server authority

Use server-side formulas for:

- Production from base output, colony biome, race modifier, government economy modifier, technology, and building level.
- Food and water consumption from population, morale, life-support buildings, and colony modifiers.
- Energy balance from power production and infrastructure demand.
- Dark Matter grants, spending, rewards, and transaction ledger entries.
- Vault deposits and withdrawals with balance, capacity, and transaction validation.

All state-changing operations must use prepared PDO statements, authenticated player identity, CSRF verification, RBAC, ownership checks, positive integer validation, sufficient-balance checks, capacity checks, transaction boundaries, audit events, and redirect-based result feedback.

## Phase 4: Build the Resources & Vault PHP page

Add or refine a dedicated authenticated page branch for `resources`. Render the page using the existing left navigation, five-resource header, white-and-black design system, responsive panels, and accessible focus states.

The layout will include:

| Panel | Content |
|---|---|
| Resource overview | Five resources, current values, capacity bars, and production status |
| Vault controls | Deposit and withdraw forms with CSRF fields and safe limits |
| Income model | Base production, race modifier, government modifier, technology, and colony contribution |
| Consumption model | Food, water, energy, and upkeep requirements |
| Dark Matter ledger | Recent grants, purchases, rewards, and spending |
| Turn reserves | Attack turns, market turns, and cooldown information |
| Result feedback | Success, insufficient resources, protected reserve, capacity full, cooldown, and error states |

Use safe fallback preview values when PDO/MySQL is unavailable, while ensuring preview buttons communicate intent and do not mutate production state.

## Phase 5: Integrate resource state across all pages

Expose resource and bonus summaries throughout the page system:

| Page family | Resource integration |
|---|---|
| Command Center | Five-resource header, income summary, production bars, and turn settlement |
| Account Information | Faction and government bonus summary |
| Income Breakdown | Detailed production and modifier formula |
| Military Statistics | Attack-turn reserve, equipment cost, and DefCon effects |
| Training | Unit-training resource cost and available population |
| Technology | Research cost, queue time, and available Naquadah |
| Armory | Weapon purchase, repair, and durability costs |
| Planets | Colony food, water, energy, and biome modifiers |
| Fleet | Dispatch cost, fuel or energy requirement, and travel modifiers |
| Market | Order balances, market turns, and settlement state |
| Mothership | Upgrade costs and module capacity |
| Universe | Exploration and colonization costs |
| Social | Trade contracts, diplomacy costs, and notifications |

All values must be recalculated server-side. Client-provided resource amounts may be used only as requested intent and must never be trusted as authoritative balances.

## Phase 6: Standardize all remaining page renderers

For each registered layout, render the shared page contract: summary, controls, server-action mapping, permission contract, database read/write contract, game-mechanic details, current-state panels, and supported states.

Use `config/page_runtime_specs.php` as the source of truth for page-family mechanics and SQL mappings. Preserve specialized pages where they already have richer forms, including dashboard, resources, training, targets, technology, armory, mothership, rankings, vacation, ascension, and universe navigation. Use the reusable module workspace for remaining routes.

## Phase 7: Testing and verification

Run PHP syntax checks across all PHP files. Run route audits against the registry, page entrypoints, runtime specs, feature contracts, and action controller. Test unauthenticated routes for safe redirects. Test the modular preview through the local PHP runtime.

If MySQL is available, import all migrations through the resource and faction migrations, then test deposit, withdrawal, Dark Matter ledger writes, insufficient-balance rejection, capacity rejection, CSRF rejection, ownership checks, and transaction rollback behavior.

Verify that missing optional tables produce safe empty states and that the preview does not modify game state.

## Phase 8: Documentation and packaging

Update documentation with the Resources & Vault layout, formulas, database mappings, permissions, action lifecycle, migration order, and local server commands. Refresh the project ZIP package and deliver the Resources page, supporting services, migrations, audits, documentation, and updated preview.

## Assumptions and risks

The project remains PHP 8.1+ with PDO and MySQL/MariaDB. The five resources are Metal, Crystal, Naquadah, Energy, and Dark Matter. Legacy Naquadah-only mechanics remain compatible with the expanded resource model through service-layer adapters. Government and race modifiers are applied only after the relevant migrations are installed. Live state verification requires a configured MySQL database and authenticated session.

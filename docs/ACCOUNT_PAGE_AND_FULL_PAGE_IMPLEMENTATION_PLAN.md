# StargateWars Account Page and Full Page-System Implementation Plan

## Goal

Complete the Account Information page and standardize the remaining StargateWars dashboard and sub-page surfaces so every route provides a coherent PHP-rendered experience with database-backed state, secure server actions, permission checks, game-mechanic details, and consistent result feedback.

## Phase 1: Audit the current page system

Inspect `config/page_registry.php`, `config/page_designs.php`, `config/page_runtime_specs.php`, `config/page_feature_contracts.php`, `index.php`, `includes/layout.php`, `actions/game.php`, and all files in `pages/`. Build a route matrix that records each route, layout, title, controls, actions, SQL reads, SQL writes, permissions, and supported states.

Confirm whether each requested route has a dedicated PHP entrypoint and identify routes that currently rely on the generic front-controller renderer. Preserve the existing left-side navigation, five-resource header, white/black theme, CSRF handling, RBAC checks, and redirect allowlist.

## Phase 2: Define the Account Information contract

Create an account-specific contract containing commander identity, username, race, government, rank, rank level, Glory, Reputation, experience, victories, defeats, protection, vacation status, creation date, last login, and registration completion state.

The page should distinguish read-only information from state-changing operations. Read-only account data will be queried from `players`, `races`, `government_types`, `rankings`, `player_progression`, `glory_reputation`, `protection_states`, and `player_government_history`. Race selection, government reform, vacation activation, and ascension remain separate controlled actions with explicit permissions and confirmation states.

## Phase 3: Implement Account Information PHP rendering

Extend the authenticated front controller with a dedicated Account Information branch or a specialized renderer. Render an account overview, faction identity panel, progression panel, protection panel, security/session panel, and recent account history.

Use prepared PDO statements and safe fallback data when MySQL is unavailable. Escape all rendered values. Show empty and unavailable states when optional tables are not populated. Display the combined race and government bonus summary using `FactionService::bonuses()` when the player has a government assignment.

## Phase 4: Implement registration and faction controls

Add a registration/faction panel that lists the five races and nine governments, their descriptions, and their modifiers. Use `FactionService::selectRegistration()` for initial selection and `FactionService::reformGovernment()` for later government changes.

Require authentication, CSRF, valid race and government IDs, active government status, player existence, and transaction boundaries. Record government changes in `player_government_history`. Do not allow the browser to submit arbitrary bonus values.

## Phase 5: Integrate bonuses across gameplay pages

Expose the combined race-government modifiers in the dashboard and relevant sub-pages:

| Page family | Bonus integration |
|---|---|
| Command Center | Current faction badge, economy and population summaries |
| Economy | Income and production modifiers |
| Technology | Research speed modifier |
| Military | Attack and defense multipliers |
| Intelligence | Covert multiplier |
| Planets | Colony and population modifiers |
| Fleet | Travel and dispatch modifier |
| Social | Diplomacy modifier |
| Dark Matter | Government premium-resource modifier |
| Rankings | Faction identity and comparative modifiers |

All displayed values must be derived from server-side faction state and must not be trusted from request parameters.

## Phase 6: Standardize the remaining page renderer

For every registered layout, render the same structural contract: page summary, control/form section, server-action mapping, permission contract, SQL read/write contract, current-state panel, supported result states, and contextual game mechanics.

Use `config/page_runtime_specs.php` as the source of layout-specific mechanics and database mappings. Keep specialized pages for dashboard, resources, training, targets, technology, armory, mothership, rankings, vacation, ascension, and universe navigation where they already provide richer behavior. Route all other pages through the improved reusable workspace renderer.

## Phase 7: Testing and verification

Run PHP syntax checks for every PHP file. Run route audits that compare registry routes, page entrypoints, runtime specs, feature contracts, and action cases. Test unauthenticated requests to verify safe redirects. Test preview rendering through the local PHP server. If a MySQL instance is available, run migration imports and integration tests for faction selection, government reform, bonus retrieval, account reads, CSRF rejection, and ownership checks.

Verify that missing optional tables produce safe empty states rather than fatal errors. Confirm that all state-changing actions use transactions and that no client-side preview action mutates production state.

## Phase 8: Documentation and packaging

Update the account and page-system documentation with the final route matrix, faction bonus model, permission model, database mappings, and setup commands. Refresh the project ZIP package and deliver the Account Information PHP page, faction migration, faction service, updated renderer, audit scripts, documentation, and package.

## Assumptions and risks

The project remains PHP 8.1+ with PDO and MySQL/MariaDB. Existing legacy `player_planets` and newer `player_colonies` models will remain compatible through service-layer separation. Government selection assumes migration `012_races_governments_registration.sql` has been applied. Live authenticated integration tests require seeded players, sessions, CSRF tokens, and a working MySQL connection. No external game data or copyrighted assets are required for this implementation; all race and government definitions are original StargateWars game content.

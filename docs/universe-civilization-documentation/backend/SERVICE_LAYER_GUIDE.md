# Service Layer Guide

## Role

The service layer owns gameplay formulas, persistence rules, and transaction boundaries. Page renderers should display service snapshots. Action handlers should select a service and pass authenticated identity plus validated intent. Services should never trust client-derived costs, effects, ownership, or outcomes.

## Major service domains

| Domain | Representative services | Responsibility |
|---|---|---|
| Economy and turns | `EconomyService`, `GameService`, `DashboardService` | Settlement, income, vault, turn processing, command state. |
| Combat and covert | `GameMechanicsService`, `EmpireOperationsService`, combat/covert services | Force, damage, detection, combat, sabotage, reports. |
| Technology and queues | `TechnologyTreeService`, branch Technology services, production and training services | Catalog, prerequisites, cost, effect, queue, completion. |
| Universe and world | `ProceduralUniverseService`, `WorldService`, `PlanetService` | Seeded hierarchy, scans, systems, planets, moons, ownership, exploration. |
| Colonies and infrastructure | `PlanetBonusService`, `PlanetDefenseService`, `MothershipService` | Colony modifiers, defenses, mothership and modules. |
| Markets and equipment | `WeaponMarketService`, `ResourceMarketService`, `MercenaryMarketService`, `WeaponRepairService` | Inventory, orders, settlement, repair, contracts. |
| Social and identity | `AllianceService`, `SocialService`, `MessagingService`, `RankingsService`, `FactionService` | Alliances, messages, rankings, seasons, race, government. |
| MMO expansion | `MMORPGService`, expedition, quest, achievement, officer, NPC services | Persistent MMO content and scheduled interactions. |

## Snapshot convention

A snapshot method returns a page-safe array with stable keys, numeric values normalized, lists initialized to empty arrays, formulas included where useful, queue state included where relevant, and state flags that the renderer can display. Snapshots must scope data to the authenticated commander.

## Mutation convention

Mutation methods should accept authenticated player ID and intent identifiers. They should begin a transaction, lock rows required for the decision, validate all prerequisites and balances, calculate the result, write domain changes and event history, commit, and return a safe result array. Exceptions should roll back and propagate to a handler that converts them to safe feedback.

## Formula convention

Formulas should be centralized in a service or formula catalog. Repeated multipliers should not be reimplemented in page JavaScript. A page may display a formula string and preview values returned by the service, but not calculate final rewards or outcomes.

## Extension checklist

A new service feature requires a schema review, migration if needed, seed data, snapshot method, mutation method, event type, action handler, route/page contract, tests, and documentation. The service catalog must be regenerated after adding or renaming a service.

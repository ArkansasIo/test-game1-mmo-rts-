# Economy and Resources

## Resource model

The resource ledger is stored per commander and is read into authenticated dashboard state. The current nine-resource model is Metal, Crystal, Deuterium, Naquadah, Energy, Dark Matter, Food, Water, and Population.

| Resource | Balance type | Typical consumers | Capacity or constraint |
|---|---|---|---|
| Metal | Stockpile | Buildings, ships, weapons, defenses | Colony or storage capacity. |
| Crystal | Stockpile | Research, advanced buildings, electronics | Colony or storage capacity. |
| Deuterium | Stockpile / fuel | Fleets, advanced ships, technology, exploration | Dedicated `deuterium_capacity` and fuel validation. |
| Naquadah | Strategic currency | Research, training, upgrades, markets, repairs, vault | Available balance and banked vault balance. |
| Energy | Operational resource | Life support, shields, buildings, production | Production and upkeep balance. |
| Dark Matter | Rare resource | Special operations and late-game systems | Rare acquisition and bounded spending. |
| Food | Life-support resource | Population upkeep, colonies, workforce | Production, storage, and consumption. |
| Water | Life-support resource | Population upkeep, colonies, workforce | Production, storage, and consumption. |
| Population | Workforce / capacity | Training, colonization, civilian jobs | Population capacity and assignment limits. |

## Settlement

A settlement cycle reads the commander’s owned colonies, buildings, race, government, technology, morale, biome, production, upkeep, queues, and active effects. The service layer calculates gross output, upkeep, net settlement, queue progress, population changes, and event records. The browser receives refreshed state after the commit.

A negative income result is not automatically an error. The system should represent a negative or zero net settlement safely, prevent balances from violating configured floors, and surface warnings when life-support or energy deficits threaten a colony.

## Vault

Naquadah may be deposited into or withdrawn from a protected vault. Vault actions validate authenticated ownership, amount format, non-negative values, available balance, vault constraints, cooldowns, CSRF, and transaction state. The balance update and event record should commit atomically.

## Production modifiers

Colony output is based on base production and modifiers from biome, race, government, buildings, morale, technology, and local resource conditions. A documented formula should identify whether modifiers are additive or multiplicative. The active implementation and tests are authoritative when historical documents differ.

## Population economy

Population can be assigned to miners, lifers, construction, research, military training, or reserve. Assignments cannot exceed population capacity and should preserve enough life-support workforce for colony survival. Training consumes eligible population and increases unit stats or queue output only after server validation.

## Deuterium integration

Deuterium is persisted in `player_resources`, seeded through the Deuterium migration, loaded in the dashboard state, displayed in the header, and registered in the design catalog. Advanced technology, ship, fleet, exploration, or gate costs should use Deuterium where declared by their design records. Any action that consumes Deuterium must validate balance and capacity server-side and write the settlement or event atomically.

## Economy feedback states

Economy pages should distinguish `ready`, `empty`, `insufficient-resource`, `invalid-input`, `cooldown`, `protected`, `success`, and `error`. A feedback message must not be the only indication of a failed mutation; the page should also refresh the authoritative balance and queue state.

# OGame-Style StargateWars Expansion

The attached foundation document is incorporated as an additive expansion to the existing StargateWars systems. It adds resource-management and fleet-strategy mechanics without replacing the original Naquadah, turns, personnel, covert, mothership, alliance, and Ascension systems.

## Frontend page families

The new page groups are Colony Management, Buildings, Research, Fleets, and World Events. Each group has dedicated PHP entrypoints under `pages/`, page metadata under `config/ogame_page_registry.php`, and SQL mappings in `PAGE_SQL_MAP.md`.

## New gameplay state

Colonies track population, population capacity, food, water, life-support capacity, morale, planet type, and coordinates. Resource balances track production, consumption, capacity, and current amounts for Metal, Crystal, Food, Water, Energy, and Naquadah. Buildings, research, fleets, and defenses use type tables plus player/colony state tables so content can be expanded through seed data.

## Turn behavior

At each colony tick, production is added to resource balances, population consumes food and water, and population growth stops when either life-support resource reaches zero. Colony snapshots preserve before/after values for audit and balancing. Construction and fleet missions are asynchronous records with completion timestamps, allowing the cron worker to process due queues.

## Server-side authority

The browser submits only intent, such as a building key, research key, fleet composition, target colony, or mission type. PHP validates ownership, positive quantities, queue limits, resource availability, cooldowns, protection state, and permissions. The server calculates costs, travel time, consumption, combat outcomes, and completion state inside transactions.

## SQL installation order

```bash
mysql -u root -p < sql/000_complete_database.sql
mysql -u root -p stargatewars < sql/001_complete_seed.sql
mysql -u root -p stargatewars < sql/006_ogame_systems.sql
mysql -u root -p stargatewars < sql/007_ogame_seed.sql
```

The new migration is additive and depends on the existing `players`, `game_events`, and core database. Run it after the canonical schema and seed. The expansion should be treated as a configurable recreation layer inspired by browser strategy conventions, not a claim of exact parity with any third-party game server.

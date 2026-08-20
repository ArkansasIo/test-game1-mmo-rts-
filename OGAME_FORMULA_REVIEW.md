# OGame-Style Resource and Colony-Turn Formula Review

## 1. Life-support consumption

The pure engine is `src/Engine/LifeSupportEngine.php`, and the transactional implementation is `includes/services/OGameService.php::processColonyTurn()`.

For an elapsed duration, the engine converts seconds to hours:

```text
hours = elapsedSeconds / 3600
```

Food consumption is currently configured as **0.25 food per population per hour**, while water consumption is **0.20 water per population per hour**:

```text
foodCost  = ceil(population × 0.25 × hours)
waterCost = ceil(population × 0.20 × hours)
```

The `ceil()` operation guarantees that an active population cannot avoid consumption because of fractional values. Stocks are clamped at zero:

```text
foodAfter  = max(0, foodStock - foodCost)
waterAfter = max(0, waterStock - waterCost)
```

A shortage exists when either resource reaches zero. This is intentionally a single boolean state, so the current rule treats food or water shortage as a life-support failure.

## 2. Population growth

Population grows only when both food and water remain above zero. The base growth rate is **1% of population per hour**, multiplied by colony morale:

```text
growth = floor(population × 0.01 × hours × morale)
```

The result is bounded by population capacity:

```text
populationAfter = min(populationCapacity, population + growth)
```

If either life-support resource is depleted, growth is zero. This creates a simple strategic relationship: larger populations increase consumption, but stable food, water, morale, and residential capacity allow growth.

## 3. Resource production balances

`player_resource_balances` stores production and consumption independently for each resource type. For every balance row, the transactional service calculates:

```text
netChange = productionPerHour × hours - consumptionPerHour × hours
nextAmount = min(capacity, max(0, amount + netChange))
```

This applies to Metal, Crystal, Food, Water, Energy, and Naquadah-style balances. A resource cannot become negative and cannot exceed its capacity. Production is therefore authoritative on the server and safe from browser-side manipulation.

## 4. Worked example

For a colony with 100 population, 1,000 food, 1,000 water, capacity 1,000, morale 1.0, and a one-hour tick:

| Value | Result |
|---|---:|
| Food cost | 25 |
| Water cost | 20 |
| Food remaining | 975 |
| Water remaining | 980 |
| Growth | 1 |
| Population after tick | 101 |
| Shortage | No |

If the same colony has only 1 food, the food stock reaches zero. The engine sets shortage to true and population growth becomes zero even though water remains available.

## 5. Colony service transaction

`processColonyTurn()` locks the colony row, loads resource balances, applies production and consumption, updates food, water, and population, writes a `colony_turn_snapshots` record, inserts a `game_events` record, and commits. Any failure rolls back the entire turn.

The snapshot preserves elapsed seconds, before/after food, before/after water, before/after population, and a JSON payload with resource deltas. This supports debugging, balancing, replay analysis, and administrative review.

## 6. Queues and fleet dispatch

Building queues calculate a configurable cost using:

```text
cost = baseNaquadah × growthFactor ^ (level - 1)
```

A queue record stores the player, colony, queue type, item key, level before construction, start time, and completion time. Fleet missions store source colony, optional target colony, mission type, JSON payload, departure time, arrival time, return time, and status.

The browser submits only mission intent and a bounded payload. PHP validates mission type, ownership, travel duration, and target validity before writing the mission transactionally.

## 7. Operational edge cases

Negative elapsed time is rejected. Elapsed time above 24 hours is rejected by the transactional service to prevent accidental bulk settlement. Food and water never go below zero. Population never exceeds capacity. Population never grows during shortage. Resource amounts never exceed capacity. Fleet missions require an allowed type and a positive travel duration.

For production deployment, move constants such as food consumption, water consumption, growth rate, shortage penalties, and maximum elapsed time into `game_settings` so operators can rebalance the world without editing PHP source code.

# Game Engine Inspection

## 1. Super Units renderer and resource costs

The Super Units renderer in `game.php` is a server-state renderer. It reads `state.super_units`, which is serialized by PHP before the page is sent to the browser. The browser does not calculate authoritative costs or modify resource balances.

The important renderer behavior is equivalent to:

```js
function superUnitsPage() {
  const u = state.super_units || {};
  const csrf = state.csrf || '';
  const roster = u.roster || [];

  const rows = (roster.length ? roster : [emptyEliteRow]).map(x =>
    '<tr>' +
      '<td><strong>' + esc(x.name) + '</strong>' +
          '<small>' + esc(x.description) + '</small></td>' +
      '<td>' + fmt(x.owned) + '</td>' +
      '<td>' + fmt(x.base_power) + '</td>' +
      '<td>' + fmt(x.tier_mastery) + '×</td>' +
      '<td>' + esc(x.technology_key || '—') + ' ' +
          fmt(x.technology_level) + ' / ' + fmt(x.technology_required) + '</td>' +
      '<td>' + fmt(x.race_modifier) + '×</td>' +
      '<td>' + fmt(x.effective_power) + '</td>' +
      '<td>' + fmt(x.strategic_cost) + ' N</td>' +
      '<td>' + (x.ready
        ? '<form method="post" action="actions/game.php" class="inline-form">' +
            csrf +
            '<input type="hidden" name="action" value="train">' +
            '<input type="hidden" name="redirect" value="super-units">' +
            '<input type="hidden" name="type" value="' + esc(x.unit_key) + '">' +
            '<input type="number" name="quantity" value="1" min="1" max="10000">' +
            '<button type="submit">Train units</button>' +
          '</form>'
        : '<span class="badge">LOCKED</span>' +
          '<small>' + esc(x.lock_reason || 'Prerequisite required') + '</small>') +
      '</td>' +
    '</tr>'
  ).join('');

  document.getElementById('content').innerHTML = /* cards and table using rows */;
}
```

The renderer displays the following authoritative fields returned by `SuperUnitService::snapshot()`:

| Field | Purpose |
|---|---|
| `owned` | Current owned count from the player resource stat column. |
| `base_power` | Catalog power for the elite unit type. |
| `tier_mastery` | Unit mastery multiplier. |
| `technology_level` and `technology_required` | Prerequisite status. |
| `race_modifier` | Attack or defense race modifier selected according to the unit stat column. |
| `effective_power` | Server-calculated effective power. |
| `strategic_cost` | Displayed cost per unit. |
| `ready` and `lock_reason` | Determines whether the training form or a locked state is rendered. |

The service calculates effective power as:

```php
$power = round(
    (float)$type['base_power']
    * (float)$type['tier_mastery']
    * (1 + ($techLevel * (float)$type['tech_effect'] / 100))
    * $raceMod,
    2
);
```

For training, the browser submits only `action=train`, the unit key, quantity, redirect route, and CSRF token. `SuperUnitService::train()` re-reads and locks the unit type, player, technology, academy, and resources. The authoritative resource formula is:

```php
$cost = (int)$type['strategic_cost'] * $quantity;
```

The transaction then deducts `untrained_units` and `naquadah`, increments the unit-specific stat column, writes `super_units_trained` to `game_events`, and commits. If any validation fails, the transaction rolls back. After the redirect, `game.php` takes a fresh snapshot, so the visible count and resource balance update from the database rather than from optimistic client-side arithmetic.

The production-upgrade control is separately gated by `automation_ready`; otherwise the renderer displays a locked state requiring Automation technology level 1.

## 2. Turn settlement, fleet movement, and production concurrency

The current system does not process all subsystems in one unified transaction. The main scheduled runner is `TurnProcessorService::run()`:

```php
$turnNumber = intdiv($now->getTimestamp(), $turnInterval);
$run = $this->claimRun($turnNumber, $now, $dryRun);

$service = new GameService($this->pdo);
foreach ($players as $playerId) {
    $result = $service->processTurns($playerId, $now);
}
```

`claimRun()` locks the `game_turns` row for the calculated turn number with `SELECT ... FOR UPDATE`. This prevents duplicate processing of the same global run. Each player is then processed sequentially by `GameService::processTurns()`.

Inside `GameService::processTurns()`, the player and `player_resources` rows are locked in a transaction. The engine calculates elapsed intervals, due turns, unit production, Naquadah income, and DefCon reduction. It updates resources, advances `players.last_turn_at`, writes a `turn_processed` event, and commits.

Fleet movement is a separate subsystem. `CombatFleetService::moveFleet()` uses its own transaction to lock the source colony and player resources, validate ownership and target state, calculate distance, Deuterium fuel, speed, arrival time, and deterministic mission seed, insert a `fleet_missions` row, deduct Deuterium, and commit.

Arrivals are processed by `CombatFleetService::processArrivals()` in another transaction:

```php
SELECT *
FROM fleet_missions
WHERE status = 'outbound'
  AND arrival_at <= ?
ORDER BY id
FOR UPDATE
```

Each due mission is marked arrived and then resolved. Attack and raid missions call deterministic combat resolution, which locks both players and both resource rows before applying casualties, loot, battles, rounds, reports, and events.

Construction and settlement queues are likewise separate. `SettlementConstructionService::processDue()` locks due `settlement_construction_queues` rows, applies the building upgrade, updates fields and buildings, marks the queue completed, and writes an event. It is not invoked by the current `TurnProcessorService::run()` loop.

Therefore, “concurrent” currently means **separate workers or cron jobs can process independent subsystem transactions concurrently**, while InnoDB row locks serialize conflicting updates. It does not mean that `TurnProcessorService` itself invokes fleet arrivals, colony production, and construction in parallel. If two jobs touch the same player or colony, they wait on row locks; if they touch independent players or queues, they can proceed concurrently.

## 3. Colony queue schema

The current settlement-specific queue is `settlement_construction_queues` from `sql/047_planet_lunar_power_buildings.sql`:

```sql
CREATE TABLE settlement_construction_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  settlement_key VARCHAR(90) NOT NULL,
  field_id BIGINT UNSIGNED NOT NULL,
  building_id BIGINT UNSIGNED NULL,
  building_type_id INT UNSIGNED NOT NULL,
  level_before TINYINT UNSIGNED NOT NULL DEFAULT 0,
  level_after TINYINT UNSIGNED NOT NULL,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','building','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_settlement_construction_due (status, completes_at),
  KEY idx_settlement_construction_player (player_id, status)
);
```

The older OGame-style queue is `construction_queue`, keyed by `player_id`, optional `colony_id`, `queue_type`, `item_key`, quantity, levels, timestamps, and status. The newer settlement queue is more detailed because it binds a build to a field, building type, planet/moon settlement key, multi-resource costs, and completion state.

`SettlementConstructionService::construct()` locks the colony, field, and building type, validates placement and prerequisites, checks the one-active-queue rule, calculates scaled costs, deducts resources, and inserts the queue row atomically. `processDue()` locks due queue rows and completes them atomically.

## 4. Race-specific modifiers and population growth

The current implementation does **not** apply a race-specific population-growth modifier during colony settlement.

The race schema contains attack, defense, income, and covert modifiers. The government schema contains `population_modifier`. `FactionService::snapshot()` exposes:

```php
'population_modifier' =>
    (float)($p['government_population_modifier'] ?? 1)
```

The population settlement path is `EconomyService::calculatePopulationState()`:

```php
$population = max(0, (int)($colony['population'] ?? 0));
$capacity = max(0, (int)($colony['population_capacity'] ?? 0));
$growthRate = max(0, (float)($colony['growth_rate'] ?? 0.01));
$growth = (int)min(
    max(0, $capacity - $population),
    floor($population * $growthRate * $foodAvailability * $waterAvailability)
);
```

`EconomyService::settleColony()` locks the colony row, calculates food and water use, derives availability, computes growth, updates population and morale, records a colony snapshot, writes resource transactions, and commits. It does not join `players` to `races` or `government_types`, and it does not multiply growth by the faction population modifier.

`OGameService::processColonyTurn()` has a second, older growth implementation that uses:

```php
$growth = $shortage
    ? 0
    : (int)floor(max(0, $population * (.01 * $hours) * $c['morale']));
```

This path also does not apply race or government modifiers.

Race and government modifiers are currently applied to **economic output** in `EconomyService::incomeBreakdown()`:

```php
$gross = $base * $race * $government * $technology;
```

They are also used for combat and other systems, but not for population growth. The current population formula is therefore:

> population growth = current population × colony growth rate × food availability × water availability

A future corrected formula, if the design requires both race and government effects, would be:

```php
$growth = floor(
    $population
    * $growthRate
    * $foodAvailability
    * $waterAvailability
    * $racePopulationModifier
    * $governmentPopulationModifier
);
```

That change should be implemented in one authoritative settlement service rather than independently in both `EconomyService` and `OGameService`, otherwise the two settlement paths can produce different population results.

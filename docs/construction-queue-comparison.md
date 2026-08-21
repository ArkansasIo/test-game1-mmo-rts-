# Construction Queue Comparison

## Executive conclusion

The project currently contains **three queue generations** rather than only two:

| Queue | Role | Current implementation status |
|---|---|---|
| `construction_queue` | Legacy mixed queue for building, research, fleet, defense, ship, and weapon repair entries | Still read by dashboard, technology, training, mothership, and repair features; no generic completion processor was found. |
| `construction_queues` | Newer generic building-production schema from migration 039 | Schema exists, but the inspected runtime paths primarily use the legacy table or the settlement-specific table. |
| `settlement_construction_queues` | Current planet/moon field-based building queue from migration 047 | Has the most complete runtime implementation through `SettlementConstructionService`. |

## Legacy `construction_queue`

The original table is defined in `sql/006_ogame_systems.sql`:

```sql
CREATE TABLE construction_queue (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  colony_id INT UNSIGNED NULL,
  queue_type ENUM('building','research','fleet','defense','ship') NOT NULL,
  item_key VARCHAR(80) NOT NULL,
  quantity INT UNSIGNED NOT NULL DEFAULT 1,
  level_before INT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','processing','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_queue_due(status, completes_at),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (colony_id) REFERENCES colonies(id) ON DELETE SET NULL
);
```

Migration `028_weapon_repair_queue.sql` extends `queue_type` with `weapon_repair`. The table is intentionally generic, but its row does not retain a complete resource-cost snapshot, a target field, a level-after value, a building type foreign key, or a settlement key. Those values must be reconstructed from the item key and the current catalog at read or completion time.

The legacy table is still consumed by `DashboardService`, `PageDataService`, the technology branch services, the unit-production pages, and the mothership pages. `DefenseTechnologyService::upgrade()` is representative:

```php
$this->pdo->beginTransaction();
try {
    $tech = selectTechnologyForUpdate($technologyKey);
    $owned = selectPlayerTechnologyForUpdate($playerId, $technologyKey);
    $queueCount = countActiveLegacyResearchRows($playerId);
    if ($queueCount > 0) {
        throw new RuntimeException('Research queue is occupied.');
    }

    $cost = calculateResearchCost($tech, $level);
    $naquadah = selectPlayerNaquadahForUpdate($playerId);
    if ($naquadah < $cost) {
        throw new RuntimeException('Not enough Naquadah.');
    }

    UPDATE player_resources SET naquadah = naquadah - :cost;
    INSERT INTO construction_queue (... queue_type, item_key, level_before,
                                    starts_at, completes_at, status)
    VALUES (..., 'research', :technology_key, :level,
            :starts, :completes, 'queued');
    INSERT INTO game_events (...);
    COMMIT;
} catch (Throwable $e) {
    ROLLBACK;
    throw $e;
}
```

This transaction protects the initial enqueue operation. It locks the catalog row, the player technology row, and the resource row, validates the active queue, deducts Naquadah, inserts the queue item, and records an event before committing.

However, the inspection found no generic PHP processor that selects due `construction_queue` rows with `FOR UPDATE`, applies their effects, marks them completed, and updates the associated technology/building/production state. The codebase contains many references describing queue completion, but the concrete due-processing implementation found is for `settlement_construction_queues`.

That means legacy rows can be successfully enqueued and displayed while their completion behavior depends on another path not represented by a unified legacy queue processor. This is the primary implementation risk.

## New `settlement_construction_queues`

Migration `047_planet_lunar_power_buildings.sql` creates a queue specifically for planet/moon field construction:

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
  KEY idx_settlement_construction_player (player_id, status),
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (field_id) REFERENCES settlement_fields(id) ON DELETE CASCADE,
  FOREIGN KEY (building_id) REFERENCES settlement_buildings(id) ON DELETE SET NULL,
  FOREIGN KEY (building_type_id) REFERENCES building_types(id) ON DELETE CASCADE
) ENGINE=InnoDB;
```

Unlike the legacy row, the settlement row snapshots all five relevant costs, stores both levels, binds the work to a specific field and building type, and distinguishes a planet/moon settlement through `settlement_key`.

## Enqueue transaction for the modern queue

`SettlementConstructionService::construct()` uses the following transaction order:

| Order | Operation | Lock or validation purpose |
|---:|---|---|
| 1 | `BEGIN` | Establish atomic construction request. |
| 2 | Lock owned `player_colonies` row with `FOR UPDATE` | Prevent simultaneous colony mutations and enforce ownership. |
| 3 | Create or verify settlement fields | Ensure the field layout exists. |
| 4 | Lock the requested `settlement_fields` row | Prevent two builds from occupying the same field. |
| 5 | Lock the `building_types` catalog row | Freeze type, prerequisites, level cap, and cost inputs for the request. |
| 6 | Lock the building already occupying the field | Determine `level_before` safely. |
| 7 | Assert no active queue for the settlement | Enforce the one-active-queue rule. |
| 8 | Validate placement and prerequisites | Enforce planet/moon, field-kind, size, and prerequisite rules. |
| 9 | Calculate and deduct all resource costs | Resource changes occur in the same transaction. |
| 10 | Insert `settlement_construction_queues` row | Store immutable level, cost, and completion metadata. |
| 11 | Insert `construction_queued` event | Audit the mutation. |
| 12 | `COMMIT` | Publish the queue and resource deduction together. |

The resource deduction is performed before the queue insert, but both operations are protected by the same transaction. If the insert, event, or any later validation fails, the resource deduction rolls back.

## Completion transaction for the modern queue

`SettlementConstructionService::processDue()` uses:

```sql
SELECT q.*, bt.building_key, bt.effect_key,
       bt.effect_per_level, bt.base_power_output,
       bt.base_power_consumption
FROM settlement_construction_queues q
JOIN building_types bt ON bt.id = q.building_type_id
WHERE q.status IN ('queued','building')
  AND q.completes_at <= :now
ORDER BY q.id
FOR UPDATE;
```

For every locked due row, it calculates final building statistics, updates an existing `settlement_buildings` row or inserts a new one, marks the queue `completed`, updates `settlement_fields.building_id`, writes a `construction_completed` event, and commits the entire batch.

If any queue item fails during the batch, the current implementation rolls back the whole transaction, including earlier items in that batch. This gives all-or-nothing behavior but means one malformed due queue can delay unrelated due queues until the error is resolved.

## Additional `construction_queues` table

Migration `039_construction_production_research.sql` also creates `construction_queues`:

```sql
CREATE TABLE construction_queues (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  player_id INT UNSIGNED NOT NULL,
  building_type_id INT UNSIGNED NOT NULL,
  level_before TINYINT UNSIGNED NOT NULL,
  level_after TINYINT UNSIGNED NOT NULL,
  metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
  starts_at DATETIME NOT NULL,
  completes_at DATETIME NOT NULL,
  status ENUM('queued','building','completed','cancelled') NOT NULL DEFAULT 'queued',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (player_id) REFERENCES players(id) ON DELETE CASCADE,
  FOREIGN KEY (building_type_id) REFERENCES building_types(id) ON DELETE CASCADE,
  KEY idx_construction_due(status, completes_at),
  KEY idx_construction_player(player_id,status)
);
```

This table is structurally closer to the settlement queue, but it lacks field, colony, settlement, moon/planet, and Deuterium columns. The inspected runtime implementation still centers on `construction_queue` and `settlement_construction_queues`, so `construction_queues` appears to be an intermediate schema rather than the active authoritative path.

## Main consistency risks

| Risk | Explanation |
|---|---|
| Multiple queue authorities | Features use `construction_queue`, while settlement construction uses `settlement_construction_queues`; the intermediate `construction_queues` table also exists. |
| Legacy completion gap | Enqueue and display paths exist for the legacy table, but no unified due processor was found that applies all legacy effects. |
| Queue-capacity scope mismatch | Legacy technology checks active rows by player and queue type. Settlement construction checks active rows by settlement key. These are different gameplay rules. |
| Cost snapshot mismatch | Modern rows preserve all costs. Legacy rows generally preserve no cost snapshot, so future catalog changes can affect interpretation. |
| Duplicate state models | Legacy queues use `colonies`; modern settlement queues use `player_colonies`, `settlement_fields`, and `settlement_buildings`. |
| Lock ordering | The modern service locks colony, field, type, and building before resources. Other legacy services often lock catalog/player-technology/resources in a different order. Mixed requests touching the same rows should standardize lock order to reduce deadlock risk. |
| Batch rollback behavior | Modern due processing rolls back the full batch on one exception. Per-row savepoints or failure isolation may be preferable for large universes. |

## Recommended consolidation path

The safest long-term design is to designate one authoritative queue abstraction and route every build, research, ship, repair, and mothership operation through it. If the field-aware model is the target, retain `settlement_construction_queues` for physical planet/moon construction and create separate typed queues for research, fleet production, repair, and mothership work rather than continuing to overload `construction_queue`.

At minimum, the project should add a legacy queue processor with `SELECT ... FOR UPDATE`, explicit item-type handlers, immutable cost metadata, idempotent completion markers, and event records. It should also document whether the legacy queue remains active for research and repair or is only a compatibility table during migration.

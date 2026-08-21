# Settlement Power Grid Inspection

## Executive summary

The current power grid is **server-authoritative and dynamically recalculated from completed settlement buildings**, but it is not yet a true per-node distribution network. The backend aggregates all active building output and consumption into two totals. The redesigned UI then visualizes those totals as a Generation node, a Grid core, and a Load node.

When a district module finishes construction, its stored `power_output` and `power_consumption` are updated in `settlement_buildings`. The next settlement-state read sums those rows again, recalculates balance and efficiency, and sends the new values to the browser. The browser does not decide power values.

## Database model

The power-grid model is spread across `building_types`, `settlement_fields`, `settlement_buildings`, and `settlement_construction_queues`.

| Table | Power responsibility |
|---|---|
| `building_types` | Catalog definition. `base_power_output`, `base_power_consumption`, `effect_per_level`, `field_size`, `building_class`, and placement rules define the module’s base behavior. |
| `settlement_fields` | Field ownership and placement. `field_kind` identifies resource, power, residential, industrial, research, military, civic, or orbital use. `power_priority` exists with default 5, but is not currently consumed by the aggregation code. |
| `settlement_buildings` | Completed module state. `level`, `condition_value`, `active`, `power_output`, `power_consumption`, and JSON `stats` store the authoritative realized values. |
| `settlement_construction_queues` | Pending module state. It stores `level_before`, `level_after`, all five resource costs, timestamps, field binding, and queue status. Pending modules do not contribute to grid totals. |

The key schema fields are:

```sql
-- settlement_fields
field_kind ENUM('resource','power','residential','industrial',
                'research','military','civic','orbital') NOT NULL,
power_priority TINYINT UNSIGNED NOT NULL DEFAULT 5,
UNIQUE KEY uq_settlement_field (settlement_key, field_index)

-- settlement_buildings
level TINYINT UNSIGNED NOT NULL DEFAULT 1,
condition_value DECIMAL(8,3) NOT NULL DEFAULT 1.000,
active TINYINT(1) NOT NULL DEFAULT 1,
power_output BIGINT NOT NULL DEFAULT 0,
power_consumption BIGINT NOT NULL DEFAULT 0,
stats JSON NOT NULL,
UNIQUE KEY uq_settlement_building_field (field_id)

-- settlement_construction_queues
level_before TINYINT UNSIGNED NOT NULL DEFAULT 0,
level_after TINYINT UNSIGNED NOT NULL,
metal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
crystal_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
deuterium_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
naquadah_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
energy_cost BIGINT UNSIGNED NOT NULL DEFAULT 0,
status ENUM('queued','building','completed','cancelled') NOT NULL DEFAULT 'queued'
```

The catalog distinguishes power modules from district modules. For example, `fusion_reactor` has base output 120 and base consumption 4. `habitat_district` has no direct output but consumes 15. The `building_types` catalog also contains larger civic, industrial, research, defense, orbital, and shipyard structures with their own power profiles.

## State aggregation

`SettlementConstructionService::state()` first verifies that the requested colony belongs to the authenticated player. It then ensures the settlement fields exist, loads all fields, loads completed settlement buildings, attaches each building to its field, and sums the stored realized power values:

```php
$output = 0;
$consumption = 0;

foreach ($fields as &$field) {
    $field['building'] = $buildingByField[(int)$field['id']] ?? null;

    if ($field['building']) {
        $output += (int)$field['building']['power_output'];
        $consumption += (int)$field['building']['power_consumption'];
    }
}

$balance = $output - $consumption;
$efficiency = self::powerEfficiency($output, $consumption);
```

The important consequence is that a new module affects the grid only after it becomes a completed `settlement_buildings` row. A queued construction appears in the queue list but contributes neither generation nor load.

## Efficiency and brownout calculation

The current formula is:

```php
public static function powerEfficiency(int $output, int $consumption): float
{
    if ($consumption < 1) return 1.0;

    $balance = $output - $consumption;

    return round(
        max(0.25, min(1.0, 1 + ($balance / $consumption * 0.5))),
        4
    );
}
```

Mathematically:

```text
efficiency = clamp(0.25, 1.0,
                    1 + ((output − consumption) / consumption × 0.5))
```

The formula has these behaviors:

| Condition | Result |
|---|---|
| Consumption is zero | Efficiency is `1.0` / 100%. |
| Output equals consumption | Efficiency is 100%. |
| Output exceeds consumption | The result remains capped at 100%; surplus does not create efficiency above 100%. |
| Output is below consumption | Efficiency falls proportionally. |
| Severe deficit | Efficiency cannot fall below 25%. |

For example, output 120 and consumption 30 produces a raw value above 100%, so the result is capped at 100%. Output 20 and consumption 40 produces `1 + (-20 / 40 × .5) = .75`, or 75%. Output 0 and consumption 40 produces `.5`, or 50%. The 25% floor is reached only at a sufficiently severe deficit.

The current service uses the efficiency value as telemetry. It does not yet apply that multiplier to resource production, population growth, building effects, or individual modules in the inspected code path. Therefore, the present “brownout penalty” is primarily a reported efficiency state unless another downstream service consumes the returned value.

## Construction and module activation flow

The module lifecycle is transactional:

```text
settlement_build request
        |
        v
lock player colony, field, building type, existing field building
        |
        v
validate placement, prerequisite, level cap, active queue
        |
        v
lock player_resources and deduct Metal/Crystal/Deuterium/Naquadah/Energy
        |
        v
insert settlement_construction_queues(status='building')
        |
        v
commit queue + resource deduction + event
        |
        v
processDue() after completes_at
        |
        v
calculate power_output = base_power_output × level
calculate power_consumption = base_power_consumption × level
        |
        v
insert/update settlement_buildings and settlement_fields
        |
        v
mark queue completed and write event
        |
        v
next settlement_state read recalculates totals
```

At completion, `SettlementConstructionService::stats()` calculates:

```php
$output = (int) round((int)$queue['base_power_output'] * $level);
$consumption = (int) round((int)$queue['base_power_consumption'] * $level);

return [
    'level' => $level,
    'effect_key' => $queue['effect_key'],
    'effect_value' => round((float)$queue['effect_per_level'] * $level, 4),
    'power_output' => $output,
    'power_consumption' => $consumption,
    'condition' => 1.0,
];
```

The completion processor selects due queue rows with `FOR UPDATE`, updates or inserts the building, updates the field’s `building_id`, marks the queue completed, records a `construction_completed` event, and commits the batch. The next state request sees the new building values and automatically changes the grid totals.

## Frontend node distribution

The current renderer receives `state.settlement.power` and uses four metrics:

```javascript
const p = u.power || {};
const balance = Number(p.balance || 0);
const efficiency = Math.round(Number(p.efficiency || 1) * 100);
```

It then displays:

```javascript
Generation node: p.output
Grid core: efficiency
Load node: p.consumption
Balance caption: p.output - p.consumption
```

The power-flow graphic therefore adjusts dynamically as the aggregate values change, but it does **not** currently create separate nodes for each district module or route power through field-level edges. A new Fusion Reactor changes the Generation total; a new Habitat District changes the Load total; a completed Power Distribution Hub changes the total according to its stored output and consumption. The visual graph remains a three-stage aggregate graph.

## Current brownout limitations

The schema contains `settlement_fields.power_priority`, but `SettlementConstructionService::state()` does not sort or throttle buildings by priority. All active buildings are summed equally. There is no inspected per-module `powered` flag, `allocated_power`, `brownout_penalty`, or priority-based shedding calculation.

Similarly, the service computes an efficiency value but does not itself reduce production, disable lower-priority modules, or apply a direct resource/population penalty. To make brownouts mechanically meaningful, a future authoritative resolver should calculate available power, allocate it by `power_priority`, mark affected modules, and expose the resulting penalties in settlement state.

A possible future model would be:

```text
available_power = total_generation
for modules ordered by power_priority ASC:
    allocated = min(module_consumption, available_power)
    module_power_ratio = allocated / module_consumption
    available_power -= allocated
    module_penalty = 1 - module_power_ratio
```

That model should be implemented server-side, persisted only when necessary for auditability, and returned as explicit module telemetry. The browser should remain a renderer of authoritative allocations, not the calculator.

## Final assessment

The current implementation correctly recalculates aggregate grid output and load whenever completed district modules change. It has transactional construction and completion, immutable queue costs, and a bounded 25% efficiency floor. It does not yet implement field-level power routing, priority-based distribution, or a direct brownout penalty applied to production and population systems. Those are the main gaps between the current aggregate grid and a full dynamic node-distribution system.

# StargateWars Eight-Resource Economy

StargateWars uses eight connected resources rather than treating the colony as a simple Naquadah balance.

| Resource | Symbol | Function |
|---|---|---|
| Metal | M | Buildings, defenses, and ships |
| Crystal | C | Technology and advanced buildings |
| Naquadah | N | Advanced energy, Stargates, and ships |
| Energy | E | Infrastructure and production power |
| Dark Matter | DM | Premium and special resource |
| Food | F | Population consumption and growth |
| Water | W | Population consumption, agriculture, and industry |
| Population | POP | Workforce, housing, taxes, and recruitment |

## Population mechanics

Population capacity is calculated as:

```text
POP_CAP = Housing + Infrastructure + Planetary_Bonuses
```

Food and water are consumed by the current population during settlement:

```text
Food_Use  = Population × Food_Rate × Elapsed_Hours
Water_Use = Population × Water_Rate × Elapsed_Hours
```

Availability is bounded between zero and one:

```text
Food_Availability  = min(1, Food_Stock / max(1, Food_Use))
Water_Availability = min(1, Water_Stock / max(1, Water_Use))
```

Growth then becomes:

```text
POP_GROWTH = Population × Growth_Rate × Food_Availability × Water_Availability × Elapsed_Hours
```

The result is capped at population capacity. Workforce is derived from settled population and the active workforce rate, then feeds production and recruitment.

## Production chain

```text
Food + Water → Population growth → Workforce → Production
```

Metal, Crystal, Naquadah, Energy, and Dark Matter remain strategic and special resources. Production is modified by workforce, race, government, technology, biome, and energy availability.

```text
Production = Base_Output × Workforce_Modifier × Race_Modifier × Government_Modifier × Biome_Modifier × Energy_Availability
```

## Server settlement

`includes/services/EconomyService.php` calculates and settles colony state. `GameService::processTurns()` first settles the player turn and then invokes player-colony settlement for every due interval. Colony state is locked and written transactionally, while `colony_turn_snapshots` and `resource_transactions` preserve the before/after record.

The client only displays the result. It cannot set population, resource balances, food availability, water availability, growth, or workforce values.

## Dashboard display

The PHP dashboard displays:

```text
M 820,000 | C 460,000 | N 1,240,000 | E 640
DM 2,500 | F 10,000 | W 10,000 | POP 100 / 1,000
```

Production and consumption pages should additionally show capacity bars, hourly food and water use, morale, workforce, shortage warnings, and the exact settlement formula used for the current colony.

## Migration

Apply `sql/013_eight_resource_economy.sql` after the existing migrations. It extends `player_resources` and `colonies`, registers all eight resource types, and creates `resource_transactions` for auditable settlement and economy events.

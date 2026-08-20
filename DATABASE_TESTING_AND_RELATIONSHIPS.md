# StargateWars Database Testing and Relationship Reference

## 1. Database integrity testing strategy

Use an isolated test database for every test run. Never run destructive tests against production. A reliable pipeline creates a temporary schema, imports `sql/000_complete_database.sql`, imports `sql/001_complete_seed.sql`, runs structural checks, runs seed assertions, executes transactional service tests, and drops the temporary database.

A practical command sequence is:

```bash
mysql -u root -p -e "DROP DATABASE IF EXISTS stargatewars_test; CREATE DATABASE stargatewars_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
sed 's/USE stargatewars;/USE stargatewars_test;/' sql/000_complete_database.sql | mysql -u root -p
sed 's/USE stargatewars;/USE stargatewars_test;/' sql/001_complete_seed.sql | mysql -u root -p
php tests/database_integrity.php
```

The production application should use a separate database name from the test database. CI should inject `DB_HOST`, `DB_NAME`, `DB_USER`, and `DB_PASS` through environment variables rather than modifying committed configuration files.

## 2. Structural integrity checks

The first test group checks that the schema exists as intended.

```sql
SELECT COUNT(*) AS table_count
FROM information_schema.tables
WHERE table_schema = DATABASE()
  AND table_type = 'BASE TABLE';

SELECT table_name
FROM information_schema.tables
WHERE table_schema = DATABASE()
  AND table_type = 'BASE TABLE'
ORDER BY table_name;

SELECT table_name, column_name, data_type, is_nullable, column_key
FROM information_schema.columns
WHERE table_schema = DATABASE()
ORDER BY table_name, ordinal_position;

SELECT table_name, constraint_name, referenced_table_name, referenced_column_name
FROM information_schema.key_column_usage
WHERE table_schema = DATABASE()
  AND referenced_table_name IS NOT NULL
ORDER BY table_name, constraint_name;
```

The canonical schema contains **54 unique tables** after the duplicate recruitment definition was replaced with the specification's `ip_restrictions` table. A test should assert that the count is 54 and that the required names are present.

The following PHP-style assertion is suitable for `tests/database_integrity.php`:

```php
$expectedTables = [
    'races','players','player_resources','player_unit_stats','menu_items',
    'page_content','rank_definitions','game_settings','player_technologies',
    'technologies','weapon_types','player_weapons','motherships',
    'mothership_modules','player_planets','planet_bonuses','planet_defenses',
    'alliances','alliance_members','commander_relationships',
    'officer_relationships','recruitment_records','battles','battle_participants',
    'battle_reports','attack_logs','covert_agents','anti_covert_agents',
    'spy_missions','sabotage_missions','covert_missions','intelligence_reports',
    'market_orders','private_trades','mercenary_types','player_mercenaries',
    'rankings','rank_snapshots','glory_reputation','ascensions',
    'ascension_states','protection_states','vacation_states','messages',
    'blacklists','target_realms','ip_restrictions','game_turns','turn_events',
    'game_events','audit_logs','alliances_black_market','supporter_status',
    'planet_explorations'
];

$actualTables = $pdo->query(
    "SELECT table_name FROM information_schema.tables
     WHERE table_schema = DATABASE() AND table_type = 'BASE TABLE'"
)->fetchAll(PDO::FETCH_COLUMN);

$missing = array_diff($expectedTables, $actualTables);
$unexpected = array_diff($actualTables, $expectedTables);
if ($missing || $unexpected) {
    throw new RuntimeException(json_encode([
        'missing' => array_values($missing),
        'unexpected' => array_values($unexpected),
    ], JSON_PRETTY_PRINT));
}
```

## 3. Foreign-key integrity checks

The test suite should verify that every foreign key points to an existing parent row. The database engine enforces this for inserts and deletes, but explicit orphan checks make fixture mistakes easier to diagnose.

```sql
SELECT COUNT(*) AS orphan_resources
FROM player_resources r
LEFT JOIN players p ON p.id = r.player_id
WHERE p.id IS NULL;

SELECT COUNT(*) AS orphan_weapon_inventory
FROM player_weapons pw
LEFT JOIN players p ON p.id = pw.player_id
LEFT JOIN weapon_types wt ON wt.id = pw.weapon_type_id
WHERE p.id IS NULL OR wt.id IS NULL;

SELECT COUNT(*) AS orphan_planet_bonuses
FROM planet_bonuses b
LEFT JOIN player_planets p ON p.id = b.planet_id
WHERE p.id IS NULL;

SELECT COUNT(*) AS orphan_battles
FROM battles b
LEFT JOIN players a ON a.id = b.attacker_id
LEFT JOIN players d ON d.id = b.defender_id
WHERE a.id IS NULL OR d.id IS NULL;

SELECT COUNT(*) AS orphan_reports
FROM battle_reports r
LEFT JOIN battles b ON b.id = r.battle_id
LEFT JOIN players p ON p.id = r.recipient_id
WHERE b.id IS NULL OR p.id IS NULL;
```

Every result must be zero. Add equivalent checks for `alliance_members`, `mothership_modules`, `player_mercenaries`, `intelligence_reports`, `private_trades`, `rank_snapshots`, `turn_events`, and `ip_restrictions`.

## 4. Seed-data tests

Seed tests should check both presence and semantic validity. The following assertions should pass after importing `001_complete_seed.sql`:

```sql
SELECT COUNT(*) AS race_count FROM races;
SELECT COUNT(*) AS rank_count FROM rank_definitions;
SELECT COUNT(*) AS technology_count FROM technologies;
SELECT COUNT(*) AS weapon_type_count FROM weapon_types;
SELECT COUNT(*) AS mercenary_type_count FROM mercenary_types;
SELECT COUNT(*) AS navigation_count FROM menu_items;
SELECT COUNT(*) AS page_count FROM page_content;
SELECT COUNT(*) AS player_count FROM players;
```

Recommended semantic assertions include:

```sql
-- Exactly four base races must exist.
SELECT COUNT(*) FROM races
WHERE name IN ('Asgard','Goa''uld','Replicator','Tau''ri');

-- All race modifiers must be positive and all four primary modifiers must exist.
SELECT COUNT(*) FROM races
WHERE attack_modifier > 0
  AND defense_modifier > 0
  AND income_modifier > 0
  AND covert_modifier > 0;

-- Required turn settings must exist.
SELECT COUNT(*) FROM game_settings
WHERE setting_key IN ('turn_interval_seconds','turn_generation_threshold',
  'turn_max_storage','natural_income_untrained','natural_income_miner',
  'market_turns_weekly','max_defcon');

-- Every player must have the essential one-to-one state rows.
SELECT p.id
FROM players p
LEFT JOIN player_resources r ON r.player_id=p.id
LEFT JOIN player_unit_stats u ON u.player_id=p.id
LEFT JOIN motherships m ON m.player_id=p.id
LEFT JOIN protection_states ps ON ps.player_id=p.id
LEFT JOIN rankings rk ON rk.player_id=p.id
WHERE r.player_id IS NULL OR u.player_id IS NULL OR m.player_id IS NULL
   OR ps.player_id IS NULL OR rk.player_id IS NULL;
```

The last query must return no rows. Seed tests should also verify that `demo` and `opponent_demo` exist, that both reference valid races, and that every seeded target references a valid player or intentionally has a null `player_id`.

## 5. Constraint and transaction tests

Test unique constraints by attempting duplicate usernames, duplicate race names, duplicate technology keys, duplicate weapon names, duplicate alliance tags, duplicate player-weapon rows, duplicate alliance memberships, and duplicate planet bonus types. Each insert should fail with a duplicate-key exception.

Test cascade behavior by creating a temporary player with resources, a mothership, a planet, and messages, deleting the player, and asserting that dependent rows are removed. Do not run this against seeded production players.

Test transaction rollback by forcing a service failure after a resource deduction but before the event insert. The Naquadah balance, inventory, and event table should remain unchanged. This is especially important for combat, market settlement, ascension, and planet conquest.

## 6. Recommended automated test layout

```text
tests/
├── database_integrity.php       # Tables, columns, foreign keys, indexes
├── seed_integrity.php           # Races, settings, menus, demo state
├── service_turns.php            # Turn calculation and idempotency
├── service_training.php         # Training and Unit Production
├── service_combat.php           # Combat, casualties, loot, reports
├── service_espionage.php       # Recon, spy, sabotage, detection
├── service_market.php           # Orders, settlement, escrow, rollback
├── service_planets.php          # Exploration, bonuses, defenses, ownership
├── service_social.php           # Alliances, messages, recruitment
└── service_ascension.php       # Requirements, conversion, persistence
```

Use a fresh fixture transaction for each test. For tests that need to verify commits, commit the fixture setup first, call the service, then query the resulting state. For tests that verify rollback, wrap the service call in an exception assertion and compare before/after snapshots.

## 7. Complete table breakdown

### Identity, configuration, and navigation

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 1 | `races` | Four base races, bank names, and combat/economy modifiers. | Referenced by `players`. |
| 2 | `players` | Core account, race, rank, glory, reputation, protection, commander, and alliance identity. | Belongs to `races`; self-references `commander_id`; referenced by almost every player-owned table. |
| 3 | `player_resources` | Naquadah, banked Naquadah, turns, population, units, spies, and covert capacity. | One-to-one with `players`. |
| 4 | `player_unit_stats` | Covert level, anti-covert level, and derived power values. | One-to-one with `players`. |
| 5 | `menu_items` | Hierarchical left-side navigation. | Self-references `parent_id`. |
| 6 | `page_content` | Page titles, descriptions, body metadata, and minimum rank. | Route-oriented; `minimum_rank_level` is consumed by application RBAC. |
| 7 | `rank_definitions` | Rank names and Glory/Reputation thresholds. | Referenced logically by `players.rank_level`. |
| 8 | `game_settings` | Turn interval, caps, income constants, market limits, and anti-abuse settings. | Key/value configuration table. |

### Technology, weapons, and fleet

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 9 | `player_technologies` | Per-player technology levels and next upgrade costs. | Belongs to `players`; optionally references `technologies` through `technology_id`. |
| 10 | `technologies` | Offense, defense, covert, anti-covert, unique, and mercenary definitions. | Referenced by `player_technologies`. |
| 11 | `weapon_types` | Weapon definitions, category, power, cost, and durability. | Referenced by `player_weapons`. |
| 12 | `player_weapons` | Player inventory and durability for each weapon type. | Belongs to `players` and `weapon_types`. |
| 13 | `motherships` | One command vessel per player, with hull, bays, hangars, weapons, shields, and exploration level. | One-to-one with `players`. |
| 14 | `mothership_modules` | Extensible module inventory for mothership upgrades. | Belongs to `motherships`; unique per module key. |

### Planets and world state

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 15 | `player_planets` | Owned planets, size, type, bonuses, ownership time, and conquest origin. | Belongs to `players`; self-references the previous owner through `conquered_from`. |
| 16 | `planet_bonuses` | Typed attack, defense, income, covert, production, and mothership bonuses. | Belongs to `player_planets`; unique per planet and bonus type. |
| 17 | `planet_defenses` | Planetary defense installations and strength. | Belongs to `player_planets`; unique per planet and defense type. |
| 18 | `planet_explorations` | Exploration attempts, discovery type, status, and result payload. | Belongs to `players`. |

### Political relationships and social systems

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 19 | `alliances` | Alliance identity, tag, founder, and description. | Belongs to founder `players`; parent of `alliance_members`. |
| 20 | `alliance_members` | Many-to-many player/alliance membership with role. | Joins `alliances` and `players`. |
| 21 | `commander_relationships` | Commander-to-officer income and Unit Production relationship. | Joins two `players` rows. |
| 22 | `officer_relationships` | Reverse/typed officer relationship record. | Joins two `players` rows. |
| 23 | `recruitment_records` | Invitations and commander recruitment lifecycle. | Joins commander and recruit `players`. |
| 24 | `messages` | Private player-to-player messages and read state. | Joins sender and recipient `players`. |
| 25 | `blacklists` | Player block lists and interaction restrictions. | Self-joins `players` through player and blocked-player IDs. |
| 26 | `ip_restrictions` | Same-IP, attack, transfer, and commander restrictions. | Belongs to `players`; stores an indexed binary IP address. |

### Combat and battle history

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 27 | `battles` | Authoritative combat result, seed, snapshots, scores, winner, loot, and casualties. | Joins attacker, defender, and optional winner `players`. |
| 28 | `battle_participants` | Detailed per-player units sent and lost for a battle. | Joins `battles` and `players`. |
| 29 | `battle_reports` | Player-readable battle reports. | Belongs to `battles` and recipient `players`. |
| 30 | `attack_logs` | Compact searchable attack history. | References `battles`, attacker, and defender. |

### Covert and intelligence systems

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 31 | `covert_agents` | Count and quality level of covert agents. | One-to-one with `players`. |
| 32 | `anti_covert_agents` | Count and quality level of anti-covert agents. | One-to-one with `players`. |
| 33 | `spy_missions` | Recon and spy mission outcomes, detection, and agent losses. | Joins attacker and defender `players`. |
| 34 | `sabotage_missions` | Targeted sabotage operations and damage values. | Joins attacker and defender `players`. |
| 35 | `covert_missions` | Unified mission log used by the current service layer. | Joins attacker and defender `players`. |
| 36 | `intelligence_reports` | JSON intelligence payloads produced by successful reconnaissance. | Joins reporting player and target player. |

### Markets and mercenaries

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 37 | `market_orders` | Open, filled, or cancelled resource/mercenary/weapon orders. | Belongs to seller `players`. |
| 38 | `private_trades` | Direct player-to-player offers and acceptance state. | Joins sender and recipient `players`. |
| 39 | `mercenary_types` | Recruitable mercenary definitions and capacity costs. | Referenced by `player_mercenaries`. |
| 40 | `player_mercenaries` | Per-player mercenary quantities. | Joins `players` and `mercenary_types`. |
| 41 | `alliances_black_market` | Alliance/black-market listings for special items. | Belongs to seller `players`. |

### Rankings, Glory, Reputation, and Ascension

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 42 | `rankings` | Current overall, military, economy, covert scores and position. | One-to-one with `players`. |
| 43 | `rank_snapshots` | Historical daily ranking records. | Belongs to `players`; unique per player/date. |
| 44 | `glory_reputation` | Dedicated ledger state for Glory and Reputation. | One-to-one with `players`. |
| 45 | `ascensions` | Immutable ascension transactions and converted value. | Belongs to `players`. |
| 46 | `ascension_states` | Current ascension count, ascended race, points, and last ascension. | One-to-one with `players`. |
| 47 | `supporter_status` | Optional supporter tier and validity period. | One-to-one with `players`. |

### Protection, turns, events, and auditing

| # | Table | Purpose | Main relationships |
|---:|---|---|---|
| 48 | `protection_states` | PPT, vacation, cooldown, and protection timestamps. | One-to-one with `players`. |
| 49 | `vacation_states` | Explicit active vacation lifecycle. | One-to-one with `players`. |
| 50 | `game_turns` | Global turn-processing runs and status. | Parent of `turn_events`. |
| 51 | `turn_events` | Per-turn income, population, and timed-effect events. | Joins optional `game_turns` and `players`. |
| 52 | `game_events` | Immutable application domain events for audit/replay. | Optionally belongs to `players`; stores JSON payloads. |
| 53 | `audit_logs` | Security and request-level audit records. | Optionally belongs to `players`; stores request IDs and IP addresses. |
| 54 | `target_realms` | Searchable target snapshot data for attack and covert selection. | Optionally links a snapshot to a live `players` row. |

## 8. High-level relationship graph

```text
races ───────< players >────── commander_relationships ──────> players
                  │  │  │
                  │  │  ├──── alliance_members >──── alliances
                  │  │  ├──── player_resources
                  │  │  ├──── player_unit_stats
                  │  │  ├──── player_technologies >──── technologies
                  │  │  ├──── player_weapons >──── weapon_types
                  │  │  ├──── motherships >──── mothership_modules
                  │  │  ├──── player_planets >──── planet_bonuses
                  │  │  │                         planet_defenses
                  │  │  ├──── market_orders / private_trades / messages
                  │  │  ├──── rankings / rank_snapshots / glory_reputation
                  │  │  ├──── ascensions / ascension_states
                  │  │  └──── protection_states / vacation_states
                  │  │
                  │  ├──── battles >──── battle_participants
                  │  │              └──── battle_reports / attack_logs
                  │  ├──── spy_missions / sabotage_missions / covert_missions
                  │  │              └──── intelligence_reports
                  │  └──── game_events / audit_logs / turn_events
                  │
menu_items ─────── self-referencing parent/child navigation tree
```

The design intentionally keeps authoritative state on the server. Client forms submit intent, such as an attack target and turn count; services calculate combat, update wallets and units, create reports, and append immutable events inside a transaction.

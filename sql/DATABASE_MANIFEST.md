# StargateWars Database Manifest

## Canonical fresh installation

Use these files for a new database:

```bash
mysql -u root -p < 000_complete_database.sql
mysql -u root -p stargatewars < 001_complete_seed.sql
```

`000_complete_database.sql` contains 54 normalized tables covering the complete reconstructed design: identity, races, wallets, units, technologies, weapons, motherships, planets, alliances, commander/officer relationships, recruitment, combat, battle participants, reports, covert operations, intelligence, markets, private trades, mercenaries, rankings, glory, reputation, ascension, protection, vacation, messages, blacklists, turn processing, events, audit, supporter state, and exploration.

`001_complete_seed.sql` contains race modifiers, bank names, ranks, settings, navigation menus, page metadata, technology definitions, weapons, mercenaries, demo commanders, starting wallets, motherships, planets, planetary bonuses, target realms, and ranking rows.

## Demo data

The seed creates `demo` and `opponent_demo` if they do not already exist. Both receive the SQL seed password value `demo123` using the legacy SHA-256 seed format used by the historical starter files. For production, create a fresh account through `register.php`, rotate or remove these rows, and use `password_hash()`-generated credentials.

## Legacy installation path

The earlier files are retained for databases that were created before the canonical schema was added:

```text
schema.sql
002_seed_subpage_data.sql
003_rbac_ranks.sql
004_game_systems.sql
005_test_scenario.sql
```

Do not mix the legacy sequence with the canonical fresh-install pair unless you are intentionally writing an upgrade migration. The canonical pair is the complete source of truth for a new installation.

# StargateWars Missing Files and Coverage Audit

## Final status

The project has no missing registered page entrypoints or missing runtime layout contracts.

| Area | Result |
|---|---:|
| Registered routes | 43 |
| PHP page files | 61, including the shared `_entry.php` |
| Runtime layouts | 28 |
| Interaction buttons and sub-buttons | 58 |
| Missing page files | None |
| Missing layout contracts | None |
| Unwired mutating interactions | None |
| Seeded races | 5 |
| Seeded governments | 9 |
| PHP parse errors | 0 |
| Empty managed module folders | 0 |

## Covered systems

The page system covers Command Center, account, economy, combat, covert operations, reports, armory, markets, training, technology, intelligence, rankings, alliances, messages, planets, mothership, exploration, progression, galaxies, sectors, solar systems, universe planets, moons, and coordinate lookup.

The system contracts are maintained in `config/page_registry.php`, `config/page_runtime_specs.php`, `config/dashboard_page_details.php`, `config/player_interaction_contracts.php`, and `config/page_feature_contracts.php`.

## Verification commands

```bash
php tools/audit_requested_pages.php
php tools/audit_player_interactions.php
php tools/audit_factions.php
php tools/audit_modules.php
find . -type f -name '*.php' -print0 | xargs -0 -n1 php -l
```

The remaining storage log directory is now populated by `09_Storage/Logs/README.md`, defining gameplay, audit, security, cron, database, and performance logging contracts.

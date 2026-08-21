# Integration Test and Transaction Inspection Report

## Scope

This report covers all 43 generated Universe Civilization: Empire at Wars page modules, the executable page-module function family, the secure action controller, and the canonical database schema contract.

## Integration results

The test command was:

```bash
php tests/page_modules_integration.php
```

The suite completed successfully without mutating the database.

| Metric | Result |
|---|---:|
| Registered routes | 43 |
| Modules loaded | 43 |
| Valid intents accepted | 90 |
| Invalid intents rejected | 43 |
| Negative-value requests rejected | 5 |
| Feedback-state transitions checked | 344 |
| Declared actions checked | 90 |
| Database mutations | 0 |

Every module was checked for route identity, preview structure, logic, features, design, systems, action enumeration, intent validation, and state-context preservation. The tested feedback states were loading, ready, empty, protected, insufficient-resource, cooldown, success, and error.

Combat and espionage edge cases included a valid combat target, a rejected zero combat target, a valid spy target, a rejected zero spy target, and a valid sabotage request. These tests used module validation and preview functions only, so they did not invoke transactional writes.

## Database contract inspection

The canonical installation is defined by `sql/000_complete_database.sql` and `sql/001_complete_seed.sql`. The canonical schema contains 54 normalized tables. Its domains include identity, factions, wallets, units, technologies, weapons, motherships, colonies and planets, alliances, combat, battle participants, battle reports, covert operations, intelligence, markets, rankings, glory, reputation, ascension, protection, vacation, messaging, turn processing, events, audit, supporter state, and exploration.

The page contract layer makes database impact explicit. Target Selection reads target realms, players, rankings, protection states, and technologies, and writes battles, battle rounds, battle reports, attack logs, and resource state through services. Covert pages read covert agents, anti-covert agents, target realms, and technologies, and write mission and intelligence records through services.

## Transaction and error-handling inspection

`actions/game.php` enforces the request boundary in this order:

1. It loads the authentication bootstrap and requires an authenticated commander.
2. It loads the service layer classes.
3. It rejects requests that are not POST requests.
4. It verifies the CSRF token.
5. It resolves the current user and validates the requested redirect against an allowlist.
6. It dispatches the action to a service inside a `try` block.
7. It stores successful feedback in the session and catches `Throwable` failures into session error feedback.
8. It redirects to the allowlisted page route.

Combat actions map to `GameService::resolveCombat()`. The service validates combat turns and target rules, locks relevant player and resource rows, calculates scores and casualties, persists battle and report records, writes an event, and commits. Covert actions map to `GameService::covertMission()`. The service validates mission type and agent count, locks attacker and defender state, calculates success and detection, consumes agents, persists mission and intelligence records, writes an event, and commits.

The controller supports the explicit aliases `combat:raid`, `covert:recon`, `covert:spy`, and `covert:sabotage`, mapping them to the corresponding service operation types.

## Reproducibility

Run the full module suite with:

```bash
cd /home/ubuntu/stargatewars
php tests/page_modules_integration.php
```

Run contract validation with:

```bash
php tools/validate_contracts.php
```

The presentation script is in [`MODULAR_PHP_ARCHITECTURE_PRESENTATION_SCRIPT.md`](MODULAR_PHP_ARCHITECTURE_PRESENTATION_SCRIPT.md).

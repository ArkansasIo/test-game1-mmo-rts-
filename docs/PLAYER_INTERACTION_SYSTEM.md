# Universe Civilization: Empire at Wars Player Interaction System

## Interaction model

Each page is a **server-authoritative player workspace**. The player can inspect current state, select an intent, and submit a controlled action. The browser never decides resource balances, combat outcomes, ownership, permissions, cooldowns, or rewards.

```text
Player page
  → button or sub-button intent
  → authenticated POST actions/game.php
  → CSRF verification
  → route and RBAC validation
  → service-layer validation
  → row locks and transaction
  → game-state updates, reports, events, and audit records
  → redirect with result feedback
```

## Button contract

Every interactive control has a stable contract:

| Field | Meaning |
|---|---|
| `action` | Server action or navigation intent |
| `logic` | Human-readable game rule executed by PHP |
| `permission` | Minimum access or ownership requirement |
| `reads` | Tables used for validation and current state |
| `writes` | Tables changed by the action |
| `states` | Loading, ready, protected, invalid, success, or failure outcomes |

The structured source is `config/player_interaction_contracts.php`.

## Dashboard and sub-menu behavior

The left navigation groups related systems. Each group contains page routes, and each page exposes controls specific to its game loop.

| Navigation group | Main player loop |
|---|---|
| Command Center | Process turns, inspect resources, review reports, open colonies |
| Attack | Select targets, attack, raid, spy, sabotage, inspect results |
| Armory | Buy weapons, inspect durability, list market orders, repair equipment |
| Training | Convert population into miners, lifers, combat units, spies, and anti-spies |
| Technology | Inspect branches, check prerequisites, queue research, collect effects |
| Intelligence | Read spy logs, enemy intelligence, detection results, and reports |
| Market | Exchange resources, weapons, and mercenaries through validated orders |
| Social | Rankings, alliances, messages, diplomacy, and notifications |
| Planets | Explore worlds, colonize, manage biomes, defenses, food, and water |
| Mothership | Upgrade hull, weapons, shields, modules, and exploration capacity |
| Account | Select race, select government, reform government, vacation, ascension |
| Universe | Browse galaxies, sectors, systems, planets, moons, and coordinates |

## Game-player functions

The principal server-side functions are:

```php
processTurns();
train();
upgradeUnitProduction();
buyTechnology();
queueResearch();
resolveCombat();
runCovertMission();
createMarketOrder();
settleMarketOrder();
repairWeapon();
colonizePlanet();
launchFleetMission();
upgradeMothership();
recordDiscovery();
selectRegistration();
reformGovernment();
joinWorldEvent();
ascend();
```

Each function must accept the authenticated player ID from the session rather than trusting a player ID from the form.

## Shared validation rules

Resource actions require a positive integer amount, sufficient available balance, capacity validation, and transaction logging. Fleet and combat actions require target existence, target protection checks, available turns or units, cooldown checks, and ownership validation. Colony actions require a valid physical universe planet, habitability checks, occupancy locking, and coordinate uniqueness. Social actions require membership, role, invitation, or relationship validation. Progression actions require server-calculated thresholds.

## Result feedback

All pages support explicit result states:

- **Loading:** data is being retrieved.
- **Ready:** state is available and controls are enabled.
- **Empty:** no records exist for the requested view.
- **Protected:** the target or account is protected.
- **Locked:** a prerequisite or progression gate is incomplete.
- **Insufficient resource:** the player lacks the required resource, turn, unit, or capacity.
- **Cooldown:** the action cannot be repeated yet.
- **Success:** the transaction committed and the resulting state is available.
- **Error:** the transaction rolled back and a safe message is shown.

## Database authority

The source of current state is stored in MySQL tables such as `players`, `player_resources`, `player_colonies`, `construction_queue`, `fleet_missions`, `technologies`, `battles`, `intelligence_reports`, `market_orders`, `alliances`, `messages`, `universe_planets`, and `universe_moons`. Audit and event tables retain the history needed for reports, rankings, notifications, and debugging.

## Frontend design rules

The page renderer keeps a white background, black text, a persistent left navigation, nested sub-menus, a five-resource header, high-contrast action buttons, responsive tables, accessible focus states, and visible feedback banners. Read-only controls are represented as navigation or inspection intents; state-changing buttons always map to a named server action and a CSRF-protected form in the production PHP pages.

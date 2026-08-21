# Universe Civilization: Empire at Wars System Map and Fleet Mission UI Integration Guide

## Purpose

This guide defines how the frontend should integrate the Solar Systems map, fleet-mission actions, player-resource state, and standardized feedback states. The browser submits commander intent only. The PHP service layer remains authoritative for ownership, coordinates, discovery, gate access, mission validity, resource balances, cooldowns, persistence, and event creation.

## Active route and action contract

| UI surface | Dashboard route | Read intent | Mutation intent | Primary service |
|---|---|---|---|---|
| Solar Systems | `solar-systems` | `system_map` | `explore` | `WorldService` / exploration service |
| Fleet mission launch | `shipyard`, `missions`, or fleet action controls | fleet state read | `launch_mission` | `OGameService::launchMission()` |
| Coordinate navigation | `coordinates` | `coordinate_lookup` | none | `WorldService` |
| Sector navigation | `sectors` | `universe_sectors` | none | `WorldService` |
| Resource header | shared dashboard shell | refreshed state | service-specific mutation | `GameService` and resource services |

The canonical mutation endpoint is `POST /actions/game.php`. Every mutation form must include the session CSRF token, an explicit `action`, a validated `redirect` route, and only the user intent fields required by that action.

## Solar Systems state specification

The Solar Systems panel is rendered by `solarSystemsPage()` in `game.php`. It presents system planets, fleet lanes, jump-gate status, scan telemetry, and anomaly exploration controls. The visible status card should remain player-facing, while the technical contract is available through expandable details.

| State | Visual treatment | Required behavior |
|---|---|---|
| `ready` | Show the system route, orbit map, fleet lanes, and active scan controls. | Enable inspection and eligible anomaly exploration. |
| `empty` | Show a non-error empty-state panel with a navigation suggestion. | Do not fabricate planets, fleets, or anomaly rewards. |
| `protected` | Show a neutral protection notice and preserve the map context. | Disable the protected operation and explain that server policy blocked it. |
| `cooldown` | Show remaining cooldown time and disable only the affected action. | Keep read-only map inspection available where permitted. |
| `success` | Show a success banner and refreshed system state. | Display the server-returned discovery, reward, travel, and persistence identifiers. |
| `error` | Show a concise actionable error banner. | Preserve the selected coordinates and do not update local resources optimistically. |

The system-map technical contract is:

| Contract element | Definition |
|---|---|
| Actions | `system_map`, `explore` |
| Data sources | `universe_solar_systems`, `universe_planets`, `universe_moons`, `universe_discoveries`, `fleet_missions`, `player_cooldowns`, `player_resources`, `game_events` |
| Server rules | Coordinate validation, discovery, gate availability, scan telemetry, anomaly rewards, cooldowns, and persistence are server-authoritative. |

## Fleet mission component specification

A fleet mission component should be composed of a source-colony selector, optional target selector, mission-type selector, payload editor, travel-time preview, resource preview, cooldown indicator, and submit control. The component must render from refreshed server state rather than infer mission completion locally.

### Supported mission types

The `OGameService::launchMission()` contract accepts `transport`, `attack`, `raid`, `espionage`, `colonize`, `recycle`, and `explore`. The client must submit the selected type as intent; the service validates the allow-list, travel duration, source ownership, target ownership when a target is provided, and transaction state.

| Field | Type | Client responsibility | Server responsibility |
|---|---:|---|---|
| `source_colony_id` | integer | Submit selected source colony. | Confirm the colony belongs to the authenticated commander. |
| `target_colony_id` | nullable integer | Submit only when the mission needs a target. | Confirm target ownership or apply mission-specific target policy. |
| `mission_type` | enum string | Submit one supported mission type. | Enforce the allow-list and mission rules. |
| `payload` | JSON object | Submit mission intent such as fleet quantities or destination metadata. | Validate structure, quantities, capacity, and authority. |
| `travel_seconds` | integer | Submit the previewed travel duration. | Reject values below one second and recompute or validate authoritative travel rules. |
| `csrf` | token | Include the active session token. | Verify before dispatch. |
| `redirect` | route | Request the relevant dashboard panel after completion. | Restrict redirect to the allow-list. |

## Fleet mission persistence contract

The `fleet_missions` table is the authoritative mission record. The launch transaction inserts a mission, writes a `fleet_mission_launched` event, and commits both records atomically.

| Column | Meaning |
|---|---|
| `id` | Mission identifier returned after commit. |
| `player_id` | Authenticated commander owner. |
| `source_colony_id` | Owned source colony. |
| `target_colony_id` | Optional target colony. |
| `mission_type` | Supported mission enum. |
| `payload` | Server-persisted mission payload JSON. |
| `departure_at` | Outbound start timestamp. |
| `arrival_at` | Expected arrival timestamp. |
| `return_at` | Optional return timestamp. |
| `status` | `scheduled`, `outbound`, `arrived`, `returning`, `completed`, `failed`, or `cancelled`. |

Related tables include `colony_fleets`, `fleet_types`, `construction_queue`, `player_cooldowns`, `player_resources`, and `game_events`. Fleet quantities and resource balances must be refreshed from the server after a successful action.

## Player-resource integration

The shared header and action panels use the resource snapshot as display state only. The client must never calculate an authoritative balance, deduct resources locally, or assume a mission succeeded because a button was clicked.

| Resource state | UI rule |
|---|---|
| Available resource | Enable an action only when the server-provided preview says it is eligible. |
| Insufficient resource | Disable the affected action and show the required amount, but still revalidate on the server. |
| Zero resource | Render `0` safely and preserve read-only navigation. |
| Refreshed resource | Replace the entire resource snapshot after a successful mutation. |
| Resource error | Keep the last confirmed state and show an error feedback banner. |

## Component integration pattern

Each interactive system-map or fleet component should follow this sequence:

1. Read the current route state and server-provided resource, cooldown, discovery, fleet, and permission values.
2. Render controls with stable `data-action` or form action identifiers.
3. Validate basic client input for usability only, including required fields, numeric bounds, and coordinate format.
4. Submit the CSRF-protected intent to `/actions/game.php`.
5. Treat the response or redirected session state as authoritative.
6. Replace affected panels, resources, cooldowns, missions, and feedback banners from refreshed server state.
7. Keep the selected route and user input when the server returns `empty`, `protected`, `cooldown`, or `error`.

The existing dashboard feedback renderer uses `state.feedback`, `feedback.state`, and `feedback.message`. New components should preserve that contract and avoid introducing independent error formats.

## Feedback-state component contract

| State | Banner tone | Controls | Data handling |
|---|---|---|---|
| `loading` | Neutral progress | Disable duplicate submits. | Do not mutate displayed balances. |
| `ready` | Neutral/positive | Enable eligible controls. | Render current confirmed state. |
| `empty` | Neutral informational | Keep navigation and search available. | Render empty collections, not fake records. |
| `protected` | Warning | Disable protected action. | Preserve map and resource state. |
| `insufficient-resource` | Warning/error | Disable or explain the blocked action. | Preserve confirmed balances. |
| `cooldown` | Warning | Disable the affected action and show remaining time. | Keep unrelated controls usable. |
| `success` | Positive | Re-enable controls after refresh. | Replace state with committed server response. |
| `error` | Error | Allow retry after correction. | Do not apply optimistic resource or mission changes. |

## Transaction and security requirements

The browser must not submit client-calculated combat outcomes, ownership assertions, cooldown bypasses, resource balances, or mission status. The PHP action controller verifies authentication and CSRF before dispatch. `OGameService::launchMission()` validates mission type and travel duration, verifies source and target colonies through commander ownership checks, inserts the mission transactionally, writes a game event, and rolls back on failure.

The system-map read path must enforce coordinate hierarchy and discovery visibility before returning planets, moons, ownership signals, gate status, or navigation identifiers. Exploration must additionally validate mothership readiness, target eligibility, resource cost, cooldown, reward calculation, persistence, and event creation server-side.

## Acceptance checklist

| Check | Expected result |
|---|---|
| System map route | `game.php?page=solar-systems` renders without reload errors. |
| Fleet launch form | Submits `launch_mission` with CSRF and allowed redirect. |
| Invalid mission type | Rejected by the PHP service layer. |
| Unowned source colony | Rejected without mission insertion. |
| Invalid target colony | Rejected without mission insertion. |
| Zero resource state | Renders safely and does not produce negative balances. |
| Cooldown state | Affected action is disabled and remaining time is visible. |
| Successful launch | Mission row and `fleet_mission_launched` event commit together. |
| Failed launch | Mission and event writes roll back together. |
| Route integration | All active dashboard route contracts remain valid. |

## Source files

This guide reflects the current implementations in `game.php`, `actions/game.php`, `includes/services/OGameService.php`, `includes/services/WorldService.php`, `includes/services/MothershipExplorationService.php`, `sql/006_ogame_systems.sql`, `sql/008_mmorpg_rts_core.sql`, and `sql/013_eight_resource_economy.sql`.

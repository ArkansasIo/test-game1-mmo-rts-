# StargateWars Text MMORPG / Turn-Based RTS Game Loop

## Core loop

A commander signs in, selects a colony, processes due turns, reviews production and life-support state, chooses a strategic action, submits the action to PHP, and receives a persisted report. The browser presents text, tables, forms, queues, logs, and status banners; the server remains authoritative for all game state.

| Stage | Server responsibility | Player-facing pages |
|---|---|---|
| Identity | Authenticate session, load rank, race, permissions, and active colony | Login, Account, Dashboard |
| Turn settlement | Calculate elapsed turns, resource production, food/water consumption, population growth, queue completion, and mission arrivals | Command Center, Resources, Colonies |
| Development | Validate and queue building, research, unit, fleet, defense, and mothership actions | Buildings, Research, Training, Shipyard, Armory |
| Strategy | Validate and resolve attack, raid, espionage, sabotage, exploration, colonization, and transport | Targets, Spy, Sabotage, Planets, Missions |
| Diplomacy | Create/join alliances, exchange messages, negotiate trades, and manage officers | Alliances, Messages, Market |
| Progression | Update rankings, Glory, Reputation, rank, supporter state, protection, vacation, and Ascension | Rankings, Account, Protection, Ascension |
| Feedback | Write battle reports, intelligence reports, mission logs, event logs, and audit records | Attack Log, Spy Log, Mission Log, Reports |

## Turn model

The turn worker calculates completed intervals from each player or colony timestamp. It locks the relevant rows, applies resource and life-support deltas, processes due construction and missions, records snapshots and events, and advances the timestamp. Re-running the worker does not recreate already-settled intervals.

## Action model

Every state-changing form posts an action name, bounded parameters, a CSRF token, and an allow-listed redirect page. PHP validates ownership, rank, cooldown, protection, resource availability, quantity limits, and target eligibility. A domain service calculates the result and persists all changes in one transaction.

## Entity groups

The model is organized around worlds, players, races, colonies, resource balances, buildings, research, unit pools, fleet types, colony fleets, defenses, construction queues, fleet missions, combat reports, covert reports, alliances, markets, messages, rankings, progression, world events, and audit/game events.

## Page map

The main left navigation is divided into Command Center, Economy, Development, Military, Intelligence, Planets, Fleets, Social, Market, Progression, and Account. Each parent menu exposes sub-pages for management screens, action forms, status tables, reports, and history views.

## Text-based RTS behavior

The game does not require real-time graphics. Players make strategic decisions through readable summaries and forms. Time advances through scheduled turns and queue timestamps. Battles and missions resolve on the server, while reports communicate the outcome in text and structured tables.

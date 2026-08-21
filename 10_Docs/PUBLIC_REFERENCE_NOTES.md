# Public Universe Civilization: Empire at Wars Reference Notes

## Sources reviewed

1. [StarGateWars User Guide](https://stargatewars.fandom.com/wiki/StarGateWars_(User_Guide)) — public community guide reviewed on 2026-08-20.
2. [Universe Civilization: Empire at Wars Wiki](https://stargatewars.fandom.com/wiki/Universe Civilization: Empire at Wars) — public game overview discovered through search.
3. [Planet](https://stargatewars.fandom.com/wiki/Planet) — public planet-system reference discovered through search.
4. [Mothership](https://stargatewars.fandom.com/wiki/Mothership) — public mothership-system reference discovered through search.
5. [Ascension](https://stargatewars.fandom.com/wiki/Ascension) — public progression reference discovered through search.
6. [GateWars main site](https://main.gatewa.rs/) — public official/community-facing game entry point discovered through search.
7. [advocaite/Stargate-Wars](https://github.com/advocaite/Stargate-Wars) — public code repository discovered through search; use only as a reference and do not copy unverified historical behavior.

## Findings used for design

The public guide documents four starting races: Asgard, Goa'uld, Replicator, and Tau'ri. It describes the persistent 30-minute turn loop, Naquadah, untrained units, Unit Production, attack turns, bank/vault storage, training, weapons, technology, covert operations, alliances, commanders, officers, rankings, vacation, and Ascension.

The guide describes a left-column interface, a visible HUD containing player, race, rank, game time, turns, Naquadah, vault/bank, next-turn status, and messages, and menus for Command Center, Actions, Attack Log, Armory, Training, Market, Alliances, and Ascension. These findings inform the categorized navigation and module structure.

The source also describes race specialization: Asgard favors defense, Goa'uld favors income, Replicator favors covert power, and Tau'ri favors attack. These are implemented as configurable game rules rather than claims that the modern recreation reproduces the original server exactly.

## Historical caveat

The public materials are community documentation and do not provide authoritative original server source code. Weapon catalogs, exact casualty rules, loot percentages, sabotage algorithms, market settlement details, and some Ascension thresholds should therefore remain configurable and clearly labeled as recreation rules in the application.

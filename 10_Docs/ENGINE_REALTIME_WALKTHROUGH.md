# Real-Time Turn and Combat Engine Walkthrough

## Turn-processing engine

The scheduled worker is `cron/process_turns.php`. It is intentionally CLI-only: direct HTTP requests return status 403. A scheduler invokes it every 30 minutes. The worker opens the PDO connection, reads player IDs, and calls `GameService::processTurns()` for each player.

`processTurns()` is transaction-based and locks the player and `player_resources` rows before calculating state. It reads `last_turn_at`, computes elapsed seconds, divides elapsed time by the configured `turn_interval_seconds`, and derives the number of completed turns. The result is bounded by the configured maximum storage and the remaining capacity between current turns and `turn_max_storage`.

```text
elapsedSeconds = now - lastTurnAt
completedTurns = floor(elapsedSeconds / turnInterval)
newTurns = min(completedTurns, maxTurnStorage - currentTurns)
```

When the player is below the configured generation threshold, the engine adds Unit Production output to `untrained_units`, calculates income from untrained units, miners, and lifers, applies the race multiplier, then applies the DefCon income multiplier. The database update changes turns, units, and Naquadah in one statement. The player timestamp advances by the number of completed intervals rather than simply jumping to the current time, preserving partial elapsed time for the next run.

```text
baseIncome = (untrainedUnits × 20) + ((miners + lifers) × 80)
income = baseIncome × raceIncomeModifier × defconIncomeModifier
untrainedUnits += unitProduction × completedTurns
attackTurns = min(maxTurnStorage, attackTurns + newTurns)
```

The service inserts an immutable `game_events` record containing the player, number of turns, income, and processing event. If any database operation fails, the transaction rolls back, so a player cannot receive income without also advancing the clock.

The worker is safe to schedule repeatedly because the timestamp-based calculation only grants completed intervals that have not already been consumed. On a multi-server deployment, add a distributed lock or use one scheduler instance so two workers do not process the same world simultaneously.

## Combat resolver

There are two layers. `src/Engine/CombatResolver.php` is a pure calculation engine suitable for deterministic unit tests. `includes/services/GameService.php::resolveCombat()` is the transactional application service that loads live database state, applies security rules, updates resources, and persists reports.

The service flow is:

```text
Validate action and 1–15 turns
→ Reject self-targeting and anti-farming violations
→ Start transaction
→ Lock attacker and defender
→ Reject vacation/protection targets
→ Read live personnel, race, weapon, technology, planet, and mothership state
→ Calculate attacker and defender power
→ Resolve outcome
→ Deduct turns and casualties
→ Transfer vulnerable Naquadah if attacker wins
→ Write battle, reports, attack log, and game event
→ Commit
```

The pure resolver calculates attacker power, defender power, ratio, winner, casualty-rate estimates, and loot. The current recreation uses the server-provided action and turn count as intent; it never accepts a client-supplied winner, loot amount, or casualty result.

```text
attackerPower = strikeAction × max(1, turns)
defenderPower = defenseAction
ratio = attackerPower / defenderPower
winner = attackerPower >= defenderPower
```

The current casualty model increases loss when the power ratio is unfavorable and caps rates to avoid unbounded damage. Successful attacks can transfer a percentage of unbanked Naquadah, while banked Naquadah is protected by design. All battle data is stored for reports and auditability.

## Real-time boundaries

The browser is not a real-time authority. It displays countdowns and estimates, but authoritative state is recomputed at request time and during scheduled processing. The database is the source of truth. PDO transactions, row locks, CSRF, authentication, RBAC, protection states, and anti-farming rules guard every state-changing action.

The implementation uses configurable settings so operators can change turn interval, turn caps, generation threshold, income, DefCon effects, daily action limits, and other balance values without changing the engine code.

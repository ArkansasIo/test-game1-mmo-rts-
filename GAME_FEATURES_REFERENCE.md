# StargateWars Game Features Reference

## Command Center

The dashboard presents live resources, current turn capacity, personnel, military strength, income estimates, DefCon status, and recent activity. `process_turns` grants all due 30-minute intervals and is safe to repeat because the player timestamp is advanced transactionally.

## Economy and account

The Resources page supports deposits and withdrawals between available and banked Naquadah. The Income page explains the current income model. The Military Stats page exposes attack, defense, covert, and DefCon values. Account Info shows the authenticated commander, rank, reputation, glory, and session security. Race lets a commander select a race from the database and applies race modifiers during game calculations.

## Personnel and technology

The Training page converts untrained population into miners, attack units, defense units, spies, or anti-spies. Unit Production increases the amount of population generated per turn. Technology pages calculate increasing costs from the database technology growth factor. Armory pages support weapon purchases and repairs. Mothership pages expose hull, volley bays, shields, hangars, weapons, and exploration upgrades.

## Combat and covert operations

Targets supports attack actions with turn limits, protection checks, combat scores, casualties, loot, battle reports, and daily anti-farming limits. Attack Log lists recent battle outcomes. Spy and Sabotage pages consume covert agents, compare covert strength, record detection, and create intelligence reports for successful recon missions. DefCon changes consume Naquadah and reduce estimated income at higher alert levels.

## Worlds and social systems

Planet pages support exploration and planetary defense upgrades. Alliance pages support creation and membership. Messages support authenticated private communication. Resource Exchange lists Naquadah market orders and supports purchases with transactional settlement. Mercenary Market recruits mercenaries from seeded types. Rankings refresh score snapshots and calculate positions. Vacation protects a realm for a bounded number of days. Ascension requires Glory and Reputation thresholds and records the ascension event.

## Security and integrity

All state-changing requests use authenticated sessions, CSRF tokens, POST-only action handlers, redirect allowlists, prepared statements, and transaction boundaries. Rank-based route checks restrict sensitive pages. `Rules.php` centralizes positive-integer validation, text validation, protection checks, and daily target limits. `game_events` records the important state changes for auditing.

## Operational files

The SQL files must be imported in order through `005_test_scenario.sql` if test data is desired. `cron/process_turns.php` is the scheduled turn worker. `tests/smoke_test.php` checks the most important service calls after a real PHP/MySQL environment is installed.

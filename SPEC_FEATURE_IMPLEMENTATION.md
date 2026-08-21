# Universe Civilization: Empire at Wars Specification Feature Implementation

This document translates the attached reverse-engineered design into front-end states and server-side behavior. The formulas are historical reconstruction values and should be treated as configurable balance defaults rather than unquestionable production truth.

## 1. Shared frontend shell

Every authenticated page uses the same shell: a persistent left sidebar, nested submenu groups, top HUD, current player identity, race, rank, Glory, Reputation, turn count, Naquadah, banked Naquadah, untrained units, and next-turn status. Each page provides loading-safe empty states, success/error notices, disabled buttons when the player lacks turns or resources, and confirmation text for destructive or irreversible actions.

All forms submit player intent only. For example, an attack form sends a target, action type, and turn count; it never sends a claimed battle result, loot value, or casualty count.

## 2. Feature-to-page design

| System | Frontend page and controls | Server-side function and persistence |
|---|---|---|
| Turn engine | Dashboard turn countdown, Process turns control, next-turn indicator | `GameService::processTurns()` calculates elapsed 30-minute intervals, caps turns, generates units/income, updates `players.last_turn_at`, and writes `game_events`. |
| Economy | Resources page with Deposit and Withdraw forms; Income page with formula breakdown and DefCon modifier | `deposit()`, `withdraw()`, `FormulaService::naturalIncome()`, `FormulaService::bankCapacity()`, `player_resources`, `game_settings`. |
| Unit Production | Unit Production page with current UP, next cost, Upgrade button | `upgradeUnitProduction()`, `FormulaService::unitProductionCost()`, Naquadah transaction, event record. |
| Personnel | Units, Miners, and Super Units pages with type selector and quantity input | `train()`, untrained-unit validation, atomic roster update, `player_resources`. |
| Weapons | Weapons inventory cards, quantity, power, durability, Buy and Repair buttons | `buyWeapon()`, `repairWeapons()`, `player_weapons`, `weapon_types`, weapon purchase/repair events. |
| Technology | Technology cards by branch, level, effect, next cost, Upgrade button | `buyTechnology()`, progressive cost calculation, `player_technologies`, `technologies`. |
| Combat | Targets table with name, race, rank, alliance, estimated scores, turn selector, Attack/Raid/Conquer/Message buttons | `resolveCombat()`, server-side FormulaService calculations, protection and anti-farming checks, `battles`, `battle_participants`, `battle_reports`, `attack_logs`. |
| Battle reports | Report detail with IDs, participants, turns, strength, technology, race, loot, casualties, weapon damage, planet/mothership contribution | Reads `battles`, `battle_participants`, `battle_reports`, and `game_events`; marks reports seen. |
| Espionage | Spy/Sabotage forms with target, mission, agent count, expected information, and detection warning | `covertMission()`, covert capacity validation, DefCon protection, detection calculation, `covert_missions`, `spy_missions`, `sabotage_missions`, `intelligence_reports`. |
| Mothership | Ship overview with hull, volley bays, shields, hangars, weapons, exploration, and module upgrade controls | `upgradeMothership()`, module allowlist, cost deduction, `motherships`, `mothership_modules`. |
| Planets | Planet list, create/explore/conquer actions, bonus cards, defense levels | `explore()`, `planet_defense()`, combat/conquest service, `player_planets`, `planet_bonuses`, `planet_defenses`, `planet_explorations`. |
| Commander/officers | Alliance and relationship panels, commander income distribution, recruitment controls | Commander/officer relationship service, `commander_relationships`, `officer_relationships`, `recruitment_records`. |
| Alliances | Alliance list, create, join, leave, invite, kick, role badge | `WorldService` alliance methods, membership limits, rank/role checks, `alliances`, `alliance_members`. |
| Market | Resource order table, private trade form, mercenary cards, buy/sell controls | Market listing, quote, settlement, escrow, and mercenary service; `market_orders`, `private_trades`, `mercenary_types`, `player_mercenaries`. |
| Rankings | Overall, attack, defense, covert, economy, and mothership ranking panels | Ranking refresh service, `rankings`, `rank_snapshots`, `glory_reputation`. |
| Protection | DefCon selector, vacation activation, protected-planet status | `setDefcon()`, `vacation()`, protection checks, `players`, `protection_states`, `vacation_states`. |
| Ascension | Requirements checklist, conversion preview, Ascend button, permanent-state warning | `ascensionEligibility()`, conversion/persistence transaction, `ascensions`, `ascension_states`, lifer preservation. |

## 3. Server-side formula contract

`includes/services/FormulaService.php` centralizes the reconstructed formulas:

```text
NaturalIncome = (UntrainedUnits × 20)
              + ((Miners + Lifers) × 80)
              + PlanetIncome
              × RaceIncomeModifier
              × DefConIncomeModifier
              × CommanderModifier

BankCapacity = NaturalIncome × 48 × 1.5
UPCost = CurrentUP × 5000 + 10000
Strike = ((NormalWeaponStrength × 5)
          + (SuperWeaponStrength × 10)
          + PlanetBonus + MothershipPower)
          × OffenseTechnology × RaceModifier
Defense = ((NormalWeaponStrength × 5)
          + (SuperWeaponStrength × 10)
          + PlanetBonus + MothershipPower)
          × DefenseTechnology × RaceModifier
Covert = ((sqrt(2^SpyLevel) × SpyCount × CovertTechnology × RaceModifier)
          + SpyCount + PlanetBonus) × 10
AntiCovert = ((sqrt(2^(AntiSpyLevel + 2)) × AntiSpyCount
              × AntiCovertTechnology × RaceModifier)
              + AntiSpyCount + PlanetBonus) × 10
OverallRank = (AttackRank + DefenseRank + CovertRank + MothershipRank) / 4
```

The service clamps negative quantities to zero, clamps DefCon to levels 0–4, and keeps all calculations server-side.

## 4. Combat server flow

The Combat module must execute the following sequence inside one transaction:

```text
Validate authenticated attacker
→ Validate target and action type
→ Validate turns 1–15
→ Reject self-targeting and anti-farming violations
→ Lock attacker, defender, wallets, protection, and relevant equipment
→ Reject vacation/PPT/protection targets
→ Build attacker and defender snapshots
→ Calculate weapon, technology, race, planet, mothership, and covert contributions
→ Resolve winner with a deterministic battle seed
→ Calculate casualties, loot, durability loss, and planet damage
→ Deduct attacker turns and update both rosters
→ Insert battle, participants, report, attack log, and immutable event
→ Commit and redirect to the report/log page
```

## 5. Espionage server flow

```text
Validate mission type and agent count
→ Validate covert capacity and target
→ Lock both player states
→ Apply DefCon protection and anti-covert formula
→ Calculate success, detection, and agent losses
→ Consume agents and apply sabotage damage when relevant
→ Store mission result and intelligence payload
→ Write immutable event
→ Commit and redirect to intelligence or spy log
```

Recon may expose resources, units, technology levels, planets, or defenses according to the result quality. Spy and sabotage should never expose data merely because the client requested it.

## 6. Security contract

The client cannot be trusted for Naquadah, turns, units, weapon strength, technology, combat results, planet ownership, market outcomes, Ascension, rank, Glory, or Reputation. PHP actions must enforce authentication, CSRF, RBAC, positive integer validation, ownership checks, protection checks, rate limits, same-IP restrictions, attack cooldowns, alliance limits, market limits, and transactional rollback.

Important events should be written to `game_events` with a JSON snapshot. Recommended event names include `TURN_PROCESSED`, `INCOME_GENERATED`, `TRAINING_COMPLETED`, `WEAPON_PURCHASED`, `WEAPON_DAMAGED`, `WEAPON_REPAIRED`, `ATTACK_STARTED`, `ATTACK_RESOLVED`, `SPY_STARTED`, `SPY_RESOLVED`, `SABOTAGE_RESOLVED`, `PLANET_CONQUERED`, `MARKET_TRADE_COMPLETED`, `ALLIANCE_JOINED`, and `ASCENSION_COMPLETED`.

## 7. Configuration

`config/settings.php` reads defaults and overrides from `game_settings`. Operators can change turn interval, turn caps, income constants, bank rules, DefCon, messages/day, alliance capacity, planet capacity, raid range, and daily target limits without modifying the PHP service source.

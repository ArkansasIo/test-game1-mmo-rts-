# Validation Matrix

| Feature | Source / route | Primary validation | Expected invariant |
|---|---|---|---|
| Authentication | `actions/login.php`, `actions/register.php` | Auth and session tests | Protected pages require an authenticated commander. |
| Dashboard | `game.php?page=dashboard` | Page smoke and UI checks | State loads and resource header renders safely. |
| Nine resources | `player_resources`, resource pages | Deuterium and economy tests | All nine resources serialize, format, and validate. |
| Vault | `resources`, `EconomyService` | Vault contract test | Deposit/withdraw is atomic and balance-safe. |
| Turn settlement | `process_turns`, cron | E2E and load tests | Settlement is idempotent, bounded, and transaction-safe. |
| Progression | progression pages/services | Progression tests | Tier and level changes respect requirements and caps. |
| Technology | Technology routes/services | Page integration and research tests | Branch routes render and upgrades enforce prerequisites and queue limits. |
| Training | `units`, `UnitTrainingService` | Training contract test | Population, queue, and resource rules hold. |
| Production | `unit-production`, `UnitProductionService` | Production test | Upgrade cost and automation modifier are authoritative. |
| Combat | `targets`, `GameMechanicsService` | Combat and UI E2E tests | Protected or invalid targets cannot resolve. |
| Espionage | `spy`, `sabotage`, reports | Spy/sabotage tests | Detection, damage, and report visibility are scoped. |
| Markets | resource/weapon/mercenary routes | Market contract tests | Orders settle once with valid ownership, funds, fees, and expiry. |
| Colonies | planet routes/services | Planet and universe tests | Habitability, occupancy, capacity, and ownership are enforced. |
| Mothership | ship/modules/exploration | Mothership tests | Upgrade and exploration validate readiness and cost. |
| Universe | galaxy/sector/system/planet/moon routes | Universe contract tests | Coordinate hierarchy and visibility remain authoritative. |
| Social | alliances/messages/rankings | Social tests | Membership, recipients, blacklist, and public scope are enforced. |
| MMO expansion | quests/achievements/officers/seasons/NPC | Expansion service tests | Event-driven progress is idempotent and auditable. |
| Security | all mutation actions | CSRF/RBAC/ownership suite | Unauthorized or forged mutations fail without state changes. |
| Documentation | documentation folder | Link/catalog/diagram checks | Every route and source reference remains navigable. |

## Cover
Universe Civilization: Empire at Wars
Modular PHP/MySQL architecture, gameplay systems, and frontend navigation

## Slide 1
### The product is a persistent strategy loop
- 30-minute scheduled turns generate Naquadah, units, income, protection updates, rankings, and world events.
- Players build economy, train personnel, acquire weapons and technology, and choose attack, defense, covert, social, or balanced specialization.
- The left navigation turns that loop into discoverable page workflows.

## Slide 2
### The codebase is organized around clear boundaries
- Frontend: authenticated shell, nested sidebar, page registry, page entrypoints, master CSS, and module CSS.
- Backend: PHP action controller, authentication/RBAC, transactional services, formula engines, repositories, cron worker, and audit events.
- Database: canonical MySQL schema, seed data, migrations, fixtures, reports, and progression state.

## Slide 3
### The database models the whole game state
- 54 canonical tables cover identity, resources, personnel, technology, weapons, motherships, planets, politics, combat, covert operations, market, progression, and audit.
- Foreign keys connect players to resources, units, planets, alliances, battles, reports, rankings, and protection states.
- JSON event payloads preserve battle and turn context for review and dispute handling.

## Slide 4
### Every page maps controls to server intent
- Dashboard pages expose controls such as Process Turns, Deposit, Train, Attack, Spy, Upgrade, Explore, Join Alliance, Buy, and Ascend.
- Browsers submit intent only: target, action, quantity, level, or message; the server calculates outcomes.
- Page registry metadata records layout type, controls, actions, tables, and permission scope.

## Slide 5
### The turn engine is timestamp-driven and transactional
- The worker runs from CLI every 30 minutes and derives completed intervals from `last_turn_at`.
- Turns are capped, Unit Production creates untrained units, income applies race and DefCon modifiers, and partial elapsed time is preserved.
- Row locks and transactions prevent duplicate grants or partial updates; `game_events` records the processed result.

## Slide 6
### Combat combines power, risk, and auditability
- Combat validates 1–15 turns, anti-farming rules, protection state, and target eligibility before locking both realms.
- Strike and defense use personnel, weapons, technology, race, planet, and mothership contributions.
- Battles persist winner, power, loot, casualties, reports, attack logs, and immutable event context.

## Slide 7
### Covert play is a parallel information economy
- Recon, spy, and sabotage compare covert and anti-covert strength with technology, levels, race modifiers, and DefCon protection.
- Success can reveal intelligence or damage a target system; failed operations may be detected.
- Mission records and intelligence reports provide a reviewable server-side trail.

## Slide 8
### The modular frontend is designed for expansion
- Parent menus group Command Center, Attack, Armory, Training, Technology, Intelligence, Market, Social, Planets, Mothership, and Account.
- Module CSS keeps combat, economy, social, planet, intelligence, and armory pages consistent while allowing specialized states.
- The next production step is runtime validation on PHP 8.1+ and MySQL, followed by full integration tests and deployment hardening.

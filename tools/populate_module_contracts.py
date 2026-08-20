from pathlib import Path
root = Path('/home/ubuntu/stargatewars')
contracts = {
 '02_Gameplay/Ascension':'Ascension gameplay rules, eligibility checks, Glory/Reputation spending, and ascension outcomes.',
 '02_Gameplay/Market':'Market order validation, escrow, settlement, expiration, and player-to-player trading.',
 '02_Gameplay/Mothership':'Mothership hull, shields, hangars, modules, exploration range, and upgrade rules.',
 '02_Gameplay/Planets':'Planet ownership, bonuses, defenses, exploration, colonization, and colony transitions.',
 '03_Player/Authentication':'Registration, login, logout, session rotation, password handling, and account security.',
 '03_Player/Rankings':'Ranking refresh, snapshots, score formulas, tie handling, and leaderboard queries.',
 '03_Player/Resources':'Resource balances, capacity, income, consumption, Dark Matter, and transactional transfers.',
 '03_Player/Technology':'Technology tree, prerequisites, level costs, research modifiers, and queue settlement.',
 '03_Player/Units':'Training, unit production, special units, capacity, and combat-power calculations.',
 '03_Player/Weapons':'Weapon inventory, durability, repair, market purchase, and combat modifiers.',
 '04_Social/Alliances':'Alliance lifecycle, roles, membership, diplomacy, permissions, and alliance events.',
 '04_Social/Commanders':'Commander profiles, ranks, reputation, notifications, and player identity.',
 '04_Social/Messages':'Inbox, compose, read state, blacklist, moderation, and message audit history.',
 '04_Social/Officers':'Officer assignment, benefits, cooldowns, and role-based command permissions.',
 '04_Social/Recruitment':'Recruitment contracts, mercenaries, availability, price, and roster persistence.',
 '05_Intelligence/Reports':'Battle, spy, sabotage, and world-event reports with ownership and read state.',
 '05_Intelligence/Sabotage':'Sabotage targets, detection probability, resource costs, and outcome persistence.',
 '05_Intelligence/Spying':'Reconnaissance and espionage missions, agent assignment, detection, and intelligence reports.',
 '06_API/Armory':'JSON adapters for weapons, market, durability, repair, and purchase workflows.',
 '06_API/Ascension':'JSON adapters for progression eligibility and ascension operations.',
 '06_API/Auth':'JSON authentication and session endpoints with CSRF and rate limits.',
 '06_API/Intelligence':'JSON adapters for reconnaissance, spy, sabotage, and reports.',
 '06_API/Market':'JSON adapters for listing, buying, cancelling, and settling market orders.',
 '06_API/Mothership':'JSON adapters for mothership state and module upgrades.',
 '06_API/Planets':'JSON adapters for colonies, planets, moons, universe maps, and exploration.',
 '06_API/Social':'JSON adapters for alliances, messages, diplomacy, and recruitment.',
 '06_API/Training':'JSON adapters for training and production actions.',
 '07_Database/Indexes':'Deployment-safe index definitions for targets, queues, missions, rankings, and universe coordinates.',
 '07_Database/Views':'Read models for dashboard summaries, rankings, colony state, fleet status, and reports.',
 '10_Docs':'Architecture, gameplay rules, security model, formulas, migrations, testing, and operations.',
}
for relative, purpose in contracts.items():
    directory = root / relative
    directory.mkdir(parents=True, exist_ok=True)
    target = directory / 'README.md'
    if not target.exists():
        title = relative.split('/')[-1].replace('_', ' ')
        target.write_text(f'# {title}\n\n{purpose}\n\nThis module follows the shared StargateWars contract: validate input at the boundary, authorize the player action, delegate state changes to a service, use a transaction for multi-row updates, and write an audit event for meaningful outcomes.\n', encoding='utf-8')

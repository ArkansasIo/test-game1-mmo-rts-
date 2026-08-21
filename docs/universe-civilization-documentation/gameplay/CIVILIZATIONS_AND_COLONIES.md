# Civilizations and Colonies

## Races and governments

Races provide production, growth, combat, covert, and population modifiers. Governments provide command, alliance, diplomacy, stability, and administrative modifiers. The combined profile is applied by authoritative formulas and exposed to the commander as an explainable modifier summary.

## Colony lifecycle

A colony begins when a validated commander colonizes an eligible universe planet. The server checks habitability, occupancy, colony capacity, parent ownership, resources, cooldowns, and protection. The colony then receives population, life-support state, buildings, production, morale, and defensive records.

## Biomes

Biomes alter production, resource availability, life support, construction, exploration, and hazard risk. A biome modifier is combined with building bonuses and morale adjustment to produce the colony bonus. A planet bonus page is read-only and must not change balances.

## Population and workforce

Population is simultaneously a growth value, workforce, training input, and colonization constraint. Assignments distinguish miners, lifers, soldiers, researchers, builders, and reserve population. Assignments must not exceed population or capacity and should preserve required life-support workforce.

Miners increase resource production through role efficiency and morale. Lifers maintain support capacity and reduce risk from food or water deficits. The workforce service returns assigned population, unassigned population, miner output, lifer output, support load, and colony ownership classification.

## Life support

Food, Water, and Energy are operational resources. The colony dashboard should show current reserves, consumption rates, morale, and warning states. Negative production or shortage must create a safe warning and must not produce impossible negative balances unless the design explicitly allows debt.

## Buildings and queues

Buildings affect production, storage, life support, defense, shipyards, research, and population capacity. Construction queues validate prerequisites, resources, colony ownership, queue capacity, cooldown, and level caps. Queue completion should be idempotent and event-audited.

## Planet defenses

Defense rating combines structures, condition, technology, planet bonus, shield integrity, and garrison. Defense upgrades enter a queue and may consume Metal, Crystal, Deuterium, Naquadah, Energy, or other configured resources. A defense page must show current integrity, garrison, upgrade queue, cost preview, and feedback states.

## Colony UI

Planet List displays owned colonies, life support, production, morale, fleet presence, exploration, colonization opportunities, and defense controls. Planet Bonuses explains modifiers. Planet Defenses manages defensive structures. Universe Planet pages remain scoped to generated worlds and colonization eligibility rather than exposing private colony state.

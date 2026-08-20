# Presentation Script: OGame-Style Life Support and Colony Mechanics

## Opening

“Today I’ll walk through the new colony-management layer added to StargateWars. The design borrows familiar browser-strategy patterns while preserving the project’s server-authoritative PHP/MySQL architecture. The main addition is that each colony is now a living operating system: it produces resources, consumes food and water, grows population, builds infrastructure, and dispatches fleets.”

## Slide 1 — Colony state is more than a resource number

“A colony now has an identity, coordinate, planet type, population, capacity, food stock, water stock, morale, and a homeworld flag. This separates world state from the original player wallet. A commander can have several colonies, each with its own life-support pressure and development strategy.”

## Slide 2 — Production and consumption are calculated on the server

“For every elapsed interval, the service converts seconds to hours. Resource balances then apply production minus consumption, clamp the result between zero and capacity, and persist the new amount. The browser can display a forecast, but it cannot set food, water, Metal, Crystal, Energy, or Naquadah directly.”

“The life-support formula is deliberately easy to balance. Food consumption is population multiplied by 0.25 per hour, and water consumption is population multiplied by 0.20 per hour. The service rounds each cost upward so a fractional hour cannot create free consumption.”

## Slide 3 — Shortage changes population growth

“After consumption, the service checks whether food or water reached zero. If either resource is depleted, the colony enters shortage and population growth stops. When both resources remain available, growth is population multiplied by 1% per hour and multiplied by morale. Growth is then capped at population capacity.”

“This makes life support a strategic constraint rather than a cosmetic meter. A larger population increases consumption, but stable farming, water processing, residential capacity, and morale create the conditions for expansion.”

## Slide 4 — Buildings create an asynchronous economy

“Buildings are data-driven. Each building type defines a category, base costs, growth factor, and build duration. A queue request stores the colony, building key, level before construction, start time, and completion time. The server calculates the cost using base cost multiplied by the growth factor raised to the previous level.”

“This supports resource buildings, food farms, water processors, residential hubs, shipyards, research labs, and defense grids without hard-coding every building into the frontend.”

## Slide 5 — Fleets turn colonies into a network

“Fleet types define attack power, defense power, cargo capacity, speed, fuel use, and build costs. A dispatch action stores the source colony, target colony, mission type, JSON payload, departure time, arrival time, and current status. The same structure supports transport, attack, raid, colonize, explore, recycle, and espionage missions.”

“The browser submits mission intent. PHP checks ownership, mission type, target validity, travel duration, and permissions before creating the mission. Arrival and return processing can then be handled by the scheduled worker.”

## Slide 6 — Snapshots and events make the system observable

“Every colony turn creates a snapshot containing elapsed time, food before and after, water before and after, population before and after, and a JSON payload. The service also writes an immutable game event. These records make balancing, debugging, player support, and dispute review possible.”

## Closing

“The colony layer extends StargateWars from a single-player-state game into a multi-location strategy system. Life support creates pressure, buildings create choices, research and shipyards create long-term progression, and fleets connect those decisions to the wider world. The next production step is to run the migration on MySQL, connect the dashboard forms to authenticated PHP actions, and schedule queue and mission settlement in the turn worker.”

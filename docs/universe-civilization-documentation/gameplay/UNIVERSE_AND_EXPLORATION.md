# Universe and Exploration

## Hierarchy

The universe is organized as **9 universes → 30 galaxies → 499 sectors → solar systems → planets and moons**. The active page registry exposes Galaxy Map, Sector Map, Solar Systems, Universe Planets, Moon Registry, and Coordinate Search.

## Deterministic generation

A validated coordinate tuple is converted into a stable seed. The seed derives base names, classes, biomes, resource modifiers, danger, anomaly rates, planet profiles, moon profiles, travel lanes, and strategic values. The same seed should generate the same base world across requests and servers.

Persistent database state overlays the generated base with discoveries, ownership, colonies, fleets, reports, anomalies resolved, gates, and player actions. This separation allows a large universe without requiring every generated object to be fully materialized before discovery.

## Visibility

Visibility depends on coordinate validity, scan power, mothership science, scan technology, discovery state, target classification, and commander permission. A page must never disclose unauthorized commander details simply because a coordinate is valid. Public presence signals may expose strategic classification without private identity.

## Exploration

Exploration validates mothership or fleet readiness, target occupancy or eligibility, travel time, risk, cooldown, resources, and commander authority. Results may include discovery records, resources, anomalies, debris, quests, achievements, event rewards, or threats. The mission lifecycle should support dispatch, travel, resolution, recall where permitted, completion, and expiry.

## Planets and moons

Planet records contain orbit, class, type, biome, habitability, bonuses, slots, occupancy, and generated resources. Moon records contain orbital class, sensor bonus, jump-gate state, parent planet, and construction options. Colonization and gate construction are separate server actions with parent ownership and resource checks.

## Maps and navigation

Galaxy and sector pages summarize strategic information. Solar system pages expose orbit maps, gates, fleet lanes, and telemetry. Coordinate Search parses and validates each hierarchy component, filters discovery and ownership visibility, and returns safe navigation identifiers.

## Anomalies and risk

Anomaly rate, danger level, biome rarity, and system class affect exploration rewards and threats. Risk should be legible before dispatch but should not make outcomes fully predictable. A deterministic seed or stored mission seed allows support staff to reproduce a dispute without allowing the browser to forge the result.

## Scale and performance

Universe queries should be indexed by hierarchy identifiers, coordinate tuple, discovery state, and ownership scope. Generated base profiles should be cached only when the cache cannot bypass access rules. Expensive map summaries should limit result counts, use pagination or scoped sectors, and avoid loading an entire universe for one page.

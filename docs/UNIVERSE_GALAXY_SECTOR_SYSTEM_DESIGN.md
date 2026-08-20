# StargateWars Universe, Galaxy, Sector, System, Planet, and Moon Design

## Hierarchy

The universe follows an OGame-style coordinate hierarchy:

> **Galaxy → Sector → Solar System → Orbital Planet → Planet Moon**

A planet coordinate is represented as `galaxy:sector:system:orbit`, such as `1:1:3:3` for Asteria Prime. Moon records belong directly to their parent planet and use a moon orbit position so a planet can support multiple moons.

| Level | Table | Purpose |
|---|---|---|
| Galaxy | `universe_galaxies` | Large navigable region with star density, sector count, and activity state |
| Sector | `universe_sectors` | Strategic subdivision with danger, resource, and anomaly modifiers |
| Solar system | `universe_solar_systems` | Star system with spectral class, system class, travel modifier, and orbit capacity |
| Planet | `universe_planets` | Orbital world with biome, type, class, habitability, slots, and resource modifiers |
| Moon | `universe_moons` | Planet satellite with moon class, facilities, sensor range, and jump-gate progression |
| Colony | `player_colonies` | Player-owned settlement linked to a universe planet and optionally a moon |

## Planet classifications

Planets have independent **class**, **type**, and **biome** fields. This allows a desert resource world, a temperate colony world, and an ancient ruin world to behave differently without encoding all behavior in one label.

The current class vocabulary includes terrestrial, gas giant, ice giant, ocean, desert, volcanic, toxic, crystal, metallic, barren, jungle, and ancient. Planet types include habitable, colony world, resource world, fortress world, ruin world, storm world, dead world, and proto-world. Biomes include temperate, forest, jungle, oceanic, arid, desert, tundra, ice, volcanic, toxic, crystal, metallic, gas, barren, and ancient.

## Moon classifications

Moons use the same composable approach. Their class identifies the physical or technological identity, while their type identifies strategic purpose. Moon classes include rocky, ice, metallic, volcanic, crystal, artificial, and ancient. Moon types include standard, resource, shipyard, sensor, fortress, ruin, and titan.

## Gameplay modifiers

Each planet stores habitability, slots, temperature, gravity, and independent metal, crystal, food, water, energy, and anomaly modifiers. Each moon stores its own metal, crystal, energy, sensor-range, and jump-gate properties. These values are read server-side during colony settlement, exploration, fleet travel, and construction calculations.

## Security and ownership

Universe inspection is read-only and can be exposed through authenticated pages. Colonization is a state-changing operation and must pass CSRF validation, player authentication, planet availability checks, occupancy checks, ownership checks, row locking, and a transaction that creates `player_colonies`, marks the planet occupied, and writes a `game_events` audit record.

## Migration

Apply `sql/009_universe_galaxy_systems.sql` after the existing MMORPG/RTS migration:

```bash
mysql -u root -p stargatewars < sql/009_universe_galaxy_systems.sql
```

The seed creates two galaxies, multiple strategic sectors, six star systems, six seeded planets, and four moons. The migration uses idempotent upserts for repeatable development imports.

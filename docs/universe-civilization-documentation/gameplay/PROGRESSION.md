# Progression, Glory, Reputation, and Ascension

## Progression scale

The game uses **21 tiers** with **23 levels per tier**, producing a 483-level global progression path. A player’s progression state includes current tier, tier name, level, global level, next-level requirements, progress percentage, effects, and state flags.

Progression affects combat, production, technology coefficients, command authority, alliance capacity, colony management, and access to higher-risk universe content. The exact effect must be calculated by the progression service rather than trusted from browser values.

## Level transition

A level transition validates the current progression row, cost, prerequisites, cooldown, maximum level, and any active protection or queue restrictions. It records the before and after values and writes an event. A failed transition must leave the progression and resource state unchanged.

## Glory and reputation

Glory is a strategic prestige balance used by rankings, ascension, seasonal rewards, and exceptional achievements. Reputation affects diplomacy, commander visibility, alliance interaction, and potentially NPC relations. Glory and reputation must be stored separately from normal stockpile resources and protected by ownership and transaction rules.

## Ascension

Ascension is available when the commander satisfies tier mastery, glory, reputation, progression, and technology requirements. The action locks progression, verifies requirements, creates an ascension history record, grants the configured reward, and commits the new state atomically. Ascension should be irreversible unless an explicit design rule defines a reset or season transition.

## Balance principles

The progression curve should reward consistent planning without making early decisions permanently fatal. Tier effects should be meaningful but bounded. A high-tier player should gain strategic options and efficiency rather than an unbounded ability to erase lower-tier competition. Protection, matchmaking, target classification, and seasonal normalization should preserve a viable competitive environment.

## UI requirements

Progression pages should show current tier and level, next level, effect preview, cost, prerequisites, glory, reputation, eligibility, permanent bonuses, and feedback state. The command center should summarize progression without duplicating authoritative calculations.

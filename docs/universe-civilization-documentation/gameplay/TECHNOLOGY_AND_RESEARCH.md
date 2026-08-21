# Technology and Research

## Branches

Technology is presented as a unified tree with dedicated branch pages for offense, defense, covert, and anti-covert research. The tree may also contain unique, mercenary, automation, mothership, and other catalog categories.

| Branch | Primary effect |
|---|---|
| Offense | Weapon damage, fleet attack, orbital strike, and offensive readiness. |
| Defense | Shields, fortification, planetary defense, and damage mitigation. |
| Covert | Agent effectiveness, infiltration, reconnaissance, and sabotage. |
| Anti-Covert | Counter-intelligence, detection, transmission interception, and covert resistance. |
| Unique / strategic | Special systems such as automation, mothership, gates, or late-game effects. |

## Research cost and effect

The standard cost formula is `base cost × growth ^ current level`. Effect previews use the base effect, current or next level, and category coefficient. Research completion applies the configured effect to the relevant service calculation; the browser displays a preview but does not apply it.

## Prerequisites

Each prerequisite links a technology key to a required minimum level. The tree service resolves a commander’s current levels and returns `met`, `required`, `level`, and lock reason fields. An upgrade cannot proceed if any prerequisite is missing or if the technology category is invalid.

## Queue

Research queues have a capacity and status. Active records include technology key, before level, after level, base effect, category coefficient, start time, completion time, and status. Queue creation, resource deduction, player technology update, and event insertion should be transactional. Completion processing must be idempotent and must not apply an effect twice.

## Resources and Deuterium

Naquadah is currently used as the primary liquid research currency in the core implementation. The design catalog should declare Metal, Crystal, Deuterium, Energy, or Dark Matter requirements where research is intended to consume those resources. Deuterium is especially appropriate for high-energy, propulsion, gate, mothership, and advanced strategic research.

## UI contract

Each Technology page shows branch identity, technology count, queue usage, current branch effect, research tracks, prerequisites, current and next levels, cost, effect preview, upgrade control, queue contents, server tables, and feedback states. The shared renderer prevents missing-function route failures while preserving branch-specific state telemetry.

## Security contract

Research actions require authenticated commander identity, CSRF, researcher eligibility, technology existence, prerequisite validation, queue availability, resource balance, level cap, transaction, and event recording. The action dispatcher chooses the authoritative service based on the technology category rather than trusting a client-provided branch name.

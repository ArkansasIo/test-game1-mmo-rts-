# Weapons

Weapon inventory, durability, repair, market purchase, and combat modifiers.

This module follows the shared Universe Civilization: Empire at Wars contract: validate input at the boundary, authorize the player action, delegate state changes to a service, use a transaction for multi-row updates, and write an audit event for meaningful outcomes.

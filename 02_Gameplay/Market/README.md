# Market

Market order validation, escrow, settlement, expiration, and player-to-player trading.

This module follows the shared Universe Civilization: Empire at Wars contract: validate input at the boundary, authorize the player action, delegate state changes to a service, use a transaction for multi-row updates, and write an audit event for meaningful outcomes.

# Auth

JSON authentication and session endpoints with CSRF and rate limits.

This module follows the shared Universe Civilization: Empire at Wars contract: validate input at the boundary, authorize the player action, delegate state changes to a service, use a transaction for multi-row updates, and write an audit event for meaningful outcomes.

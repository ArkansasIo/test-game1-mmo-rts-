# Data and State Flow

## Read flow

A commander requests `game.php` with an optional page route. The shell loads registry and contract configuration, verifies authentication, queries authenticated snapshots through domain services, serializes safe state, and renders the selected page. Empty rows become explicit empty states rather than exceptions.

## Mutation flow

A page form submits an action and identifiers. The action handler authenticates and verifies CSRF, determines the current commander, validates basic fields, delegates to the appropriate service, and redirects with safe feedback. The service locks rows, rechecks state, calculates the result, writes domain changes and events, commits, and returns a result. The next page load reads the new state from the database.

## Queue flow

A queued operation stores player, entity, level or quantity, start time, completion time, status, cost, and effect metadata. A scheduled processor selects due records, locks them, verifies status, applies the result once, changes status, writes an event, and commits. A repeated processor sees the completed status and does not grant duplicate output.

## Event flow

Important transitions produce a `game_events` record. Events provide player history, page alerts, audit evidence, support reproducibility, ranking triggers, quest or achievement progress, and operational diagnosis. Event payloads should include stable entity keys and safe facts rather than secrets.

## Error flow

An expected validation failure returns a safe feedback state such as locked, protected, insufficient-resource, cooldown, or invalid-input. An unexpected exception rolls back the transaction, logs diagnostic detail, and returns a generic error message. No partial state should be visible as a successful result.

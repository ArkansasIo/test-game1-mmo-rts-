# UML and Architecture Diagrams

The diagram sources in this folder are editable Mermaid files. They document the current architecture and intentionally distinguish deterministic generated content from persistent player state.

| Diagram | Source | Purpose |
|---|---|---|
| System component architecture | [`system_component_architecture.mmd`](system_component_architecture.mmd) | Shows the browser, dashboard shell, action handler, service layer, core rules, database, cron processor, and events. |
| Database relationships | [`database_relationships.mmd`](database_relationships.mmd) | Shows the principal relationships among players, resources, technologies, queues, colonies, universe records, alliances, and events. |
| Server action sequence | [`server_action_sequence.mmd`](server_action_sequence.mmd) | Shows authentication, CSRF, validation, row locking, calculation, event writing, and transaction commit. |
| Procedural universe generation | [`procedural_universe_generation.mmd`](procedural_universe_generation.mmd) | Shows deterministic seed generation, hierarchy creation, discovery filtering, and persistent overlays. |

Rendered PNG previews, when generated, are stored under `rendered/` with the same base filename. Mermaid source files are authoritative for diagram edits; rendered previews are derived artifacts.

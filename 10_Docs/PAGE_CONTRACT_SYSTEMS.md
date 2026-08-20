# StargateWars Per-Page Contract Systems

The StargateWars sidebar is now represented by independent PHP route files and independent page contract files. The canonical source remains `config/page_registry.php`; `tools/generate_page_tree.php` produces the grouped route tree and all associated metadata.

## Per-page files

For each registered route, the generator creates one file in each contract family:

```text
config/
├── page_definitions/<menu>/<route>.php
├── page_logic/<menu>/<route>.php
├── page_features/<menu>/<route>.php
├── page_design_specs/<menu>/<route>.php
└── page_systems/<menu>/<route>.php
```

The grouped PHP entrypoint is located at `pages/<menu>/subpages/<route>.php`. It loads the route definition and delegates to the root front controller. The route definition records the separate contract file paths as well as the combined metadata snapshot.

## Contract responsibilities

| Contract family | Responsibility |
|---|---|
| `page_logic` | Page purpose, workflow, validation rules, calculations, and state mutations. |
| `page_features` | User-visible capabilities and controls that belong to the page’s function. |
| `page_design_specs` | Template family, sections, components, responsive behavior, and white/black visual structure. |
| `page_systems` | Services, database reads, database writes, and authorized server actions. |
| `page_definitions` | Combined route contract used by entrypoints, manifests, and future renderers. |

## Functional examples

The Resources & Vault page uses an economy contract covering the eight-resource ledger, Naquadah deposits and withdrawals, positive-value validation, resource-row locking, and transactional writes to `player_resources`. The Target Selection page uses a targets contract covering protection checks, deterministic combat preview, attack-turn validation, operation costs, and combat report writes. The Spy Operations and Sabotage Operations pages use the covert contract covering agent allocation, detection calculation, intelligence generation, bounded sabotage damage, cooldowns, and report persistence.

Technology pages use the technology-tree contract, Training pages use the population-to-unit conversion contract, Planet pages use the colony and life-support contract, Mothership pages use the hull/module contract, and Universe pages use the hierarchy and coordinate-resolution contracts. Account and Progression pages define faction, government, vacation, Glory, Reputation, 21-tier, and 23-level behavior.

## Security boundary

The dedicated page files do not bypass the server-authoritative architecture. They are route entrypoints and metadata boundaries. All state changes remain in `actions/game.php`, where authentication, CSRF validation, RBAC, ownership, cooldown, resource validation, and transactions are enforced before service execution.

## Generation and validation

Regenerate the complete tree with:

```bash
cd /home/ubuntu/stargatewars
php tools/generate_page_tree.php
php tools/validate_contracts.php
```

The current generated coverage is **12 menu groups**, **43 registered page routes**, **43 page definitions**, **43 logic files**, **43 feature files**, **43 design specification files**, and **43 systems files**. `config/page_contracts.php` provides a global route index for server-side tooling and future renderers.

The verified public game interface remains `game.php`. The dedicated contract files are available to the PHP application without changing the working left-side navigation or the legacy `modular-pages-preview.php` compatibility redirect.

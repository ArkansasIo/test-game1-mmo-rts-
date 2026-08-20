# StargateWars PHP Page Tree

The left-side navigation is backed by `config/page_registry.php`. The generated page tree mirrors every registered menu group and submenu route while preserving the existing front-controller architecture.

## Generated structure

Each menu group has a parent folder with an `index.php`, a `page-manifest.php`, and a `subpages/` directory containing the group’s individual PHP entrypoints:

```text
pages/
├── _entry.php
├── _nested_entry.php
├── PAGE_TREE_MANIFEST.php
├── command-center/
│   ├── index.php
│   ├── page-manifest.php
│   └── subpages/
│       ├── dashboard.php
│       ├── account-info.php
│       ├── resources.php
│       ├── income.php
│       └── military-stats.php
├── attack/subpages/
├── armory/subpages/
├── training/subpages/
├── technology/subpages/
├── intelligence/subpages/
├── market/subpages/
├── social/subpages/
├── planets/subpages/
├── mothership/subpages/
├── account/subpages/
└── universe/subpages/
```

The generator also maintains top-level compatibility wrappers under `pages/<route>.php`, so existing dashboard links continue to work without changing the central `index.php?page=<route>` routing convention.

## Security and routing behavior

Every generated entrypoint is intentionally thin. It defines its canonical route and menu group, loads `pages/_nested_entry.php`, and redirects to `/index.php?page=<route>`. Authentication, CSRF validation, RBAC, ownership checks, transactions, and page rendering remain centralized in the existing application controller.

The generated files do not bypass server authority and do not perform direct database writes. State-changing controls continue to use `actions/game.php` and the existing service layer.

## Generation source

The repeatable generator is `tools/generate_page_tree.php`. Run it from the project root with:

```bash
php tools/generate_page_tree.php
```

The generator reads the canonical registry and currently produces **12 grouped folders**, **43 nested submenu PHP files**, **43 legacy route wrappers**, and per-group and global manifests.

## Verified routes

The following representative routes were tested against the local PHP server and returned HTTP 302 redirects to the correct front-controller route:

| Entry point | Redirect |
|---|---|
| `pages/command-center/index.php` | `/index.php?page=dashboard` |
| `pages/command-center/subpages/resources.php` | `/index.php?page=resources` |
| `pages/technology/subpages/tech-offense.php` | `/index.php?page=tech-offense` |
| `pages/universe/subpages/coordinates.php` | `/index.php?page=coordinates` |

The generated tree is compatible with the white-background, black-text dashboard theme and the existing modular preview navigation.

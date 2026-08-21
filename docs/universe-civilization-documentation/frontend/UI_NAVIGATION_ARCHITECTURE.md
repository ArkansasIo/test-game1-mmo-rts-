# UI and Navigation Architecture

## Shell regions

The dashboard has five persistent regions: left navigation, commander and resource header, account menu, central selected-page content, and footer metadata. The shell is kept stable while page content changes.

## Menu groups

The active groups are Command Center, Attack, Armory, Training, Technology, Intelligence, Market, Social, Planets, Mothership, Account, and Universe. Each group contains registered submenus. The route registry provides the label, icon, title, layout, controls, actions, and tables used by navigation and documentation.

## Page rendering

Renderer functions receive the preloaded `state` object and write section, title, description, and content. Shared renderers may serve related branches when their state shape is compatible. A route must never call an undefined function. The fallback renderer is intentional only for routes whose layout is generic or whose page is not yet specialized.

## Header and resources

The header keeps commander name, race, rank, turn status, server state, and resource balances visible. The resource strip should display all resources returned by the server in a stable order. Deuterium is explicitly ordered after Crystal and may use a dedicated capacity field. Responsive wrapping must not hide a resource at narrow widths.

## Account preferences

Theme, density, and reduced-motion preferences are stored in local storage and applied as root data attributes. Default white is the baseline. Window blue sci-fi, deep-space blue, and lighter blue `#357EC7` are supported visual directions. Persistent preferences should not affect server authority or security.

## Feedback and affordances

Actions show their purpose, permission context, cost or prerequisite context, and result state. Destructive or competitive actions should expose protection, cooldown, and target rules before submission. Read-only panels should explicitly say that no balance or ownership state is changed.

## Responsive strategy

The left rail may scroll independently, the top resource strip wraps, cards stack, and tables either scroll horizontally or use compact columns. Buttons and forms remain reachable at mobile widths. The footer retains build, developer, legal, and status links without blocking content.

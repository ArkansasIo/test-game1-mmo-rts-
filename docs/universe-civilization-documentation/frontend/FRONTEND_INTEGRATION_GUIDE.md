# Frontend Integration Guide

## Dashboard shell

`game.php` is the authenticated shell. It provides the left navigation, top commander header, resource strip, account menu, central `section`, `title`, `description`, and `content` containers, global feedback banner, and footer metadata. Page renderers replace central content without a full document reload during normal navigation.

## Navigation

The route registry is the source of truth for menu groups, icons, page titles, layouts, controls, actions, and table references. The renderer builds grouped details and submenu buttons. A route must be registered before it can be selected from a query string or menu. The special legacy alias `planets` maps to `planet-list`.

The account menu is separate from the left navigation and supports account information, preferences, density, theme, reduced motion, refresh, and logout. Preferences are stored in local storage and applied to the root dataset before page rendering.

## State binding

Server state is serialized into the page and read by renderer functions. Renderers must use safe access patterns such as `state.resources || {}` and list fallbacks. Numeric values should be formatted by shared helpers, while labels and server-provided text must be escaped before insertion into HTML.

The browser should not invent server values. It may show a local input preview, but a final balance, effect, damage, queue status, ownership state, and completion time must come from a refreshed server response.

## Forms and actions

State-changing forms use POST to `actions/game.php` and include the server-generated CSRF field. Forms submit action name, resource or entity identifiers, quantities, types, and redirect route. They must not submit trusted totals or authoritative outcomes. The action handler validates again and delegates to a service.

Shared form requirements:

| Requirement | Implementation expectation |
|---|---|
| CSRF | Include the generated CSRF field and reject invalid tokens. |
| Numeric values | Use bounded inputs with non-negative minimums and server validation. |
| Ownership | Submit identifiers only; service reloads and verifies ownership. |
| Feedback | Redirect with safe flash or feedback state and reload authoritative state. |
| Idempotency | Disable duplicate submission where possible and enforce server-side cooldown or unique constraints. |

## Feedback states

Every page should render useful empty and error states. `loading` should be used for asynchronous reads, `empty` for valid no-data, `locked` for unmet prerequisites, `protected` for protected targets or account state, `insufficient-resource` for balance failure, `cooldown` for time restrictions, `queued` for accepted work, `success` for completed work, and `error` for safe unexpected failure.

## Responsive behavior

The layout uses a left rail, top resource strip, flexible central content, cards, metric grids, and tables. At narrow widths, navigation may scroll, cards stack, tables should permit horizontal scrolling or compact wrapping, buttons must remain legible, and resource tiles must wrap without hiding a resource. Dense mode may reduce spacing but must not remove labels or critical states.

## Theme behavior

Theme settings are applied through root data attributes and CSS variables. Supported themes include default white, window blue, deep-space blue, and the lighter blue visual direction using `#357EC7`. Components should use semantic variables rather than hard-coded theme-specific colors. Focus states and warnings must remain visible in all themes.

## Accessibility

Every form control needs an associated label or accessible text. Buttons should describe the action and target. Tables need headings. Feedback should be discoverable by assistive technology without exposing sensitive payloads. Reduced-motion preference must disable non-essential animation. Color should not be the only indicator of state.

## Page renderer checklist

Before adding or changing a renderer, verify route registration, server state key, empty fallback, formula text, controls, CSRF form, action name, redirect, escaped output, feedback states, backend tables, permission text, responsive layout, and a route smoke test.

# Release Checklist

## Before merge

- [ ] Source changes have focused tests and documentation updates.
- [ ] PHP syntax checks pass for changed files.
- [ ] Client JavaScript syntax passes against rendered HTML.
- [ ] Route registry, page definitions, modules, renderers, and action handlers agree.
- [ ] Security checks cover CSRF, authentication, RBAC, ownership, cooldown, and transaction behavior.
- [ ] SQL changes include migration order, defaults, indexes, and backfill notes.
- [ ] Deuterium or other resource changes update schema, state, catalog, formulas, UI, and tests.
- [ ] UML source changes render successfully.

## Before deployment

- [ ] Database backup is complete and restorable.
- [ ] Migration version and Git commit are recorded.
- [ ] Scheduled turn processing is paused.
- [ ] Pending migrations have been reviewed and applied in order.
- [ ] Seed or backfill scripts have completed.
- [ ] Service bootstrap, page module, contract, and representative domain tests pass.
- [ ] Build number and release metadata are updated.

## After deployment

- [ ] Login and logout work.
- [ ] Dashboard loads without PHP or JavaScript errors.
- [ ] All menu groups and submenus are visible.
- [ ] Representative pages from Command Center, Attack, Armory, Training, Technology, Intelligence, Market, Social, Planets, Mothership, Account, and Universe load.
- [ ] Top resource header includes all available nine-resource fields, including Deuterium.
- [ ] One safe read-only action and one controlled mutation are verified.
- [ ] Queue and cron health checks pass.
- [ ] Logs show no unexpected errors.
- [ ] Scheduled processing is resumed.

## Release record

| Field | Value |
|---|---|
| Release version |  |
| Build number |  |
| Git commit |  |
| Migration version |  |
| Deployed at |  |
| Operator |  |
| Rollback point |  |
| Known limitations |  |

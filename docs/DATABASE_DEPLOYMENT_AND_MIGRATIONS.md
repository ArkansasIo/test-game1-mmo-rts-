# Universe Civilization: Empire at Wars Database Deployment

The database deployment entrypoint is `tools/deploy_database.php`. It applies the numbered SQL files in numeric order, creates the target database when the configured database user has permission, and records successful or failed migrations in `schema_migrations`.

## Safe workflow

The default operation is a non-mutating plan:

```bash
php tools/deploy_database.php --plan
```

The plan prints the target database, every migration filename, and its SHA-256 checksum. The runner excludes `014_local_demo_account.sql` by default so production deployment does not create test credentials.

To apply the schema and migrations explicitly:

```bash
php tools/deploy_database.php --apply
```

To include the local demo account in a development environment:

```bash
php tools/deploy_database.php --apply --include-local-demo
```

A bounded deployment can be used for staged rollout or recovery:

```bash
php tools/deploy_database.php --apply --from=034 --to=037
```

## Migration order

The runner includes numbered files from `000_complete_database.sql` through the latest numbered migration. Duplicate numeric prefixes are ordered by filename, so the two `014_*` files and two `015_*` files are deterministic. The unnumbered `schema.sql` is retained as a legacy reference and is not applied by the runner because `000_complete_database.sql` is the authoritative baseline migration.

The current deployment set contains 40 numbered migration files and 41 SQL files including `schema.sql`. Migration `037_schema_migrations.sql` defines the persistent migration ledger used by later deployments.

## Safety controls

The runner uses a MySQL advisory lock named `universe_civilization_database_deploy`, preventing concurrent deployments. Each migration is checksum-tracked. If an already-applied migration changes on disk, deployment aborts rather than silently applying drift. Each migration is executed inside a transaction where the database engine supports transactional DDL, and failed migrations are recorded with an error message and execution time.

Deployment logs are written to `storage/logs/database-deploy-YYYY-MM-DD.log`. The runner uses the existing `config/config.php` connection constants and does not expose credentials in command output.

## Operational notes

Before applying to production, take a database backup, run the plan, review the checksums, and confirm that the configured account has the required `CREATE`, `ALTER`, `INSERT`, `UPDATE`, and `LOCK TABLES` privileges. Some legacy migrations contain DDL that may be auto-committed by MySQL/MariaDB; the migration ledger and advisory lock provide operational safeguards, but they do not replace backups.

The deployment runner does not perform rollback SQL automatically. A rollback must be a separately reviewed migration or a database restore because several game migrations change table structures and seed authoritative game data.

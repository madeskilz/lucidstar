# lucidstar
Lucid Stars Private School

## Developer setup: migrations & sessions

We added a small migration runner and SQL migrations under `db_migrations/`.

- To apply migrations locally (reads DB env vars or sensible defaults):

```bash
# copy `.env.example` to `.env` and edit DB_HOST, DB_USER, DB_PASS, DB_NAME
cp .env.example .env
php scripts/run_migrations.php
```

- The runner records applied files in a `migrations` table so it only applies each file once.

- To enable database-backed sessions:
	1. Run the `db_migrations/20260312_create_ci_sessions_table.sql` migration (via the runner above).
	2. Set `USE_DB_SESSIONS=1` in your `.env` or environment.
	3. Reload your PHP/MAMP server.

Notes:
- For robust HTML sanitization of pages, installing `ezyang/htmlpurifier` via Composer is recommended; the `Page_model` will use HTMLPurifier when available and otherwise falls back to a basic sanitizer.

### Composer & tests

Install Composer dependencies (including `ezyang/htmlpurifier`):

```bash
composer install
```

Run tests (uses `phpunit.xml.dist`):

```bash
composer test
```


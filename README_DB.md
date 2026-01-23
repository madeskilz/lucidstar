DB-driven frontend migration

Steps to enable DB-managed frontend content:

1. Run migration SQL against your lucidstar database:

   ```bash
   mysql -u <user> -p <database> < db_migrations/20260123_add_site_tables.sql
   ```

2. Confirm tables created: `settings`, `menus`, `menu_items`, `media`, `ctas`.

3. Open the admin settings page: `/admin/settings` — you must be logged into the CMS (admin user).

4. Upload a logo or change site name and Save. The header/footer use these values via `site_option()` with safe fallbacks.

Rollback:

```bash
mysql -u <user> -p <database> < db_migrations/20260123_rollback_site_tables.sql
```

Notes:
- Uploaded logo files are stored in `sitefiles/media/` and the `logo_path` setting is stored as a full URL.
- Menu management is under `/admin/menus` (create menus) and `/admin/edit_menu/{id}` (add/edit items).
- The helper `application/helpers/site_helper.php` centralizes `site_option()` and `get_menu()`.

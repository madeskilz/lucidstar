# Copilot Instructions for lucidstar

Purpose: give an AI coding agent immediate, actionable knowledge for working in this CodeIgniter app.

**Repository Overview**
- **Framework:** CodeIgniter (classic structure). Key entry is `index.php` and the `system/` + `application/` folders.
- **Env bootstrap:** `index.php` requires `environment.php` which sets `ENVIRONMENT` (development/testing/production).
- **Config locations:** runtime configs live in `application/config/` (see `config.php`, `routes.php`, and environment-specific DB in `application/config/development/database.php`).

**Architecture & Key Files**
- **Front controller:** `index.php` — standard CI bootstrap and constants (`APPPATH`, `VIEWPATH`).
- **Routing:** `application/config/routes.php` (examples: `login -> auth/login`, `404_override -> custom404`).
- **Controllers:** `application/controllers/` (e.g. `Home.php`, `Auth.php`, `Admin.php`). Controllers set a `$p` array and call `$this->load->view('...', $p)` to render views.
- **Models:** `application/models/` (e.g. `User_model.php`) use CI Query Builder and return results from `->result()`.
- **Helpers:** `application/helpers/lucid_helper.php` contains global helper functions (use `get_instance()` to access `$ci->db`).
- **Views & assets:** `application/views/` and `assets/` hold templates and static files.

**Conventions & Patterns**
- **View data:** controllers populate `$p` (associative array) and pass it to views — follow that pattern when adding controllers or view variables.
- **DB access:** use `$this->db` or `$ci->db` (in helpers). Examples: `User_model::validate()` uses `group_start()/group_end()` and `$this->db->get(...)->result()`.
- **Auth flow:** `Auth::login()` reads POST via `$this->input->post()` (but checks method via `$_SERVER['REQUEST_METHOD']`) and uses `md5()`-hashed passwords — this is a discovered, project-specific detail.
- **Sessions:** configured in `application/config/config.php` (`sess_driver = 'files'` by default).
- **Error/Env rules:** set `ENVIRONMENT` to `development` to enable full error reporting (see `environment.php` and `index.php`).

**Developer Workflows (how to run & debug)**
- **Run locally:** project expects a PHP server (tested with MAMP). Open `http://localhost/<project-folder>/` or point your vhost to project root.
- **DB config:** edit `application/config/development/database.php` for local credentials (default uses `mysqli`, DB `lucidstar`).
- **Enable verbose errors:** set `ENVIRONMENT='development'` via `environment.php` or server env var `CI_ENV` to show errors and stack traces.
- **Logs:** check `application/logs/` for runtime logs.
- **Composer:** `composer.json` exists (project-level), but `composer_autoload` is `FALSE` in `config.php` — do not assume PSR autoloading is active unless `composer_autoload` is enabled.
- **Tests:** no automated tests detected. Composer dev suggests `phpunit` but no test harness present.

**Integration points & noteworthy details**
- **Database:** `mysqli` driver; DB credentials in `application/config/development/database.php` (active group: `default`).
- **Assets:** static files under `assets/` and `sitefiles/` served by web server.
- **Security/hardening notes (discovered):** passwords are hashed with `md5()` in `Auth::auth()` — this is a concrete, repo-observed behavior to handle carefully if modifying auth.

**Concrete examples to reference in work**
- Route example: `application/config/routes.php` contains `'$route['login'] = "auth/login";'` — use this mapping for changes to auth endpoints.
- Controller -> view: `Home::index()` sets `$p['active']='home'; $this->load->view('home/index', $p);` — follow `$p` pattern.
- Helper usage: `home_news()` in `application/helpers/lucid_helper.php` calls `$ci->db->query(...)` and returns `->result()`.

**Where to look first when asked to change behavior**
- For routing or controller entrypoints: `application/config/routes.php` and `application/controllers/*`.
- For DB schema/connection issues: `application/config/development/database.php` and `application/config/database.php`.
- For rendering changes: `application/views/` and `application/helpers/lucid_helper.php` for shared view helpers.

If any section above is unclear or you want more detail (examples, code snippets, or tests to add), tell me which part to expand and I will iterate.

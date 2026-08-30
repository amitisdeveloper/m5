# Project Knowledge Report

Audit date: 2026-08-30  
Repository: `amitisdeveloper/m5`  
Audited branch: `result9` at `0cb4e40`  
Scope: active application source, configuration, runtime/framework code, database references, frontend assets, deployment artifacts, and Git history. Generated framework internals and obvious backup/archive duplicates were inventoried but not reviewed line by line.

## 1. Executive summary

This is a server-rendered PHP application for managing a hierarchical number-wagering operation. Its core concepts are super-admin/master/staff users, parties represented by ledger accounts, dated shifts, wager transactions (individual numbers and several compound forms), result declaration, commission/share calculations, coins/credit, vouchers, installments, and daily/till-date account settlement ("hisab").

The application uses CodeIgniter 3.1.3 with MySQL/MariaDB through `mysqli`. It is deployed as a traditional Apache/cPanel site with `index.php` as the front controller and `.htaccess` URL rewriting. The repository vendors the CodeIgniter framework and all browser assets; there is no application build pipeline, automated test suite, schema/migration history, container definition, or CI configuration.

The active code is highly coupled and financially sensitive. Controllers contain much of the orchestration and calculation logic, models mix query-builder and raw SQL, and large PHP views contain extensive inline JavaScript and business calculations. Several security and correctness issues should be treated as blockers before major feature work: secrets are tracked in Git, passwords are mostly plaintext or MD5, CSRF is disabled, controller authorization is inconsistent, state-changing endpoints are publicly routable, and multi-table balance/transaction updates are not wrapped in database transactions.

### Project brief from the owner

- `userid = 1` is the super-admin/system owner.
- Super admin creates masters.
- Each master creates party users under their own scope.
- Global shifts are created by super admin and are visible to all roles and sub-roles.
- Super admin sets the date/time window that determines when a shift remains valid.
- Master-specific shifts are visible only to that master and their parties.
- Masters can set the timing for their own shifts, including the cutoff until which work can be sent upward to the super admin for that shift.
- Shift ordering shown to parties must follow the timing set by each master for their own shifts, while still respecting any super-admin global timing rules.
- All logins must see the shift list according to the closing time configured by super admin or master.

Unless explicitly marked **inferred** or **unknown**, statements below are confirmed from source.

## 2. Architecture

### Runtime and framework

- Language: PHP, with HTML/CSS/JavaScript in PHP templates.
- Framework: CodeIgniter 3.1.3, committed in `system/`.
- PHP compatibility metadata: Composer only requires PHP `>=5.2.4`, but deployment files point to cPanel PHP 7.4. Local syntax validation passed for 146 selected active PHP files on PHP 8.3.27; that does not prove runtime compatibility or database behavior.
- Database: MySQL/MariaDB-compatible SQL via CodeIgniter's `mysqli` driver.
- Architecture: conventional CodeIgniter MVC, but controllers and views contain substantial business logic.
- Dependency management: `composer.json` is the stock CodeIgniter framework manifest; Composer autoloading is disabled and no lockfile/vendor application dependencies are present.

### Entry point and request lifecycle

1. Apache rewrites non-file/non-directory requests to `index.php/$1`.
2. `index.php` defaults `ENVIRONMENT` to `development` unless `CI_ENV` is provided.
3. `index.php` boots `system/core/CodeIgniter.php`.
4. CodeIgniter loads configuration and routes, autoloads database/session/pagination/user-agent plus security/form/url/`comman` helpers, resolves a controller method, and renders a layout.
5. Controllers normally set `$data['_view']`; `application/views/layouts/main.php`, `mainold.php`, or `main_login.php` then loads that child view.

### Routing

- Default route: `dashboard/master_login`.
- Clean URLs depend on `.htaccess`; `index_page` is empty and `uri_protocol` is `REQUEST_URI`.
- Named routes cover login/logout, dashboards, ledger/master/agent/staff/shift CRUD, transaction entry, jantri views/cutting, result entry, statements/hisab, coin/credit allocation, vouchers, installments, and opening-balance jobs.
- CodeIgniter's default controller/method routing remains enabled, so public methods are callable even without explicit route entries.
- Broken/stale routes are present: `admin_login` targets a missing `Dashboard::admin_login`, `check_logs` targets a missing `Dashboard::show_logs`, and three shift-time routes target a missing `ShiftController`.
- `partyjantri` is declared twice.

### Application directories

- `application/controllers/`: active controllers plus many dated/`back` copies.
- `application/models/`: active data-access classes plus dated/copy variants.
- `application/views/`: server-rendered templates; the transaction and jantri views are particularly large and JS-heavy.
- `application/helpers/comman_helper.php`: global balance, commission, opening/closing, and shift-allocation helpers; it is also executed after every controller construction through a hook.
- `application/config/`: routes, database, session/security/runtime settings.
- `application/cron/`: a standalone, dated database script and its separate connection file.
- `application/newmastefiles/`, `application/masterbackupmvc/`, multiple ZIPs, and numerous dated files: archival duplicates, not part of the configured runtime.
- `assets/`: vendored CSS/JS/fonts/images.

### Controller/model map

| Module | Controller(s) | Primary models | Responsibility |
|---|---|---|---|
| Authentication/dashboard | `Dashboard`, duplicate `Dashboard_staff` | `Users_model`, ledger/shift/transaction/coin/open-result models | Login variants, session creation/destruction, dashboard summaries |
| Ledger/party/master | `Tbl_ledger` | `Tbl_ledger_model` | Party/master accounts, rates, commissions, opening balance, hierarchy, statements |
| Admin/agent/staff | `Tbl_admin`, `Tbl_agent`, `Tbl_staff` | matching models | Supporting identity/group records and staff activation |
| Shifts | `Tbl_shift` | `Tbl_shift_model` | Shift definitions and per-user/per-date timing overrides |
| Transactions | `Tbl_transactions` | transaction, ledger, shift, staff, open-result, coin models | Wager entry/edit/delete, aggregate maintenance, coin charging |
| Jantri | `Tbl_jantri` | jantri, transaction, shift, ledger models | Consolidated wager sheets, party views, cutting/commission variants |
| Results and settlement | `Tbl_openno` | open-result, transaction, ledger, agent, shift, staff models | Winning result entry, exposure calculation, opening/closing, hisab, statements/reports |
| Coin/credit | `Tbl_coin` | `CoinModel` | Coin transfers, credit allocation, balances |
| Voucher/installment | `Tbl_voucher`, `Tbl_kist` | matching models | Cash-transfer adjustments and installment adjustments |
| Dormant coin CRUD | `AddCoin` | `AddCoin_model` | Generic CRUD scaffold; no active named route and model table naming is unclear |

## 3. Frontend architecture

- Server-rendered PHP templates, not a SPA.
- Main UI libraries are vendored jQuery 2.2.4, Bootstrap 4.3.1, Moment 2.13.0, Font Awesome, daterangepicker/datetimepicker, DataTables-related assets, Select2, and custom CSS/JS.
- Some Select2, jQuery UI, JSZip, pdfmake, and font assets are loaded from public CDNs, making those screens dependent on external availability and CSP/network policy.
- Layout navigation is hidden/shown according to session `role`, but this is presentation logic and is not an authorization boundary.
- Many views issue `XMLHttpRequest` calls directly to controller routes and contain number-expansion/calculation logic inline.
- The largest active templates are roughly 80–178 KB, especially transaction entry/edit forms. This makes UI changes high-risk and difficult to test.
- There is no root Node package, bundler, minification task, or reproducible frontend build. Assets are edited/served directly.

## 4. Database

### Technology and configuration

- CodeIgniter database configuration is in `application/config/database.php`.
- Driver: `mysqli`; persistent connections off; query cache off; saved queries on; UTF-8/`utf8_general_ci`; strict mode off; connection encryption off.
- Database configuration and a second standalone cron connection file are tracked in Git and contain credentials. Values are intentionally omitted from this report.
- Database debug is enabled outside the `production` environment.
- No application migration directory, SQL schema, dump, foreign-key definitions, seed data, or database test fixture is present. `migration.php` is the stock disabled configuration.

### Core table groups

The following are confirmed table references. Relationships are confirmed from joins/filters unless marked **inferred**.

#### Identity and hierarchy

- `tbl_user_login`: legacy/top-level login accounts; linked to `tbl_user_roles` by `user_role`.
- `tbl_user_roles`: role-name lookup.
- `tbl_admin`: an additional admin login/entity table.
- `tbl_staff`: staff login accounts; `updated_by` links a staff record to its owning master/ledger context.
- `tbl_ledger`: central party/master account table. It stores credentials, status, `is_master`, rates/commissions, opening balance, coin balance, hierarchy through `updated_by`, and optional agent/share/third-party settings.
- `tbl_agent`: agent grouping; ledger records reference it through `agent_id`.

#### Shift scheduling

- `tbl_shift`: reusable shift definitions.
- `user_shift_timings`: dated, user/master-specific shift timing and activation records; `shift_id -> tbl_shift.id`. Transaction headers often store a timing-record ID rather than the base shift ID, so the distinction is critical.

#### Wager entry and aggregation

- `tbl_master_transaction`: transaction header with shift, party, date, and total amounts.
- `tbl_trans_numbers`: current number/amount detail records linked by `master_id`.
- `tbl_trans_add`: older/alternate number details.
- `tbl_random_f4`, `tbl_trans_cross`, `tbl_trans_fromto`, `tbl_random_f8`: compound wager forms linked to a master transaction.
- `tbl_jantri`: jantri detail/summary records linked to transaction headers.
- `Tb_Date_shift_party_entry`: per-date/shift/party aggregate and settlement staging row containing rates, commission, total exposure, winning exposure, and net-profit-related fields.
- `tbl_transaction_result`: result/aggregate data referenced by transaction and result logic.
- Other legacy references include `tbl_transactions`, `tbl_onlt_tb_trnsctions`, `Tb_Date_shift_party_entrytest`, and singular/plural transaction variants. Their live status cannot be proven without the schema and production data.

#### Results and accounting

- `tbl_openno`: declared winning numbers/results by date and shift.
- `tbl_opening`: daily opening/closing snapshots by ledger/date.
- `tbl_final_hisab`: daily/final settlement values by ledger; dates are frequently stored/parsed as `DD-MM-YYYY` strings.
- `tbl_final_ledger` and legacy `final_ledger`: final account records. Both names appear, suggesting schema/code drift.
- `tbl_voucher`: transfers between `PartyId` and `Collect_By`; direction changes the sign in settlement.
- `tbl_kist`: installment adjustments associated with ledgers.
- `tbl_credit`: append-style credit allocations by party/master.
- `coin_transactions`: sender/receiver coin movements, optional shift, type/status, and timestamps.

### Important relationships

```text
tbl_user_roles <- tbl_user_login

tbl_ledger (parent via updated_by)
  ├─< tbl_staff (owner/master via updated_by)
  ├─< tbl_agent
  ├─< tbl_credit
  ├─< tbl_final_hisab
  ├─< tbl_opening
  ├─< tbl_voucher / tbl_kist
  └─< tbl_master_transaction (party_id)

tbl_shift ─< user_shift_timings ─< tbl_master_transaction (shift_id in current flows)

tbl_master_transaction
  ├─< tbl_trans_numbers / tbl_trans_add
  ├─< tbl_random_f4
  ├─< tbl_trans_cross
  ├─< tbl_trans_fromto
  ├─< tbl_random_f8
  └─< tbl_jantri

(party, dated shift) ─> Tb_Date_shift_party_entry ─> result exposure / hisab

tbl_ledger ─< coin_transactions >─ tbl_ledger
```

There are no repository-level foreign-key declarations, so referential enforcement is **unknown**.

### Critical data flows

#### Transaction entry

1. Controller accepts form fields for party, dated shift, numbers/amounts, and compound forms.
2. It derives total number and akhar amounts.
3. Some entry paths check coin balance and create a coin transfer/spend record.
4. A `tbl_master_transaction` header is inserted.
5. Detail rows are inserted, mainly into `tbl_trans_numbers`; older paths use the compound tables.
6. The party/date/shift aggregate in `Tb_Date_shift_party_entry` is inserted or updated with the ledger's rate, commission, rebate, third-party/share settings, and totals.
7. Opening/closing values may be recalculated and persisted.

These writes are not wrapped in an explicit database transaction; a partial failure can desynchronize money, header, detail, and aggregate records.

#### Result declaration

1. `Tbl_openno` records or edits a winning number for a shift/date.
2. It locates each party aggregate for that shift/date.
3. It scans stored comma-separated number/amount details and compound-form tables.
4. Exact winning-number exposure becomes `Open_Number_amount`; digit-position/akhar matches become `Akhar_Number_amount`. `00` is inconsistently represented as `00`, `100`, `000`, or `0000` in different flows.
5. Aggregate/result fields are updated and then used by reports and settlement.

#### Daily settlement (hisab)

- Wager total is reconstructed from transaction details.
- Commission is rounded upward: `ceil(total wager * dara commission / 100)`.
- Winning number payout is rounded upward: `ceil(open-number exposure * dara rate)`.
- Akhar payout is rounded upward: `ceil(akhar exposure * akhar rate)`.
- If `hissa_select == 'y'`, patti/share is a percentage of the amount remaining after commission and payouts.
- Base settlement is approximately wager total minus commission, payouts, and share; vouchers and kist are applied in route-specific ways.
- Opening balance comes from the ledger at month start or a dated `tbl_opening` snapshot/fallback calculation on later days.

The calculation exists in several controller/helper variants with differences, so the exact authoritative formula is **not established**.

#### Coin balance

Multiple competing formulas exist:

- mutable `tbl_ledger.coin_balance` updated during allocation/withdrawal;
- sum of received `coin_transactions` minus selected sent transactions;
- received coins minus current-month `tbl_final_hisab.today_hisab`;
- helper variants with a fixed historical start date and a 06:00 business-day boundary.

This is a major reconciliation risk. The source does not identify one canonical balance function.

## 5. Configuration and external integrations

### Application configuration

- Production base URL is hardcoded to `https://result9.bull99exch.com/`; an alternate admin domain is commented nearby.
- No per-environment `application/config/{development,production}` overrides are present.
- Hooks are enabled. A `post_controller_constructor` hook calls `update_coin_balance()` from `comman_helper.php` on every controller request, adding hidden database work and potential side effects.
- Logging threshold is maximum verbosity (`4`), with the default log directory.
- Application caching is not configured; database query caching is off.
- Sessions use CodeIgniter's file driver, `ci_session`, no expiration, and `sys_get_temp_dir()` as the save path.
- Cookies are not marked Secure or HttpOnly in CodeIgniter config.
- CSRF protection is disabled.
- Encryption key is empty.
- File uploads are enabled and sized very generously by cPanel PHP configuration, but no active application upload workflow was found.

### External services and domains

- Browser redirects/integration references exist for `check.555xch.live`, `app.555xch.live`, `new.555xch.live`, a WhatsApp share URL, and a Netlify-hosted URL used in ledger sharing.
- The login page links to an external mobile app/demo.
- PHP `mail()` is used by `Tbl_openno::cron_mail`; no SMTP/API provider configuration is present.
- CDN dependencies include cdnjs, jsDelivr, and code.jquery.com.
- No active REST client, payment gateway, queue, cloud storage SDK, or webhook handler was found.
- An old Yii/web-service method exists inside a block comment in `Tbl_openno_model`; it is not active CodeIgniter behavior.

## 6. Authentication and authorization

### Login flow

- Default login is `Dashboard::master_login`, which authenticates against `tbl_ledger` using username, plaintext password, and `status = 1`.
- Other reachable login methods try `tbl_user_login` with MD5, then `tbl_admin` with plaintext; staff login uses `tbl_staff` with plaintext.
- Successful login sets overlapping session keys: `userid`, `id`, `name`/`first_name`, `updated_by`, `role`, `coin_balance`, and `authenticated` depending on the path.
- Logout destroys the whole session and redirects to `/`.

### Roles and hierarchy

- Observed role strings: `Super Admin`, `Master`, and `Staff`.
- ID `1` is repeatedly treated as super-admin/system owner; other magic IDs are present in financial paths.
- `tbl_ledger.updated_by` and staff `updated_by` implement ownership/hierarchy.
- `is_master` distinguishes master ledger accounts.
- Layouts hide navigation by role, and some controller methods perform role checks.

### Authorization weaknesses

- `system/core/User_Controller.php` contains a session guard, but application controllers extend `CI_Controller`, not `User_Controller`.
- `Dashboard::logged_in()` exists but is not called.
- Most controllers do not enforce authentication in their constructor.
- Many reads/writes accept IDs directly from URL or POST data and do not verify ownership.
- Several methods mutate session identity or rely on client-supplied `updated_by`/master IDs.
- Public `remove($id)` methods delete records through GET-like controller routes without CSRF or consistent role checks.
- Cron/update-opening/result/coin mutation methods are web-routable and lack a dedicated scheduler secret or CLI-only guard.
- Role-based navigation must not be mistaken for server-side authorization.

## 7. Deployment and operations

### Confirmed deployment model

- Traditional document-root deployment under Apache with `mod_rewrite` and `index.php` front controller.
- `.htaccess` uses `RewriteBase /`, so the site expects to be installed at a domain root.
- `.user.ini`/`php.ini` are cPanel-generated and point to cPanel PHP 7.4 session storage.
- The active base URL targets the `result9.bull99exch.com` host.
- The current local workspace is under XAMPP on Windows; this is a development checkout, not proof of the production filesystem layout.

### Runtime configuration concerns

- `index.php` defaults to `development` when `CI_ENV` is absent.
- Both production and development branches call `ini_set('display_errors', 1)`; cPanel's `display_errors = Off` may therefore be overridden at runtime.
- Database debug is on whenever the environment is not exactly `production`.
- cPanel permits 512 MB POSTs, 1 GB uploads, 1 GB memory, and 300-second execution, which increases denial-of-service impact if exposed endpoints accept large requests.

### Cron/background work

- No queue worker or framework CLI command exists.
- Web routes expose closing/opening update and mail operations.
- `application/cron/updateclosing.php` is a standalone, hardcoded 2023 diagnostic script that reads rows and prints them. It uses separate committed credentials and should not be considered a production-safe scheduler.
- Actual server crontab/cPanel schedule is not in the repository and remains unknown.

### Release process

- No deployment script, Docker image, CI workflow, artifact build, health check, rollback procedure, or environment template is present.
- Likely deployment is file upload/Git checkout into a cPanel document root (**inferred** from cPanel files and tracked ZIP archives).

## 8. Git repository and workflow

- Remote: GitHub repository `amitisdeveloper/m5` over HTTPS.
- Current branch: `result9`, tracking `origin/result9`.
- Remote default branch: `main`.
- At audit time `result9`, `origin/result9`, `origin/main`, and `origin/HEAD` all point to `0cb4e40`; there is no branch divergence.
- The repository has only 11 visible commits: one very large initial import followed by small direct fixes.
- Recent work is concentrated in the cutting-jantri flow (`Tbl_jantri`, `cut_index_temp.php`, shift selection, and routes).
- Commit messages are short and informal; there is no documented branching, review, release, tagging, or commit convention.
- `AGENTS.md` is untracked user-provided project instruction at audit time. This report is also documentation, not application code.
- Configuration files with credentials are tracked, as are the entire framework, cPanel settings, multiple ZIP archives, and at least 113 backup/date-named files.

## 9. Major business modules and rules

### Account hierarchy

- Super admin/system owner is special-cased as ID `1`.
- Masters and parties are stored in `tbl_ledger`; a ledger's parent/creator is `updated_by`.
- Staff are separate login records related to a master by `updated_by`.
- Ledger records hold the commercial rules used at entry and settlement: dara rate/commission, akhar rate/commission, rebate, third-party party/percentage, hissa percentage/enablement, opening balance, and agent.

### Dated shifts

- `tbl_shift` defines a base shift.
- `user_shift_timings` assigns a shift to a user/master and date with time/active metadata.
- The application selects the latest timing per shift/user for transaction entry.
- Jantri sending/cutting can be gated by comparing the configured dated shift time to current Asia/Kolkata time.

### Wager forms

- Direct two-digit numbers are stored as parallel comma-separated number/amount data in current detail tables.
- Special forms include repeated-digit/akhar entries, random F4, cross, from-to ranges, and random F8 inside/outside digits.
- `00` has special normalization logic and is a fragile business rule because representations differ by code path.
- Transaction aggregates are kept separately from details and must stay synchronized.

### Jantri and cutting

- Jantri screens consolidate transactions by shift/date and optionally party.
- `cutjantri` currently routes to `cutjantritemp(false)`, which selects the legacy cutting view. `cutjantrinew` invokes the same controller method with new-view flags for commission/patti application.
- Recent commits specifically revised this route/view split and automatic shift selection.

### Results and hisab

- Result entry maps the winning number into party exposure totals.
- Settlement subtracts commission, number payout, akhar payout, and optional patti/share; vouchers and installments adjust the balance.
- Daily openings roll forward from prior calculations and snapshots, with special handling at the first day of a month.
- A 06:00 boundary appears in coin/balance queries, suggesting the business day may not equal midnight-to-midnight; this needs owner confirmation.

## 10. Project conventions

- CRUDigniter-generated class/file naming: `Tbl_xxx` controller, `Tbl_xxx_model`, and `application/views/tbl_xxx/` templates.
- Controllers set `$data['_view']` and render through a shared layout.
- Active files coexist with `back`, `old`, date-suffixed, `.bak`, ZIP, and full-tree duplicate copies. There is no reliable naming rule beyond the active unsuffixed paths and explicit routes.
- Table/column naming mixes lowercase snake case, TitleCase (`PartyId`, `ShiftId`, `Date`), singular/plural, and inconsistent spellings (`commission`/`commision`, `akhar`/`akar`, `dara`/`dhada`). Preserve database spelling when touching existing flows.
- Models return a mix of arrays, objects, JSON strings, IDs, booleans, and status strings; callers depend on these ad hoc contracts.
- Dates are stored and compared in multiple formats (`Y-m-d`, `d-m-Y`, timestamps, and `STR_TO_DATE`).
- IDs and role strings are often hardcoded rather than constants/configuration.
- Form validation is controller-local and inconsistent; many paths use raw superglobals.
- Business logic is commonly duplicated among normal/admin/master/app/back variants.
- New features have recently been implemented by adding routes/method flags and copying/modifying large views rather than extracting services/components.

## 11. Technical debt and risk register

### Critical

1. **Committed secrets:** database credentials exist in tracked `application/config/database.php` and `application/cron/conn.php`. Rotate them, purge them from history as appropriate, and move configuration to environment/ignored files.
2. **Authentication storage:** most account passwords are plaintext; the legacy top-level login uses MD5. Migrate to `password_hash`/`password_verify` with staged rehashing.
3. **Missing centralized authorization:** most controllers are callable without a proven auth guard; role checks are partial and often UI-only.
4. **CSRF disabled and mutations over public routes:** deletes, coin allocation, result changes, and closing/opening operations are exposed without CSRF protection or consistent method restrictions.
5. **Financial consistency:** coin, wager, aggregate, result, and balance writes span tables without explicit database transactions or idempotency.

### High

6. **Multiple balance formulas:** `coin_balance`, helper-derived balances, transaction sums, and hisab deductions disagree in scope/date boundaries.
7. **Raw and mixed SQL:** numerous raw queries and direct superglobals increase SQL injection, logic-bypass, and maintenance risk. Some queries use bindings, others interpolate values/conditions.
8. **Output escaping:** no application use of `htmlspecialchars` was found while templates echo database/form data extensively; stored/reflected XSS risk is high.
9. **Error exposure:** runtime defaults to development, production also enables display errors, DB debug can be on, and several active methods contain `echo last_query(); die;`/diagnostic output.
10. **IDOR/tenant leakage:** many controller methods accept party/master/result IDs without ownership checks; hierarchy filtering is inconsistent.
11. **Race conditions:** coin balance is read then updated without row locking; simultaneous allocations can overspend or lose updates.
12. **Hardcoded system identities:** IDs `1`, `86`, `103`, `52`, sentinel receiver `9999999999`, fixed dates, and a huge synthetic admin balance appear in business code.

### Medium

13. **Obsolete dependencies:** CodeIgniter 3.1.3, jQuery 2.2.4, Moment 2.13.0, and old browser plugins are substantially outdated.
14. **No schema/migrations/tests:** database behavior and regressions cannot be reproduced confidently.
15. **Repository pollution:** archival copies and ZIPs obscure active code, enlarge clones, and invite edits to the wrong file.
16. **Large controllers/views:** key files exceed 90–136 KB and templates exceed 150 KB, combining persistence, calculations, rendering, and JavaScript.
17. **Dead/broken code:** stale routes, missing model loads (`Tbl_openno_model` in `Tbl_ledger`, `CoinModel` in `Tbl_openno`, `AccessTime_model` in `Tbl_shift`), commented Yii code, dormant scaffolds, and duplicated controller variants.
18. **Date handling:** mixed formats, string dates, local timezone calls, and inconsistent midnight/06:00 boundaries threaten report correctness.
19. **Hidden hook cost and split balance truth:** every controller request reads `tbl_ledger.coin_balance` and refreshes the session cache, while transaction admission uses a separately calculated coin balance.
20. **No documented deployment/rollback:** direct configuration edits appear in the latest commit.

## 12. Confirmed unknowns and assumptions

- Full database schema, indexes, foreign keys, triggers, stored procedures, row counts, and data distributions.
- Which legacy tables/files are still populated or called by external clients.
- Production PHP/MySQL exact versions and SQL modes.
- Actual Apache virtual-host rules, filesystem ownership/permissions, TLS/HSTS/CSP settings, and whether `.user.ini` overrides are honored.
- Actual cron/cPanel schedules and whether web cron routes are called externally.
- Whether the `check.555xch.live`/app redirects are still contractually active and what query-string contract they require.
- Canonical coin-balance formula, settlement formula, business-day cutoff, and `00` representation.
- Required semantics of rebate, third-party percentage, master commission, kist, and patti/hissa across every report.
- Whether `result9` is intended as a long-lived environment branch or temporary deployment branch.
- Branch/PR/review/release expectations.
- Backup, restore, reconciliation, audit-log, and incident-response procedures.
- Legal/compliance requirements for the wagering domain and financial records.

## 13. Recommended next documentation

1. Version-controlled, secret-free database schema with an ER diagram, indexes, date formats, and table ownership/status (active vs legacy).
2. A single approved settlement specification with worked examples for number, akhar, commission, patti/hissa, voucher, kist, opening, rounding, and `00` handling.
3. A canonical coin/credit ledger specification, including business-day cutoff, invariants, reconciliation queries, and concurrency rules.
4. Authentication/authorization matrix for every controller action and role, including object ownership rules.
5. Deployment runbook: environments, PHP/MySQL versions, config injection, cron schedule, release/rollback, backups, and smoke checks.
6. Integration contracts for external app/check domains, mobile login link, email, CDN fallback, and WhatsApp sharing.
7. Git workflow and active-file map, followed by a controlled archival cleanup plan.
8. Characterization tests around login, transaction entry, result calculation, hisab, coin allocation, and daily opening roll-forward before refactoring.

## 14. Concise A–J handoff

### A. Architecture

CodeIgniter 3.1.3 PHP MVC, Apache front controller, server-rendered PHP/jQuery/Bootstrap UI, MySQL via `mysqli`, no build/test/CI system.

### B. Major modules

Login/dashboard; ledger/master/party hierarchy; admin/agent/staff; dated shifts; wager transactions; jantri/cutting; result/open number; hisab/opening reports; coins/credit; vouchers/kist.

### C. Database

Central ledger and user hierarchy; base/detailed shift scheduling; master transaction with detail/compound tables; aggregate result staging; opening/final settlement; voucher/kist/credit/coin movement. No schema or migrations are available.

### D. External integrations

Several 555xch/app/check domain links and redirects, WhatsApp share links, one Netlify URL, PHP mail, and CDN-hosted browser libraries. No formal integration client/config layer.

### E. Authentication/security

Session-based roles with multiple login tables and inconsistent session keys. Plaintext/MD5 passwords, missing global guard, CSRF off, insecure cookies, IDOR risk, public mutation routes, tracked secrets, and weak output escaping.

### F. Deployment

Likely cPanel/Apache PHP 7.4 document-root deployment with URL rewriting. No deployment automation; environment/error configuration is unsafe; cron reality is unknown.

### G. Git workflow

`result9` and `main` currently identical. Small direct commits follow a huge imported codebase. No documented branching/review/release convention; many backups and secrets are tracked.

### H. Important business rules

Per-ledger rates and commissions; dated shift timing; special number forms; `00` normalization; result exposure; `ceil` rounding for commission/payout; optional hissa/patti; voucher/kist/opening adjustments; coin sufficiency checks.

### I. Risks/technical debt

Security boundary failures, credential exposure, non-transactional financial writes, competing balance formulas, duplication, mixed date formats, old dependencies, giant views/controllers, dead routes, debug code, no tests/schema.

### J. Questions/unknowns

Canonical schema/formulas/balance cutoff, production versions/config, active legacy paths, cron schedule, external contracts, Git/release rules, compliance, and operational reconciliation/backup procedures.

## 15. Second-pass workflow traces

This section follows active routes and forms through their write/read paths. Unless noted otherwise, authorization is only implicit in session values and navigation visibility; the controllers do not enforce a common authentication or object-ownership policy.

### 15.1 Login and session initialization

| Concern | Trace |
|---|---|
| Entry point | `GET /` renders `Dashboard::master_login`; the login form posts back to the same URL. `/login` maps to `Dashboard::index`, an older alternate path. |
| Controller/service | `Dashboard::master_login` calls `Tbl_ledger_model::login`; the alternate path calls `Users_model::login`. |
| Business logic | The main path accepts an active `tbl_ledger` row and labels it `Master` when `is_master` is set, otherwise `Staff`. It stores identity, role, display name, updater identity, authentication flag, and coin balance in the session. |
| Database tables | Main path: `tbl_ledger`. Alternate path: `tbl_user_login`, then `tbl_admin`, with a `tbl_staff` fallback. |
| External APIs | None. |
| Authentication/authorization | This establishes authentication, but no shared controller guard consumes it consistently. The two login implementations use different password representations and session shapes. No session-ID regeneration was found. |
| Side effects | Session state is created; subsequent requests run the post-controller-constructor coin-balance hook. |
| Error handling | Validation/flash messages and redisplay. Failed credentials do not distinguish account state. |

### 15.2 Ledger/master/party creation and maintenance

| Concern | Trace |
|---|---|
| Entry point | Forms post to `tbl_ledger/add`, `tbl_ledger/add_admin`, and edit counterparts. Credit is posted separately to `tbl_ledger/allocate_credit`. |
| Controller/service | `Tbl_ledger` validates selected fields, builds commercial/account attributes, and calls `Tbl_ledger_model`. |
| Business logic | A ledger is both a login principal and a financial party. Its owner is recorded through `updated_by`; `is_master` distinguishes masters. Number/akhar rates, commissions, rebate, TP sharing, hissa/patti, opening values, and agent association drive downstream calculations. Usernames are intended to be unique. |
| Database tables | `tbl_ledger`; related reads include `tbl_credit`, `tbl_final_hisab`, `tbl_master_transaction`, and `coin_transactions`. |
| External APIs | None. |
| Authentication/authorization | No action-level role or ownership guard was found. Admin/master distinctions are controller branches and view choices, not a centralized policy. |
| Side effects | Changing commercial terms can alter future transactions and, in report paths that join current ledger values, historical calculations. Transaction aggregates retain a partial snapshot of terms, so history has mixed temporal semantics. |
| Error handling | CodeIgniter form validation, redirects/flash messages, and `show_error` for missing records. Multi-record consequences are not reconciled. |

### 15.3 Shift definition and dated assignment

| Concern | Trace |
|---|---|
| Entry point | `tbl_shift/add`, `tbl_shift/add_admin`, `tbl_shift/add_master_submit`, and edit/delete URLs. |
| Controller/service | `Tbl_shift` calls `Tbl_shift_model` to create a base shift and a dated user assignment. |
| Business logic | `tbl_shift` defines the named shift; `user_shift_timings` assigns it to a user/master for an open date with web/app cutoffs. Current transaction and jantri screens generally submit the timing-row ID, while other paths use the base shift ID. |
| Database tables | `tbl_shift`, `user_shift_timings`; downstream references occur in `tbl_master_transaction`, `Tb_Date_shift_party_entry`, `tbl_openno`, and `coin_transactions`. |
| External APIs | None directly; app cutoffs govern external-app entry/delete behavior. |
| Authentication/authorization | Role-specific methods exist, but no consistent guard or ownership check protects IDs. |
| Side effects | Deleting a timing invokes a model transaction that also deletes its base `tbl_shift` row. If that base row is shared, other timings and historical references can be orphaned. |
| Error handling | Duplicate-name validation and success/error redirects. Creation of the base shift and timing is not consistently atomic. |

### 15.4 Normal wager transaction creation

| Concern | Trace |
|---|---|
| Entry point | `/transactions` -> `Tbl_transactions::indexmay`; its form posts to `Tbl_transactions::add_transaction_final_may`. Auxiliary number-entry forms are loaded through controller endpoints/XHR. |
| Controller/service | `Tbl_transactions` orchestrates `CoinModel`, `Tbl_ledger_model`, and `Tbl_transactions_model`; `crontoupdateclosing` also runs before the wager write. |
| Business logic | The controller sums submitted wager components, requires sufficient calculated coin balance, debits the party through a sentinel receiver, normalizes blank entries, computes number/akhar totals, snapshots ledger terms, and creates/updates the per-date/shift/party aggregate. |
| Database tables | `coin_transactions` and possibly `tbl_ledger.coin_balance`; `tbl_opening`; `tbl_master_transaction`; `tbl_trans_numbers`; `Tb_Date_shift_party_entry`; reads from `tbl_ledger`, prior settlement, vouchers/kist, shifts, and results. Legacy entry modes also target `tbl_trans_add`, `tbl_random_f4`, `tbl_trans_cross`, `tbl_trans_fromto`, `tbl_random_f8`, and `tbl_jantri`. |
| External APIs | None on the normal web path. |
| Authentication/authorization | Party, shift, master/updater, and date values are largely request-controlled. No object-ownership enforcement or CSRF protection was found. |
| Side effects | Coin usage is recorded before the transaction header/detail/aggregate writes; opening data can also be upserted. These are not wrapped in one database transaction. |
| Error handling | Insufficient balance stops submission; success uses flash/redirect. Later write failures do not roll back the prior coin debit or opening update. Input arrays and totals have limited structural validation. |

### 15.5 Jantri/cutting entry and submission

| Concern | Trace |
|---|---|
| Entry point | Jantri/cutting pages use GET filters and XHR `add_jantri`; the completed grid posts to `tbl_transactions/sendjantri`. |
| Controller/service | `Tbl_transactions::sendjantri` transforms grid keys into the standard transaction arrays, then reuses the transaction models/calculation flow. |
| Business logic | The party is forced to the current session user; coin balance is checked and coins are allocated to system receiver ID `1`. Grid positions become number/amount pairs and feed the same transaction header, detail, and aggregate tables. |
| Database tables | Same core tables as transaction creation, plus reads used to render cutting totals and results. |
| External APIs | None. Browser-side libraries provide the interactive grid. |
| Authentication/authorization | Safer than normal entry in that the party comes from session, but the action still lacks a common authentication guard and trusts submitted shift/date/grid data. |
| Side effects | Coin debit, opening recalculation/upsert, transaction insert, and aggregate insert/update. |
| Error handling | Balance/input failures return messages; success redirects. There is no encompassing transaction or retry/reconciliation mechanism. |

### 15.6 Transaction edit and deletion

| Concern | Trace |
|---|---|
| Entry point | Edit form posts to `/tbl_transactions/edit_transaction_final_master/{id}`; removal calls `Tbl_transactions::remove/{id}`. An external-app delete variant accepts both transaction and user IDs in the URL. |
| Controller/service | `Tbl_transactions` calls model edit/delete functions and coin-allocation reversal logic. |
| Business logic | Edit rewrites the master row and comma-separated number detail, then replaces aggregate totals for the party/shift/date. Delete subtracts the transaction totals from the aggregate, removes it at zero, and deletes master/detail rows. |
| Database tables | `tbl_master_transaction`, `tbl_trans_numbers`, `Tb_Date_shift_party_entry`, `coin_transactions`, and `tbl_opening`. |
| External APIs | The app variant redirects back to the external app and enforces an app cutoff from `user_shift_timings`. |
| Authentication/authorization | IDs are accepted directly without verified ownership. The app variant accepts a user ID from the URL. |
| Side effects | Delete attempts to reverse a shift-linked coin transaction. Edit does not reconcile the original coin debit when amount, party, shift, or date changes. Result exposure and settled history are not automatically rebuilt. |
| Error handling | Missing rows use `show_error`; invalid app input may emit JSON or JavaScript and exit. Delete operations and aggregate adjustment are not one transaction, and some failure branches print database diagnostics. |

### 15.7 Result/open-number publication and exposure calculation

| Concern | Trace |
|---|---|
| Entry point | `/openno` or `/openno_admin`; forms post to `tbl_openno/add`, `add_admin`, `edit`, or `edit_admin`. |
| Controller/service | `Tbl_openno` writes through `Tbl_openno_model`, then `insertresulttempmay`/edit variants calculate winning exposure through transaction models. |
| Business logic | One result is expected per owner/shift/date. For each party aggregate, comma-separated number bets are parsed and exact-number plus akhar/digit exposure is calculated. `00` has special normalization, including repeated-zero representations. Derived result amounts are written back to the aggregate. |
| Database tables | `tbl_openno`, `tbl_master_transaction`, `tbl_trans_numbers`, `Tb_Date_shift_party_entry`, `tbl_shift`, and `user_shift_timings`. |
| External APIs | None. |
| Authentication/authorization | Admin/non-admin branches choose different shift queries, but there is no common authorization or ownership policy. Duplicate scope includes `updated_by`, permitting distinct owners to publish separate rows for what may be the same business shift/date. |
| Side effects | Mutates derived winning exposure used by hisab and reports. It does not automatically rebuild every already-materialized `tbl_final_hisab` row. |
| Error handling | Invalid input may return JSON; duplicates trigger inline JavaScript and immediate termination; missing records use `show_error`. Result insert and exposure updates are not atomic. |

### 15.8 Daily hisab/opening roll-forward

| Concern | Trace |
|---|---|
| Entry point | `/updateopening` -> `Tbl_openno::updateopening`; form posts a target date. Transaction creation also calls `crontoupdateclosing` for a narrower opening update. |
| Controller/service | `Tbl_openno` processes ledgers in chunks and calls calculation helpers plus `Tbl_openno_model::updateopeningtbl`. |
| Business logic | Prior closing/opening is selected, with special first-of-month handling. Per-party wager totals are reduced by rounded commissions and number/akhar payouts; optional patti/hissa, vouchers, kist, TP and opening adjustments feed the final balance. The result is upserted per ledger/date. |
| Database tables | `tbl_final_hisab`, `tbl_opening`, `tbl_ledger`, `Tb_Date_shift_party_entry`, `tbl_master_transaction`, `tbl_trans_numbers`, `tbl_openno`, `tbl_voucher`, `tbl_kist`, and coin data. |
| External APIs | None. No confirmed scheduler invokes the web endpoint. |
| Authentication/authorization | The role/session ID changes which ledgers are selected, but the endpoint has no centralized privileged-action guard. |
| Side effects | Writes daily financial snapshots. After an update it calls `deactivate_shift_allocations`, which sets every active shift-linked coin allocation to inactive without scoping by processed user or date. |
| Error handling | Upsert provides partial idempotence per ledger/date, but there is no all-ledger transaction, job record, retry state, or reconciliation report. Overall success can depend on the last processed row. |

### 15.9 Coin and credit allocation

| Concern | Trace |
|---|---|
| Entry point | Coin forms post to `coins/allocate/process` or `processmaster`; ledger credit posts to `allocate_credit`. |
| Controller/service | `Coins` delegates to `CoinModel`; credit insertion is handled by `Tbl_ledger`. The global hook also calls `CoinModel` after controller construction. |
| Business logic | Allocation moves coin value between sender/receiver, with special system-ID behavior and deposit/withdrawal flags. Credit creates an allowance row. Multiple functions calculate balance from different combinations of mutable ledger balance, transaction flags, settlement, deductions, and different date windows. |
| Database tables | `coin_transactions`, `tbl_ledger`, `tbl_credit`, `tbl_final_hisab`, and shift/date references. |
| External APIs | None. |
| Authentication/authorization | The coin UI/process checks broad roles (`Super Admin`/`Master`), but object-level sender/receiver ownership is weak; credit creation has no equivalent robust policy. |
| Side effects | Mutable ledger balances and append-only-looking coin records are changed without locking. The request hook only refreshes session `coin_balance` from `tbl_ledger`; transaction admission uses another computed source. One master deposit branch assigns rather than increments a receiver balance. |
| Error handling | Controllers return JSON/flash messages, but multi-write operations lack database transactions and concurrent requests can lose updates or overspend. |

### 15.10 Voucher and kist adjustments

| Concern | Trace |
|---|---|
| Entry point | CRUD forms/routes under `tbl_voucher` and `tbl_kist`. |
| Controller/service | Thin controllers validate and call their models; settlement controllers/models later consume the rows. |
| Business logic | A voucher moves an amount from `PartyId` to `Collect_By` for a date. Kist stores a party, date range, total/days, and daily amount; settlement applies it according to the date path in use. |
| Database tables | `tbl_voucher`, `tbl_kist`, `tbl_ledger`; downstream `tbl_final_hisab` and report queries. |
| External APIs | None. |
| Authentication/authorization | No common guard or ownership enforcement. |
| Side effects | CRUD itself does not trigger recomputation/invalidation of existing opening or final-hisab snapshots, so backdated edits can silently make stored balances stale. |
| Error handling | Form validation and redirect/flash handling; no dependency warning, recalculation queue, or audit workflow. |

### 15.11 Statements and reports

| Concern | Trace |
|---|---|
| Entry point | Routes include `statement/{id}`, `user_hisab`, `ledger_till_date_report(s)`, search endpoints, and app-specific report URLs. |
| Controller/service | Mostly `Tbl_openno` plus a ledger app statement method; large controller methods combine queries, calculations, and view preparation. |
| Business logic | Reports combine coin movement, daily P/L, opening/final balances, results, voucher/kist, commissions, TP, and ledger hierarchy. Admin/master/agent paths use different filters and sometimes different formulas. |
| Database tables | Nearly all financial tables, especially `coin_transactions`, `tbl_final_hisab`, `tbl_opening`, `Tb_Date_shift_party_entry`, `tbl_openno`, `tbl_ledger`, `tbl_voucher`, and `tbl_kist`. |
| External APIs | App-specific views are reached by external-domain links; browser export/share libraries may load from CDNs. |
| Authentication/authorization | Statement IDs and report filters are accepted directly. Some app reports render with `layouts/main_login`, and no signed link or ownership check was found, creating likely information-disclosure risk. |
| Side effects | Primarily read-only, although controller-calculation reuse and debug branches make that boundary unclear. |
| Error handling | Empty results are mostly handled in views. Some active-looking code retains `echo`, `last_query`, `print_r`, and `die`, which can expose internals or truncate output. |

### 15.12 External app handoff

| Concern | Trace |
|---|---|
| Entry point | App transaction methods and app delete/report routes; server responses issue browser redirects to configured 555xch app/check hosts. |
| Controller/service | `Tbl_transactions` and `Tbl_openno`; there is no dedicated integration client. |
| Business logic | Entry data and identifiers are passed through query strings; shift app-time controls whether some modifications are allowed. |
| Database tables | Same transaction, shift timing, coin, aggregate, result, and report tables as web workflows. |
| External APIs | Browser redirect/query-string contract only; no authenticated server-to-server API client was found. |
| Authentication/authorization | No request signing, nonce, shared-secret validation, or ownership verification was found in the inspected endpoints. Some user identifiers arrive in URLs. |
| Side effects | External pages can initiate or revisit local financial workflows; URL data may be retained in history, logs, and referrers. |
| Error handling | JavaScript alerts, redirects, history navigation, and immediate exits form the protocol. There is no typed/versioned contract or structured retry behavior. |

## 16. Cross-module invariants and accidental-breakage map

1. **Shift identity is polymorphic.** `tbl_shift.id` is the base definition, while `user_shift_timings.id` is a dated assignment. The generic field names `shift`, `shift_id`, and `ShiftId` are used for both. A join that selects the wrong identity can hide transactions/results, apply the wrong cutoff, or corrupt settlement totals.
2. **The aggregate is derived but treated as authoritative.** `Tb_Date_shift_party_entry` summarizes transaction totals, snapshots selected ledger terms, and later stores winning exposure. All transaction create/edit/delete and result create/edit paths must keep it synchronized.
3. **Coin charge must equal the accepted wager.** Creation charges before core inserts, edit does not adjust charge, and delete reverses through a separate lookup. Any change to totals, party, date, or shift needs explicit coin reconciliation and idempotency.
4. **Results are upstream of settlement snapshots.** Changing a result changes exposure, which changes hisab. Existing `tbl_final_hisab`/`tbl_opening` rows are not universally invalidated or rebuilt.
5. **Commercial terms have unclear effective dates.** A transaction copies rates/commissions into the aggregate, but several reports/settlement paths join live `tbl_ledger` terms. Editing a ledger can therefore change some historical views but not others.
6. **Voucher/kist are retroactive inputs.** Backdated CRUD changes calculated balances without automatically refreshing stored daily snapshots.
7. **There are multiple coin sources of truth.** `tbl_ledger.coin_balance`, filtered sums of `coin_transactions`, settlement-adjusted helper formulas, and session `coin_balance` do not share one invariant or cutoff.
8. **Daily closing affects coin allocation globally.** `deactivate_shift_allocations()` updates all active shift-linked allocations, so closing one user's date can change availability/reversal behavior for unrelated users and dates.
9. **User ID `1` has domain semantics.** It is used as an administrator/system actor and special receiver, with bypass/synthetic-balance behavior. Reassigning or deleting it would affect authentication, allocation, reports, and jantri.
10. **Ownership is encoded indirectly.** `updated_by`, `master_id`, `is_master`, agent links, and session `id`/`userid` act as a tenancy boundary. Inconsistent use produces cross-master visibility or mutation.
11. **Date format and day-boundary choices are contractual.** Tables and queries mix `Y-m-d`, `d-m-Y`, timestamps, midnight, and 06:00 cutoffs. Mechanical normalization would change financial results unless the business-day rule is first specified.
12. **Number details are positional serialized data.** `tbl_trans_numbers` stores comma-separated number and amount lists. Array filtering, reindexing, delimiter changes, or partial edits can silently misalign pairs.
13. **Rounding is part of the ledger contract.** Commission and payout paths use `ceil` in important places. Refactoring order-of-operations or aggregation level changes balances.
14. **`00` is a special value, not an ordinary integer zero.** Result and exposure logic maps zero representations deliberately. Numeric coercion or validation changes can break payouts.
15. **Navigation roles are not security controls.** Adding/removing menu items does not protect controllers. Every new mutation/report needs server-side authentication, role, and ownership checks.
16. **Archived copies resemble active code.** Several dated/back/new controllers and models contain near-identical methods. Routes currently point to the canonical files; fixes made only in an archive have no effect, while accidentally routing to one can resurrect obsolete formulas.
17. **External app URLs are an undocumented public contract.** Renaming parameters, changing shift ID semantics, or tightening session assumptions can break the app integration; leaving it unchanged preserves unsigned-ID risks.

## 17. Important findings added by the second pass

- The global hook does not calculate or persist canonical coin balance; it mirrors `tbl_ledger.coin_balance` into the session, while admission checks use another formula.
- Closing a date globally deactivates active shift-linked coin allocations rather than scoping the change to the processed ledger/date.
- Transaction edit can change wager value without reconciling coin usage; delete attempts a reversal but is not atomic with transaction/aggregate deletion.
- Shift deletion can remove the shared base shift along with one timing assignment.
- Result uniqueness is owner-scoped, while settlement joins do not consistently preserve that same ownership dimension.
- Current and historical commercial-rate semantics are mixed because aggregates snapshot terms but other queries use the live ledger row.
- Backdated voucher, kist, transaction, and result changes do not consistently invalidate materialized opening/final balances.
- Several balance helpers include manual date-specific corrections and competing cutoff windows; these should be treated as undocumented production patches until reconciled.
- The external app integration is an unsigned browser redirect/query-string protocol, not a formal API client.
- App statements/report endpoints appear capable of rendering financial data from URL identifiers without a verified object-level authorization boundary.

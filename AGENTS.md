# AGENTS.md

## Project overview

This repository is a CodeIgniter 3.1.3 PHP/MySQL application for ledger-managed number wagering. Core features are ledger/master/party management, dated shifts, wager and jantri entry, result publication, daily hisab/opening balances, coins/credit, vouchers/kist, and financial reports.

Read `PROJECT_KNOWLEDGE_REPORT.md` before changing financial, authentication, database, or deployment behavior. Treat confirmed source behavior as authoritative when it differs from naming or comments.

## Architecture

- Apache front controller: `index.php`; routing: `application/config/routes.php`.
- MVC code: `application/controllers`, `application/models`, and `application/views`.
- MySQL access uses CodeIgniter's `mysqli` driver and is configured in `application/config/database.php`.
- Views are server-rendered PHP, normally selected through `_view` and wrapped by `layouts/main` or `layouts/main_login`.
- Frontend code is legacy jQuery/Bootstrap-era JavaScript embedded largely in views. There is no npm build.
- `application/config/hooks.php` runs a post-controller-constructor balance hook from `application/helpers/comman_helper.php`.
- Controllers frequently contain orchestration and business calculations; there is no dependable service layer.
- Files with names such as `*_back`, `*back`, `*_new`, or embedded dates are archival unless an active route explicitly references them.

## Development commands

Run from the repository root in PowerShell.

```powershell
# Serve through the existing XAMPP Apache/MySQL installation.
# Expected local path: http://localhost/r9/m5/

# Check one PHP file.
php -l application/controllers/Tbl_transactions.php

# Lint active PHP source; exclude archive copies if they are outside the task.
Get-ChildItem application -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }

# Review scope and whitespace before handoff.
git status --short --branch
git diff --check
git diff
```

Do not use PHP's built-in server as proof that Apache rewriting or `.htaccess` behavior works.

## Testing

- There is no automated test suite or CI pipeline in this repository.
- At minimum, lint every changed PHP file and run `git diff --check`.
- For behavioral changes, manually exercise the affected route through XAMPP using a non-production database.
- Financial changes require before/after examples covering create, edit, delete, recalculation, and report output.
- For transaction/result work, test ordinary numbers, `00`, akhar, rounding, insufficient coins, duplicate results, and backdated changes.
- Never use production data or invoke production-like cron/closing routes merely to test code.

## Important directories

- `application/config/`: routes, database, hooks, sessions, security, and environment behavior.
- `application/controllers/`: HTTP entry points and much of the workflow orchestration.
- `application/models/`: SQL and persistence logic.
- `application/views/`: PHP templates plus substantial browser JavaScript.
- `application/helpers/`: shared calculations and request-wide balance behavior.
- `application/core/`: custom CodeIgniter base classes, if used.
- `system/`: vendored CodeIgniter framework; do not modify without explicit approval.
- `assets/`: browser assets; confirm whether a file is local or CDN-backed before replacing it.

## Coding conventions

- Preserve CodeIgniter 3 controller/model naming and existing route conventions.
- Keep compatibility with the production PHP 7.4-era target; do not introduce PHP 8-only syntax without approval.
- Use CodeIgniter input, validation, session, URL, database, and view helpers consistently.
- Prefer query-builder conditions or bound parameters. Do not concatenate request values into SQL.
- Escape user-controlled output in HTML, JavaScript, attributes, and URLs.
- Keep changes narrow. Do not combine feature work with archive cleanup, formatting sweeps, or framework modernization.
- Add comments for business rationale and invariants, not line-by-line mechanics.
- Do not copy fixes into similarly named archival controllers/models unless they are proven active.

## Git workflow and `result9` rules

- `result9` is the active project branch and tracks `origin/result9`.
- Before editing or committing, verify the current branch with `git status --short --branch`.
- Keep requested work on `result9`. Do not switch, merge, rebase, reset, force-push, or synchronize with `main` unless the user explicitly requests it.
- Do not assume `main` remains identical to `result9`; compare commits before porting changes.
- Never commit secrets, database exports, runtime logs, generated archives, or unrelated local changes.
- Preserve user changes in a dirty worktree. Stage only files belonging to the requested task.
- Use focused commits with a clear reason and affected workflow. Do not commit or push unless asked.

## Files requiring special care

- `application/controllers/Tbl_transactions.php`: wager creation/edit/delete, jantri, coin charging, opening updates, and external-app handoff.
- `application/controllers/Tbl_openno.php`: results, exposure, reports, and daily hisab/opening workflows.
- `application/models/Tbl_transactions_model.php`: transaction details and `Tb_Date_shift_party_entry` synchronization.
- `application/models/Tbl_openno_model.php`: settlement/report queries and mixed date/shift joins.
- `application/models/CoinModel.php`: competing balance formulas and non-atomic transfers.
- `application/models/Tbl_shift_model.php`: base-shift versus dated-timing identity and deletion behavior.
- `application/helpers/comman_helper.php`: shared financial formulas, cutoffs, manual corrections, and global allocation deactivation.
- `application/config/{database,config,routes,hooks}.php`, `.htaccess`, and `index.php`: environment, routing, session, and deployment boundaries.

When changing these files, trace the complete workflow and every affected derived table before editing.

## Financial and database invariants

- `tbl_shift.id` and `user_shift_timings.id` are different identities despite generic `shift_id`/`ShiftId` names. Confirm which one each path expects.
- Keep `tbl_master_transaction`, `tbl_trans_numbers`, and `Tb_Date_shift_party_entry` synchronized across create, edit, and delete.
- Coin charge/reversal must equal the accepted wager and must be idempotent. Editing currently does not reliably reconcile coins.
- Result exposure feeds hisab. Result changes can invalidate `Tb_Date_shift_party_entry`, `tbl_opening`, and `tbl_final_hisab`.
- Backdated voucher, kist, transaction, or result changes can invalidate stored balances.
- Preserve `ceil` rounding, special `00` handling, and aligned comma-separated number/amount arrays unless a written business rule changes them.
- Do not normalize dates mechanically. The code mixes `Y-m-d`, `d-m-Y`, midnight, and 06:00 business cutoffs.
- Treat `updated_by`, `master_id`, agent links, and session `id`/`userid` as tenancy/ownership fields.
- System user ID `1` and other magic IDs have business meaning. Do not renumber or generalize them without a migration and compatibility plan.
- Use database transactions and locking for new multi-write financial operations. Do not expand existing partial-write behavior.

## Security rules

- Never print, copy, document, commit, or place in logs any password, API key, token, private key, cookie, DSN, or credential value.
- Do not weaken authentication, session, CSRF, authorization, or ownership checks to preserve a legacy UI flow.
- Navigation visibility is not authorization. Enforce authentication, role, and object ownership in controllers/services.
- Do not add plaintext or MD5 password handling. New password changes must use supported password hashing and a migration strategy.
- Treat all URL, form, query-string, session, and external-app values as untrusted.
- Do not expose SQL errors, last queries, stack traces, or internal paths to users.
- External app redirects and report URLs are unsigned legacy contracts. Do not add sensitive data to their query strings.

## Database and configuration rules

- No reliable migrations/schema are present. Do not infer columns or constraints from names alone; confirm every schema assumption.
- Do not run schema changes, destructive SQL, closing jobs, reconciliation jobs, or data fixes without explicit approval and a backup/rollback plan.
- Never connect to or mutate a production database during development or testing.
- Do not hardcode environment-specific hosts, domains, credentials, filesystem paths, or feature flags in controllers/views.
- Keep secrets outside version control and provide only redacted/example configuration when documentation is required.
- Preserve environment-specific configuration unless the task explicitly includes deployment changes.
- Any new schema change must include a reversible migration plan, indexes/constraints, affected-query review, and rollout/backfill notes.

## Deployment warnings

- Deployment appears to be direct Apache/PHP hosting; no automated release or rollback pipeline is documented.
- Validate Apache rewriting, PHP compatibility, database connectivity, sessions, filesystem permissions, and external redirects in the target environment.
- Do not edit production configuration in place or treat a Git pull as a complete deployment procedure.
- Cron/background scheduling is unconfirmed. Web-accessible closing/update routes may have broad financial side effects; never invoke them casually.
- Changes to routes, `.htaccess`, external-domain parameters, shift IDs, date cutoffs, or session keys may break the external app and historical reports.
- Require a database backup, reconciliation plan, smoke checks, and rollback steps before deploying financial or schema changes.

# Current Master Coin System

Prepared: 3 October 2026  
Portal reviewed: C:/xampp/htdocs/m5/m5 (CodeIgniter 3)

## 1. Purpose and verification scope

This document explains the coin system currently implemented in the master portal: login, Super Admin funding recognition, party deposits and withdrawals through /ledger, balance calculations, and related transaction flows.

Business rule supplied by the owner: a master receives coins from only two sources: Super Admin funding through another portal, and withdrawal of coins from the master's parties. Allocating coins to a party must reduce the master's available coins; withdrawing coins from a party must increase them.

The descriptions below distinguish that intended rule from actual source behavior. Local routes, controllers, models, helpers, and views were reviewed. No live database records, browser transactions, or other portal implementation were verified. Existing project Markdown contained no coin-process documentation. Only this document was added; application behavior was not changed.

The IDE file C:/Users/Administrator/AppData/Local/Temp/fz3temp-2/Tbl_transactions 2.php was also inspected. Its coin-related calls match the workspace controller; the two differences after trimming individual lines are extra role arguments in shift-list calls at lines 67 and 75. The workspace is the source for this document.

## 2. Business process

| Operation | Direction | Expected master effect | Expected party effect |
| --- | --- | --- | --- |
| Super Admin funds master | Super Admin → Master | Increase | None |
| Deposit / allocate from /ledger | Master → Party | Decrease | Increase |
| Withdraw from /ledger | Party → Master | Increase | Decrease |

The expected master balance is:

    Super Admin coins received + party withdrawals received − coins allocated to parties

Example: Super Admin gives 1,000 coins. Master deposits 300 to Party A, leaving 700. Master withdraws 100 from Party A, giving the master 800 and Party A 200, before any party game/P&L adjustments.

The master header implements this formula. Other checks and stored balance updates do not consistently implement it; see section 10.

## 3. Account identity, creation, and login

- Master and party account records are held in tbl_ledger. The master role is derived from a nonempty is_master value; login requires status = 1.
- A party belongs to the master whose ledger ID is stored in the party's updated_by field.
- The default portal route and /master_login call Dashboard::master_login(). Users_model::master_login() checks the supplied username and password against tbl_ledger and sets role to Master or Staff according to is_master.
- Successful login stores the ledger ID as session id and userid, sets authenticated, and initially loads session coin_balance from tbl_ledger.coin_balance.
- Login itself does not grant coins or require a positive coin balance.
- The reviewed /ledger creation action creates a party with updated_by equal to the logged-in master, accepts a posted coin_balance, inserts tbl_ledger, and creates a final_ledger row. It does not create a coin_transactions funding entry or debit the master for that initial value.
- Creation of the master account by the separate Super Admin portal was outside the available source scope. No automatic master signup grant is established by this review.

Sources: application/config/routes.php:4–6; application/controllers/Dashboard.php:97–128; application/models/users_model.php:71–95; application/controllers/Tbl_ledger.php:123–168; application/models/Tbl_ledger_model.php:1042–1067.

## 4. Tables used

| Table | Role in this portal |
| --- | --- |
| tbl_ledger | Master/party identity, ownership via updated_by, stored coin_balance, and coin_balance_before used by another transaction path |
| coin_transactions | Coin movement history: sender_id, receiver_id, amount, type, status, created_at, shift_id, deposite_byto_master |
| tbl_final_hisab | Daily account calculation; today_hisab is used in party balance calculations, with date parsed as DD-MM-YYYY |
| tbl_credit | Separate party credit setting; latest record by ID is displayed on /ledger |
| tbl_master_transaction | Game transaction summary; latest t_date supplies the /ledger transaction-date column, and some transaction rows reference coin_id |
| final_ledger | A row is created for a new party; this is not the coin-movement history |

Keep the actual field spelling deposite_byto_master when inspecting records.

## 5. Recognition of Super Admin funding

The master header treats all coin_transactions rows with receiver_id equal to the master ID and deposite_byto_master = 0 as received funding. It sums amount without checking sender identity, type, status, or date.

This means an update to tbl_ledger.coin_balance alone can change the stored/session balance but will not change the master header or the /ledger allocation check. For consistent recognition here, external funding must also have the corresponding coin_transactions record with the master as receiver and the expected flag.

This is the receiving portal's contract inferred from its queries. The separate portal's actual inserts and schema defaults were not inspected.

A generic allocation path also exists locally: /coins/allocate/process → Tbl_coin::processAllocation() → CoinModel::allocateCoins(). It permits Super Admin or Master roles, adds to the receiver's stored ledger balance, and inserts a transaction with type = allocation. Sender ID 1 bypasses the sender balance limit/debit. This insert does not explicitly provide deposite_byto_master, status, shift_id, or created_at; their effective values depend on database defaults. Its presence does not prove how the separate funding portal works.

Sources: application/helpers/comman_helper.php:92–123; application/controllers/Tbl_coin.php:345–375; application/models/CoinModel.php:268–301.

## 6. Deposit / allocate coins from /ledger

### Screen and request

/ledger → Tbl_ledger::add() → application/views/tbl_ledger/add.php.

Each account row exposes Deposit and Withdraw actions. The Deposit modal posts to /coins/allocate/processmaster, routed to Tbl_coin::processAllocationMaster(), with:

| Request field | Value |
| --- | --- |
| receiver_id | Selected party ledger ID |
| amount | Number of coins |
| transactiontype | D |

The master ID is taken from the session. The amount is cast to an integer. Missing fields or a nonpositive amount are rejected with a browser alert.

### Balance check and writes

1. Sum incoming master transactions with deposite_byto_master = 0.
2. Subtract outgoing master transactions with deposite_byto_master = 1.
3. Reject if that result is less than the deposit amount. This check does not include withdrawals returned by parties and does not filter type/status/date.
4. Set the party's tbl_ledger.coin_balance to the entered amount. This is an overwrite, not an increment.
5. Insert the following history row:

| Field | Deposit value |
| --- | --- |
| sender_id | Master ledger ID |
| receiver_id | Party ledger ID |
| amount | Entered positive integer |
| type | allocation |
| deposite_byto_master | 1 |
| status | 1 |
| created_at | Current PHP date/time |

The master stored tbl_ledger.coin_balance is not debited in this branch. The master header decreases because the newly inserted allocation is subtracted by its helper. The party's history-derived balance increases because it receives the transaction.

If insertion succeeds, the controller alerts Transaction successful and redirects to /ledger. If it fails, it alerts Transaction failed and returns to the previous page. The ledger update happens before the insert and is not wrapped in a database transaction here.

Sources: application/config/routes.php:13,99; application/views/tbl_ledger/add.php:388–412,587–598; application/controllers/Tbl_coin.php:247–296,335–341.

## 7. Withdraw coins from a party

The Withdraw modal posts to the same /coins/allocate/processmaster endpoint with receiver_id = selected party, amount, and transactiontype = W. Despite the field name receiver_id, the selected party becomes the sender for withdrawal.

1. Validate positive integer amount and required fields.
2. Call get_client_coin_balance(party ID); reject if it is below the amount.
3. Fetch the party ledger and perform a second balance check using CoinModel::get_coin_balance(party ID). Reject if the ledger is missing or this second result is insufficient.
4. Subtract the amount from the party's stored tbl_ledger.coin_balance.
5. Add the amount to the master's stored tbl_ledger.coin_balance.
6. Insert the history row:

| Field | Withdrawal value |
| --- | --- |
| sender_id | Party ledger ID |
| receiver_id | Master ledger ID |
| amount | Entered positive integer |
| type | spend |
| deposite_byto_master | 1 |
| status | 1 |
| created_at | Current PHP date/time |

The master header increases from the recorded withdrawal. The party history-derived balance decreases from the active spend row. Success/failure feedback follows the same alert/redirect behavior as Deposit.

Neither balance check directly verifies the party's stored coin_balance is sufficient, even though the subsequent subtraction modifies that stored column. There is no database transaction or concurrent balance lock in this handler.

Sources: application/views/tbl_ledger/add.php:620–630; application/controllers/Tbl_coin.php:297–341.

## 8. Which balance is actually used?

### Master header balance

layouts/main.php calls get_master_coin_balance(session id) and displays its result as Balance: ... coins.

    SUM(incoming with flag 0)
    + SUM(incoming with flag 1 and type spend)
    − SUM(outgoing with flag 1 and type allocation)

There are no status or date filters in these sums. This balance is not read from tbl_ledger.coin_balance.

### Stored/session coin balance

CoinModel::getUserBalance() returns tbl_ledger.coin_balance. Login loads it into the session. An enabled post_controller_constructor hook refreshes the session from this stored value for logged-in IDs other than 1. This refresh does not reconcile the stored value with coin history or the header balance.

### Available party balance on /ledger

Tbl_ledger_model::getledgercreditdebit_with_coin_balance() selects accounts with updated_by = session id; its status filter is commented out. It calculates:

    Incoming coin amounts − active outgoing spend amounts − SUM(today_hisab)

Coin range: 1 August 2025 at 12:00 inclusive to tomorrow at 06:00 exclusive. Hisab dates run from 1 August 2025 inclusive through today's date. Incoming transactions are counted regardless of status; outgoing rows require type = spend and status = 1. A negative today_hisab increases the result; a positive one reduces it. The query does not add stored coin_balance or openingbalance to this result.

### First withdrawal check: get_client_coin_balance()

This helper calculates:

    Incoming amounts − active outgoing spend amounts − SUM(today_hisab)
    − active outgoing shift allocation amounts with deposite_byto_master = 0

Its coin range starts at the literal 2025-08-01 (midnight) and ends before tomorrow at 06:00. Its hisab range starts on that same date and ends before tomorrow's date. The extra allocation deduction requires shift_id IS NOT NULL, type = allocation, and status = 1.

Consequently this check can be lower than the /ledger Available Balance, which omits the extra shift allocation deduction. The two start times also differ.

### Second withdrawal check: CoinModel::get_coin_balance()

    All-time incoming coin amounts − current-calendar-month SUM(today_hisab)

It does not subtract prior outgoing spend/withdrawals or apply a transaction status filter. This formula also checks some game/Jantri operations.

Sources: application/views/layouts/main.php:34–35,59; application/helpers/comman_helper.php:22–39,92–123,185–256; application/models/CoinModel.php:56–98; application/models/Tbl_ledger_model.php:312–498; application/config/hooks.php:15–20; application/config/config.php (enable_hooks).

## 9. Credit settings, statements, and other coin activity

### Separate credit setting

The credit edit flow posts to /allocate_credit. Tbl_coin::allocateCredits() inserts party_id, master_id, credit_balance, and credit_type = 1 into tbl_credit through CoinModel::insertOrUpdateCredit(). Despite that method's name, it always inserts. /ledger shows the latest record by ID.

This action does not fund the master, create a coin movement, or update stored coin balances. The /ledger P/L display is calculated as latest credit_balance minus the calculated available coin balance; it is distinct from directly displaying today_hisab.

### Statements

The party row links to /statement/{party ID}, with start_date = 2025-08-01 and end_date = today. The route maps to Tbl_openno::statement(). Tbl_openno_model::get_coin_statement() builds incoming, active outgoing spend, P/L, and running-balance rows. Its selected coin window begins at noon on the start date and ends before 06:00 the day after the end date.

This builder starts its running balance at zero for the selected range, and it does not include the separate shift allocation deduction used by get_client_coin_balance(). It is a party-oriented statement formula; it should not be assumed to reconcile the master's header because outgoing master allocation rows are excluded by its query.

### Game and Jantri paths also affect coins

The current application has coin operations beyond the two business funding sources:

- Tbl_transactions::add_transaction_final_app() checks get_client_coin_balance(), then calls allocateCoinsapp(party, posted updated_by, amount, shift). That model logs a shift-linked allocation and records the sender's coin_balance_before; direct sender/receiver coin_balance updates are commented out. Its own approval still uses the sender's stored balance.
- Tbl_transactions::sendjantri() sends coins from the master to account ID 1 through allocateCoins(). For a replacement Jantri, it charges only the increase in amount; a reduction returns the difference from ID 1 to the master. The local sendjantri flow uses a database transaction and named lock.
- Jantri_cron and Jantri_schedule also call allocateCoins(master, 1, amount).
- allocateCoins() debits the non-ID-1 sender's stored balance, credits the receiver's stored balance, and logs type = allocation. It does not explicitly set the classification flag/status/date fields described in section 5.

A Jantri reduction therefore creates a refund credit in current code, in addition to the stated two ordinary funding sources. Whether that refund is included as flag-0 income in the master header depends on the database default for deposite_byto_master. Game allocations sent to a master could likewise be included by the broad flag-0 receiver query if they have that default. These effects require schema and record verification; they are not confirmed live funding behavior.

Sources: application/controllers/Tbl_coin.php:16–37; application/models/CoinModel.php:25–38,222–301; application/views/tbl_ledger/add.php:339–345; application/models/Tbl_openno_model.php:139–260; application/controllers/Tbl_transactions.php:238–268,640–679; application/controllers/Jantri_cron.php:161–185; application/controllers/Jantri_schedule.php:240–246.

## 10. Current implementation differences from the business rule

| Finding | Actual consequence from the reviewed code |
| --- | --- |
| Deposit approval omits returned party withdrawals | Header may show spendable coins while a deposit is rejected. Example: funding 1,000, allocation 1,000, withdrawal 200 gives header 200 but deposit check 0. |
| Deposit overwrites party stored coin_balance | After deposits 300 and 100, that column becomes 100, while history records 400 before other adjustments. |
| Deposit does not debit master stored coin_balance | Session/model balance can differ from the decreasing master header. |
| Withdrawal uses two different party formulas | An amount can pass the first check and fail the second; neither check establishes a sufficient stored balance. |
| Party display omits helper's shift allocation deduction | The Available Balance shown on /ledger can differ from the first withdrawal check. |
| Master queries do not filter status | Inactive coin history rows still affect the header and deposit limit. |
| External ledger-only funding is insufficient for history calculations | Stored/session balance can increase while header and deposit limit do not. |
| Party creation accepts an initial stored coin value without a transfer | Initial stored coins are not backed by a master debit/history entry in this action. |
| Master transfer handler has no atomic transaction/lock | Ledger updates can remain if history insertion fails; concurrent requests can pass the same balance check. |
| processAllocationMaster has no explicit authentication/role/party-ownership check | The reviewed handler itself does not enforce that the posted party belongs to the session master; screen filtering is not an endpoint ownership check. Global/server protections were not verified. |
| Remarks are read but not saved | The handler defaults remarks to Cash transaction but does not include remarks in the inserted history row. |
| Generic and Jantri allocation inserts omit classification fields | Header recognition depends on database defaults; not every allocation record necessarily means master-to-party deposit. |

These are documented findings, not changes made by this task. The portal currently has several competing balance definitions rather than one consistently maintained coin balance.

## 11. Verification needed for a live reconciliation

To establish that the deployed system follows the required two-source rule, compare the master's tbl_ledger.coin_balance against its coin_transactions rows and the header formula. Confirm the other portal writes the expected funding history, inspect defaults for deposite_byto_master/status/created_at/shift_id, and trace actual deposit, withdrawal, game, and Jantri refund records. For parties, also reconcile tbl_final_hisab.today_hisab and the differing date ranges above.

No production transaction was executed, and no master or party account balance was changed during this documentation task.

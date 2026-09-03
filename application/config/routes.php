<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['check_logs'] = 'dashboard/show_logs';
$route['default_controller'] = 'dashboard/master_login';
$route['admin_login'] = 'dashboard/admin_login';
$route['master_login'] = 'dashboard/master_login';
$route['staff_login'] = 'dashboard/staff_login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'dashboard/logout';
$route['dashboard'] = 'dashboard/dashboard';
$route['agent_master'] = 'Tbl_agent/add';
$route['ledger'] = 'Tbl_ledger/add';
$route['ledger1'] = 'Tbl_ledger/add1';
$route['ledger2'] = 'Tbl_ledger/add2';
$route['ledger3'] = 'Tbl_ledger/add3';
$route['ledger4'] = 'Tbl_ledger/add4';
$route['ledger5'] = 'Tbl_ledger/add5';
$route['admin'] = 'Tbl_ledger/add_admin';
$route['master_commission'] = 'Tbl_ledger/master_comm_index';

$route['edit_admin'] = 'Tbl_ledger/edit_admin';
$route['getagentledger'] = 'Tbl_ledger/getagentledger';
$route['shift_master'] = 'Tbl_shift/add';
$route['shift_master_admin'] = 'Tbl_shift/add_admin';
$route['shift_edit_admin'] = 'Tbl_shift/edit_admin';
$route['staff_master'] = 'Tbl_staff/add';
$route['admin_master'] = 'Tbl_admin/add';
$route['transactions'] = 'Tbl_transactions/indexmay';
$route['transactionsmay'] = 'Tbl_transactions/indexmay';
$route['view_transactions'] = 'Tbl_transactions/view';
$route['view_transactions_admin'] = 'Tbl_transactions/view_admin';
$route['view_transactions_details'] = 'Tbl_transactions/view_details';
$route['addtrnback'] = 'Tbl_transactions/addtrnback';
$route['add_transactions'] = 'Tbl_transactions/add_trn';
$route['add_transaction_final'] = 'Tbl_transactions/add_transaction_final';
$route['add_transaction_final_may'] = 'Tbl_transactions/add_transaction_final_may';
$route['edit_transaction'] = 'Tbl_transactions/edit_trn';
$route['update_transactions'] = 'Tbl_transactions/update_trn';
$route['add_randomf4'] = 'Tbl_transactions/add_randomf4';
$route['update_randomf4'] = 'Tbl_transactions/update_randomf4';
$route['add_cross'] = 'Tbl_transactions/add_cross';
$route['update_cross'] = 'Tbl_transactions/update_cross';
$route['add_fromto'] = 'Tbl_transactions/add_fromto';
$route['update_fromto'] = 'Tbl_transactions/update_fromto';
$route['random_f8'] = 'Tbl_transactions/random_f8';
$route['update_random_f8'] = 'Tbl_transactions/update_random_f8';
$route['jantri'] = 'Tbl_jantri/index';
$route['add_jantri'] = 'Tbl_jantri/add';
$route['viewjantri'] = 'Tbl_jantri/view_jantri';
$route['view_jantri_total'] = 'Tbl_jantri/view_jantri_total';
$route['view_jantri'] = 'Tbl_jantri/view_jantri_intotal';
$route['partyjantri'] = 'Tbl_jantri/partyjantri';
//$route['cutjantri'] = 'Tbl_jantri/cutjantri';
$route['cutjantriold'] = 'Tbl_jantri/cutjantritemp';
$route['cutjantri'] = 'Tbl_jantri/cutjantrinew';
$route['partyjantri'] = 'Tbl_jantri/partyjantri';
$route['openno'] = 'Tbl_openno/add'; 
$route['openno_admin'] = 'Tbl_openno/add_admin';
$route['openno_edit_admin'] = 'Tbl_openno/edit_admin';
$route['view_all_result'] = 'Tbl_openno/view_all_result';
$route['user_hisab'] = 'Tbl_openno/final_ledger_report';
$route['users_hisab'] = 'Tbl_openno/final_ledger_reports';
$route['user_hisab_agent'] = 'Tbl_openno/final_ledger_report_agent';
$route['user_hisab_master'] = 'Tbl_openno/final_ledger_report_agent_master';
$route['statement/(:num)'] = 'Tbl_openno/statement/$1';
//$route['user_hisab'] = 'Tbl_openno/user_hisab';
$route['search_final_ledger'] = 'Tbl_openno/search_final_ledger';
$route['search_final_ledger_agent'] = 'Tbl_openno/search_final_ledger_agent';
$route['voucher'] = 'Tbl_voucher/add';
$route['kist'] = 'Tbl_kist/add';
$route['ledger_report'] = 'Tbl_openno/ledger_report';
$route['crontoupdateclosing'] = 'Tbl_openno/crontoupdateclosing';
$route['ledger_till_date_report'] = 'Tbl_openno/ledger_till_date_report';
$route['ledger_till_date_reports'] = 'Tbl_openno/ledger_till_date_reports';
$route['ledger_till_date_reports_app'] = 'Tbl_openno/ledger_till_date_reports_app';
$route['ledger_till_date_reporttemp'] = 'Tbl_openno/ledger_till_date_reporttemp';
$route['final_ledger_reporttemp'] = 'Tbl_openno/final_ledger_reporttemp';
$route['cron_mail'] = 'Tbl_openno/cron_mail';
$route['updateopening'] = 'Tbl_openno/updateopening';
$route['updateopening_admin'] = 'Tbl_openno/updateopening_admin';
$route['updateopeningon1st'] = 'Tbl_openno/updateopeningon1st';
// Master Commission Till Date Report
$route['master_comm_till_date/(:num)'] = 'Tbl_openno/master_commission_report/$1';

/*set new shift timings */
$route['load-shift-form/(:num)'] = 'ShiftController/load_shift_form/$1';
$route['create-or-update-shift'] = 'ShiftController/create_or_update_shift';
$route['edit-shift-time'] = 'ShiftController/edit_shift_time';
$route['select-shift'] = 'ShiftController/select_shift';

// AddCoin routes
$route['coins/allocate'] = 'Tbl_coin/allocateCoins';      // View allocation page
$route['coins/allocate/process'] = 'Tbl_coin/processAllocation'; // Process coin allocation
$route['coins/allocate/processmaster'] = 'Tbl_coin/processAllocationMaster'; // Process coin allocation
$route['coins/balance'] = 'Tbl_coin/viewBalance';        // View coin balance

// credit routes
$route['allocate_credit'] = 'Tbl_coin/allocateCredits';

// AddMaster Coin routes
//$route['coins/masterallocate'] = 'Tbl_coin/masterallocateCoins';      // View allocation page
$route['coins/masterallocate/process'] = 'Tbl_coin/processMasterAllocation'; // Process coin allocation
$route['coins/masterledgerbalance'] = 'Tbl_coin/viewLedgerBalance';        // View coin balance

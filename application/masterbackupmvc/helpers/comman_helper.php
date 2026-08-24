<?php

defined('BASEPATH') or exit('No direct script access allowed');



if (!function_exists('pre')) {

    function pre($data)
    {

        echo '<pre>';

        print_r($data);

        echo '</pre>';

        die();
    }
}

if (!function_exists('update_coin_balance')) {
    function update_coin_balance()
    {
        $CI = &get_instance(); // Get the CodeIgniter instance
        $CI->load->model('CoinModel'); // Load the CoinModel if not already loaded

        $user_id = $CI->session->userdata('id');

        if ($user_id && $user_id != 1) {
            // Fetch the latest coin balance
            $latest_balance = $CI->CoinModel->getUserBalance($user_id);

            // Update the session if the balance has changed
            if ($CI->session->userdata('coin_balance') !== $latest_balance) {
                $CI->session->set_userdata('coin_balance', $latest_balance);
            }
        }
    }
}

if (!function_exists('get_opening_value')) {
    function get_opening_value($id)
    {
        $CI = &get_instance(); // Get CI super object
        $CI->load->database(); // Load database

        // Example: Assuming you have a settings table
        $query = $CI->db->get_where('tbl_ledger', ['id' => $id]);
        if ($query->num_rows() > 0) {
            return $query->row()->openingbalance;
        } else {
            return null; // Or some default value
        }
    }
}

if (!function_exists('get_running_balance')) {
    function get_running_balance($db, $ledger_id, $date)
    {
        // Convert date to required format
        $month_start = date('01-m-Y', strtotime($date));

        // 1. Opening balance on 1st of month
        $opening_row = $db->select('final_hisab')
            ->from('tbl_final_hisab')
            ->where('ledger_id', $ledger_id)
            ->where('date', $month_start)
            ->get()
            ->row_array();

        $opening_balance = isset($opening_row['final_hisab']) ? (float) $opening_row['final_hisab'] : 0;

        // 2. Sum of final_hisab from 2nd to selected date
        $hisab_rows = $db->select('final_hisab')
            ->from('tbl_final_hisab')
            ->where('ledger_id', $ledger_id)
            ->where("STR_TO_DATE(date, '%d-%m-%Y') >", date('Y-m-d', strtotime($month_start)))
            ->where("STR_TO_DATE(date, '%d-%m-%Y') <=", date('Y-m-d', strtotime($date)))
            ->get()
            ->result_array();

        $pl_sum = 0;
        foreach ($hisab_rows as $row) {
            $pl_sum += (float) $row['final_hisab'];
        }

        return $opening_balance + $pl_sum;
    }
}

if (!function_exists('get_master_coin_balance')) {
    function get_master_coin_balance($master_id)
    {
        $CI = &get_instance();
        $CI->load->database();

        // 1. Received from main admin
        $received = $CI->db->select_sum('amount')
            ->from('coin_transactions')
            ->where('receiver_id', $master_id)
            ->where('deposite_byto_master', 0)
            ->get()->row()->amount ?? 0;

        // 2. Withdrawals from clients
        $withdrawals = $CI->db->select_sum('amount')
            ->from('coin_transactions')
            ->where('receiver_id', $master_id)
            ->where('deposite_byto_master', 1)
            ->where('type', 'spend')
            ->get()->row()->amount ?? 0;

        // 3. Allocations to clients
        $allocated = $CI->db->select_sum('amount')
            ->from('coin_transactions')
            ->where('sender_id', $master_id)
            ->where('deposite_byto_master', 1)
            ->where('type', 'allocation')
            ->get()->row()->amount ?? 0;

        // Final balance
        return ((int)$received + (int)$withdrawals) - (int)$allocated;
    }
}

// function get_client_coin_balance($ledger_id)
// {
//     $CI = &get_instance();
//     $CI->load->database();

//     // Convert date range: start at 12 PM on start_date, end at 6 AM on next day of end_date
//     // Start date = 1st day of current month at 12:00:00
//     $start_datetime = date('Y-m-d H:i:s', strtotime(date('Y-m-01') . ' 12:00:00'));

//     // End date = today +1 day at 06:00:00
//     $end_datetime = date('Y-m-d H:i:s', strtotime('+1 day 06:00:00'));


//     // 1. Fetch coin_transactions affecting the ledger
//     $CI->db->select('amount, sender_id, receiver_id, status, type, created_at');
//     $CI->db->from('coin_transactions');
//     $CI->db->group_start()
//         ->where('receiver_id', $ledger_id)
//         ->or_group_start()
//         ->where('sender_id', $ledger_id)
//         ->where('type', 'spend')
//         ->group_end()
//         ->group_end();
//     $CI->db->where('created_at >=', $start_datetime);
//     $CI->db->where('created_at <', $end_datetime);

//     $transactions = $CI->db->get()->result();

//     $balance = 0;

//     foreach ($transactions as $tx) {
//         if ($tx->receiver_id == $ledger_id) {
//             $balance += $tx->amount;
//         } elseif ($tx->sender_id == $ledger_id && $tx->status == 1) {
//             $balance -= $tx->amount;
//         }
//     }

//     // 2. Fetch P/L from tbl_final_hisab
//     $CI->db->select('date, today_hisab AS final_hisab');
//     $CI->db->from('tbl_final_hisab');
//     $CI->db->where('ledger_id', $ledger_id);
//     $CI->db->where("STR_TO_DATE(date, '%d-%m-%Y') >=", date('Y-m-d', strtotime($start_datetime)));
//     $CI->db->where("STR_TO_DATE(date, '%d-%m-%Y') <", date('Y-m-d', strtotime($end_datetime)));

//     $pl_entries = $CI->db->get()->result();

//     foreach ($pl_entries as $pl) {
//         $pl_value = (float) $pl->final_hisab;
//         if ($pl_value < 0) {
//             $balance += abs($pl_value); // Loss: add back to balance
//         } else {
//             $balance -= $pl_value; // Profit: subtract from balance
//         }
//     }

//     return $balance;
// }

function get_client_coin_balance($ledger_id)
{
    $CI = &get_instance();
    $CI->load->database();

    // Start = 1st day of current month at 12:00:00
    $start_datetime = date('Y-m-d H:i:s', strtotime(date('Y-m-01') . ' 12:00:00'));

    // End = tomorrow at 06:00:00
    $end_datetime = date('Y-m-d H:i:s', strtotime('+1 day 06:00:00'));

    // 1. Fetch coin_transactions affecting the ledger
    $CI->db->select('amount, sender_id, receiver_id, status, type, shift_id, deposite_byto_master, created_at');
    $CI->db->from('coin_transactions');
    $CI->db->group_start()
        ->where('receiver_id', $ledger_id)
        ->or_group_start()
            ->where('sender_id', $ledger_id)
            ->where('type', 'spend')
        ->group_end()
    ->group_end();
    $CI->db->where('created_at >=', $start_datetime);
    $CI->db->where('created_at <', $end_datetime);

    $transactions = $CI->db->get()->result();

    $balance = 0;

    foreach ($transactions as $tx) {
        if ($tx->receiver_id == $ledger_id) {
            $balance += $tx->amount;
        } elseif ($tx->sender_id == $ledger_id && $tx->status == 1) {
            $balance -= $tx->amount;
        }
    }

    // 2. Fetch P/L from tbl_final_hisab
    $CI->db->select('date, today_hisab AS final_hisab');
    $CI->db->from('tbl_final_hisab');
    $CI->db->where('ledger_id', $ledger_id);
    $CI->db->where("STR_TO_DATE(date, '%d-%m-%Y') >=", date('Y-m-d', strtotime($start_datetime)));
    $CI->db->where("STR_TO_DATE(date, '%d-%m-%Y') <", date('Y-m-d', strtotime($end_datetime)));

    $pl_entries = $CI->db->get()->result();

    foreach ($pl_entries as $pl) {
        $pl_value = (float) $pl->final_hisab;
        if ($pl_value < 0) {
            $balance += abs($pl_value); // Loss: add back
        } else {
            $balance -= $pl_value; // Profit: deduct
        }
    }

    // 3. Deduct entries matching special condition
    $CI->db->select_sum('amount');
    $CI->db->from('coin_transactions');
    $CI->db->where('shift_id IS NOT NULL', null, false); // raw IS NOT NULL
    $CI->db->where('deposite_byto_master', 0);
    $CI->db->where('type', 'allocation');
    $CI->db->where('status', 1);
    $CI->db->where('sender_id', $ledger_id); // Assuming receiver is affected
    $CI->db->where('created_at >=', $start_datetime);
    $CI->db->where('created_at <', $end_datetime);

    $deduct_amount = $CI->db->get()->row()->amount ?? 0;
// if($ledger_id == '157'){
//     echo $deduct_amount; die;    
//     }
    $balance -= (float) $deduct_amount;

    return $balance;
}


if (!function_exists('get_final_balance')) {
    function get_final_balance($CI, $ledger_id, $start_date, $end_date)
    {
        // Convert date range: start at 12 PM on start_date, end at 6 AM on next day of end_date
        $start_datetime = date('Y-m-d H:i:s', strtotime($start_date . ' 12:00:00'));
        $end_datetime   = date('Y-m-d H:i:s', strtotime($end_date . ' +1 day 06:00:00'));

        // 1. Fetch coin_transactions affecting the ledger
        $CI->db->select('amount, sender_id, receiver_id, status, type, created_at');
        $CI->db->from('coin_transactions');
        $CI->db->group_start()
            ->where('receiver_id', $ledger_id)
            ->or_group_start()
            ->where('sender_id', $ledger_id)
            ->where('type', 'spend')
            ->group_end()
            ->group_end();
        $CI->db->where('created_at >=', $start_datetime);
        $CI->db->where('created_at <', $end_datetime);

        $transactions = $CI->db->get()->result();

        $balance = 0;

        foreach ($transactions as $tx) {
            if ($tx->receiver_id == $ledger_id) {
                $balance += $tx->amount;
            } elseif ($tx->sender_id == $ledger_id && $tx->status == 1) {
                $balance -= $tx->amount;
            }
        }

        // 2. Fetch P/L from tbl_final_hisab
        $CI->db->select('date, today_hisab AS final_hisab');
        $CI->db->from('tbl_final_hisab');
        $CI->db->where('ledger_id', $ledger_id);
        $CI->db->where("STR_TO_DATE(date, '%d-%m-%Y') >=", date('Y-m-d', strtotime($start_datetime)));
        $CI->db->where("STR_TO_DATE(date, '%d-%m-%Y') <", date('Y-m-d', strtotime($end_datetime)));

        $pl_entries = $CI->db->get()->result();

        foreach ($pl_entries as $pl) {
            $pl_value = (float) $pl->final_hisab;
            if ($pl_value < 0) {
                $balance += abs($pl_value); // Loss: add back to balance
            } else {
                $balance -= $pl_value; // Profit: subtract from balance
            }
        }

        return $balance;
    }
}

if (!function_exists('deactivate_shift_allocations')) {
    function deactivate_shift_allocations()
    {
        $CI =& get_instance(); // Load CI instance

        $CI->db->where('shift_id IS NOT NULL', null, false);
        $CI->db->where('deposite_byto_master', 0);
        $CI->db->where('type', 'allocation');
        $CI->db->where('status', 1);

        return $CI->db->update('coin_transactions', ['status' => 0]);
    }
}

function calhisab_with_commissions($lid, $date)
{
    $CI =& get_instance();
    $CI->load->database();

    // Step 1: Get dara/akhar amounts for the ledger/date
    $CI->db->select('SUM(dara_amount) as dara_total, SUM(akhar_amount) as akhar_total');
    $CI->db->where('ledger_id', $lid);
    $CI->db->where('date', $date);
    $txn = $CI->db->get('tbl_transactions')->row_array();

    $dara_total  = isset($txn['dara_total']) ? (float)$txn['dara_total'] : 0;
    $akhar_total = isset($txn['akhar_total']) ? (float)$txn['akhar_total'] : 0;

    // Step 2: Get commission rates from ledger master
    $CI->db->select('dara_commision, dara_master_commision, akhar_commission, akhar__master_commission');
    $CI->db->where('id', $lid);
    $ledger = $CI->db->get('tbl_ledger')->row_array();

    $dara_commission_party   = isset($ledger['dara_commision']) ? (float)$ledger['dara_commision'] : 0;
    $dara_commission_master  = isset($ledger['dara_master_commision']) ? (float)$ledger['dara_master_commision'] : 0;
    $akhar_commission_party  = isset($ledger['akhar_commission']) ? (float)$ledger['akhar_commission'] : 0;
    $akhar_commission_master = isset($ledger['akhar__master_commission']) ? (float)$ledger['akhar__master_commission'] : 0;

    // Step 3: Apply commissions
    $dara_party_amount   = $dara_total - ($dara_total * $dara_commission_party / 100);
    $dara_master_amount  = $dara_total - ($dara_total * $dara_commission_master / 100);

    $akhar_party_amount   = $akhar_total - ($akhar_total * $akhar_commission_party / 100);
    $akhar_master_amount  = $akhar_total - ($akhar_total * $akhar_commission_master / 100);

    // Step 4: Final calculation (Example: sum of adjusted values)
    // You can adjust this depending on whether master/party are separate or combined
    $final_amount_party  = $dara_party_amount + $akhar_party_amount;
    $final_amount_master = $dara_master_amount + $akhar_master_amount;

    return [
        'party_total'  => $final_amount_party,
        'master_total' => $final_amount_master,
        'dara_party'   => $dara_party_amount,
        'dara_master'  => $dara_master_amount,
        'akhar_party'  => $akhar_party_amount,
        'akhar_master' => $akhar_master_amount,
    ];
}


function calhisab_new($lid, $date)
{
    $CI =& get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_ledgers');
    $CI->db->where('id', $lid);
    $ledger = $CI->db->get()->row_array();

    // Commission rates (ensure they're numeric)
    $dara_party_rate   = floatval($ledger['dara_commision'] ?? 0);
    $dara_master_rate  = floatval($ledger['dara_master_commision'] ?? 0);
    $akhar_party_rate  = floatval($ledger['akhar_commision'] ?? 0);
    $akhar_master_rate = floatval($ledger['akhar__master_commission'] ?? 0);

    // Get the total amount for the date
    $CI->db->select_sum('amount');
    $CI->db->where('ledger_id', $lid);
    $CI->db->where('date', $date);
    $result = $CI->db->get('tbl_transactions')->row_array();
    $tamount = floatval($result['amount'] ?? 0);

    // Calculate commissions
    $dara_party_comm   = round(($tamount * $dara_party_rate) / 100, 2);
    $dara_master_comm  = round(($tamount * $dara_master_rate) / 100, 2);
    $akhar_party_comm  = round(($tamount * $akhar_party_rate) / 100, 2);
    $akhar_master_comm = round(($tamount * $akhar_master_rate) / 100, 2);

    // Total commission
    $total_commission = $dara_party_comm + $dara_master_comm + $akhar_party_comm + $akhar_master_comm;

    // Get Patti
    $CI->db->select_sum('patti');
    $CI->db->where('ledger_id', $lid);
    $CI->db->where('date', $date);
    $patti_res = $CI->db->get('tbl_transactions')->row_array();
    $patti = floatval($patti_res['patti'] ?? 0);

    // Hisab calculation
    $hisab = $tamount - $total_commission - $patti;

    return [
        'tamount'           => $tamount,
        'dara_party_comm'   => $dara_party_comm,
        'dara_master_comm'  => $dara_master_comm,
        'akhar_party_comm'  => $akhar_party_comm,
        'akhar_master_comm' => $akhar_master_comm,
        'total_commission'  => $total_commission,
        'patti'             => $patti,
        'final_hisab'       => $hisab
    ];
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jantri_cron extends CI_Controller
{
    const JANTRI_CRON_TIMEZONE = 'Asia/Kolkata';

    public function automatic()
    {
        if (!$this->input->is_cli_request()) show_404();
        $this->configure_jantri_cron_timezone();
        $this->load->helper('jantri');
        $this->load->model('Tbl_transactions_model');
        $this->load->model('Tbl_openno_model');
        $this->load->model('Tbl_shift_model');
        $this->load->model('CoinModel');
        $now = new DateTime('now', new DateTimeZone(self::JANTRI_CRON_TIMEZONE));
        $businessDate = jantri_business_date(clone $now);
        $this->write_jantri_cron_event('hit', __METHOD__, 'cron_started', array(
            'business_date' => $businessDate,
            'now' => $now->format('Y-m-d h:i:s A'),
            'timezone' => self::JANTRI_CRON_TIMEZONE,
        ));
        $masters = $this->db->where('is_master', 1)->where('status', 1)->where('automatic_jantri', 1)->where('is_locked', 0)->get('tbl_ledger')->result_array();
        $this->log_db_error(__METHOD__, 'select_enabled_masters');
        if (!$masters) {
            $this->write_jantri_cron_event('skip', __METHOD__, 'no_enabled_masters', array(
                'reason' => 'No tbl_ledger rows matched is_master=1, status=1, automatic_jantri=1, is_locked=0',
                'business_date' => $businessDate,
            ));
        }
        foreach ($masters as $master) {
            $timings = $this->Tbl_shift_model->get_automatic_jantri_timings($master['id'], $businessDate);
            $this->log_db_error('Tbl_shift_model::get_automatic_jantri_timings', 'select_shift_timings', array(
                'master' => $master['id'],
                'business_date' => $businessDate,
            ));
            if (!$timings) {
                $this->write_jantri_cron_event('skip', __METHOD__, 'no_shift_timings', array(
                    'master' => $master['id'],
                    'business_date' => $businessDate,
                    'reason' => 'No active user_shift_timings rows found for today/next day with non-empty master time',
                ));
            }
            foreach ($timings as $timing) {
                $cutoff = jantri_cutoff_datetime($businessDate, $timing['master']);
                if (!$cutoff) {
                    $this->write_jantri_cron_event('fail', __METHOD__, 'invalid_cutoff_time', array(
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'base_shift' => $timing['shift_id'],
                        'business_date' => $businessDate,
                        'shift_time' => $timing['master'],
                        'now' => $now->format('Y-m-d h:i:s A'),
                        'reason' => 'jantri_cutoff_datetime returned false',
                    ));
                    continue;
                }
                if ($now < $cutoff) {
                    $this->write_jantri_cron_event('skip', __METHOD__, 'time_condition_failed', array(
                        'condition' => 'now >= cutoff',
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'base_shift' => $timing['shift_id'],
                        'business_date' => $businessDate,
                        'shift_time' => $timing['master'],
                        'now' => $now->format('Y-m-d h:i:s A'),
                        'cutoff' => $cutoff->format('Y-m-d h:i:s A'),
                        'reason' => 'Current IST time is before configured master cutoff',
                    ));
                    continue;
                }
                $this->write_jantri_cron_event('pass', __METHOD__, 'time_condition_passed', array(
                    'condition' => 'now >= cutoff',
                    'master' => $master['id'],
                    'shift' => $timing['id'],
                    'base_shift' => $timing['shift_id'],
                    'business_date' => $businessDate,
                    'shift_time' => $timing['master'],
                    'now' => $now->format('Y-m-d h:i:s A'),
                    'cutoff' => $cutoff->format('Y-m-d h:i:s A'),
                ));
                $nextDate = date('Y-m-d', strtotime($businessDate . ' +1 day'));
                $sent = $this->db->where('shift_id', $timing['id'])->where('party_id', $master['id'])->where('t_date >=', $businessDate . ' 00:00:00')->where('t_date <', $nextDate . ' 00:00:00')->where('show_to_admin', 1)->count_all_results('tbl_master_transaction');
                $this->log_db_error(__METHOD__, 'check_duplicate_submission', array('master' => $master['id'], 'shift' => $timing['id'], 'business_date' => $businessDate));
                if ($sent) {
                    $this->write_jantri_cron_event('skip', __METHOD__, 'duplicate_already_sent', array(
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'business_date' => $businessDate,
                        'existing_count' => $sent,
                        'reason' => 'tbl_master_transaction already has show_to_admin=1 for this master/shift/date',
                    ));
                    continue;
                }
                $currentMaster = $this->db->where('id', $master['id'])->where('status', 1)->where('automatic_jantri', 1)->where('is_locked', 0)->get('tbl_ledger')->row_array();
                $this->log_db_error(__METHOD__, 'recheck_master_enabled', array('master' => $master['id']));
                if (!$currentMaster) {
                    $this->write_jantri_cron_event('skip', __METHOD__, 'master_recheck_failed', array(
                        'master' => $master['id'],
                        'reason' => 'Master was disabled, locked, or automatic_jantri turned off after initial selection',
                    ));
                    continue;
                }
                $this->session->set_userdata(array('id' => $master['id'], 'userid' => $master['id']));
                $rows = $this->Tbl_transactions_model->get_custom_transactions_total_shift_master($timing['id'], $businessDate);
                $this->log_db_error('Tbl_transactions_model::get_custom_transactions_total_shift_master', 'select_transaction_rows', array('master' => $master['id'], 'shift' => $timing['id'], 'business_date' => $businessDate));
                if (!$rows) {
                    $this->write_jantri_cron_event('skip', __METHOD__, 'no_transaction_rows', array(
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'business_date' => $businessDate,
                        'reason' => 'No source transactions found to calculate automatic Jantri',
                    ));
                    continue;
                }
                $cells = jantri_automatic_cells($rows);
                $post = array('shift' => $timing['id'], 'party' => $master['id'], 'dateoftrn' => $businessDate, 'ttamntt' => array_sum($cells), 'trn_number' => array(), 'trn_amount' => array());
                foreach ($cells as $number => $amount) if ($amount > 0) { $post['trn_number'][] = $number == 100 ? '00' : sprintf('%02d', $number); $post['trn_amount'][] = $amount; }
                if (!$post['trn_number']) {
                    $this->write_jantri_cron_event('skip', __METHOD__, 'no_calculated_cells', array(
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'business_date' => $businessDate,
                        'total_amount' => $post['ttamntt'],
                        'source_rows' => count($rows),
                        'reason' => 'Calculated Jantri had no positive cells to submit',
                    ));
                    continue;
                }
                $this->db->trans_start();
                $sentId = $this->send_automatic($post, $master);
                $this->db->trans_complete();
                if ($sentId && $this->db->trans_status()) {
                    $this->write_jantri_cron_event('success', __METHOD__, 'jantri_sent', array(
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'business_date' => $businessDate,
                        'transaction_id' => $sentId,
                        'total_amount' => $post['ttamntt'],
                    ));
                } else {
                    $this->write_jantri_cron_event('fail', __METHOD__, 'send_or_transaction_failed', array(
                        'master' => $master['id'],
                        'shift' => $timing['id'],
                        'business_date' => $businessDate,
                        'sent_id' => $sentId ? $sentId : 'none',
                        'db_transaction_status' => $this->db->trans_status() ? 'true' : 'false',
                        'reason' => 'send_automatic returned false or database transaction failed',
                    ));
                    $this->log_db_error(__METHOD__, 'send_or_transaction_failed', array('master' => $master['id'], 'shift' => $timing['id'], 'business_date' => $businessDate));
                }
            }
        }
        $this->write_jantri_cron_event('hit', __METHOD__, 'cron_finished', array(
            'business_date' => $businessDate,
            'now' => date('Y-m-d h:i:s A'),
        ));
    }

    private function send_automatic($post, $master)
    {
        $balance = $this->CoinModel->get_coin_balance($master['id']);
        if ($balance < $post['ttamntt']) {
            $this->write_jantri_cron_event('fail', __METHOD__, 'insufficient_coin_balance', array(
                'master' => $master['id'],
                'shift' => $post['shift'],
                'business_date' => $post['dateoftrn'],
                'balance' => $balance,
                'required' => $post['ttamntt'],
                'condition' => 'balance >= required',
            ));
            log_message('error', 'Automatic Jantri skipped: insufficient balance for master ' . $master['id']);
            return false;
        }
        if (!$this->CoinModel->allocateCoins($master['id'], 1, $post['ttamntt'])) {
            $this->write_jantri_cron_event('fail', __METHOD__, 'coin_allocation_failed', array(
                'master' => $master['id'],
                'shift' => $post['shift'],
                'business_date' => $post['dateoftrn'],
                'amount' => $post['ttamntt'],
                'receiver' => 1,
            ));
            $this->log_db_error('CoinModel::allocateCoins', 'allocate_coins', array('master' => $master['id'], 'shift' => $post['shift']));
            return false;
        }
        $opening = $this->calculate_opening_for_updateclosing($master['id'], $post['dateoftrn']);
        if (is_array($opening)) {
            $this->write_jantri_cron_event('fail', __METHOD__, 'opening_calculation_returned_array', array(
                'master' => $master['id'],
                'shift' => $post['shift'],
                'business_date' => $post['dateoftrn'],
                'opening_payload' => $opening,
                'reason' => 'updateclosing requires a scalar opening amount',
            ));
            return false;
        }
        if ($opening === false) {
            $this->write_jantri_cron_event('fail', __METHOD__, 'opening_calculation_failed', array(
                'master' => $master['id'],
                'shift' => $post['shift'],
                'business_date' => $post['dateoftrn'],
                'reason' => 'Could not calculate scalar opening amount',
            ));
            return false;
        }
        $this->Tbl_transactions_model->updateclosing($opening, $master['id'], $post['dateoftrn']);
        $this->log_db_error('Tbl_transactions_model::updateclosing', 'update_closing_balance', array('master' => $master['id'], 'business_date' => $post['dateoftrn']));
        $id = $this->Tbl_transactions_model->add_tbl_transaction(array('shift_id' => $post['shift'], 'party_id' => $master['id'], 'master_id' => $master['id'], 't_date' => $post['dateoftrn'], 'total_number_amount' => $post['ttamntt'], 'total_akhar_amount' => 0, 'show_to_admin' => 1));
        $this->log_db_error('Tbl_transactions_model::add_tbl_transaction', 'insert_master_transaction', array('master' => $master['id'], 'shift' => $post['shift'], 'business_date' => $post['dateoftrn']));
        if (!$id) {
            $this->write_jantri_cron_event('fail', __METHOD__, 'master_transaction_insert_failed', array(
                'master' => $master['id'],
                'shift' => $post['shift'],
                'business_date' => $post['dateoftrn'],
                'total_amount' => $post['ttamntt'],
            ));
            return false;
        }
        $this->Tbl_transactions_model->add_tbl_only_transaction_may($id, $post);
        $this->log_db_error('Tbl_transactions_model::add_tbl_only_transaction_may', 'insert_transaction_numbers', array('master' => $master['id'], 'shift' => $post['shift'], 'transaction_id' => $id));
        return $id;
    }

    private function calculate_opening_for_updateclosing($masterId, $date)
    {
        $post = array('ledger_id' => $masterId, 'date' => $date);
        $tdledger = $this->Tbl_openno_model->ledger_till_date_result_today($post);
        $this->log_db_error('Tbl_openno_model::ledger_till_date_result_today', 'calculate_opening_report', array(
            'master' => $masterId,
            'business_date' => $date,
        ));

        if (empty($tdledger['today'][0])) {
            $this->write_jantri_cron_event('fail', __METHOD__, 'opening_calculation_missing_today', array(
                'master' => $masterId,
                'business_date' => $date,
                'reason' => 'ledger_till_date_result_today returned no today row',
            ));
            return false;
        }

        $data = array('tdledger' => $tdledger);
        $finalsum = 0;
        foreach ($data['tdledger']['today'] as $key => $val) {
            $filter = array(
                'shift_name' => $val['ShiftId'],
                'search_party' => $val['PartyId'],
                'todate' => $val['Date'],
            );
            $tdata = $this->Tbl_transactions_model->view_transaction_filter_calculate($filter);
            foreach ($tdata as $vall) {
                $finalsum += array_sum(explode(',', $vall['trn_amt']));
            }
            $data['tdledger']['today'][$key]['finalsum'] = $finalsum;
            $data['tdledger']['today'][$key]['tamnt'] = $finalsum;
        }

        $kist = $this->Tbl_openno_model->ledger_get_kist($post);
        $backvoucher = $this->Tbl_openno_model->ledger_get_back_voucher($post);
        $bvc = 0;
        foreach ($backvoucher as $val) {
            if ($post['ledger_id'] == $val['PartyId']) $bvc -= $val['Amount'];
            if ($post['ledger_id'] == $val['Collect_By']) $bvc += $val['Amount'];
        }

        if (!empty($kist)) {
            $date1 = new DateTime(date('Y-m-d', strtotime($kist[0]['frdate'])));
            $date2 = new DateTime(date('Y-m-d', strtotime($data['tdledger']['today'][0]['Date'])));
            $interval = $date1->diff($date2);
            $kamnt = $interval->days ? ($interval->days * $kist[0]['kist']) : 0;
        } else {
            $kamnt = 0;
        }

        $btamount = 0;
        $bta = 0;
        $btb = 0;
        $bpattiamnt = 0;
        $nbopening = 0;
        $bopening = !empty($data['tdledger']['today'][0]['openingbalance']) ? $data['tdledger']['today'][0]['openingbalance'] : 0;

        foreach ($data['tdledger']['before'] as $vall) {
            $beforeSum = 0;
            $filter = array(
                'shift_name' => $vall['ShiftId'],
                'search_party' => $vall['PartyId'],
                'todate' => $vall['Date'],
                'created_by' => $this->session->userdata['id'],
            );
            $tdata = $this->Tbl_transactions_model->view_transaction_filter($filter);
            foreach ($tdata as $valll) {
                $beforeSum += array_sum(explode(',', $valll['trn_amt']));
            }
            $btamount += $beforeSum;
            $bta += $vall['oamnt'];
            $btb += $vall['akmnt'];
            $bcommission = ceil($btamount * ((float)$vall['ledgerdara_commision'] / 100));
            $bdamount = ceil($bta * $vall['ledgerdara_rate']);
            $baamount = ceil($btb * $vall['ledgerakhar_rate']);
            $bpattiamnt = ($vall['hissa_select'] == 'y') ? (($btamount - ($bcommission + $baamount + $bdamount)) * $vall['pattiperc']) / 100 : 0;
            $nbopening = ($btamount - ($bcommission + $baamount + $bdamount + $bpattiamnt));
        }

        $bopening = $nbopening + $bopening + $bvc;
        if (date('Y-m-01') == date('Y-m-d', time())) {
            $ledgerbal = $this->Tbl_transactions_model->thirdpartydetails($post['ledger_id']);
            $bopening = $ledgerbal['openingbalance'];
        }

        $this->write_jantri_cron_event('pass', __METHOD__, 'opening_calculated', array(
            'master' => $masterId,
            'business_date' => $date,
            'opening' => $bopening,
            'kist_amount' => $kamnt,
            'back_voucher' => $bvc,
        ));
        return $bopening;
    }

    private function configure_jantri_cron_timezone()
    {
        date_default_timezone_set(self::JANTRI_CRON_TIMEZONE);
    }

    private function write_jantri_cron_log($message)
    {
        $line = '['.date('Y-m-d h:i:s A').'] '.$message;
        echo $line."\n";
        file_put_contents(APPPATH.'logs/jantri-cron.log', $line.PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function write_jantri_cron_event($status, $source, $condition, $details = array())
    {
        $details['file'] = __FILE__;
        $details['source'] = $source;
        $details['condition'] = $condition;
        $parts = array();
        foreach ($details as $key => $value) {
            if (is_array($value) || is_object($value)) $value = json_encode($value);
            $parts[] = $key.'='.$value;
        }
        $this->write_jantri_cron_log($status.': '.implode(' ', $parts));
    }

    private function log_db_error($source, $condition, $details = array())
    {
        $error = $this->db->error();
        if (empty($error['code'])) return;
        $details['db_error_code'] = $error['code'];
        $details['db_error_message'] = $error['message'];
        $details['last_query'] = $this->db->last_query();
        $this->write_jantri_cron_event('fail', $source, $condition, $details);
    }
}

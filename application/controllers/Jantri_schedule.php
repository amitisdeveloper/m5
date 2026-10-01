<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jantri_schedule extends CI_Controller
{
    const TIMEZONE = 'Asia/Kolkata';
    const SCHEDULE_VERSION = 1;
    private $base_shift_ids = array(3, 4, 6, 7, 10, 11);

    public function __construct()
    {
        parent::__construct();
        if (!$this->input->is_cli_request()) show_404();
        date_default_timezone_set(self::TIMEZONE);
        $this->load->helper('jantri');
        $this->load->model('Tbl_transactions_model');
        $this->load->model('Tbl_openno_model');
        $this->load->model('Tbl_shift_model');
        $this->load->model('CoinModel');
    }

    public function refresh()
    {
        $now = $this->now();
        $cycleDate = $this->cycle_date($now);
        $this->log_event('hit', 'refresh_started', array('cycle_date' => $cycleDate, 'now' => $now->format('Y-m-d h:i:s A')));

        $rows = $this->db
            ->select('id, shift_name, super_admin')
            ->where_in('id', $this->base_shift_ids)
            ->where('is_active', 1)
            ->order_by('id', 'ASC')
            ->get('tbl_shift')
            ->result_array();
        $this->log_db_error('refresh_select_tbl_shift');

        $entries = array();
        foreach ($rows as $row) {
            $normalized = $this->normalize_time($row['super_admin']);
            if (!$normalized) {
                $this->log_event('skip', 'invalid_shift_time', array(
                    'base_shift_id' => $row['id'],
                    'shift_name' => $row['shift_name'],
                    'raw_time' => $row['super_admin'],
                    'reason' => 'Cannot parse tbl_shift.super_admin',
                ));
                continue;
            }

            $due = $this->due_datetime_for_cycle($cycleDate, $normalized);
            if (!$this->is_inside_operating_window($due, $cycleDate)) {
                $this->log_event('skip', 'time_outside_operating_window', array(
                    'base_shift_id' => $row['id'],
                    'shift_name' => $row['shift_name'],
                    'raw_time' => $row['super_admin'],
                    'normalized_time' => $normalized,
                    'due_at' => $due->format('Y-m-d H:i:00'),
                    'reason' => 'Allowed window is 13:46 through next-day 08:00',
                ));
                continue;
            }

            $entries[] = array(
                'base_shift_id' => (int)$row['id'],
                'shift_name' => $row['shift_name'],
                'raw_time' => $row['super_admin'],
                'normalized_time' => $normalized,
                'due_at' => $due->format('Y-m-d H:i:00'),
            );
        }

        $payload = array(
            'version' => self::SCHEDULE_VERSION,
            'cycle_date' => $cycleDate,
            'timezone' => self::TIMEZONE,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'source' => 'tbl_shift.super_admin',
            'base_shift_ids' => $this->base_shift_ids,
            'entries' => $entries,
        );

        if (!$this->write_schedule_atomic($payload)) {
            $this->log_event('fail', 'refresh_write_failed', array('path' => $this->schedule_path()));
            return;
        }

        $this->log_event('success', 'refresh_finished', array(
            'cycle_date' => $cycleDate,
            'entry_count' => count($entries),
            'path' => $this->schedule_path(),
        ));
    }

    public function run()
    {
        $now = $this->now();
        $cycleDate = $this->cycle_date($now);
        $minute = $now->format('Y-m-d H:i:00');
        $this->log_event('hit', 'runner_started', array('cycle_date' => $cycleDate, 'minute' => $minute));

        if (!$this->is_runner_minute($now)) {
            $this->log_event('skip', 'runner_outside_window', array('minute' => $minute));
            return;
        }

        $schedule = $this->read_schedule();
        if (!$schedule) return;

        if (empty($schedule['cycle_date']) || $schedule['cycle_date'] !== $cycleDate) {
            $this->log_event('skip', 'schedule_cycle_mismatch', array(
                'runner_cycle_date' => $cycleDate,
                'schedule_cycle_date' => isset($schedule['cycle_date']) ? $schedule['cycle_date'] : '',
                'reason' => 'Refresh did not create a schedule for this cycle',
            ));
            return;
        }

        $dueEntries = array();
        foreach ($schedule['entries'] as $entry) {
            if (!empty($entry['due_at']) && $entry['due_at'] === $minute) $dueEntries[] = $entry;
        }

        if (!$dueEntries) {
            $this->log_event('skip', 'nothing_due_this_minute', array('minute' => $minute));
            return;
        }

        foreach ($dueEntries as $entry) {
            $this->run_base_shift_entry($entry, $cycleDate, $now);
        }
        $this->log_event('hit', 'runner_finished', array('cycle_date' => $cycleDate, 'minute' => $minute));
    }

    public function self_test()
    {
        $tests = array(
            'parse_colon_pm' => $this->normalize_time('1:10 PM') === '13:10',
            'parse_dot_pm' => $this->normalize_time('2.15 PM') === '14:15',
            'parse_am' => $this->normalize_time('3:00 AM') === '03:00',
            'malformed_time' => $this->normalize_time('bad time') === false,
            'start_window' => $this->is_runner_minute(new DateTime('2026-09-23 13:46:00', new DateTimeZone(self::TIMEZONE))),
            'midnight_window' => $this->is_runner_minute(new DateTime('2026-09-24 00:00:00', new DateTimeZone(self::TIMEZONE))),
            'end_window' => $this->is_runner_minute(new DateTime('2026-09-24 08:00:00', new DateTimeZone(self::TIMEZONE))),
            'after_end_window' => !$this->is_runner_minute(new DateTime('2026-09-24 08:01:00', new DateTimeZone(self::TIMEZONE))),
            'before_refresh_window' => !$this->is_runner_minute(new DateTime('2026-09-23 13:45:00', new DateTimeZone(self::TIMEZONE))),
            'am_rollover' => $this->due_datetime_for_cycle('2026-09-23', '03:00')->format('Y-m-d H:i:00') === '2026-09-24 03:00:00',
            'pm_same_day' => $this->due_datetime_for_cycle('2026-09-23', '14:57')->format('Y-m-d H:i:00') === '2026-09-23 14:57:00',
        );

        foreach ($tests as $name => $passed) {
            echo ($passed ? 'PASS ' : 'FAIL ').$name.PHP_EOL;
        }
    }

    private function run_base_shift_entry($entry, $cycleDate, $now)
    {
        $masters = $this->db
            ->where('is_master', 1)
            ->where('status', 1)
            ->where('automatic_jantri', 1)
            ->where('is_locked', 0)
            ->get('tbl_ledger')
            ->result_array();
        $this->log_db_error('runner_select_masters', array('base_shift_id' => $entry['base_shift_id']));

        foreach ($masters as $master) {
            $timing = $this->resolve_user_shift_timing($master['id'], $entry['base_shift_id'], $cycleDate);
            if (!$timing) {
                $this->log_event('skip', 'timing_not_found', array(
                    'master' => $master['id'],
                    'base_shift_id' => $entry['base_shift_id'],
                    'cycle_date' => $cycleDate,
                    'reason' => 'No active user_shift_timings row found for this master/base shift/cycle',
                ));
                continue;
            }

            if (!$this->claim_run($cycleDate, $entry, $timing, $master, $now)) continue;

            $this->session->set_userdata(array('id' => $master['id'], 'userid' => $master['id']));
            $sentId = false;
            $error = '';
            $this->db->trans_start();
            try {
                $sentId = $this->submit_automatic_jantri($master, $timing, $cycleDate);
            } catch (Exception $e) {
                $error = $e->getMessage();
                $this->log_event('fail', 'submit_exception', array(
                    'master' => $master['id'],
                    'base_shift_id' => $entry['base_shift_id'],
                    'user_shift_timing_id' => $timing['id'],
                    'error' => $error,
                ));
            }
            $this->db->trans_complete();

            if ($sentId && $this->db->trans_status()) {
                $this->finish_run($cycleDate, $entry, $timing, $master, 'success', $sentId, '');
            } else {
                $message = $error ? $error : 'submit_automatic_jantri returned false or database transaction failed';
                $this->finish_run($cycleDate, $entry, $timing, $master, 'failed', $sentId, $message);
            }
        }
    }

    private function submit_automatic_jantri($master, $timing, $businessDate)
    {
        $nextDate = date('Y-m-d', strtotime($businessDate . ' +1 day'));
        $sent = $this->db
            ->where('shift_id', $timing['id'])
            ->where('party_id', $master['id'])
            ->where('t_date >=', $businessDate . ' 00:00:00')
            ->where('t_date <', $nextDate . ' 00:00:00')
            ->where('show_to_admin', 1)
            ->count_all_results('tbl_master_transaction');
        if ($sent) {
            $this->log_event('skip', 'manual_or_auto_already_sent', array('master' => $master['id'], 'user_shift_timing_id' => $timing['id'], 'business_date' => $businessDate));
            return true;
        }

        $rows = $this->Tbl_transactions_model->get_custom_transactions_total_shift_master($timing['id'], $businessDate);
        if (!$rows) {
            $this->log_event('skip', 'no_transaction_rows', array('master' => $master['id'], 'user_shift_timing_id' => $timing['id'], 'business_date' => $businessDate));
            return false;
        }

        $cells = jantri_automatic_cells($rows);
        $post = array('shift' => $timing['id'], 'party' => $master['id'], 'dateoftrn' => $businessDate, 'ttamntt' => array_sum($cells), 'trn_number' => array(), 'trn_amount' => array());
        foreach ($cells as $number => $amount) {
            if ($amount > 0) {
                $post['trn_number'][] = $number == 100 ? '00' : sprintf('%02d', $number);
                $post['trn_amount'][] = $amount;
            }
        }
        if (!$post['trn_number']) {
            $this->log_event('skip', 'no_calculated_cells', array('master' => $master['id'], 'user_shift_timing_id' => $timing['id'], 'business_date' => $businessDate));
            return false;
        }

        $balance = $this->CoinModel->get_coin_balance($master['id']);
        if ($balance < $post['ttamntt']) {
            $this->log_event('fail', 'insufficient_coin_balance', array('master' => $master['id'], 'balance' => $balance, 'required' => $post['ttamntt']));
            return false;
        }
        if (!$this->CoinModel->allocateCoins($master['id'], 1, $post['ttamntt'])) {
            $this->log_event('fail', 'coin_allocation_failed', array('master' => $master['id'], 'amount' => $post['ttamntt']));
            return false;
        }

        $opening = $this->calculate_opening_for_updateclosing($master['id'], $businessDate);
        if ($opening === false || is_array($opening)) return false;
        $this->Tbl_transactions_model->updateclosing($opening, $master['id'], $businessDate);

        $id = $this->Tbl_transactions_model->add_tbl_transaction(array(
            'shift_id' => $post['shift'],
            'party_id' => $master['id'],
            'master_id' => $master['id'],
            't_date' => $businessDate,
            'total_number_amount' => $post['ttamntt'],
            'total_akhar_amount' => 0,
            'show_to_admin' => 1,
        ));
        if (!$id) return false;
        $this->Tbl_transactions_model->add_tbl_only_transaction_may($id, $post);
        return $id;
    }

    private function claim_run($cycleDate, $entry, $timing, $master, $now)
    {
        $row = array(
            'cycle_date' => $cycleDate,
            'base_shift_id' => $entry['base_shift_id'],
            'user_shift_timing_id' => $timing['id'],
            'master_id' => $master['id'],
            'scheduled_time' => $entry['normalized_time'].':00',
            'status' => 'running',
            'started_at' => $now->format('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('jantri_schedule_runs', $row);
        $error = $this->db->error();
        if (!empty($error['code'])) {
            if ((int)$error['code'] === 1062) {
                $this->log_event('skip', 'duplicate_run_claim', array('master' => $master['id'], 'base_shift_id' => $entry['base_shift_id'], 'user_shift_timing_id' => $timing['id'], 'cycle_date' => $cycleDate));
            } else {
                $this->log_event('fail', 'run_claim_db_error', array('db_error_code' => $error['code'], 'db_error_message' => $error['message']));
            }
            return false;
        }
        return true;
    }

    private function finish_run($cycleDate, $entry, $timing, $master, $status, $transactionId, $error)
    {
        $data = array('status' => $status, 'finished_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'transaction_id' => $transactionId ? $transactionId : null, 'error_message' => $error);
        $this->db
            ->where('cycle_date', $cycleDate)
            ->where('base_shift_id', $entry['base_shift_id'])
            ->where('user_shift_timing_id', $timing['id'])
            ->where('master_id', $master['id'])
            ->update('jantri_schedule_runs', $data);
        $this->log_event($status === 'success' ? 'success' : 'fail', 'run_finished', array('status' => $status, 'master' => $master['id'], 'base_shift_id' => $entry['base_shift_id'], 'user_shift_timing_id' => $timing['id'], 'transaction_id' => $transactionId, 'error' => $error));
    }

    private function resolve_user_shift_timing($masterId, $baseShiftId, $cycleDate)
    {
        $nextDate = date('Y-m-d', strtotime($cycleDate . ' +1 day'));
        $this->db->select('id, shift_id, updated_by, open_date, master');
        $this->db->from('user_shift_timings');
        $this->db->where('shift_id', $baseShiftId);
        $this->db->where_in('updated_by', array($masterId, 1));
        $this->db->where_in('open_date', array($cycleDate, $nextDate));
        $this->db->where('is_active', 1);
        $this->db->order_by("CASE WHEN updated_by = ".$this->db->escape($masterId)." THEN 0 ELSE 1 END", 'ASC', false);
        $this->db->order_by('open_date', 'ASC');
        $this->db->order_by('id', 'DESC');
        return $this->db->get()->row_array();
    }

    private function calculate_opening_for_updateclosing($masterId, $date)
    {
        $post = array('ledger_id' => $masterId, 'date' => $date);
        $tdledger = $this->Tbl_openno_model->ledger_till_date_result_today($post);
        if (empty($tdledger['today'][0])) {
            $this->log_event('fail', 'opening_calculation_missing_today', array('master' => $masterId, 'business_date' => $date));
            return false;
        }

        $data = array('tdledger' => $tdledger);
        $finalsum = 0;
        foreach ($data['tdledger']['today'] as $key => $val) {
            $filter = array('shift_name' => $val['ShiftId'], 'search_party' => $val['PartyId'], 'todate' => $val['Date']);
            $tdata = $this->Tbl_transactions_model->view_transaction_filter_calculate($filter);
            foreach ($tdata as $vall) $finalsum += array_sum(explode(',', $vall['trn_amt']));
            $data['tdledger']['today'][$key]['finalsum'] = $finalsum;
            $data['tdledger']['today'][$key]['tamnt'] = $finalsum;
        }

        $backvoucher = $this->Tbl_openno_model->ledger_get_back_voucher($post);
        $bvc = 0;
        foreach ($backvoucher as $val) {
            if ($post['ledger_id'] == $val['PartyId']) $bvc -= $val['Amount'];
            if ($post['ledger_id'] == $val['Collect_By']) $bvc += $val['Amount'];
        }

        $btamount = 0;
        $bta = 0;
        $btb = 0;
        $nbopening = 0;
        $bopening = !empty($data['tdledger']['today'][0]['openingbalance']) ? $data['tdledger']['today'][0]['openingbalance'] : 0;
        foreach ($data['tdledger']['before'] as $vall) {
            $beforeSum = 0;
            $filter = array('shift_name' => $vall['ShiftId'], 'search_party' => $vall['PartyId'], 'todate' => $vall['Date'], 'created_by' => $this->session->userdata['id']);
            $tdata = $this->Tbl_transactions_model->view_transaction_filter($filter);
            foreach ($tdata as $valll) $beforeSum += array_sum(explode(',', $valll['trn_amt']));
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
        return $bopening;
    }

    private function write_schedule_atomic($payload)
    {
        $path = $this->schedule_path();
        $dir = dirname($path);
        if (!is_dir($dir) && !mkdir($dir, 0755, true)) return false;
        $tmp = $path.'.tmp.'.getmypid();
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        if ($json === false) return false;
        if (file_put_contents($tmp, $json, LOCK_EX) === false) return false;
        return rename($tmp, $path);
    }

    private function read_schedule()
    {
        $path = $this->schedule_path();
        if (!is_file($path)) {
            $this->log_event('fail', 'schedule_file_missing', array('path' => $path));
            return false;
        }
        $data = json_decode(file_get_contents($path), true);
        if (!is_array($data) || empty($data['entries'])) {
            $this->log_event('fail', 'schedule_file_invalid', array('path' => $path));
            return false;
        }
        return $data;
    }

    private function schedule_path()
    {
        return APPPATH.'runtime/jantri_schedule.json';
    }

    private function normalize_time($value)
    {
        $value = trim((string)$value);
        if ($value === '') return false;
        $value = preg_replace('/\s+/', ' ', strtoupper(str_replace('.', ':', $value)));
        if (!preg_match('/^(\d{1,2}):(\d{2})\s*(AM|PM)$/', $value, $matches)) return false;
        $hour = (int)$matches[1];
        $minute = (int)$matches[2];
        if ($hour < 1 || $hour > 12 || $minute < 0 || $minute > 59) return false;
        if ($matches[3] === 'PM' && $hour !== 12) $hour += 12;
        if ($matches[3] === 'AM' && $hour === 12) $hour = 0;
        return sprintf('%02d:%02d', $hour, $minute);
    }

    private function due_datetime_for_cycle($cycleDate, $normalizedTime)
    {
        $date = ($normalizedTime < '13:46') ? date('Y-m-d', strtotime($cycleDate.' +1 day')) : $cycleDate;
        return new DateTime($date.' '.$normalizedTime.':00', new DateTimeZone(self::TIMEZONE));
    }

    private function is_inside_operating_window($due, $cycleDate)
    {
        $start = new DateTime($cycleDate.' 13:46:00', new DateTimeZone(self::TIMEZONE));
        $end = new DateTime(date('Y-m-d', strtotime($cycleDate.' +1 day')).' 08:00:00', new DateTimeZone(self::TIMEZONE));
        return $due >= $start && $due <= $end;
    }

    private function is_runner_minute($now)
    {
        $time = $now->format('H:i');
        return ($time >= '13:46' && $time <= '23:59') || ($time >= '00:00' && $time <= '08:00');
    }

    private function cycle_date($now)
    {
        if ($now->format('H:i') <= '08:00') {
            $cycle = clone $now;
            return $cycle->modify('-1 day')->format('Y-m-d');
        }
        return $now->format('Y-m-d');
    }

    private function now()
    {
        return new DateTime('now', new DateTimeZone(self::TIMEZONE));
    }

    private function log_event($status, $condition, $details = array())
    {
        $details['file'] = __FILE__;
        $details['condition'] = $condition;
        $parts = array();
        foreach ($details as $key => $value) {
            if (is_array($value) || is_object($value)) $value = json_encode($value);
            $parts[] = $key.'='.$value;
        }
        $line = '['.date('Y-m-d h:i:s A').'] '.$status.': '.implode(' ', $parts);
        echo $line.PHP_EOL;
        file_put_contents(APPPATH.'logs/jantri-schedule.log', $line.PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function log_db_error($condition, $details = array())
    {
        $error = $this->db->error();
        if (empty($error['code'])) return;
        $details['db_error_code'] = $error['code'];
        $details['db_error_message'] = $error['message'];
        $details['last_query'] = $this->db->last_query();
        $this->log_event('fail', $condition, $details);
    }
}

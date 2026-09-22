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
        $masters = $this->db->where('is_master', 1)->where('status', 1)->where('automatic_jantri', 1)->where('is_locked', 0)->get('tbl_ledger')->result_array();
        foreach ($masters as $master) {
            $timings = $this->Tbl_shift_model->get_automatic_jantri_timings($master['id'], $businessDate);
            foreach ($timings as $timing) {
                $cutoff = jantri_cutoff_datetime($businessDate, $timing['master']);
                if (!$cutoff) {
                    $this->write_jantri_cron_log(
                        "time not matched: invalid cutoff master={$master['id']} shift={$timing['id']} business_date={$businessDate} shift_time={$timing['master']} now=".$now->format('Y-m-d h:i:s A')
                    );
                    continue;
                }
                if ($now < $cutoff) {
                    $this->write_jantri_cron_log(
                        "time not matched: condition failed master={$master['id']} shift={$timing['id']} business_date={$businessDate} shift_time={$timing['master']} now=".$now->format('Y-m-d h:i:s A').' cutoff='.$cutoff->format('Y-m-d h:i:s A')
                    );
                    continue;
                }
                $this->write_jantri_cron_log(
                    "time matched: condition passed master={$master['id']} shift={$timing['id']} business_date={$businessDate} shift_time={$timing['master']} now=".$now->format('Y-m-d h:i:s A').' cutoff='.$cutoff->format('Y-m-d h:i:s A')
                );
                $nextDate = date('Y-m-d', strtotime($businessDate . ' +1 day'));
                $sent = $this->db->where('shift_id', $timing['id'])->where('party_id', $master['id'])->where('t_date >=', $businessDate . ' 00:00:00')->where('t_date <', $nextDate . ' 00:00:00')->where('show_to_admin', 1)->count_all_results('tbl_master_transaction');
                if ($sent) continue;
                $currentMaster = $this->db->where('id', $master['id'])->where('status', 1)->where('automatic_jantri', 1)->where('is_locked', 0)->get('tbl_ledger')->row_array();
                if (!$currentMaster) continue;
                $this->session->set_userdata(array('id' => $master['id'], 'userid' => $master['id']));
                $rows = $this->Tbl_transactions_model->get_custom_transactions_total_shift_master($timing['id'], $businessDate);
                if (!$rows) continue;
                $cells = jantri_automatic_cells($rows);
                $post = array('shift' => $timing['id'], 'party' => $master['id'], 'dateoftrn' => $businessDate, 'ttamntt' => array_sum($cells), 'trn_number' => array(), 'trn_amount' => array());
                foreach ($cells as $number => $amount) if ($amount > 0) { $post['trn_number'][] = $number == 100 ? '00' : sprintf('%02d', $number); $post['trn_amount'][] = $amount; }
                if (!$post['trn_number']) continue;
                $this->db->trans_start();
                $sentId = $this->send_automatic($post, $master);
                $this->db->trans_complete();
                if ($sentId && $this->db->trans_status()) $this->write_jantri_cron_log("sent master={$master['id']} shift={$timing['id']} date={$businessDate}");
            }
        }
    }

    private function send_automatic($post, $master)
    {
        if ($this->CoinModel->get_coin_balance($master['id']) < $post['ttamntt']) { log_message('error', 'Automatic Jantri skipped: insufficient balance for master ' . $master['id']); return false; }
        if (!$this->CoinModel->allocateCoins($master['id'], 1, $post['ttamntt'])) return false;
        $opening = $this->Tbl_openno_model->ledger_till_date_result_today(array('ledger_id' => $master['id'], 'date' => $post['dateoftrn']));
        $this->Tbl_transactions_model->updateclosing($opening, $master['id'], $post['dateoftrn']);
        $id = $this->Tbl_transactions_model->add_tbl_transaction(array('shift_id' => $post['shift'], 'party_id' => $master['id'], 'master_id' => $master['id'], 't_date' => $post['dateoftrn'], 'total_number_amount' => $post['ttamntt'], 'total_akhar_amount' => 0, 'show_to_admin' => 1));
        if (!$id) return false;
        $this->Tbl_transactions_model->add_tbl_only_transaction_may($id, $post);
        return $id;
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
}

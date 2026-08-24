<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddCoin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_coin($data) {
        return $this->db->insert('AddCoin', $data);
    }

    public function get_coin($id) {
        return $this->db->get_where('AddCoin', array('ID' => $id))->row_array();
    }

    public function get_all_coins() {
        return $this->db->get('AddCoin')->result_array();
    }

    public function update_coin($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update('AddCoin', $data);
    }

    public function delete_coin($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('AddCoin');
    }
}

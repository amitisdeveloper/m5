<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddCoin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AddCoin_model');
        $this->load->helper('url');
    }

    public function index() {
        $data['coins'] = $this->AddCoin_model->get_all_coins();
        $this->load->view('addcoin/index', $data);
    }

    public function view($id) {
        $data['coin'] = $this->AddCoin_model->get_coin($id);
        $this->load->view('addcoin/view', $data);
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('addcoin/create');
        } else {
            $data = array(
                'MasterID' => $this->input->post('masterid'),
                'ClientID' => $this->input->post('clientid'),
                'Amount' => $this->input->post('amount'),
                'CreaterDate' => $this->input->post('createdate'),
                'CreatedTime' => $this->input->post('createtime'),
                'CreatedBy' => $this->input->post('createdby'),
                'ModifyDate' => $this->input->post('modifydate'),
                'ModifyTime' => $this->input->post('modifytime'),
                'ModifyBy' => $this->input->post('modifyby')
            );
            $this->AddCoin_model->insert_coin($data);
            redirect('addcoin');
        }
    }

    public function edit($id) {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['coin'] = $this->AddCoin_model->get_coin($id);

        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('addcoin/edit', $data);
        } else {
            $update_data = array(
                'MasterID' => $this->input->post('masterid'),
                'ClientID' => $this->input->post('clientid'),
                'Amount' => $this->input->post('amount'),
                'CreaterDate' => $this->input->post('createdate'),
                'CreatedTime' => $this->input->post('createtime'),
                'CreatedBy' => $this->input->post('createdby'),
                'ModifyDate' => $this->input->post('modifydate'),
                'ModifyTime' => $this->input->post('modifytime'),
                'ModifyBy' => $this->input->post('modifyby')
            );
            $this->AddCoin_model->update_coin($id, $update_data);
            redirect('addcoin');
        }
    }

    public function delete($id) {
        $this->AddCoin_model->delete_coin($id);
        redirect('addcoin');
    }
}

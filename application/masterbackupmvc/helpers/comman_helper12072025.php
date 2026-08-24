<?php

defined('BASEPATH') OR exit('No direct script access allowed');



if (!function_exists('pre')) {

		function pre($data) {

			echo '<pre>';

			print_r($data);

			echo '</pre>'; 

            die();

		}

	}

if (!function_exists('update_coin_balance')) {
    function update_coin_balance() { 
        $CI =& get_instance(); // Get the CodeIgniter instance
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

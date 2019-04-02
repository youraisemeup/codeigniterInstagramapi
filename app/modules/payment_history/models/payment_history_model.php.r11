<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class payment_history_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getPaymentHistory(){
		$accounts = $this->model->fetch("*", PAYMENT_HISTORY, "", "id", "asc");
		if(!empty($accounts)){
			foreach ($accounts as $key => $row) {
				$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
				if(!empty($user)){
					$accounts[$key]->user = $user->fullname;
				}else{
					$accounts[$key]->user = "";
				}
			}
		}

		return $accounts;
	}
}

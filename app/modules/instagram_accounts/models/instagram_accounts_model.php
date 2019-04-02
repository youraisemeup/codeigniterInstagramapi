<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class instagram_accounts_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getAccounts(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, getDatabyUser(0), "id", "asc");
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

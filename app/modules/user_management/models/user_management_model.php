<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_management_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getUserList(){
		$result = $this->model->fetch("*", USER_MANAGEMENT, "", "id", "DESC");
		if(!empty($result)){
			foreach ($result as $key => $row) {
				$package = $this->model->get("*", PACKAGE, "id = '".$row->package_id."' AND status = 1");
				if(!empty($package)){
					$result[$key]->package_name = $package->name;
				}
			}
		}
		return $result;
	}
}

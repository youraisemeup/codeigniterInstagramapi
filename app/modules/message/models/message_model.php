<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class message_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getAllSchedules(){
		$this->db->select("*");
		$this->db->where("type = 'message'");
		$this->db->where("uid = '".session("uid")."'");
		$this->db->order_by("id", "desc");
		$query = $this->db->get(INSTAGRAM_SCHEDULES);
		$result = $query->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$this->db->select("*");
				$this->db->where("type = 'message'");
				$this->db->where("uid = '".$row->uid."'");
				$this->db->where("account_id = '".$row->account_id."'");
				$history = $this->db->get(INSTAGRAM_HISTORY);
				$result1 = $history->result();
				$result[$key]->like_count = $history->num_rows();
			}
		}
		return $result;
	}
}

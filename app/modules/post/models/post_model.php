<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class post_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}


	public function getAllAccount(){
		$cate   = $this->model->get("*", CATEGORIES, "id = '".session("category")."' AND category = 'post'");

		$this->db->select("*");

		if(session("category") && !empty($cate)){
			$group_id = json_decode($cate->data);
			if(!empty($group_id)){
				$this->db->where_in("username", $group_id);
			}
		}
		
		$this->db->where("status = 1");
		$this->db->where("uid = '".session("uid")."'");
		$this->db->order_by("id", "desc");
		$query = $this->db->get(INSTAGRAM_ACCOUNTS);
		$result = $query->result();

		return $result;
	}
}

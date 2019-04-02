<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class save_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getSave($type = ""){
		$this->db->select("*");
		switch ($type) {
			case 'post': 
				if(!permission("post")){
					redirect(PATH);
				}
				$this->db->where("category = '".$type."'");
				break;

			case 'friend':
				if(!permission("post_wall_friends")){
					redirect(PATH);
				}
				$this->db->where("category = '".$type."'");
				break;

			case 'message':
				if(!permission("direct_message")){
					redirect(PATH);
				}
				$this->db->where("category = '".$type."'");
				break;

			case 'comment':
				if(!permission("comment")){
					redirect(PATH);
				}
				$this->db->where("category = '".$type."'");
				break;
		}

		if(IS_ADMIN != 1){
			$this->db->where('uid', session("uid"));
		}
		$query = $this->db->get(SAVE);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
}

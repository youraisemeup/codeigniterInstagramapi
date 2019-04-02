<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class analytics_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getActivitys(){
		$result = (object)array();
		$query = $this->db->query('SELECT type, COUNT(type) AS jobcount FROM `'.INSTAGRAM_HISTORY.'` WHERE uid = '.(int)session("uid").' GROUP BY type ORDER BY jobcount DESC');

		if ($query->num_rows() > 0){
		    foreach ($query->result() as $item){
		        $data[$item->type] = $item->jobcount;
		    }
		}

		$result->like_count = isset($data['like'])?$data['like']:0;
		$result->comment_count = isset($data['comment'])?$data['comment']:0;
		$result->follow_count = isset($data['follow'])?$data['follow']:0;
		$result->followback_count = isset($data['followback'])?$data['followback']:0;
		$result->unfollow_count = isset($data['unfollow'])?$data['unfollow']:0;
		$result->repost_count = isset($data['repost'])?$data['repost']:0;
		$result->deletemedia_count = isset($data['deletemedia'])?$data['deletemedia']:0;

		return $result;
	}

	public function activity_count($type){
		$this->db->select('status, COUNT(status) as total');
		$this->db->where("category", $type);
		$this->db->where("uid", session("uid"));
		$this->db->group_by('status'); 
		$this->db->order_by('status', 'desc'); 
		$query = $this->db->get(INSTAGRAM_SCHEDULES);
		if($query->result()){
			return $query->result();
		}else{
			return false;
		}
	}
}

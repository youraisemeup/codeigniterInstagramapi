<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logs_model extends MY_Model {
	public function __construct(){
		parent::__construct();
	}

	public function getSchedules($type = ""){

        //$this->db->query("DELETE FROM instagram_history WHERE id IN (SELECT temp.id FROM (SELECT *  FROM instagram_history GROUP BY pk,type HAVING count(pk)>1) AS temp)");

        $this->db->select('history.*, account.username');

        $this->db->from(INSTAGRAM_HISTORY." as history");

        $this->db->join(INSTAGRAM_ACCOUNTS." as account", 'history.account_id = account.id');
        
        switch ($type) {
            case 'repost':
                $this->db->where("type", $type);
                break;
            case 'like':
				//echo 'My Code WILL BE HERE';die;
                $this->db->where("type", $type);
                break;
            case 'comment':
                $this->db->where("type", $type);
                break;
            case 'follow':
                $this->db->where("type", $type);
                break;
            case 'like_follow':
                $this->db->where("type", $type);
                break;
            case 'followback':
                $this->db->where("type", $type);
                break;
            case 'unfollow':
                $this->db->where("type", $type);
                break;
            case 'deletemedia':
                $this->db->where("type", $type);
                break;
        }
        $this->db->where("account.uid", session("uid"));
        if((int)post('account') != 0){
           $this->db->where("account_id", (int)post('account')); 
        }
//        $this->db->order_by("id", "desc");
        $this->db->order_by("created", "desc");
        $this->db->limit(30, (int)post("page")*30);
        $query = $this->db->get();
        if($query){
            $result = $query->result();
            return $result;
        }else{
            return false;
        }
	}

    public function countSchedules($type = ""){
        $this->db->select('history.*, account.username');
        $this->db->from(INSTAGRAM_HISTORY." as history");
        $this->db->join(INSTAGRAM_ACCOUNTS." as account", 'history.account_id = account.id');
        switch ($type) {
            case 'repost':
                $this->db->where("type", $type);
                break;
            case 'like':
                $this->db->where("type", $type);
                break;
            case 'comment':
                $this->db->where("type", $type);
                break;
            case 'follow':
                $this->db->where("type", $type);
                break;
            case 'like_follow':
                $this->db->where("type", $type);
                break;
            case 'followback':
                $this->db->where("type", $type);
                break;
            case 'unfollow':
                $this->db->where("type", $type);
                break;
            case 'deletemedia':
                $this->db->where("type", $type);
                break;
        }
        $this->db->where("account.uid", session("uid"));
        if((int)get('account') != 0){
           $this->db->where("account_id", (int)get('account')); 
        }
//        $this->db->order_by("id", "desc");
        $this->db->order_by("created", "desc");
        $query = $this->db->get();
        if($query){
            $result = (int)$query->num_rows();
            return $result;
        }else{
            return 0;
        }
    }
}
 
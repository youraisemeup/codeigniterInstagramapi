<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class activity extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
//		permission_view();
	}

	public function index(){
//
//        $CI = &get_instance();
//        $tmp_uid = $CI->session->userdata();
//        print_r($tmp_uid);
//        die();
//        $data = $this->model->getAllSchedules();
//        echo "<pre>";
//        print_r($data);
//        die();

		$data = array(
			"result"     => $this->model->getAllSchedules(),
            "startCount" => $this->common_model->fetch_data(INSTAGRAM_ACTIVITY, 'id', ['where' => ['uid' => session('uid'), 'account_id !=' => 'NULL'], 'where_in' => ['status' => [5]]], true, true),
            "stopCount" => $this->common_model->fetch_data(INSTAGRAM_ACTIVITY, 'id', ['where' => ['uid' => session('uid'), 'account_id !=' => 'NULL'], 'where_in' => ['status' => [1,3]]], true, true),
		);
		
		//Update user's last online time
        $this->common_model->update_single(USER_MANAGEMENT, ['last_active_time' => date('Y-m-d H:i:s', time())], ['where' => ['id' => session('uid')]]);


		$this->template->title(l('Dashboard'));
		
		$this->template->build('index', $data);
	}

	public function auto_activity(){
        $id = (int)get("id");

        //If ID is not present
        if (empty ($id)) {  
            redirect(PATH);
        }

        $item = $this->model->get("*", INSTAGRAM_ACTIVITY, "id = '".$id."'  AND uid = '".session("uid")."'");
        $accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
        if(!empty($item)){
            $accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "id = '".$item->account_id."' AND uid = '".session("uid")."'");
            if (empty($accounts)) {
                redirect(PATH);
            }
        } else {
            redirect(PATH);
        }
        $data = array(
            "result"     => $this->model->getAllSchedules($id),
            "accounts"   => $accounts,
            "item"       => $item,
        );
		
		$this->template->title(l('Auto activity'));
		$this->template->build('activity', $data);
	}

	public function settings(){
		$id = (int)get("id");
		$item = $this->model->get("*", INSTAGRAM_ACTIVITY, "id = '".$id."'  AND uid = '".session("uid")."'");
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		if(!empty($item)){
			$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "id = '".$item->account_id."' AND uid = '".session("uid")."'");
		}
		$data = array(
			"accounts"   => $accounts,
			"item"       => $item,     
		);
		$this->template->title(l('Auto activity')); 
		$this->template->build('update', $data);
	}

	public function disconnect(){
		$id = (int)post("id");
		$item = $this->model->get("*", INSTAGRAM_ACTIVITY, "id = '".$id."' AND uid = '".session("uid")."'");
		if(!empty($item)){
			$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$item->account_id."' AND (category = 'like' OR category = 'comment' OR category = 'follow' OR category = 'followback' OR category = 'unfollow' OR category = 'repost')");
			$this->db->delete(INSTAGRAM_HISTORY, "account_id = '".$item->account_id."'");
			$this->db->delete(INSTAGRAM_ACTIVITY, "id = '".$id."'");
			$this->db->delete(INSTAGRAM_ACCOUNTS, "id = '".$item->account_id."' AND uid = '".session("uid")."'");
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Disconnected Successfully')
		));
	}
}
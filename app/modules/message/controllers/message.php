<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class message extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$id = (int)get("id");
		$item = $this->model->get("*", INSTAGRAM_SCHEDULES, "id = '".$id."' AND type= 'message' AND uid = '".session("uid")."'");
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		if(!empty($item)){
			$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "id = '".$item->account_id."' AND uid = '".session("uid")."'");
		}
		$data = array(
			"accounts"   => $accounts,
			"item"       => $item,     
			"result"     => $this->model->getAllSchedules(),
		);
		$this->template->title(l('Auto direct message')); 
		$this->template->build('index', $data);
	}

	public function ajax_save_schedules(){
		$data = array();
		$id      = (int)post("account");
		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$id."'".getDatabyUser());
		if(!empty($account)){

			if(post('message') == ""){
				ms(array(
					"st"    => "valid",
					"label" => "bg-red",
					"txt"   => l('Message is required')
				));
			}

			$data = array(
				"category"  => "message",
				"type"      => "message",
				"message"   => post('message')
			);

			if(post("limit")){
				$limit = (int)post("limit");
			}else{
				$limit = 0;
			}

			$i = Instagram_Loader($account->username, $account->password);
			$groups = Instagram_Get_Follow($i, post("follow_type"), $limit);
		
			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			if(empty($groups)){
				ms(array(
					"st"    => "valid",
					"label" => "bg-red",
					"txt"   => l('Cannot found any users')
				));
			}

			if(post('auto_repeat') != 0){
				$data["repeat_post"] = 1;
				$data["repeat_time"] = (int)post("auto_repeat");
				$data["repeat_end"]  = date("Y-m-d", strtotime(post('repeat_end')));
			}else{
				$data["repeat_post"] = 0;
			}

			$count = 0;
			$deplay = (int)post('deplay')*60;
			$list_deplay = array();
			for ($i=0; $i < count($groups); $i++) { 
				$list_deplay[] = $deplay*$i;
			}

			$auto_pause = (int)post('auto_pause');
			if($auto_pause != 0){
				$pause = 0;
				$count_deplay = 0;
				for ($i=0; $i < count($list_deplay); $i++) { 
					$item_deplay = 1;
					if($auto_pause == $count_deplay){
						$pause += post('time_pause')*60;
						$count_deplay = 0;
					}

					$list_deplay[$i] += $pause;
					$count_deplay++;
				}
			}

			shuffle($list_deplay);

			$time_post_show = strtotime(post('time_post').":00");
			$time_now  = strtotime(NOW) + 60;
			if($time_post_show < $time_now){
				$time_post_show = $time_now;
			}

			$date = new DateTime(date("Y-m-d H:i:s", $time_post_show), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group->pk;
				$data["name"]           = $group->username;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", $time_post_show + $list_deplay[$key]);
				$data["status"]         = 1;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;
				$data["created"]        = NOW;

				$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				$count++;
			}

		
			ms(array(
				"st"    => "success",
				"label" => "bg-green",
				"txt"   => l('Successfully')
			));
		
		}else{
			ms(array(
				"st"  => "valid",
				"label" => "bg-red",
				"txt" => l('Instagram account not exist'),
			));
		}
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'");
					$this->db->delete(INSTAGRAM_HISTORY, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 5), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), "id = '{$id}'");
					break;
			}
		}

		$json= array(
			'st' 	=> 'success',
			'txt' 	=> l('successfully')
		);

		print_r(json_encode($json));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'");
							$this->db->delete(INSTAGRAM_HISTORY, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 5), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), "id = '{$id}'");
							break;
					}
				}
			}
		}

		if(post("action") == "delete_all"){
			$this->db->delete(INSTAGRAM_SCHEDULES, "category = 'message'".getDatabyUser());
			$this->db->delete(INSTAGRAM_HISTORY, "category = 'message'".getDatabyUser());
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		)));
	}
}
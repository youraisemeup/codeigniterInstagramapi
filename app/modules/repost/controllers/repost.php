<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class repost extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"result"     => $this->model->getAllSchedules()
		);
		$this->template->title(l('Auto like')); 
		$this->template->build('index', $data);
	}

	public function update(){
		$id = (int)get("id");
		$item = $this->model->get("*", INSTAGRAM_SCHEDULES, "id = '".$id."' AND type= 'like' AND uid = '".session("uid")."'");
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'");
		if(!empty($item)){
			$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "id = '".$item->account_id."' AND uid = '".session("uid")."'");
		}
		$data = array(
			"accounts"   => $accounts,
			"item"       => $item,     
		);
		$this->template->title(l('Auto like')); 
		$this->template->build('update', $data);
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'");
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
			$this->db->delete(INSTAGRAM_SCHEDULES, "category = 'repost'".getDatabyUser());
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		)));
	}
}
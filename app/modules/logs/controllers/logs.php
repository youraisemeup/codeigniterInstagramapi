<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class logs extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"result" => $this->model->countSchedules(get('action')),
			"accounts" => $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = '".session("uid")."'")
		);
		
		$this->template->title(l('Activity Log'));
		$this->template->build('index', $data);
	}

	public function ajax_page(){
		
		$result = $this->model->getSchedules(post('type'));
		
        ms(array(
			'st' 	 => 'success',
			'page'   => !empty($result)?(int)post("page")+1:-1,
			'result' => json_encode($this->load->view("ajax_logs", array("result" => $result), true)),
			'txt' 	 => l('successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'".getDatabyUser());
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'".getDatabyUser());
					break;
				
				case 'active':
					$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 1), "id = '{$id}'".getDatabyUser());
					break;

				case 'disable':
					$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 0), "id = '{$id}'".getDatabyUser());
					break;
			}
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('successfully')
		));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'".getDatabyUser());
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'");
							break;

						case 'active':
							$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 1), "id = '{$id}'".getDatabyUser());
							break;

						case 'disable':
							$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 0), "id = '{$id}'".getDatabyUser());
							break;
					}
				}
			}
		}

		if(post("action") == "delete_all"){
			$this->db->delete(INSTAGRAM_SCHEDULES, "category = '".post("category")."'".getDatabyUser());
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		));
	}
}
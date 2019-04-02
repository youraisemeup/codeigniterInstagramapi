<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class save extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$type = segment(2);
		$data = array(
			"result" => $this->model->getSave($type)
		);
		$this->template->title(l('Save management'));
		$this->template->build('index', $data);
	}
	
	public function ajax_save(){
		$data = array();
		switch (post("category")) {
			case 'post':
				switch (post('type')) {
					case 'video':
						if(post('video_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Video is required')
							));
						}

						$data = array(
							"category"    => "post",
							"type"        => post('type'),
							"image"       => post('video_url'),
							"description" => post('video_description'),
							"message"     => post('message'),
						);
						break;
					default:
						if(post('image_url') == ""){
							ms(array(
								"st"    => "valid",
								"label" => "bg-red",
								"txt"   => l('Image is required')
							));
						}

						$data = array(
							"category"  => "post",
							"type"      => post('type'),
							"image"     => post('image_url'),
							"message"   => post('message')
						);
						break;
				}
				break;
		}

		if(post('title') == ""){
			ms(array(
				"st"    => "title",
			));
		}else{
			$data["name"]    = filter_input_xss(post('title'));
			$data["uid"]     = (int)session("uid");
			$data["created"] = NOW;
			$this->db->insert(SAVE, $data);
			ms(array(
				"st"    => "success",
				"label" => "bg-light-green",
				"txt"   => l('Save successfully')
			));
		}
	}

	public function ajax_get_save(){
		$check = $this->model->get("*", SAVE, "id = '".post("value")."'".getDatabyUser());
		print_r(json_encode($check));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', SAVE, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(SAVE, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(SAVE, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(SAVE, array("status" => 0), "id = '{$id}'");
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
				$POST = $this->model->get('*', SAVE, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(SAVE, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(SAVE, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(SAVE, array("status" => 0), "id = '{$id}'");
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		)));
	}
}
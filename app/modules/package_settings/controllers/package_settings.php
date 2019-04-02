<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class package_settings extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view(true);
	}

	public function index(){
		$data = array(
			"result" => $this->model->fetch("*", PACKAGE, "", "id", "DESC")
		);
		$this->template->title(l('Package settings'));
		$this->template->build('index', $data);
	}

	public function update(){
		$data = array(
			"result" => $this->model->get("*", PACKAGE, "id = '".get("id")."'")
		);
		$this->template->title(l('Package settings'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
		$id = (int)post("id");

		if(post("name") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Name is required')
			));
		}

		$modules = array(
			"maximum_account"   => (int)post("maximum_account"),
			"post"              => (int)post("post"),
			"message"           => (int)post("message"),
			"activity"          => (int)post("activity"),
			"search"            => (int)post("search"),
			"download"          => (int)post("download")
		);

		if(post("type") == ""){
			if(post("price") == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Price is required')
				));
			}

			if(post("day") == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Day is required')
				));
			}

			$data = array(
				"name"  => post("name"),
				"type"  => 2,
				"price" => (float)post("price"),
				"day"   => (int)post("day"),
				"orders"=> (int)post("orders"),
				"permission" => json_encode($modules),
				"default_package" => (int)post("default"),
				"changed" => NOW
			);
		}else{
			$data = array(
				"name"  => post("name"),
				"type"  => (int)post("type"),
				"price" => 0,
				"day"   => (int)post("day"),
				"orders"=> (int)post("orders"),
				"permission" => json_encode($modules),
				"default_package" => (int)post("default"),
				"changed" => NOW
			);
		}
		
		if($id == 0){
			$data['created'] = NOW;
			$this->db->insert(PACKAGE, $data);
			$id = $this->db->insert_id();
		}else{
			$this->db->update(PACKAGE, $data, array("id" => $id));
		}

		if((int)post("default") == 1){
			$this->db->update(PACKAGE, array("default_package" => 0), "id != '".$id."'");
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', PACKAGE, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(PACKAGE, "id = '{$id}' AND type = '2'");
					break;
				
				case 'active':
					$this->db->update(PACKAGE, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(PACKAGE, array("status" => 0), "id = '{$id}'");
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
				$POST = $this->model->get('*', PACKAGE, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(PACKAGE, "id = '{$id}' AND type = '2'");
							break;
						case 'active':
							$this->db->update(PACKAGE, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(PACKAGE, array("status" => 0), "id = '{$id}'");
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
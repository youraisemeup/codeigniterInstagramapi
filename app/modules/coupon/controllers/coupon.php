<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class coupon extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view(true);
	}

	public function index(){
		$data = array(
			"result" => $this->model->fetch("*", COUPON, "", "id", "DESC")
		);
		$this->template->title(l('Package settings'));
		$this->template->build('index', $data);
	}

	public function update(){
		$data = array(
			"result"   => $this->model->get("*", COUPON, "id = '".get("id")."'"),
			"packages" => $this->model->fetch("*", PACKAGE, "type = 2", "id", "DESC")
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

		if(post("code") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Coupon is required')
			));
		}

		if(post("price") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Price is required')
			));
		}

		if(post("date_expiration") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Date expritation is required')
			));
		}

		$data = array(
			"name"            => post("name"),
			"type"            => ((int)post("type")==1)?1:2,
			"code"            => post("code"),
			"price"           => (float)post("price"),
			"date_expiration" => post("date_expiration"),
			"packages"        => json_encode($this->input->post("packages")),
			"changed"         => NOW
		);
		
		if($id == 0){
			$data['created'] = NOW;
			$this->db->insert(COUPON, $data);
			$id = $this->db->insert_id();
		}else{
			$this->db->update(COUPON, $data, array("id" => $id));
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', COUPON, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(COUPON, "id = '{$id}' AND type = '2'");
					break;
				
				case 'active':
					$this->db->update(COUPON, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(COUPON, array("status" => 0), "id = '{$id}'");
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
				$POST = $this->model->get('*', COUPON, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(COUPON, "id = '{$id}' AND type = '2'");
							break;
						case 'active':
							$this->db->update(COUPON, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(COUPON, array("status" => 0), "id = '{$id}'");
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
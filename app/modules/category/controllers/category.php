<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class category extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function ajax_add_category(){
		if(empty(post('id'))){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Select at least a item')
			));
		}

		$array = array();

		$groups = post('id');
		foreach ($groups as $key => $group) {
			$array[] = $group;
		}

		if(post('title') == ""){
			ms(array(
				"st"    => "title"
			));
		}else{
			$data = array(
				"uid"     => session("uid"),
				"category"=> post("category"),
				"name"    => post("title"),
				"data"    => json_encode($array),
				"created" => NOW
			);
			$this->db->insert(CATEGORIES, $data);

			ms(array(
				"st"    => "success",
				"label" => "bg-light-green",
				"txt"   => l('Successfully')
			));
		}
	}

	public function ajax_update_category(){
		if(empty(post('id'))){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Select at least a Page/Group/Profile')
			));
		}

		$array = array();

		$groups = post('id');
		foreach ($groups as $key => $group) {
			$group  = explode("{-}", $group);
			$array[] = $group[3];
		}

		$category = $this->model->get("*", CATEGORIES, "id = '".post("cid")."'".getDatabyUser());
		if(empty($category)){
			ms(array(
				"st"    => "id"
			));
		}else{
			$cur_array = json_decode($category->data);
			$new_array = (array)array_unique(array_merge_recursive($cur_array, $array));

			$data = array(
				"uid"     => session("uid"),
				"data"    => json_encode($new_array),
				"created" => NOW
			);
			$this->db->update(CATEGORIES, $data, "id = '".post("cid")."'");

			ms(array(
				"st"    => "success",
				"label" => "bg-light-green",
				"txt"   => l('Successfully')
			));
		}
	}

	public function ajax_get_category(){
		$result = $this->model->get("*", CATEGORIES, "id  = '".post("id")."'".getDatabyUser());
		if(!empty($result)){
			set_session("category", $result->id);
		}else{
			unset_session("category");
		}
		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Successfully')
		));
	}

	public function ajax_delete_category(){
		$this->db->delete(CATEGORIES, "id  = '".post("id")."'".getDatabyUser());
		unset_session("category");
		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Successfully')
		));
	}

}
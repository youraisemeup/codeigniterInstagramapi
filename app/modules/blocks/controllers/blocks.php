<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class blocks extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function header(){
		$data = array(
			"lang" => getListLang()
		);
		$this->load->view('header', $data);
	}
	
	public function sidebar(){
		$data = array();
		$this->load->view('sidebar', $data);
	}

	public function footer(){
		$data = array();
		$this->load->view('footer', $data);
	}

	public function language(){
		setLang();
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class analytics extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$i = Instagram_Loader("tienpham1606", "nguoidacbiet");
		$data = $i->getInsights();

		pr($data,1);
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class payment_settings extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view(true);
		if(hashcheck()){
			redirect(PATH);
		}
	}

	public function index(){
		$data = array(
			"result" => $this->model->get("*", PAYMENT)
		);
		$this->template->title(l('Payment settings'));
		$this->template->build('index', $data);
	}

	public function ajax_update(){
		$id = (int)post("id");

		if(post("paypal_email") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Paypal email is required')
			));
		}

		if(post("currency") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Currency is required')
			));
		}

		$data = array(
			"paypal_email"    => post("paypal_email"),
			"stripe_email"    => post("stripe_email"),
			"stripe_pk"       => post("stripe_pk"),
			"stripe_sk"       => post("stripe_sk"),
			"pagseguro_email" => post("pagseguro_email"),
			"pagseguro_token" => post("pagseguro_token"),
			"sandbox"         => (int)post("sandbox"),
			"currency"        => post("currency"),
			"symbol"          => post("symbol")
		);

		$this->db->update(PAYMENT, $data, array("id" => $id));

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}
}
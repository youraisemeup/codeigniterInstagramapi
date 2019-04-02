<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class payment_history extends MX_Controller {

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
			"result" => $this->model->getPaymentHistory()
		);

		$this->template->title(l('Payment history'));
		$this->template->build('index', $data);
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', PAYMENT_HISTORY, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(PAYMENT_HISTORY, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(PAYMENT_HISTORY, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(PAYMENT_HISTORY, array("status" => 0), "id = '{$id}'");
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
				$POST = $this->model->get('*', PAYMENT_HISTORY, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(PAYMENT_HISTORY, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(PAYMENT_HISTORY, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(PAYMENT_HISTORY, array("status" => 0), "id = '{$id}'");
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('-successfully')
		)));
	}

}
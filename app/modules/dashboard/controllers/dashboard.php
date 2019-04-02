<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class dashboard extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, getDatabyUser(0));

		$activity = $this->model->getActivitys();

		//PROCESS GROUPS
		$group_count = array(
			"profile" => count($accounts),
		);

		//POST
		$post_count = $this->model->activity_count("post");

		$post = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);

		if(!empty($post_count)){

			$total_post = array_sum(array_map(function($item) { 
			    return $item->total; 
			}, $post_count));

			$post['total'] = $total_post;
			foreach ($post_count as $key => $row) {
				switch ($row->status) {
					case 1:
						$post['processing'] = $row->total;
						break;

					case 3:
						$post['success'] = $row->total;
						break;

					case 4:
						$post['failure'] = $row->total;
						break;

				}
			}
		}

		//MESSAGE
		
		
		//POST
		$message_count = $this->model->activity_count("message");

		$message = array(
			"total"        => 0,
			"queue"        => 0,
			"success"      => 0,
			"failure"      => 0,
			"processing"   => 0,
			"repeat"       => 0,
		);

		if(!empty($message_count)){
			$total_message = array_sum(array_map(function($item) { 
			    return $item->total; 
			}, $message_count));

			$message['total'] = $total_message;

			foreach ($message_count as $key => $row) {
				switch ($row->status) {
					case 1:
						$message['processing'] = $row->total;
						break;

					case 3:
						$message['success'] = $row->total;
						break;

					case 4:
						$message['failure'] = $row->total;
						break;

				}
			}
		}

		$data = array(
			'group'             => (object)$group_count,
			'post'              => (object)$post,
			'message'           => (object)$message,
			'activity'          => $activity
		);

		$this->template->title('Dashboard');
		$this->template->build('index', $data);
	}
	
}
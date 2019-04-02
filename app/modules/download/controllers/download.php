<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class download extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){
		$data = array(
			"accounts" => $account = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, getDatabyUser(0))
		);
		$this->template->title(l('Instagram search'));
		$this->template->build('index', $data);
	}

	public function ajax_search(){
		$id      = (int)post("account");
		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$id."'".getDatabyUser());

		if(!empty($account)){
			//Add Proxy
			$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
			if(!empty($proxy_item)){
				$proxy = $proxy_item->proxy;
			}else{
				$proxy = "";
			}
			$i = Instagram_Loader($account->username, $account->password, $proxy);

			if(post("keyword")){
				switch (post("type")) {
					case 'tag':
						$result = Instagram_Get_Feed($i, 'search_tags', post("keyword"));

						ms(array(
							"st"  => "success",
							"label" => "bg-green",
							"txt" => l('Successfully'),
							"result" => json_encode($this->load->view("ajax_search_tags", array("result" => $result), true))
						));
						break;

					case 'download':
						$result = Instagram_Get_Feed($i, 'feed', post("keyword"));
						ms(array(
							"st"  => "success",
							"label" => "bg-green",
							"txt" => l('Successfully'),
							"result" => json_encode($this->load->view("ajax_download", array("result" => $result), true))
						));
						break;
					
					default:
						$result = Instagram_Get_Feed($i, 'search_users', post("keyword"));

						ms(array(
							"st"  => "success",
							"label" => "bg-green",
							"txt" => l('Successfully'),
							"result" => json_encode($this->load->view("ajax_search_usernames", array("result" => $result), true))
						));
						break;
						break;
				}
			}else{
				if(post("type") != "download"){
					ms(array(
						"st"  => "error",
						"label" => "bg-red",
						"txt" => l('Please enther media url or media ID'),
					));
				}else{
					ms(array(
						"st"  => "error",
						"label" => "bg-red",
						"txt" => l('Keyword is required'),
					));
				}
			}
		}else{
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Instagram account not exist'),
			));
		}
	}
}
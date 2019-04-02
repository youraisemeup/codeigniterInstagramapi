<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class stats extends MX_Controller {

    public function __construct(){
        parent::__construct();
//        $this->load->model(get_class($this).'_model', 'model');
        $this->load->model('common_model');
    }

    public function index(){

	
//        permission_view(true);
        if((int)get('id') == ''){
            redirect(base_url());
        }

        $result = $this->db->get_where(INSTAGRAM_ACCOUNTS,['id'=>(int)get('id'),'uid'=>session("uid")]);
        $result2 = $this->db->get_where(INSTAGRAM_ACTIVITY,['account_id'=>(int)get('id'),'uid'=>session("uid")]);

        if ($result->num_rows()>0) {
            $resp = $result->result_array();
        } else {
            redirect(base_url());
        }

        if ($result2->num_rows()>0) {
            $resp2 = $result2->result_array();
        } else {
            redirect(base_url());
        }
        $data = array(
            "result" => $resp,
            "act_id" => $resp2[0]['id']
        );
        $this->template->title(l('Stats'));
        $this->template->build('index', $data);
    }

    public function getdata(){
		$url = 'https://getigdata.com/Api?username='.get('username');
	
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		$insta_source = curl_exec($ch);
		curl_close($ch);
        //$insta_source = @file_get_contents('https://getigdata.com/Api?username='.get('username'));
        if ($insta_source === FALSE) {

            $insta_source = [
                'status' => 1,
                'newuser' => 0,
                'insta_account' => '',
                'sevenrecent' => '',
                'thirtyrecent' => '',
                'post' => '',
                'msg' => "Something Went Wrong"
            ];

        }
        echo json_encode($insta_source);

    }


}
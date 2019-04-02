<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class demo extends MX_Controller {

    public function __construct(){
        parent::__construct();
//        $this->load->model(get_class($this).'_model', 'model');
//        $this->load->model('common_model');
    }

    public function index(){


//        permission_view(true);
//        if((int)get('id') == ''){
//            redirect(base_url());
//        }
//
//        $result = $this->db->get_where(INSTAGRAM_ACCOUNTS,['id'=>(int)get('id'),'uid'=>session("uid")]);
//
//        if ($result->num_rows()>0) {
//            $resp = $result->result_array();
//        } else {
//            redirect(base_url());
//        }
//        $data = array(
//            "result" => $resp
//        );
        $this->template->set_layout("demo");
        $this->template->title(l('DemoSettings'));
        $this->template->build('index', '');
//        $this->load->views('demo');
    }


}
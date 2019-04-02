<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class publish extends MX_Controller {

    public function __construct(){
        parent::__construct();
//        $this->load->model(get_class($this).'_model', 'model');
//        permission_view();
    }

    public function post($Post){

        echo "hello";
        die();

    }
}
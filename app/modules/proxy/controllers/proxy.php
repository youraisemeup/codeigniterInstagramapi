<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Spreadsheet
use PhpOffice\PhpSpreadsheet\IOFactory;


use GuzzleHttp\TransferStats;
class proxy extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		$this->load->model('common_model');
		$this->load->library('session');
		$this->load->library('PHPExcel');
	}

	public function index(){

		//If importing file
		//echo phpinfo();
		//echo '<pre>';var_dump(get_loaded_extensions());die;
		if (!empty ($_FILES['import_proxies']['tmp_name'])) {
			
			$fileLink = $_FILES['import_proxies']['tmp_name'];
			$filename = $_FILES['import_proxies']['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			//echo '<pre>';print_r($ext);die;
			if($ext == 'csv'){
				$objReader = PHPExcel_IOFactory::createReader('CSV');
			}else{
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			}
			
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($fileLink);
			$rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
			$sheetData = array();
			foreach($rowIterator as $row){
				$cellIterator = $row->getCellIterator();
				foreach ($cellIterator as $cell) {
					$sheetData[$row->getRowIndex()][$cell->getColumn()] = $cell->getCalculatedValue();
				}
			}

			
			//If sheet is empty
			if(count($sheetData) < 2) {

				//Set error message
				$this->session->set_flashdata('error', l('Uploaded file is invalid or not in correct format.'));

				//Redirect
				redirect($this->uri->uri_string(), 'refresh');
			}

			$insertArray = $proxyList = $skipRows = [];
			foreach ($sheetData as $k => $row) {

				//Skip first row
				if ($k == 1) {
					continue;
				}

				//To check for existing
				$proxyList[$k] = $row['B'];

				//Inserting in array to be inserted in database later
				$insertArray[$k] = [
								'name'    => $row['A'],
								'proxy'   => $row['B'],
								'uid'     => 0,
								'status'  => 1,
								'is_working' => 0,
								'changed' => date('Y-m-d H:i:s', time()),
								'created' => date('Y-m-d H:i:s', time()),
				];
			}

			//Check if proxies already exists
			$checkExist = $this->common_model->fetch_data(PROXY, 'proxy', ['where_in' => ['proxy' => $proxyList]]);

			//If proxies exists
			if (count ($checkExist) > 0) {
				//Iterating all existing proxies
				foreach ($checkExist as $row) {

					//If this proxy exists in uploaded proxies list
					while(is_numeric(array_search($row['proxy'], $proxyList))) {
						$proxyKey = array_search($row['proxy'], $proxyList);
						//echo $proxyKey . '<br>';

						//Searching this proxy in uploaded proxies list
						$skipRows[] = $proxyKey;
						unset($insertArray[$proxyKey]);
						unset($proxyList[$proxyKey]);
					}
				}
			}

			//If any rows have been skipped
			$messageSuffix = '';
			if (count ($skipRows) > 0) {
				$messageSuffix .= '<br/>' . count($skipRows) . ' ' . 'proxies skipped.' . '<br />';
			}

			//If there are still any new proxies to be inserted
			if (count($insertArray) > 0) {

				//Insert all proxies in database
				$this->common_model->insert_batch(PROXY, $insertArray);

				//For proper message
				$proxyCount = count ($insertArray);

				//Set error message
				$this->session->set_flashdata('success', $proxyCount . ' ' . 'proxies successfully imported.' . $messageSuffix);
			} else {
				//Set error message
				$this->session->set_flashdata('success', 'All duplicate proxies skipped.');
			}

			//Redirect to current page
			redirect($this->uri->uri_string(), 'refresh');
			
		}
				/*
				$file = $_FILES['import_proxies']['name'];
				$rand  = rand(1000,9999);
				$nameoffile = $rand;
				$files = preg_replace('/\s+/', '_', $file);
				$config['upload_path']          = './uploads/xls/';
				$config['allowed_types']        = 'xlsx|xls|csv';
				$config['file_name']            = strtolower($nameoffile.$files);
				//   $nameofifile = 'notes/admin/'.strtolower($nameofimg.$_FILES['photo']['name']);
				$nameofifile = "uploads/xls/".strtolower($nameoffile.$files);
				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload('import_proxies'))
				{
					$error = array('error' => $this->upload->display_errors());
					echo $this->upload->display_errors();
					die();
					echo "<script>alert('".$this->upload->display_errors()."')</script>";
					// print_r($error);
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());

					// print_r($data);
					$save = array(
					'FilePath'  => base_url().$nameofifile,
					'FilePath'  => BASE."".$nameofifile,
					'Status' => 1
					);
					$this->ExcelUpload_Model->saveData($save);
					$this->db->insert('tbl_CSV_File', $save);
					$lnk = BASE."".$nameofifile;
					$this->Select_path($nameofifile);
					echo "<script>alert('File Inserted Successfully')</script>";
					$this->load->view('Admin/ShowLanguage', $data);
				}

				*/

			/*if($_POST['import_proxies'] == '') {

					//Set error message
					$this->session->set_flashdata('error', l('Does not contain any proxy.'));

					//Redirect
					redirect($this->uri->uri_string(), 'refresh');
			}


            $proxy_name = explode(";",$_POST['import_proxies']);

            for($i=0;$i < count($proxy_name);$i++){

                if($proxy_name[$i] == ''){
                    continue;
                }

                $newproxy_name = explode(",",$proxy_name[$i]);
                $name = $newproxy_name[0];
                $proxy = $newproxy_name[1];


                $proxyList[$i] = $proxy;

                $insertArray[$i] = [
                    'name'    => $name,
                    'proxy'   => $proxy,
                    'uid'     => $this->session->userdata('id'),
                    'status'  => 1,
                    'is_working' => 0,
                    'changed' => date('Y-m-d H:i:s', time()),
                    'created' => date('Y-m-d H:i:s', time()),
                ];

				array_push($fulldata,$insertArray);
            }

            //Check if proxies already exists
            $checkExist = $this->common_model->fetch_data(PROXY, 'proxy', ['where_in' => ['proxy' => $proxyList]]);

            //If proxies exists
            if (count ($checkExist) > 0) {

                //Iterating all existing proxies
                foreach ($checkExist as $row) {

                    //If this proxy exists in uploaded proxies list
                    while(is_numeric(array_search($row['proxy'], $proxyList))) {
                        $proxyKey = array_search($row['proxy'], $proxyList);
                        echo $proxyKey . '<br>';

                        //Searching this proxy in uploaded proxies list
                        $skipRows[] = $proxyKey;
                        unset($insertArray[$proxyKey]);
                        unset($proxyList[$proxyKey]);
                    }
                }
            }

            $messageSuffix = '';

            //If there are still any new proxies to be inserted
            if (count($insertArray) > 0) {

                //Insert all proxies in database
                $this->common_model->insert_batch(PROXY, $insertArray);

                //For proper message
                $proxyCount = count ($insertArray);

                //Set error message
                $this->session->set_flashdata('success', $proxyCount . ' ' . l('proxies successfully imported.') . $messageSuffix);
            } else {

                //Set error message
                $this->session->set_flashdata('success', l('All duplicate proxies skipped.'));
            }

            //Redirect to current page
            redirect($this->uri->uri_string(), 'refresh');



		}*/

		$proxyList = $this->common_model->fetch_data(PROXY .' AS p', '*, (SELECT COUNT(id) FROM ' . INSTAGRAM_ACCOUNTS . ' AS ia WHERE ia.uid != 0 AND ia.uid = p.uid) AS ig_accounts_count', ['order_by' => ['id' => 'DESC']]);

		$proxies = "";
		$proxies = $this->model->fetch("*", PROXY, "uid = '".$this->session->userdata('uid')."'", "id", "DESC");

        if($this->session->userdata('admin') == 1){

            $proxies = $this->db->select('p.*')
                ->from('proxy AS p')
                ->order_by('p.id', 'DESC')
                ->get();
            if ($proxies->num_rows() > 0) {
                $proxyresp = $proxies->result_array();
            } else {
                $proxyresp = '';
            }
			//echo '<pre>';print_r($proxyresp);die;
            if (!empty($proxyresp)) {
                foreach ($proxyresp as $key => $value) {

					//$ig_accounts = $this->model->get("count(*) as instagram_accounts ",INSTAGRAM_ACCOUNTS,"`proxy`=".$value->id)->ig_accounts;

                    $accountscount = $this->db->select('count(*) as instagram_accounts')
                        ->from(INSTAGRAM_ACCOUNTS)
                        ->where('proxy', $value['id'])
                        ->get();

                    $ig_accounts = $accountscount->result_array();

                    if (isset($ig_accounts)) {
                        $this->db->update(PROXY, array("ig_accounts" => $ig_accounts[0]['instagram_accounts']), "`id`=" . $value['id']);
                        $proxyresp[$key]['ig_accounts'] = $ig_accounts[0]['instagram_accounts'];
                    }
                }
            }

        }else {


            $proxies = $this->db->select('p.*')
                ->from('proxy AS p')
                ->where('p.uid', $this->session->userdata('uid'))
                ->order_by('p.id', 'DESC')
                ->get();
            if ($proxies->num_rows() > 0) {
                $proxyresp = $proxies->result_array();
            } else {
                $proxyresp = '';
            }

            if (!empty($proxyresp)) {
                foreach ($proxyresp as $key => $value) {

					$ig_accounts = $this->model->get("count(*) as instagram_accounts ",INSTAGRAM_ACCOUNTS,"`proxy`=".$value->id)->ig_accounts;

                    $accountscount = $this->db->select('count(*) as instagram_accounts')
                        ->from(INSTAGRAM_ACCOUNTS)
                        ->where('proxy', $value['id'])
                        ->get();

                    $ig_accounts = $accountscount->result_array();

                    if (isset($ig_accounts)) {
                        $this->db->update(PROXY, array("ig_accounts" => $ig_accounts[0]['instagram_accounts']), "`id`=" . $value['id']);
                        $value->ig_accounts = $ig_accounts[0]['instagram_accounts'];
                    }
                }
            }
        }



        $data = array(
			//"result" => $proxyList,
			"result" => $proxyresp 
		);
		$this->template->title(l('Proxy management'));
		$this->template->build('index', $data);
	}

    public function applyproxy(){ 

        $uid = $this->session->userdata('uid');

        if($this->session->userdata('admin') == 1){

            $insta = $this->db->select('*')
                ->from(INSTAGRAM_ACCOUNTS)
                ->where('proxy',0)
                ->where('status',1)
                ->order_by('id','DESC')
                ->limit(50)
                ->get();
 
        }else{
            $insta = $this->db->select('*')
                ->from(INSTAGRAM_ACCOUNTS)
                ->where('uid',$uid)
                ->where('proxy',0)
                ->order_by('id','DESC')
                ->get();
        }
		
        if($insta->num_rows() > 0){

            $instaresp = $insta->result_array();
			//echo '<pre>';print_r($instaresp);die;

            foreach ($instaresp as $key => $value) {

                if($this->session->userdata('admin') == 1){
                    $proxies = $this->db->select('p.*')
                        ->from('proxy AS p')
						->where('p.uid',0)
						->where('p.ig_accounts',0)
//                    ->order_by('p.id','DESC')
                        ->order_by('rand()')
                        ->limit(1)
                        ->get();
                }else{
                    $proxies = $this->db->select('p.*')
                        ->from('proxy AS p')
                        ->where('p.uid',$uid)
						->where('p.ig_accounts',0)
//                    ->order_by('p.id','DESC')
                        ->order_by('rand()')
                        ->limit(1)
                        ->get();
                }

				
                if($proxies->num_rows() > 0){
					
                    $proxyresp = $proxies->result_array();
					
                    $this->db->update(INSTAGRAM_ACCOUNTS,array("proxy"=>$proxyresp[0]['id']),"`id`=".$value['id']);


                }else{
                    $this->session->set_flashdata('error', l('Do not have any account without proxy.'));
//                    redirect($this->uri->uri_string(), 'refresh');
                    redirect('proxy');
                }

            }

            $this->session->set_flashdata('success', l('Proxies Applied.'));

   
        }else{
            $proxyresp = '';

            $this->session->set_flashdata('error', l('You do not any account to apply.'));
        }
//        redirect($this->uri->uri_string(), 'refresh');
//        redirect('index.php/proxy');
        redirect('proxy');
    }

    public function Select_path($nameofifile)
    {
        ini_set('max_execution_time', 10000);

        $this->db->select('*');
        $this->db->from('tbl_CSV_File');
        $this->db->like('FilePath',$nameofifile);
        $data = $this->db->get();
        if($data->num_rows()>0){

            $dataitem = $data->result_array();

        }else{
            redirect(BASE."index.php/proxy");
        }

//
//        print_r($dataitem);
//        die();
//echo "hello";
        $this->load->library('PHPExcel');//load PHPExcel l
//echo "hii";
//         if(count($dataitem)>0)
        if(true)
        {
            $FilePath = $dataitem[0]['FilePath'];
            $id = $dataitem[0]['id'];


            //  echo base_url()."<br>";
//            $filename = str_replace(base_url(),"",$FilePath);
            $filename = str_replace(BASE.'/uploads/xls/',"",$FilePath);
            //   echo $FilePath;
//            echo $FilePath."--".$id;
//die();
            //  $objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003
            $objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007
            //Set to read only
//            echo $FilePath."--".$id;
//            $objReader->setReadDataOnly(true);
            $objReader->
            //Load excel file
            //  $objPHPExcel=$objReader->load(FCPATH.'uploads/excel/'.$file_name);

            //$objPHPExcel=$objReader->load('uploads/2940ku-ar-en.xlsx');
            $objPHPExcel=$objReader->load($filename);

            $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel
            $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);

// echo "<pre>";
// print_r($objWorksheet);
// die();

            // echo '1';
            for($i=2;$i<=$totalrows;$i++)
            {
                // $FirstName= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
                $name = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(); //Excel Column 1
                $proxy= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();

                $name = trim($name);
                $proxy = trim($proxy);

                $name= str_replace("_x000D_", '',$name);
                $proxy= str_replace("_x000D_", '',$proxy);

                $name = addslashes($name);
                $proxy =  addslashes($proxy);

                $data_user= [
                    'name'    => $name,
                    'proxy'   => $proxy,
                    'uid'     => 0,
                    'status'  => 1,
                    'is_working' => 0,
                    'changed' => date('Y-m-d H:i:s', time()),
                    'created' => date('Y-m-d H:i:s', time()),
                ];

                $this->db->select('*');
                $this->db->from('proxy');
                $this->db->where('name',$name);
                $this->db->where('proxy',$proxy);
                $responce = $this->db->get();
                if ($responce->num_rows() > 0 ) {
//                    return  $query->result_array();
                    continue;
                } else {
                    $this->db->insert('proxy', $data_user);
                }

            }

            //Get all proxy list
            $proxyList = $this->common_model->fetch_data(PROXY .' AS p', '*, (SELECT COUNT(id) FROM ' . INSTAGRAM_ACCOUNTS . ' AS ia WHERE ia.uid != 0 AND ia.uid = p.uid) AS ig_accounts_count', ['order_by' => ['id' => 'DESC']]);

            $data = array(
                "result" => $proxyList,
            );
            $this->template->title(l('Proxy management'));
            $this->template->build('index', $data);

        }


    }


    public function update(){
		$data = array(
			"result"  => $this->model->get("*", PROXY, "id = '".get("id")."'"),
		);
		$this->template->title(l('Proxy management'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
		$id = (int)post("id");

		if(post("name") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Name is required')
			));
		}

		if(post("proxy") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Proxy is required')
			));
		}

		$data = array(
			"name"            => post("name"),
			"proxy"           => post("proxy"),
			"uid"             => session("uid"),
			"status"          => (int)post("status"),
			"changed"         => NOW
		);

		if($id == 0){
			$data["created"]  = NOW;
			$this->db->insert(PROXY, $data);
			$id = $this->db->insert_id();
		}else{
			$this->db->update(PROXY, $data, array("id" => $id));
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', PROXY, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS,"proxy = '{$id}'");

					if(!empty($instagram_accounts)){
						foreach ($instagram_accounts as $key => $value) {
							$setting = $this->model->get("proxy_default",SETTINGS);
							if(!empty($setting)){
								$user_admin = $this->model->get("*",USER_MANAGEMENT,"admin = 1");
								$proxy_default = json_decode($setting->proxy_default);
								$proxy_default_igaccount = json_decode($proxy_default->proxy_default_igaccount);
								$proxy_item = $this->model->get("*",PROXY,"ig_accounts 0 AND uid = '".$user_admin->id."' AND id !='".$id."'  AND status = 1","ig_accounts","DESC");
								if(!empty($proxy_item)){
									$this->db->where("id",$value->id);
									$this->db->set("proxy",$proxy_item->id,FALSE);
									$this->db->update(INSTAGRAM_ACCOUNTS);

									$this->db->where("id",$proxy_item->id);
									$this->db->set("ig_accounts","1",FALSE);
									$this->db->update(PROXY);

								}else{
									$this->db->where("id",$value->id);
									$this->db->set("proxy",0,FALSE);
									$this->db->update(INSTAGRAM_ACCOUNTS);
								}
							}
						}
					}
					$this->db->delete(PROXY, "id = '{$id}'");
					break;
				
				case 'active':
					$this->db->update(PROXY, array("status" => 1), "id = '{$id}'");
					break;

				case 'disable':
					$this->db->update(PROXY, array("status" => 0), "id = '{$id}'");
					break;

				case 'verify':
                    $this->check_proxies([$id]);
					break;
			}
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

    public function check_proxies ($proxies = null){

        //Set max execution time
        ini_set('max_execution_time', 300000);

        //If proxies not empty
        if (!empty ($proxies)) {
            $condition = ['where_in' => ['id' => $proxies]];
        } else {
            $condition = ['where' => ['status' => 1]];
        }

	    //Fetching details of proxies
	    $proxyList = $this->common_model->fetch_data(PROXY, '*', $condition);
		
	    //If proxy details not found
        if (count ($proxyList) < 1) {
            return false;
        }
		
        //Iterating all proxies
        $updateRows = $failedProxies = [];
        foreach ($proxyList as $row) {

            //Checking proxy
            $response = make_request($row['proxy']);
			//echo $row['proxy'];
			//var_dump($response);
			 //If succeeds
            $updateRows[] = [
                'id'         => $row['id'],
                'uid'        => $response['success'] ? $row['uid'] : 0,
                'is_working' => $response['success'] ? 1 : 0,
            ];
			
            //If proxy failed
            if (!$response['success']) {
				$condition = ['where' => ['proxy' => $row['id']]];
				$users_with_proxy = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $condition);
				
				
				if(count($users_with_proxy) > 0){
					foreach($users_with_proxy as $user){
						//Add in failed proxies
						$failedProxies[$user['uid']] = $user['id'];
					}
				}
                
            }
        }
		
        //Update rows
        $this->common_model->update_batch_data(PROXY, ['changed' => date('Y-m-d H:i:s', time())], $updateRows, 'id');

        //For each failed proxy
        if (count($failedProxies) > 0) {
            foreach ($failedProxies as $k => $ig_account_id) {
                //Assign proxy to user
                $this->common_model->assign_available_proxy($k,false,false,$ig_account_id);
            }
        }

        return $failedProxies;
    }

	public function ajax_action_multiple(){

		$ids =$this->input->post('id');
		if(!empty($ids)){

		    //If action is to verify
            if (!empty ($this->input->post("action")) and ($this->input->post("action") == 'verify')) {
                $this->check_proxies($ids);

                //Response
                print_r(json_encode(array(
                    'st' 	=> 'success',
                    'txt' 	=> l('Update successfully')
                )));
                exit;
            }

			foreach ($ids as $id) {
				$POST = $this->model->get('*', PROXY, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS,"proxy = '{$id}'");
							if(!empty($instagram_accounts)){ 
								foreach ($instagram_accounts as $key => $value) {
									$setting = $this->model->get("proxy_default",SETTINGS);
									if(!empty($setting)){
										$user_admin = $this->model->get("*",USER_MANAGEMENT,"admin = 1");
										$proxy_default = json_decode($setting->proxy_default);
										$proxy_default_igaccount = json_decode($proxy_default->proxy_default_igaccount);
										$proxy_item = $this->model->get("*",PROXY,"ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND id !='".$id."'  AND status = 1","ig_accounts","DESC");
										if(!empty($proxy_item)){
											$this->db->where("id",$value->id);
											$this->db->set("proxy",$proxy_item->id,FALSE);
											$this->db->update(INSTAGRAM_ACCOUNTS);

											$this->db->where("id",$proxy_item->id);
											$this->db->set("ig_accounts","ig_accounts+1",FALSE);
											$this->db->update(PROXY);

										}else{
											$this->db->where("id",$value->id);
											$this->db->set("proxy",0,FALSE);
											$this->db->update(INSTAGRAM_ACCOUNTS);
										}
									}
								}
							}
							$this->db->delete(PROXY, "id = '{$id}'");
							break;
						case 'active':
							$this->db->update(PROXY, array("status" => 1), "id = '{$id}'");
							break;

						case 'disable':
							$this->db->update(PROXY, array("status" => 0), "id = '{$id}'");
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Update successfully')
		)));
	}
	public function ajax_action_proxy_detail(){
		$id = (int)post("id");
		$data = $this->model->fetch("*",INSTAGRAM_ACCOUNTS,"proxy = '".$id."'");
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$user = $this->model->get("*",USER_MANAGEMENT,"id = '".$value->uid."'");
				if(!empty($user)){
					$data[$key]->fullname = $user->fullname;
					$data[$key]->email 	= $user->email;
				}
			}
		}
		print_r(json_encode(array(
			'st' 	=> "success",
			'data' 	=> json_encode($data),
		)));
	}

    public function ajax_open_import_proxies(){
        print_r($this->load->view("ajax_open_import_proxies", array(), true));
    }
}
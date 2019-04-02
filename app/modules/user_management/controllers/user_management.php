<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class user_management extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
        $this->load->model('common_model');
	}

	public function index(){
		permission_view(true);
		$data = array(
			"result" => $this->model->getUserList()
		);
		$this->template->title(l('User management'));
		$this->template->build('index', $data);
	}

	public function update(){
		permission_view(true);
		$data = array(
			"result"  => $this->model->get("*", USER_MANAGEMENT, "id = '".get("id")."'"),
			"package" => $this->model->fetch("*", PACKAGE, "status = 1", "id", "ASC")
		);
		$this->template->title(l('User management'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
		permission_view(true);
		$id = (int)post("id");

		if(post("fullname") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Fullname is required')
			));
		}

		if(post("email") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Email is required')
			));
		}

		if(!filter_var(post("email"), FILTER_VALIDATE_EMAIL)){
		  	ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Invalid email format')
			));
		}

		if(post("package_id") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Package is required')
			));
		}

		if(post("expiration_date") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Expiration date is required')
			));
		}

		if(post("timezone") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Timezone is required')
			));
		}

		$data = array(
			"fullname"        => post("fullname"),
			"email"           => post("email"),
			"package_id"      => (int)post("package_id"),
			"expiration_date" => date("Y-m-d", strtotime(post("expiration_date"))),
			"timezone"        => post("timezone"),
			"status"          => (int)post("status"),
			"changed"         => NOW
		);

		if($id == 0){
			if(post("password") == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Password is required')
				));
			}

			if(strlen(post("password")) < 6){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Passwords must be at least 6 characters')
				));
			}

			if(post("password") != post("repassword")){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Password incorrect')
				));
			}

			$data["password"] = md5(post("password"));
			$data["type"]     = "direct";
			$data["created"]  = NOW;

			$this->db->insert(USER_MANAGEMENT, $data);
			$id = $this->db->insert_id();
		}else{
			if(post("password") != ""){
				if(strlen(post("password")) < 6){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l('Passwords must be at least 6 characters')
					));
				}

				if(post("password") != post("repassword")){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l('Password incorrect')
					));
				}

				$data["password"] = md5(post("password"));
			}

            //Checking referrals and credit amount to referee
            $this->load->model('common_model');

            //Checking user's current plan
            $userPackage = $this->common_model->fetch_data( USER_MANAGEMENT, 'package_id, expiration_date', [ 'where' => array('id' => $id) ], true);

            //Check referral only when the posted expiration date is greater than user's current package expiration date
            if ((strtotime(post("expiration_date")) > time()) and (strtotime(post("expiration_date")) > strtotime($userPackage['expiration_date']))) {

                $this->common_model->check_referral(['item_number' => (int)post("package_id")], $id);
            }

            //Updating profile
			$this->db->update(USER_MANAGEMENT, $data, array("id" => $id));
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_item(){
		permission_view(true);
		$id = (int)post('id');
		$POST = $this->model->get('*', USER_MANAGEMENT, "id = '{$id}'");
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS, "uid = '{$id}'");
					if(!empty($instagram_accounts)){
						foreach ($instagram_accounts as $key => $value) {
							$proxy_item = $this->model->get("*",PROXY,"id = '".$value->proxy."'");
							if(!empty($proxy_item)&&$proxy_item->ig_accounts!=0){
								$this->db->where("id",$value->proxy);
								$this->db->set("ig_accounts","ig_accounts-1",FALSE);
								$this->db->update(PROXY);
							}
						}
					}

					$this->db->delete(USER_MANAGEMENT, "id = '{$id}'");
					$this->db->delete(INSTAGRAM_ACCOUNTS, "uid = '{$id}'");
					$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '{$id}'");
					$this->db->delete(SAVE, "uid = '{$id}'");
					$this->db->delete(CATEGORIES, "uid = '{$id}'");

                    //Remove any assigned proxy
					$ig_condition = ['where' => ['uid' => $id]];
					$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
					//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
					//die;
					if(count($ig_accounts)){ 
						foreach($ig_accounts as $ig){ 
							$this->common_model->remove_assigned_proxy($ig['id']);
						}
					}
                     
					break;
				
				case 'active':
					$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS,"uid = '{$id}'");

					if(!empty($instagram_accounts)){
						$setting = $this->model->get("proxy_default",SETTINGS);
						$user_admin = $this->model->get("*",USER_MANAGEMENT,"admin = 1");
						$proxy_default = json_decode($setting->proxy_default);
						$proxy_default_igaccount = json_decode($proxy_default->proxy_default_igaccount);
						foreach ($instagram_accounts as $key => $value) {
							if(!empty($setting)){
								$proxy_item = $this->model->get("*",PROXY,"ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND status = 1","ig_accounts","DESC");
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
					$this->db->update(USER_MANAGEMENT, array("status" => 1), "id = '{$id}'");

                    //Assign proxy to user
                    
					$ig_condition = ['where' => ['uid' => $id]];
					$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
					//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
					//die;
					if(count($ig_accounts)){ 
						foreach($ig_accounts as $ig){ 
							//If proxy not assigned then assign one
							$proxy = $this->assign_available_proxy($userID, false, true,$ig['id']);
						}
					}
					break;

				case 'disable':
					$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS, "uid = '{$id}'");
				
					if(!empty($instagram_accounts)){
						foreach ($instagram_accounts as $key => $value) {
							$proxy_item = $this->model->get("*",PROXY,"id = '".$value->proxy."'");
							if(!empty($proxy_item)&&$proxy_item->ig_accounts!=0){
								$this->db->where("id",$value->proxy);
								$this->db->set("ig_accounts","ig_accounts-1",FALSE);
								$this->db->update(PROXY);

								$this->db->where("id",$value->id);
								$this->db->set("proxy",0,FALSE);
								$this->db->update(INSTAGRAM_ACCOUNTS);
							}
						}
					}
					$this->db->update(USER_MANAGEMENT, array("status" => 0), "id = '{$id}'");

                    //Remove any assigned proxy
					$ig_condition = ['where' => ['uid' => $id]];
					$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
					//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
					//die;
					if(count($ig_accounts)){ 
						foreach($ig_accounts as $ig){ 
							$this->common_model->remove_assigned_proxy($ig['id']);
						}
					}
                    
					break;
			}
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_multiple(){
		permission_view(true);
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', USER_MANAGEMENT, "id = '{$id}'");
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS, "uid = '{$id}'");
							if(!empty($instagram_accounts)){
								foreach ($instagram_accounts as $key => $value) {
									$proxy_item = $this->model->get("*",PROXY,"id = '".$value->proxy."'");
									if(!empty($proxy_item)&&$proxy_item->ig_accounts>0){
										$this->db->where("id",$value->proxy);
										$this->db->set("ig_accounts","ig_accounts-1",FALSE);
										$this->db->update(PROXY);
									}
								}
							}

							$this->db->delete(USER_MANAGEMENT, "id = '{$id}'");
							$this->db->delete(INSTAGRAM_ACCOUNTS, "uid = '{$id}'");
							$this->db->delete(PROXY, "uid = '{$id}'");
							$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '{$id}'");
							$this->db->delete(SAVE, "uid = '{$id}'");
							$this->db->delete(CATEGORIES, "uid = '{$id}'");

                            //Remove any assigned proxy
                            $ig_condition = ['where' => ['uid' => $id]];
							$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
							//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
							//die;
							if(count($ig_accounts)){ 
								foreach($ig_accounts as $ig){ 
									$this->common_model->remove_assigned_proxy($ig['id']);
								}
							}
							break;
						case 'active':
							$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS,"uid = '{$id}'");
							if(!empty($instagram_accounts)){
								$setting = $this->model->get("proxy_default",SETTINGS);
								$user_admin = $this->model->get("*",USER_MANAGEMENT,"admin = 1");
								$proxy_default = json_decode($setting->proxy_default);
								$proxy_default_igaccount = json_decode($proxy_default->proxy_default_igaccount);
								foreach ($instagram_accounts as $key => $value) {
									if(!empty($setting)){
										$proxy_item = $this->model->get("*",PROXY,"ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND status = 1","ig_accounts","DESC");
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
							$this->db->update(USER_MANAGEMENT, array("status" => 1), "id = '{$id}'");

                            //Assign proxy to user
                            $ig_condition = ['where' => ['uid' => $id]];
							$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
							//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
							//die;
							if(count($ig_accounts)){ 
								foreach($ig_accounts as $ig){ 
									//If proxy not assigned then assign one
									$proxy = $this->assign_available_proxy($userID, false, true,$ig['id']);
								}
							} 
							break;

						case 'disable':
							$instagram_accounts = $this->model->fetch("*",INSTAGRAM_ACCOUNTS, "uid = '{$id}'");
							if(!empty($instagram_accounts)){
								foreach ($instagram_accounts as $key => $value) {
									$proxy_item = $this->model->get("*",PROXY,"id = '".$value->proxy."'");
									if(!empty($proxy_item)&&$proxy_item->ig_accounts>0){
										$this->db->where("id",$value->proxy);
										$this->db->set("ig_accounts","ig_accounts-1",FALSE);
										$this->db->update(PROXY);

										$this->db->where("id",$value->id);
										$this->db->set("proxy",0,FALSE);
										$this->db->update(INSTAGRAM_ACCOUNTS);
									}
								}
							}
							$this->db->update(USER_MANAGEMENT, array("status" => 0), "id = '{$id}'");

                            //Remove any assigned proxy
                            $$ig_condition = ['where' => ['uid' => $id]];
							$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
							//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
							//die;
							if(count($ig_accounts)){ 
								foreach($ig_accounts as $ig){ 
									$this->common_model->remove_assigned_proxy($ig['id']);
								}
							}
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

	// Set Session tmp_uid
	public function ajax_action_view_user(){
		permission_view(true);
		if(post("id")!=""){
			$id = (int)post("id");
			set_session("tmp_uid",$id);
			ms(array(
				"st" => "success",
			));
		}
	}

	public function ajax_action_back_admin(){
		if(session("tmp_uid")){
			unset_session("tmp_uid");
			ms(array(
				"st" => "success",
			));
		}
	}

	public function profile(){
		$user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
		if(empty($user)) redirect(PATH);

		$package = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'", "id", "ASC");
		if(empty($package)){
			$package = $this->model->get("*", PACKAGE, "type = '1' OR type = '0'");
		}

		$data = array(
			"result"  => $user,
			"package" => $package
		);
		$this->template->title('Dashboard');
		$this->template->build('profile', $data);
	}

	public function ajax_profile(){
		$id = (int)post("id");

		if(post("fullname") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Fullname is required')
			));
		}
		
		if(post("timezone") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Timezone is required')
			));
		}

		$data = array(
			"fullname"        => post("fullname"),
			"timezone"        => post("timezone"),
            "paypal_email"    => !empty(post("paypal_email")) ? post("paypal_email") : '',
			"changed"         => NOW
		);

		if(post("password") != ""){
			if(strlen(post("password")) < 6){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Passwords must be at least 6 characters')
				));
			}

			if(post("password") != post("repassword")){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Password incorrect')
				));
			}

			$data["password"] = md5(post("password"));
		}

		$this->db->update(USER_MANAGEMENT, $data, array("id" => session("uid")));

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function openid($type = ""){
		$result = array();
		switch ($type) {
			case 'facebook':
				if(get('code') && get('state')){
					$USER = FACEBOOK_GET_USER();
					if(!empty($USER) && isset($USER['id'])){
						$data = array(
							"type"            => "facebook",
							"pid"             => $USER['id'],
							"fullname"        => $USER['name'],
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);

						if(!empty($PACKAGE)){
							$permission = json_decode($PACKAGE->permission);
							$data["maximum_account"] = $permission->maximum_account;
							$data["maximum_groups"]  = $permission->maximum_groups;
							$data["maximum_pages"]   = $permission->maximum_pages;
							$data["maximum_liked_pages"] = $permission->maximum_liked_pages;
							$data["expiration_date"] = date('Y-m-d', strtotime("+".$PACKAGE->day." days"));
						}else{
							$data["expiration_date"] = date('Y-m-d');
						}

						if(isset($USER['email'])){
							$data['email'] = $USER['email'];
						}

						if(isset($data['email'])){
							$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$data['email']."'");
						}else{
							$result = $this->model->get('*', USER_MANAGEMENT, "pid = '".$USER['id']."'");
						}
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
				break;
			case 'google':
				if(get('code')){
					$USER = GOOGLE_GET_USER(get('code'));
					if(!empty($USER)){
						$data = array(
							"type"            => "google",
							"pid"             => $USER->id,
							"fullname"        => $USER->name,
							"email"           => $USER->email,
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);


						$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$USER->email."'");
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$package = $this->model->get("*", PACKAGE, "type = 1 AND status = 1");
								if(!empty($package)){
									$data["package_id"] = $package->id;
									if($package->type == 1){
										$data["expiration_date"] = date('Y-m-d', strtotime("+".$package->day." days"));
									}
								}
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
				break;
			case 'twitter':
				if(get('oauth_token') && get('oauth_verifier')){
					$USER = TWITTER_GET_USER();
					if(!empty($USER)){
						$data = array(
							"type"            => "twitter",
							"pid"             => $USER->id_str,
							"fullname"        => $USER->name,
							"status"          => AUTO_ACTIVE_USER,
							"changed"         => NOW
						);


						if(isset($USER->email)){
							$data['email'] = $USER->email;
						}

						if(isset($data['email'])){
							$result = $this->model->get('*', USER_MANAGEMENT, "email = '".$data['email']."'");
						}else{
							$result = $this->model->get('*', USER_MANAGEMENT, "pid = '".$USER->id_str."'");
						}
						if(empty($result)){
							if(REGISTER_ALLOWED == 1){
								$package = $this->model->get("*", PACKAGE, "type = 1 AND status = 1");
								if(!empty($package)){
									$data["package_id"] = $package->id;
									if($package->type == 1){
										$data["expiration_date"] = date('Y-m-d', strtotime("+".$package->day." days"));
									}
								}
								$data["created"] = NOW;
								$this->db->insert(USER_MANAGEMENT, $data);
								$id = $this->db->insert_id();
								$result = $this->model->get('*', USER_MANAGEMENT, "id = '".$id."'");
							}
						}else{
							$this->db->update(USER_MANAGEMENT, $data, array('id' => $result->id));
						}
					}
				}
				break;
		}

		if(!empty($result) && $result->status == 1){
			$this->model->session($result);
			redirect(PATH."#login-success");
		}else{
			redirect(PATH."#not-active");
		}
	}

	public function ajax_login(){
		if(post("email") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Email is required')
			));
		}

		if(!filter_var(post("email"), FILTER_VALIDATE_EMAIL)){
		  	ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Invalid email format')
			));
		}

		if(post("password") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password is required')
			));
		}

		$user = $this->model->get("*", USER_MANAGEMENT, "email = '".post('email')."' AND password = '".md5(post("password"))."'");
		if(!empty($user)){
			if($user->status == 1){
				$this->model->session($user);

                if(post("remember") == 'on'){
                    set_cookie('uid', $user->id, time() + (86400 * 30),BASE,'/');
                    set_cookie('admin', $user->admin, time() + (86400 * 30),BASE,'/');
                    set_cookie('pid', $user->pid, time() + (86400 * 30),BASE,'/');
                    set_cookie('fullname', $user->fullname, time() + (86400 * 30),BASE,'/');
                    set_cookie('username', $user->email, time() + (86400 * 30),BASE,'/');
                    set_cookie('user_type', $user->type, time() + (86400 * 30),BASE,'/');
                    set_cookie('user_created', $user->created, time() + (86400 * 30),BASE,'/');
                    set_cookie('folderid', 'user'.(string)$user->id, time() + (86400 * 30),BASE,'/');
                }

				//Assign proxy to user
                //$this->common_model->assign_available_proxy($user->id, true); 

				ms(array(
					"st"    => "success",
					"label" => "bg-light-green",
					"txt"   => l('Login successfully')
				));
			}else{
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l('Your account has not been activated')
				));
			}
		}else{
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Username or password incorrect')
			));
		}
	}

	public function ajax_register(){
		if(!REGISTER_ALLOWED) redirect(PATH);

		if(post("fullname") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('First Name is required')
			));
		}

		if(post("email") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Email is required')
			));
		}

		if(!filter_var(post("email"), FILTER_VALIDATE_EMAIL)){
		  	ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Invalid email format')
			));
		}

		if(strlen(post('password')) == ''){
    		ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password is required')
			));
    		exit(0);
    	}

		if(strlen(post("password")) < 6){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Passwords must be at least 6 characters')
			));
		}

		if(post("password") != post("repassword")){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password incorrect')
			));
		}

		$POST = $this->model->get('*', USER_MANAGEMENT, "email = '".post('email')."'");
		if(empty($POST)){

            //Loading encryption library
            $this->load->library('Encryption_lib');

			$data = array(
				'fullname'=> post("fullname"),
				'type'    => 'direct',
	    		'email'   => post('email'),
	    		'password'=> md5(post('password')),
	    		'status'  => AUTO_ACTIVE_USER,
                'referral_code' => $this->encryption_lib->get_unique_referral_code(),
	    		'changed' => NOW,
	    		'created' => NOW
	    	);

            $data1 = array(
                'fullname'=> post("fullname"),
                'email'   => post('email'),
                'created' => NOW
            );


			$package = $this->model->get("*", PACKAGE, "type = 1 AND status = 1");
			if(!empty($package)){
				$data["package_id"] = $package->id;
				if($package->type == 1){
					$data["expiration_date"] = date('Y-m-d', strtotime("+".$package->day." days"));
				}
			}

    	    $this->db->insert(USER_MANAGEMENT, $data);
    		$id = $this->db->insert_id();

            $timezone_offset_minutes = post("nowtimezone");
            $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);

//            echo $timezone_name;

            $this->post_infusionsoft( post("fullname"), post("email"), $timezone_name);
//            $this->post_zapier( post("fullname"), post("email"));

            if($id){
                $url = 'https://api.fomo.com/api/v1/applications/Dsk_PEjDVqQ0eoq_l9UCLg/webhooks/custom_webhook/8066ee61a628f54eb5efefd0c5cf9a8b';
//                $webhuk = json_encode($data1);
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

                curl_setopt($ch, CURLOPT_HEADER, 0);

                curl_setopt($ch, CURLOPT_TIMEOUT, 20);

                curl_setopt($ch,CURLOPT_POST,true);

                curl_setopt($ch, CURLOPT_NOBODY, 0);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);

                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

//                $result = curl_exec($ch);
                curl_exec($ch);

                curl_close($ch);
            }

//            print_r($return);
//            die();

            if(AUTO_ACTIVE_USER == 1){
	    		set_cookie("uid", $id, 1209600);
				set_session("uid", $id);
				if (!file_exists('uploads/user'.(string)$id)) {
		    		mkdir('uploads/user'.$id, 0777, true);
				}
				set_cookie('folderid', 'user'.(string)$id, 86400);
			}

            //If user has been referred
            $referralCode = $this->input->cookie('aff');

            //Checking if referral belongs to someone
            if(!empty($referralCode)) {

                //Getting referee
                $refereeUser = $this->common_model->fetch_data(USER_MANAGEMENT, '*', ['where' => ['referral_code' => $referralCode]], true);

                //If referee's subscription has been expired then setting referral as cancelled.
                $refereeStatus = 0;
                if (($refereeUser['package_id'] < 2) and (strtotime($refereeUser['expiration_date']) < time()))
                    $refereeStatus = 3;

                //Adding referral
                $insertReferral = [
                    'user_from'       => $refereeUser['id'],
                    'user_to'         => $id,
                    'status'          => $refereeStatus,
                    'package_id'      => 0,
                    'package_amount' => 0,
                    'referral_amount' => 0,
                    'created'         => date('Y-m-d H:i:s'),
                ];

                //Inserting in database
                $this->db->insert(REFERRALS, $insertReferral);
            }

    		ms(array(
				'st' 	=> 'success',
				'label' => "bg-light-green",
				'txt' 	=> l('Register successfully')
			));
    	}else{
    		ms(array(
				'st' 	=> 'error',
				'label' => "bg-red",
				'txt' 	=> l('Email already exists')
			));
    	}
	}

    public function post_infusionsoft($name,$email,$timezone){

//        $AuthUser = $this->getVariable("AuthUser");

        $fields = array(

            "inf_field_FirstName"     => $name,//your instagram client id

            "inf_field_Email" => $email,

            "inf_form_xid" => '147c81196f35de252e44b7d492019fc7',

            "inf_form_name" => 'App Registration',

            "infusionsoft_version" => '1.70.0.77530',

            "timeZone"=> $timezone
        );


        $url = 'https://rf650.infusionsoft.com/app/form/process/147c81196f35de252e44b7d492019fc7';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_HEADER, 0);

        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        curl_setopt($ch,CURLOPT_POST,true);

        curl_setopt($ch, CURLOPT_NOBODY, 0);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        //$result = curl_exec($ch);
        curl_exec($ch);

        curl_close($ch);

        //$result = json_decode($result);

        //print_r($result);

        //print_r($_POST);
    }
//    public function post_zapier($name,$email){
//
////        $AuthUser = $this->getVariable("AuthUser");
//
//        $fields = array(
//
//            "first_name" => $name,//your instagram client id
//
//            "email" => $email
//        );
//
//
//        $url = 'https://hooks.zapier.com/hooks/catch/1060897/0kwkid/';
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $url);
//
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//
//        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
//
//        curl_setopt($ch,CURLOPT_POST,true);
//
//        curl_setopt($ch, CURLOPT_NOBODY, 0);
//
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//
//        //$result = curl_exec($ch);
//        curl_exec($ch);
//
//        curl_close($ch);
//
//        //$result = json_decode($result);
//
//        //print_r($result);
//
//        //print_r($_POST);
//    }

	public function ajax_reset_password(){
		if(strlen(post('password')) == ''){
    		ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password is required')
			));
    		exit(0);
    	}

		if(strlen(post("password")) < 6){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Passwords must be at least 6 characters')
			));
		}

		if(post("password") != post("repassword")){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Password incorrect')
			));
		}

		$POST = $this->model->get('*', USER_MANAGEMENT, "reset_key = '".post('reset_key')."'");
		if(!empty($POST)){
			$data = array(
	    		'password'=> md5(post('password')),
	    		'reset_key' => md5(time()),
	    		'changed' => NOW,
	    	);

    		$this->db->update(USER_MANAGEMENT, $data, array("id" => $POST->id));
    		
    		ms(array(
				'st' 	=> 'success',
				'label' => "bg-light-green",
				'txt' 	=> l('Successfully')
			));
    	}else{
    		ms(array(
				'st' 	=> 'error',
				'label' => "bg-red",
				'txt' 	=> l('Reset password key not exists')
			));
    	}
	}

	public function ajax_forgot_password(){
		
		if(post("email") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Email is required')
			));
		}

		if(!filter_var(post("email"), FILTER_VALIDATE_EMAIL)){
		  	ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Invalid email format')
			));
		}

		$POST = $this->model->get('*', USER_MANAGEMENT, "email = '".post('email')."'");
		if(!empty($POST)){
			$reset_key = md5(time().$POST->password);
			$this->db->update(USER_MANAGEMENT, array("reset_key" => $reset_key), array("id" => $POST->id));
			
			if(send_mail(post("email"), $reset_key)){
				ms(array(
					'st' 	=> 'success',
					'label' => "bg-light-green",
					'txt' 	=> l('Please check your email to reset password')
				));
			}else{
				ms(array(
					'st' 	=> 'error',
					'label' => "bg-red",
					'txt' 	=> l('An error occurred. Please try again later')
				));
			}
    	}else{
    		ms(array(
				'st' 	=> 'error',
				'label' => "bg-red",
				'txt' 	=> l('This email address does not exist')
			));
    	}
	}

	public function ajax_timezone(){
		if(session("uid")){
			$this->db->update(USER_MANAGEMENT, array("timezone" => post("timezone")), array("id" => (int)session("uid")));
			ms(array(
				"st"    => "success",
				"label" => "bg-light-green",
				"txt"   => l('Update successfully')
			));
		}
	}
}
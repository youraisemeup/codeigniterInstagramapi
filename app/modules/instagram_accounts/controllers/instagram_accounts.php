<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class instagram_accounts extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
	}

	public function index(){
		$data = array(
			"result" => $this->model->getAccounts()
		);
		$this->template->title(l('Instagram accounts'));
		$this->template->build('index', $data);
	}

	public function add(){
		$data = array(
			"result" => $this->model->getAccounts()
		);
		$this->template->title(l('Instagram accounts'));
		$this->template->build('index', $data);
	}

	public function add_account(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, getDatabyUser(0));
		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".(int)get("id")."'".getDatabyUser());

		$setting = $this->model->get("proxy_default",SETTINGS);
		if(!empty($setting)){
			$user_admin = $this->model->get("*",USER_MANAGEMENT,"id = 1 AND admin = 1");
			$proxy_default = json_decode($setting->proxy_default);
			$proxy_default_igaccount = json_decode($proxy_default->proxy_default_igaccount);
		}
		$proxy="";
		if(session("uid")!=1){
			$proxy = $this->model->fetch("*", PROXY, "uid ='".session("uid")."' AND status = 1","id","DESC");
		}
		if(empty($proxy)||session("uid")==1){
				$proxy = $this->model->fetch("*",PROXY,"ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND status = 1","ig_accounts","DESC");
		};

        $targetresp = $this->db->get('targets');
        $newresp = $targetresp->num_rows()>0 ? $targetresp->result_array() : '';


		$data = array(
			'result' => $account,
			'count'  => count($accounts),
			"proxy"  => $proxy,
            'targets' => $newresp
		);
		$this->load->view("add_account", $data);
	}

    public function reconnect($username,$password,$txt = ''){
//        $this->reconnect($account->username, $account->password);
//        $this->load->view("reconnect");
        print_r($this->load->view("reconnect", array("username" => $username, "password" => $password, "txt" => $txt), true));
        exit;
    }

	public function update(){
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, getDatabyUser(0));
		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".(int)get("id")."'".getDatabyUser());
		$proxy_account = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
		
		$setting = $this->model->get("proxy_default",SETTINGS);
		if(!empty($setting)){
			$user_admin = $this->model->get("*",USER_MANAGEMENT,"id = 1 AND admin = 1");
			$proxy_default = json_decode($setting->proxy_default);
			$proxy_default_igaccount = json_decode($proxy_default->proxy_default_igaccount);
		}

		$proxy="";
		if(session("uid")!=1){
			$proxy = $this->model->fetch("*", PROXY, "uid ='".session("uid")."' AND status = 1","id","DESC");
		}

		if(empty($proxy)||session("uid")==1){
			$proxy = $this->model->fetch("*",PROXY,"ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND status = 1","ig_accounts","DESC");
		};
		if(!empty($proxy_account)){
			$proxy[] = $proxy_account;
		}
		
		$data = array(
			'result' => $account,
			'count'  => count($accounts),
			"proxy"  => $this->model->fetch("*", PROXY, "uid = '".session("uid")."'", "id", "DESC")
		);
		$this->template->title(l('Instagram accounts'));
		$this->template->build('update', $data);
	}

	public function ajax_update(){
		$username = post('username');
		$password = post('password');
        $code = post('code');
		$proxy_id = (int)post('proxy');
		if($username == "" || $password == ""){
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please input all fields')
			));
		}

		if(session('admin')==1&&post('proxy') == ""){
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Please select a proxy')
			));
		}

/*      $gwtuserdetail = $this->model->get("*",USER_MANAGEMENT,"id = ".session('uid'));

        $now_date = strtotime(NOW);

        if($gwtuserdetail->package_id == 1 && $gwtuserdetail->admin == 0){

            $expAccount = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "username = '".$username."'");
            if(!empty($expAccount)){

               foreach($expAccount as $row){

					$newid = $row->uid;

					$expUser = $this->model->fetch("*", USER_MANAGEMENT, "id = ".$newid);

                    if(!empty($expUser)){

                        foreach($expUser as $raw){

                            $exp_date = strtotime($raw->expiration_date);

                            if($raw->package_id == 1 && $exp_date < $now_date ){
                                ms(array(
                                    "st"    => "error",
                                    "label" => "bg-red",
                                    "txt"   => l('This instagram account already added by another user. If you want this account so first you have to purchase any plan.')
                                ));
                            }

                        }

                   }

                }

            }

        }

		*/

		$proxy = "";
		
		if($proxy_id!=0){
			$proxy_item = $this->model->get("*", PROXY, "id = '".$proxy_id."' AND status = 1 AND is_working= 1");
			if(!empty($proxy_item)){
				$proxy = $proxy_item->proxy;
                $proxy_id = $proxy_item->id;
			}
		}else{
			
			// Proxy is to be automated (proxy of admin)
			$setting = $this->model->get("proxy_default",SETTINGS);
			
			if(!empty($setting)){
				$user_admin = $this->model->get("*",USER_MANAGEMENT,"admin = 1");
				$proxy_default = json_decode($setting->proxy_default);
				
				$proxy_default_igaccount = $proxy_default->proxy_default_igaccount;
				//echo "ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND status = 1";die;
				$proxy_item = $this->model->get("*",PROXY,"ig_accounts < ".$proxy_default_igaccount."  AND status = 1 AND is_working=1");
				
				if(!empty($proxy_item)){
					$proxy = $proxy_item->proxy;
					$proxy_id = $proxy_item->id;
				}
				
			}
		}
			 
		//print_r($proxy_id);die;
		
       // $code = '087152';		
        if(isset($code) AND $code!='' ){
            $ig = approveChallengeVerificationCode($username, $password, $proxy,$code);
            //var_dump($ig->getFullResponse());die;
//            echo 21;
            if(is_array($ig) && isset($ig['st'])){

                if( stripos($ig['txt'], 'CURL' ) !== false) {

                    $updata = array(
                        'is_working' => 0
                    );
                    $this->db->where('id',$proxy_id);
                    $this->db->update(PROXY,$updata);

                    $proxy_item = $this->model->get("*",PROXY,"ig_accounts < 1  AND status = 1 AND is_working = 1");

                    if(!empty($proxy_item)){
                        $proxy = $proxy_item->proxy;
                    }else{
                        $proxy = '';
                    }

                    $ig = approveChallengeVerificationCode($username, $password, $proxy,$code);

                    if(is_array($ig) && isset($ig['st'])){
                        ms($ig);
                    }

                }else{
                    ms($ig);
                }
            }


//            echo 23;
            $info =  $ig->getFullResponse();
//            echo 24;
            if($info->getStatus() == "ok"){
//                echo 25;
				//print_r($info->getLoggedInUser());die;
                if($info->getLoggedInUser() == ''){

//                    $ignew = Instagram_Login($username, $password, $proxy);
//
//                    if(is_array($ignew) && isset($ignew['st'])){
//                        ms($ignew);
//                    }

                    $ig->internal->getZeroRatingTokenResult();
                    $ig->people->getBootstrapUsers();
                    $ig->story->getReelsTrayFeed();
                    $ig->timeline->getTimelineFeed(null, ['recovered_from_crash' => true]);
                    $ig->internal->syncUserFeatures();
//                    $this->_registerPushChannels();
                    $ig->direct->getRankedRecipients('reshare', true);
                    $ig->direct->getRankedRecipients('raven', true);
                    $ig->direct->getInbox();
                    $ig->account->getPresenceStatus();
                    $ig->internal->getProfileNotice();
                    //$this->internal->getMegaphoneLog();
                    $ig->people->getRecentActivityInbox();
                    $ig->internal->getQPFetch();
                    $ig->media->getBlockedMedia();
                    $ig->discover->getExploreFeed(null, true);
                    $ig->internal->getFacebookOTA();

                    $ig->client->saveCookieJar();


                    $infonew = $ig->account->getCurrentUser();
                    $user = $infonew->getUser();
                    $fid  = $user->getPk();

                    $ig_profile_pic = $user->getProfilePicUrl();
                    $ig_user = $user->getUsername();
                    $ig_pk = $fid;

                }else{

                    $ig_profile_pic = $info->getLoggedInUser()->getProfilePicUrl();
                    $ig_user = $info->getLoggedInUser()->getUsername();
                    $ig_pk = $info->getLoggedInUser()->getPk();

                }

            }else{
                $ig_profile_pic ='';
                $ig_user ='';
                $ig_pk='';
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Connect failure')
                ));
            }
         //  echo  $info->status;
          //  $info = $ig->logged_in_user;
      //   echo    $info->logged_in_user->profile_pic_url;
       //  echo    $info->logged_in_user->username;
	 

        }else{						

            $checkIg_Account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "username = '".$username."'");
            $checkIg_Data = $this->model->get("*", INSTAGRAM_DATA, "username = '".$username."'");

            if($checkIg_Account AND $checkIg_Data){
            }else{
                $this->db->delete(INSTAGRAM_DATA, "username = '$username'");
            }
			
            $ig = Instagram_Login($username, $password, $proxy);



            if(is_array($ig) && isset($ig['st'])){

                if( stripos($ig['txt'], 'CURL' ) !== false) {

                    $updata = array(
                        'is_working' => 0
                    );
                    $this->db->where('id',$proxy_id);
                    $this->db->update(PROXY,$updata);

                    $proxy_item = $this->model->get("*",PROXY,"ig_accounts < 1  AND status = 1 AND is_working = 1");

                    if(!empty($proxy_item)){
                        $proxy = $proxy_item->proxy;
                    }else{
                        $proxy = '';
                    }

                    $ig = Instagram_Login($username, $password, $proxy);

                    if(is_array($ig) && isset($ig['st'])){
                        ms($ig);
                    }

                }else{
                    ms($ig);
                }

            }

            $info = $ig->account->getCurrentUser();
            $user = $info->getUser();
            $fid  = $user->getPk();

            $ig_profile_pic = $user->getProfilePicUrl();
            $ig_user = $user->getUsername();
            $ig_pk = $fid;

        }

		//var_dump($ig);
		//        die();
		//
		if(is_array($ig) && isset($ig['st'])){
			ms($ig);
		}

		//Instagram Account Info 
		
		if($info->getStatus() != "ok"){
			ms(array(
				"st"  => "error",
				"label" => "bg-red",
				"txt" => l('Connect failure')
			));
		}
		
		//$user = $info->user;
		//$fid  = $user->pk;
		$data = array(
			"uid"           => session("uid"),
			"fid"           => $ig_pk,
//			"fid"           => $fid,
			"proxy"         => $proxy_id,
//			"avatar"        => $user->profile_pic_url,
//			"username"      => $user->username,
            "avatar"        => $ig_profile_pic,
            "username"      => $ig_user,
			"password"      => $password,
			"checkpoint"    => 0,
		);
		$fid = $ig_pk;
		$id = (int)post("id");
		$accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = ".session("uid"));
		if($id == 0){
			if(count($accounts) < getMaximumAccount()){
				//$checkAccount = $this->model->get("*", INSTAGRAM_ACCOUNTS, "fid = '".$fid."' AND uid = ".session("uid")); 
				$checkAccount = $this->model->get("*", INSTAGRAM_ACCOUNTS, "fid = '".$fid."'");
				if(!empty($checkAccount)){
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => l("This Instagram profile is linked somewhere else and you can't add it again.")
					));
				}
				// Increase 1 IG account on proxy

				$this->db->where("id",$proxy_id);
				$this->db->set("ig_accounts","ig_accounts+1",FALSE);
				$this->db->update(PROXY);
				if($this->db->insert(INSTAGRAM_ACCOUNTS, $data)){
					$id = $this->db->insert_id();
					get_setting("like", 0, $id,"logs_counter");
					get_setting("comment", 0, $id,"logs_counter");
                    get_setting("follow", 0, $id,"logs_counter");
					get_setting("like_follow", 0, $id,"logs_counter");
					get_setting("followback", 0, $id,"logs_counter");
					get_setting("unfollow", 0, $id,"logs_counter");
					get_setting("repost", 0, $id,"logs_counter");
					get_setting("message", 0, $id,"logs_counter");
					get_setting("deletemedia", 0, $id,"logs_counter");
				};
			}else{
				ms(array(
					"st"    => "error",
					"label" => "bg-orange",
					"txt"   => l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')
				));
			}
		}else{
//			$checkAccount = $this->model->get("*", INSTAGRAM_ACCOUNTS, "fid = '".$fid."' AND id != '".$id."' AND uid = ".session("uid"));
			$checkAccount = $this->model->get("*", INSTAGRAM_ACCOUNTS, "fid = '".$fid."'");
			if(!empty($checkAccount)){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
                    "txt"   => l("This Instagram profile is linked somewhere else and you can't add it again.")
				));
			}

			$account = $this->model->get("*",INSTAGRAM_ACCOUNTS,"id = '".$id."' AND uid = ".session("uid"));
			if(!empty($account)){
				if($account->proxy!=$data["proxy"]){
					// Increase 1 IG account on new proxy.
					$this->db->where("id",$data["proxy"]);
					$this->db->set("ig_accounts","1",FALSE);
					$this->db->update(PROXY);

					// Decrease 1 IG account on old proxy.
					$proxy_item = $this->model->get("*",PROXY,"id = '".$account->proxy."'");
					if (!empty($proxy_item)&&$proxy_item->ig_accounts!=0) {
						$this->db->where("id",$account->proxy);
						$this->db->set("ig_accounts","ig_accounts-1",FALSE);
						$this->db->update(PROXY);
					}
				}
			}

			$this->db->update(INSTAGRAM_ACCOUNTS, $data, array("id" => post("id")));
		}

	 
        $schedule = $this->model->get("*", SETTINGS);
        $schedule_default = json_decode($schedule->schedule_default);

        $todo = json_encode($schedule_default->todo);
        $location = json_encode($schedule_default->locations);
        $deftags = json_encode($schedule_default->tags);
        $comments = json_encode($schedule_default->comments);
        $messages = json_encode($schedule_default->messages);
        $filter = json_encode($schedule_default->filter);
//        $slow = array();

//        echo $schedule_default->slow;
        $slow = json_decode($schedule_default->slow);
//        print_r((array)$slow);
        $slow = (array)$slow;
        $nspeed = array_merge($slow,array('type' => 1));
//print_r($nspeed);
        $dspeed = json_encode(json_encode($nspeed));

        $target = post('target');

        if($target != ''){

            $targetresp = $this->db->get_where('targets', array("id" => $target));
            $newresp = $targetresp->num_rows()>0 ? $targetresp->result_array() : '';

        }else{
            $newresp = '';
        }


        if($newresp != ''){

//            $newt = json_encode(array('tags' => $newresp[0]['data']));
            $newt = json_encode($newresp[0]['data']);

            if($newresp[0]['influencers'] != null ){
                $newu = json_encode($newresp[0]['influencers']);
            }else{
                $newu = 'null';
            }
 
//            $tags = '{"todo":"{\"like\":1,\"comment\":0,\"follow\":1,\"like_follow\":0,\"followback\":0,\"unfollow\":1,\"deletemedia\":0}","targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":'.$newt.',"usernames":'.$newu.',"locations":"null","comments":"[\" Made my day\",\"Totally rocks!\",\"Very nice\",\"Very sweet :)\",\"This is great\",\"So cool\",\"Fascinating one\",\"Neat-o!\",\"Gorgeous! Love it!\",\"The cutest :grinning:\",\"Breathtaking one\",\"This is awesome :)\",\"Outstanding one!\",\"Whoopee!\",\"My Goodness!\",\"This is awesome!\"]","messages":"[\"Thank you for following me:)\"]","filter":"{\"media_age\":\"\",\"media_type\":\"\",\"min_likes\":0,\"max_likes\":0,\"min_comments\":0,\"max_comments\":0,\"user_relation\":\"\",\"user_profile\":\"\",\"min_followers\":0,\"max_followers\":0,\"min_followings\":0,\"max_followings\":0,\"gender\":\"\"}"}';
//            $tags = '{"todo":'.$todo.',"targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":10,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":'.$newt.',"usernames":'.$newu.',"locations":'.$location.',"comments":'.$comments.',"messages":'.$messages.',"filter":'.$filter.'}';
			$targets = json_encode(array("tag"=>1,"location"=>0,"followers"=>1,"followings"=>1,"likers"=>3,"commenters"=>1,"unfollow"=>array("unfollow_source"=>2,"unfollow_followers"=>0,"unfollow_follow_age"=>86400)));
			
            $tags = '{"todo":'.$todo.',"targets":'.$targets.',"speed":'.$dspeed.',"tags":'.$newt.',"usernames":'.$newu.',"locations":'.$location.',"comments":'.$comments.',"messages":'.$messages.',"filter":'.$filter.'}';

        }else{

			$targets = json_encode(array("tag"=>1,"location"=>0,"followers"=>1,"followings"=>1,"likers"=>3,"commenters"=>1,"unfollow"=>array("unfollow_source"=>2,"unfollow_followers"=>0,"unfollow_follow_age"=>86400)));

            $tags = '{"todo":'.$todo.',"targets":'.$targets.',"speed":'.$dspeed.',"tags":'.$deftags.',"usernames":"null","locations":'.$location.',"comments":'.$comments.',"messages":'.$messages.',"filter":'.$filter.'}';

        }

        $activity = array(
            "uid" 			=> session("uid"),
            "account_id" 	=> $id,
            "account_name" 	=> $data['username'],
            "data" 			=> $tags,			
			//"blacklists" 	=> '{"bl_tags":"[\"sex\",\"xxx\",\"fuckyou\",\"videoxxx\",\"nude\"]","bl_usernames":"null","bl_keywords":"[\"nude\",\"sex\",\"fuck now\"]"}',
            "blacklists" 	=> '{"bl_tags":"null","bl_usernames":"null","bl_keywords":"null"}',
            "status" 		=> 1,
            "created" 		=> NOW
        );

        $check = $this->model->get("*", INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
        if(!empty($check)){
            $this->db->update(INSTAGRAM_ACTIVITY, $activity, array("id" => $check->id)); 
        }else{
            $this->db->insert(INSTAGRAM_ACTIVITY, $activity);
        }
		
		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully'),
			 "accountStatus" => true,
            "newaccount" => true,
		));
	}

	public function ajax_get_groups(){
		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".post("id")."'".getDatabyUser());
//        print_r($account);
//        die();
		if(!empty($account)){

			//Add Proxy
			$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."' AND status = 1 AND is_working = 1");
			if(!empty($proxy_item)){
				$proxy = $proxy_item->proxy;
                $proxy_id = $proxy_item->id;
			}else{
				$proxy = "";
			}

			switch (post("type")) {
				case 'page':
					$IG_Oauth = Instagram_Login($account->username, $account->password, $proxy,'update');

					if(is_array($IG_Oauth) && isset($IG_Oauth['st'])){

                        if( stripos($IG_Oauth['txt'], 'CURL' ) !== false) {

                            $updata = array(
                                'is_working' => 0
                            );
                            $this->db->where('id',$proxy_id);
                            $this->db->update(PROXY,$updata);

                            $proxy_item = $this->model->get("*",PROXY,"ig_accounts < 1  AND status = 1 AND is_working = 1");

                            if(!empty($proxy_item)){
                                $proxy = $proxy_item->proxy;
                            }else{
                                $proxy = '';
                            }

                            $IG_Oauth = Instagram_Login($account->username, $account->password, $proxy,'update');

                            if(is_array($IG_Oauth) && isset($IG_Oauth['st'])){
                                $this->reconnect($account->username, $account->password,$IG_Oauth['txt']);
                                ms($IG_Oauth);
                            }

                        }else{
                            $this->reconnect($account->username, $account->password,$IG_Oauth['txt']);
                            ms($IG_Oauth);
                        }

//                        $this->reconnect($account->username, $account->password,$IG_Oauth['txt']);
//						ms($IG_Oauth);
					}else{
						//IG Info 
						$IG_Info = $IG_Oauth->account->getCurrentUser();						
						if($IG_Info->getStatus() != "ok"){
                            $this->reconnect($account->username, $account->password,'Connect failure');
							ms(array(
								"st"  => "error",
								"label" => "bg-red",
								"txt" => l('Connect failure')
							));
						}												//print_r($IG_Info->getUser());die;
						$data = array(
							"checkpoint" => 0,
							"avatar" => $IG_Info->getUser()->getProfilePicUrl(),
                            "auto_update"    => 0
						);						

						$this->db->update(INSTAGRAM_ACCOUNTS, $data, array("id" => post("id")));
						ms(array(
							"st"    => "success",
							"label" => "bg-light-green",
							"txt"   => l('Update successfully')
						));
					}
					break;
			}
			ms(array(
				'st' 	=> 'success',
				"label" => "bg-light-green",
				'txt' 	=> l('Successfully')
			));
		}else{
            $this->reconnect($account->username, $account->password,'Update failure');
			ms(array(
				'st' 	=> 'error',
				"label" => "bg-red",
				'txt' 	=> l('Update failure')
			));
		}
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', INSTAGRAM_ACCOUNTS, "id = '{$id}'".getDatabyUser());
		if(!empty($POST)){
			switch (post("action")) { 
				case 'delete':
					// decrease IG account on proxy
					
					$proxy_item = $this->model->get("*",PROXY,"id = '".$POST->proxy."'");
					if (!empty($proxy_item)&&$proxy_item->ig_accounts!=0) {
						$this->db->where("id",$POST->proxy);
						$this->db->set("ig_accounts","ig_accounts-1",FALSE);
						$this->db->update(PROXY);
					}


					$this->db->delete(INSTAGRAM_ACCOUNTS, "id = '{$id}'".getDatabyUser());
					$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."'".getDatabyUser());
					$this->db->delete(INSTAGRAM_HISTORY, "account_id = '".$id."'".getDatabyUser());
					$this->db->delete(INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
					break;
				
				case 'active':
					$this->db->update(INSTAGRAM_ACCOUNTS, array("status" => 1), "id = '{$id}'".getDatabyUser());
					$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'like' OR category = 'comment' OR category = 'follow' OR category = 'followback' OR category = 'unfollow' OR category = 'repost')".getDatabyUser());
					$this->db->delete(INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
					$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'post' OR category = 'message')".getDatabyUser());
					break;

				case 'disable':
					$this->db->update(INSTAGRAM_ACCOUNTS, array("status" => 0), "id = '{$id}'".getDatabyUser());
					$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'like' OR category = 'comment' OR category = 'follow' OR category = 'followback' OR category = 'unfollow' OR category = 'repost')".getDatabyUser());
					$this->db->delete(INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
					$this->db->delete(INSTAGRAM_HISTORY, "account_id = '".$id."'".getDatabyUser());
					$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'post' OR category = 'message')".getDatabyUser());
					break;
			}
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', INSTAGRAM_ACCOUNTS, "id = '{$id}'".getDatabyUser());
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							// decrease IG account on proxy
							$proxy_item = $this->model->get("*",PROXY,"id = '".$POST->proxy."'");
							if (!empty($proxy_item)&&$proxy_item->ig_accounts!=0) {
								$this->db->where("id",$POST->proxy);
								$this->db->set("ig_accounts","ig_accounts-1",FALSE);
								$this->db->update(PROXY);
							}


							$this->db->delete(INSTAGRAM_ACCOUNTS, "id = '{$id}'".getDatabyUser());
							$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."'".getDatabyUser());
							$this->db->delete(INSTAGRAM_HISTORY, "account_id = '".$id."'".getDatabyUser());
							$this->db->delete(INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
							break;
						case 'active':
							$this->db->update(INSTAGRAM_ACCOUNTS, array("status" => 1), "id = '{$id}'".getDatabyUser());
							$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'like' OR category = 'comment' OR category = 'follow' OR category = 'followback' OR category = 'unfollow' OR category = 'repost')".getDatabyUser());
							$this->db->delete(INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
							$this->db->delete(INSTAGRAM_HISTORY, "account_id = '".$id."'".getDatabyUser());
							$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'post' OR category = 'message')".getDatabyUser());
							break;

						case 'disable':
							$this->db->update(INSTAGRAM_ACCOUNTS, array("status" => 0), "id = '{$id}'".getDatabyUser());
							$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'like' OR category = 'comment' OR category = 'follow' OR category = 'followback' OR category = 'unfollow' OR category = 'repost')".getDatabyUser());
							$this->db->delete(INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
							$this->db->delete(INSTAGRAM_SCHEDULES, "account_id = '".$id."' AND (category = 'post' OR category = 'message')".getDatabyUser());
							break;
					}
				}
			}
		}

		print_r(json_encode(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		)));
	}

    public function ajax_reconnect(){
        $username = post('username');
        $password = post('password');
        $code = post('code');
        $proxy_id = (int)post('proxy');
        if($username == "" || $password == ""){
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Please input all fields')
            ));
        }

        if(session('admin')==1&&post('proxy') == ""){
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Please select a proxy')
            ));
        }

        $proxy = "";

        if($proxy_id!=0){
            $proxy_item = $this->model->get("*", PROXY, "id = '".$proxy_id."' AND status = 1 AND is_working = 1");
            if(!empty($proxy_item)){
                $proxy = $proxy_item->proxy;
                $proxy_id = $proxy_item->id;
            }
        }else{

            // Proxy is to be automated (proxy of admin)
            $setting = $this->model->get("proxy_default",SETTINGS);

            if(!empty($setting)){
                $user_admin = $this->model->get("*",USER_MANAGEMENT,"admin = 1");
                $proxy_default = json_decode($setting->proxy_default);

                $proxy_default_igaccount = $proxy_default->proxy_default_igaccount;
                //echo "ig_accounts < '".$proxy_default_igaccount."' AND uid = '".$user_admin->id."' AND status = 1";die;
                $proxy_item = $this->model->get("*",PROXY,"ig_accounts < ".$proxy_default_igaccount."  AND status = 1 AND is_working=1");

                if(!empty($proxy_item)){
                    $proxy = $proxy_item->proxy;
                    $proxy_id = $proxy_item->id;
                }

            }
        }

        //print_r($proxy_id);die;

        // $code = '087152';
        if(isset($code) AND $code!='' ){
            $ig = approveChallengeVerificationCode($username, $password, $proxy,$code);
            // var_dump($ig->getFullResponse());
            if(is_array($ig) && isset($ig['st'])){

                if( stripos($ig['txt'], 'CURL' ) !== false) {

                    $updata = array(
                        'is_working' => 0
                    );
                    $this->db->where('id',$proxy_id);
                    $this->db->update(PROXY,$updata);

                    $proxy_item = $this->model->get("*",PROXY,"ig_accounts < 1  AND status = 1 AND is_working = 1");

                    if(!empty($proxy_item)){
                        $proxy = $proxy_item->proxy;
                    }else{
                        $proxy = '';
                    }

                    $ig = approveChallengeVerificationCode($username, $password, $proxy,$code);

                    if(is_array($ig) && isset($ig['st'])){
                        ms($ig);
                    }

                }else{
                    ms($ig);
                }

            }

            $info =  $ig->getFullResponse();

            if($info->getStatus() == "ok"){
                //print_r($info->getLoggedInUser());die;
//                $ig_profile_pic = $info->getLoggedInUser()->getProfilePicUrl();
//                $ig_user = $info->getLoggedInUser()->getUsername();
//                $ig_pk = $info->getLoggedInUser()->getPk();

                if($info->getLoggedInUser() == ''){

//                    $ignew = Instagram_Login($username, $password, $proxy);
//
//                    if(is_array($ignew) && isset($ignew['st'])){
//                        ms($ignew);
//                    }

                    $ig->internal->getZeroRatingTokenResult();
                    $ig->people->getBootstrapUsers();
                    $ig->story->getReelsTrayFeed();
                    $ig->timeline->getTimelineFeed(null, ['recovered_from_crash' => true]);
                    $ig->internal->syncUserFeatures();
//                    $this->_registerPushChannels();
                    $ig->direct->getRankedRecipients('reshare', true);
                    $ig->direct->getRankedRecipients('raven', true);
                    $ig->direct->getInbox();
                    $ig->account->getPresenceStatus();
                    $ig->internal->getProfileNotice();
                    //$this->internal->getMegaphoneLog();
                    $ig->people->getRecentActivityInbox();
                    $ig->internal->getQPFetch();
                    $ig->media->getBlockedMedia();
                    $ig->discover->getExploreFeed(null, true);
                    $ig->internal->getFacebookOTA();

                    $ig->client->saveCookieJar();


                    $infonew = $ig->account->getCurrentUser();
                    $user = $infonew->getUser();
                    $fid  = $user->getPk();

                    $ig_profile_pic = $user->getProfilePicUrl();
                    $ig_user = $user->getUsername();
                    $ig_pk = $fid;

                }else{

                    $ig_profile_pic = $info->getLoggedInUser()->getProfilePicUrl();
                    $ig_user = $info->getLoggedInUser()->getUsername();
                    $ig_pk = $info->getLoggedInUser()->getPk();

                }

            }else{
                $ig_profile_pic ='';
                $ig_user ='';
                $ig_pk='';
                ms(array(
                    "st"  => "error",
                    "label" => "bg-red",
                    "txt" => l('Connect failure')
                ));
            }
            //  echo  $info->status;
            //  $info = $ig->logged_in_user;
            //   echo    $info->logged_in_user->profile_pic_url;
            //  echo    $info->logged_in_user->username;


        }else{



            $checkIg_Account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "username = '".$username."'");
            $checkIg_Data = $this->model->get("*", INSTAGRAM_DATA, "username = '".$username."'");
//            echo "<pre>";
//            print_r($checkIg_Account);
//            print_r($checkIg_Data);
//            die();
//            if($checkIg_Account AND $checkIg_Data){
//
//                echo "hello";
//            }else{
//                echo "hiii";
                $this->db->delete(INSTAGRAM_DATA, "username = '$username'");
//            }
            $ig = Instagram_Login($username, $password, $proxy);

//            echo "<pre>";
//            print_r($ig);
//            die();

            if(is_array($ig) && isset($ig['st'])){
                if( stripos($ig['txt'], 'CURL' ) !== false) {

                    $updata = array(
                        'is_working' => 0
                    );
                    $this->db->where('id',$proxy_id);
                    $this->db->update(PROXY,$updata);

                    $proxy_item = $this->model->get("*",PROXY,"ig_accounts < 1  AND status = 1 AND is_working = 1");

                    if(!empty($proxy_item)){
                        $proxy = $proxy_item->proxy;
                    }else{
                        $proxy = '';
                    }

                    $ig = Instagram_Login($username, $password, $proxy);

                    if(is_array($ig) && isset($ig['st'])){
                        ms($ig);
                    }

                }else{
                    ms($ig);
                }
            }
            $info = $ig->account->getCurrentUser();
            $user = $info->getUser();
            $fid  = $user->getPk();

            $ig_profile_pic = $user->getProfilePicUrl();
            $ig_user = $user->getUsername();
            $ig_pk = $fid;

        }

//var_dump($ig);
//        die();
//
        if(is_array($ig) && isset($ig['st'])){
            ms($ig);
        }

        //Instagram Account Info

        if($info->getStatus() != "ok"){
            ms(array(
                "st"  => "error",
                "label" => "bg-red",
                "txt" => l('Connect failure')
            ));
        }

        //$user = $info->user;
        //$fid  = $user->pk;
        $data = array(
            "uid"           => session("uid"),
            "fid"           => $ig_pk,
//			"fid"           => $fid,
            "proxy"         => $proxy_id,
//			"avatar"        => $user->profile_pic_url,
//			"username"      => $user->username,
            "avatar"        => $ig_profile_pic,
            "username"      => $ig_user,
            "password"      => $password,
            "checkpoint"    => 0,
            "auto_update"    => 0
        );
        $fid = $ig_pk;
//        $id = (int)post("id");
//        $accounts = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "uid = ".session("uid"));
//        if($id == 0){
//            if(count($accounts) < getMaximumAccount()){
                $checkAccount = $this->model->get("*", INSTAGRAM_ACCOUNTS, "fid = '".$fid."' AND uid = ".session("uid"));
                if(empty($checkAccount)){
                    ms(array(
                        "st"    => "error",
                        "label" => "bg-red",
                        "txt"   => l('Account not found.')
                    ));
                }
                // Increase 1 IG account on proxy

//                $this->db->where("id",$proxy_id);
//                $this->db->set("ig_accounts","ig_accounts+1",FALSE);
//                $this->db->update(PROXY);
//                if($this->db->insert(INSTAGRAM_ACCOUNTS, $data)){
//                    $id = $this->db->insert_id();
//                    get_setting("like", 0, $id,"logs_counter");
//                    get_setting("comment", 0, $id,"logs_counter");
//                    get_setting("like_follow", 0, $id,"logs_counter");
//                    get_setting("followback", 0, $id,"logs_counter");
//                    get_setting("unfollow", 0, $id,"logs_counter");
//                    get_setting("repost", 0, $id,"logs_counter");
//                    get_setting("message", 0, $id,"logs_counter");
//                    get_setting("deletemedia", 0, $id,"logs_counter");
//                };
//            }else{
//                ms(array(
//                    "st"    => "error",
//                    "label" => "bg-orange",
//                    "txt"   => l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')
//                ));
//            }
//        }else{
//            $checkAccount = $this->model->get("*", INSTAGRAM_ACCOUNTS, "fid = '".$fid."' AND id != '".$id."' AND uid = ".session("uid"));
//            if(!empty($checkAccount)){
//                ms(array(
//                    "st"    => "error",
//                    "label" => "bg-red",
//                    "txt"   => l('This instagram account already exists')
//                ));
//            }
//
//            $account = $this->model->get("*",INSTAGRAM_ACCOUNTS,"id = '".$id."' AND uid = ".session("uid"));
//            if(!empty($account)){
//                if($account->proxy!=$data["proxy"]){
//                    // Increase 1 IG account on new proxy.
//                    $this->db->where("id",$data["proxy"]);
//                    $this->db->set("ig_accounts","ig_accounts+1",FALSE);
//                    $this->db->update(PROXY);
//
//                    // Decrease 1 IG account on old proxy.
//                    $proxy_item = $this->model->get("*",PROXY,"id = '".$account->proxy."'");
//                    if (!empty($proxy_item)&&$proxy_item->ig_accounts!=0) {
//                        $this->db->where("id",$account->proxy);
//                        $this->db->set("ig_accounts","ig_accounts-1",FALSE);
//                        $this->db->update(PROXY);
//                    }
//                }
//            }

//            $this->db->update(INSTAGRAM_ACCOUNTS, $data, array("id" => post("id")));
            $this->db->update(INSTAGRAM_ACCOUNTS, $data, array("username" => post("username")));
//        }

        //Add activity
//        $activity = array(
//            "uid" 			=> session("uid"),
//            "account_id" 	=> $id,
//            "account_name" 	=> $data['username'],
//            "data" 			=> '{"todo":"{\"like\":1,\"comment\":1,\"follow\":0,\"like_follow\":0,\"followback\":0,\"unfollow\":0,\"repost\":3,\"deletemedia\":0}","targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":"[\"author\",\"vacation\",\"instaart\",\"nature\",\"tasty\",\"masterpiece\",\"creative\",\"bestoftheday\",\"pretty\",\"siblings\",\"clouds\",\"page\",\"throwbackthursday\",\"cuddle\",\"instafollow\",\"lovely\",\"shoutout\",\"cute\",\"draw\"]","usernames":"null","locations":"null","comments":"[\" Made my day\",\"Totally rocks!\",\"Very nice\",\"Very sweet :)\",\"This is great\",\"So cool\",\"Fascinating one\",\"Neat-o!\",\"Gorgeous! Love it!\",\"The cutest :grinning:\",\"Breathtaking one\",\"This is awesome :)\",\"Outstanding one!\",\"Whoopee!\",\"My Goodness!\",\"This is awesome!\"]","messages":"null","filter":"{\"media_age\":\"\",\"media_type\":\"\",\"min_likes\":0,\"max_likes\":0,\"min_comments\":0,\"max_comments\":0,\"user_relation\":\"\",\"user_profile\":\"\",\"min_followers\":0,\"max_followers\":0,\"min_followings\":0,\"max_followings\":0,\"gender\":\"\"}"}',
//            "blacklists" 	=> '{"bl_tags":"[\"sex\",\"xxx\",\"fuckyou\",\"videoxxx\",\"nude\"]","bl_usernames":"null","bl_keywords":"[\"nude\",\"sex\",\"fuck now\"]"}',
//            "status" 		=> 1,
//            "created" 		=> NOW
//        );

//        $schedule = $this->model->get("*", SETTINGS);
//        $schedule_default = json_decode($schedule->schedule_default);
//
//        $todo = json_encode($schedule_default->todo);
//        $location = json_encode($schedule_default->locations);
//        $deftags = json_encode($schedule_default->tags);
//        $comments = json_encode($schedule_default->comments);
//        $messages = json_encode($schedule_default->messages);
//        $filter = json_encode($schedule_default->filter);
//
//        $target = post('target');
//
//        if($target != ''){
//
//            $targetresp = $this->db->get_where('targets', array("id" => $target));
//            $newresp = $targetresp->num_rows()>0 ? $targetresp->result_array() : '';
//
//        }else{
//            $newresp = '';
//        }
//
//
//        if($newresp != ''){
//
////            $newt = json_encode(array('tags' => $newresp[0]['data']));
//            $newt = json_encode($newresp[0]['data']);
//
//            if($newresp[0]['influencers'] != null ){
//                $newu = json_encode($newresp[0]['influencers']);
//            }else{
//                $newu = 'null';
//            }
//
////            $tags = '{"todo":"{\"like\":1,\"comment\":0,\"follow\":1,\"like_follow\":0,\"followback\":0,\"unfollow\":1,\"deletemedia\":0}","targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":'.$newt.',"usernames":'.$newu.',"locations":"null","comments":"[\" Made my day\",\"Totally rocks!\",\"Very nice\",\"Very sweet :)\",\"This is great\",\"So cool\",\"Fascinating one\",\"Neat-o!\",\"Gorgeous! Love it!\",\"The cutest :grinning:\",\"Breathtaking one\",\"This is awesome :)\",\"Outstanding one!\",\"Whoopee!\",\"My Goodness!\",\"This is awesome!\"]","messages":"[\"Thank you for following me:)\"]","filter":"{\"media_age\":\"\",\"media_type\":\"\",\"min_likes\":0,\"max_likes\":0,\"min_comments\":0,\"max_comments\":0,\"user_relation\":\"\",\"user_profile\":\"\",\"min_followers\":0,\"max_followers\":0,\"min_followings\":0,\"max_followings\":0,\"gender\":\"\"}"}';
//            $tags = '{"todo":'.$todo.',"targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":'.$newt.',"usernames":'.$newu.',"locations":'.$location.',"comments":'.$comments.',"messages":'.$messages.',"filter":'.$filter.'}';
//
//        }else{
//
////            $tags = '{"todo":"{\"like\":1,\"comment\":1,\"follow\":0,\"like_follow\":0,\"followback\":0,\"unfollow\":0,\"repost\":3,\"deletemedia\":0}","targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":"[\"author\",\"vacation\",\"instaart\",\"nature\",\"tasty\",\"masterpiece\",\"creative\",\"bestoftheday\",\"pretty\",\"siblings\",\"clouds\",\"page\",\"throwbackthursday\",\"cuddle\",\"instafollow\",\"lovely\",\"shoutout\",\"cute\",\"draw\"]","usernames":"null","locations":"null","comments":"[\" Made my day\",\"Totally rocks!\",\"Very nice\",\"Very sweet :)\",\"This is great\",\"So cool\",\"Fascinating one\",\"Neat-o!\",\"Gorgeous! Love it!\",\"The cutest :grinning:\",\"Breathtaking one\",\"This is awesome :)\",\"Outstanding one!\",\"Whoopee!\",\"My Goodness!\",\"This is awesome!\"]","messages":"[\"Thank you for following me:)\"]","filter":"{\"media_age\":\"\",\"media_type\":\"\",\"min_likes\":0,\"max_likes\":0,\"min_comments\":0,\"max_comments\":0,\"user_relation\":\"\",\"user_profile\":\"\",\"min_followers\":0,\"max_followers\":0,\"min_followings\":0,\"max_followings\":0,\"gender\":\"\"}"}';
////            $tags = '{"todo":"{\"like\":1,\"comment\":0,\"follow\":1,\"like_follow\":0,\"followback\":0,\"unfollow\":1,\"deletemedia\":0}","targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":"null","usernames":"null","locations":"null","comments":"[\" Made my day\",\"Totally rocks!\",\"Very nice\",\"Very sweet :)\",\"This is great\",\"So cool\",\"Fascinating one\",\"Neat-o!\",\"Gorgeous! Love it!\",\"The cutest :grinning:\",\"Breathtaking one\",\"This is awesome :)\",\"Outstanding one!\",\"Whoopee!\",\"My Goodness!\",\"This is awesome!\"]","messages":"[\"Thank you for following me:)\"]","filter":"{\"media_age\":\"\",\"media_type\":\"\",\"min_likes\":0,\"max_likes\":0,\"min_comments\":0,\"max_comments\":0,\"user_relation\":\"\",\"user_profile\":\"\",\"min_followers\":0,\"max_followers\":0,\"min_followings\":0,\"max_followings\":0,\"gender\":\"\"}"}';
//            $tags = '{"todo":'.$todo.',"targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":"{\"repost\":3,\"like\":20,\"comment\":6,\"deletemedia\":10,\"follow\":15,\"like_follow\":1,\"followback\":15,\"unfollow\":15,\"delay\":6,\"type\":1}","tags":'.$deftags.',"usernames":"null","locations":'.$location.',"comments":'.$comments.',"messages":'.$messages.',"filter":'.$filter.'}';
//
//        }
//
//        $activity = array(
//            "uid" 			=> session("uid"),
//            "account_id" 	=> $id,
//            "account_name" 	=> $data['username'],
//            "data" 			=> $tags,
////			"blacklists" 	=> '{"bl_tags":"[\"sex\",\"xxx\",\"fuckyou\",\"videoxxx\",\"nude\"]","bl_usernames":"null","bl_keywords":"[\"nude\",\"sex\",\"fuck now\"]"}',
//            "blacklists" 	=> '{"bl_tags":"null","bl_usernames":"null","bl_keywords":"null"}',
//            "status" 		=> 1,
//            "created" 		=> NOW
//        );
//
//        $check = $this->model->get("*", INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
//        if(!empty($check)){
//            $this->db->update(INSTAGRAM_ACTIVITY, $activity, array("id" => $check->id));
//        }else{
//            $this->db->insert(INSTAGRAM_ACTIVITY, $activity);
//        }

        ms(array(
            "st"    => "success",
            "label" => "bg-light-green",
            "txt"   => l('Updated successfully'),
            "accountStatus" => true,
        ));
    }
}
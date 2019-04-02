<?php
set_time_limit(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class cron extends MX_Controller {

	public function __construct(){
		parent::__construct();
		ini_set('mysql.connect_timeout', -1);
		ini_set('default_socket_timeout', -1);    
		$this->load->model(get_class($this).'_model', 'model');
	}
	
	/*
		Test Code for Filters
	*/
	public function devlike(){
		
		//echo date('Y-d-m h:i:s',$row->getTakenAt());die;
		//ini_set("max_execution_time",60); 
        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

		
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    //->where('status', 5)
	    ->where('category', 'like') 
	    //->where('time_post <= ', NOW)
		->where("account_id" , 808)
	    ->get()->result();
			
		if(!empty($result)){
			foreach ($result as $key => $row) {
				 
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;  
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);
				$account_id = $row->account_id;
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");

//                    echo $row->account_name;
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
                            $this->db->delete(INSTAGRAM_SCHEDULES, array("uid" => $row->uid));
                            $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("uid" => $row->uid));
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."' AND status = 1 AND is_working = 1");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}
						$row->description = unset_match_values($row->description,$row->blacklists);
						echo "<pre>";
						$response = (object)Instagram_Post((object)$row);
						print_r($response);  
						die; 
                        if(isset($response->data)){
                            $ndata = json_decode($response->data);
							$row->follower_id = $ndata->user->pk;
                        }
						 
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$activity_account = $this->model->get("*", INSTAGRAM_ACTIVITY, " uid = '".$row->uid."' AND account_id = '".$row->account_id."'");
							$account_data = json_decode($activity_account->data);
							$messages = json_decode($account_data->messages,true);
							 
							$follow_response = json_decode($response->data);

							$n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
							update_setting($row->type,$n,$row->account_id,"logs_counter");
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							
						}

                        if(isset($response->st) && $response->st == "error"){
                            create_log($row->account_name,$row->type ,$response->txt);
                        }
						$arr_update = array(
							'status' => (isset($response->st) && $response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5; 

                            if(isset($response->st) && $response->st == "success"){								  
                                $arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

                                $date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM));
                                $date->setTimezone(new DateTimeZone($user->timezone));
                                $time_post_show = $date->format('Y-m-d H:i:s');
                                $arr_update['time_post_show'] = $time_post_show;
                            }else{
								$arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

								$date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM)); 
								$date->setTimezone(new DateTimeZone($user->timezone));
								$time_post_show = $date->format('Y-m-d H:i:s');
								$arr_update['time_post_show'] = $time_post_show;
							}
							
							$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"like"));

						}else{
							
							$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"like"));
						}
						
						
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}


					
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}

		echo l('Successfully');
	}

	/*
		Test Code Ends here
	*/


	public function notify_stripe_payment_recurring(){
		// Retrieve the request's body and parse it as JSON:
		$input = file_get_contents('php://input');
		$likes_history_path = dirname(__FILE__) . '/recurring'; 
		if (!is_dir($likes_history_path)){
				//mkdir - tells that need to create a directory
				mkdir($likes_history_path,0777,true);
		}
		$r = false; 
		
		if (!file_exists($likes_history_path.'/test_log.json')){
			
		
			$r = file_put_contents($likes_history_path.'/test_log.json',$input, FILE_APPEND);
		}
		$event_json = json_decode($input); 
       
		// Do something with $event_json

		http_response_code(200); // PHP 5.4 or greater 
	} 
	/* Please Don't Delete this function i have writed for testing purpose*/
	public function tester(){
		//var_dump(Instagram_Genter('abbasjami47'));die;
		$result = $this->db
	    ->select('*') 
	    ->from('targets')
	    ->get()->result();
		echo '<pre>';print_r($result);die; 
		/*$res = json_decode('[["Art.nights","Photography","Art_spotlight","Generalpublic.art","Art.magazine","Artofdrawingg","Canon_photos","Nightphotography"],["Ferrari","Ferrariusa","Bentlyofficial","Rollsroycecars","Lamborghini","Mercedesbenz","Needforspeed"],["Entrepreneur","Huffpost","Huffpostwomen","Womenontopp","Businessinsider","Entrepreneurshipfacts","Garyvee","Successmagazine"],["Menfashion","Mensfashions","Menfashioner","Lux.men","Gentlemen","Highfashionmen","Fashionnovamen"],["Dressdreamz","Fashionista_com","Fashionweek","Women_with_style","Fashionnova","Fashion.voyage","Fashioninflux"],["Alexbeadon","_thesixfigurechick_","Daniellelaporte","Marieforleo","Megganwatterson","Amyporterfield","Jasminestar","Shandasumpter","Ambermccue","Screwtheninetofive","ChalleneJohnson","Womeneur"],["Curtiswilliams17","Menshealthmag","Thebenbooker","Getfitwithgiddy","Bjgaddour","Jaycardiello","Thorbjornsson","Dylanwerneryoga","Mathewfras","Andyspeer"],["Tonyrobbins","Fitlifelucy","Hannahbower2","Zannavandijk","Celia_gabbiani","Thealiyajanell","Annavictoria","Gypsetgoddess","Amandabisk","Shutthekaleup","Kirstygodso"],["Deliciouslyella","Rachaelsgoodeats","Foodyeating","Stephclairesmith","Sjanaelise","Hannahpolites","Gabbyepstein","Tashoakley","Buzzfeedtasty"],["Sjanaelise","Dylanwerneryoga","Mirepoixstudio","Rachlmansfield","Thechalkboardmag","Marytilson","Mynameisjessamyn","Shutthekaleup","Nomnompaleo","Mikaelareuben","Rochellebilow","Lonijane"],["Luxinst","Luxury","Thexpensive","Louisvuitton","Jimmychoo","Nordstrom","Rolex","The_luxury_life"],["Tonyrobbins","Motivationmafia","Motivated.mindset","Agentsteven","Grantcardone","Brendonburchard","Proctorgallagher","Thelesbrown","Arvinsworld","Entrepreneur","Garyvee"],["Applemusic","Music","Music_box_tv","Music.love.quotes","Radio_musical","Kanebrown_music","Musicallys","Musicallybestvideo","Productionmusiclive"],["Parents","Badparentingmoments","Averageparentproblems","Dadsaysjokes","Dad","Lifeofdad"],["Kristinakuzmic","Gparrish","Diaryofafitmommyofficial","Averageparentproblems","Kidsaretheworst","Badparentingmoments"],["Dog","Cats_of_instagram","Puppystagrams","Dog.lovers","Dogsofinstagram","Marniethedog","Catsofweek"],["Fredrikeklundny","Ryanserhant","Thejoshaltman","Chadcarroll","Barbaracorcoran","Luisiglesiasrealestate","Kevin.vaughan","Laughing_realtor","Joycereyrealestate","Grantcardone","Cleverinvestor"],["Entrepreneur","Garyvee","Huffpost","Huffpostwomen","Businessinsider","Teamgaryvee","Relentlesspowerdigital"],["Amazing.planets","Travelsfever","Places","Followmefaraway","Bbc_travel","Globefever","Voyagefervor","Travel"],["Yoga_girl","Yoga","Yogaongaia","Acroyoga","Aloyoga","Beachyogagirl","Wanderlustfest"]]');
		foreach($res as $influencer){
			
			echo '<pre>';
			$new_arr = array();
			foreach($influencer as $list){
				$url = 'https://getigdata.com/Api?username='.$list;
			
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $url);

				$insta_source = curl_exec($ch);
				curl_close($ch);
				$insta_source = json_decode($insta_source);
				$new_arr[] = $insta_source->insta_account[0]->instagram_id.'|'.$list;
			}
			echo json_encode($new_arr);
			echo '</pre>';
		}
		die;
		echo 'payment response';
		$d = json_decode('{"id":"sub_EXS36Q7jvY4YdS","object":"subscription","application_fee_percent":null,"billing":"charge_automatically","billing_cycle_anchor":1550300414,"billing_thresholds":null,"cancel_at":null,"cancel_at_period_end":false,"canceled_at":null,"created":1550300414,"current_period_end":1550386814,"current_period_start":1550300414,"customer":"cus_EXS3xOtJuFWN2Z","days_until_due":null,"default_source":null,"discount":null,"ended_at":null,"items":{"object":"list","data":[{"id":"si_EXS3uxcjNzl2D8","object":"subscription_item","billing_thresholds":null,"created":1550300415,"metadata":[],"plan":{"id":"business","object":"plan","active":true,"aggregate_usage":null,"amount":40000,"billing_scheme":"per_unit","created":1550299869,"currency":"usd","interval":"day","interval_count":1,"livemode":false,"metadata":[],"name":"business","nickname":"business","product":"prod_EXRuX5EHtMRysB","statement_descriptor":null,"tiers":null,"tiers_mode":null,"transform_usage":null,"trial_period_days":null,"usage_type":"licensed"},"quantity":1,"subscription":"sub_EXS36Q7jvY4YdS"}],"has_more":false,"total_count":1,"url":"\/v1\/subscription_items?subscription=sub_EXS36Q7jvY4YdS"},"livemode":false,"metadata":[],"plan":{"id":"business","object":"plan","active":true,"aggregate_usage":null,"amount":40000,"billing_scheme":"per_unit","created":1550299869,"currency":"usd","interval":"day","interval_count":1,"livemode":false,"metadata":[],"name":"business","nickname":"business","product":"prod_EXRuX5EHtMRysB","statement_descriptor":null,"tiers":null,"tiers_mode":null,"transform_usage":null,"trial_period_days":null,"usage_type":"licensed"},"quantity":1,"schedule":null,"start":1550300414,"status":"active","tax_percent":null,"trial_end":null,"trial_start":null}');
		echo '<pre>';
		echo date('Y-d-m',$d->current_period_end);*/ 
		 
	}

	public function devtest(){	
		//var_dump(make_request('http://ig1:IqXhfXpj@107.161.85.220:80'));die;
		error_reporting(E_ALL);
ini_set('display_errors', 1);
		$condition = ['where' => ['status' => 1,'id' => 397]];
		//$condition = array();
		$this->load->model('common_model');
		$users = $this->common_model->fetch_data(USER_MANAGEMENT, '*', $condition);
		
		foreach($users as $user){
			
			$uid = $user['id'];
			if($uid == 397){
				$ig_condition = ['where' => ['uid' => $uid]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){
						//var_dump($ig);die; 
						
						$id = $ig['id'];
						if($id == 357){
							continue;
						}
						$username = $ig['username']; 
						
						$schedule = $this->model->get("*", SETTINGS);
						
						$schedule_default = json_decode($schedule->schedule_default);

						$todo = json_encode($schedule_default->todo);
						$location = json_encode($schedule_default->locations);
						$deftags = json_encode($schedule_default->tags);
						$comments = json_encode($schedule_default->comments);
						$messages = json_encode($schedule_default->messages);
						$filter = json_encode($schedule_default->filter);
						$slow = json_decode($schedule_default->slow);
						$slow = (array)$slow;
						$nspeed = array_merge($slow,array('type' => 1));
						$dspeed = json_encode(json_encode($nspeed));
					
						$tags = '{"todo":'.$todo.',"targets":"{\"tag\":1,\"location\":1,\"followers\":1,\"followings\":2,\"likers\":2,\"commenters\":3,\"unfollow\":\"{\"unfollow_source\":1,\"unfollow_followers\":0,\"unfollow_follow_age\":\"0\"}\"}","speed":'.$dspeed.',"tags":'.$deftags.',"usernames":"null","locations":'.$location.',"comments":'.$comments.',"messages":'.$messages.',"filter":'.$filter.'}';
						$activity = array(
							"uid" 			=> $uid,
							"account_id" 	=> $id, 
							"account_name" 	=> $username,
							"data" 			=> $tags,			
							//"blacklists" 	=> '{"bl_tags":"[\"sex\",\"xxx\",\"fuckyou\",\"videoxxx\",\"nude\"]","bl_usernames":"null","bl_keywords":"[\"nude\",\"sex\",\"fuck now\"]"}',
							"blacklists" 	=> '{"bl_tags":"null","bl_usernames":"null","bl_keywords":"null"}',
							"status" 		=> 1,
							"created" 		=> NOW
						);
						echo '<pre>';
						print_r($activity);
						echo '</pre>';
						$check = $this->model->get("*", INSTAGRAM_ACTIVITY, "account_id = '".$id."'".getDatabyUser());
						if(!empty($check)){
							$this->db->update(INSTAGRAM_ACTIVITY, $activity, array("id" => $check->id)); 
						}else{
							$this->db->insert(INSTAGRAM_ACTIVITY, $activity);
						}
						
					}
				}
			
			
			}
			
		} 	
		
		die;
	}
	/* Please Don't Delete this Above function i have writed for testing purpose*/
	
	
	
    public function payment(){

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers','errorlog',$homepath);

        ini_set('error_log', $new_home.'/payment.log'); // Logging file

//        ini_set('log_errors_max_len', 1024);

        //ini_set('max_execution_time', 30000000);

        $result = $this->db
            ->select('*')
            ->from(USER_MANAGEMENT)
            ->where('expiration_date <', NOW)
            ->where('package_id != 1')
            ->where('admin', 0)
            ->where('(last_mail IS NULL OR DATE(last_mail) < DATE("'.NOW.'"))')
	        ->limit(5)
            ->get()->result();

//        echo count($result);
//        echo "<pre>";
//        print_r($result);
//        die();

        if(!empty($result)){

            $settings = $this->db->select("*")->get(SETTINGS)->row();
            $subject = l('Account Expired').' - '.$settings->website_title;
            $message = '
					<html>
					<head>
					<title>'.l('Account Expired').' - '.$settings->website_title.'</title>
					</head>
					<body>
					<p>'.l('Hey,').'</p>
					<p>'.l('Just a quick heads up that your account has been expired and your account activity has stopped. To continue the benefits without any interuption please purchase any package from following packages.').'</p>
					<p>'.l('Please => ').'<a target="_blank" href="https://app.igplan.com">'.l('go HERE to get your account growing again.').'</a></p>
					<p>'.l('Thanks!').'</p>
					<p>'.l('Your IGplan team').'</p>
					</body>
					</html>
					';


            foreach ($result as $key => $row) {

                require APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;
//				$mail->SMTPDebug = 2;                               // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = $settings->mail_smtp_host;  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = $settings->mail_smtp_user;                 // SMTP username
                $mail->Password = $settings->mail_smtp_pass;                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = (int)$settings->mail_smtp_port;                                    // TCP port to connect to

                $mail->setFrom($settings->mail_from_email, $settings->mail_from_name);
                $mail->addAddress($row->email);     // Add a recipient
                $mail->addReplyTo($settings->mail_from_email, 'Admin');
                $mail->addCC($settings->mail_from_email);
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = $subject;
                $mail->Body    = $message;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if(!$mail->send()) {
                    echo "Mail Not Send";
                    create_log($row->email,'mail' ,'Mail Not Send');
                } else {

                    $this->db->update(USER_MANAGEMENT,array( 'last_mail'=> NOW ),array('id'=>$row->id));
                    echo "Mail Send";

                }


            }
        }

        echo l('Successfully');
    }

	public function post(){ 
		$spintax = new Spintax(); 
		//ini_set('max_execution_time', 30000000);
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status !=', 2)
      	->where('status !=', 3)
      	->where('status !=', 4)
	    ->where('category', 'post')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "username = '".$row->account_name."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$row->password = $account->password;
					$row->username = $account->username;
					$row->fid = $account->fid;

					//Add Proxy
					$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
					if(!empty($proxy_item)){
						$row->proxy = $proxy_item->proxy;
					}else{
						$row->proxy = "";
					}

					$response = (object)Instagram_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Instagram account not exist')
					);
					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
				}
			}
		}
		echo l('Successfully');
	}

	public function like(){
		
		if(!isset($_GET['easycron'])){ 
			exit; 
		}
		
		//ini_set("max_execution_time",60); 
        error_reporting(E_ALL); // Error engine - always ON!

       ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        
		
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'like')
	    ->where('time_post <= ', NOW)
		
	    ->get()->result();
	
		
		if(!empty($result)){
			foreach ($result as $key => $row) {
				 
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;  
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);
				$account_id = $row->account_id;
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");

//                    echo $row->account_name;
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
                            $this->db->delete(INSTAGRAM_SCHEDULES, array("uid" => $row->uid));
                            $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("uid" => $row->uid));
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."' AND status = 1 AND is_working = 1");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}
						$row->description = unset_match_values($row->description,$row->blacklists);
						
						$response = (object)Instagram_Post((object)$row);
//                        

                        if(isset($response->data)){
                            $ndata = json_decode($response->data);
							$row->follower_id = $ndata->user->pk;
                        }
						 
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$activity_account = $this->model->get("*", INSTAGRAM_ACTIVITY, " uid = '".$row->uid."' AND account_id = '".$row->account_id."'");
							$account_data = json_decode($activity_account->data);
							$messages = json_decode($account_data->messages,true);
							 
							$follow_response = json_decode($response->data);

							$n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
							update_setting($row->type,$n,$row->account_id,"logs_counter");
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							
						}

                        if(isset($response->st) && $response->st == "error"){
                            create_log($row->account_name,$row->type ,$response->txt);
                        }
						$arr_update = array(
							'status' => (isset($response->st) && $response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5; 

                            if(isset($response->st) && $response->st == "success"){								  
                                $arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

                                $date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM));
                                $date->setTimezone(new DateTimeZone($user->timezone));
                                $time_post_show = $date->format('Y-m-d H:i:s');
                                $arr_update['time_post_show'] = $time_post_show;
                            }else{
								$arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

								$date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM)); 
								$date->setTimezone(new DateTimeZone($user->timezone));
								$time_post_show = $date->format('Y-m-d H:i:s');
								$arr_update['time_post_show'] = $time_post_show;
							}
							
							$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"like"));

						}else{
							
							$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"like"));
						}
						
						
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}


					
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}

		echo l('Successfully');
	}

	public function comment(){

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        if(!isset($_GET['easycron'])){ 
			exit; 
		} 
		
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'comment')
	    ->where('time_post <= ', NOW)
		//->limit($limit_item['limit_per_page'],$limit_item['start_index'])
	    //->limit(10)
	    ->get()->result();

//        echo "<pre>";

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;
				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");

//                    echo $row->account_name;
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
                            $this->db->delete(INSTAGRAM_SCHEDULES, array("uid" => $row->uid));
                            $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("uid" => $row->uid));
							continue;
						}

						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid      = $account->fid;
						$row->timezone = $user->timezone;
						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."' AND status = 1 AND is_working = 1");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}
						$row->description = unset_match_values($row->description,$row->blacklists);
						$response = (object)Instagram_Post((object)$row);

                        if(isset($response->code)) {
                            $check_data = $this->model->get("*", INSTAGRAM_HISTORY, " uid = '".$row->uid."' AND account_id = '".$row->account_id."' AND pk = '".$response->code."'");

                            if(!empty($check_data)){
                                continue;
                            }
                        }

//                        print_r($response);
                        if(isset($response->data)){
                            $ndata = json_decode($response->data);
//                            $odata = json_decode($ndata->user);
//                            print_r($ndata);
//                            $row->follower_id = $odata->pk;
                            $row->follower_id = $ndata->user->pk;
                        }

						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$activity_account = $this->model->get("*", INSTAGRAM_ACTIVITY, " uid = '".$row->uid."' AND account_id = '".$row->account_id."'");
							$account_data = json_decode($activity_account->data);
							$messages = json_decode($account_data->messages,true);
							
							$follow_response = json_decode($response->data);
						
							
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							//increase counter
							$n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
							update_setting($row->type,$n,$row->account_id,"logs_counter");
						}

                        if(isset($response->st) && $response->st == "error"){
                            create_log($row->account_name,$row->type ,$response->txt);
                        }
						$arr_update = array(
							'status' => (isset($response->st) && $response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;

                            if(isset($response->st) && $response->st == "success"){
                                $arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

                                $date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM));
                                $date->setTimezone(new DateTimeZone($user->timezone));
                                $time_post_show = $date->format('Y-m-d H:i:s');
                                $arr_update['time_post_show'] = $time_post_show;
								$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"comment"));
                            }else{
								$arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

								$date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM)); 
								$date->setTimezone(new DateTimeZone($user->timezone));
								$time_post_show = $date->format('Y-m-d H:i:s');
								$arr_update['time_post_show'] = $time_post_show;
							}
						}else{
								
								$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"comment"));
							}

					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}

//					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
//                    print_r($arr_update);
                    
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

	public function follow(){

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging
		
		if(!isset($_GET['easycron'])){ 
			exit; 
		} 
        
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'follow')
	    ->where('time_post <= ', NOW)
		//->limit($limit_item['limit_per_page'],$limit_item['start_index'])
	    //->limit(10)
	    ->get()->result();

        echo count($result);

//        echo "<pre>";
//        print_r($result);

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;
                $failcount       = $row->failcount;
//                echo $failcount;

//				$time_post          = strtotime(NOW) + $repeat_time;
//				$time_post_only_day = date("Y-m-d", $time_post);
//				$time_post_day      = strtotime($time_post_only_day);
				$time_post_day      = strtotime(date("Y-m-d"));
				$repeat_end         = strtotime($repeat_end);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
                if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
//                    print_r($user);
//                    echo $row->account_name;
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
                            $this->db->delete(INSTAGRAM_SCHEDULES, array("uid" => $row->uid));
                            $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("uid" => $row->uid));
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;
						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."' AND status = 1 AND is_working = 1");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}

						$row->description = unset_match_values($row->description,$row->blacklists);

						$response = (object)Instagram_Post((object)$row);

                        if(isset($response->code)) {
                            $check_data = $this->model->get("*", INSTAGRAM_HISTORY, " uid = '".$row->uid."' AND account_id = '".$row->account_id."' AND pk = '".$response->code."'");

                            if(!empty($check_data)){
                                continue;
                            }
                        }

                        if(isset($response->data)){
                            $ndata = json_decode($response->data);
//                            print_r($ndata);
                            $row->follower_id = $ndata->pk;
                        }
//                        print_r($response);
						//echo '<pre>';print_r($account_data);
						//die;
						$arr_update = array();
//                        print_r($response);
//                        echo $response->st;
						if(isset($response->st) && $response->st == "success"){
							$activity_account = $this->model->get("*", INSTAGRAM_ACTIVITY, " uid = '".$row->uid."' AND account_id = '".$row->account_id."'");
							$account_data = json_decode($activity_account->data);
//							$messages = json_decode($account_data->messages,true);
							$messages = json_decode($account_data->messages);
//							echo "heii";
							$follow_response = json_decode($response->data);
                            $this->db->insert(
                                    INSTAGRAM_HISTORY,
                                    array(
                                        "uid" => $row->uid,
                                        "account_id" => $row->account_id,
                                        "type" => $row->type,
                                        "pk" => $response->code,
                                        "data" => $response->data,
                                        "created" => NOW
                                    )
                                );

							// add followed user and increase counter
							$data_tmp = json_decode($response->data);
							if(is_object($data_tmp)){
								$option = array(
									"type"			            => $row->type,
									"key"			            => $data_tmp->pk."@".$data_tmp->username,
									"account_id"	            => $row->account_id,
								);
								update_followed_iguser($option);
							}


						}



                        if(isset($response->st) && $response->st == "error"){
                            create_log($row->account_name,$row->type ,$response->txt);

                        }

						$arr_update = array(
							'status' => (isset($response->st) && $response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
//                        echo $response->st;



						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;
//                            echo $response->st;
                            if(isset($response->st) && $response->st == "success"){

                                if($failcount == 0){

                                    $repeat_time = $repeat_time;

                                }else{

                                    $ntime = $failcount * 60;

                                    $mtime = $repeat_time - $ntime;

                                    if($mtime < 0){

                                        $repeat_time = 0;

                                    }else{

                                        $repeat_time = $mtime;

                                    }

                                }

                                $arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

                                $date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM));
                                $date->setTimezone(new DateTimeZone($user->timezone));
                                $time_post_show = $date->format('Y-m-d H:i:s');
                                $arr_update['time_post_show'] = $time_post_show;;

                                $arr_update['failcount']    = 0;

                            }else if(isset($response->st) && $response->st == "error"){
								
								
								$arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

								$date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM)); 
								$date->setTimezone(new DateTimeZone($user->timezone));
								$time_post_show = $date->format('Y-m-d H:i:s');
								$arr_update['time_post_show'] = $time_post_show;
							

                                $arr_update['failcount']    = $failcount + 1;

                                echo $arr_update['failcount'];

                            }
							
							 $this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>'follow'));

						}else{
							
							 $this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>'follow'));
						}
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}


                   
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

  	public function like_follow(){
		//ini_set('max_execution_time', 30000000);

        $limit_item = divisible_cronjob($category='like_follow',segment(3));
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'like_follow')
	    ->where('time_post <= ', NOW)
	    //->limit($limit_item['limit_per_page'],$limit_item['start_index'])
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
							$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}
						$row->description = unset_match_values($row->description,$row->blacklists);
						$response = (object)Instagram_Post((object)$row);
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							// add followed user and increase counter
							$data_tmp = json_decode($response->data);
							if(is_object($data_tmp)){
								$data_key = "";
								if(isset($data_tmp->pk)){
									$data_key = $data_tmp->pk;
								}								
								if(isset($data_tmp->username)){
									$data_key =$data_tmp->pk."@".$data_tmp->username;
								}
								$option = array(
									"type"			            => $row->type,
									"key"			            => $data_key,
									"account_id"	            => $row->account_id,
								);
								update_followed_iguser($option);
							}

						}
						$arr_update = array(
							'status' => ($response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;
							$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}

//					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
                    $this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"type"=>$row->category));
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

	public function unfollow(){

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging
		if(!isset($_GET['easycron'])){ 
			exit; 
		}
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'unfollow')
	    ->where('time_post <= ', NOW)
		//->limit($limit_item['limit_per_page'],$limit_item['start_index'])
        //->limit(10)
	    ->get()->result();

		//echo "<pre>";       print_r($this->db->last_query());       die();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");

//                    echo $row->account_name;

					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
							$this->db->delete(INSTAGRAM_SCHEDULES, array("uid" => $row->uid));
                            $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("uid" => $row->uid));
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."' AND status = 1 AND is_working = 1");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}
						//$row->description = unset_match_values($row->description,$row->blacklists);
						//var_dump($row->description);die;
						$response = (object)Instagram_Post((object)$row);
//                        print_r($response);
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$check_item = $this->model->get('*',INSTAGRAM_HISTORY," (`type` = 'follow' OR `type` = 'followback' OR `type` = 'like_follow')  AND   `pk` = '".$response->code."'");
//							print_r($check_item);
                            if(!empty($check_item)){
								$this->db->update(
									INSTAGRAM_HISTORY,
									array(
										"type" 		=> $row->type,
										"created" 	=> NOW,
									),
									" (`type` = 'follow' OR `type` = 'like_follow')  AND   `pk` = '".$response->code."'"
								);
							}else{

								$this->db->insert(
									INSTAGRAM_HISTORY,
									array(
										"uid" => $row->uid,
										"account_id" => $row->account_id,
										"type" => $row->type,
										"pk" => $response->code,
										"data" => $response->data,
										"created" => NOW
									)
								);
							}
							
							//increase counter
							$n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
							update_setting($row->type,$n,$row->account_id,"logs_counter");

						}

                        if(isset($response->st) && $response->st == "error"){
                            create_log($row->account_name,$row->type ,$response->txt);
                        }

						$arr_update = array(
							'status' => (isset($response->st) && $response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;

                            if(isset($response->st) && $response->st == "success"){

                                $arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

                                $date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM));
                                $date->setTimezone(new DateTimeZone($user->timezone));
                                $time_post_show = $date->format('Y-m-d H:i:s');
                                $arr_update['time_post_show'] = $time_post_show;
                            }else{
								$arr_update['time_post'] = date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time);

								$date = new DateTime(date("Y-m-d H:i:s", strtotime(NOW) + $repeat_time), new DateTimeZone(TIMEZONE_SYSTEM)); 
								$date->setTimezone(new DateTimeZone($user->timezone));
								$time_post_show = $date->format('Y-m-d H:i:s');
								$arr_update['time_post_show'] = $time_post_show;
							}
							$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"unfollow"));
						}else{
							
							$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , array("id" => $row->id,"category"=>"unfollow"));
						}
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}

//                    print_r($arr_update);
//					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
                    
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

//    function getfollowers()
//    {
//        $arry[] = '';
//        //ini_set('max_execution_time', 30000000);
////        $limit_item = divisible_cronjob($category='follow',segment(3));
//        $result = $this->db
//            ->select('*')
//            ->from(INSTAGRAM_ACCOUNTS)
////            ->where('username', 'socialdefine')
//            ->where('status', 1)
//            ->where('checkpoint', 0)
////            ->where('follow_time <= ', NOW)
//            ->order_by('username', 'RANDOM')
//            ->limit(5)
//            ->get()->result();
////print_r($result); 
//        if (!empty($result)) {
//            foreach ($result as $row) {
//
//                $user = $this->model->get("*", USER_MANAGEMENT, "id = '" . $row->uid . "'");
//
////                $now = strtotime(date("Y-m-d", strtotime(NOW)));
////                $expiration_date = strtotime($row->expiration_date);
//                $now = date("Y-m-d");
//                echo $expiration_date = $row->expiration_date;
//
//                $proxy_item = $this->model->get("*", PROXY, "id = '" . $row->proxy . "'");
//                if (!empty($proxy_item)) {
//                    $proxy = $proxy_item->proxy;
//                } else {
//                    $proxy = "";
//                }
//
//                $ignew = Instagram_Login($row->username, $row->password, $proxy);
//
//                $users = $ignew->people->getSelfInfo();
//
////                print_r($users);
//                echo '<br><br>';
//                $follower = $users->getUser()->getFollowerCount();
//                $following = $users->getUser()->getFollowingCount();
//                $getfeed = $ignew->getUserFeed();
//
////                echo $follower.'--'.$following;
//echo '<pre>';
//                print_r($getfeed);
//                die();
//
//                if (!empty($user)) {
//                    // check expiration datee
////                    if($user->expiration_date > date('Y-m-d')){
//                    if($now > $expiration_date){
//                        echo "Instagram Account Expired";
////                        echo "User  Expired";
//                        continue;
//                    }else{
//
//                        //Add Proxy
//                        $proxy_item = $this->model->get("*", PROXY, "id = '" . $row->proxy . "'");
//                        if (!empty($proxy_item)) {
//                            $proxy = $proxy_item->proxy;
//                        } else {
//                            $proxy = "";
//                        }
//
//                        $ignew = Instagram_Login($row->username, $row->password, $proxy);
//
//                        $users = $ignew->people->getSelfInfo();
//
//
//                        $follower = $users->getUser()->getFollowerCount();
//                        $following = $users->getUser()->getFollowingCount();
//
//                        echo $follower.'--'.$following;
//                        die();
//
////                        if(!empty($follower) && !empty($following)){
//
//                        $arr_update = array(
//                            'follower' => $follower,
//                            'following' => $following
//                        );
//
////                            echo $follower.'--'.$following;
////                            $this->db->where("id",$row->id);
//                        $this->db->update(INSTAGRAM_ACCOUNTS,$arr_update,array('id' => $row->id));
////                        }
//                        echo "Successfully";
//
//                    }
//
//
//                }else {
//
//                    echo "User not Found";
//                    continue;
//
//                }
//
//
////                    }
//
//
//            }
//
//        }else{
//            echo "Account not Found";
//        }
//
//
//    }


    function getfollowers()
    {
        $arry[] = '';
//        //ini_set('max_execution_time', 300);
//        $limit_item = divisible_cronjob($category='follow',segment(3));
        $result = $this->db
            ->select('*')
            ->from(INSTAGRAM_ACCOUNTS)
            ->where('status', 1)
//            ->where('category', 'follow')
//            ->where('time_post <= ', NOW)
//            ->limit($limit_item['limit_per_page'],$limit_item['start_index'])
            ->get()->result();


//        $data1 = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, "*", '', false, false);
//        $data = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS,"*", ['where' => ['id' => session("uid")]], false, false);
//        $data1 = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS,"*", ['where' => ['uid' => $sesid]], false, false);


        if (!empty($result)) {
            foreach ($result as $row) {
//            foreach ($result as $key => $row) {
//        $sesid = session("uid");
//        $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '" . $row->id . "' AND uid = '" . $sesid . "' AND checkpoint = '0'");
//                if (!empty($account)) {
                $user = $this->model->get("*", USER_MANAGEMENT, "id = '" . $row->uid . "'");
                if (!empty($user)) {
                    // check expiration date
                    $expiration_date = $user->expiration_date;
                    $admin = $user->admin;
                    $password = $row->password;
                    $username = $row->username;
//                        $fid = $row->fid;
                    $timezone = $user->timezone;

                    //Add Proxy
                    $proxy_item = $this->model->get("*", PROXY, "id = '" . $row->proxy . "'");
                    if (!empty($proxy_item)) {
                        $proxy = $proxy_item->proxy;
                    } else {
                        $proxy = "";
                    }

                    $arr_update = array();

                    $followersdata = $this->followers($row->id);

                    $i = Instagram_Loader($username, $password, $proxy);
                    $user_followers = Instagram_Get_Feed($i, "user_followers", $username);
                    print_r($user_followers);

                    $arr_update = array(
                        'follower' => $followersdata
                    );

                } else {

                    $arr_update = array();

//                        $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '" . $row->uid . "'");
//                        $this->db->delete(INSTAGRAM_ACTIVITY, "uid = '" . $row->uid . "'");
//                        $this->db->delete(INSTAGRAM_HISTORY, "uid = '" . $row->uid . "'");
//                        $this->db->delete(SAVE, "uid = '" . $row->uid . "'");
//                        $this->db->delete(CATEGORIES, "uid = '" . $row->uid . "'");
                }

                $this->db->update(INSTAGRAM_ACCOUNTS, $arr_update, "id = {$row->id}");
//                    }


            }

        }

    }

	public function followback(){
		//ini_set('max_execution_time', 30000000);
        $limit_item = divisible_cronjob($category='followback',segment(3));
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'followback')
	    ->where('time_post <= ', NOW)
	    //->limit($limit_item['limit_per_page'],$limit_item['start_index'])
	    ->get()->result();
		if(!empty($result)){
			foreach ($result as $key => $row) { 
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
							$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}
						$row->description = unset_match_values($row->description,$row->blacklists);
						$response = (object)Instagram_Post((object)$row);
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							// add followed user and increase counter
							$data_tmp = json_decode($response->data);
							if(is_object($data_tmp)){
								$option = array(
									"type"			            => $row->type,
									"key"			            => $data_tmp->pk."@".$data_tmp->username,
									"account_id"	            => $row->account_id,
								);
								update_followed_iguser($option);
							}
						}
						$arr_update = array(
							'status' => ($response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;
							$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}

					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

	public function repost(){
		//ini_set('max_execution_time', 30000000);
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'repost')
	    ->where('time_post <= ', NOW)
	    ->get()->result();
		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
							$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}

						$row->description = unset_match_values($row->description,$row->blacklists);

						$response = (object)Instagram_Post((object)$row);
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							//increase counter
							$n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
							update_setting($row->type,$n,$row->account_id,"logs_counter");

						}
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;
							$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}

					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

	public function deletemedia(){
		//ini_set('max_execution_time', 30000000);

	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status', 5)
	    ->where('category', 'deletemedia')
	    ->where('time_post <= ', NOW)
	    ->get()->result();
		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
					if(!empty($user)){
						// check expiration date
						$expiration_date = $user->expiration_date;
						$admin           = $user->admin;
						if(!check_expiration($expiration_date)&&$admin !=1){
							$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
							continue;
						}
						$row->password = $account->password;
						$row->username = $account->username;
						$row->fid = $account->fid;
						$row->timezone = $user->timezone;

						//Add Proxy
						$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
						if(!empty($proxy_item)){
							$row->proxy = $proxy_item->proxy;
						}else{
							$row->proxy = "";
						}

						$response = (object)Instagram_Post((object)$row);
						$arr_update = array();
						if(isset($response->st) && $response->st == "success"){
							$this->db->insert(
								INSTAGRAM_HISTORY,
								array(
									"uid" => $row->uid,
									"account_id" => $row->account_id,
									"type" => $row->type,
									"pk" => $response->code,
									"data" => $response->data,
									"created" => NOW
								)
							);
							//increase counter
							$n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
							update_setting($row->type,$n,$row->account_id,"logs_counter");
						}
						$arr_update = array(
							'status' => ($response->st == "success")?5:4,
							'result' => (isset($response->code) && $response->code != "")?$response->code:"",
							'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
						);
						if($repeat == 1 && $time_post_day <= $repeat_end){
							$arr_update['status']    = 5;
							$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}
					}else{
						$this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
						$this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
						$this->db->delete(SAVE, "uid = '".$row->uid."'");
						$this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
					}

					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
                }
			}
		}
		echo l('Successfully');
	}

	public function message(){
		$spintax = new Spintax();
		//ini_set('max_execution_time', 30000000);
	 	$result = $this->db
	    ->select('*')
	    ->from(INSTAGRAM_SCHEDULES)
	    ->where('status != ', 2)
	    ->where('status != ', 3)
	    ->where('status != ', 4)
	    ->where('category', 'message')
	    ->where('time_post <= ', NOW)
	    ->get()->result();

		if(!empty($result)){
			foreach ($result as $key => $row) {
				$delete       = $row->delete_post;
				$repeat       = $row->repeat_post;
				$repeat_time  = $row->repeat_time;
				$repeat_end   = $row->repeat_end;
				$time_post    = $row->time_post;
				$deplay       = $row->deplay;

				$time_post          = strtotime(NOW) + $repeat_time;
				$time_post_only_day = date("Y-m-d", $time_post);
				$time_post_day      = strtotime($time_post_only_day);
				$repeat_end         = strtotime($repeat_end);

				$row->url         = $spintax->process($row->url);
				$row->message     = $spintax->process($row->message);
				$row->title       = $spintax->process($row->title);
				$row->description = $spintax->process($row->description);
				$row->image       = $spintax->process($row->image);
				$row->caption     = $spintax->process($row->caption);

				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "username = '".$row->account_name."' AND uid = '".$row->uid."' AND checkpoint = '0'");
				if(!empty($account)){
					$row->password = $account->password;
					$row->username = $account->username;
					$row->fid = $account->fid;

					//Add Proxy
					$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
					if(!empty($proxy_item)){
						$row->proxy = $proxy_item->proxy;
					}else{
						$row->proxy = "";
					}
					$response = (object)Instagram_Post((object)$row);
					$arr_update = array(
						'status' => ($response->st == "success")?3:4,
						'result' => (isset($response->id) && $response->id != "")?$response->id:"",
						'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
					);

					if($repeat == 1 && $time_post_day <= $repeat_end){
						$arr_update['status']    = 5;
						$arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

						$user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
						if(!empty($user)){
							$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
							$date->setTimezone(new DateTimeZone($user->timezone));
							$time_post_show = $date->format('Y-m-d H:i:s');
							$arr_update['time_post_show'] = $time_post_show;
						}else{
							$arr_update['time_post_show'] = date("Y-m-d H:i:s", $time_post);
						}
					}

					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
				}else{
					$arr_update = array(
						'status' => 4,
						'message_error' => l('Instagram account not exist')
					);
					$this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
                    $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id" => $row->account_id));
				}
			}
		}
		echo l('Successfully');
	}	

	public function delete_history(){
		$setting = $this->model->get('clear_log_days',SETTINGS,'`id`=1');
		$setting->clear_log_days = 1;
		if(!empty($setting)&&$setting->clear_log_days!=0){ 
			//$day     = $setting->clear_log_days*24*60*60;
			$day     = 24*60*60; 
			$day_tmp = strtotime(NOW) - $day;
			//$this->db->delete(INSTAGRAM_HISTORY,"created<='".date("Y-m-d H:i:s", $day_tmp)."' ");
			$this->db->delete(INSTAGRAM_HISTORY," created<='".date("Y-m-d H:i:s", $day_tmp)."'");
			echo $this->db->last_query();
			
		}
		echo l('Successfully');
	}

    public function delete_session(){
        $setting = $this->model->get('clear_log_days',SETTINGS,'`id`=1');

        if(!empty($setting)&&$setting->clear_log_days!=0){
            $day     = 20*60;
            //$day     = $setting->clear_log_days*24*60*60;
            $day_tmp = strtotime(NOW) - $day;
            $this->db->delete('sessions',"timestamp < '".$day_tmp."' ORDER BY timestamp ASC LIMIT 1000");
        }
        echo l('Successfully');
    }
	
	//Cron to check inactive users and un-subscribed users with proxies, so that we can remove assigned proxies
    public function inactive_users()
    {
        //Set max execution time
        //ini_set('max_execution_time', 30000000);

        //Load model
        $this->load->model('common_model');

        //Fetch users
        $this->db->select ('u.id')
            ->from  (USER_MANAGEMENT . ' as u')
            ->group_start()
                ->where	   ('u.last_active_time <', date('Y-m-d H:i:s', strtotime('-30 days')))
                ->or_where  ('u.expiration_date <', date('Y-m-d H:i:s', time()))
            ->group_end();
         //   ->where ('EXISTS (SELECT id FROM '. PROXY .' AS p WHERE p.uid = u.id)');
        $query = $this->db->get();
        $users = $query->result_array();
//		print_r($users);die;
        //If user found
        $usersToUpdate = [];
        if (count ($users) > 0) {

            foreach ($users as $row) {
				$ig_condition = ['where' => ['uid' => $row['id']]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){ 
						$usersToUpdate[] = $ig['id'];
					}
				}
            }

            //Remove assignment from proxy
            $this->common_model->remove_assigned_query($usersToUpdate);
        }

        //Insert log
        /*$this->common_model->insert_single(CRON_LOGS, [
            'cron_type'     => 1,
            'records_found' => count($usersToUpdate),
            'records_list'  => json_encode($usersToUpdate),
            'created'       => date('Y-m-d H:i:s', time()), 
        ]);*/

        echo l('Successfully');
    }

	//Cron to check proxies' working status. If proxy failed then assign a new proxy to user.
    public function check_proxies()
    {
        //Set max execution time
        //ini_set('max_execution_time', 30000000);

        //Load model
        $this->load->model('common_model');

        //Check proxy
        $failedProxies = modules::run("proxy/check_proxies");
        //var_dump($failedProxies);die;
        //Insert log
        $this->common_model->insert_single(CRON_LOGS, [
            'cron_type'     => 2,
            'records_found' => !empty ($failedProxies) ? count($failedProxies) : 0,
            'records_list'  => json_encode($failedProxies),
            'created'       => date('Y-m-d H:i:s', time()),
        ]);

        echo l('Successfully');
    }


    public function schedule()
    {
        //ini_set('max_execution_time', 30000000);
        // Get scheduled posts
//        $Posts = Controller::model("Posts");
//        $Posts->whereIn(TABLE_PREFIX.TABLE_POSTS.".status", ["scheduled"])
//            ->where(TABLE_PREFIX.TABLE_POSTS.".is_scheduled", "=", "1")
//            ->where(TABLE_PREFIX.TABLE_POSTS.".schedule_date", "<=", date("Y-m-d H:i").":59")
//            ->setPageSize(5) // Limit posts to prevent server overload
//            ->setPage(1)
//            ->fetchData();

        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where("status", 'scheduled');
        $this->db->where("is_scheduled", 1);
//        $this->db->where("schedule_date <=", date("Y-m-d H:i").":59");
        $this->db->where("schedule_date <=", NOW);
        $this->db->limit(5);
        $posresp = $this->db->get();

        $Posts = $posresp->num_rows()>0?$posresp->result_array():"";

//         print_r($Posts);
//          die();
        if ($Posts == '') {
            // There is not any scheduled posts
            return true;
        }


        $published = 0;
        $failed = 0;
        foreach ($Posts as $Post) {
            // Update post status
//            $Post->set("status", "publishing")->save();

            $this->db->where('id',$Post["id"]);
            $this->db->update('posts',array("status"=> "publishing"));
            $Post['status'] = "publishing";
            try {
                $value = publish_schedule($Post);
                echo $value;
                $published++;
            } catch (Exception $e) {
                echo $e->getMessage();
                $failed++;
            }
        }

        return true;
    }

    public function newfollow(){
        //ini_set('max_execution_time', 30000000);
//        $limit_item = divisible_cronjob($category='follow',segment(3));
        echo "<pre>";
//        print_r($limit_item); 
        $result = $this->db
            ->select('*')
            ->from(INSTAGRAM_SCHEDULES)
            ->where('account_id',282)
//            ->where('status', 5)
            ->where('category', 'follow')
//            ->where('time_post <= ', NOW)
//            ->limit($limit_item['limit_per_page'],$limit_item['start_index'])
//            ->limit(5)
            ->get()->result();

        print_r($result);

        if(!empty($result)){
            foreach ($result as $key => $row) {
                echo 1;
                $delete       = $row->delete_post;
                $repeat       = $row->repeat_post;
                $repeat_time  = $row->repeat_time;
                $repeat_end   = $row->repeat_end;
                $time_post    = $row->time_post;
                $deplay       = $row->deplay;
echo 2;
                $time_post          = strtotime(NOW) + $repeat_time;
                $time_post_only_day = date("Y-m-d", $time_post);
                $time_post_day      = strtotime($time_post_only_day);
                $repeat_end         = strtotime($repeat_end);
                echo 3;
                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
                echo 4;
                print_r($account);
                if(!empty($account)){
                    echo 5;
                    $user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
                    echo 6;
                    print_r($user);
                    if(!empty($user)){
                        echo 7;
                        // check expiration date
                        $expiration_date = $user->expiration_date;
                        $admin           = $user->admin;
                        echo 8;
                        if(!check_expiration($expiration_date)&&$admin !=1){
                            echo 9;
                            $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
                            continue;
                        }

                        echo 10;
                        $row->password = $account->password;
                        $row->username = $account->username;
                        $row->fid = $account->fid;
                        $row->timezone = $user->timezone;
                        //Add Proxy
                        $proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
                        if(!empty($proxy_item)){
                            $row->proxy = $proxy_item->proxy;
                        }else{
                            $row->proxy = "";
                        }

                        $row->description = unset_match_values($row->description,$row->blacklists);

                        echo $row->username.'--'.$row->password;

                        $resp = Instagram_Loader($row->username, $row->password,$row->proxy);
                        print_r($resp);
                        die();

                        $response = (object)Instagram_Post((object)$row);
//                        echo "<pre>";
print_r($response);

                        //echo '<pre>';print_r($account_data);
                        //die;
                        $arr_update = array();
                        if(isset($response->st) && $response->st == "success"){
                            $activity_account = $this->model->get("*", INSTAGRAM_ACTIVITY, " uid = '".$row->uid."'");
                            $account_data = json_decode($activity_account->data);
                            $messages = json_decode($account_data->messages,true);

                            $follow_response = json_decode($response->data);
                            //print_r($account_data->messages);

                            if(is_array($messages)){
                                $index = rand(0,(count($messages)-1));
                                $message_text = $messages[$index];
                                $row->message = $message_text;
                                $row->category = 'send_dm_to_followers';
                                $row->group_id = $follow_response->pk;
                                Instagram_Post((object)$row);
                                //var_dump($response);
                            }
                            $this->db->insert(
                                INSTAGRAM_HISTORY,
                                array(
                                    "uid" => $row->uid,
                                    "account_id" => $row->account_id,
                                    "type" => $row->type,
                                    "pk" => $response->code,
                                    "data" => $response->data,
                                    "created" => NOW
                                )
                            );
                            // add followed user and increase counter
                            $data_tmp = json_decode($response->data);
                            if(is_object($data_tmp)){
                                $option = array(
                                    "type"			            => $row->type,
                                    "key"			            => $data_tmp->pk."@".$data_tmp->username,
                                    "account_id"	            => $row->account_id,
                                );
                                update_followed_iguser($option);
                            }
                        }
                        $arr_update = array(
                            'status' => ($response->st == "success")?5:4,
                            'result' => (isset($response->code) && $response->code != "")?$response->code:"",
                            'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
                        );
                        if($repeat == 1 && $time_post_day <= $repeat_end){
                            $arr_update['status']    = 5;
                            $arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

                            $date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
                            $date->setTimezone(new DateTimeZone($user->timezone));
                            $time_post_show = $date->format('Y-m-d H:i:s');
                            $arr_update['time_post_show'] = $time_post_show;
                        }
                    }else{
                        $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
                        $this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
                        $this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
                        $this->db->delete(SAVE, "uid = '".$row->uid."'");
                        $this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
                    }

                    $this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
                }else{
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_id" => $row->account_id));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_id" => $row->account_id));
                }
            }
        }
        echo l('Successfully');
    }

    public function newunfollow(){
        //ini_set('max_execution_time', 30000000);
		$limit_item = divisible_cronjob($category='unfollow',segment(3));
        //echo "<pre>";
		//print_r($limit_item);
        $result = $this->db
            ->select('*')
            ->from(INSTAGRAM_SCHEDULES)
            ->where('id', 1871)
//            ->where('status', 5)
//            ->where('category', 'unfollow')
//            ->where('time_post <= ', NOW)
            ->get()->result();

        print_r($result);
        if(!empty($result)){
            foreach ($result as $key => $row) {
                $delete       = $row->delete_post;
                $repeat       = $row->repeat_post;
                $repeat_time  = $row->repeat_time;
                $repeat_end   = $row->repeat_end;
                $time_post    = $row->time_post;
                $deplay       = $row->deplay;

                $time_post          = strtotime(NOW) + $repeat_time;
                $time_post_only_day = date("Y-m-d", $time_post);
                $time_post_day      = strtotime($time_post_only_day);
                $repeat_end         = strtotime($repeat_end);

                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$row->account_id."' AND uid = '".$row->uid."' AND checkpoint = '0'");
                if(!empty($account)){
                    $user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row->uid."'");
                    if(!empty($user)){
                        // check expiration date
                        $expiration_date = $user->expiration_date;
                        $admin           = $user->admin;
                        if(!check_expiration($expiration_date)&&$admin !=1){
                            $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
                            continue;
                        }
                        $row->password = $account->password;
                        $row->username = $account->username;
                        $row->fid = $account->fid;
                        $row->timezone = $user->timezone;
//                        $row->category = "unfollow2";

                        //Add Proxy
                        $proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
                        if(!empty($proxy_item)){
                            $row->proxy = $proxy_item->proxy;
                        }else{
                            $row->proxy = "";
                        }
                        $row->description = unset_match_values($row->description,$row->blacklists);

                        $response = (object)Instagram_Post((object)$row);
                        $arr_update = array();
                        if(isset($response->st) && $response->st == "success"){
                            $check_item = $this->model->get('*',INSTAGRAM_HISTORY," (`type` = 'follow' OR `type` = 'followback' OR `type` = 'like_follow')  AND   `pk` = '".$response->code."'");
                            if(!empty($check_item)){
                                $this->db->update(
                                    INSTAGRAM_HISTORY,
                                    array(
                                        "type" 		=> $row->type,
                                        "created" 	=> NOW,
                                    ),
                                    " (`type` = 'follow' OR `type` = 'like_follow')  AND   `pk` = '".$response->code."'"
                                );
                            }else{

                                $this->db->insert(
                                    INSTAGRAM_HISTORY,
                                    array(
                                        "uid" => $row->uid,
                                        "account_id" => $row->account_id,
                                        "type" => $row->type,
                                        "pk" => $response->code,
                                        "data" => $response->data,
                                        "created" => NOW
                                    )
                                );
                            }

                            //increase counter
                            $n = get_setting($row->type,0,$row->account_id,"logs_counter") + 1;
                            update_setting($row->type,$n,$row->account_id,"logs_counter");

                        }

                        $arr_update = array(
                            'status' => ($response->st == "success")?5:4,
                            'result' => (isset($response->code) && $response->code != "")?$response->code:"",
                            'message_error' => (isset($response->txt) && $response->txt != "")?$response->txt:""
                        );
                        if($repeat == 1 && $time_post_day <= $repeat_end){
                            $arr_update['status']    = 5;
                            $arr_update['time_post'] = date("Y-m-d H:i:s", $time_post);

                            $date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_SYSTEM));
                            $date->setTimezone(new DateTimeZone($user->timezone));
                            $time_post_show = $date->format('Y-m-d H:i:s');
                            $arr_update['time_post_show'] = $time_post_show;
                        }
                    }else{
                        $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
                        $this->db->delete(INSTAGRAM_ACTIVITY, "uid = '".$row->uid."'");
                        $this->db->delete(INSTAGRAM_HISTORY, "uid = '".$row->uid."'");
                        $this->db->delete(SAVE, "uid = '".$row->uid."'");
                        $this->db->delete(CATEGORIES, "uid = '".$row->uid."'");
                    }

                    $this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "id = {$row->id}");
                }
            }
        }
        echo l('Successfully');
    }

    public function update_checkpoint(){

        //ini_set('max_execution_time', 30000000);

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers','errorlog',$homepath);

        ini_set('error_log', $new_home.'/account.log'); // Logging file

//        ini_set('log_errors_max_len', 1024);

        $action = 'account';

        $this->db->select('*');
        $this->db->from(INSTAGRAM_ACCOUNTS);
        $this->db->where('checkpoint != ',0);
        $this->db->where('auto_update',0);
//        $this->db->order_by('rand()');
        $this->db->order_by('id','RANDOM');
        $this->db->limit(5);
        $aresp = $this->db->get();

        $account = $aresp->num_rows()>0?$aresp->result_array():"";

        if($account != ''){

            foreach($account as $row) {


                $this->db->select('*');
                $this->db->from(USER_MANAGEMENT);
                $this->db->where('id', $row['uid']);
//                $this->db->where('expiration_date >= ', NOW);
                $uresp = $this->db->get();

                $user = $uresp->num_rows() > 0 ? $uresp->result_array() : "";

                if ($user == '') {

                    $response = array(
                        'st' 	=> 'error',
                        "account" => $row['username'],
                        "user" => '',
                        'txt' 	=> l('User Not Found')
                    );

                    $this->db->update(INSTAGRAM_ACCOUNTS, array('auto_update'=>1), array("id" => $row["id"]));

                    echo json_encode($response);

                    create_log($row['username'],$action ,$response['txt']);

                    continue;

                }

                $expiration_date = $user[0]['expiration_date'];
                $admin           = $user[0]['admin'];
                if(!check_expiration($expiration_date)&&$admin !=1){

                    $response = array(
                        'st' 	=> 'error',
                        "account" => $row['username'],
                        "user" => $user[0]['email'],
                        'txt' 	=> l('User Expired')
                    );

                    $this->db->update(INSTAGRAM_ACCOUNTS, array('auto_update'=>1), array("id" => $row["id"]));

                    echo json_encode($response);

                    create_log($row['username'],$action ,$response['txt']);

                    continue;
                }

                //Add Proxy
                $proxy_item = $this->model->get("*", PROXY, "id = '" . $row['proxy'] . "'");
                if (!empty($proxy_item)) {
                    $proxy = $proxy_item->proxy;
                } else {
                    $proxy = "";
                }

                $IG_Oauth = Instagram_Login($row['username'], $row['password'], $proxy, 'update');
                if (is_array($IG_Oauth) && isset($IG_Oauth['st'])) {
//                    echo json_encode();

                    $response = $IG_Oauth;

                    $response = array_merge($response,array("account" => $row['username'],"user" => $user[0]['email']));

                    $this->db->update(INSTAGRAM_ACCOUNTS, array('auto_update'=>1), array("id" => $row["id"]));

                    echo json_encode($response);

                    create_log($row['username'],$action ,$response['txt']);

                    continue;

                } else {
                    //IG Info
                    $IG_Info = $IG_Oauth->account->getCurrentUser();
                    if ($IG_Info->getStatus() != "ok") {

                        $response = array(
                            "st" => "error",
                            "account" => $row['username'],
                            "user" => $user[0]['email'],
                            "txt" => l('Connect failure')
                        );

                        $this->db->update(INSTAGRAM_ACCOUNTS, array('auto_update'=>1), array("id" => $row["id"]));

                        echo json_encode($response);

                        create_log($row['username'],$action ,$response['txt']);

                        continue;
                    }                                                //print_r($IG_Info->getUser());die;
                    $data = array(
                        "checkpoint" => 0,
                        "avatar" => $IG_Info->getUser()->getProfilePicUrl()
                    );

                    $this->db->update(INSTAGRAM_ACCOUNTS, $data, array("id" => $row["id"]));
                    $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 5), array("account_id" => $row["id"]));
                    $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 5), array("account_id" => $row["id"]));
                    echo json_encode(array(
                        "st" => "success",
                        "account" => $row['username'],
                        "user" => $user[0]['email'],
                        "txt" => l('Update successfully')
                    ));
                    continue;

                }

            }


        }else{

            echo json_encode(array(
                'st' 	=> 'error',
                "account" => '',
                "user" => '',
                'txt' 	=> l('Account Not Found')
            ));
        }
    }

    public function send_alert_mail(){

        //ini_set('max_execution_time', 30000000);

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers','errorlog',$homepath);

        ini_set('error_log', $new_home.'/mail.log'); // Logging file

//        $this->db->select('*');
//        $this->db->from(INSTAGRAM_ACCOUNTS);
//        $this->db->where('checkpoint',1);
//        $this->db->where('auto_update',1);
//        $this->db->where('last_update_date = ',null);
////        $this->db->or_where('DATE(last_update_date) < ','DATE('.NOW.')');
//        $this->db->or_where('last_update_date < ',NOW);
////        $this->db->order_by('rand()');
//        $this->db->order_by('id','RANDOM');
//        $this->db->limit(5);
//        $aresp = $this->db->get();

        $aresp = $this->db->query('SELECT * FROM `'.INSTAGRAM_ACCOUNTS.'` WHERE `checkpoint` = 1 AND `auto_update` = 1 AND ( `last_update_date` IS NULL OR DATE(last_update_date) < DATE("'.date('Y-m-d H:i:s').'") ) ORDER BY RAND() LIMIT 5');

        $account = $aresp->num_rows()>0?$aresp->result_array():"";

//        print_r($account);

        if($account != ''){

            $settings = $this->db->select("*")->get(SETTINGS)->row();
            $subject = l('Activity Stopped').' - '.$settings->website_title;


            foreach($account as $row) {

                $this->db->select('*');
                $this->db->from('emailalert');
                $this->db->where('uid',$row['uid']);
                $this->db->where('account_id',$row['id']);
                $wresp = $this->db->get();
                $emailalert = $wresp->num_rows()>0?$wresp->result_array():"";

                if($emailalert != ''){

//                    $headers = "MIME-Version: 1.0" . "\r\n";
//                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//                    $headers .= 'From: <'.$settings->mail_from_email.'>' . "\r\n";
//                    $headers .= 'Cc: '.$settings->mail_from_email. "\r\n";
//                    echo $emailalert[0]['email']."<br>";
//                    echo $subject."<br>";
//                    echo $message."<br>";
//                    echo $headers."<br>";


                    $message = '
					<html>
					<head>
					<title>'.l('Activity Stopped').' - '.$settings->website_title.'</title>
					</head>
					<body>
					<p>'.l('Hey,').'</p>
					<p>'.l('Just a quick heads up that your instagram account "'.$row['username'].'" activity has stopped and needs just a minute of your attention.').'</p>
					<p>'.l('Please => ').'<a target="_blank" href="https://app.igplan.com">'.l('go HERE to get your account growing again.').'</a></p>
					<p>'.l('Thanks!').'</p>
					<p>'.l('Your IGplan team').'</p>
					</body>
					</html>
					';



                    require APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
//				$mail->SMTPDebug = 2;                               // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = $settings->mail_smtp_host;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $settings->mail_smtp_user;                 // SMTP username
                    $mail->Password = $settings->mail_smtp_pass;                           // SMTP password
                    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = (int)$settings->mail_smtp_port;                                    // TCP port to connect to

                    $mail->setFrom($settings->mail_from_email, $settings->mail_from_name);
                    $mail->addAddress($emailalert[0]['email']);     // Add a recipient
                    $mail->addReplyTo($settings->mail_from_email, 'Admin');
                    $mail->addCC($settings->mail_from_email);
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                        echo "Mail Not Send";
                        create_log($row['username'],'mail' ,'Mail Not Send');
                    } else {
                        $this->db->where('uid',$row['uid']);
                        $this->db->where('id',$row['id']);
                        $updata = $this->db->update(INSTAGRAM_ACCOUNTS, array( "last_update_date" => NOW ));

                        if($updata){
                            echo "sent";
                        }else{

                            echo "Update Error";
                            create_log($row['username'],'mail' ,'Update Error');
                        }
                    }

//                    if(mail($emailalert[0]['email'],$subject,$message,$headers)){
//
//                        $this->db->where('uid',$row['uid']);
//                        $this->db->where('id',$row['id']);
//                        $updata = $this->db->update(INSTAGRAM_ACCOUNTS, array( "last_update_date" => NOW ));
//
//                        if($updata){
//                            echo "sent";
//                        }else{
//
//                            echo "Update Error";
//                            create_log($row['username'],'mail' ,'Update Error');
//                        }
//
//
//                    }else{
//                        echo "Mail Not Send";
//                        create_log($row['username'],'mail' ,'Mail Not Send');
//                    }

                }else{
                    echo "Email not found";
                    create_log($row['username'],'mail' ,'Email not found');
                }

            }
        }else{
            echo "Account not found";
        }

    }




    public function stopactivity(){

        //ini_set('max_execution_time', 30000000);

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers','errorlog',$homepath);

        ini_set('error_log', $new_home.'/activity.log'); // Logging file


        $aresp = $this->db->get('SELECT * FROM `'.INSTAGRAM_ACCOUNTS.'` WHERE `checkpoint` != 1 AND `auto_update` != 1 ORDER BY RAND() LIMIT 5');

        $account = $aresp->num_rows()>0?$aresp->result_array():"";

//        print_r($account);

        if($account != ''){

            foreach($account as $row) {

                $log_counter = (object)json_decode($row['logs_counter']);

                $follow_count = $log_counter->follow;

                if($follow_count >= 7500){

                    $updata = $this->db->update(INSTAGRAM_SCHEDULES, array( "status" => 3 ));

                }

            }
        }else{
            echo "Account not found";
        }

    }

    public function emailsend($email,$message,$settings){

        $subject = l('Account Expired').' - '.$settings->website_title;

        require APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
//				$mail->SMTPDebug = 2;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $settings->mail_smtp_host;  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $settings->mail_smtp_user;                 // SMTP username
        $mail->Password = $settings->mail_smtp_pass;                           // SMTP password
        //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = (int)$settings->mail_smtp_port;                                    // TCP port to connect to

        $mail->setFrom($settings->mail_from_email, $settings->mail_from_name);
        $mail->addAddress($email);     // Add a recipient
        $mail->addReplyTo($settings->mail_from_email, 'Admin');
        $mail->addCC($settings->mail_from_email);
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo "Mail Not Send<br>";
//            create_log($row['username'],'mail' ,'Mail Not Send');
        } else {
//            $this->db->where('uid',$row['uid']);
//            $this->db->where('id',$row['id']);
//            $updata = $this->db->update(INSTAGRAM_ACCOUNTS, array( "last_update_date" => NOW ));
            echo "Mail sent<br>";
//            if($updata){
//                echo "sent";
//            }else{
//
//                echo "Update Error";
//                create_log($row['username'],'mail' ,'Update Error');
//            }
        }

    }


    public function dm_follower_user()
    {


        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers', 'errorlog', $homepath);

        ini_set('error_log', $new_home . '/follow.log'); // Logging file

    //        ini_set('log_errors_max_len', 1024);

        //ini_set('max_execution_time', 600000);

        $spintax = new Spintax();

//        echo "<pre>";
  
        $result = $this->db
            ->select('*')
            ->from(INSTAGRAM_ACCOUNTS)
            ->where('checkpoint', 0)
            ->where('on_job', 0)
//            ->where('id', 138)
            ->order_by('rand()')
            ->limit(2)
            ->get()->result();

//        echo count($result);
//        print_r($result);
//        die();
        if(!empty($result) and count($result)>0){
            $followerList = array();
            $newPk = '';
            foreach ($result as $row) {

                $up = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>1),array('id'=>$row->id));

                $activity = $this->db
                    ->select('*')
                    ->from(INSTAGRAM_ACTIVITY)
                    ->where('account_id', $row->id)
                    ->get()->row();

//                print_r($activity);

                if(empty($activity)){
					$upd = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>0),array('id'=>$row->id));
                    echo "Activity blank";
                    continue;
                }else{
                    if($activity->status != 5){
						$upd = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>0),array('id'=>$row->id));
                        echo "Activity is not active";
                        continue;
                    }
                }

                $check = $this->db
                    ->select('*')
                    ->from(FOLLOWERS_DM_MESSAGES)
                    ->where('i_user_id', $row->fid)
                    ->where('date', date('Y-m-d'))
                    ->order_by('id','DESC')
//                    ->limit(1)
                    ->get()->result_array();

//                print_r($check);

                if(!empty($check)){

                    if(count($check) >= 20){
                        echo "Max message limit reached";
						$upd = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>0),array('id'=>$row->id));
                        continue;
                    }
                    $last_dm_time = strtotime($check[0]['date']);
                    $date_now = strtotime(NOW);

                    $time_diff = $date_now - $last_dm_time;

//                    echo $time_diff;

                    if($time_diff < 1800){
                        echo "30 mins not completed";
						$upd = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>0),array('id'=>$row->id));
                        continue;
                    }

                }

                $proxy_item = $this->model->get("*", PROXY, "id = '" . $row->proxy . "'");
                if (!empty($proxy_item)) {
                    $row->proxy = $proxy_item->proxy;
                } else {
                    $row->proxy = "";
                }

//                echo $row->proxy;

                try{

                    $i = Instagram_Loader($row->username, $row->password, $row->proxy);

                    $user_followers = Instagram_Get_Feed($i, "get_user_followers", $row->fid);

                } catch (Exception $e){

                        echo "Login or get_user_followers error";

                        continue;

                }



//                print_r($user_followers);

//                foreach($user_followers as $raw){
//                    echo $raw->getPk()."<br>";
//                }

//                die();
                $followings = (array)json_decode($row->followed_username);

                if(empty($followings)){
                    echo "followed_username is blank";
                    $upd = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>0),array('id'=>$row->id));
                    continue;
                }
//                print_r($followings);

                foreach($followings as $key => $value){
                    $userdetail = explode('@',$key);

                    $userID = $userdetail[0];

                    $fol_date = date('Y-m-d',$value);

                    foreach($user_followers as $raw){

                        $dm_resp = $this->db
                            ->select('*')
                            ->from(FOLLOWERS_DM_MESSAGES)
                            ->where('i_user_id', $row->fid)
                            ->where('follower_id', $raw->getPk())
                            ->get()->result();

//                        print_r($dm_resp);

//                        echo $userID."---".$raw->getPk()."<br>";
                         if($userID == $raw->getPk()){

                             if(empty($dm_resp) and count($dm_resp)==0){

                                 if (strpos(NOW, $fol_date) !== false) {

                                     $user_data = array('pk'=>$raw->getPk(),"username"=>$raw->getUsername());

                                     array_push($followerList,$user_data);

                                 }

                             }

                         }

                    }

                }

//                print_r($followerList);
//                die();

                if(!empty($followerList)){

                    $index  = array_rand($followerList);
                    $feed   = $followerList[$index];

//                   print_r($feed);


                    $account_data = json_decode($activity->data);
                    $messages = json_decode($account_data->messages,true);

                    if(is_array($messages)){

                          $index = rand(0,(count($messages)-1));
                          $message_text = $messages[$index];

//                        print_r($message_text);



                          try {

                                $messageresp = $i->direct->sendText(['users' => [$feed['pk']]], $spintax->process($message_text));

//                                print_r($messageresp);

                                create_log($row->username,'message --'.$feed['pk'] ,$messageresp);

                                if($messageresp->getStatus() == "ok"){

                                    $res = $this->db->insert(
                                        FOLLOWERS_DM_MESSAGES,
                                        array(
                                            "i_user_id" => $row->fid,
                                            "follower_id" => $feed['pk'],
                                            "message" => $spintax->process($message_text),
                                            "type" => 'message',
                                            "sent" => 1,
                                            "date" => date("Y-m-d H:i:s")
                                        )
                                    );

                                    echo "Successfully";

                                }else{
                                    echo "Status is ".$messageresp->getStatus();
                                }

                          } catch (Exception $e){

//                                print_r($e->getMessage());

                                create_log($row->username,'message --'.$feed['pk'] ,$e->getMessage());

                              echo "Message is not sent";

                          }

                        $upd = $this->db->update(INSTAGRAM_ACCOUNTS,array('on_job'=>0),array('id'=>$row->id));

                    }else{
                        echo "Message is blank";
                    } 
  
                }else{
                    echo "No new following";
                }

//                print_r($followings);
//                die();


            }
        }

    }



    public function stop_start_activity()
    {


        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers', 'errorlog', $homepath);

        ini_set('error_log', $new_home . '/follow.log'); // Logging file

//        ini_set('log_errors_max_len', 1024);

        //ini_set('max_execution_time', 30000000);

        echo "<pre>";
//        $date = DATE_SUB(NOW(),'INTERVAL 1 HOUR');
//        echo $date;
//        die();
        $account = $this->db
            ->select('*')
            ->from(INSTAGRAM_ACCOUNTS)
            ->where('status', 1)
//            ->where('last_update_date' >= )
//            ->limit(5)
            ->get()->result();
        foreach($account as $row){

            $ch = curl_init();
            $url = "https://www.instagram.com/".$row->username."/";
//            $url = "https://www.instagram.com/pradeep_spidy/";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
            $output = curl_exec($ch);
            /* Check for 404 (file not found). */
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($httpCode == 404) {
//                /* Handle 404 here. */
//                echo"1265";
                continue;
            }
            curl_close($ch);

        $parsed = $this->get_string_between($output, '<meta content="', '" name="description"');
            $Post_count = $this->get_string_between($parsed, '<meta content="', 'Followers,');

            $arr_update=array('status'=>3);
            if($Post_count==0){
                $this->db->update(INSTAGRAM_SCHEDULES ,$arr_update , "account_name = '$row->username'");
                echo $row->username."<br/>";
            }else{
//                echo $row->username."else<br/>";
                continue;
            }




        }

    }

    public function proxy_autostart(){


        $proxy = $this->model->fetch("DISTINCT(proxy) AS newproxy", 'proxy_log','status = 0');
//        echo "<pre> hello";
//        print_r($proxy);


        if(!empty($proxy)){

            foreach($proxy as $row){
                $newproxy = $row->newproxy;

//                echo $newproxy;

                $proxyresp = $this->model->get("*", PROXY, "proxy = '".$newproxy."'");
//                print_r($proxyresp);

                if(!empty($proxyresp)){
                    if($proxyresp->is_working == 1){

                        $instaresp = $this->model->fetch("*", INSTAGRAM_ACCOUNTS, "proxy = '".$proxyresp->id."'");

//                        print_r($instaresp);
                        if(!empty($instaresp)){

                            foreach($instaresp as $row1){

//                                echo $row1->username;
                                $user = $this->model->get("*", USER_MANAGEMENT, "id = '".$row1->uid."'");

//                    echo $row->account_name;
                                if(!empty($user)){
                                    // check expiration date
                                    $expiration_date = $user->expiration_date;
                                    $admin           = $user->admin;
                                    if(!check_expiration($expiration_date)&&$admin !=1){
//                                        $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
                                        echo "Expired";
                                        continue;
                                    }
                                }

                                if($row1->checkpoint == 1){
                                    echo "Checkpoint";
                                    continue;
                                }

                                $this->db->update(INSTAGRAM_SCHEDULES, array("status" => 5), array("account_id" => $row1->id));
                                $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 5), array("account_id" => $row1->id));

                            }
                            $this->db->update('proxy_log', array("status" => 1), array("proxy" => $newproxy));

                            echo "Updated Successfully";

                        }else{
                            echo "No account Found";
                        }

                    }else{
                        echo "Proxy not working";
                    }
                }else{
                    echo "Proxy doesn't exist";
                }

            }

        }else{
            echo "All proxy are working";
        }

    }


    public function check_proxy_email(){
        $proxy = $this->model->fetch("*", PROXY,'is_working = 0 AND delay_time IS NOT NULL');

        if(!empty($proxy)){

            $details = '';

            foreach($proxy as $row){

                $delay_time = strtotime(date($row->delay_time));

//                echo $delay_time."<br>";
                $time_now = strtotime(NOW);

//                echo $time_now."<br>";

                $diff = (int)$time_now - (int)$delay_time;

//                echo $diff."<br>";

                if((int)$diff > 10800){

                    $proxy_log = $this->model->fetch("DISTINCT(username) AS username", 'proxy_log',"proxy = '".$row->proxy."' AND status = 0");
//                    $proxy_log = $this->model->fetch("DISTINCT(username) AS username", 'proxy_log',"proxy = '".$row->proxy."'");

//                    print_r($proxy_log);
                    if(!empty($proxy_log)){
                        foreach($proxy_log as $row1){

//                            echo $row->id."<br>".$row1->username;

                            $insta = $this->model->get("*", INSTAGRAM_ACCOUNTS,"proxy = '".$row->id."' AND username = '".$row1->username."'");
//                            print_r($insta);
                            if(!empty($insta)){

                                $user = $this->model->get("*", USER_MANAGEMENT, "id = '".$insta->uid."'");

//                    echo $row->account_name;
                                if(!empty($user)){
                                    // check expiration date
                                    $expiration_date = $user->expiration_date;
                                    $admin           = $user->admin;
                                    if(!check_expiration($expiration_date)&&$admin !=1){
//                                        $this->db->delete(INSTAGRAM_SCHEDULES, "uid = '".$row->uid."'");
                                        echo "Expired";
                                        continue;
                                    }
                                }

                                if($insta->checkpoint == 1){
                                    echo "Checkpoint";
                                    continue;
                                }

                                $this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $row1->username));

                                $details .= "<p>".l("@".$row1->username." activity has been off for 3 hours.")."<br>";

                            }else{
                                echo "No account found";
                            }

                        }
                    }else{
                        echo "Empty Proxy log";
                    }

                }

//                echo $details."hello";

                if($details != ''){

                    $settings = $this->db->select("*")->get(SETTINGS)->row();
                    $subject = l('Proxy Stopped Working').' - '.$settings->website_title;
                    $message = '
					<html>
					<head>
					<title>'.l('Proxy Stopped Working').' - '.$settings->website_title.'</title>
					</head>
					<body>
					<p>'.l('Hey admin,').'</p>
					'.$details.'
					<p>'.l('IGplan').'</p>
					</body>
					</html>
					';

//                    echo $message;

                    require APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
//				    $mail->SMTPDebug = 2;                               // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = $settings->mail_smtp_host;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $settings->mail_smtp_user;                 // SMTP username
                    $mail->Password = $settings->mail_smtp_pass;                           // SMTP password
                    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = (int)$settings->mail_smtp_port;                                    // TCP port to connect to

                    $mail->setFrom($settings->mail_from_email, $settings->mail_from_name);
                    $mail->addAddress($settings->mail_from_email);     // Add a recipient
                    $mail->addReplyTo($settings->mail_from_email, 'Admin');
                    $mail->addCC($settings->mail_from_email);
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = $subject;
                    $mail->Body    = $message;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                        echo "Mail Not Send";
                    } else {
                        echo "Mail Sent";

                    }

                }


            }
        }else{
            echo "No data Found";
        }
    }


//print_r($output);
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }


    public function check_followers(){

        $result = $this->db
            ->select('*')
            ->from(INSTAGRAM_ACCOUNTS)
//            ->where('checkpoint', 0)
            ->where('id', 152)
//            ->order_by('rand()')
//            ->limit(5)
            ->get()->row();

        $proxy_item = $this->model->get("*", PROXY, "id = '" . $result->proxy . "'");
        if (!empty($proxy_item)) {
            $result->proxy = $proxy_item->proxy;
        } else {
            $result->proxy = "";
        }

//                echo $row->proxy;
echo "<pre>";
        try{

            $i = Instagram_Loader($result->username, $result->password, $result->proxy);

            $homepath = dirname(__FILE__);

            $new_home = str_replace('app/modules/cron/controllers','',$homepath);

            $user_files_dir = $new_home."assets/uploads/20/fabayaye-5c1708f8c09e0.jpg";

            $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($user_files_dir);
            $resp = $i->timeline->uploadPhoto($photo->getFile());

//            $rankToken = \InstagramAPI\Signatures::generateUUID();
//            $followers = $i->people->getSelfFollowing($rankToken);
//
//            $data = $followers->getFullResponse();
//            $count = 0;
//            foreach($data->getUsers() as $row){
//                echo $count."<br>";
//                echo $row->getUsername()."<br>";
//
//                $count++;
//            }

//            $followers = $i->people->getSelfFollowers($rankToken,null,'QVFBMU0tcmludFJmY2FmQjZpdHNwb1VId0hSR01SZE9ZNXhxT254Z203VFhOcnpKdWRIMjF2dkZvaEg1eWJMc3VDVGdLWDQ1eF9DVjN5T2RJc3VKbFRaTw==');

//            $followers = $i->people->getSelfFollowers($rankToken);
//            $hashtag_feed = $i->hashtag->getFeed('artecontemporaneo',$rankToken);
//            $following = $i->people->getFollowing($result->fid,$rankToken);

//            $user_followers = Instagram_Get_Feed($i, "get_user_followers", $result->fid);

            print_r($resp);
            die();


        } catch (Exception $e){

            print_r($e);

//            continue;

        }
    }


    public function send_alert_mail_for_account_add(){

        ini_set('max_execution_time', 30000000);

        error_reporting(E_ALL); // Error engine - always ON!

        ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

        ini_set('log_errors', TRUE); // Error logging

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/cron/controllers','errorlog',$homepath);

        ini_set('error_log', $new_home.'/mail.log'); // Logging file

//        $this->db->select('*');
//        $this->db->from(INSTAGRAM_ACCOUNTS);
//        $this->db->where('checkpoint',1);
//        $this->db->where('auto_update',1);
//        $this->db->where('last_update_date = ',null);
////        $this->db->or_where('DATE(last_update_date) < ','DATE('.NOW.')');
//        $this->db->or_where('last_update_date < ',NOW);
////        $this->db->order_by('rand()');
//        $this->db->order_by('id','RANDOM');
//        $this->db->limit(5);
//        $aresp = $this->db->get();

//        $aresp = $this->db->query('SELECT * FROM `'.USER_MANAGEMENT.'` WHERE `admin` = 0 AND DATE(created) = date("Y-m-d")');
        $aresp = $this->db->query('SELECT * FROM `'.USER_MANAGEMENT.'` WHERE `admin` = 0 AND  created > DATE_SUB(CURDATE(), INTERVAL 2 HOUR)');

        $account = $aresp->num_rows()>0?$aresp->result_array():"";
        //echo"<pre>";
        //print_r($account);
//        die(); 

        if($account != ''){
//            foreach($account as $records)
//            $accosiated_account = $this->db->query('SELECT * FROM `'.INSTAGRAM_ACCOUNTS.'` WHERE `uid` = "'.$records->id.'"';
//            if($accosiated_account!='' and count($accosiated_account)>0){
//
//            }
//            $settings = $this->db->select("*")->get(SETTINGS)->row();
//            $subject = l('Activity Stopped').' - '.$settings->website_title;


            foreach($account as $row) {

                $this->db->select('*');
                $this->db->from('instagram_accounts');
                $this->db->where('uid',$row['id']);
                $wresp = $this->db->get();
                $emailalert = $wresp->num_rows()>0?$wresp->result_array():"";
                if(is_array($emailalert) && count($emailalert)>0){
                    continue;
                }else{
                    $settings = $this->db->select("*")->get(SETTINGS)->row();
                    $message = '
					<html>
					<head>
					<title></title>
					</head>
					<body>
					<p>'.l('Hey,').'</p>
					<p>'.l('we noticed you created a trial with IGplan, but haven’t added your IG account yet.').'</p>
					<p>'.l('Please => ').'<a target="_blank" href="https://app.igplan.com">'.l('go HERE to add your account to start growing your IG account and getting your friends jealous..').'</a></p>
					<p>'.l('Thanks!').'</p>
					<p>'.l('Your IGplan team').'</p>
					</body>
					</html>
					';



                    require APPPATH.'libraries/PHPMailer/PHPMailerAutoload.php';
                    $mail = new PHPMailer;
//				$mail->SMTPDebug = 2;                               // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = $settings->mail_smtp_host;  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = $settings->mail_smtp_user;                 // SMTP username
                    $mail->Password = $settings->mail_smtp_pass;                           // SMTP password
                    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = (int)$settings->mail_smtp_port;                                    // TCP port to connect to

                    $mail->setFrom($settings->mail_from_email, $settings->mail_from_name);
                    $mail->addAddress($row['email']);     // Add a recipient
                    $mail->addReplyTo($settings->mail_from_email, 'Admin');
                    $mail->addCC($settings->mail_from_email);
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = "Add your IG account";
                    $mail->Body    = $message;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    if(!$mail->send()) {
                        echo "Mail Not Send";
                        create_log($row['email'],'mail' ,'Mail Not Send');
                    } else {
//                        $this->db->where('uid',$row['uid']);
//                        $this->db->where('id',$row['id']);
//                        $updata = $this->db->update(INSTAGRAM_ACCOUNTS, array( "last_update_date" => NOW ));

//                        if($updata){
                        echo "sent";
//                        }else{
//
//                            echo "Update Error";
//                            create_log($row['username'],'mail' ,'Update Error');
//                        }
                    }
                }

            }
        }else{
            echo "Account not found";
        }

    }
}

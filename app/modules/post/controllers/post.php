<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class post extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view();
	}

	public function index(){

        if(is_null(get('account'))){
            header("Location: ".PATH);
            exit;
        }

        $this->db->select('*');
        $this->db->from(INSTAGRAM_ACCOUNTS);
        $this->db->where('uid',session('uid'));
        $this->db->where('id',get('account'));
        $this->db->where('checkpoint',0);
        $aresp = $this->db->get();

        $Accountresp = $aresp->num_rows()>0?$aresp->result_array():"";

        if($Accountresp == ''){
            header("Location: ".PATH);
            exit;
        }

        $this->db->select('*');
        $this->db->from(INSTAGRAM_ACCOUNTS);
        $this->db->where('uid',session('uid'));
        $this->db->where('checkpoint',0);
        $this->db->order_by("username","ASC");
        $resp2 = $this->db->get();

        $Accounts = $resp2->num_rows()>0?$resp2->result_array():"";

        if(!is_null(get('postid'))){

            $this->db->select('*');
            $this->db->from('posts');
            $this->db->where('id',get('postid'));
            $postresp = $this->db->get();

            $Post = $postresp->num_rows()>0?$postresp->result_array():"";
            $allowed_statuses = ["scheduled", "failed"];

            if($Post != ''){

                if(!in_array($Post[0]["status"], $allowed_statuses) ||  $Post[0]["user_id"] != session("uid")){

                    header("Location: ".PATH."post?account=".get('account'));
                    exit;

                }
            }else{
                header("Location: ".PATH."post?account=".get('account'));
                exit;
            }
        }else{
            $Post = '';
        }

        $this->db->select('*');
        $this->db->from(USER_MANAGEMENT);
        $this->db->where('id',session('uid'));
        $userresp = $this->db->get();

        $AuthUser = $userresp->num_rows()>0?$userresp->result_array():"";


		$data = array(
			"Accounts"     => $Accounts,
			"Post"     => $Post,
			"AuthUser"     => $AuthUser,
			"result"     => $this->model->getAllAccount(),
			"save"       => $this->model->fetch("*", SAVE, "status = 1 AND category = 'post'".getDatabyUser()),
			"categories" => $this->model->fetch("*", CATEGORIES, "category = 'post'".getDatabyUser())
		);
		$this->template->title(l('Auto post')); 
		$this->template->build('index', $data);
	}

	public function bulk(){
		$data = array(
			"result"     => $this->model->getAllAccount()
		);
		$this->template->build('bulk', $data);
	}

	public function ajax_bulk_post(){
		$link = post("link");
		$account = (int)post("account");

		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $link);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

	    $result = json_decode(curl_exec($ch));
	    curl_close($ch);

	 	if(is_array($result)){
	 		$ig_accounts = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$account."'".getDatabyUser());
	 		if(!empty($ig_accounts)){
		 		foreach ($result as $key => $row) {
		 			$keywords = $row->keywords;
		 			$tags = "";
		 			if(!empty($keywords)){
		 				$tags = "\n\nHashtags: #".implode(" #", $keywords);
		 			}

		 			$cation = $row->titlename."\n\nDescription:\n ".$row->description."\n- "."".$row->bulletpoint1."\n- ".$row->bulletpoint2."\n- ".$row->bulletpoint3."\n- ".$row->bulletpoint4."\n- ".$row->bulletpoint5."\n\nLink: ".$row->linkamz.$tags;
			 		$data = array(
			 			"uid" => session("uid"),
			 			"group_type"     => "profile",
			 			"account_id"     => $ig_accounts->id,
			 			"account_name"   => $ig_accounts->username,
			 			"group_id"       => session("uid"),
			 			"name"           => $ig_accounts->username,
			 			"privacy"        => 0,
			 			"status"         => 1,
			 			"deplay"         => 360,
			 			"changed"        => NOW,
			 			"created"        => NOW,

			 			"time_post"      => date("Y-m-d H:i:s", strtotime($row->timestartpost)),
			 			"time_post_show" => date("Y-m-d H:i:s", strtotime($row->timestartpost)),
			 			"category"       => "post",
						"type"           => "photo",
						"image"          => $row->image1,
						"message"        => $cation

			 		);

			 		$this->db->insert(INSTAGRAM_SCHEDULES, $data);
			 	}

			 	ms(array(
					"st"    => "success",
					"label" => "bg-green",
					"txt"   => l("Add schedule successfully")
				));
			}else{
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => l("Please select an instagram account")
				));
			}
	 	}else{
	 		ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l("No posts found")
			));
	 	}
	}
	
	public function ajax_post_now(){
		$spintax = new Spintax();
		$data = array();

		if(!check_expiration()  && IS_ADMIN != 1){
			if(post('video_url') == ""){
				ms(array(
					"st"    => "valid",
					"label" => "bg-red",
					"txt"   => l('Notice: Out of date! System auto stop all activity on all your instagram accounts.')
				));
			}
		}

		switch (post('type')) {
			case 'video':
				if(post('video_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Video is required')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => $spintax->process(post('video_url')),
					"message"     => $spintax->process(post('message')),
                    "first_comment" => $spintax->process(post('first_comment'))
				);
				break;

			case 'storyvideo':
				if(post('video_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Video is required')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => $spintax->process(post('video_url')),
					"message"     => $spintax->process(post('message')),
                    "first_comment" => $spintax->process(post('first_comment'))
				);
				break;

			case 'photocarousel':
				if(!post('images_url[]')){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Images is required')
					));
				}

				if(count(post('images_url[]')) < 2){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Add at least two images')
					));
				}

				if(count(post('images_url[]')) > 10){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Add maximum tem images')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => json_encode($this->input->post("images_url[]")),
					"message"     => $spintax->process(post('message')),
                    "first_comment" => $spintax->process(post('first_comment'))
				);
				break;
				
			default:
				if(post('image_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Image is required')
					));
				}

				$data = array(
					"category"      => "post",
					"type"          => post('type'),
					"image"         => $spintax->process(post('image_url')),
					"message"       => $spintax->process(post('message')),
					"first_comment" => $spintax->process(post('first_comment'))
				);
				break;
		}

		$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".post('group')."'".getDatabyUser());
		if(post('group')){
			$data["uid"]            = session("uid");
			$data["group_type"]     = "profile";
			$data["account_id"]     = $account->id;
			$data["account_name"]   = $account->username;
			$data["group_id"]       = $account->id;
			$data["name"]           = $account->username;
			$data["privacy"]        = 0;
			$data["time_post"]      = NOW;
			$data["changed"]        = NOW;
			$data["created"]        = NOW;
			$data["deplay"]         = 180;
			$data["status"]         = 4;

			$date = new DateTime(NOW, new DateTimeZone(TIMEZONE_SYSTEM));
			$date->setTimezone(new DateTimeZone(TIMEZONE_USER));
			$time_post_show = $date->format('Y-m-d H:i:s');

			$data["time_post_show"] = $time_post_show;
			if(!empty($account)){
				$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				$id = $this->db->insert_id();

				$data['username'] = $account->username;
				$data['password'] = $account->password;
				$data['fid'] = $account->fid;

				//Add Proxy
				$proxy_item = $this->model->get("*", PROXY, "id = '".$account->proxy."'");
				if(!empty($proxy_item)){
					$data["proxy"] = $proxy_item->proxy;
				}else{
					$data["proxy"] = "";
				}

				$row = (object)$data;

				$response = (object)Instagram_Post($row);
				$this->db->update(INSTAGRAM_SCHEDULES, array(
					"status" => ($response->st == "success")?3:4,
					"result" => (isset($response->id))?$response->id:"",
					"message_error" => ($response->st == "success")?$response->txt:"",
				), "id = {$id}");

				if($response->st == "success"){
					ms(array(
						"st"    => "success",
						"label" => "bg-light-green",
						"txt"   => "<span class='col-green'>".l('Post successfully')." <a href='https://instagram.com/p/".$response->code."' target='_blank'><i class='col-light-blue fa fa-external-link-square' aria-hidden='true'></i></a></span>"
					));
				}else{
					ms(array(
						"st"    => "error",
						"label" => "bg-red",
						"txt"   => "<span class='col-red'>".$response->txt."</span>"
					));
				}
			}else{
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
					"txt"   => "<span class='col-red'>".l('Instagram account not exist')."</span>"
				));
			}
		}else{
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => "<span class='col-red'>".l('Have problem with this item')."</span>"
			));
		}
	}

	public function ajax_save_schedules(){
		$data = array();
		$groups = $this->input->post('id');
		switch (post('type')) {
			case 'video':
				if(post('video_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Video is required')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => post('video_url'),
					"message"     => post('message'),
                    "first_comment" => !empty (post('first_comment')) ? post('first_comment') : '',
				);
				break;

			case 'storyvideo':
				if(post('video_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Video is required')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => post('video_url'),
					"message"     => post('message'),
                    "first_comment" => !empty (post('first_comment')) ? post('first_comment') : '',
				);
				break;

			case 'photocarousel':
				if(!post('images_url[]')){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Images is required')
					));
				}

				if(count(post('images_url[]')) < 2){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Add at least two images')
					));
				}

				if(count(post('images_url[]')) > 10){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Add maximum ten images')
					));
				}

				$data = array(
					"category"    => "post",
					"type"        => post('type'),
					"image"       => json_encode($this->input->post("images_url[]")),
					"message"     => post('message'),
                    "first_comment" => !empty (post('first_comment')) ? post('first_comment') : '',
				);
				break;

			default:
				if(post('image_url') == ""){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Image is required')
					));
				}

				$data = array(
					"category"      => "post",
					"type"          => post('type'),
					"image"         => post('image_url'),
					"message"       => post('message'),
					"first_comment" => !empty (post('first_comment')) ? post('first_comment') : '',
				);
				break;
		}

		if(post('time_post') == ""){
			$json[] = array(
				"st"    => "valid",
				"label" => "bg-red",
				"text"  => l('Time post is required')
			);
		}

		if(empty($groups)){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Select at least a instagram account')
			));
		}

		if(post('auto_repeat') != 0){
			$data["repeat_post"] = 1;
			$data["repeat_time"] = (int)post("auto_repeat");
			$data["repeat_end"]  = date("Y-m-d", strtotime(post('repeat_end')));
		}else{
			$data["repeat_post"] = 0;
		}

		$count = 0;
		$deplay = (int)post('deplay')*60;
		$list_deplay = array();
		for ($i=0; $i < count($groups); $i++) { 
			$list_deplay[] = $deplay*$i;
		}

		$auto_pause = (int)post('auto_pause');
		if($auto_pause != 0){
			$pause = 0;
			$count_deplay = 0;
			for ($i=0; $i < count($list_deplay); $i++) { 
				$item_deplay = 1;
				if($auto_pause == $count_deplay){
					$pause += post('time_pause')*60;
					$count_deplay = 0;
				}

				$list_deplay[$i] += $pause;
				$count_deplay++;
			}
		}

		shuffle($list_deplay);

		$time_post_show = strtotime(post('time_post').":00");
		$time_now  = strtotime(NOW) + 60;
		if($time_post_show < $time_now){
			$time_post_show = $time_now;
		}

		$date = new DateTime(date("Y-m-d H:i:s", $time_post_show), new DateTimeZone(TIMEZONE_USER));
		$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
		$time_post = $date->format('Y-m-d H:i:s');
		foreach ($groups as $key => $group) {
			$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
			$data["uid"]            = session("uid");
			$data["group_type"]     = "profile";
			$data["account_id"]     = $account->id;
			$data["account_name"]   = $account->username;
			$data["group_id"]       = session("uid");
			$data["name"]           = $account->username;
			$data["privacy"]        = 0;
			$data["time_post"]      = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
			$data["time_post_show"] = date("Y-m-d H:i:s", $time_post_show + $list_deplay[$key]);
			$data["status"]         = 1;
			$data["deplay"]         = $deplay;
			$data["changed"]        = NOW;
			$data["created"]        = NOW;

			$this->db->insert(INSTAGRAM_SCHEDULES, $data);
			$count++;
		}

		if($count != 0){
			ms(array(
				"st"    => "success",
				"label" => "bg-green",
				"txt"   => l('Successfully')
			));
		}else{
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('The error occurred during processing')
			));
		}
	}


    public function schedule()
    {

        $respresult = 0;

        $callback = get('callback');

//        $AuthUser = $this->getVariable("AuthUser");
//        $Post = $this->getVariable("Post");
//        $is_new = !$Post->isAvailable();

//        $isVideoExtenstionsLoaded = $this->getVariable("isVideoExtenstionsLoaded");
//        $Accounts = $this->getVariable("Accounts");

        $this->db->select('*');
        $this->db->from(INSTAGRAM_ACCOUNTS);
        $this->db->where('uid',session('uid'));
        $this->db->where('checkpoint',0);
        $this->db->order_by("username","ASC");
        $resp2 = $this->db->get();

        $Accounts = $resp2->num_rows()>0?$resp2->result_array():"";

        if(post('post') != ''){

            $this->db->select('*');
            $this->db->from('posts');
            $this->db->where('id',post('post'));
            $postresp = $this->db->get();

            $Post = $postresp->num_rows()>0?$postresp->result_array():"";

        }else{
            $Post = '';
        }

        $is_new = $Post == ''? 1 : 0;

        $this->db->select('*');
        $this->db->from(USER_MANAGEMENT);
        $this->db->where('id',session('uid'));
        $userresp = $this->db->get();

        $AuthUser = $userresp->num_rows()>0?$userresp->result_array():"";

        if($AuthUser != ''){

            $expiration_date = $AuthUser[0]['expiration_date'];
            $admin           = $AuthUser[0]['admin'];
            $usertimezone    = $AuthUser[0]['timezone'];

            $authresp = json_decode($AuthUser[0]["settings"]);

//            $types = $authresp->post_types;

        }

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/post/controllers','',$homepath);
        // Emojione Client
        require($new_home.'app/libraries/Emojione/autoload.php');
//        require($new_home.'app/libraries/Emojione/src/Client.php');
//        require($new_home.'app/libraries/Emojione/src/Ruleset.php');
//        require($new_home.'app/libraries/Emojione/src/ClientInterface.php');
//        require($new_home.'app/libraries/Emojione/src/Emojione.php');
//        require($new_home.'app/libraries/Emojione/src/RulesetInterface.php');

        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

//        if ($AuthUser->isExpired()) {
//
//            $this->resp->result = 3;
//            $this->resp->msg = "Your account has been expired! Please renew your account to use the app.";
//            $this->jsonecho();
//        }

        if(!check_expiration($expiration_date)&&$admin !=1){
            echo $callback.'('.json_encode(array(
                "result"    => 3,
                "msg"   => l('Your account has been expired! Please renew your account to use the app.')
            )).")";
        }

        // Ckeck post type
        $type = post("type");
        if (!in_array($type, ["timeline", "story", "album"])) {
            $type = "timeline";
        }

//        if (in_array($type, ["timeline", "album"])) {
//            $type = "timeline";
//        }

        // Check media ids
        $media_ids = explode(",", post("media_ids"));

//print_r($media_ids);
//        die();
        foreach ($media_ids as $i => $id) {
            if ((int)$id < 1) {
                unset($media_ids[$i]);
            } else {
                $id = (int)$id;
            }
        }

//        $query = DB::table(TABLE_PREFIX.TABLE_FILES)
//            ->where("user_id", "=", $AuthUser->get("id"))
//            ->whereIn("id", $media_ids);
//        $res = $query->get();

        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('user_id',session('uid'));
        $this->db->where_in("id", $media_ids);
        $resp2 = $this->db->get();

        $res = $resp2->num_rows()>0?$resp2->result_array():"";

        $valid_media_ids = [];
        $media_data = [];
        foreach ($res as $m) {
//            $valid_media_ids[] = $m->id;
            $valid_media_ids[] = $m['id'];
            $media_data[$m['id']] = $m;
        }

        foreach ($media_ids as $i => $id) {
            if (!in_array($id, $valid_media_ids)) {
                unset($media_ids[$i]);
            }
        }

        if ($type == "album" && count($media_ids) < 2) {
//            $this->resp->msg = l("Please select at least 2 media this album post.");
//            $this->jsonecho();

            echo $callback.'('.json_encode(array(
                "result"    => $respresult,
                "msg"   => l('Please select at least 2 media this album post.')
            )).")";

        } else if ($type == "story" && count($media_ids) < 1) {
//            $this->resp->msg = l("Please select one media for this story post.");
//            $this->jsonecho();

            echo $callback.'('.json_encode(array(
                "result"    => $respresult,
                "msg"   => l('Please select one media for this story post.')
            )).")";

        } else if ($type == "timeline" && count($media_ids) < 1) {
//            $this->resp->msg = l("Please select one media for this post.");
//            $this->jsonecho();

            echo $callback.'('.json_encode(array(
                "result"    => $respresult,
                "msg"   => l('Please select one media for this post.')
            )).")";
        }

        switch ($type) {
            case "timeline":
//                $media_ids = array_slice($media_ids, 0, 10);
//                break;
            case "story":
                $media_ids = array_slice($media_ids, 0, 1);
                break;

            case "album":
                $media_ids = array_slice($media_ids, 0, 10);
                break;

            default:
                $media_ids = array_slice($media_ids, 0, 1);
                break;
        }



        // Check caption
        $caption = post("caption");
        $caption = str_replace(">⠀<", "\r\n", $caption);
        $caption = $Emojione->shortnameToUnicode($caption);
        $caption = mb_substr($caption, 0, 2200);
        $caption = $Emojione->toShort($caption);


        // Check comment
        $comment = post("comment");
        $comment = $Emojione->shortnameToUnicode($comment);
        $comment = mb_substr($comment, 0, 2200);
        $comment = $Emojione->toShort($comment);



        // Check accounts
        $account_ids = post("accounts");
        if (!is_array($account_ids)) {
            $account_ids = array($account_ids);
        }

//        print_r($account_ids);
//        die();

        $all_account_ids = [];
        $account_data = [];
        foreach ($Accounts as $a) {
            $all_account_ids[] = $a["id"];
            $account_data[$a["id"]] = $a;
        }

        foreach ($account_ids as $i => $id) {
            if (!in_array($id, $all_account_ids)) {
                unset($account_ids[$i]);
            }
        }

        if (!$account_ids) {
//            $this->resp->msg = l("Please select at least one Instagram account.");
//            $this->jsonecho();

            echo $callback.'('.json_encode(array(
                "result"    => $respresult,
                "msg"   => l('Please select at least one Instagram account.')
            )).")";


        }



        // Check schedule
        $is_scheduled = post("is_scheduled");
        $user_datetime_format = post("user_datetime_format");
        if (!$user_datetime_format) {
//            $user_datetime_format = $AuthUser->get("preferences.dateformat")
//                . " "
//                . ($AuthUser->get("preferences.timeformat") == "24" ?
//                    "H:i" : "h:i A");

            $user_datetime_format = "Y-m-d H:i:s";
        }

        $timezone = $usertimezone;
        $schedule_date = post("schedule_date");
        if ($is_scheduled) {

            if (isValidDate($schedule_date, $user_datetime_format)) {

//                echo $user_datetime_format."<br>";
//                echo $schedule_date."<br>";
                $date = date_create_from_format($user_datetime_format,$schedule_date);
                $newdate =  $date->format('Y-m-d H:i:s');

//                $schedule_date = new DateTime(date($newdate), new DateTimeZone(TIMEZONE_USER));
//                $schedule_date->setTimezone(new DateTimeZone(date_default_timezone_get()));

//                $schedule_date = new DateTime($newdate, new DateTimeZone(TIMEZONE_USER));
//                $schedule_date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));

                require_once($new_home . 'app/libraries/moment/src/Moment.php');

                $schedule_date = new \Moment\Moment($newdate,TIMEZONE_USER);
                $schedule_date->setTimezone(TIMEZONE_SYSTEM);

//                $schedule_date = \DateTime::createFromFormat($user_datetime_format, $schedule_date, new DateTimeZone($timezone));
//                $schedule_date->setTimezone(new DateTimeZone(date_default_timezone_get()));

//                echo $schedule_date->format("Y-m-d H:i:s")."<br>";
//                echo date("Y-m-d H:i:s");
//                die();
            } else {
                $is_scheduled = false;
//                echo 12;
//                die();
            }
        }




        // Define status
        $status = $is_scheduled ? "scheduled" : "publishing";


        // Check permissions
        foreach ($media_ids as $id) {
            $media = $media_data[$id];
            $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));

//            if (in_array($ext, ["mp4"])) {
////                if (!$isVideoExtenstionsLoaded) {
////                    $this->resp->msg = l("It's not possible to post video files right now!");
////                    $this->jsonecho();
////                }
//
////                $permission = "settings.post_types.".$type."_video";
//                $permission = $type."_video";
//            } else if (in_array($ext, ["jpg", "jpeg", "png"])) {
////                $permission = "settings.post_types.".$type."_photo";
//                $permission = $type."_photo";
//            } else {
////                $this->resp->msg = l("Oops! An error occured. Please try again later!");
////                $this->jsonecho();
//
//                echo $callback.'('.json_encode(array(
//                    "result"    => $respresult,
//                    "msg"   => l('Oops! An error occured. Please try again later!')
//                )).")";
//            }

            if (!in_array($ext, ["mp4","jpg", "jpeg", "png"])) {
                echo $callback.'('.json_encode(array(
                    "result"    => $respresult,
                    "msg"   => l('Oops! An error occured. Please try again later!')
                )).")";
            }

//            if (!$AuthUser->get($permission)) {
//                $permission_errors = [
//                    "settings.post_types.timeline_video" => l("You don't have a permission for video posts."),
//                    "settings.post_types.story_video" => l("You don't have a permission for story videos."),
//                    "settings.post_types.album_video" => l("You don't have a permission for videos in album."),
//                    "settings.post_types.timeline_photo" => l("You don't have a permission for photo posts."),
//                    "settings.post_types.story_photo" => l("You don't have a permission for story photos."),
//                    "settings.post_types.album_photo" => l("You don't have a permission for photos in album.")
//                ];
//
//                if (isset($permission_errors[$permission])) {
//                    $msg = $permission_errors[$permission];
//                } else {
//                    $msg = l("You don't have a permission for this kind of post.");
//                }
//
//                $this->resp->msg = $msg;
//                $this->jsonecho();
//            }
        }
//print_r($media_ids);
//        die();

        // If post exists, get create date and remove it
        // It will be created again as a new post
        if ($is_new) {
            $create_date = date("Y-m-d H:i:s");
        } else {
//            $create_date = $Post->get("create_date");
//            $old_post_id = $Post->get("id");
//            $Post->remove();
            if($Post != ''){
                $create_date = $Post[0]["create_date"];
                $old_post_id = $Post[0]["id"];

                $this->db->where('create_date',$create_date);
                $this->db->where('id',$old_post_id);
                $RemovePost = $this->db->delete('posts');
            }

        }
//print_r($media_ids);
//        die();
        $posts = [];
        foreach ($account_ids as $aid) {
//            foreach ($media_ids as $mid) {

//                    // Create new post
//                    echo post("lat")."/".post("long");

            $locate = ['lat'=> post("lat"), 'long' => post("long") ,'placename' =>post("placename")];
            $location = json_encode($locate);

//            $Post = Controller::model("Post");
//            $Post->set("status", $status)
//                ->set("user_id", $AuthUser->get("id"))
//                ->set("type", $type)
//                ->set("caption", $caption)
//                ->set("location", $location)
//                ->set("media_ids", implode(",", $media_ids))
////                    ->set("media_ids", $mid)
//                ->set("account_id", $aid)
//                ->set("is_scheduled", $is_scheduled)
//                ->set("create_date", $create_date)
//                ->set("comment", $comment);
//
//
//            if ($is_scheduled) {
//                $Post->set("schedule_date", $schedule_date->format("Y-m-d H:i:s"));
//            } else {
//                $Post->set("schedule_date", date("Y-m-d H:i:s"));
//            }
//
//            $Post->save();


            $NewPost = array(
                "status" => $status,
                "user_id" => session("uid"),
                "type" => $type,
                "caption" => $caption,
                "location" => $location,
                "media_ids" => implode(",", $media_ids),
                "account_id" => $aid,
                "is_scheduled" => $is_scheduled,
                "create_date" => $create_date,
                "publish_date" => $create_date,
                "comment" => $comment,
                "schedule_date" => $is_scheduled ? $schedule_date->format("Y-m-d H:i:s") : date("Y-m-d H:i:s")
            );

            $this->db->insert('posts', $NewPost);
            $insertresp = $this->db->insert_id();


            $this->db->select('*');
            $this->db->from('posts');
            $this->db->where("id", $insertresp);
            $posresp = $this->db->get();

            $Post = $posresp->num_rows()>0?$posresp->result_array():"";

            $posts[] = $Post[0];

//            }
        }



        if ($status == "scheduled") {
//            $date = new Moment\Moment($Post->get("schedule_date"), date_default_timezone_get());
//            $date->setTimezone($AuthUser->get("preferences.timezone"));

            $date = new DateTime($NewPost["schedule_date"], new DateTimeZone(TIMEZONE_SYSTEM));
            $date->setTimezone(new DateTimeZone(TIMEZONE_USER));

//            $format = $AuthUser->get("preferences.dateformat") . " "
//                . ($AuthUser->get("preferences.timeformat") == "24" ? "H:i" : "h:i A");

            $format = "Y-m-d H:i:s";

//            $this->resp->result = 1;
            if ($is_new) {
//                $this->resp->msg = l("Post has been scheduled to %s", $date->format($format));

                echo $callback.'('.json_encode(array(
                    "result"    => 1,
                    "msg"   => l("Post has been scheduled to ".$date->format($format))
                )).")";


            } else {
//                $this->resp->msg = l("Post has been re-scheduled to %s", $date->format($format));

                echo $callback.'('.json_encode(array(
                    "result"    => 1,
                    "msg"   => l("Post has been re-scheduled to ". $date->format($format))
                )).")";
            }
//            $this->jsonecho();
        } else {
            // Publish posts to Instagram
            $results = [
                "success" => [],
                "fail" => []
            ];


            foreach ($posts as $Post) {
                try {
//                    $ig_media_code = publish($Post);
                    $ig_media_code = publish_schedule($Post);
//                    $ig_media_code = "dnsj6ahs7nJ";

//                    $results["success"][] = [
//                        "account_id" => $Post->get("account_id"),
//                        "username" => $account_data[$Post->get("account_id")]->get("username"),
//                        "url" => "https://www.instagram.com/p/".$ig_media_code
//                    ];

                    $results["success"][] = [
                        "account_id" => $Post["account_id"],
                        "username" => $account_data[$Post["account_id"]]['username'],
                        "url" => "https://www.instagram.com/p/".$ig_media_code
                    ];
                } catch (\Exception $e) {
                    $resp = $e->getMessage();
                    if (stripos($resp, "Login required") !== false || stripos($resp, "The password you entered is incorrect. Please try again.") !== false) {
                        $respmsg = "Re-login required for ". $account_data[$Post["account_id"]]['username'] . ". Because username or password may be changed.";
                    }else if (stripos($resp, "Challenge required.") !== false) {
                        $respmsg = "Re-login required for ". $account_data[$Post["account_id"]]['username'] . ". Due to challenge required.";
                    }else{
                        $respmsg = $e->getMessage();
                    }

                    $results["fail"][] = [
                        "account_id" => $Post["account_id"],
                        "username" => $account_data[$Post["account_id"]]['username'],
                        "url" => PATH."post?postid=".$Post["id"],
//                        "msg" => $e->getMessage()
                        "msg" => $respmsg
                    ];
                }
            }

            if (!empty($results["success"]) && empty($results["fail"])) {
                // Published all posts
                $respresult = 1;
                if (count($posts) > 1) {
                    $msg = l("Post published successfully! Click on the usernames to view the published posts.");
                    $details = [];
                    foreach ($results["success"] as $r) {
                        $r["type"] = "success";
                        $details[] = $r;
                    }
                } else {
                    $msg = l("Post published successfully!");

//                    $this->resp->msg = l("Post published successfully! <a href='%s'>View post</a>",
//                        $results["success"][0]["url"]);
                }
            } else if (!empty($results["fail"]) && empty($results["success"])) {
                // Failed for all posts
                $respresult = -1;

                $details = [];
                foreach ($results["fail"] as $r) {
                    $r["type"] = "fail";
                    $details[] = $r;
                }

                if (count($posts) > 1) {
                    $msg = l("Failed to publish the post! Click on the usernames to view the failed posts.");
                } else {
                    // There is only one most, remove it
                    // There no need to keep it as a failed post
//                    if (count($posts) == 1) {
////                        if ($is_new) {
//////                            $posts[0]->remove();
//////                            $RemovePost = $this->db->delete('posts')->where('create_date',$create_date)->where('id',$old_post_id);
////                        } else {
//////                            $posts[0]->updateId($old_post_id);
////                        }
//                    }
                    $msg = $results["fail"][0]["msg"];
                }
            } else {
                // Published for some and failed for rest
                // Number of posts is definitely bigger than one
                $respresult = 2;
                $msg = l("Post successfully published only for some accounts.");
                $details = [];

                foreach ($results["success"] as $r) {
                    $r["type"] = "success";
                    $details[] = $r;
                }

                foreach ($results["fail"] as $r) {
                    $r["type"] = "fail";
                    $details[] = $r;
                }
            }


//            $this->jsonecho();
            echo $callback.'('.json_encode(array(
                "result"    => $respresult,
                "details"    => $details,
                "msg"   => $msg
            )).")";

        }
    }


    public function location(){

        $this->db->select('*');
        $this->db->from(INSTAGRAM_ACCOUNTS);
        $this->db->where('uid',session('uid'));
        $this->db->where('checkpoint',0);
        $this->db->order_by("username","ASC");
        $this->db->limit(1);
        $accresp2 = $this->db->get();

        $Accounts = $accresp2->num_rows()>0?$accresp2->result_array():"";

        if($Accounts == ''){
            ms(array(
                "result"    => 0,
                "details"    => '',
                "msg"   => "No account Found"
            ));
        }

        $proxy_item = $this->model->get("*", PROXY, "id = '" . $Accounts[0]['proxy'] . "'");
        if (!empty($proxy_item)) {
            $proxy = $proxy_item->proxy;
        } else {
            $proxy = "";
        }

        $ins = Instagram_Login($Accounts[0]['username'], $Accounts[0]['password'] , $proxy);
        if(is_array($ins) && isset($ins['st'])){
            ms($ins);
        }

//        latitude=×tamp=1524057238000&longitude=82.151475&search_query=unite
//        $location = $Instagram->location->search(Input::post("lat"), Input::post("long"), Input::post("place"))->getVenues();
//        $location = $Instagram->location->search(29.7629, -95.3832, Input::post("place"))->getVenues();
        $location = $ins->location->search(post("lat"), post("long"), post("place"))->getVenues();

            ms(array(
                "result"    => 1,
                "details"    => '',
                "msg"   => $location
            ));
    }

    public function captions(){

        $callback = get('callback');

        if(post('action')=='save'){

            $this->db->select('*');
            $this->db->from('captions');
            $this->db->where('user_id',session('uid'));
            $capresp2 = $this->db->get();
            $Captions = $capresp2->num_rows()>0?$capresp2->result_array():"";



            $homepath = dirname(__FILE__);
            $new_home = str_replace('app/modules/post/controllers','',$homepath);

            require($new_home.'app/libraries/Emojione/autoload.php');

            $Emojione = new \Emojione\Client(new \Emojione\Ruleset());

            $caption = post("caption");
            $caption = str_replace(">⠀<", "\r\n", $caption);
            $caption = $Emojione->shortnameToUnicode($caption);
            $caption = mb_substr($caption, 0, 2200);
            $caption = $Emojione->toShort($caption);

            if($Captions != ''){

                $updata = array(
//                    'user_id' => session('uid'),
                    'title' => post('title'),
                    'caption' => $caption,
                    'date' => date('Y-m-d H:i:s')
                );
                $this->db->where('user_id',session('uid'));
                $Update = $this->db->update('captions',$updata);
                if($Update){
                    echo $callback.'('.json_encode(array("result" => 1,"details" => '',"msg"   => 'Hashtag Saved Successfully!')).')';
                }else{
                    echo $callback.'('.json_encode(array(
                        "result"    => 0,
                        "details"    => '',
                        "msg"   => 'Something Went Wrong!'
                    )).')';
                }


            }else{

                $indata = array(
                    'user_id' => session('uid'),
                    'title' => post('title'),
                    'caption' => $caption,
                    'date' => date('Y-m-d H:i:s')
                );

                $Insert = $this->db->insert('captions',$indata);
                if($Insert){
                    echo $callback.'('.json_encode(array(
                        "result"    => 1,
                        "details"    => '',
                        "msg"   => 'Hashtag Saved Successfully!'
                    )).')';
                }else{
                    echo $callback.'('.json_encode(array(
                        "result"    => 0,
                        "details"    => '',
                        "msg"   => 'Something Went Wrong!'
                    )).')';
                }

            }

        }else{

            $this->db->select('*');
            $this->db->from('captions');
            $this->db->where('user_id',session('uid'));
            $capresp2 = $this->db->get();
            $Captions = $capresp2->num_rows()>0?$capresp2->result_array():"";

            if($Captions != ''){
                echo $callback.'('.json_encode(array(
                    "result"    => 1,
                    "caption"    => $Captions[0]['caption'],
                    "id"   => $Captions[0]['id']
                )).')';
            }else{
                echo $callback.'('.json_encode(array(
                    "result"    => 0,
                    "details"    => '',
                    "msg"   => ''
                )).')';
            }

        }
    }

    public function imageupload(){

//        $AuthUser = $this->getVariable("AuthUser");
        $Userid =  session("uid");
        $ImageName = post("ImageName");
        $Image = post("Image");

        $homepath = dirname(__FILE__);
        $new_home = str_replace('app/modules/post/controllers','',$homepath);

//        require($new_home.'app/libraries/Emojione/autoload.php');

        define('UPLOAD_DIR', $new_home.'assets/uploads/'.$Userid.'/');
//        echo$ImageName;

        $ext = pathinfo($ImageName, PATHINFO_EXTENSION);
        //  echo $ext;

        $Image_Name=$this->extract_unit($ImageName,$Userid,'.');
//       $vdoName= str_replace($ext,"png",$ImageName);
//        $imageName=explode('.',$vdoName);
//        $finalImageName=$imageName[0];
//        echo$Image_Name;
//        die();
        $image_parts = explode(";base64,", $Image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = UPLOAD_DIR . $Image_Name . '.png';
//        $file = $finalImageName . '.png';
//        echo $vdoName;
        // die();
        file_put_contents($file, $image_base64);

//        if(file_put_contents($file, $image_base64)){
//            return true;
//        }
//        return false;


    }
    function extract_unit($string, $start, $end)
    {
        $pos = stripos($string, $start);

        $str = substr($string, $pos);

        $str_two = substr($str, strlen($start));

        $second_pos = stripos($str_two, $end);

        $str_three = substr($str_two, 0, $second_pos);

        $unit = trim($str_three); // remove whitespaces

        return $unit;
    }


}
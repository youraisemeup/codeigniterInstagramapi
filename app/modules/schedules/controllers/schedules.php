<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class schedules extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');

        $this->load->model('common_model');
	}

	public function index(){
		$type = segment(2);
		if(!$type) redirect(PATH);

		$data = array();
		$this->template->title(l('Schedules'));
		$this->template->build('index', $data);
	}

	public function ajax_page(){
		$results = $this->model->get_cd_list();
        echo json_encode($results);
	}

	public function ajax_add_schedules(){
		$data = array();
		$groups = $this->input->post('accounts');

		if(!check_expiration()  && IS_ADMIN != 1){
			if(post('video_url') == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
//					"txt"   => l('Notice: Out of date! System auto stop all activity on all your instagram accounts.')
//					"txt"   => l('Notice: &nbsp;&nbsp;Your session has expired. <a href="'.PATH.'payments" style="color: #fff;">CLICK HERE</a> to keep growing your Instagram following on autopilot.')
					"txt"   => l('Notice: Your session has expired.')
				));
			}
		}

		switch (post('type')) {
			case 'like':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				} 

				//Target
				$target = array();
				if(post("enable_tag")){ $target['tag'] = 1; }
				if(post("enable_timeline")){ $target['timeline'] = 1; }
				if(post("enable_popular")){ $target['popular'] = 1; }
				if(post("enable_your_feed")){ $target['your_feed'] = 1; }
				if(post("enable_explore_tab")){ $target['explore_tab'] = 1; }

				//Tags
				$tags = post('tags');

				$data = array(
					"category"    => post('type'),
					"type"        => post('type'),
					"title"       => json_encode((array)$target),
					"comment"     => json_encode((array)$tags)
				);
				break;
			case 'comment':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				}

				//Target
				$target = array();
				if(post("enable_tag")){ $target['tag'] = 1; }
				if(post("enable_timeline")){ $target['timeline'] = 1; }
				if(post("enable_popular")){ $target['popular'] = 1; }
				if(post("enable_your_feed")){ $target['your_feed'] = 1; }
				if(post("enable_explore_tab")){ $target['explore_tab'] = 1; }

				//Tags
				$tags = post('tags');
				$comments = post('comments');

				$data = array(
					"category"    => post('type'),
					"type"        => post('type'),
					"title"       => json_encode((array)$target),
					"description" => json_encode((array)$tags),
					"message"     => json_encode((array)$comments),
				);
				break;
			case 'follow':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				}

				//Target
				$target = array();
				if(post("enable_tag")){ $target['tag'] = 1; }
				if(post("enable_location")){ $target['location'] = 1; }
				if(post("enable_username")){ $target['username'] = 1; }

				//Tags
				$tags = post('tags');
				$locations = post('locations');
				$usernames = post('usernames');

				$data = array(
					"category"    => post('type'),
					"type"        => post('type'),
					"title"       => json_encode((array)$target),
					"description" => json_encode((array)$tags),
					"url"         => json_encode((array)$locations),
					"image"       => json_encode((array)$usernames),
				);
				break;

      case 'like_follow':
  				if(count($groups) == 0){
  					ms(array(
  						"st"    => "valid",
  						"label" => "bg-red",
  						"txt"   => l('Select at least one account instagram')
  					));
  				}

  				//Target
  				$target = array();
  				if(post("enable_tag")){ $target['tag'] = 1; }
  				if(post("enable_location")){ $target['location'] = 1; }
  				if(post("enable_username")){ $target['username'] = 1; }

  				//Tags
  				$tags = post('tags');
  				$locations = post('locations');
  				$usernames = post('usernames');

  				$data = array(
  					"category"    => post('type'),
  					"type"        => post('type'),
  					"title"       => json_encode((array)$target),
  					"description" => json_encode((array)$tags),
  					"url"         => json_encode((array)$locations),
  					"image"       => json_encode((array)$usernames),
  				);
  				break;

			case 'unfollow':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				}

				$data = array(
					"category"    => post('type'),
					"type"        => post('type')
				);
				break;
			case 'followback':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				}

				//Message
				$messages = post('messages');

				$data = array(
					"category"    => post('type'),
					"type"        => post('type'),
					"message"     => json_encode((array)$messages)
				);
				break;
			case 'repost':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				}
				//Target
				$target = array();
				if(post("enable_tag")){ $target['tag'] = 1; }
				if(post("enable_location")){ $target['location'] = 1; }
				if(post("enable_username")){ $target['username'] = 1; }

				//Tags
				$tags = post('tags');
				$locations = post('locations');
				$usernames = post('usernames');
				$data = array(
					"category"    => post('type'),
					"type"        => post('type'),
					"title"       => json_encode((array)$target),
					"description" => json_encode((array)$tags),
					"url"         => json_encode((array)$locations),
					"image"       => json_encode((array)$usernames),
				);
				break;
			case 'message':
				if(count($groups) == 0){
					ms(array(
						"st"    => "valid",
						"label" => "bg-red",
						"txt"   => l('Select at least one account instagram')
					));
				}

				//Target
				$target = array();
				if(post("enable_tag")){ $target['tag'] = 1; }
				if(post("enable_location")){ $target['location'] = 1; }

				//Tags
				$tags = post('tags');
				$locations = post('locations');

				$data = array(
					"category"    => post('type'),
					"type"        => post('type'),
					"title"       => json_encode((array)$target),
					"description" => json_encode((array)$tags),
					"url"         => json_encode((array)$locations),
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

		$PostonHour = (int)post("repeat");
		$repeat     = 60/$PostonHour*60;

		$data["speed"]       = (int)post("speed");
		$data["repeat_post"] = 1;
		$data["repeat_time"] = $repeat;
		$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

		$count = 0;
		$deplay = (int)post('delay')*60;
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

		$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
		$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
		$time_post = $date->format('Y-m-d H:i:s');
		foreach ($groups as $key => $group) {
			$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
			$data["uid"]            = session("uid");
			$data["group_type"]     = "profile";
			$data["account_id"]     = $account->id;
			$data["account_name"]   = $account->username;
			$data["group_id"]       = $group;
			$data["name"]           = $group;
			$data["privacy"]        = 0;
			$data["time_post"]      = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
			$data["time_post_show"] = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
			$data["status"]         = 1;
			$data["caption"]        = $PostonHour;
			$data["deplay"]         = $deplay;
			$data["changed"]        = NOW;
			$data["created"]        = NOW;

			$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
			if(!empty($check)){
				$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
			}else{
				$this->db->insert(INSTAGRAM_SCHEDULES, $data);
			}
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

	public function ajax_add_multi_schedules(){
		$count = 0;
		$groups = $this->input->post('accounts'); 
		
		foreach ($groups as $key => $group) {
			//echo $group;die;
			$assignProxy = $this->common_model->assign_available_proxy(session('uid'), true,false,$group);
			//var_dump($assignProxy);die;
			if (!is_bool($assignProxy)) { 
				ms(array( 
					"st"    => "newerror",
					"label" => "bg-red",
					"txt"   => l('Temporary Server Maintenance to bring upgrades to your account performance.')
				));
			}
		}
        if(post("todo_like") != 'on' && post("todo_comment") != 'on' && post("todo_follow") != 'on' && post("todo_unfollow") != 'on'){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "txt"   => l('At least one activity action should be selected.')
            ));
        }

        if(post("enable_tag") != 'on' && post("enable_location") != 'on' && post("enable_followers") == '' && post("enable_followings") == '' && post("enable_likers") == '' && post("enable_commenters") == ''){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "txt"   => l('Targeting fields are mendatory. Please fill them.')
            ));
        }

        if(post("enable_tag") == 'on' && post("tags") == ''){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'tag',
                "txt"   => l('Add at least 1 hashtag in your settings to use Hashtag-related targeting.')
            ));
        }

        if(post("enable_location") == 'on' && post("locations") == ''){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'loc',
                "txt"   => l('Add at least 1 location in your settings to use Location-related targeting.')
            ));
        }

        if((post("enable_followers") == 1 && post("usernames") == '') || (post("enable_followers") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if((post("enable_followings") == 1 && post("usernames") == '') || (post("enable_followings") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if((post("enable_likers") == 1 && post("usernames") == '') || (post("enable_likers") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if((post("enable_commenters") == 1 && post("usernames") == '') || (post("enable_commenters") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }


		$blacklist_tags = post("blacklist_tags");
		$blacklist_usernames = post("blacklist_usernames");
		$blacklist_keywords = post("blacklist_keywords");
		$blacklists = array(
			"bl_tags" 		=> json_encode($blacklist_tags),
			"bl_usernames" 	=> json_encode($blacklist_usernames),
			"bl_keywords" 	=> json_encode($blacklist_keywords),
		);

		if(!check_expiration()  && IS_ADMIN != 1){
			if(post('video_url') == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
//					"txt"   => l('Notice: Out of date! System auto stop all activity on all your instagram accounts.')
//					"txt"   => l('Notice: &nbsp;&nbsp;Your session has expired. <a href="'.PATH.'payments" style="color: #fff;">CLICK HERE</a> to keep growing your Instagram following on autopilot.')
					"txt"   => l('Notice: Your session has expired.')
				));
			}
		}

		if(count($groups) == 0){
			ms(array(
				"st"    => "valid",
				"label" => "bg-red",
				"txt"   => l('Select at least one account instagram')
			));
		}

		$filter = array(
			"media_age" => post("filter_media_age"),
			"media_type" => post("filter_media_type"),
			"min_likes" => (int)post("filter_min_likes"),
			"max_likes" => (int)post("filter_max_likes"),
			"min_comments" => (int)post("filter_min_comments"),
			"max_comments" => (int)post("filter_max_comments"),
			"user_relation" => post("filter_user_relation"),
			"user_profile" => post("filter_user_profile"),
			"min_followers" => (int)post("filter_min_followers"),
			"max_followers" => (int)post("filter_max_followers"),
			"min_followings" => (int)post("filter_min_followings"),
			"max_followings" => (int)post("filter_max_followings"),
			"gender" => post("filter_gender")
		);

		if(post("todo_like")){
			$data = array();

			//------------------------//
			//Target
			$target = array();

			if(post("enable_tag")){ $target['tag'] = 1; }
			if(post("enable_location")){ $target['location'] = 1; }
			if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
			if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
			if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
			if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }
			
			//Data Activity
			$tags = post('tags');
			$locations = post('locations');
			
			$usernames = post('usernames');
			$data = array(
				"category"    => "like",
				"type"        => "like",
				"title"       => json_encode((array)$target),
				"description" => json_encode((array)$tags),
				"blacklists"  => json_encode($blacklists),
				"url"         => json_encode((array)$locations),
				"image"       => json_encode((array)$usernames),
				"filter"      => json_encode((array)$filter)
			);
			
			
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

			$PostonHour = (int)post("repeat_like");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//                $newuserdata = $this->db->get_where(INSTAGRAM_ACCOUNTS, array('id =' => $groups))->result_array();
                if($account->checkpoint != 0){
					var_dump($account->checkpoint);die;
                    $this->reconnect($account->username, $account->password,l("Due to checkpoint you can't start/stop the activity."));
                    ms(array(
                        "st"    => "error",
                        "label" => "bg-red",
                        "txt"   => l("Due to checkpoint you can't start/stop the activity.")
                    ));
                }
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				
				if(!empty($check)){
					$data["status"] = (int)post('newstatus');
//					$data["status"] = 1;
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//                    die();
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//                    die();
				}else{
					
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "like"));
			}
		}

		if(post("todo_comment")){
			$data = array();

			//------------------------//
			//Target
			$target = array();
			if(post("enable_tag")){ $target['tag'] = 1; }
			if(post("enable_location")){ $target['location'] = 1; }
			if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
			if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
			if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
			if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

			//Tags
			$tags = post('tags');
			$locations = post('locations');
			$usernames = post('usernames');
			$comments = post('comments');

			$data = array(
				"category"    => "comment",
				"type"        => "comment",
				"title"       => json_encode((array)$target),
				"description" => json_encode((array)$tags),
				"blacklists"  => json_encode($blacklists),
				"comment"     => json_encode((array)$comments),
				"url"         => json_encode((array)$locations),
				"image"       => json_encode((array)$usernames),
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			$PostonHour = (int)post("repeat_comment");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
                        $data["status"] = (int)post('newstatus');
//                    }

					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//					$data["status"] = 1;
				}else{
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "comment"));
			}
		}

		if(post("todo_follow")){
			$data = array();

			//------------------------//
			//Target
			$target = array();
			if(post("enable_tag")){ $target['tag'] = 1; }
			if(post("enable_location")){ $target['location'] = 1; }
			if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
			if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
			if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
			if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

			//Tags
			$tags = post('tags');
			$locations = post('locations');
			$usernames = post('usernames');

			$data = array(
				"category"    => "follow",
				"type"        => "follow",
				"title"       => json_encode((array)$target),
				"description" => json_encode((array)$tags),
				"blacklists"  => json_encode($blacklists),
				"url"         => json_encode((array)$locations),
				"image"       => json_encode((array)$usernames),
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			$PostonHour = (int)post("repeat_follow");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				// pr($account->id,1);
				if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//					$data["status"] = 1;
					$data["status"] = (int)post('newstatus');
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

				}else{
					$data["created"] = NOW;
					// pr($data,1);
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "follow"));
			}
		}

    	if(post("todo_like_follow")){

			$data = array();

			//------------------------//
			//Target
			$target = array();
			if(post("enable_tag")){ $target['tag'] = 1; }
			if(post("enable_location")){ $target['location'] = 1; }
			if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
			if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
			if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
			if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

			//Tags
			$tags = post('tags');
			$locations = post('locations');
			$usernames = post('usernames');

			$data = array(
				"category"    => "like_follow",
				"type"        => "like_follow",
				"title"       => json_encode((array)$target),
				"description" => json_encode((array)$tags),
				"blacklists"  => json_encode($blacklists),
				"url"         => json_encode((array)$locations),
				"image"       => json_encode((array)$usernames),
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			$PostonHour = (int)post("repeat_like_follow");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//					$data["status"] = 1;
					$data["status"] = (int)post('newstatus');
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

				}else{
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "like_follow"));
			}
		}

		if(post("todo_followback")){
			$data = array();

			//------------------------//
			//Message
			$messages = post('messages');

			$data = array(
				"category"    => "followback",
				"type"        => "followback",
				"message"     => json_encode((array)$messages),
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			$PostonHour = (int)post("repeat_followback");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
					$data["status"] = (int)post('newstatus');
//					$data["status"] = 1;
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

				}else{
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "followback"));
			}
		}

		if(post("todo_unfollow")){
			$data = array();

			//------------------------//
			$data = array(
				"category"    => "unfollow",
				"type"        => "unfollow",
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}
			
			//Target
			$target = array();
			if(post("enable_tag")){ $target['tag'] = 1; }
			if(post("enable_location")){ $target['location'] = 1; }
			if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
			if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
			if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
			if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

			
			$PostonHour = (int)post("repeat_unfollow");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;
				$data["title"]        = json_encode($target);

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//					$data["status"] = 1;
					$data["status"] = (int)post('newstatus');
					//print_r($data);//die;
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

				}else{
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "unfollow"));
			}
		}

		if(post("todo_repost")){
			$data = array();

			//------------------------//
			//Target
			$target = array();
			switch ((int)post("todo_repost")) {
				case 1:
					$target['tag'] = 1;
					break;

				case 2:
					$target['location'] = 1;
					break;

				case 3:
					$target['username'] = 1;
					break;

				case 4:
					$target['tag'] = 1;
					$target['location'] = 1;
					$target['username'] = 1;
					break;
			}


			//Tags
			$tags = post('tags');
			$locations = post('locations');
			$usernames = post('usernames');

			$data = array(
				"category"    => "repost",
				"type"        => "repost",
				"title"       => json_encode((array)$target),
				"description" => json_encode((array)$tags),
				"blacklists"  => json_encode($blacklists),
				"url"         => json_encode((array)$locations),
				"image"       => json_encode((array)$usernames),
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			$PostonHour = (int)post("repeat_repost");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//                    $data["status"] = 1;
                    $data["status"] = (int)post('newstatus');
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

				}else{
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "repost"));
			}
		}

		if(post("todo_deletemedia")){
			$data = array();

			//------------------------//
			//Target
			$target = array();

			//Tags
			$tags = post('tags');
			$locations = post('locations');

			$data = array(
				"category"    => "deletemedia",
				"type"        => "deletemedia",
				"title"       => json_encode((array)$target),
				"filter"      => json_encode((array)$filter)
			);
			//-----------------------//

			if(post('time_post') == ""){
				$json[] = array(
					"st"    => "valid",
					"label" => "bg-red",
					"text"  => l('Time post is required')
				);
			}

			$PostonHour = (int)post("repeat_deletemedia");
			$repeat     = 60/$PostonHour*60;

			$data["speed"]       = (int)post("speed");
			$data["repeat_post"] = 1;
			$data["repeat_time"] = $repeat;
			$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

			$deplay = (int)post('delay')*60;
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

			$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
			$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
			$time_post = $date->format('Y-m-d H:i:s');
			foreach ($groups as $key => $group) {
				$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
				$data["uid"]            = session("uid");
				$data["group_type"]     = "profile";
				$data["account_id"]     = $account->id;
				$data["account_name"]   = $account->username;
				$data["group_id"]       = $group;
				$data["name"]           = $group;
				$data["privacy"]        = 0;
				$data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
				$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
				$data["caption"]        = $PostonHour;
				$data["deplay"]         = $deplay;
				$data["changed"]        = NOW;

				$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
				if(!empty($check)){

                        $data["status"] = (int)post('newstatus');
//                        $data["status"] = 1;
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
					$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

				}else{
					$data["created"] = NOW;
					$this->db->insert(INSTAGRAM_SCHEDULES, $data);
				}
				$count++;
			}
		}else{
			foreach ($groups as $key => $group) {
				$this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "deletemedia"));
			}
		}

		//-----------Save Activity-------------//
		//Target
		$todo = array(
			'like' => post("todo_like")?1:0,
			'comment'  => post("todo_comment")?1:0,
      		'follow'  => post("todo_follow")?1:0,
			'like_follow'  => post("todo_like_follow")?1:0,
			'followback'  => post("todo_followback")?1:0,
			'unfollow'  => post("todo_unfollow")?1:0,
			'repost'  => (int)post("todo_repost"),
			'deletemedia'  => post("todo_deletemedia")?1:0,
		);
		$unfollow = array();

		$unfollow = array(
			"unfollow_source" => post("enable_unfollow_source"),
			"unfollow_followers"  => post("enable_unfollow_followers")?1:0,
			"unfollow_follow_age"  	=> post("unfollow_follow_age"),
		);





		//Target
		$targets = array(
			'tag'        => post("enable_tag")?1:0,
			'location'   => post("enable_location")?1:0,
			'followers'  => (int)post("enable_followers"),
			'followings' => (int)post("enable_followings"),
			'likers'     => (int)post("enable_likers"),
			'commenters' => (int)post("enable_commenters"),
			'unfollow'   => $unfollow,
		);

		//Tags
		$tags = post('tags');
		$locations = post('locations');
		$usernames = post('usernames');
		$comments = post('comments');
		$messages = post('messages');

		//Speed
		$speed = array(
			"repost" => (int)post("repeat_repost"),
			"like" => (int)post("repeat_like"),
			"comment" => (int)post("repeat_comment"),
			"deletemedia" => (int)post("repeat_deletemedia"),
      		"follow" => (int)post("repeat_follow"),
			"like_follow" => (int)post("repeat_like_follow"),
			"followback" => (int)post("repeat_followback"),
			"unfollow" => (int)post("repeat_unfollow"),
			"delay" => (int)post("delay"),
			"type" => (int)post("speed"),
		);
		
		$data_activity = array(
			"todo" => json_encode($todo),
			"targets" => $targets,
			"speed" => json_encode($speed),
			"tags" => json_encode($tags),
			"usernames" => json_encode($usernames),
			"locations" => json_encode($locations),
			"comments" => json_encode($comments),
			"messages" => json_encode($messages),
			"filter" => json_encode((array)$filter)
		);


		//-----------Save Activity-------------//
		foreach ($groups as $key => $group) {
			$account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//			if(post('newstatus') == 3 || post('newstatus') == 1){
                $activity = array(
                    "uid" 			=> session("uid"),
                    "account_id" 	=> $account->id,
                    "account_name" 	=> $account->username,
                    "data" 			=> json_encode($data_activity),
                    "blacklists" 	=> json_encode($blacklists),
                    "status" 		=> (int)post('newstatus'),
                    "created" 		=> NOW
                );
//            }else{
//                $activity = array(
//                    "uid" 			=> session("uid"),
//                    "account_id" 	=> $account->id,
//                    "account_name" 	=> $account->username,
//                    "data" 			=> json_encode($data_activity),
//                    "blacklists" 	=> json_encode($blacklists),
//                    "status" 		=> 3,
//                    "created" 		=> NOW
//                );
//            }


			$check = $this->model->get("*", INSTAGRAM_ACTIVITY, "account_id = '".$account->id."'".getDatabyUser());

			$activityID = $check->id;
			if(!empty($check)){

				$this->db->update(INSTAGRAM_ACTIVITY, $activity, array("id" => $check->id));
			}else{
                $activityID = $this->db->insert(INSTAGRAM_ACTIVITY, $activity);
			}

			//Enable activity
            $this->ajax_enable_activity ($activityID, 0);

		}
		ms(array(
			"st"    => "success",
//			"label" => "bg-green",
			"label" => "bg-dashboard-primary",
			"txt"   => l('Success!')
		));
	}

	public function ajax_action_all_activity(){
	    //Get action (1 = start, 2 = Stop)
        $action = (int)post("action");

        //If action is not correct
        if (!in_array($action, [1, 2])) {
            return false;
        }

        //If subscription expired
		if(!check_expiration()  && IS_ADMIN != 1){
            if(post('video_url') == ""){
                ms(array(
                    "st"    => "error",
                    "label" => "bg-red",
//                    "txt"   => l('Notice: Out of date! System auto stop all activity on all your instagram accounts.')
//                    "txt"   => l('Notice: &nbsp;&nbsp;Your session has expired. <a href="'.PATH.'payments" style="color: #fff;">CLICK HERE</a> to keep growing your Instagram following on autopilot.')
                    "txt"   => l('Notice: Your session has expired.')
                ));
            }
        }

       /* $assignProxy = $this->common_model->assign_available_proxy(session('uid'), true);
        if (!is_bool($assignProxy)) {
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "txt"   => l('Temporary Server Maintenance to bring upgrades to your account performance.')
            ));
        }*/

        //Defaults response
//        $responseStatus = '<span class="badge bg-light-green">'.l('Started').'</span>';
        $responseStatus = '<span class="badge bg-dashboard-primary">'.l('Started').'</span>';

        //Defaults statuses
        $activityStatus = 5;
        $scheduleStatus = 1;
        $checkActivityStatus = [1,3];
        $checkActivityStatusUpdate = [5];

        //If action is to stop all
        if ($action == 2) {

            //Defaults statuses
            $activityStatus = 3;
            $scheduleStatus = 3;
            $checkActivityStatus = [5];
            $checkActivityStatusUpdate = [1,3];

            //Defaults response
            $responseStatus = '<span class="badge bg-red">'.l('Stopped').'</span>';
        }

        //Perform action on all of user's schedules
//        $this->db->update(INSTAGRAM_SCHEDULES, array("status" => $scheduleStatus), "uid = '".session('uid')."' AND category != 'post' AND category != 'message'");

        //Perform action on all of user's activities
//        $this->db->update(INSTAGRAM_ACTIVITY, array("status" => $activityStatus), "uid = '".session('uid')."'");

        //All activities
        $activities = $this->common_model->fetch_data(INSTAGRAM_ACTIVITY, '*', ['where' => ['uid' => session('uid')], 'where_in' => ['status' => $checkActivityStatus]]);

        //Enable all activities
        if (count ($activities) > 0) {
            foreach ($activities as $row) {
                $this->ajax_enable_activity ($row['id'], 1);
            }
        }

        //Send response
        ms(array(
            "st"          => "success",
            "label"       => "bg-green",
            "txt"         => l('Successfully'),
            "status"      => $responseStatus,
            "updatedRows" => $this->common_model->fetch_data(INSTAGRAM_ACTIVITY, 'id', ['where' => ['uid' => session('uid')], 'where_in' => ['status' => $checkActivityStatusUpdate]], true, true),
        ));
    }

    public function reconnect($username,$password,$txt = ''){
        ms(array(
            'st'=>'modal',
            "label" => "bg-red",
            'txt' => $this->load->view("reconnect", array("username" => $username, "password" => $password, "txt" => $txt), true)
         )); 
    }

	public function ajax_enable_activity($activityID = false, $fromDashboardPage = false){
		$id = (int)post("id");
		$fromDashboard = (int)post("fromDashboard");
        
		$noResponse = false;

		if (!empty ($activityID)) {
			
		    $id = $activityID;
		    $fromDashboard = $fromDashboardPage;
		    $noResponse = true;
        } 
		
		$activity = $this->model->get("*", INSTAGRAM_ACTIVITY, "id = '".$id."'".getDatabyUser());
		
        $assignProxy = $this->common_model->assign_available_proxy(session('uid'), true,false,$activity->account_id);
		
		if (!is_bool($assignProxy)) {
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "txt"   => l('Temporary Server Maintenance to bring upgrades to your account performance.')
            ));
        }


		
//        $schedule1 = json_decode($activity->data);
//        $targetsnew = json_decode($schedule1->targets);
// 
//        if($targetsnew->tag != 1 || $targetsnew->followers == 0 || $targetsnew->followings == 0 || $targetsnew->commenters == 0 || $targetsnew->unfollow == 0){
//            ms(array(
//                "st"    => "error",
//                "label" => "bg-red",
//                "txt"   => l('Targeting fields are mendatory. Please fill them.')
//            ));
//        }

        $mdata = json_decode($activity->data);
        $mtargets = json_decode($mdata->targets);

        if($mtargets->tag == 1 && $mdata->tags == 'null'){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "pop" => 1,
                "txt"   => l('Add at least 1 hashtag in your settings to use Hashtag-related targeting.')
            ));
        }

        if($mtargets->location == 1 && $mdata->locations == 'null'){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "pop" => 1,
                "txt"   => l('Add at least 1 location in your settings to use Location-related targeting.')
            ));
        }

        if(($mtargets->followers == 1 && $mdata->usernames == 'null') || ($mtargets->followers == 3 && $mdata->usernames == 'null')){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "pop" => 1,
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if(($mtargets->followings == 1 && $mdata->usernames == 'null') || ($mtargets->followings == 3 && $mdata->usernames == 'null')){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "pop" => 1,
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if(($mtargets->likers == 1 && $mdata->usernames == 'null') || ($mtargets->likers == 3 && $mdata->usernames == 'null')){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "pop" => 1,
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if(($mtargets->commenters == 1 && $mdata->usernames == 'null') || ($mtargets->commenters == 3 && $mdata->usernames == 'null')){
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "pop" => 1,
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

		if(!check_expiration()  && IS_ADMIN != 1){
			if(post('video_url') == ""){
				ms(array(
					"st"    => "error",
					"label" => "bg-red",
//					"txt"   => l('Notice: Out of date! System auto stop all activity on all your instagram accounts.')
//					"txt"   => l('Notice: &nbsp;&nbsp;Your session has expired. <a href="'.PATH.'payments" style="color: #fff;">CLICK HERE</a> to keep growing your Instagram following on autopilot.')
					"txt"   => l('Notice: Your session has expired.')
				));
			}
		}

        $newuserdata = $this->db->get_where(INSTAGRAM_ACCOUNTS, array('id =' => $activity->account_id))->result_array();
        if($newuserdata[0]['checkpoint'] != 0){


            $this->reconnect($newuserdata[0]['username'],$newuserdata[0]['password'],l("Due to checkpoint you can't start/stop the activity."));
            ms(array(
                "st"    => "error",
                "label" => "bg-red",
                "txt"   => l("Due to checkpoint you can't start/stop the activity.")
            ));
        }

//        $logs_counter = [
//            'like' => 0,
//            'comment'  => 0,
//            'follow'  => 0,
//            'like_follow'  => 0,
//            'followback'  => 0,
//            'unfollow'  => 0,
//            'repost'  => 0,
//            'deletemedia'  => 0,
//        ];
//
//        $logs_counter = [
//            'logs_counter' => json_encode($logs_counter)
//        ];
//
////        $this->db->where('uid', $id);
////        $this->db->where('uid', session('uid'));
//
//        $this->db->where('id', $activity->account_id);
////        $this->db->update(INSTAGRAM_SCHEDULES, $logs_counter, array("uid" => $id));
//        $this->db->update(INSTAGRAM_ACCOUNTS, $logs_counter);
////        print_r($hello);
		//echo '<pre>';		print_r($activity);die;
		if(!empty($activity)){
			
			$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), "account_id = '".$activity->account_id."' AND category != 'post' AND category != 'message'");

				if($activity->status == 3 || $activity->status == 1){
				$schedule = json_decode($activity->data);
				$todo = json_decode($schedule->todo);				
				$targets = $schedule->targets;
				//print_r($schedule);die;
				$comments = json_decode($schedule->comments);
				$locations = json_decode($schedule->locations);
				$usernames = json_decode($schedule->usernames);
				$messages = json_decode($schedule->messages);
				$speed = json_decode($schedule->speed);
				$tags = json_decode($schedule->tags);
				$blacklists = json_decode($activity->blacklists);
				if(isset($targets) && !empty($targets)){
					$unfollow = $targets->unfollow;
				}
				

        		//Stop all schedule
        		$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 1), "account_id = '".$activity->account_id."' AND category != 'post' AND category != 'message'");

				if($todo->like == 1){
					$data = array();


					//------------------------//
					//Target
					$target = array();
					if(isset($targets) && !empty($targets)){
					if($targets->tag == 1){ $target['tag'] = 1; }
					if($targets->location == 1){ $target['location'] = 1; }
					if($targets->followers != 0){ $target['followers'] = $targets->followers; }
					if($targets->followings != 0){ $target['followings'] = $targets->followings; }
					if($targets->likers != 0){ $target['likers'] = $targets->likers; }
					if($targets->commenters != 0){ $target['commenters'] = $targets->commenters; }
					}
					$data = array(
						"category"    => "like",
						"type"        => "like",
						"title"       => json_encode((array)$target),
						"description" => json_encode((array)$tags),
						"blacklists" => json_encode((array)$blacklists),
						"url"         => json_encode((array)$locations),
						"image"       => json_encode((array)$usernames)
					);
					//------------------------//

					$PostonHour = (int)$speed->like;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;
					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

				if($todo->comment == 1){
					$data = array();

					//------------------------//
					//Target
					$target = array();
					if(isset($targets) && !empty($targets)){
					if($targets->tag == 1){ $target['tag'] = 1; }
					if($targets->location == 1){ $target['location'] = 1; }
					if($targets->followers != 0){ $target['followers'] = $targets->followers; }
					if($targets->followings != 0){ $target['followings'] = $targets->followings; }
					if($targets->likers != 0){ $target['likers'] = $targets->likers; }
					if($targets->commenters != 0){ $target['commenters'] = $targets->commenters; }
					}

					$data = array(
						"category"    => "comment",
						"type"        => "comment",
						"title"       => json_encode((array)$target),
						"description" => json_encode((array)$tags),
						"blacklists" => json_encode((array)$blacklists),
						"url"         => json_encode((array)$locations),
						"image"       => json_encode((array)$usernames),
						"comment"     => json_encode((array)$comments),
					);
					//------------------------//

					$PostonHour = (int)$speed->comment;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;

					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

				if($todo->follow == 1){
					$data = array();

					//------------------------//
					//Target
					$target = array();
					if(isset($targets) && !empty($targets)){
					if($targets->tag == 1){ $target['tag'] = 1; }
					if($targets->location == 1){ $target['location'] = 1; }
					if($targets->followers != 0){ $target['followers'] = $targets->followers; }
					if($targets->followings != 0){ $target['followings'] = $targets->followings; }
					if($targets->likers != 0){ $target['likers'] = $targets->likers; }
					if($targets->commenters != 0){ $target['commenters'] = $targets->commenters; }
					}
					$data = array(
						"category"    => "follow",
						"type"        => "follow",
						"title"       => json_encode((array)$target),
						"description" => json_encode((array)$tags),
						"blacklists" => json_encode((array)$blacklists),
						"url"         => json_encode((array)$locations),
						"image"       => json_encode((array)$usernames),
					);
					//------------------------//

					$PostonHour = (int)$speed->follow;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;

					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

        		if($todo->like_follow == 1){
					$data = array();

					//------------------------//
					//Target
					$target = array();
					if(isset($targets) && !empty($targets)){
					if($targets->tag == 1){ $target['tag'] = 1; }
					if($targets->location == 1){ $target['location'] = 1; }
					if($targets->followers != 0){ $target['followers'] = $targets->followers; }
					if($targets->followings != 0){ $target['followings'] = $targets->followings; }
					if($targets->likers != 0){ $target['likers'] = $targets->likers; }
					if($targets->commenters != 0){ $target['commenters'] = $targets->commenters; }
					}
					$data = array(
						"category"    => "like_follow",
						"type"        => "like_follow",
						"title"       => json_encode((array)$target),
						"description" => json_encode((array)$tags),
						"blacklists" => json_encode((array)$blacklists),
						"url"         => json_encode((array)$locations),
						"image"       => json_encode((array)$usernames),
					);
					//------------------------//

					$PostonHour = (int)$speed->like_follow;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;

					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

				if($todo->followback == 1){
					$data = array();

					//------------------------//
					//Target
					$data = array(
						"category"    => "followback",
						"blacklists" => json_encode((array)$blacklists),
						"type"        => "followback",
						"message"     => json_encode((array)$messages)
					);
					//------------------------//

					$PostonHour = (int)$speed->followback;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;

					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

				if($todo->unfollow == 1){
					$data = array();

					//------------------------//
					//Target
					$target = array();
					if(isset($targets) && !empty($targets)){
					if($targets->tag == 1){ $target['tag'] = 1; }
					if($targets->location == 1){ $target['location'] = 1; }
					if($targets->followers != 0){ $target['followers'] = $targets->followers; }
					if($targets->followings != 0){ $target['followings'] = $targets->followings; }
					if($targets->likers != 0){ $target['likers'] = $targets->likers; }
					if($targets->commenters != 0){ $target['commenters'] = $targets->commenters; }
					}

					
					$data = array(
						"category"    	=> "unfollow",
						"title"       => json_encode((array)$target),
						"blacklists" 	=> json_encode((array)$blacklists),
						"type"        	=> "unfollow",
						"description"   => json_encode($unfollow),
					);
					//------------------------//

					$PostonHour = (int)$speed->unfollow;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;

					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

				if($todo->repost != 0){
					$data = array();

					//------------------------//
					//Target
					$target = array();
					switch ($todo->repost) {
						case 1:
							$target['tag'] = 1;
							break;

						case 2:
							$target['location'] = 1;
							break;

						case 3:
							$target['username'] = 1;
							break;

						case 4:
							$target['tag'] = 1;
							$target['location'] = 1;
							$target['username'] = 1;
							break;
					}

					//Tags
					$data = array(
						"category"    => 'repost',
						"type"        => 'repost',
						"title"       => json_encode((array)$target),
						"description" => json_encode((array)$tags),
						"blacklists" => json_encode((array)$blacklists),
						"url"         => json_encode((array)$locations),
						"image"       => json_encode((array)$usernames),
					);
					//------------------------//

					$PostonHour = (int)$speed->repost;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;


					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

				if($todo->deletemedia == 1){
					$data = array();

					//------------------------//
					//Target
					$target = array();

					$data = array(
						"category"    => "deletemedia",
						"type"        => "deletemedia",
						"title"       => json_encode((array)$target),
						"description" => json_encode((array)$tags),
						"blacklists" => json_encode((array)$blacklists),
						"url"         => json_encode((array)$locations),
					);
					//------------------------//

					$PostonHour = (int)$speed->deletemedia;
					$repeat     = 60/$PostonHour*60;

					$data["speed"]       = (int)$speed->type;
					$data["repeat_post"] = 1;
					$data["repeat_time"] = $repeat;
					$data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

					$deplay = (int)$speed->delay*60;
					$time_post = strtotime(NOW) + 60;

					$date = new DateTime(date("Y-m-d H:i:s", $time_post), new DateTimeZone(TIMEZONE_USER));
					$date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
					$time_post_show = $date->format('Y-m-d H:i:s');
					$data["uid"]            = session("uid");
					$data["group_type"]     = "profile";
					$data["account_id"]     = $activity->account_id;
					$data["account_name"]   = $activity->account_name;
					$data["group_id"]       = $activity->account_id;
					$data["name"]           = $activity->account_id;
					$data["privacy"]        = 0;
					$data["time_post"]      = date("Y-m-d H:i:s", $time_post);
					$data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post_show));
					$data["caption"]        = $PostonHour;
					$data["deplay"]         = $deplay;
					$data["status"]         = 5;
					$data["changed"]        = NOW;


					$check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$activity->account_id."' AND category = '".$data['category']."'");
					if(!empty($check)){
						$this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
					}else{
						$data["created"]        = NOW;
						$this->db->insert(INSTAGRAM_SCHEDULES, $data);
					}
				}

                $logs_counter = [
                    'like' => 0,
                    'comment'  => 0,
                    'follow'  => 0,
                    'like_follow'  => 0,
                    'followback'  => 0,
                    'unfollow'  => 0,
                    'repost'  => 0,
                    'deletemedia'  => 0,
                ];

                $logs_counter = [
                    'logs_counter' => json_encode($logs_counter),
                    'start_date' => NOW
                ];

//        $this->db->where('uid', $id);
//        $this->db->where('uid', session('uid'));

                $this->db->where('id', $activity->account_id);
//        $this->db->update(INSTAGRAM_SCHEDULES, $logs_counter, array("uid" => $id));
                $this->db->update(INSTAGRAM_ACCOUNTS, $logs_counter);
//        print_r($hello);

				$this->db->update(INSTAGRAM_ACTIVITY, array("status" => 5), "id = '".$activity->id."'");

//                $status = '<span class="activity-status">'.l('Started').'</span>';
                $status = '<span class="badge bg-dashboard-primary">'.l('Started').'</span>';
                $button = '<button type="button" class="btn waves-effect btn-block btn-dashboard bg-red rounded-corner btnActivityAll" data-dashboard="0">'.l('Stop').'</button>';
                if ($fromDashboard == 1) {
                    $status = '<span class="badge bg-dashboard-primary">'.l('Started').'</span>';
                    $button = '<button type="button" style="width: 30%;float: left;padding: 7px 16px !important;" class="btn btn-dashboard bg-red rounded-corner waves-effect btnActivityAll" data-dashboard="1">'.l('Stop').'</button>';
                }

                if (!$noResponse) {
                    ms(array(
                        "st"    => "success",
                        "label" => "bg-green",
                        "txt"   => l('Successfully'),
                        "status"=> $status,
                        "btn"   => $button
                    ));
                }
			}else{
				$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), "account_id = '".$activity->account_id."' AND category != 'post' AND category != 'message'");
				$this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), "id = '".$activity->id."'");
                $this->db->update(INSTAGRAM_ACCOUNTS, array("stop_date" => NOW), array("id"=>$activity->account_id));
//				$status = '<span class="activity-status">'.l('Stopped').'</span>';
				$status = '<span class="badge bg-red">'.l('Stopped').'</span>';
				$button = '<button type="button" class="btn waves-effect bg-dashboard-primary btn-block btn-dashboard rounded-corner btnActivityAll" data-dashboard="0">'.l('Start').'</button>';
				if ($fromDashboard == 1) {
                    $status = '<span class="badge bg-red">'.l('Stopped').'</span>';
                    $button = '<button type="button" style="width: 30%;float: left;padding: 7px 16px !important;" class="btn btn-dashboard bg-dashboard-primary rounded-corner waves-effect btnActivityAll" data-dashboard="1">'.l('Start').'</button>';
                }

                if (!$noResponse) {
                    ms(array(
                        "st" => "success",
                        "label" => "bg-green",
                        "txt" => l('Successfully'),
                        "status" => $status,
                        "btn" => $button
                    ));
                }
			}
		}else{
            if (!$noResponse) {

                ms(array(
                    "st" => "valid",
                    "label" => "bg-red",
                    "txt" => l('Activity not exist')
                ));
            }
		}
	}

	public function ajax_action_item(){
		$id = (int)post('id');
		$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'".getDatabyUser());
		if(!empty($POST)){
			switch (post("action")) {
				case 'delete':
					$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'".getDatabyUser());
					break;

				case 'active':
					$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 1), "id = '{$id}'".getDatabyUser());
					break;

				case 'disable':
					$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 0), "id = '{$id}'".getDatabyUser());
					break;
			}
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('successfully')
		));
	}

	public function ajax_action_multiple(){
		$ids =$this->input->post('id');
		if(!empty($ids)){
			foreach ($ids as $id) {
				$POST = $this->model->get('*', INSTAGRAM_SCHEDULES, "id = '{$id}'".getDatabyUser());
				if(!empty($POST)){
					switch (post("action")) {
						case 'delete':
							$this->db->delete(INSTAGRAM_SCHEDULES, "id = '{$id}'");
							break;

						case 'active':
							$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 1), "id = '{$id}'".getDatabyUser());
							break;

						case 'disable':
							$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 0), "id = '{$id}'".getDatabyUser());
							break;
					}
				}
			}
		}

		if(post("action") == "delete_all"){
			$this->db->delete(INSTAGRAM_SCHEDULES, "category = '".post("category")."'".getDatabyUser());
		}

		ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Successfully')
		));
	}


    public function save_schedules(){

        $count = 0;
        $groups = $this->input->post('accounts');

//        if(post("enable_tag") != 'on' && post("enable_location") != 'on' && post("enable_followers") == '' && post("enable_followings") == '' && post("enable_likers") == '' && post("enable_commenters") == ''){
//            ms(array(
//                "st"    => "error",
//                "label" => "bg-red",
//                "txt"   => l('Targeting fields are mendatory. Please fill them.')
//            ));
//        }
//

        if(post("todo_like") != 'on' && post("todo_comment") != 'on' && post("todo_follow") != 'on' && post("todo_unfollow") != 'on'){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "txt"   => l('At least one activity action should be selected.')
            ));
        }


        if(post("enable_tag") == 'on' && post("tags") == ''){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'tag',
                "txt"   => l('Add at least 1 hashtag in your settings to use Hashtag-related targeting.')
            ));
        }

        if(post("enable_location") == 'on' && post("locations") == ''){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'loc',
                "txt"   => l('Add at least 1 location in your settings to use Location-related targeting.')
            ));
        }

        if((post("enable_followers") == 1 && post("usernames") == '') || (post("enable_followers") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if((post("enable_followings") == 1 && post("usernames") == '') || (post("enable_followings") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if((post("enable_likers") == 1 && post("usernames") == '') || (post("enable_likers") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        if((post("enable_commenters") == 1 && post("usernames") == '') || (post("enable_commenters") == 3 && post("usernames") == '')){
            ms(array(
                "st"    => "newerror",
                "label" => "bg-red",
                "pop" => 'user',
                "txt"   => l('Add at least 1 username in your settings to use Username-related targeting.')
            ));
        }

        $blacklist_tags = post("blacklist_tags");
        $blacklist_usernames = post("blacklist_usernames");
        $blacklist_keywords = post("blacklist_keywords");
        $blacklists = array(
            "bl_tags" 		=> json_encode($blacklist_tags),
            "bl_usernames" 	=> json_encode($blacklist_usernames),
            "bl_keywords" 	=> json_encode($blacklist_keywords),
        );

        if(!check_expiration()  && IS_ADMIN != 1){
            if(post('video_url') == ""){
                ms(array(
                    "st"    => "error",
                    "label" => "bg-red",
//                    "txt"   => l('Notice: Out of date! System auto stop all activity on all your instagram accounts.')
//                    "txt"   => l('Notice: &nbsp;&nbsp;Your session has expired. <a href="'.PATH.'payments" style="color: #fff;">CLICK HERE</a> to keep growing your Instagram following on autopilot.')
                    "txt"   => l('Notice: Your session has expired.')
                ));
            }
        }

        if(count($groups) == 0){
            ms(array(
                "st"    => "valid",
                "label" => "bg-red",
                "txt"   => l('Select at least one account instagram')
            ));
        }

        $filter = array(
            "media_age" => post("filter_media_age"),
            "media_type" => post("filter_media_type"),
            "min_likes" => (int)post("filter_min_likes"),
            "max_likes" => (int)post("filter_max_likes"),
            "min_comments" => (int)post("filter_min_comments"),
            "max_comments" => (int)post("filter_max_comments"),
            "user_relation" => post("filter_user_relation"),
            "user_profile" => post("filter_user_profile"),
            "min_followers" => (int)post("filter_min_followers"),
            "max_followers" => (int)post("filter_max_followers"),
            "min_followings" => (int)post("filter_min_followings"),
            "max_followings" => (int)post("filter_max_followings"),
            "gender" => post("filter_gender")
        );

        if(post("todo_like")){
            $data = array();

            //------------------------//
            //Target
            $target = array();

            if(post("enable_tag")){ $target['tag'] = 1; }
            if(post("enable_location")){ $target['location'] = 1; }
            if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
            if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
            if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
            if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

            //Data Activity
            $tags = post('tags');
            $locations = post('locations');
            $usernames = post('usernames');
            $data = array(
                "category"    => "like",
                "type"        => "like",
                "title"       => json_encode((array)$target),
                "description" => json_encode((array)$tags),
                "blacklists"  => json_encode($blacklists),
                "url"         => json_encode((array)$locations),
                "image"       => json_encode((array)$usernames),
                "filter"      => json_encode((array)$filter)
            );


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

            $PostonHour = (int)post("repeat_like");
            $repeat     = 60/$PostonHour*60;

            $data["speed"]       = (int)post("speed");
            $data["repeat_post"] = 1;
            $data["repeat_time"] = $repeat;
            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

            $deplay = (int)post('delay')*60;
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

            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
            $time_post = $date->format('Y-m-d H:i:s');
            foreach ($groups as $key => $group) {
                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
                $data["uid"]            = session("uid");
                $data["group_type"]     = "profile";
                $data["account_id"]     = $account->id;
                $data["account_name"]   = $account->username;
                $data["group_id"]       = $group;
                $data["name"]           = $group;
                $data["privacy"]        = 0;
                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
                $data["caption"]        = $PostonHour;
                $data["deplay"]         = $deplay;
                $data["changed"]        = NOW;

                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");

                if(!empty($check)){
                    $data["status"] = (int)post('newstatus');
//					$data["status"] = 1;
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//                    die();
                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//                    die();
                }else{

                    $data["created"] = NOW;
                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
                }
                $count++;
            }
        }else{
            foreach ($groups as $key => $group) {
                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "like"));
            }
        }

        if(post("todo_comment")){
            $data = array();

            //------------------------//
            //Target
            $target = array();
            if(post("enable_tag")){ $target['tag'] = 1; }
            if(post("enable_location")){ $target['location'] = 1; }
            if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
            if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
            if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
            if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

            //Tags
            $tags = post('tags');
            $locations = post('locations');
            $usernames = post('usernames');
            $comments = post('comments');

            $data = array(
                "category"    => "comment",
                "type"        => "comment",
                "title"       => json_encode((array)$target),
                "description" => json_encode((array)$tags),
                "blacklists"  => json_encode($blacklists),
                "comment"     => json_encode((array)$comments),
                "url"         => json_encode((array)$locations),
                "image"       => json_encode((array)$usernames),
                "filter"      => json_encode((array)$filter)
            );
            //-----------------------//

            if(post('time_post') == ""){
                $json[] = array(
                    "st"    => "valid",
                    "label" => "bg-red",
                    "text"  => l('Time post is required')
                );
            }

            $PostonHour = (int)post("repeat_comment");
            $repeat     = 60/$PostonHour*60;

            $data["speed"]       = (int)post("speed");
            $data["repeat_post"] = 1;
            $data["repeat_time"] = $repeat;
            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

            $deplay = (int)post('delay')*60;
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

            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
            $time_post = $date->format('Y-m-d H:i:s');
            foreach ($groups as $key => $group) {
                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
                $data["uid"]            = session("uid");
                $data["group_type"]     = "profile";
                $data["account_id"]     = $account->id;
                $data["account_name"]   = $account->username;
                $data["group_id"]       = $group;
                $data["name"]           = $group;
                $data["privacy"]        = 0;
                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
                $data["caption"]        = $PostonHour;
                $data["deplay"]         = $deplay;
                $data["changed"]        = NOW;

                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
                if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
                    $data["status"] = (int)post('newstatus');
//                    }

                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//					$data["status"] = 1;
                }else{
                    $data["created"] = NOW;
                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
                }
                $count++;
            }
        }else{
            foreach ($groups as $key => $group) {
                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "comment"));
            }
        }

//        if(post("todo_follow")){
        if(post("todo_follow") == 'on'){

//            echo 1;
            $data = array();

            //------------------------//
            //Target
            $target = array();
            if(post("enable_tag")){ $target['tag'] = 1; }
            if(post("enable_location")){ $target['location'] = 1; }
            if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
            if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
            if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
            if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }

            //Tags
            $tags = post('tags');
            $locations = post('locations');
            $usernames = post('usernames');

            $data = array(
                "category"    => "follow",
                "type"        => "follow",
                "title"       => json_encode((array)$target),
                "description" => json_encode((array)$tags),
                "blacklists"  => json_encode($blacklists),
                "url"         => json_encode((array)$locations),
                "image"       => json_encode((array)$usernames),
                "filter"      => json_encode((array)$filter)
            );
            //-----------------------//

            if(post('time_post') == ""){
                $json[] = array(
                    "st"    => "valid",
                    "label" => "bg-red",
                    "text"  => l('Time post is required')
                );
            }

            $PostonHour = (int)post("repeat_follow");
            $repeat     = 60/$PostonHour*60;

            $data["speed"]       = (int)post("speed");
            $data["repeat_post"] = 1;
            $data["repeat_time"] = $repeat;
            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

            $deplay = (int)post('delay')*60;
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

            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
            $time_post = $date->format('Y-m-d H:i:s');
            foreach ($groups as $key => $group) {
                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
                $data["uid"]            = session("uid");
                $data["group_type"]     = "profile";
                $data["account_id"]     = $account->id;
                $data["account_name"]   = $account->username;
                $data["group_id"]       = $group;
                $data["name"]           = $group;
                $data["privacy"]        = 0;
                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
                $data["caption"]        = $PostonHour;
                $data["deplay"]         = $deplay;
                $data["changed"]        = NOW;

                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
                // pr($account->id,1);
                if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//					$data["status"] = 1;
//                    echo 2;
                    $data["status"] = (int)post('newstatus');
                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

                }else{
//                    echo 3;

                    $data["created"] = NOW;
                    // pr($data,1);
//                    print_r($data);
                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);

                }
                $count++;
            }
        }else{
            foreach ($groups as $key => $group) {
                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "follow"));

            }
        }

//        if(post("todo_like_follow")){
//
//            $data = array();
//
//            //------------------------//
//            //Target
//            $target = array();
//            if(post("enable_tag")){ $target['tag'] = 1; }
//            if(post("enable_location")){ $target['location'] = 1; }
//            if(post("enable_followers")){ $target['followers'] = (int)post("enable_followers"); }
//            if(post("enable_followings")){ $target['followings'] = (int)post("enable_followings"); }
//            if(post("enable_likers")){ $target['likers'] = (int)post("enable_likers"); }
//            if(post("enable_commenters")){ $target['commenters'] = (int)post("enable_commenters"); }
//
//            //Tags
//            $tags = post('tags');
//            $locations = post('locations');
//            $usernames = post('usernames');
//
//            $data = array(
//                "category"    => "like_follow",
//                "type"        => "like_follow",
//                "title"       => json_encode((array)$target),
//                "description" => json_encode((array)$tags),
//                "blacklists"  => json_encode($blacklists),
//                "url"         => json_encode((array)$locations),
//                "image"       => json_encode((array)$usernames),
//                "filter"      => json_encode((array)$filter)
//            );
//            //-----------------------//
//
//            if(post('time_post') == ""){
//                $json[] = array(
//                    "st"    => "valid",
//                    "label" => "bg-red",
//                    "text"  => l('Time post is required')
//                );
//            }
//
//            $PostonHour = (int)post("repeat_like_follow");
//            $repeat     = 60/$PostonHour*60;
//
//            $data["speed"]       = (int)post("speed");
//            $data["repeat_post"] = 1;
//            $data["repeat_time"] = $repeat;
//            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));
//
//            $deplay = (int)post('delay')*60;
//            $list_deplay = array();
//            for ($i=0; $i < count($groups); $i++) {
//                $list_deplay[] = $deplay*$i;
//            }
//
//            $auto_pause = (int)post('auto_pause');
//            if($auto_pause != 0){
//                $pause = 0;
//                $count_deplay = 0;
//                for ($i=0; $i < count($list_deplay); $i++) {
//                    $item_deplay = 1;
//                    if($auto_pause == $count_deplay){
//                        $pause += post('time_pause')*60;
//                        $count_deplay = 0;
//                    }
//
//                    $list_deplay[$i] += $pause;
//                    $count_deplay++;
//                }
//            }
//
//            shuffle($list_deplay);
//
//            $time_post_show = strtotime(post('time_post').":00");
//            $time_now  = strtotime(NOW) + 60;
//            if($time_post_show < $time_now){
//                $time_post_show = $time_now;
//            }
//
//            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
//            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
//            $time_post = $date->format('Y-m-d H:i:s');
//            foreach ($groups as $key => $group) {
//                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//                $data["uid"]            = session("uid");
//                $data["group_type"]     = "profile";
//                $data["account_id"]     = $account->id;
//                $data["account_name"]   = $account->username;
//                $data["group_id"]       = $group;
//                $data["name"]           = $group;
//                $data["privacy"]        = 0;
//                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
//                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
//                $data["caption"]        = $PostonHour;
//                $data["deplay"]         = $deplay;
//                $data["changed"]        = NOW;
//
//                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
//                if(!empty($check)){
////                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
////                        $data["status"] = 5;
////                    }else{
////                        $data["status"] = 3;
////                    }
////					$data["status"] = 1;
//                    $data["status"] = (int)post('newstatus');
//                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//
//                }else{
//                    $data["created"] = NOW;
//                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
//                }
//                $count++;
//            }
//        }else{
//            foreach ($groups as $key => $group) {
//                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "like_follow"));
//            }
//        }

//        if(post("todo_followback")){
//            $data = array();
//
//            //------------------------//
//            //Message
//            $messages = post('messages');
//
//            $data = array(
//                "category"    => "followback",
//                "type"        => "followback",
//                "message"     => json_encode((array)$messages),
//                "filter"      => json_encode((array)$filter)
//            );
//            //-----------------------//
//
//            if(post('time_post') == ""){
//                $json[] = array(
//                    "st"    => "valid",
//                    "label" => "bg-red",
//                    "text"  => l('Time post is required')
//                );
//            }
//
//            $PostonHour = (int)post("repeat_followback");
//            $repeat     = 60/$PostonHour*60;
//
//            $data["speed"]       = (int)post("speed");
//            $data["repeat_post"] = 1;
//            $data["repeat_time"] = $repeat;
//            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));
//
//            $deplay = (int)post('delay')*60;
//            $list_deplay = array();
//            for ($i=0; $i < count($groups); $i++) {
//                $list_deplay[] = $deplay*$i;
//            }
//
//            $auto_pause = (int)post('auto_pause');
//            if($auto_pause != 0){
//                $pause = 0;
//                $count_deplay = 0;
//                for ($i=0; $i < count($list_deplay); $i++) {
//                    $item_deplay = 1;
//                    if($auto_pause == $count_deplay){
//                        $pause += post('time_pause')*60;
//                        $count_deplay = 0;
//                    }
//
//                    $list_deplay[$i] += $pause;
//                    $count_deplay++;
//                }
//            }
//
//            shuffle($list_deplay);
//
//            $time_post_show = strtotime(post('time_post').":00");
//            $time_now  = strtotime(NOW) + 60;
//            if($time_post_show < $time_now){
//                $time_post_show = $time_now;
//            }
//
//            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
//            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
//            $time_post = $date->format('Y-m-d H:i:s');
//            foreach ($groups as $key => $group) {
//                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//                $data["uid"]            = session("uid");
//                $data["group_type"]     = "profile";
//                $data["account_id"]     = $account->id;
//                $data["account_name"]   = $account->username;
//                $data["group_id"]       = $group;
//                $data["name"]           = $group;
//                $data["privacy"]        = 0;
//                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
//                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
//                $data["caption"]        = $PostonHour;
//                $data["deplay"]         = $deplay;
//                $data["changed"]        = NOW;
//
//                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
//                if(!empty($check)){
////                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
////                        $data["status"] = 5;
////                    }else{
////                        $data["status"] = 3;
////                    }
//                    $data["status"] = (int)post('newstatus');
////					$data["status"] = 1;
//                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//
//                }else{
//                    $data["created"] = NOW;
//                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
//                }
//                $count++;
//            }
//        }else{
//            foreach ($groups as $key => $group) {
//                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "followback"));
//            }
//        }

        if(post("todo_unfollow")){
            $data = array();

            //------------------------//
            $data = array(
                "category"    => "unfollow",
                "type"        => "unfollow",
                "filter"      => json_encode((array)$filter)
            );
            //-----------------------//

            if(post('time_post') == ""){
                $json[] = array(
                    "st"    => "valid",
                    "label" => "bg-red",
                    "text"  => l('Time post is required')
                );
            }

            $PostonHour = (int)post("repeat_unfollow");
            $repeat     = 60/$PostonHour*60;

            $data["speed"]       = (int)post("speed");
            $data["repeat_post"] = 1;
            $data["repeat_time"] = $repeat;
            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));

            $deplay = (int)post('delay')*60;
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

            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
            $time_post = $date->format('Y-m-d H:i:s');
            foreach ($groups as $key => $group) {
                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
                $data["uid"]            = session("uid");
                $data["group_type"]     = "profile";
                $data["account_id"]     = $account->id;
                $data["account_name"]   = $account->username;
                $data["group_id"]       = $group;
                $data["name"]           = $group;
                $data["privacy"]        = 0;
                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
                $data["caption"]        = $PostonHour;
                $data["deplay"]         = $deplay;
                $data["changed"]        = NOW;

                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
                if(!empty($check)){
//                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
//                        $data["status"] = 5;
//                    }else{
//                        $data["status"] = 3;
//                    }
//					$data["status"] = 1;
                    $data["status"] = (int)post('newstatus');
                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));

                }else{
                    $data["created"] = NOW;
                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
                }
                $count++;
            }
        }else{
            foreach ($groups as $key => $group) {
                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "unfollow"));
            }
        }

//        if(post("todo_repost")){
//            $data = array();
//
//            //------------------------//
//            //Target
//            $target = array();
//            switch ((int)post("todo_repost")) {
//                case 1:
//                    $target['tag'] = 1;
//                    break;
//
//                case 2:
//                    $target['location'] = 1;
//                    break;
//
//                case 3:
//                    $target['username'] = 1;
//                    break;
//
//                case 4:
//                    $target['tag'] = 1;
//                    $target['location'] = 1;
//                    $target['username'] = 1;
//                    break;
//            }
//
//
//            //Tags
//            $tags = post('tags');
//            $locations = post('locations');
//            $usernames = post('usernames');
//
//            $data = array(
//                "category"    => "repost",
//                "type"        => "repost",
//                "title"       => json_encode((array)$target),
//                "description" => json_encode((array)$tags),
//                "blacklists"  => json_encode($blacklists),
//                "url"         => json_encode((array)$locations),
//                "image"       => json_encode((array)$usernames),
//                "filter"      => json_encode((array)$filter)
//            );
//            //-----------------------//
//
//            if(post('time_post') == ""){
//                $json[] = array(
//                    "st"    => "valid",
//                    "label" => "bg-red",
//                    "text"  => l('Time post is required')
//                );
//            }
//
//            $PostonHour = (int)post("repeat_repost");
//            $repeat     = 60/$PostonHour*60;
//
//            $data["speed"]       = (int)post("speed");
//            $data["repeat_post"] = 1;
//            $data["repeat_time"] = $repeat;
//            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));
//
//            $deplay = (int)post('delay')*60;
//            $list_deplay = array();
//            for ($i=0; $i < count($groups); $i++) {
//                $list_deplay[] = $deplay*$i;
//            }
//
//            $auto_pause = (int)post('auto_pause');
//            if($auto_pause != 0){
//                $pause = 0;
//                $count_deplay = 0;
//                for ($i=0; $i < count($list_deplay); $i++) {
//                    $item_deplay = 1;
//                    if($auto_pause == $count_deplay){
//                        $pause += post('time_pause')*60;
//                        $count_deplay = 0;
//                    }
//
//                    $list_deplay[$i] += $pause;
//                    $count_deplay++;
//                }
//            }
//
//            shuffle($list_deplay);
//
//            $time_post_show = strtotime(post('time_post').":00");
//            $time_now  = strtotime(NOW) + 60;
//            if($time_post_show < $time_now){
//                $time_post_show = $time_now;
//            }
//
//            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
//            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
//            $time_post = $date->format('Y-m-d H:i:s');
//            foreach ($groups as $key => $group) {
//                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//                $data["uid"]            = session("uid");
//                $data["group_type"]     = "profile";
//                $data["account_id"]     = $account->id;
//                $data["account_name"]   = $account->username;
//                $data["group_id"]       = $group;
//                $data["name"]           = $group;
//                $data["privacy"]        = 0;
//                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
//                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
//                $data["caption"]        = $PostonHour;
//                $data["deplay"]         = $deplay;
//                $data["changed"]        = NOW;
//
//                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
//                if(!empty($check)){
////                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
////                        $data["status"] = 5;
////                    }else{
////                        $data["status"] = 3;
////                    }
////                    $data["status"] = 1;
//                    $data["status"] = (int)post('newstatus');
//                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//
//                }else{
//                    $data["created"] = NOW;
//                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
//                }
//                $count++;
//            }
//        }else{
//            foreach ($groups as $key => $group) {
//                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "repost"));
//            }
//        }

//        if(post("todo_deletemedia")){
//            $data = array();
//
//            //------------------------//
//            //Target
//            $target = array();
//
//            //Tags
//            $tags = post('tags');
//            $locations = post('locations');
//
//            $data = array(
//                "category"    => "deletemedia",
//                "type"        => "deletemedia",
//                "title"       => json_encode((array)$target),
//                "filter"      => json_encode((array)$filter)
//            );
//            //-----------------------//
//
//            if(post('time_post') == ""){
//                $json[] = array(
//                    "st"    => "valid",
//                    "label" => "bg-red",
//                    "text"  => l('Time post is required')
//                );
//            }
//
//            $PostonHour = (int)post("repeat_deletemedia");
//            $repeat     = 60/$PostonHour*60;
//
//            $data["speed"]       = (int)post("speed");
//            $data["repeat_post"] = 1;
//            $data["repeat_time"] = $repeat;
//            $data["repeat_end"]  = date("Y-m-d", strtotime("2025-01-01"));
//
//            $deplay = (int)post('delay')*60;
//            $list_deplay = array();
//            for ($i=0; $i < count($groups); $i++) {
//                $list_deplay[] = $deplay*$i;
//            }
//
//            $auto_pause = (int)post('auto_pause');
//            if($auto_pause != 0){
//                $pause = 0;
//                $count_deplay = 0;
//                for ($i=0; $i < count($list_deplay); $i++) {
//                    $item_deplay = 1;
//                    if($auto_pause == $count_deplay){
//                        $pause += post('time_pause')*60;
//                        $count_deplay = 0;
//                    }
//
//                    $list_deplay[$i] += $pause;
//                    $count_deplay++;
//                }
//            }
//
//            shuffle($list_deplay);
//
//            $time_post_show = strtotime(post('time_post').":00");
//            $time_now  = strtotime(NOW) + 60;
//            if($time_post_show < $time_now){
//                $time_post_show = $time_now;
//            }
//
//            $date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_USER));
//            $date->setTimezone(new DateTimeZone(TIMEZONE_SYSTEM));
//            $time_post = $date->format('Y-m-d H:i:s');
//            foreach ($groups as $key => $group) {
//                $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//                $data["uid"]            = session("uid");
//                $data["group_type"]     = "profile";
//                $data["account_id"]     = $account->id;
//                $data["account_name"]   = $account->username;
//                $data["group_id"]       = $group;
//                $data["name"]           = $group;
//                $data["privacy"]        = 0;
//                $data["time_post"]      = date("Y-m-d H:i:s", $time_now + $list_deplay[$key]);
//                $data["time_post_show"] = date("Y-m-d H:i:s", strtotime($time_post) + $list_deplay[$key]);
//                $data["caption"]        = $PostonHour;
//                $data["deplay"]         = $deplay;
//                $data["changed"]        = NOW;
//
//                $check = $this->model->get("*", INSTAGRAM_SCHEDULES, "account_id = '".$account->id."' AND category = '".$data['category']."'");
//                if(!empty($check)){
//
//                    $data["status"] = (int)post('newstatus');
////                        $data["status"] = 1;
////                    if(post('newstatus') == 3 || post('newstatus') == 1 ){
////                        $data["status"] = 5;
////                    }else{
////                        $data["status"] = 3;
////                    }
//                    $this->db->update(INSTAGRAM_SCHEDULES, $data, array("id" => $check->id));
//
//                }else{
//                    $data["created"] = NOW;
//                    $this->db->insert(INSTAGRAM_SCHEDULES, $data);
//                }
//                $count++;
//            }
//        }else{
//            foreach ($groups as $key => $group) {
//                $this->db->delete(INSTAGRAM_SCHEDULES, array("account_id" => $group, "category" => "deletemedia"));
//            }
//        }

        //-----------Save Activity-------------//
        //Target
        $todo = array(
            'like' => post("todo_like")?1:0,
            'comment'  => post("todo_comment")?1:0,
            'follow'  => post("todo_follow")?1:0,
            'like_follow'  => post("todo_like_follow")?1:0,
            'followback'  => post("todo_followback")?1:0,
            'unfollow'  => post("todo_unfollow")?1:0,
            'repost'  => (int)post("todo_repost"),
            'deletemedia'  => post("todo_deletemedia")?1:0,
        );
        $unfollow = array();

        $unfollow = array(
            "unfollow_source" => post("enable_unfollow_source"),
            "unfollow_followers"  => post("enable_unfollow_followers")?1:0,
            "unfollow_follow_age"  	=> post("unfollow_follow_age"),
        );





        //Target
        $targets = array(
            'tag'        => post("enable_tag")?1:0,
            'location'   => post("enable_location")?1:0,
            'followers'  => (int)post("enable_followers"),
            'followings' => (int)post("enable_followings"),
            'likers'     => (int)post("enable_likers"),
            'commenters' => (int)post("enable_commenters"),
            'unfollow'   => json_encode($unfollow),
        );

        //Tags
        $tags = post('tags');
        $locations = post('locations');
        $usernames = post('usernames');
        $comments = post('comments');
        $messages = post('messages');

        //Speed
        $speed = array(
            "repost" => (int)post("repeat_repost"),
            "like" => (int)post("repeat_like"),
            "comment" => (int)post("repeat_comment"),
            "deletemedia" => (int)post("repeat_deletemedia"),
            "follow" => (int)post("repeat_follow"),
            "like_follow" => (int)post("repeat_like_follow"),
            "followback" => (int)post("repeat_followback"),
            "unfollow" => (int)post("repeat_unfollow"),
            "delay" => (int)post("delay"),
            "type" => (int)post("speed"),
        );

        $data_activity = array(
            "todo" => json_encode($todo),
            "targets" => json_encode($targets),
            "speed" => json_encode($speed),
            "tags" => json_encode($tags),
            "usernames" => json_encode($usernames),
            "locations" => json_encode($locations),
            "comments" => json_encode($comments),
            "messages" => json_encode($messages),
            "filter" => json_encode((array)$filter)
        );


        //-----------Save Activity-------------//
        foreach ($groups as $key => $group) {
            $account = $this->model->get("*", INSTAGRAM_ACCOUNTS, "id = '".$group."'".getDatabyUser());
//			if(post('newstatus') == 3 || post('newstatus') == 1){
            $activity = array(
                "uid" 			=> session("uid"),
                "account_id" 	=> $account->id,
                "account_name" 	=> $account->username,
                "data" 			=> json_encode($data_activity),
                "blacklists" 	=> json_encode($blacklists),
                "status" 		=> (int)post('newstatus'),
                "created" 		=> NOW
            );
//            }else{
//                $activity = array(
//                    "uid" 			=> session("uid"),
//                    "account_id" 	=> $account->id,
//                    "account_name" 	=> $account->username,
//                    "data" 			=> json_encode($data_activity),
//                    "blacklists" 	=> json_encode($blacklists),
//                    "status" 		=> 3,
//                    "created" 		=> NOW
//                );
//            }


            $check = $this->model->get("*", INSTAGRAM_ACTIVITY, "account_id = '".$account->id."'".getDatabyUser());

            $activityID = $check->id;
            if(!empty($check)){

                $this->db->update(INSTAGRAM_ACTIVITY, $activity, array("id" => $check->id));
            }else{
                $activityID = $this->db->insert(INSTAGRAM_ACTIVITY, $activity);
            }

            //Enable activity
//            $this->ajax_enable_activity ($activityID, 0);

        }
        ms(array(
            "st"    => "success",
//			"label" => "bg-green",
            "label" => "bg-dashboard-primary",
            "txt"   => l('Saved!')
        ));
    }
}

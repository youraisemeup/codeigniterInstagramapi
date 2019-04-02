<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class settings extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
		permission_view(true);
	}

	public function index(){

		$id   = (int)get("id");
		$list_lang = scandir(APPPATH."../lang/");
		unset($list_lang[0]);
		unset($list_lang[1]);
		$data_lang = array();
		foreach ($list_lang as $lang) {
			$arr_lang = explode(".", $lang);
			if(count($arr_lang) == 2 && strlen($arr_lang[0]) == 2 && $arr_lang[1] == "xml"){
				$data_lang[] = $arr_lang[0];
			}
		}

		$data = array(
			"result" => $this->model->get("*", SETTINGS),
			"lang"   => $data_lang,
		);


		if(post('website_title')){
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

			//Target
			$target = array(
				'tag' => post("enable_tag")?1:0,
				'location'  => post("enable_location")?1:0,
				'followers'  => (int)post("enable_followers"),
				'followings'  => (int)post("enable_followings"),
				'likers'  => (int)post("enable_likers"),
				'commenters'  => (int)post("enable_commenters"),
			);

			//Tags
			$tags = post('tags');
			$locations = post('locations');
			$usernames = post('usernames');
			$comments = post('comments');
			$messages = post('messages');

			// blacklists

			$blacklist_tags = post("blacklist_tags");
			$blacklist_usernames = post("blacklist_usernames");
			$blacklist_keywords = post("blacklist_keywords");
			$blacklists = array(
				"bl_tags" 		=> json_encode($blacklist_tags),
				"bl_usernames" 	=> json_encode($blacklist_usernames),
				"bl_keywords" 	=> json_encode($blacklist_keywords),
			);

			// Proxy Default
			$proxy_default_igaccount = post("proxy_default_igaccount");
			$proxy_default = array(
				"proxy_default_igaccount" => json_encode($proxy_default_igaccount),
			);
			//Slow
			$slow = array(
				"repost" => (int)post("slow_repost"),
				"like" => (int)post("slow_like"),
				"comment" => (int)post("slow_comment"),
				"deletemedia" => (int)post("slow_deletemedia"),
        		"follow" => (int)post("slow_follow"),
				"like_follow" => (int)post("slow_like_follow"),
				"followback" => (int)post("slow_followback"),
				"unfollow" => (int)post("slow_unfollow"),
				"delay" => (int)post("slow_delay"),
			);

			//Medium
			$medium = array(
				"repost" => (int)post("medium_repost"),
				"like" => (int)post("medium_like"),
				"comment" => (int)post("medium_comment"),
				"deletemedia" => (int)post("medium_deletemedia"),
        		"follow" => (int)post("medium_follow"),
				"like_follow" => (int)post("medium_like_follow"),
				"followback" => (int)post("medium_followback"),
				"unfollow" => (int)post("medium_unfollow"),
				"delay" => (int)post("medium_delay"),
			);

			//Fast
			$fast = array(
				"repost" => (int)post("fast_repost"),
				"like" => (int)post("fast_like"),
				"comment" => (int)post("fast_comment"),
				"deletemedia" => (int)post("fast_deletemedia"),
        		"follow" => (int)post("fast_follow"),
				"like_follow" => (int)post("fast_like_follow"),
				"followback" => (int)post("fast_followback"),
				"unfollow" => (int)post("fast_unfollow"),
				"delay" => (int)post("fast_delay"),
			);

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


			$schedule_default = array(
				"todo"      => json_encode($todo),
				"target"    => json_encode($target),
				"tags"      => json_encode($tags),
				"locations" => json_encode($locations),
				"comments"  => json_encode($comments),
				"messages"  => json_encode($messages),
				"slow"      => json_encode($slow),
				"medium"    => json_encode($medium),
				"fast"      => json_encode($fast),
				"speed"     => post("speed"),
				"filter"    => json_encode($filter)
			);

			$data = array(
				"website_title"            => post('website_title'),
				"website_description"      => post('website_description'),
				"website_keyword"          => post('website_keyword'),
				"theme_color"              => post('theme_color'),
				"timezone"                 => post('timezone'),
				"register"                 => (int)post('register'),
				"auto_active_user"         => (int)post('auto_active_user'),
				"upload_max_size"          => (int)post('upload_max_size'),
				"default_language"         => post('default_language'),
				"schedule_default"         => json_encode($schedule_default),
				"blacklists_default"       => json_encode($blacklists),
				"default_deplay"           => post('default_deplay'),
				"minimum_deplay"           => (int)post('minimum_deplay'),
				"default_deplay_post_now"  => (int)post('default_deplay_post_now'),
				"minimum_deplay_post_now"  => (int)post('minimum_deplay_post_now'),
				"proxy_default"  		   => json_encode($proxy_default),
				"purchase_code"            => post('purchase_code'),
				"facebook_id"              => post('facebook_id'),
				"facebook_secret"          => post('facebook_secret'),
				"google_api_key"           => post('google_api_key'),
				"google_id"                => post('google_id'),
				"google_secret"            => post('google_secret'),
				"twitter_id"               => post('twitter_id'),
				"twitter_secret"           => post('twitter_secret'),
				"facebook_page"            => post('facebook_page'),
				"twitter_page"             => post('twitter_page'),
				"pinterest_page"           => post('pinterest_page'),
				"instagram_page"           => post('instagram_page'),
				"mail_type"                => (int)post('mail_type'),
				"mail_from_name"           => post('mail_from_name'),
				"mail_from_email"          => post('mail_from_email'),
				"mail_smtp_host"           => post('mail_smtp_host'),
				"mail_smtp_user"           => post('mail_smtp_user'),
				"mail_smtp_pass"           => post('mail_smtp_pass'),
				"mail_smtp_port"           => post('mail_smtp_port'),
                "commission_percentage"    => empty(post('commission_percentage')) ? 0 : (post('commission_percentage') > 100 ? 100 : post('commission_percentage')),
            );

			foreach ($_FILES as $key => $value) {
			    if (!empty($value['tmp_name']) && $value['size'] > 0) {
			    	$this->load->library('upload');
			    	if($key == "language"){
			    		$config['upload_path'] = "./lang/";
					    $config['allowed_types'] = 'xml';
					    $config['remove_spaces'] = TRUE;
				    	$this->upload->initialize($config);
				    	if ($this->upload->do_upload($key)) {}
			    	}else{
			    		$path = "./assets/images/";
			    		$config['upload_path'] = $path;
					    $config['allowed_types'] = 'jpg|png';
					    $config['remove_spaces'] = TRUE;
				    	$this->upload->initialize($config);
				    	if ($this->upload->do_upload($key)) {
			            	$data_file = $this->upload->data();
		    				$data["logo"] = str_replace("./", "", $path.$data_file["file_name"]);
			        	}
			    	}
			    }
			}

			$this->db->update(SETTINGS, $data);
		    redirect(PATH."settings");
		}

		$this->template->title(l('Settings'));
		$this->template->build('index', $data);
	}

	public function ajax_update(){
		$id = (int)post("id");

		if(post("website_title") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Website title is required')
			));
		}

		if(post("public_key") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Public key is required')
			));
		}

		if(post("secret_key") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Secret key is required')
			));
		}

		if(post("currency") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Currency is required')
			));
		}

		$data = array(
			"paypal_email" => post("paypal_email"),
			"public_key"   => post("public_key"),
			"secret_key"   => post("secret_key"),
			"currency"     => post("currency")
		);

		$this->db->update(SETTINGS, $data, array("id" => $id));

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}
}

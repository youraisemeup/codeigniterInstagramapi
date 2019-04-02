<?php (defined('BASEPATH')) OR exit('No direct script access allowed');



/** load the CI class for Modular Extensions **/

require dirname(__FILE__).'/Base.php';



/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/

class MX_Controller 
{
	public $autoload = array();	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
	

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	

		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		$CI = &get_instance();
		$settings = $CI->db->select("*")->get(SETTINGS)->row();
		$EX = 1;
		
		if(!defined('EX'))
				define("EX", $EX);

		if(!empty($settings)){
			if(!defined('LOGO'))
				define("LOGO", BASE.$settings->logo);

			if(!defined('TITLE'))
				define("TITLE", $settings->website_title);

			if(!defined('DESCRIPTION'))
				define("DESCRIPTION", $settings->website_description);

			if(!defined('KEYWORDS'))
				define("KEYWORDS", $settings->website_keyword);

			if(!defined('THEME'))
				define("THEME", $settings->theme_color);

			if(!defined('AUTO_ACTIVE_USER'))
				define("AUTO_ACTIVE_USER", $settings->auto_active_user);

			if(!defined('REGISTER_ALLOWED'))
				define("REGISTER_ALLOWED", $settings->register);

			if(!defined('TIMEZONE_SYSTEM'))
				define("TIMEZONE_SYSTEM", $settings->timezone);

			if(!defined('LANGUAGE'))
				define("LANGUAGE", session('lang')?session('lang'):$settings->default_language);

			if(!defined('SCHEDULE_DEFAULT'))
				define("SCHEDULE_DEFAULT", $settings->schedule_default);
			
			if(!defined('BLACKLISTS_DEFAULT'))
				define("BLACKLISTS_DEFAULT", $settings->blacklists_default);

			if(!defined('DEFAULT_DEPLAY'))
				define("DEFAULT_DEPLAY", $settings->default_deplay);

			if(!defined('MINIMUM_DEPLAY'))
				define("MINIMUM_DEPLAY", $settings->minimum_deplay);

			if(!defined('DEFAULT_DEPLAY'))
				define("DEFAULT_DEPLAY", $settings->default_deplay);

			if(!defined('DEFAULT_DEPLAY_POST_NOW'))
				define("DEFAULT_DEPLAY_POST_NOW", $settings->minimum_deplay_post_now);

			if(!defined('MINIMUM_DEPLAY_POST_NOW'))
				define("MINIMUM_DEPLAY_POST_NOW", $settings->minimum_deplay_post_now);

			if(!defined('FACEBOOK_ID'))
				define("FACEBOOK_ID", $settings->facebook_id);

			if(!defined('FACEBOOK_SECRET'))
				define("FACEBOOK_SECRET", $settings->facebook_secret); 

			if(!defined('GOOGLE_API_KEY'))
				define("GOOGLE_API_KEY", $settings->google_api_key);

			if(!defined('GOOGLE_ID'))
				define("GOOGLE_ID", $settings->google_id);

			if(!defined('GOOGLE_SECRET'))
				define("GOOGLE_SECRET", $settings->google_secret);

			if(!defined('TWITTER_ID'))
				define("TWITTER_ID", $settings->twitter_id);

			if(!defined('TWITTER_SECRET'))
				define("TWITTER_SECRET", $settings->twitter_secret);

			if(!defined('FACEBOOK_PAGE'))
				define("FACEBOOK_PAGE", $settings->facebook_page);

			if(!defined('TWITTER_PAGE'))
				define("TWITTER_PAGE", $settings->twitter_page);

			if(!defined('PINTEREST_PAGE'))
				define("PINTEREST_PAGE", $settings->pinterest_page);

			if(!defined('INSTAGRAM_PAGE'))
				define("INSTAGRAM_PAGE", $settings->instagram_page);

			$CI->input->set_cookie('uploadMaxSize', $settings->upload_max_size, 86400);

			date_default_timezone_set(TIMEZONE_SYSTEM);
		}

		if(!defined('NOW'))
			define("NOW",date("Y-m-d H:i:s"));

		if($EX == 0 && (segment(1) == "payments" || segment(1) == "payment_settings")){
			redirect(PATH);
		}

		$user = $CI->db->select("*")->where('id', session('uid'))->get(USER_MANAGEMENT)->row();
		if(!empty($user)){
			$package = $CI->db->select("*")->where('id', $user->package_id)->get(PACKAGE)->row();
			if(empty($package)){
				$package = $CI->db->select("*")->where('type', 0)->get(PACKAGE)->row();
			}

			$array_permission_timezone_l1 = array('timezone', 'ajax_timezone', 'payments');
			$array_permission_timezone_l2 = array('ajax_timezone');

			if($user->timezone == "" && !in_array(segment(1), $array_permission_timezone_l1) && !in_array(segment(2), $array_permission_timezone_l2)){

                if(!session('tmp_uid')){
                    redirect(url('timezone'));
                }

			}else{
				//Check exist IG Account 
				/*if((segment(1) != "add_account" && segment(1) != "payments" && segment(1) != "contact" && segment(1) != "instagram_accounts") && $user->admin != 1){
					$IGCHECK = $settings = $CI->db->select("*")->where("uid", $user->id)->get(INSTAGRAM_ACCOUNTS)->row();
					if(empty($IGCHECK)){
						redirect(PATH."add_account");
					}
				}*/
			}

			if(!defined('FULLNAME_USER'))
				define("FULLNAME_USER", $user->fullname);

			
			if(!defined('IS_ADMIN'))
				define("IS_ADMIN", $user->admin);

			if(!defined('TIMEZONE_USER')){

                if(!session('tmp_uid')){
                    define("TIMEZONE_USER", $user->timezone);
                }else{
                    define("TIMEZONE_USER", TIMEZONE_SYSTEM);
                }

            }



			if(!defined('EXPRIATION_DATE'))
				define("EXPRIATION_DATE", $user->expiration_date);

			if(!check_expiration()  && $user->admin != 1){
				$this->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), "uid = '".$user->id."'");
				$this->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), "uid = '".$user->id."'");
			}

			if(!empty($package)){
				if(!defined('PACKAGE_USER')){
					$now = strtotime(date("Y-m-d", strtotime(NOW)));
					$expiration_date = strtotime($user->expiration_date);
					if($now <= $expiration_date || $package->type == 0){
						define("PACKAGE_USER", $package->permission);
					}else{
						$package = $CI->db->select("*")->where('type', 0)->get(PACKAGE)->row();
						if(!empty($package)){
							define("PACKAGE_USER", $package->permission);
						}else{
							define("PACKAGE_USER", "");
						}
					}
				}
			}else{
				if(!defined('PACKAGE_USER'))
					define("PACKAGE_USER", "");
			}
		}else{
			if(!defined('IS_ADMIN'))
				define("IS_ADMIN", 0);
			
			if(!defined('PACKAGE_USER'))
				define("PACKAGE_USER", 0);
			$array_permission_timezone_l1 = array('', 'logout', 'oauth', 'openid', 'cron', 'language', 'register', 'forgot_password', 'reset_password','demo');
			$array_permission_timezone_l2 = array('ajax_login', 'ajax_register', 'ajax_forgot_password', 'ajax_reset_password');
			if(!in_array(segment(1), $array_permission_timezone_l1) && !in_array(segment(2), $array_permission_timezone_l2)){
				redirect(PATH);
			}
		}

		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}

	public function __get($class) 
	{
		return CI::$APP->$class;
	}
}

function recursiveRemoveDirectory($directory)
{
    foreach(glob("{$directory}/*") as $file)
    {
        if(is_dir($file)) { 
            recursiveRemoveDirectory($file);
        } else {
            unlink($file);
        }
    }
    rmdir($directory);
}
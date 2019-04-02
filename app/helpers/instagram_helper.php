<?php


if(!function_exists("get_setting")){

    function get_setting($key, $value = "", $account_id, $field){

        $CI = &get_instance();

        $setting = $CI->model->get($field, INSTAGRAM_ACCOUNTS, " id = {$account_id}")->$field;

        $option = json_decode($setting);

        if(is_array($option) || is_object($option)){

            $option = (array)$option;

            if( isset($option[$key]) ){

                return row($option, $key);

            }else{

                $option[$key] = $value;

                $CI->db->update(INSTAGRAM_ACCOUNTS, array($field => json_encode($option)), array("id" => $account_id) );

                return $value;

            }

        }else{

            $option = json_encode(array($key => $value));

            $CI->db->update(INSTAGRAM_ACCOUNTS, array($field => $option),array("id" => $account_id));

            return $value;
        }
    }
}


if(!function_exists("update_setting")){

    function update_setting($key, $value, $account_id, $field = 'logs_counter'){

        $CI = &get_instance();

        $setting = $CI->model->get($field, INSTAGRAM_ACCOUNTS, "id = {$account_id}")->$field;

        $option = json_decode($setting);

        if(is_array($option) || is_object($option)){

            $option = (array)$option;

            if( isset($option[$key]) ){

                $option[$key] = $value;

                $CI->db->update(INSTAGRAM_ACCOUNTS, array($field => json_encode($option)), array("id" => $account_id) );

                return true;

            }

        }

        return false;

    }

}


if(!function_exists("row")){

    function row($data, $field){

        if(is_object($data)){

            if(isset($data->$field)){

                return $data->$field;

            }else{

                return "";

            }

        }

        if(is_array($data)){

            if(isset($data[$field])){

                return $data[$field];

            }else{

                return "";

            }

        }

    }

}


if(!function_exists("update_followed_iguser")){

    function update_followed_iguser($data=array()){

        if($data["type"]=="follow"||$data["type"]=="followback"||$data["type"]=="like_follow"){

            // add followed user

            get_setting($data["key"],strtotime(NOW), $data["account_id"],"followed_username");

        }

        // Increase counter

        $n = get_setting($data["type"], 0, $data["account_id"],"logs_counter") + 1;

        update_setting($data["type"],$n,$data["account_id"],"logs_counter");

    }

}

/**

* Compare strtotime

*/

class LowerThanFilter{

    private $limit;

    function __construct($limit){

        $this->limit = $limit;

    }

    function isLower($i){

        return $i <= $this->limit;

    }

}


if (!function_exists('divisible_cronjob')) {

    function divisible_cronjob($category='',$segment){

        $CI = &get_instance();

        $data_schedule = $CI->model->fetch("*",INSTAGRAM_SCHEDULES,"`category` ='".$category."' AND `time_post` <='".NOW."' AND `status`=5");
		if($category == 'like'){
			$l = 30;
			$json_file = 'likes_limit.json'; 
		}else if($category == 'like_follow'){
			$json_file = 'like_follow_limit.json';
			$l = 30;
		}else if($category == 'follow'){
			$json_file = 'follow_limit.json';
			$l = 30;
		}else if($category == 'followback'){ 
			$json_file = 'followback_limit.json';
			$l = 30;
		}else if($category == 'comment'){
			$json_file = 'comment_limit.json';
			$l = 30;
		}else if($category == 'unfollow'){
			$json_file = 'unfollow_limit.json';
			$l = 30;
		}
		
		$limit = file_get_contents(__DIR__ . "/".$json_file);
		$limit_array = json_decode($limit, true);
		
		$total_res = count($data_schedule);
		//echo $total_res;
		
		$start = $limit_array['start'];
		$end   = $limit_array['end'];
		if($end >= $total_res){
			$new_limit = array("start"=>0,"end"=>$l);
		}else{ 
			$new_limit = array("start"=>$end,"end"=>$end+$l);
		}
		//print_r($new_limit);die;
		file_put_contents(__DIR__ . "/".$json_file, json_encode($new_limit));
		return $result = array(

			"limit_per_page"    => $l,

			"start_index"       => $start,

		); 



        return false;

    }

}

if (!function_exists('divisible_cronjob_schedule')) {

    function divisible_cronjob_schedule($category=''){

        $CI = &get_instance();

        $data_schedule = $CI->model->fetch("*",INSTAGRAM_SCHEDULES,"`category` ='".$category."' AND `time_post` <='".NOW."' AND `status`=5");
		
		$total_res = count($data_schedule);
		return $total_res;
		
		
    }

}





function hashcheck(){

    if(EX == 1){

        return false;

    }else{

        return true;

    }

}



function file_get_contents_curl($url) {

    $ch = curl_init();



    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);

    curl_setopt($ch, CURLOPT_HEADER, 0);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    $data = curl_exec($ch);

    curl_close($ch);



    return $data;

}



function removeFeedVideo($result){

    if(!empty($result)){

        foreach ($result as $key => $row) {

            if($row->getMediaType() != 1){

                unset($result[$key]);

                continue;

            }

        }

        return array_values($result);

    }

}



function removeFeedPrivate($result){

    if(!empty($result)){

        foreach ($result as $key => $row) {

            if(null !== $row->getUser() && $row->getUser()->getIsPrivate() == 1){

                unset($result[$key]);

                continue;

            }

        }
		
        return array_values($result);

    }

}

 

function removePrivateUser($result){

    if(!empty($result) and count($result) > 0 ){
		
        foreach ($result as $key => $row) { 

            if($row->getIsPrivate() == 1){

                unset($result[$key]);
 
                continue;

            }

        } 
		
        return $result;

    }

}



function removePrivateUserComments($result){

    if(!empty($result)){

        foreach ($result as $key => $row) {

            if($row->getUser()->getIsPrivate() == 1){

                unset($result[$key]);

                continue;

            }

        }

        return array_values($result);

    }

}



function removeFeedBlackLists($feeds,$bl_tags,$bl_usernames,$bl_keywords){

    foreach ($feeds as $key => $row) {

        $check_tags=false;

        $check_usernames=false;

        $check_keywords=false;
		
		if('InstagramAPI\Response\Model\Comment' == get_class($row)){
			if(!empty($row->getPreviewChildComments())&&is_array($row->getPreviewChildComments())) {

				if(!empty($row->getPreviewChildComments()[0])){

					$preview_comments_1 = $row->getPreviewChildComments()[0];

					$preview_comments_1 = strtolower($preview_comments_1->getText());

					if(!empty($row->getPreviewChildComments()[1])){

						$preview_comments_2 = $row->getPreviewChildComments()[1];

						$preview_comments_2 = strtolower($preview_comments_2->getText());

						$preview_comments = $preview_comments_1.' '.$preview_comments_2;

					}

				}

			}
		}
		
        $caption_text="";
		if(!empty($row->getCaption())){
			 if(!empty($row->getCaption()->getText())){

				$caption_text = strtolower($row->getCaption()->getText());

			}
		}
       
		
        if(isset($preview_comments)){

            $caption_text.=' '.$preview_comments;

            $caption_hashtags=getDataFromString($caption_text,$target="hashtags");

        }

        if (!empty($row->getUser())) {

            $blist_usernames = $row->getUser();

            $blist_usernames = strtolower($blist_usernames->getUsername());

        }

 
        

        if(!empty($caption_text)){

            $caption_usernames=getDataFromString($caption_text,$target="usernames");

            $caption_usernames[]="@".$blist_usernames;

            $caption_usernames = array_count_values($caption_usernames);

            $caption_usernames = array_keys($caption_usernames);

        }

        if (!empty($bl_tags)&&is_array($bl_tags)&&!empty($caption_hashtags)&&is_array($caption_hashtags)) {

            if ($check_usernames==false&&$check_keywords==false) {

                foreach ($bl_tags as $pattern) {

                    $pattern  = trim($pattern);

                    $pattern  = "#".$pattern;

                    foreach ($caption_hashtags as $val) {

                        if ($pattern==$val) {

                            $check_tags=true;

                            break;

                        }

                    }

                    if ($check_tags) {

                        break;

                    }

                }

            }

        }

        // usernames

        if(!empty($bl_usernames)&&is_array($bl_usernames)&&!empty($caption_usernames)&&is_array($caption_usernames)){

            if ($check_tags==false&&$check_keywords==false) {

                foreach ($bl_usernames as $pattern) {

                    $pattern  = trim($pattern);

                    $pattern  = "@".$pattern;

                    foreach ($caption_usernames as $val) {

                        if ($pattern==$val) {

                            $check_usernames=true;

                            break;

                        }

                    }

                    if ($check_usernames) {

                        break;

                    }

                }

            }

        }

        // keywords

        if(!empty($bl_keywords)&&is_array($bl_keywords)&&is_string($caption_text)){

            if ($check_tags==false&&$check_usernames==false) {

                $re = '/\b(?:' . join('|', array_map(function($keyword) {return preg_quote($keyword, '/'); }, $bl_keywords)) . ')\b/i';

                if (preg_match_all($re, $caption_text, $matches)>0) {

                    $check_keywords=true;

                }

            }

        }

        if ($check_tags==true||$check_usernames==true||$check_keywords==true) {

            unset($feeds[$key]);

        }

    }
  
    return array_values($feeds);

}
 




function removeUserBlackLists($users,$bl_usernames){

    if(!empty($bl_usernames)&&is_array($bl_usernames)&&!empty($users)&&is_array($users)){

        foreach ($users as $key => $value) {

            $check_usernames=false;

            foreach ($bl_usernames as $pattern) {

                $pattern  = trim($pattern);

                if ($pattern==$value->getUsername()) {

                    $check_usernames=true;

                }

            }

            if($check_usernames){

                unset($users[$key]);

            }   

        }

    }

    return array_values($users);

}



function removeUserCommentBlacklists($users,$bl_usernames){

    if(!empty($bl_usernames)&&is_array($bl_usernames)&&!empty($users)&&is_array($users)){

        foreach ($users as $key => $value) {

            $user=$value->getUser();

            $check_usernames=false;

            foreach ($bl_usernames as $pattern) {

                $pattern  = trim($pattern);

                if ($pattern==$user->getUsername()) {



                    $check_usernames=true;

                }

            }

            if($check_usernames){

                unset($users[$key]);

            }   

        }

    }

    return array_values($users);

}



function removeUserFollowBackBlacklist($users,$bl_usernames){

    if(!empty($bl_usernames)&&is_array($bl_usernames)){

        foreach ($users as $key => $value) {

            $check_usernames=false;

            foreach ($bl_usernames as $pattern) {

                $pattern  = trim($pattern);

                if ($pattern==$value->getUsername()) {

                    $check_usernames=true;

                }

            }

            if($check_usernames){

                unset($users[$key]);

            }   

        }

    }

    return array_values($users);

}



function removeUserUnFollowBackBlacklist($users,$bl_usernames){

    if(!empty($bl_usernames)&&is_array($bl_usernames)){

        foreach ($users as $key => $value) {

            $check_usernames=false;

            $user = explode("@",$key);

            foreach ($bl_usernames as $pattern) {

                $pattern  = trim($pattern);

                if ($pattern==$user[1]) {

                    $check_usernames=true;

                }

            }

            if($check_usernames){

                unset($users[$key]);

            }   

        }

    }

    return $users;

}



function unset_match_values($tags,$blacklist_tags){

    $blacklists = json_decode($blacklist_tags);
	if(!empty($blacklists)){
		$blacklist_tags = json_decode(strtolower($blacklists->bl_tags));
	}
    

    $tags = (array)json_decode($tags);

    if (!empty($blacklist_tags) && is_array($blacklist_tags)&&!empty($tags)&&is_array($tags)) {

        foreach ($tags as $key => $tag) {

            foreach ($blacklist_tags as $bl) {

                if ($tag==$bl) {

                    unset($tags[$key]);

                    continue;

                }

            }

        }

    }

    return $tags=json_encode($tags);

}



function getDataFromString($string,$target){

    if ($target=="hashtags") {

        $hashtags = array();

        preg_match_all("/(#\w+)/", $string, $matches);  

        if ($matches) {

            $hashtagsArray = array_count_values($matches[0]);

            $hashtags = array_keys($hashtagsArray);

            return $hashtags;

        }

    }

    if ($target=="usernames") {

        $usernames = array();

        preg_match_all("/(@\w+)/", $string, $matches);  

        if ($matches) {

            $usernamesArray = array_count_values($matches[0]);

            $usernames = array_keys($usernamesArray);

            return $usernames;

        }

    }

}


function check_point($username,$password, $message , $i = ""){

    $CI = &get_instance();

    if(is_string($message)){

        if(strpos($message, 'proxy') !== false && strpos($message, 'Connection refused') !== false){

            //strpos($message, 'cURL error') !== false && strpos($message, '443') !== true && strpos($message, 'OpenSSL') !== true

            file_put_contents('logs.txt', $message.PHP_EOL , FILE_APPEND | LOCK_EX);

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 3), array("username" => $username));

        }



        if(strpos($message, 'The password you entered is incorrect') !== false){

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 2), array("username" => $username));

        }



        if(strpos($message, 'checkpoint') !== false){

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1), array("username" => $username));

        }



        if(strpos($message, 'User not logged in') !== false && $i != ""){

            try{

                $i->login($username,$password);

            } catch (Exception $e){

                if(strpos($e->getMessage(), 'checkpoint') !== false){

                    $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1), array("username" => $username));

                }

            }

        }



    }



}


function Instagram_Get_Avatar($username){

    try{

        $sites_html = file_get_contents('https://www.instagram.com/'.$username);



        $html = new DOMDocument();

        @$html->loadHTML($sites_html);

        $meta_og_img = null;

        //Get all meta tags and loop through them.

        foreach($html->getElementsByTagName('meta') as $meta) {

            //If the property attribute of the meta tag is og:image

            if($meta->getAttribute('property')=='og:image'){

                //Assign the value from content attribute to $meta_og_img

                $meta_og_img = $meta->getAttribute('content');

            }

        }

        return $meta_og_img;

    }catch(Exception $e){

        return BASE."assets/images/noavatar.png";

    }

}



if(!function_exists("Instagram_Loader")){

    function Instagram_Loader($username, $password,$proxy = ""){
        $CI = &get_instance();
        try {
            $ig = new \InstagramAPI\Instagram(false, false, [

            'storage'    => 'mysql',

            'dbhost'     => DB_HOST,

            'dbname'     => DB_NAME,

            'dbusername' => DB_USER,

            'dbpassword' => DB_PASS,

            'dbtablename'=> INSTAGRAM_DATA

        ]);
        $ig->setVerifySSL(false);


        if($proxy != ""){

            $ig->setProxy($proxy);

        }

        $ig->login($username, $password);


        return $ig;

        } catch (InstagramAPI\Exception\CheckpointRequiredException $e) {

            $txt = $e->getMessage();

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $txt,"stop_date" => NOW), array("username" => $username));
            $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
            $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));

            return $txt;

        } catch (InstagramAPI\Exception\ChallengeRequiredException $e) {

            $txt = $e->getMessage();

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $txt,"stop_date" => NOW), array("username" => $username));
            $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
            $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));

            return $txt;

        } catch (InstagramAPI\Exception\AccountDisabledException $e) {

            $txt = l("Your account has been disabled for violating Instagram terms. <a href='https://help.instagram.com/366993040048856'>Click here</a> to learn how you may be able to restore your account.");

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $txt,"stop_date" => NOW), array("username" => $username));
            $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
            $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));

            return $txt;

        } catch (InstagramAPI\Exception\SentryBlockException $e) {

            $txt = l("Your account has been banned from Instagram API for spam behaviour or otherwise abusing.");

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $txt,"stop_date" => NOW), array("username" => $username));
            $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
            $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));

            return $txt;

        } catch (InstagramAPI\Exception\IncorrectPasswordException $e) {

            $txt = l("The password you entered is incorrect. Please try again.");

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $txt,"stop_date" => NOW), array("username" => $username));
            $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
            $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));

            return $txt;

        } catch (InstagramAPI\Exception\InvalidUserException $e) {

            $txt = l("The username you entered doesn't appear to belong to an account. Please check your username and try again.");
            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $txt,"stop_date" => NOW), array("username" => $username));
            $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
            $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));

            return $txt;

        } catch (InstagramAPI\Exception\InstagramException $e) {

            if ($e->hasResponse()) {
                $msg = $e->getResponse()->getMessage();
            } else {
                $msg = explode(":", $e->getMessage(), 2);
                $msg = end($msg);
            }

            if (stripos($msg, "CURL error") !== false) {

                $pro_data = array(
                    'username' => $username,
                    'proxy' => $proxy,
                    'message' => $msg,
                    'date' => NOW
                );

                $CI->db->insert('proxy_log', $pro_data);
                $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
//                $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));
                $CI->db->update(PROXY, array("is_working" => 0,"delay_time" => NOW), array("proxy" => $proxy));
            }

            if (stripos($msg, "Login required") !== false || stripos($msg, "Challenge required") !== false || stripos($msg, "checkpoint required") !== false) {

                $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $msg,"stop_date" => NOW), array("username" => $username));
                $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
                $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));
            }

            return $msg;

        } catch (Exception $e) {

            $msg = $e->getMessage();

//            $CI = &get_instance();
            if (stripos($msg, "CURL error") !== false) {

                $pro_data = array(
                    'username' => $username,
                    'proxy' => $proxy,
                    'message' => $msg,
                    'date' => NOW
                );

                $CI->db->insert('proxy_log', $pro_data);
                $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
//                $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));
                $CI->db->update(PROXY, array("is_working" => 0,"delay_time" => NOW), array("proxy" => $proxy));
            }

            if (stripos($msg, "Login required") !== false || stripos($msg, "Challenge required") !== false || stripos($msg, "checkpoint required") !== false) {

                $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 1,"error_message" => $msg,"stop_date" => NOW), array("username" => $username));
                $CI->db->update(INSTAGRAM_SCHEDULES, array("status" => 3), array("account_name" => $username));
                $CI->db->update(INSTAGRAM_ACTIVITY, array("status" => 3), array("account_name" => $username));
            }

            return $msg;
        }


    }

}



if(!function_exists("Instagram_Login")){

    function Instagram_Login($username, $password, $proxy = "",$update = null){
		$verificationCodeStatus = false;
		$st = 'error';
        try {

            $ig = new \InstagramAPI\Instagram(false, false, [

            'storage'    => 'mysql',

            'dbhost'     => DB_HOST,

            'dbname'     => DB_NAME,

            'dbusername' => DB_USER,

            'dbpassword' => DB_PASS,

            'dbtablename'=> INSTAGRAM_DATA

        ]);
        $ig->setVerifySSL(false);



        if($proxy != ""){

            $ig->setProxy($proxy);

        }

            $ig->login($username, $password);

            //$ig->login($username, $password);

            $CI = &get_instance();

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 0), array("username" => $username));



            return $ig;

        }

        catch (Exception $e) {
			if($update =='update'){
				$txt = getInstagramMessage($e->getMessage());
			}else{


           $error_msg =  getInstagramMessage($e->getMessage());
		   
            if($error_msg == "Challenge required."){
                $error_arr = $e->getTrace();
                  //var_dump($error_arr[0]['args'][2]->challenge->api_path);
                $url =  $error_arr[0]['args'][2]->getChallenge()->getApiPath();
				//echo $url;
                sleep(4);
                $res =  $ig->sendChallengeVerificationCode($username,$password,$url);
				
                $fullResponse =  $res->getFullResponse();  
              
                if($fullResponse->getStatus()== 'ok'){
				
					//  var_dump($fullResponse->user_id);
					//  var_dump($fullResponse->nonce_code);	
					
					$CheckPointData = [
						'InstagramID' =>  $res->getUserId(),
						'CheckPointCode' =>  $res->getNonceCode()

					];


					unset($_SESSION['CheckPointCode']);
					$_SESSION['CheckPointCode'] = $CheckPointData;
					if($res->getStepName() == 'verify_email'){
						$txt = 'Code send to your email:'.$res->getStepData()['contact_point']." ";
					}else{
						$txt = 'Code send to your mobile :'.$res->getStepData()['contact_point']." ";
					}
					
					$verificationCodeStatus = true;
					$st = 'success';
				}else{
					$st = 'error';
					$txt = 'There is Problem in sending verfication code to Mobile/Email';
					$verificationCodeStatus = false;
				}
            }else{
                $txt = getInstagramMessage($e->getMessage());
				$verificationCodeStatus = false;
				$st = 'error';
            }
}

            return array(

                "txt"   => $txt,

                "type"  => getInstagramMessage($e->getMessage()),

                "label" => "bg-red",
				
                "verificationCodeStatus" => $verificationCodeStatus,

                "st"    => $st,

            );

        }

    }

}



if(!function_exists("approveChallengeVerificationCode")){

    function approveChallengeVerificationCode($username,$password,$proxy,$code){

            $ig = new \InstagramAPI\Instagram(false, false, [

                'storage'    => 'mysql',

                'dbhost'     => DB_HOST,

                'dbname'     => DB_NAME,

                'dbusername' => DB_USER,

                'dbpassword' => DB_PASS,

                'dbtablename'=> INSTAGRAM_DATA

            ]);
            $ig->setVerifySSL(false);



            if($proxy != ""){

                $ig->setProxy($proxy);

            }

        try{
           // print_r($_SESSION['CheckPointCode']);
          //  die();
		  if(!isset($_SESSION['CheckPointCode'])){
			   return array(

                "txt"   => 'Please First Submit form without code then that will send verification code to your email and then submit with new verification code.',

                "type"  => '', 

                "label" => "bg-red",

                "st"    => "error",

            );
		  }else{
			  $InstagramID  =  $_SESSION['CheckPointCode']['InstagramID']; 
			  $CheckPointCode  =  $_SESSION['CheckPointCode']['CheckPointCode'];
		  }

            $result =  $ig->approveChallengeVerificationCode($InstagramID,$CheckPointCode,$code,$username,$password);


            return $result;

        }catch(Exception $e){

            return array(

                "txt"   => getInstagramMessage($e->getMessage()),

                "type"  => getInstagramMessage($e->getMessage()),

                "label" => "bg-red",

                "st"    => "error",

            );
           // return $e->getMessage();

        }

    }


}


if(!function_exists("Instagram_Search_Hashtags")){

    function Instagram_Search_Hashtags($data, $hashtag,$proxy=""){

       $i = Instagram_Loader($data->username, $data->password, $proxy);


        if(stripos($i, "Login required") != false || stripos($i, "Challenge required") != false) {
            return 'Instagram verification required. Please go into your Instagram app and verify.  Once done, reconnect here.';
        }


		
        try{

            $result = $i->hashtag->search($hashtag);

            return $result;

        }catch(InstagramException $e){

            return $e->getMessage();

        }

    }

}



if(!function_exists("Instagram_Search_Locations")){

    function Instagram_Search_Locations($data, $lat, $lng,  $keyword, $proxy=""){

        $i = Instagram_Loader($data->username, $data->password,$proxy);

        if(stripos($i, "Login required") != false || stripos($i, "Challenge required") != false) {
            return 'Instagram verification required. Please go into your Instagram app and verify.  Once done, reconnect here.';
        }

        try{

            $result = $i->location->search($lat, $lng);

            return $result;

        }catch(InstagramException $e){

            return $e->getMessage();

        }

    }

}



if(!function_exists("Instagram_Search_Usernames")){

    function Instagram_Search_Usernames($data, $username, $proxy=""){

        $i = Instagram_Loader($data->username, $data->password, $proxy);

        if(stripos($i, "Login required") != false || stripos($i, "Challenge required") != false) {
            return 'Instagram verification required. Please go into your Instagram app and verify.  Once done, reconnect here.';
        }

        try{

            $result = $i->people->search($username);

            if(!empty($result)){

                $result_tmp = $result->getUsers();
			
                foreach ($result_tmp as $key => $row) {

                    if($row->getIsPrivate() == 1){

                        unset($result_tmp[$key]);

                        continue;

                    }

                }

                $result->setUsers(array_values($result_tmp));

            }

            return $result;

        }catch(InstagramException $e){

            return $e->getMessage();

        }

    }

}



if(!function_exists("Instagram_Sort_Tags")){

    function Instagram_Sort_Tags($data){

        usort($data, function($a, $b) {

            if($a->getMediaCount()==$b->getMediaCount()) return 0;

            return $a->getMediaCount() < $b->getMediaCount()?1:-1;

        });

        return $data;

    }

}



if (!function_exists('Instagram_Get_Id')) {

    function Instagram_Get_Id($url){

        $link = str_replace("https://", "", $url);

        $link = str_replace("http://", "", $link);

        $link = explode("/", $link);

        if(count($link) >= 3){

            $url = $link[2];

        }else{

            $url = $url;

        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'https://api.instagram.com/oembed/?url=http://instagram.com/p/'.$url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);

        curl_setopt($curl, CURLOPT_HEADER, false);

        $data = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($data);

        if(!empty($result)){

            return $result->media_id;

        }else{

            return false;

        }

    }

}



if(!function_exists("Instagram_Get_Feed")){

    function Instagram_Get_Feed($i, $type, $keyword = ""){
        if($i == ""){
            return (object)array("st" => "error");
        }	
		
		$rankToken = \InstagramAPI\Signatures::generateUUID();
		
        $keyword = trim($keyword);
        $result = array(); 
		
        try {

            switch ($type) {

                case 'timeline':

                    $timeline_feed = $i->timeline->getTimelineFeed();

                    $result = array();

                    $feeds  = $timeline_feed->GetFeedItems();
					
                    if(!empty($feeds) && is_array($feeds)){

                        foreach ($feeds as $key => $row) {

                            if(null !== $row->getMediaOrAd()){

                                $result[] = $row->getMediaOrAd();

                            }

                        }

                    }

                    break;

                case 'popular':

                    $result = $i->discover->getPopularFeed();

                    if($result->getStatus() == "ok"){

                        $result = $result->getItems();

                    }

                    break;

                case 'explore_tab':

                    $explode_feed = $i->discover->getExploreFeed();

                    if($explode_feed->getStatus() == "ok"){

                        $result = array();

                        $feeds = $explode_feed->getItems();

                        if(!empty($feeds) && is_array($feeds)){

                            foreach ($feeds as $key => $row) {

                                if(null !== $row->getMedia()){

                                    $result[] = $row->getMedia();

                                }

                            }

                        }

                    }

                    break;

                case 'reels_tray':

                    $reels_tray_feed = $i->story->getReelsTrayFeed();

                    if($reels_tray_feed->getStatus() == "ok"){

                        $result = $reels_tray_feed->getTray()[0]->getItems();

                    }

                    break;

                case 'your_feed':

                    $self_user_feed = $i->timeline->getSelfUserFeed();

                    if($self_user_feed->getStatus() == "ok"){

                        $result = $self_user_feed->getItems();

                    }

                    break;

                case 'tag':
					
                    $hashtag_feed = $i->hashtag->getFeed($keyword,$rankToken);
					
                    if($hashtag_feed->getStatus() == "ok"){

                        $result = $hashtag_feed->getItems();

                    }
					
                    break;

                case 'search_tags':
					
                    $search_tags = $i->hashtag->search($keyword);					
                    if($search_tags->getStatus() == "ok"){
						
                        $result = Instagram_Sort_Tags($search_tags->getResults());

                    }
					
                    break;

                case 'search_users':

                    $search_users = $i->people->search($keyword);

                    if($search_users->getStatus() == "ok"){

                        $result = $search_users->getUsers();

                    }

                    break;

                case 'following':

//                    print_r($i);

                    $following = $i->people->getSelfFollowing($rankToken);

                    if($following->getStatus() == "ok"){

                        $result = $following->getUsers();

                    }

                    break;

                case 'followers':
					
                    $followers = $i->people->getSelfFollowers();

                    if($followers->getStatus() == "ok"){

                        $result = $followers->getUsers();

                    }

                    break;

                case 'feed':

                    $mediaId   = Instagram_Get_Id($keyword);

                    if($mediaId != ""){

                        $feed      = $i->media->getInfo($mediaId);

                        if($feed->getStatus() == "ok"){

                            $result = $feed->getItems()[0];

                        }

                    }

                    break;

                case 'feed_by_id':

                    $feed = $i->media->getInfo($keyword);

                    if($feed->getStatus() == "ok"){

                        $result = $feed->getItems()[0];

                    }

                    break;

                case 'user_feed':

                    $array_username = explode("|", $keyword);

                    if(count($array_username) == 2){

                        $user_feed = $i->timeline->getUserFeed($array_username[0]);

                        if($user_feed->getStatus() == "ok"){

                            $result = $user_feed->getItems();

                        }

                    }

                    break;

                case 'user_following':

                    $array_username = explode("|", $keyword);
					
                    if(count($array_username) == 2){

                        $following = $i->people->getFollowing($array_username[0],$rankToken);

                        if($following->getStatus() == "ok"){

                            $result = $following->getUsers();

                        }

                    }
					
                    break;

                case 'user_followers':
//                    print_r($keyword);

                    $array_username = explode("|", $keyword);
//                    print_r($array_username);
                    if(count($array_username) == 2){

                        $followers = $i->people->getFollowers($array_username[0],$rankToken);
//                        print_r($followers);

                        if($followers->getStatus() == "ok"){

                            $result = $followers->getUsers();

                        }

                    }

                    break;



                case 'following_recent_activity':

                    $followback = $i->people->getRecentActivityInbox();
		
                    $followback = $followback->getFullResponse()->getOldStories();
					
                    if(!empty($followback)){

                        $result = array();

                        foreach ($followback as $key => $row) {

                            if(isset($row->args->inline_follow) && $row->args->inline_follow->following != 1 && $row->args->inline_follow->outgoing_request != 1 && strpos($row->args->text, 'started following you') !== false ){

                                $result[] = $row->args->inline_follow->user_info;

                            }

                        } 

                    }



                    break;



                case 'location':

                    $array_location = explode("|", $keyword);

                    if(count($array_location) == 4){

                        $location = $i->location->getFeed($array_location[3],$rankToken);

                        if($location->getStatus() == "ok"){

                            $result = $location->getItems();

                        }

                    }

                case 'username':

                    $follow_types  = array("user_following","user_followers");

                    $follow_index  = array_rand($follow_types);

                    $follow_type   = $follow_types[$follow_index];

                    switch ($follow_type) {

                        case 'user_following':

                            $array_username = explode("|", $keyword);

                            if(count($array_username) == 2){

                                $following = $i->people->getFollowing($array_username[0],$rankToken);

                                if($following->getStatus() == "ok"){

                                    $result = $following->getUsers();

                                }

                            }

                            break;

                        case 'user_followers':

                            $array_username = explode("|", $keyword);

                            if(count($array_username) == 2){

                                $followers = $i->people->getFollowers($array_username[0]);

                                if($followers->getStatus() == "ok"){

                                    $result = $followers->getUsers();

                                }

                            }

                            break;

                    }

                    break;
                case 'get_user_followers':


                        $followers = $i->people->getFollowers($keyword,$rankToken);

                        if($followers->getStatus() == "ok"){

                            $result = $followers->getUsers();

                        }


                    break;

            }

        } catch (Exception $e){

            $result = $e->getMessage();

           

        }


		
		
	
		
        return $result;

    }

}

   

if(!function_exists("Instagram_Genter")){

    function Instagram_Genter($username){

       // echo $fullnames."-<br>";
/*
        if($fullnames == ''){
            return 'dm';
        }

        if(str_word_count($fullnames) == 1 ){

            $firstname = $fullnames;

        }else{
            $name = explode(' ',$fullnames);

            $firstname = $name[0];
        }
*/


        //echo $firstname;

//        $resp = @file_get_contents('https://api.genderize.io/?name='.$firstname);
		$resp = file_get_contents_curl('http://genderapi.io/api/?name='.$username.'&key=5c6ad0f9615dc564ca599632');  
        //$resp = @file_get_contents('http://gender-api.com/get?name='.$username.'&key=myNsTENWKXhxHfgGVF');

		//var_dump($resp);die; 
        if ($resp === FALSE) {  

//            continue;
//            return 'dm';

        }
        if(!empty($resp)){
			$genderresp = json_decode($resp);
//        print_r($genderresp);

//        echo $genderresp['gender'].'--'.$genderresp->gender;
			 if(!empty($genderresp)){
					return $genderresp->gender;
			 }

		}else{
			return false;
		}
        
//        $app_url = "https://api.genderize.io/?";

//        $names = array();
//
//        $names_count = 0;
//
//        $count_up = 0;
//
//        $data_name = array();

//        if(!empty($fullnames)){
//
//            foreach ($fullnames as $key => $row) {
//
//                $names[$names_count]["name[".$count_up."]"] = $row;
//
//                if(count($names[$names_count]) == 10){
//
//                    $names_count++;
//
//                    $count_up = 0;
//
//                }
//
//                $count_up++;
//
//            }
//
//        }



//        if(!empty($names)){

//            foreach ($names as $key => $row) {


//                $url = 'https://api.genderize.io/?name='.urldecode(http_build_query($fullnames));
//
//                pr($url);
//
//                $curl = curl_init();
//
//                curl_setopt($curl, CURLOPT_URL, $url);
//
//                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//                curl_setopt($curl, CURLOPT_HEADER, false);
//
//                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//
//                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//
//                $data = curl_exec($curl);
//
//                curl_close($curl);
//
//                $data = json_decode($data);
//
//                if(!empty($data)){
//
//                    foreach ($data as $key => $value) {
//
//                        $data_name[] = $value;
//
//                    }
//
//                }
//
////            }
//
////        }
//
//        pr($data_name,1);
//
//        pr($names,1);

    }

}



if(!function_exists('Instagram_Filter')){

    function Instagram_Filter($data = array(), $filter = array(), $timezone = "", $type = "feed"){
        
        $filter = json_decode($filter);

        $result = array();
		
        if(!empty($filter) && !empty($data)){

            switch ($type) {

                case 'feed':
                    if(!empty($data) && !is_string($data)){
  
                        $data = removeFeedPrivate($data);
						
						
						
                        foreach ($data as $key => $row) {
							
                            if($filter->media_age != "" && $timezone != ""){ 
								
								//if( null !== $row->getCaption()){
								//echo date('Y-d-m h:i:s',$row->getTakenAt()); 
								//echo '</br>'; 
								if( null !== $row->getTakenAt()){
									
									//if(null !==$row->getCaption()->getCreatedAtUtc()){
										
										$time_media = "";
										
										switch ($filter->media_age) {

											case 'new':

												$time_media = 600;

												break;

											case '1h':

												$time_media = 3600;

												break;

											case '12h':

												$time_media = 43200;

												break;

											case '1d':

												$time_media = 86400;

												break;

											case '3d':

												$time_media = 259000;

												break;

											case '1w':

												$time_media = 604800;

												break;

											case '2w':

												$time_media = 1209600;

												break;

											case '1M':

												$time_media = 2419200;

												break;
											case '3M':

												$time_media = 7776000;

												break;

										}



										if($time_media != ""){

											$time_now  = strtotime(NOW);

											$date = new DateTime(date("Y-m-d H:i:s", $time_now), new DateTimeZone(TIMEZONE_SYSTEM));

											$date->setTimezone(new DateTimeZone($timezone));

											$time_of_user = $date->format('Y-m-d H:i:s');
											//if( null !== $row->getCaption()){
												if(strtotime($time_of_user) - $row->getTakenAt() > $time_media){

													unset($data[$key]);

													continue;

												}
											//}

										}

									
								}else{
									unset($data[$key]);
								}

                            }


							
                            //Media type
							
                            switch ($filter->media_type) {

                                case 'photo':

                                    if($row->getMediaType() == 2){

                                        unset($data[$key]);

                                        continue;

                                    }

                                    break;



                                case 'video':

                                    if($row->getMediaType() == 1){

                                        unset($data[$key]);

                                        continue;

                                    }

                                    break;

                            }



                            //Min. likes filter
							
                            //if($row->getLikeCount() < $filter->min_likes && $filter->min_likes != 0){
                            if($row->getLikeCount() < $filter->min_likes){

                                unset($data[$key]);

                                continue;

                            }



                            //Max. likes filter

                            //if($row->getLikeCount() > $filter->max_likes && $filter->max_likes != 0){
                            if($row->getLikeCount() > $filter->max_likes){

                                unset($data[$key]);

                                continue;

                            }



                            //Min. comments filter

                           // if(null !== $row->getCommentCount() && $row->getCommentCount() < $filter->min_comments && $filter->min_comments != 0){
                            if(null !== $row->getCommentCount() && $row->getCommentCount() < $filter->min_comments){

                                unset($data[$key]);

                                continue;

                            }



                            //if(null !== $row->getCommentsDisabled() && $row->getCommentsDisabled() == 1 && $filter->min_comments != 0){
                            if(null !== $row->getCommentsDisabled() && $row->getCommentsDisabled() == 1){

                                unset($data[$key]);

                                continue;

                            }



                            //Max. comments filter

                           // if(null !== $row->getCommentCount() && $row->getCommentCount() > $filter->max_comments && $filter->max_comments != 0){
                            if(null !== $row->getCommentCount() && $row->getCommentCount() > $filter->max_comments ){

                                unset($data[$key]);

                                continue;

                            }



                            //if(null !== $row->getCommentsDisabled() && $row->getCommentsDisabled() == 1 && $filter->max_comments != 0){
                            if(null !== $row->getCommentsDisabled() && $row->getCommentsDisabled() == 1 ){

                                unset($data[$key]);

                                continue;

                            }



                            //User relation filter

                            switch ($filter->user_relation) {

                                case 'followers':

                                    if( null !== $row->getUser()->getFriendshipStatus() && is_object($row->getUser()->getFriendshipStatus()) && null !== $row->getUser()->getFriendshipStatus()->getFollowedBy() && $row->getUser()->getFriendshipStatus()->getFollowedBy() != ""){

                                        unset($data[$key]);

                                        continue;

                                    }

                                    break;



                                case 'followings':

                                    if( null !== $row->getUser()->getFriendshipStatus() && is_object($row->getUser()->getFriendshipStatus()) && null !== $row->getUser()->getFriendshipStatus()->getFollowing() && $row->getUser()->getFriendshipStatus()->getFollowing() != ""){

                                        unset($data[$key]);

                                        continue;

                                    }

                                    break;



                                case 'both':

                                    if( null !== $row->getUser()->getFriendshipStatus() && is_object($row->getUser()->getFriendshipStatus()) && null !== $row->getUser()->getFriendshipStatus()->getFollowedBy() && $row->getUser()->getFriendshipStatus()->getFollowedBy() != ""){

                                        unset($data[$key]);

                                        continue;

                                    }



                                    if( null !== $row->getUser()->getFriendshipStatus() && is_object($row->getUser()->getFriendshipStatus()) && null !==  $row->getUser()->getFriendshipStatus()->getFollowing() && $row->getUser()->getFriendshipStatus()->getFollowing() != ""){

                                        unset($data[$key]);

                                        continue;

                                    }

                                    break;

                            }



                            //Get Fullname

                            /*if(isset($row->user->full_name) && $row->user->full_name != ""){

                                $remove_emoji = preg_replace('/[^\w\s]+/u','' , $row->user->full_name);

                                $remove_emoji = str_replace("_", " ", $remove_emoji);

                                if(!empty($remove_emoji != ""){

                                    $explode_name = explode(" ", $remove_emoji);

                                    $names["name[".$names_count."]"] = $explode_name[0];

                                    $names_count++;

                                }

                            }*/



                        }

                    }

                    break;




            }

        }


        if(!empty($filter->gender))
        {
            //Check gender

            if($filter->gender == 'm'){
                $gender = 'male';
            }else{
                $gender = 'female';
            }
			
            foreach ($data as $key => $row) {
 
				//echo '==='.$row->getUser()->getUsername().'===';

                $resp = Instagram_Genter($row->getUser()->getUsername());
				
//                print_r($resp);

//                echo $gender.'---'.$resp;

                if($gender != $resp){
//echo 1;
                    unset($data[$key]);

                    continue;

                } 

            }
        }

//        if(!empty($data)){
//
//            foreach ($data as $key => $row) {
//
//
//
//            }
//
//        }
		//print_r($data);die;
		
        return $data;

    }

}



if(!function_exists('Instagram_Filter_Item')){

//    function Instagram_Filter_Item($data = array(), $filter = array(), $type = "feed", $i){
//
//        $id = (null !==$data->getPk())?$data->getPk():$data->getId();
//
//        $userinfo = $i->people->getInfoById($id);
//
//        $filter   = json_decode($filter);
//
//        if(!empty($filter) && !empty($data)){
//
//            switch ($type) {
//
//                case 'user':
//
////                    echo "Hello";
////                    print_r($userinfo);
////                    echo $userinfo->getUser()->getGender();
//
//                    //User profile filter
//
//                    switch ($filter->user_profile) {
//
//                        case 'low':
//
//                            if($userinfo->getUser()->getProfilePicId() == "" || (int)$userinfo->getUser()->getMediaCount() == 0){
//
//                                return false;
//
//                            }
//
//                            break;
//
//                        case 'medium':
//
//                            if($userinfo->getUser()->getProfilePicId() == "" || (int)$userinfo->getUser()->getMediaCount() < 10 || $userinfo->getUser()->getFullName() == ""){
//
//                                return false;
//
//                            }
//
//                            break;
//
//                        case 'height':
//
//                            if($userinfo->getUser()->getProfilePicId() == "" || (int)$userinfo->getUser()->getMediaCount() < 30 || $userinfo->getUser()->getFullName() == "" || $userinfo->getUser()->getBiography() == ""){
//
//                                return false;
//
//                            }
//
//                            break;
//
//                    }
//
//
//
//                    //Min. followers filter
//
//                    if($userinfo->getUser()->getFollowerCount() < $filter->min_followers && $filter->min_followers != 0){
//
//                        return false;
//
//                    }
//
//
//
//                    //Max. followers filter
//
//                    if($userinfo->getUser()->getFollowerCount() > $filter->max_followers && $filter->max_followers != 0){
//
//                        return false;
//
//                    }
//
//
//
//                    //Min. following filter
//
//                    if($userinfo->getUser()->getFollowingCount() < $filter->min_followings && $filter->min_followings != 0){
//
//                        return false;
//
//                    }
//
//
//
//                    //Max. follow filter
//
//                    if($userinfo->getUser()->getFollowingCount() > $filter->max_followings && $filter->max_followings != 0){
//
//                        return false;
//
//                    }
//
//                    break;
//
//            }
//
////            if(!empty($filter->gender))
////            {
////                //Check gender
////
////                if($filter->gender == 'm'){
////                    $gender = 'male';
////                }else{
////                    $gender = 'female';
////                }
////
////                foreach ($data as $key => $row) {
////
//////                echo $row->getUser()->getFullName();
////
////                    $resp = Instagram_Genter($row->getUser()->getFullName());
//////                print_r($resp);
////
//////                echo $gender.'---'.$resp;
////
////                    if($gender != $resp){
//////echo 1;
////                        unset($data[$key]);
////
////                        continue;
////
////                    }
////
////                }
////            }
//
//        }
//
//        return $data;
//
//    }
    

    function Instagram_Filter_Item($data = array(), $filter = array(), $type = "feed", $i, $alreadyfollow = '' ,$category = '' ,$account_id = ''){

   

        $id = (null !==$data->getPk())?$data->getPk():$data->getId();

        $userinfo = $i->people->getInfoById($id);

        $filter   = json_decode($filter);

        if(!empty($filter) && !empty($data)){

            switch ($type) {

                case 'user':

//                    echo "Hello";
//                    print_r($userinfo);
//                    echo $userinfo->getUser()->getGender();

                    //User profile filter

                    switch ($filter->user_profile) {

                        case 'low':

                            if($userinfo->getUser()->getProfilePicId() == "" || (int)$userinfo->getUser()->getMediaCount() == 0){

                                return false;

                            }

                            break;

                        case 'medium':

                            if($userinfo->getUser()->getProfilePicId() == "" || (int)$userinfo->getUser()->getMediaCount() < 10 || $userinfo->getUser()->getFullName() == ""){

                                return false;

                            }

                            break;

                        case 'height':

                            if($userinfo->getUser()->getProfilePicId() == "" || (int)$userinfo->getUser()->getMediaCount() < 30 || $userinfo->getUser()->getFullName() == "" || $userinfo->getUser()->getBiography() == ""){

                                return false;

                            }

                            break;

                    }



                    //Min. followers filter

                    if($userinfo->getUser()->getFollowerCount() < $filter->min_followers && $filter->min_followers != 0){

                        return false;

                    }



                    //Max. followers filter

                    if($userinfo->getUser()->getFollowerCount() > $filter->max_followers && $filter->max_followers != 0){

                        return false;

                    }



                    //Min. following filter

                    if($userinfo->getUser()->getFollowingCount() < $filter->min_followings && $filter->min_followings != 0){

                        return false;

                    }



                    //Max. follow filter

                    if($userinfo->getUser()->getFollowingCount() > $filter->max_followings && $filter->max_followings != 0){

                        return false;

                    }



                    if(!empty($filter->gender))
                    {
                        //Check gender

                        if($filter->gender == 'm'){
                            $gender = 'male';
                        }else{
                            $gender = 'female';
                        }

                        $resp = Instagram_Genter($userinfo->getUser()->getUsername());

 
        //                echo $gender.'---'.$resp;

                            if($gender != $resp){
        //echo 1;
                                return false;

                            }

                    }


                    if($alreadyfollow != ''){

                        switch ($alreadyfollow) {

                            case 'location':
								$info   = $i->people->getFriendship($data->getPk());
                                if($info->getFollowing() != "" && $info->getOutgoingRequest() != ""){

                                    return false;
 
                                }

                                break;

                            case 'username':

                                $info   = $i->people->getFriendship($data->getPk());

                                if($info->getStatus() != "ok"){

                                    return false;

                                }else{

                                    if($info->getFollowing() != "" && $info->getOutgoingRequest() != ""){

                                        return false;

                                    }

                                }

                                break;

                            case 'tag':

//                                print_r($data);

                                if($data->getFriendshipStatus()->getFollowing() != "" && $data->getFriendshipStatus()->getOutgoingRequest() != ""){

                                    return false;

                                }

                                break;

                            case 'followers':

                                $CI = &get_instance();

                                $history = $CI->db->select("*")->where("pk", $data->getUsername())->where("type", $category)->where("account_id", $account_id)->get(INSTAGRAM_HISTORY)->row();

                                $userFriendship = $i->people->getFriendship($data->getPk());

                                if(!empty($history) && $userFriendship->getFollowing() != "" && $userFriendship->getOutgoingRequest() != ""){

                                    return false;

                                }

                                break;

                            case 'followings':

                                $CI = &get_instance();

                                $history = $CI->db->select("*")->where("pk", $data->getUsername())->where("type", $category)->where("account_id", $account_id)->get(INSTAGRAM_HISTORY)->row();

                                $userFriendship = $i->people->getFriendship($data->getPk());

                                if(!empty($history) && $userFriendship->getFollowing() != "" && $userFriendship->getOutgoingRequest() != ""){

                                    return false;

                                }

                                break;

                            case 'likers':

                                $CI = &get_instance();

                                $history = $CI->db->select("*")->where("pk", $data->getUsername())->where("type", $category)->where("account_id", $account_id)->get(INSTAGRAM_HISTORY)->row();

                                $userFriendship = $i->people->getFriendship($data->getPk());

                                if(!empty($history) && $userFriendship->getFollowing() != "" && $userFriendship->getOutgoingRequest() != ""){

                                    return false;

                                }

                                break;

                            case 'commenters':

                                $CI = &get_instance();

                                $history = $CI->db->select("*")->where("pk", $data->getUsername())->where("type", $category)->where("account_id", $account_id)->get(INSTAGRAM_HISTORY)->row();

                                $userFriendship = $i->people->getFriendship($data->getPk());

                                if(!empty($history) && $userFriendship->getFollowing() != "" && $userFriendship->getOutgoingRequest() != ""){

                                    return false;

                                }

                                break;

                        }

                    }

                    break;

            }

        }

        return $data;

    }

}



if(!function_exists("Instagram_Get_Follow")){

    function Instagram_Get_Follow($i, $type, $limit = 0){
		
        $result = false;
		$rankToken = \InstagramAPI\Signatures::generateUUID();
		
        try {

            switch ($type) {

                case 'following':

                    $data = array();

                    $next_page = null;

                    while(count($data) <= $limit) {
                        $following = $i->people->getSelfFollowing($rankToken,$next_page);


                        if($following->getStatus() == "ok"){

                            $next_page = $following->getNextMaxId();



                            $data = array_merge($data, $following->getUsers());

                            if($following->getNextMaxId() == ""){

                                break;

                            }

                        }

                    }

                    if(count($data)>$limit){

                        $result = array();

                        $i = 0;

                        for ($i = 0; $i <  $limit; $i++) {

                            $result[$i]=$data[$i];

                        }

                    }else{

                        $result = $data;

                    }

                    break;

                case 'followers':

                    $data = array();

                    $next_page = null;
					
                    while(count($data) <= $limit) {
						
                        $followers = $i->people->getSelfFollowers($rankToken,$next_page);
						
                        if($followers->getStatus() == "ok"){

                            $next_page = $followers->getNextMaxId();

                            $data = array_merge($data, $followers->getUsers());

                            if($followers->getNextMaxId() == ""){

                                break;

                            }



                        }

                    }
				
                    if(count($data)>$limit){

                        $result = array();

                        $i = 0;

                        for ($i = 0; $i <  $limit; $i++) {

                            $result[$i]=$data[$i];

                        }

                    }else{

                        $result = $data;

                    }

                    break;

            }

        } catch (Exception $e){

            $result = $e->getMessage();

        }

        return $result;

    }

}


if(!function_exists("Instagram_Post")){

    function Instagram_Post($data){  
        $CI = &get_instance();

        if($data->category != 'post' && $data->category != "message"){

			if(!empty($data) and isset($data->blacklists)){
				$blacklists             = json_decode($data->blacklists);
			}else{
				$blacklists             = array();
			}
            
			if(!empty($blacklists) and isset($blacklists->bl_tags)){
				$lacklist_tags         = json_decode(strtolower($blacklists->bl_tags));
			}else{
				$lacklist_tags             = array();
			}
            

            
			if(!empty($blacklists) and isset($blacklists->bl_usernames)){
				$lacklist_usernames    = json_decode(strtolower($blacklists->bl_usernames));
			}else{
				$lacklist_usernames             = array();
			}
            
			if(isset($blacklists->bl_keywords)){
				$lacklist_keywords     = json_decode(strtolower($blacklists->bl_keywords));
			}else{
				$lacklist_keywords     = array();
			} 
            

            $CI->db->select('*');
            $CI->db->from('blacklist');
            $resp = $CI->db->get();
            $Blackresp = $resp->num_rows()>0?$resp->result_array():"";


            $ntags = $Blackresp[0]['tags'];
            $nuser = $Blackresp[0]['username'];
            $nkey = $Blackresp[0]['keywords'];

            $otags = explode(',',$ntags);
            $ouser = explode(',',$nuser);
            $okey = explode(',',$nkey);


            if($lacklist_tags != null){
                $blacklist_tags = array_merge($lacklist_tags,$otags);
            }else{
                $blacklist_tags = $otags;
            }
            if($lacklist_usernames != null){

                $blacklist_usernames = array_merge($lacklist_usernames,$ouser);
            }else{
                $blacklist_usernames = $ouser;
            }
            if($lacklist_keywords != null){
                $blacklist_keywords = array_merge($lacklist_keywords,$okey);
            }else{
                $blacklist_keywords = $okey;
            }
        }

        $spintax = new Spintax();
        $response = array();
        $i = Instagram_Loader($data->username, $data->password, $data->proxy);

        if($i == ""){
            $response = (object)array(
                "st"      => "error",
                "txt"     => "Login Error"
            );
            return $response;
        }

        if(!is_string($i)){

            switch ($data->category) {

                case 'post':

                    switch ($data->type) {

                        case 'photo':
                            try {

                                $image_tmp = explode(BASE,$data->image);

                                $response =$i->timeline->uploadPhoto($image_tmp[1], array("caption" => $data->message));

                            } catch (Exception $e){

                                $response = $e->getMessage();

                            }

                            break;

                        case 'photocarousel':

                            try {

                                $images = json_decode($data->image);

                                if(!empty($images)){

                                    foreach ($images as $key => $image) {
                                        $image_tmp = explode(BASE,$image);

                                        $image = $image_tmp[1];

                                        $check_type = explode(".", $image);

                                        $check_type = end($check_type);

                                        $check_type = strtolower($check_type);

                                        if($check_type == "mp4"){

                                            $medias[] = array(

                                                "type" => "video",

                                                "file" => $image

                                            );

                                        }else{

                                            $medias[] = array(

                                                "type" => "photo",

                                                "file" => $image

                                            );

                                        }

                                    }

                                }



                                $response =$i->timeline->uploadAlbum($medias, array("caption" => $data->message));

                            } catch (Exception $e){

                                $response = $e->getMessage();

                            }

                            break;

                        case 'story':

                            try {
                                $image_tmp = explode(BASE,$data->image);
                                $response =$i->story->uploadPhoto($image_tmp[1], array("caption" => $data->message));

                            } catch (Exception $e){

                                $response = $e->getMessage();

                            }

                            break;

                        case 'video':

                            $url = $data->image;

                            try {

                                $response =$i->timeline->uploadVideo($url, array("caption" => $data->message));

                                if(isset($response->fullResponse)){

                                    $response = $response->fullResponse;

                                }

                            } catch (Exception $e){

                                $response = $e->getMessage();

                            }

                            break;

                        case 'storyvideo':

                            $url = str_replace(BASE, "", $data->image);

                            try {

                                $response =$i->story->uploadVideo($url, array("caption" => $data->message));

                                if(isset($response->fullResponse)){

                                    $response = $response->fullResponse;

                                }

                            } catch (Exception $e){

                                $response = $e->getMessage();

                            }



                            break;

                    }


                    if(is_object($response) && $response->getStatus() == "ok"){

                        $response = array(

                            "st"      => "success",

                            "id"      => $response->getMedia()->getPk(),

                            "code"    => $response->getMedia()->getCode(),

                            "txt"     => l('Post successfully')

                        );

                    }

                    if(is_string($response)){

                        $response = array(

                            "st"      => "error",

                            "txt"     => $response

                        );

                    }

                    return $response;

                    break;



                case 'like':

                    $targets          = (array)json_decode($data->title); 

                    $target           = array_rand((array)json_decode($data->title));



                    $tags             = (array)json_decode($data->description);





                    $tag_index        = array_rand((array)json_decode($data->description));



                    $locations        = (array)json_decode($data->url);

                    $location_index   = array_rand((array)json_decode($data->url));



                    $usernames        = (array)json_decode($data->image);

                    $username_index   = array_rand((array)json_decode($data->image));



                    $tag              = @$spintax->process($tags[$tag_index]);

                    $location         = @$spintax->process($locations[$location_index]);

                    $username         = @$spintax->process($usernames[$username_index]);

					echo "Target===".$target."<br>";
					echo "TAG===".$tag."<br>"; 
					//$target = 'location';
                    switch ($target) { 
                    
                        case 'location':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $location);
								
                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
							    
                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after filter(l)"

                                    );

                                }


                                if(!empty($feeds) && is_array($feeds)){





                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                    $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();
                                    if(empty($history)){

                                        $like = $i->media->like($feed->getPk());

                                        
                                        if($like->getStatus() == "ok"){

                                            $response = array(

                                                "st"      => "success",

                                                "data"    => json_encode($feed),

                                                "code"    => $feed->getCode(),

                                                "txt"     => l('Successfully')

                                            );

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "Like Failed(l)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "History is not null(l)"

                                        );

                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist filter(l)"

                                    );

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'tag':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $tag);
                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords); 

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after filter(t)"

                                    );

                                }

                                if(!empty($feeds) && is_array($feeds)){





                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                    $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();
									//$history = array();
                                    if(empty($history)){



                                        $like = $i->media->like($feed->getPk());



                                        //pr($like,0);

                                        //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                        if($like->getStatus() == "ok"){

                                            $response = array(

                                                "st"      => "success",

                                                "data"    => json_encode($feed),

                                                "code"    => $feed->getCode(),

                                                "txt"     => l('Successfully')

                                            );

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "Like Failed(t)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "History is not null(t)"

                                        );

                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist filter(t)"

                                    );

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'username':

                            try {

                                $feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                print_r($feeds);
                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                if(!empty($feeds)&&is_array($feeds)){

                                   $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after filter(u)"

                                    );

                                }

                                if(!empty($feeds) && is_array($feeds)){

                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                    $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();
									//$history = array();
                                    if(empty($history)){

                                        $like = $i->media->like($feed->getPk());

                                        //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                        if($like->getStatus() == "ok"){

                                            $response = array(

                                                "st"      => "success",

                                                "data"    => json_encode($feed),

                                                "code"    => $feed->getCode(),

                                                "txt"     => l('Successfully')

                                            );

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "Like Failed(u)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "History is not null(u)"

                                        );

                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist filter(u)"

                                    );

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'followers':

                            try {

                                switch ((int)$targets['followers']) {

                                    case 1:

                                        //Usernames

                                        $users  = Instagram_Get_Feed($i, "user_followers", $username);
//                                        print_r($users);
                                        break;



                                    case 2:

                                        //My Account

                                        $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);
//                                        print_r($users);
                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:

                                                $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);
//                                                print_r($users);
                                                break;



                                            case 1:

                                                $users  = Instagram_Get_Feed($i, "user_followers", $username);
//                                                print_r($users);
                                                break;

                                        }

                                        break;

                                }



                                //$users = removePrivateUser($users);
								

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index];
									
                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
									$feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									while(empty($feeds)){
										
										$index      = array_rand($users);

										$user       = $users[$index];
										$feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername()); 
										$feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
										
									}
                                    
                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(f)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){





                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();
										//$history = array();
                                        if(empty($history)){

                                            $like = $i->media->like($feed->getPk());

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($like->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Like failed(f)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(f)"

                                            );

                                        }

                                    }else{
  
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(f)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(f)"

                                );

                            } 

                            break;



                        case 'followings':

                            try {

                                switch ((int)$targets['followings']) {

                                    case 1:
										
                                        //Usernames

                                        $users  = Instagram_Get_Feed($i, "user_following", $username);
                                        break;



                                    case 2:
										
                                        //My Account
                                    	

                                        $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);
                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:

                                                $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);
//                                                print_r($users);
                                                break;



                                            case 1:

                                                $users  = Instagram_Get_Feed($i, "user_following", $username);
//                                                print_r($users);
                                                break;

                                        }

                                        break;
  
                                }
                                // Removing users whom attribue is_private = 1
                                //$users = removePrivateUser($users);

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
									
									$feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									
									while(	empty($feeds)){
										
										$index      = array_rand($users);
  
										$user       = $users[$index];

										$feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
										
										$feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

									}
									
									
                                    if(!empty($feeds)&&is_array($feeds)){

                                       $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(n)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){





                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();
										//$history = array();
                                        if(empty($history)){

                                            $like = $i->media->like($feed->getPk());

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($like->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Like Failed(n)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(n)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(n)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(n)"

                                );

                            }

                            break;



                        case 'likers':

                            try {

                                switch ((int)$targets['likers']) {

                                    case 1:

                                        //Usernames Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                        print_r($user_feeds);
                                        break;



                                    case 2:

                                        //My Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                        print_r($user_feeds);
                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                                print_r($user_feeds);
                                                break;



                                            case 2:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                                print_r($user_feeds);
                                                break;

                                        }

                                        break;

                                }

								

                                if(!empty($user_feeds)){
									if(is_array($user_feeds)){
               
										$index       = array_rand($user_feeds);

										$user_feed   = $user_feeds[$index];

										$likers = $i->media->getLikers($user_feed->getPk());
									}else{
										$likers = $i->media->getLikers($user_feeds);
									}

                                    $users  = $likers->getUsers();

                                    $users  = removePrivateUser($users);
 
                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Userfeed is null(i)"

                                    );

                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
									$feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									while(empty($feeds)){
										$index      = array_rand($users);
  
										$user       = $users[$index];

										$feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
										   $feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									}
									
									
                                 

                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(i)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){

                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        if(empty($history)){

                                            $like = $i->media->like($feed->getPk());

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($like->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Like Failed(i)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(i)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(i)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(i)"

                                );

                            }


    


                            break;



                        case 'commenters':

                            try {

                                switch ((int)$targets['commenters']) {

                                    case 1:

                                        //Usernames Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                        print_r($user_feeds);
                                        break;



                                    case 2:

                                        //My Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                        print_r($user_feeds);
                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                                print_r($user_feeds);
                                                break;



                                            case 2:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                                print_r($user_feeds);
                                                break;

                                        }

                                        break;

                                }



                                if(!empty($user_feeds) and is_array($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $commenters  = $i->media->getComments($user_feed->getPk());

                                    $users       = $commenters->getComments();

                                    $users       = removePrivateUserComments($users);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Userfeed is null(c)"

                                    );

                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    //$user       = $users[$index]->user;
                                    $user       = $users[$index]->getUser();
									
                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
									$feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									while(empty($feeds)){ 
										$index      = array_rand($users);
  
										$user       = $users[$index];

										$feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
										 $feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									}								
                                   

                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);
  
                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(c)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){



                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();
										//$history = array();
                                        if(empty($history)){

                                            $like = $i->media->like($feed->getPk());

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($like->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Like Failed(c)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(c)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(c)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(c)"

                                );

                            }

                            break;

                    }  



                    return $response;

                    break;
    


                case 'comment':

                    $targets          = (array)json_decode($data->title);

                    $target       = array_rand((array)json_decode($data->title));



                    $tags             = (array)json_decode($data->description);

                    $tag_index        = array_rand((array)json_decode($data->description));



                    $locations        = (array)json_decode($data->url);

                    $location_index   = array_rand((array)json_decode($data->url));



                    $usernames        = (array)json_decode($data->image);

                    $username_index   = array_rand((array)json_decode($data->image));



                    $comments         = (array)json_decode($data->comment);

                    $comment_index    = array_rand((array)json_decode($data->comment));



                    $tag              = @$spintax->process($tags[$tag_index]);

                    $location         = @$spintax->process($locations[$location_index]);

                    $username         = @$spintax->process($usernames[$username_index]);

                    $comment          = @$spintax->process($comments[$comment_index]);

					echo '===target==='.$target.'</br>';

                    switch ($target) {

                        case 'location':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $location);

                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after filter(l)"

                                    );

                                }

                                if(!empty($feeds) && is_array($feeds)){





                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                    $feed   = Instagram_Filter_Item($feed->user, $data->filter, 'user', $i);

                                    $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                    if(empty($history)){

                                        $comment = $i->media->comment($feed->getPk(), $comment);

                                        //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                        if($comment->getStatus() == "ok"){

                                            $response = array(

                                                "st"      => "success",

                                                "data"    => json_encode($feed),

                                                "code"    => $feed->getCode(),

                                                "txt"     => l('Successfully')

                                            );

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "Comment Failed(l)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "History is not null(l)"

                                        );

                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist filter(l)"

                                    );

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'username':

                            try {

                                $feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after filter(u)"

                                    );

                                }

                                if(!empty($feeds) && is_array($feeds)){





                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                    $feed   = Instagram_Filter_Item($user, $data->filter, 'user', $i);

                                    $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                    if(empty($history)){

                                        $comment = $i->media->comment($feed->getPk(), $comment);

                                        //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                        if($comment->getStatus() == "ok"){

                                            $response = array(

                                                "st"      => "success",

                                                "data"    => json_encode($feed),

                                                "code"    => $feed->getCode(),

                                                "txt"     => l('Successfully')

                                            );

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "Comment Failed(u)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "History is not null(u)"

                                        );

                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist filter(u)"

                                    );

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'tag':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $tag);

                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after filter(t)"

                                    );

                                }

                                if(!empty($feeds) && is_array($feeds)){



                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];
									 
  
                                    $feed   = Instagram_Filter_Item($feed->getUser(), $data->filter, 'user', $i);

                                    $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                    if(empty($history)){

                                        $comment = $i->media->comment($feed->getPk(), $comment);

                                        //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                        if($comment->getStatus() == "ok"){

                                            $response = array(

                                                "st"      => "success",

                                                "data"    => json_encode($feed),

                                                "code"    => $feed->getCode(),

                                                "txt"     => l('Successfully')

                                            );

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "Comment Failed(t)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "History is not null(t)"

                                        );

                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist filter(t)"

                                    );

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'followers':

                            try {

                                switch ((int)$targets['followers']) {

                                    case 1:

                                        //Usernames

                                        $users  = Instagram_Get_Feed($i, "user_followers", $username);

                                        break;



                                    case 2:

                                        //My Account

                                        $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:

                                                $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);

                                                break;



                                            case 1:

                                                $users  = Instagram_Get_Feed($i, "user_followers", $username);

                                                break;

                                        }

                                        break;

                                }



                                //$users = removePrivateUser($users);

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                    $feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(f)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){





                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        if(empty($history)){

                                            $comment = $i->media->comment($feed->getPk(), $comment);

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($comment->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Comment Failed(f)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(f)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(f)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(f)"

                                );

                            }

                            break;



                        case 'followings':

                            try {

                                switch ((int)$targets['followings']) {

                                    case 1:

                                        //Usernames

                                        $users  = Instagram_Get_Feed($i, "user_following", $username);

                                        break;



                                    case 2:

                                        //My Account

                                        $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:

                                                $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);

                                                break;



                                            case 1:

                                                $users  = Instagram_Get_Feed($i, "user_following", $username);

                                                break;

                                        }

                                        break;

                                }

                                //$users = removePrivateUser($users);

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());
									
									echo 'Before filter  '.count($feeds).'<br>';
                                    $feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");
									echo 'After filter  '.count($feeds); 
                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(n)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){





                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        if(empty($history)){

                                            $comment = $i->media->comment($feed->getPk(), $comment);

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($comment->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Comment Failed(n)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(n)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(n)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(n)"

                                );

                            }

                            break;



                        case 'likers':

                            try {

                                switch ((int)$targets['likers']) {

                                    case 1:

                                        //Usernames Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                        break;



                                    case 2:

                                        //My Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                                break;



                                            case 2:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                                break;

                                        }

                                        break;

                                }



                                if(!empty($user_feeds) and is_array($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $likers = $i->media->getLikers($user_feed->getPk());

                                    $users  = $likers->getUsers();

                                    $users  = removePrivateUser($users);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Userfeed is null(i)"

                                    );

                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                    $feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(i)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){



                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        if(empty($history)){

                                            $comment = $i->media->comment($feed->getPk(), $comment);

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($comment->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Comment Failed(i)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(i)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(i)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(i)"

                                );

                            }





                            break;



                        case 'commenters':

                            try {

                                switch ((int)$targets['commenters']) {

                                    case 1:

                                        //Usernames Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                        break;



                                    case 2:

                                        //My Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                                break;



                                            case 2:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                                break;

                                        }

                                        break;

                                }



                                if(!empty($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $commenters  = $i->media->getComments($user_feed->getPk());

                                    $users       = $commenters->getComments();

                                    $users       = removePrivateUserComments($users);

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Userfeed is null(c)"

                                    );

                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                try {

                                    $index      = array_rand($users);

                                    $user       = $users[$index]->getUser();

                                    $feeds      = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                    $feeds      = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                    if(!empty($feeds)&&is_array($feeds)){

                                        $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(c)"

                                        );

                                    }

                                    if(!empty($feeds) && is_array($feeds)){





                                        $index  = array_rand($feeds);

                                        $feed   = $feeds[$index];

                                        $history = $CI->db->select("*")->where("pk", $feed->getCode())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        if(empty($history)){

                                            $comment = $i->media->comment($feed->getPk(), $comment);

                                            //echo "<a href='https://instagram.com/p/".$feed->code."' target='_blank'>".$feed->code."</a>";

                                            if($comment->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($feed),

                                                    "code"    => $feed->getCode(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Comment Failed(c)"

                                                );

                                            }

                                        }else{

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "History is not null(c)"

                                            );

                                        }

                                    }else{

                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(c)"

                                        );

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }else{

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => "User is blank after private filter(c)"

                                );

                            }

                            break;

                    }



                    return $response;

                    break;



                case 'follow':

                    $targets          = (array)json_decode($data->title);

                    $target           = array_rand((array)json_decode($data->title));

                    $tags             = (array)json_decode($data->description);

                    $tag_index        = array_rand((array)json_decode($data->description));



                    $locations        = (array)json_decode($data->url);

                    $location_index   = array_rand((array)json_decode($data->url));



                    $usernames        = (array)json_decode($data->image);

                    $username_index   = array_rand((array)json_decode($data->image));



                    $tag              = @$spintax->process($tags[$tag_index]);

                    $location         = @$spintax->process($locations[$location_index]);

                    $username         = @$spintax->process($usernames[$username_index]);


                    //echo "<pre>";
                    switch ($target) {

                        case 'location':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $location);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    if(!empty($feeds) && is_array($feeds)){

                                        $user = false;

                                        $count = 0;
                                        foreach ($feeds as $key => $val) {

                                            $user   = Instagram_Filter_Item($val->getUser(), $data->filter, 'user', $i,'location');
                                            if(!empty($user)){

                                                $user = $val->getUser();
                                                break;
                                            }

                                            $count ++;
                                        }


                                        if(!empty($user)){

                                            $follow = $i->people->follow($user->getPk());

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Following failed(l)"

                                                );

                                            }

                                        }else{
                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "User is blank after filter(l)"

                                            );
                                        }
                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "feed is blank after blacklist(l)"

                                        );
                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Feed is null(l)"

                                    );

                                }



                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error ",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'username':

                            try {

                                $follow_types  = array("user_following","user_followers");

                                $follow_index  = array_rand($follow_types);

                                $follow_type   = $follow_types[$follow_index];



                                $users  = Instagram_Get_Feed($i, $follow_type, $username);

                                $users = removeUserBlackLists($users,$blacklist_usernames);

                                if(!empty($users)){

                                    $user = false;
                                    $count = 0;
                                    foreach ($users as $key => $val) {

                                        $user   = Instagram_Filter_Item($val->getUser(), $data->filter, 'user', $i,'username');
                                        if(!empty($user)){

                                            $user = $val->getUser();
                                            break;
                                        }

                                        $count ++;
                                    }

                                    if(!empty($user)){


                                                $follow = $i->people->follow($user->getPk());

                                                if($follow->getStatus() == "ok"){

                                                    $response = array(

                                                        "st"      => "success",

                                                        "data"    => json_encode($user),

                                                        "code"    => $user->getUsername(),

                                                        "txt"     => l('Successfully')

                                                    );

                                                }else{
                                                    $response = array(

                                                        "st"      => "error",

                                                        "txt"     => "Following failed(u)"

                                                    );
                                                }

                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after filter(u)"

                                        );
                                    }

                                }else{
                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after blacklist(u)"

                                    );
                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );
                            }

                            break;



                        case 'tag':

                            try {
                                //echo $data->username."tag";
                                $feeds  = Instagram_Get_Feed($i, $target, $tag);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                    if(!empty($feeds) && is_array($feeds)){

                                        $user = false;
                                        $count = 0;
                                        foreach ($feeds as $key => $val) {

                                            $user   = @Instagram_Filter_Item($val->getUser(), $data->filter, 'user', $i,'tag');
                                            if(!empty($user)){
                                                echo 3;
                                                $user = $val->getUser();
                                                break;
                                            }

                                            $count ++;
                                        }


                                        if(!empty($user)){


                                            $follow = $i->people->follow($user->getPk());


                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }else{
                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "Following failed(t)"

                                                );
                                            }


                                        }else{
                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "User is blank after filter(t)"

                                            );
                                        }

                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "Feed is blank after blacklist(t)"

                                        );
                                    }

                                }else{
                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Feed is blank(t)"

                                    );
                                }


                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;

                        case 'followers':

                            try {

                                switch ((int)$targets['followers']) {

                                    case 1:

                                        //Usernames
                                       // echo "f1";

                                        $sdm = 1;

                                        $users  = Instagram_Get_Feed($i, "user_followers", $username);

                                        break;

                                    case 2:

                                        //My Account

                                        $sdm = 2;
                                        echo "f2";
//                                        $users  = Instagram_Get_Feed($i, "user_followers", $username);
//                                        $users  = Instagram_Get_Feed($i, 'tag', $tag);
                                        $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);

                                        break;

                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:
                                                echo "f32";

                                                $sdm = 2;
                                                $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);
//                                                $users  = Instagram_Get_Feed($i, "user_followers", $username);
//                                                $users  = Instagram_Get_Feed($i, 'tag', $tag);


                                                break;



                                            case 1:
                                                echo "f31";

                                                $sdm = 1;
                                                $users  = Instagram_Get_Feed($i, "user_followers", $username);

                                                break;

                                        }

                                        break;

                                }

                                //echo $data->username."fol";

                                //$users = removePrivateUser($users);

                                //Activity

                                if(!empty($users)){

                                    $users = removeUserBlackLists($users,$blacklist_usernames);


                                    if(!empty($users)){

                                        try {

                                            $user = false;
                                            $count = 0;
                                            foreach ($users as $key => $val) {

                                                $user   = Instagram_Filter_Item($val, $data->filter, 'user', $i,'followers',$data->category,$data->account_id);
                                                if(!empty($user)){
                                                    echo 4;
                                                    $user = $val;
                                                    break;
                                                }

                                                $count ++;
                                            }


                                            if(!empty($user)){

                                                $follow = $i->people->follow($user->getPk());


                                                if($follow->getStatus() == "ok"){

                                                    $response = array(

                                                        "st"      => "success",

                                                        "data"    => json_encode($user),

                                                        "code"    => $user->getUsername(),

                                                        "txt"     => l('Successfully'),

                                                        "sdm"    => $sdm

                                                    );

                                                }else{
                                                    $response = array(

                                                        "st"      => "error",

                                                        "txt"     => "Following Failed(f)"

                                                    );
                                                }

                                            }else{
                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "User is blank after filter(f)"

                                                );
                                            }

                                        } catch (Exception $e){

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => $e->getMessage()

                                            );
                                        }

                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after Blacklist filter(f)"

                                        );
                                    }

                                }else{
                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after private filter(f)"

                                    );
                                }


                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'followings':

                            try {

                                switch ((int)$targets['followings']) {

                                    case 1:

                                        //Usernames
                                       // echo "n1";
                                        $users  = Instagram_Get_Feed($i, "user_following", $username);

                                        break;



                                    case 2:

                                        //My Account
                                      //  echo "n2";
                                        $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);
//                                        $users  = Instagram_Get_Feed($i, "user_following", $username);
//                                        $users  = Instagram_Get_Feed($i, 'tag', $tag);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:
                                               // echo "n32";
                                                $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);
//                                                $users  = Instagram_Get_Feed($i, "user_following", $username);
//                                                $users  = Instagram_Get_Feed($i, 'tag', $tag);

                                                break;



                                            case 1:
                                                echo "n31";
                                                $users  = Instagram_Get_Feed($i, "user_following", $username);

                                                break;

                                        }

                                        break;

                                }
                               // echo $data->username."ing";

                                //$users = removePrivateUser($users);

                                //Activity

                                if(!empty($users)){

                                    $users = removeUserBlackLists($users,$blacklist_usernames);


                                    if(!empty($users)){

                                        try {

                                            $user = false;
                                            $count = 0;
                                            foreach ($users as $key => $val) {

                                                $user   = Instagram_Filter_Item($val, $data->filter, 'user', $i,'followings',$data->category,$data->account_id);
                                                if(!empty($user)){
                                                    echo 5;
                                                    $user = $val;
                                                    break;
                                                }

                                                $count ++;
                                            }


                                            if(!empty($user)){

                                                $follow = $i->people->follow($user->getPk());

                                                if($follow->getStatus() == "ok"){

                                                    $response = array(

                                                        "st"      => "success",

                                                        "data"    => json_encode($user),

                                                        "code"    => $user->getUsername(),

                                                        "txt"     => l('Successfully')

                                                    );

                                                }else{
                                                    $response = array(

                                                        "st"      => "error",

                                                        "txt"     => "Following failed(n)"

                                                    );
                                                }

                                            }else{
                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => "User is blank after filter(n)"

                                                );
                                            }

                                        } catch (Exception $e){

                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => $e->getMessage()

                                            );
                                        }

                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after blacklist filter(n)"

                                        );
                                    }

                                }else{

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "User is blank after private filter(n)"

                                    );
                                }

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'likers':

                            try {

                                switch ((int)$targets['likers']) {

                                    case 1:

                                        //Usernames Post
                                        echo "l1";
                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                        break;



                                    case 2:

                                        //My Post
                                        echo "l2";
                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                        $user_feeds  = Instagram_Get_Feed($i, 'tag', $tag);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:
                                                echo "l31";
                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                                break;



                                            case 2:
                                                echo "l32";
                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                                $user_feeds  = Instagram_Get_Feed($i, 'tag', $tag);

                                                break;

                                        }

                                        break;

                                }
                                echo $data->username."lik";


                                if(!empty($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $likers = $i->media->getLikers($user_feed->getPk());

                                    $users  = $likers->getUsers();

                                    $users  = removePrivateUser($users);


                                    //Activity

                                    if(!empty($users)){

                                        $users = removeUserBlackLists($users,$blacklist_usernames);

                                        if(!empty($users)){

                                            try {

                                                $user = false;
                                                $count = 0;
                                                foreach ($users as $key => $val) {

                                                    $user   = Instagram_Filter_Item($val, $data->filter, 'user', $i,'likers',$data->category,$data->account_id);
                                                    if(!empty($user)){
                                                        echo 6;
                                                        $user = $val;
                                                        break;
                                                    }

                                                    $count ++;
                                                }

                                                if(!empty($user)){


                                                    $follow = $i->people->follow($user->getPk());

                                                    if($follow->getStatus() == "ok"){

                                                        $response = array(

                                                            "st"      => "success",

                                                            "data"    => json_encode($user),

                                                            "code"    => $user->getUsername(),

                                                            "txt"     => l('Successfully')

                                                        );

                                                    }else{
                                                        $response = array(

                                                            "st"      => "error",

                                                            "txt"     => "Following Failed(i)"

                                                        );
                                                    }

                                                }else{
                                                    $response = array(

                                                        "st"      => "error",

                                                        "txt"     => "User is blank after filter(i)"

                                                    );
                                                }

                                            } catch (Exception $e){

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => $e->getMessage()

                                                );

                                            }

                                        }else{
                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "User is blank after blacklist filter(i)"

                                            );
                                        }

                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after private filter(i)"

                                        );
                                    }

                                }else{
                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Userfeed is null(i)"

                                    );
                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'commenters':

                            try {

                                switch ((int)$targets['commenters']) {

                                    case 1:

                                        //Usernames Post
                                        echo "c1";
                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                        break;



                                    case 2:

                                        //My Post
                                        echo "c2";
                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                        $user_feeds  = Instagram_Get_Feed($i, 'tag', $tag);


                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:
                                                echo "c31";
                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                                break;



                                            case 2:
                                                echo "c32";
                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);
//                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);
//                                                $user_feeds  = Instagram_Get_Feed($i, 'tag', $tag);


                                                break;

                                        }

                                        break;

                                }

                                echo $data->username."com";


                                if(!empty($user_feeds) and  is_array($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $commenters  = $i->media->getComments($user_feed->getPk());

                                    $users       = $commenters->getComments();

                                    $users       = removePrivateUserComments($users);


                                    //Activity

                                    if(!empty($users)){

                                        $users = removeUserCommentBlacklists($users,$blacklist_usernames);

                                        if(!empty($users)){

                                            try {

                                                $user = false;
                                                $count = 0;
                                                foreach ($users as $key => $val) {

                                                    $user   = Instagram_Filter_Item($val, $data->filter, 'user', $i,'commenters',$data->category,$data->account_id);
                                                    if(!empty($user)){
                                                        echo 7;
                                                        $user = $val;
                                                        break; 
                                                    }

                                                    $count ++;
                                                }


                                                if(!empty($user)){

                                                    $follow = $i->people->follow($user->getPk());

                                                    if($follow->getStatus() == "ok"){

                                                        $response = array(

                                                            "st"      => "success",

                                                            "data"    => json_encode($user),

                                                            "code"    => $user->getUsername(),

                                                            "txt"     => l('Successfully')

                                                        );

                                                    }else{
                                                        $response = array(

                                                            "st"      => "error",

                                                            "txt"     => "Following Failed(c)"

                                                        );
                                                    }


                                                }else{
                                                    $response = array(

                                                        "st"      => "error",

                                                        "txt"     => "User is blank after filter(c)"

                                                    );
                                                }

                                            } catch (Exception $e){

                                                $response = array(

                                                    "st"      => "error",

                                                    "txt"     => $e->getMessage()

                                                );
                                            }

                                        }else{
                                            $response = array(

                                                "st"      => "error",

                                                "txt"     => "User is blank after blacklist filter(c)"

                                            );
                                        }

                                    }else{
                                        $response = array(

                                            "st"      => "error",

                                            "txt"     => "User is blank after private filter(c)"

                                        );
                                    }


                                }else{
                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => "Userfeed is null(c)"

                                    );
                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                    }

                    return $response;

                    break;



                case 'like_follow':

                    $targets          = (array)json_decode($data->title);

                    $target           = array_rand((array)json_decode($data->title));



                    $tags             = (array)json_decode($data->description);

                    $tag_index        = array_rand((array)json_decode($data->description));



                    $locations        = (array)json_decode($data->url);

                    $location_index   = array_rand((array)json_decode($data->url));



                    $usernames        = (array)json_decode($data->image);

                    $username_index   = array_rand((array)json_decode($data->image));



                    $tag              = @$spintax->process($tags[$tag_index]);

                    $location         = @$spintax->process($locations[$location_index]);

                    $username         = @$spintax->process($usernames[$username_index]);



                    switch ($target) {

                        case 'location':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $location);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }

                                if(!empty($feeds) && is_array($feeds)){



                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                    $user   = Instagram_Filter_Item($feed->getUser(), $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        if($user->getFriendshipStatus()->getFollowing() == "" && $user->getFriendshipStatus()->getOutgoingRequest() == ""){

                                            $feed_like  = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                            $max_like = rand(3, 5);

                                            $count = 0;

                                            foreach($feed_like as $k => $fl){

                                                if($count < $max_like){

                                                    $i->media->like($fl->getPk());

                                                }else{

                                                    break;

                                                }

                                                $count++;

                                            }



                                            $follow = $i->people->follow($user->getPk());

                                            //echo "<a href='https://instagram.com/".$feed->user->username."' target='_blank'>".$feed->user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                        }

                                    }

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'username':

                            try {

                                $follow_types  = array("user_following","user_followers");

                                $follow_index  = array_rand($follow_types);

                                $follow_type   = $follow_types[$follow_index];



                                $users  = Instagram_Get_Feed($i, $follow_type, $username);

                                if(!empty($users)){

                                    $index  = array_rand($users);

                                    $user   = $users[$index];

                                    $user   = Instagram_Filter_Item($user, $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        $info   = $i->people->getFriendship($user->getPk());

                                        if($info->getStatus() == "ok"){

                                            if($info->getFollowing() == "" && $info->getOutgoingRequest() == ""){

                                                $follow = $i->people->follow($user->getPk());

                                                //echo "<a href='https://instagram.com/".$user->user->username."' target='_blank'>".$user->user->username."</a>";

                                                if($follow->getStatus() == "ok"){

                                                    $response = array(

                                                        "st"      => "success",

                                                        "data"    => json_encode($user),

                                                        "code"    => $user->getUsername(),

                                                        "txt"     => l('Successfully')

                                                    );

                                                }

                                            }

                                        }

                                    }

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'tag':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $tag);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }

                                if(!empty($feeds) && is_array($feeds)){

                                    $index  = @array_rand($feeds);

                                    $feed   = @$feeds[$index];

                                    $user   = @Instagram_Filter_Item($feed->getUser(), $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        if($user->getFriendshipStatus()->getFollowing() == "" && $user->getFriendshipStatus()->getOutgoingRequest() == ""){

                                            $feed_like  = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                            $max_like = rand(3, 5);

                                            $count = 0;

                                            foreach($feed_like as $k => $fl){

                                                if($count < 3){

                                                    $i->media->like($fl->getPk());

                                                }else{

                                                    break;

                                                }

                                                $count++;

                                            }

                                            $follow = $i->people->follow($user->getPk());

                                            //echo "<a href='https://instagram.com/".$feed->user->username."' target='_blank'>".$feed->user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                        }

                                    }

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'followers':

                            try {

                                switch ((int)$targets['followers']) {

                                    case 1:

                                        //Usernames

                                        $users  = Instagram_Get_Feed($i, "user_followers", $username);

                                        break;



                                    case 2:

                                        //My Account

                                        $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:

                                                $users  = Instagram_Get_Feed($i, "user_followers", $data->fid."|".$data->username);

                                                break;



                                            case 1:

                                                $users  = Instagram_Get_Feed($i, "user_followers", $username);

                                                break;

                                        }

                                        break;

                                }



                                //$users = removePrivateUser($users);

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                $users = removeUserBlackLists($users,$blacklist_usernames);

                            }

                            if(!empty($users)){

                                try {



                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $user       = Instagram_Filter_Item($user, $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        $history = $CI->db->select("*")->where("pk", $user->getUsername())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        $userFriendship = $i->people->getFriendship($user->getPk());

                                        if(empty($history) && $userFriendship->getFollowing() == "" && $userFriendship->getOutgoingRequest() == ""){

                                            $feed_like  = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                            $max_like = rand(3, 5);

                                            $count = 0;

                                            foreach($feed_like as $k => $fl){

                                                if($count < 3){

                                                    $i->media->like($fl->getPk());

                                                }else{

                                                    break;

                                                }

                                                $count++;

                                            }



                                            $follow = $i->people->follow($user->getPk());

                                            //echo "<a href='https://instagram.com/".$user->username."' target='_blank'>".$user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                        }

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }

                            break;



                        case 'followings':

                            try {

                                switch ((int)$targets['followings']) {

                                    case 1:

                                        //Usernames

                                        $users  = Instagram_Get_Feed($i, "user_following", $username);

                                        break;



                                    case 2:

                                        //My Account

                                        $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 2:

                                                $users  = Instagram_Get_Feed($i, "user_following", $data->fid."|".$data->username);

                                                break;



                                            case 1:

                                                $users  = Instagram_Get_Feed($i, "user_following", $username);

                                                break;

                                        }

                                        break;

                                }



                                //$users = removePrivateUser($users);

                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                $users = removeUserBlackLists($users,$blacklist_usernames);

                            }

                            if(!empty($users)){

                                try {



                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $user       = Instagram_Filter_Item($user, $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        $history = $CI->db->select("*")->where("pk", $user->getUsername())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        $userFriendship = $i->people->getFriendship($user->getPk());

                                        if(empty($history) && $userFriendship->getFollowing() == "" && $userFriendship->getOutgoingRequest() == ""){

                                            $feed_like  = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                            $max_like = rand(3, 5);

                                            $count = 0;

                                            foreach($feed_like as $k => $fl){

                                                if($count < 3){

                                                    $i->media->like($fl->getPk());

                                                }else{

                                                    break;

                                                }

                                                $count++;

                                            }



                                            $follow = $i->people->follow($user->getPk());

                                            //echo "<a href='https://instagram.com/".$user->username."' target='_blank'>".$user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->username,

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                        }

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }

                            break;



                        case 'likers':

                            try {

                                switch ((int)$targets['likers']) {

                                    case 1:

                                        //Usernames Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                        break;



                                    case 2:

                                        //My Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                                break;



                                            case 2:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                                break;

                                        }

                                        break;

                                }



                                if(!empty($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $likers = $i->media->getLikers($user_feed->getPk());

                                    $users  = $likers->getUsers();

                                    $users  = removePrivateUser($users);

                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                $users = removeUserBlackLists($users,$blacklist_usernames);

                            }

                            if(!empty($users)){

                                try {





                                    $index      = array_rand($users);

                                    $user       = $users[$index];

                                    $user       = Instagram_Filter_Item($user, $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        $history = $CI->db->select("*")->where("pk", $user->getUsername())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        $userFriendship = $i->people->getFriendship($user->getPk());

                                        if(empty($history) && $userFriendship->getFollowing() == "" && $userFriendship->getOutgoingRequest() == ""){

                                            $feed_like  = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                            $max_like = rand(3, 5);

                                            $count = 0;

                                            foreach($feed_like as $k => $fl){

                                                if($count < 3){

                                                    $i->media->like($fl->getPk());

                                                }else{

                                                    break;

                                                }

                                                $count++;

                                            }



                                            $follow = $i->people->follow($user->getPk());

                                            //echo "<a href='https://instagram.com/".$user->username."' target='_blank'>".$user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                        }

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }

                            break;



                        case 'commenters':

                            try {

                                switch ((int)$targets['commenters']) {

                                    case 1:

                                        //Usernames Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                        break;



                                    case 2:

                                        //My Post

                                        $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                        break;



                                    case 3:

                                        //All

                                        switch (rand(1, 2)) {

                                            case 1:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $username);

                                                break;



                                            case 2:

                                                $user_feeds  = Instagram_Get_Feed($i, "user_feed", $data->fid."|".$data->username);

                                                break;

                                        }

                                        break;

                                }



                                if(!empty($user_feeds)){

                                    $index       = array_rand($user_feeds);

                                    $user_feed   = $user_feeds[$index];

                                    $commenters  = $i->media->getComments($user_feed->getPk());

                                    $users       = $commenters->getComments();

                                    $users       = removePrivateUserComments($users);

                                }



                            } catch (Exception $e) {

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }



                            //Activity

                            if(!empty($users)){

                                $users = removeUserCommentBlacklists($users,$blacklist_usernames);

                            }

                            if(!empty($users)){

                                try {



                                    $index      = array_rand($users);

                                    $user       = $users[$index]->getUser();

                                    $user       = Instagram_Filter_Item($user, $data->filter, 'user', $i);

                                    if(!empty($user)){

                                        $history = $CI->db->select("*")->where("pk", $user->getUsername())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        $userFriendship = $i->people->getFriendship($user->getPk());

                                        if(empty($history) && $userFriendship->getFollowing() == "" && $userFriendship->getOutgoingRequest() == ""){

                                            $feed_like  = Instagram_Get_Feed($i, "user_feed", $user->getPk()."|".$user->getUsername());

                                            $max_like = rand(3, 5);

                                            $count = 0;

                                            foreach($feed_like as $k => $fl){

                                                if($count < 3){

                                                    $i->media->like($fl->getPk());

                                                }else{

                                                    break;

                                                }

                                                $count++;

                                            }



                                            $follow = $i->people->follow($user->getPk());

                                            //echo "<a href='https://instagram.com/".$user->username."' target='_blank'>".$user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                        }

                                    }

                                } catch (Exception $e){

                                    $response = array(

                                        "st"      => "error",

                                        "txt"     => $e->getMessage()

                                    );

                                }

                            }

                            break;



                    }

                    return $response;

                    break;



                case 'followback':

                    try {

                        $users  = Instagram_Get_Feed($i, "following_recent_activity");



                        if(!empty($users)&&is_array($users)){

                            $users = removeUserFollowBackBlacklist($users,$blacklist_usernames);

                        }

                        if(!empty($users)){

                            foreach ($users as $user) {

                                if(!empty($user)){



                                    $info   = $i->people->getFriendship($user->getId());



                                    if($info->getStatus() == "ok"){

                                        $history = $CI->db->select("*")->where("pk", $user->getUsername())->where("type", $data->category)->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                                        if(empty($history) && $info->getFollowing() == "" && $info->getOutgoingRequest() == "" && $info->getFollowedBy() == 1){

                                            $follow = $i->people->follow($user->getId());

                                            //echo "<a href='https://instagram.com/".$user->username."' target='_blank'>".$user->username."</a>";

                                            if($follow->getStatus() == "ok"){

                                                $messages         = (array)json_decode($data->message);

                                                $message_index    = array_rand((array)json_decode($data->message));

                                                if(!empty($messages)){

                                                    $message          = $spintax->process($messages[$message_index]);

                                                    if($message != ""){

                                                        $mess = $i->direct->sendText(['users' => [$user->getId()]], $message);

                                                    }

                                                }

                                                $user->setPk($user->getId());

                                                $response = array(

                                                    "st"      => "success",

                                                    "data"    => json_encode($user),

                                                    "code"    => $user->getUsername(),

                                                    "txt"     => l('Successfully')

                                                );

                                            }

                                            break;

                                        }

                                    }

                                }

                            }



                        }

                    } catch (Exception $e){

                        $response = array(

                            "st"      => "error",

                            "txt"     => $e->getMessage()

                        );

                    }

                    return $response;

                    break;



                case 'unfollow':
                    $unfollow = $data->description;
					$unfollow = json_decode($unfollow);  
                    if(!empty($data->description) and $data->description != 'null' and $data->description !=  null){ 

						$unfollow_source = !empty($unfollow->unfollow_source)?$unfollow->unfollow_source:0;

						$unfollow_followers = !empty($unfollow->unfollow_followers)?$unfollow->unfollow_followers:0;

						$unfollow_follow_age = !empty($unfollow->unfollow_follow_age)?$unfollow->unfollow_follow_age:0;
					}else{
						$unfollow_source = 2;
						$unfollow_followers = 1; 
						$unfollow_follow_age = 86400;
					}
					
					if($unfollow_followers==1||$unfollow_source==2){
 
							$account_id = $data->account_id;

							$users      =   $CI->db

								->select('followed_username')

								->from(INSTAGRAM_ACCOUNTS)

								->where("id",$account_id)

								->get()->row()->followed_username;


							if(!empty($users)){

								$users_tmp = (array)json_decode($users);

							}else{

								$response = array(

									"st"      => "error",

									"txt"     => "Followers is null"

								);

							}


							if(!empty($users_tmp) and isset($users_tmp)){
							foreach($users_tmp as $key => $value){

								$check_date = strtotime(NOW) - $value;

								if($check_date < $unfollow_follow_age){
									unset($users_tmp[$key]);
								}
							}
							}

						
							if($unfollow_follow_age!=0){

								if(!empty($users_tmp)){

									$time_limit = strtotime(NOW) - $unfollow_follow_age;

									$users_tmp = array_filter($users_tmp,array(new LowerThanFilter($time_limit),"isLower"));

								}else{

									$response = array(

										"st"      => "error",

										"txt"     => "Followers is null after json decode"

									);

								}


							}

							if(!empty($users_tmp)){

								$users_tmp= removeUserUnFollowBackBlacklist($users_tmp,$blacklist_usernames);

							}else{

								$response = array(

									"st"      => "error",

									"txt"     => "Followers is null after json decode"

								);

							}


						try {

							if(!empty($users_tmp)){

								//print_r($users_tmp);

								$index      = array_rand($users_tmp);

								$user_data  = explode("@",$index);

								$user = array(

									"pk"                => $user_data[0],

									"username"          => $user_data[1],

								);

								//echo $user["pk"];

								$unfollow = $i->people->unfollow($user["pk"]);

								//print_r($unfollow);

								if($unfollow->getStatus() == "ok"){

									$users_all = (array)json_decode($users);

									unset($users_all[$index]);

									//print_r(json_encode($users_all));

									$CI->db->update(INSTAGRAM_ACCOUNTS,

										array("followed_username"=>json_encode($users_all)),

										"`id` = '".$account_id."'"

									);

									$response = array(

										"st"      => "success",

										"data"    => json_encode($user),

										"code"    => $user["username"],

										"txt"     => l('Successfully')

									);

								}else{

									$response = array(

										"st"      => "error",

										"txt"     => "Unfollow Failed"

									);

								}

							}else{

								$response = array(

									"st"      => "error",

									"txt"     => "Followers is null after Blacklist"

								);

							}



						} catch (Exception $e){

							$response = array(

								"st"      => "error",

								"txt"     => $e->getMessage()

							);

						}

					}else if($unfollow_source==1&&$unfollow_followers==0){ 

						try {

							$users = $i->people->getSelfInfo();

							$following = $users->getUser()->getFollowingCount();

							if($following != 0){

							try { 


								$usersfeed  = Instagram_Get_Feed($i, 'following');



								$account_id = $data->account_id;

								$users      =   $CI->db

									->select('followed_username')

									->from(INSTAGRAM_ACCOUNTS)

									->where("id",$account_id)

									->get()->row()->followed_username;


								$letuser = array();

								$users_tmp_new = (array)json_decode($users);

									foreach($users_tmp_new as $key => $value) {

										$check_date = strtotime(NOW) - $value;

										if($check_date > $unfollow_follow_age){

											$newdata = explode('@',$key);

											array_push($letuser,$newdata[0]);

										}

									}
								if(!empty($letuser)){ 
									foreach($letuser as $row) {
										foreach($usersfeed as $key => $value) {

	//                                        echo "<br>";
	//                                        echo $value->getPk();


											if($row == $value->getPk()){

												unset($usersfeed[$key]);

											}


										}
									}

								}
//
//                                print_r($letuser);
//                                print_r($usersfeed);
//                                die();

								if(!empty($usersfeed)){

									$index  = array_rand($usersfeed);

									$user   = $usersfeed[$index];

//                                    print_r($user);

//                                    echo $user->getPk();

									$unfollow = $i->people->unfollow($user->getPk());

//                                    print_r($unfollow);

									if($unfollow->getStatus() == "ok"){




										if(!empty($users)){

											$users_tmp = (array)json_decode($users);

											if(!empty($users_tmp)){

												$da = '';

												foreach($users_tmp as $key => $value) {
													$newdata = explode('@',$key);
													if($newdata[0] == $user->getPk()){

														$da = $key;
														break;

													}
												}

												if($da != ''){
													unset($users_tmp[$da]);

													$CI->db->update(INSTAGRAM_ACCOUNTS,

														array("followed_username"=>json_encode($users_tmp)),

														"`id` = '".$account_id."'"

													);

												}
											}

										}

										$response = array(

											"st"      => "success",

											"data"    => json_encode($user),

											"code"    => $user->getUsername(),

											"txt"     => l('Successfully')

										);

									}else{

										$response = array(

											"st"      => "error",

											"txt"     => "Unfollow Failed"

										);

									}

								}else{

									$response = array(

										"st"      => "error",

//                                        "txt"     => "User is blank after Blacklist filter"
										"txt"     => "Userfeed is null"

									);

								}

							} catch (Exception $e){

								$response = array(

									"st"      => "error",

									"txt"     => $e->getMessage()

								);

							}

							}else{

								$response = array(

									"st"      => "error",

									"txt"     => "Empty Following"

								);

							}



						} catch (Exception $e){

							$response = array(

								"st"      => "error",

								"txt"     => $e->getMessage()

							);

						}

					}
					
                    return $response;

                    break;



                case 'deletemedia':

                    try {

                        $feeds  = Instagram_Get_Feed($i, "your_feed", "");

                        if(!empty($feeds) && is_array($feeds)){

                            $index  = @array_rand($feeds);

                            $feed   = @$feeds[$index];

                            $delete = $i->media->delete($feed->getId());

                            //echo "<a href='https://instagram.com/".$feed->code."' target='_blank'>".$feed->code."</a>";

                            if($delete->getStatus() == "ok"){

                                $response = array(

                                    "st"      => "success",

                                    "data"    => json_encode($feed),

                                    "code"    => $feed->getCode(),

                                    "txt"     => l('Successfully')

                                );

                            }

                        }

                    } catch (Exception $e){

                        $response = array(

                            "st"      => "error",

                            "txt"     => $e->getMessage()

                        );

                    }



                    return $response;

                    break;



                case 'repost':
                    die("");
                    $targets          = (array)json_decode($data->title);

                    $target           = array_rand((array)json_decode($data->title));



                    $tags             = (array)json_decode($data->description);

                    $tag_index        = array_rand((array)json_decode($data->description));



                    $locations        = (array)json_decode($data->url);

                    $location_index   = array_rand((array)json_decode($data->url));



                    $usernames        = (array)json_decode($data->image);

                    $username_index   = array_rand((array)json_decode($data->image));



                    $tag              = @$spintax->process($tags[$tag_index]);

                    $location         = @$spintax->process($locations[$location_index]);

                    $username         = @$spintax->process($usernames[$username_index]);



                    $feed             = array();



                    switch ($target) {

                        case 'location':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $location);

                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                $feeds  = removeFeedVideo($feeds);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }

                                if(!empty($feeds) && is_array($feeds)){
                                    $index  = array_rand($feeds);
                                    $feed   = $feeds[$index];
                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'username':

                            try {

                                $feeds  = Instagram_Get_Feed($i, 'user_feed', $username);

                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                $feeds  = removeFeedVideo($feeds);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }

                                if(!empty($feeds) && is_array($feeds)){

                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;



                        case 'tag':

                            try {

                                $feeds  = Instagram_Get_Feed($i, $target, $tag);

                                $feeds  = Instagram_Filter($feeds, $data->filter, $data->timezone, "feed");

                                $feeds  = removeFeedVideo($feeds);

                                if(!empty($feeds)&&is_array($feeds)){

                                    $feeds=removeFeedBlackLists($feeds,$blacklist_tags,$blacklist_usernames,$blacklist_keywords);

                                }

                                if(!empty($feeds) && is_array($feeds)){



                                    $index  = array_rand($feeds);

                                    $feed   = $feeds[$index];

                                }

                            } catch (Exception $e){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $e->getMessage()

                                );

                            }

                            break;

                    }



                    if(isset($feed) && !empty($feed)){

                        $CI = &get_instance();

                        $history = $CI->db->select("*")->where("pk", $feed->getPk())->where("type", "repost")->where("account_id", $data->account_id)->get(INSTAGRAM_HISTORY)->row();

                        if(empty($history)){

                            switch ($feed->getMediaType()) {

                                case 1:
                                    try {
                                        if (!file_exists('app/helpers/up/')) {
                                            mkdir('app/helpers/up/', 0777, true);
                                        }
                                        $url_tmp=explode('.jpg',str_replace('https', 'http', $feed->getImageVersions2()->getCandidates()[0]->getUrl()));
                                        $url_tmp = $url_tmp[0].'.jpg';
                                        // $image_tmp = getImg($url_tmp);
                                        // file_put_contents('app/helpers/up/'."image".$data->username.".jpg",$image_tmp);
                                        copy($url_tmp, 'app/helpers/up/'."image".$data->username.".jpg");
                                        $response =$i->timeline->uploadPhoto('app/helpers/up/'."image".$data->username.".jpg", array("caption" => ($feed->getCaption())?$feed->getCaption()->getText():''));
                                        unlink('app/helpers/up/'."image".$data->username.".jpg");
                                    } catch (Exception $e){
                                        $response = $e->getMessage();
                                    }
                                    break;
                                case 2:

                                    /*try {

                                        $response =$i->uploadTimelineVideo($feed->video_versions[0]->url,  array("caption" => $feed->caption->text));

                                    } catch (Exception $e){

                                        $response = $e->getMessage();

                                    }*/

                                    break;

                            }



                            if( null !== $response->getStatus() && $response->getStatus() == "ok"){

                                $response = array(

                                    "st"      => "success",

                                    "pk"      => $feed->getPk(),

                                    "data"    => json_encode($feed),

                                    "code"    => $feed->getPk(),

                                    "txt"     => l('Successfully')

                                );

                            }



                            if(is_string($response)){

                                $response = array(

                                    "st"      => "error",

                                    "txt"     => $response

                                );

                            }

                        }



                    }



                    return $response;

                    break;



                case 'message':

                    try {

//                        echo "hel";
//                        echo $data->group_id.'--'.$data->message;
                        echo $spintax->process($data->message);

                        $message = $i->direct->sendText(['users' => [$data->group_id]], $spintax->process($data->message)); 

//                        print_r($message);

                        create_log($data->account_name,'message --'.$data->group_id ,$message);

                        if($message->getStatus() == "ok"){

                            $res = $CI->db->insert(
                                FOLLOWERS_DM_MESSAGES,
                                array(
                                    "i_user_id" => $data->fid,
                                    "follower_id" => $data->follower_id,
                                    "message" => $spintax->process($data->message),
                                    "type" => $data->type,
                                    "sent" => 1,
                                    "date" => date("Y-m-d H:i:s")
                                )
                            );

                            $response = array(

                                "st"      => "success",

                                "code"    => $data->name,

                                "txt"     => l('Successfully')

                            );

                        }



                    } catch (Exception $e){

                        $response = array(

                            "st"      => "error",

                            "txt"     => $e->getMessage()

                        );

                        create_log($data->account_name,'message --'.$data->group_id ,$e->getMessage());

                    }



                    return $response;

                    break;

            }

        }else{

            $response["message"] = "Upload failed, Please try again";

           

            $response = (object)array(

                "st"  => "error",

                "txt" => $response["message"]

            );

            return $response;

        }

    }



    function removeElementWithValue($array, $key, $value){

        $array = (array)$array;

         foreach($array as $subKey => $subArray){

            $subArray = (array)$subArray;

              if($subArray[$key] != $value){

                   unset($array[$subKey]);

              }

         }

         return $array;

    }

}


if(!function_exists("publish")){

    function publish($Post)
    {

        $CI = &get_instance();
        // Check availability
        if ($Post == '') {
            // Probably post has been removed manually
            throw new Exception(l("Post is not available!"));
        }


        // Check status
        if ($Post[0]["status"] != "publishing") {
            // Setting post status to "publishing" before passing it
            // to this controller is in responsibility of
            // PostController or CronController
            //
            // Data has been modified by external factors
            throw new Exception(l("Post status is not valid!"));
        }


        // Check type
        $type = $Post[0]["type"];
        if (!in_array($type, ["timeline", "story", "album"])) {
            // Validating post type before passing it
            // to this controller is in responsibility of PostController
            //
            // Data has been modified by external factors

            $msg = l("Post type is not valid!");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();
            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }

        // Check user
        $CI->db->select('*');
        $CI->db->from(USER_MANAGEMENT);
        $CI->db->where("id", $Post[0]["user_id"]);
        $uresp = $CI->db->get();

        $User = $uresp->num_rows()>0?$uresp->result_array():"";

//        $User = Controller::model("User", $Post->get("user_id"));
//        if (!$User->isAvailable() || !$User->get("is_active") || $User->isExpired()) {
        if ($User == '') {

            $msg = l("Your access to the script has been disabled!");
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));
            throw new Exception($msg);

        }

        if ($User[0]["status"] != 1 || !check_expiration($User[0]['expiration_date']) && $User[0]['admin'] !=1) {
            $msg = l("Your access to the script has been disabled!");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));
            throw new Exception($msg);
        }



        // Check account

        $CI->db->select('*');
        $CI->db->from(INSTAGRAM_ACCOUNTS);
        $CI->db->where('id',$Post[0]["account_id"]);
        $accresp2 = $CI->db->get();

        $Account = $accresp2->num_rows()>0?$accresp2->result_array():"";

//        $Account = Controller::model("Account", $Post->get("account_id"));
//        if (!$Account->isAvailable()) {
        if ($Account == '') {
            $msg = l("Account is not available.");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update($msg);

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));
            throw new Exception($msg);
        }
        if ($Account[0]['checkpoint'] != 0) {
            $msg = l("Re-login required for %s", $Account[0]["username"]);
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }

        // Check media ids
//        $user_files_dir = ROOTPATH . "/assets/uploads/" . $User->get("id");

        $homepath = dirname(__FILE__);

        $new_home = str_replace('app/helpers','',$homepath);

        $user_files_dir = $new_home."assets/uploads/". $User[0]["id"];

        $media_ids = explode(",", $Post[0]["media_ids"]);
        foreach ($media_ids as $i => $id) {
            if ((int)$id < 1) {
                unset($media_ids[$i]);
            } else {
                $id = (int)$id;
            }
        }

//        $query = DB::table(TABLE_PREFIX.TABLE_FILES)
//            ->where("user_id", "=", $User->get("id"))
//            ->whereIn("id", $media_ids);
//        $res = $query->get();

        $CI->db->select('*');
        $CI->db->from('files');
        $CI->db->where('user_id',$User[0]["id"]);
        $CI->db->where_in("id", $media_ids);
        $fileresp2 = $CI->db->get();

        $res = $fileresp2->num_rows()>0?$fileresp2->result_array():"";

//        print_r($res);
//        die();

        $valid_media_ids = [];
        $media_data = [];
        foreach ($res as $m) {
            $ext = strtolower(pathinfo($m['filename'], PATHINFO_EXTENSION));
//            $filename = $user_files_dir."/".$m['filename'];
//            if (file_exists($filename)) {
//                echo "The file $filename exists";
//            } else {
//                echo "The file $filename does not exist";
//            }
//            print_t(file_exists($user_files_dir."/".$m['filename']));
//            die();
            if (file_exists($user_files_dir."/".$m['filename']) &&
                in_array($ext, ["jpeg", "jpg", "png", "mp4"])) {
                $valid_media_ids[] = $m['id'];
                $media_data[$m['id']] = $m;
            }
        }

//        print_r($valid_media_ids);
//        die();

//        echo count($media_ids);
//
        foreach ($media_ids as $i => $id) {
            if (!in_array($id, $valid_media_ids)) {
                unset($media_ids[$i]);
            }
        }

        if ($type == "album" && count($media_ids) < 2) {
            $msg = l("At least 2 photo or video is required for the album post.");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        } else if ($type == "story" && count($media_ids) < 1) {
            $msg = l("Couldn't find selected media for the story");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        } else if ($type == "timeline" && count($media_ids) < 1) {
            $msg = l("Couldn't find selected media for the post");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }

        switch ($type) {
            case "timeline":
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

        // Check user permissions
        foreach ($media_ids as $id) {
            $media = $media_data[$id];
            $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));

            if (!in_array($ext, ["mp4","jpg", "jpeg", "png"])) {
                $msg = l("Oops! An error occured. Please try again later!");
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();

                $CI->db->where('id',$Post[0]["id"]);
                $CI->db->update('posts',array("status"=> "failed","data" => $msg));

                throw new Exception($msg);
            }

//            if (in_array($ext, ["mp4"])) {
////                if (!isVideoExtenstionsLoaded()) {
////                    $msg = __("It's not possible to post video files right now!");
////                    $Post->set("status", "failed")
////                         ->set("data", $msg)
////                         ->update();
////                    throw new Exception($msg);
////                }
//
//                $permission = "settings.post_types.".$type."_video";
//            } else if (in_array($ext, ["jpg", "jpeg", "png"])) {
//                $permission = "settings.post_types.".$type."_photo";
//            } else {
//                $msg = __("Oops! An error occured. Please try again later!");
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();
//                throw new Exception($msg);
//            }
//
//            if (!$User->get($permission)) {
//                $permission_errors = [
//                    "settings.post_types.timeline_video" => __("You don't have a permission for video posts."),
//                    "settings.post_types.story_video" => __("You don't have a permission for story videos."),
//                    "settings.post_types.album_video" => __("You don't have a permission for videos in album."),
//                    "settings.post_types.timeline_photo" => __("You don't have a permission for photo posts."),
//                    "settings.post_types.story_photo" => __("You don't have a permission for story photos."),
//                    "settings.post_types.album_photo" => __("You don't have a permission for photos in album.")
//                ];
//
//                if (isset($permission_errors[$permission])) {
//                    $msg = $permission_errors[$permission];
//                } else {
//                    $msg = __("You don't have a permission for this kind of post.");
//                }
//
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();
//                throw new Exception($msg);
//            }
        }


        // Login
        try {

            $CI->db->select('*');
            $CI->db->from(PROXY);
            $CI->db->where('id',$Account[0]['proxy']);
            $proresp2 = $CI->db->get();

            $proxy_item = $proresp2->num_rows()>0?$proresp2->result_array():"";

//            $proxy_item = $this->model->get("*", PROXY, "id = '" . $Account[0]['proxy'] . "'");
            if ($proxy_item != '') {
                $proxy = $proxy_item[0]['proxy'];
            } else {
                $proxy = "";
            }

//            $Instagram = self::login($Account);
            $Instagram = new \InstagramAPI\Instagram(false, false, [

                'storage'    => 'mysql',

                'dbhost'     => DB_HOST,

                'dbname'     => DB_NAME,

                'dbusername' => DB_USER,

                'dbpassword' => DB_PASS,

                'dbtablename'=> INSTAGRAM_DATA

            ]);
            $Instagram->setVerifySSL(false);

            if($proxy != ""){

                $Instagram->setProxy($proxy);

            }

            $Instagram->login($Account[0]['username'], $Account[0]['password']);

            //$ig->login($username, $password);

//            $CI = &get_instance();

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 0), array("username" => $Account[0]['username']));



//            return $ig;

        } catch (Exception $e) {
            $msg = $e->getMessage();
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }



        // Caption
        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
        $caption = $Emojione->shortnameToUnicode($Post[0]["caption"]);
        $caption = mb_substr($caption, 0, 2200);

        // Comment
        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
        $comment = $Emojione->shortnameToUnicode($Post[0]["comment"]);
        $comment = mb_substr($comment, 0, 2200);

        // Check spintax permission
//        if ($User->get("settings.spintax")) {
        if (true) {
            $caption = Spintax::process($caption);
        }

        $location = false;
        $locate = json_decode($Post[0]["location"]);
        if($locate->lat != '' && $locate->long != ''){
//            $location = $Instagram->location->search($locate->lat, $locate->long)->getVenues();
            $location = $Instagram->location->search($locate->lat, $locate->long)->getVenues();

        }

//        print_r($location);
//        die();
        $PlaceArray = explode(",", $locate->placename);
//        $PlaceArray = $locate->placename;
        $placename = '';
        $count = 0;
        foreach ($location as $key => $val) {

            //if ($val->name === $locate->placename) {
//            if (strpos($val->name, $PlaceArray[0]) !== false) {
            if ($val->getLat() == $locate->lat && $val->getLng() == $locate->long && $val->getName() == $locate->placename ) {
                $placename = $key;
                break;
            }
            $count ++;
        }
        $location = $location[$count];


        try {
            if ($type == "timeline") {
                $media = $media_data[$media_ids[0]];
                $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));
                $file_path = $user_files_dir."/".$m['filename'];

//                try {
//                    $location = $Instagram->location->search('40.0', '-100.0')->getVenues()[0];
//                } catch (\Exception $e) {
//                    echo 'Something went wrong: '.$e->getMessage()."\n";
//                }

                if (in_array($ext, ["mp4"])) {

//                    if (!isVideoExtenstionsLoaded()) {
//                        $msg = __("It's not possible to post video files!");
//                        $Post->set("status", "failed")
//                             ->set("data", $msg)
//                             ->update();
//                        throw new Exception($msg);
//                    }

//                    echo $file_path;
//                    die();

//                    $newfile = str_replace("/var/www/html",'',$file_path);
//                    $resp = $Instagram->timeline->uploadVideo($newfile, ["caption" => $caption]);
//
//                    print_r($resp);
//                    die();

                    if($location == false) {

//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path);
//                        $resp = $Instagram->timeline->uploadVideo($video->getFile(), ['caption' => $caption]);

                        $resp = $Instagram->timeline->uploadVideo($file_path, ['caption' => $caption]);


                    }else{

//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path);
//                        $resp = $Instagram->timeline->uploadVideo($video->getFile(), ['caption' => $caption,

                        $resp = $Instagram->timeline->uploadVideo($file_path, ['caption' => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);

//                        $resp = $Instagram->timeline->uploadVideo($file_path, ["caption" => $caption,
//                         'location_sticker' => [
//                            'width'         => 0.89333333333333331,
//                            'height'        => 0.071281859070464776,
//                            'x'             => 0.5,
//                            'y'             => 0.2,
//                            'rotation'      => 0.0,
//                            'is_sticker'    => true,
//                            'location_id'   => $location->getExternalId(),
//                        ],
//                        'location' => $location
//                        ]);
                    }

                } else {
//                    $img = new \InstagramAPI\MediaAutoResizer($file_path, [
//                        "targetFeed" => \InstagramAPI\Constants::FEED_TIMELINE,
//                        "operation" => \InstagramAPI\MediaAutoResizer::CROP
//                    ]);
//                    $resp = $Instagram->timeline->uploadPhoto($img->getFile(), ["caption" => $caption]);
//                    $resp = $Instagram->timeline->uploadPhoto($file_path, ["caption" => $file_path]);

                    if($location == false) {

                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path);
                        $resp = $Instagram->timeline->uploadPhoto($photo->getFile(), ['caption' => $caption]);

                    }else{

                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path);
                        $resp = $Instagram->timeline->uploadPhoto($photo->getFile(), ['caption' => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);

                    }




                }
                // first comment
                $media_id= $resp->getMedia()->getPk();//"1660920548793928997__2508886359";//$resp->id
                $comment = trim($comment);

                if(!empty($comment) AND $comment!='' AND isset($comment)){
                    try{
//                        $commentresp = $Instagram->timeline->comment($media_id, $comment);
                        $commentresp = $Instagram->media->comment($media_id, $comment);
                    }catch (Exception $ex){
                        $msg ='';
                    }

                }


            } else if ($type == "story") {
                $media = $media_data[$media_ids[0]];
                $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));
                $file_path = $user_files_dir."/".$m['filename'];

                if (in_array($ext, ["mp4"])) {
//                    if (!isVideoExtenstionsLoaded()) {
//                        $msg = __("It's not possible to post video files!");
//                        $Post->set("status", "failed")
//                             ->set("data", $msg)
//                             ->update();
//                        throw new Exception($msg);
//                    }

                    if($location == false) {

//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
//                        $resp = $Instagram->story->uploadVideo($video->getFile(), ['caption' => $caption]);

                        $resp = $Instagram->story->uploadVideo($file_path, ['caption' => $caption]);
                    }else{
//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
//                        $resp = $Instagram->story->uploadVideo($video->getFile(), ['caption' => $caption,

                        $resp = $Instagram->story->uploadVideo($file_path, ['caption' => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);
                    }

                } else {
//                    $img = new \InstagramAPI\MediaAutoResizer($file_path, [
//                        "targetFeed" => \InstagramAPI\Constants::FEED_STORY,
//                        "operation" => \InstagramAPI\MediaAutoResizer::CROP,
//                        "minAspectRatio" => \InstagramAPI\MediaAutoResizer::BEST_MIN_STORY_RATIO,
//                        "maxAspectRatio" => \InstagramAPI\MediaAutoResizer::BEST_MAX_STORY_RATIO
//                    ]);
//                    $resp = $Instagram->story->uploadPhoto($img->getFile(), ["caption" => $caption]);
//                    $resp = $Instagram->story->uploadPhoto($file_path, ["caption" => $caption]);
                    if($location == false) {

                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
                        $resp = $Instagram->story->uploadPhoto($photo->getFile(), ["caption" => $caption]);

                    }else{
                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
                        $resp = $Instagram->story->uploadPhoto($photo->getFile(), ["caption" => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);

                    }
                }
            } else if ($type == "album") {
                $album_media = [];
                $temp_files_handlers = [];

                foreach ($media_ids as $id) {
                    $media = $media_data[$id];
                    $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));
                    $file_path = $user_files_dir."/".$media['filename'];

                    if (in_array($ext, ["mp4"])) {
//                        if (!isVideoExtenstionsLoaded()) {
//                            $msg = __("It's not possible to post video files!");
//                            $Post->set("status", "failed")
//                                 ->set("data", $msg)
//                                 ->update();
//                            throw new Exception($msg);
//                        }
                        $media_type = "video";
                    } else {
                        $media_type = "photo";

//                        $temp_files_handlers[] = new \InstagramAPI\MediaAutoResizer($file_path, [
//                            "targetFeed" => \InstagramAPI\Constants::FEED_TIMELINE_ALBUM,
//                            "operation" => \InstagramAPI\MediaAutoResizer::CROP,
//                            "minAspectRatio" => 1,
//                            "maxAspectRatio" => 1
//                        ]);
//                        $file_path = $temp_files_handlers[count($temp_files_handlers) - 1]->getFile();
                    }

                    $album_media[] = [
                        "type" => $media_type,
                        "file" => $file_path
                    ];
                }


                if($location == false) {
                    $resp = $Instagram->timeline->uploadAlbum($album_media, ['caption' => $caption]);
                }else{
                    $resp = $Instagram->timeline->uploadAlbum($album_media, ['caption' => $caption,
                        'location_sticker' => [
                            'width'         => 0.89333333333333331,
                            'height'        => 0.071281859070464776,
                            'x'             => 0.5,
                            'y'             => 0.2,
                            'rotation'      => 0.0,
                            'is_sticker'    => true,
                            'location_id'   => $location->getExternalId(),
                        ],
                        'location' => $location
                    ]);
                }

//                $media_id= $resp->media->id;//"1660920548793928997__2508886359";//$resp->id
                $media_id= $resp->getMedia()->getPk();//"1660920548793928997__2508886359";//$resp->id
                $comment = trim($comment);

                if(!empty($comment) AND $comment!='' AND isset($comment)){
                    try{
//                        $commentresp = $Instagram->timeline->comment($media_id, $comment);
                        $commentresp = $Instagram->media->comment($media_id, $comment);
                    }catch (Exception $ex){
                        $msg ='';
                    }

                }
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();

            // Extract full file path from exception messages
            // Found in configuration and validation error messages
            preg_match('/"[^"]+"/', $msg, $matches);

//            $homepath = dirname(__FILE__);
//            $new_home = str_replace('app/helpers','',$homepath);



//            if ($matches && strpos($matches[0], ROOTPATH) !== false) {
            if ($matches && strpos($matches[0], $new_home) !== false) {
                $invalid_file_path = $matches[0];
//                $invalid_file_url = str_replace($new_home, APPURL, $invalid_file_path);
                $invalid_file_url = str_replace($new_home, BASE, $invalid_file_path);
                $invalid_file_name = basename($invalid_file_path, '"');

                $human_readable_file_name = explode("-", $invalid_file_name, 2);
                $human_readable_file_name = $human_readable_file_name[0];

                $msg = preg_replace('/"[^"]+"/', "<a href=".$invalid_file_url." target='_blank' class='file-link' data-file='".$invalid_file_name."'>".$human_readable_file_name."</a>", $msg);
            }

//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();
            $CI->db->where('id',$Post[0]["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }



//        $ig_media_code = !empty($resp->media->code) ? $resp->media->code : "";
        $ig_media_code = ($resp->getMedia()->getCode() != '') ? $resp->getMedia()->getCode() : "";
        $data = [
//            "upload_id" => !empty($resp->upload_id) ? $resp->upload_id : "",
            "upload_id" => ($resp->getUploadId() != '') ? $resp->getUploadId() : "",
//            "pk" => !empty($resp->media->pk) ? $resp->media->pk : "",
            "pk" => ($resp->getMedia()->getPk() != '') ? $resp->getMedia()->getPk() : "",
//            "id" => !empty($resp->media->id) ? $resp->media->id : "",
            "id" => ($resp->getMedia()->getId() != '') ? $resp->getMedia()->getId() : "",
            "code" => $ig_media_code
        ];
//        $Post->set("status", "published")
//            ->set("data", json_encode($data))
//            ->set("publish_date", date("Y-m-d H:i:s"))
//            ->update();

        $CI->db->where('id',$Post[0]["id"]);
        $CI->db->update('posts',array("status"=> "published","data" => json_encode($data),"publish_date"=> date("Y-m-d H:i:s")));

        return $ig_media_code;
    }

}

if(!function_exists("publish_schedule")){

    function publish_schedule($Post)
    {

//        print_r($Post);
//        die();
        $CI = &get_instance();
        // Check availability
        if ($Post == '') {
            // Probably post has been removed manually
            throw new Exception(l("Post is not available!"));
        }


        // Check status
        if ($Post["status"] != "publishing") {
            // Setting post status to "publishing" before passing it
            // to this controller is in responsibility of
            // PostController or CronController
            //
            // Data has been modified by external factors
            throw new Exception(l("Post status is not valid!"));
        }


        // Check type
        $type = $Post["type"];
        if (!in_array($type, ["timeline", "story", "album"])) {
            // Validating post type before passing it
            // to this controller is in responsibility of PostController
            //
            // Data has been modified by external factors

            $msg = l("Post type is not valid!");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();
            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }

        // Check user
        $CI->db->select('*');
        $CI->db->from(USER_MANAGEMENT);
        $CI->db->where("id", $Post["user_id"]);
        $uresp = $CI->db->get();

        $User = $uresp->num_rows()>0?$uresp->result_array():"";

//        $User = Controller::model("User", $Post->get("user_id"));
//        if (!$User->isAvailable() || !$User->get("is_active") || $User->isExpired()) {
        if ($User == '') {

            $msg = l("Your access to the script has been disabled!");
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));
            throw new Exception($msg);

        }

        if ($User[0]["status"] != 1 || !check_expiration($User[0]['expiration_date']) && $User[0]['admin'] !=1) {
            $msg = l("Your access to the script has been disabled!");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));
            throw new Exception($msg);
        }



        // Check account

        $CI->db->select('*');
        $CI->db->from(INSTAGRAM_ACCOUNTS);
        $CI->db->where('id',$Post["account_id"]);
        $accresp2 = $CI->db->get();

        $Account = $accresp2->num_rows()>0?$accresp2->result_array():"";

//        $Account = Controller::model("Account", $Post->get("account_id"));
//        if (!$Account->isAvailable()) {
        if ($Account == '') {
            $msg = l("Account is not available.");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update($msg);

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));
            throw new Exception($msg);
        }
        if ($Account[0]['checkpoint'] != 0) {
            $msg = l("Re-login required for %s", $Account[0]["username"]);
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }

        // Check media ids
//        $user_files_dir = ROOTPATH . "/assets/uploads/" . $User->get("id");

        $homepath = dirname(__FILE__);

        $new_home = str_replace('app/helpers','',$homepath);

        $user_files_dir = $new_home."assets/uploads/". $User[0]["id"];

        $media_ids = explode(",", $Post["media_ids"]);
        foreach ($media_ids as $i => $id) {
            if ((int)$id < 1) {
                unset($media_ids[$i]);
            } else {
                $id = (int)$id;
            }
        }

//        $query = DB::table(TABLE_PREFIX.TABLE_FILES)
//            ->where("user_id", "=", $User->get("id"))
//            ->whereIn("id", $media_ids);
//        $res = $query->get();

        $CI->db->select('*');
        $CI->db->from('files');
        $CI->db->where('user_id',$User[0]["id"]);
        $CI->db->where_in("id", $media_ids);
        $fileresp2 = $CI->db->get();

        $res = $fileresp2->num_rows()>0?$fileresp2->result_array():"";

//        print_r($res);
//        die();

        $valid_media_ids = [];
        $media_data = [];
        foreach ($res as $m) {
            $ext = strtolower(pathinfo($m['filename'], PATHINFO_EXTENSION));
//            $filename = $user_files_dir."/".$m['filename'];
//            if (file_exists($filename)) {
//                echo "The file $filename exists";
//            } else {
//                echo "The file $filename does not exist";
//            }
//            print_t(file_exists($user_files_dir."/".$m['filename']));
//            die();
            if (file_exists($user_files_dir."/".$m['filename']) &&
                in_array($ext, ["jpeg", "jpg", "png", "mp4"])) {
                $valid_media_ids[] = $m['id'];
                $media_data[$m['id']] = $m;
            }
        }

//        print_r($valid_media_ids);
//        die();

//        echo count($media_ids);
//
        foreach ($media_ids as $i => $id) {
            if (!in_array($id, $valid_media_ids)) {
                unset($media_ids[$i]);
            }
        }

        if ($type == "album" && count($media_ids) < 2) {
            $msg = l("At least 2 photo or video is required for the album post.");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        } else if ($type == "story" && count($media_ids) < 1) {
            $msg = l("Couldn't find selected media for the story");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        } else if ($type == "timeline" && count($media_ids) < 1) {
            $msg = l("Couldn't find selected media for the post");
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }

        switch ($type) {
            case "timeline":
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

        // Check user permissions
        foreach ($media_ids as $id) {
            $media = $media_data[$id];
            $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));

            if (!in_array($ext, ["mp4","jpg", "jpeg", "png"])) {
                $msg = l("Oops! An error occured. Please try again later!");
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();

                $CI->db->where('id',$Post["id"]);
                $CI->db->update('posts',array("status"=> "failed","data" => $msg));

                throw new Exception($msg);
            }

//            if (in_array($ext, ["mp4"])) {
////                if (!isVideoExtenstionsLoaded()) {
////                    $msg = __("It's not possible to post video files right now!");
////                    $Post->set("status", "failed")
////                         ->set("data", $msg)
////                         ->update();
////                    throw new Exception($msg);
////                }
//
//                $permission = "settings.post_types.".$type."_video";
//            } else if (in_array($ext, ["jpg", "jpeg", "png"])) {
//                $permission = "settings.post_types.".$type."_photo";
//            } else {
//                $msg = __("Oops! An error occured. Please try again later!");
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();
//                throw new Exception($msg);
//            }
//
//            if (!$User->get($permission)) {
//                $permission_errors = [
//                    "settings.post_types.timeline_video" => __("You don't have a permission for video posts."),
//                    "settings.post_types.story_video" => __("You don't have a permission for story videos."),
//                    "settings.post_types.album_video" => __("You don't have a permission for videos in album."),
//                    "settings.post_types.timeline_photo" => __("You don't have a permission for photo posts."),
//                    "settings.post_types.story_photo" => __("You don't have a permission for story photos."),
//                    "settings.post_types.album_photo" => __("You don't have a permission for photos in album.")
//                ];
//
//                if (isset($permission_errors[$permission])) {
//                    $msg = $permission_errors[$permission];
//                } else {
//                    $msg = __("You don't have a permission for this kind of post.");
//                }
//
//                $Post->set("status", "failed")
//                    ->set("data", $msg)
//                    ->update();
//                throw new Exception($msg);
//            }
        }


        // Login
        try {

            $CI->db->select('*');
            $CI->db->from(PROXY);
            $CI->db->where('id',$Account[0]['proxy']);
            $proresp2 = $CI->db->get();

            $proxy_item = $proresp2->num_rows()>0?$proresp2->result_array():"";

//            $proxy_item = $this->model->get("*", PROXY, "id = '" . $Account[0]['proxy'] . "'");
            if ($proxy_item != '') {
                $proxy = $proxy_item[0]['proxy'];
            } else {
                $proxy = "";
            }

//            $Instagram = self::login($Account);
            $Instagram = new \InstagramAPI\Instagram(false, false, [

                'storage'    => 'mysql',

                'dbhost'     => DB_HOST,

                'dbname'     => DB_NAME,

                'dbusername' => DB_USER,

                'dbpassword' => DB_PASS,

                'dbtablename'=> INSTAGRAM_DATA

            ]);
            $Instagram->setVerifySSL(false);

            if($proxy != ""){

                $Instagram->setProxy($proxy);

            }

            $Instagram->login($Account[0]['username'], $Account[0]['password']);

            //$ig->login($username, $password);

//            $CI = &get_instance();

            $CI->db->update(INSTAGRAM_ACCOUNTS, array("checkpoint" => 0), array("username" => $Account[0]['username']));



//            return $ig;

        } catch (Exception $e) {
            $msg = $e->getMessage();
//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();

            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }


        require($new_home.'app/libraries/Emojione/autoload.php');
        // Caption
        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
        $caption = $Emojione->shortnameToUnicode($Post["caption"]);
        $caption = mb_substr($caption, 0, 2200);

        // Comment
        $Emojione = new \Emojione\Client(new \Emojione\Ruleset());
        $comment = $Emojione->shortnameToUnicode($Post["comment"]);
        $comment = mb_substr($comment, 0, 2200);

        // Check spintax permission
//        if ($User->get("settings.spintax")) {
        if (true) {
            $caption = Spintax::process($caption);
        }

        $location = false;
        $locate = json_decode($Post["location"]);
        if($locate->lat != '' && $locate->long != ''){
//            $location = $Instagram->location->search($locate->lat, $locate->long)->getVenues();
            $location = $Instagram->location->search($locate->lat, $locate->long)->getVenues();

        }

//        print_r($location);
//        die();
        $PlaceArray = explode(",", $locate->placename);
//        $PlaceArray = $locate->placename;
        $placename = '';
        $count = 0;
        foreach ($location as $key => $val) {

            //if ($val->name === $locate->placename) {
//            if (strpos($val->name, $PlaceArray[0]) !== false) {
            if ($val->getLat() == $locate->lat && $val->getLng() == $locate->long && $val->getName() == $locate->placename ) {
                $placename = $key;
                break;
            }
            $count ++;
        }
        $location = $location[$count];


        try {
            if ($type == "timeline") {
                $media = $media_data[$media_ids[0]];
                $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));
                $file_path = $user_files_dir."/".$m['filename'];

//                try {
//                    $location = $Instagram->location->search('40.0', '-100.0')->getVenues()[0];
//                } catch (\Exception $e) {
//                    echo 'Something went wrong: '.$e->getMessage()."\n";
//                }

                if (in_array($ext, ["mp4"])) {

//                    if (!isVideoExtenstionsLoaded()) {
//                        $msg = __("It's not possible to post video files!");
//                        $Post->set("status", "failed")
//                             ->set("data", $msg)
//                             ->update();
//                        throw new Exception($msg);
//                    }

//                    echo $file_path;
//                    die();

//                    $newfile = str_replace("/var/www/html",'',$file_path);
//                    $resp = $Instagram->timeline->uploadVideo($newfile, ["caption" => $caption]);
//
//                    print_r($resp);
//                    die();

                    if($location == false) {

//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path);
//                        $resp = $Instagram->timeline->uploadVideo($video->getFile(), ['caption' => $caption]);

                        $resp = $Instagram->timeline->uploadVideo($file_path, ['caption' => $caption]);

                    }else{

//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path);
//                        $resp = $Instagram->timeline->uploadVideo($video->getFile(), ['caption' => $caption,

                        $resp = $Instagram->timeline->uploadVideo($file_path, ['caption' => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);

//                        $resp = $Instagram->timeline->uploadVideo($file_path, ["caption" => $caption,
//                         'location_sticker' => [
//                            'width'         => 0.89333333333333331,
//                            'height'        => 0.071281859070464776,
//                            'x'             => 0.5,
//                            'y'             => 0.2,
//                            'rotation'      => 0.0,
//                            'is_sticker'    => true,
//                            'location_id'   => $location->getExternalId(),
//                        ],
//                        'location' => $location
//                        ]);
                    }

                } else {
//                    $img = new \InstagramAPI\MediaAutoResizer($file_path, [
//                        "targetFeed" => \InstagramAPI\Constants::FEED_TIMELINE,
//                        "operation" => \InstagramAPI\MediaAutoResizer::CROP
//                    ]);
//                    $resp = $Instagram->timeline->uploadPhoto($img->getFile(), ["caption" => $caption]);
//                    $resp = $Instagram->timeline->uploadPhoto($file_path, ["caption" => $file_path]);

                    if($location == false) {

                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path);
                        $resp = $Instagram->timeline->uploadPhoto($photo->getFile(), ['caption' => $caption]);

                    }else{

                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path);
                        $resp = $Instagram->timeline->uploadPhoto($photo->getFile(), ['caption' => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);

                    }




                }
                // first comment
                $media_id= $resp->getMedia()->getPk();//"1660920548793928997__2508886359";//$resp->id
                $comment = trim($comment);

                if(!empty($comment) AND $comment!='' AND isset($comment)){
                    try{
//                        $commentresp = $Instagram->timeline->comment($media_id, $comment);
                        $commentresp = $Instagram->media->comment($media_id, $comment);
                    }catch (Exception $ex){
                        $msg ='';
                    }

                }


            } else if ($type == "story") {
                $media = $media_data[$media_ids[0]];
                $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));
                $file_path = $user_files_dir."/".$m['filename'];

                if (in_array($ext, ["mp4"])) {
//                    if (!isVideoExtenstionsLoaded()) {
//                        $msg = __("It's not possible to post video files!");
//                        $Post->set("status", "failed")
//                             ->set("data", $msg)
//                             ->update();
//                        throw new Exception($msg);
//                    }

                    if($location == false) {

//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
//                        $resp = $Instagram->story->uploadVideo($video->getFile(), ['caption' => $caption]);

                        $resp = $Instagram->story->uploadVideo($file_path, ['caption' => $caption]);
                    }else{
//                        $video = new \InstagramAPI\Media\Video\InstagramVideo($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
//                        $resp = $Instagram->story->uploadVideo($video->getFile(), ['caption' => $caption,

                        $resp = $Instagram->story->uploadVideo($file_path, ['caption' => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);
                    }

                } else {
//                    $img = new \InstagramAPI\MediaAutoResizer($file_path, [
//                        "targetFeed" => \InstagramAPI\Constants::FEED_STORY,
//                        "operation" => \InstagramAPI\MediaAutoResizer::CROP,
//                        "minAspectRatio" => \InstagramAPI\MediaAutoResizer::BEST_MIN_STORY_RATIO,
//                        "maxAspectRatio" => \InstagramAPI\MediaAutoResizer::BEST_MAX_STORY_RATIO
//                    ]);
//                    $resp = $Instagram->story->uploadPhoto($img->getFile(), ["caption" => $caption]);
//                    $resp = $Instagram->story->uploadPhoto($file_path, ["caption" => $caption]);
                    if($location == false) {

                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
                        $resp = $Instagram->story->uploadPhoto($photo->getFile(), ["caption" => $caption]);

                    }else{
                        $photo = new \InstagramAPI\Media\Photo\InstagramPhoto($file_path, ['targetFeed' => \InstagramAPI\Constants::FEED_STORY]);
                        $resp = $Instagram->story->uploadPhoto($photo->getFile(), ["caption" => $caption,
                            'location_sticker' => [
                                'width'         => 0.89333333333333331,
                                'height'        => 0.071281859070464776,
                                'x'             => 0.5,
                                'y'             => 0.2,
                                'rotation'      => 0.0,
                                'is_sticker'    => true,
                                'location_id'   => $location->getExternalId(),
                            ],
                            'location' => $location
                        ]);

                    }
                }
            } else if ($type == "album") {
                $album_media = [];
                $temp_files_handlers = [];

                foreach ($media_ids as $id) {
                    $media = $media_data[$id];
                    $ext = strtolower(pathinfo($media['filename'], PATHINFO_EXTENSION));
                    $file_path = $user_files_dir."/".$media['filename'];

                    if (in_array($ext, ["mp4"])) {
//                        if (!isVideoExtenstionsLoaded()) {
//                            $msg = __("It's not possible to post video files!");
//                            $Post->set("status", "failed")
//                                 ->set("data", $msg)
//                                 ->update();
//                            throw new Exception($msg);
//                        }
                        $media_type = "video";
                    } else {
                        $media_type = "photo";

//                        $temp_files_handlers[] = new \InstagramAPI\MediaAutoResizer($file_path, [
//                            "targetFeed" => \InstagramAPI\Constants::FEED_TIMELINE_ALBUM,
//                            "operation" => \InstagramAPI\MediaAutoResizer::CROP,
//                            "minAspectRatio" => 1,
//                            "maxAspectRatio" => 1
//                        ]);
//                        $file_path = $temp_files_handlers[count($temp_files_handlers) - 1]->getFile();
                    }

                    $album_media[] = [
                        "type" => $media_type,
                        "file" => $file_path
                    ];
                }


                if($location == false) {
                    $resp = $Instagram->timeline->uploadAlbum($album_media, ['caption' => $caption]);
                }else{
                    $resp = $Instagram->timeline->uploadAlbum($album_media, ['caption' => $caption,
                        'location_sticker' => [
                            'width'         => 0.89333333333333331,
                            'height'        => 0.071281859070464776,
                            'x'             => 0.5,
                            'y'             => 0.2,
                            'rotation'      => 0.0,
                            'is_sticker'    => true,
                            'location_id'   => $location->getExternalId(),
                        ],
                        'location' => $location
                    ]);
                }

//                $media_id= $resp->media->id;//"1660920548793928997__2508886359";//$resp->id
                $media_id= $resp->getMedia()->getPk();//"1660920548793928997__2508886359";//$resp->id
                $comment = trim($comment);

                if(!empty($comment) AND $comment!='' AND isset($comment)){
                    try{
//                        $commentresp = $Instagram->timeline->comment($media_id, $comment);
                        $commentresp = $Instagram->media->comment($media_id, $comment);
                    }catch (Exception $ex){
                        $msg ='';
                    }

                }
            }
        } catch (Exception $e) {
            $msg = $e->getMessage();

            // Extract full file path from exception messages
            // Found in configuration and validation error messages
            preg_match('/"[^"]+"/', $msg, $matches);

//            $homepath = dirname(__FILE__);
//            $new_home = str_replace('app/helpers','',$homepath);



//            if ($matches && strpos($matches[0], ROOTPATH) !== false) {
            if ($matches && strpos($matches[0], $new_home) !== false) {
                $invalid_file_path = $matches[0];
//                $invalid_file_url = str_replace($new_home, APPURL, $invalid_file_path);
                $invalid_file_url = str_replace($new_home, BASE, $invalid_file_path);
                $invalid_file_name = basename($invalid_file_path, '"');

                $human_readable_file_name = explode("-", $invalid_file_name, 2);
                $human_readable_file_name = $human_readable_file_name[0];

                $msg = preg_replace('/"[^"]+"/', "<a href=".$invalid_file_url." target='_blank' class='file-link' data-file='".$invalid_file_name."'>".$human_readable_file_name."</a>", $msg);
            }

//            $Post->set("status", "failed")
//                ->set("data", $msg)
//                ->update();
            $CI->db->where('id',$Post["id"]);
            $CI->db->update('posts',array("status"=> "failed","data" => $msg));

            throw new Exception($msg);
        }



//        $ig_media_code = !empty($resp->media->code) ? $resp->media->code : "";
        $ig_media_code = ($resp->getMedia()->getCode() != '') ? $resp->getMedia()->getCode() : "";
        $data = [
//            "upload_id" => !empty($resp->upload_id) ? $resp->upload_id : "",
            "upload_id" => ($resp->getUploadId() != '') ? $resp->getUploadId() : "",
//            "pk" => !empty($resp->media->pk) ? $resp->media->pk : "",
            "pk" => ($resp->getMedia()->getPk() != '') ? $resp->getMedia()->getPk() : "",
//            "id" => !empty($resp->media->id) ? $resp->media->id : "",
            "id" => ($resp->getMedia()->getId() != '') ? $resp->getMedia()->getId() : "",
            "code" => $ig_media_code
        ];
//        $Post->set("status", "published")
//            ->set("data", json_encode($data))
//            ->set("publish_date", date("Y-m-d H:i:s"))
//            ->update();

        $CI->db->where('id',$Post["id"]);
        $CI->db->update('posts',array("status"=> "published","data" => json_encode($data),"publish_date"=> date("Y-m-d H:i:s")));

        return $ig_media_code;
    }

}

?>
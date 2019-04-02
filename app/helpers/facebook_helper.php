<?php
if(!function_exists("FbOAuth_User")){
    function FbOAuth_User($access_token){
        try {
            $params = array("fields=id,name", "access_token" => $access_token);
            return FbOAuth()->api( '/v2.3/me' , 'GET', $params );
        }
        catch ( Exception $e ) {
            return false;
        }
    }
}

if(!function_exists("FbOAuth_Access_Token_Page")){
    function FbOAuth_Access_Token_Page($pageid, $access_token){
        try {
            $params = array("access_token" => $access_token);
            $result = FbOAuth()->api( '/v2.3/'.$pageid.'?fields=access_token' , 'GET', $params );
            if(isset($result['access_token'])){
                return $result['access_token'];
            }else{  
                return false;
            }
        }
        catch ( Exception $e ) {
            return false;
        }
    }
}

if(!function_exists("FbOAuth_Info_App")){
    function FbOAuth_Info_App($access_token){
        $params = array("access_token" => $access_token);
        return FbOAuth()->api( '/v2.3/app' , 'GET', $params );
    }
}

if(!function_exists("FACEBOOK_GET_USER")){
    function FACEBOOK_GET_USER(){
        require_once( APPPATH."libraries/Facebook/autoload.php" );
        $fb = new \Facebook\Facebook([
          'app_id' => FACEBOOK_ID,
          'app_secret' => FACEBOOK_SECRET,
          'default_graph_version' => 'v2.9',
          'persistent_data_handler' => 'session'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }
        try {
            $accessToken = $helper->getAccessToken();
            // OAuth 2.0 client handler
            $oAuth2Client = $fb->getOAuth2Client();
             
            // Exchanges a short-lived access token for a long-lived one
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            $response = $fb->get( '/me?fields=id,name,email', (string)$accessToken);
            $data = $response->getGraphUser();
            return $data;
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            pr($e->getMessage(),1);
            return false;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            pr($e->getMessage(),1);
            return false;
        }
    }
}

if(!function_exists("FACEBOOK_GET_LOGIN_URL")){
    function FACEBOOK_GET_LOGIN_URL(){
        $FB = FbOAuth();
        return $FB->getLoginUrl(array('scope' => 'email', 'redirect_uri' => PATH."openid/facebook"));
    }
}

if(!function_exists("FbOAuth")){
    function FbOAuth(){
        require_once( APPPATH."libraries/FbOAuth/facebook.php" );
        $fb  = new FacebookCustom( array("appId" => FACEBOOK_ID, "secret" => FACEBOOK_SECRET) );
        return $fb;
    }
}

//FUNCTION HELPER
if (!function_exists('FB_DownloadVideo')) {
    function FB_DownloadVideo($url) {
        $useragent = 'Mozilla/5.0 (Linux; U; Android 2.3.3; de-de; HTC Desire Build/GRI40) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $source = curl_exec($ch);
        curl_close($ch);

        $download = explode('/video_redirect/?src=', $source);
        if(isset($download[1])){
            $download = explode('&amp', $download[1]);
            $download = rawurldecode($download[0]);
            return $download;
        }
        
        return "error";
    }
}

if (!function_exists('getIdYoutube')) {
    function getIdYoutube($link){
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $id);
        if(!empty($id)) {
            return $id = $id[0];
        }
        return $link;
    }
}

if (!function_exists('checkRemoteFile')) {
    function checkRemoteFile($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if(curl_exec($ch)!==FALSE)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>
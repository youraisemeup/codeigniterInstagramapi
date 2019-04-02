<?php

error_reporting(E_ALL); // Error engine - always ON!

ini_set('display_errors', TRUE); // Error display - OFF in production env or real server

ini_set('log_errors', TRUE); // Error logging

$homepath = dirname(__FILE__);


ini_set('error_log', $homepath.'/payment.log'); // Logging file

$servername = "localhost";
$username = "root";
$password = 'h8^TB3hhJrwY=\,%';
$dbname = "mysecretbot";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// Read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

/*
 * Post IPN data back to PayPal to validate the IPN data is genuine
 * Without this step anyone can fake IPN data
 */

$payment = $conn->query("SELECT * FROM payment");

if($payment->num_rows > 0){
    while($rowm = $payment->fetch_assoc()) {
        $sandbox = $rowm["sandbox"];
    }
}

if($sandbox == 1){
    $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
}else{
    $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
}


$ch = curl_init($paypalURL);
if ($ch == FALSE) {
    return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

// Set TCP timeout to 30 seconds
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
$res = curl_exec($ch);

/*
 * Inspect IPN validation result and act accordingly
 * Split response headers and payload, a better way for strcmp
 */
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));

//        if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
if ($res == "VERIFIED") {

    if(isset($_POST['mc_gross'])){

        $item_name = "";
        $item_number = 0;

//    if(isset($_POST['txn_type']) && $_POST['txn_type']=="subscr_signup"){
//        $type = $_POST['txn_type'];
//    }else{
//        $type = "";
//    }
        if(isset($_POST['item_number'])){
            $item_name   = $_POST['item_name'];
            $item_number = $_POST['item_number'];
        }

        if(isset($_POST['item_number1'])){
            $item_name   = $_POST['item_name1'];
            $item_number = $_POST['item_number1'];
        }

        if(isset($_POST['item_number2'])){
            $item_name   = $_POST['item_name2'];
            $item_number = $_POST['item_number2'];
        }

        if(isset($_POST['item_number3'])){
            $item_name   = $_POST['item_name3'];
            $item_number = $_POST['item_number3'];
        }

        if(isset($_POST['item_number4'])){
            $item_name   = $_POST['item_name4'];
            $item_number = $_POST['item_number4'];
        }

        if(isset($_POST['item_number5'])){
            $item_name   = $_POST['item_name5'];
            $item_number = $_POST['item_number5'];
        }


//        $uid             = $_SESSION["uid"];
        $uid             = isset($_POST["custom"])?$_POST["custom"]:16;
        $type             = 'paypal';
        $invoice         = isset($_POST['invoice'])?(int)$_POST['invoice']:0;
        $first_name      = $_POST['first_name'];
        $last_name       = $_POST['last_name'];
        $business       = $_POST['business'];
        $receiver_email  = $_POST['receiver_email'];
        $payer_email     = $_POST['payer_email'];
        $item_name       =  $item_name;
        $item_number     = (int)$item_number;
        $address_street  = isset($_POST['address_street'])?$_POST['address_street']:"";
        $address_city    = isset($_POST['address_city'])?$_POST['address_city']:"";
        $address_country = isset($_POST['address_country'])?$_POST['address_country']:"";
        $mc_gross        = $_POST['mc_gross'];
        $mc_currency     = $_POST['mc_currency'];
        $payment_date    = date("Y-m-d H:i:s", strtotime($_POST['payment_date']));
        $payment_status  = $_POST['payment_status'];
        $full_data       = json_encode($_POST);
        $created         = date("Y-m-d H:i:s");



//    $this->db->insert(PAYMENT_HISTORY, $data);
        $insert = "INSERT INTO payment_history(type,uid,invoice,first_name,last_name,business,receiver_email,payer_email,item_name,item_number,address_street,address_city,address_country,mc_gross,mc_currency,payment_date,payment_status,full_data,created) VALUES ('".$type."',$uid,'".$invoice."','".$first_name."','".$last_name."','".$business."','".$receiver_email."','".$payer_email."','".$item_name."',$item_number,'".$address_street."','".$address_city."','".$address_country."',$mc_gross,'".$mc_currency."','".$payment_date."','".$payment_status."','".$full_data."','".$created."')";
        if ($conn->query($insert) === TRUE) {

            if($_POST['payment_status'] == "Completed"){
                $result = $conn->query("SELECT * FROM user_management WHERE id = $uid");
                if($result->num_rows > 0){

                    while($row = $result->fetch_assoc()) {
                        $exp = $row["expiration_date"];
                        $name = $row["fullname"];
                        $email = $row["email"];
                        $userpack = $row["package_id"];
                    }

//                    public function post_zapier($name,$email,$plan){

//        $AuthUser = $this->getVariable("AuthUser");

                        $fields = array(

                            "first_name" => $name,//your instagram client id

                            "email" => $email,

                            "plan" => $item_name
                        );


                        $url = 'https://hooks.zapier.com/hooks/catch/1060897/0kwkid/';

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
//                    }

                    $package_new = $conn->query("SELECT * FROM package WHERE id = $item_number");

                    if($package_new->num_rows > 0){
                        while($row1 = $package_new->fetch_assoc()) {
                            $package_id = $row1["id"];
                            $package_price = $row1["price"];
                            $package_day = $row1["day"];
                        }
                    }

                    $package_old = $conn->query("SELECT * FROM package WHERE id = $userpack");

                    if($package_old->num_rows > 0){
                        while($row2 = $package_old->fetch_assoc()) {
                            $package_id2 = $row2["id"];
                            $package_price2 = $row2["price"];
                            $package_day2 = $row2["day"];
                        }

                        if(strtotime(date("Y-m-d H:i:s")) < strtotime($exp)){
                            $date_now = date("Y-m-d", strtotime(date("Y-m-d H:i:s")));
                            $date_expiration = date("Y-m-d", strtotime($exp));
                            $diff = abs(strtotime($date_expiration) - strtotime($date_now));
                            $days = floor($diff/86400);

                            $day_added = round(($package_price2/$package_price)*$days);
                            $total_day = $package_day + $day_added;
                            $expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
                        }else{
                            $expiration_date = date('Y-m-d', strtotime("+".$package_day." days"));
                        }
                    }else{
                        $expiration_date = date('Y-m-d', strtotime("+".$package_day." days"));
                    }

                    error_log("package_id = $package_id AND expiration_date = '".$expiration_date."' | Time: ".date('Y-m-d H:i:s')."");

                    $update = "UPDATE user_management SET package_id = $package_id , expiration_date = '".$expiration_date."' WHERE id=$uid";
                    if ($conn->query($update) === TRUE) {
                        echo "Record updated successfully";
                    } else {
//                        echo "Error updating record: " . $conn->error;
                        error_log("Type: $conn->error | Time: ".date('Y-m-d H:i:s')."");
                    }

                }else{
//                    echo "Error updating record: " . $conn->error;

                    error_log("Type: $conn->error | Time: ".date('Y-m-d H:i:s')."");
                }
            }else{
                error_log("Type: Not Completed | Time: ".date('Y-m-d H:i:s')."");
            }

        } else {
//            echo "Error: " . $insert . "<br>" . $conn->error;

            error_log("Type: $conn->error | Time: ".date('Y-m-d H:i:s')."");
        }

    }else{
        error_log("Type: Gross Blank | Time: ".date('Y-m-d H:i:s')."");
    }

}else{
    error_log("Type: Not Verified | Time: ".date('Y-m-d H:i:s')."");
}

?>
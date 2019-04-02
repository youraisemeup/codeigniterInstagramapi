<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class payments extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(get_class($this).'_model', 'model');
        $this->load->model('common_model');
		if(hashcheck()){
			redirect(PATH);
		}
	}

	public function index(){
		$data = array(
			"payment" => $this->model->get("*", PAYMENT),
			"package" => $this->model->fetch("*", PACKAGE, "status = 1 AND type = 2", "orders", "ASC")
		);
//		$this->template->set_layout("home");
		$this->template->title(l('Prices'));
		$this->template->build('index', $data);
	}

	public function type(){
		$package = $this->model->get("*", PACKAGE, "id = '".(int)get("package")."' AND status = 1 AND type = 2", "orders", "ASC");
		if(empty($package)) redirect(cn());

		$coupon  = $this->model->get("*", COUPON, "id = '".session("coupon")."' AND status = 1");
		if(!empty($coupon)){
			$coupon_packages = json_decode($coupon->packages);
			if(!empty($coupon_packages) && !in_array($package->id, $coupon_packages)){
				unset_session("coupon", $coupon->id);
				$coupon = array();
			}
		}

		$data = array(
			"payment" => $this->model->get("*", PAYMENT),
			"package" => $package,
			"coupon"  => $coupon
 		);
//		$this->template->set_layout("home");
		$this->template->title(l('Pricing'));
		$this->template->build('type', $data);
	}
	
	
	// Test case functions
	public function test_type(){
		$package = $this->model->get("*", PACKAGE, "id = '".(int)get("package")."' AND status = 1 AND type = 2", "orders", "ASC");
		if(empty($package)) redirect(cn());

		$coupon  = $this->model->get("*", COUPON, "id = '".session("coupon")."' AND status = 1");
		if(!empty($coupon)){
			$coupon_packages = json_decode($coupon->packages);
			if(!empty($coupon_packages) && !in_array($package->id, $coupon_packages)){
				unset_session("coupon", $coupon->id);
				$coupon = array();
			}
		}

		$data = array(
			"payment" => $this->model->get("*", PAYMENT),
			"package" => $package,
			"coupon"  => $coupon
 		);
		
//		$this->template->set_layout("home");
		$this->template->title(l('Pricing'));
		$this->template->build('test_type', $data);
	}

	public function ajax_coupon(){
		if(post("coupon") == ""){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('Promotional code is required')
			));
		}

		//Check coupon
		$coupon = $this->model->get("*", COUPON, "code = '".post("coupon")."'");
		if(empty($coupon)){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('The promotion code entered does not exist')
			));
		}
		
		$coupon_expiration = strtotime($coupon->date_expiration." 23:59:59");
		$today             = date("Y-m-d", strtotime(NOW));
		$today_end         = strtotime($today." 00:00:00");
		if($coupon_expiration < $today_end){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('The promotion code expired')
			));
		}

		$package = $this->model->get("*", PACKAGE, "id = '".(int)post("package_id")."' AND status = 1 AND type = 2", "orders", "ASC");
		if(empty($package)){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('The package does not exist')
			));
		}

		$coupon_packages = json_decode($coupon->packages);
		if(!empty($coupon_packages) && !in_array($package->id, $coupon_packages)){
			ms(array(
				"st"    => "error",
				"label" => "bg-red",
				"txt"   => l('The promotion code you entered has been applied to your package but no items qualify for the discount yet')
			));
		}


		set_session("coupon", $coupon->id);

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Successfully')
		));
	}

	public function stripe_process(){

        $homepath = dirname(__FILE__);

        $new_home = str_replace('modules/payments/controllers','',$homepath);

        require_once($new_home.'vendor/stripe/stripe-php/init.php');

		$payment = $this->model->get("*", PAYMENT);
		$user    = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");

		//\Stripe\Stripe::setApiKey("sk_test_9R4Vr0pBLUpxALgdyIeShwts");
        \Stripe\Stripe::setApiKey($payment->stripe_sk);

//        print_r($_POST);
//        die();

		$token  = $_POST['stripeToken'];

		$package_id = (int)get("package");

		//Check Package
		$package = $this->model->get("*", PACKAGE, "id = '".$package_id."' AND status = 1 AND type = 2", "orders", "ASC");
		if(empty($package)) redirect(cn("type?package=".$package_id));

		//COUPON
		$coupon  = $this->model->get("*", COUPON, "id = '".session("coupon")."' AND status = 1");
		$total_price = $package->price;
		if(!empty($coupon)){
			if($coupon->type==1){
				$discount = (float)$coupon->price;
			}else{
				$discount = ((float)$coupon->price/100)*(float)$package->price;
			}

			$total_price = $package->price - $discount;
			$total_price = ($total_price < 0)?0.01:$total_price;
			$total_price = $total_price*100;
		}

        try {

            $customer = \Stripe\Customer::create(array(
                'customer' => $user->email,
                'source'   => $token
            ));

    //		$result = \Stripe\Charge::create(array(
    //	  		'customer' => $customer->id,
    //		  	'amount'   => $total_price,
    //		  	'currency' => $payment->currency
    //		));


            if($package->price == 37){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'basic']],
                ]);

                $plan = 'basic';

                //prod_EDJMbsS5BpMpiK

            }elseif($package->price == 67){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'best']],
                ]);

                $plan = 'best';

                //prod_EDJPEYY10YIItK

            }elseif($package->price == 97){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'boss']],
                ]);

                $plan = 'boss';

                //prod_EDJSZeO4JRsnOo

            }elseif($package->price == 177){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'business']],
                ]);

                $plan = 'business';

                //prod_EDJTgzKM3kzBif

            }elseif($package->price == 397){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'business_pro']],
                ]);

                $plan = 'business_pro';
                //prod_EDJVLzZlYAJxSp

            }elseif($package->price == 697){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'enterprise']],
                ]);

                $plan = 'enterprise';
                //prod_EDJX0pDBo9hcBd

            }else{
                redirect(PATH);
            }

//            print_r(json_encode($result));
//
//            die();


        } catch (Exception $e) {
//            echo $e->getMessage();
//            die();
            redirect(PATH);
        }

//		if($result->paid == 1){
//			$data = array(
//				"type"            => "stripe",
//				"uid"             => session("uid"),
//				"invoice"         => $result->id,
//				"last_name"       => $result->customer,
//				"business"        => $result->customer,
//				"payer_email"     => $result->source->name,
//				"item_name"       => $package->name,
//				"item_number"     => $package->id,
//				"mc_gross"        => $result->amount,
//				"feeAmount"       => $result->amount,
//				"netAmount"       => $result->amount,
//				"mc_currency"     => $result->currency,
//				"payment_date"    => date("Y-m-d H:i:s", $result->created),
//				"payment_status"  => $result->status,
//				"full_data"       => json_encode($result),
//				"created"         => NOW
//			);
//
//			$this->db->insert(PAYMENT_HISTORY, $data);
//			$user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
//			if(!empty($user)){
//
//                //Checking referral
//                $this->common_model->check_referral($data, session('uid'));
//
//                //Assign proxy to user
//                $this->common_model->assign_available_proxy(session('uid'));
//
//				$package_new = $package;
//				$package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
//				$package_id = $package_new->id;
//				if(!empty($package_old)){
//					if(strtotime(NOW) < strtotime($user->expiration_date)){
//						$date_now = date("Y-m-d", strtotime(NOW));
//						$date_expiration = date("Y-m-d", strtotime($user->expiration_date));
//						$diff = abs(strtotime($date_expiration) - strtotime($date_now));
//						$days = floor($diff/86400);
//
//						$day_added = round(($package_old->price/$package_new->price)*$days);
//						$total_day = $package_new->day + $day_added;
//						$expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
//					}else{
//						$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
//					}
//				}else{
//					$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
//				}
//
//				$data = array(
//					"package_id"      => $package_id,
//					"expiration_date" => $expiration_date
//				);
//
//				$this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
//			}
//		}

        if($result->status == "active"){
            $data = array(
                "type"            => "stripe",
                "uid"             => session("uid"),
                "invoice"         => $result->id,
                "last_name"       => $result->customer,
                "business"        => $result->customer,
                "payer_email"     => $_POST['stripeEmail'],
                "item_name"       => $package->name,
                "item_number"     => $package->id,
                "mc_gross"        => $package->price,
                "feeAmount"       => $package->price,
                "netAmount"       => $package->price,
                "mc_currency"     => $result->plan->currency,
                "payment_date"    => date("Y-m-d H:i:s", $result->created),
                "payment_status"  => $result->status,
                "full_data"       => json_encode($result),
                "created"         => NOW
            );

            $this->db->insert(PAYMENT_HISTORY, $data);

            $user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
            if(!empty($user)){

                $this->post_zapier($user->fullname,$user->email,$plan);

                //Checking referral
                $this->common_model->check_referral($data, session('uid'));

                //Assign proxy to user
               // $this->common_model->assign_available_proxy(session('uid')); 
				$ig_condition = ['where' => ['uid' => session('uid')]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){ 
						//If proxy not assigned then assign one
						$proxy = $this->common_model->assign_available_proxy(session('uid'), false, true,$ig['id']);
					}
				}

                $package_new = $package;
                $package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
                $package_id = $package_new->id;
                if(!empty($package_old)){
                    if(strtotime(NOW) < strtotime($user->expiration_date)){
                        $date_now = date("Y-m-d", strtotime(NOW));
                        $date_expiration = date("Y-m-d", strtotime($user->expiration_date));
                        $diff = abs(strtotime($date_expiration) - strtotime($date_now));
                        $days = floor($diff/86400);

                        $day_added = round(($package_old->price/$package_new->price)*$days);
                        $total_day = $package_new->day + $day_added;
                        $expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
                    }else{
                        $expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
                    }
                }else{
                    $expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
                }

                $data = array(
                    "package_id"      => $package_id,
                    "expiration_date" => $expiration_date
                );

                $this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
            }
        }

		redirect(PATH);
	}

	public function test_stripe_process(){ 

        $homepath = dirname(__FILE__);

        $new_home = str_replace('modules/payments/controllers','',$homepath);

        require_once($new_home.'vendor/stripe/stripe-php/init.php');

		$payment = $this->model->get("*", PAYMENT);
		$user    = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
		$payment->stripe_sk = 'sk_test_R6QMEBq8yCi06XoaSgS7MT5B'; 
		//\Stripe\Stripe::setApiKey("sk_test_9R4Vr0pBLUpxALgdyIeShwts");
        \Stripe\Stripe::setApiKey($payment->stripe_sk);

//        print_r($_POST);
//        die();

		$token  = $_POST['stripeToken'];

		$package_id = (int)get("package");

		//Check Package
		$package = $this->model->get("*", PACKAGE, "id = '".$package_id."' AND status = 1 AND type = 2", "orders", "ASC");
		if(empty($package)) redirect(cn("type?package=".$package_id));

		//COUPON
		$coupon  = $this->model->get("*", COUPON, "id = '".session("coupon")."' AND status = 1");
		$total_price = $package->price;
		if(!empty($coupon)){
			if($coupon->type==1){
				$discount = (float)$coupon->price;
			}else{
				$discount = ((float)$coupon->price/100)*(float)$package->price;
			}

			$total_price = $package->price - $discount;
			$total_price = ($total_price < 0)?0.01:$total_price;
			$total_price = $total_price*100;
		}

        try {

            $customer = \Stripe\Customer::create(array(
                'customer' => $user->email,
                'source'   => $token
            ));

    //		$result = \Stripe\Charge::create(array(
    //	  		'customer' => $customer->id,
    //		  	'amount'   => $total_price,
    //		  	'currency' => $payment->currency
    //		));


            if($package->price == 37){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'basic']],
                ]);

                $plan = 'basic';

                //prod_EDJMbsS5BpMpiK

            }elseif($package->price == 67){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'best']],
                ]);

                $plan = 'best';

                //prod_EDJPEYY10YIItK

            }elseif($package->price == 97){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'boss']],
                ]);

                $plan = 'boss';

                //prod_EDJSZeO4JRsnOo

            }elseif($package->price == 177){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'business']],
                ]);

                $plan = 'business';

                //prod_EDJTgzKM3kzBif

            }elseif($package->price == 397){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'business_pro']],
                ]);

                $plan = 'business_pro';
                //prod_EDJVLzZlYAJxSp

            }elseif($package->price == 697){

                $result = \Stripe\Subscription::create([
                    'customer' => $customer->id,
                    'items' => [['plan' => 'enterprise']],
                ]);

                $plan = 'enterprise';
                //prod_EDJX0pDBo9hcBd

            }else{
                redirect(PATH);
            }

//            print_r(json_encode($result));
//
//            die();


        } catch (Exception $e) {
			
            redirect(PATH);
        }

//		if($result->paid == 1){
//			$data = array(
//				"type"            => "stripe",
//				"uid"             => session("uid"),
//				"invoice"         => $result->id,
//				"last_name"       => $result->customer,
//				"business"        => $result->customer,
//				"payer_email"     => $result->source->name,
//				"item_name"       => $package->name,
//				"item_number"     => $package->id,
//				"mc_gross"        => $result->amount,
//				"feeAmount"       => $result->amount,
//				"netAmount"       => $result->amount,
//				"mc_currency"     => $result->currency,
//				"payment_date"    => date("Y-m-d H:i:s", $result->created),
//				"payment_status"  => $result->status,
//				"full_data"       => json_encode($result),
//				"created"         => NOW
//			);
//
//			$this->db->insert(PAYMENT_HISTORY, $data);
//			$user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
//			if(!empty($user)){
//
//                //Checking referral
//                $this->common_model->check_referral($data, session('uid'));
//
//                //Assign proxy to user
//                $this->common_model->assign_available_proxy(session('uid'));
//
//				$package_new = $package;
//				$package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
//				$package_id = $package_new->id;
//				if(!empty($package_old)){
//					if(strtotime(NOW) < strtotime($user->expiration_date)){
//						$date_now = date("Y-m-d", strtotime(NOW));
//						$date_expiration = date("Y-m-d", strtotime($user->expiration_date));
//						$diff = abs(strtotime($date_expiration) - strtotime($date_now));
//						$days = floor($diff/86400);
//
//						$day_added = round(($package_old->price/$package_new->price)*$days);
//						$total_day = $package_new->day + $day_added;
//						$expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
//					}else{
//						$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
//					}
//				}else{
//					$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
//				}
//
//				$data = array(
//					"package_id"      => $package_id,
//					"expiration_date" => $expiration_date
//				);
//
//				$this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
//			}
//		}

        if($result->status == "active"){
            $data = array(
                "type"            => "stripe",
                "uid"             => session("uid"),
                "invoice"         => $result->id,
                "last_name"       => $result->customer,
                "business"        => $result->customer,
                "payer_email"     => $_POST['stripeEmail'],
                "item_name"       => $package->name,
                "item_number"     => $package->id,
                "mc_gross"        => $package->price,
                "feeAmount"       => $package->price,
                "netAmount"       => $package->price,
                "mc_currency"     => $result->plan->currency,
                "payment_date"    => date("Y-m-d H:i:s", $result->created),
                "payment_status"  => $result->status,
                "full_data"       => json_encode($result),
                "created"         => NOW
            );

            $this->db->insert(PAYMENT_HISTORY, $data);

            $user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
            if(!empty($user)){

                $this->post_zapier($user->fullname,$user->email,$plan);

                //Checking referral
                $this->common_model->check_referral($data, session('uid'));

                //Assign proxy to user
               // $this->common_model->assign_available_proxy(session('uid')); 
				$ig_condition = ['where' => ['uid' => session('uid')]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){ 
						//If proxy not assigned then assign one
						$proxy = $this->common_model->assign_available_proxy(session('uid'), false, true,$ig['id']);
					}
				}

                $package_new = $package;
				$package_new->day = 1;
                $package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
                $package_id = $package_new->id;
                if(!empty($package_old)){
                    if(strtotime(NOW) < strtotime($user->expiration_date)){
                        $date_now = date("Y-m-d", strtotime(NOW));
                        $date_expiration = date("Y-m-d", strtotime($user->expiration_date));
                        $diff = abs(strtotime($date_expiration) - strtotime($date_now));
                        $days = floor($diff/86400);

                        $day_added = round(($package_old->price/$package_new->price)*$days);
                        $total_day = $package_new->day + $day_added;
                        $expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
                    }else{
                        $expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
                    }
                }else{
                    $expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
                }

                $data = array(
                    "package_id"      => $package_id,
                    "expiration_date" => $expiration_date
                );

                $this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
            }
        }

		redirect(PATH);
	}


    public function post_zapier($name,$email,$plan){

//        $AuthUser = $this->getVariable("AuthUser");

        $fields = array(

            "first_name" => $name,//your instagram client id

            "email" => $email,

            "plan" => $plan
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
    }
	
	public function do_payment_pagseguro(){
		$payment = $this->model->get("*", PAYMENT);
		$package = $this->model->get("*", PACKAGE, "id = '".(int)get("package")."' AND status = 1");

		if(!empty($package )){

			//COUPON
			$coupon  = $this->model->get("*", COUPON, "id = '".session("coupon")."' AND status = 1");
			$total_price = $package->price;
			if(!empty($coupon)){
				if($coupon->type==1){
					$discount = (float)$coupon->price;
				}else{
					$discount = ((float)$coupon->price/100)*(float)$package->price;
				}

				$total_price = $package->price - $discount;
				$total_price = ($total_price < 0)?0.01:$total_price;
				$total_price = number_format($total_price,2);
			}

		    $data['email'] = $payment->pagseguro_email;
			$data['token'] = $payment->pagseguro_token;
			$data['currency'] = $payment->currency;
			$data['itemId1'] = $package->id;
			$data['itemDescription1'] = $package->name;
			$data['itemAmount1'] = $total_price;
			$data['itemQuantity1'] = '1';
			$data['reference'] = 'REF'.strtoupper(random_string(8));
			$data['redirectURL'] = cn("pagseguro_notify_payment");

		    $header = array('Content-Type' => 'application/json; charset=UTF-8;');
		    if($payment->sandbox == 0){
			    $response = curlExec("https://ws.pagseguro.uol.com.br/v2/checkout", $data, $header);
			    $json = json_decode(json_encode(simplexml_load_string($response)));
		    	header('Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $json->code);
		    }else{
		    	$response = curlExec("https://ws.sandbox.pagseguro.uol.com.br/v2/checkout", $data, $header);
			    $json = json_decode(json_encode(simplexml_load_string($response)));
		    	header('Location: https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $json->code);
		    }
		}else{
			redirect(cn());
		}
	}

	public function pagseguro_notify_payment(){
		$payment = $this->model->get("*", PAYMENT);
		$header = array('Content-Type' => 'application/json; charset=UTF-8;');
		if($payment->sandbox == 0){
			$response = curlExec("https://ws.pagseguro.uol.com.br/v2/transactions/".get("transaction_id")."?email=".$payment->pagseguro_email."&token=".$payment->pagseguro_token, null, $header);
	    }else{
			$response = curlExec("https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/".get("transaction_id")."?email=".$payment->pagseguro_email."&token=".$payment->pagseguro_token, null, $header);
	    }
		$result = json_decode(json_encode(simplexml_load_string($response)));

		if(is_object($result)){
			switch ($result->status) {
				case 1:
					$status = "Pending";
					break;
				case 2:
					$status = "Awaiting Fulfillment";
					break;
				case 3:
					$status = "Completed";
					break;
				case 6:
					$status = "Refund";
					break;
				case 7:
					$status = "Cancel";
					break;
				
				default:
					$status = "";
					break;
			}

			$data = array(
				"type"            => "pagseguro",
				"uid"             => session("uid"),
				"invoice"         => $result->code,
				"last_name"       => $result->code,
				"business"        => $result->sender->name,
				"payer_email"     => $result->sender->email,
				"item_name"       => $result->items->item->id,
				"item_number"     => $result->items->item->description,
				"mc_gross"        => $result->grossAmount,
				"feeAmount"       => $result->feeAmount,
				"netAmount"       => $result->netAmount,
				"payment_date"    => date("Y-m-d H:i:s", strtotime($result->lastEventDate)),
				"payment_status"  => $result->status,
				"full_data"       => json_encode($result),
				"created"         => NOW
			);

			$this->db->insert(PAYMENT_HISTORY, $data);
			if($result->status == 3){
				$user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
				if(!empty($user)){

                    //Checking referral
                    $this->common_model->check_referral($data, session('uid'));

                    //Assign proxy to user
                    $ig_condition = ['where' => ['uid' => session('uid')]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){ 
						//If proxy not assigned then assign one
						$proxy = $this->common_model->assign_available_proxy(session('uid'), false, true,$ig['id']);
					}
				}
					$package_new = $this->model->get("*", PACKAGE, "id = '".$result->items->item->id."'");
					$package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
					$package_id = $package_new->id;
					if(!empty($package_old)){
						if(strtotime(NOW) < strtotime($user->expiration_date)){
							$date_now = date("Y-m-d", strtotime(NOW));
							$date_expiration = date("Y-m-d", strtotime($user->expiration_date));
							$diff = abs(strtotime($date_expiration) - strtotime($date_now));
							$days = floor($diff/86400);

							$day_added = round(($package_old->price/$package_new->price)*$days);
							$total_day = $package_new->day + $day_added;
							$expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
						}else{
							$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
						}
					}else{
						$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
					}

					$data = array(
						"package_id"      => $package_id,
						"expiration_date" => $expiration_date
					);

					$this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
				}
			}
		}

		redirect(PATH);
	}

	public function do_payment_recurring(){
		$payment = $this->model->get("*",PAYMENT);
		$package = $this->model->get("*",PACKAGE,"id = '".(int)get("package")."'");
	
		if(is_object($payment)&&is_object($package)&&session("uid")){
			$package->currency_code = $payment->currency;
			// $package->currency_code = $payment->currency;
			$data = array(
				"payment" => $payment,
				"package" => $package,
			);
			$this->load->view("process",$data);

		}else{
			redirect(PATH);
		}
	}

//	public function notify_payment_recurring(){
//
//		if(isset($_REQUEST)&&$_REQUEST['txn_type']=="subscr_signup"){
//			$package = $this->model->get("*",PACKAGE,"id = '".(int)get("package")."'");
//			$user = $this->model->get("*",USER_MANAGEMENT,"id = '".session("uid")."'");
//			if(empty($user) || empty($package) || !session("uid")) redirect(PATH);
//			$data_payment_history=array(
//				"uid" 				=> session("uid"),
//				"first_name" 		=> $_REQUEST['first_name'],
//				"last_name" 		=> $_REQUEST['last_name'],
//				"business" 			=> $_REQUEST['business'],
//				"receiver_email" 	=> $_REQUEST['receiver_email'],
//				"payer_email"   	=> $_REQUEST['payer_email'],
//				"item_name" 		=> $_REQUEST['item_name'],
//				"address_street" 	=> $_REQUEST['address_street'],
//				"address_city"   	=> $_REQUEST['address_city'],
//				"address_country" 	=> $_REQUEST['address_country'],
//				"payment_status" 	=> $_REQUEST['payer_status'],
//				"payment_date" 		=> date("Y-m-d H:i:s", strtotime($_REQUEST['subscr_date'])),
//				"mc_gross" 			=> $_REQUEST['mc_amount3'],
//				"mc_currency" 		=> $_REQUEST['mc_currency'],
//				"full_data" 		=> json_encode($_REQUEST),
//				"created" 			=> NOW,
//			);
//			$data_payment=array(
//				"package_id" 		=> (int)get("package"),
//				"expiration_date" 	=> Date('Y-m-d H:i:s', strtotime("+".$package->day." days")),
//			);
//			$this->db->insert(PAYMENT_HISTORY,$data_payment_history);
//			$user = $this->model->get("*",USER_MANAGEMENT,"id = '".session("uid")."'");
//			if(!empty($user)){
//				$this->db->update(USER_MANAGEMENT,$data_payment,"id = '".session("uid")."'");
//			}
//		}
//		redirect(PATH);
//	}

    public function notify_stripe_payment_recurring(){
		// Retrieve the request's body and parse it as JSON:
		$input = file_get_contents('php://input');
		$likes_history_path = dirname(__FILE__) . '/history_logs.json';
		if (!is_dir($likes_history_path)){
				//mkdir - tells that need to create a directory
				mkdir($likes_history_path,0777,true);
		}
		$r = false;
		if (!file_exists($likes_history_path)){
			
		
			$r = file_put_contents($likes_file_path,$input, FILE_APPEND);
		}
		$event_json = json_decode($input);
       
		// Do something with $event_json

		http_response_code(200); // PHP 5.4 or greater
	}
    public function notify_payment_recurring(){

        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//        $txt = $_POST;

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
        $paypalURL = "https://www.sandbox.paypal.com/cgi-bin/webscr";
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

            fwrite($myfile,"\n".   $_POST['payment_status'] );
            fclose($myfile);

            $item_name = "";
            $item_number = 0;

            if(isset($_POST['txn_type']) && $_POST['txn_type']=="subscr_signup"){
                $type = $_POST['txn_type'];
            }else{
                $type = "";
            }
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

            $data = array(
                "uid"             => session("uid"),
                "type"             => $type,
                "invoice"         => (int)$_POST['invoice'],
                "first_name"      => $_POST['first_name'],
                "last_name"       => $_POST['last_name'],
                "business"        => $_POST['business'],
                "receiver_email"  => $_POST['receiver_email'],
                "payer_email"     => $_POST['payer_email'],
                "item_name"       => $item_name,
                "item_number"     => (int)$item_number,
                "address_street"  => isset($_POST['address_street'])?$_POST['address_street']:"",
                "address_city"    => isset($_POST['address_city'])?$_POST['address_city']:"",
                "address_country" => isset($_POST['address_country'])?$_POST['address_country']:"",
                "mc_gross"        => $_POST['mc_gross'],
                "mc_currency"     => $_POST['mc_currency'],
                "payment_date"    => date("Y-m-d H:i:s", strtotime($_POST['payment_date'])),
                "payment_status"  => $_POST['payment_status'],
                "full_data"       => json_encode($_POST),
                "created"         => NOW
            );
            $this->db->insert(PAYMENT_HISTORY, $data);
            if($_POST['payment_status'] == "Completed"){
                $user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
                if(!empty($user)){

                    //Checking referral
                    $this->common_model->check_referral($data, session('uid'));

                    //Assign proxy to user
                    $ig_condition = ['where' => ['uid' => session('uid')]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){ 
						//If proxy not assigned then assign one
						$proxy = $this->common_model->assign_available_proxy(session('uid'), false, true,$ig['id']);
					}
				}
                    $package_new = $this->model->get("*", PACKAGE, "id = '".$item_number."'");
                    $package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
                    $package_id = $package_new->id;
                    if(!empty($package_old)){
                        if(strtotime(NOW) < strtotime($user->expiration_date)){
                            $date_now = date("Y-m-d", strtotime(NOW));
                            $date_expiration = date("Y-m-d", strtotime($user->expiration_date));
                            $diff = abs(strtotime($date_expiration) - strtotime($date_now));
                            $days = floor($diff/86400);

                            $day_added = round(($package_old->price/$package_new->price)*$days);
                            $total_day = $package_new->day + $day_added;
                            $expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
                        }else{
                            $expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
                        }
                    }else{
                        $expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
                    }

                    $data = array(
                        "package_id"      => $package_id,
                        "expiration_date" => $expiration_date
                    );

                    $this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
                }
            }

        }
        redirect(PATH);

    }

	public function do_payment(){
		$payment = $this->model->get("*", PAYMENT);
		$package = $this->model->get("*", PACKAGE, "id = '".(int)get("package")."'");

		if(empty($payment) || empty($package) || !session("uid")) redirect(PATH);

		$config['business'] 			= $payment->paypal_email;
		$config['cpp_header_image'] 	= ''; //Image header url [750 pixels wide by 90 pixels high]
		$config['return'] 				= cn().'notify_payment';
		$config['cancel_return'] 		= cn().'cancel_payment';
		$config['notify_url'] 			= cn().'process_payment'; //IPN Post
		$config['production'] 			= ($payment->sandbox == 1)?FALSE:TRUE; //Its false by default and will use sandbox
		$config["invoice"]				= random_string('numeric',8); //The invoice id
		$config["currency_code"]     	= $payment->currency; //The invoice id
		
		$this->load->library('paypal',$config);

		//COUPON
		$coupon  = $this->model->get("*", COUPON, "id = '".session("coupon")."' AND status = 1");
		$total_price = $package->price;
		if(!empty($coupon)){
			if($coupon->type==1){
				$discount = (float)$coupon->price;
			}else{
				$discount = ((float)$coupon->price/100)*(float)$package->price;
			}

			$total_price = $package->price - $discount;
			$total_price = ($total_price < 0)?0.01:$total_price;
			$total_price = number_format($total_price,2);
		}
		$this->paypal->add($package->name, $total_price, 1, $package->id); //Third item with code
		$this->paypal->pay(); //Proccess the payment
	}

	public function process_payment(){

        redirect(PATH);
	}

	public function notify_payment(){
		$result = $this->input->post();
		if(!empty($result)){
			$item_name = "";
			$item_number = 0;

            if(isset($result['txn_type']) && $result['txn_type']=="subscr_signup"){
                $type = $result['txn_type'];
            }else{
                $type = "";
            }
			if(isset($result['item_number'])){
				$item_name   = $result['item_name'];
				$item_number = $result['item_number'];
			}

			if(isset($result['item_number1'])){
				$item_name   = $result['item_name1'];
				$item_number = $result['item_number1'];
			}

			if(isset($result['item_number2'])){
				$item_name   = $result['item_name2'];
				$item_number = $result['item_number2'];
			}

			if(isset($result['item_number3'])){
				$item_name   = $result['item_name3'];
				$item_number = $result['item_number3'];
			}

			if(isset($result['item_number4'])){
				$item_name   = $result['item_name4'];
				$item_number = $result['item_number4'];
			}

			if(isset($result['item_number5'])){
				$item_name   = $result['item_name5'];
				$item_number = $result['item_number5'];
			}

			$data = array(
				"uid"             => session("uid"),
				"type"             => $type,
				"invoice"         => (int)$result['invoice'],
				"first_name"      => $result['first_name'],
				"last_name"       => $result['last_name'],
				"business"        => $result['business'],
				"receiver_email"  => $result['receiver_email'],
				"payer_email"     => $result['payer_email'],
				"item_name"       => $item_name,
				"item_number"     => (int)$item_number,
				"address_street"  => isset($result['address_street'])?$result['address_street']:"",
				"address_city"    => isset($result['address_city'])?$result['address_city']:"",
				"address_country" => isset($result['address_country'])?$result['address_country']:"",
				"mc_gross"        => $result['mc_gross'],
				"mc_currency"     => $result['mc_currency'],
				"payment_date"    => date("Y-m-d H:i:s", strtotime($result['payment_date'])),
				"payment_status"  => $result['payment_status'],
				"full_data"       => json_encode($result),
				"created"         => NOW
			);
			$this->db->insert(PAYMENT_HISTORY, $data);
			if($result['payment_status'] == "Completed"){
				$user = $this->model->get("*", USER_MANAGEMENT, "id = '".session("uid")."'");
				if(!empty($user)){

                    //Checking referral
                    $this->common_model->check_referral($data, session('uid'));

                    //Assign proxy to user
                   $ig_condition = ['where' => ['uid' => session('uid')]];
				$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
				//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
				//die;
				if(count($ig_accounts)){ 
					foreach($ig_accounts as $ig){ 
						//If proxy not assigned then assign one
						$proxy = $this->common_model->assign_available_proxy(session('uid'), false, true,$ig['id']);
					}
				}
					$package_new = $this->model->get("*", PACKAGE, "id = '".$item_number."'");
					$package_old = $this->model->get("*", PACKAGE, "id = '".$user->package_id."'");
					$package_id = $package_new->id;
					if(!empty($package_old)){
						if(strtotime(NOW) < strtotime($user->expiration_date)){
							$date_now = date("Y-m-d", strtotime(NOW));
							$date_expiration = date("Y-m-d", strtotime($user->expiration_date));
							$diff = abs(strtotime($date_expiration) - strtotime($date_now));
							$days = floor($diff/86400);

							$day_added = round(($package_old->price/$package_new->price)*$days);
							$total_day = $package_new->day + $day_added;
							$expiration_date = date('Y-m-d', strtotime("+".$total_day." days"));
						}else{
							$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
						}
					}else{
						$expiration_date = date('Y-m-d', strtotime("+".$package_new->day." days"));
					}

					$data = array(
						"package_id"      => $package_id,
						"expiration_date" => $expiration_date
					);

					$this->db->update(USER_MANAGEMENT, $data, "id = '".session("uid")."'");
				}
			}
		}
		redirect(PATH);
	}
	public function cancel_payment(){
		redirect(url('payments'));
	}


    public function send_mail(){

        if(trim(post('email')) == ''){
            ms(array(
                'st' 	=> 'error',
                'txt' 	=> l('Please enter email id.')
            ));
        }

        $message = '
					<html>
					<head>
					<title>'.l('Support Ticket').'</title>
					</head>
					<body>
					<p>'.l('From: ').post('username').' &lt;<a href="mailto:'.post('email').'">'.post('email').'</a>&gt;</p>
					<p>'.l('Subject: ').post('subject').'</p>
					<p>'.l('Email: ').'<a href="mailto:'.post('email').'">'.post('email').'</a></p>
					<p>'.l('User Name: ').post('username').'</p>
					<p>'.l('Subject: ').post('subject').'</p>
					<p>'.l('Message : ').post('message').'</p>

					</body>
					</html>
					';


        $settings = $this->db->select("*")->get(SETTINGS)->row();

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

        $mail->setFrom($settings->mail_from_email,post('username'));
        $mail->addAddress($settings->mail_from_email);     // Add a recipient
//        $mail->addReplyTo($settings->mail_from_email, 'Admin');
//        $mail->addCC($settings->mail_from_email);
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = '"'.post('subject').'"';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            ms(array(
                'st' 	=> 'error',
                'txt' 	=> l('Something went wrong. Please try again.')
            ));
        } else {
            ms(array(
                'st' 	=> 'success',
                'txt' 	=> l('Thank you for your message. It has been sent.')
            ));
        }

//        print_r($message);
//        $sendfrom = 'no-reply@igplan.com';
//        $sendto = 'support@igplan.com';
//
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: <'.$sendfrom.'>' . "\r\n";
//        $headers .= 'Cc: '.$sendfrom. "\r\n";
//        if(mail($sendto,'"'.post('subject').'"',$message,$headers)){
//            ms(array(
//                'st' 	=> 'success',
//                'txt' 	=> l('Thank you for your message. It has been sent.')
//            ));
//        }else{
//            ms(array(
//                'st' 	=> 'error',
//                'txt' 	=> l('Something went wrong. Please try again.')
//            ));
//        }

    }

}
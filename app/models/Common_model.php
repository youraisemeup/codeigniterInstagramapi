<?php
class Common_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    /**
     * Fetch data from any table based on different conditions
     *
     * @access    public
     * @param    string
     * @param    string
     * @param    array
     * @return    bool
     */
    public function fetch_data($table, $fields = '*', $conditions = array(), $returnRow = false, $onlyCount = false)
    {
        //Preparing query
        $this->db->select($fields);
        $this->db->from($table);

        //If there are conditions
        if (count($conditions) > 0) {
            $this->condition_handler($conditions);
        }

        //Set count is true?
        if ($onlyCount) {
            return $this->db->count_all_results();
        }

        $query = $this->db->get();

        //Return
        return $returnRow ? $query->row_array() : $query->result_array();
    }


    /**
     * Count all records
     *
     * @access    public
     * @param    string
     * @return    array
     */
    public function fetch_count($table, $conditions = array())
    {
        $this->db->from($table);
        //If there are conditions
        if (count($conditions) > 0) {
            $this->condition_handler($conditions);
        }
        return $this->db->count_all_results();
    }


    /**
     * Insert data in DB
     *
     * @access    public
     * @param    string
     * @param    array
     * @param    string
     * @return    string
     */
    public function insert_single($table, $data = array())
    {
        //Check if any data to insert
        if (count($data) < 1) {
            return false;
        }

        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }


    /**
     * Insert batch data
     *
     * @access    public
     * @param    string
     * @param    array
     * @param    array
     * @param    bool
     * @return    bool
     */
    public function insert_batch($table, $data = array())
    {
        //Check if any data to insert
        if (count($data) < 1) {
            return false;
        }

        $this->db->insert_batch($table, $data);
        return $this->db->insert_id();
    }


    /**
     * Update details in DB
     *
     * @access    public
     * @param    string
     * @param    array
     * @param    array
     * @return    string
     */
    public function update_single($table, $updates, $conditions = array())
    {
        //If there are conditions
        if (count($conditions) > 0) {
            $this->condition_handler($conditions);
        }
        return $this->db->update($table, $updates);
    }


    /**
     * Update Batch
     *
     * @access    public
     * @param    string
     * @param    array
     * @return    boolean
     */
    public function update_batch_data($table, $defaultArray, $dynamicArray = array(), $key)
    {
        //Check if any data
        if (count($dynamicArray) < 1) {
            return false;
        }

        //Prepare data for insertion
        foreach ($dynamicArray as $val) {
            $data[] = array_merge($defaultArray, $val);
        }
        return $this->db->update_batch($table, $data, $key);
    }


    /**
     * Delete data from DB
     *
     * @access    public
     * @param    string
     * @param    array
     * @param    string
     * @return    string
     */
    public function delete_data($table, $conditions = array())
    {
        //If there are conditions
        if (count($conditions) > 0) {
            $this->condition_handler($conditions);
        }
        return $this->db->delete($table);
    }


    /**
     * Handle different conditions of query
     *
     * @access    public
     * @param    array
     * @return    bool
     */
    public function condition_handler($conditions)
    {
        //Where
        if (array_key_exists('where', $conditions)) {

            //Iterate all where's
            foreach ($conditions['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        //Or Where
        if (array_key_exists('or_where', $conditions)) {

            //Iterate all where's
            foreach ($conditions['or_where'] as $key => $val) {
                $this->db->or_where($key, $val);
            }
        }

        //Where In
        if (array_key_exists('where_in', $conditions)) {

            //Iterate all where in's
            foreach ($conditions['where_in'] as $key => $val) {
                $this->db->where_in($key, $val);
            }
        }

        //Where Not In
        if (array_key_exists('where_not_in', $conditions)) {

            //Iterate all where in's
            foreach ($conditions['where_not_in'] as $key => $val) {
                $this->db->where_not_in($key, $val);
            }
        }

        //Having
        if (array_key_exists('having', $conditions)) {
            foreach ($conditions['having'] as $key => $val) {
                $this->db->having($key, $val);
            }
        }

        //Group By
        if (array_key_exists('group_by', $conditions)) {
            $this->db->group_by($conditions['group_by']);
        }

        //Order By
        if (array_key_exists('order_by', $conditions)) {

            //Iterate all order by's
            foreach ($conditions['order_by'] as $key => $val) {
                $this->db->order_by($key, $val);
            }
        }

        //Order By
        if (array_key_exists('like', $conditions)) {

            //Iterate all likes
            foreach ($conditions['like'] as $key => $val) {
                $this->db->like($key, $val, 'after');
            }
        }

        //Limit
        if (array_key_exists('limit', $conditions)) {

            //If offset is there too?
            if (count($conditions['limit']) == 1) {
                $this->db->limit($conditions['limit'][0]);
            } else {
                $this->db->limit($conditions['limit'][0], $conditions['limit'][1]);
            }
        }

        //Group Start (For and or conditions)
        if (array_key_exists('group_start', $conditions)) {
            $this->db->group_start();

            //Iterate all conditions
            $i = 0;
            foreach ($conditions['group_start'] as $key => $val) {
                if ($i == 0) {
                    $this->db->where($key, $val);
                } else {
                    $this->db->or_where($key, $val);
                }
                $i++;
            }
            $this->db->group_end();
        }
    }


    /**
     * Log error in DB
     *
     * @access    public
     * @param    array
     * @param    string
     */
    public function error_log_in_db($logData = array(), $message, $admin = true)
    {
        $insertData = array(
            'message' => $message,
            'data' => json_encode($logData),
            'type' => (string)($admin ? 1 : 0),
            'loggedTime' => time(),
        );
        return $this->insert_single('error_logs', $insertData);
    }

    /**
     * Get refferal counts
     *
     */
    function get_refferal_counts($conditions = [])
    {
        $this->db->select(
            'COUNT(referral_id) as referral_count, status, SUM(referral_amount) AS referral_amount, SUM(package_amount) AS package_amount',
            false
        )
            ->from('referrals');

        //If there are conditions?
        if (count($conditions) > 0) {
            $this->common_model->condition_handler($conditions);
        }

        $this->db->where_not_in('status', [3])
            ->group_by('status');

        //Query and return!
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get refferal counts
     *
     */
    function get_users_referral_count($startDate, $endDate)
    {
        $commonCondition = ' AND created >= "' . $startDate . '" AND created <= "' . $endDate . '"';

        $this->db->select(
            'um.id, um.fullname, um.email, um.paypal_email, um.package_id,
            (SELECT IFNULL(SUM(referral_amount), "0") FROM referrals WHERE user_from = um.id AND status = 2' . $commonCondition . ') AS paid_referrals_amount,
            (SELECT IFNULL(SUM(referral_amount), "0") FROM referrals WHERE user_from = um.id AND status = 1' . $commonCondition . ') AS unpaid_referrals_amount,
            (SELECT COUNT(referral_id) FROM referrals WHERE user_from = um.id AND status = 0' . $commonCondition . ') AS pending_referrals,
            (SELECT COUNT(referral_id) FROM referrals WHERE user_from = um.id AND status = 2' . $commonCondition . ') AS paid_referrals,
            (SELECT COUNT(referral_id) FROM referrals WHERE user_from = um.id AND status = 1' . $commonCondition . ') AS unpaid_referrals,
            (SELECT COUNT(referral_id) FROM referrals WHERE user_from = um.id AND status = 3' . $commonCondition . ') AS cancelled_referrals',
            false
        )
            ->from('user_management AS um')
            ->where('package_id >', 1)
            ->order_by('unpaid_referrals_amount', 'DESC');

        //Query and return!
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get refferal users
     *
     */
    function referred_users_old($field, $additionalConditions)
    {
        $this->db->select(
            $field,
            false
        )
            ->from('referrals AS r')
            ->where('package_id >', 1)
            ->order_by('unpaid_referrals_amount', 'DESC');

        //Query and return!
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get data from referral table
     *
     */
    public function referred_users($conditions = array(), $fields = '*', $join = array(), $returnRow = false)
    {
        $this->db->select(
            $fields,
            false
        )
            ->from('referrals as r');

        //If referred user joined with user table
        if (in_array('join_user_to', $join)) {
            $this->db->join('user_management as um', 'um.id = r.user_to', 'inner');
        }

        //If referee joined with user table
        if (in_array('join_user_from', $join)) {
            $this->db->join('user_management as um', 'um.id = r.user_from', 'inner');
        }

        //If package name is needed
        if (in_array('join_package', $join)) {
            $this->db->join('package as p', 'p.id = r.package_id', 'left');
        }

        //If there are conditions?
        if (count($conditions) > 0) {
            $this->common_model->condition_handler($conditions);
        }

        //Query and return!
        $query = $this->db->get();
        return $returnRow ? $query->row_array() : $query->result_array();
    }

    public function check_referral($paymentHistory, $userID)
    {

        $referral = $this->fetch_data(
            REFERRALS,
            "*",
            [
                'where' => ['user_to' => $userID],
                'order_by' => ['referral_id' => 'desc']
            ],
            true
        );
		//var_dump($paymentHistory);
		//var_dump($referral);die;
        //If user is not referred by any user
        if (count($referral) < 1)
            return false;

        //If user is indeed referred, then checking status of referee
        $referee = $this->fetch_data(USER_MANAGEMENT, "*", ['where' => ['id' => $referral['user_from']]], true);

        //If referee details not found
        if (count($referee) < 1)
            return false;

        //Checking referee's packages
        if ((strtotime($referee['expiration_date']) < time()) or ($referee['package_id'] < 2))
            return false;

        //Getting details of subscribed package
        $subscribedPlan = $this->fetch_data(PACKAGE, "*", ['where' => ['id' => $paymentHistory['item_number']]], true);

        //If user's subscribed plan not found
        if (count($subscribedPlan) < 1)
            return false;

        //Getting current referral commision percentage from settings
        $referralCommission = $this->fetch_data(SETTINGS, "commission_percentage", [], true);

        //If commission not set
        if (empty($referralCommission['commission_percentage']))
            $referralCommission['commission_percentage'] = 0;

        //Calculating referral amount
        $referralAmount = $subscribedPlan['price'] * $referralCommission['commission_percentage'] / 100;

        //Prepping referral array to be updated
        $updateReferral = [
            'status' => 1,
            'package_id' => $paymentHistory['item_number'],
            'package_amount' => $subscribedPlan['price'],
            'referral_amount' => $referralAmount,
            'package_subscribed' => date('Y-m-d H:i:s'),
            'changed' => date('Y-m-d H:i:s'),
        ];

        //If previous referral needs to be updated
        if ($referral['package_id'] < 2) {

            //Updating referral
            $this->update_single(REFERRALS, $updateReferral, ['where' => ['referral_id' => $referral['referral_id']]]);
        } else {

            //Inserting a new referral row
            $updateReferral['user_from'] = $referral['user_from'];
            $updateReferral['user_to'] = $userID;
            $updateReferral['status'] = 1;
            $updateReferral['created'] = date('Y-m-d H:i:s');

            $this->insert_single(REFERRALS, $updateReferral);

        }

        return true;
    }

    //Get proxy of user
    public function get_user_assigned_proxy($userID)
    {
		$ig_condition = ['where' => ['uid' => $userID]];
		$ig_accounts = $this->common_model->fetch_data(INSTAGRAM_ACCOUNTS, '*', $ig_condition);
		//echo '<pre>'.$uid.'<br>';print_r($ig_accounts);
		//die;
		if(count($ig_accounts)){ 
			foreach($ig_accounts as $ig){ 
				$proxy = $this->check_proxy_assigned($userID);

				//If proxy assigned 
				if ($proxy['isAssigned']) {

					return $proxy['proxy']['id'];
				}

				//If proxy not assigned then assign one
				$proxy = $this->assign_available_proxy($userID, false, true,$ig['id']);
			}
		}
        //Check if user has proxy assigned already
        

        //Return
        return $proxy['id'];
    }

    //Check if user has proxy assigned already
    public function check_proxy_assigned($userID)
    {
		
		
        //Getting proxy assigned to user
        $proxy = $this->fetch_data(PROXY, '*', ['where' => ['uid' => $userID]], true);

        //If no proxy found
        $isAssigned = true;
        if (!$proxy)
            $isAssigned = false;

        //Return
        return [
            'proxy' => $proxy,
            'isAssigned' => $isAssigned,
        ];
    }

    //Get user details with subscription status
    public function get_user_details($userID)
    {

        //Getting user details
        $userInfo = $this->fetch_data(USER_MANAGEMENT, '*', ['where' => ['id' => $userID]], true);

        //If user's subscription has been expired then setting subscription status to false.
        $isSubscribed = true;
        if (($userInfo['package_id'] < 2) and (strtotime($userInfo['expiration_date']) < time()))
            $isSubscribed = false;

        //Merge in user info
        $userInfo['is_subscribed'] = $isSubscribed;

        //Return
        return $userInfo;
    }

    //Assign an available proxy to
    public function assign_available_proxy($userID, $throwError = false, $returnAssigned = false,$ig_account_id)
    {

		//$insta = $this->model->get("*", INSTAGRAM_ACCOUNTS,"uid = '".$userID."'");

        $this->db->select('*')
            ->from(INSTAGRAM_ACCOUNTS)
            ->where('id', $ig_account_id);
        $query = $this->db->get();
        $insta = $query->row();
		//echo 'USER ID IS ----'.$userID.'<br>';
        if(!empty($insta)){
            $proxy = $insta->proxy;
			
			//$proxyresp = $this->model->get("*", PROXY,"id = '".$proxy."' is_working = 0 AND delay_time IS NOT NULL");

            $this->db->select('*')
                ->from(PROXY)
                ->where('id', $proxy)
                ->where('is_working', 0)
                ->where('delay_time IS NOT NULL');
            $query1 = $this->db->get();
            $proxyresp = $query1->row();
			//echo $proxy;
			//echo "<pre>";print_r($proxyresp);die;
            if(!empty($proxyresp)){

                $delay_time = strtotime(date($proxyresp->delay_time));

//                echo $delay_time."<br>";
                $time_now = strtotime(NOW);

//                echo $time_now."<br>";

                $diff = (int)$time_now - (int)$delay_time;

//                echo $diff."<br>";

                if((int)$diff > 10800){
                    return '<div class="alert alert-danger">
                        <strong>' . l('Notice:') . '</strong> '
                    . l("Temporary Server Maintenance to bring upgrades to your account performance.") .
                    '</div>';
                }

                return false;

            }

           

        }

        //Get user details
        $userDetails = $this->get_user_details($userID);

        //If user is not subscribed
        if (!$userDetails['is_subscribed'])
			return false;

        //Check if any proxy already assigned to user
        $checkProxyAssigned = $this->check_proxy_assigned($ig_account_id);

        //If proxy already assigned
        if ($checkProxyAssigned['isAssigned']){
			return false;
		}
            
        //Fetch available proxy
        $this->db->select('p.*')
            ->from(PROXY . ' as p')
            ->where('p.is_working', 1)
            ->where('p.status', 1)
            ->where('p.uid', 0)
            ->where('p.ig_accounts', 0)
          //  ->where('p.cooldown_start_time <', date('Y-m-d H:i:s'))
			->where('NOT EXISTS (SELECT id FROM ' . PROXY_ASSIGNMENTS . ' AS pa WHERE pa.proxy_id = p.id AND pa.user_id = ' . $userID . ')');
        $query = $this->db->get();
		
        $proxy = $query->row_array();
		//print_r($query);
		
        //If proxy not found
        if (!$proxy) {
			//var_dump($proxy);die;
//
//            if(!empty($proxy['delay_time'])){
//
//                $delay_time = strtotime(date($proxy['delay_time']));
//
////                echo $delay_time."<br>";
//                $time_now = strtotime(NOW);
//
////                echo $time_now."<br>";
//
//                $diff = (int)$time_now - (int)$delay_time;
//
////                echo $diff."<br>";
//
//                if((int)$diff > 10800){

                    //If throw error
            if ($throwError) {

//                    return
//                        '<div class="alert alert-danger">
//                        <strong>' . l('Notice:') . '</strong> '
////                        . l("We are currently at capacity. Someone from our support team will contact you within the next 6 hours to help you set your account up.") .
//                        . l("Temporary Server Maintenance to bring upgrades to your account performance.") .
//                        '</div>';

                return '<div class="alert alert-danger">
                        <strong>' . l('Notice:') . '</strong> '
               . l("Temporary Server Maintenance to bring upgrades to your account performance.") .
                '</div>';
                }

//            }



            return false;
        }
		
		//echo 'proxy id is === '.$proxy['id'].'<br>';

        //Assign proxy to user
        $this->common_model->update_single(PROXY, ['uid' => $ig_account_id,'ig_accounts' => 1], ['where' => ['id' => $proxy['id']]]);

        //Update proxy in user's all Instagram accounts
        $this->common_model->update_single(INSTAGRAM_ACCOUNTS, ['proxy' => $proxy['id']], ['where' => ['id' => $ig_account_id]]);

        //Add log
        $insertProxyLog = [
            'proxy_id' => $proxy['id'],
            'user_id' => $ig_account_id,
            'created' => date('Y-m-d H:i:s', time()),
        ];
        $this->insert_single(PROXY_ASSIGNMENTS, $insertProxyLog);

        //If returning assigned proxy details
        if ($returnAssigned) {

            return $proxy;
        }

        return true;
    }

    //Remove assigned proxy
    public function remove_assigned_proxy($userID)
    {

        //Check if any proxy already assigned to user
		
        $checkProxyAssigned = $this->check_proxy_assigned($userID);

        //If proxy already assigned
        if (!$checkProxyAssigned['isAssigned'])
            return false;
  
        //Remove assignment from proxy
        $this->remove_assigned_query([$userID]);

        return true;
    }

    //Remove assigned query
    public function remove_assigned_query($userIDs)
    {

        //Remove assignment from proxy
        $this->common_model->update_single(PROXY, ['uid' => 0, 'cooldown_start_time' => date('Y-m-d H:i:s', strtotime('+7 days'))], ['where_in' => ['uid' => $userIDs]]);

        //Remove proxy from Instagram accounts
        $this->common_model->update_single(INSTAGRAM_ACCOUNTS, ['proxy' => 0], ['where_in' => ['id' => $userIDs]]);

        return true;
    }

    //Instagram activity header
    public function instagram_activity_header()
    {
        //Get ID from query string
        $id = (int)get("id");

        //If page is logs
        if (in_array($this->uri->segment(1), ['logs', 'post','calendar'])) {
            $id = (int)get("account");
        }

        //If ID is not present
        if (empty($id))
            return false;

        //If page is logs or post
        if (in_array($this->uri->segment(1), ['logs', 'post','calendar'])) {

            //Get account details
            $this->db->select("activity.*, account.avatar");
            $this->db->from(INSTAGRAM_ACCOUNTS . " as account");
            $this->db->join(INSTAGRAM_ACTIVITY . " as activity", 'account.id = activity.account_id');
            $this->db->where("account.id = '" . $id . "'");
            $query = $this->db->get();
            $accountInfo = $query->result_array();
        } else {

            //Get account details
            $this->db->select("activity.*, user.avatar, user.checkpoint");
            $this->db->from(INSTAGRAM_ACTIVITY . " as activity");
            $this->db->join(INSTAGRAM_ACCOUNTS . " as user", 'user.id = activity.account_id');
            $this->db->where("activity.uid = '" . session("uid") . "'");
            $this->db->where("activity.id = '" . $id . "'");
            $query = $this->db->get();
            $accountInfo = $query->result_array();
        }

        //If account details not found
        if (count($accountInfo) < 1)
            return false;

        foreach ($accountInfo as $row) {

            $userInfo = $this->fetch_data(EMAIL_ALERT, '*', ['where' => ['account_id' => $row['account_id']]], true);
//            print_r($userInfo);
            ?>
            <div class="col-md-12 m-b-15 <?php if($this->uri->segment(2) != 'auto_activity'){ ?>statadjust<?php } ?>">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 instabottom">
                        <a href="https://instagram.com/<?= $row['account_name'] ?>" target="_blank">
                            <img class="instagram-avatar" src="<?= $row['avatar'] ?>" alt="Instagram avatar">
                        </a>
                        <a href="https://instagram.com/<?= $row['account_name'] ?>" style="color: #000 !important;" target="_blank" class="instagram-username">
                            <?= $row['account_name'] ?>
                        </a>
<!--                        <a href="#" data-popup-open="#popup-account-email" class="fa fa-dashboard"></a>-->
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-add-email" style="color: #000 !important;font-size: 20px;margin-right: 3px;"><i class="fa fa-at" style="vertical-align: middle;"></i></a>
                        <a href="<?= PATH . "dashboard";?>" style="color: #000 !important;font-size: 20px;margin-right: 3px;"><i class="material-icons" style="vertical-align: middle;">dashboard</i></a>

                        <div class="modal fade" id="modal-add-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header new-grey">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Your Email')?></h4>
                                    </div>
                                    <div class="modal-body pt0">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade active in">
                                                <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                                                    <?=l('Add your email to your account to be notified if your Activity is stopped for any reason (reached limits or an error) so your account can grow without interruptions.');?>
                                                </p>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" style="border: 1px solid #ddd !important;" name="email" class="form-control" placeholder="<?=l('Email')?>" value="<?=$userInfo['email']!=''?$userInfo['email']:'';?>">
                                                        <input type="hidden" name="account" class="form-control" value="<?=$row['account_id'];?>">
                                                    </div>
                                                </div>
                                                <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                                                    <?=l('You can add the same email to multiple accounts.');?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="text-align: left;">
                                        <button type="button" class="btn new-blue waves-effect btnAddEmail" style="text-transform: none !important;width: 100px;"><?=l('Set')?></button>
                                        <a class="btn waves-effect btnDeleteEmail" style="text-transform: none !important;color: #337ab7;"><?=l('Remove')?></a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="navbar-header newtoggle">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <i class="fa fa-angle-down"></i>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse menu_02" id="myNavbar" style="padding-top: 3px;">
                            <ul class="nav navbar-nav nav-group">
                                <li><a href="<?= PATH . "activity/auto_activity?id=" . $row['id'] ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(2) == 'auto_activity' ? 'active' : '') ?>"><?= l('Activity') ?></a></li>
                                <li><a href="<?= PATH . "stats?id=" . $row['account_id'] ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(1) == 'stats' ? 'active' : '') ?>"><?= l('Stats') ?></a></li>
                                <li><a href="<?= PATH . "post?account=" . $row['account_id'] ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(1) == 'post' ? 'active' : '') ?>"><?= l('Schedule') ?></a></li>
                                <li><a href="<?= PATH . "logs?account=" . $row['account_id'] ?>" class="navbar-link m-r-15 <?= ($this->uri->segment(1) == 'logs' ? 'active' : '') ?>"><?= l('Log') ?></a></li>
                                <li><a href="https://instagram.com/<?= $row['account_name'] ?>" target="_blank" class="navbar-link m-r-15"><?= l('Profile') ?></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        <?php }

    }

}


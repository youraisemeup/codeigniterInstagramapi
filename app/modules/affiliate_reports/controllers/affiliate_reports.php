<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class affiliate_reports extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['common_model']);
        permission_view(true);
        if(hashcheck()){
            redirect(PATH);
        }
	}

	public function index(){

	    $post = $this->input->get();

	    $startDate = date('Y-m-d 00:00:00', (time() - 31536000)); //1 year
	    $endDate   = date('Y-m-d 23:59:59', time());

	    //If date rage has been selected
	    if (!empty($post['date_range_start']))
	        $startDate = strtotime($post['date_range_start']) ? $post['date_range_start'] . ' 00:00:00' : $startDate;

        //If date rage has been selected
	    if (!empty($post['date_range_end']))
	        $endDate = strtotime($post['date_range_end']) ? $post['date_range_end'] . ' 23:59:59' : $endDate;

	    // Getting all users with referral counts
        $usersReferrals = $this->common_model->get_users_referral_count($startDate, $endDate);

        // Iterating each userID and getting their referrals
        $userIDs = $referrals = $userWise = [];
        $tableFooter = [
            'totalPaidAmount'         => 0,
            'totalUnpaidAmount'       => 0,
            'totalCancelledReferrals' => 0,
            'totalPendingReferrals'   => 0,
            'totalPaidReferrals'      => 0,
            'totalUnpaidReferrals'    => 0,
        ];
        if (count ($usersReferrals) > 0) {
            foreach ($usersReferrals as $row) {
                $userIDs[] = $row['id'];
            }

            // Getting all referrals of users
            $referrals = $this->common_model->referred_users(
                [
                    'where_in' => ['r.user_from' => $userIDs],
                    'where'    => ['r.created >=' => $startDate, 'r.created <=' => $endDate]
                ],
                'r.*, um.fullname, um.email, IFNULL(r.package_subscribed, "N/A") as package_name, IFNULL(p.name, "N/A") as package_name, IFNULL(r.package_amount, "0") as package_price',
                ['join_user_to', 'join_package']
            );

            // If referral found
            if (count($referrals) > 0) {
                foreach ($referrals as $row) {
                    $userWise[$row['user_from']][$row['status']][] = $row;

                    //If pending
                    if ($row['status'] == 0) {
                        $tableFooter['totalPendingReferrals'] += 1;
                    }

                    //If unpaid
                    if ($row['status'] == 1) {
                        $tableFooter['totalUnpaidAmount']    += $row['referral_amount'];
                        $tableFooter['totalUnpaidReferrals'] += 1;
                    }

                    //If paid
                    if ($row['status'] == 2) {
                        $tableFooter['totalPaidAmount']    += $row['referral_amount'];
                        $tableFooter['totalPaidReferrals'] += 1;
                    }
                    //If cancelled
                    if ($row['status'] == 3) {
                        $tableFooter['totalCancelledReferrals'] += 1;
                    }

                }
            }
        }

		$data = [
    	    'referralCounts' => $this->get_referral_counts(),
            'usersReferrals' => $usersReferrals,
            'userWise'       => $userWise,
            'tableFooter'    => $tableFooter,
            'dateRangePicker' => [
                'startDate' => date ('F d, Y', strtotime($startDate)),
                'endDate'   => date ('F d, Y', strtotime($endDate)),
            ],
		];
//    echo '<pre>';
//    print_r($data);
//    die;
		$this->template->title(l('Affiliate Reports'));
		$this->template->build('index', $data);
	}

    /**
     * Get dashboard application counts
     *
     */
    function get_referral_counts ()
    {
        //Get count!
        $referralCounts = $this->common_model->get_refferal_counts();
        $counts = array ( 'total_referrals' => 0, 'pending_referrals' => 0, 'paid_referrals' => 0, 'unpaid_referrals' => 0, 'total_earning' => 0, 'total_referral_spends' => 0 );

        if ( count ( $referralCounts ) > 0 ) {
            foreach ( $referralCounts as $row ) {

                //Total referrals
                $counts['total_referrals'] += $row['referral_count'];

                //Pending referrals
                if ( in_array ( $row['status'], array (0) ) ) {
                    $counts['pending_referrals'] += $row['referral_count'];}

                //Unpaid referrals
                if ( in_array ( $row['status'], array (1) ) ) {
                    $counts['unpaid_referrals'] += $row['referral_count'];
                    $counts['total_earning']    += $row['package_amount'];
                }

                //Paid referrals
                if ( in_array ( $row['status'], array (2) ) ) {
                    $counts['paid_referrals'] += $row['referral_count'];

                    $counts['total_earning']  += $row['package_amount'];

                    $counts['total_referral_spends'] += $row['referral_amount'];
                }

            }
        }

        //Return
        return $counts;
    }

	public function ajax_action_item(){
        $multipleID = array ((int)post('id'));

		if(!empty($multipleID)){
			switch (post("action")) {
				case 'confirm':
                    $this->update_multiple($multipleID, 'confirm');
					break;
				case 'confirm_ref':
                    $this->update_multiple($multipleID, 'confirm_ref');
					break;
				case 'cancel_ref':
                    $this->update_multiple($multipleID, 'cancel_ref');
					break;
			}
		}

		ms(array(
			"st"    => "success",
			"label" => "bg-light-green",
			"txt"   => l('Update successfully')
		));
	}

	public function ajax_action_multiple(){
        $multipleIDs = $this->input->post('id');
		if(!empty($multipleIDs)){
            switch (post("action")) {
                case 'confirm':
                    $this->update_multiple($multipleIDs, 'confirm');
                    break;
                case 'confirm_ref':
                    $this->update_multiple($multipleIDs, 'confirm_ref');
                    break;
                case 'cancel_ref':
                    $this->update_multiple($multipleIDs, 'cancel_ref');
                    break;
            }
		}

        ms(array(
			'st' 	=> 'success',
			'txt' 	=> l('Update successfully')
		));
	}

    public function update_multiple($multipleIDs, $action){

        // Status to update
        $performStatus = [
            'confirm' => 2,
            'confirm_ref' => 2,
            'cancel'  => 3,
            'cancel_ref'  => 3,
        ];

        $finalReferralIDs = [];
        if (in_array($action, ['confirm', 'cancel'])) {

            // Getting all referralIDs of selected users
            $referralIDs = $this->common_model->fetch_data(
                'referrals',
                'referral_id',
                [
                    'where_in' => array('user_from' => $multipleIDs),
//                'where'    => array('status'    => $checkStatus[$action]),
                ]
            );

            // If found
            if (count ($referralIDs) > 0) {

                // Extracting refferalIDs
                foreach ($referralIDs as $referralID) {
                    $finalReferralIDs[] = $referralID['referral_id'];
                }
            }
        } else {
            $finalReferralIDs = $multipleIDs;
        }

        // Performing action
        $this->common_model->update_single(
            'referrals',
            ['status' => $performStatus[$action], 'action_performed' => date('Y-m-d H:i:s', time())],
            [
                'where_in' => array('referral_id' => $finalReferralIDs),
            ]
        );

    }

}
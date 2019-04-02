<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class affiliate extends MX_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['common_model']);
        permission_view(false);
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

        // Iterating each userID and getting their referrals
        $tableFooter = [
            'totalPaidAmount'      => 0,
            'totalUnpaidAmount'    => 0,
        ];

        // Getting all referrals of users
        $referrals = $this->common_model->referred_users(
            [
                'where_in' => ['r.user_from' => session("uid")],
                'where'    => ['r.created >=' => $startDate, 'r.created <=' => $endDate]
            ],
            'r.*, um.fullname, um.email',
            ['join_user_to']
        );

        // If referral found
        if (count($referrals) > 0) {
            foreach ($referrals as $row) {

                //If unpaid
                if ($row['status'] == 1) {
                    $tableFooter['totalUnpaidAmount']    += $row['referral_amount'];
                }

                //If unpaid
                if ($row['status'] == 2) {
                    $tableFooter['totalPaidAmount']    += $row['referral_amount'];
                }

            }
        }

        // Getting all referrals of users
        $referralCommission = $this->common_model->fetch_data('settings', 'commission_percentage', [], true);

        // Getting referral code of user
        $referralCode = $this->common_model->fetch_data('user_management', 'referral_code', ['where' => ['id' => session("uid")]], true);

        // If referral code is not generated for this user before, then generating a new one.
        if (empty($referralCode['referral_code'])) {

            //Loading encryption library
            $this->load->library('Encryption_lib');

            //Generating new code
            $referralCode['referral_code'] = $this->encryption_lib->get_unique_referral_code();

            // Saving in user profile
            $this->common_model->update_single(
                'user_management',
                ['referral_code' => $referralCode['referral_code']],
                ['where' => ['id' => session("uid")]]
            );

        }

        $data = [
    	    'referralCounts'   => $this->get_referral_counts(session("uid")),
            'usersReferrals'   => $referrals,
            'tableFooter'      => $tableFooter,
            'referralStatuses' => [
                ['name' => 'Pending Membership', 'class' => 'warning'],
                ['name' => 'Unpaid',  'class' => 'info'],
                ['name' => 'Paid',    'class' => 'success'],
                ['name' => 'Cancelled', 'class' => 'danger'],
            ],
            'referralCommission' => $referralCommission['commission_percentage'],
            'referralCode' => $referralCode['referral_code'],
            'dateRangePicker' => [
                'startDate' => date ('F d, Y', strtotime($startDate)),
                'endDate'   => date ('F d, Y', strtotime($endDate)),
            ],
		];
//echo '<pre>';
//print_r($data);
//die;
		$this->template->title(l('Affiliate'));
		$this->template->build('index', $data);
	}

    /**
     * Get dashboard application counts
     *
     */
    function get_referral_counts ($userID = null)
    {
        $additionalCondition = [];
        if ($userID)
            $additionalCondition = ['where' => ['user_from' => $userID]];

        //Get count!
        $referralCounts = $this->common_model->get_refferal_counts($additionalCondition);
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
                    $counts['unpaid_referrals'] += $row['referral_count'];}

                //Paid referrals
                if ( in_array ( $row['status'], array (2) ) ) {
                    $counts['paid_referrals'] += $row['referral_count'];

                    $counts['total_earning'] += $row['referral_amount'];
                }

            }
        }

        //Return
        return $counts;
    }

}
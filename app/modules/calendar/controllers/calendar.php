<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Moment\Moment;

class calendar extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this) . '_model', 'model');


//		permission_view();
    }

    public function index()
    {

        if (!is_null(get('date'))) {

            $this->dayView();
            // $this->dayViewAllPost();
        } elseif(post('action')=='remove'){
            $this->remove();
        } else{
            $this->monthView();
        }


    }


    private function monthView(){

//        $year = get('y') ;
        $month = get('month') ;
        $account = get('account') ;

        if(is_null($account)){
            header("Location: ".PATH);
            exit;
        }

//        $month = get('m') ;


        if (!isValidDate($month."-01", "Y-m-d")) {

            $now = new DateTime(date("Y-m-d H:i:s"), new DateTimeZone(TIMEZONE_SYSTEM));
            $now->setTimezone(new DateTimeZone(TIMEZONE_USER));

//            $year = $now->format("Y");
//            $month = $now->format("m");
            $month = $now->format("Y")."-".$now->format("m");

//            header("Location: ".PATH."calendar?y=".$year."&m=".$month);
            header("Location: ".PATH."calendar?month=".$month."&account=".$account);
            exit;
        }

        $data = array(
//                "user" => $user,
            "event" => $month,
            "account" => $account
//            "year" => $year
        );

//        $data = array(
//            "result" => $this->model->getAllSchedules(),
//            "startCount" => $this->common_model->fetch_data(INSTAGRAM_ACTIVITY, 'id', ['where' => ['uid' => session('uid'), 'account_id !=' => 'NULL'], 'where_in' => ['status' => [5]]], true, true),
//            "stopCount" => $this->common_model->fetch_data(INSTAGRAM_ACTIVITY, 'id', ['where' => ['uid' => session('uid'), 'account_id !=' => 'NULL'], 'where_in' => ['status' => [1, 3]]], true, true),
//        );
//
//        //Update user's last online time
        $this->common_model->update_single(USER_MANAGEMENT, ['last_active_time' => date('Y-m-d H:i:s', time())], ['where' => ['id' => session('uid')]]);
//

        $this->template->title(l('Dashboard'));

        $this->template->build('index',$data);

    }


    private function dayView(){

        $date = get('date');
        $account = get('account') ;

        if(is_null($account)){
            header("Location: ".PATH);
            exit;
        }
//        $year = get('y') ;
//        $month = get('m') ;
        $newevent = explode("-",$date);
        $year = $newevent[0];
        $month = $newevent[1];

        if (!isValidDate($date, "Y-m-d")) {
            if (isValidDate($year."-".$month."-01", "Y-m-d")) {
                $url = PATH."calendar?month=".$year."-".$month."&account=".$account;
            } else {
                $url = PATH."calendar?account=".$account;
            }

            header("Location: ".$url);
            exit;
        }


        // Get accounts
//        $Accounts = Controller::model("Accounts");
//        $Accounts->where("user_id", "=", $AuthUser->get("id"))
//            ->orderBy("id","DESC")
//            ->fetchData();
        $data = array();

        $this->db->select('*');
        $this->db->from(INSTAGRAM_ACCOUNTS);
        $this->db->where('uid',session('uid'));
        $this->db->order_by("id","DESC");
        $resp = $this->db->get();

        $Accounts = $resp->num_rows()>0?$resp->result_array():"";


        if ($Accounts != '' && count($Accounts) > 0) {
            // Get schedule counts for each accounts

            $homepath = dirname(__FILE__);
            $new_home = str_replace('app/modules/calendar/controllers','',$homepath);

            require_once($new_home . 'app/libraries/moment/src/Moment.php');

//            $start = new \Moment\Moment($Post["schedule_date"], TIMEZONE_SYSTEM);
//            $start->setTimezone(TIMEZONE_USER);

            $start = new \Moment\Moment($date." 00:00:00",TIMEZONE_USER);
            $start->setTimezone(date_default_timezone_get());

            $end = new \Moment\Moment($date." 23:59:59",TIMEZONE_USER);
            $end->setTimezone(date_default_timezone_get());

            $this->db->select('COUNT(id) as total,account_id');
            $this->db->from('posts');
            $this->db->where('user_id',session('uid'));
            $this->db->where('is_scheduled',1);
            $this->db->where('schedule_date >=',$start->format("Y-m-d H:i:s"));
//            $this->db->where('schedule_date >=',date($date)." 00:00:00");
            $this->db->where('schedule_date <',$end->format("Y-m-d H:i:s"));
//            $this->db->where('schedule_date <',date($date)." 23:59:59");
            $this->db->group_by('account_id');
            $resp2 = $this->db->get();

            $Schedules = $resp2->num_rows()>0?$resp2->result_array():"";

            $count_per_account = [];
            foreach ($Schedules as $r) {
                $count_per_account[$r['account_id']] = $r['total'];
            }

            $ActiveAccount = '';

            if(!is_null(get('account'))){

                $this->db->select('*');
                $this->db->from(INSTAGRAM_ACCOUNTS);
                $this->db->where('uid',session('uid'));
                $this->db->where('id',get('account'));
//            $this->db->order_by("id","DESC");
                $instaresp = $this->db->get();

                $NewActiveAccount = $instaresp->num_rows()>0?$instaresp->result_array():"";

                $ActiveAccount = $NewActiveAccount[0];

            }

//print_r($ActiveAccount);
//            $ActiveAccount = Controller::model("Account", Input::get("account"));
//            if (!$ActiveAccount->isAvailable() || $ActiveAccount->get("user_id") != $AuthUser->get("id")) {
            if ($ActiveAccount == '') {
                    foreach ($Accounts as $a) {
                        if (!empty($count_per_account[$a["id"]])) {
                            $ActiveAccount = $a;
                            break;
                        }
                    }

                    if ($ActiveAccount == '') {
                        $a = $Accounts;
                        $ActiveAccount = $a[0];
                    }
            }

//            print_r($ActiveAccount);
//            die();
            // Get Posts
            $in_progress = 0;
            $completed = 0;

            $Posts = '';

                if($ActiveAccount != ''){

                    $this->db->select('*');
                    $this->db->from('posts');
                    $this->db->where('user_id',session('uid'));
                    $this->db->where('account_id',$ActiveAccount['id']);
                    $this->db->where('is_scheduled',1);
                    $this->db->where('schedule_date >=',$start->format("Y-m-d H:i:s"));
//                    $this->db->where('schedule_date >=',date($date)." 00:00:00");
                    $this->db->where('schedule_date <',$end->format("Y-m-d H:i:s"));
//                    $this->db->where('schedule_date <',date($date)." 23:59:59");
                    $resp3 = $this->db->get();

                    $Posts = $resp3->num_rows()>0?$resp3->result_array():"";

                    if($Posts != ''){
                        foreach ($Posts as $p) {
                            if (in_array($p['status'], ["failed", "published"])) {
//                            if ($p['status'] == "Post successfully" || $p['status'] != '' || $p['status'] != null) {
                                $completed++;
                            } else {
                                $in_progress++;
                            }
                        }
                    }

                }



            $data["Posts"] = $Posts;
            $data["ActiveAccount"] = $ActiveAccount;
            $data["count_per_account"] = $count_per_account;
            $data["in_progress"] = $in_progress;
            $data["completed"] = $completed;
        }

//        $data["month"] = $month;
//        $data["year"] = $year;
        $data["date"] = $date;
        $data["Accounts"] = $Accounts;

        $this->common_model->update_single(USER_MANAGEMENT, ['last_active_time' => date('Y-m-d H:i:s', time())], ['where' => ['id' => session('uid')]]);

        $this->template->title(l('Dashboard'));

        $this->template->build('dayview',$data);

    }

    private function remove()
    {
        $callback = get('callback');
        $result = 0;
//        $AuthUser = $this->getVariable("AuthUser");

        if (!post("id")) {
            $msg= l("ID is required!");
//            $this->jsonecho();
            echo $callback.'('.json_encode(array(
                    "result"    => $result,
                    "details"    => '',
                    "msg"   => $msg
                )).')';
        }

//        $Post = Controller::model("Post", Input::post("id"));

        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where('id',post('id'));
        $postresp = $this->db->get();

        $Post = $postresp->num_rows()>0?$postresp->result_array():"";
        $allowed_statuses = ["published", "publishing"];

        if($Post != ''){

            if(in_array($Post[0]["status"], $allowed_statuses) ||  $Post[0]["user_id"] != session("uid")){

                $msg= l("Invalid ID");
                echo $callback.'('.json_encode(array(
                        "result"    => $result,
                        "details"    => '',
                        "msg"   => $msg
                    )).')';

            }
        }else{
            $msg= l("Invalid ID");
            echo $callback.'('.json_encode(array(
                    "result"    => $result,
                    "details"    => '',
                    "msg"   => $msg
                )).')';
        }

//        if (!$Post->isAvailable() ||
//            $Post->get("user_id") != $AuthUser->get("id") ||
//            in_array($Post->get("status"), ["published", "publishing"]))
//        {
//            $this->resp->msg = l("Invalid ID");
//            $this->jsonecho();
//        }

//        $Post->delete();

        $this->db->where('id',post('id'));
        $RemovePost = $this->db->delete('posts');

//        $this->resp->result = 1;
//        $this->jsonecho();

        echo $callback.'('.json_encode(array(
                "result"    => 1,
                "details"    => '',
                "msg"   => 'Post Deleted Successfully!'
            )).')';
    }




}
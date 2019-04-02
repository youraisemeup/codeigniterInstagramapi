<style>
    /*#sticky {*/
    /*padding: 0.5ex;*/
    /*width: 100%;*/
    /*background-color: #333;*/
    /*color: #fff;*/
    /*font-size: 2em;*/
    /*border-radius: 0.5ex;*/
    /*}*/

    #UpdateAlert.stick {
        position: fixed;
        top: 0;
        z-index: 10000;
        width: 84.5%;
        /*border-radius: 0 0 0.5em 0.5em;*/
    }

    @media only screen and (max-width: 560px) and (min-width: 280px){
        #UpdateAlert.stick {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 760px) and (min-width: 561px){
        #UpdateAlert.stick {
            width: 95.5%;
        }
    }

    .carousel-indicators {
        position: absolute;
        bottom: 20px !important;
        left: 50%;
        z-index: 15;
        width: 60%;
        padding-left: 0;
        margin-left: -30%;
        text-align: center;
        list-style: none;
    }
    .modal-content {
        padding: 0px !important;
    }
    .carousel-control.left{background: none !important;}
    .carousel-control.right{background: none !important;}
    .carousel-indicators li {
        display: inline-block;
        width: 8px;
        height: 8px;
        margin: 1px;
        text-indent: -999px;
        cursor: pointer;
        background-color: #000\9;
        background-color: rgb(167, 167, 165);
        border: 0px !important;
        /* border-radius: 50%; */
    }

    .carousel-inner {

        margin-bottom: 50px !important;
    }


    .carousel-indicators .active {
        width: 8px;
        height: 8px;
        margin: 1px;
        background-color: #0070bc;
    }
    .carousel-control .glyphicon-chevron-left, .carousel-control .glyphicon-chevron-right, .carousel-control .icon-next, .carousel-control .icon-prev{
        font-size: 14px !important;
        color: #0070bd;
    }
    /*.carousel-control{*/
    /*opacity: 1;*/
    /*box-shadow: 0px;}*/

    .item h2{
        margin: 0px;
        text-align: center;
        font-size: 22px;
        color: #000;
        padding: 20px 0px 20px;
    }
    .item p{
        font-size: 13px;
        color: #000;
        text-align: center;
        width: 80%;
        margin: 0 auto;}
    .carousel{position: initial !important;}
    .slider_go {
        /*background: #a7a7a5;*/
        /*margin: 10px auto;*/
        /*display: table;*/
        /*font-size: 12px;*/
        /*padding: 10px 30px;*/
        /*color: #fff;*/
        /*border-radius: 5px;*/
        /*float: none;*/
        /*opacity: 1;*/
        /*font-weight: normal;*/

        background: #0D509F;
        margin: 10px auto;
        display: table;
        font-size: 14px;
        padding: 10px 30px;
        color: #fff;
        border-radius: 5px;
        float: none;
        opacity: 1 !important;
        font-weight: normal;
        text-shadow: none;
    }

    .slider_go:hover{
        background: #0D509F;
        color: #fff;
    }

    .carousel-control {text-shadow: 0 0px 0px rgba(0, 0, 0, .6);}

    /*.slider_go:hover{color: #fff; text-decoration: none;}*/
    /*a:focus, a:hover {*/
    /*color: #fff;*/
    /*text-decoration: none;*/
    /*}*/

    /*body {*/
    /*margin: 1em;*/
    /*}*/

    /*p {*/
    /*margin: 1em auto;*/
    /*}*/
</style>
<div class="row SchedulesListActivity" data-action="<?=url("schedules/ajax_enable_activity")?>" data-payment="<?=url("payments")?>">
    <div class="col-md-12">
        <div class="col-md-12">
            <h3><?=l('Dashboard')?></h3>
        </div>
    </div>
    <div class="col-md-12">
        <div class="filter">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php if(!empty($result) and (count($result) > 0)) { ?>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 m-b-15">
                            <span>Activity</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <a href="javascript:void(0);" data-action="1" class="btn waves-effect bg-dashboard-primary btn-block btn-dashboard rounded-corner all-activities-start m-b-15" data-url="<?=url('schedules/ajax_action_all_activity')?>"><?=l('Start all')?></a>
                            <div>Started <span class="m-l-5 col-black font-bold activity-count"><?=$startCount?></span></div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <a href="javascript:void(0);" data-action="2" class="btn waves-effect btn-block btn-dashboard bg-grey rounded-corner all-activities-stop m-b-15" data-url="<?=url('schedules/ajax_action_all_activity')?>"><?=l('Stop all')?></a>
                            <div>Stopped <span class="m-l-5 col-black font-bold activity-count"><?=$stopCount?></span></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-lg-offset-2 col-md-offset-2 col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <span>Add new Instagram account</span>
                    <div class="form-group m-t-15">
                        <a href="javascript:void(0);" class="btn waves-effect bg-dashboard-primary btn-block btn-dashboard rounded-corner" data-toggle="modal" data-target="#modal-add-account"><?=l('Add account')?></a>
                    </div>
					<a href="https://www.igplan.com/basic/managing-accounts/" class="custom-help-block" target="_blank">Learn more about Dashboard</a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
<!--                    <span>Unlock more features</span>-->
                    <span>Add more Instagram accounts</span>
                    <div class="m-t-15">
                        <a href="<?=url("payments")?>" class="btn waves-effect btn-block btn-dashboard bg-dashboard-success rounded-corner"><?=l('Upgrade')?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="col-md-12 m-t-15 filters">
        <form>
            <div class="col-lg-offset-4 col-md-offset-4 col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <div class="input-group" style="margin-bottom: 20px;">
                    <span class="input-group-addon"><?=l('Sort:')?> </span>
                    <select name="sort" style="height: 36px;" class="form-filter form-control show-tick activity_speed" style="border-radius: 4px !important;">
                        <option value=""><?=l('-')?></option>
                        <option value="username" <?=get("sort") == "username"?"selected":""?>><?=l('Username')?></option>
                        <option value="time" <?=get("sort") == "time"?"selected":""?>><?=l('Time')?></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                <div class="input-group" style="margin-bottom: 20px;">
                    <span class="input-group-addon"><?=l('Filter:')?> </span>
                    <select name="filter" style="height: 36px;" class="form-filter form-control show-tick activity_speed" style="border-radius: 4px !important;">
                        <option value=""><?=l('-')?></option>
                        <option value="started" <?=get("filter") == "started"?"selected":""?>><?=l('Started')?></option>
                        <option value="stoped" <?=get("filter") == "stoped"?"selected":""?>><?=l('Stoped')?></option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="input-group mb15">
                    <div class="form-line" style="height: 35px !important;padding: 0px 10px !important;">
                        <input type="text" name="keyword" class="form-control" value="<?=clean(get("keyword"))?>" style="height: 35px;" placeholder="<?=l('Search by username')?>">
                    </div>
                    <span class="input-group-btn">
<!--                        <button type="submit" class="btn bg-dashboard-btn waves-effect" style="border-radius: 4px !important;margin-top: -5px !important;"><i class="fa fa-search" aria-hidden="true"></i> --><?//=l('Search')?><!--</button>-->
                        <button type="submit" class="btn bg-dashboard-btn waves-effect" style="border-radius: 4px !important; width:108%;margin-top: -5px !important;padding: 0px 15px !important;font-size: 15px !important;"><?=l('Search')?></button>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12">
        <div class="row row-eq-height">
            <div class="col-md-12">
<!--                <div class="row">-->
            <?php if(!empty($result)){
//echo '<pre>';print_r($result);die;
            $arrayChunks = array_chunk($result, 3);
            foreach ($arrayChunks as $rowSet) {
                foreach ($rowSet as $key => $row) {
//					$checkSchedule = checkSchedule($row->account_id);
//					$checkStop = checkStop($row->account_id);
            ?>
<!--            <div class="item-container --><?php //= $key == 0 ? 'col-lg-offset-1 col-md-offset-1' : '' ?><!-- col-lg-3 col-md-3 col-sm-6 col-xs-12">-->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="alert-message-activity">
                    <?php if (!empty($row->checkpoint)) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-warning" role="alert">
                                    Activity stopped working:
                                    <?= $row->checkpoint == 1
                                        ? l("Please go to <a href='http://instagram.com/' target='_blank'>http://instagram.com/</a> to verify email and then click button MORE and select RECONNECT.")
                                        : ($row->checkpoint == 2)
                                            ? l("Please update password on this account to continue use.")
                                            : ($row->checkpoint == 3)
                                                ? l('Please click button MORE and click RECONNECT, then click "Start".')
                                                : ''
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="item bg-dashboard-item" data-id="<?=$row->id?>" data-action="<?=cn("disconnect")?>">
                    <div class="info-box-2 mb0 bg-dashboard-item">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <div class="icon">
                            <a href="<?=cn()."auto_activity?id=".$row->id?>">
                                <img style="margin: 9px;" class="media-object" src="<?=$row->avatar?>" width="64" height="64">
                            </a>
                        </div>
                        <div class="content">
                            <div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">
                                <a href="<?=cn()."auto_activity?id=".$row->id?>" class="col-black"><?=$row->account_name?></a>
                            </div>
                            <div class="col-grey" style="padding-top: 0px !important;"><?=l('Instagram')?></div>
                        </div>
                    </div>
                    <hr style="padding: 0px;margin: 5px 0px;">
<!--                    <div class="row">-->
                        <div class="col-md-12 list-group-count">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey" style="padding-bottom: 10px;">
                                    <?=l('Activity')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 ajax_status col-grey">
                                    <?php
                                    switch ($row->status) {
                                        case 5:
//                                            echo '<span class="badge bg-light-green">'.l('Started').'</span>';
                                            echo '<span class="badge bg-dashboard-primary">'.l('Started').'</span> <i class="fa fa-spinner abcnew loadernew" style="color: #000;"></i>';
                                            break;

                                        default:
                                            echo '<span class="badge bg-red">'.l('Stopped').'</span> <i class="fa fa-times-circle" style="color: #F44336;"></i>';
                                            break;
                                    }
                                    ?>
                                </div>
                            </div>

                            <?php

                            $homepath = dirname(__FILE__);
                            $new_home = str_replace('app/modules/activity/views','',$homepath);

                            require_once($new_home . 'app/libraries/moment/src/Moment.php');

                            if($row->start_date){

                                $start_date = new \Moment\Moment($row->start_date, TIMEZONE_SYSTEM);
                                $start_date->setTimezone(TIMEZONE_USER);

                                $format = "Y-m-d h:i A";

                                $sdate = $start_date->format($format);

                            }else{
                                $sdate = '-';
                            }



                            if($row->stop_date){

                                $stop_date = new \Moment\Moment($row->stop_date, TIMEZONE_SYSTEM);
                                $stop_date->setTimezone(TIMEZONE_USER);

                                $format = "Y-m-d h:i A";

                                $edate = $stop_date->format($format);

                            }else{
                                $edate = '-';
                            }


                            ?>

                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey">
                                    <?=l('Started on')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey">
                                    <span class="font-bold col-black"><?=$sdate?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey">
                                    <?=l('Stopped on')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey">
                                    <span class="font-bold col-black"><?=$edate?></span>
                                </div>
                            </div>
                            <hr style="padding: 0px;margin: 5px 0px 22px;">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey">
                                    <?=l('Likes')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey">
                                    <span class="font-bold col-black"><?=$row->like_count?></span>
<!--									 --><?php //if(!empty($checkSchedule)&&$checkSchedule->like==1) echo "<a href='https://www.igplan.com/troubleshooting/settings-help/#fixingthefeedbackrequirederror' target='_blank'><u style='color:#0D509F;'>FeedBack Required</u></a>"?>
<!--									 --><?php //if(!empty($checkStop)&&$checkStop->like==1) echo "<font style='color:#0D509F;'>Like Stopped</font>"?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey">
                                    <?=l('Comments')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey">
                                    <span class="font-bold col-black"><?=$row->comment_count?></span>
<!--									 --><?php //if(!empty($checkSchedule)&&$checkSchedule->comment==1) echo "<a href='https://www.igplan.com/troubleshooting/settings-help/#fixingthefeedbackrequirederror' target='_blank'><u style='color:#0D509F;'>FeedBack Required</u></a>"?>
<!--									 --><?php //if(!empty($checkStop)&&$checkStop->comment==1) echo "<font style='color:#0D509F;'>Comment Stopped</font>"?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey">
                                    <?=l('Follows')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey">
                                    <span class="font-bold col-black"><?=$row->follow_count?></span>
<!--									 --><?php //if(!empty($checkSchedule)&&$checkSchedule->follow==1) echo "<a href='https://www.igplan.com/troubleshooting/settings-help/#fixingthefeedbackrequirederror' target='_blank'><u style='color:#0D509F;'>FeedBack Required</u></a>"?>
<!--									 --><?php //if(!empty($checkStop)&&$checkStop->follow==1) echo "<font style='color:#0D509F;'>Follow Stopped</font>"?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey">
                                    <?=l('Unfollows')?>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey">
                                    <span class="font-bold col-black"><?=$row->unfollow_count?></span>
<!--									 --><?php //if(!empty($checkSchedule)&&$checkSchedule->unfollow==1) echo "<a href='https://www.igplan.com/troubleshooting/settings-help/#fixingthefeedbackrequirederror' target='_blank'><u style='color:#0D509F;'>FeedBack Required</u></a>"?>
<!--									 --><?php //if(!empty($checkStop)&&$checkStop->unfollow==1) echo "<font style='color:#0D509F;'>Unfollow Stopped</font>"?>
                                </div>
                            </div>
                            <hr style="padding: 0px;margin: 20px 0px 5px;">
                        </div>
                        <div class="list-group"> <!--col-md-12-->

                            <div class="list-group-item control bg-dashboard-item">
                                <span class="ajax_btn_enable">
                                <?php
                                switch ($row->status) {
                                    case 5:
                                        echo '<button type="button" style="width: 31%;float: left;padding: 7px 16px !important;" class="btn btn-dashboard bg-red rounded-corner waves-effect btnActivityAll" data-dashboard="1">'.l('Stop').'</button>';
                                        break;

                                    default:
                                        echo '<button type="button" style="width: 31%;float: left;padding: 7px 16px !important;" class="btn btn-dashboard bg-dashboard-primary rounded-corner waves-effect btnActivityAll" data-dashboard="1">'.l('Start').'</button>';
                                        break;
                                }
                                ?>

                                </span>
                                <a href="<?=cn()."auto_activity?id=".$row->id?>" class="btn btn-dashboard bg-grey rounded-corner waves-effect" style="width: 31%;margin: 0px 8px; float: left;padding: 7px 16px !important;"><?=l('Settings')?></a>
                                <div class="btn-group" style="width: 31%;">
                                    <button type="button" class="btn btn-dashboard bg-grey rounded-corner dropdown-toggle uc" style="width: 100%;padding: 7px 16px !important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <?=l('More')?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="top: -260px;left: -64px;">
                                        <li><a href="<?=PATH."activity/auto_activity?id=".$row->id?>" class=" waves-effect waves-block"><?=l('Activity')?></a></li>
                                        <li><a href="<?=PATH."logs?account=".$row->account_id?>" class=" waves-effect waves-block"><?=l('Log')?></a></li>
                                        <li><a href="<?=PATH."stats?id=".$row->account_id?>" class=" waves-effect waves-block"><?=l('Stats')?></a></li>
                                        <li><a href="<?=PATH."post?account=".$row->account_id?>" class=" waves-effect waves-block"><?=l('Schedule')?></a></li>
                                        <li><a href="https://instagram.com/<?=$row->account_name?>" target="_blank" class=" waves-effect waves-block"><?=l('Profile')?></a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnReconnect btnUpdateGroups" data-type="page" data-id="<?=$row->account_id?>" data-action-groups="<?=url('instagram_accounts/ajax_get_groups')?>"><?=l('Reconnect')?></a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDisconnect" data-confirm="<?=l('Do you want delete these items?')?>"><?=l('Disconnect')?></a></li>
<!--                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDisconnect" data-confirm="--><?//=l('Do you want disconect this account?')?><!--">--><?//=l('Disconnect')?><!--</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
<!--                    </div>-->
                </div>
            </div>

            <?php }}}else{?>
                <div class="col-md-12">
                    <div class="logs_empty" style="border: none !important;">
<!--                        <i class="fa fa-chain-broken" aria-hidden="true"></i>-->
<!--                        <div class="text">--><?//=l('No recent activity')?><!--</div>-->

                        <div class="text">
                            <a href="javascript:void(0);" style="color:#000000;" data-toggle="modal" data-target="#modal-add-account"><?=l('Click ')?><font style="color: #337ab7;font-weight: bold;text-decoration: underline;"><?=l('HERE')?></font><?=l(' to add your Instagram account')?></a>
                        </div>
                    </div>
                </div>
            <?php }?>
<!--        </div>-->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="getstartguide" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header new-grey">
                <button type="button" class="close">&times;</button>
                <h4 style="text-align: center;" class="modal-title" id="defaultModalLabel"><?=l('Quick Start Guide')?></h4>
            </div>
            <div class="modal-body pt0">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" style="height: 310px;">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                        <li data-target="#myCarousel" data-slide-to="4"></li>
                        <li data-target="#myCarousel" data-slide-to="5"></li>

                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">

                        <div class="item active">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g1.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Recommended actions');?></h2>
                            <p><?=l('Do not use all of the actions at the same time as a beginner. It is safer to use only the Like action on Slow speed for your first few days on IGplan.');?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g2.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Recommended speed');?></h2>
                            <p><?=l('Start using IGplan on the Slow speed to ensure your account is safe. You can increase the speed to Normal or Fast after a few days of using IGplan.');?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g3.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Adjust your settings');?></h2>
                            <p><?=l('IGplan offers a wide variety of activity settings for the most effective interaction with your target audience.');?></p>
                        </div>
                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g4.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Instagram content');?></h2>
                            <p><?=l("It's important that your Instagram account doesn't look fake or spammy. It is better to have an actively maintained account with at least 15 photos/videos posted.");?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g5.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Important information');?></h2>
                            <p><?=l("Feel free to post pictures when IGplan is started but make sure you don't Like, Comment, Follow, or Unfollow manually. Manual activity can lead to password resets.");?></p>
                        </div>

                        <div class="item">
                            <div style="width:35%; margin: 0 auto;">
                                <img src="<?=BASE?>assets/images/slide/g6.png" style="width:100%;">
                            </div>
                            <h2 style="padding-bottom:10px;"><?=l('Now you are ready!');?></h2>
                            <p><?=l("It's time to customize your settings and start your activity.");?></p>
                            <a href="javascript:void(0);" class="slider_go">Let's Go</a>
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $('.slider_go').click(function(){
            window.location.reload();
        });

        $('.close').click(function(){
            window.location.reload();
        });
    });
</script>

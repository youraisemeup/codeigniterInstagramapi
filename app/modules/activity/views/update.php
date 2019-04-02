<?php
$schedule_default = SCHEDULE_DEFAULT;

$schedule_default = json_decode($schedule_default);
$targets_default = json_decode($schedule_default->target);
$speed_default = $schedule_default->speed;
$target_hashtag = $targets_default->tag;
$target_location = $targets_default->location;
$target_followers = $targets_default->followers;
$target_followings = $targets_default->followings;
$target_likers = $targets_default->likers;
$target_commenters = $targets_default->commenters;
$todo = json_decode($schedule_default->todo);
$tags = json_decode($schedule_default->tags);


$locations = json_decode($schedule_default->locations);
$comments = json_decode($schedule_default->comments);
$messages = json_decode($schedule_default->messages);
$filter = json_decode($schedule_default->filter);

$blacklists_default = BLACKLISTS_DEFAULT;
$blacklists_default = json_decode($blacklists_default);
$blacklist_tags = json_decode($blacklists_default->bl_tags);
$blacklist_usernames = json_decode($blacklists_default->bl_usernames);
$blacklist_keywords = json_decode($blacklists_default->bl_keywords);


$usernames = array();
switch ($speed_default) {
    case 1:
        $slow = json_decode($schedule_default->slow);
        $delay = (int)$slow->delay;
        $speed_like = (int)$slow->like;
        $speed_comment = (int)$slow->comment;
        $speed_deletemedia = (int)$slow->deletemedia;
        $speed_follow = (int)$slow->follow;
        $speed_like_follow = (int)$slow->like_follow;
        $speed_followback = (int)$slow->followback;
        $speed_unfollow = (int)$slow->unfollow;
        $speed_repost = (int)$slow->repost;
        break;
    case 2:
        $medium = json_decode($schedule_default->medium);
        $delay = (int)$medium->delay;
        $speed_like = (int)$medium->like;
        $speed_comment = (int)$medium->comment;
        $speed_deletemedia = (int)$slow->deletemedia;
        $speed_follow = (int)$medium->follow;
        $speed_like_follow = (int)$medium->like_follow;
        $speed_followback = (int)$medium->followback;
        $speed_unfollow = (int)$medium->unfollow;
        $speed_repost = (int)$medium->repost;
        break;
    case 3:
        $fast = json_decode($schedule_default->fast);
        $delay = (int)$fast->delay;
        $speed_like = (int)$fast->like;
        $speed_comment = (int)$fast->comment;
        $speed_deletemedia = (int)$slow->deletemedia;
        $speed_follow = (int)$fast->follow;
        $speed_like_follow = (int)$fast->like_follow;
        $speed_followback = (int)$fast->followback;
        $speed_unfollow = (int)$fast->unfollow;
        $speed_repost = (int)$fast->repost;
        break;
}

$act_status = 1;

if(!empty($item)){
    $target_hashtag = false;
    $target_location = false;
    $target_followers = 0;
    $target_followings = 0;
    $target_likers = 0;
    $target_commenters = 0;

    $schedule = json_decode($item->data);
    $todo = json_decode($schedule->todo);
    $targets = $schedule->targets;
    $comments = json_decode($schedule->comments);
    $locations = json_decode($schedule->locations);
    $usernames = json_decode($schedule->usernames);
    $messages = json_decode($schedule->messages);
    $speed = json_decode($schedule->speed);
    $tags = json_decode($schedule->tags);
    $filter = json_decode($schedule->filter);


    //====blacklist
    $blacklists = json_decode($item->blacklists);
    $blacklist_tags = json_decode($blacklists->bl_tags);
    $blacklist_usernames = json_decode($blacklists->bl_usernames);
    $blacklist_keywords = json_decode($blacklists->bl_keywords);

  
	if(isset($targets) && count($targets) > 0 ){
		
		 // ===unfollow
		$unfollow = $targets->unfollow;
		//$unfollow = json_decode($unfollow);
		$unfollow_source = $unfollow->unfollow_source;
		$unfollow_followers = $unfollow->unfollow_followers;
		$unfollow_follow_age = $unfollow->unfollow_follow_age;
		
		if($targets->tag == 1){ $target_hashtag = true; }
		if($targets->location == 1){ $target_location = true; }
		if($targets->followers != 0){ $target_followers = $targets->followers; }
		if($targets->followings != 0){ $target_followings = $targets->followings; }
		if($targets->likers != 0){ $target_likers = $targets->likers; }
		if($targets->commenters != 0){ $target_commenters = $targets->commenters; }

	}
   
    $speed_like = (int)$speed->like;
    $speed_comment = (int)$speed->comment;
    $speed_deletemedia = (int)$speed->deletemedia;
    $speed_follow = (int)$speed->follow;
    $speed_like_follow = (int)$speed->like_follow;
    $speed_followback = (int)$speed->followback;
    $speed_unfollow = (int)$speed->unfollow;
    $speed_repost = (int)$speed->repost;
    $delay = (int)$speed->delay;
    $speed_default = (int)$speed->type;

    $act_status = $item->status;
}
?>

<script type="text/javascript">
    var activity_speed = [
        <?=$schedule_default->slow?>,
        <?=$schedule_default->medium?>,
        <?=$schedule_default->fast?>
    ];
</script>

<div class="row rowadjust">

    <div class="bootstrap-alert bootstrap-alert-success successfully-reconnected" hidden="" role="alert">
        <?=l('The ');?><strong id="new-name"></strong><?=l(' account has been successfully connected/reconnected.');?>
    </div>

    <form class="formSchedule" action="javascript:void(0);" data-type="all" data-action="<?=url("schedules/ajax_add_multi_schedules")?>" data-redirect="<?=url('')?>">
    <?php
        $emdata = '';
        if(!empty($result)){
            foreach ($result as $key => $row) {

                $emresp = $this->common_model->fetch_data(EMAIL_ALERT, '*', ['where' => ['account_id' => $row->account_id]], true);

                $emdata = $emresp['email'];
            ?>

            <input type="hidden" name="accounts[]" value="<?=$row->account_id?>">
            <div id="newid" hidden=""><?=$row->account_id?></div>
        <?php }}?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!--        <div class="card">-->
            <div class="body pb0">
                <?php if ($this->uri->segment(2) == 'auto_activity') { ?>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 activity-status-button margin-bottom-0" data-action="<?=url("schedules/ajax_enable_activity")?>">
                        <div class="col-md-12 list-group-count m-t-15">
                            <div class="row">
                                <div class="header uc">
                                    <h2 style="padding-left: 16px; font-size: 35px;">
                                        <?=l('Activity')?>
                                    </h2>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-5 col-xs-5 col-grey">
                                    <?=l('Status')?>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-7 col-xs-7">
                                    <?php
                                    switch ($row->status) {
                                        case 5:
                                            echo '<div class="activity-status statnew" id="statnew" style="padding: 15px; display: table;">'.l('Started').' <i class="fa fa-spinner abcnew loadernew"></i></div>';
                                            break;

                                        default:
                                            echo '<div class="activity-status statnew" id="statnew" style="padding: 15px; display: table;">'.l('Stopped').'</div>';
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

                                $sdate = '<span class="col-black" style="font-size: 13px;">'.$start_date->format($format);

                            }else{
                                $sdate = '<span class="col-black" style="font-size: 15px;font-weight: bolder;">-';
                            }



                            if($row->stop_date){

                                $stop_date = new \Moment\Moment($row->stop_date, TIMEZONE_SYSTEM);
                                $stop_date->setTimezone(TIMEZONE_USER);

                                $format = "Y-m-d h:i A";

                                $edate = '<span class="col-black" style="font-size: 13px;">'.$stop_date->format($format).'</span>';

                            }else{
                                $edate = '<span class="col-black" style="font-size: 15px;font-weight: bolder;">-</span>';
                            }


                            ?>

                            <div class="row" style="margin-bottom: 15px;">
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey" style="font-size: 15px;">
                                    Started on
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6 col-grey" style="font-size: 15px;">
                                    <?=$sdate?>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6 col-grey" style="font-size: 15px;">
                                    Stopped on
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-6  col-grey" style="font-size: 15px;">
                                    <?=$edate?>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-15 m-b-10">
<!--                            <button type="button" class="btn btn-lg waves-effect btn-block btn-dashboard bg-grey rounded-corner btnAddSchedules"><i class="fa fa-play" aria-hidden="true"></i> --><?//=l('Start/Stop')?><!--</button>-->
<!--                            <button type="button" class="btn btn-lg waves-effect btn-block btn-dashboard bg-dashboard-primary rounded-corner btnAddSchedules"><i class="fa fa-play" aria-hidden="true"></i> --><?//=l('Start/Stop')?><!--</button>-->
                            <?php
                            switch ($row->status) {
                                case 5:
                                    echo '<button type="button" class="btn btn-lg waves-effect btn-block btn-dashboard bg-grey rounded-corner btnAddSchedules" style="width: 180px;">'.l('Stop').'</button>';
                                    break;

                                default:
                                    echo '<button type="button" class="btn btn-lg waves-effect btn-block btn-dashboard bg-dashboard-primary rounded-corner btnAddSchedules" style="width: 180px;">'.l('Start').'</button>';
                                    break;
                            }
                            ?>

                            <input type="hidden" class="newstatus" name="newstatus" id="newstatus" value="<?php if(!empty($item)){ echo $item->status; }else{ echo 1; } ?>">

                        </div>
                        <?php /*
                        <div class="item m-t-15 m-b-10" data-id="<?=$row->id?>" data-action="<?=cn("disconnect")?>">
                            <span class="ajax_btn_enable text-center">
                                <?php
                                switch ($row->status) {
                                    case 5:
                                        echo '<button type="button" class="btn waves-effect btn-block btn-dashboard bg-grey rounded-corner btnActivityAll" data-dashboard="0">'.l('Stop').'</button>';
                                        break;

                                    default:
                                        echo '<button type="button" class="btn waves-effect btn-block btn-dashboard rounded-corner btnActivityAll" data-dashboard="0">'.l('Start').'</button>';
                                        break;
                                }
                                ?>
                            </span>
                        </div>
                         */ ?>
                        <a href="#" class="custom-help-block quickguide"><?=l('Quick Start Guide')?></a>
<!--                        <a href="--><?//= PATH . "dashboard";?><!--" class="custom-help-block">--><?//=l('Dashboard')?><!--</a>-->
<!--                        <button type="button" style="margin-top: 10px;" class="btn waves-effect btn-block btn-dashboard bg-grey rounded-corner btnSaveSettings">Save/Load Settings</button>-->
                        <div id="savesettings" hidden=""><?=url("schedules/save_schedules")?></div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 activity-status-button margin-bottom-0">
                        <div class="servic_text"><?=l('Select what you want to do')?></div>

                        <div class="todo-control" data-field="like">
                            <label class="switch-label">
                                <input type="checkbox" name="todo_like" <?=($todo->like==1)?"checked":""?>>
                                <span class="switch-slider round">
                                    <i class="fa fa-heart col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-heart col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                            </label>
                            <label class="todo-label">
                                <?=l('Likes')?>
                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Likes activity.<br/><br/>
									  	The counter shows how many photos and videos you've liked
										since your last activity start.
									  " data-original-title="<?=l('Likes')?>">?</span>
                            </label>
                            <span class="todo-count" id="like_count"><?=$row->like_count?></span>
                        </div>

                        <div class="todo-control" data-field="comment">
                            <label class="switch-label">
                                <input type="checkbox" name="todo_comment" <?=($todo->comment==1)?"checked":""?>>
                                <span class="switch-slider round">
                                    <i class="fa fa-comment col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-comment col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                            </label>
                            <label class="todo-label">
                                <?=l('Comments')?>
                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Comments activity.<br/><br/>
									  	The counter shows how many photos and videos you've commented
										since your last activity start.
									  " data-original-title="<?=l('Comments')?>">?</span>
                            </label>
                            <span class="todo-count" id="comment_count"><?=$row->comment_count?></span>
                        </div>

                        <div class="todo-control" data-field="follow">
                            <label class="switch-label">
                                <input type="checkbox" name="todo_follow" <?=($todo->follow==1)?"checked":""?>>
                                <span class="switch-slider round">
                                    <i class="fa fa-user col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-user col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                            </label>
                            <label class="todo-label">
                                <?=l('Follows')?>
                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Follows activity.<br/><br/>
									  	The counter shows how many users you've followed
										since your last activity start.
									  " data-original-title="<?=l('Follows')?>">?</span>
                            </label>
                            <span class="todo-count" id="follow_count"><?=$row->follow_count?></span>
                        </div>

                        <div class="todo-control" data-field="unfollow">
                            <label class="switch-label">
                                <input type="checkbox" name="todo_unfollow" <?=($todo->unfollow==1)?"checked":""?>>
                                <span class="switch-slider round">
                                    <i class="fa fa-times col-white font-20 disable" aria-hidden="true"></i>
                                    <i class="fa fa-times col-white font-20 enable" aria-hidden="true"></i>
                                </span>
                            </label>
                            <label class="todo-label">
                                <?=l('Unfollows')?>
                                <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-content="Turn this switch on (blue) to automate your Unfollows activity.<br/><br/>
									  	The counter shows how many users you've unfollowed
										since your last activity start.
									  " data-original-title="<?=l('Unfollows')?>">?</span>
                            </label>
                            <span class="todo-count" id="unfollow_count"><?=$row->unfollow_count?></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5 col-sm-12 col-xs-12 margin-bottom-0">
                        <div class="row">
                            <div class="embed-responsive-4by3">

                                <div class="video-warp">
                                    <iframe src="https://player.vimeo.com/video/307399102?title=0&amp;byline=0&amp;portrait=0" frameborder="0"></iframe>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
<div class="card">
                <div class="row m-b-30">
                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                        <div class="btn-group hidden" role="group">
                            <div class="hidden">
                                <input type="checkbox" name="todo_like_follow" <?=($todo->like_follow==1)?"checked":""?>>
                                <input type="checkbox" name="todo_followback" <?=($todo->followback==1)?"checked":""?>>
                                <select name="todo_repost" class="form-control show-tick">
                                    <option value=""><?=l('Default')?></option>
                                    <option value="1" <?=($todo->repost == 1)?"selected":""?>><?=l('Hashtags')?></option>
                                    <option value="2" <?=($todo->repost == 2)?"selected":""?>><?=l('Locations')?></option>
                                    <option value="3" <?=($todo->repost == 3)?"selected":""?>><?=l('Usernames')?></option>
                                    <option value="4" <?=($todo->repost == 4)?"selected":""?>><?=l('All')?></option>
                                </select>
                                <input type="checkbox" name="todo_deletemedia" <?=($todo->deletemedia==1)?"checked":""?>>
                                <select name="repeat_like_follow" class="form-control show-tick repeat_like_follow">
                                    <?php for($i = 1; $i <= 30; $i++){?>
                                        <option value="<?=$i?>" <?=($speed_like_follow == $i)?"selected":""?>><?=$i?></option>
                                    <?php }?>
                                </select>
                                <select name="repeat_deletemedia" class="form-control show-tick repeat_deletemedia">
                                    <?php for($i = 1; $i <= 30; $i++){?>
                                        <option value="<?=$i?>" <?=($speed_deletemedia == $i)?"selected":""?>><?=$i?></option>
                                    <?php }?>
                                </select>
                                <select name="repeat_followback" class="form-control show-tick repeat_followback">
                                    <?php for($i = 1; $i <= 30; $i++){?>
                                        <option value="<?=$i?>" <?=($speed_followback == $i)?"selected":""?>><?=$i?></option>
                                    <?php }?>
                                </select>
                                <select name="repeat_repost" class="form-control show-tick repeat_repost">
                                    <?php for($i = 1; $i <= 30; $i++){?>
                                        <option value="<?=$i?>" <?=($speed_repost == $i)?"selected":""?>><?=$i?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                        <div class="panel-group full-body" id="accordion_22" role="tablist" aria-multiselectable="true">

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingOne_19">
                                    <h4 class="panel-title">
                                        <a role="button" class="activity-settings-cat" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19">
                                            <div class="general-icon general-icon-targeting"></div>
                                            <span><?=l('Targeting')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Hashtags')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Hashtags')?>" data-content="<?=l("Based on selected Activity Actions, you can like and/or comment
								  	on media posted under <b>Hashtags</b> added in your settings,
								  	and/or follow users who posted those media.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you should add at least 1 tag in the <b>Hashtags</b> list.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <div>
                                                                <label>
                                                                    <input type="checkbox" class="chk-custom" name="enable_tag"
                                                                        <?php
                                                                            if($target_hashtag){
                                                                                echo "checked";
                                                                            }else{
                                                                                if(!empty($tags)){
                                                                                    echo "checked";
                                                                                }else{
                                                                                    echo "";
                                                                                }
                                                                            } ?>>
                                                                    <span class="chk-custom"></span>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Locations')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Locations')?>" data-content="<?=l("Based on selected Activity Actions, you can like and/or comment
								  	on media posted under <b>Locations</b> added in your settings,
								  	and/or follow users who posted those media.<br/><br/>
 
								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you should add at least 1 location in the <b>Locations</b> list.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <div>
                                                                <label>
                                                                    <input type="checkbox" class="chk-custom" name="enable_location" <?=($target_location)?"checked":""?>>
                                                                    <span class="chk-custom"></span>
                                                                </label>
                                                            </div>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Followers')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Followers')?>" data-content="<?=l("Based on selected Activity Actions, you can follow users
								  	who follow <b>Usernames</b> added in your settings (Followers of Usernames),
								  	and/or like or comment on 1-3 most recent media posted by those users.<br/><br/>

								  	You can also target your own Followers (users who follow your account)
								  	by selecting <b>My Account</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_followers" class="form-control show-tick">
                                                                <option value="0"><?=l('Off')?></option>
<!--                                                                <option value="1" --><?//=($target_followers == 1)?"selected":""?><!-->--><?//=l('Usernames')?><!--</option>-->
                                                                <option value="1"
                                                                    <?php
                                                                        if($target_followers == 1){
                                                                            echo "selected";
                                                                        }else{
                                                                            if(!empty($usernames)){
                                                                                echo "selected";
                                                                            }else{
                                                                                echo "";
                                                                            }
                                                                        }
                                                                    ?>><?=l('Usernames')?></option>
                                                                <option value="2" <?=($target_followers == 2)?"selected":""?>><?=l('My Account')?></option>
                                                                <option value="3" <?=($target_followers == 3)?"selected":""?>><?=l('All')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Followings')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Followings')?>" data-content="<?=l("Based on selected Activity Actions, you can follow users
								  	followed by <b>Usernames</b> added in your settings (Followings of Usernames),
								  	and/or like or comment on 1-3 most recent media posted by those users.<br/><br/>

								  	You can also target your own Followings (users you follow)
								  	by selecting <b>My Feed</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.")?>">?</span> 
                                                        <span class="badge bg-none">
                                                            <select name="enable_followings" class="form-control show-tick">
                                                                <option value="0"><?=l('Off
																')?></option>
                                                                <option value="1" <?=($target_followings == 1)?"selected":""?>><?=l('Usernames')?></option>
                                                                <option value="2" <?=($target_followings == 2)?"selected":""?>><?=l('My Account')?></option>
                                                                <option value="3" <?=($target_followings == 3)?"selected":""?>><?=l('All')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Likers')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Likers')?>" data-content="<?=l("Based on selected Activity Actions, you can follow users
								  	who have liked the media posted by the <b>Usernames</b>
								  	added in your settings, and/or like or comment on 1-3 most
								  	recent media posted by those users.<br/><br/>

								  	You can also target your own Likers (users who have liked your media)
								  	by selecting <b>My posts</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_likers" class="form-control show-tick">
                                                                <option value="0"><?=l('Off')?></option> 
                                                                <option value="1" <?=($target_likers == 1)?"selected":""?>><?=l("Usernames Post's")?></option>
                                                                <option value="2" <?=($target_likers == 2)?"selected":""?>><?=l("My Post's")?></option>
                                                                <option value="3" <?=($target_likers == 3)?"selected":""?>><?=l('All')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Commenters')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Commenters')?>" data-content="<?=l("Based on selected Activity Actions, you can follow users
								  	who have commented on the media posted by <b>Usernames</b>
								  	added in your settings, and/or like or comment on 1-3 most
								  	recent media posted by those users.<br/><br/>

								  	You can also target your own Commenters (users who have commented on your media)
								  	by selecting <b>My posts</b> or <b>All</b>.<br/><br/>

								  	<span class='color-blue'>INFO:</span> This targeting source
								  	works independently of all other targeting sources that you
								  	can select.<br/><br/>

									<span class='color-warning'>IMPORTANT:</span> To use this source
									you may need to add at least 1 username in the <b>Usernames</b> list.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="enable_commenters" class="form-control show-tick">
                                                                <option value="0"><?=l('Off')?></option>
                                                                <option value="1" <?=($target_commenters == 1)?"selected":""?>><?=l("Usernames Post's")?></option>
                                                                <option value="2" <?=($target_commenters == 2)?"selected":""?>><?=l("My Post's")?></option>
                                                                <option value="3" <?=($target_commenters == 3)?"selected":""?>><?=l('All')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 

                            <div class="panel panel-settings mb20">
<!--                            <div class="panel panel-settings mb20 adjust-space">-->
                                <div class="panel-heading" role="tab" id="headingThree_20">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_20" aria-expanded="true" aria-controls="collapseThree_20">
<!--                                            <div class="general-icon general-icon-main"></div>-->
                                            <img src="<?=BASE?>assets/images/speedicon.svg" style="height: 30px;">
                                            <span style="margin-left: 10px !important;"><?=l('Speed')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_20" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_20" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Activity speed')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Activity speed')?>" data-content="<?=l("<b>Slow</b> — safe speed to do about
									480 likes,
									96 comments,
									360 follows,
									360 unfollows per day
									(the best speed for the beginning).<br/><br/>
									<b>Normal</b> — smart speed to do about
									600 likes,
									168 comments,
									480 follows,
									480 unfollows per day.<br/><br/>
									<b>Fast</b> — supreme speed to do about
									720 likes,
									240 comments,
									600 follows,
									600 unfollows per day.<br/><br/>
									Try to use <b>Slow</b> speed for the beginning and then change it
									to <b>Normal</b> or <b>Fast</b> after several days.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="speed" class="form-control show-tick activity_speed">
                                                                <option value="1" <?=($speed_default == 1)?"selected":""?>><?=l('Slow')?></option>
                                                                <option value="2" <?=($speed_default == 2)?"selected":""?>><?=l('Normal')?></option>
<!--                                                                <option value="3" --><?//=($speed_default == 3)?"selected":""?><!-->--><?//=l('Fast')?><!--</option>-->
                                                                <option value="3"
                                                                    <?php if($speed_default == 3 && $speed_like == 30 && $speed_comment == 10 && $speed_follow == 25 && $speed_unfollow == 25 && $delay == 2){
                                                                        echo "selected";
                                                                    }

                                                                    ?>><?=l('Fast')?></option>
                                                                <?php
                                                                $newlike = array(20, 25, 30);
                                                                $newcomment = array(4, 7, 10);
                                                                $newfollow = array(15, 20, 25);
                                                                $newunfollow = array(15, 20, 25);
                                                                $newdelay = array(6, 4, 2);
                                                                if(!in_array($speed_like,$newlike) || !in_array($speed_comment,$newcomment) || !in_array($speed_follow,$newfollow) || !in_array($speed_unfollow,$newunfollow) || !in_array($delay,$newdelay)){
                                                                ?>
                                                                    <option value="3" selected="" disabled=""><?=l('Custom')?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <div class="ribbon-container">
                                                            <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                                                        </div>
                                                        <?=l('Likes / hour')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Likes / hour')?>" data-content="<?=l("Number of Like actions that your activity will try to post
									in an hour.<br/><br/>
									Recommended value: <b>25</b><br/>
									Allowed values: <b>1</b>-<b>60</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_like" class="form-control show-tick repeat_like abcspeed">
                                                                <?php for($i = 1; $i <= 30; $i++){?>
                                                                    <option value="<?=$i?>" <?=(   $speed_like == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <div class="ribbon-container">
                                                            <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                                                        </div>
                                                        <?=l('Comments / hour')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Comments / hour')?>" data-content="<?=l("Number of Comment actions that your activity will try to post
									in an hour.<br/><br/>
									Recommended value: <b>7</b><br/>
									Allowed values: <b>1</b>-<b>20</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_comment" class="form-control show-tick repeat_comment abcspeed">
                                                                <?php for($i = 1; $i <= 30; $i++){?>
                                                                    <option value="<?=$i?>" <?=($speed_comment == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <div class="ribbon-container">
                                                            <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                                                        </div>
                                                        <?=l('Follows / hour')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Follows / hour')?>" data-content="<?=l("Number of Follow actions that your account will try to perform
									in an hour.<br/><br/>
									Recommended value: <b>20</b><br/>
									Allowed values: <b>1</b>-<b>50</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_follow" class="form-control show-tick repeat_follow abcspeed">
                                                                <?php for($i = 1; $i <= 30; $i++){?>
                                                                    <option value="<?=$i?>" <?=($speed_follow == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <div class="ribbon-container">
                                                            <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                                                        </div>
                                                        <?=l('Unfollows / hour')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Unfollows / hour')?>" data-content="<?=l("Number of Unfollow actions that your account will try to perform
									in an hour.<br/><br/>
									Recommended value: <b>20</b><br/>
									Allowed values: <b>1</b>-<b>50</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="repeat_unfollow" class="form-control show-tick repeat_unfollow abcspeed">
                                                                <?php for($i = 1; $i <= 30; $i++){?>
                                                                    <option value="<?=$i?>" <?=($speed_unfollow == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <div class="ribbon-container">
                                                            <span class="badge custom-ribbon ribbon-bg-beta">Beta</span>
                                                            <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                                                        </div>
                                                        <?=l('Delay range / minutes')?>

                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Delay range / minutes')?>" data-content="<?=l("This option controls delay interval between sequential actions.<br/><br/>
								  	The setting is in minutes, so however many minutes you set is what the delay will be for each action.</br></br>
								  	Recommended value: <b>6 minutes</b><br/>
									Allowed values: <b>2</b>-<b>10 minutes</b><br/><br/>
									<span class='color-danger'>Use with caution!</span>")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="delay" class="form-control show-tick repeat_delay abcspeed">
                                                                <?php for($i = 1; $i <= 30; $i++){?>
                                                                    <option value="<?=$i?>" <?=($delay == $i)?"selected":""?>><?=$i?></option>
                                                                <?php }?>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="panel panel-settings mb20 adjust-space">-->
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_filter">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_filter" aria-expanded="true" aria-controls="collapseThree_filter">
                                            <div class="general-icon general-icon-filters"></div>
                                            <span><?=l('Filters')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_filter" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_filter" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Media age')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Media age')?>" data-content="<?=l("This setting will help you choose the age of media you want to interact with. From the newest one to the oldest.<br/><br/> For example: select <b>1 Day</b> if you want to interact only with media that's not older than one day.<br/><br/>")?>">?</span> <!--- <b>Newest</b> media age was previously known as <b>New media only</b>--->
                                                        <span class="badge bg-none">
                                                            <select name="filter_media_age" class="form-control">
                                                                <option value="new" <?=($filter->media_age == "new")?"selected":""?>><?=l('Newest')?></option>
                                                                <option value="1h" <?=($filter->media_age == "1h")?"selected":""?>><?=l('1 Hour')?></option>
                                                                <option value="12h" <?=($filter->media_age == "12h")?"selected":""?>><?=l('12 Hours')?></option>
                                                                <option value="1d" <?=($filter->media_age == "1d")?"selected":""?>><?=l('1 Day')?></option>
                                                                <option value="3d" <?=($filter->media_age == "3d")?"selected":""?>><?=l('3 Days')?></option>
                                                                <option value="1w" <?=($filter->media_age == "1w")?"selected":""?>><?=l('1 Week')?></option>
                                                                <option value="2w" <?=($filter->media_age == "2w")?"selected":""?>><?=l('2 Weeks')?></option>
                                                                <option value="1M" <?=($filter->media_age == "1M")?"selected":""?>><?=l('1 Month')?></option>
<!--                                                                <option value="" --><?//=($filter->media_age == "")?"selected":""?><!--><?//=l('Any')?><!--</option>-->
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Media type')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Media type')?>" data-content="<?=l("This setting lets you interact only with specific media type: <b>Photos</b> or <b>Videos</b>. Also, you can choose <b>Any</b> to interact with any media type.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_media_type" class="form-control">
                                                                <option value="" <?=($filter->media_type == "")?"selected":""?>><?=l('Any')?></option>
                                                                <option value="image" <?=($filter->media_type == "image")?"selected":""?>><?=l('Photos')?></option>
                                                                <option value="video" <?=($filter->media_type == "video")?"selected":""?>><?=l('Videos')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Min. likes filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. likes filter')?>" data-content="<?=l("Interact only with media that have minimum set number of amount likes.<br/><br/> Use it along with <b>Max. likes filter</b> to set desired range of media popularity.<br/><br/> Recommended value: 0.<br/><br/> Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_likes" value="<?=($filter->min_likes != "")?$filter->min_likes:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Max. likes filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. likes filter')?>" data-content="<?=l("Interact only with media that have maximum set number of likes.<br/><br/>Use it along with <b>Min. likes filter</b> to set desired range of media popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_likes" value="<?=($filter->max_likes != "")?$filter->max_likes:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Min. comments filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. comments filter')?>" data-content="<?=l("Interact only with media that have minimum set number of comments.<br/><br/>Use it along with <b>Max. comments filter</b> to set desired range of media popularity.<br/><br/>Recommended value: 0.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_comments" value="<?=($filter->min_comments != "")?$filter->min_comments:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Max. comments filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. comments filter')?>" data-content="<?=l("Interact only with media that have maximum set number of comments.<br/><br/>Use it along with <b>Min. comments filter</b> to set desired range of media popularity.<br/><br/>Recommended values: 20-50.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_comments" value="<?=($filter->max_comments != "")?$filter->max_comments:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('User relation filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('User relation filter')?>" data-content="<?=l("This filter will help you exclude your own followers/followings from Liking, Commenting and Following activity:<br/><br/><b>Off</b> - Filter is turned off.<br/><br/><b>Followers</b> - You will not interact with your followers and their media.<br/><br/><b>Followings</b> - You will not interact with your followings and their media.<br/><br/><b>Both</b> - You will not interact with your followers and followings and their media.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_user_relation" class="form-control">
                                                                <option value="" <?=($filter->user_relation == "")?"selected":""?>><?=l('Off')?></option>
                                                                <option value="followers" <?=($filter->user_relation == "followers")?"selected":""?>><?=l('Followers')?></option>
                                                                <option value="followings" <?=($filter->user_relation == "followings")?"selected":""?>><?=l('Followings')?></option>
                                                                <option value="both" <?=($filter->user_relation == "both")?"selected":""?>><?=l('Both')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('User profile filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="<?=l("This filter will help you avoid inappropriate and unwanted users and their media during your activity:<br/><br/><b>Off</b> - Filter is turned off.<br/><br/><b>Low</b> - Excludes users who have no avatar or have no posted media.<br/><br/><b>Medium</b> - Excludes users who have no avatar, have less than 10 posted media or have no name in the profile.<br/><br/><b>High</b> - Excludes users who have no avatar, have less than 30 posted media, have no name in the profile or have no bio.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_user_profile" class="form-control">
                                                                <option value="" <?=($filter->user_profile == "")?"selected":""?>><?=l('Off')?></option>
                                                                <option value="low" <?=($filter->user_profile == "low")?"selected":""?>><?=l('Low')?></option>
                                                                <option value="medium" <?=($filter->user_profile == "medium")?"selected":""?>><?=l('Medium')?></option>
                                                                <option value="height" <?=($filter->user_profile == "height")?"selected":""?>><?=l('High')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Min. followers filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. followers filter')?>" data-content="<?=l("Interact only with users that have minimum set number of followers.<br/><br/>Use it along with <b>Max. followers filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 0-50.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_followers" value="<?=($filter->min_followers != "")?$filter->min_followers:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Max. followers filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. followers filter')?>" data-content="<?=l("Interact only with users that have maximum set number of followers.<br/><br/>Use it along with <b>Min. followers filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 500-1000.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_followers" value="<?=($filter->max_followers != "")?$filter->max_followers:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Min. followings filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. followings filter')?>" data-content="<?=l("Interact only with users that have minimum set number of followings.<br/><br/>Use it along with <b>Max. followings filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_min_followings" value="<?=($filter->max_followings != "")?$filter->min_followings:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <?=l('Max. followings filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. followings filter')?>" data-content="<?=l("Interact only with users that have maximum set number of followings.<br/><br/>Use it along with <b>Min. followings filter</b> to set desired range of users popularity.<br/><br/>Recommended values: 300-500.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <input type="text" class="form-control" name="filter_max_followings" value="<?=($filter->max_followings != "")?$filter->max_followings:"0"?>">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <div class="ribbon-container">
                                                            <span class="badge custom-ribbon ribbon-bg-beta">Beta</span>
                                                            <span class="badge custom-ribbon ribbon-bg-advanced">Advanced</span>
                                                        </div>
                                                        <?=l('Gender filter')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="<?=l("<b>Off</b> - Filter is turned off.<br/><br/><b>Female</b> - Interact only with users and their media whose gender has been determined as female.<br/><br/><b>Male</b> - Interact only with users and their media whose gender has been determined as male.<br/><br/><span class='col-blue'>INFO:</span> This filter analyzes full names of the user profiles and cannot guarantee 100% accuracy.<br/><br/><span class='col-orange'>WARNING:</span> This filter can slow down or completely stop your activity if the system will not be able to find accounts based on the selected option.")?>">?</span>
                                                        <span class="badge bg-none">
                                                            <select name="filter_gender" class="form-control pull-right">
                                                                <option value="" <?=($filter->gender == "")?"selected":""?>><?=l('Off')?></option>
                                                                <option value="f" <?=($filter->gender == "f")?"selected":""?>><?=l('Female')?></option>
                                                                <option value="m" <?=($filter->gender == "m")?"selected":""?>><?=l('Male')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="panel panel-settings mb20 adjust-space">-->
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_comment">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_comment" aria-expanded="false" aria-controls="collapseThree_comment">
                                            <div class="general-icon general-icon-comment"></div>
                                            <span><?=l('Comment')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>

                                <div id="collapseThree_comment" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_comment" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-comments">
                                            <label style="padding-right: 1.5em;">
                                                <?=l('Comments')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Comments')?>" data-content="<?=l("Add at least one comment
								  	if you have <b>Comments</b> turned on in Activity section.<br/><br/>

									For each post a new comment will be randomly selected from this list.
									IGplan will not comment on same media more than once.<br/><br/>

									We recommend using at least 10 different
									neutral comments like: Nice, Like it, Beautiful, etc.<br/><br/>

									<ul><li> The total length of the comment cannot exceed 300 characters.</li>
									<li>Enter variety of comments, so they are all different.</li></ul>

									You can add up to 100 comments.")?>">?</span>
                                            </label>
                                            <?php
                                            if(!empty($comments)){
                                                foreach ($comments as $key => $row) {?>
                                                    <div class="item" data-tag="<?=$row?>">
                                                        <?=$row?>
                                                        <input type="hidden" name="comments[]" value="<?=$row?>">
                                                        <div class="icon-remove btnRemoveTag">x</div>
                                                        <div class="icon-tag"></div>
                                                    </div>
                                                <?php }}?>
                                            <div class="btn-group m-b-20 actionAddComments" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddComments"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingOne_unfollow">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseOne_unfollow" aria-expanded="true" aria-controls="collapseOne_unfollow">
                                            <div class="general-icon general-icon-unfollow"></div>
                                            <span><?=l('Unfollow')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne_unfollow" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="row mb0">
                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <i  aria-hidden="true"></i> <?=l('Unfollow source')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Unfollow source')?>" data-content="<?=l("Which users to unfollow?<br/><br/> <b>IGplan</b> - select this option if you want to unfollow only users that were followed by our service. This option should be used in most cases, especially if you use Follow and Unfollow actions at the same time.<br/><br/> <b>All</b> - select this option if you want to unfollow all users that you follow.")?>">?
                                                        </span>

                                                        <span class="badge bg-none">
                                                            <select name="enable_unfollow_source" class="form-control show-tick">

<!--                                                                <option value="2" --><?//=(isset($unfollow_source)&&$unfollow_source == 2)?"selected":""?><!----><?//=l('Instatool')?><!--</option>-->
                                                                <option value="2" <?=(isset($unfollow_source)&&$unfollow_source == 2)?"selected":""?>><?=l('IGPlan')?></option>
                                                                <option value="1" <?=(isset($unfollow_source)&&$unfollow_source == 1)?"selected":""?>><?=l('All')?></option>

                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="list-group mb0">
                                                    <div class="list-group-item">
                                                        <i  aria-hidden="true"></i> <?=l('Timer')?>
                                                        <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Timer')?>" data-content="<?=l("This function will help you unfollow your activity automatically for specified period of time")?><?=l("For example, If you select 24 hours and Our service from Unfollow source, the system will unfollow people who you followed last 24 hours")?>">?
                                                        </span>

                                                        <span class="badge bg-none">
                                                            <select name="unfollow_follow_age" class="form-control">
<!--                                                                <option value="0" --><?//=(isset($unfollow_follow_age)&&$unfollow_follow_age == "0")?"selected":""?><!-->--><?//=l('Default')?><!--</option>-->
<!--                                                                <option value="43200" --><?//=(isset($unfollow_follow_age)&&$unfollow_follow_age == "43200")?"selected":""?><!-->--><?//=l('12 Hours')?><!--</option>-->
                                                                <option value="86400" <?=(isset($unfollow_follow_age)&&$unfollow_follow_age == "86400")?"selected":""?>><?=l('24 Hours')?></option>
                                                                <option value="172800" <?=(isset($unfollow_follow_age)&&$unfollow_follow_age == "172800")?"selected":""?>><?=l('48 Hours')?></option>
                                                                <option value="259200" <?=(isset($unfollow_follow_age)&&$unfollow_follow_age == "259200")?"selected":""?>><?=l('72 Hours')?></option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
											<!--
												<div class="col-md-4">
													<div class="list-group mb0">
														<div class="list-group-item" style="position: relative;z-index: 1;">
															<i  aria-hidden="true"></i> <?=l("Don't unfollow my followers")?>
															<span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l("Don't unfollow my followers")?>" data-content="<?=l("When turning on this box you will not unfollow users who follow you back.")?>">?
															</span>
															<span class="badge bg-none">
																<div>
																	<label>
																		<input type="checkbox" class="chk-custom" name="enable_unfollow_followers" <?=(isset($unfollow_followers)&&$unfollow_followers==1)?"checked":""?>>
																		<span class="chk-custom"></span>
																	</label>
																</div>
															</span>

														</div>
													</div>
												</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="panel panel-settings mb20 adjust-space">-->
                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_19">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
<!--                                            <div class="general-icon general-icon-tags"></div>-->
<!--                                            <span>--><?//=l('Hashtags')?><!--</span>-->
<!--                                            <i class="fa fa-hashtag" style="font-size: 30px;"></i>-->
                                            <img src="<?=BASE?>assets/images/hashicon.svg" style="height: 30px;">
                                            <span style="margin-left: 10px !important;"><?=l('Hashtags')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-tags">
                                            <label style="padding-right: 1.5em;">
                                                <?=l('Hashtags')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Hashtags')?>" data-content="<?=l("Add at least one tag to get media from,
								  	if you are using <b>Hashtags</b> as your Media source.<br/><br/>

								  	You can search tags or you can add multiple tags by clicking Add Multi Hashtags link.<br/><br/>

								  	You can add up to 1000 tags.")?>">?</span>

                                            </label>
                                            <?php
                                            if(!empty($tags)){
                                            foreach ($tags as $key => $row) {?>
                                                <div class="item" data-tag="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="tags[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}?>
                                            <div class="btn-group m-b-20 actionAddTags" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddTags" data-id="<?=$this->input->get('id')?>"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_11">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_11" aria-expanded="false" aria-controls="collapseThree_11">
                                            <div class="general-icon general-icon-locations"></div>
                                            <span><?=l('Locations')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_11" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-locations">
                                            <label style="padding-right: 1.5em;">
                                                <?=l('Locations')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Locations')?>" data-content="<?=l("Add at least one location to get media from,
									if you are using <b>Locations</b> as your Media source.<br/><br/>

									You can like and comment on media posted in that location
									or follow people who post media in that location. Please
									note that sharing your geolocation must be enabled in
									your browser to use this feature.<br/><br/>

									You can add up to 100 locations.")?>">?</span>
                                            </label>
                                            <?php
                                            if(!empty($locations)){
                                            foreach ($locations as $key => $row) {
                                                $array_row = explode("|", $row);
                                                if(count($array_row) == 4){
                                            ?>
                                                <div class="item" data-location="<?=$row?>">
                                                    <a href="https://www.instagram.com/explore/locations/<?=$array_row[3]?>" target="_blank"><?=$array_row[0]?></a>
                                                    <input type="hidden" name="locations[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}}?>
                                            <div class="btn-group m-b-20 actionAddLocations" role="group">
<!--                                                <button type="button" class="tags-btn btn-plain btnOpenAddLocations">--><?//=l('Add')?><!--</button>-->
                                                <button type="button" class="tags-btn btn-plain btnOpenLocations"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all locations')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_33">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat" role="button" data-toggle="collapse" href="#collapseThree_33" aria-expanded="false" aria-controls="collapseThree_33">
                                            <div class="general-icon general-icon-usernames"></div>
                                            <span><?=l('Usernames')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_33" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_33" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-usernames">
                                            <label style="padding-right: 1.5em;">
                                                <?=l('Usernames')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Usernames')?>" data-content="<?=l("
									Add at least one username
									if you are using <b>Followers/Followings of usernames</b>
									as your Media or Follow source.<br/><br/>

									IGplan will use followers or followings of those usernames
									to follow them and/or choose up to 5 recently posted media from
									each account for automatic likes and comments.<br/><br/>

									You can add up to 100 usernames.
								  ")?>">?</span>
                                            </label>
                                            <?php
                                            if(!empty($usernames)){
                                            foreach ($usernames as $key => $row) {
                                                $array_row = explode("|", $row);
                                                if(count($array_row) == 2){
                                            ?>
                                                <div class="item" data-tag="<?=$array_row[1]?>">
                                                    <a href="https://www.instagram.com/<?=$array_row[1]?>" target="_blank"><?=$array_row[1]?></a>
                                                    <input type="hidden" name="usernames[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}}?>
                                            <div class="btn-group m-b-20 actionAddUsernames" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddUsernames"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all usernames')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_message">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat custom-icon-manage" role="button" data-toggle="collapse" href="#collapseThree_message" aria-expanded="true" aria-controls="collapseThree_message">
                                            <i class="fa fa-envelope-o font-32 m-r--35" aria-hidden="true"></i>
<!--                                            <div class="general-icon general-icon-blacklists"></div>-->
                                            <span><?=l('Message DM')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree_message" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_message" aria-expanded="true">
                                    <div class="panel-body row mb0">
                                        <div class="vttags list-messages">
                                            <label style="padding-right: 1.5em;">
                                                <?=l('Message')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Welcome DM')?>" data-content="<?=l("Please have at least one of the following settings enabled for your Welcome DM to work properly: Likes, Comments or Follows.")?>">?</span>
                                            </label>
                                            <?php
                                            if(!empty($messages)){
                                            foreach ($messages as $key => $row) {?>
                                                <div class="item" data-tag="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="messages[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                            <?php }}?>
                                            <div class="btn-group m-b-20 actionAddMessages" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddMessages"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-settings mb20">
                                <div class="panel-heading" role="tab" id="headingThree_blacklists">
                                    <h4 class="panel-title">
                                        <a class="activity-settings-cat collapsed"  role="button" data-toggle="collapse" href="#collapseThree_blacklists" aria-expanded="false" aria-controls="collapseThree_blacklists">
                                            <div class="general-icon general-icon-blacklists"></div>
                                            <span><?=l('Blacklists')?></span>
                                            <i class="fa fa-plus pull-right font-color-grey" aria-hidden="true"></i>
                                            <i class="fa fa-minus pull-right font-color-grey" aria-hidden="true"></i>
                                        </a>
                                    </h4>
                                </div>
<!--                                <div id="collapseThree_blacklists" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_blacklists" aria-expanded="true">-->
                                <div id="collapseThree_blacklists" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree_blacklists" aria-expanded="false" style="height: 0px;">
                                    <!-- tags -->
                                    <div class="panel-body row mb0">
                                        <div class="vttags blacklist-tags">
                                            <label style="padding-right: 1.5em;">
                                                <?=l('Hashtags blacklist')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Hashtags blacklist')?>" data-content="<?=l("Add some tags to this list if you want to skip liking and/or commenting on media containing those tags in bio or caption.<br/><br/> You can add up to 3000 tags in this list.")?>">?</span>
                                            </label>
                                            <span class="tags-row">
                                                <?php
                                                if(!empty($blacklist_tags)){

                                                foreach ($blacklist_tags as $key => $row) {?>
                                                <div class="item" data-blacklist_tags="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="blacklist_tags[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                </div>
                                                <?php }}?>
                                            </span>

                                            <div class="btn-group m-b-20 actionAddBlacklistTags" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddBlacklistTags"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- usernames -->
                                    <div class="panel-body row mb0">
                                        <div class="vttags blacklist-usernames">
                                            <label style="padding-right: 1.5em;">
                                                <i  aria-hidden="true"></i> <?=l('Usernames blacklist')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Usernames blacklist')?>" data-content="<?=l("Add some usernames to this list if you want to skip following followers of these profiles, and liking and/or commenting on media from these profiles.<br/><br/> You can add up to 3000 usernames in this list.")?>">?</span>
                                            </label>
                                                <?php
                                                if(!empty($blacklist_usernames)){
                                                foreach ($blacklist_usernames as $key => $row) {?>
                                                <div class="item" data-blacklist_usernames="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="blacklist_usernames[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                                <?php }}?>

                                            <div class="btn-group m-b-20 actionAddBlacklistUsernames" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddBlacklistUsernames"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- keyword -->
                                    <div class="panel-body row mb0">
                                        <div class="vttags blacklist-keywords">
                                            <label style="padding-right: 1.5em;">
                                                <i  aria-hidden="true"></i> <?=l('Keywords blacklist')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Keywords blacklist')?>" data-content="<?=l("Add some keywords to this list that you don't want to interact with. This filter will search for stop keywords in media (tags and caption) and in user (username, full name, bio and website).<br/><br/>&quot;For example&quot; add playboy keyword to exclude all content that contains any words that start with playboy.<br/><br/>You can add up to 3000 keywords in this list.")?>">?</span>
                                            </label>
                                                <?php
                                                if(!empty($blacklist_keywords)){
                                                foreach ($blacklist_keywords as $key => $row) {?>
                                                <div class="item" data-blacklist_keywords="<?=$row?>">
                                                    <?=$row?>
                                                    <input type="hidden" name="blacklist_keywords[]" value="<?=$row?>">
                                                    <div class="icon-remove btnRemoveTag">x</div>
                                                    <div class="icon-tag"></div>
                                                </div>
                                                <?php }}?>

                                            <div class="btn-group m-b-20 actionAddBlacklistKeywords" role="group">
                                                <button type="button" class="tags-btn btn-plain btnOpenAddBlacklistKeywords"><?=l('Add')?></button>
                                                <button type="button" class="tags-btn btn-plain waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript">
    /*$(function(){
        hash = window.location.hash;
        if(hash != undefined && hash == "#openvideo"){
            $( "#modal-how-to-use" ).modal('show').find(".modal-body").html('<iframe width="100%" height="315" src="https://player.vimeo.com/video/213740386?rel=0&autoplay=1&showinfo=0&controls=0" frameborder="0" allowfullscreen style="display: block;"></iframe>');
        }


        $(".btnCloseModelHowToUse,.close").click(function(){
            $('#modal-how-to-use').modal('toggle');
            $('iframe').remove();
            window.location.hash = "";
        });

    });*/

    $(document).ready(function(){
        $('.quickguide').click(function(){
//            alert(123);
            $("#getstartguide").modal('show');
        });
    });
</script>

<!--<div class="modal fade" id="getstartguide" role="dialog">-->
<!--    <div class="modal-dialog modal-lg">-->
<!---->
        <!-- Modal content-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header" style="border-bottom:0px;">-->
<!--                <button type="button" id="quickclose" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h2 style="text-transform: none;">How to Start?</h2>-->
<!--            </div>-->
<!--            <div class="popup_contant">-->
<!---->
<!--                <p>If you want to get a lot of new likes, comments, and followers, you should-->
<!--                    be doing the same for others. We help you to be more active!</p>-->
<!--                <div class="col-sm-6">-->
<!--                    <p><strong>1.</strong> Select what do you want to do: like, comment, follow or unfollow. To do-->
<!--                        this, press on the button next to each action, so its color changes to blue.</p>-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <img class="pull-right" style="padding-bottom:30px;width: 100%;" src="--><?//=BASE?><!--assets/images/option.svg" >-->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    <img style="width:100%;" src="--><?//=BASE?><!--assets/images/select.png">-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <p><strong>2.</strong> Our settings will help you to control your activity depends on your-->
<!--                        needs.</p>-->
<!--                </div>-->
<!--                <div class="col-sm-12">-->
<!--                    <p class="paragraf_bg">You may hover your mouse over the question mark next-->
<!--                        to each setting to learn more about it: <img style="height: 22px;" src="--><?//=BASE?><!--assets/images/question.png"></p>-->
<!--                </div>-->
<!---->
<!--                <div class="col-sm-6">-->
<!--                    <p><strong>3.</strong> We have already added some hashtags and comments for easy start. Just-->
<!--                        push the blue button! Find more information about all our settings in our Guide!</p>-->
<!--                </div>-->
<!--                <div class="col-sm-6">-->
<!--                    <img style="padding-top:30px; width:100%;" class="pull-right" src="--><?//=BASE?><!--assets/images/btn.png">-->
<!--                </div>-->
<!---->
<!--                <p class="bottom_p">Find more information about all our settings in our <a href="#">Guide</a>!</p>-->
<!--<!--                <a href="#" class="bottom_btn">Let's go</a>-->
<!--                <button type="button" class="btn bottom_btn waves-effect"  style="text-transform: none !important;" data-dismiss="modal">--><?//=l("Let's go")?><!--</button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<script>
    $('#quickclose').click(function(){
//            alert(123);
        $("#getstartguide").modal('hide');
    });

    $('.abcspeed').change(function(){
//            alert(123);
        if($("select[name=speed] option").length <= 3){
            var opt = '<option value="3" disabled="" selected="">Custom</option>';
            $(":input[name='speed']").append(opt);
        }
//       var opt = '<option value="3" disabled="" selected="">Custom</option>';
//        $(":input[name='speed']").append(opt);
    });

    $('.btnOpenLocations').click(function(){
//            alert(123);
        $("#PopupAddLocations").modal('show');
    });

</script>

<div class="modal fade" id="PopupAddLocations" tabindex="-1" role="dialog" style="background-color: #0009;">
    <div class="modal-dialog" role="document">
        <form class="location">
            <div class="modal-content">
                <div class="modal-header new-grey">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="defaultModalLabel"><?=l('Add Locations')?></h4>
                </div>
                <div class="modal-body pt0">
                    <p style="font-size: 14px;color: #000;margin: 20px 0px;">
                        Find locations by name, address, city, state or country and get the most popular places nearby. Or just click on the map to start exploring locations on the current map position.
                    </p>

                    <div class="input-group mb15 formSearchPopup">
                        <span class="input-group-btn" style="display: none;">
                          <select name="account" class="form-control account" style="min-width: 120px;">
                              <?php if(!empty($result)){
                                  foreach ($result as $key => $row) { ?>
                                      <option value="<?=$row->account_id?>" selected></option>
                                  <?php }}?>
                          </select>
                        </span>
                        <div class="form-line newinput">
                            <input type="text" id="pac-input" name="popup_location" class="form-control popup_location" placeholder="<?=l('Enter location name')?>">
                        </div>
                        <span class="input-group-btn">
                          <a class="btn bg-dashboard-primary waves-effect btnSearchLocations newbutton"><?=l('Search')?></a>
                        </span>
                    </div>
                    <div class="row">
                        <!--                        <div class="col-md-12 newloc" style="display: none;">-->
                        <div class="col-md-12 newloc">
                            <div id="map_canvas" class="map_canvas" style="width: 100%; height: 250px;"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input name="formatted_address" type="hidden" value="">
                            <input name="lat" type="hidden" value="">
                            <input name="lng" type="hidden" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ajax_dataSearchLocation">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn new-blue waves-effect btnAddLocations" style="display: none;text-transform: none !important;"><?=l('Add Locations')?></button>
                    <button type="button" class="btn bg-grey waves-effect closebtn" data-dismiss="modal" style="text-transform: none !important;"><?=l('Close')?></button>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="modal fade" id="getstartguide" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header new-grey">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                            <a href="javascript:void(0);" class="slider_go close" data-dismiss="modal">Let's Go</a>
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



<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function() { getdetails(); }, 5000);

        $('#myCarousel').carousel({
            interval: false
        });

    });

    function getdetails(){

            var action   = '<?= PATH.'search/getactivity'; ?>';
            var type     = $('#newid').text();

            $.post(action, {id: type}, function(result){
                if(result.st == 'success'){
                    //self.showNotification(result.label, result.txt, 'bottom', 'center', 'animated bounceIn', 'animated bounceOut');
                    $('#like_count').empty().text(result.like);
                    $('#comment_count').empty().text(result.comment);
                    $('#follow_count').empty().text(result.follow);
                    $('#unfollow_count').empty().text(result.unfollow);

                }
            },'json');
        }


    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-anchor').offset().top;
        if (window_top > div_top) {
            $('#UpdateAlert').addClass('stick');
        } else {
            $('#UpdateAlert').removeClass('stick');
        }
    }

    $(function() {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });

</script>

<?php if(($act_status == 1) &&($emdata == '')){ ?>
    <script>
        $(document).ready(function(){
//            $('#getstartguide').modal('show');
            $('#modal-add-email').modal('show');
        });
    </script>
<?php } ?>
<?php
$schedule_default   = json_decode($result->schedule_default);
$targets            = json_decode($schedule_default->target);
$tags               = json_decode($schedule_default->tags);
$todo               = json_decode($schedule_default->todo);
$locations          = json_decode($schedule_default->locations);
$comments           = json_decode($schedule_default->comments);
$messages           = json_decode($schedule_default->messages);
$slow               = json_decode($schedule_default->slow);
$medium             = json_decode($schedule_default->medium);
$fast               = json_decode($schedule_default->fast);
$filter             = json_decode($schedule_default->filter);

//====blacklist
$blacklists             = json_decode($result->blacklists_default);
$blacklist_tags         = json_decode($blacklists->bl_tags);
$blacklist_usernames    = json_decode($blacklists->bl_usernames);
$blacklist_keywords     = json_decode($blacklists->bl_keywords);

//Proxy Default
$proxy_default              = json_decode($result->proxy_default);
$proxy_default_igaccount    = json_decode($proxy_default->proxy_default_igaccount);

?>

<form action="<?=cn()?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        <i class="fa fa-cogs" aria-hidden="true"></i> <?=l('Settings')?>
                    </h2>
                </div>
                <div class="body pt0">
                    <div class="row">
                        <div class="col-sm-12 mb0">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">home</i> <?=l('GENARAL')?>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">assignment</i> <?=l('SCHEDULE DEFAULT')?>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#post_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">send</i> <?=l('POST DEFAULT')?>
                                    </a>
                                </li>                                
                                <li role="presentation">
                                    <a href="#post_with_icon_title1" data-toggle="tab">
                                        <i class="material-icons">sync</i> <?=l('PROXY SETTING')?>
                                    </a>
                                </li>
                                <!-- li role="presentation">
                                    <a href="#messages_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">share</i> < ?=l('LOGIN SOCIAL')?>
                                    </a>
                                </li -->
                                <li role="presentation">
                                    <a href="#messages_with_icon_title2" data-toggle="tab">
                                        <i class="material-icons">loyalty</i> <?=l('LINK SOCIAL PAGE')?>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#home_with_icon_title3" data-toggle="tab">
                                        <i class="material-icons">email</i> <?=l('MAIL SETTINGS')?>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#affiliate_settings" data-toggle="tab">
                                        <i class="material-icons">attach_money</i> <?=l('AFFILIATE')?>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">
                                    <b><?=l('Website name')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" class="form-control" name="token" id="token" value="<?=$this->security->get_csrf_hash();?>">
                                            <input type="text" class="form-control" name="website_title" value="<?=!empty($result)?$result->website_title:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('Website description')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="website_description" value="<?=!empty($result)?$result->website_description:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('Website keywords')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="website_keyword" value="<?=!empty($result)?$result->website_keyword:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('Website logo')?></b>
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="file" value="<?=!empty($result)?$result->logo:""?>">
                                    </div>
                                    <b><?=l('Google map API key')?></b>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="google_api_key" value="<?=!empty($result)?$result->google_api_key:""?>">
                                    </div>
                                    <b><?=l('Theme color')?></b>
                                    <div class="form-group">
                                        <select name="theme_color" class="form-control">
                                        <?php foreach(theme_color() as $key => $color) { ?>
                                            <option value="<?=$key?>" <?=(!empty($result) && $result->theme_color == $key)?"selected":""?>>
                                                <?=$color?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <b><?=l('Timezone server')?></b>
                                    <div class="form-group">
                                        <select name="timezone" class="form-control">
                                        <?php foreach(tz_list() as $t) { ?>
                                            <option value="<?=$t['zone'] ?>" <?=(!empty($result) && $result->timezone == $t['zone'])?"selected":""?>>
                                                <?=$t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <b><?=l('Default language')?></b>
                                    <div class="form-group">
                                        <select class="form-control" name="default_language">
                                            <?php if(!empty($lang))
                                            foreach ($lang as $row) {
                                            ?>
                                            <option value="<?=$row?>" <?=(!empty($result) && $result->default_language == $row)?"selected":""?>><?=strtoupper($row)?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <b><?=l('Add new language')?></b>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="language" id="language">
                                            <span class="input-group-btn">
                                              <a href="<?=BASE?>lang/en.xml" target="_blank" class="btn bg-red waves-effect"><i class="fa fa-info-circle"></i> <?=l('View demo')?></a>
                                            </span>
                                        </div>
                                    </div>
                                    <b><?=l('Register user')?></b>
                                    <div class="form-group demo-radio-button">
                                        <input name="register" type="radio" id="register_yes" class="radio-col-red" <?=(!empty($result) && $result->register == 1)?"checked=''":""?> value="1">
                                        <label for="register_yes"><?=l('Yes')?></label>

                                        <input name="register" type="radio" id="register_no" class="radio-col-red" <?=(!empty($result) && $result->register == 0)?"checked=''":""?> value="0">
                                        <label for="register_no"><?=l('No')?></label>
                                    </div>
                                    <b><?=l('Auto active user')?></b>
                                    <div class="form-group demo-radio-button">
                                        <input name="auto_active_user" type="radio" id="auto_active_user_yes" class="radio-col-red" <?=(!empty($result) && $result->auto_active_user == 1)?"checked=''":""?> value="1">
                                        <label for="auto_active_user_yes"><?=l('Yes')?></label>

                                        <input name="auto_active_user" type="radio" id="auto_active_user_no" class="radio-col-red" <?=(!empty($result) && $result->auto_active_user == 0)?"checked=''":""?> value="0">
                                        <label for="auto_active_user_no"><?=l('No')?></label>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <div class="row">
                                        <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                                            <div class="panel-group full-body" id="accordion_22" role="tablist" aria-multiselectable="true">
                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingOne_todo">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" href="#collapseOne_todo" aria-expanded="true" aria-controls="collapseOne_todo" class="collapsed">
                                                                <i class="fa fa-tasks col-light-green" aria-hidden="true"></i> <?=l('To do')?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseOne_todo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_todo" aria-expanded="true">
                                                        <div class="panel-body row mb0">
                                                            <div class="row mb0">
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Like')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_like" <?=($todo->like==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Comment')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_comment" <?=($todo->comment==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follow')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_follow" <?=($todo->follow==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Like + Follow')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_like_follow" <?=($todo->like_follow==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Unfollow')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_unfollow" <?=($todo->unfollow==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follow back')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_followback" <?=($todo->followback==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Repost media')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="todo_repost" class="form-control show-tick">
                                                                                    <option><?=l('-')?></option>
                                                                                    <option value="1" <?=($todo->repost == 1)?"selected":""?>><?=l('Hashtags')?></option>
                                                                                    <option value="2" <?=($todo->repost == 2)?"selected":""?>><?=l('Locations')?></option>
                                                                                    <option value="3" <?=($todo->repost == 3)?"selected":""?>><?=l('Usernames')?></option>
                                                                                    <option value="4" <?=($todo->repost == 4)?"selected":""?>><?=l('All')?></option>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delete media')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="todo_deletemedia" <?=($todo->deletemedia==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingOne_19">
                                                        <h4 class="panel-title">
                                                            <a role="button" data-toggle="collapse" href="#collapseOne_19" aria-expanded="true" aria-controls="collapseOne_19" class="collapsed">
                                                                <i class="fa fa-dot-circle-o col-red" aria-hidden="true"></i> <?=l('Targeting')?>
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
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="enable_tag" <?=($targets->tag==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Location')?>
                                                                            <span class="badge bg-none">
                                                                                <div class="switch">
                                                                                    <label><input type="checkbox" name="enable_location" <?=($targets->location==1)?"checked":""?>><span class="lever switch-col-light-green"></span></label>
                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Followers')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="enable_followers" class="form-control show-tick">
                                                                                    <option><?=l('-')?></option>
                                                                                    <option value="1" <?=($targets->followers == 1)?"selected":""?>><?=l('Usernames')?></option>
                                                                                    <option value="2" <?=($targets->followers == 2)?"selected":""?>><?=l('My Account')?></option>
                                                                                    <option value="3" <?=($targets->followers == 3)?"selected":""?>><?=l('All')?></option>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Followings')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="enable_followings" class="form-control show-tick">
                                                                                    <option><?=l('-')?></option>
                                                                                    <option value="1" <?=($targets->followings == 1)?"selected":""?>><?=l('Usernames')?></option>
                                                                                    <option value="2" <?=($targets->followings == 2)?"selected":""?>><?=l('My Account')?></option>
                                                                                    <option value="3" <?=($targets->followings == 3)?"selected":""?>><?=l('All')?></option>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Likers')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="enable_likers" class="form-control show-tick">
                                                                                    <option><?=l('-')?></option>
                                                                                    <option value="1" <?=($targets->likers == 1)?"selected":""?>><?=l('Usernames Post')?></option>
                                                                                    <option value="2" <?=($targets->likers == 2)?"selected":""?>><?=l('My Post')?></option>
                                                                                    <option value="3" <?=($targets->likers == 3)?"selected":""?>><?=l('All')?></option>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Commenters')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="enable_commenters" class="form-control show-tick">
                                                                                    <option><?=l('-')?></option>
                                                                                    <option value="1" <?=($targets->commenters == 1)?"selected":""?>><?=l('Usernames Post')?></option>
                                                                                    <option value="2" <?=($targets->commenters == 2)?"selected":""?>><?=l('My Post')?></option>
                                                                                    <option value="3" <?=($targets->commenters == 3)?"selected":""?>><?=l('All')?></option>
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
                                                    <div class="panel-heading" role="tab" id="headingThree_20">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_20" aria-expanded="false" aria-controls="collapseThree_20">
                                                                <i class="fa fa-tachometer col-blue" aria-hidden="true"></i> <?=l('Speed')?>
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
                                                                            <span class="badge bg-none">
                                                                                <select name="speed" class="form-control show-tick">
                                                                                    <option value="1" <?=($schedule_default->speed == 1)?"selected":""?>><?=l('Slow')?></option>
                                                                                    <option value="2" <?=($schedule_default->speed == 2)?"selected":""?>><?=l('Medium')?></option>
                                                                                    <option value="3" <?=($schedule_default->speed == 3)?"selected":""?>><?=l('Fast')?></option>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="lead">
                                                                <?=l('Slow')?>
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Reposts / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_repost" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->repost== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Likes / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_like" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->like== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Comments / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_comment" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->comment== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delete media / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_deletemedia" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->deletemedia == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_follow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->follow== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Like + Follows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_like_follow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->like_follow== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follows back / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_followback" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->followback== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Unfollows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_unfollow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->unfollow== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delay on each account (minutes)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="slow_delay" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($slow->delay == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="lead">
                                                                <?=l('Medium')?>
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Reposts / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_repost" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->repost == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Likes / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_like" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->like == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Comments / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_comment" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->comment == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delete media / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_deletemedia" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->deletemedia == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_follow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->follow == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Like + Follows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_like_follow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->like_follow== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follows back / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_followback" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->followback == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Unfollows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_unfollow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->unfollow == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delay on each account (minutes)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="medium_delay" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($medium->delay == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <p class="lead">
                                                                <?=l('Fast')?>
                                                            </p>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Reposts / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_repost" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->repost == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Likes / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_like" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->like == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Comments / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_comment" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->comment == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delete media / hour (post)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_deletemedia" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->deletemedia == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_follow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->follow == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Like + Follows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_like_follow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->like_follow== $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Follows back / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_followback" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->followback == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Unfollows / hour (user)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_unfollow" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->unfollow == $i)?"selected":""?>><?=$i?></option>
                                                                                    <?php }?>
                                                                                </select>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Delay on each account (minutes)')?>
                                                                            <span class="badge bg-none">
                                                                                <select name="fast_delay" class="form-control show-tick">
                                                                                    <?php for($i = 1; $i <= 60; $i++){?>
                                                                                        <option value="<?=$i?>" <?=($fast->delay == $i)?"selected":""?>><?=$i?></option>
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

                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingThree_filter">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_filter" aria-expanded="false" aria-controls="collapseThree_filter">
                                                                <i class="fa fa-filter" aria-hidden="true"></i> <?=l('Filters')?>
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
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Media age')?>" data-content="<?=l("This setting will help you to choose an age of media you want to interact with. From the newest one to the oldest.<br/><br/> For example: select <b>1 Day</b> if you want to interact only with media that not older than one day.<br/><br/><b>Newest</b> media age was previously known as <b>New media only</b>.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <select name="filter_media_age" class="form-control">
                                                                                    <option value="new" <?=($filter->media_age == "new")?"selected":""?>><?=l('Newest')?></option>
                                                                                    <option value="1h" <?=($filter->media_age == "1h")?"selected":""?>><?=l('1 Hour')?></option>
                                                                                    <option value="12h" <?=($filter->media_age == "12h")?"selected":""?>><?=l('12 Hours')?></option>
                                                                                    <option value="1d" <?=($filter->media_age == "1d")?"selected":""?>><?=l('1 Day')?></option>
                                                                                    <option value="3d" <?=($filter->media_age == "3d")?"selected":""?>><?=l('3 Danys')?></option>
                                                                                    <option value="1w" <?=($filter->media_age == "1w")?"selected":""?>><?=l('1 Week')?></option>
                                                                                    <option value="2w" <?=($filter->media_age == "2w")?"selected":""?>><?=l('2 Weeks')?></option>
                                                                                    <option value="1M" <?=($filter->media_age == "1M")?"selected":""?>><?=l('1 Month')?></option>
                                                                                    <option value="" <?=($filter->media_age == "")?"selected":""?>><?=l('Any')?></option>
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
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. likes filter')?>" data-content="<?=l("Interact only with media that have minimum selected amount of likes.<br/><br/> Use it along with <b>Max. likes filter</b> to set desired range of media popularity.<br/><br/> Recommended value: 0.<br/><br/> Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_min_likes" value="<?=$filter->min_likes?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Max. likes filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. likes filter')?>" data-content="<?=l("Interact only with media that have maximum selected amount of likes.<br/><br/>Use it along with <b>Min. likes filter</b> to set desired rangeof media popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_max_likes" value="<?=$filter->max_likes?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Min. comments filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. comments filter')?>" data-content="<?=l("Interact only with media that have minimum selected amount of comments.<br/><br/>Use it along with <b>Max. comments filter</b> to set desired rangeof media popularity.<br/><br/>Recommended value: 0.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_min_comments" value="<?=$filter->min_comments?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Max. comments filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. comments filter')?>" data-content="<?=l("Interact only with media that have maximum selected amount of comments.<br/><br/>Use it along with <b>Min. comments filter</b> to set desired rangeof media popularity.<br/><br/>Recommended values: 20-50.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_max_comments" value="<?=$filter->max_comments?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('User relation filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('User relation filter')?>" data-content="<?=l("This filter will help you to exclude your own followers/followings from Liking, Commenting and Following activity:<br/><br/><b>Off</b> - Filter is turned off.<br/><br/><b>Followers</b> - You will not interact with your followers and their media.<br/><br/><b>Followings</b> - You will not interact with your followings and their media.<br/><br/><b>Both</b> - You will not interact with your followers and followings and their media.")?>">?</span>
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
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="<?=l("This filter will help you to avoid inappropriate and unwanted users and their media during your activity:<br/><br/><b>Off</b> - Filter is turned off.<br/><br/><b>Low</b> - Excludes users who have no avatar or have no posted media.<br/><br/><b>Medium</b> - Excludes users who have no avatar, have less than 10 postedmedia or have no name in the profile.<br/><br/><b>High</b> - Excludes users who have no avatar, have less than 30 postedmedia, have no name in the profile or have no bio.")?>">?</span>
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
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. followers filter')?>" data-content="<?=l("Interact only with users that have minimum selected amount of followers.<br/><br/>Use it along with <b>Max. followers filter</b> to set desired rangeof users popularity.<br/><br/>Recommended values: 0-50.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_min_followers" value="<?=$filter->min_followers?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Max. followers filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. followers filter')?>" data-content="<?=l("Interact only with users that have maximum selected amount of followers.<br/><br/>Use it along with <b>Min. followers filter</b> to set desired rangeof users popularity.<br/><br/>Recommended values: 500-1000.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_max_followers" value="<?=$filter->max_followers?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Min. followings filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Min. followings filter')?>" data-content="<?=l("Interact only with users that have minimum selected amount of followings.<br/><br/>Use it along with <b>Max. followings filter</b> to set desired rangeof users popularity.<br/><br/>Recommended values: 50-100.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_min_followings" value="<?=$filter->min_followings?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Max. followings filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Max. followings filter')?>" data-content="<?=l("Interact only with users that have maximum selected amount of followings.<br/><br/>Use it along with <b>Min. followings filter</b> to set desired rangeof users popularity.<br/><br/>Recommended values: 300-500.<br/><br/>Set to zero to disable this filter.")?>">?</span>
                                                                            <span class="badge bg-none">
                                                                                <input type="text" class="form-control" name="filter_max_followings" value="<?=$filter->max_followings?>">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 hidden">
                                                                    <div class="list-group mb0">
                                                                        <div class="list-group-item">
                                                                            <?=l('Gender filter')?>
                                                                            <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="Media age" data-content="<?=l("<b>Off</b> - Filter is turned off.<br/><br/><b>Female</b> - Interact only with users and their mediawhose gender has been determined as female.<br/><br/><b>Male</b> - Interact only with users and their mediawhose gender has been determined as male.<br/><br/><span class='col-blue'>INFO:</span> This filter analyzes fullnames of the user profiles and cannot guarantee 100% accuracy.<br/><br/><span class='col-orange'>WARNING:</span> This filter can slow downor completely stop your activity if the system will not be ableto find accounts based on the selected option.")?>">?</span>
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

                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingThree_15">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_15" aria-expanded="false" aria-controls="collapseThree_15">
                                                                <i class="fa fa-comments col-purple" aria-hidden="true"></i> <?=l('Comments')?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree_15" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_15" aria-expanded="true">
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags list-comments">
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
                                                                <div class="btn-group actionAddComments" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddComments"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all hashtags')?></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingThree_19">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_19" aria-expanded="false" aria-controls="collapseThree_19">
                                                                <i class="fa fa-hashtag col-blue-grey" aria-hidden="true"></i> <?=l('Hashtags')?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree_19" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_19" aria-expanded="true">
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags list-tags">
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
                                                                <div class="btn-group actionAddTags" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddTags"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all hashtags')?></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingThree_11">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_11" aria-expanded="false" aria-controls="collapseThree_11">
                                                                <i class="fa fa-map-marker col-red" aria-hidden="true"></i> <?=l('Locations')?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree_11" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_11" aria-expanded="true">
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags list-locations">
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
                                                                <div class="btn-group actionAddLocations" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddLocations"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all locations')?></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingThree_16">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" href="#collapseThree_16" aria-expanded="false" aria-controls="collapseThree_16">
                                                                <i class="fa fa-commenting col-orange" aria-hidden="true"></i> <?=l('Message')?>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree_16" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_16" aria-expanded="true">
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags list-messages">
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
                                                                <div class="btn-group actionAddMessages" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddMessages"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><?=l('Delete all hashtags')?></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="panel panel-settings mb20">
                                                    <div class="panel-heading" role="tab" id="headingThree_blacklists">
                                                        <h4 class="panel-title">
                                                            <a class=""  role="button" data-toggle="collapse" href="#collapseThree_blacklists" aria-expanded="true" aria-controls="collapseThree_blacklists">
                                                                <i class="fa fa-hashtag col-blue-grey" aria-hidden="true"></i> <?=l('Blacklists')?>
                                                                <i class="fa fa-plus pull-right" aria-hidden="true"></i>
                                                                <i class="fa fa-minus pull-right" aria-hidden="true"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree_blacklists" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree_blacklists" aria-expanded="true">
                                                        <!-- tags -->
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags blacklist-tags">
                                                                <label style="padding-right: 1.5em;">
                                                                    <i  aria-hidden="true"></i> <?=l('Tags blacklist')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Message')?>" data-content="<?=l("Add some tags to this list if you want to skip media marked by these tags from liking and/or commenting activity. You will skip the users from lacklisted tags as well.<br/><br/> You can add up to 3000 tags in this list. ")?>">?</span>
                                                                </label>
                                                                    <?php
                                                                    if(!empty($blacklist_tags)){
                                                                    foreach ($blacklist_tags as $key => $row) {?>
                                                                    <div class="item" data-blacklist_tags="<?=$row?>">
                                                                        <?=$row?>
                                                                        <input type="hidden" name="blacklist_tags[]" value="<?=$row?>">
                                                                        <div class="icon-remove btnRemoveTag">x</div>
                                                                        <div class="icon-tag"></div>
                                                                    </div>
                                                                    <?php }}?>

                                                                <div class="btn-group actionAddBlacklistTags" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddBlacklistTags"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- usernames -->
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags blacklist-usernames">
                                                                <label style="padding-right: 1.5em;">
                                                                    <i  aria-hidden="true"></i> <?=l('Usernames blacklist')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Message')?>" data-content="<?=l("Add some usernames to this list if you want to skip users from following or also from unfollowing activity. You will skip the media from blacklisted users as well.<br/><br/> You can add up to 3000 usernames in this list. ")?>">?</span>
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

                                                                <div class="btn-group actionAddBlacklistUsernames" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddBlacklistUsernames"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                            <span class="caret"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a href="javascript:void(0);" class=" waves-effect waves-block btnDeleteAllItem"><?=l('Delete all')?></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- keyword -->
                                                        <div class="panel-body row mb0">
                                                            <div class="vttags blacklist-keywords">
                                                                <label style="padding-right: 1.5em;">
                                                                    <i  aria-hidden="true"></i> <?=l('Keywords blacklist')?> <span class="help-tip" data-html="true" data-toggle="popover" data-placement="top" data-trigger="hover" title="" data-original-title="<?=l('Message')?>" data-content="<?=l("Add some keywords to this list that you don't want to interact with. This filter will search for stop keywords in media (tags and caption) and in user (username, full name, bio and website). For example: add playboy keyword to exclude all content that contains any words that start with playboy You can add up to 3000 keywords in this list.
                                                                  ")?>">?</span>
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

                                                                <div class="btn-group actionAddBlacklistKeywords" role="group">
                                                                    <button type="button" class="btn bg-blue-grey waves-effect btnOpenAddBlacklistKeywords"><?=l('Add')?></button>
                                                                    <div class="btn-group" role="group">
                                                                        <button type="button" class="btn bg-blue-grey waves-effect dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                                
                                <div role="tabpanel" class="tab-pane fade" id="post_with_icon_title">
                                    <div class="row">
                                        <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                                            <b><?=l('Default delay every post on post now')?></b>
                                            <div class="form-group">
                                                <select name="default_deplay_post_now" class="form-control">
                                                    <?php for ($i = 5; $i <= 900; $i++) {
                                                    if($i%5 == 0){
                                                    ?>
                                                        <option value="<?=$i?>" <?=$i==$result->default_deplay_post_now?"selected":""?>><?=$i." ".l('seconds')?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                            <b><?=l('Minimum delay every post on post now')?></b>
                                            <div class="form-group">
                                                <select name="minimum_deplay_post_now" class="form-control">
                                                    <?php for ($i = 5; $i <= 900; $i++) {
                                                    if($i%5 == 0){
                                                    ?>
                                                        <option value="<?=$i?>" <?=$i==$result->minimum_deplay_post_now?"selected":""?>><?=$i." ".l('seconds')?></option>
                                                    <?php }} ?>
                                                </select>
                                            </div>
                                            <b><?=l('Default delay every post on schedule')?></b>
                                            <div class="form-group">
                                                <select name="default_deplay" class="form-control">
                                                    <?php for ($i = 1; $i <= 720; $i++) {?>
                                                        <option value="<?=$i?>" <?=$i==$result->default_deplay?"selected":""?> ><?=$i." ".l('minutes')?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <b><?=l('Minimum delay every post on schedule')?></b>
                                            <div class="form-group">
                                                <select name="minimum_deplay" class="form-control">
                                                    <?php for ($i = 1; $i <= 720; $i++) {?>
                                                        <option value="<?=$i?>" <?=$i==$result->minimum_deplay?"selected":""?> ><?=$i." ".l('minutes')?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <b><?=l('Maximum size of file uploads')?></b>
                                            <div class="form-group">
                                                <select name="upload_max_size" class="form-control">
                                                    <?php for ($i=1; $i < 100; $i++) {?>
                                                        <option value="<?=$i?>" <?=$i==$result->upload_max_size?"selected":""?> ><?=$i." ".l('MB')?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                                <div role="tabpanel" class="tab-pane fade" id="post_with_icon_title1">
                                    <div class="row">
                                        <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12 mb0">
                                            <b><?=l('Default maximum Instagram accounts on each Proxy')?></b>
                                            <div class="form-group">
                                                <select name="proxy_default_igaccount" class="form-control">
                                                    <?php for ($i = 1; $i <= 100; $i++) {
                                                    ?>
                                                        <option value="<?=$i?>" <?=$i==$proxy_default_igaccount?"selected":""?>><?=$i." ".l('accounts')?></option>
                                                    <?php } ?>
                                                </select>
                                                <?=l("Recommended 5~10 accounts/proxy")?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages_with_icon_title">
                                    <b><?=l('Facebook ID')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="facebook_id" value="<?=!empty($result)?$result->facebook_id:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Facebook Secret')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="facebook_secret" value="<?=!empty($result)?$result->facebook_secret:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Googe Client ID')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="google_id" value="<?=!empty($result)?$result->google_id:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Google Client Secret')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="google_secret" value="<?=!empty($result)?$result->google_secret:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Twitter Consumer Secret')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="twitter_id" value="<?=!empty($result)?$result->twitter_id:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Twitter Consumer Secret')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="twitter_secret" value="<?=!empty($result)?$result->twitter_secret:""?>">
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade hidden" id="messages_with_icon_title2">
                                    <b><?=l('Facebook')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="facebook_page" value="<?=!empty($result)?$result->facebook_page:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Twitter')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="twitter_page" value="<?=!empty($result)?$result->twitter_page:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Pinterest')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="pinterest_page" value="<?=!empty($result)?$result->pinterest_page:""?>">
                                        </div>
                                    </div>

                                    <b><?=l('Instagram')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="instagram_page" value="<?=!empty($result)?$result->instagram_page:""?>">
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="home_with_icon_title3">
                                    <b><?=l('Protocal')?></b>
                                    <div class="form-group demo-radio-button">
                                        <input name="mail_type" type="radio" id="mail_type_mail" class="radio-col-red" <?=(!empty($result) && $result->mail_type == 1)?"checked=''":""?> value="1">
                                        <label for="mail_type_mail"><?=l('Mail')?></label>
                                        <input name="mail_type" type="radio" id="mail_type_smtp" class="radio-col-red" <?=(!empty($result) && $result->mail_type == 2)?"checked=''":""?> value="2">
                                        <label for="mail_type_smtp"><?=l('SMTP')?></label>
                                    </div>
                                    <b><?=l('From name')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mail_from_name" value="<?=!empty($result)?$result->mail_from_name:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('From email')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mail_from_email" value="<?=!empty($result)?$result->mail_from_email:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('SMTP Host')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mail_smtp_host" value="<?=!empty($result)?$result->mail_smtp_host:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('SMTP Username')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mail_smtp_user" value="<?=!empty($result)?$result->mail_smtp_user:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('SMTP Password')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mail_smtp_pass" value="<?=!empty($result)?$result->mail_smtp_pass:""?>">
                                        </div>
                                    </div>
                                    <b><?=l('SMTP Port')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="mail_smtp_port" value="<?=!empty($result)?$result->mail_smtp_port:""?>">
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="affiliate_settings">
                                    <b><?=l('Set Commission Percentage')?></b>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="hidden" class="form-control" name="token" id="token" value="<?=$this->security->get_csrf_hash();?>">
                                            <input type="text" class="form-control" name="commission_percentage" value="<?=!empty($result)?$result->commission_percentage:"0"?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn bg-red waves-effect"><?=l('Submit')?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
